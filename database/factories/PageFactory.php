<?php

namespace Database\Factories;

use App\Models\Page;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PageFactory extends Factory
{
    protected $model = Page::class;

    public function definition(): array
    {
        $title = fake()->sentence(3);

        return [
            'title' => $title,
            'slug' => Str::slug($title).'-'.fake()->unique()->numberBetween(1, 9999),
            'status' => fake()->randomElement(['draft', 'published', 'archived']),
            'meta_title' => fake()->sentence(4),
            'meta_description' => fake()->paragraph(),
            'display_order' => fake()->numberBetween(0, 20),
            'created_by' => User::factory(),
            'updated_by' => null,
        ];
    }
}
