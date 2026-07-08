<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /** Menambahkan identitas, data wali, kemampuan, dan dokumen pendaftar. */
    public function up(): void
    {
        Schema::table('pendaftars', function (Blueprint $table) {
            $table->string('jenis_kelamin')->nullable()->after('nisn');
            $table->string('tempat_lahir')->nullable()->after('jenis_kelamin');
            $table->string('asal_sekolah')->nullable()->after('alamat');

            $table->string('pekerjaan_ayah')->nullable()->after('nama_ayah');
            $table->string('pekerjaan_ibu')->nullable()->after('nama_ibu');
            $table->string('wa_santri')->nullable()->after('wa_wali');

            $table->string('kemampuan_membaca_alquran')->nullable()->after('program');
            $table->string('jumlah_hafalan')->nullable()->after('kemampuan_membaca_alquran');
            $table->text('riwayat_penyakit')->nullable()->after('jumlah_hafalan');
            $table->text('motivasi_masuk_pondok')->nullable()->after('riwayat_penyakit');

            $table->string('kartu_keluarga')->nullable()->after('foto');
            $table->string('akta_lahir')->nullable()->after('kartu_keluarga');
        });
    }

    /** Menghapus kembali seluruh kolom detail tambahan. */
    public function down(): void
    {
        Schema::table('pendaftars', function (Blueprint $table) {
            $table->dropColumn([
                'jenis_kelamin',
                'tempat_lahir',
                'asal_sekolah',
                'pekerjaan_ayah',
                'pekerjaan_ibu',
                'wa_santri',
                'kemampuan_membaca_alquran',
                'jumlah_hafalan',
                'riwayat_penyakit',
                'motivasi_masuk_pondok',
                'kartu_keluarga',
                'akta_lahir',
            ]);
        });
    }
};
