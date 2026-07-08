<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /** Menyeragamkan nama kolom identitas menjadi nomor_induk_santri. */
    public function up(): void
    {
        if (Schema::hasColumn('pendaftars', 'nisn') && ! Schema::hasColumn('pendaftars', 'nomor_induk_santri')) {
            DB::statement('ALTER TABLE pendaftars CHANGE nisn nomor_induk_santri VARCHAR(255) NULL AFTER id');
        } elseif (Schema::hasColumn('pendaftars', 'nomor_induk_santri')) {
            DB::statement('ALTER TABLE pendaftars MODIFY nomor_induk_santri VARCHAR(255) NULL AFTER id');
        }

        if (Schema::hasColumn('users', 'nomor_induk') && ! Schema::hasColumn('users', 'nomor_induk_santri')) {
            DB::statement('ALTER TABLE users CHANGE nomor_induk nomor_induk_santri VARCHAR(255) NULL AFTER email');
        } elseif (Schema::hasColumn('users', 'nomor_induk_santri')) {
            DB::statement('ALTER TABLE users MODIFY nomor_induk_santri VARCHAR(255) NULL AFTER email');
        }
    }

    /** Mengembalikan nama kolom identitas ke nisn dan nomor_induk. */
    public function down(): void
    {
        if (Schema::hasColumn('pendaftars', 'nomor_induk_santri') && ! Schema::hasColumn('pendaftars', 'nisn')) {
            DB::statement('ALTER TABLE pendaftars CHANGE nomor_induk_santri nisn VARCHAR(255) NULL AFTER id');
        }

        if (Schema::hasColumn('users', 'nomor_induk_santri') && ! Schema::hasColumn('users', 'nomor_induk')) {
            DB::statement('ALTER TABLE users CHANGE nomor_induk_santri nomor_induk VARCHAR(255) NULL AFTER email');
        }
    }
};
