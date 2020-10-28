@extends('layouts.master')
@section('top-main')
    @section('top-main')
<nav>
  <div class="nav nav-tabs" id="nav-tab" role="tablist">
      <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Home</a>
      <a class="nav-item nav-link" href="/potongan"> Detail</a>
  </div>
</nav>
@endsection
@endsection
@section('main')
<div class="row">
<div class="col-xl-12">
<div class="card">
    <div class="card-header bg-success text-white">Potongan Gaji</div>
    <div class="card-body ">
        <form action="" method="post">
            <div class="row">
                    <div class="col-xl-4">
                        <div class="form-group">
                            <label for="">Karyawan</label>
                            <select name="karyawan"  class="form-control">
                                @foreach ($karyawan as $k)
                                
                                <option value="{{$k->id}}">{{$k->nama}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-xl-4">
                        <div class="form-group">
                            <label for="">Tanggal</label>
                            <input name="tanggal" type="date"  class="form-control">
                        </div>
                    </div>
                    <div class="col-xl-4">
                        <div class="form-group">
                            <label for="">Nominal Uang</label>
                            <input name="uang" type="text"  class="form-control numberFormat">
                        </div>
                    </div>
                        </div>
                        @csrf
                <div class="row">
                    <div class="col-xl-12">
                        <div class="form-group">
                            <label for="">Deskripsi</label>
                            <textarea name="deskripsi"   class="form-control"></textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                        <button class="btn btn-success">Submit</button>
                </div>
        </form>

    </div>

</div>   

</div>    

</div>    

@endsection
@section('script')
    <script src="{{ asset('js/mine/rp.js') }}"></script>
@endsection