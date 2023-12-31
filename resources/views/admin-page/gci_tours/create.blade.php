@extends('layouts.admin-layout')

@section('title', 'Create Tour')

@section('content')
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center border-bottom">
                        <h2 class="card-title">Create Tour</h2>
                        <a href="{{ route('admin.gci_tours') }}" class="btn btn-primary">Back to List</a>
                    </div>
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form action="{{ route('admin.gci_tour.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-lg-6 my-1">
                                    <label for="tour_name" class="form-label">Tour Name</label>
                                    <input type="text" class="form-control" name="tour_name" id="tour_name"
                                        value="{{ old('tour_name') }}">
                                </div>
                                <div class="col-lg-6 my-1">
                                    <label for="province" class="form-label">Province</label>
                                    <select name="province" id="province" class="form-control select2">
                                        <option value="">--- SELECT PROVINCE ---</option>
                                        @foreach ($provinces as $province)
                                            <option {{ old('province') == $province->id ? 'selected' : null }}
                                                value="{{ $province->id }}">{{ $province->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-lg-6 my-1">
                                    <label for="what_to_wear" class="form-label">What to wear</label>
                                    <input type="text" class="form-control" name="what_to_wear" id="what_to_wear">
                                </div>
                                <div class="col-lg-6 my-1">
                                    <label for="best_time" class="form-label">Best Time</label>
                                    <input type="text" class="form-control" name="best_time" id="best_time">
                                </div>
                                <div class="col-lg-6 my-1">
                                    <label for="tour_details" class="form-label">Tour Details</label>
                                    <textarea type="text" class="form-control" rows="5" name="tour_details" id="tour_details"></textarea>
                                </div>
                                <div class="col-lg-6 my-1">
                                    <label for="tour_duration" class="form-label">Tour Duration</label>
                                    <input type="text" class="form-control" name="tour_duration" id="tour_duration"> <br>
                                    <label for="youtube" class="form-label">Youtube</label>
                                    <input type="url" class="form-control" name="youtube" id="youtube">
                                </div>
                                <div class="col-lg-6 my-1">
                                    <label for="inclusions" class="form-label">Inclusions</label>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <fieldset>
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" name="inclusions[]"
                                                        value="accommodation" id="inclusions1">
                                                    <label class="custom-control-label"
                                                        for="inclusions1">ACCOMMODATION</label>
                                                </div>
                                            </fieldset>
                                            <fieldset>
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" name="inclusions[]"
                                                        value="meals" id="inclusions2">
                                                    <label class="custom-control-label" for="inclusions2">MEALS</label>
                                                </div>
                                            </fieldset>
                                            <fieldset>
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" name="inclusions[]"
                                                        value="entrance_fees" id="inclusions3">
                                                    <label class="custom-control-label" for="inclusions3">ENTRANCE
                                                        FEES</label>
                                                </div>
                                            </fieldset>
                                            <fieldset>
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" name="inclusions[]"
                                                        value="transportation" id="inclusions4">
                                                    <label class="custom-control-label"
                                                        for="inclusions4">TRANSPORTATION</label>
                                                </div>
                                            </fieldset>
                                            <fieldset>
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" name="inclusions[]"
                                                        value="gasoline" id="inclusions5">
                                                    <label class="custom-control-label" for="inclusions5">GASOLINE</label>
                                                </div>
                                            </fieldset>
                                            <fieldset>
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input"
                                                        name="inclusions[]" value="toll_fees" id="inclusions6">
                                                    <label class="custom-control-label" for="inclusions6">TOLL
                                                        FEES</label>
                                                </div>
                                            </fieldset>
                                        </div>
                                        <div class="col-lg-6">
                                            <fieldset>
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input"
                                                        name="inclusions[]" value="driver_fee" id="inclusions7">
                                                    <label class="custom-control-label" for="inclusions7">DRIVER'S
                                                        FEE</label>
                                                </div>
                                            </fieldset>
                                            <fieldset>
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input"
                                                        name="inclusions[]" value="tour_guide" id="inclusions8">
                                                    <label class="custom-control-label" for="inclusions8">TOUR
                                                        GUIDE</label>
                                                </div>
                                            </fieldset>
                                            <fieldset>
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input"
                                                        name="inclusions[]" value="environmental_fees" id="inclusions9">
                                                    <label class="custom-control-label" for="inclusions9">ENVIRONMENTAL
                                                        FEES</label>
                                                </div>
                                            </fieldset>
                                            <fieldset>
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input"
                                                        name="inclusions[]" value="bottled_water" id="inclusions10">
                                                    <label class="custom-control-label" for="inclusions10">BOTTLED
                                                        WATER</label>
                                                </div>
                                            </fieldset>
                                            <fieldset>
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input"
                                                        name="inclusions[]" value="travel_kit" id="inclusions2">
                                                    <label class="custom-control-label" for="inclusions2">SAFE TRAVEL
                                                        KIT</label>
                                                </div>
                                            </fieldset>
                                            <fieldset>
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input"
                                                        name="inclusions[]" value="insurance" id="inclusions11">
                                                    <label class="custom-control-label"
                                                        for="inclusions11">INSURANCE</label>
                                                </div>
                                            </fieldset>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 my-1">
                                    <div class="row">
                                        <div class="col-lg-8">
                                            <label for="tour_cover" class="form-label">Tour Cover</label>
                                            <input type="file" class="form-control" name="tour_cover"
                                                id="tour_cover" value="">
                                        </div>
                                        <div class="col-lg-4">
                                                <img src="{{ URL::asset('app-assets/images/default-image.jpg')}}" alt="default" style="width: 100%;" id="previewImage">
                                        </div>
                                    </div>
                                </div>
                                {{-- <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="Tour Type" class="form-label">Tour Type</label>
                                        <select name="" id="" class="select2 form-control"></select>
                                    </div>
                                </div> --}}
                                <div class="col-lg-6 my-1">
                                    <label for="flyers" class="form-label">Flyers</label>
                                    <input type="file" class="form-control" id="flyers" name="flyers">
                                </div>
                            </div>
                            <hr>
                            <div class="repeater-default">
                                <div data-repeater-list="tour_cities">
                                    <div data-repeater-item>
                                        <div class="row">
                                            <div class="form-group mb-1 col-sm-12 col-md-3">
                                                <label for="city">City</label>
                                                <br>
                                                <input type="text" class="form-control" id="city"
                                                    name="city">
                                            </div>
                                            <div class="form-group mb-1 col-sm-12 col-md-3">
                                                <label for="tour_details">Tour Details</label>
                                                <br>
                                                <textarea class="form-control" id="tour_details" rows="2" name="tour_details"></textarea>
                                            </div>
                                            <div class="form-group mb-1 col-sm-12 col-md-3">
                                                <label for="background_image" class="cursor-pointer">Background
                                                    Image</label>
                                                <br>
                                                <input type="file" name="background_image" class="form-control"
                                                    id="background_image">
                                            </div>
                                            <div class="form-group col-sm-12 col-md-3 text-center mt-2">
                                                <button type="button" class="btn btn-danger" data-repeater-delete> <i
                                                        class="feather icon-x"></i> Delete</button>
                                            </div>
                                        </div>
                                        <hr>
                                    </div>
                                </div>
                                <div class="form-group overflow-hidden">
                                    <div class="col-12">
                                        <button type="button" data-repeater-create class="btn btn-primary btn-lg">
                                            <i class="icon-plus4"></i> Add
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="form-footer py-2 border-top d-flex align-items-center" style="gap: 25px;">
                                <div class="my-1">
                                    <label for="mobile_number" class="form-label">Is Featured?</label>
                                    <fieldset>
                                        <div class="float-left">
                                            <input type="checkbox" class="switch" id="is_featured" name="is_featured"
                                                data-group-cls="btn-group-sm" />
                                        </div>
                                    </fieldset>
                                </div>
                                <button class="btn btn-success">Save Tour</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
