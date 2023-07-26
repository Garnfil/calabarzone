@extends('layouts.admin-layout')

@section('title', 'Create Event')

@section('content')
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center border-bottom">
                    <h2 class="card-title">Create Event</h2>
                    <a href="{{ route('admin.events') }}" class="btn btn-primary">Back to List</a>
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
                    <form action="{{ route('admin.event.update', $event->id) }}" method="POST" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <input type="hidden" name="old_image" value="{{ $event->featured_image }}">
                        <input type="hidden" id="city_id_hidden" value="{{ $event->city_id }}">
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="row">
                                    <div class="col-lg-6 my-1">
                                        <label for="event_name" class="form-label">Event Name</label>
                                        <input type="text" class="form-control" name="event_name" id="event_name" value="{{ $event->event_name }}">
                                        <span class="text-danger danger">
                                            @error('event_name')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                    <div class="col-lg-6 my-1">
                                        <label for="featured_image" class="form-label">Featured Image</label>
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
                                                <option {{ $event->province_id == $province->id ? 'selected' : null }} value="{{ $province->id }}">{{ $province->name }}</option>
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
                                        <label for="event_date" class="form-label">Event Date</label>
                                        <input type="text" name="event_date" id="event_date" class="form-control" value="{{ $event->event_date }}">
                                    </div>
                                    <div class="col-lg-6 my-1">
                                        <label for="what_to_wear" class="form-label">What to wear</label>
                                        <input type="text" name="what_to_wear" id="what_to_wear" class="form-control" value="{{ $event->what_to_wear }}">
                                    </div>
                                    <div class="col-lg-6 my-1">
                                        <label for="travel_tips" class="form-label">Travel Tips</label>
                                        <textarea name="travel_tips" id="travel_tips" cols="30" rows="10" class="form-control">{{ $event->travel_tips }}</textarea>
                                        <span class="text-danger danger">
                                            @error('travel_tips')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                    <div class="col-lg-6 my-1">
                                        <label for="description" class="form-label">Description</label>
                                        <textarea name="description" id="description" cols="30" rows="10" class="form-control">{{ $event->description }}</textarea>
                                        <span class="text-danger danger">
                                            @error('description')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                    <div class="col-lg-6 my-1">
                                        <label for="contact_person" class="form-label">Contact Person</label>
                                        <input type="text" class="form-control" name="contact_person" id="contact_person" value="{{ $event->contact_person }}">
                                    </div>
                                    <div class="col-lg-6 my-1">
                                        <label for="contact_number" class="form-label">Contact Number</label>
                                        <input type="text" class="form-control" name="contact_number" id="contact_number" value="{{ $event->contact_number }}">
                                    </div>
                                    <div class="col-lg-6 my-1">
                                        <label for="interest_type" class="form-label">Activity Type</label>
                                        <select name="interest_type" id="interest_type" class="select2 form-control">
                                            <option value="">--- SELECT ACTIVITY TYPE ---</option>
                                            @foreach ($interests as $interest)
                                                <option {{ $interest->id == $event->interest_type ? 'selected' : null }} value="{{ $interest->id }}">{{ $interest->interest_name }}</option>
                                            @endforeach
                                        </select>
                                        <span class="text-danger danger">
                                            @error('interest_type')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <img class="img-responsive" id="previewImage" style="width: 100% !important;" src="{{ URL::asset('app-assets/images/events/' . $event->featured_image) }}" alt="">
                            </div>
                        </div>
                        <div class="form-footer py-2 border-top">
                            <button class="btn btn-success">Save Event</button>
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