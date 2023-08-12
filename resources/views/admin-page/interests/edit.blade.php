@extends('layouts.admin-layout')

@section('title', 'Edit Interest')

@section('content')
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center border-bottom">
                        <h3 class="card-title">Edit Interest</h3>
                        <a href="{{ route('admin.interests') }}" class="btn btn-primary">Back to List</a>
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
                        <form method="POST" enctype="multipart/form-data" action="{{ route('admin.interest.update', $interest->id) }}">
                            @csrf
                            @method("PUT")
                            <input type="hidden" name="old_icon_image" value="{{ $interest->icon }}">
                            <input type="hidden" name="old_featured_image" value="{{ $interest->featured_image }}">
                            <div class="row">
                                <div class="col-lg-8">
                                    <div class="row">
                                        <div class="col-lg-6 my-1">
                                            <label for="interest_name" class="form-label">Interest Name</label>
                                            <input type="text" class="form-control" name="interest_name"
                                                id="interest_name" value="{{ $interest->interest_name }}">
                                            <span>
                                                @error('interest_name')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>
                                        <div class="col-lg-6 my-1">
                                            <label for="featured_image" class="form-label">Featured Image  <span class="text-primary primary" style="font-size: 10px;">Change it if needed.</span></label>
                                            <input type="file" class="form-control" name="featured_image"
                                                id="featured_image">
                                                <span>
                                                    @error('featured_image')
                                                        {{ $message }}
                                                    @enderror
                                                </span>
                                        </div>
                                        <div class="col-lg-6 my-1">
                                            <label for="icon" class="form-label">Featured Icon  <span class="text-primary primary" style="font-size: 10px;">Change it if needed.</span></label>
                                            <input type="file" class="form-control" name="icon" id="icon">
                                            <span>
                                                @error('icon')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>
                                        <div class="col-lg-6 my-1">
                                            <label for="description" class="form-label">Description</label>
                                            <textarea rows="5" class="form-control" name="description" id="description">{{ $interest->description }}</textarea>
                                            <span>
                                                @error('description')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>
                                        <div class="col-lg-6 my-1">
                                            <label for="background_color" class="form-label">Background Color</label>
                                            <input type="color" name="background_color" id="background_color" class="form-control" oninput="getBackgroundColorValue(this)">
                                            <input type="text" class="form-control" id="background_color_hex" readonly value="{{ $interest->background_color }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 d-flex justify-content-between" style="gap: 10px">
                                    <div class="featured-image-container" style="width: 50% !important;">
                                        <h6>Featured Image Preview</h6>
                                        @if($interest->featured_image)
                                            <img class="img-responsive" id="previewFeaturedImage" style="width: 100% !important;" src="{{ URL::asset('app-assets/images/interests/' . $interest->featured_image) }}" alt="">
                                        @else
                                            <img class="img-responsive" id="previewFeaturedImage" style="width: 100% !important;" src="{{ URL::asset('app-assets/images/default-image.jpg') }}" alt="">
                                        @endif
                                    </div>
                                    <div class="featured-image-container" style="width: 50% !important;">
                                        <h6>Featured Icon Preview</h6>
                                        <div style="width: 100%; height: 150px; max-height: 200px; padding: 2rem; background: #0a254a; border-radius: 5px;">
                                            <img class="img-responsive" id="previewIconImage" style="width: 100% !important; height: 100%; object-fit: cover;"
                                            src="{{ URL::asset('app-assets/images/interests_icons/' . $interest->icon) }}" alt="">
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="form-footer my-1">
                                <button class="btn btn-success">Save Interest</button>
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
        function handleFeatureFileSelect(event) {
            const file = event.target.files[0];

            if (file) {
                const reader = new FileReader();

                reader.onload = function(event) {
                    const previewImage = document.getElementById('previewFeaturedImage');
                    previewImage.src = event.target.result;
                };

                reader.readAsDataURL(file);
            }
        }

        function handleIconFileSelect(event) {
            const file = event.target.files[0];

            if (file) {
                const reader = new FileReader();

                reader.onload = function(event) {
                    const previewImage = document.getElementById('previewIconImage');
                    previewImage.src = event.target.result;
                };

                reader.readAsDataURL(file);
            }
        }

        function getBackgroundColorValue(e) {
            document.querySelector('#background_color_hex').value = e.value;
        }

        window.addEventListener('load', () => {
            document.querySelector('#background_color').value = document.querySelector('#background_color_hex').value;
        })

        // Attach the 'handleFileSelect' function to the file input's change event
        document.getElementById('featured_image').addEventListener('change', handleFeatureFileSelect);
        document.getElementById('icon').addEventListener('change', handleIconFileSelect);
    </script>
@endpush
