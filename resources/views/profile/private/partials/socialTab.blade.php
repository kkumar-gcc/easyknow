<div>
    <div class="e-vcard e-vcard-shadow mt-3">
        @if (session()->has('success'))
            <div class="response-message response-success">
                <p>{{ session()->get('success') }}</p>
            </div>
        @endif
        <form method="POST" action="/settings/social-links">
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class=" mb-4">
                    <label class="form-label" for="twitter_username">Twitter</label>
                    <input type="url" id="twitter_username" class="form-control" name="twitter_username"
                        value="{{ old('twitter_username', $user->twitter_url) }}" />
                    <div class="input-error" id="oldPasswordError"></div>
                </div>
                <div class=" mb-4">
                    <label class="form-label" for="facebook_username">Facebook</label>
                    <input type="url" id="facebook_username" class="form-control" name="facebook_username"
                        value="{{ old('facebook_username', $user->facebook_url) }}" />
                    <div class="input-error" id="oldPasswordError"></div>
                </div>
                <div class=" mb-4">
                    <label class="form-label" for="instagram_username">Instagram</label>
                    <input type="url" id="instagram_username" class="form-control" name="instagram_username"
                        value="{{ old('instagram_username', $user->instagram_url) }}" />
                    <div class="input-error" id="oldPasswordError"></div>
                </div>
                <div class=" mb-4">
                    <label class="form-label" for="linkedin_username">LinkedIn</label>
                    <input type="url" id="linkedin_username" class="form-control" name="linkedin_username"
                        value="{{ old('linkedin_username', $user->linkedin_url) }}" />
                    <div class="input-error" id="oldPasswordError"></div>
                </div>
                <div class=" mb-4">
                    <label class="form-label" for="github_username">GitHub</label>
                    <input type="url" id="github_username" class="form-control" name="github_username"
                        value="{{ old('github_username', $user->github_url) }}" />
                    <div class="input-error" id="oldPasswordError"></div>
                </div>
                <div class=" mb-4">
                    <label class="form-label" for="stackoverflow_username">Stack Overflow</label>
                    <input type="url" id="stackoverflow_username" class="form-control" name="stackoverflow_username"
                        value="{{ old('stackoverflow_username', $user->stackoverflow_url) }}" />
                    <div class="input-error" id="oldPasswordError"></div>
                </div>
                <div class=" mb-4">
                    <label class="form-label" for="medium_username">Medium</label>
                    <input type="url" id="medium_username" class="form-control" name="medium_username"
                        value="{{ old('medium_username', $user->medium_url) }}" />
                    <div class="input-error" id="oldPasswordError"></div>
                </div>
                <div class=" mb-4">
                    <label class="form-label" for="quora_username">Quora</label>
                    <input type="url" id="quora_username" class="form-control" name="quora_username"
                        value="{{ old('quora_username', $user->quora_url) }}" />
                    <div class="input-error" id="oldPasswordError"></div>
                </div>
                <div class=" mb-4">
                    <label class="form-label" for="reddit_username">Reddit</label>
                    <input type="url" id="reddit_username" class="form-control" name="reddit_username"
                        value="{{ old('reddit_username', $user->reddit_url) }}" />
                    <div class="input-error" id="oldPasswordError"></div>
                </div>
                <div class=" mb-4">
                    <label class="form-label" for="youtube_channel">Youtube</label>
                    <input type="url" id="youtube_channel" class="form-control" name="youtube_channel"
                        value="{{ old('youtube_channel', $user->youtube_url) }}" />
                    <div class="input-error" id="oldPasswordError"></div>
                </div>
                <div class=" mb-4">
                    <label class="form-label" for="codepen_username">CodePen</label>
                    <input type="url" id="codepen_username" class="form-control" name="codepen_username"
                        value="{{ old('codepen_username', $user->codepen_url) }}" />
                    <div class="input-error" id="oldPasswordError"></div>
                </div>
                <div class=" mb-4">
                    <label class="form-label" for="laracasts_username">Laracasts</label>
                    <input type="url" id="laracasts_username" class="form-control" name="laracasts_username"
                        value="{{ old('laracasts_username', $user->laracasts_url) }}" />
                    <div class="input-error" id="oldPasswordError"></div>
                </div>
                <input type="submit" class="e-btn e-btn-success" value="update socila links" />

            </div>
        </form>
    </div>
</div>
