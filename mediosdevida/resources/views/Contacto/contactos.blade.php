@extends('layout.page_layout')
@section('title', 'Contactos')
@section('content')
<div class="page-header">

</div>
<div class="row">
	<div class="card">
		<div class="card-body">
			<div class="row">
				<h2 class="mb-1 col-md font-anton">Lista de contactos</h2>
				<div class="mb-1 col-md text-right">
					@if(count($grupos)>0)
					 <a class="btn btn-secondary bg-gradient-secondary btn-pill" id="btn_exportar_contacto" href="#">Exportar contacto</a>
					@endif
				</div>
			</div>
		</div>
	</div>	
</div>
<div class="row form-group">
	<div class="card">
		<div class="card-body">
				<form action="{{route('importar_contacto')}}" method="POST">
					<div class="row">
						@csrf
						<div class="col-md-3">
							<select class="form-control" id="combo_grupo" name="combo_grupo">
								@if(count($grupos)>0)
									@foreach($grupos as $linea)
										<option value="{{$linea->ID_GRUPO}}"
										{{($grupo_old == $linea->ID_GRUPO ) ? "selected" : ""}}
										>{{$linea->TITULO}}</option>
									@endforeach
								@else
										<option value=""></option>
								@endif
							</select>
						</div>
						<div class="col-md-9 text-right" >
							@if(count($grupos)>0)
			              <button class="btn btn-secondary bg-gradient-secondary btn-pill" id="btn_nuevo_contacto" onclick="OpenModal('0')" type="button">Nuevo contacto</button>
			              <button class="btn btn-secondary bg-gradient-secondary btn-pill" id="btn_importar_contacto" type="submit">Importar contacto</a>
			         	@endif
			         </div>
			      </div>
	         </form>
		</div>		
	</div>
</div>
<div class="row form-group">
	<div class="card">
		<div class="card-body">
			<div class="row">
				<div class=" mb-3 col-1">
					<label class="font-anton">Buscar:</label>
				</div>
				<div class="col"><input class="form-control " name="txt_busqueda" id="txt_busqueda" placeholder="Ingrese numero, nombre o apellido a buscar"/></div>
				<div class="col-1  text-left"><button class="btn btn-secondary bg-gradient-secondary btn-pill" onclick="busqueda()">Buscar</button></div>
				<div class="col-5  text-left"><button class="btn btn-secondary bg-gradient-secondary btn-pill" onclick="reiniciar()">Reiniciar</button></div>
			</div>
		</div>
	</div>
</div>
<div class="row form-group">
	<div class="card">
		<div class="card-body">
			<div class="row">
				<div id="cargar" class="table-responsive">
			 	  @if (count($contactos_grupo) > 0)
		           @include('Contacto.contactos_grupo')
		        @else
						<div class=col-md-12>
							<table class="table card-table border table-vcenter text-nowrap" >
								<tr>
									<td class="bg-warning">No hay datos para mostrar</td>
								</tr>
							</table>
						</div>
		        @endif
		     	</div>
			</div>
		</div>
	</div>
</div>

<div class="col-md-12">
	<div class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
		<div class="modal-dialog" role="document" style="min-width:80%">
			<div class="modal-content shadow border-0">
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12">
							<div class="card-body">
								<form id= "form_modal_grupo" name="form_modal_grupo" action="{{route('guardar_contacto','cond')}}">
								<div class="modal_contacto"></div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection
