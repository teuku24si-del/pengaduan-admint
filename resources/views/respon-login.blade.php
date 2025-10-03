<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Berhasil</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }

        .response-container {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 450px;
            padding: 40px 30px;
            text-align: center;
            animation: fadeIn 0.5s ease-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .success-icon {
            font-size: 64px;
            color: #4CAF50;
            margin-bottom: 20px;
        }

        .response-header h1 {
            color: #333;
            font-size: 28px;
            margin-bottom: 15px;
        }

        .response-header p {
            color: #666;
            font-size: 16px;
            line-height: 1.5;
            margin-bottom: 30px;
        }

        .button-group {
            display: flex;
            flex-direction: column;
            gap: 15px;
            margin-top: 25px;
        }

        .btn {
            padding: 12px 20px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }

        .btn-home {
            background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
            color: white;
        }

        .btn-home:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(37, 117, 252, 0.4);
        }

        .btn-back {
            background-color: #f5f5f5;
            color: #333;
            border: 1px solid #ddd;
        }

        .btn-back:hover {
            background-color: #e9e9e9;
        }

        @media (min-width: 480px) {
            .button-group {
                flex-direction: row;
                justify-content: center;
            }

            .btn {
                min-width: 150px;
            }
        }
    </style>
</head>
<body>
    <div class="response-container">
        <div class="success-icon">✓</div>

        <div class="response-header">
            <h1>Login Berhasil!</h1>
            <p>Selamat datang {{$username}}! Anda telah berhasil masuk ke akun Anda. Sekarang Anda dapat mengakses semua fitur yang tersedia
                di sistem Pengaduan dan aspirasi warga
            </p>
        </div>

       <div class="button-group">
         <a href="{{route ('Home.index')}}" class="btn btn-back">masuk ke Home</a>
        <a href="{{route ('Auth.index')}}" class="btn btn-back">Kembali ke Login</a>
        </div>
    </div>
</body>
</html>
