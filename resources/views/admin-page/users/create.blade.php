@extends('layouts.admin-layout')

@section('title', 'Create User')

@section('content')
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center border-bottom">
                        <h3 class="card-title">Create User</h3>
                        <a href="{{ route('admin.users') }}" class="btn btn-primary">Back to List</a>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.user.store')}}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="row">
                                        <div class="col-lg-4 my-1">
                                            <label for="username" class="my-1">Username</label>
                                            <input type="text" class="form-control" id="username" name="username">
                                        </div>
                                        <div class="col-lg-4 my-1">
                                            <label for="email" class="my-1">Email</label>
                                            <input type="email" class="form-control" id="email" name="email">
                                        </div>
                                        <div class="col-lg-4 my-1">
                                            <label for="password" class="my-1">Password</label>
                                            <input type="password" class="form-control" id="password" name="password">
                                        </div>
                                        <div class="col-lg-4 my-1">
                                            <label for="firstname" class="my-1">Firstname</label>
                                            <input type="text" class="form-control" id="firstname" name="firstname">
                                        </div>
                                        <div class="col-lg-4 my-1">
                                            <label for="lastname" class="my-1">Lastname</label>
                                            <input type="text" class="form-control" id="lastname" name="lastname">
                                        </div>
                                        <div class="col-lg-4 my-1">
                                            <label for="interests" class="my-1">Interests</label>
                                            <select name="interests[]" id="interests" class="select2 form-control" multiple="multiple">
                                                @foreach ($interests as $interest)
                                                    <option value="{{ $interest->id }}">{{ $interest->interest_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-xxl-3 col-xl-3">
                                            <label for="lastname" class="my-1">Is Verify <br> <span style="font-size: 12px;" class="warning">( If you choice is Yes, then it
                                                    will not send to the user registered email with verification )</span></label>
                                            <fieldset>
                                                <div class="float-left">
                                                    <input type="checkbox" class="switch" id="is_verify" name="is_verify"
                                                        data-group-cls="btn-group-sm" />
                                                </div>
                                            </fieldset>
                                        </div>
                                        <div class="col-xxl-1 col-xl-2">
                                            <label for="lastname" class="my-1">Is Active</label>
                                            <fieldset>
                                                <div class="float-left">
                                                    <input type="checkbox" checked class="switch" id="is_active" name="is_active"
                                                        data-group-cls="btn-group-sm" />
                                                </div>
                                            </fieldset>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="footer-btn py-2 my-2 border-top">
                                <button class="btn btn-success">Save User</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
