@extends('layouts.blog2')

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

        <div class="mt-4">
            <h1 class="inline-block mb-2 text-4xl font-extrabold tracking-tight text-gray-900 dark:text-white"> Search results for "{!! Str::words($query, 4) !!}"</h1>
        </div>
        <div class="tabs mb-4 mt-4 border-b border-gray-200 dark:border-gray-700">
            <ul class="flex flex-wrap -mb-px text-sm font-medium text-center -primary" role="tablist">
                <li class="mr-2" role="presentation">
                    <a class="inline-block p-4 rounded-t-lg border-b-2  {{ $tab == 'blogs' ? 'text-green-600 hover:text-green-600 dark:text-green-500 dark:hover:text-green-500 border-green-600 dark:border-green-500' : 'hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300 dark:border-transparent text-gray-500 dark:text-gray-400 border-gray-100 dark:border-gray-700' }}"
                        href="/search/blogs?query={{ $query }}" role="tab">Blogs</a>
                </li>
                <li class="mr-2" role="presentation">
                    <a class="inline-block p-4 rounded-t-lg border-b-2  {{ $tab == 'users' ? 'text-green-600 hover:text-green-600 dark:text-green-500 dark:hover:text-green-500 border-green-600 dark:border-green-500' : 'hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300 dark:border-transparent text-gray-500 dark:text-gray-400 border-gray-100 dark:border-gray-700' }}"
                        href="/search/users?query={{ $query }}" role="tab">Users</a>
                </li>
                <li class="mr-2" role="presentation">
                    <a class="inline-block p-4 rounded-t-lg border-b-2  {{ $tab == 'tags' ? 'text-green-600 hover:text-green-600 dark:text-green-500 dark:hover:text-green-500 border-green-600 dark:border-green-500' : 'hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300 dark:border-transparent text-gray-500 dark:text-gray-400 border-gray-100 dark:border-gray-700' }}"
                        href="/search/tags?query={{ $query }}" role="tab">Tags</a>
                </li>
            </ul>
        </div>
        @if ($tab == 'blogs')
            @include('search.blogs', ['blogs' => $blogs])
        @elseif($tab == 'users')
            @include('search.users', ['users' => $users])
        @elseif($tab == 'tags')
            @include('search.tags', ['tags' => $tags])
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
            <ul class="e-vcard-list ">
                @foreach ($topBlogs as $topBlog)
                    <li>

                      <a href="/blogs/{{ Str::slug($topBlog->title, '-') }}-{{ $topBlog->id }}" class="blog-popover"
                        id="topBlog-{{ $topBlog->id }}"><h5 class="f-16">{{ $topBlog->title }}</h5></a>
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
                                    <a href="/users/{{ $topUser->username }}"
                                        class="user-popover" id="user-{{ $topUser->id }}">
                                        <img class="user-img"
                                            src="{{ asset($topUser->profile_image ?? 'images/1654760695anime3.png') }}"
                                            alt="">
                                    </a>
                                </div>
                                <div class="user-detail">
                                    <a href="/users/{{ $topUser->username }}"
                                        class="user-popover" id="userdetail-{{ $topUser->id }}">
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

        });
    </script>
@endpush
