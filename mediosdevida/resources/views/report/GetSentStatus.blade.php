
				<div class="">
					<div class="item2-gl table_r">
						<div class="table-responsive">
			 	<table class="table card-table border table-vcenter text-nowrap ">
				<thead>
					<tr>
						<th>NOMBRE</th>
						<th>NÚMERO</th>
						<th>ENVIADO</th>
						<th>RECIBIDO</th>
						<th>VISTO</th>
						<th>FECHA DE ACTUALIZACIÓN</th>
					</tr>
				</thead>
				<tbody class="table_content">
					@isset($sent)
			    @forelse($sent as $item )
					<tr>
						<th scope="row">
							<div class="circulo circulo_contact bg-gradient-secondary">
							  <a class="circulo_contact " >{{ substr($item->NOMBRE, 0, 1) }}</a>
							</div>
							<div style="padding-top: 10px;padding-left: 50px;">
								{{ $item->NOMBRE .' '.$item->APELLIDO }}
							</div>
						</th>
						<th scope="row">
							{{ $item->NUMERO  == null ? "No definido" : $item->NUMERO }}  
						</th>
						
							@if($item->SENT=="true")
						       <th scope="row" class="bg-success txt-color-white" >Enviado</th>
						  @else
						       <th scope="row" class="bg-warning txt-color-white" >No Enviado</th>
						  @endif
						  @if($item->DELIVERED=="true")
						       <th scope="row" class="bg-success txt-color-white" >Recibido</th>
						  @else
						       <th scope="row" class="bg-warning txt-color-white" >No Recibido</th>
						  @endif
							@if($item->VIEWED=="true")
						       <th scope="row" class="bg-success txt-color-white" >Visto</th>
						  @else
						       <th scope="row" class="bg-warning txt-color-white" >No visto</th>
						  @endif
						  
						  <th scope="row">
							  {{ $item->max_date_actualizacion == null ? "No definido" : $item->max_date_actualizacion  }}  
						  </th>
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
		 	<div class="col-md-12 col-lg-12 col-xl-12"> {{ $sent->links() }}</div>
					</div>
					
		     </div>
	