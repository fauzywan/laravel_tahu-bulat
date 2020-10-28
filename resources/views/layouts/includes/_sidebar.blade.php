 <ul class="navbar-nav bg-gradient-success sidebar sidebar-dark accordion" id="accordionSidebar" style="background-color: #06794f;
    background-image: linear-gradient(45deg,#0fa28b,#0fa28b);">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/">
        <div class="sidebar-brand-icon">
          <i class="fas fa-fw fa-store-alt pl-2" style="font-weight: 600;"></i>
        </div>
        <?php 
        
        ?>
        <div class="sidebar-brand-text mx-3" style="font-weight: 600;">{{App\infoPerusahaan::first()!=null?(App\infoPerusahaan::first('nama')->nama):''}}</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item  {{Request::segment(1)=='dashboard'?'active':''}}">
        <a class="nav-link"  href="/dashboard">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>

      <!-- Divider -->
      {{-- <hr class="sidebar-divider"> --}}

      <!-- Heading -->
      {{-- <div class="sidebar-heading">
        Interface
      </div> --}}

      <!-- Nav Item - Pages Collapse Menu -->
       <li class="nav-item ">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#tambah" aria-expanded="true" aria-controls="tambah">
          <i class="fas fa-fw fa-folder"></i>
          <span>Kelola Data</span>
        </a>
        <div id="tambah" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            {{-- <h6 class="collapse-header">Login Screens:</h6> --}}
            <a class="collapse-item" href="/karyawan">Karyawan</a>
            <a class="collapse-item" href="/produksi">Biaya Produksi</a>
            <a class="collapse-item" href="/distributor">Konsumen</a>
            <a class="collapse-item" href="/suplier">Suplier</a>
          </div>
        </div>
      </li>
      <li class="nav-item {{Request::segment(1)=='pesanan'?'active':''}}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-fw 
fas fa-shopping-basket"></i>
          <span>Pesanan</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            {{-- <h6 class="collapse-header"></h6> --}}
            <a class="collapse-item" href="/pesanan">Daftar Pesanan</a>
            <a class="collapse-item" href="/pesanan/bayar">Bayar Pesanan</a>
            <a class="collapse-item" href="/pesanan/create">Tambah Pesanan</a>
            <a class="collapse-item" href="/pesanan/laporan">Laporan Hari Ini</a>
          </div>
        </div>
      </li>

      <!-- Nav Item - Utilities Collapse Menu -->
      <li class="nav-item {{Request::segment(1)=='gudang' ||Request::segment(1)=='belanja'?'active':''}}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
          <i class="fas fa-fw fas fa-warehouse"></i>
          <span>Gudang & Belanja </span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            {{-- <h6 class="collapse-header">Custom Utilities:</h6> --}}
            <a class="collapse-item" href="/gudang">Gudang</a>
            <a class="collapse-item" href="/belanja">Belanja</a>
            <a class="collapse-item" href="/belanja/hutang">Hutang Belanja</a>
            <a class="collapse-item" href="/belanja/histori">Histori Pembelanjaan</a>
          </div>
        </div>
      </li>
      <li class="nav-item ">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#karyawanCollapse" aria-expanded="true" aria-controls="karyawanCollapse">
          <i class="fas fa-fw fas fa-users"></i>
          <span>Karyawan</span>
        </a>
        <div id="karyawanCollapse" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            {{-- <h6 class="collapse-header">Custom Utilities:</h6> --}}
        <a class="collapse-item" href="/peminjaman"><span>Peminjaman</span></a>
        <a class="collapse-item" href="/absen"><span>Absensi</span></a>
        <a class="collapse-item" href="/penggajian"><span>Penggajian</span></a>
        <a class="collapse-item" href="/penggajian/potongan"><span>Potongan Gaji</span></a>
          </div>
        </div>
      </li>
  
      

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        {{-- Addons --}}
      </div>

      <!-- Nav Item - Pages Collapse Menu -->
      {{-- <li class="nav-item ">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
          <i class="fas fa-fw fa-folder"></i>
          <span>Pages</span>
        </a>
        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Login Screens:</h6>
            <a class="collapse-item" href="login.html">Login</a>
            <a class="collapse-item" href="register.html">Register</a>
            <a class="collapse-item" href="forgot-password.html">Forgot Password</a>
            <div class="collapse-divider"></div>
            <h6 class="collapse-header">Other Pages:</h6>
            <a class="collapse-item" href="404.html">404 Page</a>
            <a class="collapse-item" href="blank.html">Blank Page</a>
          </div>
        </div>
      </li> --}}

      <!-- Nav Item - Charts -->

      <li class="nav-item ">
        <a class="nav-link" href="/laporan">
          <i class="fas fa-fw fa-chart-area"></i>
          <span>Laporan</span></a>
      </li>

      <!-- Nav Item - Tables -->

           <li class="nav-item ">
        <a class="nav-link" href="/pengaturan">
          <i class="fas fa-fw fa-cog"></i>
          <span>Pengaturan</span></a>
      </li>
           <li class="nav-item ">
        <a class="nav-link" href="/pengaturan/profil">
          <i class="fas fa-fw fa-cog"></i>
          <span>Profile</span></a>
      </li>


      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">
                 <li class="nav-item ">
        <a class="nav-link" href="/logout">
          <i class="fas fa-fw fa-sign-out-alt"></i>
          <span>Logout</span></a>
      </li>

 
      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>