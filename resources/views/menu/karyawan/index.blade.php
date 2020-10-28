@extends('layouts.master')
@section('main')

<div class="container">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">

    <h1 class="h3 mb-3  text-gray-800">Karyawan</h1>

            <!-- <a
                href="#"
                class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"
                ><i class="fas fa-download fa-sm text-white-50"></i> Generate
                Report</a -->
                {{-- > --}}
            </div>
                               <nav class="mb-2">
                              <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                <a class="nav-item nav-link o active" href="/karyawan"  >Karyawan</a>
                                <a class="nav-item nav-link text-inf " href="/produksi"   >Biaya Produksi</a>
                                <a class="nav-item nav-link text-inf " href="/suplier"   >Suplier</a>
                                <a class="nav-item nav-link text-inf " href="/distributor"   >Konsumen</a>
                                {{-- <a class="nav-item nav-link" id="nav-contact-tab" >Contact</a> --}}
                              </div>
                            </nav>
        <div class="row">
              <div class="col-xl-4 col-md-4 mb-4">
             <a href="/absen" style="text-decoration:none;">
                  <div class="card border-left-primary   shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary  text-uppercase mb-1">Tanggal</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{date('d F Y')}} </div>
                    </div>
                    <img class="" style="width:110px; position:absolute; bottom: 4px;  right: 1px;cursor: pointer"  src="{{asset('unDraw/undraw_Domain_names_re_0uun.svg')}}">               

                  </div>
                </div>
              </div>
                 </a>

            </div>
              <div class="col-xl-4 col-md-4 mb-4">
              <div class="card border-left-warning   shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-warning  text-uppercase mb-1">Jumlah Karyawan</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{$jumlah}} Orang</div>
                    </div>
                    <img class="" style="width:95px; position:absolute; bottom: 4px;  right: 10px;"  src="{{asset('unDraw/Team.svg')}}">               

                  </div>
                </div>
              </div>
            </div>
            {{-- <div class="col-xl-4 col-md-4"></div> --}}
              <div class="col-xl-4 col-md-4 mb-4">
              <div class="card border-left-info   shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-info  text-uppercase mb-1">Hadir</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{$hadir}} Orang</div>
                    </div>
                    <img class="" style="width:140px; position:absolute; bottom: 4px;  right: 10px;"  src="{{asset('unDraw/undraw_online_organizer_ofxm.svg')}}">               

                  </div>
                </div>
              </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-8 col-lg-7">
                <div class="card shadow mb-4">
                    <div  class="card-header py-3 d-flex bg-success flex-row align-items-center justify-content-between"
                    >
                        <h6 class="m-0 font-weight-bold text-white">
                            Daftar Karyawan
                        </h6>
                       
                    </div>

                    <div class="card-body">
                        
                        <div class="table-responsive">
                         <div class="dropdown no-arrow mb-3" style="float: right">
                            <button
                            style="background-color: #06794f;
    background-image: linear-gradient(45deg,#0fa28b,#0fa28b);"
                                type="submit"
                                class="btn btn-success"
                                data-toggle="modal"
                                data-target="#exampleModal"
                            >
                                Tambah Karyawan
                        </button>
                        </div>    <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col">posisi</th>
                                        <th scope="col">Opsi</th>
                                     </tr>
                                </thead>
                                <tbody>
                                    @foreach ($karyawan as $k)
                                    <tr>
                                           
                                         <th scope="row">{{isset($_GET['page']) &&$_GET['page']>1 ?$loop->iteration+(5* $_GET['page'])-5:$loop->iteration}}</th>
                                       <td><a href="/karyawan/{{$k->id}}/detail">{{$k->nama }}</a></td>
                                       <td>{{ $k->posisi!=null?$k->posisi->nama:''}}</td>
                                       <td>
                                           <a   class="btn btn-sm btn-danger"href="/karyawan/{{$k->id}}/delete" onclick="return confirm('Yakin?')"
                                           ><i class="fas fa-trash"></i
                                            ></a>
                                        </td>
                                    </tr>
                                    @endforeach
                              
                                </tbody>
                            </table>
                            <td class="">{{ $karyawan->links() }} </td>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-lg-5">
                <div class="card shadow mb-4">
                    <div
                        class="card-header py-3 d-flex flex-row  bg-success align-items-center justify-content-between"
                    >
                        <h6 class="m-0 font-weight-bold text-white">
                           Daftar Posisi
                        </h6>
                    </div>
                    <div class="card-body">
                        <form
                        action="/posisi/store" method="POST"
                            class="input-group mb-3"
                        >
                        @csrf
                            <input
                            autocomplete="off"   
                            type="text"
                                class="form-control"
                                placeholder="Posisi"
                                name="nama"

                            />
                            <div class="input-group-append">
                                <button
                                    class="btn btn-sm btn-success"
                                    style="background-color: #06794f;
    background-image: linear-gradient(45deg,#0fa28b,#0fa28b);"
                                >
                                    Tambah
                                </button>
                            </div>
                        </form>
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">Posisi</th>
                                    <th scope="col">Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($posisi as $p)
                                    
                                <tr>
                                    <td>
                                        {{ $p->nama }}
                                    </td>
                                    <td>

                                        <a class="btn btn-sm btn-danger" href="/posisi/{{$p->id}}/delete"onclick="return confirm('yakin')"
                                            ><i class="fas fa-trash"></i
                                                ></a>
                                            </td>
                                            </tr>
                                    @endforeach
                                </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- Button trigger modal -->

        <!-- Modal -->
        <div
            class="modal fade"
            id="exampleModal"
            tabindex="-1"
            role="dialog"
            aria-labelledby="exampleModalLabel"
            aria-hidden="true"
        >
            <div class="modal-dialog" role="document">
                <form
                    class="modal-content"
                    action="/karyawan/store"
                    method="POST"
                >
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">
                            Tambah Data
                        </h5>
                        <button
                            type="button"
                            class="close"
                            data-dismiss="modal"
                            aria-label="Close"
                        >
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input
                            autocomplete="off"   
                            type="text"
                                class="form-control"
                                id="nama"
                                name="nama"
                                placeholder="Masukan Nama"
                            />
                            </div>
                        </div>
                        <div class="col-md-6">
                        <div class="form-group">
                            <label for="nama">Jenis Kelamin</label>
                            <select
                                class="form-control"
                                id="nama"
                                name="jk"
                            >
                                <option value="L">L</option>
                                <option value="P">P</option>
                            </select>
                        </div>
                        </div>
                        </div>

@csrf
<div class="row">
    <div class="col-6">
        <div class="form-group">
            <label for="posisi">Posisi</label>
            <select class="form-control" name="posisi" id="posisi">
                            @foreach ($posisi as $p)
                        <option value="{{$p->id}}">
                                {{ $p->nama }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-6">
                     <div class="form-group">
                            <label for="kerja">Mulai kerja</label>
                            <input
                                type="date"
                                class="form-control"
                                id="kerja"
                                name="kerja"
                            />
                        </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                     <div class="form-group">
                            <label for="telepon">No telepon</label>
                            <input
                            autocomplete="off"   
                            type="text"
                                class="form-control"
                                id="telepon"
                                maxlength="15"
                                name="telepon"
                                placeholder="Nomor telepon"
                            />
                        </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
    <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <textarea
                            autocomplete="off"   
                            type="text"
                                class="form-control"
                                id="alamat"
                                name="alamat"
                            ></textarea
                            >
                        </div>
                </div>
            </div>       
                    </div>
                    <div class="modal-footer">
                        <button
                            type="button"
                            class="btn btn-secondary"
                            data-dismiss="modal"
                        >
                            Close
                        </button>
                        <button
                        
                            type="submit"
                            class="btn btn-success "
                        >
                            Save
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
 
@endsection