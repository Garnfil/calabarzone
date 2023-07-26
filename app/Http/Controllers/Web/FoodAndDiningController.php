<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Models\FoodAndDining;
use App\Models\Province;
use App\Models\Interest;

use App\Http\Requests\Activity\CreateActivityRequest;
use App\Http\Requests\Activity\UpdateActivityRequest;

use DataTables;

class FoodAndDiningController extends Controller
{
    public function list(Request $request) {
        if($request->ajax()) {
            $data = FoodAndDining::latest()->with('province', 'city_municipality');
            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('featured_image', function ($row) {
                        $featured_image = "../app-assets/images/food_dinings/" . $row->featured_image;
                        return '<img src="' . $featured_image . '" style="width: 75px;" />';
                    })
                    ->addColumn('province', function($row) {
                        return $row->province->name;
                    })
                    ->addColumn('city_municipality', function($row) {
                        return $row->city_municipality->name;
                    })
                    ->addColumn('actions', function($row) {
                        $btn = '<a href="/admin/food_dining/edit/' . $row->id . '" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                                <button id="' . $row->id . '" class="btn btn-danger"><i class="fa fa-trash"></i></button>';
                        return $btn;
                    })
                    ->rawColumns(['featured_image', 'actions'])
                    ->make(true);
        }

        return view('admin-page.food_dinings.list');
    }

    public function create(Request $request) {

    }

    public function store(Request $request) {

    }

    public function edit(Request $request) {

    }

    public function update(Request $request) {

    }
}
