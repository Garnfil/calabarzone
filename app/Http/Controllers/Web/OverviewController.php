<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Interest;

class OverviewController extends Controller
{
    public function viewOverview(Request $request) {
        $interests = Interest::limit(5)->latest()->get();
        $users = User::limit(5)->latest()->get();
        return view('admin-page.overview.overview', compact('interests', 'users'));
    }
}
