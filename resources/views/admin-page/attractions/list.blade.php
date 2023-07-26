@extends('layouts.admin-layout')

@section('title', 'Attractions')

@section('content')
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center border-bottom">
                    <h2 class="card-title">Attractions</h2>
                    <a href="{{ route('admin.attraction.create') }}" class="btn btn-primary">Create Attraction</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped data-table">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Featured Image</th>
                                    <th>Attraction Name</th>
                                    <th>Province</th>
                                    <th>City/Municipality</th>
                                    <th>Is Featured?</th>
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
                    url: "{{ route('admin.attractions') }}"
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
                        data: 'attraction_name',
                        name: 'attraction_name'
                    },
                    {
                        data: 'province',
                        name: 'province,'
                    },
                    {
                        data: 'city_municipality',
                        name: 'city_municipality,'
                    },
                    {
                        data: 'is_featured',
                        name: 'is_featured'
                    },
                    {
                        data: 'actions',
                        name: 'actions'
                    },
                ]
            })
        }
        loadTable();
    </script>

@endpush
