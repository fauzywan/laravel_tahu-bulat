@extends('layouts.master')
@section('top-main')    
        
<div class="invoice-img" style="margin-left:15px;">
                          <p style="color: white"> Sediakan  Uang Minimal</p>
<h3 class=".sediakanUang" style="color: white">Rp.{{number_format($belanja->sum('harga'))}}</h3>
                        </div>
@endsection
@section('main')

<div class="inbox-area">
        <div class="container">
            <div class="row">
                 <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="width:98.6%">
                    <div class="inbox-text-list sm-res-mg-t-30">
                            <div class="breadcomb-wp">
                                <div class="breadcomb-icon">
                                    <i class="notika-icon notika-edit"></i>
                                </div>
                                <div class="breadcomb-ctn">
                                    <h2>Belanja</h2>
                                    <p>Pengolahan<span class="bread-ntd">Pembelanjaan</span></p>
                                </div>
                            </div>
                            
                        <div class="form-group">
                        </div>
                        <div class="inbox-btn-st-ls btn-toolbar">
                
                            <div class="btn-group ib-btn-gp active-hook nk-act nk-email-inbox ">
                                <button id="add" class="btn btn-default btn-sm waves-effect"><i class="notika-icon notika-plus-symbol" ></i></button>
                                <button id="minus" class="btn btn-default btn-sm waves-effect"><i class="notika-icon notika-minus-symbol" ></i></button>
                            </div>
                        </div>
                    <form action="{{url('belanja/gudang')}}" method="POST">                                    
                        @method('post')
                        @csrf
                        <div class="table-responsive ">
                            <table class="table table-hover table-inbox notRedy">
                               <thead>
                                   <th>#</th>
                                   <th>Kuantitas</th>
                                   <th>No.Faktur</th>
                                   <th>Suplier</th>
                                   <th>harga</th>
                                   <th>Total</th>
                                   <th>dibayar</th>
                                </thead>
                                <tbody class="add">
                                    @foreach ($belanja as $b)
                                    <tr>
                                        <td style="width: 15%">
                                            <select name="barang[]" class="form-control">
                                                @foreach ($produksi as $p)
                                                <option value="{{$p->id}}"{{$p->id==$b->id?'selected':''}}>{{$p->nama}}</option>
                                                @endforeach
                                            </select>
                                        </td>    
                                        <hr>

                                    <td style="width:10%"><input type="text" class="kuantitas-input form-control input-sm" name="kuantitas[]" placeholder="Qty"value="{{$b->kuantitas}}"></td>
                                    
                                    <td style="width: 15%">
                                        <input type="text" name="faktur" class="form-control input-sm">
                                        <input type="date"  onkeyup="hs();rp()" class="harga-input numberFormat form-control input-sm hide" name="tanggal[]" placeholder="Harga Satuan" value="{{$b->tanggal_belanja}}">
                                    </td>

                                        <td style="width:15%">
                                             <select name="suplier[]" class="form-control" name="suplier[]">
                                                @foreach ($suplier as $s)
                                            <option value="{{$p->id}}">{{$s->nama}}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                    <td style="width:13%"><input type="text" onkeyup="hs();rp()" class="harga-input numberFormat form-control input-sm " name="harga[]" placeholder="Harga Satuan" value="{{number_format($b->harga_satuan)    }}"></td>

                                        <td style="width:13%"><input type="text" class="total-input form-control input-sm numberFormat" name="total[]" placeholder="Total Harga" onkeyup="rp()" value="{{number_format($b->harga)}}"></td>

                                        <td style="width:13%"><input type="text" class="total-input form-control input-sm numberFormat" name="dibayar[]" placeholder="Total Harga" onkeyup="rp()" value="{{number_format($b->harga)}}"></td>

                                        <td class="remove text-right btn btn-danger btn-sm waves-effect"><i class="notika-icon notika-trash remove"></i></td>
                                    </tr>
                                    @endforeach
                    <tr class="next"></tr>
                            </tbody>                              
                            </table>
                            <tr>
                                <td style="width:13%"><button class="btn btn-success" type="submit">Simpan</button></td>
                            </form> 
                        <form action="{{url('belanja/gagal')}}" method="POST" style="display: inline">
                            @csrf
                            @method('post')

                                <td style="width:13%"><button class="btn btn-success" type="submit">Batal</button></td>
                            </form>
                            </tr>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
<script>
const ubah=document.querySelector('.ubah')
const fData=document.querySelector('.fData li p')

// ubah.addEventListener('click',function(){

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
// })
 </script> 
 <script src="{{ asset('js/mine/belanja/tolha.js') }}"></script>
 <script src="{{ asset('js/mine/belanja/add2.js') }}"></script>
@endsection