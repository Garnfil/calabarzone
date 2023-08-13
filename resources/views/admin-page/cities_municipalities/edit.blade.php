@extends('layouts.admin-layout')

@section('title', 'Create City or Municipality')

@section('content')
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center border-bottom">
                        <h3 class="card-title">Create City or Municipality</h3>
                        <a href="{{ route('admin.cities_municipalities') }}" class="btn btn-primary">Back to List</a>
                    </div>
                    <div class="card-body">
                        @if (Session::get('success'))
                            <div class="alert alert-success">{{ Session::get('success') }}</div>
                        @endif
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form action="{{ route('admin.city_municipality.update', $data->id) }}" method="post"
                            enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <input type="hidden" name="old_image" value="{{ $data->featured_image }}">
                            <div class="row">
                                <div class="col-lg-8">
                                    <div class="row">
                                        <div class="col-lg-6 my-1">
                                            <label for="name" class="form-label">Name</label>
                                            <input type="text" class="form-control" name="name" id="name"
                                                value="{{ $data->name }}">
                                        </div>
                                        <div class="col-lg-6 my-1">
                                            <label for="province" class="form-label">Province</label>
                                            <select name="province_id" id="province" class="select2 form-control">
                                                <option value="">--- SELECT PROVINCE ---</option>
                                                @foreach ($provinces as $province)
                                                    <option {{ $data->province_id == $province->id ? 'selected' : null }}
                                                        value="{{ $province->id }}">{{ $province->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-lg-6 my-1">
                                            <label for="featured_image" class="form-label">Featured Image <span
                                                    class="text-primary primary" style="font-size: 10px;">Change it if
                                                    needed.</span></label>
                                            <input type="file" class="form-control" name="featured_image"
                                                id="featured_image" value="">
                                        </div>
                                        <div class="col-lg-6 my-1">
                                            <label for="featured_image" class="form-label">Type</label>
                                            <fieldset>
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" class="custom-control-input" name="type"
                                                        id="type1" value="city"
                                                        {{ $data->type == 'city' ? 'checked' : null }}>
                                                    <label class="custom-control-label" for="type1">City</label>
                                                </div>
                                            </fieldset>
                                            <fieldset>
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" class="custom-control-input" name="type"
                                                        id="type2"
                                                        {{ $data->type == 'municipality' ? 'checked' : null }}
                                                        value="municipality">
                                                    <label class="custom-control-label" for="type2">Municipality</label>
                                                </div>
                                            </fieldset>
                                        </div>
                                        <div class="col-lg-6 my-1">
                                            <label for="description" class="form-label">Description</label>
                                            <textarea type="text" class="form-control" rows="5" name="description" id="description">{{ $data->description }}</textarea>
                                            <span class="danger text-danger">
                                                @error('description')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    @if ($data->featured_image)
                                        <img class="img-responsive" id="previewImage" style="width: 100% !important;"
                                            src="{{ URL::asset('app-assets/images/city_municipality/' . $data->featured_image) }}"
                                            alt="">
                                    @else
                                        <img src="{{ URL::asset('app-assets/images/default-image.jpg') }}" alt="" style="width: 100% !important;">
                                    @endif
                                </div>
                            </div>
                            <div class="form-footer">
                                <button class="btn btn-success">Save City or Municipality</button>
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

        // Attach the 'handleFileSelect' function to the file input's change event
        document.getElementById('featured_image').addEventListener('change', handleFileSelect);
    </script>
@endpush
