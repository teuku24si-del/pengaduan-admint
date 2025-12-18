<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <!-- Header Logo Sidebar -->
    <div class="sidebar-header text-center">
        <a href="{{ route('dashboard') }}" class="sidebar-logo-link">
            <!-- Logo Utama di Sidebar -->
            <div class="sidebar-logo-container">
                <img src="{{ asset('assets/images/logo1.png') }}"
                     alt="Logo Desa Mamuju"
                     class="sidebar-logo-main"
                     onerror="this.onerror=null; this.src='{{ asset('assets/images/logo.svg') }}'">
            </div>
        </a>
    </div>

    <!-- Garis Pemisah -->
    <div class="sidebar-divider"></div>

    <ul class="nav">
        <!-- Menu items tetap sama -->
        <li class="nav-item">
            <a class="nav-link" href="{{ route('dashboard') }}">
                <span class="icon-bg"><i class="mdi mdi-chart-bar menu-icon"></i></span>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>

        <li class="nav-item nav-category">Fitur Utama</li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('kategori_pengaduan.index') }}">
                <span class="icon-bg"><i class="mdi mdi-contacts menu-icon"></i></span>
                <span class="menu-title">Kategori Pengaduan</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('Pengaduan.index') }}">
                <span class="icon-bg"><i class="mdi mdi-contacts menu-icon"></i></span>
                <span class="menu-title">Pengaduan</span>
            </a>
        </li>

        <li class="nav-item nav-category">Master Data</li>

        <li class="nav-item">
            <a class="nav-link active" href="{{ route('warga.index') }}">
                <span class="icon-bg"><i class="mdi mdi-cube menu-icon"></i></span>
                <span class="menu-title">Data warga</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('user.index') }}">
                <span class="icon-bg"><i class="mdi mdi-format-list-bulleted menu-icon"></i></span>
                <span class="menu-title">user</span>
            </a>
        </li>

        <li class="nav-item nav-category">About Developper</li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('profil.index') }}">
                <span class="icon-bg"><i class="mdi mdi-contacts menu-icon"></i></span>
                <span class="menu-title">Profil</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
                <span class="icon-bg"><i class="mdi mdi-lock menu-icon"></i></span>
                <span class="menu-title">User Pages</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="auth">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('Auth.index') }}">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('Auth.regis') }}">Register</a>
                    </li>
                </ul>
            </div>
        </li>

        <li class="nav-item sidebar-user-actions">
            <div class="sidebar-user-menu">
                <a href="{{ route('Auth.index') }}" class="nav-link">
                    <i class="mdi mdi-logout menu-icon"></i>
                    <span class="menu-title">Log Out</span>
                </a>
            </div>
        </li>
    </ul>
</nav>

<style>
/* HEADER SIDEBAR - DIUBAH UNTUK RUANG LEBIH BESAR */
.sidebar-header {
    padding: 25px 15px 15px 15px !important;
    min-height: 200px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: transparent;
    margin-bottom: 5px;
}

.sidebar-logo-link {
    text-decoration: none;
    display: block;
    transition: all 0.3s ease;
    width: 100%;
    height: 100%;
}

/* CONTAINER LOGO - DIPERBESAR */
.sidebar-logo-container {
    width: 200px !important; /* DIPERBESAR DARI 160px */
    height: 200px !important; /* DIPERBESAR DARI 160px */
    margin: 0 auto;
    padding: 0;
    background: transparent !important;
    border-radius: 0;
    box-shadow: none !important;
    border: none !important;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
    overflow: hidden;
}

/* LOGO UTAMA - DIPERBESAR MAXIMAL */
.sidebar-logo-main {
    width: 180px !important; /* DIPERBESAR DARI 140px */
    height: 180px !important; /* DIPERBESAR DARI 140px */
    max-width: 100% !important; /* MAKSIMAL 100% DARI CONTAINER */
    max-height: 100% !important;
    object-fit: contain !important;
    transition: all 0.3s ease;
    filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.1));
}

/* HOVER EFFECT */
.sidebar-logo-container:hover {
    transform: scale(1.05);
}

.sidebar-logo-container:hover .sidebar-logo-main {
    filter: drop-shadow(0 4px 8px rgba(0, 0, 0, 0.15));
    transform: scale(1.05);
}

/* GARIS PEMISAH */
.sidebar-divider {
    height: 1px;
    background: linear-gradient(90deg, transparent, rgba(102, 126, 234, 0.3), transparent);
    margin: 0 20px 20px 20px; /* DIUBAH MARGIN BOTTOM */
}

/* RESPONSIVE DESIGN */
@media (max-width: 991px) {
    .sidebar-logo-container {
        width: 160px !important;
        height: 160px !important;
    }

    .sidebar-logo-main {
        width: 140px !important;
        height: 140px !important;
    }

    .sidebar-header {
        min-height: 180px;
        padding: 20px 10px 10px 10px !important;
    }
}

@media (max-width: 768px) {
    .sidebar-logo-container {
        width: 140px !important;
        height: 140px !important;
    }

    .sidebar-logo-main {
        width: 120px !important;
        height: 120px !important;
    }

    .sidebar-header {
        min-height: 160px;
        padding: 15px 5px 5px 5px !important;
    }
}

/* VERSI SIDEBAR COLLAPSED */
.sidebar-mini .sidebar-logo-container {
    width: 80px !important;
    height: 80px !important;
}

.sidebar-mini .sidebar-logo-main {
    width: 70px !important;
    height: 70px !important;
}

/* SIDEBAR LEBAR */
#sidebar {
    width: 250px; /* Pastikan sidebar cukup lebar */
}

/* ANIMASI LOGO */
@keyframes logoPulse {
    0% { transform: scale(1); }
    50% { transform: scale(1.03); }
    100% { transform: scale(1); }
}

