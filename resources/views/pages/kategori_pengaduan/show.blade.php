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
            <h2 class="text-dark font-weight-bold mb-2">Detail Kategori Pengaduan</h2>
            <div class="d-sm-flex justify-content-xl-between align-items-center mb-2">
                <a href="{{ route('kategori_pengaduan.index') }}" class="btn btn-secondary mr-2">
                    <i class="mdi mdi-arrow-left mr-1"></i>Kembali
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

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <div class="row">
            <!-- Informasi Kategori -->
            <div class="col-lg-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Informasi Kategori</h4>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <tr>
                                    <th width="40%">Nama Kategori</th>
                                    <td>{{ $kategori_pengaduan->nama }}</td>
                                </tr>
                                <tr>
                                    <th>SLA Hari</th>
                                    <td>{{ $kategori_pengaduan->sla_hari }} hari</td>
                                </tr>
                                <tr>
                                    <th>Prioritas</th>
                                    <td>
                                        @php
                                            $badgeClass = [
                                                'rendah' => 'badge-info',
                                                'sedang' => 'badge-warning',
                                                'tinggi' => 'badge-danger',
                                                'sangat_tinggi' => 'badge-dark',
                                            ][$kategori_pengaduan->prioritas] ?? 'badge-secondary';
                                        @endphp
                                        <span class="badge {{ $badgeClass }}">
                                            {{ ucfirst(str_replace('_', ' ', $kategori_pengaduan->prioritas)) }}
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Dibuat Pada</th>
                                    <td>{{ $kategori_pengaduan->created_at->format('d/m/Y H:i') }}</td>
                                </tr>
                                <tr>
                                    <th>Diupdate Pada</th>
                                    <td>{{ $kategori_pengaduan->updated_at->format('d/m/Y H:i') }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Upload File -->
            <div class="col-lg-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Tambah File</h4>
                        <form action="{{ route('media.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="ref_table" value="kategori_pengaduan">
                            <input type="hidden" name="ref_id" value="{{ $kategori_pengaduan->kategori_id }}">

                            <div class="form-group">
                                <label for="files">Pilih File</label>
                                <input type="file" name="files[]" id="files" class="form-control-file" multiple required>
                                <small class="form-text text-muted">
                                    Format yang didukung: JPG, JPEG, PNG, PDF, DOC, DOCX, XLS, XLSX. Maksimal 5MB per file.
                                </small>
                                @error('files.*')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary">
                                <i class="mdi mdi-upload mr-1"></i>Upload File
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Daftar File yang Sudah Diupload -->
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">File Terlampir</h4>
                        <div class="table-responsive">
                            @if($files->count() > 0)
                                <table class="table table-striped">
                                    <thead>
                                        <tr class="table-header-gradient">
                                            <th>No</th>
                                            <th>Nama File</th>
                                            <th>Tipe File</th>
                                            <th>Caption</th>
                                            <th>Tanggal Upload</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($files as $index => $file)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $file->file_name }}</td>
                                                <td>
                                                    <span class="badge badge-info">{{ $file->mime_type }}</span>
                                                </td>
                                                <td>{{ $file->caption ?? '-' }}</td>
                                                <td>{{ $file->created_at->format('d/m/Y H:i') }}</td>
                                                <td>
                                                    <a href="{{ asset('uploads/' . $file->file_name) }}"
                                                       target="_blank"
                                                       class="btn btn-sm btn-info"
                                                       title="Lihat">
                                                        <i class="mdi mdi-eye"></i>
                                                    </a>
                                                    <a href="{{ asset('uploads/' . $file->file_name) }}"
                                                       download
                                                       class="btn btn-sm btn-success"
                                                       title="Download">
                                                        <i class="mdi mdi-download"></i>
                                                    </a>
                                                    <form action="{{ route('media.destroy', $file->media_id) }}"
                                                          method="POST"
                                                          class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                                class="btn btn-sm btn-danger"
                                                                title="Hapus"
                                                                onclick="return confirm('Apakah Anda yakin ingin menghapus file ini?')">
                                                            <i class="mdi mdi-delete"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @else
                                <div class="text-center py-4">
                                    <i class="mdi mdi-file-document-outline mr-2" style="font-size: 48px; color: #ccc;"></i>
                                    <p class="mt-2 text-muted">Belum ada file yang diupload untuk kategori ini.</p>
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
        .table-header-gradient {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        }

        .table-header-gradient th {
            padding: 16px 12px;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 0.5px;
            border: none;
            color: #2c3e50;
        }
    </style>
@endsection
