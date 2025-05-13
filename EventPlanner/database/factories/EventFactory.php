<?php

namespace Database\Factories;

use App\Models\Event;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $user = User::factory()->create();
        return [
            'user_id' => $user->id,
            'name' => $this->faker->sentence(),
            'description' => $this->faker->paragraph(),
        ];

        Event::factory()->create([
            'user_id' => $user->id,
            'name' => $this->faker->sentence(),
            'description' => $this->faker->paragraph(),
        ]);
        return [
            'user_id' => $user->id,
            'name' => $this->faker->sentence(),
            'description' => $this->faker->paragraph(),
        ];
    }
}
