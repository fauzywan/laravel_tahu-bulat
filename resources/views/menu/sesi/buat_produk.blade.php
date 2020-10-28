@extends('layouts.master')

@section('navbar')
<a href="/pesanan/{{$buat_produk->sesi_id}}/adonan">
        <i class=" btn-circle fas fa-arrow-left"></i>Back    
    </a>
    @endsection
@section('top-main')

<div class="row mb-3">
            <div class="col-xl-4 col-md-6 mb-4">
              <div class="card border-left-success   shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Sedang Dibuat</div>
                      {{-- <div class="h5 mb-0 font-weight-bold text-gray-800">{{($sesi->sedang_dibuat())}} Buah</div> --}}
                    </div>
                    <img class="" style="width:120px; position:absolute; bottom: 1px;  right: 0px;"  src="{{asset('unDraw/undraw_deliveries_131a.svg')}}">               
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-4 col-md-6 mb-4">
              <div class="card border-left-primary  shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Sudah Dibuat</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">  {{($sesi->dibuat)}} Buah</div>
                    </div>
                    <img class="" style="width:120px; position:absolute; bottom: 2px;  right: 0px;"  src="{{asset('unDraw/undraw_deliveries_131a.svg')}}">               
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-4 col-md-6 mb-4">
              <div class="card border-left-danger  shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Belum Dibuat</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">  {{($sesi->jumlah-$sesi->dibuat)-$sesi->sesi_produk->sum('sedang_dibuat')}} Buah</div>
                    </div>
                    <img class="" style="width:120px; position:absolute; bottom: 2px;  right: 0px;"  src="{{asset('unDraw/undraw_deliveries_131a.svg')}}">               
                  </div>
                </div>
              </div>
            </div>

    </div>
  

@endsection
@section('main')

<div class="row">
<div class="col-xl-8 mb-3">
      <div class="card">
  <div class="card-header bg-success text-white">
    Pengambilan Bahan
  </div>
  <div class="card-body">
  <form action="./bahan" method="POST">
      <table class="table table-bordered">
                @if ($buat_produk->balo *$jumlah>$buat_produk->jumlah)

      @csrf
      <tr>
        <td colspan="3">
            <label>Karyawan</label>
            <select class="form-control" name="karyawan">
          @foreach ($buat_produk->sesi_karyawan as $sesi_karyawan)
          <option value="{{$sesi_karyawan->karyawan->id}}">{{$sesi_karyawan->karyawan->nama}}</option>
          @endforeach
        </select>
        </td>
      </tr>
      <tbody class="areaBahan">
      <tr>
        <td >
             <label>Bahan</label>
        <select class="form-control no-1" name="bahan[]" >
            @foreach ($bahan as $b)
        <option value="{{$b->id}}" class="value-{{$b->id}}" data-tersedia="{{$b->tersedia}}">{{$b->biaya_produksi->nama}}(Rp.{{number_format($b->harga_satuan)}})({{$b->tersedia." ".$b->biaya_produksi->satuan->nama}})</option>
            @endforeach
    </select>
        </td>
        <td>
            <div class="form-group">
    <label>Jumlah</label>
    <input class="form-control" name="kuantitas[]" onkeyup="kuantitas('no-1')"">
  </div>
        </td>
         <td class="fas-trash-adonan"><span  class="remove-trsh-adonan btn btn-danger float-right"><i class="fas-trash-adonan fas fa-trash"></i></span></td>
      </tr>

      <tr class="nextBahan"></tr>        
      </tbody>

<tr>
  <td colspan="1" class="text-center">
                <button type="submit" class="btn btn-sm btn-primary">Tambah</button>
              </td>
  <td class="float-right">
    <span class="btn btn-primary" onclick="addBahan('nextBahan')"><i class="fas fa-plus"></i></span>
  </td>
</tr>
@endif
      </table>

  </form>
</div>
</div>
</div>
  
<div class="col-xl-4">
    <div class="card">
        <div class="card-header bg-success text-white">
            Karyawan
        </div>
        <div class="card-body">
            <form action="./karyawan" method="POST">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">nama</th>
                            <th scope="col">Dibuat</th>
                        </tr>
                    </thead>
                    <tbody class="area">
                    @foreach ($buat_produk->sesi_karyawan as $sk)
                        <tr>
                            <td>{{$sk->karyawan->nama}}</td>
                            <td>{{$sk->dibuat==""?0:$sk->dibuat}}</td>
                        </tr>
                        @endforeach
                        @csrf
                    <tr class="next"></tr>
                </tbody>
                @if ($buat_produk->balo *$jumlah>$buat_produk->jumlah)
            <tr>
              <td colspan="1" class="text-center hidden">
                <button type="submit" class="btn btn-sm btn-primary">Tambah</button>
              </td>
              <td><span onclick="select()" class="add btn btn-sm btn-primary float-right"><i class="fas fa-plus"></i></span></td>
            </tr>
            @endif
            
        </table>
    </form>
  </div>
</div>
    </div>
