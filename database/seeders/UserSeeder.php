<?php

namespace Database\Seeders;

use App\Models\Blog;
use App\Models\Comment;
use App\Models\Episode;
use App\Models\Fun;
use App\Models\Podcast;
use App\Models\Reply;
use App\Models\User;
use App\Models\Video;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->count(100)->create()
            ->each(function ($user) {

                Podcast::factory()->count(rand(1, 2))->create(
                    [
                        "user_id" => $user->id,
                    ]
                )
                    ->each(function ($podcast) {
                        Episode::factory()->count(rand(1,4))->create(
                            [
                                "podcast_id" => $podcast->id
                            ]
                        );
                    });

                Video::factory()->count(rand(1, 2))->create(
                    [
                        "user_id" => $user->id,
                    ]
                )
                    ->each(function ($video) {
                        $tag_ids = range(1, 8);
                        shuffle($tag_ids);
                        $assignments = array_slice($tag_ids, 0, rand(1, 5));
                        foreach ($assignments as $tag_id) {
                            DB::table('tag_video')
                                ->insert([
                                    "video_id" => $video->id,
                                    "tag_id" => $tag_id,
                                    'created_at' => now(),
                                    'updated_at' => now(),
                                ]);
                        }
                    });
                Fun::factory()->count(rand(1, 4))->create(
                    [
                        "user_id" => $user->id,
                    ]
                )
                    ->each(function ($fun) {
                        $tag_ids = range(1, 8);
                        shuffle($tag_ids);
                        $assignments = array_slice($tag_ids, 0, rand(1, 5));
                        foreach ($assignments as $tag_id) {
                            DB::table('fun_tag')
                                ->insert([
                                    "fun_id" => $fun->id,
                                    "tag_id" => $tag_id,
                                    'created_at' => now(),
                                    'updated_at' => now(),
                                ]);
                        }
                    });
                Blog::factory()->count(rand(1, 4))->create(
                    [
                        "user_id" => $user->id,
                    ]
                )
                    ->each(function ($blog) {
                        $tag_ids = range(1, 8);
                        shuffle($tag_ids);
                        $assignments = array_slice($tag_ids, 0, rand(1, 5));
                        foreach ($assignments as $tag_id) {
                            DB::table('blog_tag')
                                ->insert([
                                    "blog_id" => $blog->id,
                                    "tag_id" => $tag_id,
                                    'created_at' => now(),
                                    'updated_at' => now(),
                                ]);
                        }
                        Comment::factory()->count(rand(1, 30))->create(
                            [
                                "blog_id" => $blog->id
                            ]
                        )
                            ->each(function ($comment) {
                                Reply::factory()->count(rand(0, 3))->create(
                                    [
                                        "comment_id" => $comment->id
                                    ]
                                );
                            });
                    });
            });
    }
}
