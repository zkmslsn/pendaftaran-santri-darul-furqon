<?php

// Memastikan proses login, kegagalan login, dan logout berjalan aman.

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    public function test_login_screen_can_be_rendered(): void
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
    }

    public function test_users_can_authenticate_using_the_login_screen(): void
    {
        $user = User::factory()->create([
            'role' => 'admin',
        ]);

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(route('admin.dashboard', absolute: false));
    }

    public function test_santri_can_authenticate_using_email_and_initial_password(): void
    {
        $user = User::factory()->create([
            'email' => 'santri@darulfurqon.test',
            'nomor_induk_santri' => '2026009',
            'password' => '2026009',
            'role' => 'santri',
        ]);

        $response = $this->post('/login', [
            'role' => 'santri',
            'email' => strtoupper($user->email).' ',
            'password' => '2026009',
        ]);

        $this->assertAuthenticatedAs($user);
        $response->assertRedirect(route('santri.status', absolute: false));
    }

    public function test_santri_can_authenticate_using_nomor_induk(): void
    {
        $user = User::factory()->create([
            'nomor_induk_santri' => '2026009',
            'password' => '2026009',
            'role' => 'santri',
        ]);

        $response = $this->post('/login', [
            'role' => 'santri',
            'email' => ' 2026009 ',
            'password' => '2026009',
        ]);

        $this->assertAuthenticatedAs($user);
        $response->assertRedirect(route('santri.status', absolute: false));
    }

    public function test_users_can_not_authenticate_when_selected_role_does_not_match(): void
    {
        $user = User::factory()->create([
            'role' => 'santri',
        ]);

        $response = $this->from('/login?role=admin')->post('/login', [
            'role' => 'admin',
            'email' => $user->email,
            'password' => 'password',
        ]);

        $this->assertGuest();
        $response
            ->assertRedirect('/login?role=admin')
            ->assertSessionHasErrors([
                'email' => 'Akun ini tidak sesuai dengan peran yang dipilih.',
            ]);
    }

    public function test_users_can_not_authenticate_with_invalid_password(): void
    {
        $user = User::factory()->create();

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'wrong-password',
        ]);

        $this->assertGuest();
        $response->assertSessionHasErrors([
            'email' => 'Email atau password tidak sesuai dengan data kami.',
        ]);
    }

    public function test_users_can_logout(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/logout');

        $this->assertGuest();
        $response->assertRedirect('/');
    }
}
