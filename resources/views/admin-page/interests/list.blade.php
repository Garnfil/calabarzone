@extends('layouts.admin-layout')

@section('title', 'Interests')

@section('content')
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center border-bottom">
                    <h2 class="card-title">Interests</h2>
                    <a href="{{ route('admin.interest.create') }}" class="btn btn-primary">Create Interest</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped data-table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Interest Name</th>
                                    <th>Featured Image</th>
                                    <th>Icon</th>
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
                    url: "{{ route('admin.interests') }}"
                },
                columns: [
                    {
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'interest_name',
                        name: 'interest_name'
                    },
                    {
                        data: 'featured_image',
                        name: 'featured_image'
                    },
                    {
                        data: 'icon',
                        name: 'icon'
                    },
                    {
                        data: 'actions',
                        name: 'actions'
                    }
                ]
            })
        }

        loadTable();
    </script>
@endpush
