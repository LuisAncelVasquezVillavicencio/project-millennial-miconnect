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
												<h2 class="mb-1 font-anton">RESUMEN DE RESULTADOS ENVÍO MASIVO</h2>
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
							
                            <div class="col-sm-12 col-md-12 col-lg-6 col-xl-3 ">
								<div class="card overflow-hidden ">
									<div class="card-body">
										<div class="d-flex">
											<div class="">
												<p class="mb-2 h6">GRUPO </p>
												<h2 class="mb-1 ">{{ $item_grupo[0]->TITULO}}</h2>
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
							<div class="col-sm-12 col-md-12 col-lg-6 col-xl-3 ">
								<div class="card overflow-hidden ">
									<div class="card-body">
										<div class="d-flex">
											<div class="">
												<p class="mb-2 h6">TOTAL CONTACTOS</p>
												<h2 class="mb-1 ">{{ count($list_contactos) }}</h2>
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
							<div class="col-sm-12 col-md-12 col-lg-6 col-xl-3 txt-color-white">
								<div class="card overflow-hidden bg-gradient-success">
									<div class="card-body">
										<div class="d-flex">
											<div class="">
												<p class="mb-2 h6">TOTAL MENSAJES ENVIADOS</p>
												<h2 class="mb-1 " id="total_msm_sent" >{{ count($list_resultados) }}</h2>
											</div>
											<div class=" my-auto ml-auto">
												<!--<div class="chart-wrapper">-->
												<!--	<canvas id="areaChart2" class="areaChart2 chartjs-render-monitor chart-dropshadow-secondary overflow-hidden"></canvas>-->
												<!--</div>-->
											</div>
										</div>
									</div>
								</div>
							</div>
		
							<div class="col-sm-12 col-md-12 col-lg-6 col-xl-3 txt-color-white">
								<div class="card overflow-hidden bg-gradient-danger">
									<div class="card-body">
										<div class="d-flex">
											<div class="">
												<p class="mb-2 h6">TOTAL ERRORES DE ENVIO</p>
												<h2 class="mb-1 " id="total_time_sent" >{{ count($list_resultados_ERROR) }}</h2>
											</div>
											<div class="my-auto ml-auto">
												<!--<div class="chart-wrapper">-->
												<!--	<canvas id="areaChart4" class="areaChart4 chartjs-render-monitor chart-dropshadow-success overflow-hidden"></canvas>-->
												<!--</div>-->
											</div>
										</div>
									</div>
								</div>
							</div>
							
    </div>

    
    
	<div class="row">
	
	<div class="col-xl-12 col-lg-12 col-md-12 ">
		<!--Add lists-->
		<div class="card bg-gradient-success card-collapsed" >
			<div class="card-header txt-color-white " style="background: transparent;border:0px;" >
				<h2 class="card-title  txt-color-white ">{{ 'DETALLE MENSAJES ENVIADOS'}}</h2>
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
									<th  class="txt-color-white">ID CONTACTO</th>
									<th  class="txt-color-white">NOMBRE CONTACTO</th>
									<th  class="txt-color-white">NUMERO</th>
									<th  class="txt-color-white">TIPO</th>
									<th  class="txt-color-white" >MENSAJE</th>
								</tr>
							</thead>
							<tbody class="table_content txt-color-white">
								@isset($list_resultados)
								@forelse($list_resultados as $item)
								<tr>
									    <th scope="row"  class="txt-color-white">{{  $item['id_contacto'] }} </th>
									    <th scope="row"  class="txt-color-white">{{  $item['nombre_completo'] }} </th>
									    <th scope="row"  class="txt-color-white">{{  $item['numero'] }} </th>
									    <th scope="row"  class="txt-color-white">{{  $item['type_msm'] }} </th>
									    <th scope="row"  class="txt-color-white">{{  $item['body_msm'] }} </th>
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
	<!--.Add lists-->
   
    
    
    	<div class="col-xl-12 col-lg-12 col-md-12 ">
		<!--Add lists-->
		<div class="card bg-gradient-danger card-collapsed " >
			<div class="card-header txt-color-white " style="background: transparent;border:0px;" >
				<h2 class="card-title  txt-color-white ">{{ 'DETALLE ERRORES MENSAJES ENVIADOS'}}</h2>
				<div class="card-options">
					<a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up  txt-color-white "></i></a>
					<a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i class="fe fe-maximize  txt-color-white "></i></a>
				</div>
			</div>
			<div class="card-body" style="padding-top: 0px;">
				<div class="">
					<div class="item2-gl table_r">
						<div class="table-responsive txt-color-white">
						 	<table class="table card-table  table-vcenter text-nowrap txt-color-white" style="background: transparent;border:0px;">
								<thead >
									<tr>
										<th class="txt-color-white" >ID CONTACTO</th>
										<th class="txt-color-white" >NOMBRE CONTACTO</th>
										<th class="txt-color-white" >NUMERO</th>
										<th class="txt-color-white" >TIPO</th>
										<th class="txt-color-white" >MENSAJE</th>
									</tr>
								</thead>
								<tbody class="table_content txt-color-white" >
									@isset($list_resultados_ERROR)
									@forelse($list_resultados_ERROR as $item)
									<tr >
										    <th scope="row" class="txt-color-white">{{  isset($item['id_contacto']) ? $item['id_contacto'] : 'Null'  }} </th>
										    <th scope="row" class="txt-color-white">{{  isset($item['nombre_completo']) ? $item['nombre_completo'] : 'Null' }} </th>
										    <th scope="row" class="txt-color-white">{{  isset($item['numero']) ? $item['numero'] : 'Null'  }} </th>
										    <th scope="row" class="txt-color-white">{{  isset($item['type_msm']) ? $item['type_msm'] : 'Null'  }}  </th>
										    <th scope="row" class="txt-color-white">{{  isset($item['body_msm']) ? $item['body_msm'] : 'Null'  }}  </th>
									</tr>
									@empty
									<tr>
									    <td style="text-align:center;" colspan="100" class="text-warning">No se encontraron errores</td>
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
	
	

	
	</div>
	
	
	 <div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-6 col-xl-12 ">
								<div class="card overflow-hidden ">
									<div class="card-body">
										<div class="d-flex">
											<div class="">
												<p class="mb-2 h6"> </p>
												<h2 class="mb-1 font-anton ">ANALYTICS IDENTIFICADOR</h2>
											</div>

										</div>
									</div>
								</div>
							</div>
							
                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 ">
								<div class="card overflow-hidden ">
									<div class="card-body">
										<div class="d-flex">
											<div class="">
												<p class="mb-2 h6">ETIQUETA </p>
												<h2 class="mb-1 ">{{ $etiqueta }}</h2>
											</div>

										</div>
									</div>
								</div>
							</div>
							<!--<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 ">-->
							<!--	<div class="card overflow-hidden ">-->
							<!--		<div class="card-body">-->
									
											
							<!--					<p class="mb-2 h6"><b>KEY</b></p>-->
							<!--					<input type="text"  class="form-control" required readonly  value="{{ $key }}" style="width:100%;"  /> -->
	
										
									
							<!--		</div>-->
							<!--	</div>-->
							<!--</div>-->
				
		
					
    </div>
    
    	
    
	</div>


							
@endsection
@section('scripts')
<script>
  
</script>
@endsection				

