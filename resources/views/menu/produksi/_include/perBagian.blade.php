@foreach ($data as $d)            
<tr >
    <td>{{$loop->iteration}}</td>
    <td>{{$d->nama}}</td>
    <td>{{$d->kuantitas}}</td>
    <td>{{$d->satuan->nama}}</td>
    <td><a href="/produksi/{{$d->id}}/delete" class="badge badge-danger"><i class="notika-icon notika-trash"></i></a></td>        
</tr>
@endforeach
         