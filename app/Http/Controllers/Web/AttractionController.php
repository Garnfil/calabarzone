<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Models\Attraction;
use App\Models\Province;
use App\Models\Interest;

use App\Http\Requests\Attraction\CreateAttractionRequest;
use App\Http\Requests\Attraction\UpdateAttractionRequest;
use DataTables;

class AttractionController extends Controller
{
    public function list(Request $request) {
        if($request->ajax()) {
            $data = Attraction::latest()->where('is_active', 1)->with('province', 'city_municipality');
            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('featured_image', function ($row) {
                        $featured_image = "../app-assets/images/attractions/" . $row->featured_image;
                        return '<img src="' . $featured_image . '" style="width: 75px;" />';
                    })
                    ->addColumn('province', function($row) {
                        return optional($row->province)->name;
                    })
                    ->addColumn('city_municipality', function($row) {
                        return optional($row->city_municipality)->name;
                    })
                    ->addColumn('is_featured', function($row) {
                       if($row->is_featured) {
                            return '<div class="badge badge-primary p-50">Yes</div>';
                       } else {
                            return '<div class="badge badge-warning p-50">No</div>';
                       }
                    })
                    ->addColumn('actions', function($row) {
                        $btn = '<a href="/admin/attraction/edit/' . $row->id . '" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                                <button id="' . $row->id . '" class="btn btn-danger remove-btn"><i class="fa fa-trash"></i></button>';
                        return $btn;
                    })
                    ->rawColumns(['featured_image', 'actions', 'is_featured'])
                    ->make(true);
        }

        return view('admin-page.attractions.list');
    }

    public function create(Request $request) {
        $provinces = Province::get();
        $interests = Interest::get();
        return view('admin-page.attractions.create', compact('provinces', 'interests'));
    }

    public function store(CreateAttractionRequest $request) {
        $data = $request->validated();

        $featured_image = $request->file('featured_image');
        $file_name = Str::snake(Str::lower($request->attraction_name));
        $featured_image_name = $file_name . '.' . $featured_image->getClientOriginalExtension();
        $save_file = $featured_image->move(public_path() . '/app-assets/images/attractions', $featured_image_name);

        $create = Attraction::create(array_merge($data, [
            'featured_image' => $featured_image_name,
            'is_active' => $request->has('is_active'),
            'is_featured' => $request->has('is_featured')
        ]));

        if($create) return redirect()->route('admin.attractions')->withSuccess('Attraction Created Successfully');
    }

    public function edit(Request $request) {
        $attraction = Attraction::where('id', $request->id)->firstOrFail();
        $provinces = Province::get();
        $interests = Interest::get();
        return view('admin-page.attractions.edit', compact('attraction', 'provinces', 'interests'));
    }

    public function update(UpdateAttractionRequest $request) {
        $data = $request->validated();
        $attraction = Attraction::where('id', $request->id)->firstOrFail();
        $featured_image_name = $request->old_image;

        if($request->hasFile('featured_image')) {
            $old_upload_image = public_path('/app-assets/images/attractions/') . $request->old_image;
            $remove_image = @unlink($old_upload_image);

            $featured_image = $request->file('featured_image');
            $featured_image_name = Str::snake($request->attraction_name) . '.' . $featured_image->getClientOriginalExtension();

            $save_file = $featured_image->move(public_path() . '/app-assets/images/attractions', $featured_image_name);
        }

        $update = $attraction->update(array_merge($data, [
                'featured_image' => $featured_image_name,
                'is_active' => $request->has('is_active'),
                'is_featured' => $request->has('is_featured')
            ]));

        if($update) return back()->withSuccess('Attraction Updated Successfully');
    }

    public function destroy(Request $request) {
        $id = $request->id;
        $attraction = Attraction::where('id', $request->id)->firstOrFail();

        $old_upload_image = public_path('/app-assets/images/attractions/') . $attraction->featured_image;
        $remove_image = @unlink($old_upload_image);

        $delete = $attraction->delete();

        if($delete) {
            return response([
                'status' => true,
                'message' => 'Deleted Successfully'
            ], 200);
        }
    }
}
