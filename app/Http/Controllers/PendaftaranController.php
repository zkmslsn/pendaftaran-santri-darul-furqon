<?php

namespace App\Http\Controllers;

use App\Models\Pendaftar;
use Illuminate\Http\Request;

class PendaftaranController extends Controller
{
    /** Menampilkan formulir pendaftaran santri baru. */
    public function create()
    {
        return view('daftar');
    }

    /** Memvalidasi, menyimpan berkas, dan mencatat pendaftaran baru. */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:pendaftars,email',
            'jenis_kelamin' => 'required|in:Perempuan',
            'tempat_lahir' => 'required|string|max:255',
            'tgl_lahir' => 'required|date',
            'alamat' => 'required|string',
            'wa_santri' => 'required|digits_between:10,13',
            'asal_sekolah' => 'required|string|max:255',

            'nama_ayah' => 'required|string|max:255',
            'pekerjaan_ayah' => 'required|string|max:255',
            'nama_ibu' => 'required|string|max:255',
            'pekerjaan_ibu' => 'required|string|max:255',
            'wa_wali' => 'required|digits_between:10,13',

            'kemampuan_membaca_alquran' => 'required|string|max:255',
            'jumlah_hafalan' => 'required|string|max:255',
            'riwayat_penyakit' => 'required|string',
            'motivasi_masuk_pondok' => 'required|string',

            'foto' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'kartu_keluarga' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'akta_lahir' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'bukti_pembayaran' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        $uploadFolders = [
            'foto' => 'foto_pendaftar',
            'kartu_keluarga' => 'dokumen_pendaftar',
            'akta_lahir' => 'dokumen_pendaftar',
            'bukti_pembayaran' => 'bukti_pembayaran',
        ];

        foreach ($uploadFolders as $field => $folder) {
            $validated[$field] = $request->file($field)->store($folder, 'public');
        }

        $validated['tanggal_upload_pembayaran'] = now();

        // Pendaftaran baru selalu masuk ke antrean verifikasi admin.
        $validated['status'] = 'menunggu';
        $validated['status_pembayaran'] = 'menunggu_verifikasi';
        $validated['catatan'] = null;

        Pendaftar::create($validated);

        return redirect()->back()->with('success', 'Pendaftaran berhasil dikirim. Data dan bukti pembayaran menunggu verifikasi admin.');
    }
}
