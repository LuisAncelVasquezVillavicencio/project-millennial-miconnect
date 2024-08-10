@extends('layout.page_layout')
@section('title', 'Grupos')
@section('content')
<div class="page-header" >
	<div class="page-leftheader">
	</div>
</div>


<div class="row">
     	<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 ">
								<div class="card overflow-hidden ">
									<div class="card-body">
										<div class="d-flex">
											<div class="">
												<p class="mb-2 h6"> </p>
												<h2 class="mb-1 font-anton">PASO 3 ENVIAR MENSAJES</h2>
											</div>
											<div class=" my-auto ml-auto">
															<a href="{{ asset('sent1') }}" class="btn btn-cancelar btn-secondary bg-gradient-danger txt-color-white btn-pill" style="border-color: #d20c0c">
																		<i class="fa fa-remove"> CANCELAR</i> 
															</a>	
											</div>
										</div>
									</div>
								</div>
							</div>
					</div>	

<div class="row">
              <div class="col-sm-12 col-md-12 col-lg-6 col-xl-3">
								<div class="card overflow-hidden bg-gradient-secondary txt-color-white">
									<div class="card-body">
										<div class="d-flex">
											<div class="">
												<p class="mb-2 h6 txt-color-white">GRUPO </p>
												<h2 class="mb-1 txt-color-white ">{{ $item_grupo[0]->TITULO}}</h2>
											</div>
											<div class=" my-auto ml-auto">
												<!--<div class="chart-wrapper text-center">-->
												<!--	<canvas id="areaChart1" class="areaChart2 chartjs-render-monitor chart-dropshadow-primary overflow-hidden mx-auto"></canvas>-->
												<!--</div>-->
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-sm-12 col-md-12 col-lg-6 col-xl-3">
								<div class="card overflow-hidde bg-gradient-secondary txt-color-white">
									<div class="card-body">
										<div class="d-flex">
											<div class="">
												<p class="mb-2 h6">TOTAL CONTACTOS</p>
												<h2 class="mb-1 ">{{ count($list_contactos) }}</h2>
											</div>
											<div class=" my-auto ml-auto">
												<!--<div class="chart-wrapper text-center">-->
												<!--	<canvas id="areaChart1" class="areaChart2 chartjs-render-monitor chart-dropshadow-primary overflow-hidden mx-auto"></canvas>-->
												<!--</div>-->
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-sm-12 col-md-12 col-lg-6 col-xl-3">
								<div class="card overflow-hidden bg-gradient-secondary txt-color-white ">
									<div class="card-body">
										<div class="d-flex">
											<div class="">
												<p class="mb-2 h6">TOTAL MENSAJES A ENVIAR</p>
												<h2 class="mb-1 " id="total_msm_sent" >0</h2>
											</div>
											<div class=" my-auto ml-auto">
												<!--<div class="chart-wrapper">-->
												<!--	<canvas id="areaChart2" class="areaChart2 chartjs-render-monitor chart-dropshadow-secondary overflow-hidden"></canvas>-->
												<!--</div>-->
											</div>
										</div>
									</div>
								</div>
							</div>
		
							<div class="col-sm-12 col-md-12 col-lg-6 col-xl-3">
								<div class="card overflow-hidden bg-gradient-secondary txt-color-white">
									<div class="card-body">
										<div class="d-flex">
											<div class="">
												
											</div>
											<div class="my-auto ml-auto">
												<!--<div class="chart-wrapper">-->
												<!--	<canvas id="areaChart4" class="areaChart4 chartjs-render-monitor chart-dropshadow-success overflow-hidden"></canvas>-->
												<!--</div>-->
											</div>
										</div>
									</div>
								</div>
							</div>
</div>



