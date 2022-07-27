<div>
    @if ($pins->count() > 0)
        <article class="mt-4">
            @foreach ($pins as $pin)
                <div class="e-scard e-scard-warning" id="blog-{{ $pin->blog->id }}">
                    <div class="card-body">
                        <div class="image">
                            <img src="https://picsum.photos/400/300" alt="">
                        </div>
                        <div class="detail">
                            <div id="toast-info"></div>
                            <form method="POST" id="blogPin-{{ $pin->blog->id }}" class="blogpin_form">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                                <input type="hidden" name="blog_id" value="{{ $pin->blog->id }}">
                                <button type="submit" class="bookmark  e-rbtn">
                                    <span title="Bookmark this Article" class="blog_pin_btn_{{ $pin->blog->id }}"
                                        id="blog_pin_btn_{{ $pin->blog->id }}">
                                        @if ($pin->blog->pinned)
                                            @svg('tabler-pinned-off', 'bookmark-active')
                                        @else
                                            @svg('tabler-pin')
                                        @endif
                                    </span>
                                </button>
                            </form>
                            <a href="/blogs/{{ Str::slug($pin->blog->title, '-') }}-{{ $pin->blog->id }}" class="link link-secondary">
                                <h5 class="title">{{ $pin->blog->title }}</h5>
                            </a>


                            <p class="card-text disable">
                                {!! Str::words(strip_tags($pin->blog->description), 20) !!}

                            </p>



                            @foreach ($pin->blog->tags as $tag)
                                <span class="modern-badge  modern-badge-{{ $tag->color }}">#{{ $tag->title }}</span>
                            @endforeach
                            {{-- <p class="card-text"><small class="text-muted">Last updated </small></p> --}}
                            <p class="mt-3">
                                <small class="text-muted"> posted
                                    {{ \Carbon\Carbon::parse($pin->blog->created_at)->diffForHumans() }}
                                </small>
                            </p>

                            <a class="e-btn e-btn-dark e-btn-lg disable" href="/blogs/{{ Str::slug($pin->blog->title, '-') }}-{{ $pin->blog->id }}">
                                {{ __('Read Article') }}
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </article>
    @else
        <div class="e-scard e-scard-hover s-empty-state wmx4 p48">
            <div class="card-body">
                You haven't pinned any blog.
            </div>
        </div>
    @endif

    @if ($pins->count() <= 5)
        @if ($blogs->count() > 0)


            <h4 class="card-title mt-5 mb-3">Pin Blog (remaining <?php echo 5 - $pins->count(); ?>)</h4>
            <div>
                @foreach ($blogs as $blog)
                    <div class="e-scard e-scard-hover" id="blog-{{ $blog->id }}">
                        <div class="card-body">
                            <div class="image">
                                <img src="https://picsum.photos/400/300" alt="">
                            </div>
                            <div class="detail">

                                <div id="toast-info"></div>
                                <form method="POST" id="blogPin-{{ $blog->id }}" class="blogpin_form">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                                    <input type="hidden" name="blog_id" value="{{ $blog->id }}">
                                    <button type="submit" class="bookmark  e-rbtn">
                                        <span title="Bookmark this Article" class="blog_pin_btn_{{ $blog->id }}"
                                            id="blog_pin_btn_{{ $blog->id }}">
                                            @if ($blog->pinned)
                                                @svg('tabler-pinned-off', 'bookmark-active')
                                            @else
                                                @svg('tabler-pin')
                                            @endif
                                        </span>
                                    </button>
                                </form>

                                <a href="/blogs/{{ Str::slug($blog->title, '-') }}-{{ $blog->id }}" class="link link-secondary">
                                    <h5 class="title">{{ $blog->title }}</h5>
                                </a>


                                <p class="card-text disable">
                                    {!! Str::words(strip_tags($blog->description), 20) !!}

                                </p>



                                @foreach ($blog->tags as $tag)
                                    <span
                                        class="modern-badge  modern-badge-{{ $tag->color }}">#{{ $tag->title }}</span>
                                @endforeach
                                {{-- <p class="card-text"><small class="text-muted">Last updated </small></p> --}}
                                <p class="mt-3">
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
                @endforeach
                {!! $blogs->withQueryString()->links('pagination::bootstrap-5') !!}
            </div>
        @endif
    @endif
</div>
