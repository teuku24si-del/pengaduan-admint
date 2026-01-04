@extends('layouts.admin.app')

@section('content')
<div class="content-wrapper">
    <!-- Banner -->
    

    <div class="d-xl-flex justify-content-between align-items-start mb-4">
        <h2 class="text-dark font-weight-bold mb-2">Data User</h2>
        <div class="d-flex gap-2">
            <a href="{{ route('user.create') }}" class="btn btn-primary">
                <i class="mdi mdi-plus-circle mr-1"></i> Tambah User
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

    <!-- Search and Filter Container -->
    <div class="card mb-4 shadow-sm border-0">
        <div class="card-header bg-white">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0 text-primary">
                    <i class="mdi mdi-filter-outline mr-2"></i>Filter & Pencarian
                </h5>
                <span class="badge badge-light">
                    {{ $dataUser->count() }} dari {{ $dataUser->total() }} data ditampilkan
                </span>
            </div>
        </div>
        <div class="card-body">
            <form method="GET" action="{{ route('user.index') }}" class="row g-3 align-items-center">
                <div class="col-md-3 mb-3 mb-md-0">
                    <label class="font-weight-bold small text-muted">Filter Role</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-light border-right-0">
                                <i class="mdi mdi-account-cog text-primary"></i>
                            </span>
                        </div>
                        <select name="role" class="form-control border-left-0" onchange="this.form.submit()">
                            <option value="">Semua Role</option>
                            <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="staff" {{ request('role') == 'staff' ? 'selected' : '' }}>Staff</option>
                            <option value="kades" {{ request('role') == 'kades' ? 'selected' : '' }}>Kepala Desa</option>
                        </select>
                    </div>
                </div>

                <div class="col-md-5 mb-3 mb-md-0">
                    <label class="font-weight-bold small text-muted">Cari User</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-light border-right-0">
                                <i class="mdi mdi-magnify"></i>
                            </span>
                        </div>
                        <input type="text" name="search" class="form-control border-left-0"
                            value="{{ request('search') }}" placeholder="Cari berdasarkan nama atau email...">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-primary">
                                <i class="mdi mdi-search"></i> Cari
                            </button>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="d-flex gap-2">
                        @if(request('search') || request('role'))
                            <a href="{{ route('user.index') }}" class="btn btn-light flex-fill">
                                <i class="mdi mdi-close-circle-outline mr-1"></i> Reset Filter
                            </a>
                        @endif

                    </div>
                </div>
            </form>

            <!-- Active Filter Badges -->
            @if(request('search') || request('role'))
                <div class="row mt-3">
                    <div class="col-12">
                        <div class="d-flex align-items-center">

                            <div class="d-flex flex-wrap gap-2">
                                @if(request('search'))
                                    <span class="badge badge-primary p-2">
                                        <i class="mdi mdi-magnify mr-1"></i>
                                        Pencarian: "{{ request('search') }}"
                                        <button type="button" class="btn-close-filter ml-2"
                                                onclick="removeFilter('search')" style="background: none; border: none; color: white; font-size: 0.8rem;">
                                            ×
                                        </button>
                                    </span>
                                @endif
                                @if(request('role'))
                                    <span class="badge badge-warning p-2">
                                        @php
                                            $roleNames = [
                                                'admin' => 'Admin',
                                                'staff' => 'Staff',
                                                'kades' => 'Kepala Desa'
                                            ];
                                        @endphp
                                        <i class="mdi mdi-account-cog mr-1"></i>
                                        Role: {{ $roleNames[request('role')] ?? request('role') }}
                                        <button type="button" class="btn-close-filter ml-2"
                                                onclick="removeFilter('role')" style="background: none; border: none; color: white; font-size: 0.8rem;">
                                            ×
                                        </button>
                                    </span>
                                @endif

                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div>
                            <h4 class="card-title mb-0">Daftar User Sistem</h4>
                            <p class="card-description mb-0">Kelola semua user yang memiliki akses ke sistem</p>
                        </div>
                        <div class="badge badge-info p-2">
                            Total: {{ $dataUser->total() }} User
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-striped custom-table" id="userTable">
                            <thead>
                                <tr class="table-header">
                                    <th width="60">#</th>
                                    <th width="200">NAME</th>
                                    <th width="250">EMAIL</th>
                                    <th width="150">ROLE</th>
                                    <th width="220" class="text-center">AKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($dataUser as $index => $user)
                                <tr>
                                    <td class="text-center">
                                        <div class="user-number">{{ ($dataUser->currentPage() - 1) * $dataUser->perPage() + $loop->iteration }}</div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-sm me-2">
                                                <div class="avatar-title bg-primary rounded-circle text-white">
                                                    {{ substr($user->name, 0, 1) }}
                                                </div>
                                            </div>
                                            <div>
                                                <strong class="text-truncate" style="max-width: 150px; display: inline-block;"
                                                      title="{{ $user->name }}">
                                                    {{ $user->name }}
                                                </strong>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="text-truncate" style="max-width: 230px;" title="{{ $user->email }}">
                                            <i class="mdi mdi-email-outline text-primary mr-1"></i>
                                            {{ $user->email }}
                                        </div>
                                    </td>
                                    <td>
                                        @if($user->role == 'admin')
                                            <span class="badge badge-admin">
                                                <i class="mdi mdi-shield-crown mr-1"></i>Admin
                                            </span>
                                        @elseif($user->role == 'staff')
                                            <span class="badge badge-staff">
                                                <i class="mdi mdi-account-cog mr-1"></i>Staff
                                            </span>
                                        @elseif($user->role == 'kades')
                                            <span class="badge badge-kades">
                                                <i class="mdi mdi-account-tie mr-1"></i>Kepala Desa
                                            </span>
                                        @else
                                            <span class="badge badge-secondary">
                                                {{ ucfirst($user->role) }}
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-center gap-2">
                                            <!-- Tombol Edit -->
                                            <a href="{{ route('user.edit', $user->id) }}"
                                               class="btn btn-warning btn-sm btn-action">
                                                <i class="mdi mdi-pencil mr-1"></i>Edit
                                            </a>

                                            <!-- Tombol Hapus -->
                                            <form action="{{ route('user.destroy', $user->id) }}"
                                                  method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm btn-action"
                                                    onclick="return confirmDelete('{{ $user->name }}')">
                                                    <i class="mdi mdi-delete mr-1"></i>Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center py-4">
                                        <div class="empty-state">
                                            <i class="mdi mdi-account-group-outline display-4 text-muted"></i>
                                            <h5 class="mt-3">Belum ada data user</h5>
                                            @if(request('search') || request('role'))
                                                <p class="text-muted">Tidak ditemukan data dengan filter yang dipilih</p>
                                                <a href="{{ route('user.index') }}"
                                                   class="btn btn-primary mt-2">
                                                    <i class="mdi mdi-close mr-1"></i> Reset Filter
                                                </a>
                                            @else
                                                <p class="text-muted">Silakan tambah user baru untuk memulai</p>
                                                <a href="{{ route('user.create') }}" class="btn btn-primary mt-2">
                                                    <i class="mdi mdi-plus-circle mr-1"></i> Tambah User
                                                </a>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>

                        <!-- Pagination -->
                        @if($dataUser->hasPages())
                            <div class="mt-4">
                                {{ $dataUser->withQueryString()->links('pagination::bootstrap-5') }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

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
        /* # */
        background: linear-gradient(135deg, #667eea 0%, #6a5df5 100%);
    }

    .custom-table thead th:nth-child(2) {
        /* NAME */
        background: linear-gradient(135deg, #6a5df5 0%, #764ba2 100%);
    }

    .custom-table thead th:nth-child(3) {
        /* EMAIL */
        background: linear-gradient(135deg, #764ba2 0%, #8a3f9c 100%);
    }

    .custom-table thead th:nth-child(4) {
        /* ROLE */
        background: linear-gradient(135deg, #8a3f9c 0%, #9a36a2 100%);
    }

    .custom-table thead th:nth-child(5) {
        /* AKSI */
        background: linear-gradient(135deg, #9a36a2 0%, #a82bab 100%);
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

    /* User number styling */
    .user-number {
        width: 32px;
        height: 32px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
        margin: 0 auto;
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

    /* Badge styling untuk role */
    .badge-admin {
        background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
        color: white !important;
        padding: 6px 12px;
        border-radius: 20px;
        font-weight: 500;
        font-size: 0.8rem;
        display: inline-flex;
        align-items: center;
    }

    .badge-staff {
        background: linear-gradient(135deg, #ffc107 0%, #e0a800 100%);
        color: #212529 !important;
        padding: 6px 12px;
        border-radius: 20px;
        font-weight: 500;
        font-size: 0.8rem;
        display: inline-flex;
        align-items: center;
    }

    .badge-kades {
        background: linear-gradient(135deg, #28a745 0%, #218838 100%);
        color: white !important;
        padding: 6px 12px;
        border-radius: 20px;
        font-weight: 500;
        font-size: 0.8rem;
        display: inline-flex;
        align-items: center;
    }

    /* Text truncate */
    .text-truncate {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        vertical-align: middle;
    }

    /* Tombol action */
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

    /* Alert styling */
    .alert {
        border-radius: 8px;
        border: none;
    }

    .alert-danger {
        background-color: #fee;
        color: #c7254e;
    }

    .alert-success {
        background-color: #e8f7ee;
        color: #28a745;
    }

    /* Filter card styling */
    .card-header.bg-white {
        border-bottom: 2px solid #f8f9fa;
    }

    .form-control:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
    }

    .input-group-text {
        background-color: #f8f9fa;
        border-color: #dee2e6;
    }

    .btn-close-filter {
        cursor: pointer;
        opacity: 0.8;
        transition: opacity 0.2s;
    }

    .btn-close-filter:hover {
        opacity: 1;
    }

    /* Pagination styling */
    .pagination .page-item.active .page-link {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-color: #667eea;
    }

    .pagination .page-link {
        color: #667eea;
        border: 1px solid #dee2e6;
    }

    .pagination .page-link:hover {
        background-color: #f8f9fa;
        border-color: #dee2e6;
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
            min-width: 80px;
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

        .user-number {
            width: 28px;
            height: 28px;
            font-size: 0.9rem;
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

        .user-number {
            background-color: #667eea;
        }

        .badge-admin {
            background-color: #dc3545 !important;
        }

        .badge-staff {
            background-color: #ffc107 !important;
        }

        .badge-kades {
            background-color: #28a745 !important;
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
    function confirmDelete(userName) {
        return confirm(`Apakah Anda yakin ingin menghapus user "${userName}"?`);
    }

    // Responsive table untuk mobile
    function makeTableResponsive() {
        if (window.innerWidth < 768) {
            const table = document.getElementById('userTable');
            const rows = table.querySelectorAll('tbody tr');

            const headerLabels = [
                '#',
                'NAME',
                'EMAIL',
                'ROLE',
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

    // Remove individual filter
    function removeFilter(filterName) {
        const url = new URL(window.location.href);
        url.searchParams.delete(filterName);
        window.location.href = url.toString();
    }

    // Attach remove filter functionality
    document.querySelectorAll('.btn-close-filter').forEach(button => {
        button.addEventListener('click', function() {
            const filterName = this.getAttribute('onclick').match(/removeFilter\('(\w+)'\)/)[1];
            removeFilter(filterName);
        });
    });

    // Auto submit form saat memilih role
    const roleSelect = document.querySelector('select[name="role"]');
    if (roleSelect) {
        roleSelect.addEventListener('change', function() {
            this.closest('form').submit();
        });
    }

    // Add enter key submit for search
    const searchInput = document.querySelector('input[name="search"]');
    if (searchInput) {
        searchInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                this.closest('form').submit();
            }
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