.sidebar-logo-container {
    animation: logoPulse 3s ease-in-out infinite;
}

/* HAPUS BACKGROUND PUTIH JIKA ADA */
.sidebar-logo-main {
    background: transparent !important;
    mix-blend-mode: multiply;
}

.sidebar-logo-container.transparent-bg {
    background-color: transparent !important;
    background-image: none !important;
}

.sidebar-logo-main.transparent {
    background-color: transparent !important;
}

.sidebar-logo-main.no-bg {
    mix-blend-mode: multiply;
}

.sidebar-logo-main.clean-logo {
    background: transparent !important;
    padding: 0 !important;
    margin: 0 !important;
}

/* CLEAN LAYOUT */
.sidebar-logo-container:hover {
    transform: scale(1.05);
}

.sidebar-logo-link:hover {
    transform: translateY(-2px);
}

.sidebar-app-name {
    margin-top: 15px;
}

.sidebar-app-name h5 {
    font-size: 1.1rem;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

/* DARK MODE SUPPORT */
[data-theme="dark"] .sidebar-header {
    background: linear-gradient(135deg, #2c2c2c 0%, #3c3c3c 100%);
}

[data-theme="dark"] .sidebar-app-name h5 {
    color: white;
    -webkit-text-fill-color: white;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Handle logo error
    const logoImage = document.querySelector('.sidebar-logo-main');
    if (logoImage) {
        logoImage.addEventListener('error', function() {
            console.log('Logo gagal dimuat, menggunakan fallback');
            const fallbackDiv = document.createElement('div');
            fallbackDiv.className = 'sidebar-logo-fallback';
            fallbackDiv.innerHTML = '<div>DESA<br>MAMUJU</div>';

            const logoContainer = this.closest('.sidebar-logo-container');
            if (logoContainer) {
                logoContainer.innerHTML = '';
                logoContainer.appendChild(fallbackDiv);
            }
        });

        // Optimasi tampilan logo
        setTimeout(() => {
            if (logoImage.complete) {
                optimizeLogoDisplay(logoImage);
            } else {
                logoImage.addEventListener('load', function() {
                    optimizeLogoDisplay(this);
                });
            }
        }, 100);
    }

    function optimizeLogoDisplay(imgElement) {
        // Tambahkan class untuk optimasi tampilan
        imgElement.classList.add('transparent', 'clean-logo');
        imgElement.parentElement.classList.add('transparent-bg');

        // Log ukuran untuk debugging
        const imgRect = imgElement.getBoundingClientRect();
        console.log('Logo dimensions:', imgRect.width, 'x', imgRect.height);

        // Jika logo masih kecil, coba perbesar
        if (imgRect.width < 150) {
            imgElement.style.width = '180px';
            imgElement.style.height = '180px';
        }
    }

    // Animasi hover untuk logo
    const logoContainer = document.querySelector('.sidebar-logo-container');
    const logoLink = document.querySelector('.sidebar-logo-link');

    if (logoContainer && logoLink) {
        logoLink.addEventListener('mouseenter', function() {
            logoContainer.style.transform = 'scale(1.05)';
        });

        logoLink.addEventListener('mouseleave', function() {
            logoContainer.style.transform = 'scale(1)';
        });

        logoLink.addEventListener('click', function(e) {
            logoContainer.style.transform = 'scale(0.95)';
            setTimeout(() => {
                logoContainer.style.transform = 'scale(1)';
            }, 150);
        });
    }

    // Responsive sidebar behavior - DIUPDATE
    function handleSidebarResize() {
        const sidebar = document.getElementById('sidebar');
        const logoContainer = document.querySelector('.sidebar-logo-container');
        const logoImage = document.querySelector('.sidebar-logo-main');

        if (sidebar && logoContainer && logoImage) {
            const sidebarWidth = sidebar.offsetWidth;

            if (window.innerWidth < 768) {
                // Mobile view
                logoContainer.style.width = '140px';
                logoContainer.style.height = '140px';
                logoImage.style.width = '120px';
                logoImage.style.height = '120px';
            } else if (window.innerWidth < 992) {
                // Tablet view
                logoContainer.style.width = '160px';
                logoContainer.style.height = '160px';
                logoImage.style.width = '140px';
                logoImage.style.height = '140px';
            } else {
                // Desktop view
                if (sidebar.classList.contains('sidebar-mini')) {
                    // Sidebar collapsed
                    logoContainer.style.width = '80px';
                    logoContainer.style.height = '80px';
                    logoImage.style.width = '70px';
                    logoImage.style.height = '70px';
                } else {
                    // Sidebar expanded - ukuran maksimal
                    logoContainer.style.width = '200px';
                    logoContainer.style.height = '200px';
                    logoImage.style.width = '180px';
                    logoImage.style.height = '180px';

                    // Jika sidebar cukup lebar, bisa lebih besar
                    if (sidebarWidth > 280) {
                        logoContainer.style.width = '220px';
                        logoContainer.style.height = '220px';
                        logoImage.style.width = '200px';
                        logoImage.style.height = '200px';
                    }
                }
            }
        }
    }

    // Initial call
    handleSidebarResize();

    // Listen for window resize
    window.addEventListener('resize', handleSidebarResize);

    // Listen for sidebar toggle
    document.addEventListener('sidebarToggle', handleSidebarResize);
});

// Function untuk mengganti logo secara dinamis
function changeSidebarLogo(newLogoPath) {
    const logoImage = document.querySelector('.sidebar-logo-main');
    if (logoImage) {
        logoImage.src = newLogoPath;
        console.log('Logo berhasil diubah ke:', newLogoPath);
    }
}
</script>
