//view edit tindak lanjut
@extends('layouts.admin.app')

@section('content')
<div class="content-wrapper">
    <!-- Header -->
    <div class="d-xl-flex justify-content-between align-items-start mb-4">
        <h2 class="text-dark font-weight-bold mb-2">Edit Tindak Lanjut</h2>
        <div class="d-sm-flex justify-content-xl-between align-items-center">
            <a href="{{ route('tindak_lanjut.index') }}" class="btn btn-light shadow-sm border">
                <i class="mdi mdi-arrow-left mr-1"></i>Kembali ke Daftar
            </a>
        </div>
    </div>

    <!-- Card Form -->
    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-gradient-warning text-white border-bottom-0 pt-4 pb-3">
                    <h4 class="card-title mb-0">
                        <i class="mdi mdi-pencil-circle mr-2"></i>Form Edit Tindak Lanjut
                    </h4>
                    <p class="mb-0 opacity-75">Perbarui data tindak lanjut yang sudah ada</p>
                </div>

                <div class="card-body pt-4">
                    @if($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Perhatian!</strong> Terdapat kesalahan dalam pengisian form:
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="close" data-dismiss="alert">
                                <span>&times;</span>
                            </button>
                        </div>
                    @endif

                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Berhasil!</strong> {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert">
                                <span>&times;</span>
                            </button>
                        </div>
                    @endif

                    <form action="{{ route('tindak_lanjut.update', $datatindak_lanjut->tindak_id) }}" method="POST" id="tindakLanjutForm">
                        @csrf
                        @method('PUT')

                        <!-- Select Pengaduan -->
                        <div class="form-group mb-4">
                            <label for="pengaduan_id" class="font-weight-medium text-dark">
                                <i class="mdi mdi-ticket-account mr-1"></i>Pengaduan
                                <span class="text-danger">*</span>
                            </label>
                            <select name="pengaduan_id" id="pengaduan_id"
                                    class="form-control @error('pengaduan_id') is-invalid @enderror" required {{ $datatindak_lanjut->pengaduan_id ? 'disabled' : '' }}>
                                <option value="" disabled>-- Pilih Pengaduan --</option>
                                @foreach($pengaduan as $item)
                                    <option value="{{ $item->pengaduan_id }}"
                                            {{ old('pengaduan_id', $datatindak_lanjut->pengaduan_id) == $item->pengaduan_id ? 'selected' : '' }}>
                                        [{{ $item->no_tiket }}] - {{ \Illuminate\Support\Str::limit($item->deskripsi, 100) }}
                                    </option>
                                @endforeach
                            </select>
                            @if($datatindak_lanjut->pengaduan_id)
                                <input type="hidden" name="pengaduan_id" value="{{ $datatindak_lanjut->pengaduan_id }}">
                                <small class="form-text text-info mt-1">
                                    <i class="mdi mdi-information-outline mr-1"></i>
                                    Pengaduan tidak dapat diubah setelah dibuat
                                </small>
                            @endif
                            @error('pengaduan_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted mt-1">
                                <i class="mdi mdi-information-outline mr-1"></i>
                                Pengaduan yang ditindak lanjuti
                            </small>
                        </div>

                        <!-- Display Selected Pengaduan Info -->
                        @if($datatindak_lanjut->pengaduan)
                        <div class="alert alert-info border-0 mb-4">
                            <div class="d-flex">
                                <div class="mr-3">
                                    <i class="mdi mdi-ticket-confirmation" style="font-size: 1.5rem;"></i>
                                </div>
                                <div>
                                    <h6 class="alert-heading">Informasi Pengaduan</h6>
                                    <p class="mb-1"><strong>No Tiket:</strong> {{ $datatindak_lanjut->pengaduan->no_tiket }}</p>
                                    <p class="mb-1"><strong>Deskripsi:</strong> {{ $datatindak_lanjut->pengaduan->deskripsi }}</p>
                                    <p class="mb-0"><strong>Dibuat:</strong> {{ $datatindak_lanjut->pengaduan->created_at->format('d/m/Y H:i') }}</p>
                                </div>
                            </div>
                        </div>
                        @endif

                        <!-- Input Petugas -->
                        <div class="form-group mb-4">
                            <label for="petugas" class="font-weight-medium text-dark">
                                <i class="mdi mdi-account-tie mr-1"></i>Petugas Penanggung Jawab
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" name="petugas" id="petugas"
                                   class="form-control @error('petugas') is-invalid @enderror"
                                   value="{{ old('petugas', $datatindak_lanjut->petugas) }}"
                                   placeholder="Masukkan nama petugas" required>
                            @error('petugas')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted mt-1">
                                <i class="mdi mdi-information-outline mr-1"></i>
                                Nama petugas yang menangani pengaduan
                            </small>
                        </div>

                        <!-- Select Aksi -->
                        <div class="form-group mb-4">
                            <label for="aksi" class="font-weight-medium text-dark">
                                <i class="mdi mdi-progress-check mr-1"></i>Status Tindakan
                                <span class="text-danger">*</span>
                            </label>
                            <select name="aksi" id="aksi"
                                    class="form-control @error('aksi') is-invalid @enderror" required>
                                <option value="" disabled>-- Pilih Status Tindakan --</option>
                                <option value="selesai" {{ old('aksi', $datatindak_lanjut->aksi) == 'selesai' ? 'selected' : '' }}>
                                    <i class="mdi mdi-check-circle mr-1"></i> Selesai
                                </option>
                                <option value="ditolak" {{ old('aksi', $datatindak_lanjut->aksi) == 'ditolak' ? 'selected' : '' }}>
                                    <i class="mdi mdi-close-circle mr-1"></i> Ditolak
                                </option>
                            </select>
                            @error('aksi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted mt-1">
                                <i class="mdi mdi-information-outline mr-1"></i>
                                Pilih status tindakan yang dilakukan
                            </small>
                        </div>

                        <!-- Textarea Catatan -->
                        <div class="form-group mb-4">
                            <label for="catatan" class="font-weight-medium text-dark">
                                <i class="mdi mdi-note-text-outline mr-1"></i>Catatan Tindak Lanjut
                                <span class="text-danger">*</span>
                            </label>
                            <textarea name="catatan" id="catatan"
                                      class="form-control @error('catatan') is-invalid @enderror"
                                      rows="5" placeholder="Masukkan catatan tindak lanjut..." required>{{ old('catatan', $datatindak_lanjut->catatan) }}</textarea>
                            @error('catatan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted mt-1">
                                <i class="mdi mdi-information-outline mr-1"></i>
                                Jelaskan detail tindakan yang telah dilakukan
                            </small>
                        </div>

                        <!-- Metadata -->
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="font-weight-medium text-dark">
                                        <i class="mdi mdi-calendar-clock mr-1"></i>Tanggal Dibuat
                                    </label>
                                    <input type="text" class="form-control bg-light"
                                           value="{{ $datatindak_lanjut->created_at->format('d/m/Y H:i') }}" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="font-weight-medium text-dark">
                                        <i class="mdi mdi-calendar-edit mr-1"></i>Terakhir Diperbarui
                                    </label>
                                    <input type="text" class="form-control bg-light"
                                           value="{{ $datatindak_lanjut->updated_at->format('d/m/Y H:i') }}" readonly>
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="form-group pt-3">
                            <div class="d-flex justify-content-between">
                                <button type="reset" class="btn btn-light shadow-sm border">
                                    <i class="mdi mdi-refresh mr-1"></i>Reset Perubahan
                                </button>
                                <div>
                                    <a href="{{ route('tindak_lanjut.index') }}" class="btn btn-secondary shadow-sm border mr-2">
                                        <i class="mdi mdi-close mr-1"></i>Batal
                                    </a>
                                    <button type="submit" class="btn btn-warning shadow-sm px-5">
                                        <i class="mdi mdi-content-save mr-1"></i>Update Tindak Lanjut
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Sidebar Info -->
        <div class="col-lg-4">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-light border-bottom-0 pt-4 pb-3">
                    <h5 class="card-title text-dark mb-0">
                        <i class="mdi mdi-information-outline mr-2"></i>Informasi Edit
                    </h5>
                </div>
                <div class="card-body">
                    <div class="alert alert-warning border-0">
                        <div class="d-flex">
                            <div class="mr-3">
                                <i class="mdi mdi-alert-circle-outline" style="font-size: 1.5rem;"></i>
                            </div>
                            <div>
                                <h6 class="alert-heading">Perhatian!</h6>
                                <p class="mb-2 small">Pastikan data yang diupdate sudah benar. Perubahan tidak dapat dibatalkan.</p>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4">
                        <h6 class="font-weight-medium text-dark mb-3">
                            <i class="mdi mdi-help-circle-outline mr-1"></i> Status Tindakan:
                        </h6>
                        <div class="list-group list-group-flush">
                            <div class="list-group-item border-0 px-0 py-2">
                                <div class="d-flex align-items-center">
                                    <span class="badge badge-success mr-3">Selesai</span>
                                    <span class="small text-muted">Pengaduan telah selesai ditangani</span>
                                </div>
                            </div>
                            <div class="list-group-item border-0 px-0 py-2">
                                <div class="d-flex align-items-center">
                                    <span class="badge badge-danger mr-3">Ditolak</span>
                                    <span class="small text-muted">Pengaduan tidak dapat ditangani</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Current Data Info -->
                    <div class="mt-4 pt-3 border-top">
                        <h6 class="font-weight-medium text-dark mb-3">
                            <i class="mdi mdi-history mr-1"></i> Data Saat Ini:
                        </h6>
                        <div class="small">
                            <div class="mb-2">
                                <strong>ID Tindak Lanjut:</strong>
                                <span class="badge badge-light border ml-2">{{ $datatindak_lanjut->tindak_id }}</span>
                            </div>
                            <div class="mb-2">
                                <strong>Status Saat Ini:</strong>
                                @switch($datatindak_lanjut->aksi)
                                    @case('sedang_diproses')
                                        <span class="badge badge-warning ml-2">Sedang Diproses</span>
                                        @break
                                    @case('selesai')
                                        <span class="badge badge-success ml-2">Selesai</span>
                                        @break
                                    @case('ditolak')
                                        <span class="badge badge-danger ml-2">Ditolak</span>
                                        @break
                                @endswitch
                            </div>
                            <div class="mb-2">
                                <strong>Petugas Saat Ini:</strong>
                                <span class="ml-2">{{ $datatindak_lanjut->petugas }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Preview Card -->
            <div class="card shadow-sm border-0">
                <div class="card-header bg-gradient-warning text-white border-bottom-0 pt-4 pb-3">
                    <h5 class="card-title mb-0">
                        <i class="mdi mdi-eye-outline mr-2"></i>Preview Perubahan
                    </h5>
                </div>
                <div class="card-body">
                    <div id="formPreview" class="small">
                        <p class="text-muted mb-3">Ubah form untuk melihat preview di sini</p>
                        <div class="preview-item mb-2">
                            <strong>Pengaduan:</strong>
                            <span class="preview-pengaduan text-muted">
                                @if($datatindak_lanjut->pengaduan)
                                    [{{ $datatindak_lanjut->pengaduan->no_tiket }}]
                                @else
                                    -
                                @endif
                            </span>
                        </div>
                        <div class="preview-item mb-2">
                            <strong>Petugas:</strong>
                            <span class="preview-petugas text-muted">{{ $datatindak_lanjut->petugas }}</span>
                        </div>
                        <div class="preview-item mb-2">
                            <strong>Status:</strong>
                            <span class="preview-aksi text-muted">
                                @switch($datatindak_lanjut->aksi)
                                    @case('sedang_diproses')
                                        <span class="badge badge-warning">Sedang Diproses</span>
                                        @break
                                    @case('selesai')
                                        <span class="badge badge-success">Selesai</span>
                                        @break
                                    @case('ditolak')
                                        <span class="badge badge-danger">Ditolak</span>
                                        @break
                                @endswitch
                            </span>
                        </div>
                        <div class="preview-item mb-2">
                            <strong>Catatan:</strong>
                            <span class="preview-catatan text-muted">{{ \Illuminate\Support\Str::limit($datatindak_lanjut->catatan, 50) }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Custom Styles */
    .bg-gradient-warning {
        background: linear-gradient(45deg, #f6c23e, #dda20a);
    }

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

    .form-control, .custom-select {
        border-radius: 8px;
        border: 1px solid #e3e6f0;
        transition: all 0.3s ease;
    }

    .form-control:focus, .custom-select:focus {
        border-color: #f6c23e;
        box-shadow: 0 0 0 0.2rem rgba(246, 194, 62, 0.25);
    }

    .form-control.bg-light {
        background-color: #f8f9fc !important;
        color: #6c757d;
        cursor: not-allowed;
    }

    .is-invalid {
        border-color: #e74a3b !important;
    }

    .invalid-feedback {
        font-size: 0.875rem;
        margin-top: 0.25rem;
    }

    .badge {
        font-size: 0.75rem;
        padding: 0.375em 0.75em;
        font-weight: 500;
    }

    .list-group-item {
        background-color: transparent;
    }

    .preview-item {
        border-bottom: 1px solid #f8f9fc;
        padding-bottom: 0.5rem;
        margin-bottom: 0.5rem;
    }

    .preview-item:last-child {
        border-bottom: none;
    }

    .btn-warning {
        background: linear-gradient(45deg, #f6c23e, #dda20a);
        border: none;
        border-radius: 8px;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .btn-warning:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(246, 194, 62, 0.3);
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

    .alert-warning {
        background-color: #fff3cd;
        color: #856404;
        border-color: #ffeaa7;
    }

    .alert-info {
        background-color: #d1ecf1;
        color: #0c5460;
        border-color: #bee5eb;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .d-flex.justify-content-between {
            flex-direction: column;
        }

        .btn {
            width: 100%;
            margin-bottom: 10px;
        }

        .row .col-md-6 {
            margin-bottom: 15px;
        }
    }
</style>

<script>
    // Real-time Form Preview
    document.addEventListener('DOMContentLoaded', function() {
        // Get form elements
        const pengaduanSelect = document.getElementById('pengaduan_id');
        const petugasInput = document.getElementById('petugas');
        const aksiSelect = document.getElementById('aksi');
        const catatanTextarea = document.getElementById('catatan');

        // Get preview elements
        const previewPengaduan = document.querySelector('.preview-pengaduan');
        const previewPetugas = document.querySelector('.preview-petugas');
        const previewAksi = document.querySelector('.preview-aksi');
        const previewCatatan = document.querySelector('.preview-catatan');

        // Initial preview update
        updatePreview();

        // Update pengaduan preview
        pengaduanSelect.addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            previewPengaduan.textContent = selectedOption.textContent;
            updatePreviewPengaduanBadge();
        });

        // Update petugas preview
        petugasInput.addEventListener('input', function() {
            previewPetugas.textContent = this.value || '-';
        });

        // Update aksi preview
        aksiSelect.addEventListener('change', function() {
            updateAksiPreview();
        });

        // Update catatan preview
        catatanTextarea.addEventListener('input', function() {
            updateCatatanPreview();
        });

        // Function to update all previews
        function updatePreview() {
            updateAksiPreview();
            updateCatatanPreview();
        }

        // Function to update aksi preview
        function updateAksiPreview() {
            const status = aksiSelect.value;
            let badgeClass = 'badge-secondary';
            let statusText = '';

            switch(status) {
                case 'selesai':
                    badgeClass = 'badge-success';
                    statusText = '<i class="mdi mdi-check-circle mr-1"></i> Selesai';
                    break;
                case 'ditolak':
                    badgeClass = 'badge-danger';
                    statusText = '<i class="mdi mdi-close-circle mr-1"></i> Ditolak';
                    break;
            }

            previewAksi.innerHTML = `<span class="badge ${badgeClass}">${statusText}</span>`;
        }

        // Function to update catatan preview
        function updateCatatanPreview() {
            const text = catatanTextarea.value;
            if (text.length > 50) {
                previewCatatan.textContent = text.substring(0, 50) + '...';
            } else {
                previewCatatan.textContent = text || '-';
            }
        }

        // Function to update pengaduan badge preview
        function updatePreviewPengaduanBadge() {
            const pengaduanText = pengaduanSelect.options[pengaduanSelect.selectedIndex]?.textContent || '';
            const ticketMatch = pengaduanText.match(/\[(.*?)\]/);

            if (ticketMatch) {
                const ticketNumber = ticketMatch[1];
                previewPengaduan.innerHTML = `<span class="badge badge-light border">${ticketNumber}</span> ` +
                                            pengaduanText.replace(/\[.*?\]/, '').trim();
            }
        }

        // Form validation
        document.getElementById('tindakLanjutForm').addEventListener('submit', function(e) {
            const requiredFields = ['petugas', 'aksi', 'catatan'];
            let isValid = true;

            requiredFields.forEach(field => {
                const element = document.getElementById(field);
                if (!element.value.trim()) {
                    isValid = false;
                    element.classList.add('is-invalid');
                } else {
                    element.classList.remove('is-invalid');
                }
            });

            if (!isValid) {
                e.preventDefault();
                alert('Harap lengkapi semua field yang wajib diisi!');
            }
        });

        // Auto-capitalize petugas name
        petugasInput.addEventListener('blur', function() {
            this.value = this.value.split(' ')
                .map(word => word.charAt(0).toUpperCase() + word.slice(1).toLowerCase())
                .join(' ');
        });

        // Reset form to original values
        document.querySelector('button[type="reset"]').addEventListener('click', function() {
            setTimeout(function() {
                updatePreview();
            }, 100);
        });
    });
</script>
@endsection
