//view index penilaian layanan
@extends('layouts.admin.app')

@section('content')
    {{-- start main content --}}
    <div class="content-wrapper">
        <div class="row" id="proBanner">
            <div class="col-12">
                <span class="d-flex align-items-center purchase-popup">
                    <p>Like what you see? Check out our premium version for more.</p>
                    <a href="https://github.com/BootstrapDash/ConnectPlusAdmin-Free-Bootstrap-Admin-Template" target="_blank"
                        class="btn ml-auto download-button">Download Free Version</a>
                    <a href="http://www.bootstrapdash.com/demo/connect-plus/jquery/template/" target="_blank"
                        class="btn purchase-button">Upgrade To Pro</a>
                    <i class="mdi mdi-close" id="bannerClose"></i>
                </span>
            </div>
        </div>

        <div class="d-xl-flex justify-content-between align-items-start mb-4">
            <h2 class="text-dark font-weight-bold mb-2">Data Penilaian Layanan</h2>
            <div class="d-flex gap-2">
                <a href="{{ route('penilaian_layanan.create') }}" class="btn btn-primary">
                    <i class="mdi mdi-plus-circle mr-1"></i> Tambah Penilaian
                </a>
                <a href="{{ route('penilaian_layanan.index') }}" class="btn btn-light">
                    <i class="mdi mdi-refresh"></i> Refresh Data
                </a>
            </div>
        </div>

        <!-- Alert Success -->
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="mdi mdi-check-circle-outline"></i> {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="mdi mdi-alert-circle-outline"></i> {{ session('error') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <!-- Stats Cards -->
        <div class="row mb-4">
            <div class="col-xl-3 col-lg-6">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-muted font-weight-normal mb-1">Total Penilaian</h6>
                                <h3 class="font-weight-bold">{{ $datapenilaian_layanan->total() }}</h3>
                            </div>
                            <div class="bg-primary rounded-circle p-3">
                                <i class="mdi mdi-chart-bar text-white" style="font-size: 1.5rem;"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-6">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-muted font-weight-normal mb-1">Rata-rata Rating</h6>
                                <h3 class="font-weight-bold">
                                    @php
                                        $totalRating = $datapenilaian_layanan->sum('rating');
                                        $count = $datapenilaian_layanan->count();
                                        $average = $count > 0 ? number_format($totalRating / $count, 1) : 0;
                                    @endphp
                                    {{ $average }}
                                    <small class="text-muted" style="font-size: 1rem;">/5</small>
                                </h3>
                            </div>
                            <div class="bg-warning rounded-circle p-3">
                                <i class="mdi mdi-star text-white" style="font-size: 1.5rem;"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-6">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-muted font-weight-normal mb-1">Penilaian Tertinggi</h6>
                                <h3 class="font-weight-bold">
                                    {{ $datapenilaian_layanan->max('rating') ?? 0 }}
                                    <small class="text-muted" style="font-size: 1rem;">bintang</small>
                                </h3>
                            </div>
                            <div class="bg-success rounded-circle p-3">
                                <i class="mdi mdi-star-circle text-white" style="font-size: 1.5rem;"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-6">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-muted font-weight-normal mb-1">Penilaian Terendah</h6>
                                <h3 class="font-weight-bold">
                                    {{ $datapenilaian_layanan->min('rating') ?? 0 }}
                                    <small class="text-muted" style="font-size: 1rem;">bintang</small>
                                </h3>
                            </div>
                            <div class="bg-info rounded-circle p-3">
                                <i class="mdi mdi-star-half text-white" style="font-size: 1.5rem;"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Search and Filter Container -->
        <div class="card mb-4 shadow-sm border-0">
            <div class="card-header bg-white">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0 text-primary">
                        <i class="mdi mdi-filter-outline mr-2"></i>Filter & Pencarian
                    </h5>
                    <span class="badge badge-light">
                        {{ $datapenilaian_layanan->count() }} dari {{ $datapenilaian_layanan->total() }} data ditampilkan
                    </span>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('penilaian_layanan.index') }}" method="GET">
                    <div class="row align-items-end">
                        <div class="col-md-3 mb-3 mb-md-0">
                            <label class="font-weight-bold small text-muted">Filter Bintang</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-light border-right-0">
                                        <i class="mdi mdi-star text-warning"></i>
                                    </span>
                                </div>
                                <select name="rating" class="form-control border-left-0" onchange="this.form.submit()">
                                    <option value="">Semua Rating</option>
                                    @for($i=5; $i>=1; $i--)
                                        <option value="{{ $i }}" {{ request('rating') == $i ? 'selected' : '' }}>
                                            {{ $i }} Bintang
                                        </option>
                                    @endfor
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6 mb-3 mb-md-0">
                            <label class="font-weight-bold small text-muted">Cari Penilaian</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-light border-right-0">
                                        <i class="mdi mdi-magnify"></i>
                                    </span>
                                </div>
                                <input type="text" name="search" class="form-control border-left-0"
                                       placeholder="Cari berdasarkan No. Tiket atau Komentar..."
                                       value="{{ request('search') }}">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit">
                                        <i class="mdi mdi-search"></i> Cari
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="d-flex gap-2">
                                @if(request('search') || request('rating'))
                                    <a href="{{ route('penilaian_layanan.index') }}" class="btn btn-light flex-fill">
                                        <i class="mdi mdi-close-circle-outline mr-1"></i> Reset Filter
                                    </a>
                                @endif
                                <button type="submit" class="btn btn-outline-primary flex-fill">
                                    <i class="mdi mdi-filter-check mr-1"></i> Terapkan
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Active Filter Badges -->
                    @if(request('search') || request('rating'))
                        <div class="row mt-3">
                            <div class="col-12">
                                <div class="d-flex align-items-center">
                                    <span class="mr-2 text-muted small">
                                        <i class="mdi mdi-filter mr-1"></i>Filter Aktif:
                                    </span>
                                    <div class="d-flex flex-wrap gap-2">
                                        @if(request('search'))
                                            <span class="badge badge-primary p-2">
                                                <i class="mdi mdi-magnify mr-1"></i>
                                                Pencarian: "{{ request('search') }}"
                                                <button type="button" class="btn-close-filter ml-2"
                                                        onclick="removeFilter('search')" style="background: none; border: none; color: white; font-size: 0.8rem;">
                                                    ×
                                                </button>
                                            </span>
                                        @endif
                                        @if(request('rating'))
                                            <span class="badge badge-warning p-2">
                                                <i class="mdi mdi-star mr-1"></i>
                                                Rating: {{ request('rating') }} Bintang
                                                <button type="button" class="btn-close-filter ml-2"
                                                        onclick="removeFilter('rating')" style="background: none; border: none; color: white; font-size: 0.8rem;">
                                                    ×
                                                </button>
                                            </span>
                                        @endif
                                        <a href="{{ route('penilaian_layanan.index') }}" class="btn btn-sm btn-link text-danger p-0">
                                            <i class="mdi mdi-close mr-1"></i> Hapus Semua
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </form>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div>
                                <h4 class="card-title mb-0">Daftar Penilaian Layanan</h4>
                                <p class="card-description mb-0">Kelola semua penilaian layanan</p>
                            </div>
                            <div class="badge badge-info p-2">
                                Total: {{ $datapenilaian_layanan->total() }} Penilaian
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-striped custom-table" id="penilaianTable">
                                <thead>
                                    <tr class="table-header">
                                        <th width="100">NO</th>
                                        <th width="150">NO. TIKET</th>
                                        <th width="200">DESKRIPSI PENGADUAN</th>
                                        <th width="150">RATING</th>
                                        <th width="180">KOMENTAR</th>
                                        <th width="120">TANGGAL</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($datapenilaian_layanan as $index => $penilaian)
                                        <tr>
                                            <td class="text-center">
                                                <span class="badge badge-tiket"
                                                    style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                                                    {{ ($datapenilaian_layanan->currentPage() - 1) * $datapenilaian_layanan->perPage() + $loop->iteration }}
                                                </span>
                                            </td>
                                            <td>
                                                @if ($penilaian->pengaduan)
                                                    <div class="d-flex align-items-center">
                                                        <div class="avatar-sm me-2">
                                                            <div class="avatar-title bg-primary rounded-circle text-white">
                                                                <i class="mdi mdi-ticket-outline"></i>
                                                            </div>
                                                        </div>
                                                        <div>
                                                            <strong class="text-truncate"
                                                                style="max-width: 130px; display: inline-block;"
                                                                title="{{ $penilaian->pengaduan->no_tiket ?? 'N/A' }}">
                                                                {{ $penilaian->pengaduan->no_tiket ?? 'N/A' }}
                                                            </strong>
                                                            <br>
                                                            <small class="text-muted">ID: {{ $penilaian->penilaian_id }}</small>
                                                        </div>
                                                    </div>
                                                @else
                                                    <span class="text-muted">-</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($penilaian->pengaduan)
                                                    <div class="font-weight-bold text-truncate" style="max-width: 200px;"
                                                        title="{{ $penilaian->pengaduan->judul ?? '-' }}">
                                                        {{ Str::limit($penilaian->pengaduan->judul ?? '-', 25) }}
                                                    </div>
                                                    <small class="text-muted text-truncate d-block"
                                                        style="max-width: 200px;"
                                                        title="{{ $penilaian->pengaduan->deskripsi ?? '-' }}">
                                                        {{ Str::limit($penilaian->pengaduan->deskripsi ?? '-', 35) }}
                                                    </small>
                                                @else
                                                    <span class="text-muted">Data tidak ditemukan</span>
                                                @endif
                                            </td>
                                            <td>
                                                @php
                                                    $ratingColor = [
                                                        1 => 'danger',
                                                        2 => 'warning',
                                                        3 => 'info',
                                                        4 => 'primary',
                                                        5 => 'success'
                                                    ][$penilaian->rating] ?? 'secondary';

                                                    $ratingText = [
                                                        1 => 'Sangat Buruk',
                                                        2 => 'Buruk',
                                                        3 => 'Cukup',
                                                        4 => 'Baik',
                                                        5 => 'Sangat Baik'
                                                    ][$penilaian->rating] ?? 'Tidak diketahui';
                                                @endphp

                                                <div class="d-flex align-items-center">
                                                    <div class="mr-2">
                                                        @for($i = 1; $i <= 5; $i++)
                                                            @if($i <= $penilaian->rating)
                                                                <i class="mdi mdi-star" style="color: #ffc107;"></i>
                                                            @else
                                                                <i class="mdi mdi-star-outline" style="color: #ccc;"></i>
                                                            @endif
                                                        @endfor
                                                    </div>
                                                    <span class="badge badge-{{ $ratingColor }}"
                                                        style="background: linear-gradient(135deg,
                                                            @if($penilaian->rating == 1) #dc3545 0%, #c82333 100%
                                                            @elseif($penilaian->rating == 2) #ffc107 0%, #e0a800 100%
                                                            @elseif($penilaian->rating == 3) #17a2b8 0%, #138496 100%
                                                            @elseif($penilaian->rating == 4) #4e73df 0%, #224abe 100%
                                                            @else #28a745 0%, #1e7e34 100%
                                                            @endif
                                                        );">
                                                        {{ $penilaian->rating }} Bintang
                                                    </span>
                                                </div>
                                                <small class="text-muted d-block mt-1">{{ $ratingText }}</small>
                                            </td>
                                            <td>
                                                <div class="text-truncate" style="max-width: 170px;"
                                                    title="{{ $penilaian->komentar }}">
                                                    <i class="mdi mdi-comment-text text-info mr-1"></i>
                                                    {{ Str::limit($penilaian->komentar, 30) }}
                                                </div>
                                                @if(strlen($penilaian->komentar) > 30)
                                                    <button class="btn btn-link btn-sm view-comment p-0 mt-1"
                                                            data-comment="{{ $penilaian->komentar }}"
                                                            data-rating="{{ $penilaian->rating }}"
                                                            data-rating-text="{{ $ratingText }}"
                                                            data-tiket="{{ $penilaian->pengaduan->no_tiket ?? 'N/A' }}"
                                                            data-deskripsi="{{ $penilaian->pengaduan->deskripsi ?? '-' }}"
                                                            data-tanggal="{{ $penilaian->created_at->format('d/m/Y') }}">
                                                        Lihat selengkapnya
                                                    </button>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="text-center">
                                                    <div class="font-weight-bold text-primary">
                                                        {{ $penilaian->created_at->format('d/m/Y') }}
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center py-4">
                                                <div class="empty-state">
                                                    <i class="mdi mdi-star-outline display-4 text-muted"></i>
                                                    <h5 class="mt-3">Belum ada data penilaian layanan</h5>
                                                    @if(request('search') || request('rating'))
                                                        <p class="text-muted">Tidak ditemukan data dengan filter yang dipilih</p>
                                                        <a href="{{ route('penilaian_layanan.index') }}"
                                                            class="btn btn-primary mt-2">
                                                            <i class="mdi mdi-close mr-1"></i> Reset Filter
                                                        </a>
                                                    @else
                                                        <p class="text-muted">Silakan tambah penilaian baru untuk memulai</p>
                                                        <a href="{{ route('penilaian_layanan.create') }}"
                                                            class="btn btn-primary mt-2">
                                                            <i class="mdi mdi-plus-circle mr-1"></i> Tambah Penilaian
                                                        </a>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        @if($datapenilaian_layanan->hasPages())
                            <div class="mt-4">
                                {{ $datapenilaian_layanan->withQueryString()->links('pagination::bootstrap-5') }}
                            </div>
                        @endif

                        <!-- Summary Section -->
                        @if($datapenilaian_layanan->isNotEmpty())
                        <div class="row mt-4">
                            <div class="col-md-12">
                                <div class="alert alert-light border">
                                    <div class="row">
                                        <div class="col-md-4 text-center">
                                            <h5 class="font-weight-bold mb-1">Distribusi Rating</h5>
                                            <div class="mt-3">
                                                @php
                                                    $ratingDistribution = [];
                                                    for($i = 1; $i <= 5; $i++) {
                                                        $ratingDistribution[$i] = $datapenilaian_layanan->where('rating', $i)->count();
                                                    }
                                                @endphp

                                                @for($i = 5; $i >= 1; $i--)
                                                    <div class="d-flex align-items-center mb-2">
                                                        <div class="mr-2">
                                                            @for($j = 1; $j <= $i; $j++)
                                                                <i class="mdi mdi-star" style="color: #ffc107; font-size: 0.8rem;"></i>
                                                            @endfor
                                                        </div>
                                                        <div class="progress flex-grow-1" style="height: 10px;">
                                                            @php
                                                                $percentage = $datapenilaian_layanan->count() > 0
                                                                    ? ($ratingDistribution[$i] / $datapenilaian_layanan->count()) * 100
                                                                    : 0;
                                                            @endphp
                                                            <div class="progress-bar bg-{{ [
                                                                1 => 'danger',
                                                                2 => 'warning',
                                                                3 => 'info',
                                                                4 => 'primary',
                                                                5 => 'success'
                                                            ][$i] }}"
                                                                 style="width: {{ $percentage }}%">
                                                            </div>
                                                        </div>
                                                        <small class="ml-2 text-muted">{{ $ratingDistribution[$i] }}</small>
                                                    </div>
                                                @endfor
                                            </div>
                                        </div>

                                        <div class="col-md-8">
                                            <h5 class="font-weight-bold mb-1">Analisis Penilaian</h5>
                                            <div class="row mt-3">
                                                <div class="col-6">
                                                    <div class="mb-3">
                                                        <small class="text-muted d-block">Penilaian Positif (4-5 Bintang)</small>
                                                        <h4 class="font-weight-bold text-success">
                                                            @php
                                                                $positive = $datapenilaian_layanan->where('rating', '>=', 4)->count();
                                                                $positivePercentage = $datapenilaian_layanan->count() > 0
                                                                    ? number_format(($positive / $datapenilaian_layanan->count()) * 100, 1)
                                                                    : 0;
                                                            @endphp
                                                            {{ $positivePercentage }}%
                                                            <small class="text-muted">({{ $positive }} penilaian)</small>
                                                        </h4>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="mb-3">
                                                        <small class="text-muted d-block">Penilaian Negatif (1-2 Bintang)</small>
                                                        <h4 class="font-weight-bold text-danger">
                                                            @php
                                                                $negative = $datapenilaian_layanan->where('rating', '<=', 2)->count();
                                                                $negativePercentage = $datapenilaian_layanan->count() > 0
                                                                    ? number_format(($negative / $datapenilaian_layanan->count()) * 100, 1)
                                                                    : 0;
                                                            @endphp
                                                            {{ $negativePercentage }}%
                                                            <small class="text-muted">({{ $negative }} penilaian)</small>
                                                        </h4>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- end main content --}}

    <!-- Modal for Viewing Full Comment -->
    <div class="modal fade" id="commentModal" tabindex="-1" role="dialog" aria-labelledby="commentModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-gradient-primary text-white">
                    <h5 class="modal-title" id="commentModalLabel">
                        <i class="mdi mdi-comment-text-outline mr-2"></i>Detail Penilaian Layanan
                    </h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <!-- Left Column: Info Pengaduan -->
                        <div class="col-md-6">
                            <div class="card border-0 shadow-sm mb-4">
                                <div class="card-header bg-light">
                                    <h6 class="card-title mb-0">
                                        <i class="mdi mdi-ticket-account mr-2"></i>Informasi Pengaduan
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <div class="row mb-3">
                                        <div class="col-12">
                                            <label class="font-weight-medium text-dark small">No. Tiket:</label>
                                            <div class="border rounded p-2 bg-light" id="modalTiket">
                                                <!-- No Tiket akan diisi di sini -->
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <label class="font-weight-medium text-dark small">Deskripsi Pengaduan:</label>
                                            <div class="border rounded p-2 bg-light" style="min-height: 100px;" id="modalDeskripsi">
                                                <!-- Deskripsi akan diisi di sini -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Right Column: Info Penilaian -->
                        <div class="col-md-6">
                            <div class="card border-0 shadow-sm mb-4">
                                <div class="card-header bg-light">
                                    <h6 class="card-title mb-0">
                                        <i class="mdi mdi-star-circle mr-2"></i>Detail Penilaian
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <div class="row mb-3">
                                        <div class="col-12">
                                            <label class="font-weight-medium text-dark small">Rating:</label>
                                            <div class="border rounded p-3 bg-light text-center">
                                                <div id="modalRatingStars" class="mb-2">
                                                    <!-- Rating stars akan diisi di sini -->
                                                </div>
                                                <div id="modalRatingText" class="font-weight-bold">
                                                    <!-- Rating text akan diisi di sini -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-12">
                                            <label class="font-weight-medium text-dark small">Tanggal Penilaian:</label>
                                            <div class="border rounded p-2 bg-light text-center" id="modalTanggal">
                                                <!-- Tanggal akan diisi di sini -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Full Comment Section -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card border-0 shadow-sm">
                                <div class="card-header bg-light">
                                    <h6 class="card-title mb-0">
                                        <i class="mdi mdi-comment-text mr-2"></i>Komentar Lengkap
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <div class="border rounded p-3 bg-light" style="min-height: 150px;" id="fullCommentContent">
                                        <!-- Komentar lengkap akan diisi di sini -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-dismiss="modal">
                        <i class="mdi mdi-close mr-1"></i>Tutup
                    </button>
                </div>

            </div>
        </div>
    </div>

    <style>
        /* Styling untuk header tabel dengan gradasi biru dan ungu */
        .custom-table thead .table-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 8px 8px 0 0;
            overflow: hidden;
        }

        .custom-table thead th {
            padding: 16px 12px;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.875rem;
            letter-spacing: 0.5px;
            border: none;
            position: relative;
            transition: all 0.3s ease;
            border-right: 1px solid rgba(255, 255, 255, 0.1);
        }

        .custom-table thead th:last-child {
            border-right: none;
        }

        .custom-table thead th:hover {
            background: linear-gradient(135deg, #5a6fd8 0%, #6a42a0 100%);
            transform: translateY(-2px);
        }

        /* Efek garis bawah dengan gradasi yang sama */
        .custom-table thead th:after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 3px;
            background: linear-gradient(90deg, #667eea 0%, #764ba2 100%);
            transition: all 0.3s ease;
        }

        .custom-table thead th:hover:after {
            height: 5px;
            background: linear-gradient(90deg, #5a6fd8 0%, #6a42a0 100%);
        }

        /* Warna sel individual dengan variasi dari gradasi biru-ungu */
        .custom-table thead th:nth-child(1) {
            background: linear-gradient(135deg, #667eea 0%, #6a5df5 100%);
        }

        .custom-table thead th:nth-child(2) {
            background: linear-gradient(135deg, #6a5df5 0%, #764ba2 100%);
        }

        .custom-table thead th:nth-child(3) {
            background: linear-gradient(135deg, #764ba2 0%, #8a3f9c 100%);
        }

        .custom-table thead th:nth-child(4) {
            background: linear-gradient(135deg, #8a3f9c 0%, #9a36a2 100%);
        }

        .custom-table thead th:nth-child(5) {
            background: linear-gradient(135deg, #9a36a2 0%, #a82bab 100%);
        }

        .custom-table thead th:nth-child(6) {
            background: linear-gradient(135deg, #a82bab 0%, #b724ba 100%);
        }

        /* Efek hover untuk setiap kolom */
        .custom-table thead th:nth-child(1):hover {
            background: linear-gradient(135deg, #5a6fd8 0%, #5a4ef2 100%);
        }

        .custom-table thead th:nth-child(2):hover {
            background: linear-gradient(135deg, #5a4ef2 0%, #6a42a0 100%);
        }

        .custom-table thead th:nth-child(3):hover {
            background: linear-gradient(135deg, #6a42a0 0%, #7a378b 100%);
        }

        .custom-table thead th:nth-child(4):hover {
            background: linear-gradient(135deg, #7a378b 0%, #8a2d91 100%);
        }

        .custom-table thead th:nth-child(5):hover {
            background: linear-gradient(135deg, #8a2d91 0%, #9a239a 100%);
        }

        .custom-table thead th:nth-child(6):hover {
            background: linear-gradient(135deg, #9a239a 0%, #a919a3 100%);
        }

        /* Styling untuk baris tabel */
        .custom-table tbody tr {
            transition: all 0.3s ease;
            border-bottom: 1px solid #eef2f7;
        }

        .custom-table tbody tr:hover {
            background-color: #f8f9fa;
            transform: translateX(5px);
            box-shadow: 0 2px 10px rgba(102, 126, 234, 0.1);
        }

        /* Badge styling */
        .badge-tiket {
            color: white !important;
            font-weight: 600;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
        }

        .badge-danger {
            color: white !important;
            font-weight: 500;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
        }

        .badge-success {
            color: white !important;
            font-weight: 500;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
        }

        /* Avatar styling */
        .avatar-sm {
            width: 36px;
            height: 36px;
        }

        .avatar-title {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            height: 100%;
            font-weight: 600;
            font-size: 1rem;
        }

        /* Text truncate */
        .text-truncate {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            vertical-align: middle;
        }

        /* Empty state */
        .empty-state {
            padding: 3rem;
            text-align: center;
        }

        .empty-state i {
            font-size: 4rem;
            color: #667eea;
            opacity: 0.7;
        }

        /* Filter card styling */
        .card-header.bg-white {
            border-bottom: 2px solid #f8f9fa;
        }

        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }

        .input-group-text {
            background-color: #f8f9fa;
            border-color: #dee2e6;
        }

        .btn-close-filter {
            cursor: pointer;
            opacity: 0.8;
            transition: opacity 0.2s;
        }

        .btn-close-filter:hover {
            opacity: 1;
        }

        /* Pagination styling */
        .pagination .page-item.active .page-link {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-color: #667eea;
        }

        .pagination .page-link {
            color: #667eea;
            border: 1px solid #dee2e6;
        }

        .pagination .page-link:hover {
            background-color: #f8f9fa;
            border-color: #dee2e6;
        }

        /* Modal styling */
        .modal-lg {
            max-width: 800px;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .d-flex.gap-2 {
                flex-wrap: wrap;
                gap: 0.5rem !important;
            }

            .btn {
                width: 100%;
                margin-bottom: 0.5rem;
            }

            .custom-table thead {
                display: none;
            }

            .custom-table tbody tr {
                display: block;
                margin-bottom: 1rem;
                border: 1px solid #dee2e6;
                border-radius: 8px;
                box-shadow: 0 2px 4px rgba(102, 126, 234, 0.1);
            }

            .custom-table tbody td {
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 0.75rem;
                border-bottom: 1px solid #eef2f7;
                max-width: 100% !important;
            }

            .custom-table tbody td:before {
                content: attr(data-label);
                font-weight: 600;
                text-transform: uppercase;
                color: #667eea;
                min-width: 100px;
            }

            .custom-table tbody td:last-child {
                border-bottom: none;
                justify-content: center;
            }

            .text-truncate {
                max-width: 150px !important;
            }

            /* Filter form responsive */
            .row.align-items-end > div {
                margin-bottom: 1rem;
            }

            .row.align-items-end > div:last-child {
                margin-bottom: 0;
            }

            /* Modal responsive */
            .modal-dialog.modal-lg {
                margin: 0.5rem;
                max-width: calc(100% - 1rem);
            }

            /* Active filters responsive */
            .d-flex.flex-wrap.gap-2 {
                gap: 0.5rem !important;
            }
        }

        /* Untuk browser yang tidak support gradient */
        @supports not (background: linear-gradient(135deg, #667eea 0%, #764ba2 100%)) {
            .custom-table thead th {
                background-color: #667eea;
            }

            .custom-table thead th:hover {
                background-color: #5a6fd8;
            }

            .badge-tiket {
                background-color: #667eea !important;
            }

            .badge-danger {
                background-color: #dc3545 !important;
            }

            .badge-success {
                background-color: #28a745 !important;
            }

            .pagination .page-item.active .page-link {
                background-color: #667eea;
            }
        }
    </style>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // View comment modal dengan data yang lebih lengkap
            const viewCommentButtons = document.querySelectorAll('.view-comment');

            viewCommentButtons.forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();

                    // Ambil semua data dari tombol
                    const comment = this.getAttribute('data-comment');
                    const rating = parseInt(this.getAttribute('data-rating'));
                    const ratingText = this.getAttribute('data-rating-text');
                    const tiket = this.getAttribute('data-tiket');
                    const deskripsi = this.getAttribute('data-deskripsi');
                    const tanggal = this.getAttribute('data-tanggal');

                    // Set konten modal dengan data lengkap
                    document.getElementById('modalTiket').textContent = tiket || 'N/A';
                    document.getElementById('modalDeskripsi').textContent = deskripsi || '-';
                    document.getElementById('fullCommentContent').textContent = comment;
                    document.getElementById('modalTanggal').textContent = tanggal;

                    // Set rating stars dengan detail lengkap
                    const ratingStars = document.getElementById('modalRatingStars');
                    const ratingTextDiv = document.getElementById('modalRatingText');

                    let starsHtml = '<div class="d-flex justify-content-center mb-2">';
                    for (let i = 1; i <= 5; i++) {
                        if (i <= rating) {
                            starsHtml += `<i class="mdi mdi-star" style="color: #ffc107; font-size: 2rem; margin: 0 5px;"></i>`;
                        } else {
                            starsHtml += `<i class="mdi mdi-star-outline" style="color: #ccc; font-size: 2rem; margin: 0 5px;"></i>`;
                        }
                    }
                    starsHtml += '</div>';

                    // Tentukan warna badge berdasarkan rating
                    let badgeColor = 'secondary';
                    switch(rating) {
                        case 1: badgeColor = 'danger'; break;
                        case 2: badgeColor = 'warning'; break;
                        case 3: badgeColor = 'info'; break;
                        case 4: badgeColor = 'primary'; break;
                        case 5: badgeColor = 'success'; break;
                    }

                    starsHtml += `<span class="badge badge-${badgeColor} p-2" style="font-size: 1rem;">
                        ${rating} Bintang - ${ratingText}
                    </span>`;

                    ratingStars.innerHTML = starsHtml;

                    // Set rating text
                    ratingTextDiv.innerHTML = `<h4 class="mb-0">${ratingText}</h4>`;

                    // Show modal
                    $('#commentModal').modal('show');
                });
            });

            // Responsive table untuk mobile
            function makeTableResponsive() {
                if (window.innerWidth < 768) {
                    const table = document.getElementById('penilaianTable');
                    const rows = table.querySelectorAll('tbody tr');

                    const headerLabels = [
                        'NO',
                        'NO. TIKET',
                        'DESKRIPSI PENGADUAN',
                        'RATING',
                        'KOMENTAR',
                        'TANGGAL'
                    ];

                    rows.forEach(row => {
                        const cells = row.querySelectorAll('td');
                        cells.forEach((cell, index) => {
                            if (headerLabels[index]) {
                                cell.setAttribute('data-label', headerLabels[index]);
                            }
                        });
                    });
                }
            }

            // Animasi untuk header tabel saat hover
            function initTableAnimations() {
                const tableHeaders = document.querySelectorAll('.custom-table thead th');

                tableHeaders.forEach(header => {
                    header.addEventListener('mouseenter', function() {
                        this.style.transform = 'translateY(-2px)';
                        this.style.boxShadow = '0 4px 8px rgba(0, 0, 0, 0.1)';
                    });

                    header.addEventListener('mouseleave', function() {
                        this.style.transform = 'translateY(0)';
                        this.style.boxShadow = 'none';
                    });
                });
            }

            // Auto submit form saat memilih rating
            const ratingSelect = document.querySelector('select[name="rating"]');
            if (ratingSelect) {
                ratingSelect.addEventListener('change', function() {
                    this.closest('form').submit();
                });
            }

            // Add enter key submit for search
            const searchInput = document.querySelector('input[name="search"]');
            if (searchInput) {
                searchInput.addEventListener('keypress', function(e) {
                    if (e.key === 'Enter') {
                        e.preventDefault();
                        this.closest('form').submit();
                    }
                });
            }

            // Remove individual filter
            function removeFilter(filterName) {
                const url = new URL(window.location.href);
                url.searchParams.delete(filterName);
                window.location.href = url.toString();
            }

            // Attach remove filter functionality
            document.querySelectorAll('.btn-close-filter').forEach(button => {
                button.addEventListener('click', function() {
                    const filterName = this.getAttribute('onclick').match(/removeFilter\('(\w+)'\)/)[1];
                    removeFilter(filterName);
                });
            });

            // Jalankan saat halaman dimuat
            makeTableResponsive();
            initTableAnimations();

            // Tambahkan event listener untuk resize window
            window.addEventListener('resize', makeTableResponsive);

            // Auto close alert setelah 5 detik
            setTimeout(function() {
                $('.alert').alert('close');
            }, 5000);

            // Add animation to cards
            const cards = document.querySelectorAll('.card');
            cards.forEach(card => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(20px)';

                setTimeout(() => {
                    card.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
                    card.style.opacity = '1';
                    card.style.transform = 'translateY(0)';
                }, 100);
            });

            // Initialize tooltips for truncated text
            $('[title]').tooltip({
                placement: 'top',
                trigger: 'hover'
            });

            // Animasi untuk modal saat ditampilkan
            $('#commentModal').on('show.bs.modal', function () {
                $(this).find('.modal-content').css({
                    'transform': 'scale(0.7)',
                    'opacity': '0'
                });

                setTimeout(() => {
                    $(this).find('.modal-content').css({
                        'transform': 'scale(1)',
                        'opacity': '1',
                        'transition': 'all 0.3s ease-out'
                    });
                }, 10);
            });

            // Animasi untuk modal saat ditutup
            $('#commentModal').on('hide.bs.modal', function () {
                $(this).find('.modal-content').css({
                    'transform': 'scale(0.7)',
                    'opacity': '0',
                    'transition': 'all 0.3s ease-in'
                });
            });

            // Highlight active filter card
            const activeFilters = document.querySelectorAll('select[name="rating"][value], input[name="search"][value]');
            if (activeFilters.length > 0) {
                const filterCard = document.querySelector('.card.mb-4.shadow-sm.border-0');
                if (filterCard) {
                    filterCard.style.borderLeft = '4px solid #667eea';
                    filterCard.style.boxShadow = '0 0 15px rgba(102, 126, 234, 0.15)';
                }
            }
        });
    </script>
@endpush
