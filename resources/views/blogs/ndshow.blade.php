@extends('layouts.nodistraction')
@section('style')
    <x-head.tinymce-config />
@endsection
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
        {{-- @isset($success)
            <section class=" d-flex justify-content-center my-4 w-100">
                <div class="container">
                    <div class="alert alert-dismissible fade show alert-success" role="alert" data-mdb-color="warning"
                        id="customxD">
                        <strong>Success!</strong> {{ $success }}
                        <button type="button" class="btn-close" data-mdb-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            </section>
        @endisset --}}
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
                                href="#blogModal-{{ $blog->id }}">
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
                <ul>
                    <li class="blog-bar-item"><a class="blog-bar-link sbtn link link-secondary"
                            href="#"><span>{{ svg('grommet-like') }}</span> {{ nice_number($blog->likes) }}</a></li>
                    <li class="blog-bar-item"><a class="blog-bar-link sbtn link link-secondary"
                            href="#"><span>{{ svg('grommet-dislike') }}</span> {{ nice_number($blog->dislikes) }}</a>
                    </li>
                    <li class="blog-bar-item"><a class="blog-bar-link sbtn link link-secondary" href="#comments"><span><i
                                    class="tim-icons icon-chat-33"></i></span>
                            {{ nice_number($blog->comments->count()) }}</a></li>
                    <li class="blog-bar-item"><a class="blog-bar-link sbtn link link-secondary"
                            href="#"><span>{{ svg('bx-share') }}</span> 1</a></li>

                </ul>
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

@section('script')
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
        });
    </script>
@endsection
