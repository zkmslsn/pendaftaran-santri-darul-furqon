<?php

namespace App\Http\Controllers;

use App\Exports\SantriExport;
use App\Models\Pendaftar;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Excel as ExcelWriter;
use Maatwebsite\Excel\Facades\Excel as ExcelFacade;

class AdminPendaftarController extends Controller
{
    /** Kelompok status yang digunakan bersama oleh dashboard, filter, dan ekspor. */
    private const ACTIVE_STATUSES = ['diterima', 'aktif'];

    private const CANDIDATE_STATUSES = ['menunggu', 'perlu_perbaikan'];

    private const ALL_STATUSES = ['menunggu', 'perlu_perbaikan', 'diterima', 'aktif', 'alumni', 'ditolak'];

    private const PAYMENT_STATUSES = ['belum_upload', 'menunggu_verifikasi', 'terverifikasi', 'ditolak'];

    private const DOWNLOAD_TYPES = ['semua', 'calon', 'aktif', 'alumni'];

    /** Menampilkan ringkasan statistik utama untuk admin. */
    public function dashboard()
    {
        $this->ensureAdmin();

        $stats = $this->dashboardStats();

        return view('admin.dashboard', compact('stats'));
    }

    /** Menampilkan daftar calon santri beserta filter pencarian. */
    public function index(Request $request)
    {
        return $this->categoryPage($request, 'pendaftar');
    }

    /** Menampilkan daftar santri yang sudah diterima atau aktif. */
    public function aktif(Request $request)
    {
        return $this->categoryPage($request, 'aktif');
    }

    /** Menampilkan daftar santri dengan status alumni. */
    public function alumni(Request $request)
    {
        return $this->categoryPage($request, 'alumni');
    }

    /** Menampilkan detail lengkap seorang pendaftar. */
    public function show(Pendaftar $pendaftar)
    {
        $this->ensureAdmin();

        $category = $this->categoryFromStatus($pendaftar->status);
        $backRoute = $this->routeNameFromCategory($category);

        return view('admin.pendaftar.show', compact('pendaftar', 'category', 'backRoute'));
    }

    /** Menampilkan halaman pemilihan data yang akan diunduh. */
    public function download(Request $request)
    {
        $this->ensureAdmin();

        $filters = $this->downloadFilters($request);
        $years = Pendaftar::query()
            ->selectRaw('YEAR(created_at) as year')
            ->whereNotNull('created_at')
            ->distinct()
            ->orderByDesc('year')
            ->pluck('year')
            ->filter()
            ->values();

        $pendaftars = $this->downloadQuery($filters)
            ->orderBy('id')
            ->get();

        return view('admin.pendaftar.download', compact('filters', 'years', 'pendaftars'));
    }

    /** Mengekspor data terfilter ke berkas Excel. */
    public function export(Request $request)
    {
        $this->ensureAdmin();

        $filters = $this->downloadFilters($request);
        $selectedIds = collect($request->input('pendaftar_ids', []))
            ->filter(fn ($id) => is_numeric($id))
            ->map(fn ($id) => (int) $id)
            ->values()
            ->all();

        $pendaftars = $this->downloadQuery($filters)
            ->when($selectedIds, fn (Builder $query) => $query->whereIn('id', $selectedIds))
            ->orderBy('id')
            ->get();

        $fileName = 'data_santri_'.$filters['jenis_data'].'_'.($filters['tahun'] ?: 'semua_tahun').'_'.date('Y-m-d').'.xlsx';

        return ExcelFacade::download(new SantriExport($pendaftars), $fileName, ExcelWriter::XLSX);
    }

    /** Menampilkan formulir perubahan data pendaftar. */
    public function edit(Pendaftar $pendaftar)
    {
        $this->ensureAdmin();

        return view('admin.pendaftar.edit', compact('pendaftar'));
    }

