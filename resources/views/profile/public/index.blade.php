@extends('layouts.base')
@section('content-left')
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

    {{-- <article >
        <div
            class="w-full text-base text-left  border  border-gray-200 rounded-xl font-normal  dark:border-gray-700 dark:bg-gray-800 ">
            <header class="py-3 px-4 text-2xl font-semibold text-gray-700 dark:text-white">
                <h3>Social Links</h3>
            </header>
            <div class="py-3 px-4 rounded-xl   dark:bg-gray-800 ">
                <div class="social-wrap">
                    @if ($user->twitter_url)
                        <a class="social-link link-icon-twitter" href="{{ $user->twitter_url }}">
                            {{ svg('bi-twitter') }}
                        </a>
                    @endif
                    @if ($user->facebook_url)
                        <a class="social-link link-icon-facebook" href="{{ $user->facebook_url }}">
                            {{ svg('bi-facebook') }}
                        </a>
                    @endif
                    @if ($user->linkedin_url)
                        <a class="social-link link-icon-linkedin" href="{{ $user->linkedin_url }}">
                            {{ svg('bi-linkedin') }}
                        </a>
                    @endif
                    @if ($user->stackoverflow_url)
                        <a class="social-link" href="{{ $user->stackoverflow_url }}">
                            <img src="{{ asset('images/stackoverflow-color.svg') }}" style="width: 18px;height:18px">
                        </a>
                    @endif
                    @if ($user->reddit_url)
                        <a class="social-link link-icon-reddit" href="{{ $user->reddit_url }}">
                            {{ svg('bi-reddit') }}
                        </a>
                    @endif
                    @if ($user->instagram_url)
                        <a class="social-link link-icon-instagram" href="{{ $user->instagram_url }}">
                            {{ svg('bi-instagram') }}
                        </a>
                    @endif
                    @if ($user->youtube_url)
                        <a class="social-link link-icon-youtube" href="{{ $user->youtube_url }}">
                            {{ svg('bi-youtube') }}
                        </a>
                    @endif
                    @if ($user->quora_url)
                        <a class="social-link link-icon-quora" href="{{ $user->quora_url }}">
                            {{ svg('bi-quora') }}
                        </a>
                    @endif
                    @if ($user->laracasts_url)
                        <a class="social-link " href="{{ $user->laracasts_url }}">
                            <img src="{{ asset('images/laracasts-original.svg') }}" style="width: 18px;height:18px">
                        </a>
                    @endif
                    @if ($user->github_url)
                        <a class="social-link link-icon-github" href="{{ $user->github_url }}">
                            {{ svg('bi-github') }}
                        </a>
                    @endif
                    @if ($user->medium_url)
                        <a class="social-link link-icon-medium" href="{{ $user->medium_url }}">
                            {{ svg('bi-medium') }}
                        </a>
                    @endif
                    @if ($user->codepen_url)
                        <a class="social-link link-icon-codepen" href="{{ $user->codepen_url }}">
                            {{ svg('feathericon-codepen') }}
                        </a>
                    @endif
                </div>
                @auth
                    @if ($user->id == auth()->id())
                        <a href="/settings?tab=social_links">Edit social links</a>
                    @endif
                @endauth
            </div>
        </div>
        <div
            class="relative mt-3 w-full  text-base text-left  border  border-gray-200 rounded-xl font-normal   hover:shadow-md dark:border-gray-700 dark:bg-gray-800 ">
            <header class="py-3 px-4 text-2xl font-semibold text-gray-700 dark:text-white">
                <h3> Personal Info</h3>
            </header>
            <ul class="p-0 list-none">
                <li
                    class="border-t py-3 px-4 last:rounded-b-xl border-gray-200  dark:hover:text-white dark:border-gray-700 hover:bg-gray-100 hover:shadow-md dark:bg-gray-800 dark:hover:bg-gray-700">

                    <div class="flex flex-row">
                        {{ svg('uni-bag-alt-o') }}
                        <span class="ml-2">UI Manager / CSS Aficionado</span>
                    </div>
                </li>
                <li
                    class="border-t py-3 px-4 last:rounded-b-xl border-gray-200  dark:hover:text-white dark:border-gray-700 hover:bg-gray-100 hover:shadow-md dark:bg-gray-800 dark:hover:bg-gray-700">

                    <div class="flex flex-row">
                        {{ svg('zondicon-location') }}
                        <span class="ml-2">kanpur</span>
                    </div>
                </li>
                <li
                    class="border-t py-3 px-4 last:rounded-b-xl border-gray-200  dark:hover:text-white dark:border-gray-700 hover:bg-gray-100 hover:shadow-md dark:bg-gray-800 dark:hover:bg-gray-700">

                    <div class="flex flex-row">
                        {{ svg('heroicon-s-cake') }}
                        <span class="ml-2">Member Since
                            {{ \Carbon\Carbon::parse($user->created_at)->format('M , Y') }}</span>
                    </div>
                </li>
            </ul>
        </div>
        <div
            class="relative mt-3 w-full  text-base text-left  border  border-gray-200 rounded-xl font-normal   hover:shadow-md dark:border-gray-700 dark:bg-gray-800 ">
            <header class="py-3 px-4 text-2xl font-semibold text-gray-700 dark:text-white">
                <span class="modern-badge modern-badge-danger">#Advertisment</span>
            </header>
            <div
                class="border-t py-3 px-4 last:rounded-b-xl border-gray-200  dark:hover:text-white dark:border-gray-700 hover:bg-gray-100 hover:shadow-md dark:bg-gray-800 dark:hover:bg-gray-700">

                <img src="https://picsum.photos/1200/1000" alt="">
            </div>
        </div>

    </article> --}}
