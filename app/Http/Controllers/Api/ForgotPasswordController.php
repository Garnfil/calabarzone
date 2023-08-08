<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;

use App\Mail\ForgotPasswordMail;

use App\Models\User;
use App\Models\Admin;

class ForgotPasswordController extends Controller
{
    function sendForgotPassword(Request $request) {
        $user = User::where('email', $request->email)->first();

        if($user) {
            $send_mail = Mail::to($request->email)->send(new ForgotPasswordMail($request->email));
            return response([
                'status' => true,
                'message' => 'We emailed you the link to reset your password. Please Check.'
            ]);
        } else {
            return response([
                'status' => false,
                'message' => 'Your given email was not found on our record'
            ], 400);
        }
    }
}
