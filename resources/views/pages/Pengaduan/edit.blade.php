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
            <h2 class="text-dark font-weight-bold mb-2">Edit Pengaduan</h2> <!-- Ubah judul -->
        </div>
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Form Edit Pengaduan</h4>
                        <!-- PERBAIKAN: Tambahkan @method('PUT') dan parameter ID -->
                        <form class="forms-sample" method="POST" action="{{ route('Pengaduan.update', $dataPengaduan->pengaduan_id) }}">
                            @csrf
                            @method('PUT') <!-- Tambahkan ini untuk method PUT -->

                            <!-- Nomor Tiket -->
                            <div class="form-group">
                                <label for="no_tiket">Nomor Tiket</label>
                                <input type="text" class="form-control" id="no_tiket" name="no_tiket"
                                    value="{{ $dataPengaduan->no_tiket }}" readonly> <!-- Gunakan data existing -->
                            </div>

                            <!-- Pilih Warga -->
                            <div class="form-group">
                                <label for="warga_id">Warga</label>
                                <select class="form-control" id="warga_id" name="warga_id" required>
                                    <option value="">Pilih Warga</option>
                                    @foreach($warga as $w)
                                        <option value="{{ $w->warga_id }}" {{ $dataPengaduan->warga_id == $w->warga_id ? 'selected' : '' }}>
                                            {{ $w->nama }} - {{ $w->agama }} - {{ $w->pekerjaan }} -
                                            {{ $w->jenis_kelamin }} - {{ $w->email }} -  {{ $w->No_Hp }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Pilih Kategori Pengaduan -->
                            <div class="form-group">
                                <label for="kategori_id">Kategori Pengaduan</label>
                                <select class="form-control" id="kategori_id" name="kategori_id" required>
                                    <option value="">Pilih Kategori</option>
                                    @foreach($kategori as $k)
                                        <option value="{{ $k->kategori_id }}"
                                            {{ $dataPengaduan->kategori_id == $k->kategori_id ? 'selected' : '' }}
                                            data-prioritas="{{ $k->prioritas }}"
                                            data-sla="{{ $k->sla_hari }}">
                                            {{ $k->nama }} (Prioritas: {{ ucfirst($k->prioritas) }} - SLA: {{ $k->sla_hari }} hari)
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Judul Pengaduan -->
                            <div class="form-group">
                                <label for="judul">Judul Pengaduan</label>
                                <input type="text" class="form-control" id="judul" name="judul"
                                    value="{{ $dataPengaduan->judul }}" maxlength="100" required> <!-- Gunakan data existing -->
                            </div>

                            <!-- Deskripsi Pengaduan -->
                            <div class="form-group">
                                <label for="deskripsi">Deskripsi Pengaduan</label>
                                <textarea class="form-control" id="deskripsi" name="deskripsi"
                                    rows="4" maxlength="100" required>{{ $dataPengaduan->deskripsi }}</textarea> <!-- Gunakan data existing -->
                            </div>

                            <!-- Status Pengaduan -->
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select class="form-control" id="status" name="status" required>
                                    <option value="sedang_diproses" {{ $dataPengaduan->status == 'sedang_diproses' ? 'selected' : '' }}>Sedang Diproses</option>
                                    <option value="sudah_selesai" {{ $dataPengaduan->status == 'sudah_selesai' ? 'selected' : '' }}>Sudah Selesai</option>
                                </select>
                            </div>

                            <!-- Lokasi Text -->
                            <div class="form-group">
                                <label for="lokasi_text">Lokasi Kejadian</label>
                                <input type="text" class="form-control" id="lokasi_text" name="lokasi_text"
                                    value="{{ $dataPengaduan->lokasi_text }}" maxlength="100" required> <!-- Gunakan data existing -->
                            </div>

                            <!-- RT dan RW -->
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="rt">RT</label>
                                        <input type="text" class="form-control" id="rt" name="rt"
                                            value="{{ $dataPengaduan->rt }}" maxlength="100" required> <!-- Gunakan data existing -->
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="rw">RW</label>
                                        <input type="text" class="form-control" id="rw" name="rw"
                                            value="{{ $dataPengaduan->rw }}" maxlength="100" required> <!-- Gunakan data existing -->
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary mr-2">Update Pengaduan</button> <!-- Ubah teks button -->
                            <a href="{{ route('Pengaduan.index') }}" class="btn btn-light">Batal</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{--end main content--}}
@endsection
