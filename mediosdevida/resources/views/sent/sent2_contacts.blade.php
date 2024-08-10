<div class="item2-gl-nav bg-white d-flex">
	<h3 class="mb-0 mt-2"><i class="fa fa-address-book"> </i> {{ $grupo[0]->TITULO }} </h3>
	<ul class="nav item2-gl-menu ml-auto">
		<li><h4 class="mb-0 mt-2">{{ 'TOTAL CONTACTOS : '. count($list_contactos) }}</h4></li>
		<!--<li class=""><a href="#tab-11" class="active show" data-toggle="tab" title="List style"><i class="fa fa-list"></i></a></li>-->
		<!--<li><a href="#tab-12" data-toggle="tab" class="" title="Grid"><i class="fa fa-th"></i></a></li>-->
	</ul>
</div>
<div class="table-responsive">
 	<table class="table card-table border table-vcenter text-nowrap ">
	<thead>
		<tr>
			<th>Nombre</th>
			<th>Número de teléfono</th>
			
			@if (!($disable_filtros))
			@if(isset(array_keys($data_filtros)[0]))
				@if (!(array_keys($data_filtros)[0] === ''))
				<th>{{ array_keys($data_filtros)[0] }}</th>
				@endif
			@endif
			@if(isset(array_keys($data_filtros)[1]))
				@if (!(array_keys($data_filtros)[1] === ''))
				<th>{{ array_keys($data_filtros)[1] }}</th>
				@endif
			@endif
			
			@if(isset(array_keys($data_filtros)[2]))
				@if (!(array_keys($data_filtros)[2] === ''))
				<th>{{ array_keys($data_filtros)[2] }}</th>
				@endif
			@endif
			
			@if(isset(array_keys($data_filtros)[3]))
				@if (!(array_keys($data_filtros)[3] === ''))
				<th>{{ array_keys($data_filtros)[3] }}</th>
				@endif
			@endif
			
			@if(isset(array_keys($data_filtros)[4]))
				@if (!(array_keys($data_filtros)[4] === ''))
				<th>{{ array_keys($data_filtros)[4] }}</th>
				@endif
			@endif
			@endif
			
		</tr>
	</thead>
	<tbody class="table_content">
		@isset($list_contactos)
		@forelse($list_contactos as $item )
		<tr>
			<th scope="row">
				<div class="circulo circulo_contact bg-gradient-secondary">
				  <a class="circulo_contact " >{{ substr($item->NOMBRE, 0, 1) }}</a>
				</div>
				<div style="padding-top: 10px;padding-left: 50px;">
					{{ $item->NOMBRE .' '.$item->APELLIDO }}
				</div>
				
				
			</th>
			<td>{{ $item->NUMERO }}</td>
			
			@if (!($disable_filtros))
			@if(isset(array_keys($data_filtros)[0]))
				@if (!(array_keys($data_filtros)[0] === ''))
				<th>{{ $item->VAL_GRUPO1 }}</th>
				@endif
			@endif
			
			@if(isset(array_keys($data_filtros)[1]))
				@if (!(array_keys($data_filtros)[1] === ''))
				<th>{{ $item->VAL_GRUPO2 }}</th>
				@endif
			@endif
			
			@if(isset(array_keys($data_filtros)[2]))
				@if (!(array_keys($data_filtros)[2] === ''))
				<th>{{ $item->VAL_GRUPO3 }}</th>
				@endif
			@endif
			
			@if(isset(array_keys($data_filtros)[3]))
				@if (!(array_keys($data_filtros)[3] === ''))
				<th>{{ $item->VAL_GRUPO4 }}</th>
				@endif
			@endif
			
			@if(isset(array_keys($data_filtros)[4]))
				@if (!(array_keys($data_filtros)[4] === ''))
				<th>{{ $item->VAL_GRUPO5 }}</th>
				@endif
			@endif
			@endif
			
		</tr>
		@empty
		<tr>
		    <td style="text-align:center;" colspan="100" class="text-warning">No se encontraron resultados</td>
		</tr>
        @endforelse
        @endisset
	</tbody>
</table>
</div>