
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">

    <!-- Styles -->
    {{-- <link rel="stylesheet" href="{{ mix('css/app.css') }}"> --}}

    <!-- Custom fonts for this template-->
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template-->
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">

    @livewireStyles


    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <!-- Scripts -->
    {{-- <script src="{{ mix('js/app.js') }}" defer></script> --}}
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav navbar-dark bg-dark sidebar sidebar-dark accordion" id="accordionSidebar" style="background-color: #0f1115 !important;">

            <!-- Sidebar - Brand -->
            {{-- <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon">
                  <img src="{{asset('images/logo.png')}}"/>
                </div>
                
            </a> --}}
            <a class="logo d-flex align-items-center justify-content-center" href="{{ route('dashboard') }}" style="text-decoration: none;">
                <div class="sidebar-brand-icon mt-3 mb-2" style="background-color: white; border-radius: 8px; padding: 10px;">
                    <img style="max-height: 80px; width: auto; object-fit: contain;" src="{{ asset('images/LOGO123.png') }}" alt="Clinic Software Logo"/>
                </div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-2">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
              <x-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                {{ __('Dashboard') }}
              </x-nav-link>
            </li>

            <!-- Nav Item - Schedule -->
            @can("view-schedule")
              <li class="nav-item">
                  <x-nav-link href="{{ route('schedule') }}" :active="request()->routeIs('schedule')">
                      <i class="fas fa-calendar"></i>
                      {{ __('Schedule') }}
                  </x-nav-link>
              </li>
            @endcan

            @can("view-myschedule")
              <li class="nav-item">
                  <x-nav-link href="{{ route('my-schedule') }}" :active="request()->routeIs('my-schedule')">
                      <i class="fas fa-calendar"></i>
                      {{ __('My Schedule') }}
                  </x-nav-link>
              </li>
            @endcan

            <!-- Nav Item - Patients -->
           {{--  @can("list-patients")
              <li class="nav-item">
                <x-nav-link href="{{ route('patients') }}" :active="request()->routeIs('patients')">
                  <i class="fas fa-hospital-user"></i>
                  {{ __('Patients') }}
                </x-nav-link>
              </li>
            @endcan --}}

            <!-- Nav Item - Patients2 -->
            @can("list-patients")
              <li class="nav-item">
                <x-nav-link href="{{ route('patients2') }}" :active="request()->routeIs('patients2')">
                  <i class="fas fa-hospital-user"></i>
                  {{ __('Patients') }}
                </x-nav-link>
              </li>
            @endcan

            <!-- Nav Item - Staff -->
            @can("list-employees")
              <li class="nav-item">
                  <x-nav-link href="{{ route('employees') }}" :active="request()->routeIs('employees')">
                      <i class="fas fa-user-md"></i>
                      {{ __('Staff') }}
                  </x-nav-link>
              </li>
            @endcan

            <!-- Nav Item - Users -->
            @can("list-users")
            <li class="nav-item">
                <x-nav-link href="{{ route('users') }}" :active="request()->routeIs('users')">
                    <i class="fas fa-users"></i>
                    {{ __('Users') }}
                </x-nav-link>
            </li>
            @endcan

            <!-- Nav Item - Permissions -->
            @can("list-permissions")
              <li class="nav-item">
                  <x-nav-link href="{{ route('permissions') }}" :active="request()->routeIs('permissions')">
                      <i class="fas fa-hospital-user"></i>
                      {{ __('Permissions') }}
                  </x-nav-link>
              </li>
            @endcan

            <!-- Nav Item - Appointment -->
            @can("list-appointments")
              <li class="nav-item">
                  <x-nav-link href="{{ route('appointments') }}" :active="request()->routeIs('appointments')">
                      <i class="fas fa-calendar-check"></i>
                      {{ __('Appointments') }}
                  </x-nav-link>
              </li>
            @endcan

            <!-- Nav Item - Roles -->
            @can("list-roles")
              <li class="nav-item">
                  <x-nav-link href="{{ route('roles') }}" :active="request()->routeIs('roles')">
                      <i class="fas fa-user-shield"></i>
                      {{ __('Roles') }}
                  </x-nav-link>
              </li>
            @endcan
           
            @can("list-report")
            <!-- Nav Item - Report -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>{{ __('Report') }}</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="{{ route('reportpatients') }}">{{ __('Patients') }}</a>
                        <a class="collapse-item" href="{{ route('reportdoctor') }}">{{ __('Doctor') }}</a>
                        <a class="collapse-item" href="{{ route('report') }}">{{ __('Assessment') }}</a>
                        <a class="collapse-item" href="{{ route('reportcount') }}">{{ __('Number of Patients') }}</a>
                    </div>
                </div>
            </li>
            @endcan
            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">


                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- Page Heading -->
                    <header class="">
                        <div class="">
                            {{ $header }}
                        </div>
                    </header>

                    <!-- Page Content -->
                    <main class="">
                        {{ $slot }}
                    </main>
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; 2023 Esperanza Valencia. All Rights Reserved</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <form method="POST" action="{{ route('logout') }}" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-primary">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @stack('modals')

    @livewireScripts

    @stack('scripts')

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>

    <!-- Page level plugins -->
    <script src="{{ asset('vendor/chart.js/Chart.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('js/demo/chart-area-demo.js') }}"></script>
    <script src="{{ asset('js/demo/chart-pie-demo.js') }}"></script>
    <script src="{{ asset('js/utils.js') }}"></script>

</body>

</html>
