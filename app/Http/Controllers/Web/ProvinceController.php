<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Models\Province;

use App\Http\Requests\Province\CreateProvinceRequest;
use App\Http\Requests\Province\UpdateProvinceRequest;

use DataTables;

class ProvinceController extends Controller
{
    public function list(Request $request)
    {
        if ($request->ajax()) {
            $data = Province::latest();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('transportations', function ($row) {
                   $transportations = json_decode($row->transportations);
                   $output = '';
                   foreach ($transportations as $key => $transportation) {
                        $output .= '<div class="badge badge-primary p-50 mx-50">' .$transportation. '</div>';
                   }
                   return $output;
                })
                ->addColumn('actions', function ($row) {
                    $btn = '<a href="/admin/province/edit/' . $row->id . '" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                                <button id="' . $row->id . '" class="btn btn-danger remove-btn"><i class="fa fa-trash"></i></button>';
                    return $btn;
                })
                ->rawColumns(['actions', 'featured_image', 'transportations'])
                ->make(true);
        }
        return view('admin-page.provinces.list');
    }

    public function create(Request $request)
    {
        return view('admin-page.provinces.create');
    }

    public function store(CreateProvinceRequest $request)
    {
        $data = $request->validated();

        $featured_image = $request->file('featured_image');

        $featured_image_name = Str::snake($request->name) . '.' . $featured_image->getClientOriginalExtension();

        $save_file = $featured_image->move(public_path() . '/app-assets/images/provinces', $featured_image_name);

        $create = Province::create(array_merge($data,
                            ['transportations' => json_encode($request->transportations),
                            'featured_image' => $featured_image_name],
                    ));

        if($create) return redirect()->route('admin.provinces')->with('success', 'Province Created Successfully');
    }

    public function edit(Request $request) {
        $province = Province::where("id", $request->id)->firstOrFail();
        return view('admin-page.provinces.edit', compact('province'));
    }

    public function update(UpdateProvinceRequest $request) {
        $data = $request->validated();
        $province = Province::where('id', $request->id)->firstOrFail();
        $featured_image_name = $request->old_image;

        if($request->hasFile('featured_image')) {
            $old_upload_image = public_path('/app-assets/images/provinces/') . $request->old_image;
            $remove_image = @unlink($old_upload_image);

            $featured_image = $request->file('featured_image');
            $featured_image_name = Str::snake($request->name) . '.' . $featured_image->getClientOriginalExtension();

            $save_file = $featured_image->move(public_path() . '/app-assets/images/provinces', $featured_image_name);
        }

        $update = $province->update(array_merge($data,
            ['transportations' => json_encode($request->transportations),
            'featured_image' => $featured_image_name],
        ));

        if($update) return back()->with('success', 'Province Updated Successfully');
    }

    public function destroy(Request $request) {
        $id = $request->id;
        $province = Province::where('id', $request->id)->firstOrFail();

        $old_upload_image = public_path('/app-assets/images/provinces/') . $province->featured_image;
        $remove_image = @unlink($old_upload_image);

        $delete = $province->delete();

        if($delete) {
            return response([
                'status' => true,
                'message' => 'Deleted Successfully'
            ], 200);
        }
    }
}