</div>
<div class="row">
  
      <div class="col-xl-12">
            <div class="card">
  <div class="card-header bg-success text-white">
    Detail
  </div>
  <div class="card-body">
    <table class="table table-bordered">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Kuantitas</th>
      <th scope="col">harga</th>
    </tr>
  </thead>
  <tbody>
     

      @foreach ($buat_produk->pemakaian as $pemakaian)
    <tr>
    <td>{{$pemakaian->belanja->biaya_produksi->nama}}</td>
    <td>{{$pemakaian->jumlah}} {{$pemakaian->belanja->biaya_produksi->satuan->nama}}</td>
    <td>Rp.{{number_format($pemakaian->harga)}}    </td>
    </tr>
      @endforeach
      
    </tbody>
    <tr>
      <td>Total</td>
      <td></td>
    <td>Rp.{{number_format($pemakaian->sum('harga'))}}</td>
    </tr>
    </table>
    </div>
    </div>
    </div>
  <div class="col-xl-12 mt-3">
    <div class="card">
  <div class="card-header bg-success text-white">
    Selesai Membuat
  </div>
  <div class="card-body">
<form action="" method="POST">
  @csrf

    <table class="table table-bordered">
  <thead>
    <tr>
      {{-- <th scope="col">#</th> --}}
      <th scope="col">Karyawan</th>
      <th scope="col">Membuat</th>
    </tr>
  </thead>
  @foreach ($buat_produk->sesi_karyawan as $sesi_karyawan)
  <tbody>
  <tr>
      <td>
        <select class="form-control select-input" name="karyawan[]">
        <option value="{{$sesi_karyawan->id}}">
          {{$sesi_karyawan->karyawan->nama}}
        </option>
      </select>
      </td>
      <td>
        <input type="text" class="form-control jumlah-input"   name="jumlah[]">
      </td>
    </tr>
  </tbody>
  @endforeach
  <tr>
    <td><button type="submit" class="btn btn-primary">Selesai</button></td>
  </tr>

</table>
  
</form>
  </div>
</div>
  </div>
</div>
@endsection
@section('script')
    <script>
      document.addEventListener('click',function(e){
if(e.target.classList[0]=="fas-trash"){
  if(e.target.parentElement.parentElement.parentElement.parentElement.querySelectorAll('.fas-trash').length/2==1){
e.target.parentElement.parentElement.parentElement.parentElement.parentElement.querySelector('button').classList.toggle('hidden')
  }
  e.target.parentNode.parentNode.parentNode.remove()
}
if(e.target.classList[0]=="remove-trsh"){
  if(e.target.parentNode.parentNode.parentElement.querySelectorAll('.fas-trash').length/2==1){
e.target.parentElement.parentElement.parentElement.parentElement.querySelector('button').classList.toggle('hidden')

  }
  e.target.parentNode.parentNode.remove()

}
if(e.target.classList[0]=="fas-trash-adonan"){
  e.target.parentNode.parentNode.parentNode.remove()
}
if(e.target.classList[0]=="remove-trsh-adonan"){
  e.target.parentNode.parentNode.remove()

}
      });
    function select() {
      if(document.querySelector('.next').parentElement.querySelectorAll('.fas-trash').length==0)
      {document.querySelector('.next').parentElement.parentElement.querySelector('.hidden').classList.toggle('hidden')
      }
         document.querySelector('.next').innerHTML=`<td><select name="rekan[]" class="form-control">
                               @foreach ($karyawan as $k)
                               @if ($k->sesi_karyawan->where('status',1)->count()!=1)
                               <option value="{{$k->id}}">{{$k->nama}}</option>
                               @endif
                               @endforeach
                             </select>
                             </td>
                              <td class="fas-trash"><span  class="remove-trsh btn btn-sm btn-danger float-right"><i class="fas-trash fas fa-trash"></i></span></td>`
                             ;
        document.querySelector('.next').classList.remove('next')
        document.querySelector('.area').insertRow().classList.add('next')
                            }
                            let kelas;
             function addBahan(el)
             {
               kelas=`no-${document.querySelector('.'+el).parentNode.querySelectorAll('tr').length}`;
              
               document.querySelector(`.${el}`).innerHTML=`
        <tr>
                     <td >
             <label>Bahan</label>
        <select class="form-control ${kelas}" name="bahan[]" >
            @foreach ($bahan as $b)
        <option value="{{$b->id}}" class="value-{{$b->id}}" data-tersedia="{{$b->tersedia}}">{{$b->biaya_produksi->nama}}(Rp.{{number_format($b->harga_satuan)}})({{$b->tersedia." ".$b->biaya_produksi->satuan->nama}})</option>
            @endforeach
    </select>
        </td>
        <td>
            <div class="form-group">
    <label>Jumlah</label>
    <input class="form-control" name="kuantitas[]" onkeyup="kuantitas(${kelas})">
  </div>
        </td>
          </td>
                              <td class="fas-trash-adonan"><span  class="remove-trsh-adonan btn btn-danger float-right"><i class="fas-trash-adonan fas fa-trash"></i></span></td>
      </tr>`;
               document.querySelector(`.${el}`).classList.remove('nextBahan')
            document.querySelector('.areaBahan').insertRow().classList.add('nextBahan')
             }
             function kuantitas(el)
             {
               if(parseInt(document.querySelector('.'+el).parentElement.parentElement.querySelector('input').value)>parseInt(document.querySelector('.'+el).parentElement.querySelector('.value-'+document.querySelector( `.${el}`).value).dataset.tersedia)){
                 [document.querySelector('.'+el).parentElement.parentElement.querySelector('input').value.length-1]
                 document.querySelector('.'+el).parentElement.parentElement.querySelector('input').value=document.querySelector('.'+el).parentElement.parentElement.querySelector('input').value.substr(0,[document.querySelector('.'+el).parentElement.parentElement.querySelector('input').value.length-1])
               }
             }
    </script>
@endsection