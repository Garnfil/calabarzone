@extends('layouts.admin-layout')

@section('title', 'Accommodations')

@section('content')
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center border-bottom">
                        <h2 class="card-title">Accommodations</h2>
                        <a href="{{ route('admin.accommodation.create') }}" class="btn btn-primary">Create Accommodation</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped data-table">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Business Name</th>
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
                    url: "{{ route('admin.accommodations') }}"
                },
                columns: [{
                        data: "id",
                        name: "id",
                    },
                    {
                        data: "business_name",
                        name: "business_name",
                    },
                    {
                        data: "province",
                        name: "province",
                    },
                    {
                        data: "city_municipality",
                        name: "city_municipality",
                    },
                    {
                        data: "actions",
                        name: "actions",
                    }
                ],
                columnDefs: [ {
                    'targets': [0, 1, 2, 3, 4], // column index (start from 0)
                    'orderable': false, // set orderable false for selected columns
                }]
            })
        }

        $(document).on("click", ".remove-btn", function(e) {
            let id = $(this).attr("id");
            Swal.fire({
                title: 'Are you sure?',
                text: "Remove accommodation from list",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, remove it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ route('admin.accommodation.destroy') }}",
                        method: "DELETE",
                        data: {
                            _token: "{{ csrf_token() }}",
                            id: id
                        },
                        success: function(response) {
                            if (response.status) {
                                Swal.fire('Removed!', response.message, 'success').then(
                                    result => {
                                        if (result.isConfirmed) {
                                            location.reload();
                                        }
                                    })
                            }
                        }
                    })
                }
            })
        });
        loadTable()
    </script>
@endpush
