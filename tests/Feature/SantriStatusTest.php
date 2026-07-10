<?php

namespace Tests\Feature;

use App\Models\Pendaftar;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SantriStatusTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_is_redirected_to_login(): void
    {
        $this->get('/santri/status')
            ->assertRedirect(route('login', absolute: false));
    }

    public function test_santri_with_matching_registration_can_open_status_page(): void
    {
        $user = User::factory()->create([
            'name' => 'Santri Terhubung',
            'email' => 'santri.terhubung@example.com',
            'nomor_induk_santri' => '2026991',
            'role' => 'santri',
        ]);

        $this->createPendaftar([
            'nama' => $user->name,
            'email' => $user->email,
            'nomor_induk_santri' => $user->nomor_induk_santri,
        ]);

        $this->actingAs($user)
            ->get('/santri/status')
            ->assertOk()
            ->assertViewIs('santri.status')
            ->assertSee($user->name);
    }

    public function test_orphan_santri_account_sees_recovery_page_instead_of_404(): void
    {
        $user = User::factory()->create([
            'name' => 'Santri Belum Terhubung',
            'email' => 'santri.belum.terhubung@example.com',
            'nomor_induk_santri' => '2026992',
            'password' => '2026992',
            'role' => 'santri',
        ]);

        $loginResponse = $this->post('/login', [
            'role' => 'santri',
            'email' => $user->email,
            'password' => '2026992',
        ]);

        $loginResponse->assertRedirect(route('santri.status', absolute: false));

        $this->get('/santri/status')
            ->assertOk()
            ->assertViewIs('santri.unlinked')
            ->assertSee('Data Pendaftaran Belum Terhubung')
            ->assertSee(route('daftar.create', absolute: false), escape: false);
    }

    public function test_email_fallback_connects_legacy_santri_account(): void
    {
        $user = User::factory()->create([
            'name' => 'Santri Lama',
            'email' => 'santri.lama@example.com',
            'nomor_induk_santri' => null,
            'role' => 'santri',
        ]);

        $this->createPendaftar([
            'nama' => $user->name,
            'email' => $user->email,
            'nomor_induk_santri' => '2026993',
        ]);

        $this->actingAs($user)
            ->get('/santri/status')
            ->assertOk()
            ->assertViewIs('santri.status');
    }

    public function test_non_santri_account_cannot_open_status_page(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $this->actingAs($admin)
            ->get('/santri/status')
            ->assertForbidden();
    }

    /** @param array<string, mixed> $overrides */
    private function createPendaftar(array $overrides = []): Pendaftar
    {
        return Pendaftar::create(array_merge([
            'nama' => 'Santri Uji',
            'nomor_induk_santri' => '2026999',
            'email' => 'santri.uji@example.com',
            'tgl_lahir' => '2010-01-01',
            'alamat' => 'Alamat pengujian',
            'nama_ayah' => 'Ayah Uji',
            'nama_ibu' => 'Ibu Uji',
            'wa_wali' => '081234567890',
            'status' => 'aktif',
            'status_pembayaran' => 'terverifikasi',
        ], $overrides));
    }
}
