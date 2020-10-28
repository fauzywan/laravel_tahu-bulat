@extends('layouts.master')
@section('top-main')
{{--  --}}
    
{{-- error message --}}
    @error('nama')    
    <div class="row">
        <div class="alert alert-danger alert-dismissible alert-mg" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="notika-icon notika-close"></i></span></button> {{$message}}   
        </div>
    </div>
    {{--End error message --}}

    @enderror
    {{-- alert message --}}
    @if(session('pesan'))    
    <div class="row">
        <div class="alert alert-{{session('alert')}} alert-dismissible alert-mg" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="notika-icon notika-close"></i></span></button> {{session('pesan')}}   
        </div>
    </div>
    @endif
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">       
					<div class="breadcomb-list">
                    <div class="row"></div>
                        <div class="row">
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
								<div class="breadcomb-wp">
									<div class="breadcomb-icon">
										<i class="notika-icon notika-app"></i>
									</div>
									<div class="breadcomb-ctn">
										<h2>Gudang</h2>
										<p>Kelola <span class="bread-ntd">Barang Di gudang</span></p>
									</div>
								</div>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-3">
								<div class="breadcomb-report">
									<button data-toggle="tooltip" data-placement="left" title="" class="btn waves-effect" data-original-title="Download Report"><i class="notika-icon notika-sent"></i></button>
								</div>
							</div>
						</div>
					</div>
				</div>
@endsection
@section('main')
<div class="form-example-wrap">
    <div class="row">

                        <div class="cmp-tb-hd">
                            <h2>Tanggal Belanja</h2>
                        </div>
                        @if ($tanggal==null)
                        <form class="row" action="{{url('tanggal/belanja/store')}}" method="POST">
                          @method('put')
                          @else
                          <form class="row" action="{{url('tanggal/belanja/update')}}" method="POST">
                            @method('post')
                            @endif
                            @csrf
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                <div class="form-example-int form-example-st">
                                    <div class="form-group">
                                        <div class="nk-int-st">
                                        <input type="date" id="date"name="tanggal" value="{{$tanggal==null?date('Y-m-d'):$tanggal->tanggal}}" class="form-control input-sm" placeholder="Enter Email">
                                        </div>
                                    </div>
                                </div>
                            </div>
                    
                          
                            <div class="col-lg-4 col-md-4 col-sm-3 col-xs-12">
                                <div class="form-example-int">
                                    <button class="btn btn-success notika-btn-success waves-effect">Atur</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                        

                 
<script>
    document.getElementById('date').addEventListener('change',function(){
        
    console.log(document.getElementById('date').value)
    })
</script>
   @endsection