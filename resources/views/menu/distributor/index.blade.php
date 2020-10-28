@extends('layouts.master')

@section('top-main')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-3  text-gray-800">Konsumen</h1>
</div>
<nav class="mb-2">
    <div class="nav nav-tabs" id="nav-tab" role="tablist">
        <a class="nav-item nav-link o " href="/karyawan"  >Karyawan</a>
        <a class="nav-item nav-link text-inf " href="/produksi"   >Biaya Produksi</a>
        <a class="nav-item nav-link text-inf " href="/suplier"   >Suplier</a>
        <a class="nav-item nav-link text-inf active">Konsumen</a>
         {{-- <a class="nav-item nav-link" id="nav-contact-tab" >Contact</a> --}}
       </div>
     </nav>
 <div class="row">
          <div class="col-xl-3 col-md-4 mb-4">
              <div class="card border-left-success   shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success  text-uppercase mb-1">Konsumen</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{$distributor->count()}}</div>
                    </div>
                    <img class="" style="width:98px; position:absolute; bottom: 1px;  right: 3px;"  src="{{asset('unDraw/undraw_wishlist_jk8a.svg')}}">
                                   

                  </div>
                </div>
              </div>
            </div>
       
      </div>
                @endsection
                @section('main')    
                     <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12">
                <div class="card shadow mb-4">
                    <div  class="card-header py-3 d-flex flex-row align-items-center justify-content-between bg-success"
                    >
                        <h6 class="m-0 font-weight-bold text-white">
                            Daftar Konsumen
                        </h6>
                    </div>

                    <div class="card-body">
                         <div class="dropdown no-arrow mb-3 " style="float:right; ">
                            <button
                                type="submit"
                                class="btn btn-success"
                                data-toggle="modal"
                                data-target="#Modal"
                            >
                                Tambah Konsumen
                            </button>
                        </div>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col">Alamat</th>
                                        <th scope="col">Nomor Telepon</th>
                                        <th scope="col">Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($distributor as $d)
                                    <tr>
                                           
                                       <td>{{  $loop->iteration }}</td>
                                       <td><a href="/distributor/{{$d->id}}/detail">{{$d->nama }}</a></td>
                                       <td>{{ $d->telepon==0?"-":$d->alamat }}</td>
                                       <td>{{ $d->telepon==0?"-":$d->telepon }}</td>
                                       <td>
                                           <a   class="btn btn-sm btn-danger"href="/distributor/{{$d->id}}/delete" onclick="return confirm('Yakin?')"
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

        </div> 

            </div>
        </div>
    </div> 
    <!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="Modal" tabindex="-1" role="dialog" aria-labelledby="ModalTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <form class="modal-content" action="distributor/store" method="POST">
        @csrf
      <div class="modal-header">
        <h5 class="modal-title" id="ModalTitle">Tambah Konsumen</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <div class="row">
<div class="col-6">
    <div class="form-group">
        <label for="Nama">Nama Pemesan/Perusahaan</label>
        <input type="text" class="form-control" id="Nama" name="nama"  placeholder="Nama Pemesan/Perusahaan">
    </div>
</div>
<div class="col-6">
    <div class="form-group">
        <label for="telepon">Nomor Telepon</label>
        <input type="text" class="form-control" id="telepon" name="telepon"  placeholder="Nomor Telepon">
    </div>
</div>

</div>
            <div class="row">
                <div class="col-12">
    <div class="form-group">
        <label for="Pemilik">Pemilik</label>
        <input type="text" class="form-control" id="Pemilik" name="pemilik"  placeholder="Isi Bila ada">
    </div>
</div>

</div>
<div class="row">
<div class="col-12">
    <div class="form-group">
        <label for="alamat">Alamat</label>
        <textarea class="form-control" id="alamat"  name="alamat"></textarea>
    </div>
</div>
</div>
    
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    <button type="submit" class="btn btn-success">Tambah</button>
</div>
</form>
  </div>
</div>  
    @endsection
            



            
                    