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
                    ->addColumn('featured_image', function($row) {
                        $featured_image = "../app-assets/images/events/" . $row->featured_image;
                        return '<img src="' . $featured_image . '" style="width: 75px;" />';
                    })
                    ->addColumn('province', function($row) {
                        return $row->province->name;
                    })
                    ->addColumn('city_municipality', function($row) {
                        return $row->city_municipality->name;
                    })
                    ->addColumn('actions', function($row) {
                        $btn = '<a href="/admin/event/edit/' . $row->id . '" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                                <button id="' . $row->id . '" class="btn btn-danger"><i class="fa fa-trash"></i></button>';
                        return $btn;
                    })
                    ->rawColumns(['actions', 'featured_image'])
                    ->make(true);
        }

        return view('admin-page.events.list');
    }

    public function create(Request $request) {
        $provinces = Province::get();
        $interests = Interest::get();

        return view('admin-page.events.create', compact('provinces', 'interests'));
    }

    public function store(CreateEventRequest $request) {
        $data = $request->validated();

        $featured_image = $request->file('featured_image');
        $file_name = Str::snake(Str::lower($request->attraction_name));
        $featured_image_name = $file_name . '.' . $featured_image->getClientOriginalExtension();
        $save_file = $featured_image->move(public_path() . '/app-assets/images/events', $featured_image_name);

        $create = Event::create(array_merge($data, [
            'featured_image' => $featured_image_name
        ]));

        if($create) return redirect()->route('admin.events')->withSuccess('Event Created Successfully');
    }

    public function edit(Request $request) {
        $event = Event::where('id', $request->id)->firstOrFail();
        $provinces = Province::get();
        $interests = Interest::get();

        return view('admin-page.events.edit', compact('provinces', 'interests', 'event'));
    }

    public function update(UpdateEventRequest $request) {
        $data = $request->validated();
        $event = Event::where('id', $request->id)->firstOrFail();
        $featured_image_name = $request->old_image;

        if($request->hasFile('featured_image')) {
            $old_upload_image = public_path('/app-assets/images/events') . $request->old_image;
            $remove_image = @unlink($old_upload_image);

            $featured_image = $request->file('featured_image');
            $featured_image_name = Str::snake($request->name) . '.' . $featured_image->getClientOriginalExtension();

            $save_file = $featured_image->move(public_path() . '/app-assets/images/events', $featured_image_name);
        }

        $update = $event->update(array_merge($data, ['featured_image' => $featured_image_name]));

        return back()->withSuccess('Event Created Successfully');
    }
}
