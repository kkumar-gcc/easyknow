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
                            class="block p-3 w-full text-gray-900 bg-gray-50 rounded-lg border border-gray-300 sm:text-md focus:ring-rose-500 focus:border-rose-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-rose-500 dark:focus:border-rose-500"
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
                                        class="js-typeahead-search block p-4 w-full text-gray-900 bg-gray-50 rounded-lg border border-gray-300 sm:text-md focus:ring-rose-500 focus:border-rose-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-rose-500 dark:focus:border-rose-500"
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
<div id="loginMessageModal" tabindex="-1"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-screen h-screen  md:inset-0 md:h-full bg-gray-900 bg-opacity-50 dark:bg-opacity-80"
    aria-modal="true" aria-hidden="true" role="dialog">
    <div class="relative p-0 flex items-center w-screen  m-auto md:max-w-2xl md:p-4 md:w-full">
        <!-- Modal content -->
        <div class="relative min-h-screen w-full md:min-h-max md:h-auto bg-white md:rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex justify-between items-center p-4 rounded-t border-b dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 lg:text-2xl dark:text-white">
                    Log in to continue
                </h3>
                <button type="button" data-modal-toggle="loginMessageModal"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white">
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <div class="p-6 space-y-6">
                <a class="relative w-full inline-flex items-center justify-center p-0.5  overflow-hidden text-sm font-medium no-underline mx-1.5 cursor-pointer whitespace-nowrap text-gray-900 rounded-lg group bg-gradient-to-br from-rose-600 to-pink-500 group-hover:from-rose-600 group-hover:to-rose-500  dark:text-white focus:ring-4 focus:outline-none focus:ring-rose-300 dark:focus:ring-rose-800"
                    href="{{ route('login') }}">
                    <span
                        class="relative w-full text-center px-5 py-2 transition-all ease-in duration-75 bg-white hover:bg-gray-50 dark:bg-gray-900 rounded-md group-hover:bg-opacity-100">
                        {{ __('Sign In') }}
                    </span>
                </a>
                <a type="button"
                    class="w-full inline-block font-medium rounded-lg text-sm px-5 py-2.5 text-center no-underline mx-1.5 cursor-pointer whitespace-nowrap text-white bg-gradient-to-br from-rose-600 to-pink-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-rose-300 dark:focus:ring-rose-800"
                    href="{{ route('register') }}">
                    {{ __('Sign Up') }}
                </a>

            </div>
        </div>
    </div>
</div>
