<div id="shareBlogModal" tabindex="-1"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-screen h-screen  md:inset-0 md:h-full bg-gray-900 bg-opacity-50 dark:bg-opacity-80"
    aria-modal="true" aria-hidden="true" role="dialog">
    <div class="relative p-0 flex items-center w-screen  m-auto md:max-w-2xl md:p-4 md:w-full">
        <!-- Modal content -->
        <div class="relative min-h-screen w-full md:min-h-max md:h-auto bg-white md:rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex justify-between items-center p-4 rounded-t border-b dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 lg:text-2xl dark:text-white">
                    Share
                </h3>
                <button type="button" data-modal-toggle="shareBlogModal"
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
                <div class="blog-share-wrap social-wrap">

                    <a class="social-link link-icon-facebook" href="{{ $shareBlog['facebook'] }}"
                        id="">{{ svg('bi-facebook') }}
                    </a>
                    <a class="social-link link-icon-twitter" href="{{ $shareBlog['twitter'] }}"
                        id="">{{ svg('bi-twitter') }}
                    </a>
                    <a class="social-link link-icon-linkedin" href="{{ $shareBlog['linkedin'] }}"
                        id="">{{ svg('bi-linkedin') }}
                    </a>
                    <a class="social-link link-icon-reddit" href="{{ $shareBlog['reddit'] }}"
                        id="">{{ svg('bi-reddit') }}
                    </a>
                    <a class="social-link link-icon-whatsapp" href="{{ $shareBlog['whatsapp'] }}"
                        id="">{{ svg('bi-whatsapp') }}
                    </a>
                    <a class="social-link link-icon-telegram" href="{{ $shareBlog['telegram'] }}"
                        id="">{{ svg('bi-telegram') }}
                    </a>
                </div>
                <div
                    class="mt-3 w-full text-base text-left  border  border-gray-200 rounded-2xl font-normal  dark:border-gray-700 dark:bg-gray-800 ">

                    <div
                        class="flex flex-row py-3 px-4 rounded-2xl  text-gray-700 dark:text-gray-400 dark:hover:text-white  dark:bg-gray-800 ">
                        <div class="flex-1">
                           

                        </div>
                        <button type="button"
                            class="text-gray-500 flex flex-row items-center mr-2 md:mr-3 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-2.5"
                            data-modal-toggle="loginMessageModal">
                            {{ svg('fluentui-copy-20-o', 'h-4 w-4') }}
                            <span class="ml-2">copy</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
