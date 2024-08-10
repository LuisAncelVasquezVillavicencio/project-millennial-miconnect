@extends('template.app')
@section('title', 'Multimedia')
@section('linksstyle')
<link href="{{asset('new_temp/assets/css/multimedia.css')}}" rel="stylesheet" />
<link href="{{asset('plugins/fileuploads/css/dropify.css')}}" rel="stylesheet" />
@endsection
@section('content')
<div class="page-breadcrumb d-flex align-items-center">
   <div class="bread-crumb-custom w-100 d-flex align-items-center">
   	<div class="breadcrumb-title pe-3">Multimedia</div>
   	<div class="ps-3 mb-0 mb-md-0">
   		<nav aria-label="breadcrumb">
   			<ol class="breadcrumb mb-0 p-0">
   				<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
   				</li>
   				<li class="breadcrumb-item active" aria-current="page">Galeria</li>
   			</ol>
   		</nav>
   	</div>
	</div>
	<div class="ms-auto">
		<div class="btn-group">
			<button type="button" class="btn btn-primary dropdown-toggle " data-bs-toggle="dropdown">Opciones</button>
			</button>
			<div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-end">	
			   <a class="dropdown-item add" href="javascript:;">Agregar archivo</a>
			</div>
		</div>
	</div>
</div>
<div class="row mt-3">
   <div class="card">
		<div class="card-body">
			<div class="fm-search">
			   <div class="row">
   				<div class="col-md-6 col-sm-12 mb-1">
   					<div class="input-group input-group">	
   					   <span class="input-group-text bg-transparent"><i class='bx bx-search'></i></span>
   						<input type="text" class="form-control" placeholder="Buscar por nombre" name="bus_name" id="bus_name">
   					</div>
   				</div>
   				<div class="col-md-6 col-sm-12 mb-1">
   				   <div class="input-group">	
   					   <span class="input-group-text bg-transparent">Tipo de archivo:</span>
   						<select type="text" class="form-control" placeholder="Tipo de archivo" name="bus_tipo" id="bus_tipo">
   						   <option value="">Todos</option>
   						   <option value="imagen">Imagenes</option>
   						   <option value="video">Videos</option>
   						   <option value="documento">Documentos</option>
   						</select>
   					</div>
   				</div>
				</div>
			</div>
			<div class="file-cont">
			   @include('Multimedia.multimedia_lista')
			</div>
		</div> 
	</div>
</div> 

<div class="modal fade" id="ver-archivo" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog modal-lg visual-modal">
		<div class="modal-content visual">
		   
		</div>
	</div>
</div>
<div class="modal fade" id="add_modal" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content ">
			<div class="modal-header border-top border-0 border-4 border-primary ps-4 pe-4 ">
				<h5 class="modal-title text-primary "><i class='bx bx-upload'></i>Agregar archivo</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form id="form_multimedia_guardar" action="{{route('multimedia_guardar')}}" method="POST" enctype='multipart/form-data'>
			   @csrf
   			<div class="modal-body ps-4 pe-4">
   			   <div class="row g-3">
      			   <div class="col-12">
                     <label for="tipo_archivo" class="form-label">Tipo de archivo</label>
   			         <select name="tipo_archivo" id="tipo_archivo" class="form-control" required>
   			            <option value="imagen">Imagen</option>
   			            <option value="video">Video</option>
   			            <option value="documento">Documento</option>
   			         </select>
   			      </div>
   			      <div class=col-12>
   			         <input type="file" class="dropify_modal" data-height="300" name="up_file"  data-max-file-size="16M" />
   			      </div>
   			   </div>
   			</div>
   			<div class="modal-footer">
   			   <div class="load-foot"><i class='bx bx-loader-alt bx-spin'></i><span>Cargando archivo</span></div>
   				<button type="button" class="btn btn-link" data-bs-dismiss="modal">Cerrar</button>
   				<button type="submit" class="btn btn-primary">Agregar</button>
   			</div>
   		</form>
   	</div>
   </div>
