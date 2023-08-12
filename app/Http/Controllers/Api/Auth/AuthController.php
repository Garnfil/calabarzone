<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\EmailVerification;

use App\Models\User;

class AuthController extends Controller
{
    public function login(Request $request) {

        #validate requests
        $validator = \Validator::make($request->all(), [
            'email' => ['required'],
            'password' => ['required', 'min:3'],
        ]);

        # if the requested input have an error
        if($validator->fails()) return response()->json([
            'message' => $validator->errors()
        ], 401);

        $fieldType = filter_var($request->email, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        if(!Auth::attempt([$fieldType => $request->email, 'password' => $request->password, 'is_verify' => 1])) {
            return response()->json([
                'status' => false,
                'message' => 'Email & Password does not match with our record.',
            ], 401);
        }

        $user = Auth::user();

        return response([
            'user' => $user,
            'token' => $user->createToken("API TOKEN")->plainTextToken
        ], 200);
    }

    public function register(Request $request) {
        // return response($request->all());
        $validator = \Validator::make($request->all(), [
            'username' => ['required', 'unique:users,username', 'max:15'],
            'email' => ['required', 'unique:users,email', 'email'],
            'password' => ['required', 'required_with:confirm_password', 'same:confirm_password'],
            'confirm_password' => ['required', 'min:8'],
            'phone_number' => ['nullable', 'min:9']
        ]);

        # if the requested input have an error
        if($validator->fails()) return response()->json([
            'message' => $validator->errors()
        ], 401);

        $save = User::create([
            'email' => $request->email,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'phone_number' => $request->phone_number,
            'is_verify' => false,
        ]);

        # details for sending email to worker
        $details = [
            'title' => 'Verification email from CALABARZONE',
            'email' => $request->email,
            'username' => $request->username,
        ];

        // SEND EMAIL FOR VERIFICATION
        Mail::to($request->email)->send(new EmailVerification($details));

        return response()->json([
            'status' => true,
            'message' => 'Register Successfully. Verify your email now',
            'email' => $request->email
        ], 201);
    }

    public function logout(Request $request) {
        $user = Auth::user();

        # delete token
        $user->currentAccessToken()->delete();

        return response()->json([
            'status' => true,
            'message' => 'Logout Successfully',
        ], 200);
    }
}
