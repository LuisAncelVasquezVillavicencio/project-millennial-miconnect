@if(isset($datos_modal))
<div class="row form-group">
   <div class="text-left text-warning col-md-12 h4 xTitulo">
      {{$datos_modal[0]["titulo"]}}
   </div>
</div>
@csrf
<div class="row form-group">
	<div class="col-md-6" style="float:left">
		<div class="row form-group">
			<label class="control-label col-md-4">Nombre contacto*</label>
			<div class="col-md-8">
				<input type="text" name="NOMBRE_CONTACTO" id="NOMBRE_CONTACTO" class="form-control"
				value="{{($datos_modal[0]['nombre_contacto'] != "") ? $datos_modal[0]['nombre_contacto'] : ''}}"
				/>
			</div>
			<div class="help_nombre"></div>

		</div>
		<div class="row form-group">
			<label class="control-label col-md-4">Apellido contacto</label>
			<div class="col-md-8">
				<input type="text" name="APELLIDO_CONTACTO" id="APELLIDO_CONTACTO" class="form-control"
				value="{{($datos_modal[0]['apellido'] != "") ? $datos_modal[0]['apellido'] : ''}}"
				/>
			</div>
			<div class="help_apellido"></div>
		</div>
		<div class="row form-group">
			<label class="control-label col-md-4">Numero telefono*</label>
			<div class="col-md-8">
				<input type="text" name="NUMERO" id="NUMERO" class="form-control"
				value="{{($datos_modal[0]['numero_celular'] != "") ? $datos_modal[0]['numero_celular'] : ''}}"
				/>
			</div>
			<div class="help_numero"></div>
		</div>
		<div class="row form-group">
			<label class="control-label col-md-4">País*</label>
			<div class="col-md-8">
				<select class="form-control" name="PAIS" ID="PAIS">
					@foreach($pais as $linea)
						<option value="{{$linea->ID_PAIS}}" {{($datos_modal[0]['id_pais'] != 0 && $datos_modal[0]['id_pais'] == $linea->ID_PAIS ) ? "selected" : ""}} >{{$linea->NOMBRE_PAIS}}</option>
					@endforeach
				</select>
			</div>
			<div class="help_pais"></div>
		</div>
		<div class="row form-group" style="display:none;">
			<label class="control-label col-md-4">Grupo*</label>
			<div class="col-md-8">
				<select class="form-control" name="GRUPO" id="GRUPO" onchange="Obtener_campos()">
				@if(count($grupos)>0)
				   @if($datos_modal[0]['id'] != 0)
   					@foreach($grupos as $linea)
   					   @if($linea->ID_GRUPO == $datos_modal[0]['id_grupo'])
   						   <option value="{{$linea->ID_GRUPO}}" {{($grupo_actual ==$linea->ID_GRUPO ) ? "selected": ""}}>{{$linea->TITULO}}</option>
   						@endif
   					@endforeach
   				@else
   				   @foreach($grupos as $linea)
   				   	@if($linea->ID_GRUPO == $grupo_actual)
   						<option value="{{$linea->ID_GRUPO}}" {{($grupo_actual != 0 && $grupo_actual == $linea->ID_GRUPO ) ? "selected" : "" }} >{{$linea->TITULO}}</option>
   						@endif
   					@endforeach
   				@endif
				@else
						<option value=""></option>
				@endif
				</select>
			</div>
			<div class="help_grupo"></div>
		</div>
	</div>
	<input type="hidden" name="ID_C" id="ID_C" class="form-control" value = "{{$datos_modal[0]['id']}}"/>
	<div class="col-md-6" style="float:left;">
	   <div id="incluir_campos">
	      @include("Contacto.contactos_sub.contactos_modal_sub")
	   </div>
	</div>
</div>
   <div class="text-left mensaje_resp"></div>
<div class="text-right">
	<button type="submit" class="btn btn-secondary bg-gradient-secondary btn-pill my-4">Guardar</button>
	<button type="button" class="btn btn-danger bg-gradient-danger btn-pill my-4" onclick="$('#modal-form').modal('hide')">Cerrar</button>
</div>

<script >
   Obtener_campos()
   function Obtener_campos() {
    	grupo_actual = $("#GRUPO").val()
    	id_actual = "{{$datos_modal[0]['id']}}"
    	$.ajaxSetup({
         headers:{
            "X-CSRF-TOKEN":$('meta[name="_token"]').attr('content')
         }
   		})
        $.ajax({
            method:"POST",
            url : "{{route('Obtener_campos')}}",
            data: { grupo:grupo_actual,id:id_actual
            } ,
            beforeSend:function (){
            	cargando = "<div class='row align-items-center'><div class='col'></div>"+
            	"<label class='text-warning col text-center'><img src='{{asset('images_theme/tenor.gif')}}' style='width:50%;height:50%'/></label>"+
            	"<div class='col'></div></div>"
    
				   $("#incluir_campos").html(cargando)
            }
        }).done(function (data) {
            $('#incluir_campos').html(data)
            
        }).fail(function () {
        });
    }

</script>
@endif