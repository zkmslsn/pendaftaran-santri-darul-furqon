<?php

namespace App\Http\Controllers;

use App\Models\Pendaftar;
use Illuminate\Support\Facades\Auth;

class SantriStatusController extends Controller
{
    /** Menampilkan status pendaftaran yang terhubung dengan akun santri aktif. */
    public function status()
    {
        if (! Auth::check()) {
            return redirect()->route('login');
        }

        if (Auth::user()->role !== 'santri') {
            abort(403, 'Anda tidak memiliki akses ke halaman santri.');
        }

        $user = Auth::user();
        // Nomor induk adalah pengenal utama; email menjadi fallback untuk akun lama.
        $pendaftar = Pendaftar::query()
            ->where('nomor_induk_santri', $user->nomor_induk_santri)
            ->orWhere('email', $user->email)
            ->first();

        if (! $pendaftar) {
            abort(404, 'Data pendaftaran belum terhubung dengan nomor induk santri ini.');
        }

        return view('santri.status', compact('pendaftar'));
    }
}
