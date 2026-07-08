<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /** Menambahkan relasi opsional dari pendaftar ke akun pengguna. */
    public function up(): void
    {
        Schema::table('pendaftars', function (Blueprint $table) {
            if (! Schema::hasColumn('pendaftars', 'user_id')) {
                $table->foreignId('user_id')
                    ->nullable()
                    ->after('id')
                    ->constrained('users')
                    ->nullOnDelete();
            }
        });
    }

    /** Melepaskan foreign key dan kolom user_id bila tersedia. */
    public function down(): void
    {
        Schema::table('pendaftars', function (Blueprint $table) {
            if (Schema::hasColumn('pendaftars', 'user_id')) {
                $table->dropConstrainedForeignId('user_id');
            }
        });
    }
};
