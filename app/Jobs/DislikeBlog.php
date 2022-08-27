<?php

namespace App\Jobs;
use App\Models\Blog;
use App\Models\User;
use App\Traits\HasLike;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class DislikeBlog implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels,HasLike;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(private Blog $blog, private User $user)
    {
       //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->blog->dislikedBy($this->user);
    }
}
