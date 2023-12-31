<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Province;

class ProvinceController extends Controller
{
    public function getProvinces(Request $request) {
        $provinces = Province::select('id', 'name', 'featured_image', 'tagline', 'transportations', 'delicacies', 'latitude', 'longitude')->orderBy('order_id', 'asc')->get();
        return response($provinces);
    }

    public function getProvince(Request $request) {
        return Province::where('id', $request->id)->firstOr(function() {
            return response([
                'message' => 'Province Not Found'
            ]);
        });
    }
}
