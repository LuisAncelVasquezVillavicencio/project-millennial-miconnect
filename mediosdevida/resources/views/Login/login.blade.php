@extends('layout.login_layout')
@section('content')
<div class="col-md-12 text-center no-top" >
	<div class="card card-none" >
		<div class="row">
			<div class="col-md-12 col-lg-8 pr-0 d-none d-lg-block" >
				<img src="{{ asset('images_theme/Logo-millev-completo.png')}}" alt="img" class="br-tl-2 br-bl-2 " style="width:100%; height:100%">
			</div>
			<div class="col-md-12 col-lg-4 pl-0 "  style="min-height: 94vh; ">
				<div class="card-body p-6 about-con pabout center card-none">
					<div class="card-title text-center mb-4" style="margin-top:20%">INICIAR SESION</div>
					<div class="form-group">
						<input type="email" class="form-control" placeholder="Usuario">
					</div>
					<div class="form-group">
						<input type="password" class="form-control" id="exampleInputPassword1" placeholder="Contraseña">
					</div>
					<div class="form-group">
					      <label class="custom-control custom-checkbox text-left text-info small"><input type="checkbox" name="remember" style="margin-right:10px">Recuerdame
							<a href="#" class="float-right small text-info">Olvide mi contraseña</a>
						</label>
					</div>
					<div class="form-footer mt-1">
						<a href="{{route('home')}}" class="btn btn-info btn-block">Ingresar</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection