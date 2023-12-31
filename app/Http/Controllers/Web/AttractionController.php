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
            $data = Attraction::latest()->with('province', 'city_municipality');
            return DataTables::of($data)
                    ->addIndexColumn()
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
                    ->rawColumns(['actions', 'is_featured'])
                    ->make(true);
        }

        return view('admin-page.attractions.list');
    }

    public function create(Request $request) {
        $provinces = Province::orderBy('order_id', 'asc')->get();
        $interests = Interest::get();
        return view('admin-page.attractions.create', compact('provinces', 'interests'));
    }

    public function store(CreateAttractionRequest $request) {
        $data = $request->validated();

        if($request->hasFile('featured_image')) {
            $featured_image = $request->file('featured_image');
            $file_name = Str::snake(Str::lower($request->attraction_name));
            $featured_image_name = $file_name . '.' . $featured_image->getClientOriginalExtension();
            $save_file = $featured_image->move(public_path() . '/app-assets/images/attractions', $featured_image_name);
        } else {
            $featured_image_name = null;
        }

        $images = [];

        if($request->has('attraction_images')) {
            foreach ($request->attraction_images as $key => $attraction_image) {
                $attraction_background_name = null;
                $attraction_image_file = $attraction_image;
                if(isset($attraction_image_file)) {
                    $attraction_background_name = Str::snake(Str::lower($request->attraction_name)) . '_' . $key . '.' . $attraction_image_file->getClientOriginalExtension();
                    $save_file = $attraction_image_file->move(public_path() . '/app-assets/images/attractions_images', $attraction_background_name);
                }
                array_push($images, $attraction_background_name);
            }
        }

        $create = Attraction::create(array_merge($data, [
            'featured_image' => $featured_image_name,
            'images' => json_encode($images),
            'is_active' => $request->has('is_active'),
            'is_featured' => $request->has('is_featured')
        ]));

        if($create) return redirect()->route('admin.attractions')->withSuccess('Attraction Created Successfully');
    }

    public function edit(Request $request) {
        $attraction = Attraction::where('id', $request->id)->firstOrFail();
        $provinces = Province::orderBy('order_id', 'asc')->get();
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

        $images = json_decode($attraction->images);

        if($request->has('attraction_images')) {

            if($images == null || $images == '') {
                $images = [];
                $count = 0;
            } else {
                $count = count($images);
            }

            foreach ($request->attraction_images as $key => $attraction_image) {
                $attraction_background_name = null;
                $attraction_image_file = $attraction_image;
                if(isset($attraction_image_file)) {
                    $attraction_background_name = Str::snake(Str::lower($request->attraction_name)) . '_' . $count . '.' . $attraction_image_file->getClientOriginalExtension();
                    $save_file = $attraction_image_file->move(public_path() . '/app-assets/images/attractions_images', $attraction_background_name);
                }

                if(is_array($images)) {
                    array_push($images, $attraction_background_name);
                }

                $count++;
            }
        }

        $update = $attraction->update(array_merge($data, [
                'featured_image' => $featured_image_name,
                'images' => json_encode($images),
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

        $attraction_images = json_decode($attraction->images);

        if($attraction_images || is_array($attraction_images)) {
            foreach ($attraction_images as $key => $attraction_image) {
                $old_upload_image = public_path('/app-assets/images/attractions_images/') . $attraction_image;
                $remove_image = @unlink($old_upload_image);
            }
        }

        $delete = $attraction->delete();

        if($delete) {
            return response([
                'status' => true,
                'message' => 'Deleted Successfully'
            ], 200);
        }
    }

    public function destroyImage(Request $request) {
        $attraction = Attraction::where('id', $request->id)->first();

        $images = json_decode($attraction->images);
        $image_path = $request->image_path;

        if(is_array($images)) {
            if (($key = array_search($image_path, $images)) !== false) {
                unset($images[$key]);
                $old_upload_image = public_path('/app-assets/images/attractions_images/') . $image_path;
                $remove_image = @unlink($old_upload_image);
            }
        }

        $attraction->update([
            'images' => json_encode(array_values($images))
        ]);

        return back()->with('success', 'Remove Image Successfully');
    }
}
