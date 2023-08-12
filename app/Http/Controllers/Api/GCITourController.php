<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\GCITour;
use App\Models\GCITourCity;

class GCITourController extends Controller
{
    public function getGCITours(Request $request) {
        // whereIn('id', [2, 3, 4, 5, 6])->
        $gci_tours = GCITour::latest()->with('tour_province', 'tour_cities')->get();
        return response($gci_tours, 200);
    }

    public function getTourProvince(Request $request) {
        $gci_tour_province = GCITour::where('id', $request->id)->with('tour_province', 'tour_cities')->first();
        return response($gci_tour_province);
    }
}
