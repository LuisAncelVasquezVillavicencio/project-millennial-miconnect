<table class="table card-table border table-vcenter text-nowrap ">
				<thead>
					<tr>
						<th>NOMBRE</th>
						<th>APELLIDO</th>
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
								{{ $item->NOMBRE  }}
						</th>
						<th scope="row">
								{{ $item->APELLIDO  }}
						</th>
						<th scope="row">
							{{ $item->NUMERO  == null ? "No definido" : $item->NUMERO }}  
						</th>
						  @if($item->SENT=="true")
						       <th scope="row" >Enviado</th>
						  @else
						       <th scope="row" >No Enviado</th>
						  @endif
						  @if($item->DELIVERED=="true")
						       <th scope="row" >Recibido</th>
						  @else
						       <th scope="row" >No Recibido</th>
						  @endif
							@if($item->VIEWED=="true")
						       <th scope="row" >Visto</th>
						  @else
						       <th scope="row" >No visto</th>
						  @endif
						  
						  <th scope="row">
							  {{ $item->max_date_actualizacion == null ? "No definido" : $item->max_date_actualizacion  }}  
						  </th>
					</tr>
					@empty
					<tr>
					    <td style="text-align:center;" colspan="100">No se encontraron resultados</td>
					</tr>
			      @endforelse
			      @endisset
				</tbody>
</table>