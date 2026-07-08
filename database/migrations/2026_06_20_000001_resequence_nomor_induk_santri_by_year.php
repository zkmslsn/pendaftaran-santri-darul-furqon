<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /** Menyusun ulang nomor induk per tahun dan menyelaraskan akun santri terkait. */
    public function up(): void
    {
        if (! Schema::hasColumn('pendaftars', 'nomor_induk_santri')) {
            return;
        }

        $pendaftars = DB::table('pendaftars')
            ->select('id', 'email', 'nomor_induk_santri', 'password_awal', 'tanggal_diterima', 'created_at')
            ->orderByRaw('COALESCE(tanggal_diterima, created_at)')
            ->orderBy('id')
            ->get();

        if ($pendaftars->isEmpty()) {
            return;
        }

        $userIdsByPendaftarId = [];

        foreach ($pendaftars as $pendaftar) {
            $user = DB::table('users')
                ->select('id')
                ->where('role', 'santri')
                ->where(function ($query) use ($pendaftar) {
                    if ($pendaftar->nomor_induk_santri) {
                        $query->orWhere('nomor_induk_santri', $pendaftar->nomor_induk_santri);
                    }

                    if ($pendaftar->email) {
                        $query->orWhere('email', $pendaftar->email);
                    }
                })
                ->first();

            if ($user) {
                $userIdsByPendaftarId[$pendaftar->id] = $user->id;
            }
        }

        DB::transaction(function () use ($pendaftars, $userIdsByPendaftarId) {
            foreach ($pendaftars as $pendaftar) {
                DB::table('pendaftars')
                    ->where('id', $pendaftar->id)
                    ->update([
                        'nomor_induk_santri' => '__tmp_pendaftar_'.$pendaftar->id,
                    ]);

                if (isset($userIdsByPendaftarId[$pendaftar->id])) {
                    DB::table('users')
                        ->where('id', $userIdsByPendaftarId[$pendaftar->id])
                        ->update([
                            'nomor_induk_santri' => '__tmp_user_'.$pendaftar->id,
                        ]);
                }
            }

            $sequences = [];

            foreach ($pendaftars as $pendaftar) {
                $tahunMasuk = Carbon::parse($pendaftar->tanggal_diterima ?: $pendaftar->created_at ?: now())->format('Y');
                $sequences[$tahunMasuk] = ($sequences[$tahunMasuk] ?? 0) + 1;
                $nomorInduk = $tahunMasuk.str_pad((string) $sequences[$tahunMasuk], 3, '0', STR_PAD_LEFT);

                $pendaftarPayload = [
                    'nomor_induk_santri' => $nomorInduk,
                ];

                if ($pendaftar->password_awal) {
                    $pendaftarPayload['password_awal'] = $nomorInduk;
                }

                DB::table('pendaftars')
                    ->where('id', $pendaftar->id)
                    ->update($pendaftarPayload);

                if (isset($userIdsByPendaftarId[$pendaftar->id])) {
                    $userPayload = [
                        'nomor_induk_santri' => $nomorInduk,
                    ];

                    if ($pendaftar->password_awal) {
                        $userPayload['password'] = Hash::make($nomorInduk);
                    }

                    DB::table('users')
                        ->where('id', $userIdsByPendaftarId[$pendaftar->id])
                        ->update($userPayload);
                }
            }
        });
    }

    /** Data lama tidak dapat direkonstruksi secara aman setelah penomoran ulang. */
    public function down(): void
    {
        // Nomor induk lama tidak bisa dipulihkan secara aman setelah diurutkan ulang.
    }
};
