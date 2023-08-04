@extends('layouts.admin-layout')

@section('title', 'Change Password')

@section('content')
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body">
            <div class="container">
                <div class="container">
                    <div class="container">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center border-bottom">
                                <h2 class="card-title">Change Password</h2>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('admin.save_change_password') }}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-lg-4 my-1">
                                            <label for="old_password" class="form-label">Old Password</label>
                                            <input type="password" class="form-control" name="old_password" id="old_password">
                                        </div>
                                        <div class="col-lg-4 my-1">
                                            <label for="new_password" class="form-label">New Password</label>
                                            <input type="password" class="form-control" name="new_password" id="new_password">
                                        </div>
                                        <div class="col-lg-4 my-1">
                                            <label for="confirm_password" class="form-label">Confirm Password</label>
                                            <input type="password" class="form-control" name="confirm_password" id="confirm_password">
                                        </div>
                                    </div>
                                    <div class="form-footer text-right">
                                        <button class="btn btn-success">Save Password</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
