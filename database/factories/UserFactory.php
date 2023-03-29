<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Testing\Fluent\Concerns\Has;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        return [
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
        ];

//        return [
//            'name' => fake()->name(),
//            'password' => Hash::make("123456"),
//            'avatar_image' => "image.jpg",
//            'national_id' => fake()->unique()->randomDigit(),
//            'email' => fake()->unique()->safeEmail(),
//            'email_verified_at' => now(),
//            'remember_token' => Str::random(10),
//        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
