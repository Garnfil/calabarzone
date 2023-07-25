<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Province;

use App\Http\Requests\Province\CreateProvinceRequest;
use DataTables;

class ProvinceController extends Controller
{
    public function list(Request $request)
    {
        if ($request->ajax()) {
            $data = Province::latest();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('featured_image', function ($row) {
                    return '<img src="" />';
                })
                ->addColumn('action', function ($row) {
                    $btn =
                        '<a href="/admin/vicariate/edit/' .
                        $row->id .
                        '" class="btn btn-primary btn-sm"><i class="ti ti-edit"></i></a>
                                <a id="' .
                        $row->id .
                        '" class="btn btn-danger btn-sm remove-btn"><i class="ti ti-trash"></i></a>';
                    return $btn;
                })
                ->rawColumns(['action', 'featured_image'])
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
        $create = Province::create(array_merge($data,
                            ['transportations' => json_encode($request->transportations)]
                    ));

        if($create) return redirect()->route('admin.provinces')->with('success', 'Province Created Successfully');
    }
}
