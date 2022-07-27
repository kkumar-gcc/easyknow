<div>
    @if ($pins->count() > 0)
        <article class="mt-4">
            @foreach ($pins as $pin)
                <div class="e-scard  e-scard-warning" id="blog-{{ $pin->blog->id }}">
                    <div class="card-body">
                        <div class="image">
                            <img src="https://picsum.photos/400/300" alt="">
                        </div>
                        <div class="detail">

                            @guest
                                <a class="e-rbtn">
                                    <span class="bookmark " title="Bookmark this Article">
                                        @svg('gmdi-bookmark-add-o')
                                    </span>
                                </a>
                            @else
                                @if (auth()->user()->id != $pin->blog->user_id)
                                    <div id="toast-info"></div>
                                    <form method="POST" id="bookmark-{{ $pin->blog->id }}" class="bookmark_form">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="user_id" id="user_bookmark_id_{{ $pin->blog->id }}"
                                            value="{{ auth()->user()->id }}">
                                        <input type="hidden" name="blog_id" id="blog_bookmark_id_{{ $pin->blog->id }}"
                                            value="{{ $blog->id }}">
                                        <button type="submit" class="bookmark  e-rbtn">
                                            <span title="Bookmark this Article" class="bookmark_btn_{{ $pin->blog->id }}"
                                                id="bookmark_btn_{{ $pin->blog->id }}">
                                                @if ($blog->isBookmarked())
                                                    @svg('gmdi-bookmark-added-r', 'bookmark-active')
                                                @else
                                                    @svg('gmdi-bookmark-add-o')
                                                @endif
                                            </span>
                                        </button>
                                    </form>
                                @endif

                            @endguest
                            <a href="/blogs/{{ Str::slug($pin->blog->title, '-') }}-{{ $pin->blog->id }}" class="link link-secondary">
                                <h5 class="title">{{ $pin->blog->title }}</h5>
                            </a>


                            <p class="card-text disable">
                                {!! Str::words(strip_tags($pin->blog->description), 20) !!}

                            </p>



                            @foreach ($pin->blog->tags as $tag)
                                <span
                                    class="modern-badge  modern-badge-{{ $tag->color }}">#{{ $tag->title }}</span>
                            @endforeach
                            {{-- <p class="card-text"><small class="text-muted">Last updated </small></p> --}}
                            <p class="mt-3">
                                <small class="text-muted"> posted
                                    {{ \Carbon\Carbon::parse($pin->blog->created_at)->diffForHumans() }}
                                </small>
                            </p>

                            <a class="e-btn e-btn-lg e-btn-dark disable " href="/blogs/{{ Str::slug($pin->blog->title, '-') }}-{{ $pin->blog->id }}">
                                {{ __('Read Article') }}
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </article>

    @endif


    <div>
        @foreach ($blogs as $blog)
            <div class="e-scard e-scard-hover" id="blog-{{ $blog->id }}">
                <div class="card-body">
                    <div class="image">
                        <img src="https://picsum.photos/400/300" alt="">
                    </div>
                    <div class="detail">
                        @guest
                            <a class="e-rbtn">
                                <span class="bookmark " title="Bookmark this Article">
                                    @svg('gmdi-bookmark-add-o')
                                </span>
                            </a>
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
                        @endguest
                        <a href="/blogs/{{ Str::slug($blog->title, '-') }}-{{ $blog->id }}" class="link link-secondary">
                            <h5 class="title">{{ $blog->title }}</h5>
                        </a>
                        <p class="card-text disable">
                            {!! Str::words(strip_tags($blog->description), 20) !!}

                        </p>



                        @foreach ($blog->tags as $tag)
                            <span class="modern-badge  modern-badge-{{ $tag->color }}">#{{ $tag->title }}</span>
                        @endforeach
                        {{-- <p class="card-text"><small class="text-muted">Last updated </small></p> --}}
                        <p class="mt-3">
                            <small class="text-muted">by
                                <a class="btn-link link-secondary user-popover"
                                    href="/users/{{ $blog->user_id }}/{{ $blog->user->username }}/public"
                                    id="user{{ $blog->id }}-{{ $blog->user_id }}">
                                    {{ __($blog->user->username) }}
                                </a> posted
                                {{ \Carbon\Carbon::parse($blog->created_at)->diffForHumans() }}
                            </small>
                        </p>

                        <a class="e-btn e-btn-lg e-btn-dark disable" href="/blogs/{{ Str::slug($blog->title, '-') }}-{{ $blog->id }}">
                            {{ __('Read Article') }}
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
        {!! $blogs->withQueryString()->links('pagination::bootstrap-5') !!}
    </div>

</div>
@if ($pins->count() < 1 && $blogs->count() < 1)
    <div class="e-scard e-scard-hover s-empty-state wmx4 p48">
        <div class="card-body">
            {{ $user->username }} has not published any blog.
        </div>
    </div>
@endif
