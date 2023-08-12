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
                        <h2 class="card-title">Create Accommodation</h2>
                        <a href="{{ route('admin.accommodations') }}" class="btn btn-primary">Back to List</a>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.accommodation.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-lg-8">
                                    <div class="row">
                                        <div class="col-lg-6 my-1">
                                            <label for="business_name" class="form-label">Business Name</label>
                                            <input type="text" class="form-control" name="business_name"
                                                id="business_name">
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
                                                    <option value="{{ $province->id }}">{{ $province->name }}</option>
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
                                                id="merchant_code">
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
                                                    <option value="{{ $interest->id }}">{{ $interest->interest_name }}
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
                                            <textarea name="description" id="description" cols="30" rows="5" class="form-control"></textarea>
                                            <span class="text-danger danger">
                                                @error('description')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>
                                        <div class="col-lg-6 my-1">
                                            <label for="contact_number" class="form-label">Contact Number</label>
                                            <input type="text" class="form-control" name="contact_number"
                                                id="contact_number">
                                        </div>
                                        <div class="col-lg-6 my-1">
                                            <label for="contact_email" class="form-label">Contact Email</label>
                                            <input type="text" class="form-control" name="contact_email"
                                                id="contact_email">
                                        </div>
                                        <div class="col-lg-6 my-1">
                                            <label for="latitude" class="form-label">Latitude</label>
                                            <input type="text" class="form-control" name="latitude"
                                                id="latitude">
                                        </div>
                                        <div class="col-lg-6 my-1">
                                            <label for="longitude" class="form-label">Longitude</label>
                                            <input type="text" class="form-control" name="longitude"
                                                id="longitude">
                                        </div>
                                        <div class="col-lg-6 my-1">
                                            <label for="website" class="form-label">Website</label>
                                            <input type="text" class="form-control" name="website"
                                                id="website">
                                        </div>
                                        <div class="col-lg-6 my-1">
                                            <label for="mobile_number" class="form-label">Is Active?</label>
                                            <fieldset>
                                                <div class="float-left">
                                                    <input type="checkbox" class="switch" id="is_active" name="is_active" data-group-cls="btn-group-sm" />
                                                </div>
                                            </fieldset>
                                        </div>
                                    </div>
                                    <hr>
                                    <h3><i class="fa-fa-image"></i> Other Images</h3>
                                    <hr>
                                    <div class="row">
                                        <div class="form-group col-12 mb-2 file-repeater">
                                            <div data-repeater-list="accommodation_images">
                                                <div data-repeater-item>
                                                    <div class="row mb-1">
                                                        <div class="col-9 col-xl-10">
                                                            <label class="file center-block">
                                                                <input type="file" id="file" name="accommodation_images" class="form-control">
                                                                <span class="file-custom"></span>
                                                            </label>
                                                        </div>
                                                        <div class="col-2 col-xl-1">
                                                            <button type="button" data-repeater-delete class="btn btn-icon btn-danger mr-1"><i class="feather icon-x"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <button type="button" data-repeater-create class="btn btn-primary">
                                                <i class="icon-plus4"></i> Add new file
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <img class="img-responsive" id="previewImage" style="width: 100% !important;"
                                        src="{{ URL::asset('app-assets/images/default-image.jpg') }}" alt="">
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

            $.ajax({
                url: url,
                method: 'GET',
                success: function(data) {
                    $('#city option').remove();
                    if (data.length > 0) {
                        data.forEach(element => {
                            $(`<option value=${element.id}>${element.name}</option>`).appendTo('#city');
                        });
                    } else {
                        $(`<option value="">-- NO CITY FOUND --</option>`).appendTo('#city');
                    }

                }
            });
        }

        // Attach the 'handleFileSelect' function to the file input's change event
        document.getElementById('featured_image').addEventListener('change', handleFileSelect);
    </script>
@endpush
