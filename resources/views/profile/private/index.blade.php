@extends('layouts.user')
@push('styles')
    <x-head.tinymce-config />
@endpush
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
    <nav class="desktop-nav-tab">
        <ul class="nav nav-tabs flex-column  mb-3" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link {{ $tab == 'profile' ? 'active' : '' }}" href="/settings?tab=profile" role="tab">Edit
                    Profile</a>
            </li>

            <li class="nav-item" role="presentation">
                <a class="nav-link {{ $tab == 'password' ? 'active' : '' }}" href="/settings?tab=password"
                    role="tab">Password
                </a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link {{ $tab == 'social_links' ? 'active' : '' }}" href="/settings?tab=social_links"
                    role="tab">Social Links</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link {{ $tab == 'blogs' ? 'active' : '' }}" href="/settings?tab=blogs" role="tab">Blogs
                    ({{ nice_number($user->blogs->where('status', '=', 'posted')->count()) }})
                </a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link {{ $tab == 'drafts' ? 'active' : '' }}" href="/settings?tab=drafts"
                    role="tab">Drafts
                    ({{ nice_number($user->blogs->where('status', '=', 'drafted')->count()) }})
                </a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link {{ $tab == 'bookmarks' ? 'active' : '' }}" href="/settings?tab=bookmarks"
                    role="tab">Bookmarks
                    ({{ nice_number($user->bookmarks->count()) }})</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link {{ $tab == 'follower' ? 'active' : '' }}" href="/settings?tab=follower"
                    role="tab">Follower</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link {{ $tab == 'following' ? 'active' : '' }}" href="/settings?tab=following"
                    role="tab">Following</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link {{ $tab == 'pins' ? 'active' : '' }}" href="/settings?tab=pins"
                    role="tab">Pinned</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link {{ $tab == 'podcasts' ? 'active' : '' }}" href="/settings?tab=podcasts"
                    role="tab">Podcasts</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link {{ $tab == 'comments' ? 'active' : '' }}" href="/settings?tab=comments"
                    role="tab">comments</a>
            </li>

        </ul>
    </nav>
@endsection
@section('content')
    <div class="profile">
        <nav class="tabs mobile-nav-tab">
            <ul class="nav nav-tabs mb-3 -primary" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link {{ $tab == 'profile' ? 'active' : '' }}" href="/settings?tab=profile"
                        role="tab">Edit Profile</a>
                </li>

                <li class="nav-item" role="presentation">
                    <a class="nav-link {{ $tab == 'password' ? 'active' : '' }}" href="/settings?tab=password"
                        role="tab">Password
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link {{ $tab == 'social_links' ? 'active' : '' }}" href="/settings?tab=social_links"
                        role="tab">Social Links</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link {{ $tab == 'blogs' ? 'active' : '' }}" href="/settings?tab=blogs"
                        role="tab">Blogs
                        ({{ nice_number($user->blogs->where('status', '=', 'posted')->count()) }})
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link {{ $tab == 'drafts' ? 'active' : '' }}" href="/settings?tab=drafts"
                        role="tab">Drafts
                        ({{ nice_number($user->blogs->where('status', '=', 'drafted')->count()) }})
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link {{ $tab == 'bookmarks' ? 'active' : '' }}" href="/settings?tab=bookmarks"
                        role="tab">Bookmarks
                        ({{ nice_number($user->bookmarks->count()) }})</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link {{ $tab == 'follower' ? 'active' : '' }}" href="/settings?tab=follower"
                        role="tab">Follower</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link {{ $tab == 'following' ? 'active' : '' }}" href="/settings?tab=following"
                        role="tab">Following</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link {{ $tab == 'pins' ? 'active' : '' }}" href="/settings?tab=pins"
                        role="tab">Pinned</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link {{ $tab == 'podcasts' ? 'active' : '' }}" href="/settings?tab=podcasts"
                        role="tab">Podcasts</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link {{ $tab == 'comments' ? 'active' : '' }}" href="/settings?tab=comments"
                        role="tab">Comments</a>
                </li>
            </ul>
        </nav>
        <div>
            <div id="loading"></div>

            @if ($tab == 'profile')
                @include('profile.private.partials.profileTab', ['user' => $user])
            @elseif ($tab == 'password')
                @include('profile.private.partials.passwordTab', ['user' => $user])
            @elseif ($tab == 'social_links')
                @include('profile.private.partials.socialTab', ['user' => $user])
            @elseif($tab == 'blogs')
                @include('profile.private.partials.blogTab', ['blogs' => $blogs])
            @elseif ($tab == 'drafts')
                @include('profile.private.partials.draftTab', ['drafts' => $drafts])
            @elseif($tab == 'bookmarks')
                @include('profile.private.partials.bookmarkTab', ['bookmarks' => $bookmarks])
            @elseif($tab == 'follower')
                @include('profile.private.partials.followerTab', ['followers' => $followers])
            @elseif($tab == 'following')
                @include('profile.private.partials.followingTab', ['followings' => $followings])
            @elseif ($tab == 'pins')
                <div id="pinTab">
                    @include('profile.private.partials.pinTab', ['pins' => $pins, 'blogs' => $blogs])
                </div>
            @elseif($tab == 'comments')
                @include('profile.private.partials.commentTab', ['comments' => $comments])
            @elseif($tab == 'podcasts')
                @include('profile.private.partials.podcastTab', ['user' => $user])
            @endif
        </div>

    </div>
