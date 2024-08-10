
@php ($numero = 1)
@if (count($contactos_grupo) > 0)
	<div class="mb-3 "><h3 class="mb-1 col-md font-anton">Total de Contactos: {{$contactos_grupo->total()}}</h3></div>
	
	<table class="table card-table border table-vcenter text-nowrap" >
	<th>
	Nombre contacto	
	</th>
	<th>
	Numero teléfono
	</th>
	@if($grupo_selecionado->NOM_GRUPO_1 != "")
	<th>
		{{$grupo_selecionado->NOM_GRUPO_1}}
	</th>
	@endif
	@if($grupo_selecionado->NOM_GRUPO_2 != "")
	<th>
		{{$grupo_selecionado->NOM_GRUPO_2}}
	</th>
	@endif
	@if($grupo_selecionado->NOM_GRUPO_3 != "")
	<th>
		{{$grupo_selecionado->NOM_GRUPO_3}}
	</th>
	@endif
	@if($grupo_selecionado->NOM_GRUPO_4 != "")
	<th>
		{{$grupo_selecionado->NOM_GRUPO_4}}
	</th>
	@endif
	@if($grupo_selecionado->NOM_GRUPO_5 != "")
	<th>
		{{$grupo_selecionado->NOM_GRUPO_5}}
	</th>
	@endif
	<th>
	Opciones
	</th>
@foreach($contactos_grupo as $linea)
    {{--@if($numero == 0)}
        <div class="row" style="margin-top:20px">
    @endif
	    <div class="col-md-4 item_tarjeta">
	    	<div class="card" style="min-height:100%">
	    		<!--<div class="card-header">-->
	    		<!--	<div class="card-options">-->
	    				
	    		<!--	</div>-->
	    		<!--</div>-->
	    		<div class="card-body text-left" style="min-height:100%">
	    			<div class="row">
	    				<div class="col-md-12">
			    			<div class="row">
			    				<div class="col-md-12">
			    					<h6>{{$linea->NOMBRE}}</h6>
			    				</div>
			    			</div>
			    			<div class="row">
			    				<div class="col-md-12">
			    					<h6>{{$linea->APELLIDO}}</h6>
			    				</div>
			    			</div>
			    			<div class="row">
			    				<div class="col-md-12">
			    					Numero: {{$linea->NUMERO}}
			    				</div>
			    			</div>
	    				</div>
	    			</div>
	    		</div>
	    		<div class="card-footer bg-yellow">

 		        
	    		</div>
	    	</div>
	    </div>
		@php($numero = $numero + 1)
    @if($numero == 3)
	    </div>
	    @php ($numero = 0)
	@endif--}}
	<tr>
		<td scope="row">
			<div class="circulo circulo_contact  bg-gradient-secondary">
				  <a class="circulo_contact " >{{ substr($linea->NOMBRE, 0, 1) }}</a>
			</div>
			<div style="padding-top: 10px;padding-left: 50px;">
				{{ $linea->NOMBRE .' '.$linea->APELLIDO }}
			</div>
		<td scope="row">{{$linea->NUMERO}}</td>
		@if($grupo_selecionado->NOM_GRUPO_1 != "")
		<td>
		{{$linea->VAL_GRUPO1}}
		</td>
		@endif
		@if($grupo_selecionado->NOM_GRUPO_2 != "")
		<td>
		{{$linea->VAL_GRUPO2}}
		</td>
		@endif
		@if($grupo_selecionado->NOM_GRUPO_3 != "")
		<td>
		{{$linea->VAL_GRUPO3}}
		</td>
		@endif
		@if($grupo_selecionado->NOM_GRUPO_4 != "")
		<td>
		{{$linea->VAL_GRUPO4}}
		</td>
		@endif
		@if($grupo_selecionado->NOM_GRUPO_5 != "")
		<td>
		{{$linea->VAL_GRUPO5}}
		</td>
		@endif
		<td scope="row">
			<div class="btn-group" role="group" aria-label="Basic example">
				<button class="btn btn-secondary bg-gradient-secondary" onclick="OpenModal('{{$linea->ID_CONTACTO}}')">
	    			<i class="fe fe-edit" ></i> Editar Contacto
	 	      </button>
	 	      	<button class="btn btn-danger bg-gradient-danger" onclick="eliminar('{{$linea->ID_CONTACTO}}')">
	 		      <i class="fe fe-x"></i> Eliminar Contacto
	 		   </button>
			</div>
 		</td>

	</tr>
@endforeach
</table>

@elseif (count($contactos_grupo) == 0)
<div class=col-md-12>
	<table class="table card-table border table-vcenter text-nowrap" >
		<tr>
			<td class="bg-warning">No hay datos para mostrar</td>
		</tr>
	</table>
</div>
@endif
@if (count($contactos_grupo) > 0)
<div class="container paginacion" style="margin-top:10px">
	<div style="float:right">
		{{$contactos_grupo->links()}}	
	</div>
</div>
@endif
			    

