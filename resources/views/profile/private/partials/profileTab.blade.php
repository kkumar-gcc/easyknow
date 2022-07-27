<div class="profile">
    <div class="e-card e-card-shadow" style="border-radius:0px 0px 0.5rem 0.5rem">

        <div class="card-body profile-body">
            <form method="POST" id="profile_update" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">

                {{-- <input type="hidden" name="MAX_FILE_SIZE" value="30000000" /> --}}
                <div class="background-image">
                    <img src="{{ asset($user->background_image ?? '') }}"
                        alt="{{ $user->username }}'s background image" id="background_image">
                </div>
                <div class="profile-image">
                    <div class="user-image">
                        <img src="{{ asset($user->profile_image ?? '') }}" alt="{{ $user->username }} profile"
                            id="profile_image">
                    </div>
                    <div class="user-detail">
                        <h1>{{ $user->username }}</h1>

                        <span id="numberOfFollowers-{{ $user->id }}">{{ $user->friendships->count() }}
                            followers<span>
                    </div>
                    <div class="user-btn">
                        <a class="e-btn e-btn-success" href="/users/{{ $user->username }}">
                            {{ __('View Public Profile') }}
                        </a>
                    </div>

                </div>
                <div class="row" style="padding:7px">
                    <div class="col-lg-6 mb-4">
                        <label class="form-label" for="first_name">Profile Picture</label>
                        <div class="drop-zone" id="profile_image-child">
                            <p class="drop-zone__prompt">Drop file here or click to upload</p>
                            <input type="file" name="profile_image" class="drop-zone__input" accept="image/*,.jpg,.png">
                        </div>
                        <div class="input-error" id="profileImageError"></div>
                    </div>
                    <div class="col-lg-6 mb-4">
                        <label class="form-label" for="last_name">Background Image</label>
                        <div class="drop-zone" id="background_image-child">
                            <span class="drop-zone__prompt">Drop file here or click to upload</span>
                            <input type="file" name="background_image" class="drop-zone__input">
                        </div>
                        <div class="input-error" id="backgroundImageError"></div>
                    </div>
                </div>
                <div class=" mb-4">
                    <label class="form-label" for="username">Username</label>
                    <input type="text" id="username" class="form-control" name="username"
                        value="{{ old('username', $user->username ?? '') }}" />
                    <div class="input-error" id="usernameError"></div>
                </div>
                <div class=" mb-4"> <label class="form-label" for="name">Name</label>
                    {{-- <i class="fas fa-exclamation-circle trailing" data-mdb-toggle="popover"
                        data-mdb-content="And here's some amazing content. It's very engaging. Right?"></i> --}}
                    <input type="text" id="name" class="form-control" name="name"
                        value="{{ old('title', $user->name ?? '') }}" />
                    <div class="input-error" id="nameError"></div>
                </div>
                <div class=" mb-4">
                    <label class="form-label" for="location">location</label>
                    <input type="text" id="location" class="form-control" name="location"
                        value="{{ old('location', $user->location ?? '') }}" />
                        <div class="input-error" id="locationError"></div>
                </div>
                <div class="row" style="padding:7px">
                    <div class="col-lg-6 mb-4">
                        <label class="form-label" for="first_name">First Name</label>
                        <input type="text" id="first_name" class="form-control" name="first_name"
                            value="{{ old('first_name', $user->first_name ?? '') }}" />
                        <div class="input-error" id="firstNameError"></div>
                    </div>
                    <div class="col-lg-6 mb-4">
                        <label class="form-label" for="last_name">Last Name</label>
                        <input type="text" id="last_name" class="form-control" name="last_name"
                            value="{{ old('last_name', $user->last_name ?? '') }}" />
                        <div class="input-error" id="LastNameError"></div>
                    </div>
                </div>
                <div class=" mb-5">
                    <label class="form-label" for="short_bio">Short Bio</label>
                    <div class="form-outline">
                        <textarea id="short_bio" class="form-control" name="short_bio" data-mdb-showcounter="true" maxlength="200" rows="4">{{ old('short_bio', $user->short_bio ?? '') }}</textarea>
                        <div class="form-helper"></div>
                    </div>
                    <div class="input-error" id="shortBioError"></div>
                </div>
                <div class=" mb-4">
                    <label class="form-label" for="editor2">About Me</label>
                    <textarea type="text" class="form-control text-editor" name="about_me" id="editor2">{{ old('about_me', $user->about_me ?? '') }}</textarea>
                    <div class="input-error" id="aboutMeError"></div>
                </div>
                <div class=" mb-4">
                    <label class="form-label" for="website_url">Website Url</label>
                    <input type="url" id="website_url" class="form-control" name="website_url"
                        placeholder="https://website.com"
                        value="{{ old('website_url', $user->website_url ?? '') }}" />
                    <div class="input-error" id="websiteUrlError"></div>
                </div>
                <div id="response_message">
                </div>
                <input type="submit" class="e-btn e-btn-success" value="save profile info" />
            </form>

        </div>

    </div>
</div>
