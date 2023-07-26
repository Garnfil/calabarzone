@extends('layouts.admin-layout')

@section('title', 'Activities')

@section('content')
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center border-bottom">
                        <h2 class="card-title">Activities</h2>
                        <a href="{{ route('admin.activity.create') }}" class="btn btn-primary">Create Activity</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped data-table">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Featured Image</th>
                                        <th>Activity Name</th>
                                        <th>Province</th>
                                        <th>City</th>
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
                processing: true,
                pageLength: 25,
                responsive: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('admin.activities') }}"
                },
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'featured_image',
                        name: 'featured_image'
                    },
                    {
                        data: 'activity_name',
                        name: 'activity_name'
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
                        data: 'actions',
                        name: 'actions'
                    },
                ]
            })
        }
        loadTable()
    </script>
@endpush