@extends('layouts.master')
@section('main')
<h1 class="h3 mb-3   text-gray-800"> Pesanan</h1>
<nav>
  <div class="nav nav-tabs" id="nav-tab" role="tablist">
    <a class="nav-item nav-link " href="./">Daftar Pesanan</a>
    <a class="nav-item nav-link" href="./bayar">Bayar Pesanan</a>
    <a class="nav-item nav-link active"aria-selected="true" >Tambah Pesanan</a>
    <a class="nav-item nav-link" href="./laporan">Laporan</a>
  </div>
</nav>
<div class="card">
  <h5 class="card-header bg-success text-white">Pesanan</h5>
  <div class="card-body">
      @if ($toko==1)
          
    <form class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-submit" action="/pesanan" method="post">
             @csrf
                @method('post')
                <div class="row">
                    <div class="col-6" id="distributor_field">
                        <div class="form-group">
                            <label for="">Pemesan</label>
                            <div class="input-group">
                                        <select class="form-control" id="distributor" name="nama" onchange="cange('distributor')">
                                @foreach ($distributor as $d)
                                <option value="{{$d->id}}">{{$d->nama}}</option>
                                @endforeach
                                <option value="0">--Input Manual--</option>
                            </select>
                                        <input type="text" class="form-control hidden">
                            </div>
                        
                            
                    </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="">Tanggal Pesanan</label>
                           <input type="date" name="tanggal" id="" class="form-control" value="{{date('Y-m-d')}}">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-3">
                        <div class="form-group">
                            <label for="">Jumlah Pesanan</label>
                            <input autocomplete="off" type="text" class="form-control kuantitas-input" name="kuantitas" placeholder="Jumlah Pesanan">
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label for="">Harga Satuan</label>  <input autocomplete="off" type="text" class="form-control numberFormat harga-input" name="harga" placeholder="Harga satuan" value="{{$sotong}}" required>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label for="">Biaya Akomodasi</label>  <input autocomplete="off" type="text" class="form-control numberFormat akomodasi-input" name="akomodasi" placeholder="Biaya Akomondasi" value="0">
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label for="">Total Harga</label> 
                        <input autocomplete="off" readonly type="text" class="form-control numberFormat total-input"  name="total"  value="0" >

                        </div>
                    </div>
                </div>
                <div class="row" style="float: right;">

                    <button class="btn btn-success  mr-2" id="pesan" >Buat Pesanan</button>
                    <button class="btn btn-success" id="tampung">Tampung Pesanan</button>         
                </div>

            </form>
            @else
            <div class="alert alert-danger" role="alert">
 Toko Sedang tupup.Tidak Menerima Pesanan
</div>
      @endif

        </div>
    </div>

                


@endsection

@section('script')


<script src="{{ asset('js/mine/rp.js') }}">
</script>
<script src="{{ asset('js/mine/tolha.js') }}"></script>
<script>
    const form =document.querySelector('.form-submit');
    const pesan =document.getElementById('pesan');
    const tampung =document.getElementById('tampung');
    pesan.addEventListener('click',function(e){
        form.setAttribute('action','/pesanan/store/create')
    })
    tampung.addEventListener('click',function (e){
        form.setAttribute('action','/pesanan/store')
    })
    form.addEventListener('submit',function(e){
        if(this.getAttribute('action')=='/pesanan'){
            e.preventDefault() ;
        }

    })
    const distributor=document.getElementById('distributor');
    const distributor_field=document.getElementById('distributor_field');
function cange(e){
    if(e=="distributor"){
        if(distributor.value==0)
        {

            distributor_field.querySelector('input').classList.remove('hidden')
            distributor_field.querySelector('input').value="";
            distributor_field.querySelector('input').setAttribute("name","pemesan");
        }else{
            if(distributor_field.querySelectorAll('.hidden').length==0) {
            distributor_field.querySelector('input').classList.add('hidden')
            distributor_field.querySelector('input').setAttribute("name","");
            }   

        }
    }

}

</script>
@endsection