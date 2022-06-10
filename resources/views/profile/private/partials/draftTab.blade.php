<div class="container-fluid">
    @if ($drafts->count() > 0)
        <div >
            @foreach ($drafts as $draft)
                <div class="e-scard-hover e-scard" id="blog-{{ $draft->id }}">
                    <div class="card-body">
                        <div class="image">
                            <img src="https://picsum.photos/400/300" alt="">
                        </div>
                        <div class="detail">
                            <a href="/drafts/{{ $draft->id }}" class="link link-secondary">
                                <h5 class="title">{{ $draft->title }}</h5>
                            </a>
                            <p class="card-text disable">
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
                                <small class="text-muted"> drafted
                                    {{ \Carbon\Carbon::parse($draft->created_at)->diffForHumans() }}
                                </small>
                            </p>

                            <a class="e-btn e-btn-dark e-btn-lg disable " href="/drafts/{{ $draft->id }}">
                                {{ __('Edit Draft') }}
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
            {!! $drafts->withQueryString()->links('pagination::bootstrap-5') !!}
        </div>
    @else
        <div class="e-scard e-scard-hover s-empty-state wmx4 p48">
            <div class="card-body">
                You don't have any drafted blog.
            </div>
        </div>
    @endif
</div>
