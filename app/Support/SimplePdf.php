<?php

namespace App\Support;

/** Generator PDF ringan untuk laporan pendaftar tanpa dependensi renderer HTML. */
class SimplePdf
{
    private const PAGE_WIDTH = 595.28;

    private const PAGE_HEIGHT = 841.89;

    private const MARGIN = 42.0;

    private const BOTTOM_MARGIN = 54.0;

    private const CONTENT_WIDTH = self::PAGE_WIDTH - (self::MARGIN * 2);

    private array $pages = [];

    private array $images = [];

    private int $imageSequence = 0;

    private int $pageIndex = -1;

    private float $cursorY = 0.0;

    /** Membuka dokumen dan menyiapkan halaman pertamanya. */
    public function __construct(private readonly string $footerText = '')
    {
        $this->addPage();
    }

    /** Menambahkan judul utama dan subjudul pada posisi kursor saat ini. */
    public function heading(string $title, string $subtitle = ''): void
    {
        $this->text(self::MARGIN, $this->cursorY, $title, 19, 'F2', [0.02, 0.28, 0.22]);
        $this->cursorY -= 24;

        if ($subtitle !== '') {
            foreach ($this->wrap($subtitle, 9, self::CONTENT_WIDTH) as $line) {
                $this->text(self::MARGIN, $this->cursorY, $line, 9, 'F1', [0.31, 0.38, 0.48]);
                $this->cursorY -= 12;
            }
        }

        $this->line(self::MARGIN, $this->cursorY - 2, self::PAGE_WIDTH - self::MARGIN, $this->cursorY - 2, [0.83, 0.89, 0.86]);
        $this->cursorY -= 22;
    }

    /** Membuat kepala bagian berwarna untuk mengelompokkan data. */
    public function section(string $title): void
    {
        $this->ensureSpace(34);
        $this->cursorY -= 2;
        $this->rect(self::MARGIN, $this->cursorY - 17, self::CONTENT_WIDTH, 22, [0.92, 0.98, 0.95]);
        $this->text(self::MARGIN + 9, $this->cursorY - 10, strtoupper($title), 10, 'F2', [0.02, 0.31, 0.24]);
        $this->cursorY -= 32;
    }

    /** Menulis pasangan label dan nilai dengan pembungkusan teks otomatis. */
    public function field(string $label, mixed $value): void
    {
        $value = $this->stringValue($value);
        $labelWidth = 148.0;
        $valueX = self::MARGIN + $labelWidth + 12.0;
        $valueWidth = self::CONTENT_WIDTH - $labelWidth - 12.0;
        $valueLines = $this->wrap($value, 10, $valueWidth);
        $height = max(count($valueLines), 1) * 13 + 5;

        $this->ensureSpace($height);
        $startY = $this->cursorY;

        $this->text(self::MARGIN, $startY, $label.':', 9, 'F2', [0.28, 0.35, 0.43]);

        foreach ($valueLines as $line) {
            $this->text($valueX, $this->cursorY, $line, 10, 'F1', [0.07, 0.09, 0.13]);
            $this->cursorY -= 13;
        }

        $this->cursorY -= 5;
    }

    /** Menambahkan catatan bebas berukuran kecil. */
    public function note(string $text): void
    {
        foreach ($this->wrap($text, 9, self::CONTENT_WIDTH) as $line) {
            $this->ensureSpace(12);
            $this->text(self::MARGIN, $this->cursorY, $line, 9, 'F1', [0.38, 0.45, 0.55]);
            $this->cursorY -= 12;
        }

        $this->cursorY -= 5;
    }

    /** Menyisipkan gambar JPEG/PNG dan mengembalikan status keberhasilannya. */
    public function image(string $path, string $caption = '', float $maxHeight = 250.0): bool
    {
        $image = $this->prepareImage($path);

        if ($image === null) {
            return false;
        }

        $scale = min(self::CONTENT_WIDTH / $image['width'], $maxHeight / $image['height'], 1.0);
        $displayWidth = $image['width'] * $scale;
        $displayHeight = $image['height'] * $scale;
        $neededHeight = $displayHeight + 20.0 + ($caption !== '' ? 17.0 : 0.0);

        $this->ensureSpace($neededHeight);

        if ($caption !== '') {
            $this->text(self::MARGIN, $this->cursorY, $caption, 9, 'F2', [0.02, 0.31, 0.24]);
            $this->cursorY -= 15;
        }

        $x = self::MARGIN + ((self::CONTENT_WIDTH - $displayWidth) / 2);
        $y = $this->cursorY - $displayHeight;

        $this->pages[$this->pageIndex][] = sprintf(
            'q %.2F 0 0 %.2F %.2F %.2F cm /%s Do Q',
            $displayWidth,
            $displayHeight,
            $x,
            $y,
            $image['name']
        );

        $this->cursorY = $y - 18;

        return true;
    }

