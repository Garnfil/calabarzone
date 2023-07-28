<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Admin;

class ForgotPasswordController extends Controller
{
    public function sendForgotPassword(Request $request) {
        $user = User::where('email', $request->email)->first();
        if($user) {

        } else {

        }
    }
}
