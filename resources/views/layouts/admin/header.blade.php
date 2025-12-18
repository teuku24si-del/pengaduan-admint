<nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
    <div class="navbar-menu-wrapper d-flex align-items-stretch w-100">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="mdi mdi-menu"></span>
        </button>

        <!-- Search Field dipindahkan ke kiri -->
        <div class="search-field d-none d-xl-block ms-3" style="flex-grow: 1; max-width: 500px;">
            <form class="d-flex align-items-center h-100" action="#">
                <div class="input-group">
                    <div class="input-group-prepend bg-transparent">
                        <i class="input-group-text border-0 mdi mdi-magnify"></i>
                    </div>
                    <input type="text" class="form-control bg-transparent border-0"
                        placeholder="cari data warga">
                </div>
            </form>
        </div>

        <ul class="navbar-nav navbar-nav-right">
            <li class="nav-item nav-profile dropdown">
                <a class="nav-link dropdown-toggle" id="profileDropdown" href="#"
                    data-toggle="dropdown" aria-expanded="false">
                    <div class="nav-profile-img">
                        <!-- Ganti dengan inisial nama -->
                        <div class="avatar-sm me-2">
                            <div class="avatar-title bg-primary rounded-circle text-white">
                                @if(Auth::check())
                                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="nav-profile-text">
                        <p class="mb-1 text-black">hai, {{ Auth::user()->name }}</p>
                    </div>
                </a>
                <div class="dropdown-menu navbar-dropdown dropdown-menu-right p-0 border-0 font-size-sm"
                    aria-labelledby="profileDropdown" data-x-placement="bottom-end">
                    <div class="p-3 text-center bg-primary">
                        <!-- Ganti dengan inisial nama yang lebih besar -->
                        <div class="avatar-lg mx-auto mb-3">
                            <div class="avatar-title bg-light rounded-circle text-primary"
                                style="width: 80px; height: 80px; font-size: 2rem; display: flex; align-items: center; justify-content: center;">
                                @if(Auth::check())
                                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="p-2">
                        <h5 class="dropdown-header text-uppercase pl-2 text-dark">User Options</h5>
                        <a class="dropdown-item py-1 d-flex align-items-center justify-content-between"
                            href="#">
                            <span>Inbox</span>
                            <span class="p-0">
                                <span class="badge badge-primary">3</span>
                                <i class="mdi mdi-email-open-outline ml-1"></i>
                            </span>
                        </a>
                        <a class="dropdown-item py-1 d-flex align-items-center justify-content-between"
                            href="#">
                            <span>Profile</span>
                            <span class="p-0">
                                <span class="badge badge-success">1</span>
                                <i class="mdi mdi-account-outline ml-1"></i>
                            </span>
                        </a>
                        <a class="dropdown-item py-1 d-flex align-items-center justify-content-between"
                            href="javascript:void(0)">
                            <span>Settings</span>
                            <i class="mdi mdi-settings"></i>
                        </a>
                        <div role="separator" class="dropdown-divider"></div>
                        <h5 class="dropdown-header text-uppercase  pl-2 text-dark mt-2">Actions</h5>
                        <a class="dropdown-item py-1 d-flex align-items-center justify-content-between"
                            href="#">
                            <span>Lock Account</span>
                            <i class="mdi mdi-lock ml-1"></i>
                        </a>
                        <a class="dropdown-item py-1 d-flex align-items-center justify-content-between"
                            href="#">
                            <span>Log Out</span>
                            <i class="mdi mdi-logout ml-1"></i>
                        </a>
                    </div>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link count-indicator dropdown-toggle" id="messageDropdown" href="#"
                    data-toggle="dropdown" aria-expanded="false">
                    <i class="mdi mdi-email-outline"></i>
                    <span class="count-symbol bg-success"></span>
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list"
                    aria-labelledby="messageDropdown">
                    <h6 class="p-3 mb-0 bg-primary text-white py-4">Messages</h6>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item preview-item">
                        <div class="preview-thumbnail">
                            <img src="assets/images/faces/face4.jpg" alt="image" class="profile-pic">
                        </div>
                        <div
                            class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                            <h6 class="preview-subject ellipsis mb-1 font-weight-normal">Mark send you a
                                message</h6>
                            <p class="text-gray mb-0"> 1 Minutes ago </p>
                        </div>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item preview-item">
                        <div class="preview-thumbnail">
                            <img src="assets/images/faces/face2.jpg" alt="image" class="profile-pic">
                        </div>
                        <div
                            class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                            <h6 class="preview-subject ellipsis mb-1 font-weight-normal">Cregh send you a
                                message</h6>
                            <p class="text-gray mb-0"> 15 Minutes ago </p>
                        </div>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item preview-item">
                        <div class="preview-thumbnail">
                            <img src="assets/images/faces/face3.jpg" alt="image" class="profile-pic">
                        </div>
                        <div
                            class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                            <h6 class="preview-subject ellipsis mb-1 font-weight-normal">Profile picture
                                updated</h6>
                            <p class="text-gray mb-0"> 18 Minutes ago </p>
                        </div>
                    </a>
                    <div class="dropdown-divider"></div>
                    <h6 class="p-3 mb-0 text-center">4 new messages</h6>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#"
                    data-toggle="dropdown">
                    <i class="mdi mdi-bell-outline"></i>
                    <span class="count-symbol bg-danger"></span>
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list"
                    aria-labelledby="notificationDropdown">
                    <h6 class="p-3 mb-0 bg-primary text-white py-4">Notifications</h6>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item preview-item">
                        <div class="preview-thumbnail">
                            <div class="preview-icon bg-success">
                                <i class="mdi mdi-calendar"></i>
                            </div>
                        </div>
                        <div
                            class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                            <h6 class="preview-subject font-weight-normal mb-1">Event today</h6>
                            <p class="text-gray ellipsis mb-0"> Just a reminder that you have an event today
                            </p>
                        </div>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item preview-item">
                        <div class="preview-thumbnail">
                            <div class="preview-icon bg-warning">
                                <i class="mdi mdi-settings"></i>
                            </div>
                        </div>
                        <div
                            class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                            <h6 class="preview-subject font-weight-normal mb-1">Settings</h6>
                            <p class="text-gray ellipsis mb-0"> Update dashboard </p>
                        </div>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item preview-item">
                        <div class="preview-thumbnail">
                            <div class="preview-icon bg-info">
                                <i class="mdi mdi-link-variant"></i>
                            </div>
                        </div>
                        <div
                            class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                            <h6 class="preview-subject font-weight-normal mb-1">Launch Admin</h6>
                            <p class="text-gray ellipsis mb-0"> New admin wow! </p>
                        </div>
                    </a>
                    <div class="dropdown-divider"></div>
                    <h6 class="p-3 mb-0 text-center">See all notifications</h6>
                </div>
            </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
            data-toggle="offcanvas">
            <span class="mdi mdi-menu"></span>
        </button>
    </div>
