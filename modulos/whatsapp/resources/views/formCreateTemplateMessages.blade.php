<!doctype html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--favicon-->
	<link rel="icon" href={{ asset("/images/favicon-32x32.png") }} type="image/png" />
	<!--plugins-->
	<link href={{ asset("/plugins/simplebar/css/simplebar.css") }} rel="stylesheet" />
	<link href={{ asset("/plugins/input-tags/css/tagsinput.css") }} rel="stylesheet" />
	<link href={{ asset("/plugins/metismenu/css/metisMenu.min.css") }} rel="stylesheet" />
	<!-- loader-->
	<link href={{ asset("/css/pace.min.css") }} rel="stylesheet" />
	<script src={{ asset("/js/pace.min.js") }}></script>
	<!-- Bootstrap CSS -->
	<link href={{ asset("/css/bootstrap.min.css") }} rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
	<link href={{ asset("/css/app.css") }} rel="stylesheet">
	<link href={{ asset("/css/icons.css") }} rel="stylesheet">
	<!-- Theme Style CSS -->
	<link rel="stylesheet" href={{ asset("/css/dark-theme.css") }} />
	<link rel="stylesheet" href={{ asset("/css/semi-dark.css") }} />
	<link rel="stylesheet" href={{ asset("/css/header-colors.css") }} />
	<title>Whatsapp</title>
</head>

