<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\User;
use App\Models\Category;
use App\Models\Status;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
    */

    public function definition()
    {
        $status = Status::all();

        return [
            'user_id' => User::factory(),
            'category_id' => Category::factory(),
            'status_id' => rand(1, count($status) - 1),
            'title' => $this->faker->unique()->sentence(),
            'thumbnail' => 'thumbnails\3LqSTVXtqgBv9gymHiznL9AW32GPyNA8iv29rnBk.png',
            'excerpt' => $this->faker->sentence(),
            'body' => $this->faker->paragraph(),
            'slug' => $this->faker->unique()->slug(),
            'published_at' => now(),
        ];
    }
} 
