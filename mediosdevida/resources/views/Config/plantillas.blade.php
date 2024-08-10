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
   				<li class="breadcrumb-item active" aria-current="page">plantillas</li>
   			</ol>
   		</nav>
   	</div>
	</div>
</div>
<div class="row mt-3" >
	<div class="card">
   	<div class="card-body">
   	   <form action="{{route('config.plantillas.save')}}" id="form-plantilla" method="POST">
   	      @csrf
      	   <div class="row">
      	      <div class="col-12 mb-3">
      	         <label for="NOMBRE" class="form-label">Nombre</label>
      	         <input name="NOMBRE" id="NOMBRE" class="form-control" placeholder="Máximo 255 caracteres" value="{{($plantillas != null) ? $plantillas->NOMBRE : ""}}" required>
      	      </div>
      	      <div class="col-md-6 col-sm-12 mb-3">
      	         <label for="NOM_GRUPO_1" class="form-label">Campo 1</label>
      	         <input name="NOM_GRUPO_1" id="NOM_GRUPO_1" class="form-control" placeholder="Máximo 100 caracteres" value="{{($plantillas != null) ? $plantillas->NOM_GRUPO_1 : ""}}">
      	      </div>
      	      <div class="col-md-6 col-sm-12 mb-3">
      	         <label for="NOM_GRUPO_2" class="form-label">Campo 2</label>
      	         <input name="NOM_GRUPO_2" id="NOM_GRUPO_2" class="form-control" placeholder="Máximo 100 caracteres" value="{{($plantillas != null) ? $plantillas->NOM_GRUPO_2 : ""}}">
      	      </div>
      	      <div class="col-md-6 col-sm-12 mb-3">
      	         <label for="NOM_GRUPO_3" class="form-label">Campo 3</label>
      	         <input name="NOM_GRUPO_3" id="NOM_GRUPO_3" class="form-control" placeholder="Máximo 100 caracteres" value="{{($plantillas != null) ? $plantillas->NOM_GRUPO_3 : ""}}">
      	      </div>
      	      <div class="col-md-6 col-sm-12 mb-3">
      	         <label for="NOM_GRUPO_4" class="form-label">Campo 4</label>
      	         <input name="NOM_GRUPO_4" id="NOM_GRUPO_4" class="form-control" placeholder="Máximo 100 caracteres" value="{{($plantillas != null) ? $plantillas->NOM_GRUPO_4 : ""}}">
      	      </div>
      	      <div class="col-md-6 col-sm-12 mb-3">
      	         <label for="NOM_GRUPO_5" class="form-label">Campo 5</label>
      	         <input name="NOM_GRUPO_5" id="NOM_GRUPO_5" class="form-control" placeholder="Máximo 100 caracteres" value="{{($plantillas != null) ? $plantillas->NOM_GRUPO_5 : ""}}">
      	      </div>
      	      <div class="col-6 mb-3 d-flex ">
      	         <div class="d-flex mt-auto ms-auto">
      	            <button class="btn btn-primary ms-auto" type="submit">Guardar</button>
      	         </div>
      	      </div>
   	      </div>
	      </form>
   	</div>
   </div>
</div>
@endsection
@section('scripts')
<script>
   $(document).ready(function(){
      $("#form-plantilla").on("submit",function(e){
         e.preventDefault();
         guardar($(this));
      })
   })
   
   function guardar(formdata){
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
               notification_custom("success","Actualizado con éxito");
               $(formdata).find("button").prop('disabled', false)
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