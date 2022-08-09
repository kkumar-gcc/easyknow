@extends('layouts.blog')
@push('styles')
    <x-head.tinymce-config />
@endpush
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
    <main
        class="relative prose max-w-none lg:max-w-full xl:max-w-none prose-img:rounded-xl dark:prose-invert prose-a:text-rose-600 dark:prose-a:text-rose-500">
        <div id="toast-info">

        </div>
        <section>
            <div class="not-prose relative mt-3 w-full p-2.5 text-base text-left font-normal  border border-gray-200 rounded-xl hover:shadow-md dark:border-gray-700 dark:bg-gray-800 "
                id="blog-{{ $blog->id }}">
                <div class="flex flex-col items-stretch justify-center p-6 sm:flex-row">
                    <div class="relative text-center basis-1/3 min-h-fit">
                        <img class="relative block object-cover w-full h-full shadow-md rounded-xl hover:shadow-sm sm:absolute sm:top-0 sm:left-0 "
                            src="https://picsum.photos/400/300" alt="">
                    </div>
                    <div class="relative mt-2 leading-normal basis-2/3 sm:mt-0 sm:px-4">
                        <div class="flex flex-row mt-3 mb-1 md:mt-0">
                            <div class="flex flex-row items-center flex-1">
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
                                        class="flex flex-row items-center p-2 mr-1 text-sm rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:focus:ring-gray-700"
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
                                                class="flex flex-row items-center p-2 mr-1 text-sm rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:focus:ring-gray-700">
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
                            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 line-clamp-3 dark:text-white ">
                                {{ $blog->title }}
                            </h5>
                        </a>
                        <p class="font-normal line-clamp-3 sm:hidden">
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
                            <span class="mr-1">by </span>
                            <a class="text-sm font-medium text-gray-900 truncate dark:text-white user-popover"
                                href="/users/{{ $blog->user->username }}"
                                id="user{{ $blog->id }}-{{ $blog->user_id }}">
                                {{ __($blog->user->username) }}
                            </a>
                            <span class="ml-1 text-sm">posted 3 weeks ago</span>
                        </p>
                        <a class="w-full mt-5 e-btn e-btn-dark e-btn-lg sm:hidden"
                            href="/blogs/{{ Str::slug($blog->title, '-') }}-{{ $blog->id }}">
                            Read
                            Article
                        </a>
                    </div>
                </div>
            </div>
        </section>
        <div class="relative flex flex-col w-full mt-3 lg:flex-row ">
            <aside class="basis-1/4 not-prose" aria-label="Sidebar">
                <div id="sticky-sidebar" class="hidden py-4 overflow-y-auto rounded lg:block">
                    <ul class="space-y-2">
                        <li>
                            <a href="/blogs/manage/{{ Str::slug($blog->title, '-') }}-{{ $blog->id }}#general"
                                class="flex items-center p-2 text-base font-normal text-gray-900 rounded-lg dark:text-white }} hover:bg-gray-100 dark:hover:bg-gray-700">
                                <span class="ml-3">General</span>
                            </a>
                        </li>
                        <li>
                            <a href="/blogs/edit/{{ Str::slug($blog->title, '-') }}-{{ $blog->id }}"
                                class="flex items-center p-2 text-base font-normal text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
                                <span class="flex-1 ml-3 whitespace-nowrap">Edit</span>
                            </a>
                        </li>
                        <li>
                            <a href="/blogs/manage/{{ Str::slug($blog->title, '-') }}-{{ $blog->id }}"
                                class="flex items-center p-2 text-base font-normal text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
                                <span class="flex-1 ml-3 whitespace-nowrap">Manage</span>
                            </a>
                        </li>

                        <li>
                            <a href="/blogs/manage/{{ Str::slug($blog->title, '-') }}-{{ $blog->id }}#seo-settings"
                                class="flex items-center p-2 text-base font-normal text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
                                <span class="flex-1 ml-3 whitespace-nowrap">Seo Settings</span>
                            </a>
                        </li>
                    </ul>
                    <ul class="pt-4 mt-4 space-y-2 border-t border-gray-200 dark:border-gray-700">
                        <li>
                            <a href="/blogs/manage/{{ Str::slug($blog->title, '-') }}-{{ $blog->id }}#delete"
                                class="flex items-center p-2 text-base font-normal transition duration-75 rounded-lg text-rose-600 hover:bg-gray-100 dark:hover:bg-gray-700 dark:text-white group">
                                <span class="ml-4">Delete Blog</span>
                            </a>
                        </li>

                    </ul>
                </div>
            </aside>

            <div class="flex-1 py-4 my-2 basis-3/4 lg:pl-8 not-prose">
                <div id="loading"></div>
                <section id="delete">
                    <div
                        class="relative w-full mt-5 text-base font-normal text-left border rounded-xl hover:shadow-md dark:bg-gray-800 ">
                        <header class="px-5 py-4 text-2xl font-semibold text-gray-700 dark:text-white">
                            <h3>Blog Stats</h3>
                        </header>
                        <div
                            class="px-5 py-4 border-t border-gray-200 last:rounded-b-xl dark:hover:text-white dark:border-gray-700 hover:shadow-md dark:bg-gray-800 dark:hover:bg-gray-700">

                            <div role="status" class="max-w-sm animate-pulse">
                                <div class="h-2.5 bg-gray-200 rounded-full dark:bg-gray-700 w-48 mb-4"></div>
                                <div class="h-2 bg-gray-200 rounded-full dark:bg-gray-700 max-w-[360px] mb-2.5"></div>
                                <div class="h-2 bg-gray-200 rounded-full dark:bg-gray-700 mb-2.5"></div>
                                <div class="h-2 bg-gray-200 rounded-full dark:bg-gray-700 max-w-[330px] mb-2.5"></div>
                                <div class="h-2 bg-gray-200 rounded-full dark:bg-gray-700 max-w-[300px] mb-2.5"></div>
                                <div class="h-2 bg-gray-200 rounded-full dark:bg-gray-700 max-w-[360px]"></div>
                                <span class="sr-only">coming soon ......</span>
                            </div>
                        </div>
                    </div>
                </section>

            </div>
        </div>
    </main>
@endsection
@push('scripts')
    @include('ajax')
@endpush
