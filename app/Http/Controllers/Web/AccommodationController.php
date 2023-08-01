<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Models\Accommodation;
use App\Models\Province;
use App\Models\Interest;

use DataTables;
use App\Http\Requests\Accommodation\CreateAccommodationRequest;
use App\Http\Requests\Accommodation\UpdateAccommodationRequest;

class AccommodationController extends Controller
{
    public function list(Request $request) {
        if($request->ajax()) {
            $data = Accommodation::where('is_active', 1)->latest()->with('province', 'city_municipality');
            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('featured_image', function ($row) {
                        $featured_image = "../app-assets/images/accommodations/" . $row->featured_image;
                        return '<img src="' . $featured_image . '" style="width: 75px;" />';
                    })
                    ->addColumn('province', function($row) {
                        return $row->province->name;
                    })
                    ->addColumn(' ', function($row) {
                        return $row->city_municipality->name;
                    })
                    ->addColumn('actions', function($row) {
                        $btn = '<a href="/admin/accommodation/edit/' . $row->id . '" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                                <button id="' . $row->id . '" class="btn btn-danger remove-btn"><i class="fa fa-trash"></i></button>';
                        return $btn;
                    })
                    ->rawColumns(['featured_image', 'actions'])
                    ->make(true);
        }

        return view('admin-page.accommodations.list');
    }

    public function create(Request $request) {
        $provinces = Province::get();
        $interests = Interest::get();
        return view('admin-page.accommodations.create', compact('provinces', 'interests'));
    }

    public function store(CreateAccommodationRequest $request) {
        $data = $request->validated();

        $featured_image = $request->file('featured_image');
        $file_name = Str::snake(Str::lower($request->business_name));
        $featured_image_name = $file_name . '.' . $featured_image->getClientOriginalExtension();
        $save_file = $featured_image->move(public_path() . '/app-assets/images/accommodations', $featured_image_name);

        $create = Accommodation::create(array_merge($data, [
            'featured_image' => $featured_image_name,
            'is_active' => $request->has('is_active')
        ]));

        if($create) return redirect()->route('admin.accommodations')->with('success', 'Accommodation Created Successfully');
    }

    public function edit(Request $request) {
        $accommodation = Accommodation::where('id', $request->id)->firstOrFail();
        $provinces = Province::get();
        $interests = Interest::get();
        return view('admin-page.accommodations.edit', compact('accommodation', 'provinces', 'interests'));
    }

    public function update(UpdateAccommodationRequest $request) {
        $data = $request->validated();
        $accommodation = Accommodation::where('id', $request->id)->firstOrFail();
        $featured_image_name = $request->old_image;

        if($request->hasFile('featured_image')) {
            $old_upload_image = public_path('/app-assets/images/accommodation') . $request->old_image;
            $remove_image = @unlink($old_upload_image);

            $featured_image = $request->file('featured_image');
            $featured_image_name = Str::snake($request->business_name) . '.' . $featured_image->getClientOriginalExtension();

            $save_file = $featured_image->move(public_path() . '/app-assets/images/accommodation', $featured_image_name);
        }

        $update = $accommodation->update(array_merge($data, [
            'featured_image' => $featured_image_name,
            'is_active' => $request->has('is_active')
        ]));

        if($update) return back()->with('success', 'Accommodation Updated Successfully');
    }

    public function destroy(Request $request) {
        $id = $request->id;
        $accommodation = Accommodation::where('id', $request->id)->firstOrFail();

        $old_upload_image = public_path('/app-assets/images/accommodations/') . $accommodation->featured_image;
        $remove_image = @unlink($old_upload_image);

        $delete = $accommodation->delete();

        if($delete) {
            return response([
                'status' => true,
                'message' => 'Deleted Successfully'
            ], 200);
        }
    }
}
