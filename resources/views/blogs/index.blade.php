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

        <div class="tabs mb-4  mt-4 border-b border-gray-200 dark:border-gray-700">
            <ul class="flex flex-wrap -mb-px text-sm font-medium text-center -primary" role="tablist">
                <li class="mr-2" role="presentation">
                    <a class="inline-block p-4 rounded-t-lg border-b-2  {{ $tab == 'newest' ? 'text-gray-700 hover:text-gray-800 dark:text-white  border-purple-700 dark:border-purple-600' : 'hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300 dark:border-transparent text-gray-500 dark:text-gray-400 border-gray-100 dark:border-gray-700' }}"
                        href="/blogs?tab=newest" role="tab">Newest</a>
                </li>
                <li class="mr-2" role="presentation">
                    <a class="inline-block p-4 rounded-t-lg border-b-2  {{ $tab == 'likes' ? 'text-gray-700 hover:text-gray-800 dark:text-white  border-purple-700 dark:border-purple-600' : 'hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300 dark:border-transparent text-gray-500 dark:text-gray-400 border-gray-100 dark:border-gray-700' }}"
                        href="/blogs?tab=likes" role="tab">Most Liked</a>
                </li>
                <li class="mr-2" role="presentation">
                    <a class="inline-block p-4 rounded-t-lg border-b-2  {{ $tab == 'views' ? 'text-gray-700 hover:text-gray-800 dark:text-white  border-purple-700 dark:border-purple-600' : 'hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300 dark:border-transparent text-gray-500 dark:text-gray-400 border-gray-100 dark:border-gray-700' }}"
                        href="/blogs?tab=views" role="tab">Top Viewed</a>
                </li>
            </ul>
        </div>
        @foreach ($blogs as $blog)
            <div class="relative mt-3 w-full p-2.5 text-base text-left  border border-transparent rounded-3xl font-normal text-gray-700 dark:text-gray-400 hover:bg-gray-100 hover:shadow-md dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700"
                id="blog-{{ $blog->id }}">
                <div class="flex flex-col items-stretch justify-center p-6 sm:flex-row">
                    <div class="basis-1/3 relative text-center min-h-fit">
                        <img class="block relative w-full h-full rounded-xl  object-cover shadow-md hover:shadow-sm sm:absolute sm:top-0 sm:left-0 "
                            src="https://picsum.photos/400/300" alt="">
                    </div>
                    <div class="basis-2/3 mt-2 relative leading-normal sm:mt-0 sm:px-4">
                        <div class="mb-1">
                            <span class="text-sm">
                                {{ nice_number($blog->bloglikes->where('status', 1)->count()) }} likes
                            </span>
                            <span class="text-sm">
                                {{ nice_number($blog->blogviews->count()) }} views
                            </span>
                        </div>
                        @guest

                            <span class="absolute top-0 right-0 bookmark" title="Bookmark this Article">
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
                                    <button type="submit" class="absolute top-0 right-0 bookmark  e-rbtn">
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

                        <a href="/blogs/{{ Str::slug($blog->title, '-') }}-{{ $blog->id }}"
                            class="link link-secondary">
                            <h5 class="mb-2 text-2xl font-bold line-clamp-3 tracking-tight text-gray-900 dark:text-white">
                                {{ $blog->title }}
                            </h5>
                        </a>
                        <p class="font-normal line-clamp-3 text-gray-700 dark:text-gray-400 sm:hidden">
                            {!! Str::words(strip_tags($blog->description), 50) !!}
                        </p>
                        @foreach ($blog->tags as $tag)
                            <a href="/blogs/tagged/{{ $tag->title }}" class="tag-popover"
                                id="tag{{ $blog->id }}-{{ $tag->id }}">
                                <span class="modern-badge  modern-badge-{{ $tag->color }}">
                                    #{{ $tag->title }}
                                </span>
                            </a>
                        @endforeach
                        <p class="mt-3">
                            <span>By </span>
                            <a class="text-sm font-medium text-gray-900 truncate dark:text-white user-popover"
                                href="/users/{{ $blog->user->username }}"
                                id="user{{ $blog->id }}-{{ $blog->user_id }}">
                                {{ __($blog->user->username) }}
                            </a>
                            <span class="text-sm">posted 3 weeks ago</span>
                        </p>
                        <a class="e-btn e-btn-dark e-btn-lg mt-5 w-full sm:hidden"
                            href="/blogs/{{ Str::slug($blog->title, '-') }}-{{ $blog->id }}">
                            Read
                            Article
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
        {!! $blogs->withQueryString()->links('pagination::tailwind') !!}
    </div>
