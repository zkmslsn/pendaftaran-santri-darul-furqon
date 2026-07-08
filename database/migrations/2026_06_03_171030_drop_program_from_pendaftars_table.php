<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /** Menghapus kolom program yang tidak lagi digunakan aplikasi. */
    public function up(): void
    {
        Schema::table('pendaftars', function (Blueprint $table) {
            if (Schema::hasColumn('pendaftars', 'program')) {
                $table->dropColumn('program');
            }
        });
    }

    /** Mengembalikan kolom program jika migrasi dibatalkan. */
    public function down(): void
    {
        Schema::table('pendaftars', function (Blueprint $table) {
            if (! Schema::hasColumn('pendaftars', 'program')) {
                $table->string('program')->nullable();
            }
        });
    }
};
