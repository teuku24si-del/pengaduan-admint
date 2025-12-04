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
            <h2 class="text-dark font-weight-bold mb-2">Detail Pengaduan</h2>
            <div class="d-sm-flex justify-content-xl-between align-items-center mb-2">
                <a href="{{ route('Pengaduan.index') }}" class="btn btn-secondary mr-2">
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
            <!-- Informasi Pengaduan -->
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Informasi Pengaduan</h4>
                        <div class="row">
                            <!-- Kolom Kiri -->
                            <div class="col-md-6">
                                <table class="table table-striped">
                                    <tr>
                                        <th width="40%">No. Tiket</th>
                                        <td>
                                            <span class="badge badge-info">{{ $Pengaduan->no_tiket }}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Warga</th>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="mr-3">
                                                    <i class="mdi mdi-account-circle icon-md text-dark"></i>
                                                </div>
                                                <div>
                                                    <div class="font-weight-bold">{{ $Pengaduan->warga->nama ?? 'N/A' }}</div>
                                                    <small class="text-muted">{{ $Pengaduan->warga->nama ?? 'N/A' }}</small>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Kategori</th>
                                        <td>
                                            <span class="font-weight-bold">{{ $Pengaduan->kategori->nama ?? 'N/A' }}</span>
                                            <br>
                                            <small class="text-muted">SLA: {{ $Pengaduan->kategori->sla_hari ?? '0' }} hari</small>
                                            <br>
                                            <small class="text-muted">Prioritas:
                                                @php
                                                    $badgeClass = [
                                                        'rendah' => 'badge-info',
                                                        'sedang' => 'badge-warning',
                                                        'tinggi' => 'badge-danger',
                                                        'sangat_tinggi' => 'badge-dark',
                                                    ][$Pengaduan->kategori->prioritas ?? ''] ?? 'badge-secondary';
                                                @endphp
                                                <span class="badge {{ $badgeClass }}">
                                                    {{ ucfirst(str_replace('_', ' ', $Pengaduan->kategori->prioritas ?? 'N/A')) }}
                                                </span>
                                            </small>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Judul</th>
                                        <td>{{ $Pengaduan->judul }}</td>
                                    </tr>
                                </table>
                            </div>

                            <!-- Kolom Kanan -->
                            <div class="col-md-6">
                                <table class="table table-striped">
                                    <tr>
                                        <th width="40%">Status</th>
                                        <td>
                                            @if ($Pengaduan->status == 'sedang_diproses')
                                                <span class="badge badge-warning">Sedang Diproses</span>
                                            @elseif($Pengaduan->status == 'sudah_selesai')
                                                <span class="badge badge-success">Selesai</span>
                                            @else
                                                <span class="badge badge-secondary">{{ $Pengaduan->status }}</span>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Lokasi</th>
                                        <td>{{ $Pengaduan->lokasi_text }}</td>
                                    </tr>
                                    <tr>
                                        <th>RT/RW</th>
                                        <td>
                                            <span class="badge badge-light">RT {{ $Pengaduan->rt }}</span>
                                            <span class="badge badge-light">RW {{ $Pengaduan->rw }}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Deskripsi</th>
                                        <td>{{ $Pengaduan->deskripsi }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>

                        <!-- Info Tanggal -->
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <table class="table">
                                    <tr>
                                        <th width="40%">Dibuat Pada</th>
                                        <td>{{ $Pengaduan->created_at->format('d/m/Y H:i') }}</td>
                                    </tr>
                                    <tr>
                                        <th>Diupdate Pada</th>
                                        <td>{{ $Pengaduan->updated_at->format('d/m/Y H:i') }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Upload File dan Daftar File -->
        <div class="row">
            <!-- Form Upload -->
            <div class="col-lg-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Tambah Lampiran</h4>
                        <form action="{{ route('media.store') }}" method="POST" enctype="multipart/form-data" id="uploadForm">
                            @csrf
                            <input type="hidden" name="ref_table" value="Pengaduan">
                            <input type="hidden" name="ref_id" value="{{ $Pengaduan->pengaduan_id }}">

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

                            <div class="form-group">
                                <label for="caption">Keterangan (Opsional)</label>
                                <input type="text" name="caption" id="caption" class="form-control" placeholder="Masukkan keterangan file">
                            </div>

                            <button type="submit" class="btn btn-primary">
                                <i class="mdi mdi-upload mr-1"></i>Upload File
                            </button>
                        </form>

                        <!-- Preview File -->
                        <div class="mt-4" id="filePreview" style="display: none;">
                            <h6 class="card-subtitle mb-2">Preview File:</h6>
                            <div id="previewContainer" class="row"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Daftar File yang Sudah Diupload -->
            <div class="col-lg-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title d-flex justify-content-between align-items-center">
                            <span>File Terlampir ({{ $files->count() }})</span>
                            @if($files->count() > 0)
                                <span class="badge badge-primary">{{ $files->count() }} file</span>
                            @endif
                        </h4>
                        <div class="table-responsive">
                            @if($files->count() > 0)
                                <div class="row">
                                    @foreach($files as $file)
                                        <div class="col-md-6 mb-3">
                                            <div class="card file-card">
                                                <div class="card-body">
                                                    <div class="d-flex justify-content-between align-items-start">
                                                        <div>
                                                            @if(in_array($file->mime_type, ['image/jpeg', 'image/png', 'image/jpg']))
                                                                <i class="mdi mdi-image text-primary mr-2"></i>
                                                            @elseif($file->mime_type == 'application/pdf')
                                                                <i class="mdi mdi-file-pdf text-danger mr-2"></i>
                                                            @elseif(str_contains($file->mime_type, 'word'))
                                                                <i class="mdi mdi-file-word text-info mr-2"></i>
                                                            @elseif(str_contains($file->mime_type, 'excel') || str_contains($file->mime_type, 'sheet'))
                                                                <i class="mdi mdi-file-excel text-success mr-2"></i>
                                                            @else
                                                                <i class="mdi mdi-file text-secondary mr-2"></i>
                                                            @endif
                                                            <span class="font-weight-bold">{{ Str::limit($file->file_name, 20) }}</span>
                                                        </div>
                                                        <div class="dropdown">
                                                            <button class="btn btn-sm btn-link text-dark" type="button" data-toggle="dropdown">
                                                                <i class="mdi mdi-dots-vertical"></i>
                                                            </button>
                                                            <div class="dropdown-menu">
                                                                <a class="dropdown-item" href="{{ asset('uploads/' . $file->file_name) }}" target="_blank">
                                                                    <i class="mdi mdi-eye mr-2"></i>Lihat
                                                                </a>
                                                                <a class="dropdown-item" href="{{ asset('uploads/' . $file->file_name) }}" download>
                                                                    <i class="mdi mdi-download mr-2"></i>Download
                                                                </a>
                                                                <div class="dropdown-divider"></div>
                                                                <form action="{{ route('media.destroy', $file->media_id) }}" method="POST">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="dropdown-item text-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus file ini?')">
                                                                        <i class="mdi mdi-delete mr-2"></i>Hapus
                                                                    </button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <small class="text-muted d-block mt-2">
                                                        {{ $file->caption ?? 'Tidak ada keterangan' }}
                                                    </small>
                                                    <small class="text-muted d-block">
                                                        <i class="mdi mdi-clock-outline mr-1"></i>
                                                        {{ $file->created_at->format('d/m/Y H:i') }}
                                                    </small>
                                                    <small class="text-muted d-block">
                                                        <i class="mdi mdi-file mr-1"></i>
                                                        {{ $file->mime_type }}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="text-center py-4">
                                    <i class="mdi mdi-file-document-outline mr-2" style="font-size: 48px; color: #ccc;"></i>
                                    <p class="mt-2 text-muted">Belum ada file yang diupload untuk pengaduan ini.</p>
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
        .file-card {
            border: 1px solid #e0e0e0;
            transition: all 0.3s ease;
        }

        .file-card:hover {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            transform: translateY(-2px);
            border-color: #4dabf7;
        }

        .table-striped tr:nth-of-type(odd) {
            background-color: #f9f9f9;
        }

        .table-striped tr th {
            background-color: #f8f9fa;
            color: #495057;
        }
    </style>

    <script>
        // Preview file sebelum upload
        document.getElementById('files').addEventListener('change', function(e) {
            const previewContainer = document.getElementById('previewContainer');
            const filePreview = document.getElementById('filePreview');
            previewContainer.innerHTML = '';

            if (this.files.length > 0) {
                filePreview.style.display = 'block';

                for (let i = 0; i < this.files.length; i++) {
                    const file = this.files[i];
                    const col = document.createElement('div');
                    col.className = 'col-md-4 mb-2';

                    const card = document.createElement('div');
                    card.className = 'card';
                    card.style.padding = '10px';

                    let content = '';

                    if (file.type.startsWith('image/')) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            const img = document.createElement('img');
                            img.src = e.target.result;
                            img.style.maxWidth = '100%';
                            img.style.height = '80px';
                            img.style.objectFit = 'cover';
                            card.appendChild(img);
                        }
                        reader.readAsDataURL(file);
                        content = `<div class="text-center">
                            <i class="mdi mdi-image text-primary" style="font-size: 48px;"></i>
                        </div>`;
                    } else if (file.type === 'application/pdf') {
                        content = `<div class="text-center">
                            <i class="mdi mdi-file-pdf text-danger" style="font-size: 48px;"></i>
                        </div>`;
                    } else if (file.type.includes('word')) {
                        content = `<div class="text-center">
                            <i class="mdi mdi-file-word text-info" style="font-size: 48px;"></i>
                        </div>`;
                    } else if (file.type.includes('excel') || file.type.includes('sheet')) {
                        content = `<div class="text-center">
                            <i class="mdi mdi-file-excel text-success" style="font-size: 48px;"></i>
                        </div>`;
                    } else {
                        content = `<div class="text-center">
                            <i class="mdi mdi-file text-secondary" style="font-size: 48px;"></i>
                        </div>`;
                    }

                    card.innerHTML += content + `
                        <div class="text-center mt-2">
                            <small class="text-muted d-block">${file.name}</small>
                            <small class="text-muted">${(file.size / 1024).toFixed(2)} KB</small>
                        </div>`;

                    col.appendChild(card);
                    previewContainer.appendChild(col);
                }
            } else {
                filePreview.style.display = 'none';
            }
        });

        // Validasi form sebelum submit
        document.getElementById('uploadForm').addEventListener('submit', function(e) {
            const files = document.getElementById('files').files;
            if (files.length === 0) {
                e.preventDefault();
                alert('Silakan pilih file terlebih dahulu!');
                return false;
            }

            // Validasi ukuran file
            for (let i = 0; i < files.length; i++) {
                if (files[i].size > 5 * 1024 * 1024) { // 5MB
                    e.preventDefault();
                    alert(`File "${files[i].name}" melebihi ukuran maksimal 5MB!`);
                    return false;
                }
            }
        });
    </script>
@endsection
