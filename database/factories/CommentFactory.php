<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'description'=>$this->faker->realText(200),
            'likes'=>$this->faker->randomNumber(),
            'dislikes'=>$this->faker->randomNumber(),
            'user_id'=>$this->faker->randomNumber(1,100),
        ];
    }
}
