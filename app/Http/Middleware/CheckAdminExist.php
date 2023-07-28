<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;

class CheckAdminExist
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $current_admin = Auth::guard('admin')->user();
        $is_admin_exist = Admin::where('id', $current_admin->id)->exists();

        if($is_admin_exist) {
            return $next($request);
        } else {
            Auth::guard('admin')->logout();
            return redirect()->route('admin.login')->with('removed-admin', 'Your current access account was removed, which caused you to be redirected to this page.');
        }
    }
}
