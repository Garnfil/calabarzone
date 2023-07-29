<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Province;

class ProvinceController extends Controller
{
    public function getProvinces(Request $request) {
        $provinces = Province::select('id', 'name', 'featured_image', 'tagline', 'transportations')->latest()->get();
        return response($provinces);
    }
}