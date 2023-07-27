@extends('layouts.admin-layout')

@section('title', 'Edit Admin')

@section('content')
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center border-bottom">
                        <h3 class="card-title">Edit Admins</h3>
                        <a href="{{ route('admin.admins') }}" class="btn btn-primary">Back to List</a>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.admin.update', $admin->id) }}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="row">
                                        <div class="col-md-6 my-1">
                                            <label for="username" class="form-label">Username</label>
                                            <input type="text" class="form-control" name="username" id="username"
                                                value="{{ $admin->username }}">
                                            <span class="text-danger danger">
                                                @error('username')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>
                                        <div class="col-md-6 my-1">
                                            <label for="email" class="form-label">Email <span class="warning"
                                                    style="font-size: 10px">
                                                    (You can't change the email)</span></label>
                                            <input type="email" class="form-control" name="email" id="email"
                                                value="{{ $admin->email }}" disabled>
                                            <span class="text-danger danger">
                                                @error('email')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>
                                        <div class="col-md-6 my-1">
                                            <label for="password" class="form-label">Password <span class="warning"
                                                    style="font-size: 10px">
                                                    (You can't change the password)</span></label>
                                            <input type="password" class="form-control" name="password" id="password"
                                                value="{{ $admin->password }}" disabled>
                                            <span class="text-danger danger">
                                                @error('password')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>
                                        <div class="col-md-6 my-1">
                                            <label for="name" class="form-label">Name</label>
                                            <input type="text" class="form-control" name="name" id="name"
                                                value="{{ $admin->name }}">
                                            <span class="text-danger danger">
                                                @error('name')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-footer py-2 border-top">
                                <button class="btn btn-success">Save Admin</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
