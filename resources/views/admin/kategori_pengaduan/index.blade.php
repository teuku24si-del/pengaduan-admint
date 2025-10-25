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
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Nama Kategori</th>
                                                    <th>Sela Hari</th>
                                                    <th>Prioritas</th>

                                                    <th>Aksi</th>
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
                                                                <button type="submit" class="btn btn-sm btn-danger"
                                                                    title="Hapus"
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
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{--end main content--}}
                @endsection

