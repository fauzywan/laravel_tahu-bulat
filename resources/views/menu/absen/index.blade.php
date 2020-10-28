@extends('layouts.master')
@section('navbar')
    <a href="/karyawan" style="text-decoration: none">
        <i class=" btn-circle fas fa-arrow-left"></i>Back    
    </a>
@endsection
@section('main')
            <nav class="mb-2">
                              <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                <a class="nav-item nav-link o active" href="/karyawan"  >Absen</a>
                                <a class="nav-item nav-link text-inf " href="/absen/histori"   >Riwayat Absen</a>
                                
                              </div>
                            </nav>
    <div class="row">
      <div class="col-xl-6 cl-md-6 col-sm-12 col-xs-12">
            <div class="card">
                <div class="card-header text-white bg-success">
                    Belum Hadir
                </div>
                <div class="card-body">
                  <div  class="table-responsive">
                    <table class="table ">
                      <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">Karyawan</th>
                          <th scope="col">Hadir</th>
                          {{-- <th scope="col">Izin</th>
                          <th scope="col">Alpa</th> --}}
                          <th scope="col" class="text-center">Absen</th>
                        </tr>
                      </thead>
                      <tbody>
                        @if(count($belum_hadir)>0)
                        <form action="" method="POST" class="form-submit">

                        @csrf
                          <input type="date" class="form-control" readonly name="tanggal" value="{{date('Y-m-d')}}">
                            
                          @foreach ($belum_hadir as $karyawan)
                              
                          <tr>
                          <th scope="row">{{$loop->iteration}}</th>
                          <td>
                          <select type="text"  class="form-control selek" value="{{$karyawan->id}}">
                            <option value="{{$karyawan->id}}">{{$karyawan->nama}}</option>
                          </select>
                          </td>
                            <td><input type="checkbox"  class="form-control btn-sm hadir not_active" value="1" name="keterangan[]" ></td>
                            {{-- <td><input type="checkbox" value="2" name="keterangan[]" class="izin"></td>
                            <td><input type="checkbox" value="3" name="keterangan[]"  class="alpa"></td> --}}
                            <td><a href="/absen/{{$karyawan->id}}/{{date('Ymd')}}/hadir">Hadir</a>
                          {{-- <a href="/absen/{{$karyawan->id}}/izin">Alpa</a>
                            <a href="/absen/{{$karyawan->id}}/alpa">Izin</a> --}}
                          </td>
                          </tr>
                          @endforeach
                          <tr>
                            <td>
                              <button type="submit" class="btn btn-success">Absen</button>
                            </td>
                            <td><span class="btn btn-success semua">Hadir Semua</span></td>
                          </form>
                          @endif

                          </tbody>
                      </table>
                    </div>
                    </div>
            </div>
        </div>
      <div class="col-xl-6 cl-md-6 col-sm-12 col-xs-12">
            <div class="card">
                <div class="card-header text-white bg-success">
                     Hadir
                </div>
                <div class="card-body">
                  
                    <table class="table ">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Karyawan</th>
                            <th scope="col" class="text-center">Absen</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($hadir as $h)
                        <tr>
                          <td>{{$loop->iteration}}</td>
                          <td>{{$h->karyawan->nama}}</td>
                         
                        <td>{{date('d F Y',strtotime($h->tanggal))}}</td>
                        </tr>
                          @endforeach
                          <tr>
                          
                          </tr>
                        </tbody>
                      </table>
                    </div>
            </div>
        </div>
       
    </div>
@endsection
@section('script')
<script src="{{ asset('js/mine/absen.js') }}">

</script>

@endsection