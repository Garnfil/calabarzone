@extends('layouts.admin-layout')

@section('title', 'Accomodations')

@section('content')
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center border-bottom">
                        <h2 class="card-title">Accomodations</h2>
                        <a href="{{ route('admin.accomodation.create') }}" class="btn btn-primary">Create Accomodation</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped data-table">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Featured Image</th>
                                        <th>Business Name</th>
                                        <th>Merchant Code</th>
                                        <th>Classification</th>
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
                    url: "{{ route('admin.accomodations') }}"
                },
                columns: [{
                        data: "id",
                        name: "id",
                    },
                    {
                        data: "featured_image",
                        name: "featured_image,",
                    },
                    {
                        data: "business_name",
                        name: "business_name",
                    },
                    {
                        data: "merchant_code",
                        name: "merchant_code",
                    },
                    {
                        data: "classification",
                        name: "classification",
                    },
                    {
                        data: "actions",
                        name: "actions",
                    }
                ]
            })
        }
        loadTable()
    </script>
@endpush
