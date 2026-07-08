<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /** Menyeragamkan nama kolom kontak menjadi wa_wali dan wa_santri. */
    public function up(): void
    {
        $this->renameOrCreateColumn('no_hp', 'wa_wali');
        $this->renameOrCreateColumn('no_wa', 'wa_santri');
    }

    /** Mengembalikan nama kolom WhatsApp ke bentuk lama. */
    public function down(): void
    {
        $this->renameOrCreateColumn('wa_wali', 'no_hp');
        $this->renameOrCreateColumn('wa_santri', 'no_wa');
    }

    /** Mengganti nama kolom atau membuat target bila hanya salah satunya tersedia. */
    private function renameOrCreateColumn(string $from, string $to): void
    {
        $hasFrom = Schema::hasColumn('pendaftars', $from);
        $hasTo = Schema::hasColumn('pendaftars', $to);

        if ($hasFrom && ! $hasTo) {
            Schema::table('pendaftars', function (Blueprint $table) use ($from, $to) {
                $table->renameColumn($from, $to);
            });

            return;
        }

        if ($hasFrom && $hasTo) {
            DB::table('pendaftars')
                ->whereNull($to)
                ->update([$to => DB::raw($from)]);

            Schema::table('pendaftars', function (Blueprint $table) use ($from) {
                $table->dropColumn($from);
            });

            return;
        }

        if (! $hasTo) {
            Schema::table('pendaftars', function (Blueprint $table) use ($to) {
                $table->string($to)->nullable();
            });
        }
    }
};
