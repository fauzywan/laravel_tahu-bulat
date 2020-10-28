@extends('layouts.not_sidebar')
@section('navbar')
    <a href="/gudang">
        <i class=" btn-circle fas fa-arrow-left"></i>Back    
    </a>
@endsection
@section('top-main')
   <nav class="mb-2">
                              <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                <a class="nav-item nav-link o" href="/gudang">Gudang</a>
                                <a class="nav-item nav-link text-inf active">Belanja</a>
                                <a class="nav-item nav-link text-inf " href="/pengeluaran">Pengeluaran</a>
                                <a class="nav-item nav-link text-inf" href="belanja/histori">Histori Belanja</a>
                                <a class="nav-item nav-link text-inf" href="pengeluaran/histori">Histori pengeluaran</a>
                                <a class="nav-item nav-link text-inf " href="/belanja/hutang"   >Hutang Pembelanjaan</a>
                                {{-- <a class="nav-item nav-link" id="nav-contact-tab" >Contact</a> --}}
                              </div>
                            </nav>

@endsection
@section('main')
   
        <div class="row">   
            <div class=" col-xl-12 col-md-12">
                    <div class="card">
                <div class="card-header bg-success text-white mb-3" >Daftar Pesanan</div
                    >
              
                <div class="card-body">
                             <form action="{{url('belanja/store')}}" method="POST" style="margin: 0 0 30px 0;">                                    
                                        @method('post')
                                        @csrf
                                        <div class="row">

                                        <div class="col-xl-4 col-md-6 col-xs-12 mb-3">

                                            <input autocomplete="off" type="date" class="form-control input-sm" name="tanggal" value="{{date('Y-m-d')}}">
                                        </div>
                                        <div class="col-xl-4 col-md-6 col-xs-12 mb-3">
                                            <select name="suplier[]" style="font-size:13px" class="form-control">
                                                            @foreach ($suplier as $s)
                                                        <option value="{{$s->id}}">{{$s->nama}}</option>
                                                            @endforeach
                                                        </select>
                                        </div>
                                        <div class="col-xl-4 col-md-6 col-xs-12 mb-3">
                                            <td style="width: 13%;" ><input autocomplete="off" style="font-size:13px" type="text" class=" form-control input-sm" name="faktur[]" placeholder="Nomor Faktur" ></td>
                                        </div>
                                        
                                        </div>
                                        <div class="table-responsive ">
                                            <table class="table  table- notRedy">
                                                <thead style="text-align:center">
                                                    <th>Barang</th>
                                                    <th>Kuantitas</th>
                                                    <th>Harga satuan</th>
                                                    <th>Harga</th>
                                                    <th>Dibayar</th>
                                                    <th>Opsi</th>
                                                </thead>
                                                <tbody class="add" >
                                                    
                                                    @foreach ($produksi as $p)    
                                                  
                                                    @if ($p->tersedia()<$p->kuantitas && $p->kuantitas!=0)
                                                        
                                                    <tr>
                                                        <td style="width: 12%;font-size:13px"> 
                                                        <select name="barang[]" style="font-size:13px" class="form-control select selek-{{$loop->iteration}}" onchange="cange('selek-{{$loop->iteration}}')">
                                                            @foreach ($produksi as $pd)
                                                        <option class="produk-{{$pd->id}}" data-belanja="{{$pd->kuantitas-$pd->tersedia()}}" value="{{$pd->id}}" {{$pd->id==$p->id?'selected':''}}>{{$pd->nama}}</option>
                                                            @endforeach
                                                        </select>
                                                    </td>    
                                                
                                                  
                                               
                                            
                                                    <td style="width: 13%"><input autocomplete="off" style="font-size:13px" type="text" class="kuantitas-input form-control input-sm" name="kuantitas[]"  onkeyup="qyt();" value="{{isset($p->belanja)?$p->kuantitas - $p->tersedia():''}}"></td>
                                                            
                                             
                                                <td><input autocomplete="off" type="text" style="font-size:13px" class="harga-input form-control input-sm numberFormat" name="harga[]"  onkeyup="rp();hg()"></td >
                                                    
                                                    <td>
                                                        <input autocomplete="off" type="text" style="font-size:13px" readonly class="total-input form-control input-sm numberFormat" name="total[]" onkeyup="rp();" value="0"></td>

                                                <td>
                                                    <div class="row " style="display: flex;flex-direction: row;justify-content: center">
                                                        <input autocomplete="off" type="text" style="font-size:13px" class="form-control   dibayar-input input-sm numberFormat hidden" name="dibayar[]" onkeyup="rp();" value="0">
                                                            <a    style="cursor: pointer" class="btn " ><input type="checkbox" class="cekbox"</a>
                                                                               
                                                                            
                                                    </div>
                                                </td>
                                                        
                                                        <td class="remove text-white">
                                                            
                                                    <a    style="cursor: pointer" class="remove-tr btn btn-sm btn-circle btn-danger"><i class="fas fa-trash remove"></i></a>
                                                </td>
                                            </tr>
                                                    @endif  
                                                    @endforeach
                                        </tbody>
                                        <tr>
                                            <td colspan="5">
                                            </td>
                                            <td>
                                                <span id="add" class="btn btn-sm btn-primary waves-effect"><i class="fa fa-plus" ></i></span>
                                            </td>
                                        </tr>
                                            <tr class=" hiddem">
                                                <th  colspan="3"> <h5 style="float: right">Total Harga</h4></th>
                                                <td colspan="3" >
                                                    <input autocomplete="off" type="text" style="height: 35px"   readonly    name="jumlah" class="form-control harus-bayar" id="bayars_field">
                                                </td>
                                            </tr>
                                            <tr class=" hiddem">
                                                <th  colspan="3"> <h5 style="float: right">Dibayar </h4></th>
                                                <td colspan="3" >
                                                    <input autocomplete="off" type="text" style="height: 35px"   readonly    name="bayars" class="form-control" id="dibayar_field">
                                                </td>
                                            </tr>
                                            <tr class=" hiddem">
                                                <th  colspan="3"> <h5 style="float: right">Hutang</h4></th>
                                                <td colspan="3" >
                                                    <input autocomplete="off" type="text" style="height: 35px"   readonly    name="hutang" class="form-control " id="hutang_field">
                                                </td>
                                            </tr>
                                      
                                        </table>
                                        <button type="submit"  class="float-right m-2 btn btn-success belanja total_btn" >Simpan</button>
                                        <a  class="float-right mt-3 btn btn-info belanja text-white total_btn" id="total_btn"><i class="fas fa-fw fa-info"></i></a>
                                    </form> 
                            </div>
                        </div>
            </div>
        </div>
