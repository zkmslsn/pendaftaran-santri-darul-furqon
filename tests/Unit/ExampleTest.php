<?php

namespace Tests\Unit;

use App\Models\User;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class ExampleTest extends TestCase
{
    #[DataProvider('roleProvider')]
    public function test_role_has_the_expected_dashboard(string $role, ?string $expectedRoute): void
    {
        $user = new User(['role' => $role]);

        $this->assertSame($expectedRoute, $user->dashboardRouteName());
    }

    /** @return array<string, array{string, string|null}> */
    public static function roleProvider(): array
    {
        return [
            'admin' => ['admin', 'admin.dashboard'],
            'pengasuh' => ['pengasuh', 'pengasuh.dashboard'],
            'santri' => ['santri', 'santri.status'],
            'unknown' => ['unknown', null],
        ];
    }
}
