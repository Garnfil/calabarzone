<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

use App\Models\Admin;

use App\Http\Requests\Admin\CreateAdminRequest;
use DataTables;

class AdminController extends Controller
{
    public function list(Request $request) {
        if($request->ajax()) {
            $data = Admin::latest();
            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('actions', function ($row) {
                        $btn = '<a href="/admin/admin/edit/' . $row->id . '" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                                    <button id="' . $row->id . '" class="btn btn-danger remove-btn"><i class="fa fa-trash"></i></button>';
                        return $btn;
                    })
                    ->rawColumns(['actions'])
                    ->make(true);
        }

        return view("admin-page.admins.list");
    }

    public function create(Request $request) {
        return view('admin-page.admins.create');
    }

    public function store(CreateAdminRequest $request) {
        $data = $request->validated();

        $create = Admin::create(array_merge($data, ['password' => Hash::make($request->password)]));
        if($create) return redirect()->route('admin.admins')->withSuccess('Admin Created Successfully');
    }

    public function edit(Request $request) {
        $admin = Admin::find($request->id);
        return view('admin-page.admins.edit', compact('admin'));
    }

    public function update(Request $request) {
        $admin = Admin::find($request->id);
        $update = $admin->update([
            'username' => $request->username,
            'name' => $request->name
        ]);
        if($update) return back()->withSuccess('Admin Updated Successfully');

    }
}
