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
    {{-- @can('isBlogOwner', $blog)
        <div id="deleteModal-{{ $blog->id }}" tabindex="-1"
            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full md:inset-0 h-modal md:h-full"
            aria-hidden="true">
            <div class="relative p-4 w-full max-w-md h-full md:h-auto">

                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <button type="button"
                        class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white"
                        data-modal-toggle="deleteModal-{{ $blog->id }}">
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                    <div class="p-6 text-center">
                        <svg aria-hidden="true" class="mx-auto mb-4 w-14 h-14 text-gray-400 dark:text-gray-200" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">
                            Do you really want to delete blog " <strong class="font-weight-bold">{{ $blog->title }}
                            </strong>" ?
                        </h3>
                        <form method="POST" action="/blog/{{ $blog->id }}/delete">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="user_id" value="{{ $blog->user_id }}">
                            <div class="form-group">
                                <input type="submit"
                                    class="text-white mb-2 bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2"
                                    value="Yes, I'm sure">
                                <button data-modal-toggle="deleteModal-{{ $blog->id }}" type="button"
                                        class="mb-2 text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">No,
                                        cancel</button>
                            </div>
                        </form>
                        
                    </div>
                </div>
            </div>
        </div>
        @include('blogs.update', ['blog' => $blog])
    @endcan --}}
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
    <main class="prose max-w-none prose-img:rounded-xl dark:prose-invert prose-a:text-purple-600 dark:prose-a:text-white ">
        <div class="relative  pt-[60%] rounded-xl sm:pt-[50%] md:pt-[42%] ">
            <img class="absolute m-0 top-0 left-0 right-0 bottom-0 w-full h-full object-fit rounded-xl shadow-md drop-shadow-md bg-white dark:bg-gray-800"
                src="https://picsum.photos/400/300" alt="" />
        </div>
        <div class="mt-3 flex flex-col lg:flex-row w-full relative">
            <div class="basis-2/3 my-2">
                <div>
                    @foreach ($blog->tags as $tag)
                        <a href="/blogs/tagged/{{ $tag->title }}" class="link tag-popover"
                            id="tag{{ $blog->id }}-{{ $tag->id }}">
                            <span class="modern-badge  modern-badge-{{ $tag->color }}">
                                #{{ $tag->title }}
                            </span>
                        </a>
                    @endforeach
                </div>
                <h1 class="my-55 text-3xl md:text-4xl lg:text-5xl dark:text-white">
                    {{ $blog->title }}
                </h1>
                <article class="my-5 w-full ">
                    {!! $blog->description !!}
                </article>
                 <div class="m-2 mt-4 d-flex flex-row justify-content-between align-items-center">
                <div class="ml-2">
                    <h5>Comments({{ $blog->comments->count() }})</h5>
                </div>
                <div>
                    <div class="dropdown">
                        <button class="e-btn dropdown-toggle" type="button" id="dropdownMenuButton"
                            data-mdb-toggle="dropdown" aria-expanded="false">
                            Sortby
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <li><a class="dropdown-item"
                                    href="/blogs/{{ Str::slug($blog->title, '-') }}-{{ $blog->id }}?tab=newest#comments">Newest</a>
                            </li>
                            <li><a class="dropdown-item"
                                    href="/blogs/{{ Str::slug($blog->title, '-') }}-{{ $blog->id }}?tab=likes#comments">Most
                                    Liked</a></li>
                            <li><a class="dropdown-item"
                                    href="/blogs/{{ Str::slug($blog->title, '-') }}-{{ $blog->id }}?tab=dislikes#comments">Most
                                    disliked</a></li>
                        </ul>
                    </div>
                </div>
                
            </div>
            <div class="bg-black sticky bottom-0">hi</div>
            <hr>
            @include('comments.index', ['comments' => $comments, 'blog' => $blog])
            </div>
            <div class="basis-1/3 my-2 sticky top-24 bottom-0p-1">
                <div class="  mt-3 w-full  text-base text-left  border  border-gray-200 rounded-xl font-normal   hover:shadow-md dark:border-gray-700 dark:bg-gray-800 ">
                    <header class="py-3 px-4 text-2xl font-semibold text-gray-700 dark:text-white">
                        <span class="modern-badge modern-badge-danger">#Advertisment</span>
                    </header>
                    <div
                        class="border-t py-3 px-4 last:rounded-b-xl border-gray-200 text-gray-700 dark:text-gray-400 dark:hover:text-white dark:border-gray-700 hover:bg-gray-100 hover:shadow-md dark:bg-gray-800 dark:hover:bg-gray-700">

                        <img src="https://picsum.photos/1200/1000" alt="">
                    </div>
                </div>
            </div>
        </div>
    </main>
    <main class="global-main">

        <article class="blog-section mt-4">
            {{-- <nav class="flex mb-3 px-5 py-3 text-gray-700 border border-gray-200 rounded-lg bg-gray-50 hover:shadow dark:bg-gray-800 dark:border-gray-700"
                aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                        <a href="/home"
                            class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white">
                            @svg('heroicon-s-home', 'w-4 h-4 mr-2')
                            Home
                        </a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <a href="/blogs"
                                class="ml-1 text-sm font-medium text-gray-700 hover:text-gray-900 md:ml-2 dark:text-gray-400 dark:hover:text-white">Blogs</a>
                        </div>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2 dark:text-gray-400 hidden sm:flex">
                                {!! Str::words($blog->title, 4) !!}</span>
                            <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2 dark:text-gray-400 sm:hidden">
                                {!! Str::words($blog->title, 2) !!}</span>
                        </div>
                    </li>
                </ol>
            </nav> --}}

            {{-- <div class="blog-header item is-hero">
                <div class="item-container">

                    <div class="item-content">
                        <div class="item-meta global-meta">
                            <div class="item-profile-image">
                                <a href="/users/{{ $blog->user_id }}/{{ $blog->user->username }}/public"
                                    class="global-image">
                                    <img src="{{ asset($blog->user->profile_image ?? '') }}" alt="">
                                </a>
                            </div>
                            <div class="item-author">
                                <a href="/users/{{ $blog->user->username }}">
                                    {{ __($blog->user->username) }}
                                </a>
                                <div class="item-time">
                                    <time datetime="{{ $blog->created_at }}">
                                        {{ \Carbon\Carbon::parse($blog->created_at)->format('M d, Y') }}
                                    </time>
                                    ∙ {{ Str::readDuration($blog->description) }} mins read
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
            {{-- <div class="blog-content">
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
                                    <button type="button" class="e-rbtn" data-mdb-toggle="dropdown" data-mdb-display="static"
                                        aria-expanded="false">
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
                                        <input type="hidden" name="blog_id" id="blog_dislike_id"
                                            value="{{ $blog->id }}">
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
                                                <form method="POST" id="bookmark-{{ $blog->id }}"
                                                    class="bookmark_form">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="user_id"
                                                        id="user_bookmark_id_{{ $blog->id }}"
                                                        value="{{ auth()->user()->id }}">
                                                    <input type="hidden" name="blog_id"
                                                        id="blog_bookmark_id_{{ $blog->id }}"
                                                        value="{{ $blog->id }}">
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
                                        @can('isBlogOwner', $blog)
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
                                                <a type="button" role="button"
                                                    data-modal-toggle="deleteModal-{{ $blog->id }}"
                                                    class="dropdown-item e-rbtn" href="#deleteModal-{{ $blog->id }}">
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
                    <div class="blog-share-wrap social-wrap">

                        <a class="social-link link-icon-facebook" href="{{ $shareBlog['facebook'] }}"
                            id="">{{ svg('bi-facebook') }}
                        </a>
                        <a class="social-link link-icon-twitter" href="{{ $shareBlog['twitter'] }}"
                            id="">{{ svg('bi-twitter') }}
                        </a>
                        <a class="social-link link-icon-linkedin" href="{{ $shareBlog['linkedin'] }}"
                            id="">{{ svg('bi-linkedin') }}
                        </a>
                        <a class="social-link link-icon-reddit" href="{{ $shareBlog['reddit'] }}"
                            id="">{{ svg('bi-reddit') }}
                        </a>
                        <a class="social-link link-icon-whatsapp" href="{{ $shareBlog['whatsapp'] }}"
                            id="">{{ svg('bi-whatsapp') }}
                        </a>
                        <a class="social-link link-icon-telegram" href="{{ $shareBlog['telegram'] }}"
                            id="">{{ svg('bi-telegram') }}
                        </a>
                    </div>
                </div>
                <div class="blog-auther">
                    <div class="e-card e-card-center e-card-primary">
                        <div class="e-card-image">
                            <a href="/users/{{ $blog->user->username }}" class="global-image">
                                <img class="user-image" src="{{ asset($blog->user->profile_image ?? '') }}"
                                    alt="">
                            </a>
                        </div>
                        <div class="e-card-body">
                            <div class="e-card-body-top">
                                <div class="top-left">
                                    <a href="/users/{{ $blog->user->username }}" class="username">
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
                                        <a class="e-btn e-btn-success" href="#">
                                            {{ __('Follow') }}
                                        </a>
                                    @else
                                        <div id="toast-unfollow">

                                        </div>

                                        @if (auth()->user()->id == $blog->user_id)
                                            <a class="e-btn e-btn-success" href="/users/{{ $blog->user->username }}">
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
                                                        <button type="submit" class="e-btn e-btn-success">Follow</button>
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
                                                        <button type="submit" class="e-btn e-btn-success">Follow</button>
                                                    </form>
                                                </div>
                                                <div id="user_unfollow_option-{{ $blog->user_id }}" style="display: none;">

                                                    <button type="button" class="e-btn" data-mdb-ripple-color="dark"
                                                        data-mdb-toggle="modal"
                                                        data-mdb-target="#unfollowModal-{{ $blog->user_id }}">Unfollow</button>
                                                </div>
                                            @endif
                                            <div class="modal fade" id="unfollowModal-{{ $blog->user_id }}" tabindex="-1"
                                                aria-labelledby="unfollowModal-{{ $blog->user_id }}-Label"
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
                                                                    <input type="submit" class="e-btn e-btn-success"
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
                                {!! $blog->user->short_bio !!}
                            </div>
                        </div>
                    </div>
                </div>


            </div> --}}


            {{-- <div class="m-2 mt-4 d-flex flex-row justify-content-between align-items-center">
                <div class="ml-2">
                    <h5>Comments({{ $blog->comments->count() }})</h5>
                </div>
                <div>
                    <div class="dropdown">
                        <button class="e-btn dropdown-toggle" type="button" id="dropdownMenuButton"
                            data-mdb-toggle="dropdown" aria-expanded="false">
                            Sortby
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <li><a class="dropdown-item"
                                    href="/blogs/{{ Str::slug($blog->title, '-') }}-{{ $blog->id }}?tab=newest#comments">Newest</a>
                            </li>
                            <li><a class="dropdown-item"
                                    href="/blogs/{{ Str::slug($blog->title, '-') }}-{{ $blog->id }}?tab=likes#comments">Most
                                    Liked</a></li>
                            <li><a class="dropdown-item"
                                    href="/blogs/{{ Str::slug($blog->title, '-') }}-{{ $blog->id }}?tab=dislikes#comments">Most
                                    disliked</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <hr>
            @include('comments.index', ['comments' => $comments, 'blog' => $blog]) --}}

            @if ($related->count() > 0)
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
                        <div class="mt-2 relative w-full p-2.5 text-base text-left  border border-transparent rounded-3xl font-normal text-gray-700 dark:text-gray-400 hover:bg-gray-100 hover:shadow-md dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700"
                            id="blog-{{ $sblog->id }}">
                            <div class="flex flex-col items-stretch justify-center p-6 sm:flex-row">
                                <div class="basis-1/3 relative text-center min-h-fit">
                                    <img class="block relative w-full h-full rounded-xl  object-cover shadow-md hover:shadow-sm sm:absolute sm:top-0 sm:left-0 "
                                        src="https://picsum.photos/400/300" alt="">
                                </div>
                                <div class="basis-2/3 mt-2 relative leading-normal sm:mt-0 sm:px-4">
                                    @guest
                                        <span class="absolute top-0 right-0 bookmark" title="Bookmark this Article">
                                            <a class="e-rbtn">
                                                @svg('gmdi-bookmark-add-o')
                                            </a>
                                        </span>
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
                                                <button type="submit" class="absolute top-0 right-0 bookmark e-rbtn">
                                                    <span title="Bookmark this Article"
                                                        class="bookmark_btn_{{ $sblog->id }}"
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
                                    <a href="/blogs/{{ Str::slug($sblog->title, '-') }}-{{ $sblog->id }}"
                                        class="link link-secondary">
                                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">In
                                            {{ $sblog->title }}
                                        </h5>
                                    </a>

                                    @foreach ($sblog->tags as $tag)
                                        <a href="/blogs/tagged/{{ $tag->title }}" class="tag-popover"
                                            id="tagSuggest{{ $sblog->id }}-{{ $tag->id }}">
                                            <span class="modern-badge  modern-badge-{{ $tag->color }}">
                                                #{{ $tag->title }}
                                            </span>
                                        </a>
                                    @endforeach
                                    <p class="mt-3">
                                        <span>By </span>
                                        <a class="text-sm font-medium text-gray-900 truncate dark:text-white user-popover"
                                            href="/users/{{ $sblog->user->username }}"
                                            id="user{{ $sblog->id }}-{{ $sblog->user_id }}">
                                            {{ __($sblog->user->username) }}
                                        </a>
                                        <span class="text-sm">posted
                                            {{ \Carbon\Carbon::parse($sblog->created_at)->diffForHumans() }}
                                        </span>
                                    </p>
                                    <a class="e-btn e-btn-dark e-btn-lg sm:hidden"
                                        href="/blogs/{{ Str::slug($sblog->title, '-') }}-{{ $sblog->id }}">
                                        Read
                                        Article
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

        </article>
    </main>


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
