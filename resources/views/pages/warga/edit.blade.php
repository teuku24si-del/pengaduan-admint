
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

    <div class="d-xl-flex justify-content-between align-items-start mb-4">
        <h2 class="text-dark font-weight-bold mb-2">Edit Data Warga</h2>
        <div class="d-flex gap-2">
            <a href="{{ route('warga.index') }}" class="btn btn-light">
                <i class="mdi mdi-arrow-left"></i> Kembali
            </a>
        </div>
    </div>

    <!-- Alert Messages -->
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="mdi mdi-alert-circle-outline"></i>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="mdi mdi-check-circle-outline"></i> {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="row">
        <div class="col-md-12">
            <div class="card card-gradient">
                <div class="card-body">
                    <div class="header-section mb-4">
                        <h4 class="card-title mb-2">Edit Data Warga</h4>
                        <p class="card-description">Isi form berikut untuk mengedit data warga</p>
                    </div>

                    <form class="forms-sample" action="{{ route('warga.update', $datawarga->warga_id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <!-- Kolom Kiri - Data Personal -->
                            <div class="col-md-6">
                                <!-- Nama -->
                                <div class="form-group form-card">
                                    <label for="nama" class="form-label">
                                        <i class="mdi mdi-account-circle text-primary mr-2"></i>
                                        Nama Lengkap
                                    </label>
                                    <div class="input-group input-group-gradient">
                                        <input type="text" class="form-control" id="nama" name="nama"
                                            placeholder="Masukkan nama lengkap"
                                            value="{{ $datawarga->nama ?? '' }}" required>
                                        <div class="input-group-append">
                                            <span class="input-group-text">
                                                <i class="mdi mdi-account text-muted"></i>
                                            </span>
                                        </div>
                                    </div>
                                    <small class="form-text text-muted">Wajib diisi</small>
                                </div>

                                <!-- Agama -->
                                <div class="form-group form-card">
                                    <label for="agama" class="form-label">
                                        <i class="mdi mdi-church text-success mr-2"></i>
                                        Agama
                                    </label>
                                    <div class="select-wrapper">
                                        <select class="form-control select2" id="agama" name="agama" required style="background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);">
                                            <option value="">Pilih Agama</option>
                                            <option value="Islam" {{ ($datawarga->agama ?? '') == 'Islam' ? 'selected' : '' }}>Islam</option>
                                            <option value="Kristen" {{ ($datawarga->agama ?? '') == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                                            <option value="Katolik" {{ ($datawarga->agama ?? '') == 'Katolik' ? 'selected' : '' }}>Katolik</option>
                                            <option value="Hindu" {{ ($datawarga->agama ?? '') == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                                            <option value="Buddha" {{ ($datawarga->agama ?? '') == 'Buddha' ? 'selected' : '' }}>Buddha</option>
                                            <option value="Konghucu" {{ ($datawarga->agama ?? '') == 'Konghucu' ? 'selected' : '' }}>Konghucu</option>
                                        </select>
                                    </div>
                                    <small class="form-text text-muted">Pilih salah satu</small>
                                </div>

                                <!-- Jenis Kelamin -->
                                <div class="form-group form-card">
                                    <label class="form-label">
                                        <i class="mdi mdi-gender-male-female text-info mr-2"></i>
                                        Jenis Kelamin
                                    </label>
                                    <div class="radio-group">
                                        <div class="row">
                                            <div class="col-md-6 mb-2">
                                                <div class="radio-card">
                                                    <input type="radio" id="laki_laki" name="jenis_kelamin" value="Laki-laki"
                                                        class="radio-input" {{ ($datawarga->jenis_kelamin ?? '') == 'Laki-laki' ? 'checked' : '' }} required>
                                                    <label class="radio-label" for="laki_laki">
                                                        <div class="radio-icon">
                                                            <i class="mdi mdi-gender-male"></i>
                                                        </div>
                                                        <div class="radio-content">
                                                            <div class="radio-title">Laki-laki</div>
                                                        </div>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-2">
                                                <div class="radio-card">
                                                    <input type="radio" id="perempuan" name="jenis_kelamin" value="Perempuan"
                                                        class="radio-input" {{ ($datawarga->jenis_kelamin ?? '') == 'Perempuan' ? 'checked' : '' }}>
                                                    <label class="radio-label" for="perempuan">
                                                        <div class="radio-icon">
                                                            <i class="mdi mdi-gender-female"></i>
                                                        </div>
                                                        <div class="radio-content">
                                                            <div class="radio-title">Perempuan</div>
                                                        </div>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Kolom Kanan - Data Kontak dan Pekerjaan -->
                            <div class="col-md-6">
                                <!-- Pekerjaan -->
                                <div class="form-group form-card">
                                    <label for="pekerjaan" class="form-label">
                                        <i class="mdi mdi-briefcase text-warning mr-2"></i>
                                        Pekerjaan
                                    </label>
                                    <div class="input-group input-group-gradient">
                                        <input type="text" class="form-control" id="pekerjaan" name="pekerjaan"
                                            placeholder="Masukkan pekerjaan"
                                            value="{{ $datawarga->pekerjaan ?? '' }}" required>
                                        <div class="input-group-append">
                                            <span class="input-group-text">
                                                <i class="mdi mdi-briefcase-outline text-muted"></i>
                                            </span>
                                        </div>
                                    </div>
                                    <small class="form-text text-muted">Wajib diisi</small>
                                </div>

                                <!-- Email -->
                                <div class="form-group form-card">
                                    <label for="email" class="form-label">
                                        <i class="mdi mdi-email text-danger mr-2"></i>
                                        Email
                                    </label>
                                    <div class="input-group input-group-gradient">
                                        <input type="email" class="form-control" id="email" name="email"
                                            placeholder="Masukkan email"
                                            value="{{ $datawarga->email ?? '' }}" required>
                                        <div class="input-group-append">
                                            <span class="input-group-text">
                                                <i class="mdi mdi-email-outline text-muted"></i>
                                            </span>
                                        </div>
                                    </div>
                                    <small class="form-text text-muted">
                                        <i class="mdi mdi-information-outline text-primary mr-1"></i>
                                        Contoh: nama@example.com
                                    </small>
                                </div>

                                <!-- No. HP -->
                                <div class="form-group form-card">
                                    <label for="No_Hp" class="form-label">
                                        <i class="mdi mdi-phone text-success mr-2"></i>
                                        No. Handphone
                                    </label>
                                    <div class="input-group input-group-gradient">
                                        <input type="tel" class="form-control" id="No_Hp" name="No_Hp"
                                            placeholder="Masukkan nomor handphone"
                                            value="{{ $datawarga->No_Hp ?? '' }}" required>
                                        <div class="input-group-append">
                                            <span class="input-group-text">
                                                <i class="mdi mdi-phone-outline text-muted"></i>
                                            </span>
                                        </div>
                                    </div>
                                    <small class="form-text text-muted">
                                        <i class="mdi mdi-information-outline text-primary mr-1"></i>
                                        Contoh: 081234567890
                                    </small>
                                </div>
                            </div>
                        </div>

                        <!-- Tombol Aksi -->
                        <div class="row mt-5">
                            <div class="col-md-12">
                                <div class="d-flex justify-content-center">
                                    <button type="submit" class="btn btn-primary-gradient btn-lg mr-3">
                                        <i class="mdi mdi-content-save mr-2"></i> Update Data
                                    </button>
                                    <a href="{{ route('warga.index') }}" class="btn btn-light-gradient btn-lg">
                                        <i class="mdi mdi-close mr-2"></i> Batal
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
    /* Card dengan gradasi */
    .card-gradient {
        border: none;
        border-radius: 15px;
        background: linear-gradient(135deg, #f5f7fa 0%, #e4e8f0 100%);
        box-shadow: 0 10px 30px rgba(102, 126, 234, 0.15);
        overflow: hidden;
    }

    .card-gradient:before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 5px;
        background: linear-gradient(90deg, #667eea 0%, #764ba2 50%, #f093fb 100%);
    }

    /* Header Section */
    .header-section {
        text-align: center;
        padding-bottom: 20px;
        border-bottom: 1px solid rgba(102, 126, 234, 0.1);
        margin-bottom: 30px;
    }

    .card-title {
        font-weight: 700;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        font-size: 1.8rem;
        margin-bottom: 10px;
    }

    .card-description {
        color: #6c757d;
        font-size: 1rem;
    }

    /* Form Card Styling */
    .form-card {
        margin-bottom: 25px;
        padding: 20px;
        background: white;
        border-radius: 12px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
        border: 1px solid rgba(102, 126, 234, 0.1);
    }

    .form-card:hover {
        box-shadow: 0 8px 25px rgba(102, 126, 234, 0.15);
        transform: translateY(-3px);
    }

    .form-label {
        font-weight: 600;
        color: #495057;
        margin-bottom: 10px;
        display: flex;
        align-items: center;
        font-size: 0.95rem;
    }

    /* Input Group dengan gradasi */
    .input-group-gradient {
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.05);
    }

    .input-group-gradient .form-control {
        border: 2px solid transparent;
        background: linear-gradient(white, white) padding-box,
                    linear-gradient(135deg, #667eea 0%, #764ba2 100%) border-box;
        border-radius: 10px;
        padding: 12px 15px;
        transition: all 0.3s ease;
    }

    .input-group-gradient .form-control:focus {
        box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        border-color: #667eea;
    }

    .input-group-gradient .input-group-text {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
        color: white;
        padding: 12px 15px;
    }

    /* Radio Card Styling */
    .radio-group {
        margin-top: 10px;
    }

    .radio-card {
        position: relative;
        width: 100%;
    }

    .radio-input {
        position: absolute;
        opacity: 0;
        width: 0;
        height: 0;
    }

    .radio-label {
        display: flex;
        align-items: center;
        padding: 15px;
        background: white;
        border: 2px solid #e0e0e0;
        border-radius: 10px;
        cursor: pointer;
        transition: all 0.3s ease;
        width: 100%;
    }

    .radio-label:hover {
        background: linear-gradient(135deg, rgba(102, 126, 234, 0.05) 0%, rgba(118, 75, 162, 0.05) 100%);
        border-color: #667eea;
    }

    .radio-input:checked + .radio-label {
        background: linear-gradient(135deg, rgba(102, 126, 234, 0.1) 0%, rgba(118, 75, 162, 0.1) 100%);
        border-color: #667eea;
        box-shadow: 0 5px 15px rgba(102, 126, 234, 0.2);
    }

    .radio-icon {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 15px;
        font-size: 1.2rem;
    }

    #laki_laki:checked + .radio-label .radio-icon {
        background: linear-gradient(135deg, #2196F3 0%, #1976D2 100%);
        color: white;
    }

    #perempuan:checked + .radio-label .radio-icon {
        background: linear-gradient(135deg, #E91E63 0%, #C2185B 100%);
        color: white;
    }

    .radio-icon i {
        font-size: 1.5rem;
    }

    .radio-title {
        font-weight: 600;
        color: #495057;
    }

    .radio-input:checked + .radio-label .radio-title {
        color: #667eea;
    }

    /* Tombol dengan gradasi */
    .btn-primary-gradient {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
        color: white;
        padding: 12px 30px;
        border-radius: 10px;
        font-weight: 600;
        font-size: 1rem;
        transition: all 0.3s ease;
        box-shadow: 0 5px 15px rgba(102, 126, 234, 0.3);
    }

    .btn-primary-gradient:hover {
        background: linear-gradient(135deg, #5a6fd8 0%, #6a42a0 100%);
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(102, 126, 234, 0.4);
        color: white;
    }

    .btn-light-gradient {
        background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
        border: 2px solid #e0e0e0;
        color: #495057;
        padding: 12px 30px;
        border-radius: 10px;
        font-weight: 600;
        font-size: 1rem;
        transition: all 0.3s ease;
    }

    .btn-light-gradient:hover {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        border-color: #667eea;
        color: #667eea;
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }

    /* Select2 customization */
    .select2-container--default .select2-selection--single {
        border: 2px solid transparent;
        background: linear-gradient(white, white) padding-box,
                    linear-gradient(135deg, #667eea 0%, #764ba2 100%) border-box;
        border-radius: 10px;
        height: 48px;
        padding: 8px 12px;
    }

    .select2-container--default .select2-selection--single .select2-selection__rendered {
        line-height: 30px;
        color: #495057;
    }

    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 46px;
    }

    /* Alert styling */
    .alert {
        border-radius: 10px;
        border: none;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }

    .alert-danger {
        background: linear-gradient(135deg, #ffebee 0%, #ffcdd2 100%);
        color: #c62828;
    }

    .alert-success {
        background: linear-gradient(135deg, #e8f5e9 0%, #c8e6c9 100%);
        color: #2e7d32;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .card-title {
            font-size: 1.5rem;
        }

        .form-card {
            padding: 15px;
        }

        .btn-primary-gradient, .btn-light-gradient {
            width: 100%;
            margin-bottom: 10px;
        }

        .d-flex.justify-content-center {
            flex-direction: column;
            gap: 10px;
        }

        .radio-label {
            padding: 12px;
        }

        .radio-icon {
            width: 35px;
            height: 35px;
            font-size: 1rem;
        }
    }

    /* Animation untuk form card */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .form-card {
        animation: fadeInUp 0.5s ease forwards;
    }

    .form-card:nth-child(1) { animation-delay: 0.1s; }
    .form-card:nth-child(2) { animation-delay: 0.2s; }
    .form-card:nth-child(3) { animation-delay: 0.3s; }
    .form-card:nth-child(4) { animation-delay: 0.4s; }
    .form-card:nth-child(5) { animation-delay: 0.5s; }
    .form-card:nth-child(6) { animation-delay: 0.6s; }
</style>
@endsection

@push('scripts')
<script>
    // Inisialisasi select2 jika tersedia
    if ($.fn.select2) {
        $('#agama').select2({
            placeholder: "Pilih Agama",
            allowClear: false,
            theme: "default",
            width: '100%'
        }).on('select2:open', function() {
            $('.select2-results__options').css({
                'background': 'linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%)',
                'border-radius': '10px',
                'box-shadow': '0 5px 15px rgba(0, 0, 0, 0.1)'
            });
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
            showToast('error', 'Format email tidak valid');
            document.getElementById('email').focus();
            return false;
        }

        // Validasi nomor HP (minimal 10 digit, maksimal 15 digit)
        const phoneRegex = /^[0-9]{10,15}$/;
        const cleanPhone = noHp.replace(/\D/g, '');
        if (cleanPhone && !phoneRegex.test(cleanPhone)) {
            e.preventDefault();
            showToast('error', 'Nomor HP harus terdiri dari 10-15 digit angka');
            document.getElementById('No_Hp').focus();
            return false;
        }

        // Validasi jenis kelamin terpilih
        if (!jenisKelamin) {
            e.preventDefault();
            showToast('error', 'Silakan pilih jenis kelamin');
            return false;
        }

        // Tampilkan loading state dengan animasi
        const submitBtn = this.querySelector('button[type="submit"]');
        const originalContent = submitBtn.innerHTML;
        submitBtn.innerHTML = '<i class="mdi mdi-loading mdi-spin mr-2"></i> Memperbarui...';
        submitBtn.disabled = true;
        submitBtn.style.background = 'linear-gradient(135deg, #4a5fc9 0%, #5a42a0 100%)';

        // Simulasi loading
        setTimeout(() => {
            if (this.checkValidity()) {
                return true;
            }
        }, 1000);
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

    // Fungsi untuk menampilkan toast notification
    function showToast(type, message) {
        // Buat elemen toast
        const toast = document.createElement('div');
        toast.className = `toast-${type}`;
        toast.innerHTML = `
            <div class="toast-content">
                <i class="mdi ${type === 'error' ? 'mdi-alert-circle' : 'mdi-check-circle'} mr-2"></i>
                ${message}
            </div>
        `;

        // Tambahkan styling untuk toast
        const style = document.createElement('style');
        style.textContent = `
            .toast-error, .toast-success {
                position: fixed;
                top: 20px;
                right: 20px;
                padding: 15px 20px;
                border-radius: 10px;
                color: white;
                font-weight: 500;
                z-index: 9999;
                animation: slideIn 0.3s ease, fadeOut 0.3s ease 2.7s forwards;
                box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            }
            .toast-error {
                background: linear-gradient(135deg, #f44336 0%, #d32f2f 100%);
            }
            .toast-success {
                background: linear-gradient(135deg, #4CAF50 0%, #388E3C 100%);
            }
            @keyframes slideIn {
                from { transform: translateX(100%); opacity: 0; }
                to { transform: translateX(0); opacity: 1; }
            }
            @keyframes fadeOut {
                from { opacity: 1; }
                to { opacity: 0; }
            }
        `;

        document.head.appendChild(style);
        document.body.appendChild(toast);

        // Hapus toast setelah 3 detik
        setTimeout(() => {
            toast.remove();
            if (document.head.contains(style)) {
                document.head.removeChild(style);
            }
        }, 3000);
    }

    // Animasi untuk form card saat hover
    document.querySelectorAll('.form-card').forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-5px)';
        });

        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
        });
    });
</script>
@endpush
