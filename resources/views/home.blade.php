 <!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: #f5f7fa;
            color: #333;
            padding: 20px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            padding-bottom: 15px;
            border-bottom: 1px solid #e0e0e0;
        }

        .header h1 {
            color: #2c3e50;
            font-size: 24px;
            font-weight: 600;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: #3498db;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
        }

        .stats-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background-color: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
        }

        .stat-value {
            font-size: 32px;
            font-weight: 700;
            margin-bottom: 5px;
        }

        .stat-label {
            font-size: 14px;
            color: #7f8c8d;
        }

        .section-title {
            font-size: 20px;
            font-weight: 600;
            margin-bottom: 20px;
            color: #2c3e50;
        }

        .complaints-table {
            background-color: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            margin-bottom: 30px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background-color: #f8f9fa;
            padding: 15px;
            text-align: left;
            font-weight: 600;
            color: #2c3e50;
            border-bottom: 1px solid #e0e0e0;
        }

        td {
            padding: 15px;
            border-bottom: 1px solid #f0f0f0;
        }

        tr:last-child td {
            border-bottom: none;
        }

        .status {
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        .status-menunggu {
            background-color: #fff3cd;
            color: #856404;
        }

        .status-diproses {
            background-color: #d1ecf1;
            color: #0c5460;
        }

        .status-selesai {
            background-color: #d4edda;
            color: #155724;
        }

        @media (max-width: 768px) {
            .stats-container {
                grid-template-columns: 1fr;
            }

            table {
                display: block;
                overflow-x: auto;
            }
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Dashboard Admin</h1>
        <div class="user-info">
            <div class="user-avatar">A</div>
            <span>Admin</span>
        </div>
    </div>

    <div class="stats-container">
        <div class="stat-card">
            <div class="stat-value">{{ $Total_Warga }}</div>
            <div class="stat-label">Total Warga</div>
        </div>
        <div class="stat-card">
            <div class="stat-value">{{ $Pengaduan_Baru }}</div>
            <div class="stat-label">Pengaduan Baru</div>
        </div>
        <div class="stat-card">
            <div class="stat-value">{{ $dlm_Proses }}</div>
            <div class="stat-label">Dalam Proses</div>
        </div>
        <div class="stat-card">
            <div class="stat-value">4.5</div>
            <div class="stat-label">Rata-rata Penilaian</div>
        </div>
    </div>

    <div class="section-title">Pengaduan Terbaru</div>

    <div class="complaints-table">
        <table>
            <thead>
                <tr>
                    <th>Judul</th>
                    <th>Pelapor</th>
                    <th>Tanggal</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $Judul1 }}</td>
                    <td>{{ $nama1 }}</td>
                    <td>{{ $tgl1 }}</td>
                    <td><span class="status status-menunggu">Menunggu</span></td>
                </tr>
                <tr>
                    <td>{{ $Judul2 }}</td>
                    <td>{{ $nama2 }}</td>
                    <td>{{ $tgl2 }}</td>
                    <td><span class="status status-diproses">Diproses</span></td>
                </tr>
                <tr>
                    <td>{{ $Judul3 }}</td>
                    <td>{{ $nama3 }}</td>
                    <td>{{ $tgl3 }}</td>
                    <td><span class="status status-selesai">Selesai</span></td>
                </tr>
            </tbody>
        </table>
    </div>
</body>
