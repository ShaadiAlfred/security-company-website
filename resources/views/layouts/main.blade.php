<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- Tell the browser to be responsive to screen width -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <!-- Favicon icon -->
        <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('/assets/images/favicon.png') }}">

        <!-- Title -->
        @if (isset($pageTitle))
            <title>{{ config('app.name', 'Laravel') . ' - ' . $pageTitle ?? '' }}</title>
        @else
            <title>{{ config('app.name', 'Laravel') }}</title>
        @endif
        <!-- Other meta tags -->
        @stack('meta_tags')

        <!-- Main CSS -->
        <!--Toaster Popup message CSS -->
        <link href="{{ asset('/assets/node_modules/toast-master/css/jquery.toast.css') }}" rel="stylesheet">
        <!-- Style file CSS -->
        <link href="{{ mix('css/style.min.css') }}" rel="stylesheet">

        {{-- RTL stylesheet --}}
        @if (app()->getLocale() === 'ar')
            {{-- Font --}}
            <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;700;900&display=swap" rel="stylesheet">
            {{-- RTL stylesheet --}}
            <link rel="stylesheet" href="{{ mix('css/rtl.css') }}" type="text/css" media="screen" />
        @endif

        <!-- Additional stylesheets -->
        @stack('stylesheets')
    </head>

    <body class="skin-blue fixed-layout">
        <!-- ============================================================== -->
        <!-- Preloader - style you can find in spinners.css -->
        <!-- ============================================================== -->
        <div class="preloader">
            <div class="loader">
                <div class="loader__figure"></div>
                <p class="loader__label">{{ config('app.name') }}</p>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- Main wrapper - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <div id="main-wrapper">
            <!-- ============================================================== -->
            <!-- Topbar header - style you can find in pages.scss -->
            <!-- ============================================================== -->
            <header class="topbar">
                <nav class="navbar top-navbar navbar-expand-md navbar-dark">
                    <!-- ============================================================== -->
                    <!-- Logo -->
                    <!-- ============================================================== -->
                    <div class="navbar-header">
                        <a class="navbar-brand" href="{{ route('index') }}">
                            <!-- Logo icon -->
                            <b>
                                <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                                <!-- Dark Logo icon -->
                                <img src="/assets/images/logo-icon.png" alt="homepage" class="dark-logo" />
                                <!-- Light Logo icon -->
                                <img src="/assets/images/logo-light-icon.png" alt="homepage" class="light-logo" />
                            </b>
                            <!--End Logo icon -->
                            <!-- Logo text -->
                            <span>
                                <!-- dark Logo text -->
                                <img src="/assets/images/logo-text.png" alt="homepage" class="dark-logo" />
                                <!-- Light Logo text -->
                                <img src="/assets/images/logo-light-text.png" class="light-logo" alt="homepage" />
                            </span>
                        </a>
                    </div>
                    <!-- ============================================================== -->
                    <!-- End Logo -->
                    <!-- ============================================================== -->
                    <div class="navbar-collapse">
                        <!-- ============================================================== -->
                        <!-- toggle and nav items -->
                        <!-- ============================================================== -->
                        <ul class="navbar-nav mr-auto">
                            <!-- This is  -->
                            <li class="nav-item">
                                <a class="nav-link nav-toggler d-block d-md-none waves-effect waves-dark" href="javascript:void(0)">
                                    <i class="ti-menu"></i>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link sidebartoggler d-none d-lg-block d-md-block waves-effect waves-dark" href="javascript:void(0)">
                                    <i class="icon-menu"></i>
                                </a>
                            </li>
                        </ul>
                        <!-- ============================================================== -->
                        <!-- User profile -->
                        <!-- ============================================================== -->
                        <ul class="navbar-nav my-lg-0">
                            <!-- ============================================================== -->
                            <!-- User Profile -->
                            <!-- ============================================================== -->
                            <li class="nav-item dropdown u-pro">
                                <a class="nav-link dropdown-toggle waves-effect waves-dark profile-pic" href=""
                                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <img src="{{ asset('storage/profile-pictures/default.png') }}" alt="user" class="">
                                    <span class="hidden-md-down">
                                        {{ Auth::user()->name }} &nbsp;<i class="fa fa-angle-down"></i>
                                    </span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right animated flipInY">
                                    <!-- text-->
                                    <a href="javascript:void(0)" class="dropdown-item">
                                        <i class="ti-user"></i> @lang('My Profile')
                                    </a>
                                    <!-- text-->
                                    <div class="dropdown-divider"></div>
                                    <!-- text-->
                                    <a href="javascript:void(0)" class="dropdown-item">
                                        <i class="ti-settings"></i> @lang('Account Settings')
                                    </a>
                                    <!-- text-->
                                    <div class="dropdown-divider"></div>
                                    <!-- text-->
                                    <a onclick="logout()" href="javascript:void(0)" class="dropdown-item">
                                        <i class="fa fa-power-off"></i> @lang('Logout')
                                    </a>
                                    <!-- text-->
                                </div>
                            </li>
                            <!-- ============================================================== -->
                            <!-- End User Profile -->
                            <!-- ============================================================== -->
                        </ul>
                    </div>
                </nav>
            </header>
            <!-- ============================================================== -->
            <!-- End Topbar header -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Left Sidebar - style you can find in sidebar.scss  -->
            <!-- ============================================================== -->
            <aside class="left-sidebar">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li class="user-pro">
                            <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                                <img src="{{ asset('storage/profile-pictures/default.png') }}" alt="user-img" class="img-circle">
                                <span class="hide-menu">
                                    {{ Auth::user()->name }}
                                </span>
                            </a>
                            <ul aria-expanded="false" class="collapse">
                                <li>
                                    <a href="javascript:void(0)">
                                        <i class="ti-user"></i> @lang('My Profile')
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)">
                                        <i class="ti-settings"></i> @lang('Account Settings')
                                    </a>
                                </li>
                                <li>
                                    <a onclick="logout()" href="javascript:void(0)">
                                        <i class="fa fa-power-off"></i> @lang('Logout')
                                    </a>
                                </li>
                            </ul>
                        </li>
                        @if(Auth::user()->isAdmin())
                            <li>
                                <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)"
                                aria-expanded="false">
                                    <i class="ti-user"></i>
                                    <span class="hide-menu">
                                        @lang('Manage Moderators')
                                    </span>
                                </a>
                                <ul aria-expanded="false" class="collapse">
                                    <li><a href="{{ route('moderators.index') }}">@lang('All Moderators')</a></li>
                                    <li><a href="{{ route('moderators.create') }}">@lang('Add Moderator')</a></li>
                                    <li><a href="{{ route('moderators.manage_attendance') }}">@lang('Manage Attendance')</a></li>
                                </ul>
                            </li>
                            <li>
                                <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)"
                                aria-expanded="false">
                                    <i class="ti-location-pin"></i>
                                    <span class="hide-menu">
                                        @lang('Manage Job Locations')
                                    </span>
                                </a>
                                <ul aria-expanded="false" class="collapse">
                                    <li>
                                        <a href="{{ route('job_locations.index') }}">@lang('All Job Locations')</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('job_locations.create') }}">@lang('Add Job Location')</a>
                                    </li>
                                </ul>
                            </li>
                        @endif

                        @can('manage-employees')
                            <li>
                                <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)"
                                aria-expanded="false">
                                    <i class="ti-user"></i>
                                    <span class="hide-menu">
                                        @lang('Manage Employees')
                                    </span>
                                </a>
                                <ul aria-expanded="false" class="collapse">
                                    <li><a href="{{ route('employees.index') }}">@lang('All Employees')</a></li>
                                    <li><a href="{{ route('employees.create') }}">@lang('Add Employee')</a></li>
                                    <li><a href="{{ route('employees.showExcelForm') }}">@lang('Import Excel Files')</a></li>
                                    <li><a href="{{ route('employees.attendance') }}">@lang('Attendance')</a></li>
                                </ul>
                            </li>
                        @endcan
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
            </aside>
            <!-- ============================================================== -->
            <!-- End Left Sidebar - style you can find in sidebar.scss  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Page wrapper  -->
            <!-- ============================================================== -->
            <div class="page-wrapper">
                <!-- ============================================================== -->
                <!-- Container fluid  -->
                <!-- ============================================================== -->
                <div class="container-fluid">
                    <!-- ============================================================== -->
                    <!-- Breadcrumb -->
                    <!-- ============================================================== -->
                    <div class="row page-titles">
                        <div class="col-md-5 align-self-center">
                            <h4 class="text-themecolor">
                                {{ $pageTitle ?? config('app.name')  }}
                            </h4>
                        </div>
                        <div class="col-md-7 align-self-center text-right">
                            <div class="d-flex justify-content-end align-items-center">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="{{ route('index') }}">
                                            @lang('Home')
                                        </a>
                                    </li>
                                    @stack('breadcrumb')
                                    {{-- <li class="breadcrumb-item active">Dashboard 2</li> --}}
                                </ol>
                            </div>
                        </div>
                    </div>
                    <!-- ============================================================== -->
                    <!-- End Breadcrumb -->
                    <!-- ============================================================== -->
                    @yield('content')
                </div>
                <!-- ============================================================== -->
                <!-- End Container fluid  -->
                <!-- ============================================================== -->
            </div>
            <!-- ============================================================== -->
            <!-- End Page wrapper  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Footer -->
            <!-- ============================================================== -->
            <footer class="footer">
                © 2019 Eliteadmin by themedesigner.in
            </footer>
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Wrapper -->
        <!-- ============================================================== -->

        <!-- Logout Form -->
        <form id="logout-form" method="POST" action="{{ route('logout') }}">
            @csrf
        </form>

        <!-- JavaScript -->
        <script src="{{ asset('/assets/node_modules/jquery/jquery-3.2.1.min.js') }}"></script>
        <!-- Bootstrap popper Core JavaScript -->
        <script src="{{ asset('/assets/node_modules/popper/popper.min.js') }}"></script>
        <script src="{{ asset('/assets/node_modules/bootstrap/dist/js/bootstrap.min.js') }}"></script>
        <!-- Perfect Scrollbar JavaScript -->
        <script src="{{ asset('/js/perfect-scrollbar.jquery.min.js') }}"></script>
        <!-- Wave Effects -->
        <script src="{{ mix('/js/waves.min.js') }}"></script>
        <!-- Menu sidebar -->
        <script src="{{ mix('/js/sidebarmenu.min.js') }}"></script>
        <!-- Stickey Kit -->
        <script src="{{ asset('/assets/node_modules/sticky-kit-master/dist/sticky-kit.min.js') }}"></script>
        <script src="{{ asset('/assets/node_modules/sparkline/jquery.sparkline.min.js') }}"></script>
        <!-- Custom JavaScript -->
        <script src="{{ mix('/js/custom.min.js') }}"></script>

        <script type="text/javascript">
            function logout() {
                document.getElementById('logout-form').submit();
            }

            // Ajax Setup
            window.$.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            window.$.toastDefaults = {
                position: 'bottom-right',
            };
        </script>

        <!-- ============================================================== -->
        <!-- This page plugins -->
        <!-- ============================================================== -->
        @stack('javascript')
    </body>

</html>
