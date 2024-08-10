<html lang="en" dir="ltr">
	<head>

		<!-- Meta data -->
		<meta charset="UTF-8">
		@php
			header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
			header("Cache-Control: post-check=0, pre-check=0", false);
			header("Pragma: no-cache");
			header('Content-Type: text/html');
		@endphp
	
		<meta name="viewport" content="width=device-width, initial-scale=1">
		
		<!-- Favicon-->
		<link rel="icon" href="{{ asset('images_theme/Logo-millev.png')}}" type="image/x-icon"/>
		<!-- Title -->
		<title>Iniciar sesion</title>
		<!-- Bootstrap css -->
		<link href="{{ asset('plugins/bootstrap-4.1.3/css/bootstrap.min.css')}}" rel="stylesheet" />
		<!-- Style css -->
		<link href="{{ asset('css_theme/style.css')}}" rel="stylesheet" />
		<link href="{{ asset('css_theme/default.css')}}" rel="stylesheet" />
		<link rel="stylesheet" href="{{ asset('css_theme/skins.css')}}"/>
		<link rel="stylesheet" type="text/css" href="{{ asset('storage/config/view.css') }}">
	</head>
	<body class="app h-100vh">
	    
		<!-- Loader -->
		<div id="loading">
			<img src="{{ asset('images_theme/other/loader.svg')}}" class="loader-img" alt="Loader">
		</div>

		<!-- Page opened -->
		<div class="page ">
			<div class="">
				@yield('content')
			</div>
		</div>
	    
	    <style type="text/css">
	        .no-top{
	            position: absolute;
	            left:0px;
	            top:0px;
	            margin-top:10px;
	            margin-left:-15px;
	            margin-right:-45px;
	            float: left;
	            
	        }
	        body{
	            background-color: white;
	        }
	        .card-none{
	           border: 0px none !important;
	           background-color: white;
	           margin-left: 15px;
	        }
	    </style>
	    
		<!-- Dashboard js -->
		<script src="{{ asset('js_theme/vendors/jquery-3.2.1.min.js')}}"></script>
		<script src="{{ asset('plugins/bootstrap-4.1.3/popper.min.js')}}"></script>
		<script src="{{ asset('plugins/bootstrap-4.1.3/js/bootstrap.min.js')}}"></script>
		<script src="{{ asset('js_theme/vendors/circle-progress.min.js')}}"></script>
		
		<script src="{{ asset('js_theme/custom.js')}}"></script>
		
			<script type="text/javascript" >
				$(document).ready(function() {
			        window.history.pushState(null, "", window.location.href);        
			        window.onpopstate = function() {
			            window.history.pushState(null, "", window.location.href);
			        };
			    });
			</script>
	</body>
</html>