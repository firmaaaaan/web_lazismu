<!doctype html>


<html lang="en">
    <head>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
        <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
        <title>@yield('title') - Lazismu BS</title>
        <!-- CSS files -->
        <link href="{{ asset('dist') }}/css/tabler.min.css?1668287865" rel="stylesheet"/>
        @yield('style')
        <link href="{{ asset('dist') }}/css/tabler-flags.min.css?1668287865" rel="stylesheet"/>
        <link href="{{ asset('dist') }}/css/tabler-payments.min.css?1668287865" rel="stylesheet"/>
        <link href="{{ asset('dist') }}/css/tabler-vendors.min.css?1668287865" rel="stylesheet"/>
        <link href="{{ asset('dist') }}/css/demo.min.css?1668287865" rel="stylesheet"/>
        <link rel="shortcut icon" href="{{ asset('dist/img/lazismu.png') }}" type="image/x-icon">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.6/css/buttons.dataTables.min.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
        <!-- Tautan CSS untuk Select2 -->
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <style>
        @import url('https://rsms.me/inter/inter.css');
        :root {
            --tblr-font-sans-serif: Inter, -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
        }
        #myChart {
            width: 800px;
            height: 400px;
            margin: 0 auto;
        }
        </style>
    </head>
    <body  class="layout-boxed">
        <script src="{{ asset('dist') }}/js/demo-theme.min.js?1668287865"></script>
        <div class="page">
        <!-- Navbar -->
        <div class="sticky-top">
            @include('partials.header')
            @include('partials.navbar')
        </div>
            <div class="page-wrapper">
                <!-- Page header -->
            @yield('content')
            @include('partials.footer')
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
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.flash.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js"></script>

        <script src="https://cdn.ckeditor.com/ckeditor5/35.4.0/classic/ckeditor.js"></script>

        <script type="text/javascript">
            $(document).ready(function () {
                $('#datatables').DataTable({
                });
            });
        </script>
        <script type="text/javascript">
            $(document).ready(function () {
                $('#table-datatables').DataTable({
                    dom: 'Bfrtip',
                    buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
                });
            });
        </script>
        <script>
            ClassicEditor
                .create( document.querySelector( '#editor' ))
                .catch( error => {
                    console.log( error );
                } );
        </script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.min.js"></script>
        <!-- Tautan JavaScript untuk Select2 -->
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        @yield('chart')
        @yield('select')
        @yield('pie')
    </body>
</html>
