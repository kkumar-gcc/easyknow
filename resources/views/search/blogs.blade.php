@if (count($blogs) > 0)
    @foreach ($blogs as $blog)
    <x-cards.card-primary :blog=$blog />
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
