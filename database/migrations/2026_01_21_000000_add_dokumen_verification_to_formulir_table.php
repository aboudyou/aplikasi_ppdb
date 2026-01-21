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
        Schema::table('formulir_pendaftaran', function (Blueprint $table) {
            // Tambahkan kolom untuk status verifikasi dokumen jika belum ada
            if (!Schema::hasColumn('formulir_pendaftaran', 'status_berkas')) {
                $table->enum('status_berkas', ['Lengkap', 'Terverifikasi', 'Ditolak'])->default('Lengkap')->after('status_pendaftaran');
            }
            // Tambahkan kolom untuk catatan penolakan jika belum ada
            if (!Schema::hasColumn('formulir_pendaftaran', 'catatan_berkas')) {
                $table->text('catatan_berkas')->nullable()->after('status_berkas');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('formulir_pendaftaran', function (Blueprint $table) {
            $table->dropColumnIfExists(['status_berkas', 'catatan_berkas']);
        });
    }
};