    /** Memvalidasi dan menyimpan perubahan profil pendaftar. */
    public function update(Request $request, Pendaftar $pendaftar)
    {
        $this->ensureAdmin();

        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => ['required', 'email', Rule::unique('pendaftars', 'email')->ignore($pendaftar->id)],
            'jenis_kelamin' => ['required', Rule::in(['Perempuan'])],
            'tempat_lahir' => 'required|string|max:255',
            'tgl_lahir' => 'required|date',
            'alamat' => 'required|string',
            'asal_sekolah' => 'required|string|max:255',
            'nama_ayah' => 'required|string|max:255',
            'pekerjaan_ayah' => 'nullable|string|max:255',
            'nama_ibu' => 'required|string|max:255',
            'pekerjaan_ibu' => 'nullable|string|max:255',
            'wa_wali' => 'required|digits_between:10,13',
            'wa_santri' => 'nullable|digits_between:10,13',
            'kemampuan_membaca_alquran' => 'nullable|string|max:255',
            'jumlah_hafalan' => 'nullable|string|max:255',
            'riwayat_penyakit' => 'nullable|string',
            'motivasi_masuk_pondok' => 'nullable|string',
            'status' => ['required', Rule::in(self::ALL_STATUSES)],
            'status_pembayaran' => ['required', Rule::in(self::PAYMENT_STATUSES)],
            'catatan' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'kartu_keluarga' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'akta_lahir' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'bukti_pembayaran' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        foreach (['foto', 'kartu_keluarga', 'akta_lahir', 'bukti_pembayaran'] as $field) {
            if ($request->hasFile($field)) {
                $folder = $field === 'foto'
                    ? 'foto_pendaftar'
                    : ($field === 'bukti_pembayaran' ? 'bukti_pembayaran' : 'dokumen_pendaftar');

                $validated[$field] = $request->file($field)->store($folder, 'public');
            } else {
                unset($validated[$field]);
            }
        }

        if ($request->hasFile('bukti_pembayaran')) {
            $validated['tanggal_upload_pembayaran'] = now();
        }

        $pendaftar->update(array_merge(
            $validated,
            $this->statusDatePayload($pendaftar, $validated['status'])
        ));

        $category = $this->categoryFromStatus($pendaftar->fresh()->status);

        return redirect()
            ->route($this->routeNameFromCategory($category))
            ->with('success', 'Data santri berhasil diperbarui.');
    }

    /** Mengubah status penerimaan sekaligus tanggal status terkait. */
    public function updateStatus(Request $request, Pendaftar $pendaftar)
    {
        $this->ensureAdmin();

        $validated = $request->validate([
            'status' => ['required', Rule::in(self::ALL_STATUSES)],
            'catatan' => 'nullable|string',
        ]);

        $pendaftar->update(array_merge([
            'status' => $validated['status'],
            'catatan' => $validated['catatan'] ?? $pendaftar->catatan,
        ], $this->statusDatePayload($pendaftar, $validated['status'])));

        return back()->with('success', 'Status santri berhasil diperbarui.');
    }

    /** Mengubah hasil verifikasi pembayaran pendaftar. */
    public function updatePembayaran(Request $request, Pendaftar $pendaftar)
    {
        $this->ensureAdmin();

        $validated = $request->validate([
            'status_pembayaran' => ['required', Rule::in(self::PAYMENT_STATUSES)],
        ]);

        if (! $pendaftar->bukti_pembayaran && $validated['status_pembayaran'] !== 'belum_upload') {
            return back()->with('error', 'Santri belum mengupload bukti pembayaran.');
        }

        $pendaftar->update([
            'status_pembayaran' => $validated['status_pembayaran'],
        ]);

        return back()->with('success', 'Status pembayaran berhasil diperbarui.');
    }

    /** Menyimpan hasil pemeriksaan data dan catatan perbaikan admin. */
    public function updateVerification(Request $request, Pendaftar $pendaftar)
    {
        $this->ensureAdmin();

        $validated = $request->validate([
            'status_verifikasi' => ['required', Rule::in(['diterima', 'ditolak', 'perlu_perbaikan'])],
            'catatan' => 'nullable|string',
        ]);

        if ($validated['status_verifikasi'] === 'diterima') {
            if (! $pendaftar->email) {
                return back()->with('error', 'Gmail calon santri belum tersedia.');
            }

            $nomorInduk = $this->generateNomorInduk($pendaftar);
            [$akunSantri, $akunBaru, $akunError] = $this->syncSantriAccount($pendaftar, $nomorInduk);

            if ($akunError) {
                return back()->with('error', $akunError);
            }

            $pendaftar->update([
                'nomor_induk_santri' => $nomorInduk,
                'password_awal' => $nomorInduk,
                'status' => 'aktif',
                'status_pembayaran' => 'terverifikasi',
                'tanggal_diterima' => $pendaftar->tanggal_diterima ?: now(),
                'catatan' => $validated['catatan'] ?? 'Pendaftaran diterima.',
            ]);

            $message = $akunBaru
                ? 'Santri berhasil diterima dan akun login berhasil dibuat.'
                : 'Santri berhasil diterima.';

            return back()->with($this->accountFlash($pendaftar->fresh(['user']), $message));
        }

        if ($validated['status_verifikasi'] === 'ditolak') {
            $pendaftar->update([
                'status' => 'ditolak',
                'status_pembayaran' => 'ditolak',
                'catatan' => $validated['catatan'] ?? 'Pendaftaran ditolak.',
            ]);

            return back()->with('success', 'Pendaftaran berhasil ditolak.');
        }

        $pendaftar->update([
            'status' => 'perlu_perbaikan',
            'status_pembayaran' => 'menunggu_verifikasi',
            'catatan' => $validated['catatan'] ?? 'Data perlu diperbaiki.',
        ]);

        return back()->with('success', 'Status pendaftar diubah menjadi perlu perbaikan.');
    }

