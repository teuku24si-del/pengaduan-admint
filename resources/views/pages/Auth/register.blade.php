<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Register - Sistem Pengaduan Masyarakat</title>
    <link rel="icon" href="{{ asset('assets/images/logo1.png') }}" type="image/png">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            height: 100vh;
            display: flex;
            overflow: hidden;
            background: #f8f9fa;
            flex-direction: row-reverse;
        }

        /* Bagian kiri (sekarang kanan) - FORM REGISTER */
        .left-side {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #0066cc 0%, #003366 100%);
            position: relative;
            overflow: hidden;
        }

        /* Background pattern untuk form register */
        .left-side::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image:
                radial-gradient(circle at 20% 30%, rgba(255, 255, 255, 0.08) 0%, transparent 50%),
                radial-gradient(circle at 80% 70%, rgba(255, 255, 255, 0.05) 0%, transparent 50%);
            z-index: 1;
        }

        /* Bagian kanan (sekarang kiri) - GAMBAR */
        .right-side {
            flex: 1;
            position: relative;
            overflow: hidden;
        }

        .right-side::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(to bottom, rgba(0, 92, 230, 0.3), rgba(0, 92, 230, 0.1));
            z-index: 1;
        }

        .right-content {
            position: absolute;
            bottom: 50px;
            right: 50px;
            color: white;
            z-index: 2;
            max-width: 500px;
            text-align: right;
        }

        .right-content h1 {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 15px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
            color: #ff0000;
        }

        .right-content p {
            font-size: 1.1rem;
            line-height: 1.6;
            opacity: 0.9;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2);
            color: #ff3333;
            font-weight: 500;
        }

        /* Form register */
        .login-form {
            width: 85%;
            max-width: 500px; /* Diperlebar untuk logo yang lebih besar */
            padding: 35px;
            position: relative;
            z-index: 2;
            color: white;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
        }

        /* Logo yang DIPERBESAR ke kanan dan kiri */
        .form-logo-container {
            margin-bottom: 20px;
            text-align: center;
            width: 100%;
            padding: 0 10px; /* Memberikan ruang di kiri dan kanan */
        }

        .form-logo {
            width: 100%; /* Logo mengambil lebar penuh container */
            height: auto;
            max-height: 100px; /* Batas maksimal tinggi logo */
            background: white;
            padding: 15px 20px; /* Padding lebih besar di kiri dan kanan */
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15);
            object-fit: contain; /* Menjaga proporsi logo */
            display: block;
            margin: 0 auto 10px auto;
        }

        .login-form h2 {
            text-align: center;
            margin-bottom: 5px;
            font-size: 1.8rem;
            font-weight: 600;
            color: white;
            margin-top: 10px;
        }

        .login-subtitle {
            text-align: center;
            margin-bottom: 25px;
            font-size: 1rem;
            color: rgba(255, 255, 255, 0.8);
        }

        /* Form group yang lebih sederhana */
        .form-group {
            margin-bottom: 20px;
            position: relative;
        }

        .form-group label {
            display: block;
            margin-bottom: 6px;
            font-weight: 500;
            color: rgba(255, 255, 255, 0.9);
            font-size: 0.9rem;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 12px 40px 12px 15px;
            border: none;
            border-radius: 8px;
            font-size: 14px;
            background-color: rgba(255, 255, 255, 0.95);
            transition: all 0.3s ease;
            color: #333;
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
        }

        .form-group input::placeholder {
            color: #999;
            font-size: 13px;
        }

        .form-group input:focus,
        .form-group select:focus {
            outline: none;
            background-color: white;
            box-shadow: 0 0 0 2px rgba(255, 255, 255, 0.4);
        }

        .input-icon {
            position: absolute;
            right: 15px;
            top: 35px;
            color: #666;
            font-size: 1.1rem;
            pointer-events: none;
        }

        /* Tombol yang lebih sederhana */
        .login-btn {
            width: 100%;
            padding: 13px;
            background: linear-gradient(135deg, #00cc66 0%, #00a854 100%);
            border: none;
            color: white;
            border-radius: 8px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 10px;
            letter-spacing: 0.5px;
        }

        .login-btn:hover {
            background: linear-gradient(135deg, #00b359 0%, #008f44 100%);
            transform: translateY(-1px);
            box-shadow: 0 5px 15px rgba(0, 180, 100, 0.2);
        }

        .login-btn:active {
            transform: translateY(0);
        }

        .register-link {
            text-align: center;
            margin-top: 20px;
            font-size: 13px;
            color: rgba(255, 255, 255, 0.9);
        }

        .register-link a {
            color: white;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.2s ease;
        }

        .register-link a:hover {
            text-decoration: underline;
        }

        /* Error message styling */
        .alert {
            padding: 10px 12px;
            border-radius: 6px;
            margin-bottom: 15px;
            font-size: 13px;
            display: none;
        }

        .alert-danger {
            background-color: rgba(220, 53, 69, 0.9);
            color: white;
            border-left: 4px solid #dc3545;
        }

        .alert-success {
            background-color: rgba(40, 167, 69, 0.9);
            color: white;
            border-left: 4px solid #28a745;
        }

        /* Styling untuk error message kecil */
        .text-danger {
            color: #ff6b6b !important;
            font-size: 0.75rem;
            margin-top: 4px;
            display: block;
        }

        /* Password toggle */
        .password-toggle {
            position: absolute;
            right: 15px;
            top: 35px;
            background: none;
            border: none;
            color: #666;
            cursor: pointer;
            font-size: 1.1rem;
            padding: 0;
            z-index: 2;
        }

        /* Loading animation */
        .loading {
            display: none;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 10;
        }

        .spinner {
            width: 35px;
            height: 35px;
            border: 3px solid rgba(255, 255, 255, 0.3);
            border-top: 3px solid white;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* Responsive Design */
        @media (max-width: 1024px) {
            .right-content {
                right: 30px;
                bottom: 30px;
                max-width: 400px;
            }

            .right-content h1 {
                font-size: 2rem;
            }

            .right-content p {
                font-size: 1rem;
            }

            .login-form {
                max-width: 450px;
                padding: 30px;
            }

            .form-logo {
                max-height: 90px;
                padding: 12px 18px;
            }
        }

        @media (max-width: 768px) {
            body {
                flex-direction: column;
                flex-direction: column-reverse;
            }

            .left-side {
                height: 70vh;
                flex: none;
            }

            .right-side {
                height: 30vh;
                flex: none;
            }

            .right-content {
                text-align: center;
                right: 50%;
                transform: translateX(50%);
                width: 90%;
                bottom: 20px;
            }

            .right-content h1 {
                font-size: 1.8rem;
                margin-bottom: 10px;
            }

            .right-content p {
                font-size: 0.95rem;
            }

            .login-form {
                width: 90%;
                padding: 25px;
                margin-top: 15px;
                max-width: 400px;
            }

            .form-logo {
                max-height: 80px;
                padding: 10px 15px;
            }
        }

        @media (max-width: 480px) {
            .right-content h1 {
                font-size: 1.5rem;
            }

            .login-form {
                padding: 20px;
                max-width: 350px;
            }

            .form-logo-container {
                padding: 0 5px;
            }

            .form-logo {
                max-height: 70px;
                padding: 8px 12px;
            }

            .form-group input,
            .form-group select {
                padding: 10px 35px 10px 12px;
                font-size: 13px;
            }

            .input-icon,
            .password-toggle {
                top: 30px;
                font-size: 1rem;
            }
        }
    </style>
</head>

<body>

    <!-- Bagian kiri (sekarang kanan) - FORM REGISTER -->
    <div class="left-side">
        <!-- Loading spinner -->
        <div class="loading">
            <div class="spinner"></div>
        </div>

        <!-- Form register -->
        <div class="login-form">
            <!-- Logo yang DIPERBESAR ke kanan dan kiri -->
            <div class="form-logo-container">
                <img src="{{ asset('assets/images/logo1.png') }}" alt="Logo Sistem Pengaduan" class="form-logo">
            </div>

            <h2>Daftar Akun Baru</h2>
            <p class="login-subtitle">Silakan lengkapi data untuk membuat akun baru</p>

            <!-- Error/Success Messages -->
            @if ($errors->any())
                <div class="alert alert-danger" id="error-message">
                    @foreach ($errors->all() as $error)
                        {{ $error }}<br>
                    @endforeach
                </div>
            @endif

            @if (session('success'))
                <div class="alert alert-success" id="success-message">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('Auth.regist') }}" method="POST" id="registerForm">
                @csrf

                <div class="form-group">
                    <label for="name">Username</label>
                    <input type="text" id="name" name="name" placeholder="Masukkan username" value="{{ old('name') }}" required>
                    <span class="input-icon">👤</span>
                    @error('name')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="Masukkan email" value="{{ old('email') }}" required>
                    <span class="input-icon">✉️</span>
                    @error('email')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="role">Daftar Sebagai</label>
                    <select name="role" id="role" required>
                        <option value="" disabled selected>Pilih Role</option>
                        <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="staff" {{ old('role') == 'staff' ? 'selected' : '' }}>Staff</option>
                        <option value="kades" {{ old('role') == 'kades' ? 'selected' : '' }}>Kepala Desa</option>
                    </select>
                    <span class="input-icon">▼</span>
                    @error('role')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Masukkan password" required>
                    <button type="button" class="password-toggle" id="togglePassword">👁️</button>
                    @error('password')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password_confirmation">Ulangi Password</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Ulangi password" required>
                    <button type="button" class="password-toggle" id="togglePasswordConfirm">👁️</button>
                </div>

                <button type="submit" class="login-btn" id="submitBtn">DAFTAR</button>

                <p class="register-link">Sudah punya akun? <a href="{{ route('Auth.index') }}">Masuk di sini</a></p>
            </form>
        </div>
    </div>

    <!-- Bagian kanan (sekarang kiri) - GAMBAR -->
    <div class="right-side">
        <img src="{{ asset('assets/images/login.jpg') }}" alt="Pengaduan Masyarakat"
            style="width: 100%; height: 100%; object-fit: cover;" />

        <div class="right-content">
            <h1>Sistem Pengaduan Masyarakat</h1>
            <p>Platform digital untuk menyampaikan keluhan, saran, dan pengaduan masyarakat secara cepat, transparan,
                dan efisien. Bantu kami membangun pelayanan publik yang lebih baik.</p>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Toggle password visibility untuk password
            const togglePassword = document.getElementById('togglePassword');
            const passwordInput = document.getElementById('password');

            if (togglePassword) {
                togglePassword.addEventListener('click', function() {
                    const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                    passwordInput.setAttribute('type', type);
                    this.textContent = type === 'password' ? '👁️' : '🙈';
                });
            }

            // Toggle password visibility untuk password confirmation
            const togglePasswordConfirm = document.getElementById('togglePasswordConfirm');
            const passwordConfirmInput = document.getElementById('password_confirmation');

            if (togglePasswordConfirm) {
                togglePasswordConfirm.addEventListener('click', function() {
                    const type = passwordConfirmInput.getAttribute('type') === 'password' ? 'text' : 'password';
                    passwordConfirmInput.setAttribute('type', type);
                    this.textContent = type === 'password' ? '👁️' : '🙈';
                });
            }

            // Show error/success messages
            const errorMessage = document.getElementById('error-message');
            const successMessage = document.getElementById('success-message');

            if (errorMessage) {
                errorMessage.style.display = 'block';
                setTimeout(() => {
                    errorMessage.style.opacity = '0';
                    setTimeout(() => errorMessage.style.display = 'none', 500);
                }, 5000);
            }

            if (successMessage) {
                successMessage.style.display = 'block';
                setTimeout(() => {
                    successMessage.style.opacity = '0';
                    setTimeout(() => successMessage.style.display = 'none', 500);
                }, 5000);
            }

            // Form submission with loading
            const registerForm = document.getElementById('registerForm');
            const submitBtn = document.getElementById('submitBtn');
            const loading = document.querySelector('.loading');

            if (registerForm) {
                registerForm.addEventListener('submit', function(e) {
                    const inputs = document.querySelectorAll('input[required], select[required]');
                    let isValid = true;

                    inputs.forEach(input => {
                        if (!input.value.trim()) {
                            input.style.border = '2px solid #ff6b6b';
                            isValid = false;
                            if (!document.activeElement === input) {
                                input.focus();
                            }
                        }
                    });

                    // Validasi password match
                    const password = document.getElementById('password').value;
                    const passwordConfirm = document.getElementById('password_confirmation').value;

                    if (password !== passwordConfirm) {
                        e.preventDefault();
                        alert('Password dan konfirmasi password tidak cocok!');
                        document.getElementById('password').style.border = '2px solid #ff6b6b';
                        document.getElementById('password_confirmation').style.border = '2px solid #ff6b6b';
                        return false;
                    }

                    if (!isValid) {
                        e.preventDefault();
                        setTimeout(() => {
                            inputs.forEach(input => {
                                input.style.border = '';
                            });
                        }, 2000);
                        return false;
                    }

                    // Show loading
                    if (submitBtn && loading) {
                        submitBtn.disabled = true;
                        submitBtn.innerHTML = 'Memproses...';
                        loading.style.display = 'block';
                    }
                });
            }
        });
    </script>
</body>

</html>
