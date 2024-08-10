<!doctype html>
<html lang="es" dir="ltr">
	<head>

		<!-- Meta data -->
		<meta charset="UTF-8" >
		<meta http-equiv="x-ua-compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="_token" content="{!! csrf_token() !!}" />
		<!-- Favicon-->
		<link rel="icon" href="{{ asset('images_theme/Logo-millev.png')}}" type="image/x-icon"/>

		<!-- Title -->
		<title>@yield('title')</title>

		<!-- Bootstrap css -->
		<link href="{{ asset('plugins/bootstrap-4.1.3/css/bootstrap.min.css')}}" rel="stylesheet" />

		<!-- Style css -->
		<link  href="{{ asset('css_theme/style.css')}}" rel="stylesheet" />

		<!-- Default css -->
		<link href="{{ asset('css_theme/default.css')}}" rel="stylesheet">

		<!-- Sidemenu css-->
		<link rel="stylesheet" href="{{ asset('plugins/sidemenu/icon-sidemenu.css')}}">

		<!-- Owl-carousel css-->
		<link href="{{ asset('plugins/owl-carousel/owl.carousel.css')}}" rel="stylesheet" />

		<!-- Bootstrap-daterangepicker css -->
		<link rel="stylesheet" href="{{ asset('plugins/bootstrap-daterangepicker/daterangepicker.css')}}">

		<!-- Bootstrap-datepicker css -->
		<link rel="stylesheet" href="{{ asset('plugins/bootstrap-datepicker/bootstrap-datepicker.css')}}">

		<!-- Custom scroll bar css -->
		<link href="{{ asset('plugins/scroll-bar/jquery.mCustomScrollbar.css')}}" rel="stylesheet"/>

		<!-- P-scroll css -->
		<link href="{{ asset('plugins/p-scroll/p-scroll.css')}}" rel="stylesheet" type="text/css">

		<!-- Font-icons css -->
		<link  href="{{ asset('css_theme/icons.css')}}" rel="stylesheet">

		<!-- Rightsidebar css -->
		<link href="{{ asset('plugins/sidebar/sidebar.css')}}" rel="stylesheet">

		<!-- Nice-select css  -->
		<link href="{{ asset('plugins/jquery-nice-select/css/nice-select.css')}}" rel="stylesheet"/>

		<!-- Color-palette css-->
		<link rel="stylesheet" href="{{ asset('css_theme/skins.css')}}"/>
		
		<!-- Color-palette css-->
		<link rel="stylesheet" href="{{ asset('css_theme/devices.min.css')}}"/>
		
		
      <link href="https://fonts.googleapis.com/css2?family=Anton&family=Roboto:ital,wght@0,900;1,900&display=swap" rel="stylesheet">
      
          <!-- Notifications css -->
        <link href="{{ asset('plugins/notify/css/jquery.growl.css') }}" rel="stylesheet"/>
        
      <link href="{{asset('css/custom_styles.css')}}" rel="stylesheet">
      
      <link rel="stylesheet" href="{{asset('plugins/atWho/jquery.atwho.css')}}">
	   <link rel="stylesheet" type="text/css" href="{{ asset('storage/config/view.css') }}">
		<link rel="stylesheet" type="text/css" href="{{ asset('css/1_2.css') }}">
	</head>
	
	<style type="text/css">
			#mail-body {
			  background: #009688;
			  margin-top: 300px;
			}
			
			#mail-container {
			  position: absolute;
			  top: 50%;
			  left: 50%;
			  -webkit-transform: translate(-50%, -50%);
			          transform: translate(-50%, -50%);
			  -webkit-animation: mail-move 3s infinite;
			          animation: mail-move 3s infinite;
			}
			
			#line-container {
			  position: absolute;
			  left: -70px;
			  width: 60px;
			  overflow: hidden;
			}
			#line-container .line {
			  margin-top: 5px;
			  width: 70px;
			  height: 5px;
			  background: #fff;
			  border-radius: 6px;
			}
			
			#mail {
			  width: 60px;
			  height: 45px;
			  border: solid 5px #fff;
			  border-radius: 10px;
			  overflow: hidden;
			}
			#mail:before {
			  content: '';
			  display: inline-block;
			  position: relative;
			  width: 30px;
			  height: 30px;
			  border-top: solid 5px #fff;
			  border-left: solid 5px #fff;
			  -webkit-transform: rotate(45deg);
			          transform: rotate(45deg);
			  top: 18px;
			  left: 12px;
			}
			#mail:after {
			  content: '';
			  display: inline-block;
			  position: relative;
			  width: 50px;
			  height: 50px;
			  border: solid 5px #fff;
			  -webkit-transform: rotate(45deg);
			          transform: rotate(45deg);
			  top: -70px;
			  border-radius: 15px;
			  background: #009688;
			}
			
			.line-1 {
			  -webkit-animation: line-1-move 3s infinite;
			          animation: line-1-move 3s infinite;
			}
			
			@-webkit-keyframes line-1-move {
			  0% {
			    -webkit-transform: translateX(-100%);
			            transform: translateX(-100%);
			  }
			  20% {
			    -webkit-transform: translateX(100%);
			            transform: translateX(100%);
			  }
			  20.0001% {
			    -webkit-transform: translateX(-100%);
			            transform: translateX(-100%);
			  }
			  40% {
			    -webkit-transform: translateX(20%);
			            transform: translateX(20%);
			  }
			  60% {
			    -webkit-transform: translateX(20%);
			            transform: translateX(20%);
			  }
			  80% {
			    -webkit-transform: translateX(-100%);
			            transform: translateX(-100%);
			  }
			  80.1% {
			    -webkit-transform: translateX(100%);
			            transform: translateX(100%);
			  }
			  100% {
			    -webkit-transform: translateX(-100%);
			            transform: translateX(-100%);
			  }
			}
			
			@keyframes line-1-move {
			  0% {
			    -webkit-transform: translateX(-100%);
			            transform: translateX(-100%);
			  }
			  20% {
			    -webkit-transform: translateX(100%);
			            transform: translateX(100%);
			  }
			  20.0001% {
			    -webkit-transform: translateX(-100%);
			            transform: translateX(-100%);
			  }
			  40% {
			    -webkit-transform: translateX(20%);
			            transform: translateX(20%);
			  }
			  60% {
			    -webkit-transform: translateX(20%);
			            transform: translateX(20%);
			  }
			  80% {
			    -webkit-transform: translateX(-100%);
			            transform: translateX(-100%);
			  }
			  80.1% {
			    -webkit-transform: translateX(100%);
			            transform: translateX(100%);
			  }
			  100% {
			    -webkit-transform: translateX(-100%);
			            transform: translateX(-100%);
			  }
			}
			.line-2 {
			  -webkit-animation: line-2-move 3s infinite;
			          animation: line-2-move 3s infinite;
			}
			
			@-webkit-keyframes line-2-move {
			  0% {
			    -webkit-transform: translateX(-100%);
			            transform: translateX(-100%);
			  }
			  20% {
			    -webkit-transform: translateX(100%);
			            transform: translateX(100%);
			  }
			  20.0001% {
			    -webkit-transform: translateX(-100%);
			            transform: translateX(-100%);
			  }
			  40% {
			    -webkit-transform: translateX(40%);
			            transform: translateX(40%);
			  }
			  60% {
			    -webkit-transform: translateX(40%);
			            transform: translateX(40%);
			  }
			  80% {
			    -webkit-transform: translateX(-100%);
			            transform: translateX(-100%);
			  }
			  80.1% {
			    -webkit-transform: translateX(100%);
			            transform: translateX(100%);
			  }
			  100% {
			    -webkit-transform: translateX(-100%);
			            transform: translateX(-100%);
			  }
			}
			
			@keyframes line-2-move {
			  0% {
			    -webkit-transform: translateX(-100%);
			            transform: translateX(-100%);
			  }
			  20% {
			    -webkit-transform: translateX(100%);
			            transform: translateX(100%);
			  }
			  20.0001% {
			    -webkit-transform: translateX(-100%);
			            transform: translateX(-100%);
			  }
			  40% {
			    -webkit-transform: translateX(40%);
			            transform: translateX(40%);
			  }
			  60% {
			    -webkit-transform: translateX(40%);
			            transform: translateX(40%);
			  }
			  80% {
			    -webkit-transform: translateX(-100%);
			            transform: translateX(-100%);
			  }
			  80.1% {
			    -webkit-transform: translateX(100%);
			            transform: translateX(100%);
			  }
			  100% {
			    -webkit-transform: translateX(-100%);
			            transform: translateX(-100%);
			  }
			}
			.line-3 {
			  -webkit-animation: line-3-move 3s infinite;
			          animation: line-3-move 3s infinite;
			}
			
			@-webkit-keyframes line-3-move {
			  0% {
			    -webkit-transform: translateX(-100%);
			            transform: translateX(-100%);
			  }
			  20% {
			    -webkit-transform: translateX(100%);
			            transform: translateX(100%);
			  }
			  20.0001% {
			    -webkit-transform: translateX(-100%);
			            transform: translateX(-100%);
			  }
			  40% {
			    -webkit-transform: translateX(60%);
			            transform: translateX(60%);
			  }
			  60% {
			    -webkit-transform: translateX(60%);
			            transform: translateX(60%);
			  }
			  80% {
			    -webkit-transform: translateX(-100%);
			            transform: translateX(-100%);
			  }
			  80.1% {
			    -webkit-transform: translateX(100%);
			            transform: translateX(100%);
			  }
			  100% {
			    -webkit-transform: translateX(-100%);
			            transform: translateX(-100%);
			  }
			}
			
			@keyframes line-3-move {
			  0% {
			    -webkit-transform: translateX(-100%);
			            transform: translateX(-100%);
			  }
			  20% {
			    -webkit-transform: translateX(100%);
			            transform: translateX(100%);
			  }
			  20.0001% {
			    -webkit-transform: translateX(-100%);
			            transform: translateX(-100%);
			  }
			  40% {
			    -webkit-transform: translateX(60%);
			            transform: translateX(60%);
			  }
			  60% {
			    -webkit-transform: translateX(60%);
			            transform: translateX(60%);
			  }
			  80% {
			    -webkit-transform: translateX(-100%);
			            transform: translateX(-100%);
			  }
			  80.1% {
			    -webkit-transform: translateX(100%);
			            transform: translateX(100%);
			  }
			  100% {
			    -webkit-transform: translateX(-100%);
			            transform: translateX(-100%);
			  }
			}
			.line-4 {
			  -webkit-animation: line-4-move 3s infinite;
			          animation: line-4-move 3s infinite;
			}
			
			@-webkit-keyframes line-4-move {
			  0% {
			    -webkit-transform: translateX(-80%);
			            transform: translateX(-80%);
			  }
			  20% {
			    -webkit-transform: translateX(100%);
			            transform: translateX(100%);
			  }
			  20.0001% {
			    -webkit-transform: translateX(-100%);
			            transform: translateX(-100%);
			  }
			  40% {
			    -webkit-transform: translateX(120%);
			            transform: translateX(120%);
			  }
			  60% {
			    -webkit-transform: translateX(120%);
			            transform: translateX(120%);
			  }
			  80% {
			    -webkit-transform: translateX(-80%);
			            transform: translateX(-80%);
			  }
			  80.1% {
			    -webkit-transform: translateX(80%);
			            transform: translateX(80%);
			  }
			  100% {
			    -webkit-transform: translateX(-120%);
			            transform: translateX(-120%);
			  }
			}
			
			@keyframes line-4-move {
			  0% {
			    -webkit-transform: translateX(-80%);
			            transform: translateX(-80%);
			  }
			  20% {
			    -webkit-transform: translateX(100%);
			            transform: translateX(100%);
			  }
			  20.0001% {
			    -webkit-transform: translateX(-100%);
			            transform: translateX(-100%);
			  }
			  40% {
			    -webkit-transform: translateX(120%);
			            transform: translateX(120%);
			  }
			  60% {
			    -webkit-transform: translateX(120%);
			            transform: translateX(120%);
			  }
			  80% {
			    -webkit-transform: translateX(-80%);
			            transform: translateX(-80%);
			  }
			  80.1% {
			    -webkit-transform: translateX(80%);
			            transform: translateX(80%);
			  }
			  100% {
			    -webkit-transform: translateX(-120%);
			            transform: translateX(-120%);
			  }
			}
			.line-5 {
			  -webkit-animation: line-5-move 3s infinite;
			          animation: line-5-move 3s infinite;
			}
			
			@-webkit-keyframes line-5-move {
			  0% {
			    -webkit-transform: translateX(-80%);
			            transform: translateX(-80%);
			  }
			  20% {
			    -webkit-transform: translateX(100%);
			            transform: translateX(100%);
			  }
			  20.0001% {
			    -webkit-transform: translateX(-100%);
			            transform: translateX(-100%);
			  }
			  40% {
			    -webkit-transform: translateX(150%);
			            transform: translateX(150%);
			  }
			  60% {
			    -webkit-transform: translateX(150%);
			            transform: translateX(150%);
			  }
			  80% {
			    -webkit-transform: translateX(-80%);
			            transform: translateX(-80%);
			  }
			  80.1% {
			    -webkit-transform: translateX(80%);
			            transform: translateX(80%);
			  }
			  100% {
			    -webkit-transform: translateX(-120%);
			            transform: translateX(-120%);
			  }
			}
			
			@keyframes line-5-move {
			  0% {
			    -webkit-transform: translateX(-80%);
			            transform: translateX(-80%);
			  }
			  20% {
			    -webkit-transform: translateX(100%);
			            transform: translateX(100%);
			  }
			  20.0001% {
			    -webkit-transform: translateX(-100%);
			            transform: translateX(-100%);
			  }
			  40% {
			    -webkit-transform: translateX(150%);
			            transform: translateX(150%);
			  }
			  60% {
			    -webkit-transform: translateX(150%);
			            transform: translateX(150%);
			  }
			  80% {
			    -webkit-transform: translateX(-80%);
			            transform: translateX(-80%);
			  }
			  80.1% {
			    -webkit-transform: translateX(80%);
			            transform: translateX(80%);
			  }
			  100% {
			    -webkit-transform: translateX(-120%);
			            transform: translateX(-120%);
			  }
			}
			@-webkit-keyframes mail-move {
			  0% {
			    opacity: 0;
			    left: 3%;
			  }
			  40% {
			    opacity: 1;
			    left: 50%;
			  }
			  60% {
			    left: 50%;
			  }
			  80% {
			    opacity: 1;
			  }
			  100% {
			    opacity: 0;
			    left: 95%;
			  }
			}
			@keyframes mail-move {
			  0% {
			    opacity: 0;
			    left: 3%;
			  }
			  40% {
			    opacity: 1;
			    left: 50%;
			  }
			  60% {
			    left: 50%;
			  }
			  80% {
			    opacity: 1;
			  }
			  100% {
			    opacity: 0;
			    left: 95%;
			  }
			}

	</style>
	
	<style type="text/css">
  
                      .font-anton{
                      	font-family: 'Anton', sans-serif;
                      }
                      
                      .shadow_titulo{
                        text-shadow: -1px 3px 0  #0a0e27;
                      }
                      
                      .txt-color-white{
                      	color:white !important;
                      	border-bottom-width: 0px ;
                        
                      }
	/*color rgba(230, 126, 34, 1)*/
						    .app-sidebar {
						        /*margin-top:0px;*/
						        background-color: rgba(230, 126, 34, 1);
						    }
						    .header-main{
						        float: left;
						    }
						    .icon-menu-img{
						         background-color: transparent !important;
						         border-color: transparent !important;
						    }
						    .app-sidebar .toggle-menu .side-menu__item.active .icon-menu-img{
						         background-color: transparent !important;
						         border-color: white !important;
						    }
						    .header-brand-img{
						        height: 3.5rem;
						        margin: 0 0 0 -50% !important;
						    }
					        .bg-header-image-orange{
					            background: linear-gradient(-225deg,rgb(2 69 218),rgb(0 123 255)),url(../images_theme/thumbnails/media2.jpg);
					            position: relative;
					            top: 0;
					            left: 0;
					        	z-index: 9;
					            height: 100%;
					            width: 100%;
					            background-size: cover;
					            background-repeat: no-repeat;
					            background-position: center;
					        }
					        
					        .circulo {
								width: 40px;
								height: 40px;
								border-radius: 50%;
						
								display: flex;
								justify-content: center;
								align-items: center;
								text-align: center;
							    margin:0px auto;
							    padding: 20px;
							    white-space:nowrap !important;
							    float: left;
							}
							
							.circulo_contact {
								font-family: sans-serif;
								color: white !important;
								white-space:nowrap !important;
								float: left;
							}
							
														
							.marvel-device .screen {
							  text-align: left;
							}
							
							.screen-container {
							  height: 100%;
							}
							
							/* Status Bar */
							
							.status-bar {
							  height: 25px;
							  background: #004e45;
							  color: #fff;
							  font-size: 14px;
							  padding: 0 8px;
							}
							
							.status-bar:after {
							  content: "";
							  display: table;
							  clear: both;
							}
							
							.status-bar div {
							  float: right;
							  position: relative;
							  top: 50%;
							  transform: translateY(-50%);
							  margin: 0 0 0 8px;
							  font-weight: 600;
							}
							
							/* Chat */
							
							.chat {
							  height: calc(100% - 69px);
							}
							
							.chat-container {
							  height: 100%;
							}
							
							/* User Bar */
							
							.user-bar {
							  height: 55px;
							  background: #005e54;
							  color: #fff;
							  padding: 0 8px;
							  font-size: 24px;
							  position: relative;
							  z-index: 1;
							}
							
							.user-bar:after {
							  content: "";
							  display: table;
							  clear: both;
							}
							
							.user-bar div {
							  float: left;
							  transform: translateY(-50%);
							  position: relative;
							  top: 50%;
							}
							
							.user-bar .actions {
							  float: right;
							  margin: 0 0 0 20px;
							}
							
							.user-bar .actions.more {
							  margin: 0 12px 0 32px;
							}
							
							.user-bar .actions.attachment {
							  margin: 0 0 0 30px;
							}
							
							.user-bar .actions.attachment i {
							  display: block;
							  transform: rotate(-45deg);
							}
							
							.user-bar .avatar {
							  margin: 0 0 0 5px;
							  width: 36px;
							  height: 36px;
							}
							
							.user-bar .avatar img {
							  border-radius: 50%;
							  box-shadow: 0 1px 0 rgba(255, 255, 255, 0.1);
							  display: block;
							  width: 100%;
							}
							
							.user-bar .name {
							  font-size: 17px;
							  font-weight: 600;
							  text-overflow: ellipsis;
							  letter-spacing: 0.3px;
							  margin: 0 0 0 8px;
							  overflow: hidden;
							  white-space: nowrap;
							  width: 110px;
							}
							
							.user-bar .status {
							  display: block;
							  font-size: 13px;
							  font-weight: 400;
							  letter-spacing: 0;
							}
							
							/* Conversation */
							
							.conversation {
							  height: calc(100% - 12px);
							  position: relative;
							  background: #efe7dd
							    url("https://cloud.githubusercontent.com/assets/398893/15136779/4e765036-1639-11e6-9201-67e728e86f39.jpg")
							    repeat;
							  z-index: 0;
							}
							
							.conversation ::-webkit-scrollbar {
							  transition: all 0.5s;
							  width: 5px;
							  height: 1px;
							  z-index: 10;
							}
							
							.conversation ::-webkit-scrollbar-track {
							  background: transparent;
							}
							
							.conversation ::-webkit-scrollbar-thumb {
							  background: #b3ada7;
							}
							
							.conversation .conversation-container {
							  height: calc(100% - 68px);
							  box-shadow: inset 0 10px 10px -10px #000000;
							  overflow-x: hidden;
							  padding: 0 16px;
							  margin-bottom: 5px;
							}
							
							.conversation .conversation-container:after {
							  content: "";
							  display: table;
							  clear: both;
							}
							
							/* Messages */
							
							.message_device {
							  color: #000;
							  clear: both;
							  line-height: 18px;
							  font-size: 15px;
							  padding: 8px;
							  position: relative;
							  margin: 8px 0;
							  max-width: 85%;
							  word-wrap: break-word;
							  z-index: -1;
							}
							
							.message_device:after {
							  position: absolute;
							  content: "";
							  width: 0;
							  height: 0;
							  border-style: solid;
							}
							
							.metadata {
							  display: inline-block;
							  float: right;
							  padding: 0 0 0 7px;
							  position: relative;
							  bottom: -4px;
							}
							
							.metadata .time {
							  color: rgba(0, 0, 0, 0.45);
							  font-size: 11px;
							  display: inline-block;
							}
							
							.metadata .tick {
							  display: inline-block;
							  margin-left: 2px;
							  position: relative;
							  top: 4px;
							  height: 16px;
							  width: 16px;
							}
							
							.metadata .tick svg {
							  position: absolute;
							  transition: 0.5s ease-in-out;
							}
							
							.metadata .tick svg:first-child {
							  -webkit-backface-visibility: hidden;
							  backface-visibility: hidden;
							  -webkit-transform: perspective(800px) rotateY(180deg);
							  transform: perspective(800px) rotateY(180deg);
							}
							
							.metadata .tick svg:last-child {
							  -webkit-backface-visibility: hidden;
							  backface-visibility: hidden;
							  -webkit-transform: perspective(800px) rotateY(0deg);
							  transform: perspective(800px) rotateY(0deg);
							}
							
							.metadata .tick-animation svg:first-child {
							  -webkit-transform: perspective(800px) rotateY(0);
							  transform: perspective(800px) rotateY(0);
							}
							
							.metadata .tick-animation svg:last-child {
							  -webkit-transform: perspective(800px) rotateY(-179.9deg);
							  transform: perspective(800px) rotateY(-179.9deg);
							}
							
							.message_device:first-child {
							  margin: 16px 0 8px;
							}
							
							.message_device.received {
							  background: #fff;
							  border-radius: 0px 5px 5px 5px;
							  float: left;
							}
							
							.message_device.received .metadata {
							  padding: 0 0 0 16px;
							}
							
							.message_device.received:after {
							  border-width: 0px 10px 10px 0;
							  border-color: transparent #fff transparent transparent;
							  top: 0;
							  left: -10px;
							}
							
							.message_device.sent {
							  background: #e1ffc7;
							  border-radius: 5px 0px 5px 5px;
							  float: right;
							}
							
							.message_device.sent:after {
							  border-width: 0px 0 10px 10px;
							  border-color: transparent transparent transparent #e1ffc7;
							  top: 0;
							  right: -10px;
							}
							
							/* Compose */
							
							.conversation-compose {
							  display: flex;
							  flex-direction: row;
							  align-items: flex-end;
							  overflow: hidden;
							  height: 50px;
							  width: 100%;
							  z-index: 2;
							}
							
							.conversation-compose div,
							.conversation-compose input {
							  background: #fff;
							  height: 100%;
							}
							
							.conversation-compose .emoji {
							  display: flex;
							  align-items: center;
							  justify-content: center;
							  background: white;
							  border-radius: 5px 0 0 5px;
							  flex: 0 0 auto;
							  margin-left: 8px;
							  width: 48px;
							}
							
							.conversation-compose .input-msg {
							  border: 0;
							  flex: 1 1 auto;
							  font-size: 16px;
							  margin: 0;
							  outline: none;
							  min-width: 50px;
							}
							
							.conversation-compose .photo {
							  flex: 0 0 auto;
							  border-radius: 0 0 5px 0;
							  text-align: center;
							  position: relative;
							  width: 48px;
							}
							
							.conversation-compose .photo:after {
							  border-width: 0px 0 10px 10px;
							  border-color: transparent transparent transparent #fff;
							  border-style: solid;
							  position: absolute;
							  width: 0;
							  height: 0;
							  content: "";
							  top: 0;
							  right: -10px;
							}
							
							.conversation-compose .photo i {
							  display: block;
							  color: #7d8488;
							  font-size: 24px;
							  transform: translate(-50%, -50%);
							  position: relative;
							  top: 50%;
							  left: 50%;
							}
							
							.conversation-compose .send {
							  background: transparent;
							  border: 0;
							  cursor: pointer;
							  flex: 0 0 auto;
							  margin-left: 8px;
							  margin-right: 8px;
							  padding: 0;
							  position: relative;
							  outline: none;
							}
							
							.conversation-compose .send .circle {
							  background: #008a7c;
							  border-radius: 50%;
							  color: #fff;
							  position: relative;
							  width: 48px;
							  height: 48px;
							  display: flex;
							  align-items: center;
							  justify-content: center;
							}
							
							.conversation-compose .send .circle i {
							  font-size: 24px;
							  margin-left: 5px;
							}
							
							/* Small Screens */
							
							@media (max-width: 768px) {
							  .marvel-device.nexus5 {
							    border-radius: 0;
							    flex: none;
							    padding: 0;
							    max-width: none;
							    overflow: hidden;
							    height: 100%;
							    width: 100%;
							  }
							
							  .marvel-device > .screen .chat {
							    visibility: visible;
							  }
							
							  .marvel-device {
							    visibility: hidden;
							  }
							
							  .marvel-device .status-bar {
							    display: none;
							  }
							
							  .screen-container {
							    position: absolute;
							    top: 0;
							    left: 0;
							    right: 0;
							    bottom: 0;
							  }
							
							  .conversation {
							    height: calc(100vh - 55px);
							  }
							  .conversation .conversation-container {
							    height: calc(100vh - 120px);
							  }
							}
								body.modal-open {
								    overflow: hidden;
								}
							.page-header{
								min-height: 0px !important;
								padding: 0px !important;
							}
							
							.custom-checkbox .custom-control-input:checked~.custom-control-label::before {
							    background-color: #0245da;
							}
							
							.page-item.active .page-link {
							    z-index: 1;
							    color: #fff;
							    background-color: #0245da;
							    border-color: #0245da;
							}
							
							#back-to-top {
							    background: #0245da;
							    color: #fff;
							}
							
							#back-to-top:hover {
							    background: #fff;
							    color: #0245da;
							    border: 2px solid #0245da;
							}
							
							.slide-menu li.active>a {
							    font-weight: 400;
							    background: transparent;
							    color: #a7f8ff !important;
							}
							.btn-cancelar:hover{
								background-color: #bf1122 !important;
							}
							.btn-cancelar:not(:disabled):not(.disabled):active, .btn-cancelar:not(:disabled):not(.disabled).active, .show>.btn-cancelar.dropdown-toggle {
							background-color: #bf1122 !important;
							}


	</style>
	<body class="app sidebar-mini sidebar-gone sidenav-toggled ">
	    <div id="loading">
			<img src="{{ asset('images_theme/other/loader.svg')}}" class="loader-img" alt="Loader">
		</div>

		<div class="page">
		    <div class="page-main">
		        @include('layout.left_layout')
		        @include('layout.top_layout')
		        <div class="app-content icon-content">
					<div class="section">
		                @yield('content')
		         </div>
		        </div>
		    </div>
		</div>
		
		<a href="#top" id="back-to-top"><i class="fa fa-angle-double-up"></i></a>
		
		<div class="col-md-12">
			<div class="modal fade" id="modal-qr" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
				<div class="modal-dialog" role="document" style="">
					<div class="modal-content shadow border-0">
						<div class="modal-body">
							<div class="row">
								<div class="col-md-12">
									<div class="card-body">
										<div class="modal_qr"></div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Jquery-scripts -->
		<script src="{{ asset('js_theme/vendors/jquery-3.2.1.min.js')}}"></script>

		<!-- Moment js-->
        <script src="{{ asset('plugins/moment/moment.min.js')}}"></script>

		<!-- Bootstrap-scripts js -->
		<script src="{{ asset('js_theme/vendors/bootstrap.bundle.min.js')}}"></script>

		<!-- Sparkline JS-->
		<script src="{{ asset('js_theme/vendors/jquery.sparkline.min.js')}}"></script>

		<!-- Bootstrap-daterangepicker js -->
		<script src="{{ asset('plugins/bootstrap-daterangepicker/daterangepicker.js')}}"></script>

		<!-- Bootstrap-datepicker js -->
		<script src="{{ asset('plugins/bootstrap-datepicker/bootstrap-datepicker.js')}}"></script>

		<!-- Chart-circle js -->
		<script src="{{ asset('js_theme/vendors/circle-progress.min.js')}}"></script>

		<!-- Rating-star js -->
		<script src="{{ asset('plugins/rating/jquery.rating-stars.js')}}"></script>

		<!-- Clipboard js -->
		<script src="{{ asset('plugins/clipboard/clipboard.min.js')}}"></script>
		<script src="{{ asset('plugins/clipboard/clipboard.js')}}"></script>

		<!-- Prism js -->
		<script src="{{ asset('plugins/prism/prism.js')}}"></script>

		<!-- Custom scroll bar js-->
		<script src="{{ asset('plugins/scroll-bar/jquery.mCustomScrollbar.concat.min.js')}}"></script>

		<!-- Nice-select js-->
		<script src="{{ asset('plugins/jquery-nice-select/js/jquery.nice-select.js')}}"></script>
		<script src="{{ asset('plugins/jquery-nice-select/js/nice-select.js')}}"></script>

        <!-- P-scroll js -->
		<!--<script src="../assets/plugins/p-scroll/p-scroll.js"></script>-->
		<!--<script src="../assets/plugins/p-scroll/p-scroll-1.js"></script>-->

		<!-- Sidemenu js-->
		<script src="{{ asset('plugins/sidemenu/icon-sidemenu.js')}}"></script>
        @if(Route::currentRouteName() == 'home')
		<!-- JQVMap -->
		<script src="{{ asset('plugins/jqvmap/jquery.vmap.js')}}"></script>
		<script src="{{ asset('plugins/jqvmap/maps/jquery.vmap.world.js')}}"></script>
		<script src="{{ asset('plugins/jqvmap/jquery.vmap.sampledata.js')}}"></script>


		<!-- Index js -->
		<script src="{{ asset('js_theme/index.js')}}"></script>
		<script src="{{ asset('js_theme/index-map.js')}}"></script>
		
		@endif
		<!-- Apexchart js-->
		<script src="{{ asset('js_theme/apexcharts.js')}}"></script>
		
		<script src="{{ asset('js_theme/config_notificaciones.js') }}"></script>
        <script src="{{ asset('plugins/notify/js/jquery.growl.js') }}"></script>

		<!-- Chart js-->
		<script src="{{ asset('plugins/chart/chart.min.js')}}"></script>
		
		@yield('scripts')

		<!-- Rightsidebar js -->
		<!--<script src="{{ asset('plugins/sidebar/sidebar.js')}}"></script>-->

		<!-- Custom js -->
	
    
		<script src="{{ asset('js_theme/custom.js')}}"></script>
		<script src="{{ asset('plugins/carat/jquery.caret.min.js')}}"></script>
		<script src="{{ asset('plugins/atWho/jquery.atwho.min.js')}}"></script>
		<script>
		/*	$(document).ready(function () {

		    setInterval(con_sesion, 1000 * 60 * 5); // every 15 mins
		
		    function con_sesion() {
		        $.ajax({
		            url: '/con_sesion', 
		            method: 'post',
		            headers: {
		                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		            }
		        }).then(function (result) {
		            console.log(new Date() + ' ' + result + ' ' + $('meta[name="csrf-token"]').attr('content'));
		        }).fail(function(data){
		        		$.growl.error({ title: "ERROR", message: "Su sesion expiró" });
		        		window.location.href = "{{route('login')}}"  
		        });
		    }
		
		});*/
		var unique_status = "" ;

		
		var tempo_qr = "";

   
	   $('#modal-qr').on('hidden.bs.modal', function () {
	     clearInterval(tempo_qr)
	   })
	   $('#modal-qr').on('show.bs.modal', function () {
	     Modal_qr_gen();
	   })
		
		$(document).ready(function(){
			check_status_all_time()
			setInterval(check_status_all_time,30000);
			
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
		   		$("#modal-qr").modal("show");
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
		            $("#modal-qr").modal("show"); 
		            cargando = "<div class='row align-items-center'><div class='col'></div>"+
		            	"<label class='text-warning col text-center'><img src='{{asset('images_theme/tenor.gif')}}' style='width:50%;height:50%'/></label>"+
		            	"<div class='col'></div></div>"
		            $(".modal_qr").html(cargando)
		         }
		      })
		      .done(function(data){
		         if(!data["Estado"]){
		            if(data["qr"] != null){
		               cargando="<div class='row align-items-center'>"+
		               "<div class='col text-center'>Lea el codigo QR</div>"+
		               "<div class='col text-center'><img src='"+data["qr"]+"' style='width:100%,height:100%' /></div></div>"+
		               "<div class='row align-items-center'><div class='col text-center'><a data-dismiss='modal' class='btn btn-danger bg-gradient-danger' href='#'>Cancelar</button></div></div>"
		               $(".modal_qr").html(cargando)
		               
		               tempo_qr = setInterval(function(){
		                    $.ajax({
		                     url: "{{route('validar_qr')}}",
		                     data:{
		                        id: x_qr,
		                        tipo: "Modal"
		                     },
		                     dataType: "json"
		                     })
		                     .done(function(data){
		                        if(data["Estado"]){
		                           $("#modal-qr").modal("hide");
		                           $.growl.notice({ title: "OK", message: "Se ha conectado correctamente"});
		                           {{--location.reload();--}}
		                           check_status_all_time()
		                        }
		                        else{
		
		                        }
		                     });}, 2000);  
		
		               }
		            else{
		               cargando="<div class='row align-items-center'>"+data["Mensaje"]+"</div>"
		               $(".modal_qr").html(cargando)
		            }
		         }
		         else{
		               cargando="<div class='row align-items-center' style='text-align:center'><span class='col text-center'>"+data["Mensaje"]+"</span></div>"
		               +"<div class='row align-items-center text-center'><div class='col'><a data-dismiss='modal' class='btn btn-danger bg-gradient-danger mr-1' href='#'>Cerrar</button>"
		               +"<a  class='btn btn-info bg-gradient-info salir_qr' href='#'>Desconectar</a></div></div>"
		               $(".modal_qr").html(cargando)
		               $(".salir_qr").on("click",function(event){
					   		event.preventDefault();
					   		$("#modal-qr").modal("hide");
					   		Salir_qr(x_qr);
				   		})
		         }
		      }).fail(function(){
		         cargando="<div class='row align-items-center'>"+"No se puedo conectar instancia"+"</div>"
		         $(".modal_qr").html(cargando)
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
	              $.growl.notice({ title: "OK", message: "Se cerro con exito!"});
	              {{--location.reload(); --}}
	              check_status_all_time()
	           }
	           else{
	              $.growl.error({ title: "ERROR", message: "Hubo un error, vuelva a intentarlo"});
	              {{--location.reload(); --}}
	              check_status_all_time()
	           }
	         })
	      }
	   }
   	
		</script>
		
		
		
	   	
			@isset($alerta)  
		            @isset($alerta['error']) 
		            <script type="text/javascript">
		              $.growl.error({ title: "ERROR", message: "{{ $alerta['error'] }}" });
		            </script>  
		            @endisset 
		            @isset($alerta['notice']) 
		            <script type="text/javascript">
		              $.growl.notice({ title: "OK", message: "{{ $alerta['notice'] }}" });
		            </script>  
		            @endisset
		            @isset($alerta['warning']) 
		            <script type="text/javascript">
		              $.growl.warning({ title: "ADVERTENCIA", message: "{{ $alerta['warning'] }}" });
		            </script>  
		            @endisset                  
		    @endisset 
	

		
		
	</body>
</html>