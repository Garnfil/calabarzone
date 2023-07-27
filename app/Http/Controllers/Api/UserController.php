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
            'username' => ['required', 'unique:users', 'max:15'],
            'firstname' => ['required'],
            'lastname' => ['required'],
        ]);

        # if the requested input have an error
        if($validator->fails()) return response()->json([
            'message' => $validator->errors()
        ], 401);

        $user_update = Auth::user()->update([
            'username' => $request->username,
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'name' => $request->firstname . ' ' . $request->lastname,
        ]);

        if($user_update) return response([
            'message' => 'Your profile has been updated successfully',
        ], 200);
    }
}
