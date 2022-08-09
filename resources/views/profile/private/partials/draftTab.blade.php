<div class="not-prose">
    @if ($drafts->count() > 0)
        <div>
            @foreach ($drafts as $draft)
                <div class="relative mt-3 w-full p-2.5 text-base text-left  border border-transparent rounded-3xl font-normal hover:bg-gray-100 hover:shadow-md dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700"
                    id="blog-{{ $draft->id }}">
                    <div class="flex flex-col items-stretch justify-center p-6 sm:flex-row">
                        <div class="basis-1/3 relative text-center min-h-fit">
                            <img class="block relative w-full h-full rounded-xl  object-cover shadow-md hover:shadow-sm sm:absolute sm:top-0 sm:left-0 "
                                src="https://picsum.photos/400/300" alt="">
                        </div>
                        <div class="basis-2/3 mt-2 relative leading-normal sm:mt-0 sm:px-4">
                            <a href="/blogs/{{ Str::slug($draft->title, '-') }}-{{ $draft->id }}"
                                class="link link-secondary">
                                <h5
                                    class="mb-2 text-2xl font-bold line-clamp-3 tracking-tight text-gray-900  dark:text-white ">
                                    {{ $draft->title }}
                                </h5>
                            </a>
                            <p class="font-normal line-clamp-3 sm:hidden">
                                {!! Str::words(strip_tags($draft->description), 50) !!}
                            </p>
                            @foreach ($draft->tags as $tag)
                                <a href="/blogs/tagged/{{ $tag->title }}" class="tag-popover"
                                    id="tag{{ $draft->id }}-{{ $tag->id }}">
                                    <span class="modern-badge  modern-badge-{{ $tag->color }}">
                                        #{{ $tag->title }}
                                    </span>
                                </a>
                            @endforeach
                            <p class="mt-3">
                                <span class="text-sm">drafted
                                    {{ \Carbon\Carbon::parse($draft->created_at)->diffForHumans() }}</span>
                            </p>
                            <a class="e-btn e-btn-dark e-btn-lg mt-5 w-full sm:hidden"
                                href="/blogs/{{ Str::slug($draft->title, '-') }}-{{ $draft->id }}">
                                {{-- /drafts/{{ $draft->id }} --}}
                                Edit Draft
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
            {!! $drafts->withQueryString()->links('pagination::tailwind') !!}
        </div>
    @else
        <div class="py-3 px-4 rounded-xl text-base  text-gray-700 dark:text-gray-300   dark:bg-gray-800 ">
            You don't have any drafted blog.
        </div>
    @endif
</div>
