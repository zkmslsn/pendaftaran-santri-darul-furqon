<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $password = Hash::make('password');

        User::updateOrCreate(
            ['email' => 'admin@darulfurqon.test'],
            [
                'name' => 'Admin Darul Furqon',
                'password' => $password,
                'role' => 'admin',
            ]
        );

        User::updateOrCreate(
            ['email' => 'pengasuh@darulfurqon.test'],
            [
                'name' => 'Pengasuh Darul Furqon',
                'password' => $password,
                'role' => 'pengasuh',
            ]
        );

        $this->call(DemoSantriPutriSeeder::class);
    }
}
