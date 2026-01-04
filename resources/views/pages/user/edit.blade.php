@extends('layouts.admin.app')

@section('content')
<div class="content-wrapper">
    

    <div class="d-xl-flex justify-content-between align-items-start mb-4">
        <h2 class="text-dark font-weight-bold mb-2">Edit Data User</h2>
        <div class="d-flex gap-2">
            <a href="{{ route('user.index') }}" class="btn btn-light">
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
                        <h4 class="card-title mb-2">Form Edit User</h4>
                        <p class="card-description">Ubah data user yang sudah ada</p>
                    </div>

                    <form class="forms-sample" action="{{ route('user.update', $user->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <!-- Kolom Kiri - Data Dasar User -->
                            <div class="col-md-6">
                                <!-- Nama -->
                                <div class="form-group form-card">
                                    <label for="name" class="form-label">
                                        <i class="mdi mdi-account-circle text-primary mr-2"></i>
                                        Nama Lengkap
                                    </label>
                                    <div class="input-group input-group-gradient">
                                        <input type="text" class="form-control" id="name" name="name"
                                            placeholder="Masukkan nama lengkap" value="{{ old('name', $user->name) }}" required>
                                        <div class="input-group-append">
                                            <span class="input-group-text">
                                                <i class="mdi mdi-account text-muted"></i>
                                            </span>
                                        </div>
                                    </div>
                                    <small class="form-text text-muted">Wajib diisi</small>
                                </div>

                                <!-- Role -->
                                <div class="form-group form-card">
                                    <label for="role" class="form-label">
                                        <i class="mdi mdi-account-key text-warning mr-2"></i>
                                        Role
                                    </label>
                                    <div class="select-wrapper">
                                        <select class="form-control select2" id="role" name="role" required style="background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);">
                                            <option value="">Pilih Role</option>
                                            <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                                            <option value="staff" {{ old('role', $user->role) == 'staff' ? 'selected' : '' }}>Staff</option>
                                            <option value="kades" {{ old('role', $user->role) == 'kades' ? 'selected' : '' }}>Kepala Desa</option>
                                        </select>
                                    </div>
                                    <small class="form-text text-muted">Pilih peran user</small>
                                </div>

                                <!-- Email -->
                                <div class="form-group form-card">
                                    <label for="email" class="form-label">
                                        <i class="mdi mdi-email text-danger mr-2"></i>
                                        Email
                                    </label>
                                    <div class="input-group input-group-gradient">
                                        <input type="email" class="form-control" id="email" name="email"
                                            placeholder="Masukkan email" value="{{ old('email', $user->email) }}" required>
                                        <div class="input-group-append">
                                            <span class="input-group-text">
                                                <i class="mdi mdi-email-outline text-muted"></i>
                                            </span>
                                        </div>
                                    </div>
                                    <small class="form-text text-muted">
                                        <i class="mdi mdi-information-outline text-primary mr-1"></i>
                                        Contoh: user@example.com
                                    </small>
                                </div>
                            </div>

                            <!-- Kolom Kanan - Password dan Konfirmasi -->
                            <div class="col-md-6">
                                <!-- Password -->
                                <div class="form-group form-card">
                                    <label for="password" class="form-label">
                                        <i class="mdi mdi-lock text-success mr-2"></i>
                                        Password Baru
                                    </label>
                                    <div class="input-group input-group-gradient">
                                        <input type="password" class="form-control" id="password" name="password"
                                            placeholder="Kosongkan jika tidak ingin mengubah password">
                                        <div class="input-group-append">
                                            <span class="input-group-text toggle-password" data-target="password">
                                                <i class="mdi mdi-eye-off text-muted"></i>
                                            </span>
                                        </div>
                                    </div>
                                    <small class="form-text text-muted">
                                        <i class="mdi mdi-information-outline text-primary mr-1"></i>
                                        Biarkan kosong jika tidak ingin mengubah password
                                    </small>
                                    <div class="password-strength mt-2">
                                        <div class="progress" style="height: 5px;">
                                            <div class="progress-bar" id="password-strength-bar" role="progressbar" style="width: 0%;"></div>
                                        </div>
                                        <small id="password-strength-text" class="text-muted"></small>
                                    </div>
                                </div>

                                <!-- Konfirmasi Password -->
                                <div class="form-group form-card">
                                    <label for="password_confirmation" class="form-label">
                                        <i class="mdi mdi-lock-check text-info mr-2"></i>
                                        Konfirmasi Password Baru
                                    </label>
                                    <div class="input-group input-group-gradient">
                                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation"
                                            placeholder="Masukkan ulang password">
                                        <div class="input-group-append">
                                            <span class="input-group-text toggle-password" data-target="password_confirmation">
                                                <i class="mdi mdi-eye-off text-muted"></i>
                                            </span>
                                        </div>
                                    </div>
                                    <small class="form-text text-muted">
                                        <i class="mdi mdi-information-outline text-primary mr-1"></i>
                                        Harus sama dengan password baru
                                    </small>
                                    <div class="password-match mt-2">
                                        <small id="password-match-text"></small>
                                    </div>
                                </div>

                                <!-- Info Password -->
                                <div class="form-card info-card">
                                    <div class="info-header">
                                        <i class="mdi mdi-information-outline text-info mr-2"></i>
                                        <h6 class="info-title mb-0">Informasi Password</h6>
                                    </div>
                                    <div class="info-body">
                                        <div class="info-item">
                                            <i class="mdi mdi-check-circle text-success mr-2"></i>
                                            <span>Password dapat dikosongkan jika tidak ingin diubah</span>
                                        </div>
                                        <div class="info-item">
                                            <i class="mdi mdi-alert-circle text-warning mr-2"></i>
                                            <span>Isi password baru untuk mengubah password user</span>
                                        </div>
                                        <div class="info-item">
                                            <i class="mdi mdi-shield-check text-primary mr-2"></i>
                                            <span>Password baru harus minimal 8 karakter</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Info Role -->
                                <div class="form-card info-card">
                                    <div class="info-header">
                                        <i class="mdi mdi-account-group text-info mr-2"></i>
                                        <h6 class="info-title mb-0">Informasi Role</h6>
                                    </div>
                                    <div class="info-body">
                                        <div class="info-item">
                                            <i class="mdi mdi-shield-account text-primary mr-2"></i>
                                            <span><strong>Admin:</strong> Akses penuh sistem</span>
                                        </div>
                                        <div class="info-item">
                                            <i class="mdi mdi-account-tie text-success mr-2"></i>
                                            <span><strong>Staff:</strong> Akses operasional</span>
                                        </div>
                                        <div class="info-item">
                                            <i class="mdi mdi-account-supervisor text-warning mr-2"></i>
                                            <span><strong>Kepala Desa:</strong> Akses monitoring</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Tombol Aksi -->
                        <div class="row mt-5">
                            <div class="col-md-12">
                                <div class="d-flex justify-content-center">
                                    <button type="submit" class="btn btn-primary-gradient btn-lg mr-3">
                                        <i class="mdi mdi-account-edit mr-2"></i> Update User
                                    </button>
                                    <a href="{{ route('user.index') }}" class="btn btn-light-gradient btn-lg">
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
        cursor: pointer;
    }

    .input-group-gradient .input-group-text:hover {
        background: linear-gradient(135deg, #5a6fd8 0%, #6a42a0 100%);
    }

    /* Info Card */
    .info-card {
        background: linear-gradient(135deg, #f0f9ff 0%, #e6f7ff 100%);
        border: 1px solid #b6e0fe;
        margin-bottom: 15px;
    }

    .info-header {
        display: flex;
        align-items: center;
        margin-bottom: 10px;
        padding-bottom: 10px;
        border-bottom: 1px solid rgba(102, 126, 234, 0.1);
    }

    .info-title {
        font-weight: 600;
        color: #0c5460;
        font-size: 0.95rem;
    }

    .info-body {
        padding-top: 5px;
    }

    .info-item {
        display: flex;
        align-items: center;
        margin-bottom: 8px;
        font-size: 0.85rem;
        color: #495057;
    }

    .info-item:last-child {
        margin-bottom: 0;
    }

    /* Password Strength */
    .password-strength .progress {
        border-radius: 3px;
        background-color: #e9ecef;
    }

    .password-strength .progress-bar {
        transition: width 0.3s ease;
    }

    .password-match {
        min-height: 20px;
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

        .info-header {
            flex-direction: column;
            align-items: flex-start;
        }

        .info-item {
            flex-direction: column;
            align-items: flex-start;
        }

        .info-item i {
            margin-bottom: 5px;
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
        $('#role').select2({
            placeholder: "Pilih Role",
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

    // Toggle show/hide password
    document.querySelectorAll('.toggle-password').forEach(function(icon) {
        icon.addEventListener('click', function() {
            const targetId = this.getAttribute('data-target');
            const input = document.getElementById(targetId);
            const iconElement = this.querySelector('i');

            if (input.type === 'password') {
                input.type = 'text';
                iconElement.classList.remove('mdi-eye-off');
                iconElement.classList.add('mdi-eye');
            } else {
                input.type = 'password';
                iconElement.classList.remove('mdi-eye');
                iconElement.classList.add('mdi-eye-off');
            }
        });
    });

    // Password strength checker
    document.getElementById('password').addEventListener('input', function() {
        const password = this.value;
        const strengthBar = document.getElementById('password-strength-bar');
        const strengthText = document.getElementById('password-strength-text');

        // Jika password kosong, reset strength indicator
        if (password === '') {
            strengthBar.style.width = '0%';
            strengthText.textContent = '';
            return;
        }

        let strength = 0;
        let text = '';
        let color = '#dc3545';

        // Check password length
        if (password.length >= 8) strength += 25;
        if (password.length >= 12) strength += 25;

        // Check for uppercase and lowercase
        if (/[a-z]/.test(password) && /[A-Z]/.test(password)) strength += 25;

        // Check for numbers and special characters
        if (/[0-9]/.test(password)) strength += 15;
        if (/[^A-Za-z0-9]/.test(password)) strength += 10;

        // Set strength level
        if (strength < 30) {
            text = 'Lemah';
            color = '#dc3545';
        } else if (strength < 70) {
            text = 'Cukup';
            color = '#ffc107';
        } else if (strength < 90) {
            text = 'Baik';
            color = '#28a745';
        } else {
            text = 'Sangat Baik';
            color = '#20c997';
        }

        // Update UI
        strengthBar.style.width = strength + '%';
        strengthBar.style.backgroundColor = color;
        strengthText.textContent = `Kekuatan password: ${text}`;
        strengthText.style.color = color;
    });

    // Password match checker
    document.getElementById('password_confirmation').addEventListener('input', function() {
        const password = document.getElementById('password').value;
        const confirmPassword = this.value;
        const matchText = document.getElementById('password-match-text');

        if (confirmPassword === '' || password === '') {
            matchText.textContent = '';
            matchText.style.color = '';
        } else if (password === confirmPassword) {
            matchText.textContent = '✓ Password cocok';
            matchText.style.color = '#28a745';
        } else {
            matchText.textContent = '✗ Password tidak cocok';
            matchText.style.color = '#dc3545';
        }
    });

    // Validasi form sebelum submit
    document.querySelector('form').addEventListener('submit', function(e) {
        const name = document.getElementById('name').value;
        const email = document.getElementById('email').value;
        const password = document.getElementById('password').value;
        const passwordConfirmation = document.getElementById('password_confirmation').value;
        const role = document.getElementById('role').value;

        // Validasi email format
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(email)) {
            e.preventDefault();
            showToast('error', 'Format email tidak valid');
            document.getElementById('email').focus();
            return false;
        }

        // Validasi password jika diisi
        if (password !== '') {
            // Validasi password minimal 8 karakter
            if (password.length < 8) {
                e.preventDefault();
                showToast('error', 'Password minimal 8 karakter');
                document.getElementById('password').focus();
                return false;
            }

            // Validasi password match
            if (password !== passwordConfirmation) {
                e.preventDefault();
                showToast('error', 'Password dan konfirmasi password tidak cocok');
                document.getElementById('password_confirmation').focus();
                return false;
            }
        }

        // Validasi role terpilih
        if (!role) {
            e.preventDefault();
            showToast('error', 'Silakan pilih role');
            document.getElementById('role').focus();
            return false;
        }

        // Validasi nama tidak kosong
        if (!name.trim()) {
            e.preventDefault();
            showToast('error', 'Nama harus diisi');
            document.getElementById('name').focus();
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

    // Auto focus pada input pertama
    document.addEventListener('DOMContentLoaded', function() {
        const firstInput = document.getElementById('name');
        if (firstInput) {
            setTimeout(() => {
                firstInput.focus();
            }, 300);
        }
    });
</script>
@endpush
