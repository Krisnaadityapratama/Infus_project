	@extends('layouts.app')
	@section('content')
	<div class="limiter">
		<div class="container-login100" >
			<div class="wrap-login100 p-l-55 p-r-55 p-t-50 p-b-54">
				<form class="login100-form validate-form" method="POST" action="{{ url('update') }}">
				@csrf	
                     <span class="login100-form-title p-b-49">
						Data Pasien
					</span>
					<div class="container">
					
								@if(session()->has('message'))
								<div class="alert alert-success">
									{{ session('message')}}
								</div>
								@elseif(session()->has('error'))
								<div class="alert alert-danger">
									{{ session('error')}}
								</div>
								@endif
							 
                                 
						<div class="wrap-input100 validate-input m-b-23" data-validate = "nama">
						<span class="label-input100">Nama Pasien</span>
						<input id="nama" class="input100 form-control" type="text" name="nama" placeholder="masukan nama pasien" required autocomplete="nama" autofocus>
						<span class="focus-input100" data-symbol="&#xf206;"></span>   
                               
					</div>
					<div class="wrap-input100 validate-input m-b-23" data-validate = "ruang">
						<span class="label-input100">Nomor Ruangan</span>
						<input id="ruang" class="input100 form-control" type="text" name="ruang" placeholder="masukan nomor ruangan pasien" required autocomplete="ruang" autofocus>
						<span class="focus-input100" data-symbol="&#xf206;"></span>   
					</div>
					<div class="wrap-input100 validate-input m-b-23" data-validate = "tetes">
						<span class="label-input100">Tetes Infus</span>
						<input id="tetes" class="input100 form-control" type="text" name="tetes" placeholder="masukan kecepatan tetes" required autocomplete="tetes" autofocus>
						<span class="focus-input100" data-symbol="&#xf206;"></span>   
					</div>					
					<div class="wrap-input100 validate-input m-b-23" data-validate = "kode">
						<span class="label-input100">Kode Alat</span>
						<select class="form-control" required autocomplete="kode" name="kode">
							<option>--Pilih --</option>
							@foreach ($key as $keys)
                        	<option value="{{$keys->id}}">{{$keys->id}}</option>
                    		@endforeach
						</select>
						<span class="focus-input100" data-symbol=""></span>       
					</div>
					
					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button type="submit"  class="login100-form-btn">
                             Update
							</button>
						</div>
					</div>
					<div class="text-right p-t-8 p-b-31 d-flex justify-content-center">
                    {{-- @if (Route::has('login'))
                                    <a class="btn btn-link" href="{{ route('login') }}">
                                        masuk disini
                                    </a>
					@endif --}}
					</div>

					
				</form>
			</div>
		</div>
	</div>  
	
	
	@endsection
	

