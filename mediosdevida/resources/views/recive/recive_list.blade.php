@extends('layout.page_layout')
@section('title', 'Grupos')
@section('content')
<div class="page-header" >
	<div class="page-leftheader">
	</div>
</div>


<!-- row opened -->
    <div class="card-body">
    	
    	
    
    <div class="row">
                         	<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 ">
								<div class="card overflow-hidden ">
									<div class="card-body">
										<div class="d-flex">
											<div class="">
												<p class="mb-2 h6"> </p>
												<h2 class="mb-1 font-anton">RESUMEN DE MENSAJES RECIBIDOS</h2>
											</div>
											<div class=" my-auto ml-auto">
												<!--<div class="chart-wrapper text-center">-->
												<!--	<canvas id="areaChart1" class="areaChart2 chartjs-render-monitor chart-dropshadow-primary overflow-hidden mx-auto"></canvas>-->
												<!--</div>-->
											</div>
										</div>
									</div>
								</div>
							</div>
							
                            <div class="col-sm-12 col-md-12 col-lg-6 col-xl-12 ">
								<div class="card overflow-hidden ">
									<div class="card-body">
										<div class="d-flex">
											<div class="">
												<p class="mb-2 h6">MENSAJES RECIBIDOS  </p>
												<h2 class="mb-1 ">{{ $cant_recibidos }}</h2>
											</div>
											<div class=" my-auto ml-auto">
												<h3><a href="{{ route('recibeExport') }}" >Descargar</a></h3>
											</div>
										</div>
									</div>
								</div>
							</div>
							<!--<div class="col-sm-12 col-md-12 col-lg-6 col-xl-3 ">-->
							<!--	<div class="card overflow-hidden ">-->
							<!--		<div class="card-body">-->
							<!--			<div class="d-flex">-->
							<!--				<div class="">-->
							<!--					<p class="mb-2 h6">TOTAL CONTACTOS</p>-->
							<!--					<h2 class="mb-1 ">{{ ''}}</h2>-->
							<!--				</div>-->
							<!--				<div class=" my-auto ml-auto">-->
												<!--<div class="chart-wrapper text-center">-->
												<!--	<canvas id="areaChart1" class="areaChart2 chartjs-render-monitor chart-dropshadow-primary overflow-hidden mx-auto"></canvas>-->
												<!--</div>-->
							<!--				</div>-->
							<!--			</div>-->
							<!--		</div>-->
							<!--	</div>-->
							<!--</div>-->
							<!--<div class="col-sm-12 col-md-12 col-lg-6 col-xl-3 txt-color-white">-->
							<!--	<div class="card overflow-hidden bg-gradient-success">-->
							<!--		<div class="card-body">-->
							<!--			<div class="d-flex">-->
							<!--				<div class="">-->
							<!--					<p class="mb-2 h6">TOTAL MENSAJES ENVIADOS</p>-->
							<!--					<h2 class="mb-1 " id="total_msm_sent" >{{ '' }}</h2>-->
							<!--				</div>-->
							<!--				<div class=" my-auto ml-auto">-->
												<!--<div class="chart-wrapper">-->
												<!--	<canvas id="areaChart2" class="areaChart2 chartjs-render-monitor chart-dropshadow-secondary overflow-hidden"></canvas>-->
												<!--</div>-->
							<!--				</div>-->
							<!--			</div>-->
							<!--		</div>-->
							<!--	</div>-->
							<!--</div>-->
		
							<!--<div class="col-sm-12 col-md-12 col-lg-6 col-xl-3 txt-color-white">-->
							<!--	<div class="card overflow-hidden bg-gradient-danger">-->
							<!--		<div class="card-body">-->
							<!--			<div class="d-flex">-->
							<!--				<div class="">-->
							<!--					<p class="mb-2 h6">TOTAL ERRORES DE ENVIO</p>-->
							<!--					<h2 class="mb-1 " id="total_time_sent" >{{ ''}}</h2>-->
							<!--				</div>-->
							<!--				<div class="my-auto ml-auto">-->
												<!--<div class="chart-wrapper">-->
												<!--	<canvas id="areaChart4" class="areaChart4 chartjs-render-monitor chart-dropshadow-success overflow-hidden"></canvas>-->
												<!--</div>-->
							<!--				</div>-->
							<!--			</div>-->
							<!--		</div>-->
							<!--	</div>-->
							<!--</div>-->
							
    </div>

    
    
	<div class="row">
	
	<div class="col-xl-12 col-lg-12 col-md-12 ">
		<!--Add lists-->
		<div class="card bg-gradient-success " >
			<div class="card-header txt-color-white " style="background: transparent;border:0px;" >
				<h2 class="card-title  txt-color-white ">{{ 'DETALLE MENSAJES RECIBIDOS'}}</h2>
				<div class="card-options">
					<a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up  txt-color-white "></i></a>
					<a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i class="fe fe-maximize  txt-color-white "></i></a>
				</div>
			</div>
			<div class="card-body" style="padding-top: 0px;">
				<div class="">
					<div class="item2-gl table_r">
						<div class="table-responsive " >
						 	<table class="table card-table  table-vcenter text-nowrap " style="background: transparent;border:0px;" >
							<thead>
								<tr>
									<th  class="txt-color-white">FECHA RECIBIDO</th>
									<th  class="txt-color-white">CONTACTO</th>
									<th  class="txt-color-white">NUMERO</th>
									<th  class="txt-color-white">GRUPO</th>
									<th  class="txt-color-white">MENSAJE</th>
									<th  class="txt-color-white">ETIQUETA</th>
								</tr>
							</thead>
							<tbody class="table_content txt-color-white">
								@isset($list_recive)
								@forelse( $list_recive as $recive_item => $item )
								<tr>
									
									    <th scope="row"  class="txt-color-white">{{  $item->created_at  }} </th>
									    <th scope="row"  class="txt-color-white">
									    	@if(isset($item->contacto->NOMBRE)) 
									    	{{ $item->contacto->NOMBRE."  ".$item->contacto->APELLIDO }}
									    	@else
										     {{  $item->SENDERNAME   }}
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
										     <img src="{{  $item->BODY   }}" style="height:200px;" >  </img>
										     <p>{{  $item->CAPTION   }} </p> 
										    @elseif($item->TYPE == 'video')
										     <video height="200" controls  >
                                            <source src="{{  $item->BODY   }}" type="video/mp4">
                                   </video>
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
						</div>
					</div>
		        </div>
			</div>
			
		</div>
		
	</div>
	<div class="col-md-12 col-lg-12 col-xl-12"> {{ $list_recive->links() }}</div>
	<!--.Add lists-->
   
    

	

	
	</div>
	
	

				
	
    
    	
    
	</div>


							
@endsection
@section('scripts')
<script>
   
</script>
@endsection				

