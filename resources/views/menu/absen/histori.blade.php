@extends('layouts.master')
@section('navbar')
    <a href="./">
        <i class=" btn-circle fas fa-arrow-left"></i>Back    
    </a>
@endsection
@section('top-main')
 <nav class="mb-2">
                              <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                <a class="nav-item nav-link " href="/absen">Absen</a>
                                <a class="nav-item nav-link text-inf active">Riwayat Absen</a>
                                
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
                    <input type="text" class="form-control" value="{{date('d F Y',strtotime($absen[0]->tanggal))}}" readonly>
                </div>
                <div class="col-xl-6 ">
                    <form action="" class="mb-3 input-group form-form hidden"  method="POST">
                        @csrf
                        <select name="tanggal"class="form-control ">
                            @foreach ($tanggal as $t)
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
                    @foreach ($absen[0]->get() as $a)
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
{{-- @section('main')
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="card-header bg-success text-white" >
                Histori Pembelanjaan
            </div>
            <div class="card-body">
                @foreach ($absen as $a)       
                <p style="border-bottom: 1px solid rgb(230, 229, 229)">
                    <a class="-info" data-toggle="collapse"  href="#collapse{{$a->id}}" role="button" aria-expanded="false" aria-controls="collapse{{$a->id}}">
                      {{date('d F Y',strtotime($a->tanggal))}}
                        <i class="fas fa-plus float-right"></i>
                    </a>
                  </p>
                  <div class="collapse" id="collapse{{$a->id}}">
                        <div class="card card-body row table-responsive">

                        <div class="col-xl-12 col-md-12 col-xs-12">
                        <table class="table  table-bordered">
                            <thead>
                                <tr>   
                                     <td>Nama</td>
                                     <td>Waktu</td>
                      
                                </thead>
                            </tr>
                            
                            <tbody>
                                
                                @foreach ($a->where('tanggal',date('Y-m-d',strtotime($a->tanggal)))->get() as $karyawan)
                                <tr>   
                                    <td>{{$karyawan->karyawan->nama}}</td> 
                                    <td>{{$karyawan->created_at}}</td>
                                </tr>
                                @endforeach
                            <tr>
                                <td colspan="1"><a class="float-right">Jumlah</a></td>
                                <td>
                                    {{$a->where('tanggal',date('Y-m-d',strtotime($a->tanggal)))->count()}}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        </div>
                        </div>

                  </div>
                  @endforeach
            </div>
        </div>
    </div>
</div>

@endsection --}}
@section('script')
    
<script>
    
    function hiden(){
document.querySelector('.form-form').classList.toggle('hidden')
    }
</script>
@endsection