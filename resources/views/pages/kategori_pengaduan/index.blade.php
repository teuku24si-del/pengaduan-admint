

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
            <h2 class="text-dark font-weight-bold mb-2">Data Kategori Pengaduan</h2>
            <div class="d-flex gap-2">
                <a href="{{ route('kategori_pengaduan.create') }}" class="btn btn-primary">
                    <i class="mdi mdi-plus-circle mr-1"></i> Tambah Kategori
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
                                <h4 class="card-title mb-0">Daftar Kategori Pengaduan</h4>
                                <p class="card-description mb-0">Kelola kategori pengaduan untuk sistem pelaporan</p>
                            </div>
                            <div class="badge badge-info p-2">
                                Total: {{ $datakategori_pengaduan->total() }} Kategori
                            </div>
                        </div>

                        <!-- Filter dan Search Section -->
                        <div class="card mb-4">
                            <div class="card-body py-3">
                                <form method="GET" action="{{ route('kategori_pengaduan.index') }}" class="row g-3 align-items-center">
                                    <div class="col-md-2">
                                        <label class="form-label mb-0">Filter Prioritas</label>
                                        <select name="prioritas" class="form-select" onchange="this.form.submit()">
                                            <option value="">All</option>
                                            <option value="rendah" {{ request('prioritas') == 'rendah' ? 'selected' : '' }}>
                                                Rendah
                                            </option>
                                            <option value="sedang" {{ request('prioritas') == 'sedang' ? 'selected' : '' }}>
                                                Sedang
                                            </option>
                                            <option value="tinggi" {{ request('prioritas') == 'tinggi' ? 'selected' : '' }}>
                                                Tinggi
                                            </option>
                                            <option value="sangat_tinggi" {{ request('prioritas') == 'sangat_tinggi' ? 'selected' : '' }}>
                                                Sangat Tinggi
                                            </option>
                                        </select>
                                    </div>

                                    <div class="col-md-4">
                                        <label class="form-label mb-0">Cari Kategori</label>
                                        <div class="input-group">
                                            <input type="text" name="search" class="form-control"
                                                value="{{ request('search') }}" placeholder="Cari nama kategori...">
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
                            <table class="table table-striped custom-table" id="kategoriTable">
                                <thead>
                                    <tr class="table-header">
                                        <th width="60">NO</th>
                                        <th width="250">NAMA KATEGORI</th>
                                        <th width="120">SLA HARI</th>
                                        <th width="120">PRIORITAS</th>
                                        <th width="200" class="text-center">AKSI</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($datakategori_pengaduan as $index => $kategori)
                                        <tr>
                                            <td class="text-center">{{ $datakategori_pengaduan->firstItem() + $index }}</td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar-sm me-2">
                                                        <div class="avatar-title bg-primary rounded-circle text-white">
                                                            {{ substr($kategori->nama, 0, 1) }}
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <strong class="text-truncate" style="max-width: 180px; display: inline-block;"
                                                          title="{{ $kategori->nama }}">
                                                            {{ $kategori->nama }}
                                                        </strong>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <span class="badge badge-light border">
                                                    <i class="mdi mdi-clock-outline mr-1"></i>{{ $kategori->sla_hari }} hari
                                                </span>
                                            </td>
                                            <td class="text-center">
                                                @php
                                                    $badgeClass = [
                                                        'rendah' => 'badge-info',
                                                        'sedang' => 'badge-warning',
                                                        'tinggi' => 'badge-danger',
                                                        'sangat_tinggi' => 'badge-dark',
                                                    ][$kategori->prioritas] ?? 'badge-secondary';

                                                    $priorityText = ucfirst(str_replace('_', ' ', $kategori->prioritas));
                                                    $priorityIcon = [
                                                        'rendah' => 'mdi-arrow-down',
                                                        'sedang' => 'mdi-arrow-right',
                                                        'tinggi' => 'mdi-arrow-up',
                                                        'sangat_tinggi' => 'mdi-arrow-up-bold',
                                                    ][$kategori->prioritas] ?? 'mdi-information';
                                                @endphp
                                                <span class="badge {{ $badgeClass }} px-3 py-1">
                                                    <i class="mdi {{ $priorityIcon }} mr-1"></i>{{ $priorityText }}
                                                </span>
                                            </td>
                                            <td>
                                                <div class="d-flex justify-content-center gap-2">
                                                    <!-- Tombol Detail -->
                                                    <a href="{{ route('kategori_pengaduan.show', $kategori->kategori_id) }}"
                                                        class="btn btn-info btn-sm">
                                                        <i class="mdi mdi-eye"></i> Detail
                                                    </a>

                                                    <!-- Tombol Edit -->
                                                    <a href="{{ route('kategori_pengaduan.edit', $kategori->kategori_id) }}"
                                                        class="btn btn-warning btn-sm">
                                                        <i class="mdi mdi-pencil"></i> Edit
                                                    </a>

                                                    <!-- Tombol Hapus -->
                                                    <form action="{{ route('kategori_pengaduan.destroy', $kategori->kategori_id) }}"
                                                        method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm"
                                                            onclick="return confirmDelete('{{ $kategori->nama }}')">
                                                            <i class="mdi mdi-delete"></i> Hapus
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center py-4">
                                                <div class="empty-state">
                                                    <i class="mdi mdi-folder-outline display-4 text-muted"></i>
                                                    <h5 class="mt-3">Belum ada data kategori pengaduan</h5>
                                                    <p class="text-muted">Silakan tambah kategori baru untuk memulai</p>
                                                    <a href="{{ route('kategori_pengaduan.create') }}" class="btn btn-primary mt-2">
                                                        <i class="mdi mdi-plus-circle mr-1"></i> Tambah Kategori
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>

                            <!-- Pagination -->
                            @if($datakategori_pengaduan->hasPages())
                            <div class="mt-4">
                                <nav aria-label="Page navigation">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="text-muted">
                                            Menampilkan {{ $datakategori_pengaduan->firstItem() }} hingga {{ $datakategori_pengaduan->lastItem() }}
                                            dari {{ $datakategori_pengaduan->total() }} data
                                        </div>
                                        {{ $datakategori_pengaduan->links('pagination::bootstrap-5') }}
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

        /* Warna sel individual dengan variasi dari gradasi biru-ungu */
        .custom-table thead th:nth-child(1) {
            /* No */
            background: linear-gradient(135deg, #667eea 0%, #6a5df5 100%);
        }

        .custom-table thead th:nth-child(2) {
            /* Nama Kategori */
            background: linear-gradient(135deg, #6a5df5 0%, #764ba2 100%);
            width: 250px !important;
        }

        .custom-table thead th:nth-child(3) {
            /* SLA Hari */
            background: linear-gradient(135deg, #764ba2 0%, #8a3f9c 100%);
            width: 120px !important;
        }

        .custom-table thead th:nth-child(4) {
            /* Prioritas */
            background: linear-gradient(135deg, #8a3f9c 0%, #9a36a2 100%);
            width: 120px !important;
        }

        .custom-table thead th:nth-child(5) {
            /* Aksi */
            background: linear-gradient(135deg, #9a36a2 0%, #a82bab 100%);
            width: 200px !important;
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

        /* Avatar styling */
        .avatar-sm {
            width: 32px;
            height: 32px;
        }

        .avatar-title {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            height: 100%;
            font-weight: 600;
        }

        /* Badge styling untuk SLA */
        .badge.border {
            border: 1px solid #dee2e6 !important;
            background-color: #f8f9fa;
            color: #495057;
        }

        /* Text truncate untuk nama kategori */
        .text-truncate {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            vertical-align: middle;
        }

        /* Kolom nama kategori yang lebih kecil */
        td:nth-child(2) {
            max-width: 250px;
        }

        .custom-table td {
            vertical-align: middle !important;
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
                flex-direction: column;
                gap: 5px;
            }

            .text-truncate {
                max-width: 150px !important;
            }

            .d-flex.justify-content-center.gap-2 {
                flex-wrap: wrap;
                justify-content: center !important;
                gap: 0.5rem !important;
                width: 100%;
            }

            .d-flex.justify-content-center.gap-2 .btn {
                width: auto;
                margin-bottom: 0;
                min-width: 70px;
                flex: 1;
            }

            /* Tombol dengan gradasi biru-ungu di mobile */
            .btn-info {
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                border: none;
                color: white;
            }

            .btn-info:hover {
                background: linear-gradient(135deg, #5a6fd8 0%, #6a42a0 100%);
                transform: translateY(-2px);
                box-shadow: 0 4px 8px rgba(102, 126, 234, 0.3);
            }
        }

        /* Tombol action styling */
        .d-flex.gap-2 .btn {
            min-width: 80px;
            transition: all 0.3s ease;
            font-size: 0.875rem;
            padding: 0.375rem 0.75rem;
        }

        .btn-info {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            color: white;
        }

        .btn-info:hover {
            background: linear-gradient(135deg, #5a6fd8 0%, #6a42a0 100%);
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(102, 126, 234, 0.3);
        }

        /* Untuk browser yang tidak support gradient */
        @supports not (background: linear-gradient(135deg, #667eea 0%, #764ba2 100%)) {
            .custom-table thead th {
                background-color: #667eea;
            }

            .custom-table thead th:hover {
                background-color: #5a6fd8;
            }

            .btn-info {
                background-color: #667eea;
            }

            .btn-info:hover {
                background-color: #5a6fd8;
            }
        }
    </style>
@endsection

@push('scripts')
<script>
    // Konfirmasi hapus data
    function confirmDelete(nama) {
        return confirm(`Apakah Anda yakin ingin menghapus kategori "${nama}"?`);
    }

    // Responsive table untuk mobile
    function makeTableResponsive() {
        if (window.innerWidth < 768) {
            const table = document.getElementById('kategoriTable');
            const rows = table.querySelectorAll('tbody tr');

            const headerLabels = [
                'NO',
                'NAMA KATEGORI',
                'SLA HARI',
                'PRIORITAS',
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
