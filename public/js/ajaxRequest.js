$(document).ready(function () {
    //add follower using ajax
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    $("#follower_create").on("submit", function (e) {
        $.ajaxSetup({
            header: $('meta[name="_token"]').attr("content"),
        });
        e.preventDefault(e);
        var user_id = $("#user_id").val();
        var follower_id = $("#follower_id").val();
        console.log(user_id, follower_id);
        $.ajax({
            type: "POST",
            url: "/follower/create",
            data: {
                userId: user_id,
                followerId: follower_id,
            },
            dataType: "json",
            success: function (data) {
                if (data.success) {
                    $("#toast-unfollow").html(
                        `<div class="toast toast-fixed  show fade  " id="placement-toast" role="alert" aria-live="assertive"
                            aria-atomic="true"  data-mdb-width="350px"
                            style="width: 350px; display: block; top: unset; left: 10px; bottom: 10px; right: unset; transform: unset;"
                            data-mdb-autohide="true" data-mdb-position="top-right" data-mdb-append-to-body="true">
                            <div class="toast-body">` +
                            data.success +
                            `</div>
                        </div>`
                    );
                    $("#numberOfFollowers-" + user_id).text(
                        data.followers + " followers"
                    );
                    $("#user_follow_option").hide();
                    $("#user_unfollow_option").show();
                    setInterval(() => {
                        $("#toast-unfollow").html("");
                    }, 5000);
                }
                if (data.error) {
                    $("#toast-unfollow").html(
                        `<div class="toast toast-fixed  show fade  " id="placement-toast" role="alert" aria-live="assertive"
                            aria-atomic="true"  data-mdb-width="350px"
                            style="width: 350px; display: block; top: unset; left: 10px; bottom: 10px; right: unset; transform: unset;"
                            data-mdb-autohide="true" data-mdb-position="top-right" data-mdb-append-to-body="true">
                            <div class="toast-body">` +
                            data.error +
                            `</div>
                        </div>`
                    );
                    $("#numberOfFollowers-" + user_id).text(
                        data.followers + " followers"
                    );

                    setInterval(() => {
                        $("#toast-unfollow").html("");
                    }, 5000);
                }
            },
        });
    });

    //delete follower using ajax
    $("#follower_delete").on("submit", function (e) {
        $.ajaxSetup({
            header: $('meta[name="_token"]').attr("content"),
        });
        e.preventDefault(e);
        var user_d_id = $("#user_d_id").val();
        var follower_d_id = $("#follower_d_id").val();
        $.ajax({
            type: "DELETE",
            url: "/follower/delete",
            data: {
                userId: user_d_id,
                followerId: follower_d_id,
            },
            dataType: "json",
            success: function (data) {
                if (data.success) {
                    $("#numberOfFollowers-" + user_d_id).text(
                        data.followers + " followers"
                    );
                    $("#user_follow_option").show();
                    $("#user_unfollow_option").hide();
                    $("#unfollowModal-" + user_d_id).modal("hide");
                    $("#toast-unfollow").html(
                        `<div class="toast toast-fixed bg-danger text-white show fade  " id="placement-toast" role="alert" aria-live="assertive"
                            aria-atomic="true"  data-mdb-width="350px"
                            style="width: 350px; display: block; top: unset; left: 10px; bottom: 10px; right: unset; transform: unset;"
                            data-mdb-autohide="true" data-mdb-position="top-right" data-mdb-append-to-body="true">
                            <div class="toast-body ">` +
                            data.success +
                            `</div>
                            </div>`
                    );
                    setInterval(() => {
                        $("#toast-unfollow").html("");
                    }, 5000);
                    if (data.error) {
                        $("#numberOfFollowers-" + user_d_id).text(
                            data.followers + " followers"
                        );
                        $("#unfollowModal-" + user_d_id).modal("hide");
                        $("#toast-unfollow").html(
                            `<div class="toast toast-fixed bg-danger text-white show fade  " id="placement-toast" role="alert" aria-live="assertive"
                                aria-atomic="true"  data-mdb-width="350px"
                                style="width: 350px; display: block; top: unset; left: 10px; bottom: 10px; right: unset; transform: unset;"
                                data-mdb-autohide="true" data-mdb-position="top-right" data-mdb-append-to-body="true">
                                <div class="toast-body ">` +
                                data.error +
                                `</div>
                                </div>`
                        );
                        setInterval(() => {
                            $("#toast-unfollow").html("");
                        }, 5000);
                    }
                }
            },
        });
    });

    //like blog using ajax

    $("#blog_like_form").on("submit", function (e) {
        $.ajaxSetup({
            header: $('meta[name="_token"]').attr("content"),
        });
        e.preventDefault(e);
        var blog_like_id = $("#blog_like_id").val();
        var user_like_id = $("#user_like_id").val();
        $.ajax({
            url: "/bloglike/create",
            type: "PUT",
            data: {
                blogId: blog_like_id,
                userId: user_like_id,
            },
            dataType: "json",
            success: function (data) {
                if (data.created) {
                    $("#blog-like-" + blog_like_id).html(
                        `<span>{{ svg('grommet-like') }}</span> ` + data.likes
                    );
                    $("#blog-dislike-" + blog_like_id).html(
                        `<span>{{ svg('grommet-dislike') }}</span> ` +
                            data.dislikes
                    );
                    $("#blog-like-" + blog_like_id).addClass(
                        "text-danger border-danger"
                    );
                }
                if (data.removed) {
                    $("#blog-like-" + blog_like_id).html(
                        `<span>{{ svg('grommet-like') }}</span> ` + data.likes
                    );
                    $("#blog-dislike-" + blog_like_id).html(
                        `<span>{{ svg('grommet-dislike') }}</span> ` +
                            data.dislikes
                    );
                    $("#blog-like-" + blog_like_id).removeClass(
                        "text-danger border-danger"
                    );
                }
                if (data.updated) {
                    $("#blog-like-" + blog_like_id).html(
                        `<span>{{ svg('grommet-like') }}</span> ` + data.likes
                    );
                    $("#blog-dislike-" + blog_like_id).html(
                        `<span>{{ svg('grommet-dislike') }}</span> ` +
                            data.dislikes
                    );
                    $("#blog-like-" + blog_like_id).addClass(
                        "text-danger border-danger"
                    );
                    $("#blog-dislike-" + blog_like_id).removeClass(
                        "text-secondary border-secondary"
                    );
                }
            },
        });
    });
    //dislike ajax
    $("#blog_dislike_form").on("submit", function (e) {
        $.ajaxSetup({
            header: $('meta[name="_token"]').attr("content"),
        });
        e.preventDefault(e);
        var blog_dislike_id = $("#blog_dislike_id").val();
        var user_dislike_id = $("#user_dislike_id").val();
        $.ajax({
            type: "PUT",
            url: "/blogdislike/create",
            data: {
                blogId: blog_dislike_id,
                userId: user_dislike_id,
            },
            dataType: "json",
            success: function (data) {
                if (data.created) {
                    $("#blog-like-" + blog_dislike_id).html(
                        `<span>{{ svg('grommet-like') }}</span> ` + data.likes
                    );
                    $("#blog-dislike-" + blog_dislike_id).html(
                        `<span>{{ svg('grommet-dislike') }}</span> ` +
                            data.dislikes
                    );
                    $("#blog-dislike-" + blog_dislike_id).addClass(
                        "text-secondary border-secondary"
                    );
                }
                if (data.removed) {
                    $("#blog-like-" + blog_dislike_id).html(
                        `<span>{{ svg('grommet-like') }}</span> ` + data.likes
                    );
                    $("#blog-dislike-" + blog_dislike_id).html(
                        `<span>{{ svg('grommet-dislike') }}</span> ` +
                            data.dislikes
                    );
                    $("#blog-dislike-" + blog_dislike_id).removeClass(
                        "text-secondary border-secondary"
                    );
                }
                if (data.updated) {
                    $("#blog-like-" + blog_dislike_id).html(
                        `<span>{{ svg('grommet-like') }}</span> ` + data.likes
                    );
                    $("#blog-dislike-" + blog_dislike_id).html(
                        `<span>{{ svg('grommet-dislike') }}</span> ` +
                            data.dislikes
                    );
                    $("#blog-like-" + blog_dislike_id).removeClass(
                        "text-danger border-danger"
                    );
                    $("#blog-dislike-" + blog_dislike_id).addClass(
                        "text-secondary border-secondary"
                    );
                }
            },
        });
    });
    //comment like
    $("form.comment-like").on("submit", function (e) {
        $.ajaxSetup({
            header: $('meta[name="_token"]').attr("content"),
        });
        e.preventDefault(e);
        var id = $(this).attr("id");
        var comment_id = id.substr(18, id.length - 1);

        var comment_like_id = $("#comment_like_id_" + comment_id).val();
        var user_like_id = $("#user_like_id_" + comment_id).val();
        $.ajax({
            url: "/commentlike/create",
            type: "PUT",
            data: {
                commentId: comment_like_id,
                userId: user_like_id,
            },
            dataType: "json",
            success: function (data) {
                if (data.created) {
                    $("#comment-like-" + comment_like_id).html(
                        `<span>{{ svg('grommet-like') }}</span> ` + data.likes
                    );
                    $("#comment-dislike-" + comment_like_id).html(
                        `<span>{{ svg('grommet-dislike') }}</span> ` +
                            data.dislikes
                    );
                    $("#comment-like-" + comment_like_id).addClass(
                        "text-danger border-danger"
                    );
                }
                if (data.removed) {
                    $("#comment-like-" + comment_like_id).html(
                        `<span>{{ svg('grommet-like') }}</span> ` + data.likes
                    );
                    $("#comment-dislike-" + comment_like_id).html(
                        `<span>{{ svg('grommet-dislike') }}</span> ` +
                            data.dislikes
                    );
                    $("#comment-like-" + comment_like_id).removeClass(
                        "text-danger border-danger"
                    );
                }
                if (data.updated) {
                    $("#comment-like-" + comment_like_id).html(
                        `<span>{{ svg('grommet-like') }}</span> ` + data.likes
                    );
                    $("#comment-dislike-" + comment_like_id).html(
                        `<span>{{ svg('grommet-dislike') }}</span> ` +
                            data.dislikes
                    );
                    $("#comment-like-" + comment_like_id).addClass(
                        "text-danger border-danger"
                    );
                    $("#comment-dislike-" + comment_like_id).removeClass(
                        "text-secondary border-secondary"
                    );
                }
            },
        });
    });

    //dislike ajax
    $("form.comment-dislike").on("submit", function (e) {
        $.ajaxSetup({
            header: $('meta[name="_token"]').attr("content"),
        });
        e.preventDefault(e);
        var id = $(this).attr("id");
        var comment_id = id.substr(21, id.length - 1);
        console.log(id, comment_id);
        var comment_dislike_id = $("#comment_dislike_id_" + comment_id).val();
        var user_dislike_id = $("#user_dislike_id_" + comment_id).val();
        $.ajax({
            type: "PUT",
            url: "/commentdislike/create",
            data: {
                commentId: comment_dislike_id,
                userId: user_dislike_id,
            },
            dataType: "json",
            success: function (data) {
                if (data.created) {
                    $("#comment-like-" + comment_dislike_id).html(
                        `<span>{{ svg('grommet-like') }}</span> ` + data.likes
                    );
                    $("#comment-dislike-" + comment_dislike_id).html(
                        `<span>{{ svg('grommet-dislike') }}</span> ` +
                            data.dislikes
                    );
                    $("#comment-dislike-" + comment_dislike_id).addClass(
                        "text-secondary border-secondary"
                    );
                }
                if (data.removed) {
                    $("#comment-like-" + comment_dislike_id).html(
                        `<span>{{ svg('grommet-like') }}</span> ` + data.likes
                    );
                    $("#comment-dislike-" + comment_dislike_id).html(
                        `<span>{{ svg('grommet-dislike') }}</span> ` +
                            data.dislikes
                    );
                    $("#comment-dislike-" + comment_dislike_id).removeClass(
                        "text-secondary border-secondary"
                    );
                }
                if (data.updated) {
                    $("#comment-like-" + comment_dislike_id).html(
                        `<span>{{ svg('grommet-like') }}</span> ` + data.likes
                    );
                    $("#comment-dislike-" + comment_dislike_id).html(
                        `<span>{{ svg('grommet-dislike') }}</span> ` +
                            data.dislikes
                    );
                    $("#comment-like-" + comment_dislike_id).removeClass(
                        "text-danger border-danger"
                    );
                    $("#comment-dislike-" + comment_dislike_id).addClass(
                        "text-secondary border-secondary"
                    );
                }
            },
        });
    });

    //comment like
    $("form.reply-like").on("submit", function (e) {
        $.ajaxSetup({
            header: $('meta[name="_token"]').attr("content"),
        });
        e.preventDefault(e);
        var id = $(this).attr("id");

        var reply_id = id.substr(16, id.length - 1);

        var reply_like_id = $("#reply_like_id_" + reply_id).val();
        var user_like_id = $("#user_like_id_" + reply_id).val();
        $.ajax({
            url: "/replylike/create",
            type: "PUT",
            data: {
                replyId: reply_like_id,
                userId: user_like_id,
            },
            dataType: "json",
            success: function (data) {
                if (data.created) {
                    $("#reply-like-" + reply_like_id).html(
                        `<span>{{ svg('grommet-like') }}</span> ` + data.likes
                    );
                    $("#reply-dislike-" + reply_like_id).html(
                        `<span>{{ svg('grommet-dislike') }}</span> ` +
                            data.dislikes
                    );
                    $("#reply-like-" + reply_like_id).addClass(
                        "text-danger border-danger"
                    );
                }
                if (data.removed) {
                    $("#reply-like-" + reply_like_id).html(
                        `<span>{{ svg('grommet-like') }}</span> ` + data.likes
                    );
                    $("#reply-dislike-" + reply_like_id).html(
                        `<span>{{ svg('grommet-dislike') }}</span> ` +
                            data.dislikes
                    );
                    $("#reply-like-" + reply_like_id).removeClass(
                        "text-danger border-danger"
                    );
                }
                if (data.updated) {
                    $("#reply-like-" + reply_like_id).html(
                        `<span>{{ svg('grommet-like') }}</span> ` + data.likes
                    );
                    $("#reply-dislike-" + reply_like_id).html(
                        `<span>{{ svg('grommet-dislike') }}</span> ` +
                            data.dislikes
                    );
                    $("#reply-like-" + reply_like_id).addClass(
                        "text-danger border-danger"
                    );
                    $("#reply-dislike-" + reply_like_id).removeClass(
                        "text-secondary border-secondary"
                    );
                }
            },
        });
    });

    //dislike ajax
    $("form.reply-dislike").on("submit", function (e) {
        $.ajaxSetup({
            header: $('meta[name="_token"]').attr("content"),
        });
        e.preventDefault(e);
        var id = $(this).attr("id");
        var reply_id = id.substr(19, id.length - 1);
        console.log(id, reply_id);
        var reply_dislike_id = $("#reply_dislike_id_" + reply_id).val();
        var user_dislike_id = $("#user_dislike_id_" + reply_id).val();
        $.ajax({
            type: "PUT",
            url: "/replydislike/create",
            data: {
                replyId: reply_dislike_id,
                userId: user_dislike_id,
            },
            dataType: "json",
            success: function (data) {
                if (data.created) {
                    $("#reply-like-" + reply_dislike_id).html(
                        `<span>{{ svg('grommet-like') }}</span> ` + data.likes
                    );
                    $("#reply-dislike-" + reply_dislike_id).html(
                        `<span>{{ svg('grommet-dislike') }}</span> ` +
                            data.dislikes
                    );
                    $("#reply-dislike-" + reply_dislike_id).addClass(
                        "text-secondary border-secondary"
                    );
                }
                if (data.removed) {
                    $("#reply-like-" + reply_dislike_id).html(
                        `<span>{{ svg('grommet-like') }}</span> ` + data.likes
                    );
                    $("#reply-dislike-" + reply_dislike_id).html(
                        `<span>{{ svg('grommet-dislike') }}</span> ` +
                            data.dislikes
                    );
                    $("#reply-dislike-" + reply_dislike_id).removeClass(
                        "text-secondary border-secondary"
                    );
                }
                if (data.updated) {
                    $("#reply-like-" + reply_dislike_id).html(
                        `<span>{{ svg('grommet-like') }}</span> ` + data.likes
                    );
                    $("#reply-dislike-" + reply_dislike_id).html(
                        `<span>{{ svg('grommet-dislike') }}</span> ` +
                            data.dislikes
                    );
                    $("#reply-like-" + reply_dislike_id).removeClass(
                        "text-danger border-danger"
                    );
                    $("#reply-dislike-" + reply_dislike_id).addClass(
                        "text-secondary border-secondary"
                    );
                }
            },
        });
    });
});
