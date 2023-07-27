<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\EmailVerification;

use App\Models\User;
use App\Models\Interest;

use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\UpdateUserRequest;

use DataTables;

class UserController extends Controller
{
    public function list(Request $request) {
        if($request->ajax()) {
            $data = User::latest();
            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('interests', function($row) {
                        $interests = $row->my_interests;
                        $output = '';
                        if (is_array($interests)) {
                            if(count($interests) > 0) {
                                foreach ($interests as $key => $interest) {
                                    $output .= '<div class="badge badge-primary mx-50">' . $interest['interest_name'] . '</div>';
                                }
                                return $output;
                            }
                        }

                        return 'No Interests Found';
                    })
                    ->addColumn('verify_email', function($row) {
                        if($row->is_verify) {
                             return '<div class="badge badge-primary p-50">Yes</div>';
                        } else {
                             return '<div class="badge badge-warning p-50">No</div>';
                        }
                     })
                    ->addColumn('actions', function ($row) {
                        $btn = '<a href="/admin/user/edit/' . $row->id . '" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                                    <button id="' . $row->id . '" class="btn btn-danger"><i class="fa fa-trash"></i></button>';
                        return $btn;
                    })
                    ->rawColumns(['interests', 'actions', 'verify_email'])
                    ->make(true);
        }

        return view('admin-page.users.list');
    }

    public function create(Request $request) {
        $interests = Interest::get();
        return view('admin-page.users.create', compact('interests'));
    }

    public function store(CreateUserRequest $request) {
        $data = $request->validated();

        $user = User::create(array_merge($data, [
            'interests' => json_encode($request->interests),
            'password' => Hash::make($request->password),
            'is_verify' => $request->has('is_verify'),
            'is_active' => $request->has('is_active')
        ]));

        if(!$request->has('is_verify')) {
            # details for sending email to worker
            $details = [
                'title' => 'Verification email from CALABARZONE',
                'email' => $request->email,
                'username' => $request->username,
            ];

            // SEND EMAIL FOR VERIFICATION
            Mail::to($request->email)->send(new EmailVerification($details));
        }

        if($user) return redirect()->route('admin.users')->withSuccess('Create User Successfully.');
    }

    public function edit(Request $request) {
        $interests = Interest::get();
        $user = User::find($request->id);
        return view('admin-page.users.edit', compact('interests', 'user'));
    }

    public function update(UpdateUserRequest $request) {
        $data = $request->validated();

        $user = User::where('id', $request->id)->update(array_merge($data, [
            'interests' => json_encode($request->interests),
            'is_verify' => $request->has('is_verify'),
            'is_active' => $request->has('is_active')
        ]));

        if(!$request->has('is_verify')) {
            # details for sending email to worker
            $details = [
                'title' => 'Verification email from CALABARZONE',
                'email' => $request->email,
                'username' => $request->username,
            ];

            // SEND EMAIL FOR VERIFICATION
            Mail::to($request->email)->send(new EmailVerification($details));
        }

        if($user) return back()->withSuccess('Update User Successfully.');
    }
}
