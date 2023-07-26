@extends('layouts.admin-layout')

@section('title', 'Provinces')

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
                        <h2 class="card-title">Provinces</h2>
                        <a href="{{ route('admin.province.create') }}" class="btn btn-primary">Create Province</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped data-table">
                                <thead>
                                    <tr>
                                        <th width="20">Id</th>
                                        <th width="75">Image</th>
                                        <th>Name</th>
                                        <th>Transportations</th>
                                        <th>Tagline</th>
                                        <th width="100">Actions</th>
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
                    url: "{{ route('admin.provinces') }}"
                },
                columns: [{
                        data: 'id',
                        name: 'id',
                    },
                    {
                        data: 'featured_image',
                        name: 'featured_image,',
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'transportations',
                        name: 'transportations'
                    },
                    {
                        data: 'tagline',
                        name: 'tagline'
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