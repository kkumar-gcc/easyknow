<div id="searchModal" tabindex="-1"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-screen h-screen  md:inset-0 md:h-full bg-gray-900 bg-opacity-50 dark:bg-opacity-80"
    aria-modal="true" aria-hidden="true" role="dialog">
    <div class="relative p-0 flex items-center w-screen  m-auto md:max-w-3xl lg:max-w-5xl md:p-4 md:w-full">
        <!-- Modal content -->
        <div class="relative min-h-screen w-full md:min-h-max md:h-auto bg-white md:rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex justify-between items-start p-2 rounded-t border-b dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 lg:text-2xl dark:text-white">

                </h3>
                <button type="button" data-modal-toggle="searchModal"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white">
                    <kbd
                        class="px-2 py-1.5 text-xs font-semibold text-gray-800 bg-gray-100 border border-gray-200 rounded-lg dark:bg-gray-600 dark:text-gray-100 dark:border-gray-500">Esc</kbd>
                </button>
            </div>
            <div class="p-6 space-y-6">

                <div class="mb-6">
                    <form method="GET" action="/search">
                        <input type="search" id="search-input"
                        class="block p-3 w-full text-gray-900 bg-gray-50 rounded-lg border border-gray-300 sm:text-md focus:ring-purple-500 focus:border-purple-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-purple-500 dark:focus:border-purple-500"
                        autocomplete="off" placeholder="Search" name="query" id="js-typeahead-search">
                        <input type="submit" class="hidden" value="search" style="display:none" />
                    </form>
                   </div>


                <div class="form-group mb-4 ">
                    <div class="typeahead__container">
                        <div class="typeahead__field">
                            <div class="typeahead__query">
                                <form method="GET" action="/search">
                                    <input type="search"
                                        class="js-typeahead-search block p-4 w-full text-gray-900 bg-gray-50 rounded-lg border border-gray-300 sm:text-md focus:ring-purple-500 focus:border-purple-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-purple-500 dark:focus:border-purple-500"
                                        autocomplete="off" placeholder="Search" name="query" id="js-typeahead-search">
                                    <input type="submit" class="hidden" value="search" style="display:none" />
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal footer -->
            <div class="flex items-center p-6  space-x-2 rounded-b border-t border-gray-200 dark:border-gray-600">
                <ul class="flex flex-row flex-wrap text-base leading-relaxed text-gray-500 dark:text-gray-400">
                    <li class="mr-3">
                        <kbd
                            class="inline-flex items-center  mr-1 px-2 py-1.5 text-gray-800 bg-gray-100 border border-gray-200 rounded-lg dark:bg-gray-600 dark:text-gray-100 dark:border-gray-500">
                            @svg('monoicon-enter', 'w-4 h-4')</kbd>
                        <span class="search-key-label">to select</span>
                    </li>
                    <li class="mr-3">
                        <kbd
                            class="inline-flex items-center  mr-1 px-2 py-1.5 text-gray-800 bg-gray-100 border border-gray-200 rounded-lg dark:bg-gray-600 dark:text-gray-100 dark:border-gray-500">
                            @svg('heroicon-o-arrow-sm-up', 'w-4 h-4')
                            <span class="sr-only">Arrow key up</span>
                        </kbd>
                        <kbd
                            class="inline-flex items-center px-2 py-1.5  text-gray-800 bg-gray-100 border border-gray-200 rounded-lg dark:bg-gray-600 dark:text-gray-100 dark:border-gray-500">
                            @svg('heroicon-o-arrow-sm-down', 'w-4 h-4')
                            <span class="sr-only">Arrow key down</span>
                        </kbd>
                        <span class="search-key-label">to navigate</span>
                    </li>
                    <li class="mr-3">
                        <kbd
                            class="inline-flex text-xs items-center px-2 py-1.5  text-gray-800 bg-gray-100 border border-gray-200 rounded-lg dark:bg-gray-600 dark:text-gray-100 dark:border-gray-500">
                            @svg('vaadin-esc-a', 'w-4 h-4')</kbd>
                        <span class="search-key-label">to close</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

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
                        class="text-sm font-medium text-gray-900 hover:text-purple-600 dark:text-gray-300 dark:hover:text-green-500">Home</a>
                </div>
                <div class="relative ml-6">
                    <a href="/docs"
                        class="text-sm font-medium text-gray-900 hover:text-purple-600 dark:text-gray-300 dark:hover:text-purple-500">Docs</a>
                </div>
                <div class="relative ml-6">
                    <a href="/blogs"
                        class="text-sm font-medium text-gray-900 hover:text-purple-600 dark:text-gray-300 dark:hover:text-purple-500">Blogs</a>
                </div>

                <div class="relative ml-6">
                    <a href="/tags"
                        class="text-sm font-medium text-gray-900 hover:text-purple-600 dark:text-gray-300 dark:hover:text-purple-500">Tags</a>
                </div>
                <div class="relative ml-6">
                    <a href="/podcasts"
                        class="text-sm font-medium text-gray-900 hover:text-purple-600 dark:text-gray-300 dark:hover:text-purple-500">Podcasts</a>
                </div>
            </div>

            <div class="basis-full lg:basis-2/5 flex flex-row justify-end">
                <div class="flex items-center ml-6 ">
                    <button
                        class="space-x-2 flex w-full justify-start items-center font-semibold whitespace-nowrap select-none mx-[2px] my-[1px]  p-3 text-sm rounded-lg text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200  dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700"
                        type="button" data-modal-toggle="searchModal">
                        @svg('heroicon-o-search', 'flex-none')
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
                <div class="flex items-center ml-6 ">
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
                </div>
                @guest
                    @if (Route::has('login'))
                        <div class="hidden lg:flex items-center ml-6 ">
                            <a class="relative inline-flex items-center justify-center p-0.5  overflow-hidden text-sm font-medium no-underline mx-1.5 cursor-pointer whitespace-nowrap text-gray-900 rounded-lg group bg-gradient-to-br from-purple-600 to-blue-500 group-hover:from-purple-600 group-hover:to-blue-500 hover:text-white dark:text-white focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800"
                                href="{{ route('login') }}">
                                <span
                                    class="relative px-5 py-2 transition-all ease-in duration-75 bg-white dark:bg-gray-900 rounded-md group-hover:bg-opacity-0">
                                    {{ __('Sign In') }}
                                </span>
                            </a>
                        </div>
                    @endif

                    @if (Route::has('register'))
                        <div class="hidden lg:flex  items-center ml-6 ">
                            <a type="button"
                                class="inline-block font-medium rounded-lg text-sm px-5 py-2.5 text-center no-underline mx-1.5 cursor-pointer whitespace-nowrap text-white bg-gradient-to-br from-purple-600 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800"
                                href="{{ route('register') }}">{{ __('Sign Up') }}</a>
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

                        <img id="avatarButton" type="button" data-dropdown-toggle="userDropdown"
                            data-dropdown-placement="bottom-start" class="w-10 h-10 rounded-full cursor-pointer"
                            src="{{ asset(Auth::user()->profile_image ?? '') }}" alt="User dropdown">

                        <div id="userDropdown"
                            class="hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600"
                            style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate(20px, 70px);"
                            data-popper-reference-hidden="true" data-popper-escaped=""
                            data-popper-placement="bottom-start">
                            <div class="py-3 px-4 text-sm text-gray-900 dark:text-white">
                                <div>{{ auth()->user()->username }}</div>
                                <div class="font-medium truncate">{{ auth()->user()->email }}</div>
                            </div>
                            <ul class="py-1 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="avatarButton">
                                <li>
                                    <a href="/home"
                                        class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Dashboard</a>
                                </li>
                                <li>
                                    <a href="/settings"
                                        class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Settings</a>
                                </li>
                                <li>
                                    <a href="#"
                                        class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Earnings</a>
                                </li>
                            </ul>
                            <div class="py-1">
                                <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();"
                                    class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">
                                    {{ __('Sign out') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </div>
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
                            class="flex justify-between py-3 font-medium translate-x-1  transition-colors duration-200 relative  hover:text-gray-900 text-gray-500 dark:text-gray-400 dark:hover:text-white ">
                            <a href="/docs">Docs</a>
                        </div>
                        <div
                            class="flex justify-between py-3 font-medium translate-x-1  transition-colors duration-200 relative  hover:text-gray-900 text-gray-500 dark:text-gray-400 dark:hover:text-white">
                            <a href="/blogs">Blogs</a>
                        </div>
                        <div
                            class="flex justify-between py-3 font-medium translate-x-1  transition-colors duration-200 relative  hover:text-gray-900 text-gray-500 dark:text-gray-400 dark:hover:text-white ">
                            <a href="/tags">Tags</a>
                        </div>
                        <div
                            class="flex justify-between py-3 font-medium translate-x-1  transition-colors duration-200 relative  hover:text-gray-900 text-gray-500 dark:text-gray-400 dark:hover:text-white">
                            <a href="/home">Users</a>
                        </div>
                        <div class="border-b border-gray-200 dark:border-gray-700 dark:bg-gray-800">

                        </div>
                        @guest
                            <div class="flex justify-center">
                                @if (Route::has('login'))
                                    <div class="flex justify-between py-3 font-medium translate-x-1 mr-4">
                                        <a class="e-btn e-btn-success"
                                            href="{{ route('login') }}">{{ __('Login') }}</a>
                                    </div>
                                @endif

                                @if (Route::has('register'))
                                    <div class="flex justify-between py-3 font-medium translate-x-1">
                                        <a class="e-btn " href="{{ route('register') }}">{{ __('Register') }}</a>
                                    </div>
                                @endif
                            </div>
                        @else
                            <div class="flex justify-between py-3 font-medium translate-x-1">
                                <div class="flex items-center space-x-4">
                                    <img class="w-12 h-12 rounded-full"
                                        src="{{ asset(Auth::user()->profile_image ?? '') }}" alt="">
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
