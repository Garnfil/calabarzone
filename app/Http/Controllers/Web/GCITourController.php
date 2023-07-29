<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\GCITour;
use App\Models\Province;

use DataTables;

class GCITourController extends Controller
{
    public function list(Request $request) {
        if($request->ajax()) {
            $data = GCITour::latest()->with('province');
            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('province', function($row) {
                        return $row->province->name;
                    })
                    ->addColumn('actions', function($row) {
                        $btn = '<a href="/admin/attraction/edit/' . $row->id . '" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                                <button id="' . $row->id . '" class="btn btn-danger remove-btn"><i class="fa fa-trash"></i></button>';
                        return $btn;
                    })
                    ->rawColumns(['province', 'actions'])
                    ->make(true);
        }

        return view('admin-page.gci_tours.list');
    }

    public function create(Request $request) {
        $provinces = Province::get();
        return view('admin-page.gci_tours.create', compact('provinces'));
    }

    public function store(Request $request) {

    }

    public function edit(Request $request) {

    }

    public function update(Request $request) {

    }
}
