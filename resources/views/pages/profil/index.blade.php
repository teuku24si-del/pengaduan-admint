@extends('layouts.admin.app')

@section('title', 'Profil Developer - Teuku M Hasbi Alghifari')

@section('content')
<div class="page-header">
    <h3 class="page-title" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">
        👨‍💻 Profil Developer
    </h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page" style="color: #764ba2; font-weight: bold;">Profil Developer</li>
        </ol>
    </nav>
</div>

<div class="row">
    <div class="col-12">
        <div class="card" style="border: none; border-radius: 20px; overflow: hidden; box-shadow: 0 15px 35px rgba(118, 75, 162, 0.2); background: linear-gradient(145deg, #ffffff, #f8f9fa);">
            <div class="card-body p-5">
                <div class="row">
                    <!-- Kolom Kiri: Foto dan Info Kontak -->
                    <div class="col-lg-4 col-md-5">
                        <!-- Card Foto Profil -->
                        <div class="profile-card-left p-4" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 20px; color: white; text-align: center; box-shadow: 0 10px 30px rgba(102, 126, 234, 0.4);">
                            <!-- Foto Developer -->
                            <div class="photo-wrapper mb-4">
                                <div class="photo-frame" style="width: 220px; height: 220px; margin: 0 auto; border-radius: 50%; padding: 10px; background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); position: relative;">
                                    <img src="{{ asset('assets/images/profil.jpeg') }}"
                                         alt="Teuku M Hasbi Alghifari"
                                         class="img-fluid rounded-circle"
                                         style="width: 200px; height: 200px; object-fit: cover; border: 5px solid white;"
                                         onerror="this.src='https://ui-avatars.com/api/?name=Teuku+M+Hasbi&background=667eea&color=fff&size=300'">
                                    <div class="online-status" style="position: absolute; bottom: 20px; right: 20px; width: 25px; height: 25px; background: #4cd137; border-radius: 50%; border: 3px solid white;"></div>
                                </div>
                            </div>

                            <!-- Nama dan NIM -->
                            <h2 class="mb-2" style="font-weight: 800; font-size: 1.8rem;">Teuku M Hasbi Alghifari</h2>
                            <div class="nim-badge mb-4" style="display: inline-block; background: rgba(255, 255, 255, 0.2); padding: 8px 20px; border-radius: 50px; backdrop-filter: blur(10px);">
                                <i class="mdi mdi-card-account-details mr-2"></i>
                                <strong>NIM: 2457301142</strong>
                            </div>

                            <!-- Info Status -->
                            <div class="status-info mb-4 p-3" style="background: rgba(255, 255, 255, 0.1); border-radius: 15px; border-left: 4px solid #f093fb;">
                                <h5 style="color: #f093fb; margin-bottom: 5px;">
                                    <i class="mdi mdi-school mr-2"></i>
                                    Mahasiswa Aktif
                                </h5>
                                <p class="mb-0" style="font-size: 0.9rem;">Politeknik Caltex Riau</p>
                                <p style="font-size: 0.85rem; opacity: 0.9;">Program Studi: Sistem Informasi</p>
                            </div>

                            <!-- Info Kontak -->
                            <div class="contact-info">
                                <h5 class="mb-3" style="color: #f093fb; border-bottom: 2px solid rgba(240, 147, 251, 0.3); padding-bottom: 10px;">
                                    <i class="mdi mdi-contacts mr-2"></i>
                                    Kontak Developer
                                </h5>
                                <div class="contact-item mb-3">
                                    <div class="d-flex align-items-center">
                                        <div class="contact-icon" style="width: 40px; height: 40px; background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); border-radius: 10px; display: flex; align-items: center; justify-content: center; margin-right: 15px;">
                                            <i class="mdi mdi-email" style="color: white; font-size: 1.2rem;"></i>
                                        </div>
                                        <div>
                                            <p class="mb-0" style="font-size: 0.9rem; opacity: 0.9;">Email</p>
                                            <p class="mb-0" style="font-weight: 600;">hasbi10juni@gmail.com</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="contact-item">
                                    <div class="d-flex align-items-center">
                                        <div class="contact-icon" style="width: 40px; height: 40px; background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); border-radius: 10px; display: flex; align-items: center; justify-content: center; margin-right: 15px;">
                                            <i class="mdi mdi-phone" style="color: white; font-size: 1.2rem;"></i>
                                        </div>
                                        <div>
                                            <p class="mb-0" style="font-size: 0.9rem; opacity: 0.9;">Telepon</p>
                                            <p class="mb-0" style="font-weight: 600;">+62 822-8596-7701</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Kolom Kanan: Deskripsi -->
                    <div class="col-lg-8 col-md-7">
                        <!-- Tentang Website Ini -->
                        <div class="about-section p-4" style="background: linear-gradient(135deg, #fdfcfb 0%, #e2d1c3 100%); border-radius: 20px; border-left: 5px solid #f093fb; box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1); margin-bottom: 30px;">
                            <h3 class="mb-4" style="color: #764ba2; font-weight: 700; display: flex; align-items: center;">
                                <span class="icon-wrapper mr-3" style="width: 50px; height: 50px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                                    <i class="mdi mdi-web" style="color: white; font-size: 1.5rem;"></i>
                                </span>
                                Tentang Website Ini
                            </h3>

                            <div class="quote-box mb-4 p-3" style="background: linear-gradient(135deg, rgba(102, 126, 234, 0.1) 0%, rgba(118, 75, 162, 0.1) 100%); border-radius: 15px; border-left: 4px solid #667eea;">
                                <p class="lead mb-0" style="color: #764ba2; font-weight: 600; font-style: italic;">
                                    "Website ini dibuat berdasarkan keresahan warga yang sulit sekali mengadu kepada pihak kepala desa."
                                </p>
                            </div>

                            <p style="color: #333; line-height: 1.8; margin-bottom: 20px;">
                                Sistem pengaduan online ini merupakan solusi inovatif yang dirancang untuk mempermudah komunikasi antara warga dengan pihak pemerintah desa. Website ini dibuat dengan tujuan:
                            </p>

                            <!-- Fitur-fitur Website -->
                            <div class="features-list">
                                <div class="feature-item mb-3 p-3" style="background: white; border-radius: 15px; box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05); border-left: 4px solid #667eea;">
                                    <div class="d-flex align-items-center">
                                        <div class="feature-icon mr-3" style="width: 40px; height: 40px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                                            <i class="mdi mdi-message-text" style="color: white; font-size: 1.2rem;"></i>
                                        </div>
                                        <div>
                                            <h6 class="mb-1" style="color: #333; font-weight: 600;">Pengaduan Mudah</h6>
                                            <p class="mb-0" style="font-size: 0.9rem; color: #666;">Warga dapat menyampaikan pengaduan dengan cepat dan mudah melalui platform online.</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="feature-item mb-3 p-3" style="background: white; border-radius: 15px; box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05); border-left: 4px solid #f093fb;">
                                    <div class="d-flex align-items-center">
                                        <div class="feature-icon mr-3" style="width: 40px; height: 40px; background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                                            <i class="mdi mdi-speedometer" style="color: white; font-size: 1.2rem;"></i>
                                        </div>
                                        <div>
                                            <h6 class="mb-1" style="color: #333; font-weight: 600;">Respon Cepat</h6>
                                            <p class="mb-0" style="font-size: 0.9rem; color: #666;">Mempercepat respon dari pihak staff kepala desa terhadap keluhan warga.</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="feature-item mb-3 p-3" style="background: white; border-radius: 15px; box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05); border-left: 4px solid #4facfe;">
                                    <div class="d-flex align-items-center">
                                        <div class="feature-icon mr-3" style="width: 40px; height: 40px; background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                                            <i class="mdi mdi-chart-bar" style="color: white; font-size: 1.2rem;"></i>
                                        </div>
                                        <div>
                                            <h6 class="mb-1" style="color: #333; font-weight: 600;">Transparansi</h6>
                                            <p class="mb-0" style="font-size: 0.9rem; color: #666;">Meningkatkan transparansi pelayanan publik kepada masyarakat.</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="feature-item p-3" style="background: white; border-radius: 15px; box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05); border-left: 4px solid #43e97b;">
                                    <div class="d-flex align-items-center">
                                        <div class="feature-icon mr-3" style="width: 40px; height: 40px; background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%); border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                                            <i class="mdi mdi-check-circle" style="color: white; font-size: 1.2rem;"></i>
                                        </div>
                                        <div>
                                            <h6 class="mb-1" style="color: #333; font-weight: 600;">Efisiensi Kerja</h6>
                                            <p class="mb-0" style="font-size: 0.9rem; color: #666;">Mempermudah pekerjaan pihak staff kepala desa dan kepala desa.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Row untuk Social Media dan Tech Stack -->
                        <div class="row">
                            <!-- Social Media Section (sekarang di kanan atas) -->
                            <div class="col-lg-6">
                                <div class="social-media-section p-4" style="background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%); border-radius: 20px; border-top: 5px solid #f093fb; box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05); margin-bottom: 30px;">
                                    <h4 class="mb-3" style="color: #764ba2; font-weight: 700; display: flex; align-items: center;">
                                        <span class="icon-wrapper mr-2" style="width: 40px; height: 40px; background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                                            <i class="mdi mdi-share-variant" style="color: white; font-size: 1.2rem;"></i>
                                        </span>
                                        Hubungi Developer
                                    </h4>

                                    <!-- Tombol Sosial Media di Kanan -->
                                    <div class="social-buttons-right">
                                        <!-- GitHub Button -->
                                        <a href="https://github.com/teuku24si-del/pengaduan-admint"
                                           target="_blank"
                                           class="social-button-right d-flex align-items-center justify-content-between p-3 mb-3"
                                           style="background: linear-gradient(135deg, #333 0%, #6e5494 100%); border-radius: 15px; color: white; text-decoration: none; transition: all 0.3s; border: none; box-shadow: 0 5px 15px rgba(110, 84, 148, 0.3);">
                                            <div class="d-flex align-items-center">
                                                <!-- PERUBAHAN: Kotak kecil dihapus, hanya menyisakan teks -->
                                                <div style="margin-right: 15px;">
                                                    <i class="mdi mdi-github" style="font-size: 1.5rem;"></i>
                                                </div>
                                                <div>
                                                    <h5 class="mb-0" style="font-size: 1rem;">GitHub</h5>
                                                    <p class="mb-0" style="font-size: 0.85rem; opacity: 0.9;">@hasbi</p>
                                                </div>
                                            </div>
                                            <i class="mdi mdi-open-in-new" style="opacity: 0.7;"></i>
                                        </a>

                                        <!-- Instagram Button -->
                                        <a href="https://instagram.com/alghifari17_"
                                           target="_blank"
                                           class="social-button-right d-flex align-items-center justify-content-between p-3 mb-3"
                                           style="background: linear-gradient(135deg, #833ab4 0%, #fd1d1d 50%, #fcb045 100%); border-radius: 15px; color: white; text-decoration: none; transition: all 0.3s; border: none; box-shadow: 0 5px 15px rgba(253, 29, 29, 0.3);">
                                            <div class="d-flex align-items-center">
                                                <div class="social-icon-wrapper mr-3" style="width: 45px; height: 45px; background: rgba(255, 255, 255, 0.2); border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                                                    <i class="mdi mdi-instagram" style="font-size: 1.5rem;"></i>
                                                </div>
                                                <div>
                                                    <h5 class="mb-0" style="font-size: 1rem;">Instagram</h5>
                                                    <p class="mb-0" style="font-size: 0.85rem; opacity: 0.9;">@alghifari17_</p>
                                                </div>
                                            </div>
                                            <i class="mdi mdi-open-in-new" style="opacity: 0.7;"></i>
                                        </a>

                                        <!-- LinkedIn Button -->
                                        <a href="https://linkedin.com/in/hasbi-algi"
                                           target="_blank"
                                           class="social-button-right d-flex align-items-center justify-content-between p-3"
                                           style="background: linear-gradient(135deg, #0077b5 0%, #00a0dc 100%); border-radius: 15px; color: white; text-decoration: none; transition: all 0.3s; border: none; box-shadow: 0 5px 15px rgba(0, 119, 181, 0.3);">
                                            <div class="d-flex align-items-center">
                                                <div class="social-icon-wrapper mr-3" style="width: 45px; height: 45px; background: rgba(255, 255, 255, 0.2); border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                                                    <i class="mdi mdi-linkedin" style="font-size: 1.5rem;"></i>
                                                </div>
                                                <div>
                                                    <h5 class="mb-0" style="font-size: 1rem;">LinkedIn</h5>
                                                    <p class="mb-0" style="font-size: 0.85rem; opacity: 0.9;">Teuku M Hasbi</p>
                                                </div>
                                            </div>
                                            <i class="mdi mdi-open-in-new" style="opacity: 0.7;"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <!-- Tech Stack Section (sekarang di kanan bawah) -->
                            <div class="col-lg-6">
                                <div class="tech-stack-section p-4" style="background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%); border-radius: 20px; border-top: 5px solid #4facfe; box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);">
                                    <h4 class="mb-3" style="color: #764ba2; font-weight: 700; display: flex; align-items: center;">
                                        <span class="icon-wrapper mr-2" style="width: 40px; height: 40px; background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                                            <i class="mdi mdi-code-braces" style="color: white; font-size: 1.2rem;"></i>
                                        </span>
                                        Teknologi yang Digunakan
                                    </h4>

                                    <div class="tech-badges-grid">
                                        <div class="row">
                                            <div class="col-6 mb-2">
                                                <span class="tech-badge-sm" style="background: linear-gradient(135deg, #FF2D20 0%, #FF6B6B 100%);">Laravel</span>
                                            </div>
                                            <div class="col-6 mb-2">
                                                <span class="tech-badge-sm" style="background: linear-gradient(135deg, #777BB4 0%, #9FA6D9 100%);">PHP</span>
                                            </div>
                                            <div class="col-6 mb-2">
                                                <span class="tech-badge-sm" style="background: linear-gradient(135deg, #00758F 0%, #00A8CC 100%);">MySQL</span>
                                            </div>
                                            <div class="col-6 mb-2">
                                                <span class="tech-badge-sm" style="background: linear-gradient(135deg, #7952B3 0%, #9D7FEA 100%);">Bootstrap</span>
                                            </div>
                                            <div class="col-6 mb-2">
                                                <span class="tech-badge-sm" style="background: linear-gradient(135deg, #F7DF1E 0%, #FFEB3B 100%); color: #333;">JavaScript</span>
                                            </div>
                                            <div class="col-6 mb-2">
                                                <span class="tech-badge-sm" style="background: linear-gradient(135deg, #0769AD 0%, #0D8BF2 100%);">jQuery</span>
                                            </div>
                                            <div class="col-6 mb-2">
                                                <span class="tech-badge-sm" style="background: linear-gradient(135deg, #E44D26 0%, #F16529 100%);">HTML5</span>
                                            </div>
                                            <div class="col-6 mb-2">
                                                <span class="tech-badge-sm" style="background: linear-gradient(135deg, #1572B6 0%, #33A9DC 100%);">CSS3</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Custom Animations */
