@extends('template.app')
@section('title', 'Envio masivo')
@section('content')
<div class="page-breadcrumb d-flex align-items-center">
   <div class="bread-crumb-custom w-100 d-flex align-items-center">
   	<div class="breadcrumb-title pe-3">Envio masivo</div>
   	<div class="ps-3 mb-0 mb-md-0">
   		<nav aria-label="breadcrumb">
   			<ol class="breadcrumb mb-0 p-0">
   				<li class="breadcrumb-item"><a href="{{route('grupos')}}"><i class="bx bx-home-alt"></i></a>
   				</li>
   				<li class="breadcrumb-item active" aria-current="page">Paso 1: Seleccione el grupo</li>
   			</ol>
   		</nav>
   	</div>
	</div>
</div>
<div class="row mt-3" data-masonry='{"percentPosition": true }'>
   @foreach($grupos as $linea)
   <div class="col-md-4 col-sm-6 col-xs-12">
		<div class="card border-primary border-bottom border-3 border-0">
			<div class="card-body">
				<h5 class="card-title text-primary">{{ $linea->TITULO }}</h5>
				<p class="card-text">
				   {{$linea->DESCRIPCION}}<br>
					{{$linea->contactos_count}} Contactos
				</p>
				<div class="d-flex align-items-center gap-2">
				   <a href="{{route('Sent_2',$linea->ID_GRUPO)}}" data-id="{{$linea->ID_GRUPO}}" class="btn-editar btn btn-inverse-success">
					   <i class='bx bx-send'></i> Seleccionar
					</a>
				</div>
			</div>
		</div>
	</div>
	@endforeach
</div>
@endsection
@section('scripts')

<script>
	
	@if(session()->has('success'))
		$(document).ready(function(){
		
			notification_custom("success","Se estan enviando los mensajes");
			
		})
	@endif
	
</script>


@endsection