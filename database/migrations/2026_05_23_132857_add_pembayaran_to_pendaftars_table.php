<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /** Menambahkan bukti, status, dan waktu unggah pembayaran. */
    public function up(): void
    {
        Schema::table('pendaftars', function (Blueprint $table) {
            $table->string('bukti_pembayaran')->nullable()->after('akta_lahir');
            $table->string('status_pembayaran')->default('belum_upload')->after('bukti_pembayaran');
            $table->timestamp('tanggal_upload_pembayaran')->nullable()->after('status_pembayaran');
        });
    }

    /** Menghapus seluruh kolom verifikasi pembayaran. */
    public function down(): void
    {
        Schema::table('pendaftars', function (Blueprint $table) {
            $table->dropColumn([
                'bukti_pembayaran',
                'status_pembayaran',
                'tanggal_upload_pembayaran',
            ]);
        });
    }
};
