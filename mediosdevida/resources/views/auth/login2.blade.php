{{--@extends('layouts.app')--}}
@extends('layout.login_layout')
@section('content')
<div class="col-md-12 text-center no-top" >
	<div class="card card-none" >
		<div class="row">
			<div class="col-md-12 col-lg-8 pr-0 d-none d-lg-block" >
			    <div style="min-width:100%;min-height:100%; ">
			       <!--<img src="{{ asset('images_theme/logo-millev-blanco.png')}}" alt="img" style="width: 15%;height: 10%;position: absolute;margin: 10px;">-->
				    <!--<img src="{{ asset('images_theme/login.png')}}" alt="img" class="br-tl-2 br-bl-2 " style="width:100%; height:100%;">-->
				    	<img src="{{ asset('images_theme/Logo-millev-completo.png')}}" alt="img" class="br-tl-2 br-bl-2 " style="width:100%; height:100%">
				</div>
			</div>
			<div class="col-md-12 col-lg-4 pl-0 "  style="min-height: 94vh; ">
				<div class="card-body p-6 about-con pabout center card-none">
				    <form method="POST" action="{{ route('login') }}">
                        @csrf
    					<div class="card-title text-center mb-4" style="margin-top:20%">INICIAR SESION</div>
    					<div class="form-group">
    						<input type="email" class="form-control" placeholder="Email" name="email">
    						 @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                             @enderror
    					</div>
    					<div class="form-group">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Contraseña">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
    					</div>
    					<div class="form-group">
    					    <label class="custom-control custom-checkbox text-left text-info small">
    					      <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }} style="margin-right:10px"> Recuerdame
    						  @if (Route::has('password.request'))
    						      <a href="{{ route('password.request') }}" class="float-right small text-info">Olvide mi contraseña</a>
    						  @endif
    						</label>
    					</div>
    					<div class="form-group">
    					</div>
    					<div class="form-footer mt-1">
    					        <button type="submit" class="btn btn-info login-btn btn-block">Ingresar</button>
                            @if (Route::has('register') && 0 == 1)
                                <a type="submit" class="btn btn-info login-btn btn-block" href="{{ route('register') }}">Registrar</a>
                            @endif
    					</div>
    					
    				</form>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection
