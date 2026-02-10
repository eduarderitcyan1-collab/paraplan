<?php

namespace Database\Factories;

use App\Models\Block;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class BlockFactory extends Factory
{
    protected $model = Block::class;

    public function definition(): array
    {
        $name = fake()->words(2, true);

        return [
            'name' => Str::title($name),
            'code' => Str::slug($name, '_').'_'.fake()->unique()->numberBetween(10, 999),
            'schema' => ['fields' => ['title', 'description', 'payload']],
            'display_order' => fake()->numberBetween(0, 20),
            'is_active' => true,
            'created_by' => User::factory(),
            'updated_by' => null,
        ];
    }
}