<div class="row">
							<div class="col-sm-12 col-md-12 col-lg-6 col-xl-2">
								<div class="card overflow-hidden ">
									<div class="card-body">
										<div class="d-flex">
											<div class="">
												<p class="mb-2 h6"># <i class="fa fa-font"></i> Texto</p>
												<h2 class="mb-1 "><a id="txt_texto">0</a><a> / 100</a></h2>
											</div>
											<div class=" my-auto ml-auto">
												<!--<div class="chart-wrapper text-center">-->
												<!--	<canvas id="areaChart1" class="areaChart2 chartjs-render-monitor chart-dropshadow-primary overflow-hidden mx-auto"></canvas>-->
												<!--</div>-->
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-sm-12 col-md-12 col-lg-6 col-xl-2">
								<div class="card overflow-hidden">
									<div class="card-body">
										<div class="d-flex">
											<div class="">
												<p class="mb-2 h6"># <i class="fa fa-file-image-o"></i> Imagen</p>
												<h2 class="mb-1 "><a id="txt_imagen">0</a><a> / 10</a></h2>
											</div>
											<div class=" my-auto ml-auto">
												<!--<div class="chart-wrapper">-->
												<!--	<canvas id="areaChart2" class="areaChart2 chartjs-render-monitor chart-dropshadow-secondary overflow-hidden"></canvas>-->
												<!--</div>-->
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-sm-12 col-md-12 col-lg-6 col-xl-2">
								<div class="card overflow-hidden">
									<div class="card-body">
										<div class="d-flex">
											<div class="">
												<p class="mb-2 h6"># <i class="fa fa-file-movie-o"></i> Video</p>
												<h2 class="mb-1 "><a id="txt_video">0</a><a> / 5</a></h2>
											</div>
											<div class="my-auto ml-auto">
												<!--<div class="chart-wrapper">-->
												<!--	<canvas id="areaChart3" class="areaChart3 chartjs-render-monitor chart-dropshadow-info overflow-hidden"></canvas>-->
												<!--</div>-->
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-sm-12 col-md-12 col-lg-6 col-xl-2">
								<div class="card overflow-hidden">
									<div class="card-body">
										<div class="d-flex">
											<div class="">
												<p class="mb-2 h6"># <i class="fa fa-file-pdf-o"></i> PDF</p>
												<h2 class="mb-1 "><a id="txt_pdf">0</a><a> / 5</a></h2>
											</div>
											<div class="my-auto ml-auto">
												<!--<div class="chart-wrapper">-->
												<!--	<canvas id="areaChart4" class="areaChart4 chartjs-render-monitor chart-dropshadow-success overflow-hidden"></canvas>-->
												<!--</div>-->
											</div>
										</div>
									</div>
								</div>
							</div>
								<div class="col-sm-12 col-md-12 col-lg-6 col-xl-2">
								<div class="card overflow-hidden">
									<div class="card-body">
										<div class="d-flex">
											<div class="">
												<p class="mb-2 h6"># <i class="fa fa-file-word-o"></i> Word</p>
												<h2 class="mb-1 "><a id="txt_word" >0</a><a> / 5</a></h2>
											</div>
											<div class="my-auto ml-auto">
												<!--<div class="chart-wrapper">-->
												<!--	<canvas id="areaChart4" class="areaChart4 chartjs-render-monitor chart-dropshadow-success overflow-hidden"></canvas>-->
												<!--</div>-->
											</div>
										</div>
									</div>
								</div>
							</div>
								<div class="col-sm-12 col-md-12 col-lg-6 col-xl-2">
								<div class="card overflow-hidden">
									<div class="card-body">
										<div class="d-flex">
											<div class="">
												<p class="mb-2 h6"># <i class="fa fa-file-excel-o"></i>   Excel</p>
												<h2 class="mb-1 "><a id="txt_excel" >0</a><a> / 5</a></h2>
											</div>
											<div class="my-auto ml-auto">
												<!--<div class="chart-wrapper">-->
												<!--	<canvas id="areaChart4" class="areaChart4 chartjs-render-monitor chart-dropshadow-success overflow-hidden"></canvas>-->
												<!--</div>-->
											</div>
										</div>
									</div>
								</div>
							</div>
</div>

<form method="POST" id="form_enviar_mensaje"  action="{{ route('Sent_4') }}">
@csrf
{{--<div class="row">
  
			
			<div class="col-sm-12 col-md-12 col-lg-6 col-xl-12">
								<div class="card overflow-hidden">
									<div class="card-body">
									     	<p class="mb-2 h6">Instancia &nbsp;&nbsp;&nbsp;&nbsp;</p>
										<div class="d-flex">
												<select name="instancia_envio" id="instancia_envio" class="form-control" placeholder="Seleccione instancia" required>
												  @foreach($instancia as $linea)
												    <option value={{$linea->ID_WASSAP}}>{{$linea->PROPIETARIO}}</option>
												  @endforeach
												</select>
									      <button class="btn btn-primary" type="button" onclick="update()"><i class="fa fa-update"></i>Actualizar</button>
										</div>
									</div>
								</div>
			</div>
			
	
							
</div>--}}
<div class="row">
  <div class="col-xl-12 col-lg-12 col-md-12">
  		<div class="card">
  			<div class="card-body">
  				<h4 class="card-title mb-3">Bolsa de mensajes</h4>
  				   <h3> {{$mensajes_enviados." de ".$cantidad_mensajes_por_mes }} enviados este mes</h3>
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

<div class="row">
  
			
			<div class="col-sm-12 col-md-12 col-lg-6 col-xl-12">
								<div class="card overflow-hidden">
									<div class="card-body">
									     	<p class="mb-2 h6">Etiqueta &nbsp;&nbsp;&nbsp;&nbsp;</p>
										<div class="d-flex">
												<input type="text" id="txt_etiqueta" placeholder="Requerido para el analisis de los mensajes"  name="txt_etiqueta" class="form-control" required style="width:100%;" maxlength=50 />
									      <input type="hidden" id="txt_key" name="txt_key" class="form-control" required readonly   style="width:100%;"  />
										</div>
									</div>
								</div>
			</div>
			
	
							
</div>

