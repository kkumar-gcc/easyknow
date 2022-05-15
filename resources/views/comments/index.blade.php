<div class="comments" id="comments">
    <div class="comment-top card">
        @auth
            <div class="image">
                
                <img src="https://picsum.photos/400/300" alt="">
            </div>
            <div class="form">
                <form>
                    <textarea type="text" class="form-control" name="comment" id="">Post a comment </textarea>
                </form>
            </div>
        @else
            <span>
                 Please <a href="{{ Route('login') }}" class="link">login </a> or  <a href="{{ Route('register') }}" class="link">create an account </a> participate in this conversation. 
            </span>
        @endauth
    </div>


    <ul class="nav nav-tabs ">
        <li class="nav-item ">
            <a class="nav-link link link-secondary" aria-current="page" href="#">Newest</a>
        </li>
        <li class="nav-item ">
            <a class="nav-link link link-secondary active" href="#">Top Comments</a>
        </li>
    </ul>


    <div class="" >
        @foreach ($comments as $comment)
            <div class="comment" id="comment-{{ $comment->id }}">
                <div class="image">
                    <img src="https://picsum.photos/400/300" alt="">
                </div>
                <div class="comment-body">
                    <h5><a class="link link-secondary" href="/users/{{ $comment->user_id }}/{{ $comment->user->username }}/public">{{ $comment->user->username }}</a>
                    </h5>
                    <p class="card-text disable">{{ $comment->description }}</p>
                    <div>
                        <span class="action-btn"><a href="#" class="link link-secondary"><span>
                                    {{ svg('grommet-like') }}</span></a> {{ nice_number($comment->likes) }}</span>
                        <span class="action-btn"><a href="#" class="link link-secondary"><span>
                                    {{ svg('grommet-dislike') }}</span></a>
                            {{ nice_number($comment->dislikes) }}</span>
                        <span class="action-btn"><a >Reply</a></span>
                       
                    </div>
                    @if ($comment->replies->count() > 0)
                        <p class="action-btn ">
                            <a class="link-btn link pt-4 showElement" target="{{ $comment->id }}">View {{ nice_number($comment->replies->count()) }}
                                replies</a>
                        </p>
                    @endif

                    <div class="replies targetElement" id="replies-{{ $comment->id }}" style="display:none;">

                        @foreach ($comment->replies as $reply)
                            <div class="reply" id="reply-{{ $reply->id }} ">
                                <div class="image">
                                    <img src="https://picsum.photos/400/300" alt="">
                                </div>
                                <div class="reply-body">
                                    <h5><a href="/users/{{ $reply->user_id }}/{{ $reply->user->username }}/public" class="link link-secondary">{{ $reply->user->username }}</a>
                                    </h5>

                                    <p>
                                        {!! Str::words($reply->description, 50) !!}
                                        @if (strlen(strip_tags($reply->description)) > 50)
                                            ... <a href="#" class="link">Read More</a>
                                        @endif
                                    </p>
                                    <div>
                                        <span class="action-btn"><a href="#" class="link link-secondary"><span>
                                                    {{ svg('grommet-like') }}</span></a>
                                            {{ nice_number($reply->likes) }}</span>
                                        <span class="action-btn"><a href="#" class="link link-secondary"><span>
                                                    {{ svg('grommet-dislike') }}</span></a>
                                            {{ nice_number($reply->dislikes) }}</span>
                                        <span class="action-btn"><a>Reply</a></span>
                                    </div>
                                </div>

                            </div>
                        @endforeach
                    </div>

                </div>
            </div>
        @endforeach
    </div>

    {!! $comments->withQueryString()->links('pagination::bootstrap-5') !!}

</div>
