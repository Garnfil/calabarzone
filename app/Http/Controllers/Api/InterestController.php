<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Interest;
use App\Models\Attraction;
use App\Models\Event;
use App\Models\Activity;
use App\Models\Accommodation;

class InterestController extends Controller
{
    public function getAllInterest(Request $request) {
        $interests = Interest::get();
        return response($interests, 200);
    }
}
