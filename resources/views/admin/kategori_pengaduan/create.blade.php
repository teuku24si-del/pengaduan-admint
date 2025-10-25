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
                        <h2 class="text-dark font-weight-bold mb-2">Tambah Kategori Pengaduan</h2>
                    </div>
                    <div class="row">
                        <div class="col-md-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Form Kategori Pengaduan</h4>
                                    <form class="forms-sample" method="POST" action="{{ route('kategori_pengaduan.store') }}">
                                        @csrf
                                        <div class="form-group">
                                            <label for="nama">Nama Kategori</label>
                                            <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan nama kategori" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="sla_hari">Sela Hari</label>
                                            <input type="number" class="form-control" id="sla_hari" name="sla_hari" placeholder="Masukkan jumlah hari" min="1" required>
                                            <small class="form-text text-muted">Jumlah hari yang dibutuhkan untuk menyelesaikan pengaduan dalam kategori ini</small>
                                        </div>
                                        <div class="form-group">
                                            <label for="prioritas">Prioritas</label>
                                            <select class="form-control" id="prioritas" name="prioritas" required>
                                                <option value="">Pilih Prioritas</option>
                                                <option value="rendah">Rendah</option>
                                                <option value="sedang">Sedang</option>
                                                <option value="tinggi">Tinggi</option>
                                                <option value="sangat_tinggi">Sangat Tinggi</option>
                                            </select>
                                        </div>
                                        <button type="submit" class="btn btn-primary mr-2">Simpan</button>
                                        <button type="button" class="btn btn-light" onclick="window.history.back()">Batal</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{--end main content--}}
                @endsection




