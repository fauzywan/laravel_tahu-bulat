@extends('layouts.master')
@section('navbar')
    <a href="/karyawan" class="text-decoration-none">
        <i class=" btn-circle fas fa-arrow-left"></i>Back    
    </a>
    @endsection
@section('top-main')
<h1 class="h3 mb-4   text-gray-800 ">Detail Karyawan</h1>
            <nav class="mb-2">
                              <div class="nav nav-tabs" id="nav-tab" role="tablist">
                              <a class="nav-item nav-link active">Profil</a>
                              <a class="nav-item nav-link " href="./meminjam"  >Meminjam</a>
                    
                            </nav>
@endsection
@section('main')

<div class="row"> 
  
    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 mb-4">
    <div class="card">
        <div class="card-header bg-gradient-primary text-white">Foto Profile</div>
        <div class="card-body text-center">
            @if ($karyawan->gambar=="")
            <img class="img-account-profile rounded-circle w-50 mb-3"  src="{{$karyawan->jenis_kelamin=='L'?asset('img/male.svg'):asset('img/female.svg')}}">
            @else
        <img class="img-account-profile rounded-circle w-50 mb-3" src="{{asset("/img/karyawan/".$gambar)}}">
            @endif
            <form action="/karyawan/{{$karyawan->id}}/image" method="POST" enctype="multipart/form-data">
                <input name="gambar" type="file" class="form-control mb-3" >
            @csrf
            @method('put')
<button type="submit" class="btn btn-primary">Update Foto Profile </button>
        </form>
                </div>
    </div>
        {{-- <div class="list-group card" style="width: 20rem;">
 
            <a href="#" class="list-group-item list-group-item-action active">
            </a>
            <div class="card-body">
            <form action="">
                
                
            </form>
            </div>
        </div>       --}}
    </div>

    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 ">
        <div class="list-group card" >
 
            <a href="#" class="list-group-item list-group-item-action active">
                Profile Karyawan
            </a>
            <form action="/karyawan/{{$karyawan->id}}/update" method="post"  class="card-body">
              @csrf
              @method('put')

              <div class="row">
                  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                      <div class="form-group">
                          <label for="nama"> Nama</label>
                          <input autocomplete="off" type="text" class="form-control" id="nama" name="nama" placeholder="nama" value=" {{$karyawan->nama}}">
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <label for="nama"> Posisi</label>                
                            <select name="posisi" id="" class="form-control">
                                @foreach ($posisi as $p)                                    
                                <option value="{{$p->id}}" {{$karyawan->posisi_id==$p->id?'Selected':''}}>{{$p->nama}}</option>
                                @endforeach
                            </select>    
                        </div> 
                    </div>   
                </div>
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <div class="form-group">
                            <label for="exampleInputPassword1">Jenis Kelamin</label>
                            <select name="jk" id="" class="form-control">
                                <option value="L" >L</option>
                                <option value="P" {{$karyawan->jenis_kelamin=='P'?'Selected':''}}>P</option>
                            </select>
                        </div>     
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                        <div class="form-group">
                            <label for="telepon"> telepon</label>
                            <input autocomplete="off" type="text" class="form-control" id="telepon" name="telepon"  placeholder="telepon" value=" {{$karyawan->telepon}}">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="alamat"> alamat</label>
                    <textarea  class="form-control" id="alamat" name="alamat"> {{$karyawan->alamat}}</textarea>
                </div>
                <label for="kerja"> kerja</label>
                <div class="form-group">
                    <input type="date" class="form-control" id="kerja" name="kerja"  value="{{$karyawan->created_at==null?'':date('Y-m-d',strtotime($karyawan->created_at))}}">
                </div>

                
                <a href="/karyawan/{{$karyawan->id}}/delete" class="card-link text-danger">Delete</a>
                <button class="card-link text-primary" style="border: none; background: transparent" > Update</button>
        </form>
        </div>      
    </div>


</div>






                @endsection









