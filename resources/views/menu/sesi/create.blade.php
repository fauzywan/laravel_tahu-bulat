@extends('layouts.master')

@section('navbar')
    <a href="/pesanan">
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
  
    <nav>
  <div class="nav nav-tabs" id="nav-tab" role="tablist">
        @if($sesi->status==0)
    <a class="nav-item nav-link" href="./rekap">Rekap</a>
    @endif
    <a class="nav-item nav-link" id="nav-home-tab"  href="./sesi" >Detail</a>
    <a class="nav-item nav-link" href="./adonan">Adonan</a>
    <a class="nav-item nav-link active">Buat Adonan</a>
    <a class="nav-item nav-link" href="./packing">Packing</a>
  </div>
</nav>


@endsection
@section('main')
<div class="row">
     <div class="col-xl-6 col-md-5 " >
       <div class="card" ">
         <div class="card-body">
           <h5 class="card-title">Bahan Adonan</h5>
          </div>
          <div class="table-responsive">
            <form action="/adonan/pengaturan" method="POST">
            <table class="table table-stripped">

                                <tbody class="area-adonan">

                @foreach ($adonan as $a)
            <tr class="adonan {{$a->biaya_produksi_id}}" data-tersedia="{{$a->tersedia()}}">
                    <td>{{$a->biaya_produksi->nama}}</td>
                    <td class="kuantitas">:<b>{{$a->kuantitas." ".$a->biaya_produksi->satuan->nama}}</b></td>
                  </tr>
                  @endforeach
          
                                  <tr class="next-adonan"></tr>
                                </tbody>
                                <tr class="hidden">
                                    @csrf
                                    <td><button class="btn btn-primary">Atur</button></td>
                                    <td><span onclick="select_adonan('area-adonan','next-adonan')" class="add btn btn-sm btn-primary float-right"><i class="fas fa-plus"></i></span></td>
                                </tr>
                </table>
                                  </form>


              </div>
            </div>
          </div>
     <div class="col-xl-6 col-md-5 " >
       <div class="card" >
         <div class="card-body">
           <h5 class="card-title">Ketersediaan Bahan Adonan</h5>
          </div>
          <div class="table-responsive">
            <table class="table table-stripped">
              @foreach ($adonan as $a)
            <tr class="masta-child-{{$a->biaya_produksi->id}}">
                <td>{{$a->biaya_produksi->nama}}</td>
              
                @foreach ($a->adonan($a->biaya_produksi->id) as $a)
            <td class="cild-{{$loop->iteration}} {{$a->tersedia($a->harga_satuan,$a->biaya_produksi_id)}}">Rp.{{number_format($a->harga_satuan)}} ({{$a->tersedia($a->harga_satuan,$a->biaya_produksi_id)." ".$a->biaya_produksi->satuan->nama}})</td>
                @endforeach
              </tr>
                  @endforeach
            </table>
          </div>
        </div>
      </div>
</div>
<div class="row">
      
      <div class="col-xl-12 col-md-12 mt-3" >
      <form class="card" action="" method="POST">
          <div class="card-header"><h6>Buat Adonan</h6></div>
          <div class="container">
              <div class="row mt-3 mb-3">
                <div class="col-xl-3 mb-3">
                  <label for="">Tanggal</label>
  <input type="date" name="tanggal" class="form-control  " value="{{date('Y-m-d')}}">
                </div>
                <div class="col-xl-3 mb-3">
                  <label for="">Karyawan</label>
                    <select  class="form-control" name="karyawan">
    @foreach ($karyawan as $k)
    @if ($k->karyawan->sesi_karyawan->where('status',1)->count()!=1)
    <option value="{{$k->karyawan->id}}">{{$k->karyawan->nama}}</option>
    @endif
    @endforeach
  </select>
                </div>
                {{-- <div class="col-xl-3 mb-3">
                  <label for="">Pesanan</label>
<select name="pesanan" class="form-control  " name="pesanan[]">
        @foreach ($sesi->sesi_produk as $produk)
        @if($produk->pesanan->jumlah- $produk->sedang_dibuat!=0)
        <option value="{{$produk->id}}">{{$produk->pesanan->distributor->nama}}({{$produk->pesanan->jumlah- $produk->sedang_dibuat}})</option>
        @endif
        @endforeach
      </select>
</div>  --}}
    <div class="col-xl-3 mb-3">
      <label for="">Jumlah Adonan</label>
