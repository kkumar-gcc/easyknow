@extends('layouts.user')
@section('content-left')
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
    <div class="e-vcard">
        <div class="e-vcard-title">

            <h3>Social Links</h3>
        </div>
        <div class="e-vcard-body">
            <div class="social-wrap">
                @if ($user->twitter_url)
                    <a class="social-link link-icon-twitter" href="{{ $user->twitter_url }}">
                        {{ svg('bi-twitter') }}
                    </a>
                @endif
                @if ($user->facebook_url)
                    <a class="social-link link-icon-facebook" href="{{ $user->facebook_url }}">
                        {{ svg('bi-facebook') }}
                    </a>
                @endif
                @if ($user->linkedin_url)
                    <a class="social-link link-icon-linkedin" href="{{ $user->linkedin_url }}">
                        {{ svg('bi-linkedin') }}
                    </a>
                @endif
                @if ($user->stackoverflow_url)
                    <a class="social-link" href="{{ $user->stackoverflow_url }}">
                        <img src="{{ asset('images/stackoverflow-color.svg') }}" style="width: 18px;height:18px">
                    </a>
                @endif
                @if ($user->reddit_url)
                    <a class="social-link link-icon-reddit" href="{{ $user->reddit_url }}">
                        {{ svg('bi-reddit') }}
                    </a>
                @endif
                @if ($user->instagram_url)
                    <a class="social-link link-icon-instagram" href="{{ $user->instagram_url }}">
                        {{ svg('bi-instagram') }}
                    </a>
                @endif
                @if ($user->youtube_url)
                    <a class="social-link link-icon-youtube" href="{{ $user->youtube_url }}">
                        {{ svg('bi-youtube') }}
                    </a>
                @endif
                @if ($user->quora_url)
                    <a class="social-link link-icon-quora" href="{{ $user->quora_url }}">
                        {{ svg('bi-quora') }}
                    </a>
                @endif
                @if ($user->laracasts_url)
                    <a class="social-link " href="{{ $user->laracasts_url }}">
                        <img src="{{ asset('images/laracasts-original.svg') }}" style="width: 18px;height:18px">
                    </a>
                @endif
                @if ($user->github_url)
                    <a class="social-link link-icon-github" href="{{ $user->github_url }}">
                        {{ svg('bi-github') }}
                    </a>
                @endif
                @if ($user->medium_url)
                    <a class="social-link link-icon-medium" href="{{ $user->medium_url }}">
                        {{ svg('bi-medium') }}
                    </a>
                @endif
                @if ($user->codepen_url)
                    <a class="social-link link-icon-codepen" href="{{ $user->codepen_url }}">
                        {{ svg('feathericon-codepen') }}
                    </a>
                @endif
            </div>
            @auth
                @if ($user->id == auth()->id())
                    <a href="/settings?tab=social_links">Edit social links</a>
                @endif
            @endauth
        </div>
    </div>

    <div class="e-vcard">
        <div class="e-vcard-title">
            <h3>Personal Info</h3>
        </div>
        <ul class="e-vcard-list">
            <li>
                <div class="personal-info">
                    {{ svg('uni-bag-alt-o') }}
                    <span>UI Manager / CSS Aficionado</span>
                </div>
            </li>
            <li>
                <div class="personal-info">
                    {{ svg('zondicon-location') }}
                    <span>kanpur</span>
                </div>
            </li>
            <li>
                <div class="personal-info">
                    {{ svg('heroicon-s-cake') }}
                    <span>Member Since {{ \Carbon\Carbon::parse($user->created_at)->format('M , Y') }}</span>
                </div>
            </li>
        </ul>
    </div>
    <div class="e-vcard">
        <div class="e-vcard-title">
            <span class="modern-badge modern-badge-danger">#Advertisment</span>
        </div>

        <div class="e-vcard-image">
            <img src="https://picsum.photos/1200/1000" alt="">

        </div>

    </div>
@endsection
@section('content')
    <div class="profile">
        <div class="e-card e-card-shadow" style="border-radius:0px 0px 0.5rem 0.5rem">
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

                        <span id="numberOfFollowers-{{ $user->id }}">{{ $user->friendships->count() }}
                            followers<span>
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
                                <a class="e-btn e-btn-success" href="/settings">
                                    {{ __('Edit Profile') }}
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
                                            <button type="submit" class="e-btn e-btn-success">Follow</button>
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
                                            <button type="submit" class="e-btn e-btn-success">Follow</button>
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
                <hr>
                
                <div class="tabs mb-4  mt-4 border-b border-gray-200 dark:border-gray-700">
                    <ul class="flex flex-wrap -mb-px text-sm font-medium text-center -primary" role="tablist">
                        <li class="mr-2" role="presentation">
                            <a class="inline-block p-4 rounded-t-lg border-b-2  {{ $tab == 'about' ? 'text-green-600 hover:text-green-600 dark:text-green-500 dark:hover:text-green-500 border-green-600 dark:border-green-500' : 'hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300 dark:border-transparent text-gray-500 dark:text-gray-400 border-gray-100 dark:border-gray-700' }}"
                                href="/users/{{ $user->username }}?tab=about#details" role="tab">About Me</a>
                        </li>
                        <li class="mr-2" role="presentation">
                            <a class="inline-block p-4 rounded-t-lg border-b-2  {{ $tab == 'blogs' ? 'text-green-600 hover:text-green-600 dark:text-green-500 dark:hover:text-green-500 border-green-600 dark:border-green-500' : 'hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300 dark:border-transparent text-gray-500 dark:text-gray-400 border-gray-100 dark:border-gray-700' }}"
                                href="/users/{{ $user->username }}?tab=blogs#details" role="tab">Blogs
                                ({{ nice_number($user->blogs->where('status', '=', 'posted')->count()) }})</a>
                        </li>
                        <li class="mr-2" role="presentation">
                            <a class="inline-block p-4 rounded-t-lg border-b-2  {{ $tab == 'bookmarks' ? 'text-green-600 hover:text-green-600 dark:text-green-500 dark:hover:text-green-500 border-green-600 dark:border-green-500' : 'hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300 dark:border-transparent text-gray-500 dark:text-gray-400 border-gray-100 dark:border-gray-700' }}"
                                href="/users/{{ $user->username }}?tab=bookmarks#details" role="tab">Bookmarks ({{ nice_number($user->bookmarks->count()) }})</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div>
            @if ($tab == 'about')
                @include('profile.public.partials.aboutTab', ['user' => $user])
            @elseif($tab == 'blogs')
                @include('profile.public.partials.blogTab', ['pins' => $pins, 'blogs' => $blogs])
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
