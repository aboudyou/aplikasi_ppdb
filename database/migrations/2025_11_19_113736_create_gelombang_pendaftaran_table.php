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
        Schema::create('gelombang_pendaftaran', function (Blueprint $table) {
            $table->id();
            $table->string('nama_gelombang'); 
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->text('catatan')->nullable();
            $table->enum('jenis_promo', ['diskon', 'potongan'])->nullable();
            $table->decimal('nilai', 10, 2)->nullable();
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gelombang_pendaftaran');
    }
};
