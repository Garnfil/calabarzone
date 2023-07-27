
@extends('layouts.admin-layout')

@section('title', 'Edit Accomodation')

@section('content')
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center border-bottom">
                    <h3 class="card-title">Edit Food & Dining</h3>
                    <a href="{{ route('admin.food_dinings') }}" class="btn btn-primary">Back to List</a>
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
                    <form action="{{ route('admin.food_dining.update', $food_dining->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="old_image" value="{{ $food_dining->featured_image }}">
                        <input type="hidden" id="city_id_hidden" value="{{ $food_dining->city_id }}">
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="row">
                                    <div class="col-lg-6 my-1">
                                        <label for="business_name" class="form-label">Business Name</label>
                                        <input type="text" class="form-control" name="business_name"
                                            id="business_name" value="{{ $food_dining->business_name }}">
                                        <span class="text-danger danger">
                                            @error('business_name')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                    <div class="col-lg-6 my-1">
                                        <label for="featured_image" class="form-label">Featured Image</label>
                                        <input type="file" class="form-control" name="featured_image"
                                            id="featured_image">
                                        <span class="text-danger danger">
                                            @error('featured_image')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                    <div class="col-lg-6 my-1">
                                        <label for="province" class="form-label">Province</label>
                                        <select name="province_id" id="province" class="select2 form-control"
                                            onchange="getCities(this)">
                                            <option value="">--- SELECT PROVINCE ---</option>
                                            @foreach ($provinces as $province)
                                                <option
                                                    {{ $province->id == $food_dining->province_id ? 'selected' : null }}
                                                    value="{{ $province->id }}">{{ $province->name }}</option>
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
                                            <option value="">--- SELECT PROVINCE BEFORE CITY / MUNICIPALITY ---
                                            </option>
                                        </select>
                                        <span class="text-danger danger">
                                            @error('city_id')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                    <div class="col-lg-6 my-1">
                                        <label for="merchant_code" class="form-label">Merchant Code</label>
                                        <input type="text" class="form-control" name="merchant_code" id="merchant_code" value="{{ $food_dining->merchant_code }}">
                                        <span class="text-danger danger">
                                            @error('merchant_code')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                    <div class="col-lg-6 my-1">
                                        <label for="cuisine" class="form-label">Cuisine</label>
                                        <input type="text" class="form-control" name="cuisine" id="cuisine" value="{{ $food_dining->cuisine }}">
                                        <span class="text-danger danger">
                                            @error('cuisine')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                    <div class="col-lg-6 my-1">
                                        <label for="operation_hours" class="form-label">Operation Hours</label>
                                        <input type="text" class="form-control" name="operation_hours" id="operation_hours" value="{{ $food_dining->operation_hours }}">
                                        <span class="text-danger danger">
                                            @error('operation_hours')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                    <div class="col-lg-6 my-1">
                                        <label for="price_range" class="form-label">Price Range</label>
                                        <input type="text" class="form-control" name="price_range" id="price_range" value="{{ $food_dining->price_range }}">
                                        <span class="text-danger danger">
                                            @error('price_range')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                    <div class="col-lg-6 my-1">
                                        <label for="latitude" class="form-label">Latitude</label>
                                        <input type="text" class="form-control" name="latitude" id="latitude" value="{{ $food_dining->latitude }}">
                                        <span class="text-danger danger">
                                            @error('latitude')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                    <div class="col-lg-6 my-1">
                                        <label for="longitude" class="form-label">Longitude</label>
                                        <input type="text" class="form-control" name="longitude" id="longitude" value="{{ $food_dining->longitude }}">
                                        <span class="text-danger danger">
                                            @error('longitude')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                    <div class="col-lg-6 my-1">
                                        <label for="interest_type" class="form-label">Activity Type</label>
                                        <select name="interest_type" id="interest_type" class="select2 form-control">
                                            <option value="">--- SELECT ACTIVITY TYPE ---</option>
                                            @foreach ($interests as $interest)
                                                <option
                                                    {{ $food_dining->interest_type == $interest->id ? 'selected' : null }}
                                                    value="{{ $interest->id }}">{{ $interest->interest_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <span class="text-danger danger">
                                            @error('interest_type')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                    <div class="col-lg-6 my-1">
                                        <label for="atmosphere" class="form-label">Atmosphere</label>
                                        <input type="text" class="form-control" name="atmosphere" id="atmosphere" value="{{ $food_dining->atmosphere }}">
                                        <span class="text-danger danger">
                                            @error('atmosphere')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                    <div class="col-lg-6 my-1">
                                        <label for="trunkline" class="form-label">Trunkline/Business Office Number</label>
                                        <input type="text" class="form-control" name="trunkline" id="trunkline" value="{{ $food_dining->trunkline }}">
                                        <span class="text-danger danger">
                                            @error('trunkline')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                    <div class="col-lg-6 my-1">
                                        <label for="mobile_number" class="form-label">Mobile Number</label>
                                        <input type="text" class="form-control" name="mobile_number" id="mobile_number" value="{{ $food_dining->mobile_number }}">
                                        <span class="text-danger danger">
                                            @error('mobile_number')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <img class="img-responsive" id="previewImage" style="width: 100% !important;"
                                src="{{ URL::asset('app-assets/images/food_dinings/' . $food_dining->featured_image) }}"
                                alt="">
                            </div>
                        </div>
                        <div class="form-footer py-2 border-top">
                            <button class="btn btn-success">Save Food and Dinings</button>
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
            let url = `{{ route('admin.city_municipality.lookup') }}?province_id=${value}`;
            let city_id_hidden = document.querySelector('#city_id_hidden');

            $.ajax({
                url: url,
                method: 'GET',
                success: function(data) {
                    $('#city option').remove();
                    if (data.length > 0) {
                        data.forEach(element => {
                            $(`<option ${element.id == city_id_hidden.value ? 'selected' : null} value=${element.id}>${element.name}</option>`)
                                .appendTo('#city');
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
