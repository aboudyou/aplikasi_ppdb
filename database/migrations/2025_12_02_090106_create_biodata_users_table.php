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
       Schema::create('biodata_users', function (Blueprint $table) {
    $table->id();
    $table->unsignedBigInteger('user_id')->unique();
    $table->string('nama_lengkap')->nullable();
    $table->enum('jenis_kelamin',['Laki-laki','Perempuan'])->nullable();
    $table->string('no_hp',20)->nullable();
    $table->string('email')->nullable();
    $table->string('tempat_lahir',50)->nullable();
    $table->date('tanggal_lahir')->nullable();
    $table->string('alamat')->nullable();
    $table->string('kecamatan',50)->nullable();
    $table->string('kota',50)->nullable();
    $table->timestamps();

    $table->foreign('user_id')
          ->references('id')->on('users')
          ->onDelete('cascade');
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('biodata_users');
    }
};
