@extends('layouts.admin-layout')

@section('title', 'Events')

@section('content')
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="content-header row">
        </div>
        @if (Session::get('success'))
            @push('scripts')
                <script>
                    toastr.success("{{ Session::get('success') }}", 'Success', 'positionclass = "toast-bottom-full-width"')
                </script>
            @endpush
        @endif
        <div class="content-body">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center border-bottom">
                    <h2 class="card-title">Events</h2>
                    <a href="{{ route('admin.event.create') }}" class="btn btn-primary">Create Event</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped data-table">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Featured Image</th>
                                    <th>Event Name</th>
                                    <th>Province</th>
                                    <th>City</th>
                                    <th>Event Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script>


        function loadTable() {
            let table = $('.data-table').DataTable({
                processing: true,
                pageLength: 25,
                responsive: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('admin.events') }}"
                },
                columns: [
                    {
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'featured_image',
                        name: 'featured_image'
                    },
                    {
                        data: 'event_name',
                        name: 'event_name'
                    },
                    {
                        data: 'province',
                        name: 'province'
                    },
                    {
                        data: 'city_municipality',
                        name: 'city_municipality'
                    },
                    {
                        data: 'event_date',
                        name: 'event_date'
                    },
                    {
                        data: 'actions',
                        name: 'actions'
                    }
                ]
            })
        }
        loadTable()
    </script>
@endpush
