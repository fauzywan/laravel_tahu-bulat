        <tr>
            <td>
                <select name="barang[]" class="form-control"> @foreach ($produksi as $p)
                <option value="{{$p->id}}">{{$p->nama}}</option> @endforeach
                </select>
            </td>    
        <td><input type="text" class="kuantitas-input form-control input-sm" name="kuantitas[]" placeholder="Qty" onkeyup="qyt()"></td>
    
            <td><input type="text" name="faktur" id="" class="form-control">
                <input type="date" onkeyup="hs();rp()" class="harga-input numberFormat form-control input-sm hide numberFormat" name="tanggal[]" placeholder="Harga Satuan" ></td>
    
            <td>
                 <select name="barang[]" class="form-control" name="suplier[]"> @foreach ($suplier as $s)
                <option value="{{$p->id}}">{{$s->nama}}</option> @endforeach
                </select>
            </td>
            <td><input type="text" onkeyup="hs();rp()" class="harga-input numberFormat form-control input-sm numberFormat" name="harga[]" placeholder="Harga Satuan" ></td>
            <td><input type="text" class="total-input numberFormat form-control input-sm numberFormat" name="total[]" onkeyup="rp()" placeholder="Total Harga" ></td>
            <td><input type="text" class="total-input numberFormat form-control input-sm numberFormat" name="dibayar[]" onkeyup="rp()" placeholder="Dibayar" ></td>
 
         <td class="remove text-right btn btn-danger btn-sm waves-effect"><i class="notika-icon notika-trash remove"></i></td>
        </tr>  
        <tr class="next"></tr>