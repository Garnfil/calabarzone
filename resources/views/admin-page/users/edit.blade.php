@extends('layouts.admin-layout')

@section('title', 'Edit User')

@section('content')
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center border-bottom">
                        <h3 class="card-title">Edit User</h3>
                        <a href="{{ route('admin.users') }}" class="btn btn-primary">Back to List</a>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.user.update', $user->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="row">
                                        <div class="col-lg-6 my-1">
                                            <label for="username" class="my-1">Username</label>
                                            <input type="text" class="form-control" id="username" name="username"
                                                value="{{ $user->username }}">
                                        </div>
                                        <div class="col-lg-6 my-1">
                                            <label for="email" class="my-1">Email</label>
                                            <input type="email" class="form-control" id="email" name="email"
                                                readonly value="{{ $user->email }}">
                                        </div>
                                        <div class="col-lg-4 my-1">
                                            <label for="firstname" class="my-1">Firstname</label>
                                            <input type="text" class="form-control" id="firstname" name="firstname"
                                                value="{{ $user->firstname }}">
                                        </div>
                                        <div class="col-lg-4 my-1">
                                            <label for="lastname" class="my-1">Lastname</label>
                                            <input type="text" class="form-control" id="lastname" name="lastname"
                                                value="{{ $user->lastname }}">
                                        </div>
                                        <div class="col-lg-4 my-1">
                                            <label for="interests" class="my-1">Interests</label>
                                            <select name="interests[]" id="interests" class="select2 form-control"
                                                multiple="multiple">
                                                @foreach ($interests as $interest)
                                                    @if (json_decode($user->interests))
                                                        <option
                                                            {{ in_array($interest->id, json_decode($user->interests)) ? 'selected' : null }}
                                                            value="{{ $interest->id }}">{{ $interest->interest_name }}
                                                        </option>
                                                    @else
                                                        <option value="{{ $interest->id }}">{{ $interest->interest_name }}
                                                        </option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-xxl-3 col-xl-3">
                                            <label for="lastname" class="my-1">Is Verify <br> <span
                                                    style="font-size: 12px;" class="warning">( If you choice is Yes, then it
                                                    will not send to the user registered email with verification
                                                    )</span></label>
                                            <fieldset>
                                                <div class="float-left">
                                                    <input type="checkbox" class="switch" id="is_verify" name="is_verify"
                                                        {{ $user->is_verify ? 'checked' : null }}
                                                        data-group-cls="btn-group-sm" />
                                                </div>
                                            </fieldset>
                                        </div>
                                        <div class="col-xxl-1 col-xl-2">
                                            <label for="lastname" class="my-1">Is Active</label>
                                            <fieldset>
                                                <div class="float-left">
                                                    <input type="checkbox" checked class="switch" id="is_active"
                                                        name="is_active" {{ $user->is_active ? 'checked' : null }}
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
