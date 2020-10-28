    <div class="main-menu-area" style="margin: 20px 0 40px 0">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" >
                    <ul class="nav nav-tabs notika-menu-wrap menu-it-icon-pro" style="background: whitesmoke">
                        <li class="{{Request::segment(1)==""?'active':''}}"><a href="/"><i class="notika-icon notika-house"></i> Home</a>
                        </li>
                        <li class="{{Request::segment(1)=='tambah'||Request::segment(1)=='produksi'?'aktif':''}}"><a data-toggle="tab" href="#tambah"><i class="notika-icon notika-plus-symbol"></i> Tambah Data</a>
                        </li>
                        <li class="{{Request::segment(1)=="gudang"||Request::segment(1)=="pengeluaran"?'aktif':''}}">
                            <a data-toggle="tab" href="#pengeluaran"><i class="notika-icon notika-form ">
                                </i> Persediaan</a>
                        </li>
                    
                        <li><a data-toggle="tab" href="#pesanan"><i class="notika-icon notika-finance"></i> Pesanana</a>
                        </li>
                        <li><a  href="/gaji"><i class="notika-icon notika-dollar"></i> Gaji</a>
                        </li>
                        <li><a  href="/pengaturan"><i class="notika-icon notika-settings"></i> Pengaturan</a>
                        </li>
                        {{-- <li><a data-toggle="tab" href="#Appviews"><i class="notika-icon notika-app"></i> App views</a>
                        </li>
                        <li><a data-toggle="tab" href="#Page"><i class="notika-icon notika-support"></i> Pages</a>
                        </li> --}}
                    </ul>
   
                    <div class="tab-content custom-menu-content">
                        <div id="tambah" class="tab-pane notika-tab-menu-bg animated flipInX">
                            <ul class="notika-main-menu-dropdown">
                                <li><a href="{{ url('karyawan') }}">Kayrawan</a>
                                </li>
                                <li><a href="{{ url('produksi')}}">Biaya Produksi</a>
                                </li>
                                <li><a href="{{url('suplier')}}">Suplier </a>
                                <li><a href="{{url('distributor')}}">Distributor</a>
                                </li>
                            </ul>
                        </div>
                             <div id="pengeluaran" class="tab-pane notika-tab-menu-bg animated flipInX">
                            <ul class="notika-main-menu-dropdown">
                                <li><a href="{{ url('gudang') }}">Gudang</a>
                                </li>
                                <li><a href="{{ url('belanja')}}">Belanja</a>
                                </li>
                                <li><a href="{{ url('belanja/histori')}}">Riwayat Pembelanjaan</a>
                                </li>
                                {{-- <li><a href="{{url('tanggal/atur')}}">Atur tanggal</a> --}}
                                </li>
                            </ul>
                        </div>
                             <div id="pesanan" class="tab-pane notika-tab-menu-bg animated flipInX">
                            <ul class="notika-main-menu-dropdown">
                                <li><a href="{{ url('pesanan') }}">Daftar pesanan</a>
                                </li>
                                <li><a href="{{ url('pesanan/bayar')}}">Bayar Pesanan</a>
                                </li>
                                {{-- <li><a href="{{url('pesanan/transaksi')}}">Transaksi Pesanan</a> --}}
                                </li>
                                <li><a href="{{url('pesanan/create')}}">Buat Pesanan</a>
                                </li>
                                </li>
                            </ul>
                        </div>
                    </div>
                   
                </div>
            </div>
        </div>
    </div>
