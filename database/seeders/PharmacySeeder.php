<?php

namespace Database\Seeders;

use App\Models\Pharmacy;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class PharmacySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pharmacyOwner = User::create([
            'name' => 'pharmacy',
            'password' => Hash::make("123456"),
            'national_id' => '22222000022223',

            'email' => 'pharmacy@test.com',
            'gender' => '1',
            'phone' => '01066362246',
            'date_of_birth' => fake()->date(),
            'email_verified_at' => now(),
            'remember_token' => Str::random(10)
        ]);

        $pharmacyOwner->assignRole("pharmacy");

        $pharmacy = Pharmacy::factory(1)->create()->first();
        $pharmacyOwner->update([
            "pharmacy_id" => $pharmacy->id
        ]);


        $doctor = User::create([
            'name' => 'doctor',
            'password' => Hash::make("123456"),
            'national_id' => '22222000022222',
            'pharmacy_id' => 1,
            'email' => 'doctor_1@test.com',
            'gender' => '1',
            'phone' => '01066362246',
            'date_of_birth' => fake()->date(),
            'email_verified_at' => now(),
            'remember_token' => Str::random(10)
        ]);

        $doctor->assignRole("doctor");



    }
}
