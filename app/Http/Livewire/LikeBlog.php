<?php

namespace App\Http\Livewire;

use App\Jobs\DislikeBlog as DislikeBlogJob;
use App\Jobs\LikeBlog as LikeBlogJob;
use App\Models\Blog;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class LikeBlog extends Component
{
    public $blog;

    public $isSidebar = true;

    protected $listeners = ['likeToggled'];

    public function mount(Blog $blog): void
    {
        $this->blog = $blog;
    }

    public function toggleLike(): void
    {
        // dd("hello");
        if (Auth::guest()) {
            return;
        }
        if ($this->blog->isLikedBy(Auth::user())) {
            dispatch(new DislikeBlogJob($this->blog, Auth::user()));
            // DislikeBlogJob::dispatchSync($this->blog, Auth::user());
        } else {
            dispatch(new LikeBlogJob($this->blog, Auth::user()));
            // LikeBlogJob::dispatchSync($this->blog, Auth::user());
        }
        $this->emit('likeToggled');
    }

    public function likeToggled()
    {
        return $this->blog;
    }
    public function render()
    {
        return view('livewire.like-blog');
    }
}
