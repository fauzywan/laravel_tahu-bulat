@extends('layouts.master')
@section('main')
<div class="row">
    <div class="col-xl-12">
        
        <div class="card">
            <form action="" method="POST">
            <div class="card-header bg-success text-white">
                <h4>Info Perusahaan</h4>
            </div>
            <div class="card-body">
                    <div class="row">
                        <div class="col-xl-6">
                            <div class="form-group">
                                <label for="nama">Nama Perusahaan</label>
                                <input type="text" class="form-control" name="nama" value="{{$profil->nama}}">
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="form-group">
                                <label for="pemilik">Pemilik</label>
                                <input type="text" class="form-control" name="pemilik" value="{{$profil->pemilik    }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-6">
                            <div class="form-group">
                                <label for="telepon">Nomor Telepon</label>
                                <input type="text" class="form-control" name="telepon" value="{{$profil->telepon}}">
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" class="form-control" name="email" value="{{$profil->email}}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="form-group">
                                <label for="moto">Moto</label>
                            <textarea name="moto" id="" cols="30" rows="2" class="form-control">{{$profil->moto}}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="form-group">
                                <label for="alamat">Alamat</label>
                                <textarea name="alamat" id="" cols="30" rows="2" class="form-control">{{$profil->alamat}}</textarea>
                            </div>
                        </div>
                    </div>
            </div>
            @csrf
            <div class="card-footer">
                    <div class="form-group ">
                        <button class="btn btn-primary float-right mb-3">Update</button>
                    </div>
            </div>
                </form>

        </div>
    </div>
</div>


@endsection