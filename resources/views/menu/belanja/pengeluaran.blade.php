@extends('layouts.not_sidebar')
@section('navbar')
    <a href="/gudang">
        <i class=" btn-circle fas fa-arrow-left"></i>Back    
    </a>
@endsection
@section('top-main')
    <nav class="mb-2">
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <a class="nav-item nav-link o " href="/gudang">Gudang</a>
            <a class="nav-item nav-link text-inf "href="/belanja">Belanja Bahan</a>
            <a class="nav-item nav-link text-inf active" >Pengeluaran</a>
            <a class="nav-item nav-link text-inf " href="/belanja/histori">Histori Belanja</a>
            <a class="nav-item nav-link text-inf " href="/pengeluaran/histori">Histori Pengeluaran</a>
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
                             <form action="{{url('pengeluaran/store')}}" method="POST" style="margin: 0 0 30px 0;">                                    
                                        @method('post')
                                        @csrf
                                        <div class="row">

                                        <div class="col-xl-4 col-md-6 col-xs-12 mb-3">

                                            <input autocomplete="off" type="date" class="form-control input-sm" name="tanggal" value="{{date('Y-m-d')}}">
                                        </div>
                                        <div class="col-xl-4 col-md-6 col-xs-12 mb-3">
                                            <select name="suplier" style="font-size:13px" class="form-control">
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
                                            <table class="table  table-bordered notRedy">
                                                <thead style="text-align:center">
                                                    <th>Pembelian</th>
                                                    <th>Harga</th>
                                                    <th>Dibayar</th>
                                                    <th>Opsi</th>
                                                </thead>
                                                <tbody class="add" >
                                                    <tr>
                                                <td>
                                                    <select name="barang[]" class="form-control">
                                                        @foreach ($barang as $b)
                                                    <option value="{{$b->id}}">{{$b->nama}}</option>
                                                        @endforeach
                                                    </select>
                                                </td >
                                                <td><input autocomplete="off" type="text" style="" class="harga-input form-control input-sm numberFormat" name="harga[]"  onkeyup="rp();hg()"></td >
                                           
                                                <td>
                                                    <div class="row " style="display: flex;flex-direction: row;justify-content: center">
                                                        <input autocomplete="off" type="text" style="" class="form-control   dibayar-input input-sm numberFormat hidden" name="dibayar[]" onkeyup="rp();" value="0">
                                                            <a    style="cursor: pointer" class="btn " ><input type="checkbox" class="cekbox"</a>
                                                                               
                                                                            
                                                    </div>
                                                </td>
                                                        
                                                        <td class="remove text-white">
                                                            
                                                    <a    style="cursor: pointer" class="remove-tr btn btn-sm btn-circle btn-danger"><i class="fas fa-trash remove"></i></a>
                                                </td>
                                            </tr>
                                        </tbody>
                                        <tr>
                                            <td colspan="3">
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
                                        <button type="submit"  class="float-right m-2 btn btn-success belanja" >Simpan</button>
                                        <a  class="float-right mt-3 btn btn-info belanja text-white total_btn" id="total_btn"><i class="fas fa-fw fa-info"></i></a>
                                    </form> 
                            </div>
                        </div>
            </div>
        </div>
@endsection

@section('script')
<script>
    const total = document.querySelectorAll(".total_btn");
