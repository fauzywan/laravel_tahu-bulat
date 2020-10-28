@extends('layouts.master')
@section('main')
    <div class="row">
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

               <div class="col-xl-4 col-md-6 mb-4"id="lunasi" style="cursor: pointer">
                <div class="card border-left-primary   shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1" >Nominal Uang</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800" id="dibayar">Rp.{{number_format($pesanan->harus_dibayar())}}</div>
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
                      <div class="h5 mb-0 font-weight-bold text-gray-800">{{date('d F Y',strtotime($pesanan->tanggal))}}</div>
                    </div>
                    <img class="" style="width:110px; position:absolute; bottom: 0;  right: 0px;"  src="{{asset('unDraw/2.svg')}}">               

                  </div>
                </div>
              </div>
            </div>

          </div>
          <div class="row">
               <div class="col-xl-4 col-md-6">
        <div class="card mb-3">
            <div class="card-header bg-warning text-white">
                Detail Pesanan
            </div>
            <ul class="list-group list-group-flush">
            <li class="list-group-item">Pemesan : <b style="font-size: 13px">{{$pesanan->distributor->nama}}<br>{{$pesanan->distributor->pemilik==""?'':'('.$pesanan->distributor->pemilik.')'}}</b></li>
                <li class="list-group-item">Alamat : <b>{{$pesanan->distributor->alamat}}</b></li>
                <li class="list-group-item">Nomor Telepon  : <b>{{$pesanan->distributor->telepon}}</b></li>
                <li class="list-group-item">Harga : <b>Rp.{{number_format($pesanan->harga)}}</b></li>
                <li class="list-group-item">Biaya Akomodasi : <b>Rp.{{number_format($pesanan->biaya_akomodasi)}}</b></li>
            </ul>
        </div>
    </div>
               <div class="col-xl-8 col-md-8">
        <div class="card mb-3">
            <div class="card-header bg-success text-white">
                Bayar Pesanan
            </div>
            <div class="card-body">
                <form action="" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="uang">Nominal Uang</label>
                        <input type="text" class="form-control numberFormat" name="uang" id="uang">
                    </div>
       
                    <div class="form-group">
                        <label for="tanggal">Tanggal Transaksi</label>
                    <input type="date" class="form-control numberFormat" name="tanggal" id="tanggal" value="{{date('Y-m-d')}}">
                    </div>
       
                    <button type="submit" style="float:right" class="btn btn-success">Bayar</button>
                </form><div class="" >

                    <a href="/pesanan" class="btn btn-danger" >Tidak Sekarang</a>
                </div>
            </div>
        </div>
    </div>
</div>
              
              
@endsection
@section('script')
    <script src="{{ asset('js/mine/rp.js') }}"></script>

    <script>
        let money;
        let pertiga ;
        const uang=document.getElementById('uang');
        const dibayar=document.getElementById('dibayar');
        const lunasi =document.getElementById('lunasi')
        lunasi.addEventListener('click',function(){
                uang.value=dibayar.textContent.substr(3)
        })
        uang.addEventListener('keyup',function()
        {money=this.value;
            pertiga== /\d{1,3}/g;
            if(this.value.length>3){
                money=this.value.split(',').join('')
            }
             if(parseInt(money)>parseInt(dibayar.textContent.substr(3).split(',').join(''))){
               money=money.substr(0, parseInt(dibayar.textContent.substr(3).split(',').join('').length-1))
             };
             if(money.length>3 && money.length>0){
             money=money.match(pertiga)
            if (money[money.length - 1].length == 1) {
                    this.value = money.join('').substr(0, 1) + "," + money.join('').substr(1).match(pertiga);
                }

                if (money[money.length - 1].length == 2) {
                    this.value = money.join('').substr(0, 2) + "," + money.join('').substr(2).match(pertiga);


                }
                if (money[money.length - 1].length == 3) {
                    this.value = money.join('').substr(0, 3) + "," + money.join('').substr(3).match(pertiga);

                }
             }

        })
    </script>
@endsection