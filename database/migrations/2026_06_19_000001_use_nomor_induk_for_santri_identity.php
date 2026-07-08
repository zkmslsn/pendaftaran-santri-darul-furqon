<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /** Memindahkan identitas akun santri dari user_id ke nomor induk. */
    public function up(): void
    {
        if (! Schema::hasColumn('users', 'nomor_induk')) {
            Schema::table('users', function (Blueprint $table) {
                $table->string('nomor_induk')->nullable()->unique()->after('email');
            });
        }

        if (Schema::hasColumn('pendaftars', 'user_id')) {
            DB::statement("
                UPDATE users
                INNER JOIN pendaftars ON pendaftars.user_id = users.id
                SET users.nomor_induk = COALESCE(NULLIF(pendaftars.nisn, ''), NULLIF(pendaftars.password_awal, ''), users.nomor_induk)
                WHERE users.role = 'santri'
            ");
        }

        DB::statement("
            UPDATE users
            INNER JOIN pendaftars ON pendaftars.email = users.email
            SET users.nomor_induk = COALESCE(NULLIF(pendaftars.nisn, ''), NULLIF(pendaftars.password_awal, ''), users.nomor_induk)
            WHERE users.role = 'santri'
                AND users.nomor_induk IS NULL
        ");

        if (Schema::hasColumn('pendaftars', 'user_id')) {
            try {
                Schema::table('pendaftars', function (Blueprint $table) {
                    $table->dropForeign(['user_id']);
                });
            } catch (Throwable) {
                // Some installs created user_id without a foreign key.
            }

            Schema::table('pendaftars', function (Blueprint $table) {
                $table->dropColumn('user_id');
            });
        }
    }

    /** Mengembalikan relasi user_id dan menghapus nomor induk dari akun. */
    public function down(): void
    {
        if (! Schema::hasColumn('pendaftars', 'user_id')) {
            Schema::table('pendaftars', function (Blueprint $table) {
                $table->foreignId('user_id')
                    ->nullable()
                    ->after('id')
                    ->constrained('users')
                    ->nullOnDelete();
            });
        }

        if (Schema::hasColumn('users', 'nomor_induk') && Schema::hasColumn('pendaftars', 'user_id')) {
            DB::statement("
                UPDATE pendaftars
                INNER JOIN users ON (
                    users.nomor_induk = pendaftars.nisn
                    OR users.email = pendaftars.email
                )
                SET pendaftars.user_id = users.id
                WHERE users.role = 'santri'
            ");
        }

        if (Schema::hasColumn('users', 'nomor_induk')) {
            try {
                Schema::table('users', function (Blueprint $table) {
                    $table->dropUnique(['nomor_induk']);
                });
            } catch (Throwable) {
                // The column may exist without the unique index on older local databases.
            }

            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn('nomor_induk');
            });
        }
    }
};
