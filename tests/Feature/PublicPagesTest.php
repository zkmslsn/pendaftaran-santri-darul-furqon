<?php

namespace Tests\Feature;

use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class PublicPagesTest extends TestCase
{
    #[DataProvider('publicPageProvider')]
    public function test_public_pages_are_accessible(string $uri): void
    {
        $this->get($uri)->assertOk();
    }

    /** @return array<string, array{string}> */
    public static function publicPageProvider(): array
    {
        return [
            'beranda' => ['/'],
            'informasi' => ['/informasi'],
            'syarat' => ['/syarat-ketentuan'],
            'pendaftaran' => ['/daftar'],
            'login' => ['/login'],
        ];
    }
}
