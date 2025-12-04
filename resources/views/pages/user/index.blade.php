@extends('layouts.admin.app')

@section('content')
<div class="content-wrapper">
    <!-- Banner dan kode lainnya tetap sama -->

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h4 class="card-title">Data User</h4>
                        <a href="{{ route('user.create') }}" class="btn btn-primary btn-sm">
                            <i class="mdi mdi-plus"></i> Tambah User
                        </a>
                    </div>

                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-striped user-table">
                            <thead>
                                <tr class="table-header-custom">
                                    <th class="header-number">#</th>
                                    <th class="header-name">Name</th>
                                    <th class="header-email">Email</th>
                                    <th class="header-role">Role</th> <!-- TAMBAHAN KOLOM ROLE -->
                                    <th class="header-action">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($dataUser as $user)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        @if($user->role == 'admin')
                                            <span class="badge badge-danger">Admin</span>
                                        @elseif($user->role == 'staff')
                                            <span class="badge badge-warning">Staff</span>
                                        @elseif($user->role == 'kades')
                                            <span class="badge badge-success">Kades</span>
                                        @else
                                            <span class="badge badge-secondary">{{ $user->role }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('user.edit', $user->id) }}" class="btn btn-warning btn-sm">
                                                <i class="mdi mdi-pencil"></i> Edit
                                            </a>
                                            <form action="{{ route('user.destroy', $user->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus user ini?')">
                                                    <i class="mdi mdi-delete"></i> Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center">Tidak ada data user</td> <!-- Ubah colspan dari 4 ke 5 -->
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Styling untuk header tabel user */
.user-table thead .table-header-custom {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}

.user-table thead th {
    padding: 16px 12px;
    font-weight: 600;
    text-transform: uppercase;
    font-size: 0.85rem;
    letter-spacing: 0.5px;
    border: none;
    color: white;
    position: relative;
    transition: all 0.3s ease;
    border-bottom: 3px solid transparent;
}

.user-table thead th:hover {
    background: linear-gradient(135deg, #5a6fd8 0%, #6a42a0 100%);
    transform: translateY(-2px);
}

/* Garis pembatas antar kolom */
.user-table thead th:not(:last-child)::after {
    content: '';
    position: absolute;
    right: 0;
    top: 20%;
    height: 60%;
    width: 1px;
    background: rgba(255, 255, 255, 0.3);
}

/* Warna individual untuk setiap kolom dengan variasi */
.user-table thead th.header-number {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-bottom-color: #4a5fc9;
}

.user-table thead th.header-name {
    background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
    border-bottom-color: #e4455a;
}

.user-table thead th.header-email {
    background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
    border-bottom-color: #00c6fe;
}

/* TAMBAHAN STYLE UNTUK HEADER ROLE */
.user-table thead th.header-role {
    background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);
    border-bottom-color: #f9a826;
}

.user-table thead th.header-action {
    background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
    border-bottom-color: #2ce0b7;
}

/* Efek hover untuk setiap kolom */
.user-table thead th.header-number:hover {
    background: linear-gradient(135deg, #5a6fd8 0%, #6a42a0 100%);
}

.user-table thead th.header-name:hover {
    background: linear-gradient(135deg, #e083ed 0%, #e4455a 100%);
}

.user-table thead th.header-email:hover {
    background: linear-gradient(135deg, #3a9cfd 0%, #00d9e6 100%);
}

.user-table thead th.header-role:hover {
    background: linear-gradient(135deg, #e86391 0%, #f7d03e 100%);
}

.user-table thead th.header-action:hover {
    background: linear-gradient(135deg, #3ad672 0%, #2ce0b7 100%);
}

/* Styling untuk baris data */
.user-table tbody tr {
    transition: all 0.2s ease;
}

.user-table tbody tr:hover {
    background-color: #f8f9fa;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
}

/* Styling untuk badge role */
.badge {
    padding: 5px 12px;
    border-radius: 20px;
    font-weight: 600;
    font-size: 0.75rem;
}

.badge-danger {
    background-color: #f44336;
    color: white;
}

.badge-warning {
    background-color: #ff9800;
    color: white;
}

.badge-success {
    background-color: #4caf50;
    color: white;
}

.badge-secondary {
    background-color: #6c757d;
    color: white;
}

/* Styling untuk tombol aksi */
.user-table .btn-group .btn {
    margin: 0 2px;
    border-radius: 4px;
    transition: all 0.3s ease;
}

.user-table .btn-group .btn:hover {
    transform: translateY(-1px);
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
}

/* Responsif untuk mobile */
@media (max-width: 768px) {
    .user-table thead th {
        padding: 12px 8px;
        font-size: 0.8rem;
    }

    .user-table .btn-group {
        display: flex;
        flex-direction: column;
        gap: 5px;
    }

    .user-table .btn-group .btn {
        margin: 0;
        width: 100%;
    }
}
</style>
@endsection
