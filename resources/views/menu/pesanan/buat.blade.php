@extends('layouts.master')
@section('top-main')

@endsection
@section('main')
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="normal-table-list mg-t-30">
                        <div class="basic-tb-hd">
                            <div class="breadcomb-list">
						<div class="row">
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
								<div class="breadcomb-wp">
									<div class="breadcomb-icon">
                                    <a href="{{url('pesanan/create')}}"><i class="notika-icon notika-windows"></i></a>
									</div>
									<div class="breadcomb-ctn">
                                    <h2>Daftar  {{Str::ucfirst(Request::segment(1))}}</h2>
										<p>Menampilkan <span class="bread-ntd">data pesanan </span></p>
                                    </div>
								</div>
                            </div>
					</div>
                        </div>
                        <div class="bsc-tbl-hvr">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama</th>
                                        <th>Jumlah Pesanan</th>
                                        <th>Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pesanan as $pesan)
                                        
                                    <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$pesan->distributor->nama}}</td>
                                    <td>{{$pesan->jumlah}}</td>
                                    <td><a  class="btn btn-success" href="/pesanan/{{$pesan->id}}/1/form">Buat</a></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                </div>
@endsection