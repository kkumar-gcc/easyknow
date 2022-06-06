@extends('layouts.user')

@section('content')
    <?php
    function nice_number($n)
    {
        // $n = 0 + str_replace(',', '', $n);
        if (!is_numeric($n)) {
            return false;
        }
        if ($n > 1000000000000) {
            return round($n / 1000000000000, 1) + 't ';
        } elseif ($n > 1000000000) {
            return round($n / 1000000000, 1) + 'b ';
        } elseif ($n > 1000000) {
            return round($n / 1000000, 1) + 'm ';
        } elseif ($n > 1000) {
            return round($n / 1000, 1) + 'k ';
        }
    
        return number_format($n);
    }
    ?>
    <div class="profile">
        <div class="e-card" style="border-radius:0px 0px 0.5rem 0.5rem">
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
                                <a class="e-btn e-btn-warning" href="/users/{{ $user->id }}/{{ $user->username }}/public">
                                    {{ __('View Profile') }}
                                </a>
                            @else
                                @if ($user->isFollower())
                                    <div id="user_follow_option-{{ $user->id }}" style="display: none;">
                                        <form method="post" id="follower_create-{{ $user->id }}" class="follower-create">
                                            @csrf
                                            @method('put')
                                            <input type="hidden" name="follower_id" id="follower_id"
                                                value="{{ auth()->user()->id }}">
                                            <input type="hidden" name="user_id" id="user_id" value="{{ $user->id }}">
                                            <button type="submit" class="e-btn e-btn-primary">Follow</button>
                                        </form>
                                    </div>
                                    <div id="user_unfollow_option-{{ $user->id }}">
                                        <button type="button" class="e-btn" data-mdb-ripple-color="dark"
                                            data-mdb-toggle="modal"
                                            data-mdb-target="#unfollowModal-{{ $user->id }}">Unfollow</button>
                                    </div>
                                @else
                                    <div id="user_follow_option-{{ $user->id }}">
                                        <form method="post" id="follower_create-{{ $user->id }}" class="follower-create">
                                            @csrf
                                            @method('put')
                                            <input type="hidden" name="follower_id" id="follower_id"
                                                value="{{ auth()->user()->id }}">
                                            <input type="hidden" name="user_id" id="user_id" value="{{ $user->id }}">
                                            <button type="submit" class="e-btn e-btn-primary">Follow</button>
                                        </form>
                                    </div>
                                    <div id="user_unfollow_option-{{ $user->id }}" style="display: none;">

                                        <button type="button" class="e-btn" data-mdb-ripple-color="dark"
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

                                                <form method="POST" id="follower_delete-{{ $user->id }}"
                                                    class="follower-delete" action="{{ Route('follower.delete') }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <input type="hidden" name="follower_id" id="follower_d_id"
                                                        value="{{ auth()->user()->id }}">
                                                    <input type="hidden" name="user_id" id="user_d_id"
                                                        value="{{ $user->id }}">
                                                    <div class="form-group">
                                                        <button type="button" class="e-btn"
                                                            data-mdb-dismiss="modal">No</button>
                                                        <input type="submit" class="e-btn e-btn-warning" value="Unfollow">
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
@push('scripts')
    @include('ajax')
    <script>
        $(document).ready(function() {


        });
    </script>
@endpush
