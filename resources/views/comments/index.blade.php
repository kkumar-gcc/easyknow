<div class="comments" id="comments">
    <div class="shadow-2 card">
        <div class="m-2 ">
            @auth
                <div class="form">
                    <form method="POST" id="blog_comment_form">
                        @csrf
                        @method('put')
                        <input type="hidden" name="blog_id" id="comment_blog_id" value="{{ $blog->id }}">
                        <input type="hidden" name="user_id" id="comment_user_id" value="{{ auth()->user()->id }}">
                        <textarea type="text" class="form-control" name="comment" id="editor2">Write a comment </textarea>
                        <button type="submit" class="mt-2 ml-2 btn btn-outline-primary">comment</button>
                    </form>
                </div>
            @else
                <span>
                    Please <a href="{{ Route('login') }}" class="link">login </a> or <a
                        href="{{ Route('register') }}" class="link">create an account </a> participate in this
                    conversation.
                </span>
            @endauth
        </div>
        <hr>
        <div id="new-comment">

        </div>
        @foreach ($comments as $comment)
            <div class="comment m-1 showElement responsive-disable" id="comment-{{ $comment->id }}" >
                <div class="image">
                    <img class="user-img" src="https://picsum.photos/400/300" alt="">
                </div>
                <div class="comment-body">
                    <span><a class="link link-secondary user-popover"
                            href="/users/{{ $comment->user_id }}/{{ $comment->user->username }}/public" id="user{{ $comment->id }}-{{ $comment->user_id }}">{{ $comment->user->username }}</a>
                        <small class="text-muted">
                            {{ \Carbon\Carbon::parse($comment->created_at)->diffForHumans() }}
                        </small>
                    </span>
                    @if ($comment->user_id == $blog->user_id)
                        <span class="modern-badge modern-badge-warning">auther</span>
                    @endif
                    <p class=" disable mt-2">{!! $comment->description !!}</p>
                    <div class="action">
                        @guest
                            <span>
                                <a href="#" class="action-btn link link-secondary"><span>
                                        {{ svg('grommet-like') }}</span></a>{{ nice_number($comment->commentlikes->where('status', 1)->count()) }}</span>
                            <span>
                                <a href="#" class="action-btn link link-secondary">
                                    <span>{{ svg('grommet-dislike') }}</span>
                                </a>
                                {{ nice_number($comment->commentlikes->where('status', 0)->count()) }}
                            </span>
                            <span><a href="/login" class="action-btn link link-secondary ">Login to
                                    Reply</a></span>
                        @else
                            <span>
                                <form method="POST" id="comment_like_form_{{ $comment->id }}"
                                    class="d-inline comment-like">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="comment_id" id="comment_like_id_{{ $comment->id }}"
                                        value="{{ $comment->id }}">
                                    <input type="hidden" name="user_id" id="user_like_id_{{ $comment->id }}"
                                        value="{{ auth()->user()->id }}">
                                    <button type="submit" id="comment-like-{{ $comment->id }}"
                                        class="action-btn {{ $comment->isAuthUserLikedComment() ? 'text-danger' : '' }} "
                                        data-mdb-toggle="tooltip" title="likes">
                                        <span class="r-3">{{ svg('grommet-like') }}</span>
                                        <span>{{ nice_number($comment->commentlikes->where('status', 1)->count()) }}</span>
                                    </button>
                                </form>

                            </span>
                            <span>
                                <form method="post" id="comment_dislike_form_{{ $comment->id }}"
                                    class="d-inline comment-dislike">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="comment_id" id="comment_dislike_id_{{ $comment->id }}"
                                        value="{{ $comment->id }}">
                                    <input type="hidden" name="user_id" id="user_dislike_id_{{ $comment->id }}"
                                        value="{{ auth()->user()->id }}">
                                    <button type="submit" id="comment-dislike-{{ $comment->id }}"
                                        class="action-btn {{ $comment->isAuthUserDisLikedComment() ? 'text-secondary' : '' }}"
                                        data-mdb-toggle="tooltip" title="dislikes">
                                        <span class="r-3">{{ svg('grommet-dislike') }}</span>
                                        <span>{{ nice_number($comment->commentlikes->where('status', 0)->count()) }}</span>
                                    </button>
                                </form>
                            </span>
                            <span class="text-muted">
                                <a class="link link-secondary " data-mdb-toggle="collapse"
                                    href="#collapseComment-{{ $comment->id }}" role="button" aria-expanded="false"
                                    aria-controls="collapseComment-{{ $comment->id }}">
                                    Reply
                                </a>
                                <div class="collapse mt-3" id="collapseComment-{{ $comment->id }}">
                                    <form method="POST" class="comment-reply-form"
                                        id="blog_comment_form_{{ $comment->id }}">
                                        @csrf
                                        @method('put')
                                        <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                                        <input type="hidden" name="comment_id" value="{{ $comment->id }}">
                                        <input type="hidden" name="replied_user_id" value="{{ $comment->user_id }}">
                                        <textarea type="text" class="form-control" name="content" id="editor2">Write a reply </textarea>
                                        <button type="submit"
                                            class="mt-2 ml-2 btn2 btn-sm btn btn-outline-primary">reply</button>
                                    </form>
                                </div>
                            </span>
                        @endguest


                    </div>
                    @if ($comment->replies->count() > 0)
                        <p class="action-btn ">
                            <a class="link-btn link showElementBtn" target="{{ $comment->id }}" key="comment-{{ $comment->id }}">
                                {{ nice_number($comment->replies->count()) }}
                                replies</a>
                        </p>
                    @endif

                    <div class="replies targetElement" id="replies-{{ $comment->id }}" style="display:none;">

                        @foreach ($comment->replies as $reply)
                            <div class="reply" id="reply-{{ $reply->id }}" >
                                <div class="image">
                                    <img class="user-img " src="https://picsum.photos/400/300" alt="">
                                </div>
                                <div class="reply-body">
                                    <span>
                                        <a href="/users/{{ $reply->user_id }}/{{ $reply->user->username }}/public"
                                            class="link link-secondary user-popover "  id="user-{{ $reply->user_id }}">{{ $reply->user->username }}</a>
                                        <small class="text-muted">
                                            {{ \Carbon\Carbon::parse($reply->created_at)->diffForHumans() }}
                                        </small>
                                    </span>
                                    @if ($reply->user_id == $blog->user_id)
                                        <span class="modern-badge modern-badge-warning">auther</span>
                                    @endif
                                    <p class="mt-2">
                                        {!! $reply->description !!}

                                    </p>
                                    <div class="action">
                                        @guest
                                            <span>
                                                <a href="#" class="action-btn link link-secondary"><span>
                                                        {{ svg('grommet-like') }}</span></a>{{ nice_number($reply->replylikes->where('status', 1)->count()) }}</span>
                                            <span >
                                                <a href="#" class="action-btn link link-secondary">
                                                    <span>{{ svg('grommet-dislike') }}</span>
                                                </a>
                                                {{ nice_number($reply->replylikes->where('status', 0)->count()) }}
                                            </span>
                                            <span><a href="/login" class="action-btn link link-secondary ">Login
                                                    to
                                                    Reply</a></span>
                                        @else
                                            <span>
                                                <form method="POST" id="reply_like_form_{{ $reply->id }}"
                                                    class="d-inline reply-like">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="reply_id"
                                                        id="reply_like_id_{{ $reply->id }}"
                                                        value="{{ $reply->id }}">

                                                    <input type="hidden" name="user_id"
                                                        id="user_like_id_{{ $reply->id }}"
                                                        value="{{ auth()->user()->id }}">

                                                    <button type="submit" id="reply-like-{{ $reply->id }}"
                                                        class="action-btn {{ $reply->isAuthUserLikedReply() ? 'text-danger' : '' }}"
                                                        data-mdb-toggle="tooltip" title="likes">
                                                        <span class="r-3">{{ svg('grommet-like') }}</span>
                                                        <span>{{ nice_number($reply->replylikes->where('status', 1)->count()) }}</span>
                                                    </button>
                                                </form>

                                            </span>
                                            <span>
                                                <form method="post" id="reply_dislike_form_{{ $reply->id }}"
                                                    class="d-inline reply-dislike">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="reply_id"
                                                        id="reply_dislike_id_{{ $reply->id }}"
                                                        value="{{ $reply->id }}">
                                                    <input type="hidden" name="user_id"
                                                        id="user_dislike_id_{{ $reply->id }}"
                                                        value="{{ auth()->user()->id }}">
                                                    <button type="submit" id="reply-dislike-{{ $reply->id }}"
                                                        class="action-btn {{ $reply->isAuthUserDisLikedReply() ? 'text-secondary' : '' }} "
                                                        data-mdb-toggle="tooltip" title="dislikes">
                                                        <span class="r-3">{{ svg('grommet-dislike') }}</span>
                                                        <span>{{ nice_number($reply->replylikes->where('status', 0)->count()) }}</span>
                                                    </button>
                                                </form>
                                            </span>
                                            <span class="action-btn text-muted">
                                                <a class="link link-secondary " data-mdb-toggle="collapse"
                                                    href="#collapseReply-{{ $reply->id }}" role="button"
                                                    aria-expanded="false"
                                                    aria-controls="collapseReply-{{ $reply->id }}">
                                                    Reply
                                                </a>
                                                <div class="collapse mt-3" id="collapseReply-{{ $reply->id }}">
                                                    <form method="POST" class="comment-reply-form"
                                                        id="comment_reply_form_{{ $reply->id }}">
                                                        @csrf
                                                        @method('put')
                                                        <input type="hidden" name="user_id"
                                                            value="{{ auth()->user()->id }}">
                                                        <input type="hidden" name="comment_id"
                                                            value="{{ $comment->id }}">
                                                        <input type="hidden" name="replied_user_id"
                                                            value="{{ $reply->user_id }}">
                                                        <textarea type="text" class="form-control" name="content" id="editor2">
                                                            <a class="link link-secondary text-danger" style="text-decoration:none;color:red" href="/users/{{ $reply->user_id }}/{{ $reply->user->username }}/public"><code> {{ '@' }}{{ $reply->user->username }}</code></a>
                                                        </textarea>
                                                        <button type="submit"
                                                            class="mt-2 ml-2 btn2 btn-sm btn btn-outline-primary">reply</button>
                                                    </form>
                                                </div>
                                            </span>
                                        @endguest


                                    </div>
                                </div>

                            </div>
                        @endforeach
                        <div id="new-reply-{{ $comment->id }}">
                        </div>
                    </div>
                </div>
            </div>
            @include('comments.mobileView',["comment"=>$comment])
        @endforeach
    </div>

    {!! $comments->withQueryString()->links('pagination::bootstrap-5') !!}

</div>