@keyframes float {
    0% { transform: translateY(0px); }
    50% { transform: translateY(-10px); }
    100% { transform: translateY(0px); }
}

@keyframes pulse {
    0% { transform: scale(1); }
    50% { transform: scale(1.05); }
    100% { transform: scale(1); }
}

@keyframes slideInRight {
    from { transform: translateX(20px); opacity: 0; }
    to { transform: translateX(0); opacity: 1; }
}

/* Global Hover Effects */
.profile-card-left {
    animation: float 6s ease-in-out infinite;
}

.feature-item:hover {
    transform: translateY(-5px);
    transition: transform 0.3s ease;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1) !important;
}

.social-button-right:hover {
    transform: translateX(5px);
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2) !important;
}

.tech-badge-sm:hover {
    transform: translateY(-3px) scale(1.05);
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2) !important;
}

/* Tech Badge Styling */
.tech-badge-sm {
    display: block;
    padding: 8px 12px;
    border-radius: 25px;
    color: white;
    font-weight: 600;
    font-size: 0.8rem;
    text-align: center;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
    animation: slideInRight 0.5s ease forwards;
    opacity: 0;
}

/* Social Button Styling */
.social-button-right {
    animation: slideInRight 0.5s ease forwards;
    opacity: 0;
}

.social-button-right:nth-child(1) { animation-delay: 0.1s; }
.social-button-right:nth-child(2) { animation-delay: 0.2s; }
.social-button-right:nth-child(3) { animation-delay: 0.3s; }

