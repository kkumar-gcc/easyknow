@forelse ($bookmarks as $bookmark)
    <x-cards.card-primary :blog="$bookmark->blog" />
    {!! $bookmarks->withQueryString()->links('pagination::tailwind') !!}
@empty
    <div
        class="py-4 px-5 rounded-lg text-base border   text-gray-700 dark:text-gray-300  dark:border-gray-700 dark:bg-gray-800 ">
        {{ $user->username }} has no bookmarked blogs.
    </div>
@endforelse
