<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description"
        content="Stack admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords"
        content="admin template, stack admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="PIXINVENT">
    <title>@yield('title')</title>
    <link rel="apple-touch-icon" href="{{ URL::asset('app-assets/images/logo/calabarzone(32x32).png') }}">
    <link rel="shortcut icon" type="image/x-icon"
        href="{{ URL::asset('app-assets/images/logo/calabarzone(32x32).png') }}">
    <link
        href="https://fonts.googleapis.com/css?family=Poppins:300,300i,400,400i,500,500i%7COpen+Sans:300,300i,400,400i,600,600i,700,700i"
        rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('app-assets/vendors/css/vendors.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ URL::asset('app-assets/vendors/css/forms/selects/select2.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ URL::asset('app-assets/vendors/css/pickers/pickadate/pickadate.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ URL::asset('app-assets/vendors/css/forms/toggle/switchery.min.css') }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('app-assets/vendors/css/forms/icheck/icheck.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('app-assets/vendors/css/forms/icheck/custom.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ URL::asset('app-assets/vendors/css/forms/toggle/switchery.min.css') }}">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('app-assets/css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('app-assets/css/bootstrap-extended.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('app-assets/css/colors.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('app-assets/css/components.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ URL::asset('app-assets/css/core/menu/menu-types/vertical-menu.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ URL::asset('app-assets/fonts/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('app-assets/css/core/colors/palette-gradient.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('app-assets/css/plugins/forms/switch.css') }}">
    <!-- END: Theme CSS-->

    <link rel="stylesheet" type="text/css"
        href="{{ URL::asset('app-assets/css/plugins/forms/checkboxes-radios.css') }}">
    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/css/style.css') }}">
    <!-- END: Custom CSS-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.css">


</head>

<body class="vertical-layout vertical-menu 2-columns   fixed-navbar" data-open="click" data-menu="vertical-menu"
    data-col="2-columns">
    <!-- BEGIN: Header-->
    <nav class="header-navbar navbar-expand-md navbar navbar-with-menu fixed-top navbar-semi-dark navbar-shadow">
        <div class="navbar-wrapper">
            <div class="navbar-header">
                <ul class="nav navbar-nav flex-row">
                    <li class="nav-item mobile-menu d-md-none mr-auto"><a
                            class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i
                                class="feather icon-menu font-large-1"></i></a></li>
                    <li class="nav-item"><a class="navbar-brand" href="#"><img class="brand-logo"
                                alt="stack admin logo"
                                src="{{ URL::asset('app-assets/images/logo/calabarzone(32x32).png') }}">
                            <h2 class="brand-text" style="font-size: 20px !important;">Calabarzone</h2>
                        </a></li>
                    <li class="nav-item d-md-none"><a class="nav-link open-navbar-container" data-toggle="collapse"
                            data-target="#navbar-mobile"><i class="fa fa-ellipsis-v"></i></a></li>
                </ul>
            </div>
            <div class="navbar-container content">
                <div class="collapse navbar-collapse" id="navbar-mobile">
                    <ul class="nav navbar-nav mr-auto float-left">
                        <li class="nav-item d-none d-md-block"><a class="nav-link nav-menu-main menu-toggle hidden-xs"
                                href="#"><i class="feather icon-menu"></i></a></li>
                        <li class="nav-item d-none d-md-block"><a class="nav-link nav-link-expand" href="#"><i
                                    class="ficon feather icon-maximize"></i></a></li>
                        <li class="nav-item nav-search"><a class="nav-link nav-link-search" href="#"><i
                                    class="ficon feather icon-search"></i></a>
                            <div class="search-input">
                                <input class="input" type="text" placeholder="Explore Stack..." tabindex="0"
                                    data-search="template-search">
                                <div class="search-input-close"><i class="feather icon-x"></i></div>
                                <ul class="search-list"></ul>
                            </div>
                        </li>
                    </ul>
                    <ul class="nav navbar-nav float-right">
                        <li class="dropdown dropdown-user nav-item"><a
                                class="dropdown-toggle nav-link dropdown-user-link" href="#"
                                data-toggle="dropdown">
                                <div class="avatar avatar-online"><img
                                        src="../../../app-assets/images/portrait/small/avatar-s-1.png"
                                        alt="avatar"><i></i></div><span
                                    class="user-name">{{ auth()->user()->name }}</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="login-with-bg-image.html"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i
                                        class="feather icon-power"></i> Logout</a>
                                <form method="POST" action="{{ route('admin.logout') }}" id="logout-form"
                                    style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <!-- END: Header-->


    <!-- BEGIN: Main Menu-->
    <div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">
        <div class="main-menu-content">
            <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
                <li class="{{ Request::path() == 'admin/overview' ? 'active' : '' }} nav-item"><a
                        href="{{ route('admin.overview') }}"><i class="feather icon-home"></i><span
                            class="menu-title" data-i18n="Overview">Overview</span></a>
                </li>

                <!------ Start: Destination ------->
                <li class=" navigation-header"><span>Destination</span><i class=" feather icon-pointer"
                        data-toggle="tooltip" data-placement="right" data-original-title="General"></i>
                </li>
                <li class="{{ Request::path() == 'admin/provinces' ? 'active' : '' }} nav-item"><a
                        href="{{ route('admin.provinces') }}"><i class="feather icon-map-pin"></i><span
                            class="menu-title" data-i18n="Provinces">Provinces</span></a>
                </li>
                <li class="{{ Request::path() == 'admin/cities_municipalities' ? 'active' : '' }} nav-item"><a
                        href="{{ route('admin.cities_municipalities') }}"><i class="feather icon-map-pin"></i><span
                            class="menu-title" data-i18n="Cities/Municipalities">Cities/Municipalities</span></a>
                </li>
                <!------ End: Destination ------->

                <li class=" navigation-header"><span>GCI Tours</span><i class=" feather icon-pointer"
                        data-toggle="tooltip" data-placement="right" data-original-title="General"></i>
                </li>
                <li class="{{ Request::path() == 'admin/provinces' ? 'active' : '' }} nav-item"><a
                        href="{{ route('admin.provinces') }}"><i class="feather icon-map-pin"></i><span
                            class="menu-title" data-i18n="Provinces">Provinces</span></a>
                </li>

                <!------ Start: Interests ------->
                <li class=" navigation-header"><span>Interests</span><i class=" feather icon-minus"
                        data-toggle="tooltip" data-placement="right" data-original-title="Apps"></i>
                </li>
                <li class="{{ Request::path() == 'admin/interests' ? 'active' : '' }} nav-item"><a
                        href="{{ route('admin.interests') }}"><i class="feather icon-box"></i><span
                            class="menu-title" data-i18n="Interests">Interests</span></a>
                </li>
                <li class="{{ Request::path() == 'admin/attractions' ? 'active' : '' }} nav-item"><a
                        href="{{ route('admin.attractions') }}"><i class="feather icon-grid"></i><span
                            class="menu-title" data-i18n="Attractions">Attractions</span></a>
                </li>
                <li class="{{ Request::path() == 'admin/events' ? 'active' : '' }} nav-item"><a
                        href="{{ route('admin.events') }}"><i class="feather icon-calendar"></i><span
                            class="menu-title" data-i18n="Events">Events</span></a>
                </li>
                <li class="{{ Request::path() == 'admin/activities' ? 'active' : '' }} nav-item"><a
                        href="{{ route('admin.activities') }}"><i class="feather icon-activity"></i><span
                            class="menu-title" data-i18n="Activities">Activities</span></a>
                </li>
                <li class="{{ Request::path() == 'admin/accommodations' ? 'active' : '' }} nav-item"><a
                        href="{{ route('admin.accommodations') }}"><i class="feather icon-globe"></i><span
                            class="menu-title" data-i18n="Accommodations">Accommodations</span></a>
                </li>
                <li class="{{ Request::path() == 'admin/food_dinings' ? 'active' : '' }} nav-item"><a
                        href="{{ route('admin.food_dinings') }}"><i class="feather icon-globe"></i><span
                            class="menu-title" data-i18n="Food & Dinings">Food & Dinings</span></a>
                </li>
                <!------ End: Interests ------->

                <li class="navigation-header"><span>Users</span><i class=" feather icon-minus" data-toggle="tooltip"
                        data-placement="right" data-original-title="Apps"></i>
                </li>
                <li class="{{ Request::path() == 'admin/users' ? 'active' : '' }} nav-item"><a
                        href="{{ route('admin.users') }}"><i class="feather icon-users"></i><span class="menu-title"
                            data-i18n="Users">Users</span></a>
                </li>
                <li class="{{ Request::path() == 'admin/admins' ? 'active' : '' }} nav-item"><a
                        href="{{ route('admin.admins') }}"><i class="feather icon-users"></i><span
                            class="menu-title" data-i18n="Admins">Admins</span></a>
                </li>
            </ul>
        </div>
    </div>
    <!-- END: Main Menu-->

    <!-- BEGIN: Content-->
    @yield('content')
    <!-- END: Content-->

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

    <!-- BEGIN: Footer-->
    <footer class="footer footer-static footer-light navbar-border">
        <p class="clearfix blue-grey lighten-2 text-sm-center mb-0 px-2"><span
                class="float-md-left d-block d-md-inline-block">Copyright &copy; 2023 <a
                    class="text-bold-800 grey darken-2" href="#" target="_blank">CALABARZONE </a></span></p>
    </footer>
    <!-- END: Footer-->

    <!-- BEGIN: Vendor JS-->
    <script src="{{ asset('app-assets/vendors/js/vendors.min.js') }}"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="{{ asset('app-assets/vendors/js/forms/select/select2.full.min.js') }}"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="{{ asset('app-assets/vendors/js/forms/icheck/icheck.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/forms/toggle/bootstrap-checkbox.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/forms/toggle/switchery.min.js') }}"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="{{ asset('app-assets/js/core/app-menu.js') }}"></script>
    <script src="{{ asset('app-assets/js/core/app.js') }}"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="{{ asset('app-assets/js/scripts/forms/select/form-select2.js') }}"></script>
    <script src="{{ asset('app-assets/js/scripts/forms/switch.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if (Session::get('success'))
        <script>
            toastr.options = {
                closeButton: true, // Add close button
                timeOut: 2000
            };
            toastr.success("{{ Session::get('success') }}", "Success");
        </script>
    @endif

    @if (Session::get('fail'))
        <script>
            toastr.options = {
                closeButton: true, // Add close button
                timeOut: 2000
            };
            toastr.error("{{ Session::get('fail') }}", 'Fail');
        </script>
    @endif

    @stack('scripts')
    <!-- END: Page JS-->
</body>

</html>
