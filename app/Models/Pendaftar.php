<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pendaftar extends Model
{
    /** Kolom yang boleh diisi melalui proses pendaftaran dan verifikasi admin. */
    protected $fillable = [
        'nama',
        'nomor_induk_santri',
        'email',
        'password_awal',
        'jenis_kelamin',
        'tempat_lahir',
        'tgl_lahir',
        'alamat',
        'asal_sekolah',
        'nama_ayah',
        'pekerjaan_ayah',
        'nama_ibu',
        'pekerjaan_ibu',
        'wa_wali',
        'wa_santri',
        'kemampuan_membaca_alquran',
        'jumlah_hafalan',
        'riwayat_penyakit',
        'motivasi_masuk_pondok',
        'foto',
        'kartu_keluarga',
        'akta_lahir',
        'bukti_pembayaran',
        'status_pembayaran',
        'tanggal_upload_pembayaran',
        'status',
        'tanggal_diterima',
        'tanggal_alumni',
        'catatan',
    ];

    /** Mengubah kolom tanggal menjadi objek waktu Laravel secara otomatis. */
    protected $casts = [
        'tgl_lahir' => 'date',
        'tanggal_upload_pembayaran' => 'datetime',
        'tanggal_diterima' => 'datetime',
        'tanggal_alumni' => 'datetime',
    ];

    /** Menghubungkan data pendaftar dengan akun santri melalui nomor induk. */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'nomor_induk_santri', 'nomor_induk_santri');
    }

    /**
     * Mengambil nomor induk dan tetap mendukung data lama yang menyimpannya
     * pada kolom password_awal.
     */
    public function getNomorIndukSantriAttribute(): string
    {
        return (string) (($this->attributes['nomor_induk_santri'] ?? null) ?: ($this->attributes['password_awal'] ?? null) ?: '');
    }
}
