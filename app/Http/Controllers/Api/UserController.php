<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\User;

class UserController extends Controller
{
    public function getUser(Request $request) {
        return Auth::user();
    }

    public function updateProfile(Request $request) {

        $validator = \Validator::make($request->all(), [
            'user_profile' => ['nullable', 'image'],
            'username' => ['required', 'max:15'],
            'firstname' => ['required'],
            'lastname' => ['required'],
        ]);

        # if the requested input have an error
        if($validator->fails()) return response()->json([
            'message' => $validator->errors()
        ], 401);

        $image_name = $request->firstname . '_' . $request->lastname;

        if($request->hasFile('user_profile')) {
            $file = $request->file('user_profile');
            $file_name = Str::snake(Str::lower($image_name)) . '.' . $file->getClientOriginalExtension();
            $save_file = $file->move(public_path() . '/app-assets/images/users_profile', $file_name);
        } else {
            $file_name = null;
        }

        $user_update = Auth::user()->update([
            'username' => $request->username,
            'user_profile' => $file_name,
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'name' => $request->firstname . ' ' . $request->lastname,
        ]);

        if($user_update) return response([
            'message' => 'Your profile has been updated successfully',
        ], 200);
    }

    public function updateZone(Request $request) {
        $my_interests = $request->interests;
        $user = Auth::user();
        $update_interest = $user->update([
            'interests' => json_encode($my_interests)
        ]);

        if($update_interest) return response([
            'status' => true,
            'message' => 'Zone of user updated successfully'
        ]);
    }

    public function deleteAccount(Request $request) {
        $user = Auth::user();

        $delete_all_tokens = $user->tokens()->delete();

        // Removing user profile

        $delete_user = $user->delete();

        if($delete_user) {
            return response([
                'status' => true,
                'message' => 'Delete user account successfully'
            ], 200);
        }
    }
}
