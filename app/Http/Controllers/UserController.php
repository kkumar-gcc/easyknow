<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function resetPassword(Request $request)
    {
        $request->validate([
            'old_password' => ['required'],
            'new_password' => [
                'required',
                'min:8',
                'regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[@$!%*#?&]).*$/',
            ],
            'confirm_new_password' => [
                'required',
                'same:new_password'
            ]
        ]);
        $oldPassword = $request->get('old_password');
        $newPassword = $request->get('new_password');
        if (Hash::check($oldPassword, auth()->user()->password)) {
            $user = User::find(auth()->user()->id);
            $user->password = Hash::make($newPassword);
            $saved = $user->save();
            if ($saved) {
                return response()->json(["success" => "password updated successfully ."]);
            }
        } else {
            return response()->json(["error" => "old password is not matching."]);
        }
    }
}