<body>
	<!--wrapper-->
	<div class="">
		
	
		<!--end navigation-->
		<!--start page wrapper -->
		<div class="">
			<div class="page-content">
				<div class="row">
					<div class="col-xl-9 mx-auto">
						<h6 class="mb-0 text-uppercase">Form Create Template Messages</h6>
						<hr/>
						<div class="card">
							<div class="card-body">
								
								@csrf
								<div class="mb-3">
									<label class="form-label">Seleccionar configuración</label>
									<select class="form-select mb-3" id="configid" >
										@foreach ($whatsappConfig as $item)
									       <option value="{{ $item->id }}" selected >{{ $item->nombre.' (+'.$item->numero.') ' }} </option>
									    @endforeach
									</select>
								</div>
								
								<div class="mb-3">
										<label class="form-label">Nombre plantilla (no mayusculas - no espacio)</label>
										<input type="text" class="form-control" id="templateName" placeholder="Asigna un nombre a la plantilla de mensaje. (max 512 - no usar espacios)">
								</div>
								
								<div class="mb-3">
										<label class="form-label">Category:</label><br>
										<label class="form-label">Elige una plantilla de mensaje.</label>
								</div>
								<div class="mb-3">
										<div class="form-check">
											<input class="form-check-input" type="radio" name="category" id="category1" checked>
											<label class="form-check-label" for="flexRadioDefault1">Transacciones (Envía notificaciones de la cuenta y los pedidos, alertas y más para compartir información importante)</label>
										</div>
										<div class="form-check">
											<input class="form-check-input" type="radio" name="category" id="category2" >
											<label class="form-check-label" for="flexRadioDefault2">Marketing (Envía ofertas promocionales, anuncios de productos y más para aumentar el reconocimiento y la interacción)</label>
										</div>
										<div class="form-check">
											<input class="form-check-input" type="radio" name="category" id="category3" >
											<label class="form-check-label" for="flexRadioDefault2">Contraseñas de un solo uso (Envía códigos que permitan a los clientes acceder a su cuenta)</label>
										</div>
								</div>
							
								<div class="mb-3">
									<label class="form-label">IDIOMA</label>
									<select class="form-select mb-3" id="language" >
										<option value="es" selected>Español</option>
										<option value="es_AR">Español (Argentina)</option>
										<option value="es_ES">Español (España)</option>
										<option value="es_MX">Español (México)</option>
										<option value="en"  >Inglés</option>
										<option value="en_GB"  >Inglés (Reino Unido)</option>
										<option value="es_LA"  >Inglés (EE. UU.)</option>
									</select>
								</div>


								<div class="mb-3">
									    <div class="form-check">
											<input class="form-check-input" type="checkbox" value="" id="header">
											<label class="form-check-label" for="header">Configurar Encabezado (Se puede agregar un texto solo permite una variable o archivo multimedia)</label>
										</div>
										<div class="form-check">
											<input class="form-check-input" type="checkbox" value="true" id="body" checked disabled>
											<label class="form-check-label" for="body">Configurar Contenido* (solo texto)</label>
										</div>
										<div class="form-check">
											<input class="form-check-input" type="checkbox" value="" id="footer">
											<label class="form-check-label" for="footer">Configurar Pie de página (texto al final de su plantilla de mensaje)</label>
										</div>
										<div class="form-check">
											<input class="form-check-input" type="checkbox" value="" id="example" disabled>
											<label class="form-check-label" for="example">Configurar Muestra (Se mostrara automaticamente si es requerido)</label>
										</div>
								</div>
							</div>
						</div>
								
								<section id="section_header"><div class="card"><div class="card-body">
										<div class="mb-3">
											<label class="form-label">Encabezado (Opcional)</label><br>
											<label class="form-label">Agregue un título o elija qué tipo de medio usará para este encabezado.</label>
										</div>
										<div class="mb-3">
												<div class="form-check">
													<input class="form-check-input" type="radio" name="typeheader" id="typeheader1" checked>
													<label class="form-check-label" for="flexRadioDefault1">Ninguna</label>
												</div>
												<div class="form-check">
													<input class="form-check-input" type="radio" name="typeheader" id="typeheader2" >
													<label class="form-check-label" for="flexRadioDefault2">Mensaje de texto</label>
												</div>
												<div class="form-check">
													<input class="form-check-input" type="radio" name="typeheader" id="typeheader3" >
													<label class="form-check-label" for="flexRadioDefault2">Imagen</label>
												</div>
												<div class="form-check">
													<input class="form-check-input" type="radio" name="typeheader" id="typeheader4" >
													<label class="form-check-label" for="flexRadioDefault2">Video</label>
												</div>
												<div class="form-check">
													<input class="form-check-input" type="radio" name="typeheader" id="typeheader5">
													<label class="form-check-label" for="flexRadioDefault2">Documento</label>
												</div>
										</div>
										
										<section id="section_header_text">
											<div class="mb-3">
												<label class="form-label">Mensaje de texto</label><br>
												<label class="form-label">Introduzca el texto de su mensaje en el idioma que haya seleccionado.</label>
												<input type="text" class="form-control" id="templateHeaderText" placeholder="60 caracteres solo 1 variable">
											</div>	
											<div class="form-check">
												<input class="form-check-input" type="checkbox" name="templateHeaderVariable" id="templateHeaderVariable">
												<label class="form-check-label" for="templateHeaderVariable">Incluir variable</label>
											</div>
										</section>
										
										<section id="section_header_url">
											<div class="mb-3">
												<label class="form-label">Url</label><br>
												<label class="form-label">Introduzca el texto de su mensaje en el idioma que haya seleccionado.</label>
												<input type="text" class="form-control" id="templateHeaderUrl" placeholder="60 caracteres solo 1 variable">
											</div>
										</section>
										
								</div></div></section>
								
								
								<section id="section_body">
									<div class="card"><div class="card-body">
										<div class="mb-3">
											<label class="form-label">Mensaje (requerido)</label><br>
											<label class="form-label">Introduzca el texto de su mensaje en el idioma que haya seleccionado.</label>
											<textarea class="form-control" id="templateBodyText" placeholder="Introduzca el texto" rows="3" style="height: 160px;"></textarea>
											Caracteres: 0/1024
										</div>
										<div class="input-group mb-3">
											<div class="input-group-text" >
												<div class="form-check">
													<input class="form-check-input" type="checkbox" name="templateBodyVariable" id="templateBodyVariable">
													<label class="form-check-label" for="templateBodyVariable">&nbsp;  Incluir variable</label>
												</div>	
											</div>
											<select class="form-select" id="countTextBodyVariables">
												<option selected="0">0</option>
												<option value="1">1 variable</option>
												<option value="2">2 variables</option>
												<option value="3">3 variables</option>
												<option value="4">4 variables</option>
												<option value="5">5 variables</option>
												<option value="6">6 variables</option>
												<option value="7">7 variables</option>
												<option value="8">8 variables</option>
												<option value="9">9 variables</option>
												<option value="10">10 variables</option>
											</select>
										</div>
									</div></div>
								</section>
								
										
								<section id="section_footer"><div class="card"><div class="card-body">
									<div class="mb-3">
											<label class="form-label">Pie de página (Opcional)</label><br>
											<label class="form-label">Agregue una línea corta de texto al final de su plantilla de mensaje.</label>
											<input type="text" class="form-control" id="templateFooterText" placeholder="max 60">
									</div>
								</div></div></section>
										
								
								
								<section >
									<div class="card"><div class="card-body">
										
									<div class="mb-3">
											<label class="form-label">Configuración de contenido de muestra</label><br>
											<label class="form-label">Para ayudarnos a comprender qué tipo de mensaje desea enviar, tiene la opción de proporcionar ejemplos de contenido específicos para su plantilla. 
											Puede agregar una plantilla de muestra para uno o todos los idiomas que envíe.Asegúrate de no incluir información real del usuario o el cliente, y proporciona solo contenido 
											de prueba en tus ejemplos. <a href="#" onclick="$('#exampleModal').modal('show')" >Más información</a></label>
											
									</div>
	                                
	                                <section id="example_header">
	                                	<div class="mb-3">
											<label for="formFile" class="form-label">Encabezado (muestra)</label>
											<input class="form-control" type="file" id="formFile">
										</div>
										<div class="mb-3">
											<label for="templateExampleHeader" class="form-label">Encabezado texto (muestra)</label>
											<input type="text" class="form-control" id="templateExampleHeader" placeholder="">
										</div>
										<div class="mb-3">
											<label for="templateHeaderTypeHandle" class="form-label">templateHeaderTypeHandle (muestra)</label>
											<input type="text" class="form-control" id="templateHeaderTypeHandle" placeholder="">
										</div>
										<div class="mb-3">
											<label for="templateHeaderTypeUrl" class="form-label">templateHeaderTypeUrl (muestra)</label>
											<input type="text" class="form-control" id="templateHeaderTypeUrl" placeholder="">
										</div>
	                                </section>
	                                <section id="example_body">
	                                	<div class="mb-3" >
											<label for="templateExampleBody" class="form-label">Mensaje texto (muestra)</label>
											<section id="contentVariables">
												
											</section>
										</div>
	                                </section>
										
									
									
                                </section>

								<div class="mb-3">
									<button type="button" onclick="post()" class="btn btn-primary px-5">Enviar</button>	
								</div>
								
								
							</div>
						</div>
						
					</div>
				</div>
				<!--end row-->
			</div>
		</div>
		
		<!-- Modal -->
		<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		  <div class="modal-dialog modal-lg" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h5 class="modal-title" id="exampleModalLabel">Normas para plantillas de mensajes</h5>
		        </div>
		      <div class="modal-body">
		        <label class="form-label">Un equipo de Meta revisa las plantillas de mensajes de forma diaria. Nos comprometemos a responder las solicitudes de plantilla en un plazo máximo de 24 horas, salvo en fines de semana y feriados.</label><br>
		        
		        <label class="form-label"><b>Motivos de rechazos</b></label><br>
		        <label class="form-label">Si se rechazaron las plantillas de mensajes, es posible que se deba a una de las siguientes razones:</label><br>
				- Errores ortográficos o gramaticales Los mensajes con errores ortográficos o gramaticales pueden hacer que los clientes los consideren spam o un engaño.<br>
				- Faltan parámetros variables o tiene llaves disparejas. El formato correcto es {{1}}.<br>
				- No hay parámetros variables definidos. Todos los parámetros deben tener un propósito conocido. Por ejemplo, el tipo de contenido multimedia que planeas enviar en un mensaje con contenido multimedia. Se rechazará la plantilla si no sabemos qué incluye un parámetro específico. Te recomendamos agregar una muestra con el envío.<br>
				- Los parámetros variables contienen caracteres especiales, como #, $ o %.<br>
				- Los parámetros variables no son secuenciales. Por ejemplo, {{1}}, {{2}}, {{4}}, {{5}} están definidos, pero {{3}} no existe.<br>
				- El idioma definido no coincide con el contenido. Por ejemplo, se seleccionó el español, pero el contenido está en inglés o es una combinación de idiomas que contienen español e inglés.<br>
				- El formato de envío para probar la conexión a la API es incorrecto. El formato correcto es:<br>
				- Nombre de la plantilla de mensaje: prueba<br>
				- Contenido: Hola, {{1}}<br>
				- Las URL de tus enlaces están abreviadas. Los enlaces directos ocultan el destino deseado del enlace.<br>
				- El dominio de la URL de los enlaces no pertenece a tu empresa.<br>
				- Parte del contenido de las plantillas de mensajes infringe la Política de comercio de Whatsapp: cuando ofreces productos o servicios para la venta, consideramos que todos los mensajes y contenidos multimedia relacionados con esos productos y servicios, incluidas las descripciones, los precios, las tarifas, los impuestos y/o las divulgaciones legales requeridas, constituyen transacciones. Las transacciones deben cumplir con la Política de comercio de WhatsApp.<br>
				- Parte del contenido de las plantillas de mensajes infringe la Política de comercio de Whatsapp: no solicites identificadores confidenciales a los usuarios. Por ejemplo, no les pidas que compartan números completos de tarjetas de pago individuales, números de cuentas bancarias, números de identificación personal u otros identificadores confidenciales. Esto también incluye no solicitarles documentos que puedan contener identificadores confidenciales.<br>
				- El contenido incluye material potencialmente abusivo o amenazante, como la amenaza de tomar acciones legales contra un cliente o avergonzarlo en público.<br>
		       <br>
		       <label class="form-label"><b>Calificación de calidad</b></label><br>
		       <label class="form-label">La calificación de calidad muestra en una ventana móvil cómo los clientes han recibido los mensajes de la plantilla en las últimas 24 horas. La calificación de calidad se basa en cómo los destinatarios recibieron los mensajes en los últimos siete días, y se pondera según su antigüedad.</label><br>
			   <label class="form-label">Lo mostramos en tres estados diferentes:</label><br>
				- Alto (verde)<br>
				- Medio (amarillo)<br>
				- Bajo (rojo)<br>
				- Si no disponemos de suficientes señales de calidad de conversaciones entre tu empresa y los clientes, tu estado de calidad puede ser “desconocido” o “no disponible”.<br>
				<label class="form-label"><b>Estado</b></label><br>
				<label class="form-label">Existen diferentes estados para las plantillas</label><br>
				<label class="form-label">Pendiente: es cuando una empresa presenta por primera vez una plantilla que aún no se ha incorporado y aprobado.</label><br>
				<label class="form-label">Aprobada: la plantilla está aprobada para enviarse a nuestra plataforma.</label><br>
				<label class="form-label">Rechazada: la plantilla se rechazó para incorporarse a nuestra plataforma.</label><br>
				<label class="form-label">Ocasionalmente, una plantilla puede mostrar uno de dos estados particulares que estén relacionados con la calidad: Marcada y Desactivada.</label><br>
				<label class="form-label">Marcada: se trata de un estado de alerta. Cuando la calificación de calidad llega a un estado bajo (rojo), la plantilla pasa a un estado de marcado. Si la calificación de calidad mejora a un estado alto (verde) o medio (amarillo) en un período de 7 días, la plantilla volverá al estado de Aprobada.</label><br>
				<label class="form-label">Desactivada: después de que una plantilla entra en estado de marcada, si la calificación de calidad no mejora en 7 días, se desactivará la plantilla en todos los idiomas. Cuando está desactivada, no se puede editar ni utilizar para enviar mensajes.</label><br>
				<label class="form-label">Notificaciones</label><br>
				<label class="form-label">Recibirás una notificación por correo electrónico si el estado de una plantilla de tus cuentas de WhatsApp Business cambia a "Marcado" o "Desactivado".</label><br>
				<label class="form-label"><b>Consejos</b></label><br>
				<label class="form-label"> Además de lo anterior, considera lo siguiente para acelerar el proceso de aprobación.</label><br>	
				- El nombre de la plantilla del mensaje debe ser claro. En lugar de usar un nombre como "template_014," use "bus_ticket_details".<br>
				- Recuerda que alguien ajeno a tu empresa revisará las plantillas de sus mensajes. El hecho de proporcionar más claridad da a los revisores un contexto sobre cómo se utilizará la plantilla de mensaje.<br>
				- Todas las solicitudes de plantillas de mensajes rechazados requieren una muestra. Puedes apelar una plantilla de mensaje rechazada a través de Asistencia directa.<br>
				- Si necesitas escribir una plantilla de mensaje para reabrir la ventana de 24 horas, sugerimos comenzar con alguna mención del hilo de conversación anterior:<br>
				- Ejemplo: “Lamento no haber podido responder ayer a tus preguntas, pero me alegra poder ayudarte ahora. Si deseas continuar esta discusión, responde con un 'sí'." o "Pude hacer un seguimiento basado en nuestra conversación anterior, y he encontrado la respuesta a tu pregunta sobre nuestra política de reembolso. Si quieres continuar nuestra conversación, di 'sí'".<br>
		      
		       
		        <a href="https://www.whatsapp.com/legal/business-policy/?fbclid=IwAR1jLRqG2MmfXVpoC8OxG2zTl5Ub96hEm-Kq7ucQ9K5dNB8GDFaAupD530Q"> Política de WhatsApp Business</a>
		        
		      </div>
		    </div>
		  </div>
		</div>
		<!--end page wrapper -->
		<!--start overlay-->
		<div class="overlay toggle-icon"></div>
		<!--end overlay-->
		<!--Start Back To Top Button--> <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
		<!--End Back To Top Button-->
	
	</div>
	<!--end wrapper-->
	<!--start switcher-->

	<!--end switcher-->
	<!-- Bootstrap JS -->
	<script src={{ asset("/js/bootstrap.bundle.min.js") }}></script>
	<!--plugins-->
	<script src={{ asset("/js/jquery.min.js") }}></script>
	<script src={{ asset("/plugins/simplebar/js/simplebar.min.js") }}></script>
	<script src={{ asset("/plugins/input-tags/js/tagsinput.js") }}></script>
	<script src={{ asset("/plugins/metismenu/js/metisMenu.min.js") }}></script>
	<!--app JS-->
	<script src={{ asset("/js/app.js") }}></script>

	<script>
	
	    
	    
	    $('#section_header').hide();
	    $('#section_footer').hide();
	    
	    $('#section_example').hide();
	    
	    /*if($('#header').is(':checked')) { $('#section_header').show(); }
		if($('#body').is(':checked'))   { $('#section_body').show(); }
		if($('#footer').is(':checked')) { $('#section_footer').show(); }*/
		$('#section_header_text').hide();
	    $('#section_header_url').hide();
	    
	    if($('#templateHeaderVariable').is(':checked')) { $('#example_header').show(); }else{ 	$('#example_header').hide(); }
	    if($('#templateBodyVariable').is(':checked')) { $('#example_body').show(); }else{ 	$('#example_body').hide(); }
	    
	    $(document).ready(function(){
	    
	    
	      $('input[type=radio]').change(function() {
	      
			if($('#typeheader2').is(':checked')) { 
		    	$('#section_header_text').show(); 
		    } else { 
		    	$('#section_header_text').hide(); 
		    };
		    
		    if($('#typeheader3').is(':checked') || $('#typeheader4').is(':checked') ||  $('#typeheader5').is(':checked')) { 
		    	$('#section_header_url').show(); 
		    } else { 
		    	$('#section_header_url').hide(); 
		    };
		    
		    
		    
		    
		  });
	      
		  $('#header').click(function() {
		    if($('#header').is(':checked')) { $('#section_header').show(); } else { $('#section_header').hide(); };
		  });
		  
		  $('#body').click(function() {
		    if($('#body').is(':checked')) { $('#section_body').show(); } else { $('#section_body').hide(); };
		  });
		  
		  $('#footer').click(function() {
		    if($('#footer').is(':checked')) { $('#section_footer').show(); } else { $('#section_footer').hide(); };
		  });
		  
		  
		  $('#templateBodyVariable').change(function() {
		    if($('#templateBodyVariable').is(':checked')) { 
		    	$('#example_body').show(); 
		    } else { 
		    	$('#example_body').hide(); 
		    };
		  });
		  
		  $('#templateHeaderVariable').change(function() {
		    if($('#templateHeaderVariable').is(':checked')) { 
		    	$('#example_header').show(); 
		    } else { 
		    	$('#example_header').hide(); 
		    };
		  });
		  example_header
		  
		  $( "#countTextBodyVariables" ).change(function() {
		     num = parseInt($("#countTextBodyVariables" ).val());
		     $("#contentVariables" ).html("");
			 for (var i = 1; i <= num ; i++) {
			    $("#contentVariables" ).append('<div class="mb-3"><input type="text" class="form-control" id="bodyv'+i+'" placeholder="Introduce contenido para variable '+i+'"></div>')
			 }
		  });
		  
		  
		});
	    
		function post(){
			  
			  
			  num = parseInt($("#countTextBodyVariables" ).val());
			  var TextBodyVariablesExample = ""
			  for (var i = 1; i <= num ; i++) {
				  TextBodyVariablesExample = TextBodyVariablesExample + $("#bodyv"+i ).val()+",";
			  }
			  TextBodyVariablesExample = TextBodyVariablesExample.substring(0, TextBodyVariablesExample.length - 1);
			  var formData = new FormData();
			  formData.append('configid', $('#configid').val());
			  formData.append('templateName',$('#templateName').val());
		      formData.append('language',$('#language').val());
		      if($('#category1').is(':checked')) { formData.append('category',"TRANSACTIONAL"); }
		      if($('#category2').is(':checked')) { formData.append('category',"MARKETING"); }
		      if($('#category3').is(':checked')) { formData.append('category',"OTP"); }
		      if($('#header').is(':checked')) { formData.append('templateHeader',"true"); } else {formData.append('templateFooter',"false");}
		      if($('#body').is(':checked')) { formData.append('templateBody',"true"); }
		      if($('#footer').is(':checked')) { formData.append('templateFooter',"true"); } else {formData.append('templateFooter',"false");}
		      if($('#typeheader1').is(':checked')) { formData.append('templateHeaderType',"NINGUNA"); }
		      if($('#typeheader2').is(':checked')) { formData.append('templateHeaderType',"TEXT"); }
		      if($('#typeheader3').is(':checked')) { formData.append('templateHeaderType',"IMAGE"); }
		      if($('#typeheader4').is(':checked')) { formData.append('templateHeaderType',"VIDEO"); }
		      if($('#typeheader5').is(':checked')) { formData.append('templateHeaderType',"DOCUMENT"); }
			  formData.append('templateHeaderText',$('#templateHeaderText').val());		
			  if($('#templateHeaderVariable').is(':checked')) { formData.append('templateHeaderVariable',"true"); }	
		      formData.append('templateBodyText',$('#templateBodyText').val());
		      if($('#templateBodyVariable').is(':checked')) { formData.append('templateBodyVariable',"true"); }	
		      formData.append('templateFooterText',$('#templateFooterText').val());
		      formData.append('templateExampleHeader',$('#templateExampleHeader').val());
		      //formData.append('templateExampleBody',$('#templateExampleBody').val());
		      formData.append('templateHeaderTypeHandle',$('#templateHeaderTypeHandle').val());
		      formData.append('templateHeaderTypeUrl',$('#templateHeaderTypeUrl').val());
		      
		      formData.append('countTextBodyVariables',$('#countTextBodyVariables').val());
    		  formData.append('templateExampleBody',TextBodyVariablesExample);
           
        
        
		      $.ajax({
		   		type: "POST",
		        url: "{{ route('crearMessagesTemplateConfigId') }}",
		        data: formData,
		        contentType: false,
		        processData: false,
		        dataType: "json",
		        headers: {'Authorization': "Bearer {{ $token }}"},
		        beforeSend:function (){
			        //$("#form_multimedia_guardar").find("button").prop('disabled', true);
			        //$(".load-foot").show();
		        },
		        success: function(data){
		            
		             console.log( data );
		            
		        },
		      }).fail(function(){
		         
		      });
		};    
		      
	</script>
	
	
</body>

</html>