@extends('layout.page_layout')
@section('title', 'Grupos')
@section('content')
<div class="page-header" >
	<div class="page-leftheader">
	</div>
</div>

        		
        		    <div class="row">
                         	<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 ">
								<div class="card overflow-hidden ">
									<div class="card-body">
										<div class="d-flex">
											<div class="">
												<p class="mb-2 h6"> </p>
												<h2 class="mb-1 font-anton">PASO 1 ELIJA UN GRUPO DE CONTACTOS</h2>
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
					</div>
					
							
					<div class="row">
											@isset($grupo)
            		               @forelse($grupo as $item) 
            		                     
			            		  
            							<div class="col-md-12 col-xl-4">
												<div class="card box-shadow-0 widgets-cards mb-xl-0 bg-gradient-secondary" style="margin-bottom:10px !important;border-radius: 30px;">
													<div class="card-body d-flex  txt-color-white" style="padding: 1.2rem;">
														<form method="POST" action="{{ route('Sent_2') }}" style="position: absolute; bottom: 35%; right: 30px;">
														   	@csrf
														   	<input type="hidden" name="id_grupo" value="{{ $item->ID_GRUPO }}"/>
														   	<button type="submit"  class="btn btn-icon  btn-pill" /> <i class="fa fa-send"></i></button>
														</form>
														<div class="widgets-cards-icons">
															<div class="text-success mr-4 mt-2">
																<i class="fa fa-address-book fs-50  txt-color-white "></i>
															</div>
														</div>
														<div class="widgets-cards-data  txt-color-white ">
															<div class="wrp text-wrapper">
																<h3 class="shadow_titulo" style="padding-top: 12px;" >{{ $item->TITULO }}</h3>
															</div>
														</div>
													</div>
												</div>
											</div>
            		
            								@empty
            								   <div class="col-lg-12 text-center">
        											<div class="card box-shadow-0 mb-lg-0">
        												<div class="card-body">
        													<div class="item-box text-center">
        														<div class="stamp text-center stamp-lg bg-primary "><i class="fa fa-bandcamp"></i></div>
        															<div class="item-box-wrap">
        																<h5 class="mb-2">No existen grupos registrados</h5>
        															</div>
        														</div>
        													</div>
        												</div>
        											</div>
            		                        @endforelse
            		                           
		                                    @endisset
										</div>
										<!-- /row -->
								
							
						
    	


@endsection
@section('scripts')
<script>
   
</script>
@endsection