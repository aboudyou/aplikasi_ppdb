<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\FormulirPendaftaran;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\FormulirPendaftaran>
 */
class FormulirPendaftaranFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => \App\Models\User::factory(),
            'nomor_pendaftaran' => fake()->unique()->numerify('PPDB-#####'),
            'nama_lengkap' => fake()->name(),
            'jenis_kelamin' => fake()->randomElement(['Laki-laki', 'Perempuan']),
            'tinggi_badan' => fake()->numberBetween(150, 200),
            'berat_badan' => fake()->numberBetween(40, 100),
            'nisn' => fake()->unique()->numerify('##########'),
            'asal_sekolah' => fake()->company(),
            'tempat_lahir' => fake()->city(),
            'tanggal_lahir' => fake()->date(),
            'agama' => fake()->randomElement(['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Konghucu']),
            'nik' => fake()->unique()->numerify('################'),
            'anak_ke' => fake()->numberBetween(1, 10),
            'alamat' => fake()->address(),
            'kelurahan_desa' => fake()->city(),
            'kecamatan' => fake()->city(),
            'kota' => fake()->city(),
            'no_hp' => fake()->phoneNumber(),
            'jurusan_id' => \App\Models\Jurusan::factory(),
            'gelombang_id' => \App\Models\GelombangPendaftaran::factory(),
            'status_pendaftaran' => fake()->randomElement(['Draft', 'Lengkap', 'Diverifikasi', 'Lulus', 'Tidak Lulus']),
        ];
    }
}