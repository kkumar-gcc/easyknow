@if (count($tags) > 0)
    <div class="row">
        @foreach ($tags as $tag)
            <div class='col-lg-4 col-md-4 col-sm-12 '>
                <div class="e-card">
                    <div class="e-card-body">
                        <a href="blogs/tagged/{{ $tag->title }}" class="tag-popover"
                            id="tag-{{ $tag->id }}"><span
                                class="modern-badge  modern-badge-{{ $tag->color }}">#{{ $tag->title }}</span>
                        </a>
                        <p class="mt-3 mb-3">Some quick example text to build on the card title and make up the
                            bulk of
                            the card's content.</p>
                        <span class="text-muted">{{ $tag->blogs->count() }} blogs</span>
                    </div>
                </div>
            </div>
        @endforeach

    </div>
    {!! $tags->withQueryString()->onEachSide(3)->links('pagination::bootstrap-5') !!}
@else
    <div>
        <ul>
            <li>Make sure all words are spelled correctly.</li>
            <li>Try different keywords.</li>
            <li>Try more general keywords.</li>
        </ul>
    </div>
@endif
