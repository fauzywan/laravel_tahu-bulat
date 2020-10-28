@extends('layouts.master')
@section('navbar')
     <a href="/belanja">
        <i class=" btn-circle fas fa-arrow-left"></i>Back    
    </a>
@endsection
@section('top-main')
    <h1 class="h3 mb-3   text-gray-800"> Hutang</h1>
        <nav class="mb-2">
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <a class="nav-item nav-link o" href="/gudang">Gudang</a>
                    <a class="nav-item nav-link text-inf " href="/belanja">Belanja</a>
                    <a class="nav-item nav-link text-inf " href="/pengeluaran">Pengeluaran</a>
                    <a class="nav-item nav-link text-inf" href="/belanja/histori">Histori Belanja</a>
                    <a class="nav-item nav-link text-inf" href="/pengeluaran/histori">Histori pengeluaran</a>
                    <a class="nav-item nav-link text-inf active" >Hutang Pembelanjaan</a>
                    {{-- <a class="nav-item nav-link" id="nav-contact-tab" >Contact</a> --}}
                    </div>
                </nav>

<div class="row mt-3">
<div class="col-xl-4 col-md-6 mb-4" id="belum_dibayars" style="cursor: pointer">
        <div class="card border-left-danger shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
            <div class="col mr-2">
                <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Belum Dibayar</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">Rp.{{number_format($jumlah_hutang)}} </div>
            </div>
            <img class="" style="width:120px; position:absolute; bottom: 1px;  right: 10px;"   src="{{asset('unDraw/undraw_credit_card_payment_12va.svg')}}">               

            </div>
        </div>
        </div>
    </div>

</div>
@endsection
@section('main')
    <div class="row">
        

    </div>

        <div class="row">   
            <div class="col-xl-5">

        <div class="card  buat_pesanan" id="tabel2" >
    <div class="card-header bg-success text-white">
        Bayar 
    </div>
    <div class="card-body  table-responsive">
            <form class="bsc-tbl-hvr " action="" method="POST">                
                    <input type="date" name="tanggal" value="{{date('Y-m-d')}}" class="form-control mt-3 mb-3" >
                    <table class="table table-hover">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Hutang</th>
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
                <div class="card-header bg-success text-white mb-3" >Daftar Hutang</div
                    >
                    <div class="row">
                        <div class="col-5" style="margin-left:10px ">
                        
                        </div>
                        <div class="col-6">
                            <select name="" id="SELECT_DATE" class="form-control">
                                <option value="1">Tampilkan Semua</option>
                                @foreach ($tanggal as $t)
                                <option value="{{date('Y-m-d',strtotime($t->created_at))}}">{{date('d F Y',strtotime($t->created_at))  }}</option>        
                                @endforeach
                            </select>           
                        </div>
                    </div>
                <div class="card-body table-responsive">
                            <table class="table  table-hover data" id="tabel">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Barang</th>
                                            <th>Suplier</th>
                                            <th>Tanggal</th>
                                            <th>Belum Dibayar</th>
                                            <th>opsi</th>
                                        </tr>
                                    </thead>
                                    <tbody class="FORM" >
                                    @foreach ($hutang as $h)
                                    <tr class="{{$h->status > 0?'activein':'hidenin'}} {{$h->id}} dateable" id="data_{{$h->id}}">
                                                <td>{{$loop->iteration}}</td>

                                            <td >{{$h->biaya_produksi->nama}}</td>
                                            <td >{{$h->suplier->nama}}</td>
                                    <td   class="{{date('Y-m-d',strtotime($t->created_at))}} showAll">{{date('d F Y',strtotime($h->created_at))}}</td>
                                    {{-- <td >Rp.{{number_format($h->harga)}}</td> --}}
                                    @if ($h->hutang==0)
                                    <td >Lunas</td>
                                    @else
                                    
                                    <td  class="nominal_uang">{{'Rp.'.number_format($h->harga-$h->transaksi_belanja->sum('nominal_uang'))}}</td>
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
    document.getElementById('belum_dibayars').addEventListener('click',function(){
    [...document.querySelectorAll('.FORM .activein.dateable')].map(active=>
    {
  

             document.querySelector('.form').insertRow().classList.add('here')
        document.querySelector('.here').innerHTML = `
                                        <td style='width: 60%'><select name='hutang[]' class='form-control  pesananUltra'  >
                                        <option  class='here-option' value='${active.children[1]}'>${active.children[1].textContent}</option>
                                            </select>
                                        </td>
                                            <td style='width: 80%'>
                                                <input type='text' class='form-control input-sm jumlah numberFormat' name='uang[]' value='${active.querySelector(".nominal_uang").textContent.substr(3)}' onclick="rp()">
                                            </td>
                                            <td style = 'width: 40%'> <span class ='trash-here btn btn-circle btn-sm btn-danger'
                                            onclick = "trash()" > <i class = 'fas  fa-trash' > </i></span >
                                            </td>`

        document.querySelector('.here').classList.add(active.id)
        document.querySelector('.here').classList.remove('here')
        active.classList.add('hidden');
        active.classList.replace('dateable', 'datenonable');


    })
    });
    const form = document.querySelector('.form');
