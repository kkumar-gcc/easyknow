@extends('layouts.nodistraction')
@push('styles')
    <x-head.tinymce-config />
@endpush
@section('content')
    <?php
    function nice_number($n)
    {
        $n = 0 + str_replace(',', '', $n);
        if (!is_numeric($n)) {
            return false;
        }
        if ($n > 1000000000000) {
            return round($n / 1000000000000, 1) . 't ';
        } elseif ($n > 1000000000) {
            return round($n / 1000000000, 1) . 'b ';
        } elseif ($n > 1000000) {
            return round($n / 1000000, 1) . 'm ';
        } elseif ($n > 1000) {
            return round($n / 1000, 1) . 'k ';
        }
        return number_format($n);
    }
    ?>

    <div class="container-fluid detailed-blog">

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/blogs" class="link link-secondary">Blogs</a></li>
                <li class="breadcrumb-item active" aria-current="page">
                    {{-- {{ $blog->title }} --}}
                    {!! Str::words($blog->title, 4) !!}
                </li>
            </ol>
        </nav>
        @if (session()->has('success'))
            <section class=" d-flex justify-content-center my-4 w-100">
                <div class="container">
                    <div class="alert alert-dismissible fade show alert-success" role="alert" data-mdb-color="warning"
                        id="customxD">
                        <strong>Success!</strong> {{ session()->get('success') }}
                        <button type="button" class="btn-close" data-mdb-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            </section>
        @endif
        <a type="button" href="{{ url()->previous() }}" class="btn btn-outline-dark" data-mdb-ripple-color="dark">back</a>
        <h1 class="title"><a class="link link-secondary" href="/blogs/{{ $blog->id }}">{{ $blog->title }}</a>
        </h1>
        <div class="user row">
            <div class="user-left ">
                <div class="image">
                    <img src="https://picsum.photos/400/300" alt="">
                </div>
                <div class="info">
                    <p> <a class="link link-secondary"
                            href="/users/{{ $blog->user_id }}/{{ $blog->user->username }}/public">
                            {{ __($blog->user->username) }}
                        </a></p>
                    <span id="numberOfFollowers-{{ $blog->user_id }}">{{ $blog->user->friendships->count() }}
                        followers</span>
                </div>
            </div>
            <div class="user-right">
                @guest
                    <a class="btn btn-danger link" href="#">
                        {{-- {{ svg('gmdi-person-add-alt-1-r') }} --}}
                        {{ __('Follow') }}
                    </a>
                @else
                    <div id="toast-unfollow">

                    </div>
                    @if (auth()->user()->id == $blog->user_id)
                        <a class="btn2 btn btn-primary link"
                            href="/users/{{ $blog->user_id }}/{{ $blog->user->username }}/public">
                            {{-- {{ svg('gmdi-person-add-alt-1-r') }} --}}
                            {{ __('View Profile') }}
                        </a>
                    @else
                        @if ($friendship < 1)
                            <div id="user_follow_option">
                                <form method="post" id="follower_create">
                                    @csrf
                                    <input type="hidden" name="follower_id" id="follower_id"
                                        value="{{ auth()->user()->id }}">
                                    <input type="hidden" name="user_id" id="user_id" value="{{ $blog->user_id }}">
                                    <button type="submit" class="btn btn-danger">Follow</button>
                                </form>
                            </div>
                            <div id="user_unfollow_option" style="display: none;">

                                <button type="button" class="btn btn-outline-dark" data-mdb-ripple-color="dark"
                                    data-mdb-toggle="modal"
                                    data-mdb-target="#unfollowModal-{{ $blog->user_id }}">Unfollow</button>
                            </div>
                        @else
                            <div id="user_follow_option" style="display: none;">
                                <form method="post" id="follower_create">
                                    @csrf
                                    <input type="hidden" name="follower_id" id="follower_id"
                                        value="{{ auth()->user()->id }}">
                                    <input type="hidden" name="user_id" id="user_id" value="{{ $blog->user_id }}">
                                    <button type="submit" class="btn btn-danger">Follow</button>
                                </form>
                            </div>
                            <div id="user_unfollow_option">

                                <button type="button" class="btn btn-outline-dark" data-mdb-ripple-color="dark"
                                    data-mdb-toggle="modal"
                                    data-mdb-target="#unfollowModal-{{ $blog->user_id }}">Unfollow</button>
                            </div>
                        @endif
                        <div class="modal fade" id="unfollowModal-{{ $blog->user_id }}" tabindex="-1"
                            aria-labelledby="unfollowModal-{{ $blog->user_id }}-Label" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-sm">
                                <div class="modal-content">

                                    <div class="card-body text-center">
                                        unfollow to " <strong class="font-weight-bold">{{ $blog->user->username }}
                                        </strong>" ?
                                        <hr>

                                        <form method="POST" id="follower_delete" action="{{ Route('follower.delete') }}">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" name="follower_id" id="follower_d_id"
                                                value="{{ auth()->user()->id }}">
                                            <input type="hidden" name="user_id" id="user_d_id" value="{{ $blog->user_id }}">
                                            <div class="form-group">
                                                <button type="button"
                                                    class="sbtn text-dark border-dark bg-white btn-outline-dark"
                                                    data-mdb-dismiss="modal">No</button>
                                                <input type="submit"
                                                    class="sbtn text-danger border-danger bg-white btn-outline-danger"
                                                    value="Unfollow">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endguest
            </div>
        </div>
        <hr>


        @can('isOwner', $blog)
            <div class="modal fade" id="deleteModal-{{ $blog->id }}" tabindex="-1"
                aria-labelledby="deleteModal-{{ $blog->id }}-Label" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Delete Confirmation</h5>
                            <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="card-body">
                            Do you really want to delete blog " <strong class="font-weight-bold">{{ $blog->title }}
                            </strong>" ?

                        </div>
                        <div class="modal-footer">
                            <form method="POST" action="/blog/{{ $blog->id }}/delete">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="user_id" value="{{ $blog->user_id }}">
                                <div class="form-group">
                                    <button type="button" class="btn btn-outline-dark" data-mdb-dismiss="modal">No</button>
                                    <input type="submit" class="btn btn-outline-danger" value="Yes">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="blog-bar">
                <div class="blog-bar-right">
                    <ul>
                        <li class="blog-bar-item">
                            <a type="button" data-mdb-toggle="modal" role="button"
                                class="blog-bar-link sbtn link text-warning border-warning  btn-outline-warning"
                                href="#blogEditModal-{{ $blog->id }}">
                                <span>{{ svg('feathericon-edit') }}</span> Edit
                            </a>
                        </li>
                        <li class="blog-bar-item">

                            <a type="button" data-mdb-toggle="modal" role="button"
                                class="blog-bar-link sbtn text-danger border-danger btn-outline-danger link link-secondary"
                                href="#deleteModal-{{ $blog->id }}">
                                <span>{{ svg('gmdi-delete') }}</span> delete
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            @include('blogs.update', ['blog' => $blog])
        @endcan



        <div class="blog-bar">
            <div class="blog-bar-left">
                <span>{{ nice_number($blog->likes) }} views</span>

                <span class="text-muted "> Published on
                    {{ \Carbon\Carbon::parse($blog->created_at)->format('M d, Y') }}
                </span>
            </div>

            <div class="blog-bar-right">

                @guest
                    <ul>
                        <li class="blog-bar-item">
                            <button class="blog-bar-link bg-white sbtn link link-secondary" data-mdb-toggle="tooltip"
                                title="likes">
                                <span>{{ svg('grommet-like') }}</span>
                                {{ nice_number($blog->bloglikes->where('status', 1)->count()) }}
                            </button>
                        </li>
                        <li class="blog-bar-item">
                            <button class="blog-bar-link sbtn bg-white link link-secondary" data-mdb-toggle="tooltip"
                                title="dislikes">
                                <span>{{ svg('grommet-dislike') }}</span>
                                {{ nice_number($blog->bloglikes->where('status', 0)->count()) }}
                            </button>
                        </li>
                        <li class="blog-bar-item">
                            <a class="blog-bar-link sbtn bg-white link link-secondary" href="#comments"
                                data-mdb-toggle="tooltip" title="comments">
                                <span><i class="tim-icons icon-chat-33"></i></span>
                                {{ nice_number($blog->comments->count()) }}
                            </a>
                        </li>
                        <li class="blog-bar-item">
                            <button class="blog-bar-link bg-white sbtn link link-secondary" data-mdb-toggle="tooltip"
                                title="share">
                                <span>{{ svg('bx-share') }}</span> 1
                            </button>
                        </li>

                    </ul>
                @else
                    <ul>
                        <li class="blog-bar-item">
                            <form method="post" id="blog_like_form" class="d-inline">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="blog_id" id="blog_like_id" value="{{ $blog->id }}">
                                <input type="hidden" name="user_id" id="user_like_id" value="{{ auth()->user()->id }}">
                                <button type="submit" id="blog-like-{{ $blog->id }}"
                                    class="blog-bar-link bg-white sbtn @isset($like) {{ $like->status == 1 ? 'text-danger border-danger' : '' }} @endisset  link link-secondary"
                                    data-mdb-toggle="tooltip" title="likes">
                                    <span>{{ svg('grommet-like') }}</span>
                                    {{ nice_number($blog->bloglikes->where('status', 1)->count()) }}
                                </button>
                            </form>
                        </li>
                        <li class="blog-bar-item">
                            <form method="post" id="blog_dislike_form" class="d-inline">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="blog_id" id="blog_dislike_id" value="{{ $blog->id }}">
                                <input type="hidden" name="user_id" id="user_dislike_id" value="{{ auth()->user()->id }}">
                                <button type="submit" id="blog-dislike-{{ $blog->id }}"
                                    class="blog-bar-link sbtn bg-white @isset($like) {{ $like->status == 0 ? 'text-secondary border-secondary' : '' }} @endisset  link link-secondary"
                                    data-mdb-toggle="tooltip" title="dislikes">
                                    <span>{{ svg('grommet-dislike') }}</span>
                                    {{ nice_number($blog->bloglikes->where('status', 0)->count()) }}
                                </button>
                            </form>
                        </li>
                        <li class="blog-bar-item">
                            <a class="blog-bar-link sbtn bg-white link link-secondary" href="#comments"
                                data-mdb-toggle="tooltip" title="comments">
                                <span><i class="tim-icons icon-chat-33"></i></span>
                                {{ nice_number($blog->comments->count()) }}
                            </a>
                        </li>
                        <li class="blog-bar-item">
                            <button class="blog-bar-link bg-white sbtn link link-secondary" data-mdb-toggle="tooltip"
                                title="share">
                                <span>{{ svg('bx-share') }}</span> 1
                            </button>
                        </li>

                    </ul>
                @endguest
            </div>

        </div>

        @foreach ($blog->tags as $tag)
            <span class="modern-badge modern-badge-{{ $tag->color }}">{{ $tag->title }}</span>
        @endforeach


        <div class="blog-description">
            <div class="image">
                <img src="https://picsum.photos/400/300" alt="">
            </div>
            <div class="description">
                {!! $blog->description !!}

            </div>
        </div>

        <div>
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Comments({{ $blog->comments->count() }})</h5>
            </div>
            @include('comments.index', ['comments' => $comments])
        </div>
    </div>