    /** Membuat atau menyelaraskan akun login santri dari data pendaftar. */
    public function buatAkunSantri(Request $request, Pendaftar $pendaftar)
    {
        $this->ensureAdmin();

        if (! $pendaftar->email) {
            return back()->with('error', 'Gmail calon santri belum tersedia.');
        }

        $nomorInduk = $this->generateNomorInduk($pendaftar);
        [$akunSantri, $akunBaru, $akunError] = $this->syncSantriAccount($pendaftar, $nomorInduk);

        if ($akunError) {
            return back()->with('error', $akunError);
        }

        $pendaftar->update([
            'nomor_induk_santri' => $nomorInduk,
            'password_awal' => $nomorInduk,
            'status' => 'aktif',
            'status_pembayaran' => 'terverifikasi',
            'tanggal_diterima' => $pendaftar->tanggal_diterima ?: now(),
        ]);

        $message = $akunBaru
            ? 'Akun login santri berhasil dibuat.'
            : 'Akun santri sudah pernah dibuat dan data nomor induk sudah diselaraskan.';

        return back()->with($this->accountFlash($pendaftar->fresh(['user']), $message));
    }

    /** Menyelesaikan verifikasi akhir dan menyiapkan akun santri bila diterima. */
    public function verifikasiFinal(Request $request, Pendaftar $pendaftar)
    {
        $this->ensureAdmin();

        $validated = $request->validate([
            'status' => 'required|in:diterima,ditolak,perlu_perbaikan',
            'catatan' => 'nullable|string',
        ]);

        if ($validated['status'] === 'diterima') {
            if (! $pendaftar->bukti_pembayaran) {
                return back()->with('error', 'Bukti pembayaran belum tersedia.');
            }

            if (! $pendaftar->email) {
                return back()->with('error', 'Gmail calon santri belum tersedia.');
            }

            $nomorInduk = $this->generateNomorInduk($pendaftar);
            [$akunSantri, $akunBaru, $akunError] = $this->syncSantriAccount($pendaftar, $nomorInduk);

            if ($akunError) {
                return back()->with('error', $akunError);
            }

            $pendaftar->update([
                'nomor_induk_santri' => $nomorInduk,
                'password_awal' => $nomorInduk,
                'status' => 'aktif',
                'status_pembayaran' => 'terverifikasi',
                'tanggal_diterima' => $pendaftar->tanggal_diterima ?: now(),
                'catatan' => $validated['catatan'] ?? 'Pendaftaran dan pembayaran telah diverifikasi.',
            ]);

            $message = $akunBaru
                ? 'Pendaftaran berhasil diverifikasi dan akun santri berhasil dibuat.'
                : 'Pendaftaran dan pembayaran berhasil diverifikasi.';

            return back()->with($this->accountFlash($pendaftar->fresh(['user']), $message));
        }

        if ($validated['status'] === 'ditolak') {
            $pendaftar->update([
                'status' => 'ditolak',
                'status_pembayaran' => 'ditolak',
                'catatan' => $validated['catatan'] ?? 'Pendaftaran ditolak.',
            ]);

            return back()->with('success', 'Pendaftaran berhasil ditolak.');
        }

        $pendaftar->update([
            'status' => 'perlu_perbaikan',
            'status_pembayaran' => 'menunggu_verifikasi',
            'catatan' => $validated['catatan'] ?? 'Data perlu diperbaiki.',
        ]);

        return back()->with('success', 'Status pendaftar diubah menjadi perlu perbaikan.');
    }

