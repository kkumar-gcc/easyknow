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
                    <img src="{{ asset($user->background_image ?? '') }}" alt="">
                </div>
                <div class="profile-image">
                    <div class="user-image">
                        <img src="{{ asset($user->profile_image ?? '') }}" alt="">
                    </div>
                    <div class="user-detail">
                        <h1>{{ $user->username }}</h1>

                        <span id="numberOfFollowers-{{ $user->id }}">{{ $user->friendships->count() }} followers<span>
                    </div>
                    <div class="user-btn">
                        @guest
                            <a class="btn btn-danger link" href="#">
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
                <ul class="nav nav-tabs" role="tablist"  id="details">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link {{ $tab == 'about' ? 'active' : '' }}"
                            href="/users/{{ $user->id }}/{{ $user->username }}/public?tab=about#details"
                            role="tab">About Me</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link {{ $tab == 'blogs' ? 'active' : '' }}"
                            href="/users/{{ $user->id }}/{{ $user->username }}/public?tab=blogs#details"
                            role="tab">Blogs ({{ nice_number($user->blogs->where('status','=','posted')->count()) }})</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link {{ $tab == 'bookmarks' ? 'active' : '' }}"
                            href="/users/{{ $user->id }}/{{ $user->username }}/public?tab=bookmarks#details"
                            role="tab">Bookmarks ({{ nice_number($user->bookmarks->count()) }})</a>
                    </li>
                    {{-- <li class="nav-item" role="presentation">
                        <a class="nav-link {{ $tab == 'activity' ? 'active' : '' }}"
                            href="/users/{{ $user->id }}/{{ $user->username }}/public?tab=activity#details"
                            role="tab">Activity</a>
                    </li> --}}
                    {{-- <li class="nav-item" role="presentation">
                        <a class="nav-link {{ $tab == 'activity' ? 'active' : '' }}"
                            href="/users/{{ $user->id }}/{{ $user->username }}/public?tab=activity#details"
                            role="tab">Activity</a>
                    </li> --}}
                </ul>

            </div>
        </div>
        <div>
            @if ($tab == 'about')
                @include('profile.public.partials.aboutTab', ['user' => $user])
            @elseif($tab == 'blogs')
                @include('profile.public.partials.blogTab', ['blogs' => $blogs])
            @elseif($tab == 'bookmarks')
                @include('profile.public.partials.bookmarkTab', ['bookmarks' => $bookmarks])
            {{-- @elseif ($tab == 'activity')
                @include('profile.public.partials.activityTab', ['user' => $user]) --}}
            @endif
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
