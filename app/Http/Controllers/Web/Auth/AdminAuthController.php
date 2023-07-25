<?php

namespace App\Http\Controllers\Web\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class AdminAuthController extends Controller
{
    public function viewLogin(Request $request) {
        return view('admin-page.auth.login');
    }

    public function saveLogin(Request $request) {

    }
}
