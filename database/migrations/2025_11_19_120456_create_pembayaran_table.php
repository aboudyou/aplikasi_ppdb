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
        Schema::create('pembayaran', function (Blueprint $table) {
            $table->id();
            $table->foreignId('formulir_id')->constrained('formulir_pendaftaran')->onDelete('cascade');
            $table->foreignId('gelombang_id')->nullable()->constrained('gelombang_pendaftaran')->onDelete('cascade');
            $table->dateTime('tanggal_bayar')->nullable();
            $table->enum('metode_bayar', ['VA', 'E-Wallet', 'Transfer Bank'])->nullable();
            $table->enum('status', ['Menunggu', 'Lunas'])->default('Menunggu');
            $table->string('no_kuitansi')->unique()->nullable();
            $table->string('bukti_bayar')->nullable();
            $table->foreignId('admin_verifikasi_id')->nullable()->constrained('users')->onDelete('set null');
            $table->dateTime('verified_at')->nullable();
            $table->text('catatan')->nullable();
            $table->string('path_nota_pdf')->nullable();
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayaran');
    }
};
