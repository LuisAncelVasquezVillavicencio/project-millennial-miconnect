@extends('template.app')
@section('title', 'Envio masivo')
@section('content')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
<link href="{{asset('new_temp/assets/plugins/emoji-picker-main/emoji-picker-main/lib/css/emoji.css')}}" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css">
<link rel="stylesheet" href="{{ asset('css_theme/devices.min.css')}}"/>
<link href="{{asset('new_temp/assets/css/telefono.css')}}" rel="stylesheet">
<link rel="stylesheet" href="{{asset('plugins/atWho/jquery.atwho.css')}}">
<div class="page-breadcrumb d-flex align-items-center">
   <div class="bread-crumb-custom w-100 d-flex align-items-center">
   	<div class="breadcrumb-title pe-3">Envio masivo</div>
   	<div class="ps-3 mb-0 mb-md-0">
   		<nav aria-label="breadcrumb">
   			<ol class="breadcrumb mb-0 p-0">
   				<li class="breadcrumb-item"><a href="{{route('grupos')}}"><i class="bx bx-home-alt"></i></a>
   				</li>
   				<li class="breadcrumb-item active" aria-current="page">Paso 3: Crear mensaje(s) </li>
   			</ol>
   		</nav>
   	</div>
	</div>
</div>
<form method="POST" id="form_enviar_mensaje"  action="{{ route('Sent_4') }}">
@csrf
<div class="row mt-2">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h6 class="card-title">Instancia </h6>
            </div>
            <div class="card-body">
                <div class="row">
					<div class="d-flex">
						<select class="form-control" name="instancia" required>
						      <option value="">Seleccione una instancia</option>
						   @foreach($instancia as $linea)
						      <option value="{{$linea->ID_WASSAP}}">{{$linea->PROPIETARIO}}</option>
						   @endforeach
						</select>
					</div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row mt-2">
    <div class="col-md-6">
        <div class="card d-flex">
            <div class="col-md-12">
                <div class="row w-100 m-0">
                    <div class="col-md-6 text-primary">
                        <div class="p-2">
                            <p class="mb-2 h6 txt-color-white">Grupo </p>
            				<h6 class="mb-1 txt-color-white ">{{ $item_grupo[0]->TITULO}}</h6>
        				</div>
                    </div>
                    <div class="col-md-6 text-primary">
                        <div class="p-2">
                            <p class="mb-2 h6">Total contactos</p>
        					<h6 class="mb-1 ">{{ count($list_contactos) }}</h6>
                        </div>
                    </div>
                </div>
                <div class="row w-100 m-0">
                    <div class="col-md-6 text-primary">
                        <div class="p-2">
                            <p class="mb-2 h6">Total de mensajes a enviar</p>
        					<h6 class="mb-1 " id="total_msm_sent" >0</h6>
                        </div>
                    </div>
                    <div class="col-md-6 text-primary">
                        <div class="p-2">
                            <p class="mb-2 h6">Tiempo de envio</p>
        					<h6 class="mb-1 " id="total_time_sent" >00:00:00</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h6 class="card-title">Bolsa de mensajes</h6>
            </div>
            <div class="card-body">
                <div class="col-md-12">
  				    <label> {{$mensajes_enviados." de ".$cantidad_mensajes_por_mes }} enviados este mes</label>
  					<div class="progress progress-lg mb-3" >
  					  <div class="progress-bar progress-bar-striped progress-bar-animated bg-teal " 
  					       style="width:{{ $porcentaje }}% " >
  					  	    {{ $porcentaje }}% 
  					  </div>
  				   </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row mt-2">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h6 class="card-title">Etiqueta </h6>
            </div>
            <div class="card-body">
                <div class="row">
					<div class="d-flex">
						<input type="text" id="txt_etiqueta" placeholder="Etiqueta de identificación de mensajes"  name="txt_etiqueta" class="form-control" required style="width:100%;" maxlength=50 />
				        <input type="hidden" id="txt_key" name="txt_key" class="form-control" required readonly   style="width:100%;"  />
					</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h6 class="card-title">Menciones disponibles</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="datos">
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<div class="row mt-2">
    <div class="col-md-12">
      <div class="card">
         <div class="card-body row">
             <div class="col-md-2">
                <p class="mb-2 h6"># <i class="bx bx-font"></i> Texto</p>
				<h2 class="mb-1 "><a id="txt_texto">0</a><a> / 100</a></h2>
             </div>
             <div class="col-md-2">
                <p class="mb-2 h6"># <i class="fa fa-file-image-o"></i> Imagen</p>
				<h2 class="mb-1 "><a id="txt_imagen">0</a><a> / 10</a></h2>
             </div>
             <div class="col-md-2">
                <p class="mb-2 h6"># <i class="fa fa-file-movie-o"></i> Video</p>
				<h2 class="mb-1 "><a id="txt_video">0</a><a> / 5</a></h2>
             </div>
             <div class="col-md-2">
                <p class="mb-2 h6"># <i class="fa fa-file-pdf-o"></i> PDF</p>
				<h2 class="mb-1 "><a id="txt_pdf">0</a><a> / 5</a></h2>
             </div>
             <div class="col-md-2">
                <p class="mb-2 h6"># <i class="fa fa-file-word-o"></i> Word</p>
				<h2 class="mb-1 "><a id="txt_word" >0</a><a> / 5</a></h2>
             </div>
             <div class="col-md-2">
                <p class="mb-2 h6"># <i class="fa fa-file-excel-o"></i>   Excel</p>
				<h2 class="mb-1 "><a id="txt_excel" >0</a><a> / 5</a></h2>
             </div>
         </div>
      </div>
    </div>
