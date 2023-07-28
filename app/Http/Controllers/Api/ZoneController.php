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
use App\Models\FoodAndDining;

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
            FoodAndDining::class => 'food_dinings',
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

            case 'food_dinings':
                $data = FoodAndDining::find($id);
                break;

            // Optionally, you can add more cases for other types if needed
            default:
                break;
        }

        return response()->json($data);
    }

    public function getForYou(Request $request) {

        $limit = $request->limit;

         // Define the models and their corresponding types
        $models = [
            [Attraction::class, 'attractions'],
            [Event::class, 'events'],
            [Activity::class, 'activities'],
            [Accommodation::class, 'accommodations'],
            [FoodAndDining::class, 'food_dinings'],
        ];

        $user = Auth::user();

        $interest_ids = json_decode($user->interests);
        $results = $this->getForYouResult($limit, $models, $interest_ids);

        return response($results);
    }

    private function getForYouResult($limit, $models, $interest_ids) {
        $results = [];

        for ($i=0; $i < $limit; $i++) {
            $model_index = 0;

            $model = new $models[$model_index][0];

            $data = $model->whereIn('interest_type', $interest_ids)->first();
            $data['type'] = $models[$model_index][1];
            $results[] = $data;

            $model_index++;
        }

        return $results;
        // return $models[0];

        // foreach ($models as $modelClass => $modelName) {
        //     // Get the model instance from the class name
        //     $model = new $modelClass;

        //     // Retrieve data based on the interest_ids and limit
        //     $data = $model->whereIn('interest_type', $interest_ids)->get();
        //     foreach ($data as $result) {
        //         $result['type'] = $modelName;
        //         if() {

        //         }
        //         $results[] = $result;
        //     }
        // }

        return $results;
    }
}
