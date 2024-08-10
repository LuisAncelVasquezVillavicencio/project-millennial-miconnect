@extends('template.app')
@section('title', 'Grupos')
@section('linksstyle')
@endsection
@section('content')
<div class="page-breadcrumb d-flex align-items-center">
   <div class="bread-crumb-custom w-100 d-flex align-items-center">
   	<div class="breadcrumb-title pe-3">Grupos</div>
   	<div class="ps-3 mb-0 mb-md-0">
   		<nav aria-label="breadcrumb">
   			<ol class="breadcrumb mb-0 p-0">
   				<li class="breadcrumb-item"><a href="{{route('grupos')}}"><i class="bx bx-home-alt"></i></a>
   				</li>
   				<li class="breadcrumb-item active" aria-current="page">{{$titulo_cat}}</li>
   			</ol>
   		</nav>
   	</div>
	</div>
	<div class="ms-auto">
		<div class="btn-group">
			<button type="button" class="btn btn-primary dropdown-toggle " data-bs-toggle="dropdown">Opciones</button>
			</button>
			<div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-end">	
			   <a class="dropdown-item" href="{{route('grupos')}}">Volver</a>
			</div>
		</div>
	</div>
</div>
<div class="row mt-3" data-masonry='{"percentPosition": true }'>
   @foreach($grupos as $linea)
   <div class="col-md-4 col-sm-6 col-xs-12">
		<div class="card border-primary border-bottom border-3 border-0">
			<div class="card-body">
				<h5 class="card-title text-primary">{{ $linea->TITULO }}</h5>
				<p class="card-text">
				   {{$linea->DESCRIPCION}}<br>
					{{$linea->contactos_count}} Contactos
				</p>
				<div class="d-flex align-items-center gap-2">
				   <button data-id="{{$linea->ID_GRUPO}}" class="btn-editar btn btn-inverse-primary">
					   <i class='bx bxs-pencil'></i> Editar
					</button>
					<button data-id="{{$linea->ID_GRUPO}}" class="btn-delete btn btn-primary">
					   <i class='bx bxs-trash'></i> Eliminar
					</button>
				</div>
			</div>
		</div>
	</div>
	@endforeach
</div>
<div class="modal fade" id="edit_modal" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog modal-lg ">
		<div class="modal-content ">
			<div class="modal-header border-top border-0 border-4 border-primary ps-4 pe-4 ">
				<h5 class="modal-title text-primary "><i class="bx bx-group"></i> Editar Grupo</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form id="group-update" action="{{route('update_grupo')}}" method="POST">
			   @csrf
   			<div class="modal-body ps-4 pe-4">
   			   <input type="hidden" name="ID_GRUPO_E" id="ID_GRUPO_E">
   			   <div class="row g-3">
   			      <div class="col-12">
   			         <label for="TITULO" class="form-label">Nombre de grupo *</label>
   			         <input name="TITULO_E" id="TITULO_E" class="form-control" placeholder="Nombre de grupo *" required>
   			      </div>
   			      <div class="col-12">
   			         <label for="DESCRIPCION" class="form-label">Descripción *</label>
   			         <textarea name="DESCRIPCION_E" id="DESCRIPCION_E" class="form-control" placeholder="Descripción" required></textarea>
   			      </div>
   			      <div class="col-6">
   			         <label for="NOM_GRUPO_1_E" class="form-label">Campo 1</label>
   			         <input name="NOM_GRUPO_1_E" id="NOM_GRUPO_1_E" class="form-control" placeholder="Máximo 100 caracteres">
   			      </div>
   			      <div class="col-6">
   			         <label for="NOM_GRUPO_2_E" class="form-label">Campo 2</label>
   			         <input name="NOM_GRUPO_2_E" id="NOM_GRUPO_2_E" class="form-control" placeholder="Máximo 100 caracteres">
   			      </div>
   			      <div class="col-6">
   			         <label for="NOM_GRUPO_3_E" class="form-label">Campo 3</label>
   			         <input name="NOM_GRUPO_3_E" id="NOM_GRUPO_3_E" class="form-control" placeholder="Máximo 100 caracteres">
   			      </div>
   			      <div class="col-6">
   			         <label for="NOM_GRUPO_4_E" class="form-label">Campo 4</label>
   			         <input name="NOM_GRUPO_4_E" id="NOM_GRUPO_4_E" class="form-control" placeholder="Máximo 100 caracteres">
   			      </div>
   			      <div class="col-6">
   			         <label for="NOM_GRUPO_5_E" class="form-label">Campo 5</label>
   			         <input name="NOM_GRUPO_5_E" id="NOM_GRUPO_5_E" class="form-control" placeholder="Máximo 100 caracteres">
   			      </div>
   			      <div class="col-12">
   			         <label for="CATEGORIA_E" class="form-label">Categoria</label>
   			         <select class="form-control" name="ID_CATEGORIA_E" id="ID_CATEGORIA_E">
   			            @foreach($categorias as $item)
   			               <option value="{{$item->ID_CATEGORIA}}">{{$item->CATEGORIA}}</option>
   			            @endforeach
   			         </select>
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
<div class="modal fade" id="destroy-group" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog modal-lg ">
		<div class="modal-content ">
			<div class="modal-header border-top border-0 border-4 border-primary ps-4 pe-4 ">
				<h5 class="modal-title text-primary "><i class="bx bx-trash"></i> Eliminar Grupo</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form id="form-destroy-group" action="{{route('eliminar_grupo')}}" method="POST">
			   @csrf
			   <input type="hidden" name="ID_GRUPO_EL" id="ID_GRUPO_EL" value="">
   			<div class="modal-body ps-4 pe-4">
   			   <div class="row g-3">
   			      <div class="col-12">
   			         ¿Desea eliminar este grupo?
   			      </div>
   			   </div>
   			</div>
            <div class="modal-footer">
   				<button type="button" class="btn btn-link" data-bs-dismiss="modal">Cerrar</button>
   				<button type="submit" class="btn btn-primary">Eliminar</button>
   			</div>
			</form>
		</div>
	</div>
