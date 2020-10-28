@extends('layouts.master')
@section('top-main')
    <h1 class="h3 mb-3   text-gray-800"> Pesanan</h1>
<nav>
  <div class="nav nav-tabs" id="nav-tab" role="tablist">
    <a class="nav-item nav-link" href="./">Daftar Pesanan</a>
    <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Bayar Pesanan</a>
    <a class="nav-item nav-link "href="./create" >Tambah Pesanan</a>
    <a class="nav-item nav-link "href="./laporan" >Laporan</a>
  </div>
  </div>
</nav>
<div class="container">

<div class="row mt-3">
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-success   shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
            <div class="col mr-2">
                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Jumlah Uang</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">Rp.{{number_format($total)}} </div>
            </div>
            <img class="" style="width:120px; position:absolute; bottom: 1px;  right: 0px;" src="{{asset('unDraw/undraw_transfer_money_rywa.svg')}}" >               

            </div>
        </div>
        </div>
    </div>
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
            <div class="col mr-2">
                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Uang Masuk</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">Rp.{{number_format($sudah)}} </div>
            </div>
            <img class="" style="width:120px; position:absolute; bottom: -3px;  right: 2px;"  
            src="{{asset('unDraw/undraw_wallet_aym5.svg')}}" >               

            </div>
        </div>
        </div>
    </div>
<div class="col-xl-4 col-md-6 mb-4" id="belum_dibayars" style="cursor: pointer">
        <div class="card border-left-danger shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
            <div class="col mr-2">
                <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Uang Diluar</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">Rp.{{number_format($belum)}} </div>
            </div>
            <img class="" style="width:120px; position:absolute; bottom: 1px;  right: 10px;"   src="{{asset('unDraw/undraw_credit_card_payment_12va.svg')}}">               

            </div>
        </div>
        </div>
    </div>

</div>
</div>

@endsection
@section('main')
    <div class="container">
        


        <div class="row">   
            <div class="col-xl-5">

        <div class="card  buat_pesanan" id="tabel2" >
    <div class="card-header bg-success text-white">
        Bayar 
    </div>
    <div class="card-body">
            <form class="bsc-tbl-hvr" action="/pesanan/transaksi" method="POST">                
                    <input type="date" name="tanggal" value="{{date('Y-m-d')}}" class="form-control mt-3 mb-3" >
                    <table class="table table-hover table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Pesanan</th>
                            <th>Nominal uang</th>
                            <th>opsi</th>
                            </tr>
                        </thead>
                        <tbody class="form">
                            @csrf
                            @method('post')
                        </tbody>
                                <tr>
                                    <td><button class="btn btn-sm btn-success ">Bayar</button></td>
                                </tr>
                    </table>
            </form>
        </table>
    </div>
    </div>
    </div>
            <div class=" col-xl-7 col-md-6">
                    <div class="card">
                <div class="card-header bg-success text-white mb-3" >Daftar Pesanan</div
                    >
                    <div class="row container">
                     
                        <div class="col-6">
                        
                            <select name="" id="SELECT_DATE" class="form-control">
                                <option value="1">Tampilkan Semua</option>
                            <option value="{{date('Y-m-d')}}">Hari ini</option>
                                @foreach ($tanggal as $t)
                                <option value="{{$t->tanggal}}" {{$t->tanggal== $tanggal ?'selected':''}}>{{date('d F Y',strtotime($t->tanggal))  }}</option>        
                                @endforeach
                            </select>           
                        </div>
                    </div>
                <div class="card-body table-responsive">
                            <table class="table  table-hover data" id="tabel">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Pesanan</th>
                                            <th>Tanggal</th>
                                            <th>Harga</th>
                                            <th>Belum Dibayar</th>
                                            <th>opsi</th>
                                        </tr>
                                    </thead>
                                    <tbody class="FORM">
                                    @foreach ($pesanan as $pesan)
                                    <tr  class="{{$pesan->keuangan > 0?'activein':'hidenin'}} {{$pesan->id}} dateable" id="data_{{$pesan->id}}">
                                                <td  style="font-size: 14px">{{$loop->iteration}}</td>

                                            <td >{{$pesan->distributor->nama}}</td>
                                    <td   style="font-size: 12px"  class="{{$pesan->tanggal}} showAll">{{date('d F Y',strtotime($pesan->tanggal))}}</td>
                                            <td  class="nominal_uang">{{'Rp.'.number_format($pesan->total_harga())}}</td>
                                            @if ($pesan->keuangan==0)
                                            <td >Lunas</td>
                                @else
                                            <td >Rp.{{number_format($pesan->belumDibayar())}}</td>
                                            <td class="opsi" >
                                                <span class="btn btn-circle btn-sm btn-primary plus-ultra adder"><i class="fas fa-plus"></i></span>
                                                
                                            </td>
                                            @endif
                                        </tr>
                                            @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
            </div>
        </div>
