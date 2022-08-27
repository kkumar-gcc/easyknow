@if (count($users) > 0)
    @foreach ($users as $user)
        <x-cards.card-secondary :user=$user />
    @endforeach

    {!! $users->withQueryString()->onEachSide(3)->links('pagination::tailwind') !!}
@else
    <div class="prose">
        <ul>
            <li>Make sure all words are spelled correctly.</li>
            <li>Try different keywords.</li>
            <li>Try more general keywords.</li>
        </ul>
    </div>
@endif
