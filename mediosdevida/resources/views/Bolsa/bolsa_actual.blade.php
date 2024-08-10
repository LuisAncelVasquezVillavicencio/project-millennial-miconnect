@extends('layout.page_layout')
@section('title', 'Bolsa')
@section('content')

<div class="page-header" >
	<div class="page-leftheader">
	</div>
</div>

<div class="row">
	
   <div class="col-xl-12 col-lg-12 col-md-12">
		<div class="card">
			<div class="card-body">
				<h2>Bolsa de mensajes</h2>
			</div>	
		 </div>
	</div>
	
	
	<div class="col-xl-12 col-lg-12 col-md-12">
		<div class="card">
			<img class="card-img-top w-100" src="../assets/images/photos/6.jpg" alt="">
			<div class="card-body">
				<h4 class="card-title mb-3">Mensajes enviados</h4>
					<h2> Total de mensajes enviados {{$mensajes_enviados}}</h2>
				   <span>Se consideran todos los mensajes enviados.</span>
			</div>
		 </div>
	</div>
	
	<div class="col-xl-12 col-lg-12 col-md-12">
		<div class="card">
			<img class="card-img-top w-100" src="../assets/images/photos/6.jpg" alt="">
			<div class="card-body">
				<h4 class="card-title mb-3">Consumo de mensajes</h4>
				   <h2> {{$mensajes_enviados." de ".$cantidad_mensajes_por_mes }} enviados</h2>
					<div class="progress progress-lg mb-3" >
					  <div class="progress-bar progress-bar-striped progress-bar-animated bg-teal " 
					       style="width:{{ $porcentaje }}% " >
					  	    {{ $porcentaje }}% 
					  </div>
				   </div>
				   <span>Se muestra el porcentaje total de mensajes enviados ({{$porcentaje."%"}}) del total de la bolsa </span>
			</div>
		 </div>
	</div>
	
	
						

@endsection