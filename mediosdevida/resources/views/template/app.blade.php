<!doctype html>
<html lang="es">

    <head>
    	<!-- Required meta tags -->
    	<meta charset="utf-8">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
    	<meta name="_token" content="{!! csrf_token() !!}" />
    	<!--favicon-->
    	<link rel="icon" href="{{asset('images_theme/Logo-millev.png')}}" type="image/png" />
    	<!--plugins-->
    	<link href="{{asset('new_temp/assets/plugins/vectormap/jquery-jvectormap-2.0.2.css')}}" rel="stylesheet"/>
    	<link href="{{asset('new_temp/assets/plugins/simplebar/css/simplebar.css" rel="stylesheet')}}" />
    	<link href="{{asset('new_temp/assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css')}}" rel="stylesheet" />
    	<link href="{{asset('new_temp/assets/plugins/metismenu/css/metisMenu.min.css')}}" rel="stylesheet" />
    	<!-- loader-->
    	<link href="{{asset('new_temp/assets/css/pace.min.css')}}" rel="stylesheet" />
    	<script src="{{asset('new_temp/assets/js/pace.min.js')}}"></script>
    	<!-- Bootstrap CSS -->
    	<link href="{{asset('new_temp/assets/css/bootstrap.min.css')}}" rel="stylesheet">
    	<link href="{{asset('https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap')}}" rel="stylesheet">
    	<link href="{{asset('new_temp/assets/css/app.css')}}" rel="stylesheet">
    	<link href="{{asset('new_temp/assets/css/icons.css')}}" rel="stylesheet">
    	<!-- Select2 -->
    	<link href="{{asset('new_temp/assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet" />
    	<link href="{{asset('new_temp/assets/plugins/select2/css/select2-bootstrap4.css')}}" rel="stylesheet" />
    	<link rel="stylesheet" href="{{asset('new_temp/assets/plugins/notifications/css/lobibox.min.css')}}" />
    	<!-- Theme Style CSS -->
    	<link rel="stylesheet" href="{{asset('new_temp/assets/css/dark-theme.css')}}" />
    	<link rel="stylesheet" href="{{asset('new_temp/assets/css/semi-dark.css')}}" />
    	<link rel="stylesheet" href="{{asset('new_temp/assets/css/header-colors.css')}}" />
    	<link rel="stylesheet" href="{{asset('new_temp/assets/css/custom.css')}}" />
    	
    	<title>@yield('title')</title>
    	
    	
    	<style>
    	    .logo-text {
                 margin-left: 0px; 
            }
    	</style>
    	@yield('linksstyle')
    	
    </head>
    <body>
        <div class="wrapper">
            @include('template.sidebar-header')
            @include('template.header')
            <!--start page wrapper -->
    		<div class="page-wrapper">
    			<div class="page-content">
    			    @yield('content')
    			    @include('template.footer')
    			</div>
    		</div>
        </div>
        @include('template.switcher')
        <!--plugins-->
    	<script src="{{asset('new_temp/assets/js/jquery.min.js')}}"></script>
        <!-- Bootstrap JS -->
    	<script src="{{asset('new_temp/assets/js/bootstrap.bundle.js')}}"></script>
    	
    	<script src="{{asset('new_temp/assets/js/masonry.js')}}"></script>
    	<script src="{{asset('new_temp/assets/plugins/simplebar/js/simplebar.min.js')}}"></script>
    	<script src="{{asset('new_temp/assets/plugins/metismenu/js/metisMenu.min.js')}}"></script>
    	<script src="{{asset('new_temp/assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js')}}"></script>
    	<script src="{{asset('new_temp/assets/plugins/vectormap/jquery-jvectormap-2.0.2.min.js')}}"></script>
        <script src="{{asset('new_temp/assets/plugins/vectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
    	<script src="{{asset('new_temp/assets/plugins/chartjs/js/Chart.min.js')}}"></script>
    	<script src="{{asset('new_temp/assets/plugins/chartjs/js/Chart.extension.js')}}"></script>
    	<script src="{{asset('new_temp/assets/plugins/select2/js/select2.min.js')}}"></script>
    		<!--notification js -->
	   <script src="{{asset('new_temp/assets/plugins/notifications/js/lobibox.min.js')}}"></script>
	   <script src="{{asset('new_temp/assets/plugins/notifications/js/notifications.min.js')}}"></script>
		<script src="{{asset('new_temp/assets/plugins/notifications/js/notification-custom-script.js')}}"></script>
    	<!--app JS-->
    	<script src="{{asset('new_temp/assets/js/app.js')}}"></script>
    	<script src="{{asset('new_temp/assets/js/custom.js')}}"></script>
    	<script>
    	
    	$(document).ready(function(){
    	
    		check_status_all_time()
    		setInterval(check_status_all_time,30000);
    		
    		$(".qr_gen").on("click",function(){
	    			if($(".con_status").hasClass("show")){
	    				Modal_qr_gen();
	    			}

	    		})
       	})
    	
    	   var x_qr = "";
   	
           	function check_status_all_time(){
           		$.ajaxSetup({
        	         headers:{
        	            "X-CSRF-TOKEN":$('meta[name="_token"]').attr('content')
        	         }
              	})
        	      $.ajax({
        	         url: "{{route('validar_u')}}",
        	         method:"POST",
        	         dataType: "json",
        	         beforeSend:function(data){
        	                     
        	            $(".con_status_in").html('<span class="mr-3 mb-0 fs-15 dot_lo"></span><span class="font-weight-semibold">Cargando</span>')
        	            console.log("actualizando...")
        	         }
        	      })
        	      .done(function(data){
        	         unique_status = data.instancias.ESTADO;
        	         x_qr = data.instancias.ID_WASSAP;
        				estado_actual = ""
        	         if(data.instancias.ESTADO == "got qr code"){
        	         	estado_actual = '<span class="mr-3 mb-0 fs-15 dot_dis "></span><a class="no_send" href="#"><span class="font-weight-semibold ">Desconectado</span></a>'
        	         }
        	         else if(data.instancias.ESTADO == "loading"){
        	         	estado_actual = '<span class="mr-3 mb-0 fs-15 dot_lo"></span><span class="font-weight-semibold">Cargando</span>'
        	         }
        	         else if(data.instancias.ESTADO == "authenticated"){
        	         	estado_actual = '<span class="mr-3 mb-0 fs-15 dot_con"></span><a class="no_send" href="#"><span class="font-weight-semibold">Conectado</span></a>'
        	         }
        	         else{
        	         	estado_actual = '<span class="mr-3 mb-0 fs-15 dot_dis"></span><a class="no_send" href="#"><span class="font-weight-semibold">Desconectado</span></a>'
        	         }
        	          $(".con_status_in").html(estado_actual)
        	          $(".no_send").on("click",function(event){
        		   		event.preventDefault();
        	   		})
        	      }).fail(function(data){
        	      		estado_actual = '<span class="mr-3 mb-0 fs-15 dot_dis"></span><span class="font-weight-semibold">Desconectado</span>'
        	      		$(".con_status_in").html(estado_actual)
        	      })
           	}
            function Modal_qr_gen(){
		      var valor = false;
		      
		      $.ajaxSetup({
		         headers:{
		            "X-CSRF-TOKEN":$('meta[name="_token"]').attr('content')
		         }
		      })
		      $.ajax({
		         url: "{{route('estado_uno')}}",
		         method:"POST",
		         dataType: "json",
		         data:{
		            id: 1
		         },
		         beforeSend:function(data){
		            cargando = "<div class='loading-container'><i class='bx bx-loader-alt bx-spin'></i><span>Cargando</span></div>";
		            $(".qr-container").html(cargando)
		         }
		      })
		      .done(function(data){
		         if(!data["Estado"]){
		            if(data["qr"] != null){
		               cargando ="<div class='image-container'><span>Por favor, lea el codigo qr</span><img src='"+data["qr"]+"'/></div>"
		               $(".qr-container").html(cargando)
		               currentXhr = null
		               tempo_qr = setInterval(function(){
		            		if($(".con_status").hasClass("show")){
		            			currentXhr=$.ajax({
			                     url: "{{route('validar_qr')}}",
			                     data:{
			                        id: x_qr,
			                        tipo: "Modal"
			                     },
			                     dataType: "json"
			                     })
			                     .done(function(data){
			                        if(data["Estado"]){
			                           $(".con_status").removeClass("show");
			                           $(".qr-container").parent().removeClass("show");
			                           notification_custom("success","Se conecto correctamente");
			                           clearInterval(tempo_qr);
			                           check_status_all_time();
			                        }
			                        else{
										console.log("leyendo qr");
			                        }
			                     });
		            		}
		            		else{
		            			currentXhr.abort();
		            			clearInterval(tempo_qr);
		            		}
		                    }, 3000);  
								
		               }
		            else{
		               cargando="<div class='d-flex align-items-center ps-5 pe-5'>"+data["Mensaje"]+"</div>"
		               $(".qr-container").html(cargando)
		            }
		         }
		         else{
		               cargando="<div class='d-flex align-items-center' style='text-align:center'><span class='col text-center'>"+data["Mensaje"]+"</span></div>"
		               +"<div class='d-flex align-items-center text-center'><div class='col d-flex' style='justify-content: center;'><a data-dismiss='modal' class='btn btn-danger m-3' href='#'>Cerrar</button>"
		               +"<a  class='btn btn-primary salir_qr m-3' href='#'>Desconectar</a></div></div>"
		               $(".qr-container").html(cargando)
		               $(".salir_qr").on("click",function(event){
					   		event.preventDefault();
					   		$("#modal-qr").modal("hide");
					   		Salir_qr(x_qr);
				   		})
		         }
		      }).fail(function(){
		         cargando = "<div class='error-container'><i class='bx bx-comment-error'></i><span>Hubo un error, intente más tarde</span></div>";
		         $(".qr-container").html(cargando)
		      })
		      
		      
		    }
		    
		    function Salir_qr(id_w_qr){
			      var valor = false;
			      var r = confirm("¿Desea cerrar esta conexión? \nPuede tomar unos minutos en desconectarse por completo");
			      if (r == true) {
			      $.ajaxSetup({
			         headers:{
			            "X-CSRF-TOKEN":$('meta[name="_token"]').attr('content')
			         }
			         })
			         $.ajax({
			            url: "{{route('logout_whats')}}",
			            method:"POST",
			            dataType: "json",
			            data:{
			               id: id_w_qr
			            },
			            beforeSend:function(data){
			            }
			         })
			         .done(function(data){
			           if(data["Estado"]){

			              notification_custom("success","Se cerro sesion con exito");
			              check_status_all_time()
			           }
			           else{
			              notification_custom("warning","Exito al eliminar encuesta");
			              check_status_all_time()
			           }
			         })
			      }
			   }
    	</script>
    	@yield('scripts')
    </body>
</html>
