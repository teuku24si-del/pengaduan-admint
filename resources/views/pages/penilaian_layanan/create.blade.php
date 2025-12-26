@extends('layouts.admin.app')

@section('content')
<div class="content-wrapper">
    <!-- Header -->
    <div class="d-xl-flex justify-content-between align-items-start mb-4">
        <h2 class="text-dark font-weight-bold mb-2">Tambah Penilaian Layanan</h2>
        <div class="d-sm-flex justify-content-xl-between align-items-center">
            <a href="{{ route('penilaian_layanan.index') }}" class="btn btn-light shadow-sm border">
                <i class="mdi mdi-arrow-left mr-1"></i>Kembali ke tabel
            </a>
        </div>
    </div>

    <!-- Card Form -->
    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-gradient-primary text-white border-bottom-0 pt-4 pb-3">
                    <h4 class="card-title mb-0">
                        <i class="mdi mdi-star-circle mr-2"></i>Form Penilaian Layanan
                    </h4>
                    <p class="mb-0 opacity-75">Isi form berikut untuk memberikan penilaian layanan</p>
                </div>

                <div class="card-body pt-4">
                    @if($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Perhatian!</strong> Terdapat kesalahan dalam pengisian form:
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="close" data-dismiss="alert">
                                <span>&times;</span>
                            </button>
                        </div>
                    @endif

                    <form action="{{ route('penilaian_layanan.store') }}" method="POST" id="penilaianForm">
                        @csrf

                        <!-- Select Pengaduan -->
                        <div class="form-group mb-4">
                            <label for="pengaduan_id" class="font-weight-medium text-dark">
                                <i class="mdi mdi-ticket-account mr-1"></i>Pilih Pengaduan
                                <span class="text-danger">*</span>
                            </label>
                            <select name="pengaduan_id" id="pengaduan_id"
                                    class="form-control @error('pengaduan_id') is-invalid @enderror" required>
                                <option value="" disabled selected>-- Pilih Pengaduan --</option>
                                @foreach($Pengaduan as $item)
                                    <option value="{{ $item->pengaduan_id }}"
                                            {{ old('pengaduan_id') == $item->pengaduan_id ? 'selected' : '' }}>
                                        [{{ $item->no_tiket }}] - {{ $item->deskripsi }}
                                    </option>
                                @endforeach
                            </select>
                            @error('pengaduan_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted mt-1">
                                <i class="mdi mdi-information-outline mr-1"></i>
                                Pilih pengaduan yang akan dinilai
                            </small>
                        </div>

                        <!-- Rating Bintang -->
                        <div class="form-group mb-4">
                            <label for="rating" class="font-weight-medium text-dark d-block">
                                <i class="mdi mdi-star mr-1"></i>Rating Layanan
                                <span class="text-danger">*</span>
                            </label>

                            <div class="rating-container mb-2">
                                <div class="rating-stars d-flex">
                                    @for($i = 1; $i <= 5; $i++)
                                        <div class="star-wrapper mr-2" data-value="{{ $i }}">
                                            <i class="mdi mdi-star-outline star-icon"
                                               style="font-size: 2.5rem; cursor: pointer; color: #ccc;"
                                               data-index="{{ $i }}"></i>
                                        </div>
                                    @endfor
                                </div>
                                <input type="hidden" name="rating" id="rating"
                                       value="{{ old('rating') }}" required>
                            </div>

                            <div class="rating-labels d-flex justify-content-between mt-1">
                                <small class="text-muted">Sangat Buruk</small>
                                <small class="text-muted">Sangat Baik</small>
                            </div>

                            @error('rating')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror

                            <div id="rating-description" class="mt-2">
                                <small class="text-muted">
                                    <i class="mdi mdi-information-outline mr-1"></i>
                                    Klik bintang untuk memberikan rating (1 = Sangat Buruk, 5 = Sangat Baik)
                                </small>
                            </div>

                            <!-- Rating Description Text -->
                            <div id="rating-text" class="mt-2">
                                <span class="badge badge-light border" id="rating-badge">
                                    Belum ada rating
                                </span>
                                <span class="ml-2 small text-muted" id="rating-desc"></span>
                            </div>
                        </div>

                        <!-- Textarea Komentar -->
                        <div class="form-group mb-4">
                            <label for="komentar" class="font-weight-medium text-dark">
                                <i class="mdi mdi-comment-text-outline mr-1"></i>Komentar
                                <span class="text-danger">*</span>
                            </label>
                            <textarea name="komentar" id="komentar"
                                      class="form-control @error('komentar') is-invalid @enderror"
                                      rows="5" placeholder="Masukkan komentar atau saran untuk layanan kami..."
                                      required>{{ old('komentar') }}</textarea>
                            @error('komentar')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted mt-1">
                                <i class="mdi mdi-information-outline mr-1"></i>
                                Berikan komentar atau saran untuk meningkatkan kualitas layanan kami
                            </small>
                            <div class="text-right mt-1">
                                <small class="text-muted">
                                    <span id="char-count">0</span> / 255 karakter
                                </small>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="form-group pt-3">
                            <div class="d-flex justify-content-between">
                                <button type="reset" class="btn btn-light shadow-sm border" id="resetBtn">
                                    <i class="mdi mdi-refresh mr-1"></i>Reset Form
                                </button>
                                <button type="submit" class="btn btn-primary shadow-sm px-5">
                                    <i class="mdi mdi-content-save mr-1"></i>Simpan Penilaian
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Sidebar Info -->
        <div class="col-lg-4">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-light border-bottom-0 pt-4 pb-3">
                    <h5 class="card-title text-dark mb-0">
                        <i class="mdi mdi-information-outline mr-2"></i>Informasi
                    </h5>
                </div>
                <div class="card-body">
                    <div class="alert alert-info border-0">
                        <div class="d-flex">
                            <div class="mr-3">
                                <i class="mdi mdi-alert-circle-outline" style="font-size: 1.5rem;"></i>
                            </div>
                            <div>
                                <h6 class="alert-heading">Petunjuk Pengisian</h6>
                                <p class="mb-2 small">Pastikan semua field yang bertanda (*) diisi dengan data yang valid dan akurat.</p>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4">
                        <h6 class="font-weight-medium text-dark mb-3">
                            <i class="mdi mdi-help-circle-outline mr-1"></i> Skala Rating:
                        </h6>
                        <div class="list-group list-group-flush">
                            @php
                                $ratingDescriptions = [
                                    1 => ['color' => 'danger', 'text' => 'Sangat Buruk - Layanan tidak memuaskan'],
                                    2 => ['color' => 'warning', 'text' => 'Buruk - Perlu banyak perbaikan'],
                                    3 => ['color' => 'info', 'text' => 'Cukup - Layanan standar'],
                                    4 => ['color' => 'primary', 'text' => 'Baik - Layanan memuaskan'],
                                    5 => ['color' => 'success', 'text' => 'Sangat Baik - Layanan luar biasa']
                                ];
                            @endphp

                            @foreach($ratingDescriptions as $rating => $desc)
                                <div class="list-group-item border-0 px-0 py-2">
                                    <div class="d-flex align-items-center">
                                        <div class="mr-3">
                                            @for($i = 1; $i <= $rating; $i++)
                                                <i class="mdi mdi-star" style="font-size: 1rem; color: #ffc107;"></i>
                                            @endfor
                                        </div>
                                        <div>
                                            <span class="badge badge-{{ $desc['color'] }} mr-2">{{ $rating }} Bintang</span>
                                            <span class="small text-muted">{{ $desc['text'] }}</span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <!-- Preview Card -->
            <div class="card shadow-sm border-0">
                <div class="card-header bg-gradient-primary text-white border-bottom-0 pt-4 pb-3">
                    <h5 class="card-title mb-0">
                        <i class="mdi mdi-eye-outline mr-2"></i>Preview Form
                    </h5>
                </div>
                <div class="card-body">
                    <div id="formPreview" class="small">
                        <p class="text-muted mb-3">Isi form untuk melihat preview di sini</p>
                        <div class="preview-item mb-2">
                            <strong>Pengaduan:</strong>
                            <span class="preview-pengaduan text-muted">-</span>
                        </div>
                        <div class="preview-item mb-2">
                            <strong>Rating:</strong>
                            <span class="preview-rating text-muted">-</span>
                        </div>
                        <div class="preview-item mb-2">
                            <strong>Komentar:</strong>
                            <span class="preview-komentar text-muted">-</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Custom Styles */
    .bg-gradient-primary {
        background: linear-gradient(45deg, #4e73df, #224abe);
    }

    .card {
        border-radius: 10px;
        overflow: hidden;
        transition: all 0.3s ease;
    }

    .card:hover {
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
    }

    .form-control, .custom-select {
        border-radius: 8px;
        border: 1px solid #e3e6f0;
        transition: all 0.3s ease;
    }

    .form-control:focus, .custom-select:focus {
        border-color: #4e73df;
        box-shadow: 0 0 0 0.2rem rgba(78, 115, 223, 0.25);
    }

    .is-invalid {
        border-color: #e74a3b !important;
    }

    .invalid-feedback {
        font-size: 0.875rem;
        margin-top: 0.25rem;
    }

    .badge {
        font-size: 0.75rem;
        padding: 0.375em 0.75em;
        font-weight: 500;
    }

    .list-group-item {
        background-color: transparent;
    }

    .preview-item {
        border-bottom: 1px solid #f8f9fc;
        padding-bottom: 0.5rem;
        margin-bottom: 0.5rem;
    }

    .preview-item:last-child {
        border-bottom: none;
    }

    .btn-primary {
        background: linear-gradient(45deg, #4e73df, #224abe);
        border: none;
        border-radius: 8px;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(78, 115, 223, 0.3);
    }

    .rating-stars .star-wrapper .mdi-star {
        color: #ffc107 !important;
    }

    /* Rating Colors */
    .rating-1 { color: #dc3545 !important; }
    .rating-2 { color: #fd7e14 !important; }
    .rating-3 { color: #ffc107 !important; }
    .rating-4 { color: #28a745 !important; }
    .rating-5 { color: #20c997 !important; }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .d-flex.justify-content-between {
            flex-direction: column;
        }

        .btn {
            width: 100%;
            margin-bottom: 10px;
        }

        .rating-stars .star-wrapper {
            margin-right: 0.5rem;
        }

        .star-icon {
            font-size: 2rem !important;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Rating System
        const stars = document.querySelectorAll('.star-icon');
        const ratingInput = document.getElementById('rating');
        const ratingBadge = document.getElementById('rating-badge');
        const ratingDesc = document.getElementById('rating-desc');

        // Rating descriptions
        const ratingDescriptions = {
            1: { text: 'Sangat Buruk', color: 'danger' },
            2: { text: 'Buruk', color: 'warning' },
            3: { text: 'Cukup', color: 'info' },
            4: { text: 'Baik', color: 'primary' },
            5: { text: 'Sangat Baik', color: 'success' }
        };

        // Initialize with old value if exists
        const oldRating = ratingInput.value;
        if (oldRating && oldRating >= 1 && oldRating <= 5) {
            setRating(parseInt(oldRating));
        }

        // Star click event
        stars.forEach(star => {
            star.addEventListener('click', function() {
                const value = parseInt(this.getAttribute('data-index'));
                setRating(value);
            });

            star.addEventListener('mouseover', function() {
                const value = parseInt(this.getAttribute('data-index'));
                highlightStars(value);
            });
        });

        // Reset stars on mouseout
        document.querySelector('.rating-stars').addEventListener('mouseleave', function() {
            const currentRating = ratingInput.value ? parseInt(ratingInput.value) : 0;
            highlightStars(currentRating);
        });

        function setRating(value) {
            ratingInput.value = value;
            highlightStars(value);

            // Update preview and badge
            const desc = ratingDescriptions[value];
            if (desc) {
                ratingBadge.innerHTML = `<span class="badge badge-${desc.color}">${value} Bintang - ${desc.text}</span>`;
                ratingDesc.textContent = desc.text;

                // Update form preview
                document.querySelector('.preview-rating').innerHTML =
                    `<span class="badge badge-${desc.color}">${value} Bintang - ${desc.text}</span>`;
            }
        }

        function highlightStars(value) {
            stars.forEach(star => {
                const starValue = parseInt(star.getAttribute('data-index'));
                if (starValue <= value) {
                    star.classList.remove('mdi-star-outline');
                    star.classList.add('mdi-star');
                    star.style.color = getStarColor(value);
                } else {
                    star.classList.remove('mdi-star');
                    star.classList.add('mdi-star-outline');
                    star.style.color = '#ccc';
                }
            });
        }

        function getStarColor(rating) {
            const colors = {
                1: '#dc3545', // Red
                2: '#fd7e14', // Orange
                3: '#ffc107', // Yellow
                4: '#28a745', // Green
                5: '#20c997'  // Teal
            };
            return colors[rating] || '#ffc107';
        }

        // Komentar character counter
        const komentarTextarea = document.getElementById('komentar');
        const charCount = document.getElementById('char-count');

        komentarTextarea.addEventListener('input', function() {
            const length = this.value.length;
            charCount.textContent = length;

            // Update preview
            const previewKomentar = document.querySelector('.preview-komentar');
            if (length > 100) {
                previewKomentar.textContent = this.value.substring(0, 100) + '...';
            } else {
                previewKomentar.textContent = this.value || '-';
            }

            // Warning for max length
            if (length > 250) {
                charCount.classList.add('text-warning');
            } else {
                charCount.classList.remove('text-warning');
            }
        });

        // Initialize character count
        charCount.textContent = komentarTextarea.value.length;

        // Pengaduan select preview
        const pengaduanSelect = document.getElementById('pengaduan_id');
        const previewPengaduan = document.querySelector('.preview-pengaduan');

        pengaduanSelect.addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            const ticketMatch = selectedOption.textContent.match(/\[(.*?)\]/);

            if (ticketMatch) {
                const ticketNumber = ticketMatch[1];
                previewPengaduan.innerHTML = `<span class="badge badge-light border">${ticketNumber}</span> ` +
                                            selectedOption.textContent.replace(/\[.*?\]/, '').trim();
            } else {
                previewPengaduan.textContent = selectedOption.textContent;
            }
        });

        // Form validation
        document.getElementById('penilaianForm').addEventListener('submit', function(e) {
            const requiredFields = ['pengaduan_id', 'rating', 'komentar'];
            let isValid = true;

            requiredFields.forEach(field => {
                const element = document.getElementById(field);
                if (!element.value.trim()) {
                    isValid = false;
                    element.classList.add('is-invalid');

                    // Special handling for rating
                    if (field === 'rating') {
                        document.querySelector('.rating-container').classList.add('border', 'border-danger', 'rounded', 'p-2');
                    }
                } else {
                    element.classList.remove('is-invalid');
                    if (field === 'rating') {
                        document.querySelector('.rating-container').classList.remove('border', 'border-danger', 'rounded', 'p-2');
                    }
                }
            });

            if (!isValid) {
                e.preventDefault();
                alert('Harap lengkapi semua field yang wajib diisi!');
            }
        });

        // Reset button functionality
        document.getElementById('resetBtn').addEventListener('click', function() {
            // Reset rating
            ratingInput.value = '';
            stars.forEach(star => {
                star.classList.remove('mdi-star');
                star.classList.add('mdi-star-outline');
                star.style.color = '#ccc';
            });
            ratingBadge.textContent = 'Belum ada rating';
            ratingDesc.textContent = '';
            document.querySelector('.preview-rating').textContent = '-';

            // Reset preview
            document.querySelector('.preview-pengaduan').textContent = '-';
            document.querySelector('.preview-komentar').textContent = '-';

            // Reset character count
            charCount.textContent = '0';

            // Remove validation classes
            document.querySelector('.rating-container').classList.remove('border', 'border-danger', 'rounded', 'p-2');
        });

        // Auto-load old form data if exists
        if (pengaduanSelect.value) {
            pengaduanSelect.dispatchEvent(new Event('change'));
        }
        if (komentarTextarea.value) {
            komentarTextarea.dispatchEvent(new Event('input'));
        }
    });
</script>
@endsection
