@extends('layouts.admin-layout')

@section('title', 'Overview')

@section('content')
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <div class="row grouped-multiple-statistics-card">
                    <div class="col-12">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="row match-height">
                                    <div class="col-xl-12 col-lg-12">
                                        <div class="card">
                                            <div class="card-header">
                                                <h4 class="card-title">Recent Users</h4>
                                                <a class="heading-elements-toggle"><i
                                                        class="fa fa-ellipsis-v font-medium-3"></i></a>
                                                <div class="heading-elements">
                                                    <ul class="list-inline mb-0">
                                                        <li><a data-action="reload"><i
                                                                    class="feather icon-rotate-cw"></i></a></li>
                                                        <li><a data-action="expand"><i
                                                                    class="feather icon-maximize"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="card-content">
                                                <div class="card-body p-0">
                                                </div>
                                                <div class="table-responsive">
                                                    <table id="recent-orders"
                                                        class="table table-hover mb-0 ps-container ps-theme-default">
                                                        <thead>
                                                            <tr>
                                                                <th>Id</th>
                                                                <th>Username</th>
                                                                <th>Email</th>
                                                                <th>Name</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($users as $user)
                                                                <tr>
                                                                    <td class="text-truncate">{{ $user->id }}</td>
                                                                    <td class="text-truncate">{{ $user->username }}</td>
                                                                    <td class="text-truncate">{{ $user->email }}</td>
                                                                    <td class="text-truncate">{{ $user->name }}</td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="row match-height">
                                    <div class="col-xl-12 col-lg-12">
                                        <div class="card">
                                            <div class="card-header">
                                                <h4 class="card-title">Recent Interests</h4>
                                                <a class="heading-elements-toggle"><i
                                                        class="fa fa-ellipsis-v font-medium-3"></i></a>
                                                <div class="heading-elements">
                                                    <ul class="list-inline mb-0">
                                                        <li><a data-action="reload"><i
                                                                    class="feather icon-rotate-cw"></i></a></li>
                                                        <li><a data-action="expand"><i
                                                                    class="feather icon-maximize"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="card-content">
                                                <div class="card-body p-0">
                                                </div>
                                                <div class="table-responsive">
                                                    <table id="recent-orders"
                                                        class="table table-hover mb-0 ps-container ps-theme-default">
                                                        <thead>
                                                            <tr>
                                                                <th>Id</th>
                                                                <th>Interest Name</th>
                                                                <th>Icon</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($interests as $interest)
                                                                <tr>
                                                                    <td class="text-truncate">{{ $interest->id }}</td>
                                                                    <td class="text-truncate">{{ $interest->interest_name }}</td>
                                                                    <td class="text-truncate"><img src="" alt=""></td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
