<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('gelombang_pendaftaran', function (Blueprint $table) {
            // Tambahkan kolom kuota maksimal peserta
            if (!Schema::hasColumn('gelombang_pendaftaran', 'kuota_maksimal')) {
                $table->integer('kuota_maksimal')->nullable()->default(0)->after('nilai');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('gelombang_pendaftaran', function (Blueprint $table) {
            $table->dropColumnIfExists('kuota_maksimal');
        });
    }
};
