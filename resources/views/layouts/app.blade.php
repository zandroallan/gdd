<!doctype html>
<html lang="{{ app()->getLocale() }}"  data-layout="horizontal" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable">
    <head>
        <meta charset="utf-8" />
        <title>Gdd | Web</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
        <meta content="Themesbrand" name="author" />

        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ asset('velzon/images/favicon.ico') }}">
        <!-- jsvectormap css -->
        <link rel="stylesheet" type="text/css" href="{{ asset('velzon/libs/jsvectormap/css/jsvectormap.min.css') }}" />
        <!--Swiper slider css-->
        <link rel="stylesheet" type="text/css" href="{{ asset('velzon/libs/swiper/swiper-bundle.min.css') }}" />
        <!-- Layout config Js -->
        <script src="{{ asset('velzon/js/layout.js') }}"></script>
        <!-- Bootstrap Css -->
        <link rel="stylesheet" type="text/css" href="{{ asset('velzon/css/bootstrap.min.css') }}" />
        <!-- Icons Css -->
        <link rel="stylesheet" type="text/css" href="{{ asset('velzon/css/icons.min.css') }}" />
        <!-- App Css-->
        <link rel="stylesheet" type="text/css" href="{{ asset('velzon/css/app.min.css') }}" />
        <!-- custom Css-->
        <link rel="stylesheet" type="text/css" href="{{ asset('velzon/css/custom.min.css') }}" />
        <link rel="stylesheet" type="text/css" href="{{ asset('velzon/libs/sweetalert2/sweetalert2.min.css') }}">

        @yield('css')

        <style>
            .select2-selection__rendered {
                line-height: 60px !important;
            }
            .select2-container .select2-selection--single {
                height: 65px !important;
            }
            .select2-selection__arrow {
                height: 65px !important;
            }
            .bg-thead {
                background-color: #eff3f6  !important;
            }
        </style>

    </head>
    <body>
        <div id="layout-wrapper">

            @include('layouts.menu')

            <div class="main-content">
                <div class="page-content">
                    <div class="container-fluid">
                        
                        @yield('page-title')
                        
                        @yield('content')

                    </div>                    
                </div>
            </div>

            @include('layouts.footer')

        </div>
        <!-- jquery -->     
        <script src="{{ asset('velzon/js/jquery.min.js') }}"></script>

        <script src="{{ asset('velzon/libs/sweetalert2/sweetalert2.min.js') }}"></script>
        <script src="{{ asset('velzon/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('velzon/libs/simplebar/simplebar.min.js') }}"></script>
        <script src="{{ asset('velzon/libs/node-waves/waves.min.js') }}"></script>
        <script src="{{ asset('velzon/libs/feather-icons/feather.min.js') }}"></script>
        <script src="{{ asset('velzon/js/pages/plugins/lord-icon-2.1.0.js') }}"></script>
        <script src="{{ asset('velzon/js/plugins.js') }}"></script>
        <!-- App js -->
        <script src="{{ asset('velzon/js/app.js') }}"></script>
        <!-- Personal Js-Script -->
        <script src="{{ asset('js/tools.js') }}"></script>
        <script>var vuri=window.location.origin;</script>

        @yield('js')

        <script type="text/javascript">
            @yield('script')
        </script>

    </body>
</html>