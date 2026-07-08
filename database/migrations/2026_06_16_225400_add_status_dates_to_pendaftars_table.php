<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /** Menambahkan tanggal diterima/alumni dan mengisi nilainya dari data historis. */
    public function up(): void
    {
        Schema::table('pendaftars', function (Blueprint $table) {
            if (! Schema::hasColumn('pendaftars', 'tanggal_diterima')) {
                $table->timestamp('tanggal_diterima')->nullable()->after('status');
            }

            if (! Schema::hasColumn('pendaftars', 'tanggal_alumni')) {
                $table->timestamp('tanggal_alumni')->nullable()->after('tanggal_diterima');
            }
        });

        DB::table('pendaftars')
            ->whereIn('status', ['diterima', 'aktif', 'alumni'])
            ->whereNull('tanggal_diterima')
            ->update([
                'tanggal_diterima' => DB::raw('COALESCE(updated_at, created_at)'),
            ]);

        DB::table('pendaftars')
            ->where('status', 'alumni')
            ->whereNull('tanggal_alumni')
            ->update([
                'tanggal_alumni' => DB::raw('COALESCE(updated_at, created_at)'),
            ]);
    }

    /** Menghapus kolom tanggal perubahan status. */
    public function down(): void
    {
        Schema::table('pendaftars', function (Blueprint $table) {
            if (Schema::hasColumn('pendaftars', 'tanggal_alumni')) {
                $table->dropColumn('tanggal_alumni');
            }

            if (Schema::hasColumn('pendaftars', 'tanggal_diterima')) {
                $table->dropColumn('tanggal_diterima');
            }
        });
    }
};
