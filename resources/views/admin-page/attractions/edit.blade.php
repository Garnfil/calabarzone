@extends('layouts.admin-layout')

@section('title', 'Create Attraction')

@section('content')
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center border-bottom">
                    <h2 class="card-title">Create Attraction</h2>
                    <a href="{{ route('admin.attractions') }}" class="btn btn-primary">Back to List</a>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.attraction.update', $attraction->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="old_image" value="{{ $attraction->featured_image }}">
                        <input type="hidden" id="city_id_hidden" value="{{ $attraction->city_id }}">
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="row">
                                    <div class="col-lg-6 my-1">
                                        <label for="attraction_name" class="form-label">Attraction Name</label>
                                        <input type="text" class="form-control" name="attraction_name" id="attraction_name" value="{{ $attraction->attraction_name }}">
                                        <span class="text-danger danger">
                                            @error('attraction_name')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                    <div class="col-lg-6 my-1">
                                        <label for="featured_image" class="form-label">Featured Image  <span class="text-primary primary" style="font-size: 10px;">Change it if needed.</span></label>
                                        <input type="file" class="form-control" name="featured_image" id="featured_image">
                                        <span class="text-danger danger">
                                            @error('featured_image')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                    <div class="col-lg-6 my-1">
                                        <label for="province" class="form-label">Province</label>
                                        <select name="province_id" id="province" class="select2 form-control" onchange="getCities(this)">
                                            <option value="">--- SELECT PROVINCE ---</option>
                                            @foreach ($provinces as $province)
                                                <option {{ $province->id == $attraction->province_id ? 'selected' : null }} value="{{ $province->id }}">{{ $province->name }}</option>
                                            @endforeach
                                        </select>
                                        <span class="text-danger danger">
                                            @error('province_id')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                    <div class="col-lg-6 my-1">
                                        <label for="city" class="form-label">City / Municipality</label>
                                        <select name="city_id" id="city" class="select2 form-control">
                                            <option value="">--- SELECT PROVINCE BEFORE CITY / MUNICIPALITY ---</option>
                                        </select>
                                        <span class="text-danger danger">
                                            @error('city_id')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                    <div class="col-lg-6 my-1">
                                        <label for="how_to_get_there" class="form-label">How to get there</label>
                                        <textarea name="how_to_get_there" id="how_to_get_there" cols="30" rows="10" class="form-control">{{ $attraction->how_to_get_there }}</textarea>
                                        <span class="text-danger danger">
                                            @error('how_to_get_there')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                    <div class="col-lg-6 my-1">
                                        <label for="description" class="form-label">Description</label>
                                        <textarea name="description" id="description" cols="30" rows="10" class="form-control">{{ $attraction->description }}</textarea>
                                        <span class="text-danger danger">
                                            @error('description')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                    <div class="col-lg-6 my-1">
                                        <label for="interest_type" class="form-label">Activity Type</label>
                                        <select name="interest_type" id="interest_type" class="select2 form-control">
                                            <option value="">--- SELECT ACTIVITY TYPE ---</option>
                                            @foreach ($interests as $interest)
                                                <option {{ $attraction->interest_type == $interest->id ? 'selected' : null }} value="{{ $interest->id }}">{{ $interest->interest_name }}</option>
                                            @endforeach
                                        </select>
                                        <span class="text-danger danger">
                                            @error('interest_type')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                    <div class="col-lg-6 my-1">
                                        <label for="things_todo" class="form-label">Things To Do</label>
                                        <textarea name="things_todo" id="things_todo" cols="30" rows="4" class="form-control">{{ $attraction->things_todo }}</textarea>
                                        <span class="text-danger danger">
                                            @error('things_todo')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                    <div class="col-lg-6 my-1">
                                        <label for="operational_hours" class="form-label">Operational Hours</label>
                                        <input type="text" class="form-control" name="operational_hours" id="operational_hours" value="{{ $attraction->operational_hours }}">
                                        <span class="text-danger danger">
                                            @error('operational_hours')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                    <div class="col-lg-6 my-1">
                                        <label for="best_time_to_visit" class="form-label">Best time to visit</label>
                                        <input type="text" class="form-control" name="best_time_to_visit" id="best_time_to_visit" value="{{ $attraction->best_time_to_visit }}">
                                        <span class="text-danger danger">
                                            @error('best_time_to_visit')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                    <div class="col-lg-6 my-1">
                                        <label for="contact_number" class="form-label">Contact Number</label>
                                        <input type="text" class="form-control" name="contact_number" id="contact_number" value="{{ $attraction->contact_number }}">
                                        <span class="text-danger danger">
                                            @error('contact_number')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                    <div class="col-lg-6 my-1">
                                        <label for="mobile_number" class="form-label">Mobile Number</label>
                                        <input type="text" class="form-control" name="mobile_number" id="mobile_number" value="{{ $attraction->mobile_number }}">
                                        <span class="text-danger danger">
                                            @error('mobile_number')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                    <div class="col-lg-6 my-1">
                                        <label for="mobile_number" class="form-label">Is Active?</label>
                                        <fieldset>
                                            <div class="float-left">
                                                <input type="checkbox" class="switch" {{ $attraction->is_active ? 'checked' : null }} id="is_active" name="is_active" data-group-cls="btn-group-sm" />
                                            </div>
                                        </fieldset>
                                    </div>
                                    <div class="col-lg-6 my-1">
                                        <label for="mobile_number" class="form-label">Is Featured?</label>
                                        <fieldset>
                                            <div class="float-left">
                                                <input type="checkbox" class="switch" {{ $attraction->is_featured ? 'checked' : null }} id="is_featured" name="is_featured" data-group-cls="btn-group-sm" />
                                            </div>
                                        </fieldset>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <img class="img-responsive" id="previewImage" style="width: 100% !important;" src="{{ URL::asset('app-assets/images/attractions/' . $attraction->featured_image) }}" alt="">
                            </div>
                        </div>
                        <div class="form-footer border-top py-2">
                            <button class="btn btn-success">Save Attraction</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script>
        // Function to handle file selection and display preview image
        function handleFileSelect(event) {
            const file = event.target.files[0];

            if (file) {
                const reader = new FileReader();

                reader.onload = function(event) {
                const previewImage = document.getElementById('previewImage');
                previewImage.src = event.target.result;
                };

                reader.readAsDataURL(file);
            }
        }

        function getCities(event) {
            let value = event.value;
            let url = `{{ route("admin.city_municipality.lookup") }}?province_id=${value}`;
            let city_id_hidden = document.querySelector('#city_id_hidden');

            $.ajax({
                url: url,
                method: 'GET',
                success: function (data) {
                    $('#city option').remove();
                    if(data.length > 0) {
                        data.forEach(element => {
                            $(`<option ${element.id == city_id_hidden.value ? 'selected' : null} value=${element.id}>${element.name}</option>`).appendTo('#city');
                        });
                    } else {
                        $(`<option value="">-- NO CITY FOUND --</option>`).appendTo('#city');
                    }

                }
            });
        }

        window.addEventListener('load', function() {
            let province_select = document.querySelector('#province');
            getCities(province_select);
        });

        // Attach the 'handleFileSelect' function to the file input's change event
        document.getElementById('featured_image').addEventListener('change', handleFileSelect);
    </script>
@endpush
