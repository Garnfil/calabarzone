@extends('layouts.admin-layout')

@section('title', 'Create Province')

@section('content')
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
                        <form action="{{ route('admin.province.update', $province->id) }}" method="POST" enctype="multipart/form-data">
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
                                            <label for="featured_image" class="form-label">Province Image <span class="text-primary primary" style="font-size: 10px;">Change it if needed.</span></label>
                                            <input type="file" class="form-control" name="featured_image"
                                                id="featured_image" value="">
                                            <span class="danger text-danger">
                                                @error('featured_image')
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
                                            <label for="transportations" class="form-label">Province Transportations</label>
                                            <select name="transportations[]" id="transportations"
                                                class="select2 form-control" multiple="multiple">
                                                <option {{in_array('Jeep', json_decode($province->transportations)) ? 'selected' : null}} value="Jeep">Jeep</option>
                                                <option {{in_array('Bus', json_decode($province->transportations)) ? 'selected' : null}} value="Bus">Bus</option>
                                                <option {{in_array('Tricycle', json_decode($province->transportations)) ? 'selected' : null}} value="Tricycle">Tricycle</option>
                                                <option {{in_array('Motorcycle', json_decode($province->transportations)) ? 'selected' : null}} value="Motorcycle">Motorcycle</option>
                                            </select>
                                            <span class="danger text-danger">
                                                @error('transportations')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>
                                        <div class="col-md-6 my-1">
                                            <label for="tagline" class="form-label">Province Tagline</label>
                                            <input type="text" class="form-control" name="tagline"
                                                id="tagline" value="{{ $province->tagline }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    @if($province->featured_image)
                                        <img class="img-responsive" id="previewImage" style="width: 100% !important;"
                                        src="{{ URL::asset('app-assets/images/provinces/' . $province->featured_image) }}" alt="">
                                    @endif
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
