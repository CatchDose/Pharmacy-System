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
            'avatar_image' => "image.jpg",
            'national_id' => '11111000011111',
            'email' => 'admin@test.com',
            'gender' => '1',
            'phone' => '01066362244',
            'date_of_birth' => fake()->date(),
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),

        ]);

        $admin->assignRole("admin");

        $doctor = User::create([
            'name' => 'doctor',
            'password' => Hash::make("123456"),
            'avatar_image' => "image.jpg",
            'national_id' => '22222000022222',
            'email' => 'doctor_1@test.com',
            'gender' => '1',
            'phone' => '01066362246',
            'date_of_birth' => fake()->date(),
            'email_verified_at' => now(),
            'remember_token' => Str::random(10)
        ]);

        $doctor->assignRole("doctor");

        $pharmacy = User::create([
            'name' => 'pharmacy',
            'password' => Hash::make("123456"),
            'avatar_image' => "image.jpg",
            'national_id' => '22222000022223',
            'email' => 'pharmacy@test.com',
            'gender' => '1',
            'phone' => '01066362246',
            'date_of_birth' => fake()->date(),
            'email_verified_at' => now(),
            'remember_token' => Str::random(10)
        ]);

        $pharmacy->assignRole("pharmacy");

    }
}