    /** Menyiapkan data daftar, statistik, dan metadata untuk suatu kategori. */
    private function categoryPage(Request $request, string $category)
    {
        $this->ensureAdmin();

        $filters = $this->dataFilters($request);
        $stats = $this->dashboardStats();
        $page = $this->pageMeta($category);
        $years = $this->categoryQuery($category)
            ->selectRaw('YEAR(created_at) as year')
            ->whereNotNull('created_at')
            ->distinct()
            ->orderByDesc('year')
            ->pluck('year')
            ->filter()
            ->values();

        $pendaftars = $this->categoryQuery($category)
            ->with('user')
            ->when($filters['search'], fn (Builder $query) => $this->applySearch($query, $filters['search']))
            ->when($filters['tahun'], fn (Builder $query) => $query->whereYear('created_at', $filters['tahun']))
            ->latest()
            ->get();

        return view('admin.pendaftar.index', compact('pendaftars', 'filters', 'stats', 'page', 'years'));
    }

    /**
     * Menyelaraskan identitas akun santri dan mengembalikan kredensial awal
     * yang perlu ditampilkan kepada admin.
     */
    private function syncSantriAccount(Pendaftar $pendaftar, string $nomorInduk): array
    {
        if (! $pendaftar->email) {
            return [null, false, 'Gmail calon santri belum tersedia.'];
        }

        $user = $this->findSantriAccount($pendaftar, $nomorInduk);
        $emailOwner = User::where('email', $pendaftar->email)
            ->when($user, fn (Builder $query) => $query->where('id', '!=', $user->id))
            ->first();

        if ($emailOwner) {
            return [null, false, 'Gmail ini sudah terdaftar sebagai akun login.'];
        }

        $payload = [
            'name' => $pendaftar->nama,
            'email' => $pendaftar->email,
            'nomor_induk_santri' => $nomorInduk,
            'role' => 'santri',
        ];

        if (! $user || $pendaftar->password_awal !== $nomorInduk) {
            $payload['password'] = Hash::make($nomorInduk);
        }

        if ($user) {
            $user->update($payload);

            return [$user, false, null];
        }

        return [User::create($payload), true, null];
    }

    /** Mencari akun santri terkait menggunakan user_id, nomor induk, atau email. */
    private function findSantriAccount(Pendaftar $pendaftar, ?string $nomorInduk = null): ?User
    {
        $nomorInduk = $nomorInduk ?: $pendaftar->nomor_induk_santri;

        if (! $nomorInduk && ! $pendaftar->email) {
            return null;
        }

        return User::where('role', 'santri')
            ->where(function (Builder $query) use ($pendaftar, $nomorInduk) {
                if ($nomorInduk) {
                    $query->orWhere('nomor_induk_santri', $nomorInduk);
                }

                if ($pendaftar->email) {
                    $query->orWhere('email', $pendaftar->email);
                }
            })
            ->first();
    }

    /** Membuat nomor induk berurutan berdasarkan tahun masuk santri. */
    private function generateNomorInduk(Pendaftar $pendaftar): string
    {
        $tahunMasuk = $this->tahunMasukSantri($pendaftar);
        $nomorIndukSaatIni = $pendaftar->getRawOriginal('nomor_induk_santri');

        if ($this->isNomorIndukTahunMasuk($nomorIndukSaatIni, $tahunMasuk)) {
            return $nomorIndukSaatIni;
        }

        $sequence = $this->nextNomorIndukSequence($tahunMasuk);

        do {
            $nomorInduk = $tahunMasuk.str_pad((string) $sequence, 3, '0', STR_PAD_LEFT);
            $sequence++;
        } while (
            Pendaftar::where('nomor_induk_santri', $nomorInduk)
                ->where('id', '!=', $pendaftar->id)
                ->exists()
        );

        return $nomorInduk;
    }

    /** Menentukan dua digit tahun masuk dari tanggal penerimaan atau pendaftaran. */
    private function tahunMasukSantri(Pendaftar $pendaftar): string
    {
        return optional($pendaftar->tanggal_diterima ?: now())->format('Y')
            ?: now()->format('Y');
    }

    /** Memastikan nomor induk memakai pola dan tahun masuk yang diharapkan. */
    private function isNomorIndukTahunMasuk(?string $nomorInduk, string $tahunMasuk): bool
    {
        return is_string($nomorInduk)
            && preg_match('/^'.preg_quote($tahunMasuk, '/').'\d{3,}$/', $nomorInduk) === 1;
    }

