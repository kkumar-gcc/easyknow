@extends('layouts.blog')
@push('styles')
    <x-head.tinymce-config />
@endpush
@section('content')
    @include('blogs.share', ['shareBlog' => $shareBlog])
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
    @if (session()->has('success'))
        <section class="my-4 d-flex justify-content-center w-100">
            <div class="container">
                <div class="alert alert-dismissible fade show alert-success" role="alert" data-mdb-color="warning"
                    id="customxD">
                    <strong>Success!</strong> {{ session()->get('success') }}
                    <button type="button" class="btn-close" data-mdb-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        </section>
    @endif
    <main
        class="relative prose max-w-none lg:max-w-full xl:max-w-none prose-img:rounded-xl  dark:prose-invert prose-a:text-rose-600 dark:prose-a:text-rose-500">

        <div id="toast-info">
          
        </div>
        <div class="relative  pt-[60%] rounded-xl sm:pt-[50%] md:pt-[42%] ">
            <img class="absolute top-0 bottom-0 left-0 right-0 w-full h-full m-0 bg-white shadow-md object-fit rounded-xl drop-shadow-md dark:bg-gray-800"
                src="https://picsum.photos/400/300" alt="" />
        </div>
        <div class="relative flex flex-col w-full mt-3 lg:flex-row ">
            <div class="flex-1 my-2 basis-2/3 lg:w-2/3">
                <div class="not-prose {{ $blog->adult_warning ? '' : 'hidden' }}">
                    <div
                        class="flex flex-col items-center justify-center  px-4 py-4 mb-4 text-sm text-[#1f2833] leading-6 border not-prose  border-rose-200 bg-rose-50 rounded-xl dark:bg-[#fddfd8] ">
                        <p class="text-base">This blog contains adult content.<a href="#"
                                class="font-black text-rose-600 ml-2">learn more</a></p>
                    </div>
                </div>
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
                <h1 class="text-3xl my-55 md:text-4xl lg:text-5xl dark:text-white">
                    {{ $blog->title }}
                </h1>
                @can('isBlogOwner', $blog)
                    <div class="flex justify-end not-prose">
                        <div class="inline-flex rounded-md shadow-sm" role="group">
                            <a type="button" href="/blogs/edit/{{ Str::slug($blog->title, '-') }}-{{ $blog->id }}"
                                class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-l-lg hover:bg-gray-50 hover:text-rose-600 focus:z-10 focus:ring-2 focus:ring-rose-600 focus:text-rose-600 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-rose-500 dark:focus:text-white">

                                {{ svg('coolicon-edit', 'w-4 h-4 mr-2 fill-current') }}

                                Edit
                            </a>
                            <a type="button" href="/blogs/manage/{{ Str::slug($blog->title, '-') }}-{{ $blog->id }}"
                                class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-900 bg-white border-t border-b border-gray-200 hover:bg-gray-50 hover:text-rose-600 focus:z-10 focus:ring-2 focus:ring-rose-600 focus:text-rose-600 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-rose-500 dark:focus:text-white">
                                <svg aria-hidden="true" class="w-4 h-4 mr-2 fill-current" fill="currentColor"
                                    viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M5 4a1 1 0 00-2 0v7.268a2 2 0 000 3.464V16a1 1 0 102 0v-1.268a2 2 0 000-3.464V4zM11 4a1 1 0 10-2 0v1.268a2 2 0 000 3.464V16a1 1 0 102 0V8.732a2 2 0 000-3.464V4zM16 3a1 1 0 011 1v7.268a2 2 0 010 3.464V16a1 1 0 11-2 0v-1.268a2 2 0 010-3.464V4a1 1 0 011-1z">
                                    </path>
                                </svg>
                                Manage
                            </a>
                            <a type="button" href="/blogs/stats/{{ Str::slug($blog->title, '-') }}-{{ $blog->id }}"
                                class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-r-md hover:bg-gray-50 hover:text-rose-600 focus:z-10 focus:ring-2 focus:ring-rose-600 focus:text-rose-600 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-rose-500 dark:focus:text-white">
                                @svg('icomoon-stats-bars', 'w-4 h-4 mr-2 fill-current')
                                Stats
                            </a>
                        </div>
                    </div>
                @endcan
                <div class={{ $blog->adult_warning ? 'prose-img:blur-lg' : '' }}>
                    @if ($blog->access == 'follower')
                        @guest
                            <article class="w-full my-5 ">
                                {!! Str::words(strip_tags($blog->description), 50) !!}
                            </article>
                            <div class="">
                                <div
                                    class="flex flex-col items-center text-center justify-center px-8 py-16 mb-4 text-sm text-[#1f2833] leading-6 border not-prose  border-rose-200 bg-rose-50 rounded-xl dark:bg-[#fddfd8] ">
                                    <h2 class="mb-8 text-2xl font-black md:text-3xl lg:text-4xl ">This Blog is for followers
                                        only
                                    </h2>
                                    <p class="text-base">Sign up now to read the blog and get access to the full library of
                                        blogs
                                        for followers only.</p>
                                    <div class="">
                                        <a class="flex items-center justify-center px-4 py-3 my-4 text-sm font-medium text-center text-white no-underline cursor-pointer rounded-xl whitespace-nowrap bg-gradient-to-br from-rose-600 to-pink-500 hover:bg-gradient-to-bl focus:ring-2 focus:outline-none focus:ring-rose-300 dark:focus:ring-rose-800"
                                            href="/register">
                                            {{ __('Sign up now') }}
                                        </a>
                                        <span class="text-sm">Already have an account? <a href="/login" class="font-black">Sign
                                                in</a></span>
                                    </div>
                                </div>
                            </div>
                        @else
                            @if ($blog->user_id == auth()->user()->id)
                                <article class="w-full my-5 ">
                                    {!! $blog->description !!}
                                </article>
                            @else
                                @if ($blog->user->isFollowing())
                                    <article class="w-full my-5 ">
                                        {!! $blog->description !!}
                                    </article>
                                @else
                                    <article class="w-full my-5 ">
                                        {!! Str::words(strip_tags($blog->description), 50) !!}
                                    </article>
                                    <div class="">
                                        <div
                                            class="flex flex-col items-center text-center justify-center px-8 py-16 mb-4 text-sm text-[#1f2833] leading-6 border not-prose  border-rose-200 bg-rose-50 rounded-xl dark:bg-[#fddfd8] ">
                                            <h2 class="mb-8 text-2xl font-black md:text-3xl lg:text-4xl ">This Blog is for
                                                followers only
                                            </h2>
                                            <p class="text-base">Follow the author now to read the blog and get access to the
                                                full library of blogs
                                                for followers only.</p>
                                            <div class="">
                                                <form method="post" id="follow-{{ $blog->user_id }}" class="follow">
                                                    @csrf
                                                    @method('put')
                                                    <input type="hidden" name="follower_id" id="follower_id"
                                                        value="{{ auth()->user()->id }}">
                                                    <input type="hidden" name="user_id" id="user_id"
                                                        value="{{ $blog->user_id }}">
                                                    @if ($blog->user->isFollowing())
                                                        <button type="submit"
                                                            class="follow_button_{{ $blog->user_id }} my-4 inline-flex justify-center items-center font-medium rounded-lg text-sm px-5 py-2 text-center no-underline cursor-pointer whitespace-nowrap text-white bg-gradient-to-br from-rose-600 to-pink-500 hover:bg-gradient-to-bl focus:ring-2 focus:outline-none focus:ring-rose-300 dark:focus:ring-rose-800">
                                                            {{ svg('bi-person-check-fill', 'mr-2 -ml-1 w-5 h-5') }}
                                                            {{ __('Following') }}
                                                        </button>
                                                    @else
                                                        <button type="submit"
                                                            class="follow_button_{{ $blog->user_id }} my-4 w-full inline-flex justify-center items-center font-medium rounded-lg text-sm px-5 py-2 text-center no-underline  cursor-pointer whitespace-nowrap text-white bg-gradient-to-br from-rose-600 to-pink-500 hover:bg-gradient-to-bl focus:ring-2 focus:outline-none focus:ring-rose-300 dark:focus:ring-rose-800">
                                                            {{ svg('bi-person-plus-fill', 'mr-2 -ml-1 w-5 h-5') }}
                                                            {{ __('Follow') }}
                                                        </button>
                                                    @endif
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endif
                        @endguest
                    @elseif($blog->access == 'public')
                        <article class="w-full my-5 ">
                            {!! $blog->description !!}
                        </article>
                    @endif
                </div>


                @include('comments.index', ['comments' => $comments, 'blog' => $blog])
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
                            <div class="mt-2 relative w-full p-2.5 text-base text-left  border border-transparent rounded-3xl font-normal hover:bg-gray-50 hover:shadow-md dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700 not-prose"
                                id="blog-{{ $sblog->id }}">
                                <div class="flex flex-col items-stretch justify-center p-6 sm:flex-row">
                                    <div class="relative text-center basis-1/3 max-h-fit">
                                        <img class="relative block object-cover w-full h-full shadow-md rounded-xl hover:shadow-sm sm:absolute sm:top-0 sm:left-0 "
                                            src="https://picsum.photos/400/300" alt="">
                                    </div>
                                    <div class="relative mt-2 leading-normal basis-2/3 sm:mt-0 sm:px-4">
                                        <div class="flex flex-row mt-3 mb-1 md:mt-0">
                                            <div class="flex flex-row items-center flex-1">
                                                <div class="mr-2 text-sm">
                                                    {{ nice_number($sblog->bloglikes->where('status', 1)->count()) }}
                                                    <span>likes</span>
                                                </div>
                                                <div class="mr-2 text-sm">
                                                    {{ nice_number($sblog->blogviews->count()) }} <span>views</span>
                                                </div>
                                            </div>
                                            <div>
                                                @guest

                                                    <button type="button"
                                                        class="flex flex-row items-center p-2 mr-1 text-sm rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:focus:ring-gray-700"
                                                        data-modal-toggle="loginMessageModal">
                                                        <span title="Bookmark this Article">
                                                            @svg('gmdi-bookmark-add-o', 'h-5 w-5') </span>
                                                    </button>
                                                @else
                                                    @if (auth()->user()->id != $sblog->user_id)
                                                        <form method="POST" id="bookmark-{{ $sblog->id }}"
                                                            class="bookmark_form">
                                                            @csrf
                                                            @method('PUT')
                                                            <input type="hidden" name="user_id"
                                                                id="user_bookmark_id_{{ $sblog->id }}"
                                                                value="{{ auth()->user()->id }}">
                                                            <input type="hidden" name="blog_id"
                                                                id="blog_bookmark_id_{{ $sblog->id }}"
                                                                value="{{ $sblog->id }}">
                                                            <button type="submit"
                                                                class="flex flex-row items-center p-2 mr-1 text-sm rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:focus:ring-gray-700">
                                                                <span class="bookmark_btn_{{ $sblog->id }}"
                                                                    id="bookmark_btn_{{ $sblog->id }}"
                                                                    title="Bookmark this Article">
                                                                    @if ($sblog->isBookmarked())
                                                                        @svg('gmdi-bookmark-added-r', 'w-5 h-5 text-rose-500 dark:text-rose-500')
                                                                    @else
                                                                        @svg('gmdi-bookmark-add-o', 'h-5 w-5')
                                                                    @endif
                                                                </span>
                                                            </button>

                                                        </form>
                                                    @endif
                                                @endguest
                                            </div>
                                        </div>
                                        <a href="/blogs/{{ Str::slug($sblog->title, '-') }}-{{ $sblog->id }}"
                                            class="link link-secondary">
                                            <h5
                                                class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                                                In
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
                                            <span class="mr-1">By </span>
                                            <a class="text-sm font-medium text-gray-900 truncate dark:text-white user-popover"
                                                href="/users/{{ $sblog->user->username }}"
                                                id="user{{ $sblog->id }}-{{ $sblog->user_id }}">
                                                {{ __($sblog->user->username) }}
                                            </a>
                                            <span class="ml-1 text-sm">posted
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
            </div>
            <aside class="my-2 overflow-hidden basis-1/3 lg:pl-5 lg:py-5">
                <div id="sticky-sidebar">
                    <div
                        class="w-full mt-3 text-base font-normal text-left border border-gray-200 rounded-xl dark:border-gray-700 dark:bg-gray-800 ">
                        <div class="px-4 py-3 rounded-xl dark:bg-gray-800 ">
                            <div class="flex flex-row justify-between">
                                @guest
                                    <button type="button"
                                        class="flex flex-row items-center mr-1 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-2.5"
                                        data-modal-toggle="loginMessageModal">
                                        {{ svg('grommet-like', 'h-4 w-4') }}
                                        <span class="ml-3">
                                            {{ nice_number($blog->bloglikes->where('status', 1)->count()) }}</span>
                                    </button>
                                    <button type="button"
                                        class="flex flex-row items-center mr-1  hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-2.5"
                                        data-modal-toggle="loginMessageModal">
                                        {{ svg('grommet-dislike', 'h-4 w-4') }}
                                    </button>
                                @else
                                    {{-- like form --}}
                                    <form method="post" id="blog_like_form" class="d-inline">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="blog_id" id="blog_like_id" value="{{ $blog->id }}">
                                        <input type="hidden" name="user_id" id="user_like_id"
                                            value="{{ auth()->user()->id }}">
                                        <button type="submit" id="blog-like-{{ $blog->id }}"
                                            class="flex flex-row items-center mr-1 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-2.5">
                                            {{ svg('grommet-like', 'h-4 w-4') }}
                                            <span class="ml-3">
                                                {{ nice_number($blog->bloglikes->where('status', 1)->count()) }}</span>
                                        </button>
                                    </form>
                                    {{-- dislike form --}}
                                    <form method="post" id="blog_dislike_form" class="d-inline">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="blog_id" id="blog_dislike_id"
                                            value="{{ $blog->id }}">
                                        <input type="hidden" name="user_id" id="user_dislike_id"
                                            value="{{ auth()->user()->id }}">
                                        <button type="submit" id="blog-dislike-{{ $blog->id }}"
                                            class="flex flex-row items-center mr-1 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-2.5">
                                            {{ svg('grommet-dislike', 'h-4 w-4') }}
                                        </button>
                                    </form>
                                @endguest
                                <button type="button"
                                    class=" flex flex-row items-center mr-1 md:mr-1 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-2.5"
                                    data-modal-toggle="shareBlogModal">
                                    {{ svg('heroicon-o-share', 'h-5 w-5') }}
                                    <span class="ml-2">share</span>
                                </button>
                                @guest
                                    <button type="button"
                                        class="flex flex-row items-center mr-1  hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-2.5"
                                        data-modal-toggle="loginMessageModal">
                                        {{ svg('gmdi-bookmark-add-o', 'h-5 w-5') }}
                                    </button>
                                @else
                                    @if (auth()->user()->id != $blog->user_id)
                                        <form method="POST" id="bookmark-{{ $blog->id }}" class="bookmark_form">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="user_id" id="user_bookmark_id_{{ $blog->id }}"
                                                value="{{ auth()->user()->id }}">
                                            <input type="hidden" name="blog_id" id="blog_bookmark_id_{{ $blog->id }}"
                                                value="{{ $blog->id }}">
                                            <button type="submit" id="bookmark_btn_{{ $blog->id }}"
                                                class="bookmark_btn_{{ $blog->id }} flex flex-row items-center mr-1  hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-2.5">
                                                @if ($blog->isBookmarked())
                                                    @svg('gmdi-bookmark-added-r', 'text-rose-600 dark:text-rose-500 h-5 w-5')
                                                @else
                                                    @svg('gmdi-bookmark-add-o', 'h-5 w-5')
                                                @endif
                                            </button>
                                        </form>
                                    @endif
                                @endguest
                            </div>
                        </div>
                    </div>
                    <div
                        class="w-full mt-3 text-base font-normal text-left border border-gray-200 rounded-xl dark:border-gray-700 dark:bg-gray-800 ">
                        <div class="px-4 py-3 rounded-xl not-prose dark:bg-gray-800 ">
                            <header class="">
                                <div class="flex items-center flex-1 ">
                                    <img class="w-10 h-10 rounded-full" src="{{ asset($blog->user->profile_image) }}"
                                        onerror="this.onerror=null;this.src=`https://avatars.dicebear.com/api/bottts/:{{ $blog->user->username }}.svg`"
                                        alt="">
                                    <div class="ml-2 font-medium">
                                        <div class="text-gray-900 dark:text-white">{{ $blog->user->username }} </div>
                                        <div class="text-sm">Joined in
                                            {{ \Carbon\Carbon::parse($blog->user->created_at)->format('F Y') }}
                                        </div>
                                    </div>
                                </div>
                            </header>
                            <div class="mt-3">
                                {!! $blog->user->short_bio !!}
                            </div>
                            <div class="w-full mt-3">
                                @guest
                                    <button type="button"
                                        class="inline-flex items-center justify-center w-full px-5 py-2 text-sm font-medium text-center text-white no-underline rounded-lg cursor-pointer whitespace-nowrap bg-gradient-to-br from-rose-600 to-pink-500 hover:bg-gradient-to-bl focus:ring-2 focus:outline-none focus:ring-rose-300 dark:focus:ring-rose-800"
                                        data-modal-toggle="loginMessageModal">
                                        {{ svg('bi-person-plus-fill', 'mr-2 -ml-1 w-5 h-5') }}
                                        {{ __('Follow') }}
                                    </button>
                                @else
                                    @if (auth()->user()->id == $blog->user_id)
                                        <a class="inline-flex items-center justify-center w-full px-5 py-2 text-sm font-medium text-center text-white no-underline rounded-lg cursor-pointer whitespace-nowrap bg-gradient-to-br from-rose-600 to-pink-500 hover:bg-gradient-to-bl focus:ring-2 focus:outline-none focus:ring-rose-300 dark:focus:ring-rose-800"
                                            href="/users/{{ $blog->user->username }}">
                                            {{ svg('coolicon-edit', 'mr-2 -ml-1 w-5 h-5') }}
                                            {{ __('View Profile') }}
                                        </a>
                                    @else
                                        <form method="post" id="follow-{{ $blog->user_id }}" class="follow">
                                            @csrf
                                            @method('put')
                                            <input type="hidden" name="follower_id" id="follower_id"
                                                value="{{ auth()->user()->id }}">
                                            <input type="hidden" name="user_id" id="user_id"
                                                value="{{ $blog->user_id }}">
                                            @if ($blog->user->isFollowing())
                                                <button type="submit"
                                                    class="follow_button_{{ $blog->user_id }} w-full inline-flex justify-center items-center font-medium rounded-lg text-sm px-5 py-2 text-center no-underline cursor-pointer whitespace-nowrap text-white bg-gradient-to-br from-rose-600 to-pink-500 hover:bg-gradient-to-bl focus:ring-2 focus:outline-none focus:ring-rose-300 dark:focus:ring-rose-800">
                                                    {{ svg('bi-person-check-fill', 'mr-2 -ml-1 w-5 h-5') }}
                                                    {{ __('Following') }}
                                                </button>
                                            @else
                                                <button type="submit"
                                                    class="follow_button_{{ $blog->user_id }} w-full inline-flex justify-center items-center font-medium rounded-lg text-sm px-5 py-2 text-center no-underline  cursor-pointer whitespace-nowrap text-white bg-gradient-to-br from-rose-600 to-pink-500 hover:bg-gradient-to-bl focus:ring-2 focus:outline-none focus:ring-rose-300 dark:focus:ring-rose-800">
                                                    {{ svg('bi-person-plus-fill', 'mr-2 -ml-1 w-5 h-5') }}
                                                    {{ __('Follow') }}
                                                </button>
                                            @endif
                                        </form>
                                    @endif
                                @endguest
                            </div>
                        </div>
                    </div>

                    <div
                        class="w-full mt-3 text-base font-normal text-left border border-gray-200 rounded-xl hover:shadow-md dark:border-gray-700 dark:bg-gray-800">
                        <header class="px-4 py-3 text-2xl font-semibold text-gray-700 dark:text-white">
                            <span class="modern-badge modern-badge-danger">#Advertisment</span>
                        </header>
                        <div
                            class="px-4 py-3 text-gray-700 border-t border-gray-200 last:rounded-b-xl dark:text-gray-400 dark:hover:text-white dark:border-gray-700 hover:bg-gray-50 hover:shadow-md dark:bg-gray-800 dark:hover:bg-gray-700">
                            <div class="relative  pt-[60%] w-full rounded-xl sm:pt-[50%] md:pt-[42%] ">
                                <img class="absolute top-0 bottom-0 left-0 right-0 object-cover w-full h-full m-0 bg-white shadow-md rounded-xl drop-shadow-md dark:bg-gray-800"
                                    src="https://picsum.photos/400/300" alt="" />
                            </div>
                        </div>
                    </div>
                    <div
                        class="w-full mt-3 text-base font-normal text-left border border-gray-200 rounded-xl hover:shadow-md dark:border-gray-700 dark:bg-gray-800 ">
                        <header class="px-4 py-3 text-2xl font-semibold text-gray-700 dark:text-white">
                            <span>More From {{ $blog->user->username }}</span>
                        </header>
                        <div
                            class="px-4 py-3 text-gray-700 border-t border-gray-200 last:rounded-b-xl dark:text-gray-400 dark:hover:text-white dark:border-gray-700 hover:bg-gray-50 hover:shadow-md dark:bg-gray-800 dark:hover:bg-gray-700">
                            First, why should you make any website faster?

                            ✔️ Decrease bounce rate by 57% (as per study)
                            ✔️ Increases google ranking
                            ✔️ Happy Visitors/Customers

                            let's check the steps 👇

                        </div>
                    </div>
                </div>
            </aside>
        </div>
    </main>
@endsection
@push('scripts')
    @include('ajax')
    <script>
        $(document).ready(function() {
            $(document).on('click', '.collapse-toggle', function() {
                var id = $(this).attr('data-collapse-toggle');
                var isHidden = $("#" + id).attr('data-collapse-hidden');
                var classList = document.getElementById(id).classList;
                var _old = $(this).children('span').attr("data-content") || "hide replies";
                var _new = $(this).children('span').html();
                $(this).children('span').attr("data-content", _new);
                $(this).children('span').html(_old);
                if (isHidden) {
                    classList.toggle('block');
                    $("#" + id).attr('data-collapse-hidden', false);
                } else {
                    classList.toggle('hidden');
                    $("#" + id).attr('data-collapse-hidden', true);
                }
            })
            $(document).on('click', '.reply-toggle', function() {
                var id = $(this).attr('data-reply-toggle');
                var _old = $(this).children('span').attr("data-content") || "close";
                var _new = $(this).children('span').html();
                $(this).children('span').attr("data-content", _new);
                $(this).children('span').html(_old);
                $("#" + id).toggleClass('hidden block')
            })
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

                    return ` <div class="e-card shadow-1 ">
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
