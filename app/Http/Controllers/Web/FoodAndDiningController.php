<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Models\FoodAndDining;
use App\Models\Province;
use App\Models\Interest;

use App\Http\Requests\FoodAndDining\CreateFoodAndDiningRequest;
use App\Http\Requests\FoodAndDining\UpdateFoodAndDiningRequest;

use DataTables;

class FoodAndDiningController extends Controller
{
    public function list(Request $request) {
        if($request->ajax()) {
            $data = FoodAndDining::latest()->with('province', 'city_municipality');
            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('province', function($row) {
                        return optional($row->province)->name;
                    })
                    ->addColumn('city_municipality', function($row) {
                        return optional($row->city_municipality)->name;
                    })
                    ->addColumn('actions', function($row) {
                        $btn = '<a href="/admin/food_dining/edit/' . $row->id . '" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                                <button id="' . $row->id . '" class="btn btn-danger remove-btn"><i class="fa fa-trash"></i></button>';
                        return $btn;
                    })
                    ->rawColumns(['actions'])
                    ->make(true);
        }

        return view('admin-page.food_dinings.list');
    }

    public function create(Request $request) {
        $provinces = Province::orderBy('order_id', 'asc')->get();
        $interests = Interest::get();
        return view('admin-page.food_dinings.create', compact('provinces', 'interests'));
    }

    public function store(CreateFoodAndDiningRequest $request) {
        $data = $request->validated();

        if($request->hasFile('featured_image')) {
            $featured_image = $request->file('featured_image');
            $file_name = Str::snake(Str::lower($request->business_name));
            $featured_image_name = $file_name . '.' . $featured_image->getClientOriginalExtension();
            $save_file = $featured_image->move(public_path() . '/app-assets/images/food_dinings', $featured_image_name);
        } else {
            $featured_image_name = null;
        }


        $images = [];

        if($request->has('food_and_dinings_images')) {
            foreach ($request->food_and_dinings_images as $key => $food_and_dinings_image) {
                $food_and_dinings_background_name = null;
                $food_and_dinings_image_file = $food_and_dinings_image;
                if(isset($food_and_dinings_image_file)) {
                    $food_and_dinings_background_name = Str::snake(Str::lower($request->business_name)) . '_' . $key . '.' . $food_and_dinings_image_file->getClientOriginalExtension();
                    $save_file = $food_and_dinings_image_file->move(public_path() . '/app-assets/images/food_and_dinings_images', $food_and_dinings_background_name);
                }
                array_push($images, $food_and_dinings_background_name);
            }
        }

        $create = FoodAndDining::create(array_merge($data, [
            'images' => json_encode($images),
            'featured_image' => $featured_image_name,
        ]));

        if($create) return redirect()->route('admin.food_dinings')->with('success', 'Food & Dinings Created Successfully');
    }

    public function edit(Request $request) {
        $food_dining = FoodAndDining::find($request->id);
        $provinces = Province::orderBy('order_id', 'asc')->get();
        $interests = Interest::get();

        return view('admin-page.food_dinings.edit', compact('food_dining', 'provinces', 'interests'));
    }

    public function update(UpdateFoodAndDiningRequest $request) {
        $data = $request->validated();
        $food_dining = FoodAndDining::where('id', $request->id)->firstOrFail();
        $featured_image_name = $request->old_image;

        if($request->hasFile('featured_image')) {
            $old_upload_image = public_path('/app-assets/images/food_dinings') . $request->old_image;
            $remove_image = @unlink($old_upload_image);

            $featured_image = $request->file('featured_image');
            $featured_image_name = Str::snake($request->business_name) . '.' . $featured_image->getClientOriginalExtension();

            $save_file = $featured_image->move(public_path() . '/app-assets/images/food_dinings', $featured_image_name);
        }

        $images = json_decode($food_dining->images);

        if($request->has('food_and_dinings_images')) {

            if($images == null || $images == '') {
                $images = [];
                $count = 0;
            } else {
                $count = count($images);
            }

            foreach ($request->food_and_dinings_images as $key => $food_and_dinings_image) {
                $food_and_dinings_background_name = null;
                $food_and_dinings_image_file = $food_and_dinings_image;
                if(isset($food_and_dinings_image_file)) {
                    $food_and_dinings_background_name = Str::snake(Str::lower($request->business_name)) . '_' . $count . '.' . $food_and_dinings_image_file->getClientOriginalExtension();
                    $save_file = $food_and_dinings_image_file->move(public_path() . '/app-assets/images/food_and_dinings_images', $food_and_dinings_background_name);
                }

                if(is_array($images)) {
                    array_push($images, $food_and_dinings_background_name);
                }

                $count++;
            }
        }

        $update = $food_dining->update(array_merge($data, [
            'images' => json_encode($images),
            'featured_image' => $featured_image_name
        ]));

        if($update) return back()->with('success', 'Accommodation Updated Successfully');
    }

    public function destroy(Request $request) {
        $id = $request->id;
        $food_dining = FoodAndDining::where('id', $request->id)->firstOrFail();

        $old_upload_image = public_path('/app-assets/images/food_dinings/') . $food_dining->featured_image;
        $remove_image = @unlink($old_upload_image);

        $food_dining_images = json_decode($food_dining->images);

        if($food_dining_images || is_array($food_dining_images)) {
            foreach ($food_dining_images as $key => $food_dining_image) {
                $old_upload_image = public_path('/app-assets/images/food_and_dinings_images/') . $food_dining_image;
                $remove_image = @unlink($old_upload_image);
            }
        }

        $delete = $food_dining->delete();

        if($delete) {
            return response([
                'status' => true,
                'message' => 'Deleted Successfully'
            ], 200);
        }
    }

    public function destroyImage(Request $request) {
        $food_and_dinings = FoodAndDining::where('id', $request->id)->first();

        $images = json_decode($food_and_dinings->images);
        $image_path = $request->image_path;
        if(is_array($images)) {
            if (($key = array_search($image_path, $images)) !== false) {
                unset($images[$key]);
                $old_upload_image = public_path('/app-assets/images/food_and_dinings_images/') . $image_path;
                $remove_image = @unlink($old_upload_image);
            }
        }

        $food_and_dinings->update([
            'images' => json_encode(array_values($images))
        ]);

        return back()->with('success', 'Remove Image Successfully');
    }
}
