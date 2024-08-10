@extends('template.app')
@section('title', 'Bots')
@section('content')

<div class="page-breadcrumb d-flex align-items-center">
   <div class="bread-crumb-custom w-100 d-flex align-items-center">
   	<div class="breadcrumb-title pe-3">Bots</div>
   	<div class="ps-3 mb-0 mb-md-0">
   		<nav aria-label="breadcrumb">
   			<ol class="breadcrumb mb-0 p-0">
   				<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
   				</li>
   				<li class="breadcrumb-item active" aria-current="page">Listado</li>
   			</ol>
   		</nav>
   	</div>
	</div>
	<div class="ms-auto">
		<div class="btn-group">
			<button type="button" class="btn btn-primary dropdown-toggle " data-bs-toggle="dropdown">Opciones</button>
			{{--<button type="button" class="btn btn-primary split-bg-primary dropdown-toggle dropdown-toggle-split" >	<span class="visually-hidden">Toggle Dropdown</span>
			</button>--}}
			</button>
			<div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-end">	
			   <a class="dropdown-item" href="javascript:;" data-bs-toggle="modal" data-bs-target="#create_modal">Crear nuevo bot</a>
			   @if($bienvenida == null)
			   <a class="dropdown-item" href="javascript:;" data-bs-toggle="modal" data-bs-target="#create_welcome">Crear mensaje de bienvenida</a>
			   @endif
			</div>
		</div>
	</div>
</div>

<div class="row mt-3" data-masonry='{"percentPosition": true }'>
   @if($bienvenida != null)
         <div class="col-md-4 col-sm-6 col-xs-12">
      		<div class="card border-success border-bottom border-3 border-0">
      			<div class="card-body">
      				<h5 class="card-title text-success">Mensaje de bienvenida</h5>
      				<p class="card-text">{{$bienvenida->MENSAJE}}</p>
      				@if($bienvenida->ESTADO == 1)
      				<span class="badge bg-primary">Activo</span>
      				@else
      				<span class="badge bg-secondary">Inactivo</span>
      				@endif
      				<hr>
      				<div class="d-flex align-items-center gap-2">
      				   <button data-id="{{$bienvenida->ID_BIENVENIDA}}" class="edit-welcome btn btn-inverse-success">
      					   <i class='bx bx-pencil'></i>Editar
      					</button>
      				</div>
      			</div>
      		</div>
      	</div>
   @endif
   @foreach($encuestas as $linea)
      <div class="col-md-4 col-sm-6 col-xs-12">
   		<div class="card border-primary border-bottom border-3 border-0">
   			<div class="card-body">
   				<h5 class="card-title text-primary">{{$linea->TITULO_ENCUESTA}}</h5>
   				<p class="card-text">{{($linea->DESCRIPCION == '')? "Sin descripción" : $linea->DESCRIPCION}}</p>
   				@if($linea->ESTADO == 1)
   				<div class="w-100 mb-2">
   				   <span class="badge bg-primary">Activo</span>
   				</div>
   				@else
   				<div class="w-100 mb-2">
   				   <span class="badge bg-secondary">Inactivo</span>
   				</div>
   				@endif
   				<button href="javascript:;" class="btn btn-inverse-primary">
					   <i class='bx bx-star'></i>{{$linea->PALABRA_CLAVE}}
					</button>
   				<hr>
   				<div class="d-flex align-items-center gap-2">
   				   <button data-id="{{$linea->ID_ENCUESTA}}" class="edit btn btn-inverse-primary">
   					   <i class='bx bx-pencil'></i>Editar
   					</button>
   					<a href="{{route('bot.pregunta',$linea->ID_ENCUESTA)}}" class="btn btn-primary"><i class='bx bx-cog' ></i>Configuración</a>
   				</div>
   			</div>
   		</div>
   	</div>
   @endforeach
</div>



