@extends('layouts.blog2')

@section('content')
    <?php
    function nice_number($n)
    {
        // $n = 0 + str_replace(',', '', $n);
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
    
    ?>
    <div class="container-fluid blog">

        @if (session()->has('deleteSuccess'))
            <section class=" d-flex justify-content-center my-4 w-100">
                <div class="container">
                    <div class="alert alert-dismissible fade show alert-success" role="alert" data-mdb-color="warning"
                        id="customxD">
                        <strong>Success!</strong> {{ session()->get('deleteSuccess') }}
                        <button type="button" class="btn-close" data-mdb-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            </section>
        @endif

        <div class="e-card ">
            <div class="e-card-body">
                <a href="blogs/tagged/{{ $searchTag->title }}" class="tag-popover"
                    id="tag-{{ $searchTag->id }}"><span
                        class="modern-badge  modern-badge-{{ $searchTag->color }}">
                        #{{ $searchTag->title }}
                    </span>
                </a>
                <p class="mt-3 mb-3">Some quick example text to build on the card title and make up the
                    bulk of
                    the card's content.</p>
            </div>
        </div>
        <ul class="nav nav-tabs mb-3" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link {{ $tab == 'newest' ? 'active' : '' }}"
                    href="/blogs/tagged/{{ $searchTag->title }}?tab=newest" role="tab">Newest</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link {{ $tab == 'likes' ? 'active' : '' }}"
                    href="/blogs/tagged/{{ $searchTag->title }}?tab=likes" role="tab">Most Liked</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link {{ $tab == 'views' ? 'active' : '' }}"
                    href="/blogs/tagged/{{ $searchTag->title }}?tab=views" role="tab">Top Viewed</a>
            </li>
        </ul>


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


                        <a href="/blogs/tagged/{{ $searchTag->title }}" class="tag-popover"
                            id="tag{{ $blog->id }}-{{ $searchTag->id }}">
                            <span class="modern-badge  modern-badge-{{ $searchTag->color }}">
                                #{{ $searchTag->title }}
                            </span>
                        </a>
                        @foreach ($blog->tags as $tag)
                            @if ($tag->title != $searchTag->title)
                                <a href="/blogs/tagged/{{ $tag->title }}" class="tag-popover"
                                    id="tag{{ $blog->id }}-{{ $tag->id }}">
                                    <span class="modern-badge  modern-badge-{{ $tag->color }}">
                                        #{{ $tag->title }}
                                    </span>
                                </a>
                            @endif
                        @endforeach
                        {{-- <p class="card-text"><small class="text-muted">Last updated </small></p> --}}
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

                        <a class="btn btn-secondary disable mt-3 link" href="/blogs/{{ $blog->id }}">
                            {{ __('Read Article') }}
                        </a>
                    </div>
                </div>
            </div>
        @endforeach

        {!! $blogs->withQueryString()->onEachSide(3)->links('pagination::bootstrap-5') !!}
    </div>
@endsection
@section('content-right')
    <article>
        <div class="form-group mb-4 ">
            <div class="typeahead__container">
                <div class="typeahead__field">
                    <div class="typeahead__query">
                        <form method="GET" action="/search">
                            <input type="search" class="js-typeahead-search form-control " autocomplete="off"
                                placeholder="Search" name="query" id="js-typeahead-search" required>
                            <input type="submit" hidden />
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="e-vcard">
            <div class="e-vcard-title">
                {{-- <span class="modern-badge modern-badge-info">Help</span> --}}
                <h3>#help</h3>
            </div>

            <ul class="e-vcard-list">
                <li>one</li>
                <li>two</li>
            </ul>
        </div>
        <div class="e-vcard">
            <div class="e-vcard-title">
                {{-- <span class="modern-badge modern-badge-success">Discuss</span> --}}
                <h3>#Discuss</h3>
            </div>
            <div class="e-vcard-image">
                <img src="https://picsum.photos/1200/1000" alt="">
            </div>
            <div class="e-vcard-body">
                <a href="#">hello</a>
            </div>
        </div>
        <div class="e-vcard">
            <div class="e-vcard-title">
                <h3>Top Tags</h3>
            </div>
            <div class="e-vcard-body">
                ////////////////////////////////////////////reach

            </div>
        </div>
    </article>
@endsection
@push('scripts')
    @include('ajax')
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            //bookmark ajax
        });
    </script>
@endpush
