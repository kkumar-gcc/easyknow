<div>
    <div class="e-vcard mt-3">
        <form method="POST" id="password_update">
            @csrf
            @method('PUT')
            <div class="card-body">

                <h4 class="">Set New Password</h4>
                <hr>
                <div class=" mb-4">
                    <label class="form-label" for="old_password">Current Password</label>
                    <input type="password" id="old_password" class="form-control" name="old_password" autocomplete="off" />
                    <div class="input-error" id="oldPasswordError"></div>
                </div>
                <div class=" mb-4">
                    <label class="form-label" for="new_password">New Password</label>
                    <input type="password" id="new_password" class="form-control" name="new_password" autocomplete="off" />
                    <div class="input-error" id="newPasswordError"></div>
                </div>
                <div class=" mb-4">
                    <label class="form-label" for="confirm_new_password">Confirm New Password</label>
                    <input type="password" id="confirm_new_password" class="form-control" name="confirm_new_password"
                        autocomplete="off" />
                        <div class="input-error" id="cNewPasswordError"></div>
                </div>
                <div id="response_message"></div>
                <input type="submit" class="e-btn e-btn-primary" value="set password" />
                
            </div>
        </form>
    </div>
    <div class="e-vcard mt-3 border border-danger">
        <div class="card-body">
            <form method="POST" id="profile_update">
                <h4 class="card-title text-danger">Delete Account</h4>
                <p>Once you delete your account, there is no going back. Please be certain.</p>
                <button class="e-btn e-btn-danger ">Delete account</button>
            </form>
        </div>
    </div>
</div>
