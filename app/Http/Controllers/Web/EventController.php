<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Models\Event;
use App\Models\Province;
use App\Models\Interest;

use App\Http\Requests\Event\CreateEventRequest;
use App\Http\Requests\Event\UpdateEventRequest;

use DataTables;

class EventController extends Controller
{
    public function list(Request $request) {
        if($request->ajax()) {
            $data = Event::latest()->with('province', 'city_municipality');
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('province', function($row) {
                        return optional($row->province)->name;
                    })
                    ->addColumn('city_municipality', function($row) {
                        return optional($row->city_municipality)->name;
                    })
                    ->addColumn('actions', function($row) {
                        $btn = '<a href="/admin/event/edit/' . $row->id . '" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                                <button id="' . $row->id . '" class="btn btn-danger remove-btn"><i class="fa fa-trash"></i></button>';
                        return $btn;
                    })
                    ->rawColumns(['actions'])
                    ->make(true);
        }

        return view('admin-page.events.list');
    }

    public function create(Request $request) {
        $provinces = Province::orderBy('order_id', 'asc')->get();
        $interests = Interest::get();

        return view('admin-page.events.create', compact('provinces', 'interests'));
    }

    public function store(CreateEventRequest $request) {
        $data = $request->validated();

        if($request->hasFile('featured_image')) {
            $featured_image = $request->file('featured_image');
            $file_name = Str::snake(Str::lower($request->event_name));
            $featured_image_name = $file_name . '.' . $featured_image->getClientOriginalExtension();
            $save_file = $featured_image->move(public_path() . '/app-assets/images/events', $featured_image_name);
        } else {
            $featured_image_name = null;
        }

        $images = [];

        if($request->has('event_images')) {
            foreach ($request->event_images as $key => $event_image) {
                $event_background_name = null;
                $event_image_file = $event_image;
                if(isset($event_image_file)) {
                    $event_background_name = Str::snake(Str::lower($request->event_name)) . '_' . $key . '.' . $event_image_file->getClientOriginalExtension();
                    $save_file = $event_image_file->move(public_path() . '/app-assets/images/events_images', $event_background_name);
                }
                array_push($images, $event_background_name);
            }
        }

        $create = Event::create(array_merge($data, [
            'featured_image' => $featured_image_name,
            'images' => json_encode($images),
        ]));

        if($create) return redirect()->route('admin.events')->withSuccess('Event Created Successfully');
    }

    public function edit(Request $request) {
        $event = Event::where('id', $request->id)->firstOrFail();
        $provinces = Province::orderBy('order_id', 'asc')->get();
        $interests = Interest::get();

        return view('admin-page.events.edit', compact('provinces', 'interests', 'event'));
    }

    public function update(UpdateEventRequest $request) {
        $data = $request->validated();
        $event = Event::where('id', $request->id)->firstOrFail();
        $featured_image_name = $request->old_image;

        if($request->hasFile('featured_image')) {
            $old_upload_image = public_path('/app-assets/images/events/') . $request->old_image;
            $remove_image = @unlink($old_upload_image);

            $featured_image = $request->file('featured_image');
            $featured_image_name = Str::snake(Str::lower($request->event_name)) . '.' . $featured_image->getClientOriginalExtension();

            $save_file = $featured_image->move(public_path() . '/app-assets/images/events', $featured_image_name);
        }

        $images = json_decode($event->images);

        if($request->has('event_images')) {

            if($images == null || $images == '') {
                $images = [];
                $count = 0;
            } else {
                $count = count($images);
            }

            foreach ($request->event_images as $key => $event_image) {
                $event_background_name = null;
                $event_image_file = $event_image;
                if(isset($event_image_file)) {
                    $event_background_name = Str::snake(Str::lower($request->event_name)) . '_' . $count . '.' . $event_image_file->getClientOriginalExtension();
                    $save_file = $event_image_file->move(public_path() . '/app-assets/images/events_images', $event_background_name);
                }

                if(is_array($images)) {
                    array_push($images, $event_background_name);
                }

                $count++;
            }
        }

        $update = $event->update(array_merge($data, [
                    'featured_image' => $featured_image_name,
                    'images' => json_encode($images),
                ]));

        return back()->withSuccess('Event Created Successfully');
    }

    public function destroy(Request $request) {
        $id = $request->id;
        $event = Event::where('id', $request->id)->firstOrFail();

        $old_upload_image = public_path('/app-assets/images/events/') . $event->featured_image;
        $remove_image = @unlink($old_upload_image);

        $event_images = json_decode($event->images);

        if($event_images || is_array($event_images)) {
            foreach ($event_images as $key => $event_image) {
                $old_upload_image = public_path('/app-assets/images/events_images/') . $event_image;
                $remove_image = @unlink($old_upload_image);
            }
        }

        $delete = $event->delete();

        if($delete) {
            return response([
                'status' => true,
                'message' => 'Deleted Successfully'
            ], 200);
        }
    }

    public function destroyImage(Request $request) {
        $event = Event::where('id', $request->id)->first();

        $images = json_decode($event->images);
        $image_path = $request->image_path;

        if(is_array($images)) {
            if (($key = array_search($image_path, $images)) !== false) {
                unset($images[$key]);
                $old_upload_image = public_path('/app-assets/images/events_images/') . $image_path;
                $remove_image = @unlink($old_upload_image);
            }
        }

        $event->update([
            'images' => json_encode(array_values($images))
        ]);

        return back()->with('success', 'Remove Image Successfully');
    }
}
