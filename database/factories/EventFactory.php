<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Enums\EventStatuses;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory {
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array {
        return [
            'title' => fake()->unique()->words(rand(3, 10), asText: true),
            'slug' => fn (array $attributes) => Str::slug($attributes['title']),
            'description' => fake()->paragraph(),
            'featured_image_path' => fake()->filePath(),
            'begins_at' => fake()->dateTimeBetween('-1 week', '+1 week'),
            'ends_at' => fake()->dateTimeBetween('+2 week', '+4 week'),
            'status' => EventStatuses::random(),
            'creator_id' => User::factory(),
            'has_leaderboard' => fake()->boolean(),
        ];
    }
}