<div class="input-group">
<input type="text" placeholder=" Adonan" class="adonan-input form-control  " onkeyup="getAdonan()" name="adonan" value="1">
  <input type="text" placeholder="jumlah"data-jumlah='740' class="jumlah-input  form-control  " readonly name="adonan_jumlah" value="740">
  </div>      
      </div>
      
                </div> 

                @csrf

                <div class="row">
         <div class="col-xl-8">
           <div class="card">
                           <div class="card-header">
                             Bahan
                           </div>
                           <div class="card-body">
                             <table class="table table-bordered">
                               <thead>
                                 <tr>
                                   <th scope="col">Bahan</th>
                                   <th scope="col">Kuantitas</th>
                                   <th scope="col">Pengaturan</th>
                               
                                 </tr>
                               </thead>
                               <tbody>
                                 @foreach ($adonan as $a)

                                 <tr class="bg-light master-{{$a->biaya_produksi->id}}">
                                   <td>
                                     <select name="bahan[]" class="form-control" >
                                     <option value="{{$a->biaya_produksi->id}}">
                                    {{$a->biaya_produksi->nama}}
                                    </option></select> 
                                  </td>
                                <td><input type="text" class="form-control kuantitas-{{$a->biaya_produksi->id}}" autocomplete="off" name="kuantitas[]" value="{{$a->kuantitas}}"></td>
                                <td class="hidden">
                                  <input type="text" class="form-control harga-input" autocomplete="off" name="harga[]" value="" hidden>
                                  </td>
                                  <td class="text-center"><input type="checkbox" class="cek-this-out"  checked></td>
                               @foreach ($a->adonan($a->biaya_produksi_id) as $a)
                               <tr class="master-child-{{$a->biaya_produksi_id}} hidden">
                               <td>
                               <select  class="form-control">
                                 <option value="{{$a->biaya_produksi_id}}">{{$a->harga_satuan}}</option>
                                 </select>
                                <td><input type="text" autocomplete="off" placeholder="kuantitas" class="child-input child-{{$a->biaya_produksi_id}} form-control urutan-{{$loop->iteration}}" onkeyup="getAdonanChild('child-{{$a->biaya_produksi_id}}','urutan-{{$loop->iteration}}',{{$loop->iteration}});kuantitas('child-{{$a->biaya_produksi_id}}')" ></td>
                                <td><input type="text" readonly class="form-control harga" value="{{$a->harga_satuan}}"hidden ></td>
                                
                              </tr>
                                @endforeach
                              </tr>
                                @endforeach
                               </tbody>
                               
                             </table>
                           </div>
                          </div>
                        </div>
         <div class="col-xl-4">
           <div class="card">
                           <div class="card-header">
                             Rekan Karyawan
                           </div>
                            <div class="card-body">
                              <table class="table table-striped">
                                <thead>
                                 <tr>
                                  </tr>
                                </thead>
                               <tbody class="area">
          
                                  <tr class="next"></tr>
                                </tbody>
                                <tr>
                                  <td></td>
                                  <td><span onclick="select()" class="add btn btn-sm btn-primary float-right"><i class="fas fa-plus"></i></span></td>
                                </tr>
                              </table>
                            </div>
                          </div>
                        </div>
                      </div>
                      <button class="btn btn-success  m-3">Buat Adonan </button>
       </div>
       </form>
      </div>
    </div>
@endsection
@section('script')
    <script>
