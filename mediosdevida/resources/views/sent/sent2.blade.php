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
											<h2 class="mb-1 font-anton"> PASO 2 SEGMENTAR CONTACTOS</h2>
											<div class=" my-auto ml-auto">
												<form method="POST" action="{{ route('Sent_3') }}">
													@csrf
													<input type="hidden" name="id_grupo" value="{{ $id_grupo }}"/>
													
												    <div class="row">
														<div class="col-sm-6">
														<button type="submit" class="btn btn-secondary btn-block bg-gradient-secondary btn-pill" >
															<i class="fa fa-send"></i> CONTINUAR 
														</button>
														</div>
														<div class="col-sm-6">
															<a href="{{ asset('sent1') }}" class="btn btn-cancelar btn-secondary bg-gradient-danger txt-color-white btn-pill" style="border-color: #d20c0c">
																		<i class="fa fa-remove"> CANCELAR</i> 
															</a>	
														</div>
													</div>
													
												</form>
											</div>
										</div>
									</div>
								</div>
							</div>
					</div>	
<!-- row opened -->
<div class="row">
						
							<!--Right Side Content-->
		
	@if (!($disable_filtros))
	<div class="col-xl-3 col-lg-12 col-md-12">
		<form method="POST" action="{{ route('Sent_2',$id_grupo) }}" id="form_left">
		@csrf
		<input type="hidden" name="id_grupo" value="{{ $id_grupo }}"/>
		
			@isset($data_filtros)
				@php($count = 0 )
	            @forelse($data_filtros as $item => $valores)
	                @if (!($valores[0] == ''))
		                @php($count ++ )
		            <div class="card">
						<div class="card-header border-top bg-gradient-secondary"   >
							<h3 class="card-title txt-color-white"> {{ $item  }} </h3>
						</div>
						<div class="card-body">
							<div class="" id="container">
								<div class="filter-product-checkboxs">
									@php($count_sup = 0 )
									@forelse($valores as $val )
										@if (!($val == ''))
										    @php($count_sup ++ )
										    <label class="custom-control custom-checkbox mb-3 ">
												<input type="checkbox" class="custom-control-input check_form " name="{{ $count.'_'.$count_sup }}" value="{{ $val }}">
												<span class="custom-control-label ">
													<a href="#" class="">{{ $val }}</a>
												</span>
											</label>
										@endif
									@empty
						            @endforelse
								</div>
							</div>
						</div>
						</div>
					@endif
					@empty
				@endforelse
	        @endisset
		
		
		</form>
	</div>
	@endif
	<!--Right Side Content-->
	
	<div class="col-xl-9 col-lg-12 col-md-12">
		<!--Add lists-->
		<div class="mb-lg-0">
			<div class="item2-gl table_r">
				  @include('sent.sent2_contacts')
			</div>
		</div>
	</div>
	<!--.Add lists-->
</div>

							
					
						<!-- row closed -->

@endsection
@section('scripts')
<script>
   $(function(){
   	$(".check_form").on("click",function(e){
   		var data = $("#form_left").serialize();
   		$.ajax({
   			type:"POST",
   			url:$("#form_left").attr("action"),
   			data: data,
   			beforeSend: function(data)
	           {
	           	$(".table_content").html("<tr><td style='text-align:center;' colspan='100'><img src='{{asset('images_theme/tenor.gif')}}' style='width:20%;height:22%'/></div></td></tr>")
	           	//alert(data);
	           }
   			}
   		).done(function(data){
   			$(".table_r").html(data)	
   		});
   		
   		
   	})
   })
</script>
@endsection