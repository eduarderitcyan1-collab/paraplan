<?php

namespace Database\Factories;

use App\Models\GalleryItem;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class GalleryItemFactory extends Factory
{
    protected $model = GalleryItem::class;

    public function definition(): array
    {
        return [
            'type' => fake()->randomElement(['photo', 'video']),
            'url' => fake()->url(),
            'preview_url' => fake()->imageUrl(),
            'title' => fake()->sentence(3),
            'display_order' => fake()->numberBetween(0, 20),
            'created_by' => User::factory(),
            'updated_by' => null,
        ];
    }
}
