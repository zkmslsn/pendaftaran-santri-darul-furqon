<?php

namespace App\Http\Controllers;

use App\Models\Pendaftar;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class PengasuhController extends Controller
{
    /** Status yang dihitung sebagai santri aktif pada ringkasan pengasuh. */
    private const ACTIVE_STATUSES = ['diterima', 'aktif'];

    /** Status yang masih termasuk tahap calon santri. */
    private const CANDIDATE_STATUSES = ['menunggu', 'perlu_perbaikan'];

    /** Menampilkan ringkasan dan daftar santri sesuai filter pengasuh. */
    public function dashboard(Request $request)
    {
        abort_unless(auth()->user()?->role === 'pengasuh', 403, 'Anda tidak memiliki akses ke halaman pengasuh.');

        $filters = [
            'search' => $request->string('search')->toString(),
            'kategori' => in_array($request->query('kategori', 'semua'), ['semua', 'calon', 'aktif', 'alumni'], true)
                ? $request->query('kategori', 'semua')
                : 'semua',
            'tahun' => is_numeric($request->query('tahun')) ? (int) $request->query('tahun') : null,
        ];

        // Statistik tidak mengikuti filter agar kartu ringkasan selalu menunjukkan total global.
        $stats = [
            'total' => Pendaftar::count(),
            'calon' => Pendaftar::whereIn('status', self::CANDIDATE_STATUSES)->count(),
            'aktif' => Pendaftar::whereIn('status', self::ACTIVE_STATUSES)->count(),
            'alumni' => Pendaftar::where('status', 'alumni')->count(),
            'ditolak' => Pendaftar::where('status', 'ditolak')->count(),
            'pembayaran_belum' => Pendaftar::where('status_pembayaran', '!=', 'terverifikasi')->count(),
            'pembayaran_menunggu' => Pendaftar::where('status_pembayaran', 'menunggu_verifikasi')->count(),
            'pembayaran_terverifikasi' => Pendaftar::where('status_pembayaran', 'terverifikasi')->count(),
        ];

        $years = $this->categoryQuery($filters['kategori'])
            ->selectRaw('YEAR(created_at) as year')
            ->whereNotNull('created_at')
            ->distinct()
            ->orderByDesc('year')
            ->pluck('year')
            ->filter()
            ->values();

        $pendaftars = $this->categoryQuery($filters['kategori'])
            ->when($filters['search'], function (Builder $query) use ($filters) {
                $query->where(function (Builder $q) use ($filters) {
                    $search = $filters['search'];

                    $q->where('nama', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%")
                        ->orWhere('wa_wali', 'like', "%{$search}%")
                        ->orWhere('wa_santri', 'like', "%{$search}%")
                        ->orWhere('nama_ayah', 'like', "%{$search}%")
                        ->orWhere('nama_ibu', 'like', "%{$search}%")
                        ->orWhere('status', 'like', "%{$search}%")
                        ->orWhere('status_pembayaran', 'like', "%{$search}%");
                });
            })
            ->when($filters['tahun'], fn (Builder $query) => $query->whereYear('created_at', $filters['tahun']))
            ->latest()
            ->get();

        return view('pengasuh.dashboard', compact('pendaftars', 'filters', 'stats', 'years'));
    }

    /** Membentuk query dasar untuk kategori calon, aktif, alumni, atau semua data. */
    private function categoryQuery(string $category): Builder
    {
        $query = Pendaftar::query();

        if ($category === 'calon') {
            return $query->whereIn('status', self::CANDIDATE_STATUSES);
        }

        if ($category === 'aktif') {
            return $query->whereIn('status', self::ACTIVE_STATUSES);
        }

        if ($category === 'alumni') {
            return $query->where('status', 'alumni');
        }

        return $query;
    }
}
