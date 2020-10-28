@foreach ($adonan as $a)
<tr>
    <td>{{$loop->iteration}}</td>
    <td>
        <select name="bahan[]" class="form-control">
            <option value="{{$a->biaya_produksi->id}}">{{$a->biaya_produksi->nama}}</option>      
        </select>  
    </td>
    @if($a->gudang()->belanja->where('status',1)->sum('tersedia')>=$a->kuantitas* $kuantitas)
    <td><input type="text" class="form-control" placeholder="Kuantitas" name="kuantitas[]" value="{{$a->kuantitas * $kuantitas}}"></td>
    @else
    <td><input type="text" class="form-control" placeholder="Kuantitas" name="kuantitas[]" value="Jumlah Bahan digudang Tidak Mencukupi "></td>
    @endif
    <td class="remove text-right btn btn-sm btn-danger btn-sm "><i class="fas fa-trash remove"></i></td>                                                
    
</tr>  
@endforeach