@section('scripts')
<script>
$(function() {
    var grupo_actual = $( "#combo_grupo" ).val()
    Url_change()
    $('body').on('click', '.paginacion a', function(e) {
        e.preventDefault();
        var url = $(this).attr('href');
        Obtener_contacto_grupo(url);
        window.history.pushState("", "", url);
    });
    
    $("#combo_grupo").change(function() {
    	
    	url= "{{route('contactos')}}";
    	Url_change();
    	$( "#txt_busqueda" ).val("")
		Obtener_contacto_grupo(url);
		window.history.pushState("", "", url);
	});

    $("#form_modal_grupo").submit(function(e) {

	    e.preventDefault(); // avoid to execute the actual submit of the form.
	    var form = $(this);
	    var url = form.attr('action');
	    $.ajax({
	           type: "POST",
	           url: url,
	           data: form.serialize(),
	           dataType: "json",
	           success: function(data)
	           {	
	           		$.growl.notice({ title: "OK", message: data.message})
	           		$(".help_nombre").html("");
	           		$(".help_apellido").html("");
	           		$(".help_numero").html("");
	           		$(".help_pais").html("");
	           		$(".help_grupo").html("");
	           		$(".help_grupo1").html("");
	           		$(".help_grupo2").html("");
	           		$(".help_grupo3").html("");
	           		$(".help_grupo4").html("");
	           		$(".help_grupo5").html("");
	                // show response from the php script.
	                url= "{{route('contactos')}}";
	               
					$('#modal-form').modal('hide')
					Obtener_contacto_grupo(url);
	           },
	           error: function (xhr) {
	           	
	               if (xhr.status == 422) {
	                   var errors = JSON.parse(xhr.responseText);
	
	                   if(errors.errors.NOMBRE_CONTACTO){
	                  	$(".help_nombre").html("<small class='form-text text-danger'>"+errors.errors.NOMBRE_CONTACTO+"</small>")
	                   }
	                   else{
	                   	$(".help_nombre").html("");
	                   }
	                   
	                  if(errors.errors.APELLIDO_CONTACTO){
	                  	$(".help_apellido").html("<small class='form-text text-danger'>"+errors.errors.APELLIDO_CONTACTO+"</small>")
	                   }
	                   else{
	                   	$(".help_apellido").html("");
	                   }
	                  if(errors.errors.NUMERO){
	                  	$(".help_numero").html("<small class='form-text text-danger'>"+errors.errors.NUMERO+"</small>")
	                   }
	                   else{
	                   	$(".help_numero").html("");
	                   }
	                   
	                  if(errors.errors.PAIS){
	                  	$(".help_pais").html("<small class='form-text text-danger'>"+errors.errors.PAIS+"</small>")
	                   }
	                   else{
	                   	$(".help_pais").html("");
	                   }
	                   
	                  if(errors.errors.GRUPO){
	                  	$(".help_grupo").html("<small class='form-text text-danger'>"+errors.errors.GRUPO+"</small>")
	                   }
	                   else{
	                   	$(".help_grupo").html("");
	                   }
	                   
	                  if(errors.errors.VAL_GRUPO1){
	                  	$(".help_grupo1").html("<small class='form-text text-danger'>"+errors.errors.VAL_GRUPO1+"</small>")
	                   }
	                   else{
	                   	$(".help_grupo1").html("");
	                   }
	                   
	                  if(errors.errors.VAL_GRUPO2){
	                  	$(".help_grupo2").html("<small class='form-text text-danger'>"+errors.errors.VAL_GRUPO2+"</small>")
	                   }
	                   else{
	                   	$(".help_grupo2").html("");
	                   }
	                   
	                   if(errors.errors.VAL_GRUPO3){
	                  	$(".help_grupo3").html("<small class='form-text text-danger'>"+errors.errors.VAL_GRUPO3+"</small>")
	                   }
	                   else{
	                   	$(".help_grupo3").html("");
	                   }
	                  if(errors.errors.VAL_GRUPO4){
	                  	$(".help_grupo4").html("<small class='form-text text-danger'>"+errors.errors.VAL_GRUPO4+"</small>")
	                   }
	                   else{
	                   	$(".help_grupo4").html("");
	                   }
	                  if(errors.errors.VAL_GRUPO5){
	                  	$(".help_grupo5").html("<small class='form-text text-danger'>"+errors.errors.VAL_GRUPO5+"</small>")
	                   }
	                   else{
	                   	$(".help_grupo5").html("");
	                   }
	                   
	                   
	               }
	           }
	         });
	});
	
});
function OpenModal(variable){
	grupo_actual = $( "#combo_grupo" ).val()
	$.ajaxSetup({
         headers:{
            "X-CSRF-TOKEN":$('meta[name="_token"]').attr('content')
         }
    })
	$.ajax({
	    method: "POST",
	    url:"{{route('modal_contacto')}}",
	    data:{
	        id : variable,
	        grupo : grupo_actual
	    },
	    success:function(datos){ 
	     
	      $(".modal_contacto").html(datos);
	      $('#modal-form').modal('show')
	    }
	    
	  }).done(function(data){

	  });
}
function eliminar(variable) {
      var txt;
      var r = confirm("¿Desea eliminar este contacto?");
      if (r == true) {
      $.ajaxSetup({
         headers:{
            "X-CSRF-TOKEN":$('meta[name="_token"]').attr('content')
         }
   		 })
        $.ajax({
            method: "POST",
            url:"{{route('eliminar_contacto')}}",
            data:{
                id : variable
            },
            dataType: "json",
            success:function(datos){ 
                $.growl.notice({ title: "OK", message: datos.mensaje});
                url= "{{route('contactos')}}";
                Obtener_contacto_grupo(url);
            }
            
            });
      } else {
        "";
      }
	};
function busqueda(){
	 url= "{{route('contactos')}}";
    Obtener_contacto_grupo(url);
}
function reiniciar(){
	 $( "#txt_busqueda" ).val("")
	 url= "{{route('contactos')}}";
    Obtener_contacto_grupo(url);
}
function Obtener_contacto_grupo(url) {
    	grupo_actual = $( "#combo_grupo" ).val()
    	busqueda_actual = $( "#txt_busqueda" ).val()
        $.ajax({
            url : url,
            data: { grupo:grupo_actual,
            busqueda: busqueda_actual
            } ,
            beforeSend:function (){
            	cargando = "<div class='container' ><div class='row align-items-center'><div class='col'></div>"+
            	"<label class='text-warning col text-center'><img src='{{asset('images_theme/tenor.gif')}}' style='width:50%;height:50%'/></label>"+
            	"<div class='col'></div></div></div>"
    
				 $("#cargar").html(cargando)
            }
        }).done(function (data) {
            $('#cargar').html(data)
            
        }).fail(function () {
        });
    }
function Url_change() {
	grupo_actual = $( "#combo_grupo" ).val()
    concat = "{{route('exportar_contacto','replace')}}"
	concat = concat.replace("replace", grupo_actual);
    $("#btn_exportar_contacto").attr("href",concat );	
}
</script>
@endsection

