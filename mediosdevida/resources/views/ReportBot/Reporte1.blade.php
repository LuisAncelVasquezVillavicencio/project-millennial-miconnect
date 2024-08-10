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
												<h2 class="mb-1 font-anton">{{ $nombre }}</h2>
											</div>
											@if($id==4)
											<div class=" my-auto ml-auto">
												<h3><a href="{{ route('BotExport1') }}" >Descargar</a></h3>
											</div>
											@endif
											@if($id==3)
											<div class=" my-auto ml-auto">
												<h3><a href="{{ route('BotExport2') }}" >Descargar</a></h3>
											</div>
											@endif
											@if($id==5)
											<div class=" my-auto ml-auto">
												<h3><a href="{{ route('BotExport3') }}" >Descargar</a></h3>
											</div>
											@endif
											
										</div>
									</div>
								</div>
					</div>
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
									<th  class="txt-color-white">NUMERO</th>
									<th  class="txt-color-white">PREGUNTA</th>
									<th  class="txt-color-white">OPCION CONTENIDO</th>
									<th  class="txt-color-white">OPCION ESCOGIDA</th>
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
						</div>
					</div>
		        </div>
			</div>
			
		</div>
		
	</div>
	<div class="col-md-12 col-lg-12 col-xl-12"> {{ $resul_opciones->links() }}</div>
	<!--.Add lists-->
   
    

	

	
	</div>
	
	

				
	
    
    	
    
	</div>


							
@endsection
@section('scripts')
<script>
   
</script>
@endsection				