<div class="row">
							<div class="col-xl-8">
							
								<div class="card">
								  
									<div class="card-header">
										<h3 class="card-title">EDITAR MENSAJES</h3>
										<div class="card-options ">
											<a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i class="fe fe-maximize"></i></a>
										</div>
									</div>
									<div class="card-body" style=" min-height: 600px; ">
									   <div class="text-wrap text-center" style="margin-bottom:15px;" >
									     <label class="control-label ">Datos disponibles :</label>
									     <span class="datos"></span>
									   </div>
									 
			
									  <div class="text-wrap text-center" style="margin-bottom:15px;" >
                			  <a id="add_texto" class="btn btn-secondary bg-gradient-secondary txt-color-white btn-pill" style="margin-left:5px;margin-right:5px;margin-bottom:5px;" >
																		<i class="fa fa-font "></i>&nbsp; +Texto
												</a>
												<a id="add_imagen" class="btn btn-secondary bg-gradient-secondary txt-color-white btn-pill" style="margin-left:5px;margin-right:5px;margin-bottom:5px;">
																		<i class="fa fa-file-image-o"></i>&nbsp; +Imagen
												</a>
												<a id="add_video" class="btn btn-secondary bg-gradient-secondary txt-color-white btn-pill" style="margin-left:5px;margin-right:5px;margin-bottom:5px;">
																		<i class="fa fa-file-movie-o"></i>&nbsp; +Video
												</a>
												<a id="add_pdf" class="btn btn-secondary bg-gradient-secondary txt-color-white btn-pill" style="margin-left:5px;margin-right:5px;margin-bottom:5px;">
																		<i class="fa fa-file-pdf-o"></i>&nbsp; +PDF
												</a>
												<a id="add_word" class="btn btn-secondary bg-gradient-secondary txt-color-white btn-pill" style="margin-left:5px;margin-right:5px;margin-bottom:5px;">
																		<i class="fa fa-file-word-o"></i>&nbsp; +Word
												</a>
												<a id="add_excel" class="btn btn-secondary bg-gradient-secondary txt-color-white btn-pill" style="mmargin-left:5px;margin-right:5px;margin-bottom:5px;">
																		<i class="fa fa-file-excel-o"></i>&nbsp; +Excel
												</a>
												<a id="add_texto_imagen" class="btn btn-secondary bg-gradient-secondary txt-color-white btn-pill" style="mmargin-left:5px;margin-right:5px;margin-bottom:5px;">
																		<i class="fa fa-file-image-o"></i>&nbsp; +Texto e Imagen
												</a>
												<a id="add_texto_video" class="btn btn-secondary bg-gradient-secondary txt-color-white btn-pill" style="mmargin-left:5px;margin-right:5px;margin-bottom:5px;">
																		<i class="fa fa-file-movie-o"></i>&nbsp; +Texto y video
												</a>
												
             <!--   			   <a class="btn btn-app " id="add_texto"  >-->
             <!--   					<i class="fa fa-font "></i> +Texto-->
             <!--   				</a>-->
             <!--   				<a class="btn btn-app" id="add_imagen">-->
             <!--   					<i class="fa fa-file-image-o"></i> +Imagen-->
             <!--   				</a>-->
             <!--   				<a class="btn btn-app" id="add_video" >-->
             <!--   					<i class="fa fa-file-movie-o"></i> +Video-->
             <!--   				</a>-->
             <!--   				<a class="btn btn-app" id="add_pdf" >-->
             <!--   					<i class="fa fa-file-pdf-o"></i> +PDF-->
             <!--   				</a>-->
             <!--   				<a class="btn btn-app" id="add_word">-->
             <!--   					<i class="fa fa-file-word-o"></i> +Word-->
             <!--   				</a>-->
             <!--   				<a class="btn btn-app" id="add_excel">-->
             <!--   					<i class="fa fa-file-excel-o"></i> +Excel-->
             <!--   				</a>-->
             <!--   				<a class="btn btn-app">-->
													<!--<i class="fa fa-repeat"></i> Reiniciar-->
									    <!--  </a>-->
                	
                		</div>
                		
							
                                                          
                	
                		<hr style="margin:0px;padding: 0px;">
										<!-- row -->
							          
										
										    <div id="msm_content"  >
										      
										    </div>
												
									
										
										<!-- /row -->
									
									
									</div>
									<div class="card-footer" >
										  <div class="form-group mb-0 mt-3 justify-content-end">
																<div>
																	<button type="submit" 
																	{{($porcentaje >= 100) ? 'disabled':''}}
																	class="btn  btn-secondary  btn-block  bg-gradient-secondary">Enviar</button>
																</div>
												</div>
									</div>
								</div>
							
							</div>
		</form>
		
							<div class="col-xl-4">
								<div class="card"  >
									<div class="card-body"   >
										
	<!--<! wassap previsualizacion---->
	

<div class="page" style = "margin-top:20px;"  >
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
          <div class="chat-container" style="margin-top: 40px;">
            <div class="user-bar">
              <div class="back">
                <i class="zmdi zmdi-arrow-left"></i>
              </div>
              <div class="avatar">
                <img src="{{ asset('images_theme/Logo-millev.png') }}" alt="Avatar">
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
              <form class="conversation-compose">
                <div class="emoji">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" id="smiley" x="3147" y="3209"><path fill-rule="evenodd" clip-rule="evenodd" d="M9.153 11.603c.795 0 1.44-.88 1.44-1.962s-.645-1.96-1.44-1.96c-.795 0-1.44.88-1.44 1.96s.645 1.965 1.44 1.965zM5.95 12.965c-.027-.307-.132 5.218 6.062 5.55 6.066-.25 6.066-5.55 6.066-5.55-6.078 1.416-12.13 0-12.13 0zm11.362 1.108s-.67 1.96-5.05 1.96c-3.506 0-5.39-1.165-5.608-1.96 0 0 5.912 1.055 10.658 0zM11.804 1.01C5.61 1.01.978 6.034.978 12.23s4.826 10.76 11.02 10.76S23.02 18.424 23.02 12.23c0-6.197-5.02-11.22-11.216-11.22zM12 21.355c-5.273 0-9.38-3.886-9.38-9.16 0-5.272 3.94-9.547 9.214-9.547a9.548 9.548 0 0 1 9.548 9.548c0 5.272-4.11 9.16-9.382 9.16zm3.108-9.75c.795 0 1.44-.88 1.44-1.963s-.645-1.96-1.44-1.96c-.795 0-1.44.878-1.44 1.96s.645 1.963 1.44 1.963z" fill="#7d8489"/></svg>
                </div>
                <input class="input-msg" name="input" placeholder="Escribe un mensaje" autocomplete="off" autofocus></input>
                <div class="photo">
                  <i class="zmdi zmdi-camera"></i>
                </div>
                <button class="send" disabled >
                    <div class="circle">
                      <i class="zmdi zmdi-mail-send"></i>
                    </div>
                  </button>
              </form>
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




