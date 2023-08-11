<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Models\CityMunicipality;
use App\Models\Province;

use App\Http\Requests\CityMunicipality\CreateCityMunicipalityRequest;
use App\Http\Requests\CityMunicipality\UpdateCityMunicipalityRequest;

use DataTables;

class CityMunicipalityController extends Controller
{
    public function list(Request $request) {

        if($request->ajax()) {
            $data = CityMunicipality::latest()->with('province');
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('featured_image', function ($row) {
                        $featured_image = "../app-assets/images/city_municipality/" . $row->featured_image;
                        return '<img src="' . $featured_image . '" style="width: 75px;" />';
                    })
                    ->addColumn('province', function ($row) {
                        return $row->province->name;
                    })
                    ->addColumn('actions', function($row) {
                        $btn = '<a href="/admin/city_municipality/edit/' . $row->id . '" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                                <button id="' . $row->id . '" class="btn btn-danger remove-btn"><i class="fa fa-trash"></i></button>';
                        return $btn;
                    })
                    ->rawColumns(['actions', 'featured_image'])
                    ->make(true);
        }

        return view('admin-page.cities_municipalities.list');
    }

    public function lookup(Request $request) {
        if($request->ajax()) {
            $data = CityMunicipality::where('province_id', $request->province_id)->get();
            return response($data, 200);
        }
    }

    public function create(Request $request) {
        $provinces = Province::orderBy('order_id', 'asc')->get();
        return view('admin-page.cities_municipalities.create', compact('provinces'));
    }

    public function store(CreateCityMunicipalityRequest $request) {
        $data = $request->validated();
        $featured_image_name = null;

        if($request->has('featured_image')) {
            $featured_image = $request->file('featured_image');
            $featured_image_name = Str::snake($request->name) . '.' . $featured_image->getClientOriginalExtension();
            $save_file = $featured_image->move(public_path() . '/app-assets/images/city_municipality', $featured_image_name);
        }

        $create = CityMunicipality::create(array_merge($data, [
            'featured_image' => $featured_image_name
        ]));

        if($create) return redirect()->route('admin.cities_municipalities')->with('success', 'City or Municipality Created Successfully.');
    }

    public function edit(Request $request) {
        $data = CityMunicipality::where('id', $request->id)->firstOrFail();
        $provinces = Province::orderBy('order_id', 'asc')->get();
        return view('admin-page.cities_municipalities.edit', compact('data', 'provinces'));
    }

    public function update(UpdateCityMunicipalityRequest $request) {
        $data = $request->validated();
        $province = CityMunicipality::where('id', $request->id)->firstOrFail();
        $featured_image_name = $request->old_image;

        if($request->hasFile('featured_image')) {
            $old_upload_image = public_path('/app-assets/images/city_municipality') . $request->old_image;
            $remove_image = @unlink($old_upload_image);

            $featured_image = $request->file('featured_image');
            $featured_image_name = Str::snake($request->name) . '.' . $featured_image->getClientOriginalExtension();

            $save_file = $featured_image->move(public_path() . '/app-assets/images/city_municipality', $featured_image_name);
        }

        $update = $province->update(array_merge($data,
        [ 'featured_image' => $featured_image_name]));

        if($update) return back()->with('success', 'City or Municipality Updated Successfully');
    }

    public function destroy(Request $request) {
        $id = $request->id;
        $city_municipality = CityMunicipality::where('id', $request->id)->firstOrFail();

        $old_upload_image = public_path('/app-assets/images/city_municipality/') . $city_municipality->featured_image;
        $remove_image = @unlink($old_upload_image);

        $delete = $city_municipality->delete();

        if($delete) {
            return response([
                'status' => true,
                'message' => 'Deleted Successfully'
            ], 200);
        }
    }
}
