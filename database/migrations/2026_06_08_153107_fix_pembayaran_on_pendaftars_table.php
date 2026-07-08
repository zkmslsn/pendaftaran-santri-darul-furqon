<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /** Memastikan seluruh kolom pembayaran tersedia pada skema lama maupun baru. */
    public function up(): void
    {
        Schema::table('pendaftars', function (Blueprint $table) {
            if (! Schema::hasColumn('pendaftars', 'bukti_pembayaran')) {
                $table->string('bukti_pembayaran')->nullable()->after('akta_lahir');
            }

            if (! Schema::hasColumn('pendaftars', 'status_pembayaran')) {
                $table->string('status_pembayaran')->default('belum_upload')->after('bukti_pembayaran');
            }

            if (! Schema::hasColumn('pendaftars', 'tanggal_upload_pembayaran')) {
                $table->timestamp('tanggal_upload_pembayaran')->nullable()->after('status_pembayaran');
            }

            if (! Schema::hasColumn('pendaftars', 'password_awal')) {
                $table->string('password_awal')->nullable()->after('email');
            }

            if (! Schema::hasColumn('pendaftars', 'user_id')) {
                $table->unsignedBigInteger('user_id')->nullable()->after('id');
            }
        });
    }

    /** Menghapus kembali kolom pembayaran yang dinormalisasi. */
    public function down(): void
    {
        Schema::table('pendaftars', function (Blueprint $table) {
            if (Schema::hasColumn('pendaftars', 'bukti_pembayaran')) {
                $table->dropColumn('bukti_pembayaran');
            }

            if (Schema::hasColumn('pendaftars', 'status_pembayaran')) {
                $table->dropColumn('status_pembayaran');
            }

            if (Schema::hasColumn('pendaftars', 'tanggal_upload_pembayaran')) {
                $table->dropColumn('tanggal_upload_pembayaran');
            }

            if (Schema::hasColumn('pendaftars', 'password_awal')) {
                $table->dropColumn('password_awal');
            }

            if (Schema::hasColumn('pendaftars', 'user_id')) {
                $table->dropColumn('user_id');
            }
        });
    }
};
