
@extends('layouts.admin.app')

@section('content')
    {{-- start main content --}}
    <div class="content-wrapper">
        <div class="row" id="proBanner">
            <div class="col-12">
                <span class="d-flex align-items-center purchase-popup">
                    <p>Like what you see? Check out our premium version for more.</p>
                    <a href="https://github.com/BootstrapDash/ConnectPlusAdmin-Free-Bootstrap-Admin-Template" target="_blank"
                        class="btn ml-auto download-button">Download Free Version</a>
                    <a href="http://www.bootstrapdash.com/demo/connect-plus/jquery/template/" target="_blank"
                        class="btn purchase-button">Upgrade To Pro</a>
                    <i class="mdi mdi-close" id="bannerClose"></i>
                </span>
            </div>
        </div>

        <div class="d-xl-flex justify-content-between align-items-start mb-4">
            <h2 class="text-dark font-weight-bold mb-2">Data Pengaduan</h2>
            <div class="d-flex gap-2">
                <a href="{{ route('Pengaduan.create') }}" class="btn btn-primary">
                    <i class="mdi mdi-plus-circle mr-1"></i> Tambah Pengaduan
                </a>
                <a href="{{ route('dashboard') }}" class="btn btn-light">
                    <i class="mdi mdi-arrow-left"></i> Kembali
                </a>
            </div>
        </div>

        <!-- Alert Success -->
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="mdi mdi-check-circle-outline"></i> {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="mdi mdi-alert-circle-outline"></i> {{ session('error') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div>
                                <h4 class="card-title mb-0">Daftar Pengaduan Warga</h4>
                                <p class="card-description mb-0">Kelola semua pengaduan yang masuk dari warga</p>
                            </div>
                            <div class="badge badge-info p-2">
                                Total: {{ $dataPengaduan->total() }} Pengaduan
                            </div>
                        </div>

                        <!-- Filter dan Search Section -->
                        <div class="card mb-4">
                            <div class="card-body py-3">
                                <form method="GET" action="{{ route('Pengaduan.index') }}" class="row g-3 align-items-center">
                                    <div class="col-md-2">
                                        <label class="form-label mb-0">Filter Status</label>
                                        <select name="status" class="form-select" onchange="this.form.submit()">
                                            <option value="">Semua Status</option>
                                            <option value="sedang_diproses"
                                                {{ request('status') == 'sedang_diproses' ? 'selected' : '' }}>
                                                Sedang Diproses
                                            </option>
                                            <option value="sudah_selesai"
                                                {{ request('status') == 'sudah_selesai' ? 'selected' : '' }}>
                                                Sudah Selesai
                                            </option>
                                        </select>
                                    </div>

                                    <div class="col-md-4">
                                        <label class="form-label mb-0">Cari Pengaduan</label>
                                        <div class="input-group">
                                            <input type="text" name="search" class="form-control"
                                                value="{{ request('search') }}" placeholder="Cari judul/nama warga...">
                                            <button type="submit" class="btn btn-primary">
                                                <i class="mdi mdi-magnify"></i>
                                            </button>
                                            @if (request('search'))
                                                <a href="{{ request()->fullUrlWithQuery(['search' => null]) }}"
                                                    class="btn btn-outline-secondary">
                                                    <i class="mdi mdi-close"></i>
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-striped custom-table" id="pengaduanTable">
                                <thead>
                                    <tr class="table-header">
                                        <th width="150">NO. TIKET</th>
                                        <th width="180">WARGA</th>
                                        <th width="150">KATEGORI</th>
                                        <th width="220">JUDUL</th>
                                        <th width="180">LOKASI</th>
                                        <th width="100">RT/RW</th>
                                        <th width="130">STATUS</th>
                                        <th width="120">TANGGAL</th>
                                        <th width="200" class="text-center">AKSI</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($dataPengaduan as $pengaduan)
                                        <tr>
                                            <td>
                                                <span class="badge badge-tiket" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                                                    <i class="mdi mdi-ticket mr-1"></i>{{ $pengaduan->no_tiket }}
                                                </span>
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar-sm me-2">
                                                        <div class="avatar-title bg-primary rounded-circle text-white">
                                                            {{ substr($pengaduan->warga->nama ?? 'N/A', 0, 1) }}
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <strong class="text-truncate" style="max-width: 130px; display: inline-block;"
                                                          title="{{ $pengaduan->warga->nama ?? 'N/A' }}">
                                                            {{ $pengaduan->warga->nama ?? 'N/A' }}
                                                        </strong>
                                                        <br>
                                                        <small class="text-muted">{{ $pengaduan->warga->email ?? '-' }}</small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                @php
                                                    $kategoriColors = [
                                                        'Kebersihan Lingkungan' => 'badge-success',
                                                        'Infrastruktur Jalan' => 'badge-warning',
                                                        'Pengaduan Lainnya' => 'badge-info',
                                                        'biasa saja' => 'badge-secondary',
                                                    ];

                                                    $kategoriNama = $pengaduan->kategori->nama ?? 'Lainnya';
                                                    $badgeClass = $kategoriColors[$kategoriNama] ?? 'badge-dark';
                                                @endphp
                                                <span class="badge {{ $badgeClass }} px-3 py-1">
                                                    <i class="mdi mdi-tag mr-1"></i>{{ $kategoriNama }}
                                                </span>
                                                <br>
                                                <small class="text-muted">
                                                    <i class="mdi mdi-clock-outline"></i> SLA: {{ $pengaduan->kategori->sla_hari ?? '0' }} hari
                                                </small>
                                            </td>
                                            <td>
                                                <div class="font-weight-bold text-truncate" style="max-width: 200px;"
                                                     title="{{ $pengaduan->judul }}">
                                                    {{ Str::limit($pengaduan->judul, 30) }}
                                                </div>
                                                <small class="text-muted text-truncate d-block" style="max-width: 200px;"
                                                       title="{{ $pengaduan->deskripsi }}">
                                                    {{ Str::limit($pengaduan->deskripsi, 40) }}
                                                </small>
                                            </td>
                                            <td>
                                                <div class="text-truncate" style="max-width: 160px;"
                                                     title="{{ $pengaduan->lokasi_text }}">
                                                    <i class="mdi mdi-map-marker text-danger mr-1"></i>
                                                    {{ Str::limit($pengaduan->lokasi_text, 25) }}
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <div class="d-flex flex-column align-items-center">
                                                    <span class="badge badge-rt" style="background: linear-gradient(135deg, #4CAF50 0%, #2E7D32 100%);">
                                                        RT {{ $pengaduan->rt }}
                                                    </span>
                                                    <span class="badge badge-rw mt-1" style="background: linear-gradient(135deg, #2196F3 0%, #0D47A1 100%);">
                                                        RW {{ $pengaduan->rw }}
                                                    </span>
                                                </div>
                                            </td>
                                            <td>
                                                @if ($pengaduan->status == 'sedang_diproses')
                                                    <span class="badge badge-processing" style="background: linear-gradient(135deg, #FF9800 0%, #F57C00 100%);">
                                                        <i class="mdi mdi-progress-clock mr-1"></i>Sedang Diproses
                                                    </span>
                                                @elseif($pengaduan->status == 'sudah_selesai')
                                                    <span class="badge badge-completed" style="background: linear-gradient(135deg, #4CAF50 0%, #2E7D32 100%);">
                                                        <i class="mdi mdi-check-circle mr-1"></i>Selesai
                                                    </span>
                                                @else
                                                    <span class="badge badge-secondary">
                                                        {{ $pengaduan->status }}
                                                    </span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="text-center">
                                                    <div class="font-weight-bold text-primary">
                                                        {{ $pengaduan->created_at->format('d/m') }}
                                                    </div>
                                                    <div class="text-muted small">
                                                        {{ $pengaduan->created_at->format('Y') }}
                                                    </div>
                                                    
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex justify-content-center gap-2">
                                                    <!-- Tombol Detail -->
                                                    <a href="{{ route('Pengaduan.show', $pengaduan->pengaduan_id) }}"
                                                        class="btn btn-info btn-sm btn-action">
                                                        <i class="mdi mdi-eye mr-1"></i>Detail
                                                    </a>

                                                    <!-- Tombol Edit -->
                                                    <a href="{{ route('Pengaduan.edit', $pengaduan->pengaduan_id) }}"
                                                        class="btn btn-warning btn-sm btn-action">
                                                        <i class="mdi mdi-pencil mr-1"></i>Edit
                                                    </a>

                                                    <!-- Tombol Hapus -->
                                                    <form action="{{ route('Pengaduan.destroy', $pengaduan->pengaduan_id) }}"
                                                        method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm btn-action"
                                                            onclick="return confirmDelete('{{ $pengaduan->no_tiket }}')">
                                                            <i class="mdi mdi-delete mr-1"></i>Hapus
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="9" class="text-center py-4">
                                                <div class="empty-state">
                                                    <i class="mdi mdi-file-document-outline display-4 text-muted"></i>
                                                    <h5 class="mt-3">Belum ada data pengaduan</h5>
                                                    <p class="text-muted">Silakan tambah pengaduan baru untuk memulai</p>
                                                    <a href="{{ route('Pengaduan.create') }}" class="btn btn-primary mt-2">
                                                        <i class="mdi mdi-plus-circle mr-1"></i> Tambah Pengaduan
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>

                            <!-- Pagination -->
                            @if($dataPengaduan->hasPages())
                            <div class="mt-4">
                                <nav aria-label="Page navigation">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="text-muted">
                                            Menampilkan {{ $dataPengaduan->firstItem() }} hingga {{ $dataPengaduan->lastItem() }}
                                            dari {{ $dataPengaduan->total() }} data
                                        </div>
                                        {{ $dataPengaduan->links('pagination::bootstrap-5') }}
                                    </div>
                                </nav>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- end main content --}}

    <style>
        /* Styling untuk header tabel dengan gradasi biru dan ungu */
        .custom-table thead .table-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 8px 8px 0 0;
            overflow: hidden;
        }

        .custom-table thead th {
            padding: 16px 12px;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.875rem;
            letter-spacing: 0.5px;
            border: none;
            position: relative;
            transition: all 0.3s ease;
            border-right: 1px solid rgba(255, 255, 255, 0.1);
        }

        .custom-table thead th:last-child {
            border-right: none;
        }

        .custom-table thead th:hover {
            background: linear-gradient(135deg, #5a6fd8 0%, #6a42a0 100%);
            transform: translateY(-2px);
        }

        /* Efek garis bawah dengan gradasi yang sama */
        .custom-table thead th:after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 3px;
            background: linear-gradient(90deg, #667eea 0%, #764ba2 100%);
            transition: all 0.3s ease;
        }

        .custom-table thead th:hover:after {
            height: 5px;
            background: linear-gradient(90deg, #5a6fd8 0%, #6a42a0 100%);
        }

        /* Warna sel individual dengan variasi dari gradasi biru-ungu */
        .custom-table thead th:nth-child(1) {
            /* No. Tiket */
            background: linear-gradient(135deg, #667eea 0%, #6a5df5 100%);
        }

        .custom-table thead th:nth-child(2) {
            /* Warga */
            background: linear-gradient(135deg, #6a5df5 0%, #764ba2 100%);
        }

        .custom-table thead th:nth-child(3) {
            /* Kategori */
            background: linear-gradient(135deg, #764ba2 0%, #8a3f9c 100%);
        }

        .custom-table thead th:nth-child(4) {
            /* Judul */
            background: linear-gradient(135deg, #8a3f9c 0%, #9a36a2 100%);
        }

        .custom-table thead th:nth-child(5) {
            /* Lokasi */
            background: linear-gradient(135deg, #9a36a2 0%, #a82bab 100%);
        }

        .custom-table thead th:nth-child(6) {
            /* RT/RW */
            background: linear-gradient(135deg, #a82bab 0%, #b724ba 100%);
        }

        .custom-table thead th:nth-child(7) {
            /* Status */
            background: linear-gradient(135deg, #b724ba 0%, #c51fba 100%);
        }

        .custom-table thead th:nth-child(8) {
            /* Tanggal */
            background: linear-gradient(135deg, #c51fba 0%, #d31aba 100%);
        }

        .custom-table thead th:nth-child(9) {
            /* Aksi */
            background: linear-gradient(135deg, #d31aba 0%, #e214ba 100%);
        }

        /* Efek hover untuk setiap kolom dengan gradasi yang lebih gelap */
        .custom-table thead th:nth-child(1):hover {
            background: linear-gradient(135deg, #5a6fd8 0%, #5a4ef2 100%);
        }

        .custom-table thead th:nth-child(2):hover {
            background: linear-gradient(135deg, #5a4ef2 0%, #6a42a0 100%);
        }

        .custom-table thead th:nth-child(3):hover {
            background: linear-gradient(135deg, #6a42a0 0%, #7a378b 100%);
        }

        .custom-table thead th:nth-child(4):hover {
            background: linear-gradient(135deg, #7a378b 0%, #8a2d91 100%);
        }

        .custom-table thead th:nth-child(5):hover {
            background: linear-gradient(135deg, #8a2d91 0%, #9a239a 100%);
        }

        .custom-table thead th:nth-child(6):hover {
            background: linear-gradient(135deg, #9a239a 0%, #a919a3 100%);
        }

        .custom-table thead th:nth-child(7):hover {
            background: linear-gradient(135deg, #a919a3 0%, #b80fac 100%);
        }

        .custom-table thead th:nth-child(8):hover {
            background: linear-gradient(135deg, #b80fac 0%, #c704b5 100%);
        }

        .custom-table thead th:nth-child(9):hover {
            background: linear-gradient(135deg, #c704b5 0%, #d600be 100%);
        }

        /* Styling untuk baris tabel */
        .custom-table tbody tr {
            transition: all 0.3s ease;
            border-bottom: 1px solid #eef2f7;
        }

        .custom-table tbody tr:hover {
            background-color: #f8f9fa;
            transform: translateX(5px);
            box-shadow: 0 2px 10px rgba(102, 126, 234, 0.1);
        }

        /* Badge styling */
        .badge-tiket {
            color: white !important;
            font-weight: 600;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
        }

        .badge-rt, .badge-rw {
            color: white !important;
            font-weight: 500;
            padding: 4px 10px;
            border-radius: 15px;
            font-size: 0.75rem;
            min-width: 60px;
        }

        .badge-processing, .badge-completed {
            color: white !important;
            font-weight: 500;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
        }

        /* Avatar styling */
        .avatar-sm {
            width: 36px;
            height: 36px;
        }

        .avatar-title {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            height: 100%;
            font-weight: 600;
            font-size: 1rem;
        }

        /* Text truncate */
        .text-truncate {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            vertical-align: middle;
        }

        /* Tombol action dengan teks */
        .btn-action {
            padding: 6px 12px;
            border-radius: 8px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            font-size: 0.875rem;
            min-width: 80px;
        }

        .btn-action:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
        }

        /* Warna tombol */
        .btn-info {
            background: linear-gradient(135deg, #17a2b8 0%, #138496 100%);
            border: none;
            color: white;
        }

        .btn-info:hover {
            background: linear-gradient(135deg, #138496 0%, #117a8b 100%);
            border: none;
            color: white;
        }

        .btn-warning {
            background: linear-gradient(135deg, #ffc107 0%, #e0a800 100%);
            border: none;
            color: #212529;
        }

        .btn-warning:hover {
            background: linear-gradient(135deg, #e0a800 0%, #d39e00 100%);
            border: none;
            color: #212529;
        }

        .btn-danger {
            background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
            border: none;
            color: white;
        }

        .btn-danger:hover {
            background: linear-gradient(135deg, #c82333 0%, #bd2130 100%);
            border: none;
            color: white;
        }

        /* Empty state */
        .empty-state {
            padding: 3rem;
            text-align: center;
        }

        .empty-state i {
            font-size: 4rem;
            color: #667eea;
            opacity: 0.7;
        }

        .smaller {
            font-size: 0.75rem;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .d-flex.gap-2 {
                flex-wrap: wrap;
                gap: 0.5rem !important;
            }

            .btn {
                width: 100%;
                margin-bottom: 0.5rem;
            }

            .custom-table thead {
                display: none;
            }

            .custom-table tbody tr {
                display: block;
                margin-bottom: 1rem;
                border: 1px solid #dee2e6;
                border-radius: 8px;
                box-shadow: 0 2px 4px rgba(102, 126, 234, 0.1);
            }

            .custom-table tbody td {
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 0.75rem;
                border-bottom: 1px solid #eef2f7;
                max-width: 100% !important;
            }

            .custom-table tbody td:before {
                content: attr(data-label);
                font-weight: 600;
                text-transform: uppercase;
                color: #667eea;
                min-width: 100px;
            }

            .custom-table tbody td:last-child {
                border-bottom: none;
                justify-content: center;
            }

            .d-flex.justify-content-center.gap-2 {
                flex-wrap: wrap;
                justify-content: center !important;
                gap: 0.5rem !important;
                width: 100%;
            }

            .btn-action {
                min-width: 70px;
                padding: 5px 10px;
                font-size: 0.8125rem;
            }

            .avatar-sm {
                width: 32px;
                height: 32px;
            }

            .text-truncate {
                max-width: 150px !important;
            }
        }

        /* Untuk browser yang tidak support gradient */
        @supports not (background: linear-gradient(135deg, #667eea 0%, #764ba2 100%)) {
            .custom-table thead th {
                background-color: #667eea;
            }

            .custom-table thead th:hover {
                background-color: #5a6fd8;
            }

            .badge-tiket {
                background-color: #667eea !important;
            }

            .badge-rt {
                background-color: #4CAF50 !important;
            }

            .badge-rw {
                background-color: #2196F3 !important;
            }

            .badge-processing {
                background-color: #FF9800 !important;
            }

            .badge-completed {
                background-color: #4CAF50 !important;
            }

            .btn-info {
                background-color: #17a2b8 !important;
            }

            .btn-warning {
                background-color: #ffc107 !important;
            }

            .btn-danger {
                background-color: #dc3545 !important;
            }
        }
    </style>
@endsection

@push('scripts')
<script>
    // Konfirmasi hapus data
    function confirmDelete(noTiket) {
        return confirm(`Apakah Anda yakin ingin menghapus pengaduan dengan tiket "${noTiket}"?`);
    }

    // Responsive table untuk mobile
    function makeTableResponsive() {
        if (window.innerWidth < 768) {
            const table = document.getElementById('pengaduanTable');
            const rows = table.querySelectorAll('tbody tr');

            const headerLabels = [
                'NO. TIKET',
                'WARGA',
                'KATEGORI',
                'JUDUL',
                'LOKASI',
                'RT/RW',
                'STATUS',
                'TANGGAL',
                'AKSI'
            ];

            rows.forEach(row => {
                const cells = row.querySelectorAll('td');
                cells.forEach((cell, index) => {
                    if (headerLabels[index]) {
                        cell.setAttribute('data-label', headerLabels[index]);
                    }
                });
            });
        }
    }

    // Animasi untuk header tabel saat hover
    function initTableAnimations() {
        const tableHeaders = document.querySelectorAll('.custom-table thead th');

        tableHeaders.forEach(header => {
            header.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-2px)';
                this.style.boxShadow = '0 4px 8px rgba(0, 0, 0, 0.1)';
            });

            header.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
                this.style.boxShadow = 'none';
            });
        });
    }

    // Jalankan saat halaman dimuat
    document.addEventListener('DOMContentLoaded', function() {
        makeTableResponsive();
        initTableAnimations();

        // Tambahkan event listener untuk resize window
        window.addEventListener('resize', makeTableResponsive);

        // Auto close alert setelah 5 detik
        setTimeout(function() {
            $('.alert').alert('close');
        }, 5000);
    });
</script>
@endpush
