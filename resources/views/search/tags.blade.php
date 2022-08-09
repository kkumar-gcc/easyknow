@if (count($tags) > 0)
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3  gap-4 pt-4"
        >
        @foreach ($tags as $tag)
            <div
                class="relative mb-4 w-full p-2.5 text-base text-left  border border-transparent rounded-3xl font-normal  hover:bg-gray-100 shadow dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">
                <div class="flex flex-col items-stretch justify-center p-6">
                    <a href="/blogs/tagged/{{ $tag->title }}" class="tag-popover" id="tag-{{ $tag->id }}">
                        <span class="modern-badge  modern-badge-{{ $tag->color }}">
                            #{{ $tag->title }}
                        </span>
                    </a>
                    <p class="mt-3 mb-3">
                        Some quick example text to build on the card title and make up the
                        bulk of
                        the card's content.
                    </p>
                    <span>{{ $tag->blogs->count() }} blogs</span>
                </div>
            </div>
        @endforeach

    </div>
    {!! $tags->withQueryString()->onEachSide(3)->links('pagination::tailwind') !!}
@else
    <div class="prose">
        <ul>
            <li>Make sure all words are spelled correctly.</li>
            <li>Try different keywords.</li>
            <li>Try more general keywords.</li>
        </ul>
    </div>
@endif