@endsection
@section('content')
    <main class="md:p-5 lg:p-7">
        <div id="toast-info"></div>
        <section class="p-2 w-full">
            <header class="border border-gray-200 dark:border-gray-700 rounded-lg bg-white dark:bg-gray-800">
                <div class="relative  pt-[60%] rounded-lg sm:pt-[30%] md:pt-[22%] ">
                    <img class="absolute m-0 top-0 left-0 right-0 bottom-0 w-full h-full object-fit rounded-t-lg  bg-white dark:bg-gray-800"
                        src="{{ asset($user->background_image) ?? 'https://picsum.photos/400/300' }}" alt="" />
                </div>
                <div class="my-4 flex flex-col md:flex-row px-6">
                    <div class="basis-1/3 mb-4 w-full md:w-1/3 flex items-start justify-center relative">
                        <img class="-mt-24 z-10 w-40 h-40 rounded-full ring-8 ring-white dark:ring-gray-500"
                            src="{{ $user->avatarurl() }}"  alt="Bordered avatar">
                    </div>
                    <div class="basis-2/3 mb-4 flex flex-col md:flex-row items-center justify-center md:items-start">
                        <div class="flex-1">
                            <div class="font-medium text-center md:text-left ">
                                <div class="text-2xl text-gray-700 dark:text-white">{{ $user->username }}</div>
                                <div class="text-sm ">Joined in
                                    {{ \Carbon\Carbon::parse($user->created_at)->format('F  Y') }}</div>
                            </div>
                        </div>
                        <div class="mt-3 ">
                            @guest
                                <button type="button"
                                    class="w-full inline-flex justify-center items-center font-medium rounded-lg text-sm px-5 py-2.5 text-center no-underline mx-1.5 cursor-pointer whitespace-nowrap text-white bg-gradient-to-br from-rose-600 to-pink-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-rose-300 dark:focus:ring-rose-800"
                                    data-modal-toggle="loginMessageModal">
                                    {{ svg('bi-person-plus-fill', 'mr-2 -ml-1 w-5 h-5') }}
                                    {{ __('Follow') }}
                                </button>
                            @else
                                @if (auth()->user()->id == $user->id)
                                    <a class="w-full inline-flex justify-center items-center font-medium rounded-lg text-sm px-5 py-2.5 text-center no-underline cursor-pointer whitespace-nowrap text-white bg-gradient-to-br from-rose-600 to-pink-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-rose-300 dark:focus:ring-rose-800"
                                        href="/settings">
                                        {{ svg('coolicon-edit', 'mr-2 -ml-1 w-5 h-5') }}
                                        {{ __('Edit Profile') }}
                                    </a>
                                @else
                                    {{-- @if ($blog->user->isFollower()) --}}
                                    <form method="post" id="follow-{{ $user->id }}" class="follow">
                                        @csrf
                                        @method('put')
                                        <input type="hidden" name="follower_id" id="follower_id"
                                            value="{{ auth()->user()->id }}">
                                        <input type="hidden" name="user_id" id="user_id" value="{{ $user->id }}">
                                        @if ($user->isFollowing())
                                            <button type="submit"
                                                class="follow_button_{{ $user->id }} w-full inline-flex justify-center items-center font-medium rounded-lg text-sm px-5 py-2.5 text-center no-underline cursor-pointer whitespace-nowrap text-white bg-gradient-to-br from-rose-600 to-pink-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-rose-300 dark:focus:ring-rose-800">
                                                {{ svg('bi-person-check-fill', 'mr-2 -ml-1 w-5 h-5') }}
                                                {{ __('Following') }}
                                            </button>
                                        @else
                                            <button type="submit"
                                                class="follow_button_{{ $user->id }} w-full inline-flex justify-center items-center font-medium rounded-lg text-sm px-5 py-2.5 text-center no-underline  cursor-pointer whitespace-nowrap text-white bg-gradient-to-br from-rose-600 to-pink-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-rose-300 dark:focus:ring-rose-800">
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
            </header>
            <div class="mb-4  mt-4 overflow-y-hidden">
                <ul class="flex flex-nowrap  whitespace-nowrap  -mb-px text-sm font-medium text-center" role="tablist">
                    <li class="mr-2" role="presentation">
                        <a class="inline-block p-4 rounded-t-lg border-b-4  {{ $tab == 'about' ? 'text-rose-600 dark:text-rose-500  border-rose-600 dark:border-rose-500' : 'hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300  text-gray-500 dark:text-gray-400 border-gray-100 dark:border-gray-700 dark:hover:border-gray-300' }}"
                            href="/users/{{ $user->username }}?tab=about#details" role="tab">About Me</a>
                    </li>
                    <li class="mr-2" role="presentation">
                        <a class="inline-block p-4 rounded-t-lg border-b-4  {{ $tab == 'blogs' ? 'text-rose-600  dark:text-rose-500  border-rose-600 dark:border-rose-500' : 'hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300 text-gray-500 dark:text-gray-400 border-gray-100 dark:border-gray-700 dark:hover:border-gray-300' }}"
                            href="/users/{{ $user->username }}?tab=blogs#details" role="tab">Blogs
                            <span>({{ nice_number($user->blogs->where('status', '=', 'posted')->count()) }})</span></a>
                    </li>
                    <li class="mr-2" role="presentation">
                        <a class="inline-block p-4 rounded-t-lg border-b-4  {{ $tab == 'bookmarks' ? 'text-rose-600 dark:text-rose-500  border-rose-600 dark:border-rose-500' : 'hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300 text-gray-500 dark:text-gray-400 border-gray-100 dark:border-gray-700 dark:hover:border-gray-300' }}"
                            href="/users/{{ $user->username }}?tab=bookmarks#details" role="tab">Bookmarks
                            <span>({{ nice_number($user->bookmarks->count()) }})</span></a>
                    </li>
                </ul>
            </div>
            <div class="my-4">
                @if ($tab == 'about')
                    @include('profile.public.partials.aboutTab', ['user' => $user])
                @elseif($tab == 'blogs')
                    @include('profile.public.partials.blogTab', ['pins' => $pins, 'blogs' => $blogs])
                @elseif($tab == 'bookmarks')
                    @include('profile.public.partials.bookmarkTab', ['bookmarks' => $bookmarks])
                    {{-- @elseif ($tab == 'activity')
                @include('profile.public.partials.activityTab', ['user' => $user]) --}}
                @endif
            </div>
        </section>
    </main>
@endsection
@push('scripts')
    @include('ajax')
@endpush
