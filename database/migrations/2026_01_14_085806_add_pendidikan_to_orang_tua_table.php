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
        Schema::table('orang_tua', function (Blueprint $table) {
            $table->string('pendidikan_ayah')->nullable()->after('nik_ayah');
            $table->string('pendidikan_ibu')->nullable()->after('nik_ibu');
            $table->string('pendidikan_wali')->nullable()->after('nik_wali');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orang_tua', function (Blueprint $table) {
            $table->dropColumn(['pendidikan_ayah', 'pendidikan_ibu', 'pendidikan_wali']);
        });
    }
};
