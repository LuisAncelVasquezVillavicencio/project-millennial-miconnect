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
			   <a class="dropdown-item add_modal" href="javascript:;">Agregar grupo</a>
			</div>
		</div>
	</div>
</div>
<div class="row mt-3" data-masonry='{"percentPosition": true }'>
   <div class="col-md-4 col-sm-6 col-xs-12">
		<div class="card border-success border-bottom border-3 border-0">
			<div class="card-body">
				<h5 class="card-title text-success">Sin categoria</h5>
				<p class="card-text">Grupos cuyas categorias no han sido asignadas
				<br>
				{{$count_grupos}} Grupos
				</p>
				<div class="d-flex align-items-center gap-2">
				   <a data-id="-" href="{{route('grupo_categoria','no-asignado')}}" class="btn btn-inverse-success">
					   <i class='bx bxs-group'></i>Ver grupos
					</a>
				</div>
			</div>
		</div>
	</div>
   @foreach($categorias as $item)
   <div class="col-md-4 col-sm-6 col-xs-12">
		<div class="card border-primary border-bottom border-3 border-0">
			<div class="card-body">
				<h5 class="card-title text-primary">{{$item->CATEGORIA}}</h5>
				<p class="card-text">
				{{(isset($item->grupos))? count($item->grupos) : 0}} Grupos
				</p>
				<div class="d-flex align-items-center gap-2">
				   <a data-id="-" href="{{route('grupo_categoria',$item->ID_CATEGORIA)}}" class="btn btn-inverse-primary">
					   <i class='bx bxs-group'></i>Ver grupos
					</a>
				</div>
			</div>
		</div>
	</div>
   @endforeach
</div>


<div class="modal fade" id="add_modal" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog modal-lg ">
		<div class="modal-content ">
			<div class="modal-header border-top border-0 border-4 border-primary ps-4 pe-4 ">
				<h5 class="modal-title text-primary "><i class="bx bx-group"></i> Agregar Grupo</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form id="group-create" action="{{route('guardar_grupo')}}" method="POST">
			   @csrf
   			<div class="modal-body ps-4 pe-4">
   			   <input type="hidden" name="ID_GRUPO" id="ID_GRUPO">
   			   <div class="row g-3">
   			      <div class="col-12">
   			         <label for="TITULO" class="form-label">Nombre de grupo *</label>
   			         <input name="TITULO" id="TITULO" class="form-control" placeholder="Nombre de grupo *" required>
   			      </div>
   			      <div class="col-12">
   			         <label for="DESCRIPCION" class="form-label">Descripción *</label>
   			         <textarea name="DESCRIPCION" id="DESCRIPCION" class="form-control" placeholder="Descripción" required></textarea>
   			      </div>
   			      <div class="col-6">
   			         <label for="NOM_GRUPO_1" class="form-label">Campo 1</label>
   			         <input name="NOM_GRUPO_1" id="NOM_GRUPO_1" class="form-control" placeholder="Máximo 100 caracteres">
   			      </div>
   			      <div class="col-6">
   			         <label for="NOM_GRUPO_2" class="form-label">Campo 2</label>
   			         <input name="NOM_GRUPO_2" id="NOM_GRUPO_2" class="form-control" placeholder="Máximo 100 caracteres">
   			      </div>
   			      <div class="col-6">
   			         <label for="NOM_GRUPO_3" class="form-label">Campo 3</label>
   			         <input name="NOM_GRUPO_3" id="NOM_GRUPO_3" class="form-control" placeholder="Máximo 100 caracteres">
   			      </div>
   			      <div class="col-6">
   			         <label for="NOM_GRUPO_4" class="form-label">Campo 4</label>
   			         <input name="NOM_GRUPO_4" id="NOM_GRUPO_4" class="form-control" placeholder="Máximo 100 caracteres">
   			      </div>
   			      <div class="col-6">
   			         <label for="NOM_GRUPO_5" class="form-label">Campo 5</label>
   			         <input name="NOM_GRUPO_5" id="NOM_GRUPO_5" class="form-control" placeholder="Máximo 100 caracteres">
   			      </div>
   			      @if($plantillas != null)
   			      <div class="col-6">
   			         <label for="ID_PLANTILLA" class="form-label">Copiar plantilla</label>
   			         <div class="form-check">
						<input class="form-check-input" type="checkbox" value="1" id="ID_PLANTILLA" name="ID_PLANTILLA">
						<label class="form-check-label" for="ID_PLANTILLA">Si</label>
					</div>
   			      </div>
   			      @endif
   			      <div class="col-12">
   			         <label for="CATEGORIA_E" class="form-label">Categoria</label>
   			         <select class="form-control" name="ID_CATEGORIA" id="ID_CATEGORIA">
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

@endsection
@section('scripts')
<script>
	@if($plantillas != null)
	
	var pl = {"NOMBRE":'{{$plantillas->NOMBRE}}',"NOM_GRUPO_1":'{{$plantillas->NOM_GRUPO_1}}',"NOM_GRUPO_2":'{{$plantillas->NOM_GRUPO_2}}'
	,"NOM_GRUPO_3":'{{$plantillas->NOM_GRUPO_3}}',"NOM_GRUPO_4":'{{$plantillas->NOM_GRUPO_4}}',"NOM_GRUPO_5":'{{$plantillas->NOM_GRUPO_5}}'}
	
	@endif

   $(document).ready(function(){
   
      $(".add_modal").on("click",function(){
         open_modal();
      })
      $("#group-create").on("submit",function(e){
         e.preventDefault();
         create_group($(this));
      })
      
      @if($plantillas != null)
      $("#ID_PLANTILLA").on("change",function(){
      
    	if($(this).is(":checked")){
    	
    		$.each(pl,function(key,value){
    			if(key != "NOMBRE"){
    				$("#"+key).val(value);
    			}
    		})
    		
    	}
      
      })
      
      @endif
   
   })
   
   
   function open_modal(){
      $("#add_modal").find("form").trigger("reset");
      $("#add_modal").modal("show");
   }
   
   function create_group(formdata){
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
               notification_custom("success","Creado con éxito!");
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
</script>
@endsection