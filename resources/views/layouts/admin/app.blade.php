<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Connect Plus - Data Warga</title>
    <!-- plugins:css -->
    {{--start css--}}
    @include('layouts.admin.css')
    {{--end css--}}
    <!-- End layout styles -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}" />
</head>

<body>
    <div class="container-scroller">
        <!-- partial:partials/_navbar.html -->
        {{--start header--}}
       @include('layouts.admin.header')
       {{--end header--}}
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_sidebar.html -->
            {{--start sidebar--}}
           @include('layouts.admin.sidebar')
            {{--end sidebar--}}
            <!-- partial -->
            <div class="main-panel">
                {{--start main content--}}
               @yield('content')
                {{--end main content--}}
                <!-- content-wrapper ends -->
                <!-- partial:partials/_footer.html -->
                {{--start footer--}}
                @include('layouts.admin.footer')
                {{--end footer--}}
                <!-- partial -->
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    {{--start js--}}
   @include('layouts.admin.js')
    <!-- endinject -->
    {{--end js--}}
</body>

</html>
