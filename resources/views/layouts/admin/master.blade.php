<!--
=========================================================
* Argon Dashboard 2 - v2.0.4
=========================================================

* Product Page: https://www.creative-tim.com/product/argon-dashboard
* Copyright 2022 Creative Tim (https://www.creative-tim.com)
* Licensed under MIT (https://www.creative-tim.com/license)
* Coded by Creative Tim

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="./assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="{{ asset('/argon/assets/img/favicon.png') }}">
    <title>
        Argon Dashboard 2 by Creative Tim
    </title>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Nucleo Icons -->
    <link href="{{ asset('/argon/assets/css/nucleo-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('/argon/assets/css/nucleo-svg.css') }}" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="{{ asset('/argon/assets/css/nucleo-svg.css') }}" rel="stylesheet" />
    <!-- CSS Files -->
    <link id="pagestyle" href="{{ asset('/argon/assets/css/argon-dashboard.css?v=2.0.4') }}" rel="stylesheet" />

    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('/argon/assets/DataTables/dataTables.min.css') }}">

    @stack('up_css')
</head>

<body class="g-sidenav-show   bg-gray-100">
    <div class="min-height-300 bg-primary position-absolute w-100"></div>

    <!-- sidebar -->
    @includeIf('layouts.admin.sidebar')
    <!-- end sidebar -->

    <main class="main-content position-relative border-radius-lg ">

        <!-- navbar header -->
        @includeIf('layouts.admin.header')
        <!-- end navbar header -->

        @yield('content')

    </main>

    <!-- plugin -->
    @includeIf('layouts.admin.plugin')
    <!-- end plugin -->

    <!-- Jquery -->
    <script src="{{ asset('/argon/assets/js/jquery-3-7-0.js') }}"></script>
    <!--   Core JS Files   -->
    <script src="{{ asset('/argon/assets/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('/argon/assets/js/core/bootstrap.min.js') }}"></script>
    <script src="{{ asset('/argon/assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('/argon/assets/js/plugins/smooth-scrollbar.min.js') }}"></script>
    <script src="{{ asset('/argon/assets/js/plugins/chartjs.min.js') }}"></script>
    <!-- DataTables -->
    <script src="{{ asset('/argon/assets/DataTables/dataTables.min.js') }}"></script>

    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
    </script>
    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="{{ asset('/argon/assets/js/argon-dashboard.min.js?v=2.0.4') }}"></script>

    @include('sweetalert::alert', ['cdn' => "https://cdn.jsdelivr.net/npm/sweetalert2@9"])


    <!-- bottom scripts -->
    @stack('bottom_scripts')
</body>

</html>