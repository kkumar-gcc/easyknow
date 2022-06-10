<div>
    @if ($bookmarks->count() > 0)
        <div>
            @foreach ($bookmarks as $bookmark)
                <div class="e-scard e-scard-hover" id="blog-{{ $bookmark->blog->id }}">
                    <div class="card-body">
                        <div class="image">
                            <img src="https://picsum.photos/400/300" alt="">
                        </div>
                        <div class="detail">

                            <div class="statics">
                                <span> <small>
                                        {{ nice_number($bookmark->blog->bloglikes->where('status', 1)->count()) }}
                                        likes</small></span>
                                <span class="text-muted"> <small>
                                        {{ nice_number($bookmark->blog->bloglikes->where('status', 0)->count()) }}
                                        dislikes</small></span>
                                <span class="text-muted"><small>
                                        {{ nice_number($bookmark->blog->blogviews->count()) }}
                                        views</small></span>

                                {{-- {{ number_format($blog->likes, 2) }} --}}
                            </div>

                            @guest
                                <a class="e-rbtn">
                                    <span class="bookmark " title="Bookmark this Article">
                                        @svg('gmdi-bookmark-add-o')
                                    </span>
                                </a>
                            @else
                                @if (auth()->user()->id != $bookmark->blog->user_id)
                                    <div id="toast-info"></div>
                                    <form method="POST" id="bookmark-{{ $bookmark->blog->id }}" class="bookmark_form">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="user_id"
                                            id="user_bookmark_id_{{ $bookmark->blog->id }}"
                                            value="{{ auth()->user()->id }}">
                                        <input type="hidden" name="blog_id"
                                            id="blog_bookmark_id_{{ $bookmark->blog->id }}"
                                            value="{{ $bookmark->blog->id }}">
                                        <button type="submit" class="bookmark  e-rbtn ">
                                            <span title="Bookmark this Article"
                                                class="bookmark_btn_{{ $bookmark->blog->id }}"
                                                id="bookmark_btn_{{ $bookmark->blog->id }}">
                                                @if ($bookmark->blog->isBookmarked())
                                                    @svg('gmdi-bookmark-added-r', 'bookmark-active')
                                                @else
                                                    @svg('gmdi-bookmark-add-o')
                                                @endif
                                            </span>
                                        </button>
                                    </form>
                                @endif

                            @endguest
                            <a href="/blogs/{{ $bookmark->blog->id }}" class="link link-secondary">
                                <h5 class="title">{{ $bookmark->blog->title }}</h5>
                            </a>


                            <p class="card-text disable">
                                {!! Str::words(strip_tags($bookmark->blog->description), 20) !!}

                            </p>



                            @foreach ($bookmark->blog->tags as $tag)
                                <span
                                    class="modern-badge  modern-badge-{{ $tag->color }}">#{{ $tag->title }}</span>
                            @endforeach
                            {{-- <p class="card-text"><small class="text-muted">Last updated </small></p> --}}
                            <p class="mt-3"> by
                                <a class="btn-link link-secondary"
                                    href="/users/{{ $bookmark->blog->user_id }}/{{ $bookmark->blog->user->username }}/public">
                                    {{ __($bookmark->blog->user->username) }}
                                </a>
                                <small class="text-muted"> posted
                                    {{ \Carbon\Carbon::parse($bookmark->blog->created_at)->diffForHumans() }}
                                </small>
                            </p>

                            <a class="btn btn-secondary disable link" href="/blogs/{{ $bookmark->blog->id }}">
                                {{ __('Read Article') }}
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
            {!! $bookmarks->withQueryString()->links('pagination::bootstrap-5') !!}
        </div>
    @else
        <div class="e-scard e-scard-hover s-empty-state wmx4 p48">
            <div class="card-body">
                You haven't bookmarked any blog.
            </div>
        </div>
    @endif

</div>
