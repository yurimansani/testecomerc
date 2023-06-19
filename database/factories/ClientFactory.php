<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Client>
 */
class ClientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'birthDate' => fake()->date(),
            'address' => fake()->streetAddress(),
            'complement' => fake()->secondaryAddress(),
            'neighborhood' => fake()->citySuffix(),
            'zipcode' => fake()->postcode(),
        ];
    }
}
