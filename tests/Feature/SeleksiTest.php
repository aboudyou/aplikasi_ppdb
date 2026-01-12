<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\FormulirPendaftaran;

class SeleksiTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_access_seleksi_page()
    {
        // Create admin user
        $admin = User::factory()->create([
            'role' => 'admin',
            'email' => 'admin@test.com',
            'password' => bcrypt('password'),
        ]);

        // Create some test data
        FormulirPendaftaran::factory()->create([
            'status_pendaftaran' => 'Diverifikasi',
        ]);

        // Act as admin and visit seleksi page
        $response = $this->actingAs($admin)->get('/admin/seleksi');

        // Assert response is successful
        $response->assertStatus(200);
        $response->assertViewIs('admin.seleksi.index');
        $response->assertViewHas('pendaftar');
    }

    public function test_non_admin_cannot_access_seleksi_page()
    {
        // Create regular user
        $user = User::factory()->create([
            'role' => 'user',
        ]);

        // Act as user and try to visit seleksi page
        $response = $this->actingAs($user)->get('/admin/seleksi');

        // Assert forbidden
        $response->assertStatus(403);
    }
}