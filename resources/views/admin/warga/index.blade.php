               @extends('layouts.admin.app')

                @section('content')
                {{--start main content---}}
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

                    <div class="row">
                        <div class="col-md-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Data Warga</h4>
                                    <p class="card-description">Daftar seluruh data warga yang telah terdaftar</p>

                                    @if (session('success'))
                                        <div class="alert alert-success">
                                            {{ session('success') }}
                                        </div>
                                    @endif

                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>

                                                <tr>
                                                    <th>No</th>
                                                    <th>Nama</th>
                                                    <th>Agama</th>
                                                    <th>Pekerjaan</th>
                                                    <th>Jenis Kelamin</th>
                                                    <th>Email</th>
                                                    <th>No HP</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($datawarga as $index => $warga)
                                                    <tr>
                                                        <td>{{ $index + 1 }}</td>
                                                        <td>{{ $warga->nama }}</td>
                                                        <td>{{ $warga->agama }}</td>
                                                        <td>{{ $warga->pekerjaan }}</td>
                                                        <td>{{ $warga->jenis_kelamin }}</td>
                                                        <td>{{ $warga->email }}</td>
                                                        <td>{{ $warga->No_Hp }}</td>

                                                        <td>
                                                            <div class="d-flex gap-1">
                                                                <!-- Tombol Edit -->
                                                                <a href="{{ route('warga.edit', $warga->warga_id) }}"
                                                                    class="btn btn-warning btn-sm">
                                                                    <i class="mdi mdi-pencil"></i> Edit
                                                                </a>

                                                                <!-- Tombol Hapus -->
                                                                <form
                                                                    action="{{ route('warga.destroy', $warga->warga_id) }}"
                                                                    method="POST" class="d-inline">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit"
                                                                        class="btn btn-danger btn-sm"
                                                                        onclick="return confirm('Apakah Anda yakin ingin menghapus data {{ $warga->nama }}?')">
                                                                        <i class="mdi mdi-delete"></i> Hapus
                                                                    </button>
                                                                </form>
                                                            </div>
                                                        </td>


                                                    </tr>

                                                    <!-- Modal Detail -->
                                                    <div class="modal fade" id="detailModal{{ $warga->id }}"
                                                        tabindex="-1" role="dialog"
                                                        aria-labelledby="detailModalLabel{{ $warga->id }}"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title"
                                                                        id="detailModalLabel{{ $warga->id }}">
                                                                        Detail Data Warga</h5>
                                                                    <button type="button" class="close"
                                                                        data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="row">
                                                                        <div class="col-md-4">
                                                                            <strong>Nama:</strong>
                                                                        </div>
                                                                        <div class="col-md-8">
                                                                            {{ $warga->nama }}
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mt-2">
                                                                        <div class="col-md-4">
                                                                            <strong>Agama:</strong>
                                                                        </div>
                                                                        <div class="col-md-8">
                                                                            {{ $warga->agama }}
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mt-2">
                                                                        <div class="col-md-4">
                                                                            <strong>Pekerjaan:</strong>
                                                                        </div>
                                                                        <div class="col-md-8">
                                                                            {{ $warga->pekerjaan }}
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mt-2">
                                                                        <div class="col-md-4">
                                                                            <strong>Jenis Kelamin:</strong>
                                                                        </div>
                                                                        <div class="col-md-8">
                                                                            {{ $warga->jenis_kelamin }}
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mt-2">
                                                                        <div class="col-md-4">
                                                                            <strong>Email:</strong>
                                                                        </div>
                                                                        <div class="col-md-8">
                                                                            {{ $warga->email }}
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mt-2">
                                                                        <div class="col-md-4">
                                                                            <strong>No HP:</strong>
                                                                        </div>
                                                                        <div class="col-md-8">
                                                                            {{ $warga->No_Hp }}
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-dismiss="modal">Tutup</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @empty
                                                    <tr>
                                                        <td colspan="8" class="text-center">Tidak ada data warga
                                                        </td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="mt-3">
                                        <a href="{{ route('warga.create') }}" class="btn btn-primary">
                                            <i class="mdi mdi-account-plus"></i> Tambah Data Warga Baru
                                        </a>
                                        <a href="{{ route('dashboard') }}" class="btn btn-light">Kembali ke
                                            Dashboard</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{--end main content--}}
               @endsection
