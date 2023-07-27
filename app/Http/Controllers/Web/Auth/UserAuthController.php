<?php

namespace App\Http\Controllers\Web\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\EmailVerification;

use App\Models\User;

class UserAuthController extends Controller
{
    public function verifyEmail(Request $request) {
        $user = User::where('email', $request->email)->first();
        $user->is_verify = true;
        $user_save = $user->save();

        return redirect()->route('user.success_verification_message')->with('success', 'Email Verify Successfully');
    }
}
