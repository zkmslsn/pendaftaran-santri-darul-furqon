<?php

namespace App\Exports;

use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithCustomValueBinder;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Cell\Cell;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use PhpOffice\PhpSpreadsheet\Cell\DefaultValueBinder;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class SantriExport extends DefaultValueBinder implements FromCollection, ShouldAutoSize, WithColumnFormatting, WithColumnWidths, WithCustomValueBinder, WithEvents, WithHeadings, WithMapping, WithStyles, WithTitle
{
    /** Menerima koleksi pendaftar yang sudah difilter oleh controller. */
    public function __construct(private Collection $pendaftars) {}

    /** Mengembalikan sumber baris yang akan ditulis ke lembar kerja. */
    public function collection()
    {
        return $this->pendaftars;
    }

    /** Menentukan nama tab pada berkas Excel. */
    public function title(): string
    {
        return 'Data Santri';
    }

    /** Mendefinisikan judul kolom sesuai urutan hasil pemetaan. */
    public function headings(): array
    {
        return [
            'Nomor ID',
            'Nomor Induk Santri',
            'Nama',
            'Email',
            'Jenis Kelamin',
            'Tempat Lahir',
            'Tanggal Lahir',
            'Alamat',
            'Asal Sekolah',
            'Nama Ayah',
            'Pekerjaan Ayah',
            'Nama Ibu',
            'Pekerjaan Ibu',
            'WA Wali',
            'WA Santri',
            'Kemampuan Membaca Al-Quran',
            'Jumlah Hafalan',
            'Riwayat Penyakit',
            'Motivasi Masuk Pondok',
            'Status Santri',
            'Status Pembayaran',
            'Catatan',
            'Email Login',
            'Tanggal Daftar',
        ];
    }

    /** Mengubah satu model pendaftar menjadi satu baris data Excel. */
    public function map($pendaftar): array
    {
        return [
            $pendaftar->id,
            $this->nomorIndukSantri($pendaftar),
            $pendaftar->nama,
            $pendaftar->email,
            $pendaftar->jenis_kelamin,
            $pendaftar->tempat_lahir,
            $this->formatDate($pendaftar->tgl_lahir),
            $pendaftar->alamat,
            $pendaftar->asal_sekolah,
            $pendaftar->nama_ayah,
            $pendaftar->pekerjaan_ayah,
            $pendaftar->nama_ibu,
            $pendaftar->pekerjaan_ibu,
            $pendaftar->wa_wali,
            $pendaftar->wa_santri,
            $pendaftar->kemampuan_membaca_alquran,
            $pendaftar->jumlah_hafalan,
            $pendaftar->riwayat_penyakit,
            $pendaftar->motivasi_masuk_pondok,
            $this->statusLabel($pendaftar->status),
            $this->paymentLabel($pendaftar->status_pembayaran),
            $pendaftar->catatan,
            $pendaftar->user?->email ?? $pendaftar->email,
            optional($pendaftar->created_at)->format('d/m/Y H:i'),
        ];
    }

    /** Memberi gaya khusus pada baris kepala tabel. */
    public function styles(Worksheet $sheet): array
    {
        return [
            1 => [
                'font' => [
                    'bold' => true,
                    'color' => ['rgb' => 'FFFFFF'],
                ],
                'fill' => [
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => ['rgb' => '064E3B'],
                ],
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical' => Alignment::VERTICAL_CENTER,
                    'wrapText' => true,
                ],
            ],
        ];
    }

    /** Menetapkan lebar kolom agar konten panjang tetap mudah dibaca. */
    public function columnWidths(): array
    {
        return [
            'A' => 24,
            'B' => 22,
            'C' => 24,
            'D' => 28,
            'E' => 20,
            'F' => 20,
            'G' => 16,
            'H' => 38,
            'I' => 24,
            'J' => 24,
            'K' => 24,
            'L' => 24,
            'M' => 24,
            'N' => 18,
            'O' => 18,
            'P' => 28,
            'Q' => 18,
            'R' => 30,
            'S' => 36,
            'T' => 18,
            'U' => 22,
            'V' => 30,
            'W' => 28,
            'X' => 20,
        ];
    }

    /** Memaksa nomor induk dan WhatsApp diperlakukan sebagai teks. */
    public function columnFormats(): array
    {
        return [
            'B' => NumberFormat::FORMAT_TEXT,
            'N' => NumberFormat::FORMAT_TEXT,
            'O' => NumberFormat::FORMAT_TEXT,
        ];
    }

    /** Menjaga angka identitas agar nol di depan tidak hilang. */
    public function bindValue(Cell $cell, $value)
    {
        if (in_array($cell->getColumn(), ['B', 'N', 'O'], true)) {
            $cell->setValueExplicit((string) $value, DataType::TYPE_STRING);

            return true;
        }

        return parent::bindValue($cell, $value);
    }

    /** Menerapkan filter, freeze pane, border, dan pembungkusan teks setelah ekspor. */
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();
                $lastRow = max($this->pendaftars->count() + 1, 1);
                $range = 'A1:X'.$lastRow;

                $sheet->freezePane('A2');
                $sheet->setAutoFilter('A1:X1');
                $sheet->getRowDimension(1)->setRowHeight(28);

                $sheet->getStyle($range)->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => ['rgb' => 'D9E2DC'],
                        ],
                    ],
                    'alignment' => [
                        'vertical' => Alignment::VERTICAL_TOP,
                        'wrapText' => true,
                    ],
                ]);

                $sheet->getStyle('A1:X1')->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => ['rgb' => '064E3B'],
                        ],
                    ],
                ]);
            },
        ];
    }

    /** Mengambil nomor induk dengan fallback untuk data lama. */
    private function nomorIndukSantri($pendaftar): string
    {
        return (string) ($pendaftar->nomor_induk_santri ?: $pendaftar->password_awal ?: '');
    }

    /** Mengubah kode status santri menjadi label untuk laporan. */
    private function statusLabel(?string $status): string
    {
        return [
            'menunggu' => 'Menunggu Verifikasi',
            'perlu_perbaikan' => 'Perlu Perbaikan',
            'diterima' => 'Aktif',
            'aktif' => 'Aktif',
            'alumni' => 'Alumni',
            'ditolak' => 'Ditolak',
        ][$status] ?? ucfirst((string) $status);
    }

    /** Mengubah kode pembayaran menjadi label untuk laporan. */
    private function paymentLabel(?string $status): string
    {
        return [
            'belum_upload' => 'Belum Upload',
            'menunggu_verifikasi' => 'Menunggu Verifikasi',
            'terverifikasi' => 'Terverifikasi',
            'ditolak' => 'Ditolak',
        ][$status] ?? ucfirst((string) $status);
    }

    /** Menormalkan berbagai nilai tanggal ke format hari/bulan/tahun. */
    private function formatDate($date): string
    {
        if (blank($date)) {
            return '';
        }

        try {
            return Carbon::parse($date)->format('d/m/Y');
        } catch (\Throwable) {
            return (string) $date;
        }
    }
}