<div class="modal fade" id="create_modal" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog modal-lg ">
		<div class="modal-content ">
			<div class="modal-header border-top border-0 border-4 border-primary ps-4 pe-4 ">
				<h5 class="modal-title text-primary "><i class="bx bx-bot"></i> Crear nuevo bot</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form id="bot-create" action="{{route('bot.create')}}" method="POST">
			   @csrf
   			<div class="modal-body ps-4 pe-4">
   			   
   			   <div class="row g-3">
   			      <div class="col-12">
   			         <label for="TITULO_ENCUESTA" class="form-label">Titulo de bot *</label>
   			         <input name="TITULO_ENCUESTA" id="TITULO_ENCUESTA" class="form-control" placeholder="Titulo del bot" required>
   			      </div>
   			      <div class="col-12">
   			         <label for="PALABRA_CLAVE" class="form-label">Palabra o frase clave *</label>
   			         <input name="PALABRA_CLAVE" id="PALABRA_CLAVE" class="form-control" placeholder="Llave para activación del bot" required>
   			      </div>
   			      <div class="col-12">
   			         <label for="DESCRIPCION" class="form-label">Descripción *</label>
   			         <textarea name="DESCRIPCION" id="DESCRIPCION" class="form-control" placeholder="Descripción del bot" required></textarea>
   			      </div>
   			      <div class="col-12">
   			         <label for="MSM_BIENVENIDA" class="form-label">Mensaje de bienvenida</label>
   			         <textarea name="MSM_BIENVENIDA" id="MSM_BIENVENIDA" class="form-control" placeholder="Mensaje de bienvenida del bot (opcional)"></textarea>
   			      </div>
   			      <div class="col-12">
   			         <label for="MSM_DESPEDIDA" class="form-label">Mensaje de despedida</label>
   			         <textarea name="MSM_DESPEDIDA" id="MSM_DESPEDIDA" class="form-control" placeholder="Mensaje de despedida del bot (opcional)"></textarea>
   			      </div>
   			      <div class="col-md-6 col-sm-12">
                     <label for="ESTADO" class="form-label">Activar bot</label>
   			         <div class="form-check">
								<input class="form-check-input" type="checkbox" value="1" id="ESTADO_ENCUESTA" name="ESTADO_ENCUESTA">
								<label class="form-check-label" for="ESTADO_ENCUESTA">Si</label>
							</div>
   			      </div>
   			   </div>
   			</div>
   			<div class="modal-footer">
   				<button type="button" class="btn btn-link" data-bs-dismiss="modal">Cerrar</button>
   				<button type="submit" class="btn btn-primary">Crear</button>
   			</div>
			</form>
		</div>
	</div>
</div>


