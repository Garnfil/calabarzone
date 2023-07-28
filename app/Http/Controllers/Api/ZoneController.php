<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Interest;
use App\Models\Accommodation;
use App\Models\Activity;
use App\Models\Event;
use App\Models\Attraction;

class ZoneController extends Controller
{

    public function getAllZones(Request $request) {
        return Auth::user()->my_interests;
    }

    public function getAllDataByZoneType(Request $request) {
        // Get the Interest model for Nature & Adventure
        $interest = Interest::where('id', $request->id)->firstOrFail();

        // Initialize an empty array to hold the final data
        $data = [];

        // Define the models and their corresponding types
        $models = [
            Attraction::class => 'attractions',
            Event::class => 'events',
            Activity::class => 'activities',
            Accommodation::class => 'accommodations',
        ];

        // Loop through the models, retrieve the data, and add the "type" key
        foreach ($models as $modelClass => $type) {
            $results = $modelClass::where('interest_type', $interest->id)->get()->toArray();
            foreach ($results as $result) {
                $result['type'] = $type;
                $data[] = $result;
            }
        }

        return response()->json($data);
    }

    // Assuming you've already imported the necessary models at the top of your controller

    public function getDataByZoneType(Request $request) {
        $type = $request->type;
        $id = $request->id;
        $data = null;

        switch ($type) {
            case 'attractions':
                $data = Attraction::find($id);
                break;

            case 'events':
                $data = Event::find($id);
                break;

            case 'activities':
                $data = Activity::find($id);
                break;

            case 'accommodations':
                $data = Accommodation::find($id);
                break;

            // Optionally, you can add more cases for other types if needed
            default:
                break;
        }

        return response()->json($data);
    }

    public function getForYou(Request $request) {
        $limit = $request->limit;
    }
}
