<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>@yield('title') - {{ get_setting('site_name') }}</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('dashboard/assets/img/favicon.ico') }}"/>
    <link href="{{ asset('dashboard/assets/css/loader.css') }}" rel="stylesheet" type="text/css"/>
    <script src="{{ asset('dashboard/assets/js/loader.js') }}"></script>

    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link href="{{ asset('dashboard/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('dashboard/assets/css/plugins.css') }}" rel="stylesheet" type="text/css"/>
    <!-- END GLOBAL MANDATORY STYLES -->

    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM STYLES -->
    <link href="{{ asset('dashboard/plugins/notification/snackbar/snackbar.min.css') }}" rel="stylesheet" type="text/css" />
    @stack('styles')
    <!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES -->

</head>
<body>
<!-- BEGIN LOADER -->
<div id="load_screen">
    <div class="loader">
        <div class="loader-content">
            <div class="spinner-grow align-self-center"></div>
        </div>
    </div>
</div>
<!--  END LOADER -->

<!--  BEGIN NAVBAR  -->
@include('layouts.partials.header')
<!--  END NAVBAR  -->

<!--  BEGIN MAIN CONTAINER  -->
<div class="main-container" id="container">

    <div class="overlay"></div>
    <div class="search-overlay"></div>

    <!--  BEGIN SIDEBAR  -->
    @include('layouts.partials.sidebar')
    <!--  END SIDEBAR  -->

    <!--  BEGIN CONTENT AREA  -->
    <div id="content" class="main-content">
        <div class="layout-px-spacing">
            <div class="layout-top-spacing">
                @section('content')
                @show
            </div>
        </div>

        @include('layouts.partials.footer')
    </div>
    <!--  END CONTENT AREA  -->


</div>
<!-- END MAIN CONTAINER -->

<!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
<script src="{{ asset('dashboard/assets/js/libs/jquery-3.1.1.min.js') }}"></script>
<script src="{{ asset('dashboard/bootstrap/js/popper.min.js') }}"></script>
<script src="{{ asset('dashboard/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('dashboard/plugins/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
<script src="{{ asset('dashboard/assets/js/app.js') }}"></script>
<script>
    $(document).ready(function () {
        App.init();
    });
</script>
<script src="{{ asset('dashboard/assets/js/custom.js') }}"></script>
<!-- END GLOBAL MANDATORY SCRIPTS -->
@if (session()->has('toast'))
    <script src="{{ asset('dashboard/plugins/notification/snackbar/snackbar.min.js') }}"></script>
    <script>
        let toast_type = '{{ session()->get('toast')['type'] }}';
        let toast_message = '{{ session()->get('toast')['msg'] }}';
        switch (toast_type) {
            case 'primary':
                Snackbar.show({
                    text: toast_message,
                    actionTextColor: '#fff',
                    backgroundColor: '#4361ee'
                });
                break;
            case 'info':
                Snackbar.show({
                    text: toast_message,
                    actionTextColor: '#fff',
                    backgroundColor: '#2196f3'
                });
                break;
            case 'success':
                Snackbar.show({
                    text: toast_message,
                    actionTextColor: '#fff',
                    backgroundColor: '#1abc9c'
                });
                break;
            case 'warning':
                Snackbar.show({
                    text: toast_message,
                    actionTextColor: '#fff',
                    backgroundColor: '#e2a03f'
                });
                break;
            case 'danger':
                Snackbar.show({
                    text: toast_message,
                    actionTextColor: '#fff',
                    backgroundColor: '#e7515a'
                });
                break;

            default:
                Snackbar.show({
                    text: toast_message,
                    actionTextColor: '#fff',
                    backgroundColor: '#3b3f5c'
                });
                break;
        }
    </script>
@endif
<!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
@stack('scripts')
<!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->

</body>
</html>
