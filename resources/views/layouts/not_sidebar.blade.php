<html lang="en">
    <head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>@yield('title,Putra Shongka')</title>

  <!-- Custom fonts for this template-->
  <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  
  <!-- Custom styles for this template-->
  <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
  
  <link rel="stylesheet" href="{{ asset('css/toastr.min.css') }}">
</head>

<body id="page-top" class="sidebar-toggled">

  <!-- Page Wrapper -->
  <div id="wrapper">
    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-success sidebar sidebar-dark accordion toggled" id="accordionSidebar" style="background-color: #06794f;
    background-image: linear-gradient(45deg,#0fa28b,#0fa28b);">


      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/">
        <div class="sidebar-brand-icon">
          <i class="fas fa-fw fa-store-alt pl-2" style="font-weight: 600;"></i>
        </div>
        <?php 
        
        ?>
        <div class="sidebar-brand-text mx-3" style="font-weight: 600;">{{App\infoPerusahaan::first('nama')==null?'':(App\infoPerusahaan::first('nama')->nama)}}</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item {{Request::segment(1)=='dashboard'?'active':''}}">
        <a class="nav-link" href="/dashboard">
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

    </ul>    <!-- End of Sidebar -->
    

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">
      

      <!-- Main Content -->
      <div id="content">
          <div class="container-fluid">
            @yield('top-main')
            @yield('main')
        </div>
        <!-- /.con
      </div>
      <!-- End of Main Content -->
      

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
          <span>Copyright ©  <a href="/">Putra Shongka</a> 2020</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="login.html">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="{{ asset('vendor/jquery/jquery.min.js')}}"></script>
  <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

  <!-- Core plugin JavaScript-->
  <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js')}}"></script>

  <!-- Custom scripts for all pages-->
  <script src="{{asset('js/sb-admin-2.min.js')}}"></script>
     <script src="{{ asset('js/toastr.min.js') }}"></script>
        {!! Toastr::message() !!}
        @yield('script')
        
  <!-- Page level plugins -->

  <!-- Page level custom scripts -->

</body>

</html>
