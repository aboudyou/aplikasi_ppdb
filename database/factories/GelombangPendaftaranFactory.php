<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\GelombangPendaftaran;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\GelombangPendaftaran>
 */
class GelombangPendaftaranFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama_gelombang' => fake()->word(),
            'tanggal_mulai' => fake()->date(),
            'tanggal_selesai' => fake()->date(),
            'nilai' => fake()->numberBetween(100000, 500000),
            'kuota_maksimal' => fake()->numberBetween(50, 200),
            'jenis_promo' => fake()->randomElement(['diskon', 'potongan']),
            'nilai_promo' => fake()->numberBetween(0, 50),
            'tipe_nilai_promo' => fake()->randomElement(['persen', 'nominal']),
            'catatan' => fake()->sentence(),
            'keterangan' => fake()->paragraph(),
        ];
    }
}