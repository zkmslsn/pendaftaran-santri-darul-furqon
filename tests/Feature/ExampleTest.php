<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    #[DataProvider('roleProvider')]
    public function test_dashboard_redirects_users_by_role(string $role, string $expectedRoute): void
    {
        $user = User::factory()->create(['role' => $role]);

        $response = $this->actingAs($user)->get('/dashboard');

        $response->assertRedirect(route($expectedRoute, absolute: false));
    }

    /** @return array<string, array{string, string}> */
    public static function roleProvider(): array
    {
        return [
            'admin' => ['admin', 'admin.dashboard'],
            'pengasuh' => ['pengasuh', 'pengasuh.dashboard'],
            'santri' => ['santri', 'santri.status'],
        ];
    }
}
