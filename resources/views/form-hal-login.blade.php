<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login - Sistem Pengaduan Masyarakat</title>
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
        }

        /* Bagian kiri (gambar) */
        .left-side {
            flex: 1;
            position: relative;
            overflow: hidden;
        }

        .left-side::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(to bottom, rgba(0, 92, 230, 0.3), rgba(0, 92, 230, 0.1));
            z-index: 1;
        }

        .left-content {
            position: absolute;
            bottom: 50px;
            left: 50px;
            color: white;
            z-index: 2;
            max-width: 500px;
        }

        /* PERUBAHAN: Warna teks menjadi MERAH */
        .left-content h1 {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 15px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
            color: #ff0000; /* Warna MERAH untuk judul */
        }

        /* PERUBAHAN: Warna teks deskripsi menjadi MERAH */
        .left-content p {
            font-size: 1.1rem;
            line-height: 1.6;
            opacity: 0.9;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2);
            color: #ff3333; /* Warna MERAH yang sedikit lebih terang untuk deskripsi */
            font-weight: 500; /* Sedikit lebih tebal */
        }

        /* Bagian kanan (form login) */
        .right-side {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #0066cc 0%, #003366 100%);
            position: relative;
            overflow: hidden;
        }

        /* Background pattern untuk bagian kanan */
        .right-side::before {
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

        /* Logo - PERUBAHAN: Mengatur logo agar lebih terlihat */
        .logo-container {
            position: absolute;
            top: 30px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 3;
            display: flex;
            align-items: center;
            gap: 15px;
            background: rgba(255, 255, 255, 0.15); /* Background sedikit transparan */
            padding: 10px 20px;
            border-radius: 15px;
            backdrop-filter: blur(5px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .logo {
            height: 50px;
            width: auto;
            /* filter: brightness(0) invert(1); DIHAPUS agar logo warna asli terlihat */
            transition: transform 0.3s ease;
            background: white; /* Background putih untuk logo */
            padding: 5px;
            border-radius: 10px;
        }

        .logo:hover {
            transform: scale(1.05);
            box-shadow: 0 5px 15px rgba(255, 255, 255, 0.3);
        }

        .logo-text {
            color: white;
            font-size: 1.5rem;
            font-weight: 700;
            letter-spacing: 1px;
            text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.3);
        }

        /* Form login */
        .login-form {
            width: 85%;
            max-width: 450px;
            padding: 40px;
            position: relative;
            z-index: 2;
            color: white;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
        }

        .login-form h2 {
            text-align: center;
            margin-bottom: 5px;
            font-size: 1.8rem;
            font-weight: 600;
            color: white;
        }

        .login-subtitle {
            text-align: center;
            margin-bottom: 30px;
            font-size: 1rem;
            color: rgba(255, 255, 255, 0.8);
        }

        .form-group {
            margin-bottom: 25px;
            position: relative;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: rgba(255, 255, 255, 0.9);
            font-size: 0.95rem;
        }

        .form-group input {
            width: 100%;
            padding: 14px 45px 14px 15px;
            border: none;
            border-radius: 10px;
            font-size: 15px;
            background-color: rgba(255, 255, 255, 0.95);
            transition: all 0.3s ease;
            color: #333;
        }

        .form-group input::placeholder {
            color: #999;
        }

        .form-group input:focus {
            outline: none;
            background-color: white;
            box-shadow: 0 0 0 3px rgba(255, 255, 255, 0.4);
            transform: translateY(-1px);
        }

        .input-icon {
            position: absolute;
            right: 15px;
            top: 40px;
            color: #666;
            font-size: 1.2rem;
        }

        .login-btn {
            width: 100%;
            padding: 15px;
            background: linear-gradient(135deg, #00cc66 0%, #00a854 100%);
            border: none;
            color: white;
            border-radius: 10px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 10px;
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }

        .login-btn:hover {
            background: linear-gradient(135deg, #00b359 0%, #008f44 100%);
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(0, 180, 100, 0.3);
        }

        .login-btn:active {
            transform: translateY(0);
        }

        .register-link {
            text-align: center;
            margin-top: 25px;
            font-size: 14px;
            color: rgba(255, 255, 255, 0.9);
        }

        .register-link a {
            color: white;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            position: relative;
            padding-bottom: 2px;
        }

        .register-link a::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 2px;
            background: white;
            transition: width 0.3s ease;
        }

        .register-link a:hover::after {
            width: 100%;
        }

        .register-link a:hover {
            text-shadow: 0 0 8px rgba(255, 255, 255, 0.5);
        }

        /* Animasi floating elements */
        .floating-elements {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            overflow: hidden;
            z-index: 1;
        }

        .floating-element {
            position: absolute;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            animation: float 20s infinite linear;
        }

        .floating-element:nth-child(1) {
            width: 60px;
            height: 60px;
            top: 15%;
            left: 15%;
            animation-delay: 0s;
        }

        .floating-element:nth-child(2) {
            width: 100px;
            height: 100px;
            top: 65%;
            left: 85%;
            animation-delay: -7s;
        }

        .floating-element:nth-child(3) {
            width: 40px;
            height: 40px;
            top: 85%;
            left: 25%;
            animation-delay: -14s;
        }

        @keyframes float {
            0% {
                transform: translateY(0) rotate(0deg) scale(1);
            }

            33% {
                transform: translateY(-30px) rotate(120deg) scale(1.1);
            }

            66% {
                transform: translateY(15px) rotate(240deg) scale(0.9);
            }

            100% {
                transform: translateY(0) rotate(360deg) scale(1);
            }
        }

        /* Responsive Design */
        @media (max-width: 1024px) {
            .left-content {
                left: 30px;
                bottom: 30px;
                max-width: 400px;
            }

            .left-content h1 {
                font-size: 2rem;
            }

            .left-content p {
                font-size: 1rem;
            }
        }

        @media (max-width: 768px) {
            body {
                flex-direction: column;
            }

            .left-side {
                height: 40vh;
                flex: none;
            }

            .left-content {
                text-align: center;
                left: 50%;
                transform: translateX(-50%);
                width: 90%;
                bottom: 20px;
            }

            .left-content h1 {
                font-size: 1.8rem;
                margin-bottom: 10px;
            }

            .left-content p {
                font-size: 0.95rem;
            }

            .right-side {
                height: 60vh;
                flex: none;
            }

            .logo-container {
                top: 20px;
                padding: 8px 15px;
            }

            .logo {
                height: 40px;
            }

            .logo-text {
                font-size: 1.3rem;
            }

            .login-form {
                width: 90%;
                padding: 30px 25px;
                margin-top: 40px;
            }

            .login-form h2 {
                font-size: 1.5rem;
            }
        }

        @media (max-width: 480px) {
            .left-content h1 {
                font-size: 1.5rem;
            }

            .logo-container {
                flex-direction: column;
                gap: 8px;
                padding: 8px 12px;
            }

            .logo-text {
                font-size: 1.2rem;
            }

            .login-form {
                padding: 25px 20px;
            }

            .form-group input {
                padding: 12px 40px 12px 12px;
            }
        }

        /* Error message styling */
        .alert {
            padding: 12px 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 14px;
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
            width: 40px;
            height: 40px;
            border: 4px solid rgba(255, 255, 255, 0.3);
            border-top: 4px solid white;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* Password toggle */
        .password-toggle {
            position: absolute;
            right: 15px;
            top: 40px;
            background: none;
            border: none;
            color: #666;
            cursor: pointer;
            font-size: 1.2rem;
            padding: 0;
        }
    </style>
</head>

<body>

    <div class="left-side">
        <img src="{{ asset('assets/images/login.jpg') }}" alt="Pengaduan Masyarakat"
             style="width: 100%; height: 100%; object-fit: cover;" />

        <div class="left-content">
            <h1>Sistem Pengaduan Masyarakat</h1>
            <p>Platform digital untuk menyampaikan keluhan, saran, dan pengaduan masyarakat secara cepat, transparan, dan efisien. Bantu kami membangun pelayanan publik yang lebih baik.</p>
        </div>
    </div>

    <div class="right-side">
        <!-- Logo - PERUBAHAN: Logo sekarang lebih terlihat -->
        <div class="logo-container">
            <img src="{{ asset('assets/images/logo1.png') }}" alt="Logo" class="logo">
            <div class="logo-text">Pengaduan Masyarakat</div>
        </div>

        <!-- Floating elements background -->
        <div class="floating-elements">
            <div class="floating-element"></div>
            <div class="floating-element"></div>
            <div class="floating-element"></div>
        </div>

        <!-- Loading spinner -->
        <div class="loading">
            <div class="spinner"></div>
        </div>

        <!-- Form login -->
        <div class="login-form">
            <h2>Selamat Datang</h2>
            <p class="login-subtitle">Silakan login untuk mengakses sistem</p>

            <!-- Error/Success Messages -->
            @if($errors->any())
            <div class="alert alert-danger" id="error-message">
                @foreach($errors->all() as $error)
                {{ $error }}<br>
                @endforeach
            </div>
            @endif

            @if(session('success'))
            <div class="alert alert-success" id="success-message">
                {{ session('success') }}
            </div>
            @endif

            <form action="{{ route('Auth.store') }}" method="POST" id="loginForm">
                @csrf

                <div class="form-group">
                    <label for="name">Username atau Email</label>
                    <input type="text" id="name" name="name" placeholder="Masukkan username atau email" required>
                    <span class="input-icon">👤</span>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Masukkan password" required>
                    <button type="button" class="password-toggle" id="togglePassword">👁️</button>
                </div>

                <button type="submit" class="login-btn" id="submitBtn">Login</button>

                <p class="register-link">Belum punya akun? <a href="{{ route('Auth.regis') }}">Daftar di sini</a></p>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Toggle password visibility
            const togglePassword = document.getElementById('togglePassword');
            const passwordInput = document.getElementById('password');

            if (togglePassword) {
                togglePassword.addEventListener('click', function() {
                    const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                    passwordInput.setAttribute('type', type);
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
                    errorMessage.style.transition = 'opacity 0.5s';
                    setTimeout(() => errorMessage.style.display = 'none', 500);
                }, 5000);
            }

            if (successMessage) {
                successMessage.style.display = 'block';
                setTimeout(() => {
                    successMessage.style.opacity = '0';
                    successMessage.style.transition = 'opacity 0.5s';
                    setTimeout(() => successMessage.style.display = 'none', 500);
                }, 5000);
            }

            // Form submission with loading
            const loginForm = document.getElementById('loginForm');
            const submitBtn = document.getElementById('submitBtn');
            const loading = document.querySelector('.loading');

            if (loginForm) {
                loginForm.addEventListener('submit', function(e) {
                    const nameInput = document.getElementById('name');
                    const passwordInput = document.getElementById('password');

                    // Simple validation
                    if (!nameInput.value.trim() || !passwordInput.value.trim()) {
                        e.preventDefault();
                        if (!nameInput.value.trim()) {
                            nameInput.style.border = '2px solid #ff6b6b';
                            nameInput.focus();
                        }
                        if (!passwordInput.value.trim()) {
                            passwordInput.style.border = '2px solid #ff6b6b';
                            if (nameInput.value.trim()) passwordInput.focus();
                        }

                        // Reset border after 2 seconds
                        setTimeout(() => {
                            nameInput.style.border = '';
                            passwordInput.style.border = '';
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

            // Input focus effects
            const inputs = document.querySelectorAll('input');
            inputs.forEach(input => {
                input.addEventListener('focus', function() {
                    this.parentElement.style.transform = 'translateY(-2px)';
                });

                input.addEventListener('blur', function() {
                    this.parentElement.style.transform = 'translateY(0)';
                });
            });

            // Logo click animation
            const logo = document.querySelector('.logo');
            if (logo) {
                logo.addEventListener('click', function() {
                    this.style.transform = 'scale(1.1) rotate(5deg)';
                    setTimeout(() => {
                        this.style.transform = '';
                    }, 300);
                });
            }

            // Add floating animation delay to elements
            const floatingElements = document.querySelectorAll('.floating-element');
            floatingElements.forEach((el, index) => {
                el.style.animationDelay = `${index * 3}s`;
            });
        });
    </script>
</body>

</html>
