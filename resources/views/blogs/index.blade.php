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

    <div class="w-full px-2 md:px-12  my-4 mx-auto  relative">
        <div id="toast-info">


        </div>
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
       
        <div class="tabs mb-4  mt-4 dark:border-gray-700 overflow-y-hidden">
            <ul class="flex flex-nowrap  whitespace-nowrap  -mb-px text-sm font-medium text-center -primary " role="tablist">
                <li class="mr-2" role="presentation">
                    <a class="inline-block p-4 rounded-t-lg border-b-4  {{ $tab == 'newest' ? 'text-rose-600  dark:text-rose-500  border-rose-600 dark:border-rose-500' : 'hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300 dark:border-transparent text-gray-500 dark:text-gray-400 border-gray-100 dark:border-gray-700' }}"
                        href="/blogs?tab=newest" role="tab">Newest</a>
                </li>
                <li class="mr-2" role="presentation">
                    <a class="inline-block p-4 rounded-t-lg border-b-4 {{ $tab == 'likes' ? 'text-rose-600  dark:text-rose-500  border-rose-600 dark:border-rose-500' : 'hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300 dark:border-transparent text-gray-500 dark:text-gray-400 border-gray-100 dark:border-gray-600' }}"
                        href="/blogs?tab=likes" role="tab">Most Liked</a>
                </li>
                <li class="mr-2" role="presentation">
                    <a class="inline-block p-4 rounded-t-lg border-b-4  {{ $tab == 'views' ? 'text-rose-600  dark:text-rose-500  border-rose-600 dark:border-rose-500' : 'hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300 dark:border-transparent text-gray-500 dark:text-gray-400 border-gray-100 dark:border-gray-700' }}"
                        href="/blogs?tab=views" role="tab">Top Viewed</a>
                </li>
            </ul>
        </div>
        
        @foreach ($blogs as $blog)
            <div class="relative mt-3 w-full p-2.5 text-base text-left  border border-transparent rounded-3xl font-normal hover:bg-gray-50 hover:border-gray-200 hover:shadow-md dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700"
                id="blog-{{ $blog->id }}">
                <div class="flex flex-col items-stretch justify-center p-6 sm:flex-row">
                    <div class="basis-1/3 relative text-center min-h-fit {{ $blog->adult_warning ? 'prose prose-img:blur-lg' : '' }}">
                        <img class="block relative w-full h-full rounded-xl  object-cover shadow-md hover:shadow-sm sm:absolute sm:top-0 sm:left-0 "
                            src="https://imagekit.io/blog/content/images/2020/06/Server_User.png" alt="">
                    </div>
                    <div class="basis-2/3 mt-2 relative leading-normal sm:mt-0 sm:px-4">
                        <div class="flex flex-row mt-3 mb-1 md:mt-0">
                            <div class="flex-1 flex flex-row items-center">
                                <div class="mr-2 text-sm">
                                    {{ nice_number($blog->bloglikes->where('status', 1)->count()) }} <span>likes</span>
                                </div>
                                <div class="mr-2 text-sm">
                                    {{ nice_number($blog->blogviews->count()) }} <span>views</span>
                                </div>
                            </div>
                            <div>
                                @guest

                                    <button type="button"
                                        class="flex flex-row items-center mr-1 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-2"
                                        data-modal-toggle="loginMessageModal">
                                        <span title="Bookmark this Article">
                                            @svg('gmdi-bookmark-add-o', 'h-5 w-5') </span>
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
                                            <button type="submit"
                                                class="flex flex-row items-center mr-1 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-2"
                                                >
                                                <span class="bookmark_btn_{{ $blog->id }}"
                                                    id="bookmark_btn_{{ $blog->id }}" title="Bookmark this Article">
                                                    @if ($blog->isBookmarked())
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

                        <a href="/blogs/{{ Str::slug($blog->title, '-') }}-{{ $blog->id }}"
                            class="link link-secondary">
                            <h5 class="mb-2 text-2xl font-bold line-clamp-3 tracking-tight text-gray-900  dark:text-white ">
                                {{ $blog->title }}
                            </h5>
                        </a>
                        
                        @foreach ($blog->tags as $tag)
                             <a href="/blogs/tagged/{{ $tag->title }}" class="tag-popover"
                                id="tag{{ $blog->id }}-{{ $tag->id }}">
                                
                                <span class="modern-badge  modern-badge-{{ $tag->color }}">
                                    #{{ $tag->title }}
                                </span>
                            </a>
                        @endforeach
                        <p class="mt-3">
                            <span class="mr-1">by </span>
                            <a class="text-sm font-medium text-gray-900 truncate dark:text-white user-popover"
                                href="/users/{{ $blog->user->username }}"
                                id="user{{ $blog->id }}-{{ $blog->user_id }}">
                                {{ __($blog->user->username) }}
                            </a>
                            <span class="ml-1 text-sm">posted 3 weeks ago</span>
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
    <article id="sticky-sidebar" class="">
        
        @if ($topUsers->count() > 3)
            <div
                class="relative mt-3 w-full  text-base text-left  border  border-gray-200 rounded-xl font-normal   hover:shadow-md dark:border-gray-700 dark:bg-gray-800 ">
                <header class="py-3 px-4 text-2xl font-semibold text-gray-700 dark:text-white">
                    <h3> Top Users</h3>
                </header>
                <ul class="p-0 list-none">
                    @foreach ($topUsers as $topUser)
                        <li
                            class="border-t py-3 px-4 last:rounded-b-xl border-gray-200 dark:hover:text-white dark:border-gray-700 hover:bg-gray-50 hover:shadow-sm dark:bg-gray-800 dark:hover:bg-gray-700">
                            <a href="/users/{{ $topUser->username }}" class="flex items-center space-x-4 user-popover"
                                id="user-1" id="user-{{ $topUser->id }}" data-popover-placement="left">
                                <img class="w-12 h-12 rounded-full"
                                    src="{{ asset($topUser->profile_image) }}" onerror="this.onerror=null;this.src=`https://avatars.dicebear.com/api/bottts/:{{ $topUser->username }}.svg`"
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
                class="border-t py-3 px-4 last:rounded-b-xl border-gray-200 dark:hover:text-white dark:border-gray-700 hover:bg-gray-100 hover:shadow-md dark:bg-gray-800 dark:hover:bg-gray-700">

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