const opsi = document.querySelectorAll('.activein .opsi');
let parn;
let jumlah;

[...opsi].map(ops => {
    ops.querySelector('.adder').addEventListener('click', function () {
        let parn = (this.parentNode.parentNode);
        form.insertRow().classList.add('here')
        document.querySelector('.here').innerHTML = `
                                        <td style='width: 60%'><select name='hutang[]' class='form-control  pesananUltra'  id=''>
                                        <option  class='here-option' value='${parn.classList[1]}'>${parn.children[1].textContent}</option>
                                            </select>
                                        </td>
                                            <td style='width: 80%'>
                                                <input type='text' class='form-control input-sm jumlah numberFormat' name='uang[]' value='${parn.children[4].textContent.substr(3)}' onclick="rp()">
                                            </td>
                                            <td style = 'width: 40%'> <span class ='trash-here btn btn-circle btn-sm btn-danger'
                                            onclick = "trash()" > <i class = 'fas  fa-trash' > </i></span >
                                            </td>`

        document.querySelector('.here').classList.add(parn.id)
        document.querySelector('.here').classList.remove('here')
        parn.classList.add('hidden');
        parn.classList.replace('dateable', 'datenonable');



    });
});

    
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
          return  trr.children[3].classList[0]!=tanggal && trr.classList[2]!='datenonable'})
            .map(trr=>{
                    trr.classList.add('hidden')
                    trr.children[3].classList.add('sembunyi')}
        )
        }else{
         [...document.querySelectorAll('.FORM tr')].filter(trr=>trr.classList[2]=='dateable').map(trr=>{
             trr.classList.remove('hidden')
             trr.children[3].classList.remove('sembunyi')})
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
    //                             document.querySelector('.sedang_buat').classList.remove('hidden');
    //     document.querySelector('.form_data').classList.add('hidden');

    //     if (document.querySelectorAll('.form tr').length > 0) {
    //         [...document.querySelectorAll('.form tr')].map(tr => tr.remove())
    //     }
    //     [...document.querySelectorAll('.opsi')].map(ops => {
    //         if (ops.parentNode.classList[0] != 'activein') {
    //             ops.parentNode.classList.add('hidden')
    //         }
    //         ops.children[0].classList.add('hidden');
    //         ops.children[1].classList.remove('hidden');
    //     });
    //                 }
    //                 else{
    //                     document.querySelector('.checkedIn').checked=false;
    //                       document.querySelector('.form_data').classList.remove('hidden');
    //     document.querySelector('.sedang_buat').classList.add('hidden');
    
    //     [...document.querySelectorAll('.opsi')].map(ops => {
    
    //         if (ops.parentNode.classList[0] != 'activein') {
    //             ops.parentNode.classList.remove('hidden')
    //         }
    //         ops.children[0].classList.remove('hidden')
    //         ops.children[1].classList.add('hidden')
    //     });
    //                     [...document.querySelectorAll('.hiddennIn')].map(hid => {
    //         hid.classList.replace('hiddennIn', 'activein')
    //     });
                        
    //                 }
                
    //         }
            
    //     });
    //     </script>
   
@endsection
