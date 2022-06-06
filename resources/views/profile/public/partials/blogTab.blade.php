<div>
    <div class="container-fluid blog">
        @foreach ($blogs as $blog)
            <div class="e-scard e-scard-hover" id="blog-{{ $blog->id }}">
                <div class="card-body">
                    <div class="image">
                        <img src="https://picsum.photos/400/300" alt="">
                    </div>
                    <div class="detail">

                        <div class="statics">
                            <span> <small> {{ nice_number($blog->bloglikes->where('status', 1)->count()) }}
                                    likes</small></span>
                            <span class="text-muted"> <small>
                                    {{ nice_number($blog->bloglikes->where('status', 0)->count()) }}
                                    dislikes</small></span>
                            <span class="text-muted"><small> {{ nice_number($blog->blogviews->count()) }} views</small></span>

                            {{-- {{ number_format($blog->likes, 2) }} --}}
                        </div>

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
                        <a href="/blogs/{{ $blog->id }}" class="link link-secondary">
                            <h5 class="title">{{ $blog->title }}</h5>
                        </a>


                        <p class="card-text disable">
                            {!! Str::words(strip_tags($blog->description), 20) !!}

                        </p>



                        @foreach ($blog->tags as $tag)
                            <span class="modern-badge  modern-badge-{{ $tag->color }}">#{{ $tag->title }}</span>
                        @endforeach
                        {{-- <p class="card-text"><small class="text-muted">Last updated </small></p> --}}
                        <p class="mt-3"> by
                            <a class="btn-link link-secondary"
                                href="/users/{{ $blog->user_id }}/{{ $blog->user->username }}/public">
                                {{ __($blog->user->username) }}
                            </a>
                            <small class="text-muted"> posted
                                {{ \Carbon\Carbon::parse($blog->created_at)->diffForHumans() }}
                            </small>
                        </p>

                        <a class="btn btn-secondary disable link" href="/blogs/{{ $blog->id }}">
                            {{ __('Read Article') }}
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
        {!! $blogs->withQueryString()->links('pagination::bootstrap-5') !!}
    </div>
</div>
