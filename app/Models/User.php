<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Kolom akun yang boleh diisi secara massal.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'nomor_induk_santri',
        'password',
        'role',
    ];

    /**
     * Kolom sensitif yang disembunyikan saat model diserialisasi.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Mengatur konversi tipe tanggal dan hashing password otomatis.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /** Menentukan dashboard tujuan berdasarkan peran akun. */
    public function dashboardRouteName(): ?string
    {
        return match ($this->role) {
            'admin' => 'admin.dashboard',
            'pengasuh' => 'pengasuh.dashboard',
            'santri' => 'santri.status',
            default => null,
        };
    }
}
