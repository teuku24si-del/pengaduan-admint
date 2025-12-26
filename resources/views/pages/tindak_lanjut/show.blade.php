@extends('layouts.admin.app')

@section('content')
    <div class="content-wrapper">
        {{-- Header --}}
        <div class="d-xl-flex justify-content-between align-items-start mb-4">
            <div>
                <h2 class="text-dark font-weight-bold mb-2">Detail Tindak Lanjut</h2>
                <div class="d-flex align-items-center">
                    <span class="badge badge-light border mr-2 px-3 py-1">
                        <i class="mdi mdi-clipboard-text mr-1"></i>ID: {{ $tindak_lanjut->tindak_id }}
                    </span>
                    <span class="text-muted small">
                        <i class="mdi mdi-calendar mr-1"></i>
                        {{ \Carbon\Carbon::parse($tindak_lanjut->created_at)->translatedFormat('d F Y') }}
                    </span>
                </div>
            </div>
            <div class="d-sm-flex justify-content-xl-between align-items-center">
                <a href="{{ route('tindak_lanjut.index') }}" class="btn btn-light shadow-sm border">
                    <i class="mdi mdi-arrow-left mr-1"></i>Kembali
                </a>
            </div>
        </div>

        {{-- Alert --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show shadow-sm border-0" role="alert">
                <div class="d-flex align-items-center">
                    <i class="mdi mdi-check-circle-outline mr-2" style="font-size: 1.2rem;"></i>
                    <div>
                        <strong>Berhasil!</strong> {{ session('success') }}
                    </div>
                </div>
                <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
            </div>
        @endif

        <div class="row">
            {{-- Data Tindak Lanjut Card --}}
            <div class="col-lg-7 grid-margin stretch-card">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-white border-bottom-0 pt-4 pb-3">
                        <h4 class="card-title text-primary mb-0">
                            <i class="mdi mdi-clipboard-text-outline mr-2"></i>Data Tindak Lanjut
                        </h4>
                        <p class="text-muted small mb-0">Informasi lengkap mengenai tindak lanjut</p>
                    </div>
                    <div class="card-body pt-0">
                        <div class="table-responsive">
                            <table class="table table-hover table-striped">
                                <tbody>
                                    <tr class="border-bottom">
                                        <th class="bg-light-blue text-dark font-weight-medium" width="35%">
                                            <div class="d-flex align-items-center">
                                                <i class="mdi mdi-ticket-account mr-2"></i>Pengaduan
                                            </div>
                                        </th>
                                        <td class="py-3">
                                            @if($tindak_lanjut->pengaduan)
                                            <div class="d-flex align-items-center">
                                                <div class="avatar-icon-wrapper mr-3">
                                                    <div class="avatar-icon">
                                                        <i class="mdi mdi-ticket text-primary" style="font-size: 2rem;"></i>
                                                    </div>
                                                </div>
                                                <div>
                                                    <h5 class="mb-1">Tiket: {{ $tindak_lanjut->pengaduan->no_tiket }}</h5>
                                                    <p class="mb-0 text-muted small">
                                                        {{ Str::limit($tindak_lanjut->pengaduan->deskripsi, 100) }}
                                                    </p>
                                                </div>
                                            </div>
                                            @else
                                            <span class="text-muted">Pengaduan tidak ditemukan</span>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr class="border-bottom">
                                        <th class="bg-light-blue text-dark font-weight-medium">
                                            <div class="d-flex align-items-center">
                                                <i class="mdi mdi-note-text-outline mr-2"></i>Catatan Tindak Lanjut
                                            </div>
                                        </th>
                                        <td class="py-3">
                                            <div class="bg-light p-3 rounded">
                                                <p class="mb-0 text-justify">{{ $tindak_lanjut->catatan }}</p>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr class="border-bottom">
                                        <th class="bg-light-blue text-dark font-weight-medium">
                                            <div class="d-flex align-items-center">
                                                <i class="mdi mdi-account-tie mr-2"></i>Petugas
                                            </div>
                                        </th>
                                        <td class="py-3">
                                            <div class="d-flex align-items-center">
                                                <div class="avatar-icon-wrapper mr-3">
                                                    <div class="avatar-icon">
                                                        <i class="mdi mdi-account-circle text-success" style="font-size: 2rem;"></i>
                                                    </div>
                                                </div>
                                                <div>
                                                    <h5 class="mb-0">{{ $tindak_lanjut->petugas }}</h5>
                                                    <p class="text-muted small mb-0">Penanggung Jawab</p>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr class="border-bottom">
                                        <th class="bg-light-blue text-dark font-weight-medium">
                                            <div class="d-flex align-items-center">
                                                <i class="mdi mdi-progress-check mr-2"></i>Status Tindakan
                                            </div>
                                        </th>
                                        <td class="py-3">
                                            @if ($tindak_lanjut->aksi == 'selesai')
                                                <span class="badge badge-success px-3 py-2">
                                                    <i class="mdi mdi-check-circle mr-1"></i>Selesai
                                                </span>
                                            @elseif($tindak_lanjut->aksi == 'ditolak')
                                                <span class="badge badge-danger px-3 py-2">
                                                    <i class="mdi mdi-close-circle mr-1"></i>Ditolak
                                                </span>
                                            @else
                                                <span class="badge badge-secondary px-3 py-2">
                                                    {{ $tindak_lanjut->aksi }}
                                                </span>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="bg-light-blue text-dark font-weight-medium">
                                            <div class="d-flex align-items-center">
                                                <i class="mdi mdi-calendar-clock mr-2"></i>Waktu
                                            </div>
                                        </th>
                                        <td class="py-3">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <p class="mb-1"><strong>Dibuat:</strong></p>
                                                    <span class="text-muted">{{ $tindak_lanjut->created_at->format('d/m/Y') }}</span>
                                                </div>
                                                <div class="col-md-6">
                                                    <p class="mb-1"><strong>Diperbarui:</strong></p>
                                                    <span class="text-muted">{{ $tindak_lanjut->updated_at->format('d/m/Y') }}</span>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Upload Lampiran Card --}}
            <div class="col-lg-5 grid-margin stretch-card">
                <div class="card shadow-sm border-0 gradient-card">
                    <div class="card-header bg-gradient-primary text-white border-bottom-0 pt-4 pb-3">
                        <h4 class="card-title mb-0">
                            <i class="mdi mdi-cloud-upload mr-2"></i>Tambah Lampiran Baru
                        </h4>
                        <p class="mb-0 opacity-75">Unggah foto atau file pendukung</p>
                    </div>
                    <div class="card-body pt-4">
                        <form action="{{ route('media.store') }}" method="POST" enctype="multipart/form-data" id="uploadForm">
                            @csrf
                            <input type="hidden" name="ref_table" value="tindak_lanjut">
                            <input type="hidden" name="ref_id" value="{{ $tindak_lanjut->tindak_id }}">

                            <div class="form-group mb-4">
                                <label class="font-weight-medium">Pilih Foto/File</label>
                                <div class="custom-file">
                                    <input type="file" name="files[]" class="custom-file-input" id="fileUpload" multiple required>
                                    <label class="custom-file-label" for="fileUpload" id="fileLabel">
                                        <i class="mdi mdi-paperclip mr-1"></i>Pilih file...
                                    </label>
                                </div>
                                <div id="filePreview" class="mt-2"></div>
                                <small class="form-text text-muted mt-2">
                                    <i class="mdi mdi-information-outline mr-1"></i>
                                    Format yang didukung: JPG, PNG, PDF, DOC. Maksimal 5 file.
                                </small>
                            </div>

                            <div class="form-group mb-4">
                                <label class="font-weight-medium">Keterangan</label>
                                <textarea name="caption" class="form-control" rows="3" placeholder="Tambahkan keterangan mengenai file yang diunggah..."></textarea>
                            </div>

                            <button type="submit" class="btn btn-primary btn-block btn-lg shadow-sm py-3" id="submitBtn">
                                <i class="mdi mdi-cloud-upload mr-2"></i>Upload File
                            </button>
                            {{-- TAMBAHAN: Tombol Tindak Lanjut --}}
                            <div class="mt-3">
                                <hr class="my-4">
                                <a href="{{ route('penilaian_layanan.create') }}"
                                   class="btn btn-warning btn-block btn-lg shadow-sm py-3 text-dark font-weight-bold">
                                    <i class="mdi mdi-ray-start-arrow mr-2"></i>Lihat penilaian layanan
                                </a>
                                <p class="text-center text-muted small mt-2">
                                    <i class="mdi mdi-information-outline mr-1"></i>
                                    Klik untuk mengubah status atau memberikan tanggapan
                                </p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        {{-- File & Foto Terlampir --}}
        <div class="row mt-4">
            <div class="col-12 grid-margin stretch-card">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-white border-bottom-0 pt-4 pb-3">
                        <h4 class="card-title text-success mb-0">
                            <i class="mdi mdi-image-multiple mr-2"></i>File & Foto Terlampir
                        </h4>
                        <p class="text-muted small mb-0">
                            Total file: {{ $files && $files->count() > 0 ? $files->count() : 0 }}
                        </p>
                    </div>
                    <div class="card-body pt-0">
                        <hr class="mt-0">

                        @if ($files && $files->count() > 0)
                            <div class="row">
                                @foreach ($files as $file)
                                    <div class="col-xl-3 col-lg-4 col-md-6 mb-4">
                                        <div class="card h-100 border file-card">
                                            {{-- Preview File/Foto --}}
                                            <div class="file-preview">
                                                @php
                                                    $isImage = in_array(
                                                        strtolower(pathinfo($file->file_name, PATHINFO_EXTENSION)),
                                                        ['jpg', 'jpeg', 'png', 'gif', 'bmp'],
                                                    );
                                                    $filePath = asset('uploads/' . $file->file_name);
                                                    $fileExt = strtolower(pathinfo($file->file_name, PATHINFO_EXTENSION));
                                                @endphp

                                                @if ($isImage)
                                                    <a href="{{ $filePath }}" target="_blank" class="d-block text-center p-3">
                                                        <div class="image-container">
                                                            <img src="{{ $filePath }}" class="img-fluid rounded" alt="Lampiran">
                                                            <div class="image-overlay">
                                                                <i class="mdi mdi-magnify-plus-outline"></i>
                                                            </div>
                                                        </div>
                                                    </a>
                                                @else
                                                    <div class="text-center p-4 bg-light">
                                                        <div class="file-icon-wrapper">
                                                            @if($fileExt == 'pdf')
                                                                <i class="mdi mdi-file-pdf text-danger" style="font-size: 3.5rem;"></i>
                                                            @elseif(in_array($fileExt, ['doc', 'docx']))
                                                                <i class="mdi mdi-file-word text-primary" style="font-size: 3.5rem;"></i>
                                                            @elseif(in_array($fileExt, ['xls', 'xlsx']))
                                                                <i class="mdi mdi-file-excel text-success" style="font-size: 3.5rem;"></i>
                                                            @else
                                                                <i class="mdi mdi-file-document-outline text-secondary" style="font-size: 3.5rem;"></i>
                                                            @endif
                                                        </div>
                                                        <p class="small text-uppercase font-weight-medium mt-2 mb-0">
                                                            {{ $fileExt }} File
                                                        </p>
                                                    </div>
                                                @endif
                                            </div>

                                            {{-- File Info & Actions --}}
                                            <div class="card-body p-3">
                                                <p class="file-caption text-center mb-3" title="{{ $file->caption }}">
                                                    {{ $file->caption ?? 'Tanpa keterangan' }}
                                                </p>
                                                <p class="text-center text-muted small mb-3">
                                                    <i class="mdi mdi-calendar mr-1"></i>
                                                    {{ $file->created_at->format('d/m/Y') }}
                                                </p>

                                                <div class="d-flex justify-content-center">
                                                    <a href="{{ $filePath }}" download
                                                       class="btn btn-success btn-sm btn-icon mr-2 shadow-sm"
                                                       title="Download File">
                                                        <i class="mdi mdi-download"></i>
                                                    </a>

                                                    <a href="{{ $filePath }}" target="_blank"
                                                       class="btn btn-info btn-sm btn-icon mr-2 shadow-sm"
                                                       title="Lihat File">
                                                        <i class="mdi mdi-eye"></i>
                                                    </a>

                                                    <form action="{{ route('media.destroy', $file->media_id) }}"
                                                          method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                                class="btn btn-danger btn-sm btn-icon shadow-sm"
                                                                onclick="return confirm('Apakah Anda yakin ingin menghapus file ini?')"
                                                                title="Hapus File">
                                                            <i class="mdi mdi-trash-can"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-5">
                                <div class="empty-state-icon mb-3">
                                    <i class="mdi mdi-image-broken-variant text-muted" style="font-size: 4rem;"></i>
                                </div>
                                <h5 class="text-muted">Belum ada lampiran</h5>
                                <p class="text-muted small">Upload foto atau file pendukung untuk melengkapi data tindak lanjut</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Custom Styles */
        .bg-light-blue {
            background-color: #f8fafd !important;
        }

        .gradient-card {
            background: linear-gradient(to bottom, #ffffff 0%, #f9fbfe 100%);
            border: 1px solid #e3e6f0;
        }

        .badge-gradient-primary {
            background: linear-gradient(45deg, #4e73df, #224abe);
            color: white;
        }

        .file-card {
            transition: all 0.3s ease;
            border-radius: 10px;
            overflow: hidden;
            border: 1px solid #e3e6f0;
        }

        .file-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            border-color: #4e73df;
        }

        .file-preview {
            height: 200px;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            background-color: #f8f9fc;
        }

        .image-container {
            position: relative;
            width: 100%;
            height: 180px;
            overflow: hidden;
            border-radius: 8px;
        }

        .image-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .image-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(78, 115, 223, 0);
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background 0.3s ease;
            opacity: 0;
        }

        .image-container:hover .image-overlay {
            background: rgba(78, 115, 223, 0.8);
            opacity: 1;
        }

        .image-container:hover img {
            transform: scale(1.05);
        }

        .image-overlay i {
            color: white;
            font-size: 2rem;
        }

        .file-icon-wrapper {
            transition: transform 0.3s ease;
        }

        .file-card:hover .file-icon-wrapper {
            transform: scale(1.1);
        }

        .file-caption {
            font-size: 0.9rem;
            color: #5a5c69;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            min-height: 40px;
        }

        .btn-icon {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0;
        }

        .avatar-icon-wrapper {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: linear-gradient(45deg, #e3e6f0, #f8f9fc);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .empty-state-icon {
            opacity: 0.6;
        }

        /* Custom file input */
        .custom-file-label {
            background-color: #f8f9fc;
            border: 1px solid #e3e6f0;
            color: #6e707e;
        }

        .custom-file-input:focus ~ .custom-file-label {
            border-color: #4e73df;
            box-shadow: 0 0 0 0.2rem rgba(78, 115, 223, 0.25);
        }

        /* File preview list */
        .file-preview-item {
            display: flex;
            align-items: center;
            padding: 8px 12px;
            background: #f8f9fc;
            border-radius: 6px;
            margin-bottom: 5px;
            font-size: 0.875rem;
        }

        .file-preview-item i {
            margin-right: 8px;
            color: #4e73df;
        }

        /* Table styling */
        .table-striped tbody tr:nth-of-type(odd) {
            background-color: rgba(248, 250, 253, 0.5);
        }

        .table-hover tbody tr:hover {
            background-color: rgba(78, 115, 223, 0.05);
        }

        /* Card header styling */
        .card-header {
            border-bottom: 1px solid #e3e6f0;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .file-preview {
                height: 160px;
            }

            .image-container {
                height: 140px;
            }
        }
    </style>

    <script>
        // Update file input label with selected file names
        document.getElementById('fileUpload').addEventListener('change', function(e) {
            var files = e.target.files;
            var label = document.getElementById('fileLabel');
            var preview = document.getElementById('filePreview');
            var submitBtn = document.getElementById('submitBtn');

            // Clear previous preview
            preview.innerHTML = '';

            if (files.length > 0) {
                if (files.length === 1) {
                    label.innerHTML = '<i class="mdi mdi-paperclip mr-1"></i>' + files[0].name;
                } else {
                    label.innerHTML = '<i class="mdi mdi-paperclip mr-1"></i>' + files.length + ' file dipilih';
                }

                // Show file preview
                for (let i = 0; i < files.length; i++) {
                    const file = files[i];
                    const fileSize = (file.size / 1024).toFixed(2); // Convert to KB

                    const fileItem = document.createElement('div');
                    fileItem.className = 'file-preview-item';

                    // Get file icon based on type
                    let iconClass = 'mdi-file-document-outline';
                    if (file.type.startsWith('image/')) {
                        iconClass = 'mdi-file-image';
                    } else if (file.type.includes('pdf')) {
                        iconClass = 'mdi-file-pdf';
                    } else if (file.type.includes('word')) {
                        iconClass = 'mdi-file-word';
                    } else if (file.type.includes('excel')) {
                        iconClass = 'mdi-file-excel';
                    }

                    fileItem.innerHTML = `
                        <i class="mdi ${iconClass} mr-2"></i>
                        <div class="flex-grow-1">
                            <div class="d-flex justify-content-between">
                                <span class="text-truncate" style="max-width: 150px;">${file.name}</span>
                                <span class="text-muted">${fileSize} KB</span>
                            </div>
                        </div>
                    `;

                    preview.appendChild(fileItem);
                }

                // Enable submit button
                submitBtn.disabled = false;
                submitBtn.innerHTML = '<i class="mdi mdi-cloud-upload mr-2"></i>Upload ' + files.length + ' File';
            } else {
                label.innerHTML = '<i class="mdi mdi-paperclip mr-1"></i>Pilih file...';
                submitBtn.disabled = false;
                submitBtn.innerHTML = '<i class="mdi mdi-cloud-upload mr-2"></i>Upload File';
            }
        });

        // Form submission handler
        document.getElementById('uploadForm').addEventListener('submit', function(e) {
            const submitBtn = document.getElementById('submitBtn');
            const fileInput = document.getElementById('fileUpload');

            if (fileInput.files.length === 0) {
                e.preventDefault();
                alert('Pilih file terlebih dahulu!');
                return;
            }

            // Check file size (max 5MB per file)
            let isValid = true;
            const maxSize = 5 * 1024 * 1024; // 5MB in bytes

            for (let i = 0; i < fileInput.files.length; i++) {
                if (fileInput.files[i].size > maxSize) {
                    isValid = false;
                    alert(`File "${fileInput.files[i].name}" melebihi ukuran maksimal 5MB`);
                    break;
                }
            }

            if (!isValid) {
                e.preventDefault();
                return;
            }

            // Change button state during upload
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="mdi mdi-loading mdi-spin mr-2"></i>Mengupload...';
        });

        // Auto-hide alerts after 5 seconds
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(function() {
                const alerts = document.querySelectorAll('.alert');
                alerts.forEach(function(alert) {
                    const bsAlert = new bootstrap.Alert(alert);
                    bsAlert.close();
                });
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
@endsection