<div class="modal fade" id="edit_modal" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog modal-lg ">
		<div class="modal-content ">
			<div class="modal-header border-top border-0 border-4 border-primary ps-4 pe-4 ">
				<h5 class="modal-title text-primary "><i class="bx bx-bot"></i> Editar bot</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form id="bot-update" action="{{route('bot.update')}}" method="POST">
			   @csrf
   			<div class="modal-body ps-4 pe-4">
   			   <input type="hidden" name="ID_ENCUESTA_E" id="ID_ENCUESTA_E">
   			   <div class="row g-3">
   			      <div class="col-12">
   			         <label for="TITULO_ENCUESTA" class="form-label">Titulo de bot *</label>
   			         <input name="TITULO_ENCUESTA_E" id="TITULO_ENCUESTA_E" class="form-control" placeholder="Titulo del bot" required>
   			      </div>
   			      <div class="col-12">
   			         <label for="PALABRA_CLAVE" class="form-label">Palabra o frase clave *</label>
   			         <input name="PALABRA_CLAVE_E" id="PALABRA_CLAVE_E" class="form-control" placeholder="Llave para activación del bot" required>
   			      </div>
   			      <div class="col-12">
   			         <label for="DESCRIPCION" class="form-label">Descripción *</label>
   			         <textarea name="DESCRIPCION_E" id="DESCRIPCION_E" class="form-control" placeholder="Descripción del bot" required></textarea>
   			      </div>
   			      <div class="col-12">
   			         <label for="MSM_BIENVENIDA" class="form-label">Mensaje de bienvenida</label>
   			         <textarea name="MSM_BIENVENIDA_E" id="MSM_BIENVENIDA_E" class="form-control" placeholder="Mensaje de bienvenida del bot (opcional)"></textarea>
   			      </div>
   			      <div class="col-12">
   			         <label for="MSM_DESPEDIDA" class="form-label">Mensaje de despedida</label>
   			         <textarea name="MSM_DESPEDIDA_E" id="MSM_DESPEDIDA_E" class="form-control" placeholder="Mensaje de despedida del bot (opcional)"></textarea>
   			      </div>
   			      <div class="col-md-6 col-sm-12">
                     <label for="ESTADO_E" class="form-label">Activar bot.</label>
   			         <div class="form-check">
								<input class="form-check-input" type="checkbox" value="1" id="ESTADO_ENCUESTA_E" name="ESTADO_ENCUESTA_E">
								<label class="form-check-label" for="ESTADO_ENCUESTA_E">Si</label>
							</div>
   			      </div>
   			   </div>
   			</div>
   			<div class="modal-footer">
   				<button type="button" class="btn btn-link" data-bs-dismiss="modal">Cerrar</button>
   				<button type="submit" class="btn btn-primary">Guardar</button>
   			</div>
			</form>
		</div>
	</div>
</div>

@if($bienvenida == null)
<div class="modal fade" id="create_welcome" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog modal-lg ">
		<div class="modal-content ">
			<div class="modal-header border-top border-0 border-4 border-primary ps-4 pe-4 ">
				<h5 class="modal-title text-primary "><i class="bx bx-bot"></i> Crear saludo de bienvenida</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form id="bot-create-welcome" action="{{route('bot.create_welcome')}}" method="POST">
			   @csrf
   			<div class="modal-body ps-4 pe-4">
   			   <div class="row g-3">
   			      <div class="col-12">
   			         <label for="MENSAJE" class="form-label">Mensaje de bienvenida *</label>
   			         <textarea name="MENSAJE" id="MENSAJE" class="form-control" placeholder="Mensaje de bienvenida" required></textarea>
   			      </div>
   			      <div class="col-md-6 col-sm-12">
                     <label for="IMG" class="form-label">Incluir imagen</label>
   			         <div class="form-check">
								<input class="form-check-input" type="checkbox" value="1" id="IMG" name="IMG">
								<label class="form-check-label" for="IMG">Si</label>
							</div>
   			      </div>
   			      <div class="col-12">
                     <label for="URL_IMG" class="form-label">Imagen</label>
   			         <input name="URL_IMG" id="URL_IMG" class="form-control" placeholder="Dirección web de la imagen" type="url" disabled required>
   			      </div>
   			      <div class="col-md-6 col-sm-12">
                     <label for="ESTADO" class="form-label">Mostrar mensaje de bienvenida.</label>
   			         <div class="form-check">
								<input class="form-check-input" type="checkbox" value="1" id="ESTADO" name="ESTADO">
								<label class="form-check-label" for="ESTADO">Si</label>
							</div>
   			      </div>
   			   </div>
   			</div>
   			<div class="modal-footer">
   				<button type="button" class="btn btn-link" data-bs-dismiss="modal">Cerrar</button>
   				<button type="submit" class="btn btn-primary">Crear</button>
   			</div>
			</form>
		</div>
	</div> 
