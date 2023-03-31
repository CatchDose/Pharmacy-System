<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

// use Database\Seeders\CountriesSeeder;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call([
           RoleSeeder::class,
           AreaSeeder::class,
           UserSeeder::class,
           PharmacySeeder::class,
           MedicineSeeder::class,
           OrderSeeder::class,
           AddressSeeder::class,
           CountriesSeeder::class
        ]);
    }
}
