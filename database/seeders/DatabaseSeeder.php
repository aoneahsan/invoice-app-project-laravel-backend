<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Database\Seeders\Default\RoleAndPermissionsSeeder;
use Database\Seeders\Default\UserSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\Default\User::factory(10)->create();

        // \App\Models\Default\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call([
            // Default Seeders
            RoleAndPermissionsSeeder::class,
            UserSeeder::class,
        ]);
    }
}
