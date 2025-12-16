@extends('layouts.admin.app')

@section('content')
    <div class="content-wrapper">
        {{-- Header --}}
        <div class="d-xl-flex justify-content-between align-items-start mb-3">
            <h2 class="text-dark font-weight-bold mb-2">Detail Pengaduan: {{ $Pengaduan->no_tiket }}</h2>
            <div class="d-sm-flex justify-content-xl-between align-items-center">
                <a href="{{ route('Pengaduan.index') }}" class="btn btn-secondary shadow-sm">
                    <i class="mdi mdi-arrow-left mr-1"></i>Kembali
                </a>
            </div>
        </div>

        {{-- Alert --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Berhasil!</strong> {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
            </div>
        @endif

        <div class="row">
            <div class="col-lg-7 grid-margin stretch-card">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h4 class="card-title text-primary"><i class="mdi mdi-information-outline mr-2"></i>Data Laporan
                        </h4>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <tr>
                                    <th class="bg-light" width="30%">Isi Laporan</th>
                                    <td>{{ $Pengaduan->deskripsi }}</td>
                                </tr>
                                <tr>
                                    <th class="bg-light">Kategori</th>
                                    <td><span class="badge badge-info">{{ $Pengaduan->kategori->nama ?? 'Umum' }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="bg-light">Lokasi</th>
                                    <td><i class="mdi mdi-map-marker text-danger"></i> {{ $Pengaduan->lokasi_text }}
                                        (RT{{ $Pengaduan->rt }}/RW{{ $Pengaduan->rw }})</td>
                                </tr>
                                <tr>
                                    <th class="bg-light">Pelapor</th>
                                    <td><strong>{{ $Pengaduan->warga->nama ?? 'Anonim' }}</strong>
                                        ({{ $Pengaduan->warga->nik ?? '-' }})</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-5 grid-margin stretch-card">
                <div class="card shadow-sm border-left-primary">
                    <div class="card-body">
                        <h4 class="card-title">Tambah Lampiran Baru</h4>
                        <form action="{{ route('media.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="ref_table" value="Pengaduan">
                            <input type="hidden" name="ref_id" value="{{ $Pengaduan->pengaduan_id }}">

                            <div class="form-group">
                                <label>Pilih Foto/File</label>
                                <input type="file" name="files[]" class="form-control-file" multiple required>
                                <small class="text-muted">Bisa pilih lebih dari 1 foto sekaligus.</small>
                            </div>
                            <div class="form-group">
                                <textarea name="caption" class="form-control" rows="2" placeholder="Keterangan foto..."></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">
                                <i class="mdi mdi-upload mr-1"></i>Mulai Upload
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h4 class="card-title text-success"><i class="mdi mdi-image-multiple mr-2"></i>File & Foto Terlampir
                        </h4>
                        <hr>

                        @if ($files && $files->count() > 0)
                            <div class="row">
                                @foreach ($files as $file)
                                    <div class="col-md-3 col-sm-6 mb-4">
                                        <div class="card h-100 border">
                                            {{-- Bagian Preview Foto --}}
                                            <div class="text-center p-2 bg-light"
                                                style="height: 180px; overflow: hidden; display: flex; align-items: center; justify-content: center;">
                                                @php
                                                    $isImage = in_array(
                                                        strtolower(pathinfo($file->file_name, PATHINFO_EXTENSION)),
                                                        ['jpg', 'jpeg', 'png', 'gif'],
                                                    );
                                                    $filePath = asset('uploads/' . $file->file_name);
                                                @endphp

                                                @if ($isImage)
                                                    <a href="{{ $filePath }}" target="_blank">
                                                        <img src="{{ $filePath }}" class="img-fluid rounded"
                                                            alt="Lampiran" style="max-height: 160px;">
                                                    </a>
                                                @else
                                                    <div class="text-center">
                                                        <i class="mdi mdi-file-document-outline text-secondary"
                                                            style="font-size: 3rem;"></i>
                                                        <p class="small text-uppercase mb-0">
                                                            {{ pathinfo($file->file_name, PATHINFO_EXTENSION) }} File</p>
                                                    </div>
                                                @endif
                                            </div>

                                            {{-- Bagian Info & Tombol Hapus --}}
                                            <div class="card-body p-2 text-center">
                                                <p class="small text-truncate mb-1" title="{{ $file->caption }}">
                                                    {{ $file->caption ?? 'Tanpa keterangan' }}
                                                </p>
                                                <div class="btn-group w-100">
                                                    <a href="{{ $filePath }}" download
                                                        class="btn btn-xs btn-outline-success shadow-sm" title="Download">
                                                        <i class="mdi mdi-download"></i>
                                                    </a>

                                                    <form action="{{ route('media.destroy', $file->media_id) }}"
                                                        method="POST" class="d-inline w-100">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="btn btn-xs btn-outline-danger shadow-sm w-100"
                                                            onclick="return confirm('Hapus file ini?')">
                                                            <i class="mdi mdi-trash-can"></i> Hapus
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-5">
                                <i class="mdi mdi-image-broken-variant text-muted" style="font-size: 50px;"></i>
                                <p class="text-muted">Belum ada file atau foto yang diupload.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .btn-xs {
            padding: 0.25rem 0.5rem;
            font-size: 0.75rem;
        }

        .border-left-primary {
            border-left: 4px solid #4e73df !important;
        }

        .card {
            transition: transform 0.2s;
        }

        .card:hover {
            transform: translateY(-3px);
        }
    </style>
@endsection
