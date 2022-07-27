<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Video>
 */
class VideoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'link'=>"https://www.youtube.com/watch?v=5GL9JoH4Sws&list=RDMM&index=8",
            'description'=>$this->faker->realText(),
            'type'=>$this->faker->randomElement(['public', 'private','follower']),
        ];
    }
}