const add = document.getElementById("add");
const next = document.querySelector(".add");
let total_input;
let aray = [];
let okane;
[...total].map(total=>{
    total.addEventListener("click", function () {
    // document.querySelectorAll('.hiddem').forEach((e) => {
    //     if (e.classList[0] == 'hidden') {

    //         e.classList.remove('hidden')
    //     }
    // });
    [...document.querySelectorAll(".harga-input")].forEach((a, b) => {
        if (a.value.length > 3) {
            aray[b] = parseInt(a.value.split(",").join(""));
        } else {
            aray[b] = parseInt(a.value);
        }
    });

    okane = aray.reduce((a, b) => {
        return a + b;
    });
    okane = Rupiah(okane.toString());
    document.getElementById("bayars_field").value = okane;
    aray = [];
    //Dibayar
    [...document.querySelectorAll(".dibayar-input")].forEach((a, b) => {
        if (a.value.length > 3) {
            aray[b] = parseInt(a.value.split(",").join(""));
        } else {
            aray[b] = parseInt(a.value);
        }
    });
    okane = aray.reduce((a, b) => {
        return a + b;
    });
    okane = Rupiah(okane.toString());
    document.getElementById("dibayar_field").value = okane;
    //Hutang
    if (document.getElementById("bayars_field").value.length > 3) {

        okane = document.getElementById("bayars_field").value.split(',').join('');
    } else {
        okane = document.getElementById("bayars_field").value;

    }
    console.log(document.getElementById("dibayar_field").value.split(',').join(''))
    if (document.getElementById("dibayar_field").value.length > 3) {
        okane = okane - document.getElementById("dibayar_field").value.split(',').join('')
    } else {
        okane = okane - document.getElementById("dibayar_field").value
    }
    okane = Rupiah(okane.toString())
    document.getElementById("hutang_field").value = okane;

});
let el;
add.addEventListener("click", function () {
    el=`<tr>
                                                <td><select name="barang[]" class="form-control">
                                                        @foreach ($barang as $b)
                                                    <option value="{{$b->id}}">{{$b->nama}}</option>
                                                        @endforeach
                                                    </select></td >
                                                <td><input autocomplete="off" type="text" style="" class="harga-input form-control input-sm numberFormat" name="harga[]"  onkeyup="rp();hg()"></td >
                                           
                                                <td>
                                                    <div class="row " style="display: flex;flex-direction: row;justify-content: center">
                                                        <input autocomplete="off" type="text" style="" class="form-control   dibayar-input input-sm numberFormat hidden" name="dibayar[]" onkeyup="rp();" value="0">
                                                            <a    style="cursor: pointer" class="btn " ><input type="checkbox" class="cekbox"</a>
                                                                            
                                                    </div>
                                                </td>
                                                        
                                                        <td class="remove text-white">
                                                            
                                                    <a    style="cursor: pointer" class="remove-tr btn btn-sm btn-circle btn-danger"><i class="fas fa-trash remove"></i></a>
                                                </td>
                                            </tr>`
        next.insertRow().classList.add("next");
        next.querySelector(".next").innerHTML = el;
        // next.querySelector(".next").querySelector('.select').classList.add(`selek-${document.querySelectorAll('.select').length+1}`)
        // next.querySelector(".next").querySelector('.select').setAttribute('onchange', "cange('selek-" +
        //     (document.querySelectorAll('.select').length + 1) +
        //     "')")
        document.querySelector(".next").classList.remove("next");
});
document.addEventListener("click", function (e) {
    if (e.target.classList[2] == "remove") {
        e.target.parentNode.parentNode.parentNode.remove();
    }
    if (e.target.classList[0] == "remove-tr") {
        // jumlah = e.target.parentNode.parentNode.querySelector(".total-input")
        //     .value;
        e.target.parentNode.parentNode.remove();
    }
    if (e.target.classList[0] == "cekbox") {
        if (e.target.parentNode.parentNode.children[0].value.length > 0) {
            if (
                e.target.parentNode.parentNode.children[0].value != 0

            ) {


                if (e.target.checked == true) {

                    if (e.target.parentNode.parentNode.parentNode.parentNode.querySelector('.dibayar-input').value != e.target.parentNode.parentNode.parentNode.parentNode.querySelector('.total-input').value) {
                        e.target.parentNode.parentNode.parentNode.parentNode.querySelector('.dibayar-input').value = e.target.parentNode.parentNode.parentNode.parentNode.querySelector('.total-input').value
                    }
                    e.target.parentNode.parentNode.children[0].classList.add('hidden')

                } else {
                    e.target.parentNode.parentNode.children[0].classList.remove('hidden')
                }
            }
        }
    }

});
})

function Rupiah(rp) {
    if (rp.length > 3) {
        rp = rp.match(/\d{1,3}/g);

        if (rp[rp.length - 1].length == 1) {
            rp =
                rp.join("").substr(0, 1) +
                "," +
                rp
                .join("")
                .substr(1)
                .match(/\d{1,3}/g);
        }

        if (rp[rp.length - 1].length == 2) {
            rp =
                rp.join("").substr(0, 2) +
                "," +
                rp
                .join("")
                .substr(2)
                .match(/\d{1,3}/g);
        }
        if (rp[rp.length - 1].length == 3) {
            rp =
                rp.join("").substr(0, 3) +
                "," +
                rp
                .join("")
                .substr(3)
                .match(/\d{1,3}/g);
        }
    }
    return rp;
}

function rp() {
    [...document.querySelectorAll(".numberFormat")].forEach((a) => {
        a.addEventListener("keyup", function () {
            if (a.value.length > 3) {
                a.value = Rupiah(a.value.split(",").join(""));
            } else {
                a.value = Rupiah(a.value);
            }
        });
    });
}

function hg() {
    [...document.querySelectorAll(".harga-input")].map((h) => {
        h.addEventListener("keyup", function () {
                if (h.value.length > 3) {
                    okane =
                        h.value.split(",").join("")
                    okane = Rupiah(okane.toString());
                } else {
                    okane = Rupiah(this.value);
                }

            if (okane != 0) {
                if (this.parentNode.parentNode.querySelector(
                        ".dibayar-input"
                    ).classList[this.parentNode.parentNode.querySelector(
                        ".dibayar-input"
                    ).classList.length - 1] != 'hidden') {

                    this.parentNode.parentNode.querySelector(
                        ".dibayar-input"
                    ).classList.add('hidden')
                }
                this.parentNode.parentNode.querySelector(
                    "[type=checkbox]"
                ).checked = true;

            } else {
                this.parentNode.parentNode.querySelector(
                    "[type=checkbox]"
                ).checked = false;

            }
            this.parentNode.parentNode.querySelector(
                ".dibayar-input"
            ).value = okane;
            
            

        });
    });
    
}

function cekbox() {

}

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

<script src="{{asset('js/mine/belanja/pengeluaran.js')}}"></script> 

 {{-- <script src="{{ asset('js/mine/belanja/tolha.js') }}"></script>  --}}
 
@endsection