@endsection
@push('scripts')
    @include('ajax')
    <script>
        $(document).ready(function() {
            $(document).on("submit", "#profile_update", function(e) {
                e.preventDefault(e);
                $.ajaxSetup({
                    header: $('meta[name="_token"]').attr('content')
                });
                var formdata = new FormData(this)
                $.ajax({
                    type: "POST",
                    url: '/profile/update',
                    data: formdata,
                    dataType: 'JSON',
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(data) {
                        $("#response_message").html(`
                        <div class="response-message response-success"><p>` + data.success + `</p></div>
                        `);
                    },
                    error: function(response) {
                        $('#usernameError').text(response.responseJSON.errors.username);
                        $('#nameError').text(response.responseJSON.errors.name);
                        $('#locationError').text(response.responseJSON.errors.location);
                        $('#firstNameError').text(response.responseJSON.errors.first_name);
                        $('#lastNameError').text(response.responseJSON.errors.last_name);
                        $('#shortBioError').text(response.responseJSON.errors.short_bio);
                        $('#aboutMeError').text(response.responseJSON.errors.about_me);
                        $('#websiteUrlError').text(response.responseJSON.errors.website_url);
                        if (response.responseJSON.errors.background_image) {
                            $("#background_image-child").addClass("drop-zone-danger");
                            $('#backgroundImageError').text(response.responseJSON.errors
                                .background_image);
                        }
                        if (response.responseJSON.errors.profile_image) {
                            $("#profile_image-child").addClass("drop-zone-danger");
                            $('#profileImageError').text(response.responseJSON.errors
                                .profile_image);

                        }
                    }
                });
            })
            $(document).on("submit", "#password_update", function(e) {
                e.preventDefault(e);
                $.ajaxSetup({
                    header: $('meta[name="_token"]').attr('content')
                });
                $.ajax({
                    type: "POST",
                    url: '/user/password/update',
                    data: $(this).serialize(),
                    dataType: 'JSON',
                    success: function(data) {
                        if (data.success) {
                            $("#response_message").html(`
                        <div class="response-message response-success"><p>` + data.success + `</p></div>
                        `);
                            $("#password_update")[0].reset();
                        }
                        if (data.error) {
                            $('#oldPasswordError').text(data.error);
                        }

                    },
                    error: function(response) {
                        $('#newPasswordError').html('');
                        $('#oldPasswordError').text(response.responseJSON.errors.old_password);
                        $.each(response.responseJSON.errors.new_password, function(key, value) {
                            $('#newPasswordError').append(
                                '<div>' + value + '</div'
                            );
                        });
                        // $('#newPasswordError').text(response.responseJSON.errors.new_password);
                        $('#cNewPasswordError').text(response.responseJSON.errors
                            .confirm_new_password);

                    }
                });

            })



        });
    </script>
@endpush
