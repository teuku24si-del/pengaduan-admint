<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Desa Mamuju - Dashboard</title>
    <!-- plugins:css -->
    {{--start css--}}
   @include('layouts.admin.css')
    {{--end css--}}
    <!-- End layout styles -->
    <link rel="shortcut icon" href="assets/images/favicon.png" />

    <style>
        /* Styling tambahan untuk avatar di header */
        .nav-profile-img {
            display: flex;
            align-items: center;
            margin-right: 10px;
        }

        .avatar-sm {
            width: 36px;
            height: 36px;
        }

        .avatar-sm .avatar-title {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            height: 100%;
            font-weight: 600;
            font-size: 1rem;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 50%;
        }

        .avatar-lg .avatar-title {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 80px;
            height: 80px;
            font-weight: 700;
            font-size: 2rem;
            background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
            color: #667eea;
            border-radius: 50%;
            border: 3px solid #ffffff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        /* Memastikan navbar-item tetap sejajar */
        .navbar-nav-right {
            display: flex;
            align-items: center;
        }

        .nav-item.nav-profile {
            display: flex;
            align-items: center;
        }

        /* Responsive design */
        @media (max-width: 768px) {
            .avatar-sm {
                width: 32px;
                height: 32px;
            }

            .avatar-sm .avatar-title {
                font-size: 0.9rem;
            }

            .avatar-lg .avatar-title {
                width: 60px;
                height: 60px;
                font-size: 1.5rem;
            }
        }
    </style>
</head>

<body>
    <div class="container-scroller">
        <!-- partial:partials/_navbar.html -->
        {{--start Header--}}
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
                <div class="content-wrapper">
                    <div class="row" id="proBanner">
                        <div class="col-12">
                            <span class="d-flex align-items-center purchase-popup">
                                <p>Like what you see? Check out our premium version for more.</p>
                                <a href="https://github.com/BootstrapDash/ConnectPlusAdmin-Free-Bootstrap-Admin-Template"
                                    target="_blank" class="btn ml-auto download-button">Download Free Version</a>
                                <a href="http://www.bootstrapdash.com/demo/connect-plus/jquery/template/"
                                    target="_blank" class="btn purchase-button">Upgrade To Pro</a>
                                <i class="mdi mdi-close" id="bannerClose"></i>
                            </span>
                        </div>
                    </div>
                    <div class="d-xl-flex justify-content-between align-items-start">
                        <h2 class="text-dark font-weight-bold mb-2"> Dashboard Overview </h2>
                        <div class="d-sm-flex justify-content-xl-between align-items-center mb-2">


                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div
                                class="d-sm-flex justify-content-between align-items-center transaparent-tab-border {">
                                <ul class="nav nav-tabs tab-transparent" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link" id="home-tab" data-toggle="tab" href="#"
                                            role="tab" aria-selected="true">Data</a>
                                    </li>



                                </ul>
                                <div class="d-md-block d-none">
                                    <a href="#" class="text-light p-1"><i
                                            class="mdi mdi-view-dashboard"></i></a>
                                    <a href="#" class="text-light p-1"><i
                                            class="mdi mdi-dots-vertical"></i></a>
                                </div>
                            </div>
                            <div class="tab-content tab-transparent-content">
                                <div class="tab-pane fade show active" id="business-1" role="tabpanel"
                                    aria-labelledby="business-tab">
                                    <div class="row">
                                        <div class="col-xl-3 col-lg-6 col-sm-6 grid-margin stretch-card">
                                            <div class="card">
                                                <div class="card-body text-center">
                                                    <h5 class="mb-2 text-dark font-weight-normal">Total Warga</h5>
                                                    <h2 class="mb-4 text-dark font-weight-bold">1,254</h2>
                                                    <div
                                                        class="dashboard-progress dashboard-progress-1 d-flex align-items-center justify-content-center item-parent">
                                                        <i
                                                            class="mdi mdi-lightbulb icon-md absolute-center text-dark"></i>
                                                    </div>
                                                    <p class="mt-4 mb-0">Completed</p>
                                                    <h3 class="mb-0 font-weight-bold mt-2 text-dark">5443</h3>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-3 col-lg-6 col-sm-6 grid-margin stretch-card">
                                            <div class="card">
                                                <div class="card-body text-center">
                                                    <h5 class="mb-2 text-dark font-weight-normal">Pengaduan Baru</h5>
                                                    <h2 class="mb-4 text-dark font-weight-bold">42</h2>
                                                    <div
                                                        class="dashboard-progress dashboard-progress-2 d-flex align-items-center justify-content-center item-parent">
                                                        <i
                                                            class="mdi mdi-account-circle icon-md absolute-center text-dark"></i>
                                                    </div>
                                                    <p class="mt-4 mb-0">Percent</p>
                                                    <h3 class="mb-0 font-weight-bold mt-2 text-dark">50%</h3>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-3  col-lg-6 col-sm-6 grid-margin stretch-card">
                                            <div class="card">
                                                <div class="card-body text-center">
                                                    <h5 class="mb-2 text-dark font-weight-normal">Dalam Proses</h5>
                                                    <h2 class="mb-4 text-dark font-weight-bold">38</h2>
                                                    <div
                                                        class="dashboard-progress dashboard-progress-3 d-flex align-items-center justify-content-center item-parent">
                                                        <i class="mdi mdi-eye icon-md absolute-center text-dark"></i>
                                                    </div>
                                                    <p class="mt-4 mb-0">Percent</p>
                                                    <h3 class="mb-0 font-weight-bold mt-2 text-dark">35%</h3>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-3 col-lg-6 col-sm-6 grid-margin stretch-card">
                                            <div class="card">
                                                <div class="card-body text-center">
                                                    <h5 class="mb-2 text-dark font-weight-normal">Pemasukan desa</h5>
                                                    <h2 class="mb-4 text-dark font-weight-bold">4.000JT</h2>
                                                    <div
                                                        class="dashboard-progress dashboard-progress-4 d-flex align-items-center justify-content-center item-parent">
                                                        <i class="mdi mdi-cube icon-md absolute-center text-dark"></i>
                                                    </div>
                                                    <p class="mt-4 mb-0">Percent</p>
                                                    <h3 class="mb-0 font-weight-bold mt-2 text-dark">30%</h3>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 grid-margin">

                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                 {{--end main content--}}




                <!-- content-wrapper ends -->
                <!-- partial:partials/_footer.html -->
                {{--start footer--}}
                @include('layouts.admin.footer')
                {{--end footer--}}


                <!-- partial -->
            </div>


        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    {{--start js--}}
    @include('layouts.admin.js')
    <!-- End custom js for this page -->
    {{--end js--}}
</body>

</html>
