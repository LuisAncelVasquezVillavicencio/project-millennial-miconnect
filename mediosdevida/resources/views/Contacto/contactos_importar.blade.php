@extends('layout.page_layout')
@section('title', 'Importar')
@section('content')
<div class="page-header" >
   <div class="page-leftheader">
   </div>
</div>
<div class="row">
   <div class="col-md-12">
      <form id="form_files" enctype="multipart/form-data">
      	<div class="row">
      	  
      		<div class="card">
      			<div class="card-header row">
      				<div class="col-md-3"><h2 class="mb-1 col-md font-anton">Importar contactos</h2></div>
      				<div class="col-md-3 offset-6">
   						<select class="form-control " id="combo_grupo" name="combo_grupo">
   							@if(count($grupos)>0)
   								@foreach($grupos as $linea)
   									<option value="{{$linea->ID_GRUPO}}"
   									{{($grupo_consultado == $linea->ID_GRUPO ) ? "selected" : ""}}
   									>{{$linea->TITULO}}</option>
   								@endforeach
   							@else
   									<option value=""></option>
   							@endif
   						</select>
   					</div>
      			</div>
      			<div class="card-body">
      			   <div class="container">
                        <div class="row form-group" >
             				   <div class="col-md-12">
             				      @csrf
             						<input type="file" class="dropify" data-height="200" data-allowed-file-extensions="csv" name="up_file" id="up_file" data-max-file-size="10M"/>
             					</div>
            			    </div>
            			   <div class="row form-group">
                           <div class="col-md-12"><label>Si hay errores en caracteres especiales (´,ñ), trate guardando el csv con formato UTF-8</label></div>
                        </div>
            			    <div class="row form-group">
                           <div class="col-md-12">
                              <a class="btn btn-danger bg-gradient-danger btn-pill cancelar" id="" href="{{route('contactos')}}"> Cancelar</a>
                              <a class="btn btn-success bg-gradient-success btn-pill descarga" id="btn_descarga" href="#"> Descargar modelo</a>
                              <button class="btn btn-secondary bg-gradient-secondary btn-pill validar" type="button" id="btn_vp">Validar Csv</button>
                              <button class="btn btn-secondary bg-gradient-secondary btn-pill Guardar" type="button" id="btn_Imp" onclick="Imp()">Guardar datos</button>
                           </div>
            			    </div>
            			    <div id="preview">
               			   @include('Contacto.contactos_importar_vista')
            			    </div>
      			    </div>
      			</div>
      		</div>
      	</div>
   	</form>
   </div>
</div>
@endsection
@section('scripts')
<link href="{{asset('plugins/fileuploads/css/dropify.css')}}" rel="stylesheet" />
<script src="{{asset('plugins/fileuploads/js/dropify.js')}}"></script>
<script>
   $( document ).ready(function() {
      Url_grupo()
      $(".validar").hide();
      $(".Guardar").hide()
       $('.dropify').dropify(
          {
          messages: {
              'default': 'Click o suelte el archivo aqui',
              'replace': 'click o suelte el archivo para reemplazar',
              'remove':  'Remover',
              'error':   'Ooops, algo ha sucedido.'
          },
          error: {
              'fileSize': 'El archivo es muy grande (10mb max).',
              'fileExtension': 'el formato permitido es CSV.'
         }
      }).on('dropify.afterClear', function(event, element){
        $(".validar").hide();
        $(".Guardar").hide();
        $("#preview").html("");
      }).on('dropify.errors', function(event, element){
        $(".validar").hide();
        $(".Guardar").hide();
        $("#preview").html("");
      })
      
   });
   
   $("#up_file").change(function() {
      if($('#up_file').get(0).files.length>0){
       $(".validar").show();   
      }
      else{
       $(".validar").hide();   
      }
     
      $(".Guardar").hide();
      $("#preview").html("");
   });
   $("#combo_grupo").change(function() {
      Url_grupo()
      $(".Guardar").hide();
      $("#preview").html("");
   });
   
   $(function(){

      $(document).on("click","#btn_vp",function(e){
         var form = document.getElementById("form_files")
         var formData = new FormData(form);
         upCsv(formData)
      })
      
      $('body').on('click', '.paginacion a', function(e) {
        e.preventDefault();
        var url = $(this).attr('href');
        paginador(url)
        window.history.pushState("", "", url);
      });
      }
   )
   function paginador(url){
     var grupo_actual = $( "#combo_grupo" ).val()
     $.ajax({
      	  type: "GET",
           url: url,
           data:{combo_grupo:grupo_actual},
           beforeSend:function (){
            	cargando = "<div class='row align-items-center'><div class='col'></div>"+
            	"<label class='text-warning col text-center'><img src='{{asset('images_theme/tenor.gif')}}' style='width:50%;height:50%'/></label>"+
            	"<div class='col'></div></div>"
    
				 $("#preview").html(cargando)
            }
         }).done(function(data){
            $("#preview").html(data);
      });    
   }
   
   function upCsv(formData){
      $.ajaxSetup({
         headers:{
            "X-CSRF-TOKEN":$('meta[name="_token"]').attr('content')
         }
      })
      $.ajax({
      	  type: "POST",
           url: "{{route('up_file')}}",
           data: formData,
           contentType: false,
           processData: false,
           beforeSend:function (){
            	cargando = "<div class='row align-items-center'><div class='col'></div>"+
            	"<label class='text-warning col text-center'><img src='{{asset('images_theme/tenor.gif')}}' style='width:50%;height:50%'/></label>"+
            	"<div class='col'></div></div>"
    
				 $("#preview").html(cargando)
				 $(".validar").attr("disabled", true);
             $(".Guardar").attr("disabled", true);
             $("#combo_grupo").attr("disabled",true);
            }
         }).done(function(data){
            $("#preview").html(data);
            $(".validar").attr("disabled", false);
            $(".Guardar").attr("disabled", false);
            $("#combo_grupo").attr("disabled",false);
         });
   }
   function Imp(){
      var grupo_actual = $( "#combo_grupo" ).val()
      $.ajaxSetup({
         headers:{
            "X-CSRF-TOKEN":$('meta[name="_token"]').attr('content')
         }
      })
       $.ajax({
      type: "POST",
      url: "{{route('guardar_archivo')}}",
      data: {
         grupo : grupo_actual
      },
      beforeSend:function (){
      	cargando = "<div class='row align-items-center'><div class='col'></div>"+
      	"<label class='text-warning col text-center'><img src='{{asset('images_theme/tenor.gif')}}' style='width:50%;height:50%'/></label>"+
      	"<div class='col'></div></div>"

		 $("#preview").html(cargando)
		 $(".validar").attr("disabled", true);
       $(".Guardar").attr("disabled", true);
       $(".cancelar").attr("disabled", true);
       $("#combo_grupo").attr("disabled",true);
      }
      }).done(function(data){
       $("#preview").html(data);
       $(".validar").attr("disabled", false);
       $(".Guardar").attr("disabled", false);
       $(".cancelar").attr("disabled", false);
       $("#combo_grupo").attr("disabled",false);
      });
   }
   function Url_grupo() {
	grupo_actual = $( "#combo_grupo" ).val()
   concat = "{{route('descarga_modelo','replace')}}"
	concat = concat.replace("replace", grupo_actual);
    $("#btn_descarga").attr("href",concat );	
   }
        
</script>
@endsection