@endsection
{{-- @section('main')
<div class="row">  
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="widget-tabs-int tab-ctm-wp ">
                            <div class="tab-hd">
                                <div class="breadcomb-wp">
                                    <div class="breadcomb-icon">
                                        <a href="/belanja/histori"><i class="notika-icon notika-edit"></i></a>
                                    </div>
                                    <div class="breadcomb-ctn">
                                        <h2>Belanja</h2>
                                    </div>
                                </div>
                            </div>
            <div class="widget-tabs-list">    
                            <ul class="nav nav-tabs tab-nav-right">
                                <li class=""><a  href="/gudang">Gudang</a></li>
                                <li class="active"><a>belanja</a></li>
                                <li class=""style="float: left"><a href="/belanja/histori" >Riwayat Pembelanjan</a></li>
                                <li class=""style="float: left"><a href="/belanja/hutang" >Hutang</a></li>
                            </ul>
                            </ul>
                <div class="tab-content tab-custom-st tab-ctn-right">
                    <div id="home2" class="tab-pane fade in active">
                        <div class="tab-ctn">
                            <div class="bsc-tbl-hvr">
                                <div class="inbox-text-list" style="padding: 0 0 10px 0;">
                                    <div class="form-group">
                                    </div>
                                    <div class="inbox-btn-st-ls btn-toolbar">
                                        <div class="btn-group ib-btn-gp active-hook nk-act nk-email-inbox ">
                                            <button id="add" class="btn btn-default btn-sm waves-effect"><i class="notika-icon notika-plus-symbol" ></i></button>
                                            <button id="minus" class="btn btn-default btn-sm waves-effect"><i class="notika-icon notika-minus-symbol" ></i></button>
                                        </div>
                                    </div>
                                  
                                </div>
                            </div>
                         </div>
                    </div>                            
                </div>
            </div>
        </div>        
    </div>
</div>    
@endsection --}}
@section('script')
<script>
const ubah=document.querySelector('.ubah')
const fData=document.querySelector('.fData li p')


/* ubah.addEventListener('click',function(){

//     // document.querySelector('form').classList[1].remove('hide','form')
//     if(document.querySelector('form').classList[1]=="hide")
//     {
//     document.querySelector('form').classList.remove('hide')
//     document.querySelector('form').classList.add('hiden')
//     ubah.textContent='Batal';
//     fData.classList.add('hide')
//     }else{
//     document.querySelector('form').classList.add('hide')
//     document.querySelector('form').classList.remove('hiden')
//     ubah.textContent='Atur';
//     fData.classList.remove('hide')
//     }
//     // document.querySelector('form').classList[1].replace('hide')
})
*/ 


 </script>
<script>
    const form=document.querySelector('form');
    form.addEventListener('submit',function(e){
        if(this.querySelector('.add tr')==null){

        e.preventDefault()
        }
    })
    const belanja=document.querySelector('.belanja');
    belanja.addEventListener('click',function(e){
        if(this.parentNode.querySelector('.add tr')==null){
        e.preventDefault();
        }
    })
    function cange(el)
    {
        document.querySelector('.'+el).parentNode.parentElement.querySelector('.kuantitas-input').value=
        document.querySelector('.'+el).querySelector('.produk-'+document.querySelector('.'+el).value).dataset.belanja
    }
</script>

<script src="{{asset('js/mine/belanja/belanja.js')}}"></script> 

 {{-- <script src="{{ asset('js/mine/belanja/tolha.js') }}"></script>  --}}
 
@endsection