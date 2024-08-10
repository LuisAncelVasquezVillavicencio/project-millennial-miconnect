<table class="table card-table  table-vcenter text-nowrap " style="background: transparent;border:0px;" >
							<thead>
								<tr>
									<th  class="txt-color-white">FECHA RECIVIDO</th>
									<th  class="txt-color-white">NOMBRE CONTACTO</th>
									<th  class="txt-color-white">APELLIDO CONTACTO</th>
									<th  class="txt-color-white">NUMERO</th>
									<th  class="txt-color-white">GRUPO</th>
									<th  class="txt-color-white">MENSAJE</th>
									<th  class="txt-color-white">ETIQUETA</th>
								</tr>
							</thead>
							<tbody class="table_content txt-color-white">
								@isset($recive)
								@forelse( $recive as $recive_item => $item )
								<tr>
									
									    <th scope="row"  class="txt-color-white">{{  $item->created_at  }} </th>
									    <th scope="row"  class="txt-color-white">
									    	@if(isset($item->contacto->NOMBRE)) 
									    	{{ $item->contacto->NOMBRE  }}
									    	@else
										     {{  $item->SENDERNAME   }}
									    	@endif
									    </th>
									    <th scope="row"  class="txt-color-white">
									    	@if(isset($item->contacto->NOMBRE)) 
									    	{{ $item->contacto->APELLIDO  }}
									    	@else
										     {{ "" }}
									    	@endif
									    </th>
									    <th scope="row"  class="txt-color-white">
									    	@if(isset($item->contacto->NUMERO)) 
									    	{{ $item->contacto->NUMERO  }}
									    	@else
										     {{   str_replace("@c.us","",$item->AUTHOR)    }}
									    	@endif
									    </th>
									    <th scope="row"  class="txt-color-white">
									    	@if(isset($item->contacto->grupo->TITULO)) 
									    	{{ $item->contacto->grupo->TITULO  }}
									    	@else
										     {{  'SIN GRUPO'   }}
									    	@endif
									    </th>
									    
									    <th scope="row"  class="txt-color-white">
									    	 @if( $item->TYPE == 'image')
										      {{ $item->BODY  }}
										     <p>{{  $item->CAPTION   }} </p> 
										    @elseif($item->TYPE == 'video')
										       {{ $item->BODY   }}
                                   <p>{{  $item->CAPTION   }} </p> 
										    @else
										     {{  $item->BODY   }}
										    @endif
									    </th>
									    <th scope="row"  class="txt-color-white">{{  $item->ETIQUETA   }} </th>
									    
								</tr>
								@empty
								<tr>
								    <td style="text-align:center;" colspan="100" class="text-warning">No se encontraron resultados</td>
								</tr>
						      @endforelse
						      @endisset
							</tbody>
</table>
			
				
	
	