</div>
<div class="row mt-2">
   <div class="col-md-8">
      <div class="card">
         <div class="card-body h-100">
            <div class="row mb-3">
               <div>
                  <button id="add_texto" type="button" class="btn btn-inverse-primary mb-2" >
   						<i class="bx bx-font"></i> +Texto
   				  </button>
   				  <button id="add_imagen" type="button" class="btn btn-inverse-primary mb-2 ms-auto me-auto" >
   						<i class="bx bx-image-add"></i> +Imagen
   				  </button>
   				    <button id="add_video" type="button" class="btn btn-inverse-primary mb-2 ms-auto me-auto">
						<i class="bx bx-video-plus"></i>+Video
    				</button>
    				<button id="add_pdf" type="button" class="btn btn-inverse-primary mb-2 ms-auto me-auto">
						<i class="bx bxs-file-pdf"></i> +PDF
    				</button>
    				<button id="add_word" type="button" class="btn btn-inverse-primary mb-2 ms-auto me-auto">
						<i class="bx bxs-file-doc"></i>+Word
    				</button>
    				<button id="add_excel" type="button" class="btn btn-inverse-primary mb-2 ms-auto me-auto">
						<i class="bx bxs-file-doc"></i>+Excel
    				</button>
    				<button id="add_texto_imagen" type="button" class="btn btn-inverse-primary mb-2 ms-auto me-auto">
						<i class="bx bx-file-image-o"></i>+Texto e Imagen
    				</button>
    				<button id="add_texto_video" type="button" class="btn btn-inverse-primary mb-2 ms-auto me-auto">
						<i class="bx bx-file-movie-o"></i>+Texto y video
    				</button>
				</div>
            </div>
            <div id="msm_content">
   									      
   			</div>
   			<div>
       			<div class="row">
       			    <button type="submit" 
    				{{($porcentaje >= 100) ? 'disabled':''}}
    				class="btn btn-primary sender">Enviar</button>
       			</div>
   			</div>
         </div>
      </div>
   </div>
   <div class="col-md-4">
      <div class="card">
         <div class="card-body" style="display:flex;align-content: center;justify-content: center;">
            <div class="page" style = "margin-top:10px;align-items: center;display: flex;align-content: center;"  >
              <div class="marvel-device nexus5" >
                <div class="top-bar"></div>
                <div class="sleep"></div>
                <div class="volume"></div>
                <div class="camera"></div>
                <div class="screen"  >
                  <div class="screen-container">
                    <div class="status-bar">
                      <div class="time"></div>
                      <div class="battery">
                        <i class="zmdi zmdi-battery"></i>
                      </div>
                      <div class="network">
                        <i class="zmdi zmdi-network"></i>
                      </div>
                      <div class="wifi">
                        <i class="zmdi zmdi-wifi-alt-2"></i>
                      </div>
                      <div class="star">
                        <i class="zmdi zmdi-star"></i>
                      </div>
                    </div>
                    <div class="chat">
                      <div class="chat-container">
                        <div class="user-bar">
                          <div class="back">
                            <i class="zmdi zmdi-arrow-left"></i>
                          </div>
                          <div class="avatar avatar-telf">
                            <img src="{{ asset('new_temp/assets/images/icono.png') }}" alt="Avatar">
                          </div>
                          <div class="name">
                            <span>{{ $item_grupo[0]->TITULO}}</span>
                            <span class="status">Contactos: {{ count($list_contactos) }}</span>
                          </div>
                          <div class="actions more">
                            <i class="zmdi zmdi-more-vert"></i>
                          </div>
                          <div class="actions attachment">
                            <i class="zmdi zmdi-attachment-alt"></i>
                          </div>
                          <div class="actions">
                            <i class="zmdi zmdi-phone"></i>
                          </div>
                        </div>
                        <div class="conversation">
                          <div class="conversation-container" id="content_conversation" >
                            
                   
                            
                            
                          </div>
                          <span class="conversation-compose">
                            <div class="emoji">
                              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" id="smiley" x="3147" y="3209"><path fill-rule="evenodd" clip-rule="evenodd" d="M9.153 11.603c.795 0 1.44-.88 1.44-1.962s-.645-1.96-1.44-1.96c-.795 0-1.44.88-1.44 1.96s.645 1.965 1.44 1.965zM5.95 12.965c-.027-.307-.132 5.218 6.062 5.55 6.066-.25 6.066-5.55 6.066-5.55-6.078 1.416-12.13 0-12.13 0zm11.362 1.108s-.67 1.96-5.05 1.96c-3.506 0-5.39-1.165-5.608-1.96 0 0 5.912 1.055 10.658 0zM11.804 1.01C5.61 1.01.978 6.034.978 12.23s4.826 10.76 11.02 10.76S23.02 18.424 23.02 12.23c0-6.197-5.02-11.22-11.216-11.22zM12 21.355c-5.273 0-9.38-3.886-9.38-9.16 0-5.272 3.94-9.547 9.214-9.547a9.548 9.548 0 0 1 9.548 9.548c0 5.272-4.11 9.16-9.382 9.16zm3.108-9.75c.795 0 1.44-.88 1.44-1.963s-.645-1.96-1.44-1.96c-.795 0-1.44.878-1.44 1.96s.645 1.963 1.44 1.963z" fill="#7d8489"/></svg>
                            </div>
                            <input class="input-msg" name="input" placeholder="Escribe un mensaje" autocomplete="off" readonly></input>
                            <div class="photo">
                              <i class="zmdi zmdi-camera"></i>
                            </div>
                            <button class="send" disabled >
                                <div class="circle">
                                  <i class="zmdi zmdi-mail-send"></i>
                                </div>
                              </button>
                          </span>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
         </div>
      </div>
   </div>