@endsection
@section('scripts')

<script>
   
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

console.log(marc)

/*  $("#mensaje").keydown(function() {
      $("#visualizar_wassap").html(  $(this).val().replace(/\r?\n/g,'<br/>')  );
  });
 ‎Keyup()*/

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

{{--function update(){
  $.ajax({
    url: "{{route('sent3_instancia')}}",
    method:"GET",
    dataType: "json",
    beforeSend:function(data){
          $("#instancia_envio").attr("disabled",true)
      },
   success: function(data){
      $("#instancia_envio").html("")
      
      $.each(data.instancias, function(i,item){
        $("#instancia_envio").append('<option value="'+ item.ID_WASSAP +'">'+ item.PROPIETARIO +'</option>')
      })
      
      $("#instancia_envio").attr("disabled",false)
      
   }
  })
}--}}

function secondsToString(seconds) {
  var hour = Math.floor(seconds / 3600);
  hour = (hour < 10)? '0' + hour : hour;
  var minute = Math.floor((seconds / 60) % 60);
  minute = (minute < 10)? '0' + minute : minute;
  var second = seconds % 60;
  second = (second < 10)? '0' + second : second;
  return hour + ':' + minute + ':' + second;
}


function add_emoticon(id_input,elem){
  $("#"+id_input).val($("#"+id_input).val()+' '+elem);
}

function show_menu_emoticon(id_input,id_emoticonest){
  var myArray = [ '😀','😁','😂','🤣','😃','😄','😅','😆','😉','😊','😋','😇','😈','😌','😍','😎','😏','😐','😑','😒','😓','😕','😖' ,'📞','📟','📠','📡','📧','📪','📮','📱','📴','📶','📺','📻','📼 ', '💰','💼','📌','👓','🔍','🔎','🔑','🔒','🔔','⏰','⌚','⏳','🕧'];
  $("#"+id_emoticonest).html( ''+
                              '<label> &nbsp;<b>Emoticonos</b></label> <div class="btn-list">');
  $.each(myArray, function (ind, elem) { 
    $("#"+id_emoticonest).append( '<a  class="btn btn-icon btn-sm btn-pill"  onClick="add_emoticon(\''+id_input+'\',\''+elem+'\')" >'+elem+'</a>' );
  }); 
  $("#"+id_emoticonest).append( '</div>');
}



