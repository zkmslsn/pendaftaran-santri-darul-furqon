<?php

// Memastikan halaman dan proses registrasi akun berjalan sesuai aturan.

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_registration_screen_redirects_to_admission_form(): void
    {
        $response = $this->get('/register');

        $response->assertRedirect(route('daftar.create', absolute: false));
    }

    public function test_legacy_registration_post_cannot_create_an_orphan_santri_account(): void
    {
        $response = $this->post('/register', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $this->assertGuest();
        $this->assertDatabaseMissing(User::class, [
            'email' => 'test@example.com',
        ]);
        $response->assertRedirect(route('daftar.create', absolute: false));
    }
}