</div>
</form>
@endsection
@section('scripts')
<script src="{{asset('new_temp/assets/plugins/emoji-picker-main/emoji-picker-main/lib/js/config.js')}}"></script>
<script src="{{asset('new_temp/assets/plugins/emoji-picker-main/emoji-picker-main/lib/js/util.js')}}"></script>
<script src="{{asset('new_temp/assets/plugins/emoji-picker-main/emoji-picker-main/lib/js/jquery.emojiarea.js')}}"></script>
<script src="{{asset('new_temp/assets/plugins/emoji-picker-main/emoji-picker-main/lib/js/emoji-picker.js')}}"></script>
<script src="{{ asset('plugins/atWho/jquery.atwho.min.js')}}"></script>
<script>

var id_focus;

$(":input").focus(function () {
     id_focus = this.id_focus;
});

var global_items=0;
/*max*/
var max_items_texto=100;
var max_items_image=10;
var max_items_video=5;
var max_items_pdf=5;
var max_items_excel=5;
var max_items_word=5;

/*valores incremental*/
var global_items_texto=0;
var global_items_image=0;
var global_items_video=0;
var global_items_pdf=0;
var global_items_excel=0;
var global_items_word=0;

/*time*/
var peso_texto=1;
var peso_imagen=2;
var peso_video=60;
var peso_pdf=2;
var peso_excel=2;
var peso_word=2;

function secondsToString(seconds) {
  var hour = Math.floor(seconds / 3600);
  hour = (hour < 10)? '0' + hour : hour;
  var minute = Math.floor((seconds / 60) % 60);
  minute = (minute < 10)? '0' + minute : minute;
  var second = seconds % 60;
  second = (second < 10)? '0' + second : second;
  return hour + ':' + minute + ':' + second;
}

function makeid(length) {
   var result           = '';
   var characters       = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
   var charactersLength = characters.length;
   for ( var i = 0; i < length; i++ ) {
      result += characters.charAt(Math.floor(Math.random() * charactersLength));
   }
   return result;
}

function remove_obj(id_content,id_sent,type) {
    
    
    
   $('#'+id_content).remove();
   $('#'+id_sent).remove();
  
   if(type=='texto'){
     global_items_texto--;
   }else if(type=='img'){
     global_items_image--;
   }else if(type=='video'){
     global_items_video--;
   }else if(type=='pdf'){
     global_items_pdf--;
   }else if(type=='excel'){
     global_items_excel--;
   }else if(type=='word'){
     global_items_word--;
   }
   
   refresh_txt();
   
   contador = $(".msm_control").length;
   
   if(contador == 0){
       $(".sender").attr("disabled",true);
   }
}

function remove_obj_dos(id_content,id_sent_obj_uno,id_sent_obj_dos,type) {
   $('#'+id_content).remove();
   $('#'+id_sent_obj_uno).remove();
   $('#'+id_sent_obj_dos).remove();
  
   if(type=='textoimagen'){
     global_items_texto--;
     global_items_image--;
   }
   
   if(type=='textovideo'){
     global_items_texto--;
     global_items_video--;
   }
   
   refresh_txt();
   
   contador = $(".msm_control").length;
   if(contador == 0){
       $(".sender").attr("disabled",true);
   }
}


var marcadores = {!! json_encode($marcadores) !!};

var marc = []
var data_menc = ""
Object.entries(marcadores).forEach(([key, value]) => {
  
  if(value != null){
    marc.push({"nombre":value});
    data_menc = data_menc+"<span class='text-primary'> @"+value+"</span> ; "
  }
 
    
});
$(".datos").html(data_menc)


