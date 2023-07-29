@extends('layouts.admin-layout')

@section('title', 'Edit Tour')

@section('content')
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center border-bottom">
                        <h2 class="card-title">Edit Tour</h2>
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
                        <form action="{{ route('admin.gci_tour.update', $tour->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-lg-6 my-1">
                                    <label for="tour_name" class="form-label">Tour Name</label>
                                    <input type="text" class="form-control" name="tour_name" id="tour_name"
                                        value="{{ $tour->tour_name }}">
                                </div>
                                <div class="col-lg-6 my-1">
                                    <label for="province" class="form-label">Province</label>
                                    <select name="province" id="province" class="form-control select2">
                                        <option value="">--- SELECT PROVINCE ---</option>
                                        @foreach ($provinces as $province)
                                            <option {{ $tour->province == $province->id ? 'selected' : null }}
                                                value="{{ $province->id }}">{{ $province->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-lg-6 my-1">
                                    <label for="what_to_wear" class="form-label">What to wear</label>
                                    <input type="text" class="form-control" name="what_to_wear" id="what_to_wear"
                                        value="{{ $tour->what_to_wear }}">
                                </div>
                                <div class="col-lg-6 my-1">
                                    <label for="best_time" class="form-label">Best Time</label>
                                    <input type="text" class="form-control" name="best_time" id="best_time"
                                        value="{{ $tour->best_time }}">
                                </div>
                                <div class="col-lg-6 my-1">
                                    <label for="operation_hours" class="form-label">Operation Hours</label>
                                    <input type="text" class="form-control" name="operation_hours" id="operation_hours"
                                        value="{{ $tour->operation_hours }}">
                                </div>
                                <div class="col-lg-6 my-1">
                                    <label for="inclusions" class="form-label">Inclusions</label>
                                    <div class="row">
                                        <?php $inclusions = $tour->inclusions ? json_decode($tour->inclusions) : []; ?>
                                        <div class="col-lg-6">
                                            <fieldset>
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" name="inclusions[]"
                                                        value="accommodation" id="inclusions1"
                                                        {{ in_array('accommodation', $inclusions) ? 'checked' : null }}>
                                                    <label class="custom-control-label"
                                                        for="inclusions1">ACCOMMODATION</label>
                                                </div>
                                            </fieldset>
                                            <fieldset>
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" name="inclusions[]"
                                                        value="meals" id="inclusions2"
                                                        {{ in_array('meals', $inclusions) ? 'checked' : null }}>
                                                    <label class="custom-control-label" for="inclusions2">MEALS</label>
                                                </div>
                                            </fieldset>
                                            <fieldset>
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" name="inclusions[]"
                                                        value="entrance_fees" id="inclusions3"
                                                        {{ in_array('entrance_fees', $inclusions) ? 'checked' : null }}>
                                                    <label class="custom-control-label" for="inclusions3">ENTRANCE
                                                        FEES</label>
                                                </div>
                                            </fieldset>
                                            <fieldset>
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" name="inclusions[]"
                                                        value="transportation" id="inclusions4"
                                                        {{ in_array('transportation', $inclusions) ? 'checked' : null }}>
                                                    <label class="custom-control-label"
                                                        for="inclusions4">TRANSPORTATION</label>
                                                </div>
                                            </fieldset>
                                            <fieldset>
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" name="inclusions[]"
                                                        value="gasoline" id="inclusions5"
                                                        {{ in_array('gasoline', $inclusions) ? 'checked' : null }}>
                                                    <label class="custom-control-label" for="inclusions5">GASOLINE</label>
                                                </div>
                                            </fieldset>
                                            <fieldset>
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input"
                                                        name="inclusions[]" value="toll_fees" id="inclusions6"
                                                        {{ in_array('toll_fees', $inclusions) ? 'checked' : null }}>
                                                    <label class="custom-control-label" for="inclusions6">TOLL
                                                        FEES</label>
                                                </div>
                                            </fieldset>
                                        </div>
                                        <div class="col-lg-6">
                                            <fieldset>
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input"
                                                        name="inclusions[]" value="driver_fee" id="inclusions7"
                                                        {{ in_array('driver_fee', $inclusions) ? 'checked' : null }}>
                                                    <label class="custom-control-label" for="inclusions7">DRIVER'S
                                                        FEE</label>
                                                </div>
                                            </fieldset>
                                            <fieldset>
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input"
                                                        name="inclusions[]" value="tour_guide" id="inclusions8"
                                                        {{ in_array('tour_guide', $inclusions) ? 'checked' : null }}>
                                                    <label class="custom-control-label" for="inclusions8">TOUR
                                                        GUIDE</label>
                                                </div>
                                            </fieldset>
                                            <fieldset>
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input"
                                                        {{ in_array('environmental_fees', $inclusions) ? 'checked' : null }}
                                                        name="inclusions[]" value="environmental_fees" id="inclusions9">
                                                    <label class="custom-control-label" for="inclusions9">ENVIRONMENTAL
                                                        FEES</label>
                                                </div>
                                            </fieldset>
                                            <fieldset>
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input"
                                                        {{ in_array('bottled_water', $inclusions) ? 'checked' : null }}
                                                        name="inclusions[]" value="bottled_water" id="inclusions10">
                                                    <label class="custom-control-label" for="inclusions10">BOTTLED
                                                        WATER</label>
                                                </div>
                                            </fieldset>
                                            <fieldset>
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input"
                                                        {{ in_array('travel_kit', $inclusions) ? 'checked' : null }}
                                                        name="inclusions[]" value="travel_kit" id="inclusions2">
                                                    <label class="custom-control-label" for="inclusions2">SAFE TRAVEL
                                                        KIT</label>
                                                </div>
                                            </fieldset>
                                            <fieldset>
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input"
                                                        {{ in_array('insurance', $inclusions) ? 'checked' : null }}
                                                        name="inclusions[]" value="insurance" id="inclusions11">
                                                    <label class="custom-control-label"
                                                        for="inclusions11">INSURANCE</label>
                                                </div>
                                            </fieldset>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="repeater-default">
                                <div data-repeater-list="tour_cities">
                                    @foreach ($tour->tour_cities as $city)
                                        <div data-repeater-item>
                                            <div class="row">
                                                <input type="hidden" name="city_id" value="{{ $city->id }}">
                                                <input type="hidden" name="old_background_city_image"
                                                    value="{{ $city->background_image }}">
                                                <div class="form-group mb-1 col-sm-12 col-lg-2">
                                                    <label for="city">City</label>
                                                    <br>
                                                    <input type="text" class="form-control" id="city"
                                                        name="city" value="{{ $city->city }}">
                                                </div>
                                                <div class="form-group mb-1 col-sm-12 col-lg-3">
                                                    <label for="description">Description</label>
                                                    <br>
                                                    <textarea class="form-control" id="description" rows="5" name="description">{{ $city->description }}</textarea>
                                                </div>
                                                <div class="form-group mb-1 col-sm-12 col-lg-3">
                                                    <label for="background_image" class="cursor-pointer">Background
                                                        Image <span class="warning" style="font-size: 12px">Change it if
                                                            needed</span></label>
                                                    <br>
                                                    <input type="file" name="background_image" class="form-control"
                                                        id="background_image">
                                                </div>
                                                <div class="col-sm-12 col-lg-2">
                                                    <img src="{{ URL::asset('app-assets/images/gci_tour_cities_backgrounds/' . $city->background_image) }}"
                                                        alt="" style="width: 100%;">
                                                </div>
                                                <div class="form-group col-sm-12 col-lg-2 text-center mt-2">
                                                    <button type="button" class="btn btn-danger" data-repeater-delete> <i
                                                            class="feather icon-x"></i> Delete</button>
                                                </div>
                                            </div>
                                            <hr>
                                        </div>
                                    @endforeach
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
                                                data-group-cls="btn-group-sm"
                                                {{ $tour->is_featured ? 'checked' : null }} />
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
