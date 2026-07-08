<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /** Menambahkan kredensial awal dan mengisi email kosong dari akun terkait. */
    public function up(): void
    {
        Schema::table('pendaftars', function (Blueprint $table) {
            if (! Schema::hasColumn('pendaftars', 'email')) {
                $table->string('email')->nullable()->unique()->after('nama');
            }

            if (! Schema::hasColumn('pendaftars', 'password_awal')) {
                $table->string('password_awal')->nullable()->after('email');
            }
        });

        // Supaya kolom nisn tidak wajib lagi, tapi tidak dihapus dulu agar aman
        if (Schema::hasColumn('pendaftars', 'nisn')) {
            DB::statement('ALTER TABLE pendaftars MODIFY nisn VARCHAR(255) NULL');
        }
    }

    /** Menghapus kolom kredensial awal dari data pendaftar. */
    public function down(): void
    {
        Schema::table('pendaftars', function (Blueprint $table) {
            if (Schema::hasColumn('pendaftars', 'email')) {
                $table->dropColumn('email');
            }

            if (Schema::hasColumn('pendaftars', 'password_awal')) {
                $table->dropColumn('password_awal');
            }
        });
    }
};