$(document).ready(function(){


    $("#txt_key").attr('value', makeid(300));
   
    $('#add_texto').click(function(){
      
      global_items_texto++;

      var key = makeid(50);
      var id_emoticonest= 'key_emoticones_'+key;
      var id_content= 'key_content_'+key;
      var id_input= 'key_text_'+key;
      var id_sent= 'sent_text_'+key;
      
      $("#msm_content").append(
          '<div class="mb-3 d-flex flex-column count_container" id="'+id_content+'">'+
          '<hr>'+
          '<div class="d-flex w-100" style="alignment-baseline: central;align-items: baseline;">'+
          '<label class="mb-2 me-auto"> Mensaje de texto: </label>'+
          '<button class="btn btn-default border-0 box-shadow-0 p-0" type="button"  onClick="remove_obj(\''+id_content+'\',\''+id_sent+'\',\'texto\')"  >' +
  		  '<i class="bx bx-trash"></i>'+
  		  '</button>'+
          '</div>'+
          '<div class="emoji-picker-container w-100" id="ddd">'+
          '<textarea name="'+id_input+'" id="'+id_input+'" class="form-control msm_control textarea-control '+id_input+' mention_'+id_input+'" placeholder="Ingrese el texto" rows="3" maxlength="60000" required data-emojiable="true" data-emoji-input="unicode"></textarea>'+
          '</div>'+
          '</div>'
      )
     
     
      window.emojiPicker.discover()   
     
      $('#content_conversation').append( '<div id="'+id_sent+'" class="message_device sent" ></div>');			

      $("."+id_input+"").on('keyup', function() {
         $("#"+id_sent).html(re_img_videotext($(this)).replace(/\r?\n/g,'<br/>'));
      });
      $("."+id_input+"").on('change', function() {
         $("#"+id_sent).html(re_img_videotext($(this)).replace(/\r?\n/g,'<br/>'));
      });
      $("."+id_input+"").on('DOMSubtreeModified', function() {
         $("#"+id_sent).html(re_img_videotext($(this)).replace(/\r?\n/g,'<br/>'));
      });
      
      $("."+id_input+"").bind("paste", function(e){
          // access the clipboard using the api
        $("#"+id_sent).html(re_img_videotext($(this)).replace(/\r?\n/g,'<br/>'));
      });
      
      $("#"+id_input+"").bind("change", function(e){
       // access the clipboard using the api
         $("#"+id_sent).html(re_img_videotext($(this)).replace(/\r?\n/g,'<br/>'));
      })
      
      x_var = 'div.mention_'+id_input
    
      $(x_var).atwho({
            at: "@",
            data:marc,
            displayTpl: '<li>${nombre}</li>',
            insertTpl: ":${nombre}:",
            searchKey: "nombre",
            spaceSelectsMatch: true,
            limit:10,
      });
          
      refresh_txt();
      
    })
   
    $('#add_imagen').click(function(){
      global_items_image++;
      
      var key = makeid(50);
      var id_content= 'key_content_'+key;
      var id_input= 'key_img__'+key;
      var id_sent= 'sent_img_'+key;
      
      $("#msm_content").append(
          
          '<div class="mb-3 d-flex flex-column count_container" id="'+id_content+'">'+
          '<hr>'+
          '<div class="d-flex w-100" style="alignment-baseline: central;align-items: baseline;">'+
          '<label class="mb-2 me-auto"> Imagen </label>'+
          '<button class="btn btn-default border-0 box-shadow-0 p-0" type="button"  onClick="remove_obj(\''+id_content+'\',\''+id_sent+'\',\'iamgen\')"  >' +
  		  '<i class="bx bx-trash"></i>'+
  		  '</button>'+
          '</div>'+
          '<div class="w-100" id="ddd">'+
          '<input type="url" name="'+id_input+'" id="'+id_input+'"  class="form-control msm_control" required  '+
  		  'placeholder="https://ejemplo.com/(.jpg|.png|.jpeg|.gif)" pattern="https?:\/\/(www\.)*)(.jpg|.png|.jpeg|.gif)" > '+
          '</div>'+
          '</div>'
      )
      
      $('#content_conversation').append( '<div  id="'+id_sent+'" class="message_device sent" style="" >'+
       '<img  id="img'+id_sent+'" style="height:120px;border-radius: 20px;border: solid 3px #dcf8c6 !important;width: -webkit-fill-available;" />'+
       '</div>');
       
      $("#"+id_input).on('keyup', function() {
        //$("#"+id_sent).html($(this).val().replace(/\r?\n/g,'<br/>'));
        $("#img"+id_sent).attr('src', $(this).val() );
      });
      
      $("#"+id_input).bind("paste", function(e){
          // access the clipboard using the api
          $("#img"+id_sent).attr('src', $(this).val() );
      });
      
      
      $("#"+id_input).bind("change", function(e){
          // access the clipboard using the api
          $("#img"+id_sent).attr('src', $(this).val() );
      });
      
      refresh_txt();
      
    })
    
    
    $('#add_video').click(function(){
      global_items_video++;

      var key = makeid(50);
      var id_content= 'key_content_'+key;
      var id_input= 'key_mov__'+key;
      var id_sent= 'sent_mov_'+key;
      $("#msm_content").append(
          
          '<div class="mb-3 d-flex flex-column count_container" id="'+id_content+'">'+
          '<hr>'+
          '<div class="d-flex w-100" style="alignment-baseline: central;align-items: baseline;">'+
          '<label class="mb-2 me-auto"> Video </label>'+
          '<button class="btn btn-default border-0 box-shadow-0 p-0" type="button"  onClick="remove_obj(\''+id_content+'\',\''+id_sent+'\',\'video\')"  >' +
  		  '<i class="bx bx-trash"></i>'+
  		  '</button>'+
          '</div>'+
          '<div class="w-100" id="ddd">'+
          '<input type="url" name="'+id_input+'" id="'+id_input+'"  class="form-control msm_control" required  '+
  		  'placeholder="https://example.com/(.mp4)" pattern="https?:\/\/(www\.)*)(.mp4)" > '+
          '</div>'+
          '</div>'
      )
  														  
  	  $('#content_conversation').append( '<div  id="'+id_sent+'" class="message_device sent" style="z-index: 1000;" >'+
  		                                   '<video  id="mov'+id_sent+'" height="120" controls style="width: -webkit-fill-available;"  >'+
                                            '<source src="" type="video/mp4">'+
                                         '</video>'+
  		                                   '</div>');			
  		
  	  $("#"+id_input).on('keyup', function() {
        //$("#"+id_sent).html($(this).val().replace(/\r?\n/g,'<br/>'));
        $("#mov"+id_sent).attr('src', $(this).val() );
      });
      
      $("#"+id_input).bind("paste", function(e){
          // access the clipboard using the api
          $("#mov"+id_sent).attr('src', $(this).val() );
      });
      
      
      $("#"+id_input).bind("change", function(e){
          // access the clipboard using the api
          $("#mov"+id_sent).attr('src', $(this).val() );
      });
      refresh_txt();
    })
    
    $('#add_pdf').click(function(){
      global_items_pdf++;
      
      var svg = "{{ asset('img/pdf.svg')}}" ;
      var key = makeid(50);
      var id_content= 'key_content_'+key;
      var id_input= 'key_pdf__'+key;
      var id_sent= 'sent_pdf_'+key;
      
      $("#msm_content").append(
          
          '<div class="mb-3 d-flex flex-column count_container" id="'+id_content+'">'+
          '<hr>'+
          '<div class="d-flex w-100" style="alignment-baseline: central;align-items: baseline;">'+
          '<label class="mb-2 me-auto"> PDF </label>'+
          '<button class="btn btn-default border-0 box-shadow-0 p-0" type="button"  onClick="remove_obj(\''+id_content+'\',\''+id_sent+'\',\'pdf\')"  >' +
  		  '<i class="bx bx-trash"></i>'+
  		  '</button>'+
          '</div>'+
          '<div class="w-100" id="ddd">'+
          '<input type="url" name="'+id_input+'" id="'+id_input+'"  class="form-control msm_control" required  '+
  		  'placeholder="https://example.com/(.pdf)" pattern="https?:\/\/(www\.)*)(.pdf)" > '+
          '</div>'+
          '</div>'
      )
  														  
  	  $('#content_conversation').append( '<div  id="'+id_sent+'" class="message_device sent" style="z-index: 1000;" >'+
         '<a id="pdf'+id_sent+'" target="_blank" >'+
         '<img  src="'+svg+'" style="height:50px;border: solid 3px #dcf8c6 !important;width: -webkit-fill-available;" />'+
         '</a>'+
         '</div>');			
  		
  	  $("#"+id_input).on('keyup', function() {
        //$("#"+id_sent).html($(this).val().replace(/\r?\n/g,'<br/>'));
        $("#pdf"+id_sent).attr('href', $(this).val() );
      });
    
      $("#"+id_input).bind("paste", function(e){
          // access the clipboard using the api
          $("#pdf"+id_sent).attr('href', $(this).val() );
      });
      
      
      $("#"+id_input).bind("change", function(e){
          // access the clipboard using the api
          $("#pdf"+id_sent).attr('href', $(this).val() );
      });
      refresh_txt();
    })
    
    $('#add_word').click(function(){
      global_items_word++;
      
      var svg = "{{ asset('img/word.svg')}}" ;
      var key = makeid(50);
      var id_content= 'key_content_'+key;
      var id_input= 'key_word__'+key;
      var id_sent= 'sent_word_'+key;
      
      $("#msm_content").append(
          
          '<div class="mb-3 d-flex flex-column count_container" id="'+id_content+'">'+
          '<hr>'+
          '<div class="d-flex w-100" style="alignment-baseline: central;align-items: baseline;">'+
          '<label class="mb-2 me-auto"> Word </label>'+
          '<button class="btn btn-default border-0 box-shadow-0 p-0" type="button"  onClick="remove_obj(\''+id_content+'\',\''+id_sent+'\',\'word\')"  >' +
  		  '<i class="bx bx-trash"></i>'+
  		  '</button>'+
          '</div>'+
          '<div class="w-100" id="ddd">'+
          '<input type="url" name="'+id_input+'" id="'+id_input+'"  class="form-control msm_control" required  '+
  		  'placeholder="https://example.com/(.doc|.docx)" pattern="https?:\/\/(www\.)*)(.doc|.docx)" > '+ 
          '</div>'+
          '</div>'
      )
      
  	  $('#content_conversation').append( '<div  id="'+id_sent+'" class="message_device sent" style="z-index: 1000;" >'+
         '<a id="word'+id_sent+'" target="_blank" >'+
         '<img  src="'+svg+'" style="height:50px;border: solid 3px #dcf8c6 !important;" />'+
         '</a>'+
         '</div>');			
  		
  	  $("#"+id_input).on('keyup', function() {
        //$("#"+id_sent).html($(this).val().replace(/\r?\n/g,'<br/>'));
        $("#word"+id_sent).attr('href', $(this).val() );
      });
    
      $("#"+id_input).bind("paste", function(e){
          // access the clipboard using the api
          $("#word"+id_sent).attr('href', $(this).val() );
      });
      
      
      $("#"+id_input).bind("change", function(e){
          // access the clipboard using the api
          $("#word"+id_sent).attr('href', $(this).val() );
      });
      refresh_txt();
    })
    
    $('#add_excel').click(function(){
      global_items_excel++;
      
      var svg = "{{ asset('img/excel.svg')}}" ;
      var key = makeid(50);
      var id_content= 'key_content_'+key;
      var id_input= 'key_excel__'+key;
      var id_sent= 'sent_excel_'+key;
      
      $("#msm_content").append(
          
          '<div class="mb-3 d-flex flex-column count_container" id="'+id_content+'">'+
          '<hr>'+
          '<div class="d-flex w-100" style="alignment-baseline: central;align-items: baseline;">'+
          '<label class="mb-2 me-auto"> Excel </label>'+
          '<button class="btn btn-default border-0 box-shadow-0 p-0" type="button"  onClick="remove_obj(\''+id_content+'\',\''+id_sent+'\',\'excel\')"  >' +
  		  '<i class="bx bx-trash"></i>'+
  		  '</button>'+
          '</div>'+
          '<div class="w-100" id="ddd">'+
          '<input type="url" name="'+id_input+'" id="'+id_input+'"  class="form-control msm_control" required  '+
  		  'placeholder="https://example.com/(.xlsx|.xlsm|.xls)" pattern="https?:\/\/(www\.)*)(.xlsx|.xlsm|.xls)" > '+
          '</div>'+
          '</div>'
      )
      
  	  $('#content_conversation').append( '<div  id="'+id_sent+'" class="message_device sent" style="z-index: 1000;" >'+
  		                                   '<a id="excel'+id_sent+'" target="_blank" >'+
  		                                   '<img  src="'+svg+'" style="height:50px;border: solid 3px #dcf8c6 !important;" />'+
  		                                   '</a>'+
  		                                   '</div>');			
  		
  	  $("#"+id_input).on('keyup', function() {
        //$("#"+id_sent).html($(this).val().replace(/\r?\n/g,'<br/>'));
        $("#excel"+id_sent).attr('href', $(this).val() );
      });
    
      $("#"+id_input).bind("paste", function(e){
          // access the clipboard using the api
         $("#excel"+id_sent).attr('href', $(this).val() );
      });
      
      $("#"+id_input).bind("mouseover", function(e){
          // access the clipboard using the api
         $("#excel"+id_sent).attr('href', $(this).val() );
      });
      
      $("#"+id_input).bind("change", function(e){
          // access the clipboard using the api
         $("#excel"+id_sent).attr('href', $(this).val() );
      });
      refresh_txt();
    })
    
    $('#add_texto_imagen').click(function(){
      global_items_texto++;
      global_items_image++;

      var key = makeid(50);
      var id_emoticonest= 'key_emoticones_'+key;
      var id_content= 'key_content_'+key;
      
      
      var id_input_key_text= 'key_text_'+key;
      var id_sent_sent_text= 'sent_text_'+key;
      
      var id_input_key_img= 'key_img__'+key;
      var id_sent_sent_img= 'sent_img_'+key;
      
      //hidden
      var id_sent= 'senttxti_'+key;
      var id_input= 'key_txti_'+key;
      
      
      $("#msm_content").append(
          
          '<div class="mb-3 d-flex flex-column count_container" id="'+id_content+'">'+
          '<hr>'+
          '<div class="d-flex w-100" style="alignment-baseline: central;align-items: baseline;">'+
          '<label class="mb-2 me-auto"> Texto e imagen </label>'+
          '<button class="btn btn-default border-0 box-shadow-0 p-0" type="button" onClick="remove_obj_dos(\''+id_content+'\',\''+id_sent_sent_img+'\',\''+id_sent_sent_text+'\',\'textoimagen\')" >' +
  		  '<i class="bx bx-trash"></i>'+
  		  '</button>'+
          '</div>'+
          '<div class="w-100" id="ddd">'+
          '<input type="url" id="'+id_input_key_img+'"  class="form-control msm_control mb-2" required  '+
  		  'placeholder="https://example.com/(.jpg|.png|.jpeg|.gif)" pattern="https?:\/\/(www\.)*)(.jpg|.png|.jpeg|.gif)" > '+
  		  '<input type="hidden" id="'+id_input+'" name="'+id_sent+'">'+
          '</div>'+
          '<div class="emoji-picker-container w-100" id="ddd">'+
          '<textarea id="'+id_input_key_text+'" class="form-control msm_control textarea-control '+id_input_key_text+' mention_'+id_input_key_text+'" placeholder="Ingrese el texto" rows="3" maxlength="60000" required data-emojiable="true" data-emoji-input="unicode"></textarea>'+
          '</div>'+
          '</div>'
      )
      
      
      $('#content_conversation').append( '<div  id="'+id_sent_sent_img+'" class="message_device sent" style="" >'+
         '<img  id="img'+id_sent_sent_img+'" style="height:120px;border-radius: 20px;border: solid 3px #dcf8c6 !important;" />'+
         '<div id="'+id_sent_sent_text+'"></div>'+
         '</div>');	

      window.emojiPicker.discover() 
      
      $("."+id_input_key_text).on('keyup', function() {
        re_text = re_img_videotext($("div."+id_input_key_text))
        $("#"+id_sent_sent_text).html(re_text.replace(/\r?\n/g,'<br/>'));
        $("#"+id_input).val($("#"+id_input_key_img).val()+"((-))"+re_text);

      });
      
      $("."+id_input_key_text).bind("paste", function(e){
          // access the clipboard using the api
         re_text = re_img_videotext($("div."+id_input_key_text))
         $("#"+id_sent_sent_text).html(re_text.replace(/\r?\n/g,'<br/>'));
         $("#"+id_input).val($("#"+id_input_key_img).val()+"((-))"+re_text);
          
      });
      $("."+id_input_key_text).on('DOMSubtreeModified', function() {
      
         re_text = re_img_videotext($("div."+id_input_key_text))
         $("#"+id_sent_sent_text).html(re_text.replace(/\r?\n/g,'<br/>'));
         $("#"+id_input).val($("#"+id_input_key_img).val()+"((-))"+re_text);
         
         
      });
      
      
      $("textarea."+id_input_key_text).on("change", function(e){
          // access the clipboard using the api
         re_text = re_img_videotext($("div."+id_input_key_text))
         $("#"+id_sent_sent_text).html(re_text.replace(/\r?\n/g,'<br/>'));
         $("#"+id_input).val($("#"+id_input_key_img).val()+"((-))"+re_text);
         
      });
      
      // Metodos de imagen
      
      $("#"+id_input_key_img).on('keyup', function() {
        //$("#"+id_sent).html($(this).val().replace(/\r?\n/g,'<br/>'));
        $("#img"+id_sent_sent_img).attr('src', $(this).val() );
         re_text = re_img_videotext($("div."+id_input_key_text))
         $("#"+id_input).val($("#"+id_input_key_img).val()+"((-))"+re_text);
      });
      
      $("#"+id_input_key_img).bind("paste", function(e){
          // access the clipboard using the api
          $("#img"+id_sent_sent_img).attr('src', $(this).val() );
          re_text = re_img_videotext($("div."+id_input_key_text))
        
          $("#"+id_input).val($("#"+id_input_key_img).val()+"((-))"+re_text);
      });
      
      
      $("#"+id_input_key_img).bind("change", function(e){
          // access the clipboard using the api
          $("#img"+id_sent_sent_img).attr('src', $(this).val() );
         re_text = re_img_videotext($("div."+id_input_key_text))
        
         $("#"+id_input).val($("#"+id_input_key_img).val()+"((-))"+re_text);
      });
      
      x_var = 'div.mention_'+id_input_key_text
    
      $(x_var).atwho({
            at: "@",
            data:marc,
            displayTpl: '<li>${nombre}</li>',
            insertTpl: ":${nombre}:",
            searchKey: "nombre",
            spaceSelectsMatch: true,
            limit:10,
      });
      refresh_txt();
    })
    
    $('#add_texto_video').click(function(){
      global_items_texto++;
      global_items_video++;
      
      
      var key = makeid(50);
      var id_emoticonest= 'key_emoticones_'+key;
      var id_content= 'key_content_'+key;
      
      
      var id_input_key_text= 'key_text_'+key;
      var id_sent_sent_text= 'sent_text_'+key;
      
      var id_input_key_video= 'key_mov__'+key;
      var id_sent_sent_video= 'sent_mov_'+key;
      
      //hidden
      var id_sent= 'senttxvi_'+key;
      var id_input= 'key_txvi_'+key;
      
      $("#msm_content").append(
          
          '<div class="mb-3 d-flex flex-column count_container" id="'+id_content+'">'+
          '<hr>'+
          '<div class="d-flex w-100" style="alignment-baseline: central;align-items: baseline;">'+
          '<label class="mb-2 me-auto"> Texto y video </label>'+
          '<button class="btn btn-default border-0 box-shadow-0 p-0" type="button" onClick="remove_obj_dos(\''+id_content+'\',\''+id_sent_sent_video+'\',\''+id_sent_sent_text+'\',\'textovideo\')" >' +
  		  '<i class="bx bx-trash"></i>'+
  		  '</button>'+
          '</div>'+
          '<div class="w-100" id="ddd">'+
          '<input type="url" id="'+id_input_key_video+'"  class="form-control msm_control mb-2" required  '+
  		  'placeholder="https://example.com/(.mp4)" pattern="https?:\/\/(www\.)*)(.mp4)" > '+
  		  '<input type="hidden" id="'+id_input+'" name="'+id_sent+'">'+
          '</div>'+
          '<div class="emoji-picker-container w-100" id="ddd">'+
          '<textarea id="'+id_input_key_text+'" class="form-control msm_control textarea-control '+id_input_key_text+' mention_'+id_input_key_text+'" placeholder="Ingrese el texto" rows="3" maxlength="60000" required data-emojiable="true" data-emoji-input="unicode"></textarea>'+
          '</div>'+
          '</div>'
      )
      
      $('#content_conversation').append( '<div  id="'+id_sent_sent_video+'" class="message_device sent" style="z-index: 1000;" >'+
  		'<video  id="mov'+id_sent_sent_video+'" height="120" controls style="width: -webkit-fill-available;" >'+
        '<source src="" type="video/mp4">'+
        '</video>'+
        '<div id="'+id_sent_sent_text+'" class="" ></div>'+
        '</div>');
        
      window.emojiPicker.discover() 
      
      $("#"+id_input).on('keyup', function() {
        //$("#"+id_input_key_video).html($(this).val().replace(/\r?\n/g,'<br/>'));
        $("#mov"+id_sent_sent_video).attr('src', $(this).val() );
        re_text = re_img_videotext($("div."+id_input_key_text))
        $("#"+id_input).val($("#"+id_input_key_video).val()+"((-))"+re_text);
      });
      
      $("#"+id_input_key_video).bind("paste", function(e){
          // access the clipboard using the api
          $("#mov"+id_sent_sent_video).attr('src', $(this).val() );
          re_text = re_img_videotext($("div."+id_input_key_text))
          $("#"+id_input).val($("#"+id_input_key_video).val()+"((-))"+re_text);
      });
      
      $("#"+id_input_key_video).bind("mouseover", function(e){
          // access the clipboard using the api
          $("#mov"+id_sent_sent_video).attr('src', $(this).val() );
          re_text = re_img_videotext($("div."+id_input_key_text))
          $("#"+id_input).val($("#"+id_input_key_video).val()+"((-))"+re_text);
      });
      
      $("#"+id_input_key_video).bind("change", function(e){
          // access the clipboard using the api
          $("#mov"+id_sent_sent_video).attr('src', $(this).val() );
          re_text = re_img_videotext($("div."+id_input_key_text))
          $("#"+id_input).val($("#"+id_input_key_video).val()+"((-))"+re_text);
      });
      
      $("."+id_input_key_text).on('keyup', function() {
        re_text = re_img_videotext($("div."+id_input_key_text))
        $("#"+id_sent_sent_text).html(re_text.replace(/\r?\n/g,'<br/>'));
        $("#"+id_input).val($("#"+id_input_key_video).val()+"((-))"+re_text);
      });
      
      $("."+id_input_key_text).bind("paste", function(e){
          // access the clipboard using the api
        re_text = re_img_videotext($("div."+id_input_key_text))
        $("#"+id_sent_sent_text).html(re_text.replace(/\r?\n/g,'<br/>'));
        $("#"+id_input).val($("#"+id_input_key_video).val()+"((-))"+re_text);
          
      });
      
      $("."+id_input_key_text+"").on('DOMSubtreeModified', function() {
         re_text = re_img_videotext($("div."+id_input_key_text))
         $("#"+id_sent_sent_text).html(re_text.replace(/\r?\n/g,'<br/>'));
         $("#"+id_input).val($("#"+id_input_key_video).val()+"((-))"+re_text);
      });
      
      $("."+id_input_key_text).bind("change", function(e){
          // access the clipboard using the api
        re_text = re_img_videotext($("div."+id_input_key_text))
        $("#"+id_sent_sent_text).html(re_text.replace(/\r?\n/g,'<br/>'));
        $("#"+id_input).val($("#"+id_input_key_video).val()+"((-))"+re_text);
         
      });
      
      x_var = 'div.mention_'+id_input_key_text
    
      $(x_var).atwho({
            at: "@",
            data:marc,
            displayTpl: '<li>${nombre}</li>',
            insertTpl: ":${nombre}:",
            searchKey: "nombre",
            spaceSelectsMatch: true,
            limit:10,
      });
      
      refresh_txt();
    })
    
    $('#add_texto').trigger("click");
   
})

