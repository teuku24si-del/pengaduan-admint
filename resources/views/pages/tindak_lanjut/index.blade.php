@extends('layouts.admin.app')

@section('content')
    <div class="content-wrapper">
        <!-- Header -->
        <div class="d-xl-flex justify-content-between align-items-start mb-4">
            <h2 class="text-dark font-weight-bold mb-2">Daftar Tindak Lanjut</h2>
            <div class="d-sm-flex justify-content-xl-between align-items-center">
                <a href="{{ route('tindak_lanjut.create') }}" class="btn btn-primary shadow-sm">
                    <i class="mdi mdi-plus-circle mr-1"></i>Tambah Tindak Lanjut
                </a>
            </div>
        </div>

        <!-- Card Table -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-gradient-primary text-white border-bottom-0 pt-4 pb-3">
                        <h4 class="card-title mb-0">
                            <i class="mdi mdi-clipboard-list mr-2"></i>Data Tindak Lanjut Pengaduan
                        </h4>
                        <p class="mb-0 opacity-75">Berikut adalah daftar seluruh tindak lanjut pengaduan</p>
                    </div>

                    <form action="{{ route('tindak_lanjut.index') }}" method="GET">
                        <div class="row mb-3 px-4">
                            <div class="col-md-3">
                                <label class="form-label mb-0">Filter aksi</label>
                                <select name="aksi" class="form-select" onchange="this.form.submit()">
                                    <option value="">Semua aksi</option>
                                    <option value="selesai" {{ request('aksi') == 'selesai' ? 'selected' : '' }}>Selesai
                                    </option>
                                    <option value="ditolak" {{ request('aksi') == 'ditolak' ? 'selected' : '' }}>Ditolak
                                    </option>
                                    
                                </select>
                            </div>

                            <div class="col-md-5">
                                <label class="form-label mb-0">Cari nomor tiket</label>
                                <div class="input-group">
                                    <input type="text" name="search" class="form-control"
                                        value="{{ request('search') }}" placeholder="Contoh: TKT2025...">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="mdi mdi-magnify"></i> Cari
                                    </button>
                                    @if (request('search') || request('aksi'))
                                        <a href="{{ route('tindak_lanjut.index') }}" class="btn btn-outline-secondary">
                                            <i class="mdi mdi-close"></i> Reset
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </form>

                    <div class="card-body pt-4">
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>Berhasil!</strong> {{ session('success') }}
                                <button type="button" class="close" data-dismiss="alert">
                                    <span>&times;</span>
                                </button>
                            </div>
                        @endif

                        @if (session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>Gagal!</strong> {{ session('error') }}
                                <button type="button" class="close" data-dismiss="alert">
                                    <span>&times;</span>
                                </button>
                            </div>
                        @endif

                        <!-- Table -->
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered">
                                <thead class="thead-light">
                                    <tr>
                                        <th class="text-center" style="width: 50px;">No</th>
                                        <th>No Tiket Pengaduan</th>
                                        <th>Deskripsi Pengaduan</th>
                                        <th>Petugas</th>
                                        <th>Status Tindakan</th>
                                        <th>Catatan</th>
                                        <th>Tanggal Dibuat</th>
                                        <th class="text-center" style="width: 150px;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($datatindak_lanjut as $index => $tindak)
                                        <tr>
                                            <td class="text-center align-middle">{{ $index + 1 }}</td>
                                            <td class="align-middle">
                                                @if ($tindak->pengaduan)
                                                    <span
                                                        class="badge badge-light border">{{ $tindak->pengaduan->no_tiket ?? '-' }}</span>
                                                @else
                                                    <span class="text-muted">-</span>
                                                @endif
                                            </td>
                                            <td class="align-middle">
                                                @if ($tindak->pengaduan)
                                                    {{ \Illuminate\Support\Str::limit($tindak->pengaduan->deskripsi, 50) }}
                                                @else
                                                    <span class="text-muted">Data pengaduan tidak ditemukan</span>
                                                @endif
                                            </td>
                                            <td class="align-middle">{{ $tindak->petugas }}</td>
                                            <td class="align-middle">
                                                @switch($tindak->aksi)
                                                    @case('sedang_diproses')
                                                        <span class="badge badge-warning">
                                                            <i class="mdi mdi-progress-clock mr-1"></i> Sedang Diproses
                                                        </span>
                                                    @break

                                                    @case('selesai')
                                                        <span class="badge badge-success">
                                                            <i class="mdi mdi-check-circle mr-1"></i> Selesai
                                                        </span>
                                                    @break

                                                    @case('ditolak')
                                                        <span class="badge badge-danger">
                                                            <i class="mdi mdi-close-circle mr-1"></i> Ditolak
                                                        </span>
                                                    @break

                                                    @default
                                                        <span class="badge badge-secondary">{{ $tindak->aksi }}</span>
                                                @endswitch
                                            </td>
                                            <td class="align-middle">
                                                {{ \Illuminate\Support\Str::limit($tindak->catatan, 30) }}
                                                @if (strlen($tindak->catatan) > 30)
                                                    <span class="text-muted">...</span>
                                                @endif
                                            </td>
                                            <td class="align-middle">
                                                {{ $tindak->created_at->format('d/m/Y H:i') }}
                                            </td>
                                            <td class="text-center align-middle">
                                                <div class="btn-group" role="group">
                                                    <!-- Tombol Detail -->
                                                    <button type="button" class="btn btn-info btn-sm" title="Detail"
                                                        data-toggle="tooltip" data-placement="top">
                                                        <i class="mdi mdi-eye"></i>
                                                    </button>

                                                    <!-- Tombol Edit -->
                                                    <a href="{{ route('tindak_lanjut.edit', $tindak->tindak_id) }}"
                                                        class="btn btn-warning btn-sm" title="Edit" data-toggle="tooltip"
                                                        data-placement="top">
                                                        <i class="mdi mdi-pencil"></i>
                                                    </a>

                                                    <!-- Tombol Hapus -->
                                                    <form action="{{ route('tindak_lanjut.destroy', $tindak->tindak_id) }}"
                                                        method="POST" class="d-inline" onsubmit="return confirmDelete()">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm" title="Hapus"
                                                            data-toggle="tooltip" data-placement="top">
                                                            <i class="mdi mdi-delete"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                        @empty
                                            <tr>
                                                <td colspan="8" class="text-center py-5">
                                                    <div class="empty-state">
                                                        <i class="mdi mdi-clipboard-text-off-outline"
                                                            style="font-size: 5rem; color: #e3e6f0;"></i>
                                                        <h5 class="mt-3 text-muted">Belum Ada Data Tindak Lanjut</h5>
                                                        <p class="text-muted mb-4">Silakan tambah tindak lanjut pertama Anda
                                                        </p>
                                                        <a href="{{ route('tindak_lanjut.create') }}"
                                                            class="btn btn-primary">
                                                            <i class="mdi mdi-plus-circle mr-1"></i>Tambah Tindak Lanjut
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                            <!-- Info Row Count -->
                            <div class="mt-4 pt-3 border-top">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="text-muted small">
                                        <i class="mdi mdi-information-outline mr-1"></i>
                                        Menampilkan <strong>{{ count($datatindak_lanjut) }}</strong> data tindak lanjut
                                    </div>
                                    {{ $datatindak_lanjut->links('pagination::bootstrap-5') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <style>
            /* Custom Styles */
            .bg-gradient-primary {
                background: linear-gradient(45deg, #4e73df, #224abe);
            }

            .card {
                border-radius: 10px;
                overflow: hidden;
                transition: all 0.3s ease;
            }

            .card:hover {
                box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            }

            .table {
                margin-bottom: 0;
            }

            .table thead th {
                border-top: none;
                font-weight: 600;
                text-transform: uppercase;
                font-size: 0.85rem;
                letter-spacing: 0.5px;
                color: #5a5c69;
                background-color: #f8f9fc;
                border-bottom: 2px solid #e3e6f0;
            }

            .table tbody tr {
                transition: all 0.2s ease;
            }

            .table tbody tr:hover {
                background-color: #f8f9fc;
                transform: translateY(-2px);
                box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            }

            .table td {
                vertical-align: middle;
                border-color: #e3e6f0;
            }

            .badge {
                font-size: 0.75rem;
                padding: 0.375em 0.75em;
                font-weight: 500;
                border-radius: 8px;
            }

            .badge-warning {
                background-color: #f6c23e;
                color: #fff;
            }

            .badge-success {
                background-color: #1cc88a;
                color: #fff;
            }

            .badge-danger {
                background-color: #e74a3b;
                color: #fff;
            }

            .badge-light {
                background-color: #f8f9fc;
                color: #3a3b45;
                border: 1px solid #e3e6f0;
            }

            .btn-group .btn {
                margin: 0 2px;
                border-radius: 6px;
            }

            .btn-sm {
                padding: 0.375rem 0.75rem;
                font-size: 0.875rem;
            }

            .btn-info {
                background-color: #36b9cc;
                border-color: #36b9cc;
            }

            .btn-info:hover {
                background-color: #2c9faf;
                border-color: #2c9faf;
            }

            .btn-warning {
                background-color: #f6c23e;
                border-color: #f6c23e;
            }

            .btn-warning:hover {
                background-color: #f4b619;
                border-color: #f4b619;
            }

            .btn-danger {
                background-color: #e74a3b;
                border-color: #e74a3b;
            }

            .btn-danger:hover {
                background-color: #e02d1b;
                border-color: #e02d1b;
            }

            .empty-state {
                padding: 3rem 1rem;
            }

            .empty-state i {
                opacity: 0.5;
            }

            .btn-primary {
                background: linear-gradient(45deg, #4e73df, #224abe);
                border: none;
                border-radius: 8px;
                font-weight: 500;
                transition: all 0.3s ease;
            }

            .btn-primary:hover {
                transform: translateY(-2px);
                box-shadow: 0 5px 15px rgba(78, 115, 223, 0.3);
            }

            .alert {
                border-radius: 8px;
                border: none;
            }

            .alert-success {
                background-color: #d1e7dd;
                color: #0f5132;
            }

            .alert-danger {
                background-color: #f8d7da;
                color: #842029;
            }

            /* Responsive adjustments */
            @media (max-width: 768px) {
                .table-responsive {
                    border: 1px solid #e3e6f0;
                    border-radius: 8px;
                    overflow: auto;
                }

                .table {
                    min-width: 800px;
                }

                .btn-group {
                    flex-direction: column;
                }

                .btn-group .btn {
                    margin: 2px 0;
                    width: 100%;
                }
            }
        </style>

        <script>
            // Konfirmasi sebelum menghapus
            function confirmDelete() {
                return confirm('Apakah Anda yakin ingin menghapus data tindak lanjut ini?');
            }

            // Inisialisasi tooltip
            document.addEventListener('DOMContentLoaded', function() {
                // Enable Bootstrap tooltips
                var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-toggle="tooltip"]'));
                var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
                    return new bootstrap.Tooltip(tooltipTriggerEl);
                });

                // Auto-hide alerts after 5 seconds
                setTimeout(function() {
                    var alerts = document.querySelectorAll('.alert');
                    alerts.forEach(function(alert) {
                        var bsAlert = new bootstrap.Alert(alert);
                        bsAlert.close();
                    });
                }, 5000);
            });

            // Tambahkan efek hover pada tombol detail dan edit (walaupun belum berfungsi)
            document.addEventListener('DOMContentLoaded', function() {
                const detailButtons = document.querySelectorAll('.btn-info');
                const editButtons = document.querySelectorAll('.btn-warning');

                detailButtons.forEach(button => {
                    button.addEventListener('click', function(e) {
                        e.preventDefault();
                        alert('Fitur detail belum diimplementasikan');
                    });
                });

                editButtons.forEach(button => {
                    if (button.getAttribute('href') === '#') {
                        button.addEventListener('click', function(e) {
                            e.preventDefault();
                            alert('Fitur edit belum diimplementasikan');
                        });
                    }
                });
            });
        </script>
    @endsection
