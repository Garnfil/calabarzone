<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Models\Activity;
use App\Models\Province;
use App\Models\Interest;

use App\Http\Requests\Activity\CreateActivityRequest;
use App\Http\Requests\Activity\UpdateActivityRequest;

use DataTables;

class ActivityController extends Controller
{
    public function list(Request $request) {
        if($request->ajax()) {
            $data = Activity::latest()->with('province', 'city_municipality');
            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('province', function($row) {
                        return optional($row->province)->name;
                    })
                    ->addColumn('city_municipality', function($row) {
                        return optional($row->city_municipality)->name;
                    })
                    ->addColumn('actions', function($row) {
                        $btn = '<a href="/admin/activity/edit/' . $row->id . '" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                                <button id="' . $row->id . '" class="btn btn-danger remove-btn"><i class="fa fa-trash"></i></button>';
                        return $btn;
                    })
                    ->rawColumns(['actions'])
                    ->make(true);
        }

        return view('admin-page.activities.list');
    }

    public function create(Request $request) {
        $provinces = Province::orderBy('order_id', 'asc')->get();
        $interests = Interest::get();
        return view('admin-page.activities.create', compact('provinces', 'interests'));
    }

    public function store(CreateActivityRequest $request) {
        $data = $request->validated();

        if($request->hasFile('featured_image')) {
            $featured_image = $request->file('featured_image');
            $file_name = Str::snake(Str::lower($request->activity_name));
            $featured_image_name = $file_name . '.' . $featured_image->getClientOriginalExtension();
            $save_file = $featured_image->move(public_path() . '/app-assets/images/activities', $featured_image_name);
        } else {
            $featured_image_name = null;
        }

        $images = [];

        if($request->has('activity_images')) {
            foreach ($request->activity_images as $key => $activity_image) {
                $activity_background_name = null;
                $activity_image_file = $activity_image;
                if(isset($activity_image_file)) {
                    $activity_background_name = Str::snake(Str::lower($request->activity_name)) . '_' . $key . '.' . $activity_image_file->getClientOriginalExtension();
                    $save_file = $activity_image_file->move(public_path() . '/app-assets/images/activities_images', $activity_background_name);
                }
                array_push($images, $activity_background_name);
            }
        }

        $create = Activity::create(array_merge($data, [
            'images' => json_encode($images),
            'featured_image' => $featured_image_name,
        ]));

        if($create) return redirect()->route('admin.activities')->with('success', 'Activity Created Successfully');
    }

    public function edit(Request $request) {
        $activity = Activity::where('id', $request->id)->firstOrFail();
        $provinces = Province::orderBy('order_id', 'asc')->get();
        $interests = Interest::get();

        return view("admin-page.activities.edit", compact('activity', 'provinces', 'interests'));
    }

    public function update(UpdateActivityRequest $request) {
        $data = $request->validated();
        $activity = Activity::where('id', $request->id)->firstOrFail();
        $featured_image_name = $request->old_image;

        if($request->hasFile('featured_image')) {
            $old_upload_image = public_path('/app-assets/images/activities/') . $request->old_image;
            $remove_image = @unlink($old_upload_image);

            $featured_image = $request->file('featured_image');
            $featured_image_name = Str::snake(Str::lower($request->activity_name)) . '.' . $featured_image->getClientOriginalExtension();

            $save_file = $featured_image->move(public_path() . '/app-assets/images/activities', $featured_image_name);
        }

        $images = json_decode($activity->images);

        if($request->has('activity_images')) {

            if($images == null || $images == '') {
                $images = [];
                $count = 0;
            } else {
                $count = count($images);
            }

            foreach ($request->activity_images as $key => $activity_image) {
                $activity_background_name = null;
                $activity_image_file = $activity_image;
                if(isset($activity_image_file)) {
                    $activity_background_name = Str::snake(Str::lower($request->activity_name)) . '_' . $count . '.' . $activity_image_file->getClientOriginalExtension();
                    $save_file = $activity_image_file->move(public_path() . '/app-assets/images/activities_images', $activity_background_name);
                }

                if(is_array($images)) {
                    array_push($images, $activity_background_name);
                }
                $count++;
            }
        }

        $update = $activity->update(array_merge($data, [
            'images' => json_encode($images),
            'featured_image' => $featured_image_name
        ]));

        if($update) return back()->with('success', 'Activity Updated Successfully');
    }

    public function destroy(Request $request) {
        $id = $request->id;
        $activity = Activity::where('id', $request->id)->firstOrFail();

        $old_upload_image = public_path('/app-assets/images/activities/') . $activity->featured_image;
        $remove_image = @unlink($old_upload_image);

        $activity_images = json_decode($activity->images);

        if($activity_images || is_array($activity_images)) {
            foreach ($activity_images as $key => $activity_image) {
                $old_upload_image = public_path('/app-assets/images/activities_images/') . $activity_image;
                $remove_image = @unlink($old_upload_image);
            }
        }

        $delete = $activity->delete();

        if($delete) {
            return response([
                'status' => true,
                'message' => 'Deleted Successfully'
            ], 200);
        }
    }

    public function destroyImage(Request $request) {
        $activity = Activity::where('id', $request->id)->first();

        $images = json_decode($activity->images);
        $image_path = $request->image_path;

        if(is_array($images)) {
            if (($key = array_search($image_path, $images)) !== false) {
                unset($images[$key]);
                $old_upload_image = public_path('/app-assets/images/activities_images/') . $image_path;
                $remove_image = @unlink($old_upload_image);
            }
        }

        $activity->update([
            'images' => json_encode(array_values($images))
        ]);

        return back()->with('success', 'Remove Image Successfully');
    }
}