</div>
@endif
@if($bienvenida != null)
<div class="modal fade" id="edit_welcome" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog modal-lg ">
		<div class="modal-content ">
			<div class="modal-header border-top border-0 border-4 border-primary ps-4 pe-4 ">
				<h5 class="modal-title text-primary "><i class="bx bx-bot"></i> Editar saludo de bienvenida</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form id="bot-edit-welcome" action="{{route('bot.update_welcome',$bienvenida->ID_BIENVENIDA)}}" method="POST">
			   @csrf
   			<div class="modal-body ps-4 pe-4">
   			   <div class="row g-3">
   			      <div class="col-12">
   			         <label for="MENSAJE" class="form-label">Mensaje de bienvenida *</label>
   			         <textarea name="MENSAJE" id="MENSAJE" class="form-control" placeholder="Mensaje de bienvenida" required></textarea>
   			      </div>
   			      <div class="col-md-6 col-sm-12">
                     <label for="IMG" class="form-label">Incluir imagen</label>
   			         <div class="form-check">
								<input class="form-check-input" type="checkbox" value="1" id="IMG" name="IMG">
								<label class="form-check-label" for="IMG">Si</label>
							</div>
   			      </div>
   			      <div class="col-12">
                     <label for="URL_IMG" class="form-label">Imagen</label>
   			         <input name="URL_IMG" id="URL_IMG" class="form-control" placeholder="Dirección web de la imagen" type="url" disabled required>
   			      </div>
   			      <div class="col-md-6 col-sm-12">
                     <label for="ESTADO" class="form-label">Mostrar mensaje de bienvenida.</label>
   			         <div class="form-check">
								<input class="form-check-input" type="checkbox" value="1" id="ESTADO" name="ESTADO">
								<label class="form-check-label" for="ESTADO">Si</label>
							</div>
   			      </div>
   			   </div>
   			</div>
   			<div class="modal-footer">
   				<button type="button" class="btn btn-link" data-bs-dismiss="modal">Cerrar</button>
   				<button type="submit" class="btn btn-primary">Crear</button>
   			</div>
			</form>
		</div>
	</div>
</div>
@endif