</nav>

<style>
/* HEADER BACKGROUND PUTIH */
.default-layout-navbar {
    background: #ffffff !important;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
    border-bottom: 1px solid #eaeaea;
}

/* SEARCH FIELD STYLING - DIPINDAHKAN KE KIRI */
.search-field {
    margin-left: 1rem;
}

.search-field .input-group {
    background: #f8f9fa;
    border-radius: 6px;
    border: 1px solid #e0e0e0;
    transition: all 0.3s ease;
}

.search-field .input-group:hover {
    background: #f0f2f5;
    border-color: #667eea;
}

.search-field .input-group:focus-within {
    background: #ffffff;
    border-color: #667eea;
    box-shadow: 0 0 0 2px rgba(102, 126, 234, 0.15);
}

.search-field .input-group-prepend {
    padding-left: 15px;
}

.search-field .input-group-text {
    background: transparent;
    border: none;
    color: #667eea;
}

.search-field .form-control {
    border: none;
    color: #333333;
    padding: 10px 15px;
}

.search-field .form-control::placeholder {
    color: #888888;
}

.search-field .form-control:focus {
    box-shadow: none;
    background: transparent;
}

/* NAVBAR TOGGLER */
.navbar-toggler {
    border: none;
    color: #333333;
    margin-left: 1rem;
}

