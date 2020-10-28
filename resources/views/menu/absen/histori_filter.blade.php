@extends('layouts.master')
@section('navbar')
    <a href="/belanja">
        <i class=" btn-circle fas fa-arrow-left"></i>Back    
    </a>
@endsection
@section('top-main')
 <nav class="mb-2">
                              <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                <a class="nav-item nav-link " href="/absen"  >Absen</a>
                                <a class="nav-item nav-link text-inf active "  >Riwayat Absen</a>
                                
                              </div>
                            </nav>
@endsection
@section('main')
<div class="row">
    <div class="col-xl-12 col-md-12 col-sm-12 col-xs-12">

    <div class="card">
        <div class="card-header bg-success text-white" >
            Histori Pembelanjaan
            <div class="float-right">
                <i class="fas fa-filter" style="cursor:pointer" onclick="hiden()"></i>
            </div>
        </div>
        <div class="card-body">
            <div class="row">

                
                <div class="col-xl-6 mb-3">
                    <input type="text" class="form-control" value="{{date('d F Y',strtotime($tanggal))}}" readonly>
                </div>
                <div class="col-xl-6 ">
                    <form action="" class="mb-3 input-group form-form "  method="POST">
                        @csrf
                        <select name="tanggal"class="form-control ">
                            @foreach ($absen as $t)
                        <option value="{{$t->tanggal}}">{{date('d F Y',strtotime($t->tanggal))}}</option>
                                @endforeach
                            </select>
                            <div class="input-group-append">
                                <button class="btn btn-primary">Filter</button>
                            </div>
                    </form>
                </div>
            </div>
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Status</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($hadir as $a)
                    <tr>
                    <th scope="row">{{$loop->iteration}}</th>
                    <th scope="row">{{$a->karyawan->nama}}</th>
                    <td>Hadir</td>
                    </tr>
                    @endforeach
                </tbody>
              </table>
        </div>
    </div>
    </div>

@endsection

@section('script')
    
<script>
    
    function hiden(){
document.querySelector('.form-form').classList.toggle('hidden')
    }
</script>
@endsection