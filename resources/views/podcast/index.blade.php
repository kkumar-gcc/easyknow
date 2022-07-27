@extends('layouts.podcast', ['pageDirection' => 'flex-col'])

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
            <section class="d-flex justify-content-center my-4 w-100">
                <div class="container">
                    <div class="alert alert-dismissible fade show alert-success" role="alert" data-mdb-color="warning"
                        id="customxD">
                        <strong>Success!</strong> {{ session()->get('deleteSuccess') }}
                        <button type="button" class="btn-close" data-mdb-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            </section>
        @endif

        {{-- <nav class="tabs">
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
        </nav> --}}
        @auth
            <a class="e-btn e-btn-success" href="/podcast/create">create podcast series</a>

        @endauth
        @foreach ($podcasts as $podcast)
            <div class="relative mt-3 w-full p-2.5 text-base text-left  border border-transparent rounded-3xl font-normal text-gray-700 dark:text-gray-400 hover:bg-gray-100 hover:shadow-md dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700"
                id="podcast-{{ $podcast->id }}">
                <div class="flex flex-col items-stretch justify-center p-6 sm:flex-row">
                    <div class="basis-1/3 relative text-center min-h-fit">
                        <img class="block relative w-full h-full rounded-xl  object-cover shadow-md hover:shadow-sm sm:absolute sm:top-0 sm:left-0 "
                            src="https://picsum.photos/400/300" alt="">
                    </div>
                    <div class="basis-2/3 mt-2 relative leading-normal sm:mt-0 sm:px-4">
                        <a href="/podcasts/{{ $podcast->id }}" class="link link-secondary">
                            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                                {{ $podcast->title }}
                            </h5>
                        </a>
                        <p class="font-normal text-gray-700 dark:text-gray-400">
                            {!! Str::words(strip_tags($podcast->description), 20) !!}
                        </p>

                        <p class="mt-3">
                            <span>By </span>
                            <a class="text-sm font-medium text-gray-900 truncate dark:text-white user-popover" h
                                href="/users/{{ $podcast->user->username }}"
                                id="user{{ $podcast->id }}-{{ $podcast->user_id }}">
                                {{ __($podcast->user->username) }}
                            </a>
                            <span class="text-sm">| TOTAL EP {{ $podcast->episodes->count() }}</span>
                        </p>
                        <a class="e-btn e-btn-dark e-btn-lg mt-5 w-full sm:hidden" href="/podcasts/{{ $podcast->id }}">
                            Read
                            Article
                        </a>
                    </div>
                </div>
            </div>
        @endforeach

        {!! $podcasts->withQueryString()->onEachSide(3)->links('pagination::tailwind') !!}
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
