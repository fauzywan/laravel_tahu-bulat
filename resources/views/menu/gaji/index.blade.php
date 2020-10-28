@extends('layouts.master')

@section('main')
<div class="card">
    <div class="card-header">
        <h5>Daftar Gaji Karyawan</h5>
    </div>
    <div class="card-body">
        <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama</th>         
                        <th>Dibuat</th>
                        <th>Gaji</th>
                        <th>Opsi</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($karyawan as $k)
                        <tr>
                        <td>{{$loop->iteration}}</td>
                            <td>{{$k->nama}}</td>
                            <td>{{$k->gaji_filter($tanggal)->sum('dibuat')}}</td>
                            <td>{{number_format($k->total_gaji($tanggal))}}</td>
                            <td class="text-center text-white ">
                                <a  data-toggle="modal" data-target=".bd-example-modal-xl" class="btn btn-sm btn-info" data-info='tr-{{$loop->iteration}}-{{$k->id}}')"><i class="fas fa-fw fa-info"></i></a>
                                <a href="" class="btn btn-sm btn-success"><i class="fas fa-fw fa-credit-card"></i></a>
                            </td>
                        </tr>
                            
                        @endforeach
                    </tbody>
                </table>
            </div>
    </div>
    <div class="card-footer"></div>
</div>
           
<!-- Extra large modal -->

<div class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Info Penggajian</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body" id="modal">
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
    </div>
  </div>
</div>


@endsection
@section('script')
    <script>
       info= document.querySelectorAll('.btn-info');
       [...info].map(info=>{
           info.addEventListener('click', function(){
              
                karyawan=fetch(`api/karyawan/${info.dataset.info.split('-')[2]}/{{$tanggal}}`)
               .then(data=>data.json())
               .then(data=>console.log(data))

           })
       })
    </script>
@endsection