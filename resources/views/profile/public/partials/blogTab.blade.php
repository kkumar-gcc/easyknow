<div>
    <div class="container-fluid blog">
        @foreach ($blogs as $blog)
            <div class="card " id="blog-{{ $blog->id }}">
                <div class="card-body">
                    <div class="image">
                        <img src="https://picsum.photos/400/300" alt="">
                    </div>
                    <div class="detail">

                        <div class="statics">
                            <span> <small>{{ nice_number($blog->likes) }} likes</small></span>
                            <span class="text-muted"> <small>{{ nice_number($blog->dislikes) }}
                                    dislikes</small></span>
                            <span class="text-muted"><small> {{ nice_number($blog->likes) }} views</small></span>

                            {{-- {{ number_format($blog->likes, 2) }} --}}
                        </div>

                        <span class="bookmark " title="Bookmark this Article">
                            {{-- <i class="tim-icons  icon-book-bookmark"></i> --}}
                            {{ svg('bi-bookmark-fill') }}


                        </span>
                        <a href="/blogs/{{ $blog->id }}" class="link link-secondary">
                            <h5 class="title">{{ $blog->title }}</h5>
                        </a>


                        <p class="card-text disable">
                            {!! Str::words(strip_tags($blog->description), 20) !!}

                        </p>



                        @foreach ($blog->tags as $tag)
                            <span class="modern-badge  modern-badge-{{ $tag->color }}">{{ $tag->title }}</span>
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
