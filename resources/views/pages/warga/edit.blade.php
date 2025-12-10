
@extends('layouts.admin.app')

@section('content')
<div class="content-wrapper">
    <div class="row" id="proBanner">
        <div class="col-12">
            <span class="d-flex align-items-center purchase-popup">
                <p>Like what you see? Check out our premium version for more.</p>
                <a href="https://github.com/BootstrapDash/ConnectPlusAdmin-Free-Bootstrap-Admin-Template" target="_blank" class="btn ml-auto download-button">Download Free Version</a>
                <a href="http://www.bootstrapdash.com/demo/connect-plus/jquery/template/" target="_blank" class="btn purchase-button">Upgrade To Pro</a>
                <i class="mdi mdi-close" id="bannerClose"></i>
            </span>
        </div>
    </div>

    <div class="d-xl-flex justify-content-between align-items-start">
        <h2 class="text-dark font-weight-bold mb-2">Edit Data Warga</h2>
        <div class="d-sm-flex justify-content-xl-between align-items-center mb-2">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('warga.index') }}">Data Warga</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit Data</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Edit Data Warga</h4>
                    <p class="card-description">Isi form berikut untuk mengedit data warga</p>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form class="forms-sample" action="{{ route('warga.update', $datawarga->warga_id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <!-- Kolom Kiri - Data Personal -->
                            <div class="col-md-6">
                                <!-- Nama -->
                                <div class="form-group">
                                    <label for="nama">Nama</label>
                                    <input type="text" class="form-control" id="nama" name="nama"
                                        placeholder="Masukkan nama lengkap"
                                        value="{{ $datawarga->nama ?? '' }}"
                                        required>
                                </div>

                                <!-- Agama -->
                                <div class="form-group">
                                    <label for="agama">Agama</label>
                                    <select class="form-control" id="agama" name="agama" required>
                                        <option value="">Pilih Agama</option>
                                        <option value="Islam" {{ ($datawarga->agama ?? '') == 'Islam' ? 'selected' : '' }}>Islam</option>
                                        <option value="Kristen" {{ ($datawarga->agama ?? '') == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                                        <option value="Katolik" {{ ($datawarga->agama ?? '') == 'Katolik' ? 'selected' : '' }}>Katolik</option>
                                        <option value="Hindu" {{ ($datawarga->agama ?? '') == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                                        <option value="Buddha" {{ ($datawarga->agama ?? '') == 'Buddha' ? 'selected' : '' }}>Buddha</option>
                                        <option value="Konghucu" {{ ($datawarga->agama ?? '') == 'Konghucu' ? 'selected' : '' }}>Konghucu</option>
                                    </select>
                                </div>

                                <!-- Jenis Kelamin -->
                                <div class="form-group">
                                    <label for="jenis_kelamin">Jenis Kelamin</label>
                                    <div class="row">
                                        <div class="col-md-6 mb-2">
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="laki_laki" name="jenis_kelamin" value="Laki-laki"
                                                    class="custom-control-input"
                                                    {{ ($datawarga->jenis_kelamin ?? '') == 'Laki-laki' ? 'checked' : '' }}
                                                    required>
                                                <label class="custom-control-label d-flex align-items-center" for="laki_laki">
                                                    <span class="radio-circle mr-2"></span>
                                                    Laki-laki
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-2">
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="perempuan" name="jenis_kelamin" value="Perempuan"
                                                    class="custom-control-input"
                                                    {{ ($datawarga->jenis_kelamin ?? '') == 'Perempuan' ? 'checked' : '' }}>
                                                <label class="custom-control-label d-flex align-items-center" for="perempuan">
                                                    <span class="radio-circle mr-2"></span>
                                                    Perempuan
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Kolom Kanan - Data Kontak dan Pekerjaan -->
                            <div class="col-md-6">
                                <!-- Pekerjaan -->
                                <div class="form-group">
                                    <label for="pekerjaan">Pekerjaan</label>
                                    <input type="text" class="form-control" id="pekerjaan" name="pekerjaan"
                                        placeholder="Masukkan pekerjaan"
                                        value="{{ $datawarga->pekerjaan ?? '' }}"
                                        required>
                                </div>

                                <!-- Email -->
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" name="email"
                                        placeholder="Masukkan email"
                                        value="{{ $datawarga->email ?? '' }}"
                                        required>
                                    <small class="form-text text-muted">Contoh: nama@example.com</small>
                                </div>

                                <!-- No. HP -->
                                <div class="form-group">
                                    <label for="No_Hp">No. HP</label>
                                    <input type="tel" class="form-control" id="No_Hp" name="No_Hp"
                                        placeholder="Masukkan nomor handphone"
                                        value="{{ $datawarga->No_Hp ?? '' }}"
                                        required>
                                    <small class="form-text text-muted">Contoh: 081234567890</small>
                                </div>
                            </div>
                        </div>

                        <!-- Tombol Aksi -->
                        <div class="row mt-4">
                            <div class="col-md-12">
                                <div class="d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary mr-2">
                                        <i class="mdi mdi-content-save"></i> Simpan Perubahan
                                    </button>
                                    <a href="{{ route('warga.index') }}" class="btn btn-light">
                                        <i class="mdi mdi-close"></i> Batal
                                    </a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
{{--end main content--}}

<style>
/* Styling untuk form dua kolom */
.form-group {
    margin-bottom: 1.5rem;
}

.card-title {
    border-bottom: 1px solid #e3e3e3;
    padding-bottom: 15px;
    margin-bottom: 20px;
}

.card-description {
    color: #6c757d;
    margin-bottom: 25px;
}

/* Styling untuk radio button custom */
.custom-radio {
    padding-left: 0;
}

.custom-control-input {
    position: absolute;
    left: 0;
    z-index: -1;
    opacity: 0;
}

.custom-control-label {
    position: relative;
    margin-bottom: 0;
    cursor: pointer;
    padding: 10px 15px;
    border: 1px solid #dee2e6;
    border-radius: 6px;
    width: 100%;
    transition: all 0.3s ease;
}

.custom-control-label:hover {
    background-color: #f8f9fa;
    border-color: #007bff;
}

.radio-circle {
    display: inline-block;
    width: 18px;
    height: 18px;
    border: 2px solid #adb5bd;
    border-radius: 50%;
    position: relative;
    transition: all 0.3s ease;
}

.custom-control-input:checked ~ .custom-control-label {
    background-color: #e7f1ff;
    border-color: #007bff;
    color: #007bff;
    font-weight: 500;
}

.custom-control-input:checked ~ .custom-control-label .radio-circle {
    border-color: #007bff;
    background-color: #007bff;
}

.custom-control-input:checked ~ .custom-control-label .radio-circle::after {
    content: "";
    width: 8px;
    height: 8px;
    border-radius: 50%;
    background: white;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
}

/* Breadcrumb styling */
.breadcrumb {
    background: transparent;
    padding: 0;
    margin-bottom: 0;
}

.breadcrumb-item a {
    color: #4B49AC;
    text-decoration: none;
}

.breadcrumb-item.active {
    color: #666;
}

/* Alert styling */
.alert {
    border-radius: 8px;
    border: none;
}

.alert-danger {
    background-color: #fee;
    color: #c7254e;
}

.alert-success {
    background-color: #e8f7ee;
    color: #28a745;
}

/* Button styling */
.btn-primary {
    background-color: #4B49AC;
    border-color: #4B49AC;
}

.btn-primary:hover {
    background-color: #3f3d9a;
    border-color: #3f3d9a;
}

/* Form control styling */
.form-control:focus {
    border-color: #4B49AC;
    box-shadow: 0 0 0 0.2rem rgba(75, 73, 172, 0.25);
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .custom-control-label {
        padding: 8px 12px;
    }

    .col-md-6.mb-2 {
        margin-bottom: 10px !important;
    }

    .d-flex.justify-content-end {
        flex-direction: column;
        gap: 10px;
    }

    .d-flex.justify-content-end .btn {
        width: 100%;
        margin-right: 0 !important;
        margin-bottom: 10px;
    }
}
</style>
@endsection

@push('scripts')
<script>
    // Inisialisasi select2 jika tersedia
    if ($.fn.select2) {
        $('#agama').select2({
            placeholder: "Pilih Agama",
            allowClear: false
        });
    }

    // Validasi form sebelum submit
    document.querySelector('form').addEventListener('submit', function(e) {
        const email = document.getElementById('email').value;
        const noHp = document.getElementById('No_Hp').value;
        const jenisKelamin = document.querySelector('input[name="jenis_kelamin"]:checked');

        // Validasi email format
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (email && !emailRegex.test(email)) {
            e.preventDefault();
            alert('Format email tidak valid');
            document.getElementById('email').focus();
            return false;
        }

        // Validasi nomor HP (minimal 10 digit, maksimal 15 digit)
        const phoneRegex = /^[0-9]{10,15}$/;
        const cleanPhone = noHp.replace(/\D/g, '');
        if (cleanPhone && !phoneRegex.test(cleanPhone)) {
            e.preventDefault();
            alert('Nomor HP harus terdiri dari 10-15 digit angka');
            document.getElementById('No_Hp').focus();
            return false;
        }

        // Validasi jenis kelamin terpilih
        if (!jenisKelamin) {
            e.preventDefault();
            alert('Silakan pilih jenis kelamin');
            return false;
        }

        // Tampilkan loading state
        const submitBtn = this.querySelector('button[type="submit"]');
        submitBtn.innerHTML = '<i class="mdi mdi-loading mdi-spin"></i> Menyimpan...';
        submitBtn.disabled = true;
    });

    // Format nomor HP saat input
    document.getElementById('No_Hp').addEventListener('input', function(e) {
        let value = e.target.value.replace(/\D/g, '');
        if (value.length > 0) {
            if (value.length <= 4) {
                value = value.replace(/(\d{4})/, '$1');
            } else if (value.length <= 8) {
                value = value.replace(/(\d{4})(\d{4})/, '$1-$2');
            } else {
                value = value.replace(/(\d{4})(\d{4})(\d{1,7})/, '$1-$2-$3');
            }
        }
        e.target.value = value;
    });
</script>
@endpush
