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
    <a class="nav-item nav-link" href="./sesi">Detail</a>
    <a class="nav-item nav-link" href="./adonan">Adonan</a>
    <a class="nav-item nav-link" href="./create">Buat Adonan</a>
    <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true"> Packing</a>

  </div>
</nav>
@endsection
    @section('main')
    <div class="row">
  
        <div class="col-xl-7">
            <div class="card">
                <div class="card-header">
                Daftar Pesanan
            </div>
            <div class="card-body">
            <form action="" method="POST">
              @csrf
              <div class="row">
                <div class="col-xl-4">
                <input type="text" readonly data-belum="" class="form-control" value="{{$sesi->belum_dikemas()-$sesi->dikemas}}">
                </div>
                @method('post')
                 <div class="col-xl-4">
                  <input type="date" name="tanggal" id="tanggal" class="form-control" value="{{date('Y-m-d')}}">
                  </div>
                  <div class="col-xl-4">
                    {{-- <select name="pesanan" class="form-control" >
                      @foreach ($sesi-  >sesi_produk as $produk)
                      <option value="{{$produk->id}}">{{$produk->pesanan->distributor->nama}}</option>
                      @endforeach
                    </select> --}}
                  </div>
                 
              </div>
              
              <div class="row mt-3">
                <table class="table table-stripped table-bordered">
                  <thead>
                    <tr>
                      <th>Karyawan</th>
                      <th>Jumlah</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody id="body">
                    <tr class="tr-1">
                      <td>
                        <select id="selek-1" name="karyawan[]" class="form-control selected-0" onchange="select('tr-1','selek-1')">
                          
                          @foreach ($absen as $a)
                        @if($a->karyawan->posisi_id==2)
                        <option value="{{$a->karyawan->id}}" class="option-value option-value-{{$a->karyawan->id}} selected">{{$a->karyawan->nama}}</option>
                        @endif
                          @endforeach 
                        </select>
                      </td>
                            <td><input type="text" name="jumlah[]" class="form-control"></td>
                            <td></td>
                    </tr>
                    <tr class="next"></tr>
                  </tbody>
                      <tfoot>
                        
                        <tr>
                          <td>
                            <button class="btn btn-sm btn-primary">Simpan Data</button>
                            </td>
                          <td colspan="2" ><span class="btn btn-sm btn-primary float-right"id="btn-add" onclick="add('next','body')"><i class="fas fa-plus"></i></span></td>
                        </tr>
                      </tfoot>
                </table>
              </div>

                </form>
              </div>
        </div>
        </div>
        <div class="col-xl-5  ">
            <div class="card">
                <div class="card-header">
                Karyawan
            </div>
                    <div class="card-body">
                            <table class="table table-bordered">
                        <thead>
                            <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Jumlah</th>
                            </tr>
                        </thead>
                        <tbody>
                          @foreach ($karyawan as $k)
                      <tr>
                          <td>
                              {{$k->karyawan->nama}}
                          </td>
                        <td>{{$k->where(['karyawan_id'=>$k->karyawan_id,'sesi_id'=>$sesi->id])->sum('dibuat')}}</td>
                        </tr>
                          @endforeach
               
                        </tbody>
                        </table>
                    </div>
                </div>   
        </div>
    </div>
    <div class="row">
      <div class="col-xl-12">
        <div class="card">
  <div class="card-header">
    Pemakaian
  </div>
  <div class="card-body">
    <table class="table table-bordered">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Kuantitas</th>
          <th scope="col">Harga</th>
        </tr>
      </thead>
      <tbody>

      </tbody>
    </table>
  </div>
</div>
        
      </div>
    </div>
    @endsection
    @section('script')
        <script>
document.getElementById('selek-1').classList.replace(document.getElementById('selek-1').classList[1],'selected-'+document.getElementById('selek-1').querySelector('option').value);
let terselect=[];
let body2; 
          function add(next,body)
          {

              body=document.getElementById(''+body)
              next=body.querySelector(`tr.${next}`)
            if(body.querySelectorAll('tr').length<=body.querySelector('select').querySelectorAll('.option-value').length)
            {

            if(body.querySelectorAll('tr').length>=body.querySelector('select').querySelectorAll('.option-value').length){
              document.querySelector('#btn-add').classList.add('hidden')
            }
              next.innerHTML=`<tr class="tr-${body.querySelectorAll('tr').length}">
                      <td>
                        <select id="selek-${body.querySelectorAll('tr').length}" name="karyawan[]" class="form-control selected-0" onchange="select('tr-${body.querySelectorAll('tr').length}','selek-${body.querySelectorAll('tr').length}')">
                          @foreach ($absen as $a)
                        @if($a->karyawan->posisi_id==2)
                        <option value="{{$a->karyawan_id}}" class="option-value option-value-{{$a->karyawan->id}} selected">{{$a->karyawan->nama}}</option>
                        @endif
                          @endforeach 
                        </select>
                      </td>
                            <td><input type="text" name="jumlah[]" class="form-control"></td>
                            <td><span class="btn btn-sm btn-danger" onclick="hapus('tr-${body.querySelectorAll('tr').length}  ','body')"><i class="fas fa-minus"></i></span></td>
                    </tr>`
              next.classList.replace('next','tr-'+body.querySelectorAll('tr').length)
              body.insertRow().classList.add('next');
                  
                              body2=document.querySelector(`.tr-${body.querySelectorAll('tr').length-1}`);
                          
            [...body2.querySelectorAll('option')].map(o=>{
              if(document.querySelectorAll('.selected-'+o.value).length==0)
              {
                if(body2.querySelectorAll('.stop').length==0){

                  body2.querySelector('select').value=o.value
                  body2.querySelector('select').classList.replace(body2.querySelector('select').classList[1],'selected-'+o.value)
                  body2.querySelector('select').classList.add('stop');
                }
                  
                
              }  
            });
                  body2.querySelector('select').classList.remove('stop');
            }
                }
          function hapus(parent,body)
            {
              if(document.getElementById('body').querySelectorAll('tr').length-1 <= document.querySelectorAll('.option-value').length){
              document.querySelector('#btn-add').classList.remove('hidden')
            }
              document.querySelector(`#${body} .${parent}`).remove()
            }
            /*  
           function select(el,selek)
             {
               el=document.querySelector(`.${el}`);
               selek=document.querySelector(`#${selek}`);
                  [...document.querySelectorAll(`.option-value-${selek.classList[1].split('-')[1]}.d-none`)]
            .map(d=>{

           });


               selek.classList.replace(selek.classList[1],`selected-${selek.value}`);

            [...document.querySelectorAll('#body select')]
            .map(d=>{
            if(d.classList[1]!=`selected-${selek.value}`)
               {
                d.querySelector(`.option-value-${selek.value}`).classList.add('d-none')
               }
             });
            }
            */
           

        </script>
    @endsection