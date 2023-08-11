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
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form action="{{ route('admin.city_municipality.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-lg-8">
                                    <div class="row">
                                        <div class="col-lg-6 my-1">
                                            <label for="name" class="form-label">Name</label>
                                            <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}">
                                        </div>
                                        <div class="col-lg-6 my-1">
                                            <label for="province" class="form-label">Province</label>
                                            <select name="province_id" id="province" class="select2 form-control">
                                                <option value="">--- SELECT PROVINCE ---</option>
                                                @foreach ($provinces as $province)
                                                    <option value="{{ $province->id }}">{{ $province->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-lg-6 my-1">
                                            <label for="featured_image" class="form-label">Featured Image</label>
                                            <input type="file" class="form-control" name="featured_image" id="featured_image" value="{{ old('featured_image') }}">
                                        </div>
                                        <div class="col-lg-6 my-1">
                                            <label for="featured_image" class="form-label">Type</label>
                                            <fieldset>
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" class="custom-control-input" name="type" id="type1" value="city">
                                                    <label class="custom-control-label" for="type1">City</label>
                                                </div>
                                            </fieldset>
                                            <fieldset>
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" class="custom-control-input" name="type" id="type2" checked value="municipality">
                                                    <label class="custom-control-label" for="type2">Municipality</label>
                                                </div>
                                            </fieldset>
                                        </div>
                                        <div class="col-lg-6 my-1">
                                            <label for="description" class="form-label">Description</label>
                                            <textarea type="text" class="form-control" rows="5" name="description" id="description">{{ old('description') }}</textarea>
                                            <span class="danger text-danger">
                                                @error('description')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <img class="img-responsive" id="previewImage" style="width: 100% !important;" src="{{ URL::asset('app-assets/images/default-image.jpg') }}" alt="">
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
