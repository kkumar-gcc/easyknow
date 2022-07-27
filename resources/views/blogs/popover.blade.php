<?php
function nice_number($n)
{
    // $n = 0 + int(str_replace(',', '', $n));
    if (!is_numeric($n)) {
        return false;
    }
    if ($n > 1000000000000) {
        return round($n / 1000000000000, 1) . 't ';
    } elseif ($n > 1000000000) {
        return round($n / 1000000000, 1) . 'b ';
    } elseif ($n > 1000000) {
        return round($n / 1000000, 1) . 'm ';
    } elseif ($n > 1000) {
        return round($n / 1000, 1) . 'k ';
    }
    return number_format($n);
}
Str::macro('readDuration', function (...$text) {
    $totalWords = str_word_count(implode(' ', $text));
    $minutesToRead = round($totalWords / 200);

    return (int) max(1, $minutesToRead);
});

?>
<div class="e-vcard" id="blog-{{ $blog->id }}">
    <div class="e-vcard-image h-300">
        <img  src="https://picsum.photos/1200/1000" alt="">
    </div>
    <div class="e-vcard-body card-body">
        <div class="detail">
            <div class="statics">
                <span> <small> {{ nice_number($blog->bloglikes->where('status', 1)->count()) }}
                        likes</small></span>
                <span class="text-muted"> <small>
                        {{ nice_number($blog->bloglikes->where('status', 0)->count()) }}
                        dislikes</small></span>
                <span class="text-muted"><small> {{ nice_number($blog->blogviews->count()) }}
                        views</small></span>
            </div>
{{-- 
            @guest

                <span class="bookmark " title="Bookmark this Article">
                    <a class="e-rbtn"> @svg('gmdi-bookmark-add-o') </a>
                </span>
            @else
                @if (auth()->user()->id != $blog->user_id)
                    <div id="toast-info"></div>
                    <form method="POST" id="bookmark-{{ $blog->id }}" class="bookmark_form">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="user_id" id="user_bookmark_id_{{ $blog->id }}"
                            value="{{ auth()->user()->id }}">
                        <input type="hidden" name="blog_id" id="blog_bookmark_id_{{ $blog->id }}"
                            value="{{ $blog->id }}">
                        <button type="submit" class="bookmark  e-rbtn">
                            <span title="Bookmark this Article" class="bookmark_btn_{{ $blog->id }}"
                                id="bookmark_btn_{{ $blog->id }}">
                                @if ($blog->isBookmarked())
                                    @svg('gmdi-bookmark-added-r', 'bookmark-active')
                                @else
                                    @svg('gmdi-bookmark-add-o')
                                @endif
                            </span>
                        </button>
                    </form>
                @endif

            @endguest --}}

            <a href="/blogs/{{ Str::slug($blog->title, '-') }}-{{ $blog->id }}" class="link link-secondary">
                <h5 class="title">{{ $blog->title }}</h5>
            </a>


            <p class="card-text disable">
                {!! Str::words(strip_tags($blog->description), 20) !!}
            </p>



            @foreach ($blog->tags as $tag)
                <a href="/blogs/tagged/{{ $tag->title }}" >
                    <span class="modern-badge  modern-badge-{{ $tag->color }}">
                        #{{ $tag->title }}
                    </span>
                </a>
            @endforeach
            <p class="mt-3"> by
                <a href="/users/{{ $blog->user->username }}">
                    {{ __($blog->user->username) }}
                </a>
                <small class="text-muted"> posted
                    {{ \Carbon\Carbon::parse($blog->created_at)->diffForHumans() }}
                </small>
            </p>

            <a class="e-btn e-btn-dark e-btn-lg disable " href="/blogs/{{ Str::slug($blog->title, '-') }}-{{ $blog->id }}">
                {{ __('Read Article') }}
            </a>
        </div>
    </div>
</div>
