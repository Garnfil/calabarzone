@extends('layouts.admin-layout')

@section('title', 'Overview')

@section('content')
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body d-flex justify-content-center align-items-center flex-column"
                style="height: 80vh; gap: 40px;">
                <img src="{{ URL::asset('app-assets/images/logo/logo_zone.png') }}" alt="" width="650px">
                <h2 style="font-size: 60px; font-weight: 600; color: #000;">Welcome to
                    <span style="color: #18519f;">CAL</span><span style="color: #acc837;">ABA</span><span style="color: #f18e2a;">RZO</span><span style="color: #e23b30;">NE</span>
                </h2>
            </div>
        </div>
    </div>
@endsection