@endsection

@push('script')
    <script>
        $(document).ready(function() {
            $('.showElement').click(function() {
                $('.targetElement').not('#replies-' + $(this).attr('target')).hide();
                $('#replies-' + $(this).attr('target')).toggle();
            });
            //add follower using ajax
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('#follower_create').on('submit', function(e) {
                $.ajaxSetup({
                    header: $('meta[name="_token"]').attr('content')
                })
                e.preventDefault(e);
                var user_id = $("#user_id").val();
                var follower_id = $("#follower_id").val();
                $.ajax({
                    type: "POST",
                    url: '{{ Route('follower.create') }}',
                    data: {
                        userId: user_id,
                        followerId: follower_id
                    },
                    dataType: 'json',
                    success: function(data) {
                        if (data.success) {
                            $("#toast-unfollow").html(`<div class="toast toast-fixed  show fade  " id="placement-toast" role="alert" aria-live="assertive"
                            aria-atomic="true"  data-mdb-width="350px"
                            style="width: 350px; display: block; top: unset; left: 10px; bottom: 10px; right: unset; transform: unset;"
                            data-mdb-autohide="true" data-mdb-position="top-right" data-mdb-append-to-body="true">
                            <div class="toast-body">` + data.success + `</div>
                        </div>`);
                            $("#numberOfFollowers-" + user_id).text(data.followers +
                                " followers");
                            $("#user_follow_option").hide();
                            $("#user_unfollow_option").show();
                            setInterval(() => {
                                $("#toast-unfollow").html('');
                            }, 5000);
                        }
                    }

                })

            });

            $("#follower_delete").on("submit", function(e) {
                $.ajaxSetup({
                    header: $('meta[name="_token"]').attr('content')
                })
                e.preventDefault(e);
                var user_d_id = $("#user_d_id").val();
                var follower_d_id = $("#follower_d_id").val();
                $.ajax({
                    type: "DELETE",
                    url: '{{ Route('follower.delete') }}',
                    data: {
                        userId: user_d_id,
                        followerId: follower_d_id
                    },
                    dataType: 'json',
                    success: function(data) {
                        if (data.success) {
                            $("#numberOfFollowers-" + user_d_id).text(data.followers +
                                " followers");
                            $("#user_follow_option").show();
                            $("#user_unfollow_option").hide();
                            $("#unfollowModal-" + user_d_id).modal('hide');
                            $("#toast-unfollow").html(`<div class="toast toast-fixed bg-danger text-white show fade  " id="placement-toast" role="alert" aria-live="assertive"
                            aria-atomic="true"  data-mdb-width="350px"
                            style="width: 350px; display: block; top: unset; left: 10px; bottom: 10px; right: unset; transform: unset;"
                            data-mdb-autohide="true" data-mdb-position="top-right" data-mdb-append-to-body="true">
                            <div class="toast-body ">` + data.success + `</div>
                            </div>`);
                            setInterval(() => {
                                $("#toast-unfollow").html('');
                            }, 5000);
                        }
                        if (data.error) {
                            $("#numberOfFollowers-" + user_d_id).text(data.followers +
                                " followers");
                            $("#unfollowModal-" + user_d_id).modal('hide');
                            $("#toast-unfollow").html(`<div class="toast toast-fixed bg-danger text-white show fade  " id="placement-toast" role="alert" aria-live="assertive"
                                aria-atomic="true"  data-mdb-width="350px"
                                style="width: 350px; display: block; top: unset; left: 10px; bottom: 10px; right: unset; transform: unset;"
                                data-mdb-autohide="true" data-mdb-position="top-right" data-mdb-append-to-body="true">
                                <div class="toast-body ">` + data.error + `</div>
                                </div>`);
                            setInterval(() => {
                                $("#toast-unfollow").html('');
                            }, 5000);
                        }
                    }


                })
            })


            //like blog using ajax 

            $('#blog_like_form').on('submit', function(e) {
                $.ajaxSetup({
                    header: $('meta[name="_token"]').attr('content')
                })
                e.preventDefault(e);
                var blog_like_id = $("#blog_like_id").val();
                var user_like_id = $("#user_like_id").val();
                $.ajax({
                    url: '{{ Route('bloglike.create') }}',
                    type: "PUT",
                    data: {
                        blogId: blog_like_id,
                        userId: user_like_id,
                    },
                    dataType: 'json',
                    success: function(data) {
                        if (data.created) {
                            $("#blog-like-" + blog_like_id).html(
                                `<span>{{ svg('grommet-like') }}</span> ` + data.likes);
                            $("#blog-dislike-" + blog_like_id).html(
                                `<span>{{ svg('grommet-dislike') }}</span> ` + data
                                .dislikes);
                            $("#blog-like-" + blog_like_id).addClass(
                                "text-danger border-danger");
                        }
                        if (data.removed) {
                            $("#blog-like-" + blog_like_id).html(
                                `<span>{{ svg('grommet-like') }}</span> ` + data.likes);
                            $("#blog-dislike-" + blog_like_id).html(
                                `<span>{{ svg('grommet-dislike') }}</span> ` + data
                                .dislikes);
                            $("#blog-like-" + blog_like_id).removeClass(
                                "text-danger border-danger");
                        }
                        if (data.updated) {
                            $("#blog-like-" + blog_like_id).html(
                                `<span>{{ svg('grommet-like') }}</span> ` + data.likes);
                            $("#blog-dislike-" + blog_like_id).html(
                                `<span>{{ svg('grommet-dislike') }}</span> ` + data
                                .dislikes);
                            $("#blog-like-" + blog_like_id).addClass(
                                "text-danger border-danger");
                            $("#blog-dislike-" + blog_like_id).removeClass(
                                "text-secondary border-secondary")
                        }

                    }
                })
            });
            //dislike ajax
            $('#blog_dislike_form').on('submit', function(e) {
                $.ajaxSetup({
                    header: $('meta[name="_token"]').attr('content')
                })
                e.preventDefault(e);
                var blog_dislike_id = $("#blog_dislike_id").val();
                var user_dislike_id = $("#user_dislike_id").val();
                $.ajax({
                    type: "PUT",
                    url: '{{ Route('blogdislike.create') }}',
                    data: {
                        blogId: blog_dislike_id,
                        userId: user_dislike_id,
                    },
                    dataType: 'json',
                    success: function(data) {
                        if (data.created) {
                            $("#blog-like-" + blog_dislike_id).html(
                                `<span>{{ svg('grommet-like') }}</span> ` + data.likes);
                            $("#blog-dislike-" + blog_dislike_id).html(
                                `<span>{{ svg('grommet-dislike') }}</span> ` + data
                                .dislikes);
                            $("#blog-dislike-" + blog_dislike_id).addClass(
                                "text-secondary border-secondary");
                        }
                        if (data.removed) {
                            $("#blog-like-" + blog_dislike_id).html(
                                `<span>{{ svg('grommet-like') }}</span> ` + data.likes);
                            $("#blog-dislike-" + blog_dislike_id).html(
                                `<span>{{ svg('grommet-dislike') }}</span> ` + data
                                .dislikes);
                            $("#blog-dislike-" + blog_dislike_id).removeClass(
                                "text-secondary border-secondary");
                        }
                        if (data.updated) {
                            $("#blog-like-" + blog_dislike_id).html(
                                `<span>{{ svg('grommet-like') }}</span> ` + data.likes);
                            $("#blog-dislike-" + blog_dislike_id).html(
                                `<span>{{ svg('grommet-dislike') }}</span> ` + data
                                .dislikes);
                            $("#blog-like-" + blog_dislike_id).removeClass(
                                "text-danger border-danger");
                            $("#blog-dislike-" + blog_dislike_id).addClass(
                                "text-secondary border-secondary");
                        }

                    }
                })
            });


            //comment like
            $("form.comment-like").on('submit', function(e) {

                $.ajaxSetup({
                    header: $('meta[name="_token"]').attr('content')
                })
                e.preventDefault(e);
                var id = $(this).attr('id');
                var comment_id = id.substr(18, id.length - 1)

                var comment_like_id = $("#comment_like_id_" + comment_id).val();
                var user_like_id = $("#user_like_id_" + comment_id).val();
                $.ajax({
                    url: '/commentlike/create',
                    type: "PUT",
                    data: {
                        commentId: comment_like_id,
                        userId: user_like_id
                    },
                    dataType: 'json',
                    success: function(data) {
                        if (data.created) {
                            $("#comment-like-" + comment_like_id).html(
                                `<span>{{ svg('grommet-like') }}</span> ` + data.likes);
                            $("#comment-dislike-" + comment_like_id).html(
                                `<span>{{ svg('grommet-dislike') }}</span> ` + data
                                .dislikes);
                            $("#comment-like-" + comment_like_id).addClass(
                                "text-danger border-danger");
                        }
                        if (data.removed) {
                            $("#comment-like-" + comment_like_id).html(
                                `<span>{{ svg('grommet-like') }}</span> ` + data.likes);
                            $("#comment-dislike-" + comment_like_id).html(
                                `<span>{{ svg('grommet-dislike') }}</span> ` + data
                                .dislikes);
                            $("#comment-like-" + comment_like_id).removeClass(
                                "text-danger border-danger");
                        }
                        if (data.updated) {
                            $("#comment-like-" + comment_like_id).html(
                                `<span>{{ svg('grommet-like') }}</span> ` + data.likes);
                            $("#comment-dislike-" + comment_like_id).html(
                                `<span>{{ svg('grommet-dislike') }}</span> ` + data
                                .dislikes);
                            $("#comment-like-" + comment_like_id).addClass(
                                "text-danger border-danger");
                            $("#comment-dislike-" + comment_like_id).removeClass(
                                "text-secondary border-secondary")
                        }

                    }
                });
            })

            //dislike ajax
            $('form.comment-dislike').on('submit', function(e) {
                $.ajaxSetup({
                    header: $('meta[name="_token"]').attr('content')
                })
                e.preventDefault(e);
                var id = $(this).attr('id');
                var comment_id = id.substr(21, id.length - 1)
                console.log(id, comment_id);
                var comment_dislike_id = $("#comment_dislike_id_" + comment_id).val();
                var user_dislike_id = $("#user_dislike_id_" + comment_id).val();
                $.ajax({
                    type: "PUT",
                    url: '{{ Route('commentdislike.create') }}',
                    data: {
                        commentId: comment_dislike_id,
                        userId: user_dislike_id,
                    },
                    dataType: 'json',
                    success: function(data) {
                        if (data.created) {
                            $("#comment-like-" + comment_dislike_id).html(
                                `<span>{{ svg('grommet-like') }}</span> ` + data.likes);
                            $("#comment-dislike-" + comment_dislike_id).html(
                                `<span>{{ svg('grommet-dislike') }}</span> ` + data
                                .dislikes);
                            $("#comment-dislike-" + comment_dislike_id).addClass(
                                "text-secondary border-secondary");
                        }
                        if (data.removed) {
                            $("#comment-like-" + comment_dislike_id).html(
                                `<span>{{ svg('grommet-like') }}</span> ` + data.likes);
                            $("#comment-dislike-" + comment_dislike_id).html(
                                `<span>{{ svg('grommet-dislike') }}</span> ` + data
                                .dislikes);
                            $("#comment-dislike-" + comment_dislike_id).removeClass(
                                "text-secondary border-secondary");
                        }
                        if (data.updated) {
                            $("#comment-like-" + comment_dislike_id).html(
                                `<span>{{ svg('grommet-like') }}</span> ` + data.likes);
                            $("#comment-dislike-" + comment_dislike_id).html(
                                `<span>{{ svg('grommet-dislike') }}</span> ` + data
                                .dislikes);
                            $("#comment-like-" + comment_dislike_id).removeClass(
                                "text-danger border-danger");
                            $("#comment-dislike-" + comment_dislike_id).addClass(
                                "text-secondary border-secondary");
                        }

                    }
                })
            });

            //comment like
            $("form.reply-like").on('submit', function(e) {

                $.ajaxSetup({
                    header: $('meta[name="_token"]').attr('content')
                })
                e.preventDefault(e);
                var id = $(this).attr('id');

                var reply_id = id.substr(16, id.length - 1)

                var reply_like_id = $("#reply_like_id_" + reply_id).val();
                var user_like_id = $("#user_like_id_" + reply_id).val();
                $.ajax({
                    url: '/replylike/create',
                    type: "PUT",
                    data: {
                        replyId: reply_like_id,
                        userId: user_like_id
                    },
                    dataType: 'json',
                    success: function(data) {
                        if (data.created) {
                            $("#reply-like-" + reply_like_id).html(
                                `<span>{{ svg('grommet-like') }}</span> ` + data.likes);
                            $("#reply-dislike-" + reply_like_id).html(
                                `<span>{{ svg('grommet-dislike') }}</span> ` + data
                                .dislikes);
                            $("#reply-like-" + reply_like_id).addClass(
                                "text-danger border-danger");
                        }
                        if (data.removed) {
                            $("#reply-like-" + reply_like_id).html(
                                `<span>{{ svg('grommet-like') }}</span> ` + data.likes);
                            $("#reply-dislike-" + reply_like_id).html(
                                `<span>{{ svg('grommet-dislike') }}</span> ` + data
                                .dislikes);
                            $("#reply-like-" + reply_like_id).removeClass(
                                "text-danger border-danger");
                        }
                        if (data.updated) {
                            $("#reply-like-" + reply_like_id).html(
                                `<span>{{ svg('grommet-like') }}</span> ` + data.likes);
                            $("#reply-dislike-" + reply_like_id).html(
                                `<span>{{ svg('grommet-dislike') }}</span> ` + data
                                .dislikes);
                            $("#reply-like-" + reply_like_id).addClass(
                                "text-danger border-danger");
                            $("#reply-dislike-" + reply_like_id).removeClass(
                                "text-secondary border-secondary")
                        }

                    }
                });
            })

            //dislike ajax
            $('form.reply-dislike').on('submit', function(e) {
                $.ajaxSetup({
                    header: $('meta[name="_token"]').attr('content')
                })
                e.preventDefault(e);
                var id = $(this).attr('id');
                var reply_id = id.substr(19, id.length - 1)
                console.log(id, reply_id);
                var reply_dislike_id = $("#reply_dislike_id_" + reply_id).val();
                var user_dislike_id = $("#user_dislike_id_" + reply_id).val();
                $.ajax({
                    type: "PUT",
                    url: '{{ Route('replydislike.create') }}',
                    data: {
                        replyId: reply_dislike_id,
                        userId: user_dislike_id,
                    },
                    dataType: 'json',
                    success: function(data) {
                        if (data.created) {
                            $("#reply-like-" + reply_dislike_id).html(
                                `<span>{{ svg('grommet-like') }}</span> ` + data.likes);
                            $("#reply-dislike-" + reply_dislike_id).html(
                                `<span>{{ svg('grommet-dislike') }}</span> ` + data
                                .dislikes);
                            $("#reply-dislike-" + reply_dislike_id).addClass(
                                "text-secondary border-secondary");
                        }
                        if (data.removed) {
                            $("#reply-like-" + reply_dislike_id).html(
                                `<span>{{ svg('grommet-like') }}</span> ` + data.likes);
                            $("#reply-dislike-" + reply_dislike_id).html(
                                `<span>{{ svg('grommet-dislike') }}</span> ` + data
                                .dislikes);
                            $("#reply-dislike-" + reply_dislike_id).removeClass(
                                "text-secondary border-secondary");
                        }
                        if (data.updated) {
                            $("#reply-like-" + reply_dislike_id).html(
                                `<span>{{ svg('grommet-like') }}</span> ` + data.likes);
                            $("#reply-dislike-" + reply_dislike_id).html(
                                `<span>{{ svg('grommet-dislike') }}</span> ` + data
                                .dislikes);
                            $("#reply-like-" + reply_dislike_id).removeClass(
                                "text-danger border-danger");
                            $("#reply-dislike-" + reply_dislike_id).addClass(
                                "text-secondary border-secondary");
                        }

                    }
                })
            });
        });
    </script>
@endpush
