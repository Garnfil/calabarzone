<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Attraction;

class AttractionController extends Controller
{
    public function getFeaturedAttractions(Request $request) {
        $attractions = Attraction::where('is_featured', 1)->where('is_active', 1)->get();
        return response($attractions);
    }
}