    /** Merakit seluruh objek menjadi dokumen PDF biner yang siap diunduh. */
    public function output(): string
    {
        $objects = [
            1 => '<< /Type /Catalog /Pages 2 0 R >>',
            2 => '',
            3 => '<< /Type /Font /Subtype /Type1 /BaseFont /Helvetica /Encoding /WinAnsiEncoding >>',
            4 => '<< /Type /Font /Subtype /Type1 /BaseFont /Helvetica-Bold /Encoding /WinAnsiEncoding >>',
        ];

        $pageObjectNumbers = [];
        $imageObjectNumbers = [];
        $totalPages = count($this->pages);
        $nextObjectNumber = 5;

        foreach ($this->images as $name => $image) {
            $imageObjectNumbers[$name] = $nextObjectNumber;
            $objects[$nextObjectNumber] = $this->imageObject($image);
            $nextObjectNumber++;
        }

        foreach ($this->pages as $index => $commands) {
            $contentNumber = $nextObjectNumber++;
            $pageNumber = $nextObjectNumber++;
            $pageObjectNumbers[] = $pageNumber.' 0 R';

            $stream = implode("\n", array_merge($commands, [$this->footer($index + 1, $totalPages)]));
            $objects[$contentNumber] = '<< /Length '.strlen($stream)." >>\nstream\n".$stream."\nendstream";
            $objects[$pageNumber] = sprintf(
                '<< /Type /Page /Parent 2 0 R /MediaBox [0 0 %.2F %.2F] /Resources << /Font << /F1 3 0 R /F2 4 0 R >> %s >> /Contents %d 0 R >>',
                self::PAGE_WIDTH,
                self::PAGE_HEIGHT,
                $this->imageResources($imageObjectNumbers),
                $contentNumber
            );
        }

        $objects[2] = '<< /Type /Pages /Kids ['.implode(' ', $pageObjectNumbers).'] /Count '.$totalPages.' >>';
        ksort($objects);

        $pdf = "%PDF-1.4\n%\xE2\xE3\xCF\xD3\n";
        $offsets = [0];

        foreach ($objects as $objectNumber => $object) {
            $offsets[$objectNumber] = strlen($pdf);
            $pdf .= $objectNumber." 0 obj\n".$object."\nendobj\n";
        }

        $xrefAt = strlen($pdf);
        $size = max(array_keys($objects)) + 1;
        $pdf .= "xref\n0 ".$size."\n";
        $pdf .= "0000000000 65535 f \n";

        for ($i = 1; $i < $size; $i++) {
            $pdf .= sprintf("%010d 00000 n \n", $offsets[$i]);
        }

        return $pdf."trailer\n<< /Size ".$size." /Root 1 0 R >>\nstartxref\n".$xrefAt."\n%%EOF";
    }

    /** Membuat halaman kosong dan mengembalikan kursor ke bagian atas. */
    private function addPage(): void
    {
        $this->pages[] = [];
        $this->pageIndex++;
        $this->cursorY = self::PAGE_HEIGHT - self::MARGIN;
    }

    /** Membuka halaman baru bila tinggi tersisa tidak mencukupi. */
    private function ensureSpace(float $height): void
    {
        if ($this->cursorY - $height < self::BOTTOM_MARGIN) {
            $this->addPage();
        }
    }

    /** Menambahkan perintah teks PDF pada halaman aktif. */
    private function text(float $x, float $y, string $text, int $size, string $font, array $color): void
    {
        $this->pages[$this->pageIndex][] = sprintf(
            "%.3F %.3F %.3F rg\nBT /%s %d Tf %.2F %.2F Td (%s) Tj ET",
            $color[0],
            $color[1],
            $color[2],
            $font,
            $size,
            $x,
            $y,
            $this->escapeText($text)
        );
    }

    /** Menggambar garis menggunakan koordinat dan warna PDF. */
    private function line(float $x1, float $y1, float $x2, float $y2, array $color): void
    {
        $this->pages[$this->pageIndex][] = sprintf(
            "%.3F %.3F %.3F RG\n%.2F %.2F m %.2F %.2F l S",
            $color[0],
            $color[1],
            $color[2],
            $x1,
            $y1,
            $x2,
            $y2
        );
    }

    /** Menggambar bidang persegi panjang terisi pada halaman aktif. */
    private function rect(float $x, float $y, float $width, float $height, array $color): void
    {
        $this->pages[$this->pageIndex][] = sprintf(
            "%.3F %.3F %.3F rg\n%.2F %.2F %.2F %.2F re f",
            $color[0],
            $color[1],
            $color[2],
            $x,
            $y,
            $width,
            $height
        );
    }

