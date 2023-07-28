<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;

class ForgotPasswordController extends Controller
{
    function sendForgotPassword(Request $request) {
        $user = User::where('email', $request->email)->first();
        if($user) {



        } else {
            return response([
                'status' => false,
                'message' => "The email provided does not exist."
            ]);
        }
    }
}
