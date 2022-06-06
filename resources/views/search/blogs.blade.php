@if (count($blogs) > 0)
    @foreach ($blogs as $blog)
        <div class="e-scard-hover e-scard" id="blog-{{ $blog->id }}">
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
                        <span class="text-muted"><small> {{ nice_number($blog->likes) }} views</small></span>
                    </div>

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

                    @endguest

                    <a href="/blogs/{{ $blog->id }}" class="link link-secondary">
                        <h5 class="title">{{ $blog->title }}</h5>
                    </a>


                    <p class="card-text disable">
                        {!! Str::words(strip_tags($blog->description), 50) !!}
                    </p>



                    @foreach ($blog->tags as $tag)
                        <a href="/blogs/tagged/{{ $tag->title }}" class="tag-popover"
                            id="tag{{ $blog->id }}-{{ $tag->id }}">
                            <span class="modern-badge  modern-badge-{{ $tag->color }}">
                                {{ $tag->title }}
                            </span>
                        </a>
                    @endforeach
                    <p class="mt-3"> by
                        <a class="btn-link link-secondary user-popover"
                            href="/users/{{ $blog->user_id }}/{{ $blog->user->username }}/public"
                            id="user{{ $blog->id }}-{{ $blog->user_id }}">
                            {{ __($blog->user->username) }}
                        </a>
                        <small class="text-muted"> posted
                            {{ \Carbon\Carbon::parse($blog->created_at)->diffForHumans() }}
                        </small>
                    </p>

                    <a class="e-btn e-btn-dark e-btn-lg disable " href="/blogs/{{ $blog->id }}">
                        {{ __('Read Article') }}
                    </a>
                </div>
            </div>
        </div>
    @endforeach

    {!! $blogs->withQueryString()->onEachSide(3)->links('pagination::bootstrap-5') !!}
@else
    <div >
        <ul>
            <li>Make sure all words are spelled correctly.</li>
            <li>Try different keywords.</li>
            <li>Try more general keywords.</li>
        </ul>
    </div>
@endif
