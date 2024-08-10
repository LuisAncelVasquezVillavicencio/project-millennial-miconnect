@extends('template.app')
@section('title', 'Categorias')
@section('linksstyle')
@endsection
@section('content')
<div class="page-breadcrumb d-flex align-items-center">
   <div class="bread-crumb-custom w-100 d-flex align-items-center">
   	<div class="breadcrumb-title pe-3">Configuración</div>
   	<div class="ps-3 mb-0 mb-md-0">
   		<nav aria-label="breadcrumb">
   			<ol class="breadcrumb mb-0 p-0">
   				<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
   				</li>
   				<li class="breadcrumb-item active" aria-current="page">categorias</li>
   			</ol>
   		</nav>
   	</div>
	</div>
	<div class="ms-auto">
		<div class="btn-group">
			<button type="button" class="btn btn-primary dropdown-toggle " data-bs-toggle="dropdown">Opciones</button>
			</button>
			<div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-end">	
			   <a class="dropdown-item add_modal" href="javascript:;">Agregar categoria</a>
			</div>
		</div>
	</div>
</div>
<div class="row mt-3" >
	<div class="card">
   	<div class="card-body">
   		<table class="table mb-0">
   			<thead>
   				<tr>
   					<th scope="col">Categorias</th>
   					<th scope="col">Opciones</th>
   				</tr>
   			</thead>
   			<tbody>
   			   @foreach($categorias as $item)
   				<tr>
   					<td class="w-50">{{$item->CATEGORIA}}</td>
   					<td>
   					   <button class="btn btn-primary btn-editar" data-id="{{$item->ID_CATEGORIA}}"><i class="bx bx-pencil"></i> Editar</button>
   					   <button class="btn btn-danger btn-elim" data-id="{{$item->ID_CATEGORIA}}"><i class="bx bx-trash"></i> Eliminar</button>
   					</td>
   				</tr>
   				@endforeach
   			</tbody>
   		</table>
   	</div>
   </div>
</div>
<div class="modal fade" id="add_modal" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog modal-lg ">
		<div class="modal-content ">
			<div class="modal-header border-top border-0 border-4 border-primary ps-4 pe-4 ">
				<h5 class="modal-title text-primary "><i class="bx bxs-cog"></i> Agregar Grupo</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form id="categoria-create" action="{{route('config.categorias.save')}}" method="POST">
			   @csrf
   			<div class="modal-body ps-4 pe-4">
   			   <div class="row g-3">
   			      <div class="col-12">
   			         <label for="CATEGORIA" class="form-label">Categoria</label>
   			         <input name="CATEGORIA" id="CATEGORIA" class="form-control" placeholder="Categoria (Max: 255)*" required>
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
<div class="modal fade" id="edit_modal" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog modal-lg ">
		<div class="modal-content ">
			<div class="modal-header border-top border-0 border-4 border-primary ps-4 pe-4 ">
				<h5 class="modal-title text-primary "><i class="bx bxs-cog"></i> Agregar Grupo</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form id="categoria-edit" action="{{route('config.categorias.update')}}" method="POST">
			   @csrf
			   <input type="hidden" name="ID_CATEGORIA_E" id="ID_CATEGORIA_E">
   			<div class="modal-body ps-4 pe-4">
   			   <div class="row g-3">
   			      <div class="col-12">
   			         <label for="CATEGORIA_E" class="form-label">Categoria</label>
   			         <input name="CATEGORIA_E" id="CATEGORIA_E" class="form-control" placeholder="Categoria (Max: 255)*" required>
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
<div class="modal fade" id="destroy-categoria" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog modal-lg ">
		<div class="modal-content ">
			<div class="modal-header border-top border-0 border-4 border-primary ps-4 pe-4 ">
				<h5 class="modal-title text-primary "><i class="bx bx-trash"></i> Eliminar Grupo</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form id="form-destroy-categoria" action="{{route('config.categorias.delete')}}" method="POST">
			   @csrf
			   <input type="hidden" name="ID_CATEGORIA_EL" id="ID_CATEGORIA_EL" value="">
   			<div class="modal-body ps-4 pe-4">
   			   <div class="row g-3">
   			      <div class="col-12">
   			         ¿Desea eliminar esta categoria?. Los grupos asociados a esta, pasaran a ser grupos sin asignar.
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
      
      $("body").on("click",".add_modal",function(){
         open_modal();
      })
      $("body").on("click",".btn-editar",function(){
         open_edit($(this).attr("data-id"));
      })
      $("body").on("click",".btn-elim",function(){
         open_eliminar($(this).attr("data-id"));
      })
      $("#categoria-create").on("submit",function(e){
         e.preventDefault();
         categoria_create($(this));
      })
      $("#categoria-edit").on("submit",function(e){
         e.preventDefault();
         categoria_edit($(this));
      })
      $("#form-destroy-categoria").on("submit",function(e){
         e.preventDefault();
         categoria_destroy($(this));
      })
      
   })
   
   function open_modal(){
      $("#add_modal").find("form").trigger("reset");
      $("#add_modal").modal("show");
   }
   
   function open_eliminar(id){
      $("#destroy-categoria").find("form").trigger("reset");
      $("#destroy-categoria").find("#ID_CATEGORIA_EL").val(id);
      $("#destroy-categoria").modal("show");
   }
   
   function open_edit(id){
      url = "{{route('config.categorias.edit')}}"

      $.ajax({
        url: url,
        data: {id:id},
        type: 'get',
        dataType: "json",
        beforeSend:function(data){
            
        },      
        success: function(data){
            $("#edit_modal").find("form").trigger("reset");
            if(data.ID_CATEGORIA){
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
   
   function categoria_create(formdata){
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
   
   function categoria_edit(formdata){
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
   
   function categoria_destroy(formdata){
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
               $("#destroy-categoria").modal("hide");
               $(formdata).find("button").prop('disabled', false)
               notification_custom("success",data.mensaje);
               location.reload();
            }
            else if(data.resultado == "error"){
               c
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