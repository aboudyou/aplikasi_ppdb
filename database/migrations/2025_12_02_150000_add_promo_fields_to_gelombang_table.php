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
            // Tambahkan kolom untuk nilai promo jika belum ada
            if (!Schema::hasColumn('gelombang_pendaftaran', 'nilai_promo')) {
                $table->decimal('nilai_promo', 10, 2)->nullable()->default(0)->after('nilai');
            }
            
            // Kolom untuk tipe nilai promo (nominal atau persen)
            if (!Schema::hasColumn('gelombang_pendaftaran', 'tipe_nilai_promo')) {
                $table->enum('tipe_nilai_promo', ['nominal', 'persen'])->nullable()->default('nominal')->after('nilai_promo');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('gelombang_pendaftaran', function (Blueprint $table) {
            $table->dropColumnIfExists('nilai_promo');
            $table->dropColumnIfExists('tipe_nilai_promo');
        });
    }
};
