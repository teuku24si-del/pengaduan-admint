
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
            <h2 class="text-dark font-weight-bold mb-2">Data Warga</h2>
            <div class="d-flex gap-2">
                <a href="{{ route('warga.create') }}" class="btn btn-primary">
                    <i class="mdi mdi-account-plus"></i> Tambah Data Warga Baru
                </a>
                <a href="{{ route('dashboard') }}" class="btn btn-light">
                    <i class="mdi mdi-arrow-left"></i> Kembali ke Dashboard
                </a>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div>
                                <h4 class="card-title mb-0">Daftar Warga</h4>
                                <p class="card-description mb-0">Seluruh data warga yang telah terdaftar</p>
                            </div>
                            <div class="badge badge-info p-2">
                                Total: {{ $datawarga->total() }} Data
                            </div>
                        </div>

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

                        <!-- Filter dan Search Section -->
                        <div class="card mb-4">
                            <div class="card-body py-3">
                                <form method="GET" action="{{ route('warga.index') }}" class="row g-3 align-items-center">
                                    <div class="col-md-2">
                                        <label class="form-label mb-0">Filter Jenis Kelamin</label>
                                        <select name="jenis_kelamin" class="form-select" onchange="this.form.submit()">
                                            <option value="">All</option>
                                            <option value="Laki-laki" {{ request('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>
                                                Laki-laki
                                            </option>
                                            <option value="Perempuan" {{ request('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>
                                                Perempuan
                                            </option>
                                        </select>
                                    </div>

                                    <div class="col-md-4">
                                        <label class="form-label mb-0">Cari Data</label>
                                        <div class="input-group">
                                            <input type="text" name="search" class="form-control"
                                                value="{{ request('search') }}" placeholder="Search nama, email, atau no HP...">
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

                        <!-- Data Table -->
                        <div class="table-responsive">
                            <table class="table table-striped custom-table" id="wargaTable">
                                <thead>
                                    <tr class="table-header">
                                        <th width="50">No</th>
                                        <th>Nama</th>
                                        <th>Agama</th>
                                        <th>Pekerjaan</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Email</th>
                                        <th>No HP</th>
                                        <th width="220" class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($datawarga as $index => $warga)
                                        <tr>
                                            <td class="text-center">{{ $datawarga->firstItem() + $index }}</td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar-sm me-2">
                                                        <div class="avatar-title bg-primary rounded-circle text-white">
                                                            {{ substr($warga->nama, 0, 1) }}
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <strong>{{ $warga->nama }}</strong>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                @php
                                                    // Warna berbeda untuk setiap agama
                                                    $agamaColors = [
                                                        'Islam' => [
                                                            'bg' => 'linear-gradient(135deg, #1e7b1e 0%, #2ba32b 100%)',
                                                            'color' => 'white',
                                                            'icon' => 'mdi-mosque'
                                                        ],
                                                        'Kristen' => [
                                                            'bg' => 'linear-gradient(135deg, #0066cc 0%, #3399ff 100%)',
                                                            'color' => 'white',
                                                            'icon' => 'mdi-church'
                                                        ],
                                                        'Katolik' => [
                                                            'bg' => 'linear-gradient(135deg, #800080 0%, #b366b3 100%)',
                                                            'color' => 'white',
                                                            'icon' => 'mdi-church'
                                                        ],
                                                        'Hindu' => [
                                                            'bg' => 'linear-gradient(135deg, #ff6600 0%, #ff9933 100%)',
                                                            'color' => 'white',
                                                            'icon' => 'mdi-hinduism'
                                                        ],
                                                        'Buddha' => [
                                                            'bg' => 'linear-gradient(135deg, #ffcc00 0%, #ffeb3b 100%)',
                                                            'color' => '#333',
                                                            'icon' => 'mdi-buddhism'
                                                        ],
                                                        'Konghucu' => [
                                                            'bg' => 'linear-gradient(135deg, #cc0000 0%, #ff3333 100%)',
                                                            'color' => 'white',
                                                            'icon' => 'mdi-temple-buddhist'
                                                        ]
                                                    ];

                                                    $agamaData = $agamaColors[$warga->agama] ?? [
                                                        'bg' => 'linear-gradient(135deg, #6c757d 0%, #adb5bd 100%)',
                                                        'color' => 'white',
                                                        'icon' => 'mdi-account-question'
                                                    ];
                                                @endphp
                                                <span class="badge agama-badge" style="background: {{ $agamaData['bg'] }}; color: {{ $agamaData['color'] }};">
                                                    <i class="mdi {{ $agamaData['icon'] }} mr-1"></i>{{ $warga->agama }}
                                                </span>
                                            </td>
                                            <td>
                                                <span class="pekerjaan-text">{{ $warga->pekerjaan }}</span>
                                            </td>
                                            <td>
                                                @if($warga->jenis_kelamin == 'Laki-laki')
                                                    <span class="badge badge-jenis-kelamin laki-laki">
                                                        <i class="mdi mdi-gender-male"></i> Laki-laki
                                                    </span>
                                                @else
                                                    <span class="badge badge-jenis-kelamin perempuan">
                                                        <i class="mdi mdi-gender-female"></i> Perempuan
                                                    </span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="mailto:{{ $warga->email }}" class="email-link">
                                                    <i class="mdi mdi-email-outline"></i> {{ $warga->email }}
                                                </a>
                                            </td>
                                            <td>
                                                <a href="tel:{{ $warga->No_Hp }}" class="phone-link">
                                                    <i class="mdi mdi-phone"></i> {{ $warga->No_Hp }}
                                                </a>
                                            </td>
                                            <td>
                                                <div class="d-flex justify-content-center gap-2">
                                                    <!-- Tombol Detail -->
                                                    <button type="button" class="btn btn-info btn-sm"
                                                            data-toggle="modal" data-target="#detailModal{{ $warga->warga_id }}">
                                                        <i class="mdi mdi-eye"></i> Detail
                                                    </button>

                                                    <!-- Tombol Edit -->
                                                    <a href="{{ route('warga.edit', $warga->warga_id) }}"
                                                        class="btn btn-warning btn-sm">
                                                        <i class="mdi mdi-pencil"></i> Edit
                                                    </a>

                                                    <!-- Tombol Hapus -->
                                                    <form action="{{ route('warga.destroy', $warga->warga_id) }}"
                                                        method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm"
                                                            onclick="return confirmDelete('{{ $warga->nama }}')">
                                                            <i class="mdi mdi-delete"></i> Hapus
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>

                                        <!-- Modal Detail -->
                                        <div class="modal fade" id="detailModal{{ $warga->warga_id }}" tabindex="-1"
                                            role="dialog" aria-labelledby="detailModalLabel{{ $warga->warga_id }}"
                                            aria-hidden="true">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-primary text-white">
                                                        <h5 class="modal-title" id="detailModalLabel{{ $warga->warga_id }}">
                                                            <i class="mdi mdi-account-circle"></i> Detail Data Warga
                                                        </h5>
                                                        <button type="button" class="close text-white" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-md-4 text-center mb-4">
                                                                <div class="avatar-xl mb-3">
                                                                    <div class="avatar-title bg-primary rounded-circle text-white display-4">
                                                                        {{ substr($warga->nama, 0, 1) }}
                                                                    </div>
                                                                </div>
                                                                <h5>{{ $warga->nama }}</h5>
                                                                <span class="badge {{ $warga->jenis_kelamin == 'Laki-laki' ? 'badge-primary' : 'badge-pink' }}">
                                                                    {{ $warga->jenis_kelamin }}
                                                                </span>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="row mb-3">
                                                                    <div class="col-md-4"><strong>Agama:</strong></div>
                                                                    <div class="col-md-8">
                                                                        @php
                                                                            $agamaDetail = $agamaColors[$warga->agama] ?? $agamaData;
                                                                        @endphp
                                                                        <span class="badge agama-badge" style="background: {{ $agamaDetail['bg'] }}; color: {{ $agamaDetail['color'] }};">
                                                                            <i class="mdi {{ $agamaDetail['icon'] }} mr-1"></i>{{ $warga->agama }}
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <div class="row mb-3">
                                                                    <div class="col-md-4"><strong>Pekerjaan:</strong></div>
                                                                    <div class="col-md-8">{{ $warga->pekerjaan }}</div>
                                                                </div>
                                                                <div class="row mb-3">
                                                                    <div class="col-md-4"><strong>Email:</strong></div>
                                                                    <div class="col-md-8">
                                                                        <a href="mailto:{{ $warga->email }}" class="text-primary">
                                                                            {{ $warga->email }}
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                                <div class="row mb-3">
                                                                    <div class="col-md-4"><strong>No HP:</strong></div>
                                                                    <div class="col-md-8">
                                                                        <a href="tel:{{ $warga->No_Hp }}" class="text-success">
                                                                            {{ $warga->No_Hp }}
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-4"><strong>ID Warga:</strong></div>
                                                                    <div class="col-md-8">
                                                                        <code>{{ $warga->warga_id }}</code>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <a href="{{ route('warga.edit', $warga->warga_id) }}"
                                                           class="btn btn-warning">
                                                            <i class="mdi mdi-pencil"></i> Edit Data
                                                        </a>
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                            <i class="mdi mdi-close"></i> Tutup
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <tr>
                                            <td colspan="8" class="text-center py-4">
                                                <div class="empty-state">
                                                    <i class="mdi mdi-account-off-outline display-4 text-muted"></i>
                                                    <h5 class="mt-3">Tidak ada data warga</h5>
                                                    <p class="text-muted">Silakan tambah data warga baru</p>
                                                    <a href="{{ route('warga.create') }}" class="btn btn-primary mt-2">
                                                        <i class="mdi mdi-account-plus"></i> Tambah Data Warga
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>

                            <!-- Pagination -->
                            @if($datawarga->hasPages())
                            <div class="mt-4">
                                <nav aria-label="Page navigation">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="text-muted">
                                            Menampilkan {{ $datawarga->firstItem() }} hingga {{ $datawarga->lastItem() }}
                                            dari {{ $datawarga->total() }} data
                                        </div>
                                        {{ $datawarga->links('pagination::bootstrap-5') }}
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

        /* Warna sel individual dengan variasi dari gradasi biru-ungu */
        .custom-table thead th:nth-child(1) {
            /* No */
            background: linear-gradient(135deg, #667eea 0%, #6a5df5 100%);
        }

        .custom-table thead th:nth-child(2) {
            /* Nama */
            background: linear-gradient(135deg, #6a5df5 0%, #764ba2 100%);
        }

        .custom-table thead th:nth-child(3) {
            /* Agama */
            background: linear-gradient(135deg, #764ba2 0%, #8a3f9c 100%);
        }

        .custom-table thead th:nth-child(4) {
            /* Pekerjaan */
            background: linear-gradient(135deg, #8a3f9c 0%, #9a36a2 100%);
        }

        .custom-table thead th:nth-child(5) {
            /* Jenis Kelamin */
            background: linear-gradient(135deg, #9a36a2 0%, #a82bab 100%);
        }

        .custom-table thead th:nth-child(6) {
            /* Email */
            background: linear-gradient(135deg, #a82bab 0%, #b721bf 100%);
        }

        .custom-table thead th:nth-child(7) {
            /* No HP */
            background: linear-gradient(135deg, #b721bf 0%, #c616d4 100%);
        }

        .custom-table thead th:nth-child(8) {
            /* Aksi */
            background: linear-gradient(135deg, #c616d4 0%, #d50be3 100%);
        }

        /* Badge Agama - Lebih berwarna dan menarik */
        .agama-badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.8rem;
            border: none;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            min-width: 90px;
            justify-content: center;
        }

        .agama-badge:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .agama-badge i {
            font-size: 0.9rem;
        }

        /* Styling untuk pekerjaan */
        .pekerjaan-text {
            font-weight: 500;
            color: #495057;
        }

        /* Badge Jenis Kelamin */
        .badge-jenis-kelamin {
            padding: 6px 12px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.8rem;
            border: none;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .badge-jenis-kelamin.laki-laki {
            background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
            color: white;
        }

        .badge-jenis-kelamin.perempuan {
            background: linear-gradient(135deg, #ff3366 0%, #cc0044 100%);
            color: white;
        }

        /* Link styling */
        .email-link {
            color: #0066cc;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .email-link:hover {
            color: #004d99;
            text-decoration: underline;
        }

        .phone-link {
            color: #28a745;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .phone-link:hover {
            color: #1e7e34;
            text-decoration: underline;
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

        .avatar-xl {
            width: 80px;
            height: 80px;
            margin: 0 auto;
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

        /* Tombol aksi dengan teks */
        .d-flex.justify-content-center.gap-2 .btn {
            min-width: 80px;
            padding: 0.375rem 0.75rem;
            font-size: 0.875rem;
        }

        .d-flex.justify-content-center.gap-2 .btn i {
            margin-right: 5px;
        }

        /* Tombol detail dengan gradasi biru-ungu */
        .btn-info {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            color: white;
            transition: all 0.3s ease;
        }

        .btn-info:hover {
            background: linear-gradient(135deg, #5a6fd8 0%, #6a42a0 100%);
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(102, 126, 234, 0.3);
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
            }

            .custom-table tbody td:before {
                content: attr(data-label);
                font-weight: 600;
                text-transform: uppercase;
                color: #667eea;
            }

            .custom-table tbody td:last-child {
                border-bottom: none;
                justify-content: center;
            }

            .d-flex.justify-content-center.gap-2 {
                flex-wrap: wrap;
                justify-content: center !important;
                gap: 0.5rem !important;
            }

            .d-flex.justify-content-center.gap-2 .btn {
                min-width: 90px;
                width: auto;
                margin-bottom: 0.25rem;
            }

            /* Badge agama di mobile */
            .agama-badge {
                min-width: 70px;
                font-size: 0.75rem;
                padding: 4px 8px;
            }

            /* Tombol dengan teks di mobile */
            .d-flex.justify-content-center.gap-2 .btn i {
                margin-right: 5px;
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
        return confirm(`Apakah Anda yakin ingin menghapus data warga "${nama}"?`);
    }

    // Responsive table untuk mobile
    function makeTableResponsive() {
        if (window.innerWidth < 768) {
            const table = document.getElementById('wargaTable');
            const headers = table.querySelectorAll('thead th');
            const rows = table.querySelectorAll('tbody tr');

            headers.forEach((header, index) => {
                const label = header.textContent;
                rows.forEach(row => {
                    const cell = row.querySelectorAll('td')[index];
                    if (cell) {
                        cell.setAttribute('data-label', label);
                    }
                });
            });
        }
    }

    // Animasi untuk badge agama saat hover
    function initAgamaBadgeAnimations() {
        const agamaBadges = document.querySelectorAll('.agama-badge');

        agamaBadges.forEach(badge => {
            badge.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-2px)';
                this.style.boxShadow = '0 4px 8px rgba(0, 0, 0, 0.2)';
            });

            badge.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
                this.style.boxShadow = '0 2px 4px rgba(0, 0, 0, 0.1)';
            });
        });
    }

    // Jalankan saat halaman dimuat
    document.addEventListener('DOMContentLoaded', function() {
        makeTableResponsive();
        initAgamaBadgeAnimations();

        // Tambahkan event listener untuk resize window
        window.addEventListener('resize', makeTableResponsive);

        // Auto close alert setelah 5 detik
        setTimeout(function() {
            $('.alert').alert('close');
        }, 5000);
    });
</script>
@endpush
