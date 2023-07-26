@extends('layouts.admin-layout')

@section('title', 'Edit Activity')

@section('content')
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center border-bottom">
                        <h2 class="card-title">Create Activity</h2>
                        <a href="{{ route('admin.activities') }}" class="btn btn-primary">Back to List</a>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.activity.update', $activity->id) }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="old_image" value="{{ $activity->featured_image }}">
                            <input type="hidden" id="city_id_hidden" value="{{ $activity->city_id }}">
                            <div class="row">
                                <div class="col-lg-8">
                                    <div class="row">
                                        <div class="col-lg-6 my-1">
                                            <label for="activity_name" class="form-label">Activity Name</label>
                                            <input type="text" class="form-control" name="activity_name"
                                                id="activity_name" value="{{ $activity->activity_name }}">
                                            <span class="text-danger danger">
                                                @error('activity_name')
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
                                                        {{ $province->id == $activity->province_id ? 'selected' : null }}
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
                                            <label for="things_todo" class="form-label">Things To Do</label>
                                            <textarea name="things_todo" id="things_todo" cols="30" rows="5" class="form-control">{{ $activity->things_todo }}</textarea>
                                            <span class="text-danger danger">
                                                @error('things_todo')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>
                                        <div class="col-lg-6 my-1">
                                            <label for="description" class="form-label">Description</label>
                                            <textarea name="description" id="description" cols="30" rows="5" class="form-control">{{ $activity->description }}</textarea>
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
                                                    <option
                                                        {{ $interest->id == $activity->interest_type ? 'selected' : null }}
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
                                            <label for="what_to_wear" class="form-label">What to wear</label>
                                            <input type="text" class="form-control" name="what_to_wear" id="what_to_wear"
                                                value="{{ $activity->what_to_wear }}">
                                            <span class="text-danger danger">
                                                @error('what_to_wear')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>
                                        <div class="col-lg-6 my-1">
                                            <label for="operational_hours" class="form-label">Operational Hours</label>
                                            <input type="text" class="form-control" name="operational_hours"
                                                id="operational_hours" value="{{ $activity->operational_hours }}">
                                            <span class="text-danger danger">
                                                @error('operational_hours')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>
                                        <div class="col-lg-6 my-1">
                                            <label for="best_time_to_visit" class="form-label">Best time to visit</label>
                                            <input type="text" class="form-control" name="best_time_to_visit"
                                                id="best_time_to_visit" value="{{ $activity->best_time_to_visit }}">
                                            <span class="text-danger danger">
                                                @error('best_time_to_visit')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <img class="img-responsive" id="previewImage" style="width: 100% !important;"
                                        src="{{ URL::asset('app-assets/images/activities/' . $activity->featured_image) }}"
                                        alt="">
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
