<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Dashboard Admin - Desa Mamuju</title>

    <!-- plugins:css -->
    {{--start css--}}
    @include('layouts.admin.css')
    {{--end css--}}

    <!-- Tambahkan Font Awesome untuk ikon yang lebih variatif -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        /* Variabel CSS untuk warna konsisten */
        :root {
            --primary-color: #667eea;
            --secondary-color: #764ba2;
            --success-color: #28a745;
            --warning-color: #ffc107;
            --info-color: #17a2b8;
            --danger-color: #dc3545;
            --light-color: #f8f9fa;
            --dark-color: #343a40;
            --card-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            --hover-shadow: 0 8px 20px rgba(0, 0, 0, 0.12);
        }

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
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
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
            color: var(--primary-color);
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

        /* Perbaikan banner pro */
        #proBanner {
            background: linear-gradient(90deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            border-radius: 8px;
            margin-bottom: 25px;
            box-shadow: var(--card-shadow);
        }

        .purchase-popup {
            padding: 15px 20px;
            color: white;
            position: relative;
        }

        .download-button, .purchase-button {
            border-radius: 30px;
            font-weight: 600;
            padding: 8px 20px;
            transition: all 0.3s ease;
        }

        .download-button {
            background-color: rgba(255, 255, 255, 0.2);
            color: white;
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .download-button:hover {
            background-color: white;
            color: var(--primary-color);
        }

        .purchase-button {
            background-color: white;
            color: var(--primary-color);
        }

        .purchase-button:hover {
            background-color: var(--primary-color);
            color: white;
        }

        /* Styling untuk judul dashboard */
        .dashboard-title {
            color: var(--dark-color);
            font-weight: 700;
            position: relative;
            padding-bottom: 10px;
        }

        .dashboard-title::after {
            content: '';
            position: absolute;
            left: 0;
            bottom: 0;
            width: 70px;
            height: 4px;
            background: linear-gradient(90deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            border-radius: 2px;
        }

        /* Perbaikan card statistik */
        .card {
            border: none;
            border-radius: 12px;
            box-shadow: var(--card-shadow);
            transition: all 0.3s ease;
            overflow: hidden;
            height: 100%;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: var(--hover-shadow);
        }

        .card-body.text-center {
            padding: 25px 15px;
        }

        /* Gradien warna untuk setiap card statistik */
        .card:nth-child(1) {
            border-top: 4px solid var(--primary-color);
        }

        .card:nth-child(2) {
            border-top: 4px solid var(--info-color);
        }

        .card:nth-child(3) {
            border-top: 4px solid var(--warning-color);
        }

        .card:nth-child(4) {
            border-top: 4px solid var(--success-color);
        }

        /* Icon di dalam card statistik */
        .dashboard-progress {
            position: relative;
            height: 80px;
            margin: 15px 0;
        }

        .icon-md.absolute-center {
            font-size: 2.5rem;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        /* Warna ikon yang berbeda untuk setiap card */
        .card:nth-child(1) .icon-md {
            color: var(--primary-color) !important;
        }

        .card:nth-child(2) .icon-md {
            color: var(--info-color) !important;
        }

        .card:nth-child(3) .icon-md {
            color: var(--warning-color) !important;
        }

        .card:nth-child(4) .icon-md {
            color: var(--success-color) !important;
        }

        /* Progress bar stylings */
        .progress {
            height: 8px;
            border-radius: 4px;
            margin-top: 10px;
            background-color: #e9ecef;
        }

        .progress-bar {
            border-radius: 4px;
        }

        /* Tab styling */
        .nav-tabs.tab-transparent {
            border-bottom: 1px solid #dee2e6;
        }

        .nav-tabs.tab-transparent .nav-link {
            color: #6c757d;
            border: none;
            border-bottom: 3px solid transparent;
            padding: 10px 15px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .nav-tabs.tab-transparent .nav-link.active {
            color: var(--primary-color);
            border-bottom: 3px solid var(--primary-color);
            background-color: transparent;
        }

        .nav-tabs.tab-transparent .nav-link:hover {
            color: var(--primary-color);
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

            .purchase-popup {
                flex-direction: column;
                text-align: center;
            }

            .purchase-popup .btn {
                margin-top: 10px;
                width: 100%;
            }

            .dashboard-title {
                font-size: 1.5rem;
            }
        }

        /* Animasi untuk angka statistik */
        .counter-value {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--dark-color);
        }

        /* Label dan deskripsi statistik */
        .stat-label {
            font-size: 0.9rem;
            color: #6c757d;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 5px;
        }

        .stat-description {
            font-size: 0.85rem;
            color: #6c757d;
            margin-top: 8px;
        }

        /* Tambahan untuk footer */
        footer {
            margin-top: 30px;
            padding: 20px 0;
            background-color: #f8f9fa;
            border-top: 1px solid #e9ecef;
        }

        /* Badge untuk status */
        .status-badge {
            display: inline-block;
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        .badge-success {
            background-color: rgba(40, 167, 69, 0.1);
            color: var(--success-color);
        }

        .badge-warning {
            background-color: rgba(255, 193, 7, 0.1);
            color: var(--warning-color);
        }

        .badge-info {
            background-color: rgba(23, 162, 184, 0.1);
            color: var(--info-color);
        }

        /* Chart container */
        .chart-container {
            background-color: white;
            border-radius: 12px;
            padding: 20px;
            box-shadow: var(--card-shadow);
            margin-top: 30px;
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
                    <!-- Banner Promo -->
                    <div class="row" id="proBanner">
                        
                    </div>

                    <!-- Header Dashboard -->
                    <div class="d-xl-flex justify-content-between align-items-start mb-4">
                        <div>
                            <h1 class="dashboard-title">Dashboard Overview</h1>
                            <p class="text-muted">Selamat datang di dashboard admin Desa Mamuju. Pantau perkembangan desa secara real-time.</p>
                        </div>
                        <div class="d-sm-flex justify-content-xl-between align-items-center mb-2">

                        </div>
                    </div>

                    <!-- Tabs Navigasi -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="d-sm-flex justify-content-between align-items-center transaparent-tab-border">
                                <ul class="nav nav-tabs tab-transparent" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#" role="tab" aria-selected="true">
                                            <i class="fas fa-chart-bar mr-2"></i> Data Statistik
                                        </a>
                                    </li>


                                </ul>

                            </div>

                            <!-- Konten Tabs -->
                            <div class="tab-content tab-transparent-content mt-4">
                                <div class="tab-pane fade show active" id="business-1" role="tabpanel" aria-labelledby="business-tab">
                                    <!-- Statistik Cards -->
                                    <div class="row">
                                        <!-- Total Warga -->
                                        <div class="col-xl-3 col-lg-6 col-sm-6 grid-margin stretch-card">
                                            <div class="card">
                                                <div class="card-body text-center">
                                                    <div class="stat-label">Total Warga</div>
                                                    <h2 class="counter-value mb-3" id="totalWarga">1,254</h2>
                                                    <div class="dashboard-progress dashboard-progress-1 d-flex align-items-center justify-content-center item-parent">
                                                        <i class="fas fa-users icon-md absolute-center text-dark"></i>
                                                    </div>
                                                    <div class="d-flex justify-content-between align-items-center mt-3">
                                                        <div class="text-left">
                                                            <p class="stat-description mb-1">Tercatat Sempurna</p>
                                                            <h4 class="mb-0 font-weight-bold">5,443</h4>
                                                        </div>
                                                        <span class="status-badge badge-success">
                                                            <i class="fas fa-check-circle mr-1"></i> 100%
                                                        </span>
                                                    </div>
                                                    <div class="progress mt-2">
                                                        <div class="progress-bar bg-primary" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Pengaduan Baru -->
                                        <div class="col-xl-3 col-lg-6 col-sm-6 grid-margin stretch-card">
                                            <div class="card">
                                                <div class="card-body text-center">
                                                    <div class="stat-label">Pengaduan Baru</div>
                                                    <h2 class="counter-value mb-3" id="pengaduanBaru">42</h2>
                                                    <div class="dashboard-progress dashboard-progress-2 d-flex align-items-center justify-content-center item-parent">
                                                        <i class="fas fa-exclamation-circle icon-md absolute-center text-dark"></i>
                                                    </div>
                                                    <div class="d-flex justify-content-between align-items-center mt-3">
                                                        <div class="text-left">
                                                            <p class="stat-description mb-1">Persentase Penanganan</p>
                                                            <h4 class="mb-0 font-weight-bold">50%</h4>
                                                        </div>
                                                        <span class="status-badge badge-warning">
                                                            <i class="fas fa-clock mr-1"></i> Dalam Proses
                                                        </span>
                                                    </div>
                                                    <div class="progress mt-2">
                                                        <div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Dalam Proses -->
                                        <div class="col-xl-3 col-lg-6 col-sm-6 grid-margin stretch-card">
                                            <div class="card">
                                                <div class="card-body text-center">
                                                    <div class="stat-label">Dalam Proses</div>
                                                    <h2 class="counter-value mb-3" id="dalamProses">38</h2>
                                                    <div class="dashboard-progress dashboard-progress-3 d-flex align-items-center justify-content-center item-parent">
                                                        <i class="fas fa-tasks icon-md absolute-center text-dark"></i>
                                                    </div>
                                                    <div class="d-flex justify-content-between align-items-center mt-3">
                                                        <div class="text-left">
                                                            <p class="stat-description mb-1">Persentase Penyelesaian</p>
                                                            <h4 class="mb-0 font-weight-bold">35%</h4>
                                                        </div>
                                                        <span class="status-badge badge-info">
                                                            <i class="fas fa-spinner mr-1"></i> 35% Selesai
                                                        </span>
                                                    </div>
                                                    <div class="progress mt-2">
                                                        <div class="progress-bar bg-warning" role="progressbar" style="width: 35%" aria-valuenow="35" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Pemasukan Desa -->
                                        <div class="col-xl-3 col-lg-6 col-sm-6 grid-margin stretch-card">
                                            <div class="card">
                                                <div class="card-body text-center">
                                                    <div class="stat-label">Pemasukan Desa</div>
                                                    <h2 class="counter-value mb-3" id="pemasukanDesa">4.000 JT</h2>
                                                    <div class="dashboard-progress dashboard-progress-4 d-flex align-items-center justify-content-center item-parent">
                                                        <i class="fas fa-wallet icon-md absolute-center text-dark"></i>
                                                    </div>
                                                    <div class="d-flex justify-content-between align-items-center mt-3">
                                                        <div class="text-left">
                                                            <p class="stat-description mb-1">Persentase Target</p>
                                                            <h4 class="mb-0 font-weight-bold">30%</h4>
                                                        </div>
                                                        <span class="status-badge badge-success">
                                                            <i class="fas fa-chart-line mr-1"></i> +12% Bulan Lalu
                                                        </span>
                                                    </div>
                                                    <div class="progress mt-2">
                                                        <div class="progress-bar bg-success" role="progressbar" style="width: 30%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Chart Container (Placeholder) -->
                                    <div class="row mt-4">

                                    </div>

                                    <!-- Quick Stats -->
                                    <div class="row mt-4">
                                        <div class="col-lg-4 grid-margin stretch-card">
                                            <div class="card">
                                                <div class="card-body">
                                                    <h4 class="card-title">Ringkasan Cepat</h4>
                                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                                        <span>Kepuasan Warga</span>
                                                        <span class="font-weight-bold">85%</span>
                                                    </div>
                                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                                        <span>Program Berjalan</span>
                                                        <span class="font-weight-bold">12</span>
                                                    </div>
                                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                                        <span>Rata-rata Respons Pengaduan</span>
                                                        <span class="font-weight-bold">2.5 Hari</span>
                                                    </div>
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <span>Pertumbuhan Ekonomi</span>
                                                        <span class="font-weight-bold text-success">+5.2%</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-8 grid-margin stretch-card">
                                            <div class="card">
                                                <div class="card-body">
                                                    <h4 class="card-title">Aktivitas Terbaru</h4>
                                                    <div class="activity-feed">
                                                        <div class="feed-item d-flex align-items-start mb-3">
                                                            <div class="feed-icon mr-3">
                                                                <i class="fas fa-user-check text-success"></i>
                                                            </div>
                                                            <div class="feed-content">
                                                                <p class="mb-1"><strong>25 data warga</strong> telah diverifikasi hari ini</p>
                                                                <small class="text-muted">2 jam yang lalu</small>
                                                            </div>
                                                        </div>
                                                        <div class="feed-item d-flex align-items-start mb-3">
                                                            <div class="feed-icon mr-3">
                                                                <i class="fas fa-exclamation-triangle text-warning"></i>
                                                            </div>
                                                            <div class="feed-content">
                                                                <p class="mb-1"><strong>3 pengaduan baru</strong> masuk tentang infrastruktur jalan</p>
                                                                <small class="text-muted">5 jam yang lalu</small>
                                                            </div>
                                                        </div>
                                                        <div class="feed-item d-flex align-items-start mb-3">
                                                            <div class="feed-icon mr-3">
                                                                <i class="fas fa-money-bill-wave text-success"></i>
                                                            </div>
                                                            <div class="feed-content">
                                                                <p class="mb-1"><strong>Pemasukan desa</strong> meningkat 12% dibanding bulan lalu</p>
                                                                <small class="text-muted">1 hari yang lalu</small>
                                                            </div>
                                                        </div>
                                                        <div class="feed-item d-flex align-items-start">
                                                            <div class="feed-icon mr-3">
                                                                <i class="fas fa-clipboard-check text-primary"></i>
                                                            </div>
                                                            <div class="feed-content">
                                                                <p class="mb-1"><strong>5 pengaduan</strong> telah diselesaikan dengan baik</p>
                                                                <small class="text-muted">2 hari yang lalu</small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
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

    <!-- Tambahan JavaScript untuk animasi dan interaksi -->
    <script>
        // Animasi counter untuk statistik
        document.addEventListener('DOMContentLoaded', function() {
            // Animasi counter untuk angka statistik
            function animateCounter(elementId, finalValue, duration = 2000) {
                const element = document.getElementById(elementId);
                if (!element) return;

                let startValue = 0;
                const increment = finalValue / (duration / 16); // 60fps
                const counter = setInterval(() => {
                    startValue += increment;
                    if (startValue >= finalValue) {
                        element.textContent = finalValue.toLocaleString();
                        clearInterval(counter);
                    } else {
                        // Format angka dengan koma
                        element.textContent = Math.floor(startValue).toLocaleString();
                    }
                }, 16);
            }

            // Jalankan animasi untuk setiap counter
            animateCounter('totalWarga', 1254);
            animateCounter('pengaduanBaru', 42);
            animateCounter('dalamProses', 38);
            // Untuk pemasukan desa, kita perlu penanganan khusus karena ada "JT"
            const pemasukanElement = document.getElementById('pemasukanDesa');
            if (pemasukanElement) {
                pemasukanElement.textContent = '4.000 JT';
            }

            // Tutup banner promosi
            const bannerClose = document.getElementById('bannerClose');
            if (bannerClose) {
                bannerClose.addEventListener('click', function() {
                    document.getElementById('proBanner').style.display = 'none';
                });
            }

            // Tooltip initialization
            const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-toggle="tooltip"]'));
            tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });

            // Tab navigation
            const tabLinks = document.querySelectorAll('.nav-tabs .nav-link');
            tabLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    // Remove active class from all tabs
                    tabLinks.forEach(tab => tab.classList.remove('active'));
                    // Add active class to clicked tab
                    this.classList.add('active');

                    // Di sini Anda bisa menambahkan logika untuk menampilkan konten yang sesuai
                    // Misalnya dengan menampilkan/menyembunyikan elemen berdasarkan tab yang diklik
                });
            });

            // Card hover effect enhancement
            const cards = document.querySelectorAll('.card');
            cards.forEach(card => {
                card.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-8px)';
                });

                card.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0)';
                });
            });

            // Update tanggal dan waktu
            function updateDateTime() {
                const now = new Date();
                const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
                const dateString = now.toLocaleDateString('id-ID', options);
                const timeString = now.toLocaleTimeString('id-ID');

                // Anda bisa menambahkan elemen untuk menampilkan tanggal dan waktu di header
                // Contoh: document.getElementById('currentDateTime').textContent = `${dateString} ${timeString}`;
            }

            updateDateTime();
            setInterval(updateDateTime, 60000); // Update setiap menit
        });
    </script>
</body>
</html>
