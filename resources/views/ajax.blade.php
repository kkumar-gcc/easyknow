<script>
    $(document).ready(function() {
        //add follower using ajax
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(document).on('submit', '.follow', function(e) {
            $.ajaxSetup({
                header: $('meta[name="_token"]').attr('content')
            })
            e.preventDefault(e);
            var temp = $(this).attr('id');
            var user_id = temp.split('-')[1];

            $.ajax({
                type: "POST",
                url: '{{ Route('follow') }}',
                data: $(this).serialize(),
                beforeSend: function() {
                    $('.follow_button_' + user_id).html(`
                    <svg role="status" class="inline w-4 h-4 mr-3 text-white animate-spin" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="#E5E7EB"/>
                        <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentColor"/>
                    </svg>
                    Loading...
                    `)
                },
                dataType: 'json',
                success: function(data) {
                    if (data.follow) {
                        $("#toast-info").html('');
                        $("#toast-info").html(`
                            <div id="toast-undo"
                                class="fixed left-5 bottom-5 z-[100] border border  border-gray-200 flex items-center p-4 w-full max-w-xs text-gray-500 bg-white rounded-lg shadow dark:text-gray-400 dark:bg-gray-800 dark:border-gray-700"
                                role="alert">
                                <div class="text-sm font-normal">
                                    ` + data.follow + `
                                </div>
                                <div class="flex items-center ml-auto space-x-2">
                                    <button type="button"
                                        class="bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700"
                                        data-dismiss-target="#toast-undo" aria-label="Close">
                                        <span class="sr-only">Close</span>
                                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>`);
                        $('.follow_button_' + data.user_id).html(`
                                {{ svg('bi-person-check-fill', 'mr-2 -ml-1 w-5 h-5') }}
                                {{ __('Following') }}
                            `);
                        setInterval(() => {
                            $("#toast-info").html('');
                        }, 7000);

                    }
                    if (data.unfollow) {
                        $("#toast-info").html('');
                        $("#toast-info").html(`
                            <div id="toast-undo"
                                class="fixed left-5 bottom-5 z-[100] border border  border-gray-200 flex items-center p-4 w-full max-w-xs text-gray-500 bg-white rounded-lg shadow dark:text-gray-400 dark:bg-gray-800 dark:border-gray-700"
                                role="alert">
                                <div class="text-sm font-normal">
                                    ` + data.unfollow + `
                                </div>
                                <div class="flex items-center ml-auto space-x-2">
                                    <button type="button"
                                        class="bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700"
                                        data-dismiss-target="#toast-undo" aria-label="Close">
                                        <span class="sr-only">Close</span>
                                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>`);
                        $('.follow_button_' + data.user_id).html(`
                                {{ svg('bi-person-plus-fill', 'mr-2 -ml-1 w-5 h-5') }}
                                {{ __('Follow') }}
                            `);
                        setInterval(() => {
                            $("#toast-info").html('');
                        }, 7000);
                    }
                    if (data.error) {
                        $("#toast-info").html('');
                        $("#toast-info").html(`
                            <div id="toast-undo"
                                class="fixed left-5 bottom-5 z-[100] border border  border-gray-200 flex items-center p-4 w-full max-w-xs text-gray-500 bg-white rounded-lg shadow dark:text-gray-400 dark:bg-gray-800 dark:border-gray-700"
                                role="alert">
                                <div class="text-sm font-normal">
                                    ` + data.error + `
                                </div>
                                <div class="flex items-center ml-auto space-x-2">
                                    <button type="button"
                                        class="bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700"
                                        data-dismiss-target="#toast-undo" aria-label="Close">
                                        <span class="sr-only">Close</span>
                                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>`);
                        setInterval(() => {
                            $("#toast-info").html('');
                        }, 7000);
                    }
                }
            })
        });
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
                beforeSend: function() {
                    $("#blog-like-" + blog_like_id).html(
                        ` <div role="status">
                            <svg class="inline w-3.5 h-3.5 text-gray-200 animate-spin dark:text-gray-600 fill-gray-600 dark:fill-gray-300" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                                <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                            </svg>
                            <span class="sr-only">Loading...</span>
                        </div>`);
                },
                dataType: 'json',
                success: function(data) {
                    if (data.created) {
                        $("#blog-like-" + blog_like_id).html(
                            `{{ svg('grommet-like', 'h-4 w-4') }}
                                            <span class="ml-2"> ` + data.likes + `</span>`);
                        $("#blog-dislike-" + blog_like_id).html(
                            `{{ svg('grommet-dislike', 'h-4 w-4') }}`);
                        $("#blog-like-" + blog_like_id).addClass(
                            "e-rbtn-liked");
                    }
                    if (data.removed) {
                        $("#blog-like-" + blog_like_id).html(
                            `{{ svg('grommet-like', 'h-4 w-4') }}
                                            <span class="ml-2"> ` + data.likes + `</span>`);
                        $("#blog-dislike-" + blog_like_id).html(
                            `{{ svg('grommet-dislike', 'h-4 w-4') }} `);
                        $("#blog-like-" + blog_like_id).removeClass(
                            "e-rbtn-liked");
                    }
                    if (data.updated) {
                        $("#blog-like-" + blog_like_id).html(
                            `{{ svg('grommet-like', 'h-4 w-4') }}
                                            <span class="ml-2"> ` + data.likes + `</span>`);
                        $("#blog-dislike-" + blog_like_id).html(
                            `{{ svg('grommet-dislike', 'h-4 w-4') }}`);
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
                beforeSend: function() {
                    $("#blog-dislike-" + blog_dislike_id).html(
                        ` <div role="status">
                            <svg class="inline w-3.5 h-3.5 text-gray-200 animate-spin dark:text-gray-600 fill-gray-600 dark:fill-gray-300" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                                <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                            </svg>
                            <span class="sr-only">Loading...</span>
                        </div>`);
                },
                dataType: 'json',
                success: function(data) {
                    if (data.created) {
                        $("#blog-like-" + blog_dislike_id).html(
                            `{{ svg('grommet-like', 'h-4 w-4') }}
                                            <span class="ml-2"> ` + data.likes + `</span>`);
                        $("#blog-dislike-" + blog_dislike_id).html(
                            `{{ svg('grommet-dislike', 'h-4 w-4') }}`);
                        $("#blog-dislike-" + blog_dislike_id).addClass(
                            "e-rbtn-disliked");
                    }
                    if (data.removed) {
                        $("#blog-like-" + blog_dislike_id).html(
                            `{{ svg('grommet-like', 'h-4 w-4') }}
                                            <span class="ml-2"> ` + data.likes + `</span>`);
                        $("#blog-dislike-" + blog_dislike_id).html(
                            `{{ svg('grommet-dislike', 'h-4 w-4') }}`);
                        $("#blog-dislike-" + blog_dislike_id).removeClass(
                            "e-rbtn-disliked");
                    }
                    if (data.updated) {
                        $("#blog-like-" + blog_dislike_id).html(
                            `{{ svg('grommet-like', 'h-4 w-4') }}
                                            <span class="ml-2"> ` + data.likes + `</span>`);
                        $("#blog-dislike-" + blog_dislike_id).html(
                            `{{ svg('grommet-dislike', 'h-4 w-4') }}`);
                        $("#blog-like-" + blog_dislike_id).addClass(
                            "e-rbtn-liked");
                        $("#blog-dislike-" + blog_dislike_id).removeClass(
                            "e-rbtn-disliked")
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
            var comment_id = id.substr(18, id.length - 1);
            var comment_like_id = $("#comment_like_id_" + comment_id).val();
            var user_like_id = $("#user_like_id_" + comment_id).val();
            $.ajax({
                url: '/commentlike/create',
                type: "PUT",
                data: {
                    commentId: comment_like_id,
                    userId: user_like_id
                },
                beforeSend: function() {
                    $("#comment-like-" + comment_like_id).html(
                        ` <div role="status">
                            <svg class="inline w-3.5 h-3.5 text-gray-200 animate-spin dark:text-gray-600 fill-gray-600 dark:fill-gray-300" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                                <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                            </svg>
                            <span class="sr-only">Loading...</span>
                        </div>`);
                },
                dataType: 'json',
                success: function(data) {
                    if (data.created) {
                        $("#comment-like-" + comment_like_id).html(
                            ` {{ svg('grommet-like', 'h-4 w-4') }} <span class="ml-3 -mt-0.5">` +
                            data.likes + `</span>`);
                        $("#comment-dislike-" + comment_like_id).html(
                            `{{ svg('grommet-dislike', 'h-4 w-4') }}`);
                        $("#comment-like-" + comment_like_id).addClass(
                            "text-danger border-danger");
                    }
                    if (data.removed) {
                        $("#comment-like-" + comment_like_id).html(
                            `{{ svg('grommet-like', 'h-4 w-4') }} <span class="ml-3 -mt-0.5">` +
                            data.likes + `</span>`);
                        $("#comment-dislike-" + comment_like_id).html(
                            `{{ svg('grommet-dislike') }}`);
                        $("#comment-like-" + comment_like_id).removeClass(
                            "text-danger border-danger");
                    }
                    if (data.updated) {
                        $("#comment-like-" + comment_like_id).html(
                            `{{ svg('grommet-like', 'h-4 w-4') }} <span class="ml-3 -mt-0.5">` +
                            data.likes + `</span>`);
                        $("#comment-dislike-" + comment_like_id).html(
                            `{{ svg('grommet-dislike', 'h-4 w-4') }} `);
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
            var comment_id = id.substr(21, id.length - 1);
            var comment_dislike_id = $("#comment_dislike_id_" + comment_id).val();
            var user_dislike_id = $("#user_dislike_id_" + comment_id).val();
            $.ajax({
                type: "PUT",
                url: '{{ Route('commentdislike.create') }}',
                data: {
                    commentId: comment_dislike_id,
                    userId: user_dislike_id,
                },
                beforeSend: function() {
                    $("#comment-dislike-" + comment_dislike_id).html(
                        ` <div role="status">
                            <svg class="inline w-3.5 h-3.5 text-gray-200 animate-spin dark:text-gray-600 fill-gray-600 dark:fill-gray-300" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                                <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                            </svg>
                            <span class="sr-only">Loading...</span>
                        </div>`);
                },
                dataType: 'json',
                success: function(data) {
                    if (data.created) {
                        $("#comment-like-" + comment_dislike_id).html(
                            ` {{ svg('grommet-like', 'h-4 w-4') }}
                                                <span class="ml-3 -mt-0.5">
                                                    ` + data.likes + `</span>`);
                        $("#comment-dislike-" + comment_dislike_id).html(
                            `{{ svg('grommet-dislike', 'h-4 w-4') }}`);
                        $("#comment-dislike-" + comment_dislike_id).addClass(
                            "text-secondary border-secondary");
                    }
                    if (data.removed) {
                        $("#comment-like-" + comment_dislike_id).html(
                            `{{ svg('grommet-like', 'h-4 w-4') }}
                                                <span class="ml-3 -mt-0.5">` + data.likes + `</span>`);
                        $("#comment-dislike-" + comment_dislike_id).html(
                            `{{ svg('grommet-dislike', 'h-4 w-4') }}`);
                        $("#comment-dislike-" + comment_dislike_id).removeClass(
                            "text-secondary border-secondary");
                    }
                    if (data.updated) {
                        $("#comment-like-" + comment_dislike_id).html(
                            `{{ svg('grommet-like', 'h-4 w-4') }}
                                                <span class="ml-3 -mt-0.5">` + data.likes + `</span>`);
                        $("#comment-dislike-" + comment_dislike_id).html(
                            `{{ svg('grommet-dislike', 'h-4 w-4') }}`);
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
                beforeSend: function() {
                    $("#reply-like-" + reply_like_id).html(
                        ` <div role="status">
                            <svg class="inline w-3.5 h-3.5 text-gray-200 animate-spin dark:text-gray-600 fill-gray-600 dark:fill-gray-300" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                                <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                            </svg>
                            <span class="sr-only">Loading...</span>
                        </div>`);
                },
                dataType: 'json',
                success: function(data) {
                    if (data.created) {
                        $("#reply-like-" + reply_like_id).html(
                            `{{ svg('grommet-like', 'h-4 w-4') }} <span class="ml-3 -mt-0.5">` +
                            data.likes + `</span>`);
                        $("#reply-dislike-" + reply_like_id).html(
                            `{{ svg('grommet-dislike', 'h-4 w-4') }}`);
                        $("#reply-like-" + reply_like_id).addClass(
                            "text-danger border-danger");
                    }
                    if (data.removed) {
                        $("#reply-like-" + reply_like_id).html(
                            `{{ svg('grommet-like', 'h-4 w-4') }} <span class="ml-3 -mt-0.5">` +
                            data.likes + `</span>`);
                        $("#reply-dislike-" + reply_like_id).html(
                            `{{ svg('grommet-dislike', 'h-4 w-4') }}`);
                        $("#reply-like-" + reply_like_id).removeClass(
                            "text-danger border-danger");
                    }
                    if (data.updated) {
                        $("#reply-like-" + reply_like_id).html(
                            `{{ svg('grommet-like', 'h-4 w-4') }} <span class="ml-3 -mt-0.5">` +
                            data.likes + `</span>`);
                        $("#reply-dislike-" + reply_like_id).html(
                            `{{ svg('grommet-dislike', 'h-4 w-4') }}`);
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
                beforeSend: function() {
                    $("#reply-dislike-" + reply_dislike_id).html(
                        ` <div role="status">
                            <svg class="inline w-3.5 h-3.5 text-gray-200 animate-spin dark:text-gray-600 fill-gray-600 dark:fill-gray-300" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                                <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                            </svg>
                            <span class="sr-only">Loading...</span>
                        </div>`);
                },
                dataType: 'json',
                success: function(data) {
                    if (data.created) {
                        $("#reply-like-" + reply_dislike_id).html(
                            `{{ svg('grommet-like', 'h-4 w-4') }} <span class="ml-3 -mt-0.5"> ` +
                            data.likes + `</span>`);
                        $("#reply-dislike-" + reply_dislike_id).html(
                            `{{ svg('grommet-dislike', 'h-4 w-4') }}`);
                        $("#reply-dislike-" + reply_dislike_id).addClass(
                            "text-secondary border-secondary");
                    }
                    if (data.removed) {
                        $("#reply-like-" + reply_dislike_id).html(
                            `{{ svg('grommet-like', 'h-4 w-4') }} <span class="ml-3 -mt-0.5">` +
                            data.likes + `</span>`);
                        $("#reply-dislike-" + reply_dislike_id).html(
                            `{{ svg('grommet-dislike', 'h-4 w-4') }}`);
                        $("#reply-dislike-" + reply_dislike_id).removeClass(
                            "text-secondary border-secondary");
                    }
                    if (data.updated) {
                        $("#reply-like-" + reply_dislike_id).html(
                            `{{ svg('grommet-like', 'h-4 w-4') }} <span class="ml-3 -mt-0.5"> ` +
                            data.likes + `</span>`);
                        $("#reply-dislike-" + reply_dislike_id).html(
                            `{{ svg('grommet-dislike', 'h-4 w-4') }}`);
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
                        <div class="w-full p-4 px-4 my-3 border border-gray-200 not-prose rounded-xl hover:border-blue-600 active:border-blue-600 dark:border-gray-700 dark:hover:border-blue-500"
                        id="comment-` + data.comment.id + `">
                        <header class="flex flex-row not-prose">
                            <div class="flex-1">
                                <div class="flex items-center space-x-4">
                                    <img class="w-10 h-10 rounded-full md:w-11 md:h-11"
                                        src='https://avatars.dicebear.com/api/bottts/:` + data.user.username + `.svg'
                                        alt="">
                                    <div class="font-medium dark:text-white">
                                        <a class="user-popover" href="/users/` + data.user.username + `"
                                            id="user` + data.comment.id + `-` + data.user.id + `">` + data.user
                            .username + `
                                        </a>
                                        <div class="text-sm text-gray-500 dark:text-gray-400">
                                            Just Now</div>
                                    </div>
                                </div>
                            </div>
                            <div class="flex items-center justify-end ">
                                <button type="button"
                                    class="text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-2.5">
                                    @svg('go-kebab-horizontal-16', 'h-5 w-5')
                                </button>
                            </div>
                        </header>
                        <div class="my-3">
                            ` + data.comment.description + `
                        </div>
                        <footer class="mt-2">
                            <div class="flex flew-row">
                                <div class="flex flex-row flex-1">
                                        <form method="POST" id="comment_like_form_` + data.comment.id + `"
                                            class="d-inline comment-like">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="comment_id"
                                                id="comment_like_id_` + data.comment.id + `" value="` + data.comment
                            .id + `">
                                            <input type="hidden" name="user_id" id="user_like_id_` + data.comment.id + `"
                                                value="` + data.user.id + `">
                                            <button type="submit" id="comment-like-` + data.comment.id + `"
                                                class="flex flex-row items-center text-gray-500 mr-2 md:mr-3 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-2.5">
                                                {{ svg('grommet-like', 'h-4 w-4') }}
                                            </button>
                                        </form>
                                        <form method="post" id="comment_dislike_form_` + data.comment.id + `"
                                            class="d-inline comment-dislike">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="comment_id"
                                                id="comment_dislike_id_` + data.comment.id + `" value="` + data.comment
                            .id + `">
                                            <input type="hidden" name="user_id"
                                                id="user_dislike_id_` + data.comment.id + `"
                                                value="` + data.user.id + `">
                                            <button type="submit" id="comment-dislike-` + data.comment.id + `"
                                                class="flex flex-row  text-gray-500 mr-2 md:mr-3 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-2.5">
                                                {{ svg('grommet-dislike', 'h-4 w-4') }}
                                            </button>
                                        </form>
                                </div>
                               
                            </div>
                        </footer>
                           
                        </div>`);
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
                        <div class="w-full p-4 px-4 my-3 border border-gray-200 not-prose rounded-xl hover:border-blue-600 active:border-blue-600 dark:border-gray-700 dark:hover:border-blue-500"
                                    id="reply-` + data.reply.id + ` ">
                                    <header class="flex flex-row not-prose">
                                        <div class="flex-1">
                                            <div class="flex items-center space-x-4 user-popover">
                                                <img class="w-10 h-10 rounded-full md:w-11 md:h-11"
                                                    src="https://avatars.dicebear.com/api/bottts/:` + data.user
                            .username + `.svg"
                                                    alt="">
                                                <div class="font-medium dark:text-white">
                                                    <a class="user-popover"
                                                        href="/users/` + data.user.username + `  "
                                                        id="user` + data.reply.id + ` -` + data.user.id + ` ">` + data
                            .user.username + ` 
                                                        
                                                    </a>
                                                    <div class="text-sm text-gray-500 dark:text-gray-400">
                                                        just now
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="flex items-center justify-end ">
                                            <button type="button"
                                                class="text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-2.5">
                                                @svg('go-kebab-horizontal-16', 'h-5 w-5')
                                            </button>
                                        </div>
                                    </header>
                                    <div class="my-3">
                                        ` + data.reply.description + ` 
                                    </div>
                                    <footer class="mt-2">
                                        <div class="flex flew-row">
                                            <div class="flex flex-row flex-1">
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
                                                            class="flex flex-row items-center text-gray-500 mr-3 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-2.5">
                                                            {{ svg('grommet-like', 'h-4 w-4') }}
                                                        </button>
                                                    </form>
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
                                                            class="flex flex-row items-center text-gray-500 mr-3 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-2.5">
                                                            {{ svg('grommet-dislike', 'h-4 w-4') }}
                                                        </button>
                                                    </form>
                                            </div>
                                            
                                        </div>
                                    </footer>
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
                                content: ` <div class="e-card ">
                                        <div class="e-card-body">
                                            <a href="/blogs/tagged/` + data.tag[0].title + `">
                                            <span class="modern-badge  modern-badge-` + data.tag[0].color + `">#` +
                                    data
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
                var placement = el.attr('data-popover-placement') ?? 'auto';
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
                            placement: placement,
                            width: 400,
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

        $(document).on('mouseover', '.blog-popover', function(e) {
            var el = $(this);
            e.preventDefault(e);
            var timeoutId = setTimeout(function() {
                $.ajaxSetup({
                    header: $('meta[name="_token"]').attr('content')
                })

                var id = el.attr('id');
                var dummyVar = id.split('-');
                var blog_id = dummyVar[1];
                $.ajax({
                    type: "GET",
                    url: '/blog-detail',
                    data: {
                        blogId: blog_id
                    },
                    dataType: 'json',
                    success: function(data) {
                        $('#' + id).webuiPopover({
                            content: data,

                            animation: 'pop',
                            trigger: 'hover',
                            width: 400,
                            delay: {
                                show: null,
                                hide: 300
                            },
                            arrow: true,
                            placement: 'horizontal',
                            multi: true,

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
                beforeSend: function() {
                    $(".bookmark_btn_" + blog_bookmark_id).html(
                        ` <div role="status">
                            <svg class="inline w-3.5 h-3.5 text-gray-200 animate-spin dark:text-gray-600 fill-gray-600 dark:fill-gray-300" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                                <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                            </svg>
                            <span class="sr-only">Loading...</span>
                        </div>`);
                },
                dataType: 'json',
                success: function(data) {
                    if (data.created) {
                        $(".bookmark_btn_" + blog_bookmark_id).html(`@svg('gmdi-bookmark-added-r', 'text-rose-500 dark:text-rose-500 h-5 w-5')`)
                            .fadeIn(150);
                        $("#toast-info").html('');
                        $("#toast-info").html(`
                            <div id="toast-undo"
                                class="fixed left-5 bottom-5 z-[100] border border  border-gray-200 flex items-center p-4 w-full max-w-xs text-gray-500 bg-white rounded-lg shadow dark:text-gray-400 dark:bg-gray-800 dark:border-gray-700"
                                role="alert">
                                <div class="text-sm font-normal">
                                    ` + data.success + `
                                </div>
                                <div class="flex items-center ml-auto space-x-2">
                                    <button type="button"
                                        class="bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700"
                                        data-dismiss-target="#toast-undo" aria-label="Close">
                                        <span class="sr-only">Close</span>
                                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>`);
                        setInterval(() => {
                            $("#toast-info").html('');
                        }, 7000);
                    }
                    if (data.removed) {
                        $(".bookmark_btn_" + blog_bookmark_id).html(`@svg('gmdi-bookmark-add-o', 'h-5 w-5')`)
                            .fadeIn(150);
                        $("#toast-info").html('');
                        $("#toast-info").html(`
                        <div id="toast-undo"
                                class="fixed left-5 bottom-5 z-[100] border  border-gray-200 flex items-center p-4 w-full max-w-md text-gray-500 bg-white rounded-lg shadow dark:text-gray-400 dark:bg-gray-800 dark:border-gray-700"
                                role="alert">
                                <div class="text-sm font-normal">
                                    ` + data.success + `
                                </div>
                                <div class="flex items-center ml-auto space-x-2">
                                    <button type="button"
                                        class="bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700"
                                        data-dismiss-target="#toast-undo" aria-label="Close">
                                        <span class="sr-only">Close</span>
                                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>`);
                        setInterval(() => {
                            $("#toast-info").html('');
                        }, 7000);
                    }
                }
            })
        });

        function convertToSlug(Text) {
            return Text.toLowerCase()
                .replace(/[^\w ]+/g, '')
                .replace(/ +/g, '-');
        }

        //search ajax 
        typeof $.typeahead === 'function' && $.typeahead({
            input: '.js-typeahead-search',
            minLength: 1,
            maxItem: 15,
            order: "asc",
            maxItemPerGroup: 3,
            group: function(group) {
                return {
                    template: group
                }
            },
            order: "asc",
            hint: true,
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
                                    id="searchTag-` + item.id + `" class="modern-badge  modern-badge-` + item.color + ` tag-popover">
                                    #` + item.title + `
                                </span>`
                    }
                },
                users: {
                    display: ["username"],
                    href: function(item) {
                        return `/users/` + item.username;
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
                            <div class="d-flex search-user">
                                <div class="flex-none image">
                                    <img class="user-img" src="https://picsum.photos/400/300" alt="">
                                </div>
                                <div class="flex-1 user-detail">
                                    ` + item.username + `
                                </div>
                            </div>`
                    }
                },
                blogs: {
                    display: "title",
                    href: function(item) {
                        return `/blogs/` + convertToSlug(item.title) + `-` + item.id;
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
                        return `
                        <div class="e-scard e-scard-hover e-scard-secondary " id="blog-` + item.id + `">
                            <div class="card-body">
                                <div class="image">
                                    <img class ="shadow-md" src="https://picsum.photos/400/300" alt="">
                                </div>
                                <div class="detail">
                                    <a href="/blogs/` + convertToSlug(item.title) + `-` + item.id + `" class="link link-secondary">
                                        <h5 class="title">` + item.title + `</h5>
                                    </a>
                                    <p class="mt-3 text-black">
                                        by
                                        <a class="btn-link link-secondary user-popover"
                                            href="/users/"
                                            id="user-">
                                            
                                        </a>
                                        <small class="text-muted"> posted
                                            
                                        </small>
                                    </p>
                                </div>
                            </div>
                        </div>
                       `
                    },
                },
            },
            selector: {
                result: "search__result",
                list: "search__list",
                group: "search__group",
                item: "search__item",
                empty: "search__empty",

            },

        });
        //drag and drop
        document.querySelectorAll(".drop-zone__input").forEach((inputElement) => {
            const dropZoneElement = inputElement.closest(".drop-zone");

            dropZoneElement.addEventListener("click", (e) => {

                inputElement.click();
            });

            inputElement.addEventListener("change", (e) => {
                var dump = dropZoneElement.getAttribute('id').split("-");
                var id = dump[0];
                if (inputElement.files.length) {
                    updateThumbnail(dropZoneElement, inputElement.files[0], id);
                }
            });

            dropZoneElement.addEventListener("dragover", (e) => {
                e.preventDefault();
                dropZoneElement.classList.add("drop-zone--over");
            });

            ["dragleave", "dragend"].forEach((type) => {
                dropZoneElement.addEventListener(type, (e) => {
                    dropZoneElement.classList.remove("drop-zone--over");
                });
            });

            dropZoneElement.addEventListener("drop", (e) => {
                e.preventDefault();
                var dump = dropZoneElement.getAttribute('id').split("-");
                var id = dump[0];
                if (e.dataTransfer.files.length) {
                    inputElement.files = e.dataTransfer.files;
                    updateThumbnail(dropZoneElement, e.dataTransfer.files[0], id);
                }
                dropZoneElement.classList.remove("drop-zone--over");
            });
        });

        function updateThumbnail(dropZoneElement, file, id) {
            let thumbnailElement = dropZoneElement.querySelector(".drop-zone__thumb");

            // First time - remove the prompt
            if (dropZoneElement.querySelector(".drop-zone__prompt")) {
                dropZoneElement.querySelector(".drop-zone__prompt").remove();
            }

            // First time - there is no thumbnail element, so lets create it
            if (!thumbnailElement) {
                thumbnailElement = document.createElement("div");
                thumbnailElement.classList.add("drop-zone__thumb");
                dropZoneElement.appendChild(thumbnailElement);
            }

            thumbnailElement.dataset.label = file.name;

            // Show thumbnail for image files
            if (file.type.startsWith("image/")) {
                const reader = new FileReader();
                reader.readAsDataURL(file);
                reader.onload = () => {
                    thumbnailElement.style.backgroundImage = `url('${reader.result}')`;
                    $("#" + id).attr("src", `${reader.result}`);
                };
            } else {
                thumbnailElement.style.backgroundImage = null;
            }
        }

        // pin blog 
        $(document).on('submit', ".blogpin_form", function(e) {
            $.ajaxSetup({
                header: $('meta[name="_token"]').attr('content')
            })
            e.preventDefault(e);
            var id = $(this).attr('id');
            var dummyVar = id.split('-');
            var blog_id = dummyVar[1];
            $.ajax({
                type: "PUT",
                url: '{{ Route('blogpin.create') }}',
                data: $(this).serialize(),
                dataType: 'json',
                beforeSend: function() {
                    $("#loading").html(`
                    <div class="text-center">
                        <svg role="status" class="inline w-4 h-4 mr-3 text-white animate-spin" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="#E5E7EB"/>
                        <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentColor"/>
                    </svg>
                    Loading...
                    </div>`);
                    $('.book_pin_btn_' + blog_id).html(`
                    <div role="status">
                            <svg class="inline w-3.5 h-3.5 text-gray-200 animate-spin dark:text-gray-600 fill-gray-600 dark:fill-gray-300" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                                <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                            </svg>
                            <span class="sr-only">Loading...</span>
                    </div>
                    `)
                },
                complete: function() {
                    $("#loading").html('');
                },
                success: function(data) {
                    if (data.created) {
                        $("#pinTab").html(data.page)
                            .fadeIn(150);
                        $("#toast-info").html(`
                        <div class="toast toast-fixed show fade " id="placement-toast" role="alert" aria-live="assertive"
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
                        $("#pinTab").html(data.page);
                        $("#toast-info").html(`
                        <div class="text-white toast toast-fixed bg-danger show fade " id="placement-toast" role="alert" aria-live="assertive"
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
        //navbar toggler 
        $(document).on('click', '#guide-toggler', function(e) {
            if ($(this).attr('data-nav-open') === 'false') {
                $(this).html(`@svg('css-close')`).delay(500);
                $("#guide-mobile-menu").fadeIn();
                $(this).attr('data-nav-open', 'true');

            } else {
                $(this).html(`@svg('heroicon-o-menu')`).delay(500);
                $("#guide-mobile-menu").fadeOut();
                $(this).attr('data-nav-open', 'false');
            }
        });

        //open search using CTRL + K
        $(document).on('keydown', function(e) {
            if ((e.metaKey || e.ctrlKey) && (String.fromCharCode(e.which).toLowerCase() === 'k')) {
                e.preventDefault();
                $("#searchModal").show();
            }
        });
        $(document).on('keydown', function(e) {
            if ((e.key == "Escape")) {
                e.preventDefault();
                $("#searchModal").hide();
            }
        });

        function stickySidebar() {
            var $sticky = $('#sticky-sidebar');
            $sticky.hcSticky();
            $sticky.hcSticky('update', {
                top: 100,
                bottom: 5
            });
        }
        stickySidebar();


       
    });
</script>
