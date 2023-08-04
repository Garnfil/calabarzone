<?php

namespace App\Http\Controllers\Web\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

use App\Models\Admin;

use App\Http\Requests\AdminAuth\SaveLoginRequest;
use App\Http\Requests\Admin\ChangeAdminPasswordRequest;

class AdminAuthController extends Controller
{
    public function viewLogin(Request $request) {
        if(Auth::guard('admin')->check()) {
            return redirect()->route('admin.overview');
        }
        return view('admin-page.auth.login');
    }

    public function saveLogin(SaveLoginRequest $request) {
        $credentials = $request->validated();
        if (Auth::guard('admin')->attempt(array_merge($credentials))) {
            return redirect()->route('admin.overview')->with('success', 'Login Successfully');
        } else {
            return back()->with('fail', 'Invalid Credentials.');
        }
    }

    public function changePassword() {
        return view('admin-page.change_password.change_password');
    }

    public function saveChangePassword(ChangeAdminPasswordRequest $request) {
        $data = $request->validated();
        $user = Auth::guard('admin')->user();

        if(!Hash::check($request->old_password, $user->password)) return back()->with('fail', 'Your old password is incorrect. Please Try Again.');

        $update_user = $user->update([
            'password' => Hash::make($request->new_password),
        ]);

        return redirect()->route('admin.overview')->with('success', 'Your Password Updated Successfully');
    }

    public function logout(Request $request) {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login')->with('success', 'Logout Successfully');
    }
}
