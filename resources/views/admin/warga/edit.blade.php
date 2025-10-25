   @extends('layouts.admin.app')

   @section('content')
            {{--start main content--}}
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="row" id="proBanner">
                        <div class="col-12">
                            <span class="d-flex align-items-center purchase-popup">
                                <p>Like what you see? Check out our premium version for more.</p>
                                <a href="https://github.com/BootstrapDash/ConnectPlusAdmin-Free-Bootstrap-Admin-Template" target="_blank" class="btn ml-auto download-button">Download Free Version</a>
                                <a href="http://www.bootstrapdash.com/demo/connect-plus/jquery/template/" target="_blank" class="btn purchase-button">Upgrade To Pro</a>
                                <i class="mdi mdi-close" id="bannerClose"></i>
                            </span>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Tambah Data Warga</h4>
                                    <p class="card-description">Isi form berikut untuk menambahkan data warga baru</p>

                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul class="mb-0">
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif

                                    @if (session('success'))
                                        <div class="alert alert-success">
                                            {{ session('success') }}
                                        </div>
                                    @endif

                                    <form action="{{ route('warga.update', $datawarga->warga_id) }}" method="POST">
                                        @csrf
                                        @method('PUT')

                                        <div class="form-group">
                                            <label for="nama">nama</label>
                                            <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan nama lengkap" value="{{ $datawarga->nama ?? '' }}" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="agama">agama</label>
                                            <select class="form-control" id="agama" name="agama" required>
                                                <option value="">Pilih Agama</option>
                                                <option value="Islam" {{ ($datawarga->agama ?? '') == 'Islam' ? 'selected' : '' }}>Islam</option>
                                                <option value="Kristen" {{ ($datawarga->agama ?? '') == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                                                <option value="Katolik" {{ ($datawarga->agama ?? '') == 'Katolik' ? 'selected' : '' }}>Katolik</option>
                                                <option value="Hindu" {{ ($datawarga->agama ?? '') == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                                                <option value="Buddha" {{ ($datawarga->agama ?? '') == 'Buddha' ? 'selected' : '' }}>Buddha</option>
                                                <option value="Konghucu" {{ ($datawarga->agama ?? '') == 'Konghucu' ? 'selected' : '' }}>Konghucu</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="pekerjaan">pekerjaan</label>
                                            <input type="text" class="form-control" id="pekerjaan" name="pekerjaan" placeholder="Masukkan pekerjaan" value="{{ $datawarga->pekerjaan ?? '' }}" required>
                                        </div>

                                        <div class="form-group">
                                            <label>jenis_kelamin</label>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input type="radio" class="form-check-input" name="jenis_kelamin" value="Laki-laki" {{ ($datawarga->jenis_kelamin ?? '') == 'Laki-laki' ? 'checked' : '' }} required> Laki-laki
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input type="radio" class="form-check-input" name="jenis_kelamin" value="Perempuan" {{ ($datawarga->jenis_kelamin ?? '') == 'Perempuan' ? 'checked' : '' }}> Perempuan
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="email">email</label>
                                            <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan email" value="{{ $datawarga->email ?? '' }}" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="No_Hp">No_Hp</label>
                                            <input type="tel" class="form-control" id="No_Hp" name="No_Hp" placeholder="Masukkan nomor handphone" value="{{ $datawarga->No_Hp ?? '' }}" required>
                                        </div>

                                        <button type="submit" class="btn btn-primary mr-2">Simpan</button>
                                        <a href="{{ route('dashboard') }}" class="btn btn-light">Batal</a>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{--end main content--}}
                @endsection