    /** Membaca gambar, menormalkan formatnya, dan menyiapkan metadata objek PDF. */
    private function prepareImage(string $path): ?array
    {
        if (! is_file($path)) {
            return null;
        }

        $info = @getimagesize($path);

        if (! $info || empty($info[0]) || empty($info[1])) {
            return null;
        }

        $source = match (strtolower($info['mime'] ?? '')) {
            'image/jpeg', 'image/jpg' => function_exists('imagecreatefromjpeg') ? @imagecreatefromjpeg($path) : null,
            'image/png' => function_exists('imagecreatefrompng') ? @imagecreatefrompng($path) : null,
            default => null,
        };

        if (! $source) {
            return null;
        }

        $width = imagesx($source);
        $height = imagesy($source);
        $canvas = imagecreatetruecolor($width, $height);

        if (! $canvas) {
            imagedestroy($source);

            return null;
        }

        $white = imagecolorallocate($canvas, 255, 255, 255);
        imagefill($canvas, 0, 0, $white);
        imagecopy($canvas, $source, 0, 0, 0, 0, $width, $height);

        ob_start();
        imagejpeg($canvas, null, 88);
        $data = ob_get_clean();

        imagedestroy($source);
        imagedestroy($canvas);

        if (! is_string($data) || $data === '') {
            return null;
        }

        $name = 'Im'.(++$this->imageSequence);
        $this->images[$name] = [
            'data' => $data,
            'width' => $width,
            'height' => $height,
        ];

        return [
            'name' => $name,
            'width' => $width,
            'height' => $height,
        ];
    }

    /** Mengubah metadata gambar menjadi stream objek PDF. */
    private function imageObject(array $image): string
    {
        return sprintf(
            "<< /Type /XObject /Subtype /Image /Width %d /Height %d /ColorSpace /DeviceRGB /BitsPerComponent 8 /Filter /DCTDecode /Length %d >>\nstream\n",
            $image['width'],
            $image['height'],
            strlen($image['data'])
        ).$image['data']."\nendstream";
    }

    /** Menyusun daftar referensi gambar untuk resource halaman. */
    private function imageResources(array $imageObjectNumbers): string
    {
        if ($imageObjectNumbers === []) {
            return '';
        }

        $resources = [];

        foreach ($imageObjectNumbers as $name => $objectNumber) {
            $resources[] = '/'.$name.' '.$objectNumber.' 0 R';
        }

        return '/XObject << '.implode(' ', $resources).' >>';
    }

    /** Membuat footer berisi keterangan dokumen dan nomor halaman. */
    private function footer(int $page, int $total): string
    {
        $text = trim($this->footerText.' | Halaman '.$page.' dari '.$total, ' |');

        return sprintf(
            "0.420 0.470 0.540 rg\nBT /F1 8 Tf %.2F 28.00 Td (%s) Tj ET",
            self::MARGIN,
            $this->escapeText($text)
        );
    }

    /** Membungkus teks berdasarkan perkiraan lebar font dan area tersedia. */
    private function wrap(string $text, int $fontSize, float $maxWidth): array
    {
        $text = trim(preg_replace('/\s+/u', ' ', $text) ?: '');

        if ($text === '') {
            return ['-'];
        }

        $maxChars = max(12, (int) floor($maxWidth / ($fontSize * 0.52)));
        $lines = [];
        $current = '';

        foreach (preg_split('/\s+/u', $text) ?: [] as $word) {
            foreach ($this->chunks($word, $maxChars) as $chunk) {
                $candidate = $current === '' ? $chunk : $current.' '.$chunk;

                if ($this->length($candidate) <= $maxChars) {
                    $current = $candidate;

                    continue;
                }

                if ($current !== '') {
                    $lines[] = $current;
                }

                $current = $chunk;
            }
        }

        if ($current !== '') {
            $lines[] = $current;
        }

        return $lines ?: ['-'];
    }

    /** Memecah satu kata yang terlalu panjang agar tidak keluar dari halaman. */
    private function chunks(string $word, int $maxChars): array
    {
        if ($this->length($word) <= $maxChars) {
            return [$word];
        }

        $chunks = [];
        $offset = 0;
        $length = $this->length($word);

        while ($offset < $length) {
            $chunks[] = $this->substring($word, $offset, $maxChars);
            $offset += $maxChars;
        }

        return $chunks;
    }

    /** Mengubah nilai campuran menjadi teks aman untuk ditampilkan. */
    private function stringValue(mixed $value): string
    {
        if ($value === null || $value === '') {
            return '-';
        }

        return (string) $value;
    }

    /** Mengonversi UTF-8 dan meng-escape karakter khusus sintaks PDF. */
    private function escapeText(string $text): string
    {
        $text = preg_replace('/\s+/u', ' ', $text) ?: '';

        if (function_exists('iconv')) {
            $converted = @iconv('UTF-8', 'Windows-1252//TRANSLIT//IGNORE', $text);

            if ($converted !== false) {
                $text = $converted;
            }
        }

        return str_replace(['\\', '(', ')'], ['\\\\', '\\(', '\\)'], $text);
    }

    /** Menghitung panjang teks dengan dukungan multibyte bila tersedia. */
    private function length(string $text): int
    {
        return function_exists('mb_strlen') ? mb_strlen($text) : strlen($text);
    }

    /** Mengambil potongan teks dengan dukungan multibyte bila tersedia. */
    private function substring(string $text, int $start, int $length): string
    {
        return function_exists('mb_substr') ? mb_substr($text, $start, $length) : substr($text, $start, $length);
    }
}
