<script>
    $(document).ready(function() {
        // $('.showElement').hover(function() {
        //     var options = {
        //         direction: 'up'
        //     };
        //     var duration = 500;
        //     $('.targetElement').not('#replies-' + $(this).attr('target')).hide('slow');
        //     $('#replies-' + $(this).attr('target')).stop().slideToggle(options, duration);
        // });
        $('.showElementBtn').click(function() {
            var options = {
                direction: 'up'
            };
            var duration = 500;
            $('.targetElement').not('#replies-' + $(this).attr('target')).hide('slow');
            $('#replies-' + $(this).attr('target')).stop().slideToggle(options, duration);
        });
        //add follower using ajax
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(document).on('submit', '.follower-create', function(e) {
            $.ajaxSetup({
                header: $('meta[name="_token"]').attr('content')
            })
            e.preventDefault(e);
            $.ajax({
                type: "POST",
                url: '{{ Route('follower.create') }}',
                data: $(this).serialize(),
                dataType: 'json',
                success: function(data) {
                    if (data.success) {
                        $("#toast-unfollow").html(`<div class="toast toast-fixed  show fade  " id="placement-toast" role="alert" aria-live="assertive"
                            aria-atomic="true"  data-mdb-width="350px"
                            style="width: 350px; display: block; top: unset; left: 10px; bottom: 10px; right: unset; transform: unset;"
                            data-mdb-autohide="true" data-mdb-position="top-right" data-mdb-append-to-body="true">
                            <div class="toast-body">` + data.success + `</div>
                        </div>`);
                        $("#numberOfFollowers-" + data.user_id).text(data.followers +
                            " followers");
                        $("#user_follow_option-" + data.user_id).hide();
                        $("#user_unfollow_option-" + data.user_id).show();
                        setInterval(() => {
                            $("#toast-unfollow").html('');
                        }, 5000);
                    }
                    if (data.error) {
                        $("#toast-unfollow").html(`<div class="toast toast-fixed  show fade  " id="placement-toast" role="alert" aria-live="assertive"
                            aria-atomic="true"  data-mdb-width="350px"
                            style="width: 350px; display: block; top: unset; left: 10px; bottom: 10px; right: unset; transform: unset;"
                            data-mdb-autohide="true" data-mdb-position="top-right" data-mdb-append-to-body="true">
                            <div class="toast-body">` + data.error + `</div>
                        </div>`);
                        $("#numberOfFollowers-" + data.user_id).text(data.followers +
                            " followers");

                        setInterval(() => {
                            $("#toast-unfollow").html('');
                        }, 5000);
                    }
                }
            })
        });


        //delete follower using ajax 
        $(document).on("submit", '.follower-delete', function(e) {
            $.ajaxSetup({
                header: $('meta[name="_token"]').attr('content')
            })
            e.preventDefault(e);
            $.ajax({
                type: "DELETE",
                url: '{{ Route('follower.delete') }}',
                data: $(this).serialize(),
                dataType: 'json',
                success: function(data) {
                    if (data.success) {
                        $("#numberOfFollowers-" + data.user_id).text(data.followers +
                            " followers");
                        $("#user_follow_option-" + data.user_id).show();
                        $("#user_unfollow_option-" + data.user_id).hide();
                        $("#unfollowModal-" + data.user_id).modal('hide');
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
                        $("#numberOfFollowers-" + data.user_id).text(data.followers +
                            " followers");
                        $("#unfollowModal-" + data.user_id).modal('hide');
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

        $(document).on('submit', '#blog_like_form', function(e) {
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
                            `<span>@svg('heroicon-s-thumb-up')</span> ` + data.likes);
                        $("#blog-dislike-" + blog_like_id).html(
                            `<span>@svg('heroicon-s-thumb-down')</span> `);
                        $("#blog-like-" + blog_like_id).addClass(
                            "e-rbtn-liked");
                    }
                    if (data.removed) {
                        $("#blog-like-" + blog_like_id).html(
                            `<span>@svg('heroicon-s-thumb-up')</span> ` + data.likes);
                        $("#blog-dislike-" + blog_like_id).html(
                            `<span>@svg('heroicon-s-thumb-down')</span> `);
                        $("#blog-like-" + blog_like_id).removeClass(
                            "e-rbtn-liked");
                    }
                    if (data.updated) {
                        $("#blog-like-" + blog_like_id).html(
                            `<span>@svg('heroicon-s-thumb-up')</span> ` + data.likes);
                        $("#blog-dislike-" + blog_like_id).html(
                            `<span>@svg('heroicon-s-thumb-down')</span> `);
                        $("#blog-like-" + blog_like_id).addClass(
                            "e-rbtn-liked");
                        $("#blog-dislike-" + blog_like_id).removeClass(
                            "e-rbtn-disliked")
                    }

                }
            })
        });
        //dislike ajax
        $(document).on('submit', '#blog_dislike_form', function(e) {
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
                            `<span>@svg('heroicon-s-thumb-up')</span> ` + data.likes);
                        $("#blog-dislike-" + blog_dislike_id).html(
                            `<span>@svg('heroicon-s-thumb-down')</span> `);
                        $("#blog-dislike-" + blog_dislike_id).addClass(
                            "e-rbtn-disliked");
                    }
                    if (data.removed) {
                        $("#blog-like-" + blog_dislike_id).html(
                            `@svg('heroicon-s-thumb-up')` + data.likes);
                        $("#blog-dislike-" + blog_dislike_id).html(
                            `<span>@svg('heroicon-s-thumb-down')</span> `);
                        $("#blog-dislike-" + blog_dislike_id).removeClass(
                            "e-rbtn-disliked");
                    }
                    if (data.updated) {
                        $("#blog-like-" + blog_dislike_id).html(
                            `<span>@svg('heroicon-s-thumb-up')</span> ` + data.likes);
                        $("#blog-dislike-" + blog_dislike_id).html(
                            `<span>@svg('heroicon-s-thumb-down')</span> `);
                        $("#blog-like-" + blog_dislike_id).removeClass(
                            "e-rbtn-liked");
                        $("#blog-dislike-" + blog_dislike_id).addClass(
                            "e-rbtn-disliked");
                    }

                }
            })
        });
        //comment like
        $(document).on('submit', '.comment-like', function(e) {

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
        $(document).on('submit', '.comment-dislike', function(e) {
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
        $(document).on('submit', '.reply-like', function(e) {

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
        $(document).on('submit', '.reply-dislike', function(e) {
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
        $(document).on('submit', '#blog_comment_form', function(e) {
            $.ajaxSetup({
                header: $('meta[name="_token"]').attr('content')
            })
            e.preventDefault(e);
            $.ajax({
                type: "PUT",
                url: '{{ Route('comment.create') }}',
                data: $(this).serialize(),
                dataType: 'json',
                success: function(data) {
                    if (data.created) {
                        $("#new-comment").append(`
                                <div class="comment m-1" id="comment-` + data.comment.id + `" >
                                    <div class="image">
                                        <img src="https://picsum.photos/400/300" alt="">
                                    </div>
                                    <div class="comment-body">
                                        <span><a class="link link-secondary"
                                                href="/users/` + data.user.id + `/` + data.user.username +
                            `/public">` + data.user.username + `</a>
                                            <small class="text-muted">
                                                just now
                                            </small>
                                        </span>
                                        <p class=" disable mt-2"> ` + data.comment.description + `</p>
                                        <div class="action">
                        
                                            <span>
                                                <form method="POST" id="comment_like_form_` + data.comment.id + `"
                                                    class="d-inline comment-like">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="comment_id" id="comment_like_id_` + data
                            .comment.id + `"
                                                        value="` + data.comment.id + `">
                                                    <input type="hidden" name="user_id" id="user_like_id_` + data
                            .comment.id + `"
                                                        value="` + data.user.id + `">
                                                    <button type="submit" id="comment-like-` + data.comment.id + `"
                                                        class="action-btn  "
                                                        data-mdb-toggle="tooltip" title="likes">
                                                        <span class="r-3">{{ svg('grommet-like') }}</span>
                                                        <span>0</span>
                                                    </button>
                                                </form>

                                            </span>
                                            <span>
                                                <form method="post" id="comment_dislike_form_` + data.comment.id + `"
                                                    class="d-inline comment-dislike">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="comment_id" id="comment_dislike_id_` +
                            data.comment.id + `"
                                                        value="` + data.comment.id + `">
                                                    <input type="hidden" name="user_id" id="user_dislike_id_` + data
                            .comment.id + `"
                                                        value="` + data.user.id + `">
                                                    <button type="submit" id="comment-dislike-` + data.comment.id + `"
                                                        class="action-btn "
                                                        data-mdb-toggle="tooltip" title="dislikes">
                                                        <span class="r-3">{{ svg('grommet-dislike') }}</span>
                                                        <span>0</span>
                                                    </button>
                                                </form>
                                            </span>
                                            <span class="text-muted">
                                                <a class="link link-secondary " data-mdb-toggle="collapse"
                                                    href="#collapseComment-` + data.comment.id + `" role="button" aria-expanded="false"
                                                    aria-controls="collapseComment-` + data.comment.id + `">
                                                    Reply
                                                </a>
                                                <div class="collapse mt-3" id="collapseComment-` + data.comment.id + `">
                                                    <form method="POST" id="blog_comment_form_` + data.comment.id + `">
                                                        @csrf
                                                        @method('put')
                                                        <input type="hidden" name="user_id" value="` + data.user.id + `">
                                                        <input type="hidden" name="comment_id" value="` + data.comment
                            .id + `">
                                                        <textarea type="text" class="form-control" name="comment" id="editor2">Write a reply </textarea>
                                                        <button type="submit"
                                                            class="mt-2 ml-2 btn2 btn-sm btn btn-outline-primary">reply</button>
                                                    </form>
                                                </div>
                                            </span>
                                       </div>
                                    </div>
                                </div>
                                `);
                        tinyMCE.execCommand("mceAddControl", false, editor2);
                    }
                }
            })
        });

        $(document).on('submit', '.comment-reply-form', function(e) {
            $.ajaxSetup({
                header: $('meta[name="_token"]').attr('content')
            })
            e.preventDefault(e);
            $.ajax({
                type: "PUT",
                url: '{{ Route('reply.create') }}',
                data: $(this).serialize(),
                dataType: 'json',
                success: function(data) {
                    if (data.created) {
                        $("#new-reply-" + data.reply.comment_id).append(`
                            <div class="reply" id="reply-` + data.reply.id + ` ">
                                <div class="image">
                                    <img src="https://picsum.photos/400/300" alt="">
                                </div>
                                <div class="reply-body">
                                    <span>
                                        <a href="/users/` + data.user.id + ` /` + data.user.username + ` /public"
                                            class="link link-secondary">` + data.user.username + ` </a>
                                        <small class="text-muted">
                                            just now
                                        </small>
                                    </span>

                                    <p class="mt-2">
                                        ` + data.reply.description + ` 

                                    </p>
                                    <div class="action">
                                       
                                            <span>
                                                <form method="POST" id="reply_like_form_` + data.reply.id + ` "
                                                    class="d-inline reply-like">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="reply_id"
                                                        id="reply_like_id_` + data.reply.id + ` "
                                                        value="` + data.reply.id + ` ">

                                                    <input type="hidden" name="user_id"
                                                        id="user_like_id_` + data.reply.id + ` "
                                                        value="` + data.user.id + `">

                                                    <button type="submit" id="reply-like-` + data.reply.id + ` "
                                                        class="action-btn"
                                                        data-mdb-toggle="tooltip" title="likes">
                                                        <span class="r-3">{{ svg('grommet-like') }}</span>
                                                        <span>0</span>
                                                    </button>
                                                </form>

                                            </span>
                                            <span>
                                                <form method="post" id="reply_dislike_form_` + data.reply.id + ` "
                                                    class="d-inline reply-dislike">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="reply_id"
                                                        id="reply_dislike_id_` + data.reply.id + ` "
                                                        value="` + data.reply.id + ` ">
                                                    <input type="hidden" name="user_id"
                                                        id="user_dislike_id_` + data.reply.id + ` "
                                                        value="` + data.user.id + ` ">
                                                    <button type="submit" id="reply-dislike-` + data.reply.id + ` "
                                                        class="action-btn "
                                                        data-mdb-toggle="tooltip" title="dislikes">
                                                        <span class="r-3">{{ svg('grommet-dislike') }}</span>
                                                        <span>0</span>
                                                    </button>
                                                </form>
                                            </span>
                                            <span class="action-btn text-muted">
                                                <a class="link link-secondary " data-mdb-toggle="collapse"
                                                    href="#collapseReply-` + data.reply.id + `" role="button"
                                                    aria-expanded="false"
                                                    aria-controls="collapseReply-` + data.reply.id + ` ">
                                                    Reply
                                                </a>
                                                <div class="collapse mt-3" id="collapseReply-` + data.reply.id +
                            `">
                                                    <form method="POST"  class="comment-reply-form" id="comment_reply_form_` +
                            data.reply.id + ` ">
                                                        @csrf
                                                        @method('put')
                                                        <input type="hidden" name="user_id"
                                                            value="` + data.user.id + ` ">
                                                        <input type="hidden" name="comment_id"
                                                            value="` + data.reply.comment_id +
                            ` ">
                                                        <input type="hidden" name="replied_user_id"
                                                            value="">
                                                        <textarea type="text" class="form-control" name="content" id="editor2">
                                                            <a class="link link-secondary text-danger" style="text-decoration:none;color:red" href="/users/` +
                            data.user.id + ` /` + data.user.username +
                            ` /public"><code> @` + data.user.username + ` </code></a>
                                                        </textarea>
                                                        <button type="submit"
                                                            class="mt-2 ml-2 btn2 btn-sm btn btn-outline-primary">reply</button>
                                                    </form>
                                                </div>
                                            </span>
                                    </div>
                                </div>
                            </div>


                            `);
                        tinyMCE.execCommand("mceAddControl", false, editor2);
                    }


                }
            })
        });

        $(document).on('mouseover', '.tag-popover', function(e) {
            e.preventDefault(e);
            var el = $(this);
            var timeoutId = setTimeout(function() {
                $.ajaxSetup({
                    header: $('meta[name="_token"]').attr('content')
                })

                var id = el.attr('id');
                var dummyVar = id.split('-');
                var tag_id = dummyVar[1];
                $.ajax({
                    type: "GET",
                    url: '/tag-detail',
                    data: {
                        tagId: tag_id
                    },
                    dataType: 'json',
                    success: function(data) {
                        if (data.success) {
                            $('#' + id).webuiPopover({
                                content: ` <div class="e-card  shadow-1  ">
                                        <div class="e-card-body">
                                            <a href="blogs/tagged/` + data.tag[0].title + `">
                                            <span class="modern-badge  modern-badge-` + data.tag[0].color + `">#` + data
                                    .tag[0].title + `</span></a>

                                            <p class="mt-3 mb-3">Some quick example text to build on the card title and make up the bulk of
                                                the card's content.</p>
                                            <span class="text-muted">` + data.tag[0].blogs_count + ` blogs</span>
                                        </div>
                                    </div>`,
                                animation: 'pop',
                                width: 400,
                                trigger: 'hover',
                                placement: 'auto',
                                delay: {
                                    show: null,
                                    hide: 300
                                },
                            });
                            $('#' + id).webuiPopover('show');

                        }

                    }
                })
            }, 2000);
            el.mouseleave(function() {
                clearTimeout(timeoutId);
            });

        });

        $(document).on('mouseover', '.user-popover', function(e) {
            var el = $(this);
            e.preventDefault(e);
            var timeoutId = setTimeout(function() {
                $.ajaxSetup({
                    header: $('meta[name="_token"]').attr('content')
                })

                var id = el.attr('id');
                var dummyVar = id.split('-');
                var user_id = dummyVar[1];
                $.ajax({
                    type: "GET",
                    url: '/user-detail',
                    data: {
                        userId: user_id
                    },
                    dataType: 'json',
                    success: function(data) {
                        $('#' + id).webuiPopover({
                            content: data,
                            animation: 'pop',
                            trigger: 'hover',
                            placement: 'auto',
                            width: 500,
                            delay: {
                                show: null,
                                hide: 300
                            }
                        });
                        $('#' + id).webuiPopover('show');
                    }
                })
            }, 2000);
            el.mouseleave(function() {
                clearTimeout(timeoutId);

            });

        });

        $('form.bookmark_form').on('submit', function(e) {
            $.ajaxSetup({
                header: $('meta[name="_token"]').attr('content')
            })
            e.preventDefault(e);
            var id = $(this).attr('id');
            var dummyVar = id.split('-');
            var blog_id = dummyVar[1];
            var blog_bookmark_id = $("#blog_bookmark_id_" + blog_id).val();
            var user_bookmark_id = $("#user_bookmark_id_" + blog_id).val();
            $.ajax({
                type: "PUT",
                url: '{{ Route('bookmark.create') }}',
                data: {
                    blogId: blog_bookmark_id,
                    userId: user_bookmark_id,
                },
                dataType: 'json',
                success: function(data) {
                    if (data.created) {
                        $(".bookmark_btn_" + blog_bookmark_id).html(`@svg('gmdi-bookmark-added-r', 'bookmark-active')`)
                            .fadeIn(150);
                        $("#toast-info").html(`<div class="toast toast-fixed  show fade  " id="placement-toast" role="alert" aria-live="assertive"
                            aria-atomic="true"  data-mdb-width="350px"
                            style="width: 350px; display: block; top: unset; left: 10px; bottom: 10px; right: unset; transform: unset;"
                            data-mdb-autohide="true" data-mdb-position="top-right" data-mdb-append-to-body="true">
                            <div class="toast-body ">` + data.success + `</div>
                            </div>`);
                        setInterval(() => {
                            $("#toast-info").html('');
                        }, 5000);
                    }
                    if (data.removed) {
                        $(".bookmark_btn_" + blog_bookmark_id).html(`@svg('gmdi-bookmark-add-o')`)
                            .fadeIn(150);
                        $("#toast-info").html(`<div class="toast toast-fixed bg-danger text-white show fade  " id="placement-toast" role="alert" aria-live="assertive"
                            aria-atomic="true"  data-mdb-width="350px"
                            style="width: 350px; display: block; top: unset; left: 10px; bottom: 10px; right: unset; transform: unset;"
                            data-mdb-autohide="true" data-mdb-position="top-right" data-mdb-append-to-body="true">
                            <div class="toast-body ">` + data.success + `</div>
                            </div>`);
                        setInterval(() => {
                            $("#toast-info").html('');
                        }, 5000);
                    }
                }
            })
        });


        //search ajax 
        typeof $.typeahead === 'function' && $.typeahead({
            input: '.js-typeahead-search',
            minLength: 1,
            maxItem: 15,
            order: "asc",
            hint: true,
            maxItemPerGroup: 3,
            backdrop: {
                "background-color": "#fff"
            },
            group: function(group) {
                return {
                    template: group
                }
            },
            order: "asc",
            hint: true,
            blurOnTab: true,
            matcher: function(item, displayKey) {
                if (item.id === "BOS") {
                    item.disabled = true;
                }
                return true;
            },
            dynamic: true,
            hint: true,

            templateValue: name,
            emptyTemplate: function(query) {
                return `no result for "` + query + `"`;
            },
            highlight: true,
            source: {
                tags: {
                    display: "title",
                    href: function(item) {
                        return `/blogs/tagged/` + item.title;
                    },
                    ajax: function(query) {
                        return {
                            url: "/search/option/tags",
                            type: 'GET',
                            data: {
                                query: query
                            },
                            dataType: 'json',
                            callback: {
                                done: function(data) {

                                    return data.tags;
                                }
                            }
                        }
                    },
                    template: function(query, item) {
                        return `  
                                <span
                                    id="searchTag-` + item.id+ `" class="modern-badge  modern-badge-` + item.color + ` tag-popover">
                                    #` + item.title + `
                                </span>`
                    }
                },
                users: {
                    display: ["name", "username"],
                    href: function(item) {
                        return `/users/` + item.id + `/` + item.username + `/public`;
                    },
                    ajax: function(query) {
                        return {
                            url: "/search/option/users",
                            type: 'GET',
                            data: {
                                query: query
                            },
                            dataType: 'json',
                            callback: {
                                done: function(data) {

                                    return data.users;
                                }
                            }
                        }
                    },
                    template: function(query, item) {
                        return `
                            <div class="search-user">
                                <div class="image">
                                    <img class="user-img" src="https://picsum.photos/400/300" alt="">
                                </div>
                                <div class="user-detail">
                                    ` + item.username + `
                                </div>
                            </div>`
                    }
                },
                blogs: {
                    display: "title",
                    href: function(item) {
                        return `/blogs/` + item.id;
                    },
                    ajax: function(query) {
                        return {
                            url: "/search/option/blogs",
                            type: 'GET',
                            data: {
                                query: query
                            },
                            dataType: 'json',
                            callback: {
                                done: function(data) {
                                    return data.blogs;
                                }
                            }
                        }
                    },
                    template: function(query, item) {
                        return ` <div class="e-card  shadow-1  ">
                        <div class="e-card-body">
                            <a>
                                <span>` + item.title + `</span>
                            </a>
                            <p class="mt-3 mb-3">Some quick example text to build on the card title and make up the bulk of
                                the card's content.Some quick example text to build on the card title and make up the bulk of
                                the card's content.Some quick example text to build on the card title and make up the bulk of
                                the card's content.Some quick example text to build on the card title and make up the bulk of
                                the card's content.</p>
                            <span class="text-muted">blogs</span>
                        </div>
                    </div>`
                    },
                },
            },
        });

    });
</script>
