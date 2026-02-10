<?php

namespace Database\Factories;

use App\Models\Block;
use App\Models\Page;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class BlockFactory extends Factory
{
    protected $model = Block::class;

    public function definition(): array
    {
        return [
            'page_id' => Page::factory(),
            'type' => fake()->randomElement(Block::allowedTypes()),
            'content' => ['text' => fake()->sentence()],
            'display_order' => fake()->numberBetween(0, 20),
            'created_by' => User::factory(),
            'updated_by' => null,
        ];
    }
}
