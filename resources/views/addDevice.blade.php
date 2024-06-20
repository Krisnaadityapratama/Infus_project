@extends('layouts.app')

@section('content')
<div class="container-fluid">


		<div class="d-flex justify-content-center">
			<div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-90">
				<form class="login100-form validate-form" method="POST" action="{{ url('adddevices') }}">
				@csrf	
                     <span class="login100-form-title p-b-49">
						Tambah Alat
                        
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
							 
                                 
						<div class="wrap-input100 validate-input m-b-23" data-validate = "kode">
						<span class="label-input100">Masukan Kode Alat</span>
						<input id="kode" class=" form-control mt-3" type="text" name="kode" placeholder="masukan kode alat" required autocomplete="kode" autofocus>
						
                               
					</div>
                    <span class="label-input100 text-danger">*Silakan dicek pada cover alat</span>
					
					<div class="container-login100-form-btn mt-3 mb-6">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button type="submit"  class="login100-form-btn">
                             tambah alat
							</button>
						</div>
					</div>
					

					
				</form>
			</div>
		</div>
	</div>

</div>



@endsection