document.addEventListener('click',function(e){
  if(e.target.classList[0]=='remove-trsh'){

    e.target.parentNode.parentNode.remove()
  }
  if(e.target.classList[0]=='fas-trash'){

    e.target.parentNode.parentNode.remove()
  }
  if(e.target.classList=='cek-this-out')
  {
if(e.target.checked==true)
{
    e.target.parentNode.parentNode.querySelector('select').setAttribute('name','bahan[]');
    e.target.parentNode.parentNode.querySelector('input').setAttribute('name','kuantitas[]');
    e.target.parentNode.parentNode.children[2].querySelector('input').setAttribute('name','harga[]');
  }else{
    e.target.parentNode.parentNode.querySelector('select').setAttribute('name','');
    e.target.parentNode.parentNode.querySelector('input').setAttribute('name','');
    e.target.parentNode.parentNode.children[2].querySelector('input').setAttribute('name','');

  }
    [...document.querySelectorAll(`.master-child-${e.target.parentNode.parentNode.classList[1].split('-')[1]}`)].forEach(element => {
if(e.target.checked==true)
{
  element.querySelector('select').setAttribute('name','')
  element.querySelector('input').setAttribute('name','')
  element.querySelector('.harga').setAttribute('name','')
element.children[1].querySelector('input').value="";
}else{
  element.querySelector('select').setAttribute('name','bahan[]')
  element.querySelector('input').setAttribute('name','kuantitas[]')
  element.querySelector('.harga').setAttribute('name','harga[]')

}
      element.classList.toggle('hidden')
    });
   
  }
});
     function select_adonan(area,next) {
                document.querySelector(`.${next}`).innerHTML=`<td><select class="form-control"  name="adonan[]">
                               @foreach ($adonan[0]->biaya_produksi->all() as $a)
                               <option value="{{$a->id}}">{{$a->nama}}</option>
                               @endforeach
                             </select>
                             <td> <input type="text" class="form-control" placeholder="Jumlah" name="kuantitas[]" onkeyup="a('kuant')"> </td>
                             </td>
                              <td><span  class="remove-trsh btn btn-sm btn-danger float-right"><i class="fas-trash fas fa-trash"></i></span></td>`
                             ;
        document.querySelector(`.${next}`).classList.remove(`${next}`)
        document.querySelector(`.${area}`).insertRow().classList.add(`${next}`)
                        

     }
     function select() {
         document.querySelector('.next').innerHTML=`<td><select name="rekan[]" class="form-control">
                               @foreach ($karyawan as $k)
                               @if ($k->karyawan->sesi_karyawan->where('status',1)->count()!=1)
                               <option value="{{$k->karyawan->id}}">{{$k->karyawan->nama}}</option>
                               @endif
                               @endforeach
                             </select>
                             </td>
                              <td><span  class="remove-trsh btn btn-sm btn-danger float-right"><i class="fas-trash fas fa-trash"></i></span></td>`
                             ;
        document.querySelector('.next').classList.remove('next')
        document.querySelector('.area').insertRow().classList.add('next')
                            }
             function getAdonan()
             {     
               [...$('.adonan')].forEach(element => {
                if(element.querySelector('.kuantitas').textContent.substr(1).split(' ')[0] * document.querySelector('.adonan-input').value>element.dataset.tersedia){
                  document.querySelector(`.kuantitas-${element.classList[1]}`).value='Bahan Baku Tidak Cukup'

                }else{

                  document.querySelector(`.kuantitas-${element.classList[1]}`).value=(element.querySelector('.kuantitas').textContent.substr(1).split(' ')[0] * document.querySelector('.adonan-input').value);
                }
                
               });
          (document.querySelector('.jumlah-input').value=document.querySelector('.jumlah-input').dataset.jumlah * document.querySelector('.adonan-input').value)
             }    
             let plus;
             let min;
             let minSeluruh;
              function getAdonanChild (el,exe,child){   
                minSeluruh=(document.querySelector(`.master-${el.split('-')[1]} input`).value); 
               min=(document.querySelector('.masta-'+el).querySelector('.cild-'+child).classList[1]);


                [...document.querySelectorAll(`.${el}`)].reduce((a,b)=>{
                   if(a.value=="" && b.value==""){
                    plus=(0)
                  }else{
            if(a.value==""){
                   plus=(0+parseInt(b.value))
                  }
                  if(b.value==""){
                    
                   plus=(0+parseInt(a.value))
                  } else{

                   plus=(parseInt(a.value)+parseInt(b.value))
                  }
                  
                  }

                })
if(plus>minSeluruh){
  document.querySelector(`.${exe}`).value=""
}
if(parseInt(document.querySelector(`.${exe}`).value)>min)
  document.querySelector(`.${exe}`).value=""
              }     
              function kuantitas(el)
              {
                if(document.querySelector('.'+el).value=="" ||document.querySelector('.'+el).value==0 )
                {

                  (document.querySelector('.'+el).setAttribute('name','[]'))
                    document.querySelector('.'+el).parentNode.previousSibling.querySelector('select').setAttribute('name','');
                  
                   document.querySelector('.'+el).parentNode.parentNode.querySelector('.harga').setAttribute('name','')
                }else{
                  document.querySelector('.'+el).setAttribute('name','kuantitas[]');
                  document.querySelector('.'+el).parentNode.previousSibling.querySelector('select').setAttribute('name','bahan[]');
                    document.querySelector('.'+el).parentNode.parentNode.querySelector('.harga').setAttribute('name','harga[]')

                }
              }  

    </script>
@endsection