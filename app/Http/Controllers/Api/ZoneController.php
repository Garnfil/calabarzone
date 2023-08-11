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
            if($type == 'accommodations' || $type == 'attractions') {
                $results = $modelClass::where('interest_type', $interest->id)->where('is_active', 1)->get()->toArray();
            } else {
                $results = $modelClass::where('interest_type', $interest->id)->get()->toArray();
            }
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

        if(is_array($interest_ids)) {
            $results = $this->getForYouResult($limit, $models, $interest_ids);
            return response([
                "results" => $results,
                "total" => count($results)
            ]);
        } else {
            return response([
                'results' => 'No Result Found',
                'total' => 0
            ], 400);
        }


    }

    private function getForYouResult($limit, $models, $interest_ids) {
        $results = [];
        $model_count = count($models);
        $model_indexes = array_fill(0, $model_count, 0);

        $type_ids = array_fill_keys([
            'attractions', 'events', 'activities', 'accommodations', 'food_dinings'
        ], []);

        $iteration = 0;
        $max_iterations = $limit * 2;

        while ($limit > count($results) && $iteration < $max_iterations) {
            foreach ($models as $index => $model_info) {
                list($model_class, $type) = $model_info;

                $model = new $model_class;
                if($limit > count($results)) {

                    $data = $model->whereNotIn('id', $type_ids[$type])
                    ->whereIn('interest_type', $interest_ids)
                    ->first();

                    if ($data) {
                        $data['type'] = $type;
                        $type_ids[$type][] = $data->id;
                        $results[] = $data;
                    }
                }


                // Increment the model index
                $model_indexes[$index]++;
                // Reset the model index if it exceeds the array length
                if ($model_indexes[$index] >= count($models)) {
                    $model_indexes[$index] = 0;
                }
            }
            $iteration++;
        }
        return $results;
    }

}
