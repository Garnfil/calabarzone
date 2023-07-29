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
                        <a href="{{ route('admin.attractions') }}" class="btn btn-primary">Back to List</a>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.gci_tour.store') }}" method="POST">
                            <div class="row">
                                <div class="col-lg-6 my-1">
                                    <label for="tour_name" class="form-label">Tour Name</label>
                                    <input type="text" class="form-control" name="tour_name" id="tour_name">
                                </div>
                                <div class="col-lg-6 my-1">
                                    <label for="province" class="form-label">Province</label>
                                    <select name="province" id="province" class="form-control select2">
                                        <option value="">--- SELECT PROVINCE ---</option>
                                        @foreach ($provinces as $province)
                                            <option value="{{ $province->id }}">{{ $province->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-lg-6 my-1">
                                    <label for="tour_name" class="form-label">What to wear</label>
                                    <input type="text" class="form-control" name="tour_name" id="tour_name">
                                </div>
                                <div class="col-lg-6 my-1">
                                    <label for="tour_name" class="form-label">Best Time</label>
                                    <input type="text" class="form-control" name="tour_name" id="tour_name">
                                </div>
                                <div class="col-lg-6 my-1">
                                    <label for="tour_name" class="form-label">Operation Hours</label>
                                    <input type="text" class="form-control" name="tour_name" id="tour_name">
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
                                                    <input type="checkbox" class="custom-control-input" name="inclusions[]"
                                                        value="toll_fees" id="inclusions6">
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
                                    <label for="mobile_number" class="form-label">Is Featured?</label>
                                    <fieldset>
                                        <div class="float-left">
                                            <input type="checkbox" class="switch" id="is_featured" name="is_featured"
                                                data-group-cls="btn-group-sm" />
                                        </div>
                                    </fieldset>
                                </div>
                            </div>
                            <div class="form-footer py-2 border-top">
                                <button class="btn btn-success">Save Tour</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
