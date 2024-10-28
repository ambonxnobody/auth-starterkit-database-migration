<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserProfile>
 */
class UserProfileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'full_name' => $this->faker->name(),
            'nick_name' => $this->faker->name(),
            'metadata' => [
                'created_at' => now()->toDateTimeString(),
                'created_by' => null,
                'updated_at' => now()->toDateTimeString(),
                'updated_by' => null,
                'deleted_at' => null,
                'deleted_by' => null
            ]
        ];
    }
}