</div>
@endsection
@section('scripts')
<script>
   $(document).ready(function(){
      
      $("body").on("click",".btn-editar",function(){
         open_edit($(this).attr("data-id"));
      })
      $("#group-update").on("submit",function(e){
         e.preventDefault();
         update_group($(this));
      })
      $("#form-destroy-group").on("submit",function(e){
         e.preventDefault();
         group_destroy($(this));
      })
      $('#edit_modal').on('hidden.bs.modal', function (e) {
         $(this).find("form").trigger("reset");
      })
      
      $('body').on('click','.btn-delete',function(){
         
         id = $(this).attr("data-id");
         open_eliminar(id);
      })
   })
   
   function open_eliminar(id){
      $("#destroy-group").modal("show");
      $("#form-destroy-group").find("#ID_GRUPO_EL").val(id);
   }
   
   function open_edit(id){
      url = "{{route('editargrupo','')}}"+"/"+id

      $.ajax({
        url: url,
        data: {id:id},
        type: 'get',
        dataType: "json",
        beforeSend:function(data){
            
        },      
        success: function(data){
            $("#edit_modal").find("form").trigger("reset");
            if(data.ID_GRUPO){
               $.each(data,function(key,value){
                  $("#"+key+"_E").val(value);
               })
               $("#edit_modal").modal("show");
            }
            else{
              notification_custom("warning","No se encontrarón datos");
            }
        }
      })
      
   }
   
   function update_group(formdata){
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
            else if(data.resultado == "error"){
               notification_custom("warning",data.mensaje);
               $(formdata).find("button").prop('disabled', false)
            }
            else if(data.errors){
               error_marker(data);
               
               $(formdata).find("button").prop('disabled', false)
            }
            
        }
     });
   }
   
   function group_destroy(formdata){
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
               $("#destroy-group").modal("hide");
               $(formdata).find("button").prop('disabled', false)
               notification_custom("success",data.mensaje);
               location.reload();
            }
            else if(data.resultado == "error"){
               notification_custom("warning",data.mensaje);
               $(formdata).find("button").prop('disabled', false)
            }
            else if(data.errors){
               error_marker(data);
            }
            $(formdata).find("button").prop('disabled', false)
        },
        error: function(xhr, status, error) {

        }
     }).fail(function(data){
        notification_custom("warning","Ocurrio un error vuelva a intentarlo ");
        $(formdata).find("button").prop('disabled', false)
     })
   }
</script>
@endsection