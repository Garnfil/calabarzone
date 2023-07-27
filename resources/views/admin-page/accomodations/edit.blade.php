@extends('layouts.admin-layout')

@section('title', 'Create Accommodation')

@section('content')
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center border-bottom">
                        <h2 class="card-title">Edit Accommodation</h2>
                        <a href="{{ route('admin.accomodations') }}" class="btn btn-primary">Back to List</a>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.accomodation.update', $accomodation->id) }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="old_image" value="{{ $accomodation->featured_image }}">
                            <input type="hidden" id="city_id_hidden" value="{{ $accomodation->city_id }}">
                            <div class="row">
                                <div class="col-lg-8">
                                    <div class="row">
                                        <div class="col-lg-6 my-1">
                                            <label for="business_name" class="form-label">Business Name</label>
                                            <input type="text" class="form-control" name="business_name"
                                                id="business_name" value="{{ $accomodation->business_name }}">
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
                                                        {{ $province->id == $accomodation->province_id ? 'selected' : null }}
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
                                            <input type="text" class="form-control" name="merchant_code"
                                                id="merchant_code" value="{{ $accomodation->merchant_code }}">
                                        </div>
                                        <div class="col-lg-6 my-1">
                                            <label for="classification" class="form-label">Classification</label>
                                            <select name="classification" id="classification" class="select2 form-control">
                                                <option value="Hotel">Hotel</option>
                                                <option value="Resort">Resort</option>
                                                <option value="Mabuhay Accommodation">MABUHAY ACCOMMODATION </option>
                                            </select>
                                        </div>
                                        <div class="col-lg-6 my-1">
                                            <label for="interest_type" class="form-label">Activity Type</label>
                                            <select name="interest_type" id="interest_type" class="select2 form-control">
                                                <option value="">--- SELECT ACTIVITY TYPE ---</option>
                                                @foreach ($interests as $interest)
                                                    <option
                                                        {{ $accomodation->interest_type == $interest->id ? 'selected' : null }}
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
                                            <label for="description" class="form-label">Description</label>
                                            <textarea name="description" id="description" cols="30" rows="5" class="form-control">{{ $accomodation->description }}</textarea>
                                            <span class="text-danger danger">
                                                @error('description')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>
                                        <div class="col-lg-6 my-1">
                                            <label for="contact_number" class="form-label">Contact Number</label>
                                            <input type="text" class="form-control" name="contact_number"
                                                id="contact_number" value="{{ $accomodation->contact_number }}">
                                        </div>
                                        <div class="col-lg-6 my-1">
                                            <label for="contact_email" class="form-label">Contact Email</label>
                                            <input type="text" class="form-control" name="contact_email"
                                                id="contact_email" value="{{ $accomodation->contact_email }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <img class="img-responsive" id="previewImage" style="width: 100% !important;"
                                        src="{{ URL::asset('app-assets/images/accomodations/' . $accomodation->featured_image) }}"
                                        alt="">
                                </div>
                            </div>
                            <div class="form-footer border-top py-2">
                                <button class="btn btn-success">Save Accommodation</button>
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