function refresh_txt(){
  refresh_txt_texto();
  refresh_txt_imagen();
  refresh_txt_video();
  refresh_txt_pdf();
  refresh_txt_word();
  refresh_txt_excel();
  
  contact = "{{ count($list_contactos) }}" ;
  global_items=global_items_texto+global_items_image+global_items_video+global_items_pdf+global_items_excel+global_items_word;
  
  total_sent_envio=contact*global_items;
  
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
  $("#txt_word").html(global_items_excel);
}
function refresh_txt_excel(){
  $("#txt_excel").html(global_items_word);
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
}
   
  $(document).ready(function(){
  	
  	
  	$('#form_enviar_mensaje').on('submit', function(e) { //use on if jQuery 1.7+
  	    if(global_items_texto>max_items_texto){
  	       e.preventDefault();
  	       $.growl.warning({ title: "ADVERTENCIA", message: "Supero el máximo número de mensajes tipo texto por enviar" });
  	    }else if(global_items_image>max_items_image){
  	       e.preventDefault();
  	       $.growl.warning({ title: "ADVERTENCIA", message: "Supero el máximo número de mensajes tipo imagen por enviar" });
  	    }else if(global_items_video>max_items_video){
  	       e.preventDefault();
  	       $.growl.warning({ title: "ADVERTENCIA", message: "Supero el máximo número de mensajes tipo video por enviar" });
  	    }else if(global_items_pdf>max_items_pdf){
  	       e.preventDefault();
  	       $.growl.warning({ title: "ADVERTENCIA", message: "Supero el máximo número de mensajes tipo pdf por enviar" });
  	    }else if(global_items_excel>max_items_excel){
  	       e.preventDefault();
  	       $.growl.warning({ title: "ADVERTENCIA", message: "Supero el máximo número de mensajes tipo excel por enviar" });
  	    }else if(global_items_word>max_items_word){
  	       e.preventDefault();
  	       $.growl.warning({ title: "ADVERTENCIA", message: "Supero el máximo número de mensajes tipo word por enviar" });
  	    }
    });
    
  	
  	$("#txt_key").attr('value', makeid(300));
  	
    $('#add_texto').click(function(){
      global_items_texto++;
      refresh_txt();
      var key = makeid(50);
      var id_emoticonest= 'key_emoticones_'+key;
      var id_content= 'key_content_'+key;
      var id_input= 'key_text_'+key;
      var id_sent= 'sent_text_'+key;
      $('#msm_content').append( 
                		            '<div class="input-group p-1"  id="'+id_content+'"  >'+
                                '<div class="input-group-prepend">'+
        													'<div class="input-group-text br-tl-3 br-bl-3">'+
        														'<i class="fa fa-font"></i>'+
        													'</div>'+
        												'</div>'+
  															'<textarea name="'+id_input+'" id="'+id_input+'" class="form-control mention_'+id_input+'" placeholder="Ingresa tu texto ..." rows="3" required maxlength="60000" style="" ></textarea>'+
  															'<span class="input-group-append">'+
  																'<button class="btn btn-default border-0 box-shadow-0" type="button"  onClick="remove_obj(\''+id_content+'\',\''+id_sent+'\',\'texto\')"  >' +
  																'<a><i class="fe fe-x"></i></a>'+
  															'</button>'+
  															'</span>'+
  															'<nav class="" id="'+id_emoticonest+'"></nav><br><hr style="margin:0px;padding: 0px;">'+
  														  '</div>'
  														  );
  														  
  		$('#content_conversation').append( '<div id="'+id_sent+'" class="message_device sent" ></div>');			
  		show_menu_emoticon(id_input,id_emoticonest);
  	  
      $("#"+id_input).on('keyup', function() {
        $("#"+id_sent).html($(this).val().replace(/\r?\n/g,'<br/>'));
       
      });
      
      $("#"+id_input).bind("paste", function(e){
          // access the clipboard using the api
        $("#"+id_sent).html($(this).val().replace(/\r?\n/g,'<br/>'));
          
      });
      
      $("#"+id_input).bind("mouseover", function(e){
          // access the clipboard using the api
        $("#"+id_sent).html($(this).val().replace(/\r?\n/g,'<br/>'));
         
      });
      
      $("#"+id_input).bind("change", function(e){
          // access the clipboard using the api
        $("#"+id_sent).html($(this).val().replace(/\r?\n/g,'<br/>'));
         
      });
    
    x_var = 'textarea.mention_'+id_input
    
    $(x_var).atwho({
        at: "@",
        data:marc,
        displayTpl: '<li>${nombre}</li>',
        insertTpl: ":${nombre}:",
        searchKey: "nombre",
        spaceSelectsMatch: true,
        limit:10,
    });
   
    });

    
    $('#add_imagen').click(function(){
      global_items_image++;
      refresh_txt();
      
      var key = makeid(50);
      var id_content= 'key_content_'+key;
      var id_input= 'key_img__'+key;
      var id_sent= 'sent_img_'+key;
      $('#msm_content').append( '<div class="input-group p-1"  id="'+id_content+'"  >'+
                                '<div class="input-group-prepend">'+
        													'<div class="input-group-text br-tl-3 br-bl-3">'+
        														'<i class="fa fa-file-image-o"></i>'+
        													'</div>'+
        												'</div>'+
  															'<input type="url" name="'+id_input+'" id="'+id_input+'"  class="form-control" required  '+
  															'placeholder="https://example.com/(.jpg|.png|.jpeg|.gif)" pattern="https?:\/\/(www\.)*)(.jpg|.png|.jpeg|.gif)" > '+
  															'<span class="input-group-append">'+
  																'<button class="btn btn-default border-0 box-shadow-0" type="button"  onClick="remove_obj(\''+id_content+'\',\''+id_sent+'\',\'img\')"  >' +
  																'<a><i class="fe fe-x"></i></a>'+
  															'</button>'+
  															'</span>'+
  														  '</div>');
  		$('#content_conversation').append( '<div  id="'+id_sent+'" class="message_device sent" style="" >'+
  		                                   '<img  id="img'+id_sent+'" style="height:120px;border-radius: 20px;border: solid 3px #dcf8c6 !important;" />'+
  		                                   '</div>');			
  		
  	  $("#"+id_input).on('keyup', function() {
        //$("#"+id_sent).html($(this).val().replace(/\r?\n/g,'<br/>'));
        $("#img"+id_sent).attr('src', $(this).val() );
      });
      
      $("#"+id_input).bind("paste", function(e){
          // access the clipboard using the api
          $("#img"+id_sent).attr('src', $(this).val() );
      });
      
      $("#"+id_input).bind("mouseover", function(e){
          // access the clipboard using the api
          $("#img"+id_sent).attr('src', $(this).val() );
      });
      
      $("#"+id_input).bind("change", function(e){
          // access the clipboard using the api
          $("#img"+id_sent).attr('src', $(this).val() );
      });
      
    })
    
    $('#add_video').click(function(){
      global_items_video++;
      refresh_txt();
     
      var key = makeid(50);
      var id_content= 'key_content_'+key;
      var id_input= 'key_mov__'+key;
      var id_sent= 'sent_mov_'+key;
      $('#msm_content').append( '<div class="input-group p-1"  id="'+id_content+'"  >'+
                                '<div class="input-group-prepend">'+
        													'<div class="input-group-text br-tl-3 br-bl-3">'+
        														'<i class="fa fa-file-movie-o"></i>'+
        													'</div>'+
        												'</div>'+
  															'<input type="url" name="'+id_input+'" id="'+id_input+'"  class="form-control" required  '+
  															'placeholder="https://example.com/(.mp4)" pattern="https?:\/\/(www\.)*)(.mp4)" > '+
  															'<span class="input-group-append">'+
  																'<button class="btn btn-default border-0 box-shadow-0" type="button"  onClick="remove_obj(\''+id_content+'\',\''+id_sent+'\',\'video\')"  >' +
  																'<a><i class="fe fe-x"></i></a>'+
  															'</button>'+
  															'</span>'+
  														  '</div>');
  		$('#content_conversation').append( '<div  id="'+id_sent+'" class="message_device sent" style="z-index: 1000;" >'+
  		                                   '<video  id="mov'+id_sent+'" height="120" controls  >'+
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
      
      $("#"+id_input).bind("mouseover", function(e){
          // access the clipboard using the api
          $("#mov"+id_sent).attr('src', $(this).val() );
      });
      
      $("#"+id_input).bind("change", function(e){
          // access the clipboard using the api
          $("#mov"+id_sent).attr('src', $(this).val() );
      });
      
    })
    
    $('#add_pdf').click(function(){
      global_items_pdf++;
      refresh_txt();
      
      var svg = "{{ asset('img/pdf.svg')}}" ;
      var key = makeid(50);
      var id_content= 'key_content_'+key;
      var id_input= 'key_pdf__'+key;
      var id_sent= 'sent_pdf_'+key;
      $('#msm_content').append( '<div class="input-group p-1"  id="'+id_content+'"  >'+
                                '<div class="input-group-prepend">'+
        													'<div class="input-group-text br-tl-3 br-bl-3">'+
        														'<i class="fa fa-file-pdf-o"></i>'+
        													'</div>'+
        												'</div>'+
  															'<input type="url" name="'+id_input+'" id="'+id_input+'"  class="form-control" required  '+
  															'placeholder="https://example.com/(.pdf)" pattern="https?:\/\/(www\.)*)(.pdf)" > '+
  															'<span class="input-group-append">'+
  																'<button class="btn btn-default border-0 box-shadow-0" type="button"  onClick="remove_obj(\''+id_content+'\',\''+id_sent+'\',\'pdf\')"  >' +
  																'<a><i class="fe fe-x"></i></a>'+
  															'</button>'+
  															'</span>'+
  														  '</div>');
  		$('#content_conversation').append( '<div  id="'+id_sent+'" class="message_device sent" style="z-index: 1000;" >'+
  		                                   '<a id="pdf'+id_sent+'" target="_blank" >'+
  		                                   '<img  src="'+svg+'" style="height:50px;border: solid 3px #dcf8c6 !important;" />'+
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
      
      $("#"+id_input).bind("mouseover", function(e){
          // access the clipboard using the api
          $("#pdf"+id_sent).attr('href', $(this).val() );
      });
      
      $("#"+id_input).bind("change", function(e){
          // access the clipboard using the api
          $("#pdf"+id_sent).attr('href', $(this).val() );
      });
    })
    
    $('#add_word').click(function(){
      global_items_word++;
      refresh_txt();
      
      var svg = "{{ asset('img/word.svg')}}" ;
      var key = makeid(50);
      var id_content= 'key_content_'+key;
      var id_input= 'key_word__'+key;
      var id_sent= 'sent_word_'+key;
      $('#msm_content').append( '<div class="input-group p-1"  id="'+id_content+'"  >'+
                                '<div class="input-group-prepend">'+
        													'<div class="input-group-text br-tl-3 br-bl-3">'+
        														'<i class="fa fa-file-pdf-o"></i>'+
        													'</div>'+
        												'</div>'+
  															'<input type="url" name="'+id_input+'" id="'+id_input+'"  class="form-control" required  '+
  															'placeholder="https://example.com/(.doc|.docx)" pattern="https?:\/\/(www\.)*)(.doc|.docx)" > '+ 
  															'<span class="input-group-append">'+
  																'<button class="btn btn-default border-0 box-shadow-0" type="button"  onClick="remove_obj(\''+id_content+'\',\''+id_sent+'\',\'pdf\')"  >' +
  																'<a><i class="fe fe-x"></i></a>'+
  															'</button>'+
  															'</span>'+
  														  '</div>');
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
      
      $("#"+id_input).bind("mouseover", function(e){
          // access the clipboard using the api
          $("#word"+id_sent).attr('href', $(this).val() );
      });
      
      $("#"+id_input).bind("change", function(e){
          // access the clipboard using the api
          $("#word"+id_sent).attr('href', $(this).val() );
      });
    })
    
    $('#add_excel').click(function(){
      global_items_excel++;
      refresh_txt();
      
      var svg = "{{ asset('img/excel.svg')}}" ;
      var key = makeid(50);
      var id_content= 'key_content_'+key;
      var id_input= 'key_excel__'+key;
      var id_sent= 'sent_excel_'+key;
      $('#msm_content').append( '<div class="input-group p-1"  id="'+id_content+'"  >'+
                                '<div class="input-group-prepend">'+
        													'<div class="input-group-text br-tl-3 br-bl-3">'+
        														'<i class="fa fa-file-pdf-o"></i>'+
        													'</div>'+
        												'</div>'+
  															'<input type="url" name="'+id_input+'" id="'+id_input+'"  class="form-control" required  '+
  															'placeholder="https://example.com/(.xlsx|.xlsm|.xls)" pattern="https?:\/\/(www\.)*)(.xlsx|.xlsm|.xls)" > '+
  															'<span class="input-group-append">'+
  																'<button class="btn btn-default border-0 box-shadow-0" type="button"  onClick="remove_obj(\''+id_content+'\',\''+id_sent+'\',\'pdf\')"  >' +
  																'<a><i class="fe fe-x"></i></a>'+
  															'</button>'+
  															'</span>'+
  														  '</div>');
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
    })
    
    $('#add_texto_imagen').click(function(){
      global_items_texto++;
      global_items_image++;
      refresh_txt();
      
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
      
      $('#msm_content').append( '<div id="'+id_content+'">'+
      
                                '<div class="input-group p-1" >'+
                                '<div class="input-group-prepend">'+
        													'<div class="input-group-text br-tl-3 br-bl-3">'+
        														'<i class="fa fa-file-image-o"></i>'+
        													'</div>'+
        												'</div>'+
  															'<input type="url" id="'+id_input_key_img+'"  class="form-control" required  '+
  															'placeholder="https://example.com/(.jpg|.png|.jpeg|.gif)" pattern="https?:\/\/(www\.)*)(.jpg|.png|.jpeg|.gif)" > '+
  															'<span class="input-group-append">'+
  																'<button class="btn btn-default border-0 box-shadow-0" type="button"  onClick="remove_obj_dos(\''+id_content+'\',\''+id_sent_sent_img+'\',\''+id_sent_sent_text+'\',\'textoimagen\')"  >' +
  																'<a><i class="fe fe-x"></i></a>'+
  															'</button>'+
  															'</span>'+
  														  '</div>'+
  														  
                		            '<div class="input-group p-1" >'+
                                '<div class="input-group-prepend">'+
        													'<div class="input-group-text br-tl-3 br-bl-3">'+
        														'<i class="fa fa-font"></i>'+
        													'</div>'+
        												'</div>'+
  															'<textarea id="'+id_input_key_text+'" class="form-control mention_'+id_input_key_text+'" placeholder="Ingresa tu texto ..." rows="3" required maxlength="60000" style="" ></textarea>'+
  															'<span class="input-group-append">'+
  																'<button class="btn btn-default border-0 box-shadow-0" type="button"  onClick="remove_obj_dos(\''+id_content+'\',\''+id_sent_sent_img+'\',\''+id_sent_sent_text+'\',\'textoimagen\')"  >' +
  																'<a><i class="fe fe-x"></i></a>'+
  															'</button>'+
  															'</span>'+
  															'<nav class="" id="'+id_emoticonest+'"></nav><br><hr style="margin:0px;padding: 0px;">'+
  														  '</div>'+
  														  '<input type="hidden" id="'+id_input+'" name="'+id_sent+'">'+
  														  
  														  '</div>'
  														  );
  														  
  	  
  	  $('#content_conversation').append( '<div  id="'+id_sent_sent_img+'" class="message_device sent" style="" >'+
  		                                   '<img  id="img'+id_sent_sent_img+'" style="height:120px;border-radius: 20px;border: solid 3px #dcf8c6 !important;" />'+
  		                                   '</div>');	
  		                                   
  		$('#content_conversation').append( '<div id="'+id_sent_sent_text+'" class="message_device sent" ></div>');			
  		show_menu_emoticon(id_input,id_emoticonest);                              
  	  
      $("#"+id_input_key_text).on('keyup', function() {
        $("#"+id_sent_sent_text).html($(this).val().replace(/\r?\n/g,'<br/>'));
        $("#"+id_input).val($("#"+id_input_key_img).val()+"((-))"+$("#"+id_input_key_text).val());
      });
      
      $("#"+id_input_key_text).bind("paste", function(e){
          // access the clipboard using the api
        $("#"+id_sent_sent_text).html($(this).val().replace(/\r?\n/g,'<br/>'));
        $("#"+id_input).val($("#"+id_input_key_img).val()+"((-))"+$("#"+id_input_key_text).val());
          
      });
      
      $("#"+id_input_key_text).bind("mouseover", function(e){
          // access the clipboard using the api
        $("#"+id_sent_sent_text).html($(this).val().replace(/\r?\n/g,'<br/>'));
        $("#"+id_input).val($("#"+id_input_key_img).val()+"((-))"+$("#"+id_input_key_text).val());
         
      });
      
      $("#"+id_input_key_text).bind("change", function(e){
          // access the clipboard using the api
        $("#"+id_sent_sent_text).html($(this).val().replace(/\r?\n/g,'<br/>'));
        $("#"+id_input).val($("#"+id_input_key_img).val()+"((-))"+$("#"+id_input_key_text).val());
         
      });
      
      // Metodos de imagen
      
      $("#"+id_input_key_img).on('keyup', function() {
        //$("#"+id_sent).html($(this).val().replace(/\r?\n/g,'<br/>'));
        $("#img"+id_sent_sent_img).attr('src', $(this).val() );
        $("#"+id_input).val($("#"+id_input_key_img).val()+"((-))"+$("#"+id_input_key_text).val());
      });
      
      $("#"+id_input_key_img).bind("paste", function(e){
          // access the clipboard using the api
          $("#img"+id_sent_sent_img).attr('src', $(this).val() );
          $("#"+id_input).val($("#"+id_input_key_img).val()+"((-))"+$("#"+id_input_key_text).val());
      });
      
      $("#"+id_input_key_img).bind("mouseover", function(e){
          // access the clipboard using the api
          $("#img"+id_sent_sent_img).attr('src', $(this).val() );
          $("#"+id_input).val($("#"+id_input_key_img).val()+"((-))"+$("#"+id_input_key_text).val());
      });
      
      $("#"+id_input_key_img).bind("change", function(e){
          // access the clipboard using the api
          $("#img"+id_sent_sent_img).attr('src', $(this).val() );
          $("#"+id_input).val($("#"+id_input_key_img).val()+"((-))"+$("#"+id_input_key_text).val());
      });
      
          
      x_var = 'textarea.mention_'+id_input_key_text
      
      $(x_var).atwho({
          at: "@",
          data:marc,
          displayTpl: '<li>${nombre}</li>',
          insertTpl: ":${nombre}:",
          searchKey: "nombre",
          spaceSelectsMatch: true,
          limit:10,
      });


    });

    
   
  	$('#add_texto').trigger('click');
    
   
    
    
  })
  
  //Agregando texto y video 19/12/2020
  
  $('#add_texto_video').click(function(){
      global_items_texto++;
      global_items_video++;
      refresh_txt();
      
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
      
      $('#msm_content').append( '<div id="'+id_content+'">'+
      
                            '<div class="input-group p-1" >'+
                            '<div class="input-group-prepend">'+
    													'<div class="input-group-text br-tl-3 br-bl-3">'+
    														'<i class="fa fa-file-image-o"></i>'+
    													'</div>'+
    												'</div>'+
														'<input type="url" id="'+id_input_key_video+'"  class="form-control" required  '+
														'placeholder="https://example.com/(.mp4)" pattern="https?:\/\/(www\.)*)(.mp4)" > '+
														'<span class="input-group-append">'+
															'<button class="btn btn-default border-0 box-shadow-0" type="button"  onClick="remove_obj_dos(\''+id_content+'\',\''+id_sent_sent_video+'\',\''+id_sent_sent_text+'\',\'textovideo\')"  >' +
															'<a><i class="fe fe-x"></i></a>'+
														'</button>'+
														'</span>'+
													  '</div>'+
													  
            		            '<div class="input-group p-1" >'+
                            '<div class="input-group-prepend">'+
    													'<div class="input-group-text br-tl-3 br-bl-3">'+
    														'<i class="fa fa-font"></i>'+
    													'</div>'+
    												'</div>'+
														'<textarea id="'+id_input_key_text+'" class="form-control mention_'+id_input_key_text+'" placeholder="Ingresa tu texto ..." rows="3" required maxlength="60000" style="" ></textarea>'+
														'<span class="input-group-append">'+
															'<button class="btn btn-default border-0 box-shadow-0" type="button"  onClick="remove_obj_dos(\''+id_content+'\',\''+id_sent_sent_video+'\',\''+id_sent_sent_text+'\',\'textovideo\')"  >' +
															'<a><i class="fe fe-x"></i></a>'+
														'</button>'+
														'</span>'+
														'<nav class="" id="'+id_emoticonest+'"></nav><br><hr style="margin:0px;padding: 0px;">'+
													  '</div>'+
													  '<input type="hidden" id="'+id_input+'" name="'+id_sent+'">'+
													  
													  '</div>'
													  );
		
		$('#content_conversation').append( '<div  id="'+id_sent_sent_video+'" class="message_device sent" style="z-index: 1000;" >'+
  		                                   '<video  id="mov'+id_sent_sent_video+'" height="120" controls  >'+
                                            '<source src="" type="video/mp4">'+
                                         '</video>'+
  		                                   '</div>');			
  		
  	  $("#"+id_input).on('keyup', function() {
        //$("#"+id_input_key_video).html($(this).val().replace(/\r?\n/g,'<br/>'));
        $("#mov"+id_sent_sent_video).attr('src', $(this).val() );
      });
      
      $("#"+id_input_key_video).bind("paste", function(e){
          // access the clipboard using the api
          $("#mov"+id_sent_sent_video).attr('src', $(this).val() );
      });
      
      $("#"+id_input_key_video).bind("mouseover", function(e){
          // access the clipboard using the api
          $("#mov"+id_sent_sent_video).attr('src', $(this).val() );
      });
      
      $("#"+id_input_key_video).bind("change", function(e){
          // access the clipboard using the api
          $("#mov"+id_sent_sent_video).attr('src', $(this).val() );
      });
      
      $('#content_conversation').append( '<div id="'+id_sent_sent_text+'" class="message_device sent" ></div>');			
  		show_menu_emoticon(id_input,id_emoticonest);    
      
      $("#"+id_input_key_text).on('keyup', function() {
        $("#"+id_sent_sent_text).html($(this).val().replace(/\r?\n/g,'<br/>'));
        $("#"+id_input).val($("#"+id_input_key_text).val()+"((-))"+$("#"+id_input_key_text).val());
      });
      
      $("#"+id_input_key_text).bind("paste", function(e){
          // access the clipboard using the api
        $("#"+id_sent_sent_text).html($(this).val().replace(/\r?\n/g,'<br/>'));
        $("#"+id_input).val($("#"+id_input_key_video).val()+"((-))"+$("#"+id_input_key_text).val());
          
      });
      
      $("#"+id_input_key_text).bind("mouseover", function(e){
          // access the clipboard using the api
        $("#"+id_sent_sent_text).html($(this).val().replace(/\r?\n/g,'<br/>'));
        $("#"+id_input).val($("#"+id_input_key_video).val()+"((-))"+$("#"+id_input_key_text).val());
         
      });
      
      $("#"+id_input_key_text).bind("change", function(e){
          // access the clipboard using the api
        $("#"+id_sent_sent_text).html($(this).val().replace(/\r?\n/g,'<br/>'));
        $("#"+id_input).val($("#"+id_input_key_video).val()+"((-))"+$("#"+id_input_key_text).val());
         
      });
      
      x_var = 'textarea.mention_'+id_input_key_text
    
      $(x_var).atwho({
          at: "@",
          data:marc,
          displayTpl: '<li>${nombre}</li>',
          insertTpl: ":${nombre}:",
          searchKey: "nombre",
          spaceSelectsMatch: true,
          limit:10,
      });
      
  })
   
   
  
</script>
@endsection



<!--var eventlist = ["resizeend","rowenter","dragleave","beforepaste","dragover","beforecopy","page","beforeactivate","beforeeditfocus","controlselect","blur",-->
<!--                       "beforedeactivate","keydown","dragstart","scroll","propertychange","dragenter","rowsinserted","mouseup","contextmenu","beforeupdate",-->
<!--                       "readystatechange","mouseenter","resize","copy","selectstart","move","dragend","rowexit","activate","focus","focusin","mouseover","cut",-->
<!--                       "mousemove","focusout","filterchange","drop","blclick","rowsdelete","keypress","losecapture","deactivate","datasetchanged","dataavailable",-->
<!--                       "afterupdate","mousewheel","keyup","movestart","mouseout","moveend","cellchange","layoutcomplete","help","errorupdate","mousedown","paste",-->
<!--                       "mouseleave","click","drag","resizestart","datasetcomplete","beforecut","change","error","abort","load","select"];-->