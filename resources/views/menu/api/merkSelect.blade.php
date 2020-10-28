<div class="nk-int-st" id="merk">
<select name="merk" id="">
    @foreach ($data as $d)            
<option value="{{$d->merk}}">{{$d->merk}}</option>
    @endforeach
</select>
</div>
         