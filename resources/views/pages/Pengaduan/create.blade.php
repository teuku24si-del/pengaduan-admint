@extends('layouts.admin.app')

@section('content')
    {{--start main content--}}
    <div class="content-wrapper">
        <div class="row" id="proBanner">
            <div class="col-12">
                <span class="d-flex align-items-center purchase-popup">
                    <p>Like what you see? Check out our premium version for more.</p>
                    <a href="https://github.com/BootstrapDash/ConnectPlusAdmin-Free-Bootstrap-Admin-Template"
                        target="_blank" class="btn ml-auto download-button">Download Free Version</a>
                    <a href="http://www.bootstrapdash.com/demo/connect-plus/jquery/template/"
                        target="_blank" class="btn purchase-button">Upgrade To Pro</a>
                    <i class="mdi mdi-close" id="bannerClose"></i>
                </span>
            </div>
        </div>

        <div class="d-xl-flex justify-content-between align-items-start">
            <h2 class="text-dark font-weight-bold mb-2">Tambah Pengaduan Baru</h2>
            <div class="d-sm-flex justify-content-xl-between align-items-center mb-2">
                <!-- Breadcrumb atau navigasi tambahan bisa ditambahkan di sini -->
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Form Pengaduan</h4>

                        <form class="forms-sample" method="POST" action="{{ route('Pengaduan.store') }}">
                            @csrf

                            <div class="row">
                                <!-- Kolom Kiri - Data Utama -->
                                <div class="col-md-6">
                                    <!-- Nomor Tiket (Auto Generated) -->
                                    <div class="form-group">
                                        <label for="no_tiket">Nomor Tiket</label>
                                        <input type="text" class="form-control" id="no_tiket" name="no_tiket"
                                            value="{{ 'TKT-' . date('YmdHis') }}" readonly>
                                        <small class="form-text text-muted">Nomor tiket akan digenerate otomatis</small>
                                    </div>

                                    <!-- Pilih Warga -->
                                    <div class="form-group">
                                        <label for="warga_id">Warga</label>
                                        <select class="form-control select2" id="warga_id" name="warga_id" required>
                                            <option value="">Pilih Warga</option>
                                            @foreach($warga as $w)
                                                <option value="{{ $w->warga_id }}">{{ $w->nama }} - {{ $w->agama }} -
                                                    {{ $w->pekerjaan }} -  {{ $w->jenis_kelamin }} -  {{ $w->email }} -
                                                    {{ $w->No_Hp }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <!-- Pilih Kategori Pengaduan -->
                                    <div class="form-group">
                                        <label for="kategori_id">Kategori Pengaduan</label>
                                        <select class="form-control select2" id="kategori_id" name="kategori_id" required>
                                            <option value="">Pilih Kategori</option>
                                            @foreach($kategori as $k)
                                                <option value="{{ $k->kategori_id}}"
                                                    data-prioritas="{{ $k->prioritas }}"
                                                    data-sla="{{ $k->sla_hari }}">
                                                    {{ $k->nama }} (Prioritas: {{ ucfirst($k->prioritas) }} - SLA: {{ $k->sla_hari }} hari)
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <!-- Info Prioritas dan SLA -->
                                    <div class="form-group" id="info_kategori" style="display: none;">
                                        <div class="alert alert-info p-3">
                                            <small>
                                                <strong>Informasi Kategori:</strong><br>
                                                Prioritas: <span id="info_prioritas" class="font-weight-bold"></span><br>
                                                SLA: <span id="info_sla" class="font-weight-bold"></span> hari
                                            </small>
                                        </div>
                                    </div>

                                    <!-- Status Pengaduan -->
                                    <div class="form-group">
                                        <label for="status">Status</label>
                                        <select class="form-control" id="status" name="status" required>
                                            <option value="">Pilih Status</option>
                                            <option value="sedang_diproses">Sedang Diproses</option>
                                            <option value="sudah_selesai">Sudah Selesai</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Kolom Kanan - Detail Pengaduan -->
                                <div class="col-md-6">
                                    <!-- Judul Pengaduan -->
                                    <div class="form-group">
                                        <label for="judul">Judul Pengaduan</label>
                                        <input type="text" class="form-control" id="judul" name="judul"
                                            placeholder="Masukkan judul pengaduan" maxlength="100" required>
                                        <small class="form-text text-muted">Maksimal 100 karakter</small>
                                    </div>

                                    <!-- Deskripsi Pengaduan -->
                                    <div class="form-group">
                                        <label for="deskripsi">Deskripsi Pengaduan</label>
                                        <textarea class="form-control" id="deskripsi" name="deskripsi"
                                            rows="4" placeholder="Masukkan deskripsi lengkap pengaduan" maxlength="100" required></textarea>
                                        <small class="form-text text-muted">Maksimal 100 karakter</small>
                                    </div>

                                    <!-- Lokasi Text -->
                                    <div class="form-group">
                                        <label for="lokasi_text">Lokasi Kejadian</label>
                                        <input type="text" class="form-control" id="lokasi_text" name="lokasi_text"
                                            placeholder="Masukkan lokasi kejadian (contoh: Jalan Merdeka No. 10)" maxlength="100" required>
                                    </div>

                                    <!-- RT dan RW -->
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="rt">RT</label>
                                                <input type="text" class="form-control" id="rt" name="rt"
                                                    placeholder="Masukkan RT" maxlength="100" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="rw">RW</label>
                                                <input type="text" class="form-control" id="rw" name="rw"
                                                    placeholder="Masukkan RW" maxlength="100" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Tombol Aksi -->
                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <div class="d-flex justify-content-end">
                                        <button type="submit" class="btn btn-primary mr-2">
                                            <i class="mdi mdi-content-save"></i> Simpan Pengaduan
                                        </button>
                                        <button type="button" class="btn btn-light" onclick="window.history.back()">
                                            <i class="mdi mdi-close"></i> Batal
                                        </button>
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
@endsection

@push('styles')
<style>
    /* Styling untuk form yang terbagi dua kolom */
    .form-group {
        margin-bottom: 1.5rem;
    }

    .select2 {
        width: 100% !important;
    }

    .card-title {
        border-bottom: 1px solid #e3e3e3;
        padding-bottom: 15px;
        margin-bottom: 25px;
    }

    .alert-info {
        background-color: #f0f9ff;
        border-color: #b6e0fe;
        color: #0c5460;
    }
</style>
@endpush

@push('scripts')
<script>
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

            infoPrioritas.textContent = formatPrioritas[prioritas] || prioritas;
            infoSla.textContent = sla;
            infoDiv.style.display = 'block';
        } else {
            infoDiv.style.display = 'none';
        }
    });

    // Validasi form sebelum submit
    document.querySelector('form').addEventListener('submit', function(e) {
        const judul = document.getElementById('judul').value;
        const deskripsi = document.getElementById('deskripsi').value;
        let isValid = true;

        if (judul.length > 100) {
            e.preventDefault();
            alert('Judul tidak boleh lebih dari 100 karakter');
            isValid = false;
        }

        if (deskripsi.length > 100) {
            e.preventDefault();
            alert('Deskripsi tidak boleh lebih dari 100 karakter');
            isValid = false;
        }

        // Validasi tambahan jika diperlukan
        const warga_id = document.getElementById('warga_id').value;
        const kategori_id = document.getElementById('kategori_id').value;
        const status = document.getElementById('status').value;

        if (!warga_id || !kategori_id || !status) {
            if (!warga_id) {
                alert('Silakan pilih warga');
                document.getElementById('warga_id').focus();
            } else if (!kategori_id) {
                alert('Silakan pilih kategori pengaduan');
                document.getElementById('kategori_id').focus();
            } else if (!status) {
                alert('Silakan pilih status pengaduan');
                document.getElementById('status').focus();
            }
            isValid = false;
        }

        if (!isValid) {
            e.preventDefault();
            return false;
        }

        // Tampilkan loading state
        const submitBtn = this.querySelector('button[type="submit"]');
        submitBtn.innerHTML = '<i class="mdi mdi-loading mdi-spin"></i> Menyimpan...';
        submitBtn.disabled = true;
    });

    // Inisialisasi select2 jika tersedia
    if ($.fn.select2) {
        $('#warga_id, #kategori_id').select2({
            placeholder: "Pilih opsi",
            allowClear: true
        });
    }
</script>
@endpush
