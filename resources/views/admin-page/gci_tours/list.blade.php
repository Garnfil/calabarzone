@extends('layouts.admin-layout')

@section('title', 'GCI Tours')

@section('content')
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center border-bottom">
                        <h2 class="card-title">GCI TOURS</h2>
                        <a href="{{ route('admin.gci_tour.create') }}" class="btn btn-primary">Create Tour</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped data-table">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Tour Name</th>
                                        <th>Province</th>
                                        <th>Tour Duration</th>
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
                    url: "{{ route('admin.gci_tours') }}"
                },
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'tour_name',
                        name: 'tour_name',
                    },
                    {
                        data: 'province',
                        name: 'province',
                    },
                    {
                        data: 'tour_duration',
                        name: 'tour_duration',
                    },
                    {
                        data: 'actions',
                        name: 'actions',
                    },
                ]
            })
        }
        loadTable();
    </script>
@endpush
