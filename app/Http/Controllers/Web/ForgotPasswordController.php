<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;

use App\Mail\ForgotPasswordMail;

use App\Models\User;
use App\Models\Admin;

use App\Http\Requests\ForgotPassword\ResetPasswordRequest;

class ForgotPasswordController extends Controller
{
    public function sendForgotPassword(Request $request) {
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

    public function resetPasswordForm(Request $request) {
        $email = $request->email;
        return view('misc.forgot-password.reset-password-form', compact('email'));
    }

    public function saveResetPassword(ResetPasswordRequest $request) {
        $user = User::where('email', $request->email)->first();

        $update_user = $user->update([
            'password' => Hash::make($request->password),
        ]);

        if($update_user) {
            return redirect()->route('success_reset_password');
        }
    }
}
