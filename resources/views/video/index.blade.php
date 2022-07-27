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
            return round($n / 1000000000000, 1) + 't ';
        } elseif ($n > 1000000000) {
            return round($n / 1000000000, 1) + 'b ';
        } elseif ($n > 1000000) {
            return round($n / 1000000, 1) + 'm ';
        } elseif ($n > 1000) {
            return round($n / 1000, 1) + 'k ';
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

        <nav class="tabs">
            <ul class="nav nav-tabs mb-3 -primary" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link {{ $tab == 'newest' ? 'active' : '' }}" href="/blogs?tab=newest"
                        role="tab">Newest</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link {{ $tab == 'likes' ? 'active' : '' }}" href="/blogs?tab=likes" role="tab">Most
                        Liked</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link {{ $tab == 'views' ? 'active' : '' }}" href="/blogs?tab=views" role="tab">Top
                        Viewed</a>
                </li>
            </ul>
        </nav>
        @foreach ($videos as $video)
            <div class="e-vcard" id="video-{{ $video->id }}">
                <div class="e-vcard-image">
                    <video width="320" height="240" controls>
                        <source src="https://player.vimeo.com/external/637457468.hd.mp4?s=d0cdda75064a46d6b61f3b39e8d0fedeba413dd3&profile_id=174&oauth2_token_id=1146955538" type="video/mp4">
                      </video>  
                      
                    {{-- <img src="https://picsum.photos/1200/1000" alt=""> --}}
                </div>
                <div class="e-vcard-body">
                    <p class="card-text">
                        {!! Str::words(strip_tags($video->description), 50) !!}
                    </p>
                    @foreach ($video->tags as $tag)
                        <a href="/blogs/tagged/{{ $tag->title }}" class="tag-popover"
                            id="tag{{ $video->id }}-{{ $tag->id }}">
                            <span class="modern-badge  modern-badge-{{ $tag->color }}">
                                #{{ $tag->title }}
                            </span>
                        </a>
                    @endforeach
                    <p class="mt-3"> by
                        <a class="btn-link link-secondary user-popover" href="/users/{{ $video->user->username }}"
                            id="user{{ $video->id }}-{{ $video->user_id }}">
                            {{ __($video->user->username) }}
                        </a>
                        <small class="text-muted"> posted
                            {{ \Carbon\Carbon::parse($video->created_at)->diffForHumans() }}
                        </small>
                    </p>
                </div>
            </div>
            {{-- @guest

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
        @endforeach

        {!! $videos->withQueryString()->onEachSide(3)->links('pagination::bootstrap-5') !!}
    </div>
@endsection
@section('content-right')
    <article>
        <div class="form-group mb-4 ">
            <button class="flex e-search-btn" type="button" data-bs-toggle="modal" data-bs-target="#searchModal">
                @svg('heroicon-o-search', 'flex-none')
                <span class="flex-1">search </span>
                <span class="flex-none"><kbd>&#x2318;</kbd> + <kbd>K</kbd></span>
            </button>

        </div>
        @if ($topUsers->count() > 3)
            <div class="e-vcard">
                <div class="e-vcard-title">
                    {{-- <span class="modern-badge modern-badge-info">#Help</span> --}}
                    <h3>Top Users</h3>
                </div>

                <ul class="e-vcard-list">
                    @foreach ($topUsers as $topUser)
                        <li>
                            <div class="search-user">
                                <div class="image">
                                    <a href="/users/{{ $topUser->username }}" class="user-popover"
                                        id="user-{{ $topUser->id }}">
                                        <img class="user-img"
                                            src="{{ asset($topUser->profile_image ?? 'images/1654760695anime3.png') }}"
                                            alt="">
                                    </a>
                                </div>
                                <div class="user-detail">
                                    <a href="/users/{{ $topUser->username }}" class="user-popover"
                                        id="userdetail-{{ $topUser->id }}">
                                        {{ $topUser->username }}
                                    </a>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="e-vcard">
            <div class="e-vcard-title">
                <span class="modern-badge modern-badge-danger">#Advertisment</span>
            </div>
            <div class="e-vcard-image">
                <img src="https://picsum.photos/1200/1000" alt="">
            </div>
            {{-- <div class="e-vcard-body">
                <a href="#">hello</a>
            </div> --}}
        </div>
        <div class="e-vcard">
            <div class="e-vcard-title">
                <h3>Top Tags</h3>
            </div>
            <div class="e-vcard-body">
                @foreach ($topTags as $topTag)
                    <div data-name="{{ $topTag->title }}">
                        <a href="/blogs/tagged/{{ $topTag->title }}" class="tag-popover"
                            id="sidebarTag-{{ $topTag->id }}">
                            <span class="modern-badge modern-badge-{{ $topTag->color }}">
                                #{{ $topTag->title }}
                            </span>
                        </a>
                        <span class="item-multiplier">
                            <span class="item-multiplier-x">×</span>&nbsp;
                            <span class="item-multiplier-count">{{ $topTag->blogs_count }}</span>
                        </span>
                    </div>
                @endforeach

            </div>
        </div>
    </article>
@endsection
@push('scripts')
    @include('ajax')
@endpush
