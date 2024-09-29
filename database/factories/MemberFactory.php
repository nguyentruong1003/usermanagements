<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class MemberFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'sex' => rand(1,2),
            'phone' => fake()->phoneNumber(),
            'birthday' => fake()->date('Y-m-d', 'now'),
            'address' => fake()->address(),
            'level' => rand(1,10),
            'hobby' => fake()->realText(200, 2),
            'note' => fake()->realText(200, 2),
        ];
    }
}
