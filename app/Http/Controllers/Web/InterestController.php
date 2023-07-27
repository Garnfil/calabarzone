<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Models\Interest;
use DataTables;

use App\Http\Requests\Interests\CreateInterestRequest;
use App\Http\Requests\Interests\UpdateInterestRequest;

class InterestController extends Controller
{
    public function list(Request $request) {
        if($request->ajax()) {
            $data = Interest::latest();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('featured_image', function ($row) {
                        $featured_image = "../app-assets/images/interests/" . $row->featured_image;
                        if($row->featured_image) {
                            return '<img src="' . $featured_image . '" style="width: 75px;" />';
                        } else {
                            return '<img src="../app-assets/images/default-image.jpg" style="width: 75px;" />';
                        }
                    })
                    ->addColumn('icon', function ($row) {
                        $icon = "../app-assets/images/interests_icons/" . $row->icon;
                        return '<img src="' . $icon . '" style="width: 75px;" />';
                    })
                    ->addColumn('actions', function($row) {
                        $btn = '<a href="/admin/interest/edit/' . $row->id . '" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                                <button id="' . $row->id . '" class="btn btn-danger"><i class="fa fa-trash"></i></button>';
                        return $btn;
                    })
                    ->rawColumns(['actions', 'featured_image', 'icon'])
                    ->make(true);
        }

        return view('admin-page.interests.list');
    }

    public function create(Request $request) {
        return view('admin-page.interests.create');
    }

    public function store(CreateInterestRequest $request) {
        $data = $request->validated();

        $featured_image = $request->file('featured_image');

        $featured_image_name = null;
        $featured_icon_name = null;

        if($featured_image) {
            $featured_image_name = Str::snake($request->interest_name) . '.' . $featured_image->getClientOriginalExtension();
            $save_file = $featured_image->move(public_path() . '/app-assets/images/interests', $featured_image_name);
        }

        $featured_icon = $request->file('icon');

        if($featured_icon) {
            $featured_icon_name = Str::snake($request->interest_name) . '_icon' . '.' . $featured_icon->getClientOriginalExtension();
            $save_file = $featured_icon->move(public_path() . '/app-assets/images/interests_icons', $featured_icon_name);
        }

        $create = Interest::create(array_merge($data, [
            'featured_image' => $featured_image_name,
            'icon' => $featured_icon_name
        ]));

        if($create) return redirect()->route('admin.interests')->withSuccess('Interest Created Successfully');
    }

    public function edit(Request $request) {
        $interest = Interest::where('id', $request->id)->firstOrFail();
        return view('admin-page.interests.edit', compact('interest'));
    }

    public function update(UpdateInterestRequest $request) {
        $data = $request->validated();
        $featured_image_name = $request->old_featured_image;
        $featured_icon_name = $request->old_icon_image;

        if($request->hasFile('featured_image')) {
            $old_upload_image = public_path('/app-assets/images/interests') . $request->old_featured_image;
            $remove_image = @unlink($old_upload_image);

            $featured_image = $request->file('featured_image');
            $featured_image_name = Str::snake($request->interest_name) . '.' . $featured_image->getClientOriginalExtension();

            $save_file = $featured_image->move(public_path() . '/app-assets/images/interests', $featured_image_interest_name);
        }

        if($request->hasFile('icon')) {
            $old_upload_image = public_path('/app-assets/images/interests_icons') . $request->old_icon_image;
            $remove_image = @unlink($old_upload_image);

            $icon_image = $request->file('icon');
            $featured_icon_name = Str::snake($request->interest_name) . '.' . $featured_image->getClientOriginalExtension();

            $save_file = $featured_image->move(public_path() . '/app-assets/images/interests_icons', $featured_icon_name);
        }

        $update = Interest::where('id', $request->id)->update(array_merge($data, [
            'featured_image' => $featured_image_name,
            'icon' => $featured_icon_name,
        ]));

        if($update) return back()->withSuccess('Interest Update Successfully');
    }
}