@endsection
@section('script')
<script>
    // document.getElementById('belum_dibayars').addEventListener('click',function(){
    // [...document.querySelectorAll('.FORM .activein.dateable')].map(active=>
    // {
  

    //          document.querySelector('.form').insertRow().classList.add('here')
    //     document.querySelector('.here').innerHTML = `
    //                                     <td style='width: 60%'><select name='pesanan[]' class='form-control  pesananUltra'  >
    //                                     <option  class='here-option' value='${active.children[1]}'>${active.children[1].textContent}</option>
    //                                         </select>
    //                                     </td>
    //                                         <td style='width: 80%'>
    //                                             <input type='text'  class='form-control input-sm jumlah numberFormat' name='uang[]' value='${active.querySelector(".nominal_uang").textContent.substr(3)}' onclick="rp()" readonly>
    //                                         </td>
    //                                         <td style = 'width: 40%'> <span class ='trash-here btn btn-circle btn-sm btn-danger'
    //                                         onclick = "trash()" > <i class = 'fas  fa-trash' > </i></span >
    //                                         </td>`

    //     document.querySelector('.here').classList.add(active.id)
    //     document.querySelector('.here').classList.remove('here')
    //     active.classList.add('hidden');
    //     active.classList.replace('dateable', 'datenonable');


    // })
    // });
    
    let table_tr;
function trash() {


    [...document.querySelectorAll('.trash-here')].forEach(trsh => {
        trsh.addEventListener('click', function () {
            document.getElementById(this.parentNode.parentNode.classList[0]).classList.replace('datenonable', 'dateable')
            table_tr = this.parentNode.parentNode.classList[0];
            this.parentNode.parentNode.remove();
            document.querySelector('table.data tbody #' + table_tr).classList.remove('hidden')

        });
    });
}
    function rp()
    {
        [...document.querySelectorAll('.numberFormat')].forEach((a) => {
    a.addEventListener('keyup', function () {
        if (!this.value.match(/^[0-9]/g)) {
            this.value = "";
        } else {

            let pertiga = /\d{1,3}/g;
            var uang = this.value.split(',').join('').match(pertiga);
            if (this.value.length > 3) {

                if (uang[uang.length - 1].length == 1) {
                    this.value = uang.join('').substr(0, 1) + "," + uang.join('').substr(1).match(pertiga);
                }

                if (uang[uang.length - 1].length == 2) {
                    this.value = uang.join('').substr(0, 2) + "," + uang.join('').substr(2).match(pertiga);


                }
                if (uang[uang.length - 1].length == 3) {
                    this.value = uang.join('').substr(0, 3) + "," + uang.join('').substr(3).match(pertiga);

                }
            }
            if (uang.join('').length <= 3) {
                this.value = uang.join('');
            }

        }


    });

});

    }
</script>
<script src="{{ asset('js/mine/pesanan/switch2.js') }}"></script>
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
                        t.parentNode.classList.remove('hidden')
                }
                    )

            }

            [...document.querySelectorAll('.FORM tr.dateable')].
            filter(trr=>{      
          return  trr.children[2].classList[0]!=tanggal && trr.classList[2]!='datenonable'})
            .map(trr=>{
                    trr.classList.add('hidden')
                    trr.children[2].classList.add('sembunyi')}
        )
        }else{
         [...document.querySelectorAll('.FORM tr')].filter(trr=>trr.classList[2]=='dateable').map(trr=>{
             trr.classList.remove('hidden')
             trr.children[2].classList.remove('sembunyi')})
        }
        });

  document.addEventListener('keydown',function(e){
    if(e.key=="b" && e.ctrlKey){
        document.location.href="/pesanan/bayar";
    }
})

    </script>
   
@endsection
