@include('modal')
<nav
    class="shadow-sm sticky top-0 z-40 flex-none mx-auto w-full bg-white border-b border-gray-200 dark:border-gray-700 dark:bg-gray-800">
    <div class="p-5 max-w-7xl m-auto w-full text-base lg:w-11/12">
        <div class="flex w-full">
            <div class="flex items-center pr-2.5">
                <a href="/home">
                    <img class="max-h-8"
                        src="https://cdn2.iconfinder.com/data/icons/basic-thin-line-color/21/18_1-512.png">
                </a>
            </div>
            <div class="dark:text-gray-400 hidden lg:flex basis-1/2 ml-[4%] md:flex-row md:items-center">
                <div class="relative ml-6">
                    <a href="/home"
                        class="text-base font-medium tracking-wider text-gray-800 hover:text-rose-600 dark:text-gray-300 dark:hover:text-rose-500">Home</a>
                </div>
                <div class="relative ml-6">
                    <a href="/blogs"
                        class="text-base font-medium tracking-wider text-gray-800 hover:text-rose-600 dark:text-gray-300 dark:hover:text-rose-500">Read</a>
                </div>

                <div class="relative ml-6">
                    <a href="/tags"
                        class="text-base font-medium tracking-wider text-gray-800 hover:text-rose-600 dark:text-gray-300 dark:hover:text-rose-500">Tags</a>
                </div>
                <div class="relative ml-6">
                    <a href="/tags"
                        class="text-base font-medium tracking-wider text-gray-800 hover:text-rose-600 dark:text-gray-300 dark:hover:text-rose-500">Writers</a>
                </div>
                <div class="relative ml-6">
                    <a href="/podcasts"
                        class="text-base font-medium tracking-wider text-gray-800 hover:text-rose-600 dark:text-gray-300 dark:hover:text-rose-500">Podcasts</a>
                </div>
            </div>

            <div class="basis-11/12 lg:basis-2/5 flex flex-row justify-end">
                <div class="flex items-center ml-6 ">
                    <button
                        class="space-x-2 flex w-full justify-start items-center font-semibold whitespace-nowrap select-none mx-[2px] my-[1px]  p-3 text-sm rounded-lg text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200  dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700"
                        type="button" data-modal-toggle="searchModal">
                        @svg('heroicon-o-search', 'flex-none')
                        <span class="flex-none hidden sm:block">
                            Ctrl + K
                        </span>
                    </button>
                </div>
                {{-- <div class="flex items-center ml-6 ">
                    <button id="theme-toggle" type="button"
                        class="text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-2.5"
                        data-theme-toggle="theme-toggle">
                        <svg id="theme-toggle-dark-icon" data-theme-toggle="theme-toggle-dark-icon"
                            class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
                        </svg>
                        <svg id="theme-toggle-light-icon" data-theme-toggle="theme-toggle-light-icon"
                            class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z"
                                fill-rule="evenodd" clip-rule="evenodd"></path>
                        </svg>
                    </button>
                </div> --}}
                @guest
                    @if (Route::has('login'))
                        <div class="hidden lg:flex items-center ml-6 ">
                            <x-buttons.primary type="button" href="{{ route('login') }}">{{ __('Sign In') }}
                            </x-buttons.primary>
                        </div>
                    @endif

                    @if (Route::has('register'))
                        <div class="hidden lg:flex  items-center ml-6 ">
                            <x-buttons.secondary type="button" href="{{ route('register') }}">{{ __('Sign Up') }}
                            </x-buttons.secondary>
                        </div>
                    @endif
                @else
                    <div class="flex items-center ml-6  ">
                        <button type="button"
                            class="text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-2.5">
                            @svg('clarity-notification-line', 'h-5 w-5')
                        </button>
                    </div>
                    <div class="hidden lg:flex  items-center ml-6 ">
                        <x-dropdowns.primary customButton=true>
                            <x-slot:title>
                                <img class="w-10 h-10 rounded-full cursor-pointer"
                                    src="{{ asset(Auth::user()->profile_image) }}"
                                    onerror="this.onerror=null;this.src=`https://avatars.dicebear.com/api/bottts/:{{ Auth::user()->username }}.svg`"
                                    alt="User dropdown">
                            </x-slot:title>
                            <div class="py-3 px-4 text-sm text-gray-900 dark:text-white">
                                <div>{{ auth()->user()->username }}</div>
                                <div class="font-medium truncate">{{ auth()->user()->email }}</div>
                            </div>
                            <ul>
                                <li>
                                    <a href="/home" class="block hover:bg-gray-50 whitespace-no-wrap py-2 px-4">
                                        Dashboard
                                    </a>
                                </li>
                                <li>
                                    <a href="/settings" class="block hover:bg-gray-50 whitespace-no-wrap py-2 px-4">
                                        Settings
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();"
                                        class="block hover:bg-gray-50 whitespace-no-wrap py-2 px-4">
                                        {{ __('Sign out') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </x-dropdowns.primary>
                    </div>
                @endguest
                <div class="flex justify-end items-center ml-6  lg:hidden">
                    <div class="guide-toggler  flex items-center cursor-pointer text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-2.5"
                        type="button" id="guide-toggler" data-nav-open="false">
                        @svg('heroicon-o-menu')
                    </div>
                    <div class="user-mobile-menu  overflow-y-auto overflow-x-hidden fixed top-20 right-0 left-0 z-50 w-screen h-screen  py-5 px-[4%] min-h-screen hidden  bg-white border-t border-gray-200 dark:border-gray-700 dark:bg-gray-800"
                        id="guide-mobile-menu">
                        <div
                            class="flex justify-between py-3 font-medium translate-x-1  transition-colors duration-200 relative  hover:text-gray-900 text-gray-500 dark:text-gray-400 dark:hover:text-white">
                            <a href="/home">Home</a>
                        </div>

                        <div
                            class="flex justify-between py-3 font-medium translate-x-1  transition-colors duration-200 relative  hover:text-gray-900 text-gray-500 dark:text-gray-400 dark:hover:text-white">
                            <a href="/blogs">Read</a>
                        </div>
                        <div
                            class="flex justify-between py-3 font-medium translate-x-1  transition-colors duration-200 relative  hover:text-gray-900 text-gray-500 dark:text-gray-400 dark:hover:text-white ">
                            <a href="/tags">Tags</a>
                        </div>
                        <div
                            class="flex justify-between py-3 font-medium translate-x-1  transition-colors duration-200 relative  hover:text-gray-900 text-gray-500 dark:text-gray-400 dark:hover:text-white">
                            <a href="/home">Writers</a>
                        </div>
                        {{-- <div class="border-b border-gray-200 dark:border-gray-700 dark:bg-gray-800">

                        </div> --}}
                        @guest
                            <div class="flex justify-center mt-4">
                                @if (Route::has('login'))
                                    <div class="flex items-center ml-6 ">
                                        <x-buttons.primary type="button" href="{{ route('login') }}">
                                            {{ __('Sign In') }}</x-buttons.primary>
                                    </div>
                                @endif
                                @if (Route::has('register'))
                                    <div class="flex items-center ml-6 ">
                                        <x-buttons.secondary type="button" href="{{ route('register') }}">
                                            {{ __('Sign Up') }}</x-buttons.secondary>
                                    </div>
                                @endif
                            </div>
                        @else
                            <div class="flex justify-between py-3 font-medium translate-x-1">
                                <div class="flex items-center space-x-4">
                                    <x-avatar :user="auth()->user()" class="w-12 h-12 rounded-full" />
                                    <div class="space-y-1 font-medium dark:text-white">
                                        <div>{{ Auth::user()->username }}</div>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="flex justify-between py-3 font-medium translate-x-1  transition-colors duration-200 relative  hover:text-gray-900 text-gray-500 dark:text-gray-400 dark:hover:text-white">
                                <a href="/users/{{ Auth::user()->username }}">Profile</a>
                            </div>
                            <div
                                class="flex justify-between py-3 font-medium translate-x-1  transition-colors duration-200 relative  hover:text-gray-900 text-gray-500 dark:text-gray-400 dark:hover:text-white">
                                <a href="#">Work preferences</a>
                            </div>
                            <div
                                class="flex justify-between py-3 font-medium translate-x-1  transition-colors duration-200 relative  hover:text-gray-900 text-gray-500 dark:text-gray-400 dark:hover:text-white">
                                <a href="/settings?tab=blogs">My
                                    Blogs</a>
                            </div>
                            <div
                                class="flex justify-between py-3 font-medium translate-x-1  transition-colors duration-200 relative  hover:text-gray-900 text-gray-500 dark:text-gray-400 dark:hover:text-white">
                                <a href="/settings?tab=follower">My
                                    Followers</a>
                            </div>
                            <div
                                class="flex justify-between py-3 font-medium translate-x-1 transition-colors duration-200 relative  hover:text-gray-900 text-gray-500 dark:text-gray-400 dark:hover:text-white">
                                <a href="/settings?tab=following">My
                                    Followings</a>
                            </div>
                            <div
                                class="flex justify-between py-3 font-medium translate-x-1  transition-colors duration-200 relative  hover:text-gray-900 text-gray-500 dark:text-gray-400 dark:hover:text-white">
                                <a href="/settings?tab=bookmarks">My
                                    Bookmarks</a>
                            </div>
                            <div
                                class="flex justify-between py-3 font-medium translate-x-1  transition-colors duration-200 relative  hover:text-gray-900 text-gray-500 dark:text-gray-400 dark:hover:text-white">
                                <a href="/settings?tab=profile">Account
                                    Settings</a>
                            </div>
                            <div
                                class="flex justify-between py-3 font-medium translate-x-1  transition-colors duration-200 relative  hover:text-gray-900 text-gray-500 dark:text-gray-400 dark:hover:text-white">
                                <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                             document.getElementById('logout-form').submit();">
                                    {{ __('Sign out') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        @endguest
                    </div>
                </div>


            </div>
        </div>
    </div>

</nav>
