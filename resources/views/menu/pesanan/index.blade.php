@extends('layouts.not_sidebar')
@section('top-main')
<h1 class="h3 mb-3   text-gray-800"> Pesanan</h1>
<nav>
  <div class="nav nav-tabs" id="nav-tab" role="tablist">
    <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Daftar Pesanan</a>
    <a class="nav-item nav-link" href="/pesanan/bayar">Bayar Pesanan</a>
    <a class="nav-item nav-link" href="/pesanan/create">Tambah Pesanan</a>
    <a class="nav-item nav-link" href="/pesanan/laporan">Laporan</a>
  </div>
</nav>
   <div class="row mt-3" >
               <div class="col-xl-4 col-md-6 mb-4">
              <div class="card border-left-success   shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Jumlah Pesanan</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">{{$pesanan->jumlah}} Buah</div>
                    </div>
                    <img class="" style="width:120px; position:absolute; bottom: -3px;  right: 0px;"  src="{{asset('unDraw/undraw_successful_purchase_uyin.svg')}}">               

                  </div>
                </div>
              </div>
            </div>
               <div class="col-xl-4 col-md-6 mb-4"id="lunasi">
              <div class="card border-left-primary   shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1" >Nominal Uang</div>
                      {{-- <div class="h5 mb-0 font-weight-bold text-gray-800" id="dibayar">Rp.{{number_format($pesanan->harus_dibayar())}}</div> --}}
                    </div>
                    <img class="" style="width:120px; position:absolute; bottom: 0;  right: 10px;"  src="{{asset('unDraw/undraw_pay_online_b1hk.svg')}}">               

                  </div>
                </div>
              </div>
            </div>  
               <div class="col-xl-4 col-md-6 mb-4">
              <div class="card border-left-danger   shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Tanggal  Pesanan</div>
                      {{-- <div class="h5 mb-0 font-weight-bold text-gray-800">{{date('d F Y',strtotime($pesanan->tanggal))}}</div> --}}
                    </div>
                    <img class="" style="width:120px; position:absolute; bottom: 0;  right: 10px;"  src="{{asset('unDraw/2.svg')}}">               

                  </div>
                </div>
              </div>
            </div>

          </div>

@endsection
@section('main')
   
          <div class="row">
               <div class="col-xl-4 col-md-6">
        <div class="card mb-3">
            <div class="card-header bg-warning text-white">
                Detail Pesanan
            </div>
            {{-- <ul class="list-group list-group-flush">
            <li class="list-group-item">Pemesan : <b style="font-size: 13px">{{$pesanan->distributor->nama}}<br>{{$pesanan->distributor->pemilik==""?'':'('.$pesanan->distributor->pemilik.')'}}</b></li>
                <li class="list-group-item">Alamat : <b>{{$pesanan->distributor->alamat}}</b></li>
                <li class="list-group-item">Nomor Telepon  : <b>{{$pesanan->distributor->telepon}}</b></li>
            </ul> --}}
        </div>
    </div>
               <div class="col-xl-8 col-md-8">
        <div class="card mb-3">
            <div class="card-header bg-success text-white">
                Bayar Pesanan
            </div>
            <div class="card-body">
                
            </div>
        </div>
    </div>
</div>
  
@endsection



@section('script')
<script src="{{ asset('js/mine/rp.js') }}"></script>
<script src="{{ asset('js/mine/pesanan/switch.js') }}"></script>
<script src="{{ asset('js/mine/pesanan/index.js') }}"></script>
<script>
    const selek=document.getElementById('SELECT_DATE');
let tanggal
    selek.addEventListener('change',function(){
        tanggal=this.value;
        if(tanggal!=1){
            (document.querySelectorAll('.sembunyi').length>0==true)
                  if(document.querySelectorAll('.sembunyi').length>0){
                [...document.querySelectorAll('.sembunyi')].map(
                    t=>{
                        t.classList.remove('sembunyi')
                        t.parentNode.classList.remove('hide')
                }
                    )
            }

            [...document.querySelectorAll('.FORM tr.dateable')].
            filter(trr=>{      
          return  trr.children[2].classList[0]!=tanggal && trr.classList[2]!='datenonable'})
            .map(trr=>{
                    trr.classList.add('hide')
                    trr.children[2].classList.add('sembunyi')}
        )
        }else{
         [...document.querySelectorAll('.FORM tr')].filter(trr=>trr.classList[2]=='dateable').map(trr=>{
             trr.classList.remove('hide')
             trr.children[2].classList.remove('sembunyi')})
        }
        });

  document.addEventListener('keydown',function(e){
    if(e.key=="b" && e.ctrlKey){
        document.location.href="/pesanan/bayar";
    }
})

    // document.querySelector('.checkedIn').checked;
    //     document.addEventListener('keydown',function(e){
    //         if(e.key=="m")   
    //         {
    //                 if(!document.querySelector('.checkedIn').checked){
    //                     document.querySelector('.checkedIn').checked=true;
    //                             document.querySelector('.sedang_buat').classList.remove('hide');
    //     document.querySelector('.form_data').classList.add('hide');

    //     if (document.querySelectorAll('.form tr').length > 0) {
    //         [...document.querySelectorAll('.form tr')].map(tr => tr.remove())
    //     }
    //     [...document.querySelectorAll('.opsi')].map(ops => {
    //         if (ops.parentNode.classList[0] != 'activein') {
    //             ops.parentNode.classList.add('hide')
    //         }
    //         ops.children[0].classList.add('hide');
    //         ops.children[1].classList.remove('hide');
    //     });
    //                 }
    //                 else{
    //                     document.querySelector('.checkedIn').checked=false;
    //                       document.querySelector('.form_data').classList.remove('hide');
    //     document.querySelector('.sedang_buat').classList.add('hide');
    
    //     [...document.querySelectorAll('.opsi')].map(ops => {
    
    //         if (ops.parentNode.classList[0] != 'activein') {
    //             ops.parentNode.classList.remove('hide')
    //         }
    //         ops.children[0].classList.remove('hide')
    //         ops.children[1].classList.add('hide')
    //     });
    //                     [...document.querySelectorAll('.hidenIn')].map(hid => {
    //         hid.classList.replace('hidenIn', 'activein')
    //     });
                        
    //                 }
                
    //         }
            
    //     });
    //     </script>
   
@endsection