@extends('layouts.user')

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
    <div class="profile">
        <div class="card" style="border-radius:0px 0px 0.5rem 0.5rem">
            <div class="card-body profile-body">
                <div class="background-image">
                    <img src="https://picsum.photos/400/300" alt="">
                </div>
                <div class="profile-image">
                    <div class="user-image">
                        <img src="https://picsum.photos/400/300" alt="">
                    </div>
                    <div class="user-detail">
                        <h1>{{ $user->username }}</h1>

                        <span id="numberOfFollowers-{{ $user->id }}">{{ $user->friendships->count() }} followers<span>
                    </div>
                    <div class="user-btn">
                        @guest
                            <a class="btn btn-danger link" href="#">
                                {{-- {{ svg('gmdi-person-add-alt-1-r') }} --}}
                                {{ __('Follow') }}
                            </a>
                        @else
                            <div id="toast-unfollow">

                            </div>
                            @if (auth()->user()->id == $user->id)
                                <a class="btn2 btn btn-primary link"
                                    href="/users/{{ $user->id }}/{{ $user->username }}/public">
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
                                            <input type="hidden" name="user_id" id="user_id" value="{{ $user->id }}">
                                            <button type="submit" class="btn btn-danger">Follow</button>
                                        </form>
                                    </div>
                                    <div id="user_unfollow_option" style="display: none;">

                                        <button type="button" class="btn btn-outline-dark" data-mdb-ripple-color="dark"
                                            data-mdb-toggle="modal"
                                            data-mdb-target="#unfollowModal-{{ $user->id }}">Unfollow</button>
                                    </div>
                                @else
                                <div id="user_follow_option" style="display:none;">
                                    <form method="post" id="follower_create">
                                        @csrf
                                        <input type="hidden" name="follower_id" id="follower_id"
                                            value="{{ auth()->user()->id }}">
                                        <input type="hidden" name="user_id" id="user_id" value="{{ $user->id }}">
                                        <button type="submit" class="btn btn-danger">Follow</button>
                                    </form>
                                </div>
                                <div id="user_unfollow_option" >

                                    <button type="button" class="btn btn-outline-dark" data-mdb-ripple-color="dark"
                                        data-mdb-toggle="modal"
                                        data-mdb-target="#unfollowModal-{{ $user->id }}">Unfollow</button>
                                </div>
                                @endif
                                <div class="modal fade" id="unfollowModal-{{ $user->id }}" tabindex="-1"
                                    aria-labelledby="unfollowModal-{{ $user->id }}-Label" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-sm">
                                        <div class="modal-content">

                                            <div class="card-body text-center">
                                                unfollow to " <strong class="font-weight-bold">{{ $user->username }}
                                                </strong>" ?
                                                <hr>

                                                <form method="POST" id="follower_delete"
                                                    action="{{ Route('follower.delete') }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <input type="hidden" name="follower_id" id="follower_d_id"
                                                        value="{{ auth()->user()->id }}">
                                                    <input type="hidden" name="user_id" id="user_d_id"
                                                        value="{{ $user->id }}">
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
                <ul class="nav nav-tabs nav-fill" id="ex1" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" id="ex2-tab-1" data-mdb-toggle="tab" href="#ex2-tabs-1" role="tab"
                            aria-controls="ex2-tabs-1" aria-selected="true">About</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="ex2-tab-2" data-mdb-toggle="tab" href="#ex2-tabs-2" role="tab"
                            aria-controls="ex2-tabs-2" aria-selected="false">Blogs ({{ $user->blogs->count() }})</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="ex2-tab-3" data-mdb-toggle="tab" href="#ex2-tabs-3" role="tab"
                            aria-controls="ex2-tabs-3" aria-selected="false">Liked ({{ $user->blogs->count() }})</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="ex2-tab-4" data-mdb-toggle="tab" href="#ex2-tabs-4" role="tab"
                            aria-controls="ex2-tabs-4" aria-selected="false">Activity</a>
                    </li>
                </ul>
                <!-- Tabs navs -->

                <!-- Tabs navs -->
            </div>

        </div>
        <div>
            <div class="tab-content" id="ex2-content">

                <div class="tab-pane fade show active" id="ex2-tabs-1" role="tabpanel" aria-labelledby="ex2-tab-1">
                    @include('profile.public.partials.aboutTab', [
                        'user' => $user,
                    ])
                </div>
                <div class="tab-pane fade" id="ex2-tabs-2" role="tabpanel" aria-labelledby="ex2-tab-2">
                    @include('profile.public.partials.blogTab', [
                        'blogs' => $blogs,
                    ])
                </div>
                <div class="tab-pane fade" id="ex2-tabs-3" role="tabpanel" aria-labelledby="ex2-tab-3">
                    @include('profile.public.partials.likeTab', ['blogs' => $blogs])
                </div>
                <div class="tab-pane fade" id="ex2-tabs-4" role="tabpanel" aria-labelledby="ex2-tab-4">
                    @include('profile.public.partials.profileTab', [
                        'user' => $user,
                    ])
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function() {


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
                console.log(user_id, follower_id);
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
