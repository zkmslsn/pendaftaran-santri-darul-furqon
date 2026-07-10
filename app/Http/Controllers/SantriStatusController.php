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
        // Query dibuat terpisah agar nilai kosong tidak menghubungkan akun ke data lain.
        $pendaftar = filled($user->nomor_induk_santri)
            ? Pendaftar::where('nomor_induk_santri', $user->nomor_induk_santri)->first()
            : null;

        if (! $pendaftar && filled($user->email)) {
            $pendaftar = Pendaftar::where('email', $user->email)->first();
        }

        if (! $pendaftar) {
            return response()->view('santri.unlinked', compact('user'));
        }

        return view('santri.status', compact('pendaftar'));
    }
}