function refresh_txt_texto(){
  $("#txt_texto").html(global_items_texto);
}
function refresh_txt_imagen(){
  $("#txt_imagen").html(global_items_image);
}
function refresh_txt_video(){
  $("#txt_video").html(global_items_video);
}
function refresh_txt_pdf(){
  $("#txt_pdf").html(global_items_pdf);
}
function refresh_txt_word(){
  $("#txt_word").html(global_items_word);
}
function refresh_txt_excel(){
  $("#txt_excel").html(global_items_excel);
}


function refresh_txt(){
    
    
  $(".sender").attr("disabled",false);
  refresh_txt_texto();
  refresh_txt_imagen();
  refresh_txt_video();
  refresh_txt_pdf();
  refresh_txt_word();
  refresh_txt_excel();
  
  contact = "{{ count($list_contactos) }}" ;
  global_items=global_items_texto+global_items_image+global_items_video+global_items_pdf+global_items_excel+global_items_word;
  
  total_sent_envio=contact*global_items;
  total_sent_envio = $(".count_container").length * contact
  $("#total_msm_sent").html(total_sent_envio);
  
  //calcular time;
  time_texto = global_items_texto*peso_texto;
  time_imagen = global_items_image*peso_imagen;
  time_video = global_items_video*peso_video;
  time_pdf = global_items_pdf*peso_pdf;
  time_excel = global_items_excel*peso_excel;
  time_word = global_items_word*peso_word;
  
  total_time=(time_texto+time_imagen+time_video+time_pdf+time_excel+time_word)*contact;
  
  $("#total_time_sent").html(secondsToString(total_time));
  
} 

function re_img_videotext(texto){
   
   result = "";
   result = texto.prop("innerHTML").replace(/<div> <\/div>/g,"\n").replace(/<div><br><\/div>/g,"\n").replace(/<div>/g,"\n").replace(/<\/div>/g,"");
   
   return result
}
</script>
@endsection