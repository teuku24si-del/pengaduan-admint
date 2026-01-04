@extends('layouts.admin.app')

@section('content')
<div class="content-wrapper">
   

    <div class="d-xl-flex justify-content-between align-items-start mb-4">
        <h2 class="text-dark font-weight-bold mb-2">Tambah Pengaduan Baru</h2>
        <div class="d-flex gap-2">
            <a href="{{ route('Pengaduan.index') }}" class="btn btn-light">
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
                        <h4 class="card-title mb-2">Form Pengaduan</h4>
                        <p class="card-description">Isi form berikut untuk menambahkan pengaduan baru</p>
                    </div>

                    <form class="forms-sample" action="{{ route('Pengaduan.store') }}" method="POST">
                        @csrf

                        <div class="row">
                            <!-- Kolom Kiri - Data Utama -->
                            <div class="col-md-6">
                                <!-- Nomor Tiket -->
                                <div class="form-group form-card">
                                    <label for="no_tiket" class="form-label">
                                        <i class="mdi mdi-ticket text-primary mr-2"></i>
                                        Nomor Tiket
                                    </label>
                                    <div class="input-group input-group-gradient">
                                        <input type="text" class="form-control" id="no_tiket" name="no_tiket"
                                            value="{{ 'TKT-' . date('YmdHis') }}" readonly>
                                        <div class="input-group-append">
                                            <span class="input-group-text">
                                                <i class="mdi mdi-ticket-confirmation text-muted"></i>
                                            </span>
                                        </div>
                                    </div>
                                    <small class="form-text text-muted">
                                        <i class="mdi mdi-information-outline text-primary mr-1"></i>
                                        Nomor tiket akan digenerate otomatis
                                    </small>
                                </div>

                                <!-- Warga -->
                                <div class="form-group form-card">
                                    <label for="warga_id" class="form-label">
                                        <i class="mdi mdi-account text-success mr-2"></i>
                                        Warga
                                    </label>
                                    <div class="select-wrapper">
                                        <select class="form-control select2" id="warga_id" name="warga_id" required style="background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);">
                                            <option value="">Pilih Warga</option>
                                            @foreach($warga as $w)
                                                <option value="{{ $w->warga_id }}">
                                                    {{ $w->nama }} - {{ $w->agama }} - {{ $w->pekerjaan }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <small class="form-text text-muted">Pilih warga yang membuat pengaduan</small>
                                </div>

                                <!-- Kategori Pengaduan -->
                                <div class="form-group form-card">
                                    <label for="kategori_id" class="form-label">
                                        <i class="mdi mdi-tag-outline text-warning mr-2"></i>
                                        Kategori Pengaduan
                                    </label>
                                    <div class="select-wrapper">
                                        <select class="form-control select2" id="kategori_id" name="kategori_id" required style="background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);">
                                            <option value="">Pilih Kategori</option>
                                            @foreach($kategori as $k)
                                                <option value="{{ $k->kategori_id }}"
                                                    data-prioritas="{{ $k->prioritas }}"
                                                    data-sla="{{ $k->sla_hari }}">
                                                    {{ $k->nama }} (Prioritas: {{ ucfirst($k->prioritas) }} - SLA: {{ $k->sla_hari }} hari)
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <small class="form-text text-muted">Pilih kategori pengaduan</small>
                                </div>

                                <!-- Info Prioritas dan SLA -->
                                <div class="form-card" id="info_kategori" style="display: none;">
                                    <div class="info-box">
                                        <div class="info-icon">
                                            <i class="mdi mdi-information-outline text-info"></i>
                                        </div>
                                        <div class="info-content">
                                            <h6 class="info-title">Informasi Kategori</h6>
                                            <div class="info-details">
                                                <div class="info-item">
                                                    <i class="mdi mdi-flag text-danger mr-2"></i>
                                                    <span>Prioritas: </span>
                                                    <strong id="info_prioritas" class="text-danger"></strong>
                                                </div>
                                                <div class="info-item">
                                                    <i class="mdi mdi-clock text-warning mr-2"></i>
                                                    <span>SLA: </span>
                                                    <strong id="info_sla" class="text-warning"></strong> hari
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Kolom Kanan - Detail Pengaduan -->
                            <div class="col-md-6">
                                <!-- Status Pengaduan -->
                                <div class="form-group form-card">
                                    <label for="status" class="form-label">
                                        <i class="mdi mdi-flag-checkered text-danger mr-2"></i>
                                        Status
                                    </label>
                                    <div class="select-wrapper">
                                        <select class="form-control select2" id="status" name="status" required style="background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);">
                                            <option value="">Pilih Status</option>
                                            <option value="sedang_diproses">Sedang Diproses</option>
                                            <option value="sudah_selesai">Sudah Selesai</option>
                                        </select>
                                    </div>
                                    <small class="form-text text-muted">Pilih status pengaduan</small>
                                </div>

                                <!-- Judul Pengaduan -->
                                <div class="form-group form-card">
                                    <label for="judul" class="form-label">
                                        <i class="mdi mdi-format-title text-info mr-2"></i>
                                        Judul Pengaduan
                                    </label>
                                    <div class="input-group input-group-gradient">
                                        <input type="text" class="form-control" id="judul" name="judul"
                                            placeholder="Masukkan judul pengaduan"
                                            value="{{ old('judul') }}" maxlength="100" required>
                                        <div class="input-group-append">
                                            <span class="input-group-text">
                                                <i class="mdi mdi-text text-muted"></i>
                                            </span>
                                        </div>
                                    </div>
                                    <small class="form-text text-muted">
                                        <i class="mdi mdi-information-outline text-primary mr-1"></i>
                                        Maksimal 100 karakter
                                    </small>
                                </div>

                                <!-- Deskripsi Pengaduan -->
                                <div class="form-group form-card">
                                    <label for="deskripsi" class="form-label">
                                        <i class="mdi mdi-text-box-outline text-success mr-2"></i>
                                        Deskripsi Pengaduan
                                    </label>
                                    <div class="input-group input-group-gradient">
                                        <textarea class="form-control" id="deskripsi" name="deskripsi"
                                            rows="4" placeholder="Masukkan deskripsi lengkap pengaduan"
                                            maxlength="100" required>{{ old('deskripsi') }}</textarea>
                                        <div class="input-group-append">
                                            <span class="input-group-text">
                                                <i class="mdi mdi-text-subject text-muted"></i>
                                            </span>
                                        </div>
                                    </div>
                                    <small class="form-text text-muted">
                                        <i class="mdi mdi-information-outline text-primary mr-1"></i>
                                        Maksimal 100 karakter
                                    </small>
                                    <div class="char-count mt-2">
                                        <small>
                                            <span id="deskripsi_count">0</span>/100 karakter
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Lokasi dan RT/RW - Full Width -->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group form-card">
                                    <div class="row">
                                        <!-- Lokasi Kejadian -->
                                        <div class="col-md-6">
                                            <label for="lokasi_text" class="form-label">
                                                <i class="mdi mdi-map-marker text-danger mr-2"></i>
                                                Lokasi Kejadian
                                            </label>
                                            <div class="input-group input-group-gradient">
                                                <input type="text" class="form-control" id="lokasi_text" name="lokasi_text"
                                                    placeholder="Masukkan lokasi kejadian (contoh: Jalan Merdeka No. 10)"
                                                    value="{{ old('lokasi_text') }}" maxlength="100" required>
                                                <div class="input-group-append">
                                                    <span class="input-group-text">
                                                        <i class="mdi mdi-map-marker-outline text-muted"></i>
                                                    </span>
                                                </div>
                                            </div>
                                            <small class="form-text text-muted">Lokasi lengkap kejadian</small>
                                        </div>

                                        <!-- RT dan RW -->
                                        <div class="col-md-6">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label for="rt" class="form-label">
                                                        <i class="mdi mdi-home text-primary mr-2"></i>
                                                        RT
                                                    </label>
                                                    <div class="input-group input-group-gradient">
                                                        <input type="text" class="form-control" id="rt" name="rt"
                                                            placeholder="Masukkan RT"
                                                            value="{{ old('rt') }}" maxlength="100" required>
                                                        <div class="input-group-append">
                                                            <span class="input-group-text">
                                                                <i class="mdi mdi-numeric text-muted"></i>
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <small class="form-text text-muted">Nomor RT</small>
                                                </div>

                                                <div class="col-md-6">
                                                    <label for="rw" class="form-label">
                                                        <i class="mdi mdi-home-group text-success mr-2"></i>
                                                        RW
                                                    </label>
                                                    <div class="input-group input-group-gradient">
                                                        <input type="text" class="form-control" id="rw" name="rw"
                                                            placeholder="Masukkan RW"
                                                            value="{{ old('rw') }}" maxlength="100" required>
                                                        <div class="input-group-append">
                                                            <span class="input-group-text">
                                                                <i class="mdi mdi-numeric text-muted"></i>
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <small class="form-text text-muted">Nomor RW</small>
                                                </div>
                                            </div>
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
                                        <i class="mdi mdi-content-save mr-2"></i> Simpan Pengaduan
                                    </button>
                                    <a href="{{ route('Pengaduan.index') }}" class="btn btn-light-gradient btn-lg">
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

    /* Textarea khusus */
    .input-group-gradient textarea.form-control {
        min-height: 120px;
        resize: vertical;
    }

    /* Info Box Styling */
    .info-box {
        display: flex;
        align-items: center;
        padding: 15px;
        background: linear-gradient(135deg, #f0f9ff 0%, #e6f7ff 100%);
        border-radius: 10px;
        border: 1px solid #b6e0fe;
    }

    .info-icon {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background: linear-gradient(135deg, #2196F3 0%, #1976D2 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 15px;
        color: white;
        font-size: 1.5rem;
    }

    .info-content {
        flex: 1;
    }

    .info-title {
        font-weight: 600;
        color: #0c5460;
        margin-bottom: 5px;
        font-size: 1rem;
    }

    .info-details {
        display: flex;
        flex-direction: column;
        gap: 5px;
    }

    .info-item {
        display: flex;
        align-items: center;
        font-size: 0.9rem;
    }

    /* Character Count */
    .char-count {
        text-align: right;
        font-size: 0.8rem;
        color: #6c757d;
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

        .info-box {
            flex-direction: column;
            text-align: center;
        }

        .info-icon {
            margin-right: 0;
            margin-bottom: 10px;
        }

        .info-details {
            align-items: center;
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
        $('#warga_id, #kategori_id, #status').select2({
            placeholder: "Pilih opsi",
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

    // Menampilkan informasi kategori saat dipilih
    document.getElementById('kategori_id').addEventListener('change', function() {
        const selectedOption = this.options[this.selectedIndex];
        const infoDiv = document.getElementById('info_kategori');
        const infoPrioritas = document.getElementById('info_prioritas');
        const infoSla = document.getElementById('info_sla');

        if (selectedOption.value !== '') {
            const prioritas = selectedOption.getAttribute('data-prioritas');
            const sla = selectedOption.getAttribute('data-sla');

            // Format prioritas untuk ditampilkan
            const formatPrioritas = {
                'rendah': 'Rendah',
                'sedang': 'Sedang',
                'tinggi': 'Tinggi',
                'sangat_tinggi': 'Sangat Tinggi'
            };

            const prioritasText = formatPrioritas[prioritas] || prioritas;

            // Set warna berdasarkan prioritas
            const prioritasColor = {
                'rendah': '#4CAF50',
                'sedang': '#FF9800',
                'tinggi': '#FF5722',
                'sangat_tinggi': '#F44336'
            };

            infoPrioritas.textContent = prioritasText;
            infoPrioritas.style.color = prioritasColor[prioritas] || '#000';
            infoSla.textContent = sla;
            infoDiv.style.display = 'block';
        } else {
            infoDiv.style.display = 'none';
        }
    });

    // Hitung karakter untuk deskripsi
    document.getElementById('deskripsi').addEventListener('input', function() {
        const count = this.value.length;
        const countElement = document.getElementById('deskripsi_count');
        countElement.textContent = count;

        if (count > 100) {
            countElement.style.color = '#F44336';
        } else if (count > 80) {
            countElement.style.color = '#FF9800';
        } else {
            countElement.style.color = '#4CAF50';
        }
    });

    // Validasi form sebelum submit
    document.querySelector('form').addEventListener('submit', function(e) {
        const judul = document.getElementById('judul').value;
        const deskripsi = document.getElementById('deskripsi').value;
        const warga_id = document.getElementById('warga_id').value;
        const kategori_id = document.getElementById('kategori_id').value;
        const status = document.getElementById('status').value;
        const lokasi_text = document.getElementById('lokasi_text').value;
        const rt = document.getElementById('rt').value;
        const rw = document.getElementById('rw').value;

        // Validasi panjang karakter
        if (judul.length > 100) {
            e.preventDefault();
            showToast('error', 'Judul tidak boleh lebih dari 100 karakter');
            document.getElementById('judul').focus();
            return false;
        }

        if (deskripsi.length > 100) {
            e.preventDefault();
            showToast('error', 'Deskripsi tidak boleh lebih dari 100 karakter');
            document.getElementById('deskripsi').focus();
            return false;
        }

        // Validasi field wajib
        if (!warga_id) {
            e.preventDefault();
            showToast('error', 'Silakan pilih warga');
            document.getElementById('warga_id').focus();
            return false;
        }

        if (!kategori_id) {
            e.preventDefault();
            showToast('error', 'Silakan pilih kategori pengaduan');
            document.getElementById('kategori_id').focus();
            return false;
        }

        if (!status) {
            e.preventDefault();
            showToast('error', 'Silakan pilih status pengaduan');
            document.getElementById('status').focus();
            return false;
        }

        if (!lokasi_text.trim()) {
            e.preventDefault();
            showToast('error', 'Lokasi kejadian harus diisi');
            document.getElementById('lokasi_text').focus();
            return false;
        }

        if (!rt.trim()) {
            e.preventDefault();
            showToast('error', 'RT harus diisi');
            document.getElementById('rt').focus();
            return false;
        }

        if (!rw.trim()) {
            e.preventDefault();
            showToast('error', 'RW harus diisi');
            document.getElementById('rw').focus();
            return false;
        }

        // Tampilkan loading state dengan animasi
        const submitBtn = this.querySelector('button[type="submit"]');
        const originalContent = submitBtn.innerHTML;
        submitBtn.innerHTML = '<i class="mdi mdi-loading mdi-spin mr-2"></i> Menyimpan...';
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

    // Inisialisasi karakter count saat halaman dimuat
    document.addEventListener('DOMContentLoaded', function() {
        const deskripsi = document.getElementById('deskripsi');
        const countElement = document.getElementById('deskripsi_count');
        if (deskripsi && countElement) {
            countElement.textContent = deskripsi.value.length;
        }
    });
</script>
@endpush