    /** Mengambil nomor urut berikutnya yang belum dipakai pada tahun tertentu. */
    private function nextNomorIndukSequence(string $tahunMasuk): int
    {
        return Pendaftar::query()
            ->where('nomor_induk_santri', 'like', $tahunMasuk.'%')
            ->pluck('nomor_induk_santri')
            ->map(function ($nomorInduk) use ($tahunMasuk) {
                if (! is_string($nomorInduk) || preg_match('/^'.preg_quote($tahunMasuk, '/').'(\d{3,})$/', $nomorInduk, $matches) !== 1) {
                    return 0;
                }

                return (int) $matches[1];
            })
            ->max() + 1;
    }

    /** Menentukan perubahan tanggal diterima/alumni berdasarkan status baru. */
    private function statusDatePayload(Pendaftar $pendaftar, string $status): array
    {
        $payload = [];

        if ((in_array($status, self::ACTIVE_STATUSES, true) || $status === 'alumni') && ! $pendaftar->tanggal_diterima) {
            $payload['tanggal_diterima'] = now();
        }

        if ($status === 'alumni' && ! $pendaftar->tanggal_alumni) {
            $payload['tanggal_alumni'] = now();
        }

        return $payload;
    }

    /** Menyiapkan data flash kredensial akun untuk ditampilkan setelah redirect. */
    private function accountFlash(Pendaftar $pendaftar, string $message): array
    {
        return [
            'success' => $message,
            'nama_santri' => $pendaftar->nama,
            'nomor_induk_santri' => $pendaftar->nomor_induk_santri ?: $pendaftar->password_awal,
            'email_santri' => $pendaftar->user?->email ?? $pendaftar->email,
            'password_santri' => $pendaftar->password_awal ?: $pendaftar->nomor_induk_santri,
            'wa_santri' => $pendaftar->wa_santri,
            'wa_wali' => $pendaftar->wa_wali,
        ];
    }

    /** Menghentikan request jika pengguna aktif bukan admin. */
    private function ensureAdmin(): void
    {
        abort_unless(auth()->user()?->role === 'admin', 403, 'Anda tidak memiliki akses ke halaman admin.');
    }

    /** Menormalisasi filter pencarian pada halaman daftar admin. */
    private function dataFilters(Request $request): array
    {
        return [
            'search' => $request->string('search')->toString(),
            'tahun' => is_numeric($request->query('tahun')) ? (int) $request->query('tahun') : null,
        ];
    }

    /** Menormalisasi kategori, tahun, dan kata kunci untuk proses unduh. */
    private function downloadFilters(Request $request): array
    {
        $jenisData = $request->input('jenis_data', $request->query('kategori', 'semua'));
        $tahun = $request->input('tahun');

        return [
            'jenis_data' => in_array($jenisData, self::DOWNLOAD_TYPES, true) ? $jenisData : 'semua',
            'tahun' => is_numeric($tahun) ? (int) $tahun : null,
            'search' => $request->string('search')->toString(),
        ];
    }

    /** Membentuk query ekspor berdasarkan seluruh filter unduhan. */
    private function downloadQuery(array $filters): Builder
    {
        return $this->categoryQuery($filters['jenis_data'])
            ->with('user')
            ->when($filters['tahun'], fn (Builder $query) => $query->whereYear('created_at', $filters['tahun']))
            ->when($filters['search'], fn (Builder $query) => $this->applySearch($query, $filters['search']));
    }

    /** Membatasi query ke kategori calon, aktif, alumni, atau semua data. */
    private function categoryQuery(string $category): Builder
    {
        $query = Pendaftar::query();

        if ($category === 'calon') {
            return $query->whereIn('status', self::CANDIDATE_STATUSES);
        }

        if ($category === 'pendaftar') {
            return $query;
        }

        if ($category === 'aktif') {
            return $query->whereIn('status', self::ACTIVE_STATUSES);
        }

        if ($category === 'alumni') {
            return $query->where('status', 'alumni');
        }

        return $query;
    }

