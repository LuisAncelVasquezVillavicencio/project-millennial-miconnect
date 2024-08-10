@extends('template.app')
@section('title', 'Envio masivo')
@section('content')
<style>
   ul.filters{
      list-style-type:none;
      padding:0;
   }
   ul.filters li{
      display:flex;
      padding: 0.2rem;
      line-break: anywhere;
      align-items: center;
      gap:0px 5px;
   }
</style>
<div class="page-breadcrumb d-flex align-items-center">
   <div class="bread-crumb-custom w-100 d-flex align-items-center">
   	<div class="breadcrumb-title pe-3">Envio masivo</div>
   	<div class="ps-3 mb-0 mb-md-0">
   		<nav aria-label="breadcrumb">
   			<ol class="breadcrumb mb-0 p-0">
   				<li class="breadcrumb-item"><a href="{{route('grupos')}}"><i class="bx bx-home-alt"></i></a>
   				</li>
   				<li class="breadcrumb-item active" aria-current="page">Paso 2: Filtrar o segmentar contactos </li>
   			</ol>
   		</nav>
   	</div>
	</div>
</div>
<div class="row mt-3">
   <div class="col-md-3">
      <form id="form_left" method="post" action="{{route('Sent_2',$id_grupo)}}">
         @if(isset($data_filtros))
   				@php($count = 0 )
               @foreach($data_filtros as $item => $valores)
                @if (!($valores["cabecera"] == ''))
                  @php($count++)
                  <div class="card">
      						<div class="card-header border-top bg-gradient-secondary">
      							<a role="button" data-bs-toggle="collapse" data-bs-target=".{{"VAL_GRUPO".$count}}" class="card-title text-primary" aria-expanded="false" aria-controls="{{"VAL_GRUPO".$count}}"> {{$valores["cabecera"]}} </a>
      						</div>
      						<div class="card-body collapse {{"VAL_GRUPO".$count}}">
      						   <ul class="filters" >
      						      @foreach($valores["filtros"] as $val )
   										@if (!($val == ''))
      						      <li>
      										<input type="checkbox" class="custom-control-input check_form " name="{{ "VAL_GRUPO".$count }}[]" value="{{ $val }}">
      										<span class="custom-control-label ">
      											{{ $val }}
      										</span>
   									</li>
   									   @endif
   									@endforeach
      						   </ul>
      						</div>
      				</div>
      			 @else
      			   @php($count++)
      			 @endif
               @endforeach
              @if($data_filtros["GRUPO1"]["cabecera"] == "" && $data_filtros["GRUPO2"]["cabecera"] == "" && $data_filtros["GRUPO3"]["cabecera"] == "" && $data_filtros["GRUPO4"]["cabecera"] == "" && $data_filtros["GRUPO5"]["cabecera"] == "" )
              <div class="card">
						<div class="card-header border-top bg-gradient-secondary">
						   No existen filtros
						</div>
      			</div>
              @endif
         @endif
	  </form>
   </div>
   <div class="col-md-9">
      <div class="card">
         <div class="card-body">
            <div class="row mb-3 d-flex">
               <form method="POST" action="{{ route('Sent_3') }}" class="d-flex">
						@csrf
						<input type="hidden" name="id_grupo" value="{{ $id_grupo }}"/>
						<button type="submit" class="btn btn-primary btn-sm ms-auto" >
							<i class="bx bx-send"></i> Continuar 
						</button>
						<a href="{{ route('Sent_1') }}" class="btn btn-danger btn-sm ms-1">
							<i class="bx bx-chevron-left"></i>Cancelar y volver 
						</a>	
					</form>
            </div>
            <div class="row  contact-table">
            @include("sent.envio_masivo.paso2-table")
            </div>
         </div>
      </div>
   </div>

</div>
@endsection
@section('scripts')
<script>
   
   const url_consult = window.location.href;
   var current_xhr = null

   $(document).ready(function(){
      
      $(".check_form").on("change",function(){
         sent_filters();
      })
      
      $('body').on('click', '.paginado a', function(e) {
	        e.preventDefault();
	        var url = $(this).attr('href');
	        sent_filters(url);
	        
    	});
      
   })
   
   function sent_filters(url = null){
      
      let data = $("#form_left").serialize();
      
      if(url == null){
         url = $("#form_left").attr("action");
      }
      
      if(current_xhr != null){
         current_xhr.abort();
      }
      
      current_xhr = $.ajax({
      	type:"POST",
			url:url,
			data: data,
			beforeSend: function(data)
	           {
	           	$(".contact-table").html("<tr><td style='text-align:center;' colspan='100'><i class='bx bx-loader-alt bx-spin'></i><span>Cargando</span></td></tr>")
	           	//alert(data);
	           }
   		}).done(function(data){
   			$(".contact-table").html(data)	
   		});
   }
   
</script>
@endsection