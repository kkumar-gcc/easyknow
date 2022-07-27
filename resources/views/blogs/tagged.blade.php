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
    Str::macro('readDuration', function (...$text) {
        $totalWords = str_word_count(implode(' ', $text));
        $minutesToRead = round($totalWords / 200);
    
        return (int) max(1, $minutesToRead);
    });
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

        <div class="relative mt-2 w-full p-2.5 text-base text-left  border border-transparent rounded-3xl font-normal text-gray-700 dark:text-gray-400 hover:bg-gray-100 shadow dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">
            <div class="flex flex-col items-stretch justify-center p-6">
                <a href="/blogs/tagged/{{ $searchTag->title }}" class="tag-popover" id="tag-{{ $searchTag->id }}"><span
                        class="modern-badge  modern-badge-{{ $searchTag->color }}">
                        #{{ $searchTag->title }}
                    </span>
                </a>
                <p class="mt-3 mb-3">Some quick example text to build on the card title and make up the
                    bulk of
                    the card's content.</p>
            </div>
        </div>

        <div class="mb-4  mt-4 border-b border-gray-200 dark:border-gray-700">
            <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" role="tablist">
                <li class="mr-2" role="presentation">
                    <a class="inline-block p-4 rounded-t-lg border-b-2  {{ $tab == 'newest' ? 'text-green-600 hover:text-green-600 dark:text-green-500 dark:hover:text-green-500 border-green-600 dark:border-green-500' : 'hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300 dark:border-transparent text-gray-500 dark:text-gray-400 border-gray-100 dark:border-gray-700' }}"
                        href="/blogs/tagged/{{ $searchTag->title }}?tab=newest" role="tab">Newest</a>
                </li>
                <li class="mr-2" role="presentation">
                    <a class="inline-block p-4 rounded-t-lg border-b-2  {{ $tab == 'likes' ? 'text-green-600 hover:text-green-600 dark:text-green-500 dark:hover:text-green-500 border-green-600 dark:border-green-500' : 'hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300 dark:border-transparent text-gray-500 dark:text-gray-400 border-gray-100 dark:border-gray-700' }}"
                        href="/blogs/tagged/{{ $searchTag->title }}?tab=likes" role="tab">Most Liked</a>
                </li>
                <li class="mr-2" role="presentation">
                    <a class="inline-block p-4 rounded-t-lg border-b-2  {{ $tab == 'views' ? 'text-green-600 hover:text-green-600 dark:text-green-500 dark:hover:text-green-500 border-green-600 dark:border-green-500' : 'hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300 dark:border-transparent text-gray-500 dark:text-gray-400 border-gray-100 dark:border-gray-700' }}"
                        href="/blogs/tagged/{{ $searchTag->title }}?tab=views" role="tab">Top Viewed</a>
                </li>
            </ul>
        </div>

        @if ($blogs->count() > 0)
            @foreach ($blogs as $blog)
                <div class="relative mt-2 w-full p-2.5 text-base text-left  border border-transparent rounded-3xl font-normal text-gray-700 dark:text-gray-400 hover:bg-gray-100 hover:shadow-md dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700"
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
                                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                                    {{ $blog->title }}
                                </h5>
                            </a>
                            <p class="font-normal text-gray-700 dark:text-gray-400 sm:hidden">
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

            {!! $blogs->withQueryString()->onEachSide(3)->links('pagination::tailwind') !!}
        @else
            <div class="e-card e-card-hover ">
                <div class="card-body text-center">
                    There is no blog related to <a href="/blogs/tagged/{{ $searchTag->title }}" class="tag-popover"
                        id="tagError-{{ $searchTag->id }}"><span
                            class="modern-badge  modern-badge-{{ $searchTag->color }}">
                            #{{ $searchTag->title }} </a>. Please try our <a href="/tags?tab=popular">popular tags</a>.
                    </span>
                    </a>
                </div>
            </div>
        @endif
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
        <div class="e-vcard">
            <div class="e-vcard-title">
                <h3>Top Blogs</h3>
            </div>
            <ul class="e-vcard-list">
                @foreach ($topBlogs as $topBlog)
                    <li>
                        <a href="/blogs/{{ Str::slug($topBlog->title, '-') }}-{{ $topBlog->id }}" class="blog-popover"
                            id="topBlog-{{ $topBlog->id }}">
                            <h5 class="f-16">{{ $topBlog->title }}</h5>
                        </a>
                        <div class="item-time f-13 text-muted">
                            <time datetime="{{ $topBlog->created_at }}">
                                {{ \Carbon\Carbon::parse($topBlog->created_at)->format('M d, Y') }}
                            </time>
                            ∙ {{ Str::readDuration($topBlog->description) }} mins read
                        </div>

                    </li>
                @endforeach
            </ul>
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
