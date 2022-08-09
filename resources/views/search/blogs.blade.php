@if (count($blogs) > 0)
    @foreach ($blogs as $blog)
        <div class="relative mt-3 w-full p-2.5 text-base text-left  border border-transparent rounded-3xl font-normal hover:bg-gray-100 hover:shadow-md dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700"
            id="blog-{{ $blog->id }}">
            <div class="flex flex-col items-stretch justify-center p-6 sm:flex-row">
                <div class="basis-1/3 relative text-center min-h-fit">
                    <img class="block relative w-full h-full rounded-xl  object-cover shadow-md hover:shadow-sm sm:absolute sm:top-0 sm:left-0 "
                        src="https://picsum.photos/400/300" alt="">
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
                                    class="flex flex-row items-center mr-1  hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-2"
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
                                            class="flex flex-row items-center mr-1 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-2">
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
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                            {{ $blog->title }}
                        </h5>
                    </a>
                    <p class="font-normal sm:hidden">
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
                        <span class="ml-2">By </span>
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

    {!! $blogs->withQueryString()->onEachSide(3)->links('pagination::tailwind') !!}
@else
    <div class="prose">
        <ul>
            <li>Make sure all words are spelled correctly.</li>
            <li>Try different keywords.</li>
            <li>Try more general keywords.</li>
        </ul>
    </div>
@endif
