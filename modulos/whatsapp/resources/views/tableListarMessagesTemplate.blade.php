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
					<div class="col-xl-12 mx-auto">
						<h6 class="mb-0 text-uppercase">Listar Messages Templates</h6>
						<hr/>
						<div class="card">
							<div class="card-body">
								<form id="formData">
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
									<button type="button" onclick="post()" class="btn btn-primary px-5">Sincronizar</button>	
									<a href="formCreateTemplateMessages?token={{ $token }}" class="btn btn-primary px-5">Nuevo template</a>
								</div>
								</form>
								
								
								<div class="table-responsive" style="font-size: 12px;">
								  <table class="table align-middle mb-0">
								   <thead class="table-light">
									<tr>
									  <th>Nombre</th>
									  <th>Lenguaje</th>
									  <th>Estatus</th>
									  <th>Categoria</th>
									  <th>Vista previa</th>
									  <th>Opciones</th>
									</tr>
									</thead>
									<tbody id="tb">
									
								   </tbody>
								 </table>
								 </div>
					 
					 
							</div>
						</div>
					</div>
				</div>
				<!--end row-->
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
	
	    
		function post(){
			  
			  var formData = new FormData();
			  formData.append('configid', $('#configid').val());
			  formData.append('limit', 100);
			  
		      $.ajax({
		   		type: "POST",
		        url: "{{ route('listarMessagesTemplateConfigId') }}",
		        data: formData,
		        contentType: false,
		        processData: false,
		        dataType: "json",
		        headers: {'Authorization': "Bearer {{ $token }}"},
		        beforeSend:function (){
			        //$("#form_multimedia_guardar").find("button").prop('disabled', true);
			        //$(".load-foot").show();
			        $("#tb").html('');
		        },
		        success: function(data){
		            
		            /*$.each( data['data'], function( key, value ) {
		              $.each( value , function( key, value ) {
						  //alert( key + ": " + value );
						  $("#tb").append('<tr><td>'+value['name']+'</td>'+
						  '<tr><td>'+value['language']+'</td>'+
						  '<tr><td>'+value['status']+'</td>'+
						  '<tr><td>'+value['category']+'</td>');			
					  });
					});*/
					
					$.each( data['data'], function( key, value ) {
					      
					      var components="";
					      $.each( value['components'], function( key, value ) {
					        if(value['text']!=null){
					        	components= components + ' ' + value['text'] +'';
					        }
					      });
					      components= components.substring(-1,37)+'...';
					      
					      
					      
						  $("#tb").append('<tr><td>'+value['name']+'</td>'+
						  '<td>'+value['language']+'</td>'+
						  '<td>'+value['status']+'</td>'+
						  '<td>'+value['category']+'</td>'+
						  '<td>'+components+'</td>'+
						  
						  '<td><a href="formSendTemplateMessages?token={{ $token }}"  class="btn btn-outline-primary disabled" disabled >Editar</a> '+
						  '<button type="button" class="btn btn-outline-danger" disabled>Eliminar</button></td></tr>');
					});
                    console.log( data );
		            
		        },
		      }).fail(function(){
		         
		      });
		};    
		      
	</script>
	
	
</body>

</html>