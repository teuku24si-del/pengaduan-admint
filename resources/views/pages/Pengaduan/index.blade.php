@extends('layouts.admin.app')

@section('content')
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
            <h2 class="text-dark font-weight-bold mb-2">Data Pengaduan</h2>
            <div class="d-sm-flex justify-content-xl-between align-items-center mb-2">
                <a href="{{ route('Pengaduan.create') }}" class="btn btn-primary">
                    <i class="mdi mdi-plus-circle btn-icon-prepend"></i>
                    Tambah Pengaduan
                </a>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>No. Tiket</th>
                                        <th>Warga</th>
                                        <th>Kategori</th>
                                        <th>Judul</th>
                                        <th>Lokasi</th>
                                        <th>RT/RW</th>
                                        <th>Status</th>
                                        <th>Tanggal</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($dataPengaduan as $pengaduan)
                                    <tr>
                                        <td>
                                            <span class="badge badge-info">{{ $pengaduan->no_tiket }}</span>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="mr-3">
                                                    <i class="mdi mdi-account-circle icon-md text-dark"></i>
                                                </div>
                                                <div>
                                                    <div class="font-weight-bold">{{ $pengaduan->warga->nama ?? 'N/A' }}</div>
                                                    <small class="text-muted">{{ $pengaduan->warga->nama ?? 'N/A' }}</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="font-weight-bold">{{ $pengaduan->kategori->nama ?? 'N/A' }}</span>
                                            <br>
                                            <small class="text-muted">SLA: {{ $pengaduan->kategori->sla_hari ?? '0' }} hari</small>
                                        </td>
                                        <td>
                                            <div class="font-weight-bold">{{ Str::limit($pengaduan->judul, 30) }}</div>
                                            <small class="text-muted">{{ Str::limit($pengaduan->deskripsi, 40) }}</small>
                                        </td>
                                        <td>{{ Str::limit($pengaduan->lokasi_text, 20) }}</td>
                                        <td>
                                            <span class="badge badge-light">RT {{ $pengaduan->rt }}</span>
                                            <span class="badge badge-light">RW {{ $pengaduan->rw }}</span>
                                        </td>
                                        <td>
                                            @if($pengaduan->status == 'sedang_diproses')
                                                <span class="badge badge-warning">Sedang Diproses</span>
                                            @elseif($pengaduan->status == 'sudah_selesai')
                                                <span class="badge badge-success">Selesai</span>
                                            @else
                                                <span class="badge badge-secondary">{{ $pengaduan->status }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            <small>{{ $pengaduan->created_at->format('d/m/Y') }}</small>
                                            <br>
                                            <small class="text-muted">{{ $pengaduan->created_at->format('H:i') }}</small>
                                        </td>
                                        <td>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-outline-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Aksi
                                                </button>
                                                <div class="dropdown-menu">

                                                    <a class="dropdown-item" href="{{ route('Pengaduan.edit', $pengaduan->pengaduan_id) }}">
                                                        <i class="mdi mdi-pencil mr-2"></i>Edit
                                                    </a>
                                                    <div class="dropdown-divider"></div>
                                                    <form action="{{ route('Pengaduan.destroy', $pengaduan->pengaduan_id) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="dropdown-item text-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus pengaduan ini?')">
                                                            <i class="mdi mdi-delete mr-2"></i>Hapus
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="9" class="text-center py-4">
                                            <div class="text-muted">
                                                <i class="mdi mdi-information-outline icon-md"></i>
                                                <p class="mt-2">Belum ada data pengaduan</p>
                                                <a href="{{ route('Pengaduan.create') }}" class="btn btn-primary btn-sm">Tambah Pengaduan Pertama</a>
                                            </div>
                                        </td>
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
    {{--end main content--}}
@endsection
