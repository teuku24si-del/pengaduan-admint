<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login Page</title>
    <style>
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
        }

        /* Bagian kiri (gambar) */
        .left-side {
            flex: 1;
            background-size: cover;
            width: 100%;
            height: 100vh;
        }

        /* Bagian kanan (form login) */
        .right-side {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #3ceb07 0%, #2575fc 100%);
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
                radial-gradient(circle at 25% 25%, rgba(255, 255, 255, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 75% 75%, rgba(255, 255, 255, 0.1) 0%, transparent 50%);
            z-index: 1;
        }

        /* Form login tanpa card */
        .login-form {
            width: 80%;
            max-width: 400px;
            padding: 40px;
            position: relative;
            z-index: 2;
            color: white;
        }

        .login-form h2 {
            text-align: center;
            margin-bottom: 30px;
            font-size: 28px;
            font-weight: 600;
        }

        .login-form label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: rgba(255, 255, 255, 0.9);
        }

        .login-form input {
            width: 100%;
            padding: 12px 15px;
            margin-bottom: 20px;
            border: none;
            border-radius: 8px;
            font-size: 14px;
            background-color: rgba(255, 255, 255, 0.9);
            transition: all 0.3s ease;
        }

        .login-form input:focus {
            outline: none;
            background-color: white;
            box-shadow: 0 0 0 3px rgba(255, 255, 255, 0.3);
        }

        .login-form button {
            width: 100%;
            padding: 12px;
            background-color: white;
            border: none;
            color: #2575fc;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 10px;
        }

        .login-form button:hover {
            background-color: #f0f0f0;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .login-form p {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
            color: rgba(255, 255, 255, 0.9);
        }

        .login-form a {
            color: white;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .login-form a:hover {
            text-decoration: underline;
            text-shadow: 0 0 5px rgba(255, 255, 255, 0.5);
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
            animation: float 15s infinite linear;
        }

        .floating-element:nth-child(1) {
            width: 80px;
            height: 80px;
            top: 20%;
            left: 10%;
            animation-delay: 0s;
        }

        .floating-element:nth-child(2) {
            width: 120px;
            height: 120px;
            top: 60%;
            left: 80%;
            animation-delay: -5s;
        }

        .floating-element:nth-child(3) {
            width: 60px;
            height: 60px;
            top: 80%;
            left: 20%;
            animation-delay: -10s;
        }

        @keyframes float {
            0% {
                transform: translateY(0) rotate(0deg);
            }

            50% {
                transform: translateY(-20px) rotate(180deg);
            }

            100% {
                transform: translateY(0) rotate(360deg);
            }
        }

        @media (max-width: 768px) {
            body {
                flex-direction: column;
            }

            .left-side {
                height: 40vh;
            }

            .right-side {
                height: 60vh;
            }
        }
    </style>
</head>

<body>

    <div class="left-side">
        <img src="{{ asset('assets/images/desa.jpg') }}" alt=""
            style="width: 100%; height: 100%; object-fit: cover;" />
    </div>

    <div class="right-side">
        <!-- Floating elements background -->
        <div class="floating-elements">
            <div class="floating-element"></div>
            <div class="floating-element"></div>
            <div class="floating-element"></div>
        </div>

        <!-- Form login tanpa card -->


        <div class="login-form">
            <h2>Login</h2>
            <form action="{{ route('Auth.store') }}" method="POST">
                @csrf
                <label for="username">Username atau Email</label>
                <input type="text" id="name" name="name" placeholder="Masukkan username atau email" required>

                <label for="password">Password</label>
                <input type="password" id="password" name="password"  placeholder="Masukkan password" required>

                <button type="submit">Login</button>

                <p>Belum punya akun? <a href="{{ route('Auth.regis') }}">Daftar di sini</a></p>
            </form>
        </div>
    </div>

</body>

</html>