@endsection
@section('content-right')
    <article>
        <div class="form-group mb-4 ">
            <button
                class="space-x-2 flex w-full justify-start items-center font-semibold whitespace-nowrap select-none mx-[2px] my-[1px]  p-3 text-sm rounded-lg text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200  dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700"
                type="button" data-modal-toggle="searchModal">
                @svg('heroicon-o-search', 'flex-none')
                <span class="flex-1 text-left">search </span>
                <span class="flex-none hidden sm:block">
                    <kbd
                        class="px-2 py-1.5 text-xs font-semibold text-gray-800 bg-gray-100 border border-gray-200 rounded-lg dark:bg-gray-600 dark:text-gray-100 dark:border-gray-500">
                        Ctrl</kbd>
                    +
                    <kbd
                        class="px-2 py-1.5 text-xs font-semibold text-gray-800 bg-gray-100 border border-gray-200 rounded-lg dark:bg-gray-600 dark:text-gray-100 dark:border-gray-500">
                        K</kbd>
                </span>
            </button>
        </div>

        @if ($topUsers->count() > 3)
            <div
                class="relative mt-3 w-full  text-base text-left  border  border-gray-200 rounded-xl font-normal   hover:shadow-md dark:border-gray-700 dark:bg-gray-800 ">
                <header class="py-3 px-4 text-2xl font-semibold text-gray-700 dark:text-white">
                    <h3> Top Users</h3>
                </header>
                <ul class="p-0 list-none">
                    @foreach ($topUsers as $topUser)
                        <li
                            class="border-t py-3 px-4 last:rounded-b-xl border-gray-200 text-gray-700 dark:text-gray-400 dark:hover:text-white dark:border-gray-700 hover:bg-gray-100 hover:shadow-md dark:bg-gray-800 dark:hover:bg-gray-700">
                            <a href="/users/{{ $topUser->username }}" class="flex items-center space-x-4 user-popover"
                                id="user-1" id="user-{{ $topUser->id }}" data-popover-placement="left">
                                <img class="w-12 h-12 rounded-full"
                                    src="{{ asset($topUser->profile_image ?? 'images/1654760695anime3.png') }}"
                                    alt="">
                                <div class="space-y-1 font-medium ">
                                    <div>{{ $topUser->username }}</div>
                                </div>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div
            class="relative mt-3 w-full  text-base text-left  border  border-gray-200 rounded-xl font-normal   hover:shadow-md dark:border-gray-700 dark:bg-gray-800 ">
            <header class="py-3 px-4 text-2xl font-semibold text-gray-700 dark:text-white">
                <span class="modern-badge modern-badge-danger">#Advertisment</span>
            </header>
            <div
                class="border-t py-3 px-4 last:rounded-b-xl border-gray-200 text-gray-700 dark:text-gray-400 dark:hover:text-white dark:border-gray-700 hover:bg-gray-100 hover:shadow-md dark:bg-gray-800 dark:hover:bg-gray-700">

                <img src="https://picsum.photos/1200/1000" alt="">
            </div>
        </div>

        <div
            class="relative mt-3 w-full  text-base text-left  border  border-gray-200 rounded-xl font-normal   hover:shadow-md dark:border-gray-700 dark:bg-gray-800 ">
            <header class="py-3 px-4 text-2xl font-semibold text-gray-700 dark:text-white">
                <span class="modern-badge modern-badge-danger">Top Tags</span>
            </header>
            <div
                class="border-t py-3 px-4 last:rounded-b-xl border-gray-200 text-gray-700 dark:text-gray-400 dark:hover:text-white dark:border-gray-700 hover:bg-gray-100 hover:shadow-md dark:bg-gray-800 dark:hover:bg-gray-700">

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