    /** Menambahkan pencarian lintas identitas, status, kontak, dan akun santri. */
    private function applySearch(Builder $query, string $search): void
    {
        $query->where(function (Builder $q) use ($search) {
            $q->where('nama', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%")
                ->orWhere('nomor_induk_santri', 'like', "%{$search}%")
                ->orWhere('jenis_kelamin', 'like', "%{$search}%")
                ->orWhere('asal_sekolah', 'like', "%{$search}%")
                ->orWhere('nama_ayah', 'like', "%{$search}%")
                ->orWhere('nama_ibu', 'like', "%{$search}%")
                ->orWhere('wa_wali', 'like', "%{$search}%")
                ->orWhere('wa_santri', 'like', "%{$search}%")
                ->orWhere('status', 'like', "%{$search}%")
                ->orWhere('status_pembayaran', 'like', "%{$search}%")
                ->orWhereHas('user', function (Builder $userQuery) use ($search) {
                    $userQuery->where('email', 'like', "%{$search}%");
                });
        });
    }

    /** Menghitung angka ringkasan untuk seluruh kategori dashboard. */
    private function dashboardStats(): array
    {
        return [
            'total' => Pendaftar::count(),
            'calon' => Pendaftar::whereIn('status', self::CANDIDATE_STATUSES)->count(),
            'aktif' => Pendaftar::whereIn('status', self::ACTIVE_STATUSES)->count(),
            'alumni' => Pendaftar::where('status', 'alumni')->count(),
            'ditolak' => Pendaftar::where('status', 'ditolak')->count(),
            'perlu_perbaikan' => Pendaftar::where('status', 'perlu_perbaikan')->count(),
            'pembayaran_belum' => Pendaftar::where('status_pembayaran', '!=', 'terverifikasi')->count(),
            'pembayaran_menunggu' => Pendaftar::where('status_pembayaran', 'menunggu_verifikasi')->count(),
            'pembayaran_terverifikasi' => Pendaftar::where('status_pembayaran', 'terverifikasi')->count(),
        ];
    }

    /** Menyediakan judul, deskripsi, dan tampilan kosong sesuai kategori. */
    private function pageMeta(string $category): array
    {
        return [
            'calon' => [
                'category' => 'calon',
                'menu' => 'calon',
                'title' => 'Data Pendaftar / Calon Santri',
                'subtitle' => 'Berisi calon santri yang masih dalam proses verifikasi data dan pembayaran.',
                'empty' => 'Belum ada calon santri yang sedang diproses.',
            ],
            'pendaftar' => [
                'category' => 'pendaftar',
                'menu' => 'calon',
                'title' => 'Data Pendaftar',
                'subtitle' => 'Arsip seluruh data pendaftar, termasuk yang sudah diterima menjadi santri aktif.',
                'empty' => 'Belum ada data pendaftar.',
            ],
            'aktif' => [
                'category' => 'aktif',
                'menu' => 'aktif',
                'title' => 'Santri Aktif',
                'subtitle' => 'Berisi santri yang sudah diterima dan masih aktif tinggal di pondok.',
                'empty' => 'Belum ada data santri aktif.',
            ],
            'alumni' => [
                'category' => 'alumni',
                'menu' => 'alumni',
                'title' => 'Alumni',
                'subtitle' => 'Berisi santri yang sudah tidak tinggal di pondok atau sudah menjadi alumni.',
                'empty' => 'Belum ada data alumni.',
            ],
        ][$category];
    }

    /** Memetakan status database ke kategori halaman admin. */
    private function categoryFromStatus(?string $status): string
    {
        if (in_array($status, self::ACTIVE_STATUSES, true)) {
            return 'aktif';
        }

        if ($status === 'alumni') {
            return 'alumni';
        }

        return 'calon';
    }

    /** Memetakan kategori ke nama route daftar yang sesuai. */
    private function routeNameFromCategory(string $category): string
    {
        return [
            'aktif' => 'admin.santri.aktif',
            'alumni' => 'admin.santri.alumni',
            'calon' => 'admin.pendaftar.index',
        ][$category] ?? 'admin.pendaftar.index';
    }

    /** Mengubah kode status pendaftaran menjadi label yang ramah dibaca. */
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

    /** Mengubah kode status pembayaran menjadi label yang ramah dibaca. */
    private function paymentLabel(?string $status): string
    {
        return [
            'belum_upload' => 'Belum Upload',
            'menunggu_verifikasi' => 'Menunggu Verifikasi',
            'terverifikasi' => 'Terverifikasi',
            'ditolak' => 'Ditolak',
        ][$status] ?? ucfirst((string) $status);
    }
}
