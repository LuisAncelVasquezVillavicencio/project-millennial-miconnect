<table class="table card-table  table-vcenter text-nowrap " style="background: transparent;border:0px;" >
							<thead>
								<tr>
									<th  class="txt-color-white">FECHA RECIBIDO</th>
									<th  class="txt-color-white">NUMERO</th>
									<th  class="txt-color-white">PREGUNTA</th>
									<th  class="txt-color-white">OPCION CONTENIDO</th>
									<th  class="txt-color-white">OPCION ESCOJIDA</th>
								</tr>
							</thead>
							<tbody class="table_content txt-color-white">
								@isset($resul_opciones)
								@forelse( $resul_opciones as $recive_item => $item )
								<tr>
									    <th scope="row"  class="txt-color-white">{{ $item->created_at  }} </th>
									    <th scope="row"  class="txt-color-white">{{ $item->NUMERO }}</th>
									    <th scope="row"  class="txt-color-white">{{ $item->PREGUNTA }}</th>
									    <th scope="row"  class="txt-color-white">{{ $item->OPCION_CONTENIDO }}</th>
									    <th scope="row"  class="txt-color-white">{{ $item->OPCION_ESCOJIDA }}</th>
								</tr>
								@empty
								<tr>
								    <td style="text-align:center;" colspan="100" class="text-warning">No se encontraron resultados</td>
								</tr>
						      @endforelse
						      @endisset
							</tbody>
						</table>