/* Feature Item Animation */
.feature-item {
    animation: slideInRight 0.5s ease forwards;
    opacity: 0;
}

.feature-item:nth-child(1) { animation-delay: 0.1s; }
.feature-item:nth-child(2) { animation-delay: 0.2s; }
.feature-item:nth-child(3) { animation-delay: 0.3s; }
.feature-item:nth-child(4) { animation-delay: 0.4s; }

/* Tech Badge Animation */
.tech-badge-sm {
    animation: slideInRight 0.5s ease forwards;
}

.tech-badge-sm:nth-child(1) { animation-delay: 0.1s; }
.tech-badge-sm:nth-child(2) { animation-delay: 0.15s; }
.tech-badge-sm:nth-child(3) { animation-delay: 0.2s; }
.tech-badge-sm:nth-child(4) { animation-delay: 0.25s; }
.tech-badge-sm:nth-child(5) { animation-delay: 0.3s; }
.tech-badge-sm:nth-child(6) { animation-delay: 0.35s; }
.tech-badge-sm:nth-child(7) { animation-delay: 0.4s; }
.tech-badge-sm:nth-child(8) { animation-delay: 0.45s; }

/* Responsive Design */
@media (max-width: 768px) {
    .profile-card-left {
        margin-bottom: 30px;
        animation: none;
    }

    .social-media-section, .tech-stack-section {
        margin-bottom: 20px;
    }

    .social-button-right {
        padding: 12px 15px !important;
    }

    .tech-badge-sm {
        padding: 6px 10px;
        font-size: 0.75rem;
    }
}

