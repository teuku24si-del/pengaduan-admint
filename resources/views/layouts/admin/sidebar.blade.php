 <nav class="sidebar sidebar-offcanvas" id="sidebar">
     <ul class="nav">


         <li class="nav-item">
             <a class="nav-link" href="{{ route('dashboard') }}">
                 <span class="icon-bg"><i class="mdi mdi-chart-bar menu-icon"></i></span>
                 <span class="menu-title">Dashboard</span>
             </a>
         </li>

         <li class="nav-item nav-category">Fitur Utama </li>

         <li class="nav-item">
             <a class="nav-link" href="{{ route('kategori_pengaduan.create') }}">
                 <span class="icon-bg"><i class="mdi mdi-contacts menu-icon"></i></span>
                 <span class="menu-title">Kategori Pengaduan</span>
             </a>
         </li>


         <li class="nav-item nav-category">Master Data </li>

         <li class="nav-item">
             <a class="nav-link active" href="{{ route('warga.create') }}">
                 <span class="icon-bg"><i class="mdi mdi-cube menu-icon"></i></span>
                 <span class="menu-title">Data warga</span>
             </a>
         </li>

         <li class="nav-item">
             <a class="nav-link" href="{{ route('user.create') }}">
                 <span class="icon-bg"><i class="mdi mdi-format-list-bulleted menu-icon"></i></span>
                 <span class="menu-title">user</span>
             </a>
         </li>

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

                     <li class="nav-item"> <a class="nav-link" href="{{ route('Auth.index') }}"> Login </a>
                     </li>
                     <li class="nav-item"> <a class="nav-link" href="{{ route('Auth.regis') }}">
                             Register </a></li>

                 </ul>
             </div>
         </li>
         <li class="nav-item sidebar-user-actions">
             <div class="sidebar-user-menu">
                 <a href="{{ route('Auth.index') }}" class="nav-link"><i class="mdi mdi-logout menu-icon"></i>
                     <span class="menu-title">Log Out</span></a>
             </div>
         </li>




     </ul>
 </nav>
