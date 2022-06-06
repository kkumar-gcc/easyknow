<div class="user row">
    <div class="user-left ">
        <div class="image">
            <img src="https://picsum.photos/400/300" alt="">
        </div>
        <div class="info">
            <p> <a class="link link-secondary" href="/users/{{ $user->id }}/{{ $user->username }}/public">
                    {{ __($user->username) }}
                </a></p>
            <span id="numberOfFollowers-{{ $user->id }}">{{ $user->friendships->count() }}
                followers</span>
        </div>
    </div>
    <div class="user-right">
        @guest
            <a class="e-btn e-btn-primary" href="#">
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
                            <input type="hidden" name="follower_id" id="follower_id" value="{{ auth()->user()->id }}">
                            <input type="hidden" name="user_id" id="user_id" value="{{ $user->id }}">
                            <button type="submit" class="e-btn e-btn-primary">Follow</button>
                        </form>
                    </div>
                    <div id="user_unfollow_option-{{ $user->id }}">
                        <button type="button" class="e-btn" data-mdb-ripple-color="dark" data-mdb-toggle="modal"
                            data-mdb-target="#unfollowModal-{{ $user->id }}">Unfollow</button>
                    </div>
                @else
                    <div id="user_follow_option-{{ $user->id }}">
                        <form method="post" id="follower_create-{{ $user->id }}" class="follower-create">
                            @csrf
                            @method('put')
                            <input type="hidden" name="follower_id" id="follower_id" value="{{ auth()->user()->id }}">
                            <input type="hidden" name="user_id" id="user_id" value="{{ $user->id }}">
                            <button type="submit" class="e-btn e-btn-primary">Follow</button>
                        </form>
                    </div>
                    <div id="user_unfollow_option-{{ $user->id }}" style="display: none;">

                        <button type="button" class="e-btn" data-mdb-ripple-color="dark" data-mdb-toggle="modal"
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

                                <form method="POST" id="follower_delete-{{ $user->id }}" class="follower-delete"
                                    action="{{ Route('follower.delete') }}">
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" name="follower_id" id="follower_d_id"
                                        value="{{ auth()->user()->id }}">
                                    <input type="hidden" name="user_id" id="user_d_id" value="{{ $user->id }}">
                                    <div class="form-group">
                                        <button type="button" class="e-btn" data-mdb-dismiss="modal">No</button>
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
