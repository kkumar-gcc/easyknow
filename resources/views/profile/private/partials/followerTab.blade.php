@if (count($followers) > 0)
    @foreach ($followers as $follower)
        <div class="e-card e-card-center e-card-hover mt-3">
            <div class="e-card-image">
                <a href="/users/{{ $follower->follower->username }}" class="global-image">
                    <img class="user-image" src="https://picsum.photos/400/300" alt="">
                </a>
            </div>
            <div class="e-card-body">
                <div class="e-card-body-top">
                    <div class="top-left">
                        <a href="/users/{{ $follower->follower->username }}" class="username">
                            {{ __($follower->follower->username) }}
                        </a>
                        <div class="e-card-line">
                            <span id="numberOfFollowers-{{ $follower->follower->id }}">
                                {{ $follower->follower->friendships->count() }} followers
                            </span>
                        </div>
                    </div>
                    <div class="top-right">
                        @guest
                            <a class="e-btn e-btn-success" href="#">
                                {{ __('Follow') }}
                            </a>
                        @else
                            <div id="toast-unfollow">

                            </div>
                            @if (auth()->user()->id == $follower->follower->id)
                                <a class="e-btn e-btn-success"
                                    href="/users/{{ $follower->follower->username }}">
                                    {{ __('View Profile') }}
                                </a>
                            @else
                                @if ($follower->follower->isFollower())
                                    <div id="user_follow_option-{{ $follower->follower->id }}" style="display: none;">
                                        <form method="post" id="follower_create-{{ $follower->follower->id }}"
                                            class="follower-create">
                                            @csrf
                                            @method('put')
                                            <input type="hidden" name="follower_id" id="follower_id"
                                                value="{{ auth()->user()->id }}">
                                            <input type="hidden" name="user_id" id="user_id" value="{{ $follower->follower->id }}">
                                            <button type="submit" class="e-btn e-btn-success">Follow</button>
                                        </form>
                                    </div>
                                    <div id="user_unfollow_option-{{ $follower->follower->id }}">
                                        <button type="button" class="e-btn" data-mdb-ripple-color="dark"
                                            data-mdb-toggle="modal"
                                            data-mdb-target="#unfollowModal-{{ $follower->follower->id }}">Unfollow</button>
                                    </div>
                                @else
                                    <div id="user_follow_option-{{ $follower->follower->id }}">
                                        <form method="post" id="follower_create-{{ $follower->follower->id }}"
                                            class="follower-create">
                                            @csrf
                                            @method('put')
                                            <input type="hidden" name="follower_id" id="follower_id"
                                                value="{{ auth()->user()->id }}">
                                            <input type="hidden" name="user_id" id="user_id" value="{{ $follower->follower->id }}">
                                            <button type="submit" class="e-btn e-btn-success">Follow</button>
                                        </form>
                                    </div>
                                    <div id="user_unfollow_option-{{ $follower->follower->id }}" style="display: none;">

                                        <button type="button" class="e-btn" data-mdb-ripple-color="dark"
                                            data-mdb-toggle="modal"
                                            data-mdb-target="#unfollowModal-{{ $follower->follower->id }}">Unfollow</button>
                                    </div>
                                @endif
                                <div class="modal fade" id="unfollowModal-{{ $follower->follower->id }}" tabindex="-1"
                                    aria-labelledby="unfollowModal-{{ $follower->follower->id }}-Label" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-sm">
                                        <div class="modal-content">

                                            <div class="card-body text-center">
                                                unfollow to " <strong class="font-weight-bold">{{ $follower->follower->username }}
                                                </strong>" ?
                                                <hr>

                                                <form method="POST" id="follower_delete-{{ $follower->follower->id }}"
                                                    class="follower-delete" action="{{ Route('follower.delete') }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <input type="hidden" name="follower_id" id="follower_d_id"
                                                        value="{{ auth()->user()->id }}">
                                                    <input type="hidden" name="user_id" id="user_d_id"
                                                        value="{{ $follower->follower->id }}">
                                                    <div class="form-group">
                                                        <button type="button" class="e-btn"
                                                            data-mdb-dismiss="modal">No</button>
                                                        <input type="submit" class="e-btn e-btn-success" value="Unfollow">
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
                <div class="auther-description">
                    If you`ve been programming for long enough, you have heard about the concept of a graph.

                </div>
            </div>
        </div>
    @endforeach

    {!! $followers->withQueryString()->onEachSide(3)->links('pagination::bootstrap-5') !!}
@else
    <div class="e-scard e-scard-hover s-empty-state wmx4 p48">
        <div class="card-body">
            You don't have any follower.
        </div>
    </div>
@endif
