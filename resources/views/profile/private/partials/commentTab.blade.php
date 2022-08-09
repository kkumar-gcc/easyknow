@if ($comments->count() > 0)
    <div class="comment-content">

        <div class="e-vcard">
            <div class="e-vcard-title">
                {{-- <span class="modern-badge modern-badge-info">#Help</span> --}}
                <h3>Comments</h3>
            </div>

            <ul class="e-vcard-list e-vcard-list-2">
                @foreach ($comments as $comment)
                    <li>
                        <a href="#">{{ $comment->blog->title }}</a>
                        <span class="text-muted ">
                            {!! Str::words($comment->description, 1000) !!}
                        </span>
                        {{-- <span class="text-muted d-inline-block">{!! \Carbon\Carbon::parse($comment->created_at)->format("M d") !!}</span> --}}
                    </li>
                @endforeach
            </ul>

        </div>
        {{-- <div class="image">
                    <img class="user-img"  src="{{ asset($comment->user->profile_image ?? '') }}" alt="{{ $comment->user->username }} profile">
                </div> --}}
        {{-- <div class="comment-body">
                    <span><a class="link link-secondary user-popover"
                            href="/users/{{ $comment->user_id }}/{{ $comment->user->username }}/public"
                            id="user{{ $comment->id }}-{{ $comment->user_id }}">{{ $comment->user->username }}</a>
                        <small class="text-muted">
                            
                        </small>
                    </span>
                  
                </div> --}}


    </div>
    {!! $comments->withQueryString()->links('pagination::tailwind') !!}
@else
    <div
        class="py-4 px-5 rounded-xl text-base border   text-gray-700 dark:text-gray-300  dark:border-gray-700 dark:bg-gray-800 ">
        You haven't written any comment.
    </div>
@endif
