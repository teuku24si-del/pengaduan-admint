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
            <h2 class="text-dark font-weight-bold mb-2">Data Tindak Lanjut</h2>
            <div class="d-flex gap-2">
                <a href="{{ route('tindak_lanjut.create') }}" class="btn btn-primary">
                    <i class="mdi mdi-plus-circle mr-1"></i> Tambah Tindak Lanjut
                </a>
                <a href="{{ route('Pengaduan.index') }}" class="btn btn-light">
                    <i class="mdi mdi-arrow-left"></i> Kembali ke tabel pengaduan
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
                                <h4 class="card-title mb-0">Daftar Tindak Lanjut Pengaduan</h4>
                                <p class="card-description mb-0">Kelola semua tindak lanjut pengaduan</p>
                            </div>
                            <div class="badge badge-info p-2">
                                Total: {{ $datatindak_lanjut->total() }} Tindak Lanjut
                            </div>
                        </div>

                        <!-- Filter dan Search Section -->
                        <div class="card mb-4">
                            <div class="card-body py-3">
                                <form method="GET" action="{{ route('tindak_lanjut.index') }}"
                                    class="row g-3 align-items-center">
                                    <div class="col-md-2">
                                        <label class="form-label mb-0">Filter Status</label>
                                        <select name="aksi" class="form-select" onchange="this.form.submit()">
                                            <option value="">Semua Status</option>
                                            <option value="selesai" {{ request('aksi') == 'selesai' ? 'selected' : '' }}>
                                                Selesai
                                            </option>
                                            <option value="ditolak" {{ request('aksi') == 'ditolak' ? 'selected' : '' }}>
                                                Ditolak
                                            </option>
                                        </select>
                                    </div>

                                    <div class="col-md-4">
                                        <label class="form-label mb-0">Cari Tindak Lanjut</label>
                                        <div class="input-group">
                                            <input type="text" name="search" class="form-control"
                                                value="{{ request('search') }}" placeholder="Cari nomor tiket/petugas...">
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
                            <table class="table table-striped custom-table" id="tindakLanjutTable">
                                <thead>
                                    <tr class="table-header">
                                        <th width="100">NO</th>
                                        <th width="150">NO. TIKET</th>
                                        <th width="200">DESKRIPSI</th>
                                        <th width="150">PETUGAS</th>
                                        <th width="130">STATUS</th>
                                        <th width="180">CATATAN</th>
                                        <th width="120">TANGGAL</th>
                                        <th width="200" class="text-center">AKSI</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($datatindak_lanjut as $index => $tindak)
                                        <tr>
                                            <td class="text-center">
                                                <span class="badge badge-tiket"
                                                    style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                                                    {{ $index + 1 }}
                                                </span>
                                            </td>
                                            <td>
                                                @if ($tindak->pengaduan)
                                                    <div class="d-flex align-items-center">
                                                        <div class="avatar-sm me-2">
                                                            <div class="avatar-title bg-primary rounded-circle text-white">
                                                                <i class="mdi mdi-ticket-outline"></i>
                                                            </div>
                                                        </div>
                                                        <div>
                                                            <strong class="text-truncate"
                                                                style="max-width: 130px; display: inline-block;"
                                                                title="{{ $tindak->pengaduan->no_tiket ?? 'N/A' }}">
                                                                {{ $tindak->pengaduan->no_tiket ?? 'N/A' }}
                                                            </strong>
                                                            <br>
                                                            <small class="text-muted">ID: {{ $tindak->tindak_id }}</small>
                                                        </div>
                                                    </div>
                                                @else
                                                    <span class="text-muted">-</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($tindak->pengaduan)
                                                    <div class="font-weight-bold text-truncate" style="max-width: 200px;"
                                                        title="{{ $tindak->pengaduan->judul ?? '-' }}">
                                                        {{ Str::limit($tindak->pengaduan->judul ?? '-', 25) }}
                                                    </div>
                                                    <small class="text-muted text-truncate d-block"
                                                        style="max-width: 200px;"
                                                        title="{{ $tindak->pengaduan->deskripsi ?? '-' }}">
                                                        {{ Str::limit($tindak->pengaduan->deskripsi ?? '-', 35) }}
                                                    </small>
                                                @else
                                                    <span class="text-muted">Data tidak ditemukan</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar-sm me-2">
                                                        <div class="avatar-title bg-secondary rounded-circle text-white">
                                                            {{ substr($tindak->petugas, 0, 1) }}
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <strong class="text-truncate"
                                                            style="max-width: 120px; display: inline-block;"
                                                            title="{{ $tindak->petugas }}">
                                                            {{ Str::limit($tindak->petugas, 15) }}
                                                        </strong>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                @if ($tindak->aksi == 'selesai')
                                                    <span class="badge badge-completed"
                                                        style="background: linear-gradient(135deg, #4CAF50 0%, #2E7D32 100%);">
                                                        <i class="mdi mdi-check-circle mr-1"></i>Selesai
                                                    </span>
                                                @elseif($tindak->aksi == 'ditolak')
                                                    <span class="badge badge-danger"
                                                        style="background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);">
                                                        <i class="mdi mdi-close-circle mr-1"></i>Ditolak
                                                    </span>
                                                @else
                                                    <span class="badge badge-secondary">
                                                        {{ $tindak->aksi }}
                                                    </span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="text-truncate" style="max-width: 170px;"
                                                    title="{{ $tindak->catatan }}">
                                                    <i class="mdi mdi-note-text text-info mr-1"></i>
                                                    {{ Str::limit($tindak->catatan, 30) }}
                                                </div>
                                            </td>
                                            <td>
                                                <div class="text-center">
                                                    <div class="font-weight-bold text-primary">
                                                        {{ $tindak->created_at->format('d/m/Y') }}
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex justify-content-center gap-2">
                                                    <!-- Tombol Detail -->
                                                    <a href="{{ route('tindak_lanjut.show', $tindak->tindak_id) }}"
                                                        class="btn btn-info btn-sm btn-action" title="Lihat Detail">
                                                        <i class="mdi mdi-eye mr-1"></i>Detail
                                                    </a>

                                                    <!-- Tombol Edit -->
                                                    <a href="{{ route('tindak_lanjut.edit', $tindak->tindak_id) }}"
                                                        class="btn btn-warning btn-sm btn-action" title="Edit Data">
                                                        <i class="mdi mdi-pencil mr-1"></i>Edit
                                                    </a>

                                                    <!-- Tombol Hapus -->
                                                    <form
                                                        action="{{ route('tindak_lanjut.destroy', $tindak->tindak_id) }}"
                                                        method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm btn-action"
                                                            onclick="return confirmDelete('{{ $tindak->tindak_id }}')"
                                                            title="Hapus Data">
                                                            <i class="mdi mdi-delete mr-1"></i>Hapus
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="8" class="text-center py-4">
                                                <div class="empty-state">
                                                    <i class="mdi mdi-clipboard-text-outline display-4 text-muted"></i>
                                                    <h5 class="mt-3">Belum ada data tindak lanjut</h5>
                                                    <p class="text-muted">Silakan tambah tindak lanjut baru untuk memulai
                                                    </p>
                                                    <a href="{{ route('tindak_lanjut.create') }}"
                                                        class="btn btn-primary mt-2">
                                                        <i class="mdi mdi-plus-circle mr-1"></i> Tambah Tindak Lanjut
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>

                            <!-- Pagination -->
                            @if ($datatindak_lanjut->hasPages())
                                <div class="mt-4">
                                    <nav aria-label="Page navigation">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="text-muted">
                                                Menampilkan {{ $datatindak_lanjut->firstItem() }} hingga
                                                {{ $datatindak_lanjut->lastItem() }}
                                                dari {{ $datatindak_lanjut->total() }} data
                                            </div>
                                            {{ $datatindak_lanjut->links('pagination::bootstrap-5') }}
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
            background: linear-gradient(135deg, #667eea 0%, #6a5df5 100%);
        }

        .custom-table thead th:nth-child(2) {
            background: linear-gradient(135deg, #6a5df5 0%, #764ba2 100%);
        }

        .custom-table thead th:nth-child(3) {
            background: linear-gradient(135deg, #764ba2 0%, #8a3f9c 100%);
        }

        .custom-table thead th:nth-child(4) {
            background: linear-gradient(135deg, #8a3f9c 0%, #9a36a2 100%);
        }

        .custom-table thead th:nth-child(5) {
            background: linear-gradient(135deg, #9a36a2 0%, #a82bab 100%);
        }

        .custom-table thead th:nth-child(6) {
            background: linear-gradient(135deg, #a82bab 0%, #b724ba 100%);
        }

        .custom-table thead th:nth-child(7) {
            background: linear-gradient(135deg, #b724ba 0%, #c51fba 100%);
        }

        .custom-table thead th:nth-child(8) {
            background: linear-gradient(135deg, #c51fba 0%, #d31aba 100%);
        }

        /* Efek hover untuk setiap kolom */
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

        .badge-danger {
            color: white !important;
            font-weight: 500;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
        }

        .badge-completed {
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

            .badge-danger {
                background-color: #dc3545 !important;
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
        function confirmDelete(tindakId) {
            return confirm(`Apakah Anda yakin ingin menghapus tindak lanjut dengan ID "${tindakId}"?`);
        }

        // Show detail modal
        function showDetail(tindakId) {
            Swal.fire({
                title: 'Detail Tindak Lanjut',
                html: `
                <div class="text-start">
                    <div class="mb-3 text-center">
                        <div class="avatar-lg bg-gradient-primary text-white rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3">
                            <i class="mdi mdi-information" style="font-size: 2rem;"></i>
                        </div>
                        <h5 class="text-primary">ID: TL-${tindakId}</h5>
                    </div>
                    <div class="alert alert-info">
                        <i class="mdi mdi-lightbulb-on-outline me-2"></i>
                        <strong>Fitur detail sedang dalam pengembangan</strong>
                        <p class="mb-0 mt-1 small">Silakan gunakan tombol edit untuk melihat detail lengkap</p>
                    </div>
                </div>
            `,
                icon: 'info',
                confirmButtonColor: '#6a11cb',
                confirmButtonText: 'Mengerti',
                customClass: {
                    popup: 'animated fadeIn'
                }
            });
        }

        // Responsive table untuk mobile
        function makeTableResponsive() {
            if (window.innerWidth < 768) {
                const table = document.getElementById('tindakLanjutTable');
                const rows = table.querySelectorAll('tbody tr');

                const headerLabels = [
                    'NO',
                    'NO. TIKET',
                    'DESKRIPSI',
                    'PETUGAS',
                    'STATUS',
                    'CATATAN',
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

            // Add animation to cards
            const cards = document.querySelectorAll('.card');
            cards.forEach(card => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(20px)';

                setTimeout(() => {
                    card.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
                    card.style.opacity = '1';
                    card.style.transform = 'translateY(0)';
                }, 100);
            });
        });
    </script>
@endpush