@media (max-width: 576px) {
    .card-body {
        padding: 20px !important;
    }

    .profile-card-left {
        padding: 20px !important;
    }

    .about-section, .social-media-section, .tech-stack-section {
        padding: 20px !important;
    }

    .photo-frame {
        width: 180px !important;
        height: 180px !important;
    }

    .photo-frame img {
        width: 160px !important;
        height: 160px !important;
    }

    .developer-header h2 {
        font-size: 1.5rem !important;
    }
}

/* Custom Scrollbar */
::-webkit-scrollbar {
    width: 8px;
}

::-webkit-scrollbar-track {
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    border-radius: 10px;
}

::-webkit-scrollbar-thumb {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-radius: 10px;
}

/* Smooth Transitions */
* {
    transition: background-color 0.3s ease, transform 0.3s ease, box-shadow 0.3s ease, opacity 0.3s ease;
}

/* Gradient Text */
.gradient-text {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 50%, #f093fb 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

/* Floating Animation */
.floating {
    animation: float 3s ease-in-out infinite;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Floating animation for profile card
    const profileCard = document.querySelector('.profile-card-left');
    let floating = true;

    function animateFloat() {
        if (floating) {
            profileCard.style.animation = 'float 6s ease-in-out infinite';
        }
    }

    animateFloat();

    // Hover effects for social buttons
    const socialButtons = document.querySelectorAll('.social-button-right');
    socialButtons.forEach((button, index) => {
        button.style.animationDelay = `${index * 0.1}s`;

        button.addEventListener('mouseenter', function() {
            this.style.transform = 'translateX(8px)';
            this.style.zIndex = '10';
        });

        button.addEventListener('mouseleave', function() {
            this.style.transform = 'translateX(0)';
            this.style.zIndex = '1';
        });
    });

    // Hover effects for feature items
    const featureItems = document.querySelectorAll('.feature-item');
    featureItems.forEach((item, index) => {
        item.style.animationDelay = `${index * 0.1}s`;

        item.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-5px)';
            this.style.boxShadow = '0 15px 30px rgba(0, 0, 0, 0.15)';
        });

        item.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
            this.style.boxShadow = '0 5px 15px rgba(0, 0, 0, 0.05)';
        });
    });

    // Hover effects for tech badges
    const techBadges = document.querySelectorAll('.tech-badge-sm');
    techBadges.forEach((badge, index) => {
        badge.style.animationDelay = `${index * 0.05}s`;

        badge.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-3px) scale(1.05)';
            this.style.boxShadow = '0 8px 20px rgba(0, 0, 0, 0.2)';
        });

        badge.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0) scale(1)';
            this.style.boxShadow = '0 4px 10px rgba(0, 0, 0, 0.1)';
        });
    });

    // Click animation for contact items
    const contactItems = document.querySelectorAll('.contact-item');
    contactItems.forEach(item => {
        item.addEventListener('click', function() {
            this.style.transform = 'scale(0.98)';
            setTimeout(() => {
                this.style.transform = 'scale(1)';
            }, 150);
        });
    });

    // Initialize tooltips for social media
    socialButtons.forEach(button => {
        button.setAttribute('title', 'Klik untuk membuka profil');
    });

    // Copy email to clipboard
    const emailElement = document.querySelector('.contact-item:first-child');
    if (emailElement) {
        emailElement.addEventListener('click', function() {
            const email = 'hasbi10juni@gmail.com';
            navigator.clipboard.writeText(email).then(() => {
                const originalText = this.querySelector('p:last-child').textContent;
                this.querySelector('p:last-child').textContent = 'Email disalin!';
                setTimeout(() => {
                    this.querySelector('p:last-child').textContent = originalText;
                }, 2000);
            });
        });
    }

    // Parallax effect on scroll
    let lastScroll = 0;
    window.addEventListener('scroll', function() {
        const scrolled = window.pageYOffset;

        if (Math.abs(scrolled - lastScroll) > 50) {
            profileCard.style.transform = `translateY(${scrolled * 0.02}px)`;
            lastScroll = scrolled;
        }
    });

    // Add click sound effect (optional)
    const clickSound = new Audio('https://assets.mixkit.co/sfx/preview/mixkit-select-click-1109.mp3');

    socialButtons.forEach(button => {
        button.addEventListener('click', function() {
            clickSound.currentTime = 0;
            clickSound.play().catch(() => {
                // Ignore if audio fails
            });
        });
    });
});

// Add confetti effect on page load
window.addEventListener('load', function() {
    setTimeout(() => {
        if (typeof confetti === 'function') {
            confetti({
                particleCount: 100,
                spread: 70,
                origin: { y: 0.6 }
            });
        }
    }, 1000);
});
</script>
@endsection
