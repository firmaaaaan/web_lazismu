<!doctype html>


<html lang="en">
    <head>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
        <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
        <title>Dashboard - Lazismu BS</title>
        <!-- CSS files -->
        <link href="{{ asset('dist') }}/css/tabler.min.css?1668287865" rel="stylesheet"/>
        <link href="{{ asset('dist') }}/css/tabler-flags.min.css?1668287865" rel="stylesheet"/>
        <link href="{{ asset('dist') }}/css/tabler-payments.min.css?1668287865" rel="stylesheet"/>
        <link href="{{ asset('dist') }}/css/tabler-vendors.min.css?1668287865" rel="stylesheet"/>
        <link href="{{ asset('dist') }}/css/demo.min.css?1668287865" rel="stylesheet"/>
        <link rel="shortcut icon" href="{{ asset('dist/img/lazismu.png') }}" type="image/x-icon">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <style>
        @import url('https://rsms.me/inter/inter.css');
        :root {
            --tblr-font-sans-serif: Inter, -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
        }
        </style>
    </head>
    <body  class=" layout-boxed">
        <script src="{{ asset('dist') }}/js/demo-theme.min.js?1668287865"></script>
        <div class="page">
        <!-- Navbar -->
        @include('partials.header')
        @include('partials.navbar')
        <div class="page-wrapper">
            <!-- Page header -->
            @yield('content')
            <footer class="footer footer-transparent d-print-none">
            <div class="container-xl">
                <div class="row text-center align-items-center flex-row-reverse">
                <div class="col-lg-auto ms-lg-auto">
                </div>
                <div class="col-12 col-lg-auto mt-3 mt-lg-0">
                    <ul class="list-inline list-inline-dots mb-0">
                    <li class="list-inline-item">
                        Copyright &copy; 2023
                        <a href="." class="link-secondary">Lazismu-BS</a>.
                        All rights reserved.
                    </li>
                    <li class="list-inline-item">
                        <a href="./changelog.html" class="link-secondary" rel="noopener">
                        v1.0.0
                        </a>
                    </li>
                    </ul>
                </div>
                </div>
            </div>
            </footer>
        </div>
        </div>
        <!-- Libs JS -->
        <script src="{{ asset('dist/js/jam-digital.js') }}"></script>
        <script src="{{ asset('dist') }}/libs/apexcharts/dist/apexcharts.min.js?1668287865" defer></script>
        <script src="{{ asset('dist') }}/libs/jsvectormap/dist/js/jsvectormap.min.js?1668287865" defer></script>
        <script src="{{ asset('dist') }}/libs/jsvectormap/dist/maps/world.js?1668287865" defer></script>
        <script src="{{ asset('dist') }}/libs/jsvectormap/dist/maps/world-merc.js?1668287865" defer></script>
        <!-- Tabler Core -->
        <script src="{{ asset('dist') }}/js/tabler.min.js?1668287865" defer></script>
        <script src="{{ asset('dist') }}/js/demo.min.js?1668287865" defer></script>
        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.js"></script>
    </body>
</html>
