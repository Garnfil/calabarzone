<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\GCITour;
use App\Models\GCITourCity;

class GCITourController extends Controller
{
    public function getGCITours(Request $request) {
        $gci_tours = GCITour::latest()->with('tour_province', 'tour_cities')->get();
        return response($gci_tours, 200);
    }
}
