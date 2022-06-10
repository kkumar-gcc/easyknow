@if (count($followings) > 0)
    @foreach ($followings as $following)
        <div class="e-card e-card-center e-card-hover mt-3">
            <div class="e-card-image">
                <a href="/users/{{ $following->user->id }}/{{ $following->user->username }}/public" class="global-image">
                    <img class="user-image" src="https://picsum.photos/400/300" alt="">
                </a>
            </div>
            <div class="e-card-body">
                <div class="e-card-body-top">
                    <div class="top-left">
                        <a href="/users/{{ $following->user->id }}/{{ $following->user->username }}/public"
                            class="username">
                            {{ __($following->user->username) }}
                        </a>
                        <div class="e-card-line">
                            <span id="numberOfFollowers-{{ $following->user->id }}">
                                {{ $following->user->friendships->count() }} followers
                            </span>
                        </div>
                    </div>
                    <div class="top-right">
                        @guest
                            <a class="e-btn e-btn-primary" href="#">
                                {{ __('Follow') }}
                            </a>
                        @else
                            <div id="toast-unfollow">

                            </div>
                            @if ($following->user->isFollower())
                                <div id="user_follow_option-{{ $following->user->id }}" style="display: none;">
                                    <form method="post" id="follower_create-{{ $following->user->id }}" class="follower-create">
                                        @csrf
                                        @method('put')
                                        <input type="hidden" name="follower_id" id="follower_id"
                                            value="{{ auth()->user()->id }}">
                                        <input type="hidden" name="user_id" id="user_id" value="{{ $following->user->id }}">
                                        <button type="submit" class="e-btn e-btn-primary">Follow</button>
                                    </form>
                                </div>
                                <div id="user_unfollow_option-{{ $following->user->id }}">
                                    <button type="button" class="e-btn" data-mdb-ripple-color="dark"
                                        data-mdb-toggle="modal"
                                        data-mdb-target="#unfollowModal-{{ $following->user->id }}">Unfollow</button>
                                </div>
                            @else
                                <div id="user_follow_option-{{ $following->user->id }}">
                                    <form method="post" id="follower_create-{{ $following->user->id }}"
                                        class="follower-create">
                                        @csrf
                                        @method('put')
                                        <input type="hidden" name="follower_id" id="follower_id"
                                            value="{{ auth()->user()->id }}">
                                        <input type="hidden" name="user_id" id="user_id" value="{{ $following->user->id }}">
                                        <button type="submit" class="e-btn e-btn-primary">Follow</button>
                                    </form>
                                </div>
                                <div id="user_unfollow_option-{{ $following->user->id }}" style="display: none;">

                                    <button type="button" class="e-btn" data-mdb-ripple-color="dark"
                                        data-mdb-toggle="modal"
                                        data-mdb-target="#unfollowModal-{{ $following->user->id }}">Unfollow</button>
                                </div>
                            @endif
                            <div class="modal fade" id="unfollowModal-{{ $following->user->id }}" tabindex="-1"
                                aria-labelledby="unfollowModal-{{ $following->user->id }}-Label" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-sm">
                                    <div class="modal-content">

                                        <div class="card-body text-center">
                                            unfollow to " <strong class="font-weight-bold">{{ $following->user->username }}
                                            </strong>" ?
                                            <hr>

                                            <form method="POST" id="follower_delete-{{ $following->user->id }}"
                                                class="follower-delete" action="{{ Route('follower.delete') }}">
                                                @csrf
                                                @method('DELETE')
                                                <input type="hidden" name="follower_id" id="follower_d_id"
                                                    value="{{ auth()->user()->id }}">
                                                <input type="hidden" name="user_id" id="user_d_id"
                                                    value="{{ $following->user->id }}">
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
                        @endguest
                    </div>
                </div>
                <div class="auther-description">
                    If you`ve been programming for long enough, you have heard about the concept of a graph.

                </div>
            </div>
        </div>
    @endforeach

    {!! $followings->withQueryString()->onEachSide(3)->links('pagination::bootstrap-5') !!}
@else
    <div class="e-scard e-scard-hover s-empty-state wmx4 p48">
        <div class="card-body">
            You don't have any follower.
        </div>
    </div>
@endif
