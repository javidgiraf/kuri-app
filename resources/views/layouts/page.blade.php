<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta name='csrf-token' content='{{csrf_token() }}'>

    <title>Dashboard - My Kuri App</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="{{asset('assets/img/favicon.png')}}" rel="icon">
    <link href="{{asset('assets/img/apple-touch-icon.png')}}" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{asset('assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
    <link href="{{asset('assets/vendor/boxicons/css/boxicons.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/vendor/quill/quill.snow.css')}}" rel="stylesheet">
    <link href="{{asset('assets/vendor/quill/quill.bubble.css')}}" rel="stylesheet">
    <link href="{{asset('assets/vendor/remixicon/remixicon.css')}}" rel="stylesheet">
    <link href="{{asset('assets/vendor/simple-datatables/style.css')}}" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="{{asset('assets/css/style.css')}}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/toastr@2.1.4/build/toastr.min.css" rel="stylesheet">
    @stack('styles')
    @livewireStyles

</head>

<body>
    @include('layouts.partials._header')
    @include('layouts.partials._sidebar')
    @yield('content')


    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer" style="position: fixed;
   left: 0;
   bottom: 0;
   width: 100%;
    background-color: #f0f4fc;
   color: white;
   text-align: center;">
        <div class="copyright">
            &copy; Copyright <strong><span>Designed by <a href="https://giraf.in/">Giraf</a></span></strong>. All Rights Reserved
        </div>

    </footer><!-- End Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="{{asset('assets/vendor/apexcharts/apexcharts.min.js')}}"></script>
    <script src="{{asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('assets/vendor/chart.js/chart.umd.js')}}"></script>
    <script src="{{asset('assets/vendor/echarts/echarts.min.js')}}"></script>
    <script src="{{asset('assets/vendor/quill/quill.min.js')}}"></script>
    <script src="{{asset('assets/vendor/simple-datatables/simple-datatables.js')}}"></script>
    <script src="{{asset('assets/vendor/tinymce/tinymce.min.js')}}"></script>
    <script src="{{asset('assets/vendor/php-email-form/validate.js')}}"></script>

    <!-- Template Main JS File -->
    <script src="{{asset('assets/js/main.js')}}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/toastr@2.1.4/toastr.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script type="text/javascript">
        $('#user_id').select2({
            placeholder: 'Select users',
        });

        $('#scheme_id').select2({
            placeholder: 'Select Schemes',
        });

        $('#order_id').select2({
            placeholder: 'Select Order',
        });

        $('#status').select2({
            placeholder: 'Select Status',
        });

        $('#users').select2({
            placeholder: 'Select User',
        });

        $('#user_subscription_id').select2({
            placeholder: 'Select User Subscription',
        });

        $('#transaction_no').select2({
            placeholder: 'Select Transaction',
        });

        $("#mature_status").select2({
            placeholder: 'Select Maturity Status'
        });

        $("#scheme_status").select2({
            placeholder: 'Select Status' 
        });

        $("select[name='country_id']").select2({
            placeholder: 'Select a Country'
        });

        $("select[name='state_id']").select2({
            placeholder: 'Select a State'
        });
    </script>
    @stack('scripts')
    @livewireScripts
    <script>
        $('#user_id').on("select2:unselect", function(e) {
            $(this).val(null).trigger('change');
        });

        $('#scheme_id').on("select2:unselect", function(e) {
            $(this).val(null).trigger('change');
        });

        $('#order_id').on("select2:unselect", function(e) {
            $(this).val(null).trigger('change');
        });

        $('#status').on("select2:unselect", function(e) {
            $(this).val(null).trigger('change');
        });
    </script>




</body>

</html>
