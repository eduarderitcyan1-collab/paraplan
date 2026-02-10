<?php

namespace Database\Factories;

use App\Models\Block;
use App\Models\Media;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class MediaFactory extends Factory
{
    protected $model = Media::class;

    public function definition(): array
    {
        return [
            'block_id' => Block::factory(),
            'type' => fake()->randomElement(['image', 'video']),
            'url' => fake()->imageUrl(),
            'alt_text' => fake()->sentence(4),
            'uploaded_by' => User::factory(),
            'updated_by' => null,
        ];
    }
}