@endsection
@section('scripts')
<script>
   
   var ref = "";
   $(document).ready(function(){
      
      $("#bot-create-welcome").on("submit",function(e){
         e.preventDefault();
         store_welcome($(this));
      })
      $("#bot-edit-welcome").on("submit",function(e){
         e.preventDefault();
         update_welcome($(this));
      })
      
      $("#bot-create").on("submit",function(e){
         e.preventDefault();
         store_bot($(this));
      })
      
      $("#bot-update").on("submit",function(e){
         e.preventDefault();
         update_bot($(this));
      })
      
      $('#create_modal').on('hidden.bs.modal', function (e) {
         $(this).find("form").trigger("reset");
      })
      
      $('#create_welcome').on('hidden.bs.modal', function (e) {
         $(this).find("form").trigger("reset");
      })
      
      $('body').on('click', '.edit', function(e) {
         open_edit($(this).attr("data-id"));   
      })
       @if($bienvenida != null)
      $('.edit-welcome').on("click",function(e){
         open_edit_welcome($(this).attr("data-id"));
      })
      @endif
      
      $("#IMG").on("change",function(){
         
         if($(this).is(":checked")){
            $("#URL_IMG").prop("disabled",false);
         }
         else{
            $("#URL_IMG").prop("disabled",true);
         }
         
      })
      
   })
    @if($bienvenida != null)
   function open_edit_welcome(id){
      $.ajax({
        url: "{{route('bot.edit_welcome',$bienvenida->ID_BIENVENIDA)}}",
        data: {id:id},
        type: 'get',
        dataType: "json",
        beforeSend:function(data){
            
        },      
        success: function(data){
            $("#edit_welcome").find("form").trigger("reset");
            if(data.ID_BIENVENIDA){
               $.each(data,function(key,value){
                 if(!$("#"+key).is(":checkbox") && !$("#"+key).is("select")){
                      $("#"+key).val(value);
                   }
                  else{
                     if(value == 1){
                        $("#"+key).attr('checked', true).triggerHandler('change')
                     }
                     else if (value == 0 && $("#"+key).is(":checkbox")){
                        $("#"+key).attr('checked', false).triggerHandler('change')
                     }
                     else if(value != 0){
                        $("#"+key).val(value)
                     }
                   }
               })
               $("#edit_welcome").modal("show");
            }
            else{
               notification_custom("warning","No se encontrarón datos");
            }
        }
      })
   }
   @endif
   
   function open_edit(id){
      
      $.ajax({
        url: "{{route('bot.edit')}}",
        data: {id:id},
        type: 'get',
        dataType: "json",
        beforeSend:function(data){
            
        },      
        success: function(data){
            $("#edit_modal").find("form").trigger("reset");
            if(data.ID_ENCUESTA){
               $.each(data,function(key,value){
                  if((key) == "ESTADO"){
                     
                     if( value == 1){
                        $("#ESTADO_ENCUESTA_E").attr('checked', true).triggerHandler('change')
                     }
                     else{
                        $("#ESTADO_ENCUESTA_E").attr('checked', false).triggerHandler('change')
                     }
                     
                  
                  }
                  else{
                     $("#"+key+"_E").val(value);
                  }
               })
               $("#edit_modal").modal("show");
            }
            else{
              notification_custom("warning","No se encontrarón datos");
            }
        }
      })
      
   }
   
   function store_bot(formdata){
      
      url = $(formdata).attr("action");
      fd = new FormData();
      fd = formdata;
      $.ajax({
        url: url,
        data: fd.serialize(),
        type: 'POST',
        dataType: "json",
        beforeSend:function(data){
            $(formdata).find("button").prop('disabled', true)
        },      
        success: function(data){
            if(data.resultado == "ok"){
               notification_custom("success","Creado con exito!");
               location.reload();
            }
            else if(data.errors){
               error_marker(data);
               $(formdata).find("button").prop('disabled', false)
            }
            
        }
     });
   }
   
   function update_bot(formdata){
      
      url = $(formdata).attr("action");
      fd = new FormData();
      fd = formdata;
      $.ajax({
        url: url,
        data: fd.serialize(),
        type: 'POST',
        dataType: "json",
        beforeSend:function(data){
            $(formdata).find("button").prop('disabled', true)
        },      
        success: function(data){
            if(data.resultado == "ok"){
               notification_custom("success","Editado con exito!");
               location.reload();
            }
            else if(data.errors){
               error_marker(data);
               
               $(formdata).find("button").prop('disabled', false)
            }
            
        }
     });
   }
   
   function store_welcome(formdata){
      
      url = $(formdata).attr("action");
      fd = new FormData();
      fd = formdata;
      $.ajax({
        url: url,
        data: fd.serialize(),
        type: 'POST',
        dataType: "json",
        beforeSend:function(data){
            $(formdata).find("button").prop('disabled', true)
        },      
        success: function(data){
            if(data.resultado == "ok"){
               notification_custom("success","Creado con exito!");
               location.reload();
            }
            else if(data.errors){
               error_marker(data);
               $(formdata).find("button").prop('disabled', false)
            }
            
        }
     });
   }
   
   function update_welcome(formdata){
      
      url = $(formdata).attr("action");
      fd = new FormData();
      fd = formdata;
      $.ajax({
        url: url,
        data: fd.serialize(),
        type: 'POST',
        dataType: "json",
        beforeSend:function(data){
            $(formdata).find("button").prop('disabled', true)
        },      
        success: function(data){
            if(data.resultado == "ok"){
               notification_custom("success","Editado con exito!");
               location.reload();
            }
            else if(data.errors){
               error_marker(data);
               $(formdata).find("button").prop('disabled', false)
            }
           
        }
     });
   }
   
   @if(session('eliminado'))
      notification_custom("success","Exito al eliminar bot");
   @endif
   
</script>
@endsection