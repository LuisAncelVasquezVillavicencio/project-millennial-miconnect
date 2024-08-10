@extends('layout.page_layout')
@section('title', 'Contactos')
@section('content')
<div class="page-header" >
	<div class="page-leftheader">
	</div>
</div>


<div class="row">
	
    <div class="col-xl-12 col-lg-12 col-md-12">
								<div class="card">
									<div class="card-body">
										<h2 >Motor De Colas</h2>
									</div>	
								 </div>
	</div>
	
	
	<div class="col-xl-12 col-lg-12 col-md-12">
								<div class="card">
									<img class="card-img-top w-100" src="../assets/images/photos/6.jpg" alt="">
									<div class="card-body">
										<h4 class="card-title mb-3">Motor de decisión</h4>
											<h2> {{ $jobs }} Mensajes</h2>
										   <span>El sistema analiza la situacion actual de las colas, para decidir si el mensaje saliente sera almacenado o enviado a la cola.  </span>
									</div>
								 </div>
	</div>
	
	<div class="col-xl-12 col-lg-12 col-md-12">
								<div class="card">
									<img class="card-img-top w-100" src="../assets/images/photos/6.jpg" alt="">
									<div class="card-body">
										<h4 class="card-title mb-3">Cola Whatsapp</h4>
										   <h2> {{ $totalmensajes->TOTAL_MESSAGES }} Mensajes</h2>
											<div class="progress progress-lg mb-3" >
											  <div class="progress-bar progress-bar-striped progress-bar-animated bg-teal " 
											       style="width:{{ $porcentaje_trabajo_envio }}% " >
											  	    {{ $porcentaje_trabajo_envio }}% 
											  </div>
										   </div>
										   <span>El sistema muestra informacion del porcentaje de saturación de las colas , al llegar al 100% 
										         automaticamente detendra el envio de mensajes a la cola, hasta que se liberen las colas </span>
									</div>
								 </div>
	</div>
	
	<div class="col-xl-12 col-lg-12 col-md-12">
								<div class="card">
									<div class="card-body">
										<h4 class="card-title mb-3">Planificador Limpieza Cola</h4>
										<div class="progress progress-lg mb-3">
											<div class="progress-bar progress-bar-striped progress-bar-animated bg-teal "
											     style="width: {{ $porcentaje_reinicio }}% !important;"  >
											   	{{ $porcentaje_reinicio }}%
											</div>
										</div>
										<span>El sistema analiza el estatus de los servicios y evalua el reinicio de las colas ,
											      al llegar al 100% reinicia las colas automaticamente.</span>
										
									</div>
								 </div>
	</div>
	
	
	
	
	<div class="col-xl-12 col-lg-12 col-md-12">
								<div class="card">
									<img class="card-img-top w-100" src="../assets/images/photos/6.jpg" alt="">
									<div class="card-body">
										<h4 class="card-title mb-3">Almacen de cola</h4>
											<h2> {{ $colas }} Mensajes</h2>
										   <span>El sistema al detectar una posible saturación de las colas automaticamente almacena el exceso de mensajes,
										   el almacen de colas al detectar que no hay saturación envia los mensajes al motor de decisión </span>
									</div>
								 </div>
	</div>
	
	
							
					
							
						</div>
						
@endsection
