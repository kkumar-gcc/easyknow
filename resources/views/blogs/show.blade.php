@extends('layouts.blog')
@push('styles')
    <x-head.tinymce-config />
@endpush
@section('content')
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
    @can('isOwner', $blog)
        <div class="modal fade" id="deleteModal-{{ $blog->id }}" tabindex="-1"
            aria-labelledby="deleteModal-{{ $blog->id }}-Label" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Delete Confirmation</h5>
                        <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="card-body">
                        Do you really want to delete blog " <strong class="font-weight-bold">{{ $blog->title }}
                        </strong>" ?

                    </div>
                    <div class="modal-footer">
                        <form method="POST" action="/blog/{{ $blog->id }}/delete">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="user_id" value="{{ $blog->user_id }}">
                            <div class="form-group">
                                <button type="button" class="e-btn" data-mdb-dismiss="modal">No</button>
                                <input type="submit" class="e-btn e-btn-warning" value="Yes">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @include('blogs.update', ['blog' => $blog])
    @endcan
    @if (session()->has('success'))
        <section class=" d-flex justify-content-center my-4 w-100">
            <div class="container">
                <div class="alert alert-dismissible fade show alert-success" role="alert" data-mdb-color="warning"
                    id="customxD">
                    <strong>Success!</strong> {{ session()->get('success') }}
                    <button type="button" class="btn-close" data-mdb-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        </section>
    @endif
    <main class="global-main">

        <article class="blog-section">
            <nav aria-label="breadcrumb ">
                <ol class="breadcrumb  mb-4">
                    <li class="breadcrumb-item"><a href="/blogs" class="link text-muted link-secondary">Blogs</a></li>
                    <li class="breadcrumb-item active" aria-current="page">
                        {!! Str::words($blog->title, 4) !!}
                    </li>
                </ol>
            </nav>

            <div class="blog-header item is-hero">
                <div class="item-container">
                    <div class="item-image global-image">
                        <img src="https://picsum.photos/400/300" alt="">
                    </div>
                    <div class="item-content">
                        <div class="item-tags global-tags">
                            @foreach ($blog->tags as $tag)
                                <a href="/blogs/tagged/{{ $tag->title }}" class="link tag-popover"
                                    id="tag{{ $blog->id }}-{{ $tag->id }}">
                                    <span class="modern-badge  modern-badge-{{ $tag->color }}">
                                        #{{ $tag->title }}
                                    </span>
                                </a>
                            @endforeach
                        </div>
                        <h1 class="item-title">{{ $blog->title }}</h1>
                        <div class="item-meta global-meta">
                            <div class="item-profile-image">
                                <a href="/users/{{ $blog->user_id }}/{{ $blog->user->username }}/public"
                                    class="global-image">
                                    <img src="https://picsum.photos/400/300" alt="">
                                </a>
                            </div>
                            <div class="item-author">
                                <a href="/users/{{ $blog->user_id }}/{{ $blog->user->username }}/public">
                                    {{ __($blog->user->username) }}
                                </a>
                                <div class="item-time">
                                    <time datetime="{{ $blog->created_at }}">
                                        {{ \Carbon\Carbon::parse($blog->created_at)->format('M d, Y') }}
                                    </time>
                                    ∙ {{ Str::readDuration($blog->description) }} minutes read
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="blog-content">
                {!! $blog->description !!}

                <div class="blog-actions">
                    <div class="blog-actions-inner">
                        @guest
                            <div class="action-left">
                                <div class="action-inner">
                                    <button class="e-rbtn" data-mdb-toggle="tooltip" title="likes">
                                        <span>
                                            @svg('heroicon-s-thumb-up')
                                        </span>
                                        {{ nice_number($blog->bloglikes->where('status', 1)->count()) }}
                                    </button>
                                </div>
                                <div class="action-inner">
                                    <button class="e-rbtn" data-mdb-toggle="tooltip" title="dislikes">
                                        <span>
                                            @svg('heroicon-s-thumb-down')
                                        </span>
                                    </button>
                                </div>

                            </div>

                            <div class="action-right">
                                <div class="action-inner action-inner-mobile-disable">
                                    <a class="e-rbtn">
                                        <span class="bookmark " title="Bookmark this Article">
                                            @svg('gmdi-bookmark-add-o')
                                        </span>
                                    </a>
                                </div>
                                <div class="action-inner dropdown">
                                    <button type="button" class="e-rbtn" data-mdb-toggle="dropdown"
                                        data-mdb-display="static" aria-expanded="false">
                                        @svg('entypo-dots-three-horizontal')
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li><button class="dropdown-item" type="button">Action</button></li>
                                        <li class="action-inner-mobile-enable">
                                            <div id="toast-info"></div>
                                            <a class="dropdown-item e-rbtn">
                                                <span class="bookmark " title="Bookmark this Article">
                                                    @svg('gmdi-bookmark-add-o')
                                                    Bookmark
                                                </span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        @else
                            <div class="action-left">
                                <div class="action-inner">
                                    <form method="post" id="blog_like_form" class="d-inline">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="blog_id" id="blog_like_id" value="{{ $blog->id }}">
                                        <input type="hidden" name="user_id" id="user_like_id"
                                            value="{{ auth()->user()->id }}">
                                        <button type="submit" id="blog-like-{{ $blog->id }}"
                                            class="e-rbtn @isset($like) {{ $like->status == 1 ? 'e-rbtn-liked' : '' }} @endisset"
                                            data-mdb-toggle="tooltip" title="likes">
                                            <span>@svg('heroicon-s-thumb-up')</span>
                                            {{ nice_number($blog->bloglikes->where('status', 1)->count()) }}
                                        </button>
                                    </form>

                                </div>
                                <div class="action-inner">
                                    <form method="post" id="blog_dislike_form" class="d-inline">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="blog_id" id="blog_dislike_id" value="{{ $blog->id }}">
                                        <input type="hidden" name="user_id" id="user_dislike_id"
                                            value="{{ auth()->user()->id }}">
                                        <button type="submit" id="blog-dislike-{{ $blog->id }}"
                                            class="e-rbtn @isset($like) {{ $like->status == 0 ? 'e-rbtn-disliked' : '' }} @endisset "
                                            data-mdb-toggle="tooltip" title="dislikes">
                                            <span>@svg('heroicon-s-thumb-down')</span>

                                        </button>
                                    </form>
                                </div>

                            </div>

                            <div class="action-right">
                                <div id="toast-info"></div>
                                <div class="action-inner action-inner-mobile-disable">

                                    @if (auth()->user()->id != $blog->user_id)
                                        <form method="POST" id="bookmark-{{ $blog->id }}" class="bookmark_form">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="user_id" id="user_bookmark_id_{{ $blog->id }}"
                                                value="{{ auth()->user()->id }}">
                                            <input type="hidden" name="blog_id" id="blog_bookmark_id_{{ $blog->id }}"
                                                value="{{ $blog->id }}">
                                            <button type="submit" class="e-rbtn">
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
                                </div>
                                <div class="action-inner dropdown">
                                    <button type="button" class="e-rbtn" data-mdb-toggle="dropdown"
                                        data-mdb-display="static" aria-expanded="false">
                                        @svg('entypo-dots-three-horizontal')
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li><button class="dropdown-item" type="button">Action</button></li>
                                        <li class="action-inner-mobile-enable">
                                            @if (auth()->user()->id != $blog->user_id)
                                                <form method="POST" id="bookmark-{{ $blog->id }}" class="bookmark_form">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="user_id"
                                                        id="user_bookmark_id_{{ $blog->id }}"
                                                        value="{{ auth()->user()->id }}">
                                                    <input type="hidden" name="blog_id"
                                                        id="blog_bookmark_id_{{ $blog->id }}" value="{{ $blog->id }}">
                                                    <button type="submit" class="dropdown-item e-rbtn">
                                                        <span title="Bookmark this Article"
                                                            class="bookmark_btn_{{ $blog->id }}"
                                                            id="bookmark_btn_{{ $blog->id }}">
                                                            @if ($blog->isBookmarked())
                                                                @svg('gmdi-bookmark-added-r', 'bookmark-active')
                                                                Bookmarked
                                                            @else
                                                                @svg('gmdi-bookmark-add-o')
                                                                Bookmark
                                                            @endif
                                                        </span>
                                                    </button>
                                                </form>
                                            @endif
                                        </li>
                                        @can('isOwner', $blog)
                                            <li>
                                                <hr class="dropdown-divider" />
                                            </li>
                                            <li>
                                                <button type="button" data-mdb-toggle="modal" role="button"
                                                    class="dropdown-item e-rbtn"
                                                    data-mdb-target="#blogEditModal-{{ $blog->id }}">
                                                    <span>{{ svg('feathericon-edit') }}</span> Edit
                                                </button>
                                            </li>
                                            <li>
                                                <a type="button" data-mdb-toggle="modal" role="button" class="dropdown-item e-rbtn"
                                                    href="#deleteModal-{{ $blog->id }}">
                                                    <span>{{ svg('gmdi-delete') }}</span> delete
                                                </a>
                                            </li>
                                        @endcan
                                    </ul>
                                </div>
                            </div>
                        @endguest
                    </div>
                </div>

                <div class="blog-share-section">
                    <h2 class="global-label global-label-h global-zigzag">
                        Share This Article :
                        <svg role="img" viewBox="0 0 136 24" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M1.525 1.525a3.5 3.5 0 014.95 0L20 15.05 33.525 1.525a3.5 3.5 0 014.95 0L52 15.05 65.525 1.525a3.5 3.5 0 014.95 0L84 15.05 97.525 1.525a3.5 3.5 0 014.95 0L116 15.05l13.525-13.525a3.5 3.5 0 014.95 4.95l-16 16a3.5 3.5 0 01-4.95 0L100 8.95 86.475 22.475a3.5 3.5 0 01-4.95 0L68 8.95 54.475 22.475a3.5 3.5 0 01-4.95 0L36 8.95 22.475 22.475a3.5 3.5 0 01-4.95 0l-16-16a3.5 3.5 0 010-4.95z">
                            </path>
                        </svg>
                    </h2>
                    <div class="blog-share-wrap">
                        <a class="blog-share-link link-icon-facebook"
                            href="https://www.facebook.com/sharer/sharer.php?u=http://jorenvanhocht.be"
                            id="">{{ svg('bi-facebook') }}
                        </a>
                        <a class="blog-share-link link-icon-twitter"
                            href="https://twitter.com/intent/tweet?text=my share text&amp;url=http://jorenvanhocht.be"
                            id="">{{ svg('bi-twitter') }}
                        </a>
                        <a class="blog-share-link link-icon-linkedin"
                            href="http://www.linkedin.com/shareArticle?mini=true&amp;url=http://jorenvanhocht.be&amp;title=my share text&amp;summary=dit is de linkedin summary"
                            id="">{{ svg('bi-linkedin') }}
                        </a>
                        <a class="blog-share-link link-icon-reddit" href="https://wa.me/?text=http://jorenvanhocht.be"
                            id="">{{ svg('bi-reddit') }}
                        </a>
                        <a class="blog-share-link link-icon-whatsapp" href="https://wa.me/?text=http://jorenvanhocht.be"
                            id="">{{ svg('bi-whatsapp') }}
                        </a>
                        <a class="blog-share-link link-icon-telegram" href="https://wa.me/?text=http://jorenvanhocht.be"
                            id="">{{ svg('bi-telegram') }}
                        </a>
                    </div>
                </div>
                <div class="blog-auther">
                    <div class="e-card e-card-center e-card-primary">
                        <div class="e-card-image">
                            <a href="/users/{{ $blog->user_id }}/{{ $blog->user->username }}/public"
                                class="global-image">
                                <img class="user-image" src="https://picsum.photos/400/300" alt="">
                            </a>
                        </div>
                        <div class="e-card-body">
                            <div class="e-card-body-top">
                                <div class="top-left">
                                    <a href="/users/{{ $blog->user_id }}/{{ $blog->user->username }}/public"
                                        class="username">
                                        {{ __($blog->user->username) }}
                                    </a>
                                    <div class="e-card-line">
                                        <span id="numberOfFollowers-{{ $blog->user_id }}">
                                            {{ $blog->user->friendships->count() }} followers
                                        </span>
                                    </div>
                                </div>
                                <div class="top-right">
                                    @guest
                                        <a class="e-btn e-btn-primary" href="#">
                                            {{ __('Follow') }}
                                        </a>
                                    @else
                                        <div id="toast-unfollow">

                                        </div>

                                        @if (auth()->user()->id == $blog->user_id)
                                            <a class="e-btn e-btn-warning"
                                                href="/users/{{ $blog->user_id }}/{{ $blog->user->username }}/public">
                                                {{ __('View Profile') }}
                                            </a>
                                        @else
                                            @if ($blog->user->isFollower())
                                                <div id="user_follow_option-{{ $blog->user_id }}" style="display: none;">
                                                    <form method="post" id="follower_create-{{ $blog->user_id }}"
                                                        class="follower-create">
                                                        @csrf
                                                        @method('put')
                                                        <input type="hidden" name="follower_id" id="follower_id"
                                                            value="{{ auth()->user()->id }}">
                                                        <input type="hidden" name="user_id" id="user_id"
                                                            value="{{ $blog->user_id }}">
                                                        <button type="submit" class="e-btn e-btn-primary">Follow</button>
                                                    </form>
                                                </div>
                                                <div id="user_unfollow_option-{{ $blog->user_id }}">

                                                    <button type="button" class="e-btn" data-mdb-ripple-color="dark"
                                                        data-mdb-toggle="modal"
                                                        data-mdb-target="#unfollowModal-{{ $blog->user_id }}">Unfollow</button>
                                                </div>
                                            @else
                                                <div id="user_follow_option-{{ $blog->user_id }}">
                                                    <form method="post" id="follower_create-{{ $blog->user_id }}"
                                                        class="follower-create">
                                                        @csrf
                                                        @method('put')
                                                        <input type="hidden" name="follower_id" id="follower_id"
                                                            value="{{ auth()->user()->id }}">
                                                        <input type="hidden" name="user_id" id="user_id"
                                                            value="{{ $blog->user_id }}">
                                                        <button type="submit" class="e-btn e-btn-primary">Follow</button>
                                                    </form>
                                                </div>
                                                <div id="user_unfollow_option-{{ $blog->user_id }}" style="display: none;">

                                                    <button type="button" class="e-btn" data-mdb-ripple-color="dark"
                                                        data-mdb-toggle="modal"
                                                        data-mdb-target="#unfollowModal-{{ $blog->user_id }}">Unfollow</button>
                                                </div>
                                            @endif
                                            <div class="modal fade" id="unfollowModal-{{ $blog->user_id }}"
                                                tabindex="-1" aria-labelledby="unfollowModal-{{ $blog->user_id }}-Label"
                                                aria-hidden="true">
                                                <div
                                                    class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-sm">
                                                    <div class="modal-content">

                                                        <div class="card-body text-center">
                                                            unfollow to " <strong
                                                                class="font-weight-bold">{{ $blog->user->username }}
                                                            </strong>" ?
                                                            <hr>

                                                            <form method="POST" id="follower_delete-{{ $blog->user_id }}"
                                                                class="follower-delete">
                                                                @csrf
                                                                @method('DELETE')
                                                                <input type="hidden" name="follower_id" id="follower_d_id"
                                                                    value="{{ auth()->user()->id }}">
                                                                <input type="hidden" name="user_id" id="user_d_id"
                                                                    value="{{ $blog->user_id }}">
                                                                <div class="form-group">
                                                                    <button type="button" class="e-btn"
                                                                        data-mdb-dismiss="modal">No</button>
                                                                    <input type="submit" class="e-btn e-btn-warning"
                                                                        value="Unfollow">
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endguest
                                </div>
                            </div>
                            <div class="auther-description">
                                If you`ve been programming for long enough, you have heard about the concept of a graph.
                                It`s required content for a degree in computer science, and many top-level companies test
                                for an understanding of graph theory during technical interviews
                            </div>
                        </div>
                    </div>
                </div>


            </div>
            @if($related->count() > 0)
                <div>
                    <h2 class="global-label global-label-h global-zigzag">
                        Related
                        <svg role="img" viewBox="0 0 136 24" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M1.525 1.525a3.5 3.5 0 014.95 0L20 15.05 33.525 1.525a3.5 3.5 0 014.95 0L52 15.05 65.525 1.525a3.5 3.5 0 014.95 0L84 15.05 97.525 1.525a3.5 3.5 0 014.95 0L116 15.05l13.525-13.525a3.5 3.5 0 014.95 4.95l-16 16a3.5 3.5 0 01-4.95 0L100 8.95 86.475 22.475a3.5 3.5 0 01-4.95 0L68 8.95 54.475 22.475a3.5 3.5 0 01-4.95 0L36 8.95 22.475 22.475a3.5 3.5 0 01-4.95 0l-16-16a3.5 3.5 0 010-4.95z">
                            </path>
                        </svg>
                    </h2>
                    @foreach ($related as $sblog)
                        <div class="e-scard e-scard-hover  e-scard-secondary " id="blog-{{ $sblog->id }}">
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
                                        @if (auth()->user()->id != $sblog->user_id)
                                            <div id="toast-info"></div>
                                            <form method="POST" id="bookmark-{{ $sblog->id }}" class="bookmark_form">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="user_id" id="user_bookmark_id_{{ $sblog->id }}"
                                                    value="{{ auth()->user()->id }}">
                                                <input type="hidden" name="blog_id" id="blog_bookmark_id_{{ $sblog->id }}"
                                                    value="{{ $sblog->id }}">
                                                <button type="submit" class="bookmark  e-rbtn">
                                                    <span title="Bookmark this Article" class="bookmark_btn_{{ $sblog->id }}"
                                                        id="bookmark_btn_{{ $sblog->id }}">
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

                                    <a href="/blogs/{{ $sblog->id }}" class="link link-secondary">
                                        <h5 class="title">{{ $sblog->title }}</h5>
                                    </a>

                                    @foreach ($sblog->tags as $tag)
                                        <a href="/blogs/tagged/{{ $tag->title }}" class="tag-popover"
                                            id="tagSuggest{{ $blog->id }}-{{ $tag->id }}">
                                            <span class="modern-badge  modern-badge-{{ $tag->color }}">
                                                #{{ $tag->title }}
                                            </span>
                                        </a>
                                    @endforeach
                                    <p class="mt-3"> by
                                        <a class="btn-link link-secondary user-popover"
                                            href="/users/{{ $sblog->user_id }}/{{ $sblog->user->username }}/public"
                                            id="user{{ $sblog->id }}-{{ $sblog->user_id }}">
                                            {{ __($sblog->user->username) }}
                                        </a>
                                        <small class="text-muted"> posted
                                            {{ \Carbon\Carbon::parse($sblog->created_at)->diffForHumans() }}
                                        </small>
                                    </p>
                                    <a class="e-btn e-btn-dark e-btn-lg disable " href="/blogs/{{ $sblog->id }}">
                                        {{ __('Read Article') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </article>

    </main>


    {{-- <div class="m-2 mt-4 d-flex flex-row justify-content-between align-items-center">
            <div class="ml-2">
                <h5>Comments({{ $blog->comments->count() }})</h5>
            </div>
            <div>
                <div class="dropdown">
                    <button class="btn btn-outline-dark dropdown-toggle" type="button" id="dropdownMenuButton"
                        data-mdb-toggle="dropdown" aria-expanded="false">
                        Sortby
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <li><a class="dropdown-item" href="/blogs/{{ $blog->id }}?tab=newest#comments">Newest</a>
                        </li>
                        <li><a class="dropdown-item" href="/blogs/{{ $blog->id }}?tab=likes#comments">Most
                                Liked</a></li>
                        <li><a class="dropdown-item" href="/blogs/{{ $blog->id }}?tab=dislikes#comments">Most
                                disliked</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <hr> --}}
    {{-- @include('comments.index', ['comments' => $comments, 'blog' => $blog]) --}}
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
            typeof $.typeahead === 'function' && $.typeahead({
                input: '.js-typeahead-tags',
                minLength: 1,
                maxItem: 8,
                maxItemPerGroup: 6,
                order: "asc",
                hint: true,
                blurOnTab: true,
                correlativeTemplate: ["title"],
                matcher: function(item, displayKey) {
                    if (item.id === "BOS") {
                        item.disabled = true;
                    }
                    return true;
                },
                multiselect: {
                    limit: 5,
                    limitTemplate: 'You can\'t select more than 5 tags',
                    matchOn: ["title"],
                    cancelOnBackspace: true,
                    data: function() {
                        var deferred = $.Deferred();
                        var tags = @json($blog->tags);
                        $.each(tags, function() {
                            Object.assign(this, {
                                matchedKey: "title",
                                group: "tag",
                            });
                        })
                        deferred.resolve(tags);
                        return deferred;

                    },
                    callback: {
                        onClick: function(node, item, event) {
                            console.log(item.title);
                        },
                        onCancel: function(node, item, event) {
                            var tags = [];
                            var temp = [];
                            if ($("#tag-input").val() != '') {
                                temp = tags.concat(tags, JSON.parse($("#tag-input").val()));
                            }
                            if (temp.includes(item.title)) {
                                const index = temp.indexOf(item.title);
                                console.log(index);
                                if (index > -1) {
                                    temp.splice(index, 1);
                                }
                            }
                            $("#tag-input").val(JSON.stringify(temp));
                        }
                    }
                },
                dynamic: true,
                hint: true,
                template: function(query, item) {

                    return ` <div class="e-card  shadow-1  ">
                        <div class="e-card-body">
                            <a href="/blogs/tagged/` + item.title + `" class="tag-popover"
                                id="tag-` + item.id + `"><span class="modern-badge  modern-badge-` + item.color +
                        `">` + item.title + `</span>
                            </a>
                            <p class="mt-3 mb-3">Some quick example text to build on the card title and make up the bulk of
                                the card's content.Some quick example text to build on the card title and make up the bulk of
                                the card's content.Some quick example text to build on the card title and make up the bulk of
                                the card's content.Some quick example text to build on the card title and make up the bulk of
                                the card's content.</p>
                            <span class="text-muted">` + item.blogs_count + `blogs</span>
                        </div>
                    </div>`
                },
                templateValue: name,
                display: ["title", "color", "description"],
                emptyTemplate: function(query) {
                    return `no result for "` + query + `"`;
                },
                source: {
                    tag: {
                        ajax: function(query) {
                            return {
                                url: "/tags/search",
                                type: 'GET',
                                data: {
                                    query: query
                                },
                                dataType: 'json',
                                callback: {
                                    done: function(data) {

                                        return data.tags;
                                    }
                                }
                            }
                        },

                    }
                },
                callback: {
                    onClickAfter: function(node, a, item, event) {
                        var tags = [];
                        var temp = [];
                        if ($("#tag-input").val() != '') {
                            temp = tags.concat(tags, JSON.parse($("#tag-input").val()));
                        }
                        if (!temp.includes(item.title)) {
                            temp.push(item.title);
                        }
                        $("#tag-input").val(JSON.stringify(temp));
                    }
                }
            });
        });
    </script>
@endpush
