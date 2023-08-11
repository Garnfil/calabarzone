@extends('layouts.admin-layout')

@section('title', 'Create Province')

@section('content')
 <style>
    .previewImage {
        width: 100px;
        height: 100px;
        object-fit: cover;
         border-radius: 5px;
    }
 </style>
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center border-bottom">
                        <h3 class="card-title">Update Province</h3>
                        <a href="{{ route('admin.provinces') }}" class="btn btn-primary">Back to List</a>
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
                        <form action="{{ route('admin.province.update', $province->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <input type="hidden" name="old_image" value="{{ $province->featured_image }}">
                            <div class="row">
                                <div class="col-lg-8">
                                    <div class="row">
                                        <div class="col-md-6 my-1">
                                            <label for="province_name" class="form-label">Province Name</label>
                                            <input type="text" class="form-control" name="name" id="province_name"
                                                value="{{ $province->name }}">
                                            <span class="danger text-danger">
                                                @error('name')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>
                                        <div class="col-md-6 my-1">
                                            <label for="description" class="form-label">Province Description</label>
                                            <textarea type="text" class="form-control" rows="5" name="description" id="description">{{ $province->description }}</textarea>
                                            <span class="danger text-danger">
                                                @error('description')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>
                                        <div class="col-md-6 my-1">
                                            <label for="delicacies" class="form-label">Delicacies</label>
                                            <textarea name="delicacies" id="delicacies" cols="30" rows="5" class="form-control">{{ $province->delicacies }}</textarea>
                                        </div>
                                        <div class="col-md-6 my-1">
                                            <label for="transportations" class="form-label">Province Transportations</label>
                                            <select name="transportations[]" id="transportations"
                                                class="select2 form-control" multiple="multiple">
                                                <option
                                                    {{ in_array('Jeep', json_decode($province->transportations)) ? 'selected' : null }}
                                                    value="Jeep">Jeep</option>
                                                <option
                                                    {{ in_array('Bus', json_decode($province->transportations)) ? 'selected' : null }}
                                                    value="Bus">Bus</option>
                                                <option
                                                    {{ in_array('Tricycle', json_decode($province->transportations)) ? 'selected' : null }}
                                                    value="Tricycle">Tricycle</option>
                                                <option
                                                    {{ in_array('Motorcycle', json_decode($province->transportations)) ? 'selected' : null }}
                                                    value="Motorcycle">Motorcycle</option>
                                                <option
                                                    {{ in_array('Taxi', json_decode($province->transportations)) ? 'selected' : null }}
                                                    value="Taxi">Taxi</option>
                                                <option
                                                    {{ in_array('Train', json_decode($province->transportations)) ? 'selected' : null }}
                                                    value="Train">Train</option>
                                                <option
                                                    {{ in_array('Airplane', json_decode($province->transportations)) ? 'selected' : null }}
                                                    value="Airplane">Airplane</option>
                                                <option
                                                    {{ in_array('Horse Carriage', json_decode($province->transportations)) ? 'selected' : null }}
                                                    value="Horse Carriage">Horse Carriage</option>
                                            </select>
                                            <span class="danger text-danger">
                                                @error('transportations')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>
                                        <div class="col-md-6 my-1">
                                            <label for="tagline" class="form-label">Province Tagline</label>
                                            <input type="text" class="form-control" name="tagline" id="tagline"
                                                value="{{ $province->tagline }}">
                                        </div>
                                        <div class="col-md-6 my-1">
                                            <label for="latitude" class="form-label">Latitude</label>
                                            <input type="text" class="form-control" name="latitude" id="latitude"
                                                value="{{ $province->latitude }}">
                                        </div>
                                        <div class="col-md-6 my-1">
                                            <label for="longitude" class="form-label">Longitude</label>
                                            <input type="text" class="form-control" name="longitude" id="longitude"
                                                value="{{ $province->longitude }}">
                                        </div>
                                        <div class="col-md-12 my-1">
                                            <h4>Province Images</h4>
                                            <hr>
                                            <div class="row">
                                                <div class=" col-lg-6 mb-1">
                                                    <label for="featured_image_one" class="form-label">Province Image 1 <span class="text-primary primary" style="font-size: 10px;">Change it if  needed.</span></label>
                                                    <input type="file" class="form-control" name="featured_image[0]"
                                                        id="featured_image_one" onchange="handleFileSelect(this, 'previewImageOne')">
                                                    <span class="danger text-danger">
                                                        @error('featured_image')
                                                            {{ $message }}
                                                        @enderror
                                                    </span> <br>
                                                    <img class="img-responsive previewImage" id="previewImageOne" src="{{ URL::asset('app-assets/images/default-image.jpg') }}" alt="">
                                                </div>
                                                <div class=" col-lg-6 mb-1">
                                                    <label for="featured_image_two" class="form-label">Province Image 2 <span class="text-primary primary" style="font-size: 10px;">Change it if  needed.</span></label>
                                                    <input type="file" class="form-control" name="featured_image[1]"
                                                        id="featured_image_two" onchange="handleFileSelect(this, 'previewImageTwo')">
                                                    <span class="danger text-danger">
                                                        @error('featured_image')
                                                            {{ $message }}
                                                        @enderror
                                                    </span> <br>
                                                    <img class="img-responsive previewImage" id="previewImageTwo" src="{{ URL::asset('app-assets/images/default-image.jpg') }}" alt="">
                                                </div>
                                                <div class=" col-lg-6 mb-1">
                                                    <label for="featured_image_three" class="form-label">Province Image 3 <span class="text-primary primary" style="font-size: 10px;">Change it if  needed.</span></label>
                                                    <input type="file" class="form-control" name="featured_image[2]"
                                                        id="featured_image_three" onchange="handleFileSelect(this, 'previewImageThree')">
                                                    <span class="danger text-danger">
                                                        @error('featured_image')
                                                            {{ $message }}
                                                        @enderror
                                                    </span> <br>
                                                    <img class="img-responsive previewImage" id="previewImageThree" src="{{ URL::asset('app-assets/images/default-image.jpg') }}" alt="">
                                                </div>
                                                <div class=" col-lg-6 mb-1">
                                                    <label for="featured_image_four" class="form-label">Province Image 4 <span class="text-primary primary" style="font-size: 10px;">Change it if  needed.</span></label>
                                                    <input type="file" class="form-control" name="featured_image[3]"
                                                        id="featured_image_four" onchange="handleFileSelect(this, 'previewImageFour')">
                                                    <span class="danger text-danger">
                                                        @error('featured_image')
                                                            {{ $message }}
                                                        @enderror
                                                    </span> <br>
                                                    <img class="img-responsive previewImage" id="previewImageFour" src="{{ URL::asset('app-assets/images/default-image.jpg') }}" alt="">
                                                </div>
                                                <div class=" col-lg-6 mb-1">
                                                    <label for="featured_image_five" class="form-label">Province Image 5 <span class="text-primary primary" style="font-size: 10px;">Change it if  needed.</span></label>
                                                    <input type="file" class="form-control" name="featured_image[4]"
                                                        id="featured_image_five" onchange="handleFileSelect(this, 'previewImageFive')">
                                                    <span class="danger text-danger">
                                                        @error('featured_image')
                                                            {{ $message }}
                                                        @enderror
                                                    </span> <br>
                                                    <img class="img-responsive previewImage" id="previewImageFive" src="{{ URL::asset('app-assets/images/default-image.jpg') }}" alt="">
                                                </div>
                                                <div class=" col-lg-6 mb-1">
                                                    <label for="featured_image_six" class="form-label">Province Image 6 <span class="text-primary primary" style="font-size: 10px;">Change it if  needed.</span></label>
                                                    <input type="file" class="form-control" name="featured_image[5]"
                                                        id="featured_image_six" onchange="handleFileSelect(this, 'previewImageSix')">
                                                    <span class="danger text-danger">
                                                        @error('featured_image')
                                                            {{ $message }}
                                                        @enderror
                                                    </span> <br>
                                                    <img class="img-responsive previewImage" id="previewImageSix" src="{{ URL::asset('app-assets/images/default-image.jpg') }}" alt="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <section id="component-swiper-autoplay">
                                        <div class="card ">
                                            <div class="card-header">
                                                <h4 class="card-title">Featured Images</h4>
                                            </div>
                                            <div class="card-content">
                                                <div class="card-body">
                                                    <div class="swiper-autoplay swiper-container">
                                                        <div class="swiper-wrapper">
                                                            <div class="swiper-slide"> <img class="img-fluid" style="height: 250px !important; width: 100% !important; object-fit: cover; cursor: grab;" src="{{ URL::asset('app-assets/images/provinces/batangas.png') }}" alt="banner">
                                                            </div>
                                                            <div class="swiper-slide"> <img class="img-fluid" style="height: 250px !important; width: 100% !important; object-fit: cover; cursor: grab;" src="{{ URL::asset('app-assets/images/provinces/laguna.jpg') }}" alt="banner">
                                                            </div>
                                                            <div class="swiper-slide"> <img class="img-fluid" style="height: 250px !important; width: 100% !important; object-fit: cover; cursor: grab;" src="{{ URL::asset('app-assets/images/provinces/quezon.jpg') }}" alt="banner">
                                                            </div>
                                                            <div class="swiper-slide"> <img class="img-fluid" style="height: 250px !important; width: 100% !important; object-fit: cover; cursor: grab;" src="{{ URL::asset('app-assets/images/provinces/rizal.jpg') }}" alt="banner">
                                                            </div>
                                                            <div class="swiper-slide"> <img class="img-fluid" style="height: 250px !important; width: 100% !important; object-fit: cover; cursor: grab;" src="{{ URL::asset('app-assets/images/provinces/cavite.jpg') }}" alt="banner">
                                                            </div>
                                                            <div class="swiper-slide"> <img class="img-fluid" style="height: 250px !important; width: 100% !important; object-fit: cover; cursor: grab;" src="{{ URL::asset('app-assets/images/provinces/rizal.jpg') }}" alt="banner">
                                                            </div>
                                                        </div>
                                                        <!-- Add Pagination -->
                                                        <div class="swiper-pagination"></div>
                                                        <!-- Add Arrows -->
                                                        <div class="swiper-button-next"></div>
                                                        <div class="swiper-button-prev"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                    {{-- @if ($province->featured_image)
                                        <img class="img-responsive" id="previewImage" style="width: 100% !important;"
                                            src="{{ URL::asset('app-assets/images/provinces/' . $province->featured_image) }}"
                                            alt="">
                                    @endif --}}
                                </div>
                            </div>
                            <div class="form-footer">
                                <button class="btn btn-success">Save Province</button>
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
        function handleFileSelect(event, previewImageId) {
            const file = event.files[0];
            console.log(event);
            if (file) {
                const reader = new FileReader();

                reader.onload = function(event) {
                    const previewImage = document.getElementById(previewImageId);
                    previewImage.src = event.target.result;
                };

                reader.readAsDataURL(file);
            }
        }

        // Attach the 'handleFileSelect' function to the file input's change event
        // document.getElementById('featured_image').addEventListener('change', handleFileSelect);
    </script>
@endpush