.navbar-toggler .mdi-menu {
    font-size: 1.5rem;
}

/* NAVBAR MENU WRAPPER - LAYOUT BARU */
.navbar-menu-wrapper {
    display: flex;
    align-items: center;
    justify-content: space-between;
}

/* NAVBAR RIGHT ITEMS */
.navbar-nav-right {
    display: flex;
    align-items: center;
    margin-right: 1rem;
}

/* ICONS STYLING - WARNA GELAP */
.nav-link.count-indicator {
    position: relative;
    margin-right: 25px;
    color: #555555 !important;
    transition: all 0.3s ease;
}

.nav-link.count-indicator:hover {
    color: #667eea !important;
}

.nav-link.count-indicator i {
    font-size: 1.4rem;
}

.count-symbol {
    position: absolute;
    top: -5px;
    right: -5px;
    width: 8px;
    height: 8px;
    border-radius: 50%;
    border: 2px solid #ffffff;
}

/* USER PROFILE - STYLING PUTIH */
.nav-profile.dropdown .nav-link {
    display: flex;
    align-items: center;
    padding: 8px 15px;
    border-radius: 8px;
    transition: all 0.3s ease;
    background: #f8f9fa;
    border: 1px solid #eaeaea;
}

.nav-profile.dropdown .nav-link:hover {
    background: #667eea;
    border-color: #667eea;
}

.nav-profile.dropdown .nav-link:hover .nav-profile-text p {
    color: #ffffff !important;
}

.nav-profile-img .avatar-sm {
    display: flex;
    align-items: center;
}

.nav-profile-img .avatar-title {
    width: 35px;
    height: 35px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 600;
    font-size: 1rem;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}

.nav-profile-text p {
    color: #333333 !important;
    font-weight: 500;
    margin: 0;
    font-size: 0.9rem;
    transition: color 0.3s ease;
}

/* DROPDOWN MENUS - PUTIH */
.dropdown-menu {
    border: 1px solid #eaeaea;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    background: #ffffff;
}

/* BODY PADDING UNTUK HEADER FIXED */
body {
    padding-top: 70px;
}

/* WARNA TEKS UNTUK BACKGROUND PUTIH */
.text-black {
    color: #333333 !important;
}

.text-gray {
    color: #666666 !important;
}

.text-dark {
    color: #333333 !important;
}

/* PREVIEW ITEM STYLING */
.preview-item {
    color: #333333;
}

.preview-subject {
    color: #333333;
}

/* RESPONSIVE DESIGN */
@media (max-width: 768px) {
    .nav-link.count-indicator {
        margin-right: 15px;
    }

    .nav-profile.dropdown .nav-link {
        padding: 6px 12px;
    }

    .search-field {
        margin-left: 0.5rem;
        max-width: 300px !important;
    }
}

@media (max-width: 1200px) {
    .search-field {
        max-width: 400px !important;
    }
}
</style>

<script>
// Script minimal untuk styling
document.addEventListener('DOMContentLoaded', function() {
    // Search focus effect
    const searchInput = document.querySelector('.search-field .form-control');
    if (searchInput) {
        searchInput.addEventListener('focus', function() {
            this.closest('.input-group').style.boxShadow = '0 0 0 2px rgba(102, 126, 234, 0.2)';
            this.closest('.input-group').style.borderColor = '#667eea';
        });

        searchInput.addEventListener('blur', function() {
            this.closest('.input-group').style.boxShadow = 'none';
            this.closest('.input-group').style.borderColor = '#e0e0e0';
        });
    }
});
</script>
