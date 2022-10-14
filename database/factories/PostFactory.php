<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

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
        return [
            'title'=>$this->faker->word(),
            'slug'=>$this->faker->unique()->sentence(2, true),
            'body'=> $this->faker->sentence(2, true),
            'img'=> null,
            'ended_at'=> null,
        ];
    }
}
