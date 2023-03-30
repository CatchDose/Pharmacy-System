<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::create([
            'name' => 'admin',
            'password' => Hash::make("123456"),
            'national_id' => '11111000011111',
            'email' => 'admin@test.com',
            'gender' => '1',
            'phone' => '01066362244',
            'date_of_birth' => fake()->date(),
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),

        ]);

        $admin->assignRole("admin");




    }
}
