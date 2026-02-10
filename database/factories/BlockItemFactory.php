<?php

namespace Database\Factories;

use App\Models\Block;
use App\Models\BlockItem;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class BlockItemFactory extends Factory
{
    protected $model = BlockItem::class;

    public function definition(): array
    {
        return [
            'block_id' => Block::factory(),
            'title' => fake()->sentence(3),
            'subtitle' => fake()->sentence(2),
            'description' => fake()->paragraph(),
            'payload' => ['image' => fake()->imageUrl(), 'price' => fake()->numberBetween(1000, 20000)],
            'display_order' => fake()->numberBetween(0, 20),
            'created_by' => User::factory(),
            'updated_by' => null,
        ];
    }
}