</div>
<div class="modal fade" id="destroy-mult" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog modal-lg ">
		<div class="modal-content ">
			<div class="modal-header border-top border-0 border-4 border-primary ps-4 pe-4 ">
				<h5 class="modal-title text-primary "><i class="bx bx-trash"></i> Eliminar archivo</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form id="form-destroy-mult" action="{{route('multimedia_eliminar')}}" method="POST">
			   @csrf
			   <input type="hidden" name="ID_MULTIMEDIA" id="ID_MULTIMEDIA" value="">
   			<div class="modal-body ps-4 pe-4">
   			   <div class="row g-3">
   			      <div class="col-12">
   			         ¿Desea eliminar este archivo?
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
<script src="{{asset('plugins/fileuploads/js/dropify.js')}}"></script>
<script>
   
   var x =$('.dropify_modal').dropify(
   {  messages: {
         'default': 'Click o suelte el archivo aqui',
         'replace': 'click o suelte el archivo para reemplazar',
         'remove':  'Remover',
         'error':   'Ooops, algo ha sucedido.'
      },
      error: {
         'fileSize': 'El archivo es muy grande (16mb max).',
         'fileExtension':'El archivo no es del formato correcto.'
      },
      tpl:{
         wrap:'<div class="dropify-wrapper" style="height:312px"></div>'
      }
   })

   $(document).ready(function(){
      
      $('body').on('click','.visual-button', function () { 
        $(".modal-content.visual").html("");
          $(".modal-content.visual").append($('<button>',{class:"btn-close btn-mod",'data-bs-dismiss':"modal",type:"button"}));
        if($(this).attr("data-type") == "imagen"){
         
          $(".modal-content.visual").append($('<img>',{id:'img_modal',src:$(this).attr('data-id')}));
          $('#ver-archivo').modal("show");
        }
        else if($(this).attr("data-type") == "video"){
          $(".modal-content.visual").append($('<video>',{id:'img_modal',src:$(this).attr('data-id'),controls:true,controlsList:"nodownload"}));
          $('#ver-archivo').modal("show");
        }
        else{
          var url = $(this).attr('data-id');
          window.open(url, '_blank');
        }
        
      })
      
      $("#ver-archivo").on('hidden.bs.modal', function (e) {
          $("#ver-archivo video").attr("src", "");
      });
      
      $('body').on('click','.copy-btn',function(){
         
         var cpb = $(this).attr('data-id');
         navigator.clipboard.writeText(cpb).then(
            function() {
              notification_custom("success","Se copio link a portapapeles");
            }, 
            function() {
              notification_custom("warning","Ocurrio un error, por favor intentar en otro navegador");
            }
         )
      })
      
      $('body').on('click','.elim-btn',function(){
         
         id = $(this).attr("data-archivo");
         open_eliminar(id);
      })
      
      $("body").on("change","#tipo_archivo",function(){
         td = $(this).val();
         resetdrop(td);
      })
      
      
      $("#form_multimedia_guardar").on("submit",function(e){
         e.preventDefault();
         
         form = new FormData(this);
         url_base = $(this).attr("action");
         multimedia_save(form,url_base);
      })
      
      $("#form-destroy-mult").on("submit",function(e){
         e.preventDefault();
         multimedia_destroy($(this));
      })
      
      $("#bus_tipo").on("change",function(){
         cargarArchivo();
      })
      $("#bus_name").on("keyup",function(){
         cargarArchivo();
      })
      
      
      $(".add").on("click",function(){

         add_modal();
      })
   })

   function add_modal(){
      resetdrop("imagen");
      $("#tipo_archivo").val("imagen");
      $("#add_modal").modal("show");
      $(".load-foot").hide();
   }
   
   function open_eliminar(id){
      $("#destroy-mult").modal("show");
      $("#form-destroy-mult").find("#ID_MULTIMEDIA").val(id);
   }
   
   function cargarArchivo(){
      
      bus_name = $("#bus_name").val();
      bus_tipo = $("#bus_tipo").val();
      
      $.ajax({
   	  type: "get",
        url: "{{route('multimedia_index')}}",
        data: {bus_name:bus_name,bus_tipo:bus_tipo},
        beforeSend:function (){

         }
      }).done(function(data){
         $(".file-cont").html(data);
      }).fail(function(){
         
      });
   }
   
   function multimedia_save(formdata,url_base){
      
      url = url_base
      
      $.ajax({
   	  type: "POST",
        url: url,
        data: formdata,
        contentType: false,
        processData: false,
        dataType: "json",
        beforeSend:function (){
        $("#form_multimedia_guardar").find("button").prop('disabled', true);
        $(".load-foot").show();
        },
        success: function(data){
            $(".load-foot").hide();
            if(data.resultado == "ok"){
               cargarArchivo()
               notification_custom("success",data.mensaje);
               $("#add_modal").modal("hide");
               $("#form_multimedia_guardar").find("button").prop('disabled', false)
            }
            else if(data.resultado == "error"){
               notification_custom("warning",data.mensaje);
               $("#form_multimedia_guardar").find("button").prop('disabled', false)
            }
            else if(data.errors){
               error_marker(data);
               $("#form_multimedia_guardar").find("button").prop('disabled', false)
            }
            
        },
      }).fail(function(){
         notification_custom("warning","No se pudo guardar, recargue la pagina");
          $("#form_multimedia_guardar").find("button").prop('disabled', false)
      });
      
   }
   
   function multimedia_destroy(formdata){
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
               cargarArchivo();
               $("#destroy-mult").modal("hide");
               $(formdata).find("button").prop('disabled', false)
               notification_custom("success",data.mensaje);
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
   
   function resetdrop(td){
      var ttpe
      if(td == "imagen"){
         ttpe= ["jpeg","jpg","png","gif"]
      }
      else if(td == "video"){
         ttpe= ["mp4"]
      }
      else if(td == "documento"){
         ttpe= ["pdf","doc","docx","xls","xlsx"]
      }
      else{
         resetdrop("imagen")
      }
      
      drEvent = x.data('dropify');
      drEvent.resetPreview();
      drEvent.clearElement();
      drEvent.settings.allowedFileExtensions = ttpe;
      drEvent.settings.maxFileSize="16M";
      drEvent.destroy();
      drEvent.init();
      
   }
   
</script>
@endsection 