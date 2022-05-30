<!doctype html>

<html lang="en">



<head>

    <meta charset="utf-8" />

    <title>Science Clinic</title>

    <meta name="description" content="Metronic admin dashboard live demo. Check out all the features of the admin panel. A large number of settings, additional services and widgets." />

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!--begin::Fonts-->

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />

    <!--end::Fonts-->

    <!--begin::Page Vendors Styles(used by this page)-->

    <link href="{{asset('assets/plugins/custom/fullcalendar/fullcalendar.bundle.css')}}" rel="stylesheet" type="text/css" />

    <!--end::Page Vendors Styles-->

    <!--begin::Global Theme Styles(used by all pages)-->

    <link href="{{asset('assets/plugins/global/plugins.bundle.css')}}" rel="stylesheet" type="text/css" />

    <link href="{{asset('assets/plugins/custom/prismjs/prismjs.bundle.css')}}" rel="stylesheet" type="text/css" />

    <link href="{{asset('assets/css/style.bundle.css')}}" rel="stylesheet" type="text/css" />

    <!--end::Global Theme Styles-->

    <!--begin::Layout Themes(used by all pages)-->

    <link href="{{asset('assets/css/themes/layout/header/base/light.css')}}" rel="stylesheet" type="text/css" />

    <link href="{{asset('assets/css/themes/layout/header/menu/light.css')}}" rel="stylesheet" type="text/css" />

    <link href="{{asset('assets/css/themes/layout/brand/dark.css')}}" rel="stylesheet" type="text/css" />

    <link href="{{asset('assets/css/themes/layout/aside/dark.css')}}" rel="stylesheet" type="text/css" />

    <link href="{{asset('assets/css/pages/jquery-confirm.css')}}" rel="stylesheet" type="text/css" />

    <!--end::Layout Themes-->

    <link rel="shortcut icon" href="{{ asset('front/img/favicon.ico')}}" />

    <script src="https://cdn.ckeditor.com/4.5.11/standard/ckeditor.js"></script>

    <link href="{{asset('assets/css/custom.css')}}" rel="stylesheet" type="text/css" />
    @yield('page-css')

</head>



<body id="kt_body" class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading">

    <!-- Begin page -->

    <div class="d-flex flex-column flex-root">

        <!--begin::Page-->

        <div class="d-flex flex-row flex-column-fluid page">

            @if(Auth::user()->type == 1)
            <div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">

                @include('admin.elements.header')

                @include('admin.elements.sidebar')

                <div class="content d-flex flex-column flex-column-fluid" id="kt_content">

                    @yield('content')

                </div>

                @include('admin.elements.footer')

            </div>
            @elseif(Auth::user()->type == 2)
            <div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">

                @include('common.elements.header')

                @include('common.elements.sidebar')

                <div class="content d-flex flex-column flex-column-fluid" id="kt_content">

                    @yield('content')

                </div>

                @include('common.elements.footer')

            </div>
            @elseif(Auth::user()->type == 3)
            <div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">

                @include('common.elements.header')

                @include('common.elements.sidebar')

                <div class="content d-flex flex-column flex-column-fluid" id="kt_content">

                    @yield('content')

                </div>

                @include('common.elements.footer')

            </div>
            @endif

        </div>

    </div>

    <!-- JAVASCRIPT -->

    <!--begin::Global Theme Bundle(used by all pages)-->

    <script src="{{asset('assets/plugins/global/plugins.bundle.js')}}"></script>

    <script src="{{asset('assets/plugins/custom/prismjs/prismjs.bundle.js')}}"></script>

    <script src="{{asset('assets/js/scripts.bundle.js')}}"></script>

    <!--end::Global Theme Bundle-->

    <!--begin::Page Vendors(used by this page)-->

    <script src="{{asset('assets/plugins/custom/fullcalendar/fullcalendar.bundle.js')}}"></script>



    <!--end::Page Vendors-->

    <!--begin::Page Scripts(used by this page)-->

    <script src="{{asset('assets/js/pages/widgets.js')}}"></script>

    <script src="{{asset('assets/js/pages/jquery-confirm.js')}}"></script>

    <!--end::Page Scripts-->



    @yield('page-js')

    @if(Session::has('success'))

    <script>
        Command: toastr["success"]("{{Session::get('success')}}")
    </script>

    @endif



    @if(Session::has('error'))

    <script>
        Command: toastr["error"]("{{Session::get('error')}}")
    </script>

    @endif

    @include('admin.elements.message-js')

    <script>
        window.addEventListener("pageshow", function(event) {

            var historyTraversal = event.persisted ||

                (typeof window.performance != "undefined" &&

                    window.performance.navigation.type === 2);

            if (historyTraversal) {

                // Handle page restore.

                window.location.reload();

            }

        });
    </script>

    <!--begin::Global Config(global config for global JS scripts)-->

    <script>
        var KTAppSettings = {

            "breakpoints": {

                "sm": 576,

                "md": 768,

                "lg": 992,

                "xl": 1200,

                "xxl": 1400

            },

            "colors": {

                "theme": {

                    "base": {

                        "white": "#ffffff",

                        "primary": "#3699FF",

                        "secondary": "#E5EAEE",

                        "success": "#1BC5BD",

                        "info": "#8950FC",

                        "warning": "#FFA800",

                        "danger": "#F64E60",

                        "light": "#E4E6EF",

                        "dark": "#181C32"

                    },

                    "light": {

                        "white": "#ffffff",

                        "primary": "#E1F0FF",

                        "secondary": "#EBEDF3",

                        "success": "#C9F7F5",

                        "info": "#EEE5FF",

                        "warning": "#FFF4DE",

                        "danger": "#FFE2E5",

                        "light": "#F3F6F9",

                        "dark": "#D6D6E0"

                    },

                    "inverse": {

                        "white": "#ffffff",

                        "primary": "#ffffff",

                        "secondary": "#3F4254",

                        "success": "#ffffff",

                        "info": "#ffffff",

                        "warning": "#ffffff",

                        "danger": "#ffffff",

                        "light": "#464E5F",

                        "dark": "#ffffff"

                    }

                },

                "gray": {

                    "gray-100": "#F3F6F9",

                    "gray-200": "#EBEDF3",

                    "gray-300": "#E4E6EF",

                    "gray-400": "#D1D3E0",

                    "gray-500": "#B5B5C3",

                    "gray-600": "#7E8299",

                    "gray-700": "#5E6278",

                    "gray-800": "#3F4254",

                    "gray-900": "#181C32"

                }

            },

            "font-family": "Poppins"

        };
    </script>

    <!--end::Global Config-->

</body>



</html>