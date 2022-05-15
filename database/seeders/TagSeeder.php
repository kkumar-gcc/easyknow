<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = [
            'Sports' => 'primary', // blue
            'Relaxation' => 'secondary', // grey
            'Fun' => 'warning', // yellow
            'Nature' => 'success', // green
            'Inspiration' => 'light', // white grey
            'Friends' => 'info', // turquoise
            'Love' => 'danger', // red
            'Interest' => 'dark' // black-white
        ];

        foreach ($tags as $key => $value) {
            $tag = new Tag(
                [
                    'title' => $key,
                    'color' => $value,
                ]
            );
            $tag->save();
        }
    }
}
