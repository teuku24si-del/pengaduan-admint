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
        <div class="d-xl-flex justify-content-between align-items-start">
            <h2 class="text-dark font-weight-bold mb-2">Data Kategori Pengaduan</h2>
            <div class="d-sm-flex justify-content-xl-between align-items-center mb-2">
                <a href="{{ route('kategori_pengaduan.create') }}" class="btn btn-primary">
                    <i class="mdi mdi-plus-circle mr-1"></i>Tambah Kategori
                </a>
            </div>
        </div>

        <!-- Alert Success -->
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Daftar Kategori Pengaduan</h4>
                        <div class="table-responsive">
                            <table class="table table-striped kategori-table">
                                <thead>
                                    <tr class="table-header-gradient">
                                        <th class="header-no">No</th>
                                        <th class="header-nama">Nama Kategori</th>
                                        <th class="header-sla">Sela Hari</th>
                                        <th class="header-prioritas">Prioritas</th>
                                        <th class="header-aksi">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($datakategori_pengaduan as $index => $kategori)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $kategori->nama }}</td>
                                            <td>{{ $kategori->sla_hari }} hari</td>
                                            <td>
                                                @php
                                                    $badgeClass =
                                                        [
                                                            'rendah' => 'badge-info',
                                                            'sedang' => 'badge-warning',
                                                            'tinggi' => 'badge-danger',
                                                            'sangat_tinggi' => 'badge-dark',
                                                        ][$kategori->prioritas] ?? 'badge-secondary';
                                                @endphp
                                                <span class="badge {{ $badgeClass }}">
                                                    {{ ucfirst(str_replace('_', ' ', $kategori->prioritas)) }}
                                                </span>
                                            </td>

                                            <td>
                                                <a href="{{ route('kategori_pengaduan.edit', $kategori->kategori_id) }}"
                                                    class="btn btn-sm btn-warning" title="Edit">
                                                    <i class="mdi mdi-pencil"></i> Edit
                                                </a>
                                                <form
                                                    action="{{ route('kategori_pengaduan.destroy', $kategori->kategori_id) }}"
                                                    method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger" title="Hapus"
                                                        onclick="return confirm('Apakah Anda yakin ingin menghapus kategori ini?')">
                                                        <i class="mdi mdi-delete"></i> Hapus
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center">
                                                <div class="py-4">
                                                    <i class="mdi mdi-information-outline mr-2"
                                                        style="font-size: 24px;"></i>
                                                    <p class="mt-2">Belum ada data kategori pengaduan.
                                                    </p>
                                                    <a href="{{ route('kategori_pengaduan.create') }}"
                                                        class="btn btn-primary mt-2">
                                                        <i class="mdi mdi-plus-circle mr-1"></i>Tambah
                                                        Kategori Pertama
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            <div class="mt-3">
                                {{ $datakategori_pengaduan->links('pagination::bootstrap-5') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- end main content --}}

    <style>
        /* Styling untuk header tabel kategori pengaduan */
        .kategori-table thead .table-header-gradient {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        }

        .kategori-table thead th {
            padding: 16px 12px;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 0.5px;
            border: none;
            color: #2c3e50;
            position: relative;
            transition: all 0.3s ease;
            border-bottom: 3px solid transparent;
        }

        .kategori-table thead th:hover {
            background: linear-gradient(135deg, #e3e8f1 0%, #b8c6db 100%);
            transform: translateY(-2px);
        }

        /* Garis pembatas antar kolom */
        .kategori-table thead th:not(:last-child)::after {
            content: '';
            position: absolute;
            right: 0;
            top: 20%;
            height: 60%;
            width: 1px;
            background: rgba(44, 62, 80, 0.1);
        }

        /* Warna individual untuk setiap kolom */
        .kategori-table thead th.header-no {
            background: linear-gradient(135deg, #e3f2fd 0%, #bbdefb 100%);
            border-bottom-color: #2196f3;
        }

        .kategori-table thead th.header-nama {
            background: linear-gradient(135deg, #e8f5e8 0%, #c8e6c9 100%);
            border-bottom-color: #4caf50;
        }

        .kategori-table thead th.header-sla {
            background: linear-gradient(135deg, #fff3e0 0%, #ffe0b2 100%);
            border-bottom-color: #ff9800;
        }

        .kategori-table thead th.header-prioritas {
            background: linear-gradient(135deg, #fce4ec 0%, #f8bbd9 100%);
            border-bottom-color: #e91e63;
        }

        .kategori-table thead th.header-aksi {
            background: linear-gradient(135deg, #f3e5f5 0%, #e1bee7 100%);
            border-bottom-color: #9c27b0;
        }

        /* Efek hover untuk setiap kolom */
        .kategori-table thead th.header-no:hover {
            background: linear-gradient(135deg, #d1eaff 0%, #a6d5fa 100%);
        }

        .kategori-table thead th.header-nama:hover {
            background: linear-gradient(135deg, #d8f0d8 0%, #b2dfb2 100%);
        }

        .kategori-table thead th.header-sla:hover {
            background: linear-gradient(135deg, #ffecb3 0%, #ffcc80 100%);
        }

        .kategori-table thead th.header-prioritas:hover {
            background: linear-gradient(135deg, #f8bbd0 0%, #f48fb1 100%);
        }

        .kategori-table thead th.header-aksi:hover {
            background: linear-gradient(135deg, #e1bee7 0%, #ce93d8 100%);
        }

        /* Styling untuk baris data */
        .kategori-table tbody tr {
            transition: all 0.2s ease;
        }

        .kategori-table tbody tr:hover {
            background-color: #f8f9fa;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        /* Responsif untuk mobile */
        @media (max-width: 768px) {
            .kategori-table thead th {
                padding: 12px 8px;
                font-size: 0.8rem;
            }
        }
    </style>
@endsection
