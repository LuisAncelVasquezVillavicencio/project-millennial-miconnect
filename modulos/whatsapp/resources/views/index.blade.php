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
	<link href={{ asset("/plugins/perfect-scrollbar/css/perfect-scrollbar.css") }} rel="stylesheet" />
	
	<link href={{ asset("/plugins/emoji-picker/css/emoji.css") }} rel="stylesheet" />
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet">

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
	
	
	<style>
		.translate-middle-y {
		    transform: translateY(-45%)!important;
		}
		
		.icono_letra_texto{
			height:42px;width:42px; text-align: center;line-height: 42px;font-size:20px;
		}
		
		.chat-sidebar-header .chat-user-offline:before {
		    background: #fd3550;
		}
		
		.chat-left-msg {
			margin-bottom: 0px;
		}
		
		.chat-content-leftside {
			margin-top: 20px;
		}
		
		
		.dropdown-menu {
		    max-height: 280px;
		    overflow-y: auto;
		}
		
		.chat-footer {
		    height: auto;
		}
		
		.div-image-chat {
			background-position: center center;
		    background-repeat: no-repeat;
		    background-size: 80px 80px;
		    border-radius: 4px;
		    box-sizing: border-box;
		    min-width: 240px;
		}
		
		
		.fondo-chat {
			background-color: #e5ddd540;
		}
		
		.fondo-remove{
			background-color: transparent;
		}
		
		.chat-content-leftside .chat-left-msg {
    		background-color: #ffffff;
    	}
    	
    	.btn-whatsapp {
		    color: #ffffff;
		    background-color: #128c7e;
		    border-color: #128c7e;
		}
		
	</style>
</head>

<body>
	
	<header>
			<div class="topbar d-flex align-items-center">
				<nav class="navbar navbar-expand">
					<div class="topbar-logo-header">
						<div class="">
							<img src="assets/images/logo-icon.png" class="logo-icon" alt="logo icon">
						</div>
						<div class="">
							<h4 class="logo-text">Rocker</h4>
						</div>
					</div>
					<div class="mobile-toggle-menu"><i class="bx bx-menu"></i></div>
					<div class="search-bar flex-grow-1">
						<div class="position-relative search-bar-box">
							<span class="position-absolute top-50 search-show translate-middle-y"><i class="bx bx-phone"></i></span>
							<select class="form-control form-select mb-3" id="configid" style="margin-top:20px;" >
								@foreach ($whatsappConfig as $item)
									<option value="{{ $item->id }}" 
									@if($item->estado=='false') class="text-danger" @endif >&nbsp; &nbsp; &nbsp; &nbsp;  {{ $item->nombre.' (+'.$item->numero.') ' }} </option>
								@endforeach
							</select>
							<!--<input type="text" class="form-control " placeholder="Type to search..."> -->
							<!--<span class="position-absolute top-50 search-close translate-middle-y"><i class="bx bx-x"></i></span>-->
						</div>
					</div>
					<div class="top-menu ms-auto">
						<ul class="navbar-nav align-items-center">
							<li class="nav-item mobile-search-icon">
								<a class="nav-link" href="#">	<i class="bx bx-search"></i>
								</a>
							</li>
							<li class="nav-item dropdown dropdown-large">
								<a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">	<i class="bx bx-category"></i>
								</a>
								<div class="dropdown-menu dropdown-menu-end">
									<div class="row row-cols-3 g-3 p-3">
										<div class="col text-center">
											<div class="app-box mx-auto bg-gradient-cosmic text-white"><i class="bx bx-group"></i>
											</div>
											<div class="app-title">Teams</div>
										</div>
										<div class="col text-center">
											<div class="app-box mx-auto bg-gradient-burning text-white"><i class="bx bx-atom"></i>
											</div>
											<div class="app-title">Projects</div>
										</div>
										<div class="col text-center">
											<div class="app-box mx-auto bg-gradient-lush text-white"><i class="bx bx-shield"></i>
											</div>
											<div class="app-title">Tasks</div>
										</div>
										<div class="col text-center">
											<div class="app-box mx-auto bg-gradient-kyoto text-dark"><i class="bx bx-notification"></i>
											</div>
											<div class="app-title">Feeds</div>
										</div>
										<div class="col text-center">
											<div class="app-box mx-auto bg-gradient-blues text-dark"><i class="bx bx-file"></i>
											</div>
											<div class="app-title">Files</div>
										</div>
										<div class="col text-center">
											<div class="app-box mx-auto bg-gradient-moonlit text-white"><i class="bx bx-filter-alt"></i>
											</div>
											<div class="app-title">Alerts</div>
										</div>
									</div>
								</div>
							</li>
							<li class="nav-item dropdown dropdown-large">
								<a class="nav-link dropdown-toggle dropdown-toggle-nocaret position-relative" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"> <span class="alert-count">7</span>
									<i class="bx bx-bell"></i>
								</a>
								<div class="dropdown-menu dropdown-menu-end">
									<a href="javascript:;">
										<div class="msg-header">
											<p class="msg-header-title">Notifications</p>
											<p class="msg-header-clear ms-auto">Marks all as read</p>
										</div>
									</a>
									<div class="header-notifications-list ps">
										<a class="dropdown-item" href="javascript:;">
											<div class="d-flex align-items-center">
												<div class="notify bg-light-primary text-primary"><i class="bx bx-group"></i>
												</div>
												<div class="flex-grow-1">
													<h6 class="msg-name">New Customers<span class="msg-time float-end">14 Sec
												ago</span></h6>
													<p class="msg-info">5 new user registered</p>
												</div>
											</div>
										</a>
										<a class="dropdown-item" href="javascript:;">
											<div class="d-flex align-items-center">
												<div class="notify bg-light-danger text-danger"><i class="bx bx-cart-alt"></i>
												</div>
												<div class="flex-grow-1">
													<h6 class="msg-name">New Orders <span class="msg-time float-end">2 min
												ago</span></h6>
													<p class="msg-info">You have recived new orders</p>
												</div>
											</div>
										</a>
										<a class="dropdown-item" href="javascript:;">
											<div class="d-flex align-items-center">
												<div class="notify bg-light-success text-success"><i class="bx bx-file"></i>
												</div>
												<div class="flex-grow-1">
													<h6 class="msg-name">24 PDF File<span class="msg-time float-end">19 min
												ago</span></h6>
													<p class="msg-info">The pdf files generated</p>
												</div>
											</div>
										</a>
										<a class="dropdown-item" href="javascript:;">
											<div class="d-flex align-items-center">
												<div class="notify bg-light-warning text-warning"><i class="bx bx-send"></i>
												</div>
												<div class="flex-grow-1">
													<h6 class="msg-name">Time Response <span class="msg-time float-end">28 min
												ago</span></h6>
													<p class="msg-info">5.1 min avarage time response</p>
												</div>
											</div>
										</a>
										<a class="dropdown-item" href="javascript:;">
											<div class="d-flex align-items-center">
												<div class="notify bg-light-info text-info"><i class="bx bx-home-circle"></i>
												</div>
												<div class="flex-grow-1">
													<h6 class="msg-name">New Product Approved <span class="msg-time float-end">2 hrs ago</span></h6>
													<p class="msg-info">Your new product has approved</p>
												</div>
											</div>
										</a>
										<a class="dropdown-item" href="javascript:;">
											<div class="d-flex align-items-center">
												<div class="notify bg-light-danger text-danger"><i class="bx bx-message-detail"></i>
												</div>
												<div class="flex-grow-1">
													<h6 class="msg-name">New Comments <span class="msg-time float-end">4 hrs
												ago</span></h6>
													<p class="msg-info">New customer comments recived</p>
												</div>
											</div>
										</a>
										<a class="dropdown-item" href="javascript:;">
											<div class="d-flex align-items-center">
												<div class="notify bg-light-success text-success"><i class="bx bx-check-square"></i>
												</div>
												<div class="flex-grow-1">
													<h6 class="msg-name">Your item is shipped <span class="msg-time float-end">5 hrs
												ago</span></h6>
													<p class="msg-info">Successfully shipped your item</p>
												</div>
											</div>
										</a>
										<a class="dropdown-item" href="javascript:;">
											<div class="d-flex align-items-center">
												<div class="notify bg-light-primary text-primary"><i class="bx bx-user-pin"></i>
												</div>
												<div class="flex-grow-1">
													<h6 class="msg-name">New 24 authors<span class="msg-time float-end">1 day
												ago</span></h6>
													<p class="msg-info">24 new authors joined last week</p>
												</div>
											</div>
										</a>
										<a class="dropdown-item" href="javascript:;">
											<div class="d-flex align-items-center">
												<div class="notify bg-light-warning text-warning"><i class="bx bx-door-open"></i>
												</div>
												<div class="flex-grow-1">
													<h6 class="msg-name">Defense Alerts <span class="msg-time float-end">2 weeks
												ago</span></h6>
													<p class="msg-info">45% less alerts last 4 weeks</p>
												</div>
											</div>
										</a>
									<div class="ps__rail-x" style="left: 0px; bottom: 0px;"><div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps__rail-y" style="top: 0px; right: 0px;"><div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div></div></div>
									<a href="javascript:;">
										<div class="text-center msg-footer">View All Notifications</div>
									</a>
								</div>
							</li>
							<li class="nav-item dropdown dropdown-large">
								<a class="nav-link dropdown-toggle dropdown-toggle-nocaret position-relative" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"> <span class="alert-count">8</span>
									<i class="bx bx-comment"></i>
								</a>
								<div class="dropdown-menu dropdown-menu-end">
									<a href="javascript:;">
										<div class="msg-header">
											<p class="msg-header-title">Messages</p>
											<p class="msg-header-clear ms-auto">Marks all as read</p>
										</div>
									</a>
									<div class="header-message-list ps">
										<a class="dropdown-item" href="javascript:;">
											<div class="d-flex align-items-center">
												<div class="user-online">
													<img src="assets/images/avatars/avatar-1.png" class="msg-avatar" alt="user avatar">
												</div>
												<div class="flex-grow-1">
													<h6 class="msg-name">Daisy Anderson <span class="msg-time float-end">5 sec
												ago</span></h6>
													<p class="msg-info">The standard chunk of lorem</p>
												</div>
											</div>
										</a>
										<a class="dropdown-item" href="javascript:;">
											<div class="d-flex align-items-center">
												<div class="user-online">
													<img src="assets/images/avatars/avatar-2.png" class="msg-avatar" alt="user avatar">
												</div>
												<div class="flex-grow-1">
													<h6 class="msg-name">Althea Cabardo <span class="msg-time float-end">14
												sec ago</span></h6>
													<p class="msg-info">Many desktop publishing packages</p>
												</div>
											</div>
										</a>
										<a class="dropdown-item" href="javascript:;">
											<div class="d-flex align-items-center">
												<div class="user-online">
													<img src="assets/images/avatars/avatar-3.png" class="msg-avatar" alt="user avatar">
												</div>
												<div class="flex-grow-1">
													<h6 class="msg-name">Oscar Garner <span class="msg-time float-end">8 min
												ago</span></h6>
													<p class="msg-info">Various versions have evolved over</p>
												</div>
											</div>
										</a>
										<a class="dropdown-item" href="javascript:;">
											<div class="d-flex align-items-center">
												<div class="user-online">
													<img src="assets/images/avatars/avatar-4.png" class="msg-avatar" alt="user avatar">
												</div>
												<div class="flex-grow-1">
													<h6 class="msg-name">Katherine Pechon <span class="msg-time float-end">15
												min ago</span></h6>
													<p class="msg-info">Making this the first true generator</p>
												</div>
											</div>
										</a>
										<a class="dropdown-item" href="javascript:;">
											<div class="d-flex align-items-center">
												<div class="user-online">
													<img src="assets/images/avatars/avatar-5.png" class="msg-avatar" alt="user avatar">
												</div>
												<div class="flex-grow-1">
													<h6 class="msg-name">Amelia Doe <span class="msg-time float-end">22 min
												ago</span></h6>
													<p class="msg-info">Duis aute irure dolor in reprehenderit</p>
												</div>
											</div>
										</a>
										<a class="dropdown-item" href="javascript:;">
											<div class="d-flex align-items-center">
												<div class="user-online">
													<img src="assets/images/avatars/avatar-6.png" class="msg-avatar" alt="user avatar">
												</div>
												<div class="flex-grow-1">
													<h6 class="msg-name">Cristina Jhons <span class="msg-time float-end">2 hrs
												ago</span></h6>
													<p class="msg-info">The passage is attributed to an unknown</p>
												</div>
											</div>
										</a>
										<a class="dropdown-item" href="javascript:;">
											<div class="d-flex align-items-center">
												<div class="user-online">
													<img src="assets/images/avatars/avatar-7.png" class="msg-avatar" alt="user avatar">
												</div>
												<div class="flex-grow-1">
													<h6 class="msg-name">James Caviness <span class="msg-time float-end">4 hrs
												ago</span></h6>
													<p class="msg-info">The point of using Lorem</p>
												</div>
											</div>
										</a>
										<a class="dropdown-item" href="javascript:;">
											<div class="d-flex align-items-center">
												<div class="user-online">
													<img src="assets/images/avatars/avatar-8.png" class="msg-avatar" alt="user avatar">
												</div>
												<div class="flex-grow-1">
													<h6 class="msg-name">Peter Costanzo <span class="msg-time float-end">6 hrs
												ago</span></h6>
													<p class="msg-info">It was popularised in the 1960s</p>
												</div>
											</div>
										</a>
										<a class="dropdown-item" href="javascript:;">
											<div class="d-flex align-items-center">
												<div class="user-online">
													<img src="assets/images/avatars/avatar-9.png" class="msg-avatar" alt="user avatar">
												</div>
												<div class="flex-grow-1">
													<h6 class="msg-name">David Buckley <span class="msg-time float-end">2 hrs
												ago</span></h6>
													<p class="msg-info">Various versions have evolved over</p>
												</div>
											</div>
										</a>
										<a class="dropdown-item" href="javascript:;">
											<div class="d-flex align-items-center">
												<div class="user-online">
													<img src="assets/images/avatars/avatar-10.png" class="msg-avatar" alt="user avatar">
												</div>
												<div class="flex-grow-1">
													<h6 class="msg-name">Thomas Wheeler <span class="msg-time float-end">2 days
												ago</span></h6>
													<p class="msg-info">If you are going to use a passage</p>
												</div>
											</div>
										</a>
										<a class="dropdown-item" href="javascript:;">
											<div class="d-flex align-items-center">
												<div class="user-online">
													<img src="assets/images/avatars/avatar-11.png" class="msg-avatar" alt="user avatar">
												</div>
												<div class="flex-grow-1">
													<h6 class="msg-name">Johnny Seitz <span class="msg-time float-end">5 days
												ago</span></h6>
													<p class="msg-info">All the Lorem Ipsum generators</p>
												</div>
											</div>
										</a>
									<div class="ps__rail-x" style="left: 0px; bottom: 0px;"><div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps__rail-y" style="top: 0px; right: 0px;"><div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div></div></div>
									<a href="javascript:;">
										<div class="text-center msg-footer">View All Messages</div>
									</a>
								</div>
							</li>
						</ul>
					</div>
					<div class="user-box dropdown">
						<a class="d-flex align-items-center nav-link dropdown-toggle dropdown-toggle-nocaret" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
							<img src="assets/images/avatars/avatar-2.png" class="user-img" alt="user avatar">
							<div class="user-info ps-3">
								<p class="user-name mb-0">Pauline Seitz</p>
								<p class="designattion mb-0">Web Designer</p>
							</div>
						</a>
						<ul class="dropdown-menu dropdown-menu-end">
							<li><a class="dropdown-item" href="javascript:;"><i class="bx bx-user"></i><span>Profile</span></a>
							</li>
							<li><a class="dropdown-item" href="javascript:;"><i class="bx bx-cog"></i><span>Settings</span></a>
							</li>
							<li><a class="dropdown-item" href="javascript:;"><i class="bx bx-home-circle"></i><span>Dashboard</span></a>
							</li>
							<li><a class="dropdown-item" href="javascript:;"><i class="bx bx-dollar-circle"></i><span>Earnings</span></a>
							</li>
							<li><a class="dropdown-item" href="javascript:;"><i class="bx bx-download"></i><span>Downloads</span></a>
							</li>
							<li>
								<div class="dropdown-divider mb-0"></div>
							</li>
							<li><a class="dropdown-item" href="javascript:;"><i class="bx bx-log-out-circle"></i><span>Logout</span></a>
							</li>
						</ul>
					</div>
				</nav>
			</div>
		</header>
	<!--wrapper-->
	<div class="" style="margin-top: 50px">
		<!--end navigation-->
		<!--start page wrapper -->
		<div class="" >
			<div class="page-content">
				<div class="row">
					<!--<div class="col-1 col-md-3 col-lg-3 col-xl-3">-->
						
					<!--	<div class="row row-cols-1 row-cols-md-3 row-cols-lg-3 row-cols-xl-1">-->
					<!--		<div class="col">-->
					<!--		<div class="card radius-10">-->
					<!--			<div class="card-body">-->
					<!--				<div class="d-flex align-items-center">-->
					<!--					<div>-->
					<!--						<p class="mb-0 text-secondary">Total Mensajes Enviados</p>-->
					<!--						<h4 class="my-1">{{ $countWhatsappSend }}</h4>-->
					<!--						<p class="mb-0 font-13 text-success">info</p>-->
					<!--					</div>-->
					<!--				</div>-->
					<!--			</div>-->
					<!--		</div>-->
					<!--		</div>-->
					<!--		<div class="col">-->
					<!--		<div class="card radius-10">-->
					<!--			<div class="card-body">-->
					<!--				<div class="d-flex align-items-center">-->
					<!--					<div>-->
					<!--						<p class="mb-0 text-secondary">Total Mensajes recividos</p>-->
					<!--						<h4 class="my-1">{{ $countWhatsappRecive }}</h4>-->
					<!--						<p class="mb-0 font-13 text-success">info</p>-->
					<!--					</div>-->
					<!--					<div class=" ms-auto" >-->
					<!--						<div class="btn-group-vertical " role="group" aria-label="Basic example">-->
												
					<!--						</div>-->
					<!--					</div>-->
					<!--				</div>-->
					<!--			</div>-->
					<!--		</div>-->
					<!--		</div>-->
					<!--		<div class="col">-->
					<!--			<div class="card list-group-content bg-light-success  ">-->
					<!--				<div class="card-body">-->
					<!--					<ul class="list-group list-group-flush" style="height:290px;">-->
					<!--						<li class="list-group-item bg-transparent text-success"><i class="bx bx-message-detail font-18 align-middle me-1"></i> ver mensajes enviados</li>-->
					<!--						<li class="list-group-item bg-transparent text-success"><i class="bx bx-message-alt  font-18 align-middle me-1"></i>  ver mensajes recividos</li>-->
					<!--						<li class="list-group-item bg-transparent text-success"><i class="bx bx-message-alt  font-18 align-middle me-1"></i>  ver mensajes estatus</li>-->
					<!--						<li class="list-group-item bg-transparent text-success"><i class="bx bx-user font-18 align-middle me-1"></i>Enviar mensaje a contacto</li>-->
					<!--						<li class="list-group-item bg-transparent text-success"><i class="bx bx-group font-18 align-middle me-1"></i>Enviar mensaje a grupo contactos</li>-->
					<!--						<li class="list-group-item bg-transparent text-success"><i class="bx bx bx-support font-18 align-middle me-1"></i>Enviar mensaje multimedia</li>-->
					<!--						<li class="list-group-item bg-transparent text-success"><i class="bx bx bx-support font-18 align-middle me-1"></i>Enviar mensaje desde plantilla</li>-->
					<!--						<li class="list-group-item bg-transparent text-success"><i class="bx bx bx-support font-18 align-middle me-1"></i>Administrar Plantillas</li>-->
					<!--					</ul>-->
					<!--				</div>-->
					<!--			</div>-->
					<!--		</div>-->
					<!--    </div>-->
				 <!--   </div>-->
				    <div class="col-12 col-md-12 col-lg-9 col-xl-9">
				    	<div class="card radius-10">
								
					<div class="chat-wrapper ">
					<div class="chat-sidebar">
						<div class="chat-sidebar-header">
							
							<div class="d-flex align-items-center">
								<div class="chat-user-online" id="whassap_config_estado">
									@if(isset($image))
										<img src="assets/images/avatars/avatar-1.png" width="45" height="45" class="rounded-circle" alt="" />
									@else
										<div class="notify bg-light-info text-info rounded-circle icono_letra_texto" 
										     style="height:45px;width:45px; line-height: 45px;"
											 id="whassap_config_inicial"> A </div>
									@endif
								</div>
								<div class="flex-grow-1 ms-2">
									<p class="mb-0" id="whassap_config_name"></p>
									<p class="mb-0" id="whassap_config_quality_rating"><i class="fadeIn animated bx bx-info-circle"></i></p>
								</div>
								<div class="dropdown">
									<div class="cursor-pointer font-24 dropdown-toggle dropdown-toggle-nocaret" data-bs-toggle="dropdown"><i class='bx bx-dots-horizontal-rounded'></i>
									</div>
									<div class="dropdown-menu dropdown-menu-end"> <a class="dropdown-item" href="javascript:;">Settings</a>
										<div class="dropdown-divider"></div>	<a class="dropdown-item" href="javascript:;">Help & Feedback</a>
										<a class="dropdown-item" href="javascript:;">Enable Split View Mode</a>
										<a class="dropdown-item" href="javascript:;">Keyboard Shortcuts</a>
										<div class="dropdown-divider"></div>	<a class="dropdown-item" href="javascript:;">Sign Out</a>
									</div>
								</div>
							</div>
							
							<div class="mb-3"></div>
							<div class="input-group input-group-sm"> <span class="input-group-text bg-transparent"><i class='bx bx-search'></i></span>
								<input type="text" class="form-control" placeholder="People, groups, & messages"> <span class="input-group-text bg-transparent"><i class='bx bx-dialpad'></i></span>
							</div>
							
							
							<div class="chat-tab-menu mt-3">
								<ul class="nav nav-pills nav-justified">
									<li class="nav-item">
										<a class="nav-link active" data-bs-toggle="pill" href="javascript:;">
											<div class="font-24"><i class='bx bx-conversation'></i>
											</div>
											<div><small>Chats</small>
											</div>
										</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" data-bs-toggle="pill" href="javascript:;">
											<div class="font-24"><i class='bx bx-group'></i>
											</div>
											<div><small>Grupos</small>
											</div>
										</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" data-bs-toggle="pill" href="javascript:;">
											<div class="font-24"><i class='bx bxs-contact'></i>
											</div>
											<div><small>Contactos</small>
											</div>
										</a>
									</li>
								</ul>
							</div>
						</div>
						<div class="chat-sidebar-content">
							<div class="tab-content" id="pills-tabContent">
								<div class="tab-pane fade show active" id="pills-Chats">
									<div class="p-3">
										<div class="meeting-button d-flex justify-content-between">
											<div class="dropdown"> <a href="#" class="btn btn-white btn-sm radius-30 dropdown-toggle dropdown-toggle-nocaret" data-bs-toggle="dropdown">
											<i class='bx bx-cog me-2'></i>Configurar<i class='bx bxs-chevron-down ms-2'></i></a>
												<div class="dropdown-menu"> <a class="dropdown-item" href="#">Plantillas</a>
													<a class="dropdown-item" href="#">Numeros</a>
												</div>
											</div>
											<div class="dropdown"> <a href="#" class="btn btn-white btn-sm radius-30 dropdown-toggle dropdown-toggle-nocaret" data-bs-toggle="dropdown" data-display="static"><i class='bx bxs-edit me-2'></i>New Chat<i class='bx bxs-chevron-down ms-2'></i></a>
												<div class="dropdown-menu dropdown-menu-right">	
													<a class="dropdown-item" href="#">New Group Chat</a>
													<a class="dropdown-item" href="#">New Moderated Group</a>
													<a class="dropdown-item" href="#">New Chat</a>
													<a class="dropdown-item" href="#">New Private Conversation</a>
												</div>
											</div>
										</div>
										<div class="dropdown mt-3"> <a href="#" class="text-uppercase text-secondary dropdown-toggle dropdown-toggle-nocaret" data-bs-toggle="dropdown">Recent Chats <i class='bx bxs-chevron-down'></i></a>
											<div class="dropdown-menu">	<a class="dropdown-item" href="#">Recent Chats</a>
												<a class="dropdown-item" href="#">Hidden Chats</a>
												<div class="dropdown-divider"></div>	<a class="dropdown-item" href="#">Sort by Time</a>
												<a class="dropdown-item" href="#">Sort by Unread</a>
												<div class="dropdown-divider"></div>	<a class="dropdown-item" href="#">Show Favorites</a>
											</div>
										</div>
									</div>
									<div class="chat-list">
										<div class="list-group list-group-flush" id="chat_list">
											
											<!--<a href="javascript:;" class="list-group-item">-->
											<!--	<div class="d-flex">-->
											<!--		<div class="chat-user-online">-->
											<!--			<div class="notify bg-light-info text-info rounded-circle icono_letra_texto"  >A</div>-->
											<!--		</div>-->
											<!--		<div class="flex-grow-1 ms-2">-->
											<!--			<h6 class="mb-0 chat-title">Louis Litt</h6>-->
											<!--			<p class="mb-0 chat-msg">You just got LITT up, Mike.</p>-->
											<!--		</div>-->
											<!--		<div class="chat-time">9:51 AM</div>-->
											<!--	</div>-->
											<!--</a>-->
											<!--<a href="javascript:;" class="list-group-item active">-->
											<!--	<div class="d-flex">-->
											<!--		<div class="chat-user-online">-->
											<!--			<img src="assets/images/avatars/avatar-3.png" width="42" height="42" class="rounded-circle" alt="" />-->
											<!--		</div>-->
											<!--		<div class="flex-grow-1 ms-2">-->
											<!--			<h6 class="mb-0 chat-title">Harvey Specter</h6>-->
											<!--			<p class="mb-0 chat-msg">Wrong. You take the gun....</p>-->
											<!--		</div>-->
											<!--		<div class="chat-time">4:32 PM</div>-->
											<!--	</div>-->
											<!--</a>-->
											<!--<a href="javascript:;" class="list-group-item">-->
											<!--	<div class="d-flex">-->
											<!--		<div class="chat-user-online">-->
											<!--			<img src="assets/images/avatars/avatar-4.png" width="42" height="42" class="rounded-circle" alt="" />-->
											<!--		</div>-->
											<!--		<div class="flex-grow-1 ms-2">-->
											<!--			<h6 class="mb-0 chat-title">Rachel Zane</h6>-->
											<!--			<p class="mb-0 chat-msg">I was thinking that we could...</p>-->
											<!--		</div>-->
											<!--		<div class="chat-time">Wed</div>-->
											<!--	</div>-->
											<!--</a>-->
											<!--<a href="javascript:;" class="list-group-item">-->
											<!--	<div class="d-flex">-->
											<!--		<div class="chat-user-online">-->
											<!--			<img src="assets/images/avatars/avatar-5.png" width="42" height="42" class="rounded-circle" alt="" />-->
											<!--		</div>-->
											<!--		<div class="flex-grow-1 ms-2">-->
											<!--			<h6 class="mb-0 chat-title">Donna Paulsen</h6>-->
											<!--			<p class="mb-0 chat-msg">Mike, I know everything!</p>-->
											<!--		</div>-->
											<!--		<div class="chat-time">Tue</div>-->
											<!--	</div>-->
											<!--</a>-->
											<!--<a href="javascript:;" class="list-group-item">-->
											<!--	<div class="d-flex">-->
											<!--		<div class="chat-user-online">-->
											<!--			<img src="assets/images/avatars/avatar-6.png" width="42" height="42" class="rounded-circle" alt="" />-->
											<!--		</div>-->
											<!--		<div class="flex-grow-1 ms-2">-->
											<!--			<h6 class="mb-0 chat-title">Jessica Pearson</h6>-->
											<!--			<p class="mb-0 chat-msg">Have you finished the draft...</p>-->
											<!--		</div>-->
											<!--		<div class="chat-time">9/3/2020</div>-->
											<!--	</div>-->
											<!--</a>-->
											<!--<a href="javascript:;" class="list-group-item">-->
											<!--	<div class="d-flex">-->
											<!--		<div class="chat-user-online">-->
											<!--			<img src="assets/images/avatars/avatar-7.png" width="42" height="42" class="rounded-circle" alt="" />-->
											<!--		</div>-->
											<!--		<div class="flex-grow-1 ms-2">-->
											<!--			<h6 class="mb-0 chat-title">Harold Gunderson</h6>-->
											<!--			<p class="mb-0 chat-msg">Thanks Mike! :)</p>-->
											<!--		</div>-->
											<!--		<div class="chat-time">12/3/2020</div>-->
											<!--	</div>-->
											<!--</a>-->
											<!--<a href="javascript:;" class="list-group-item">-->
											<!--	<div class="d-flex">-->
											<!--		<div class="chat-user-online">-->
											<!--			<img src="assets/images/avatars/avatar-9.png" width="42" height="42" class="rounded-circle" alt="" />-->
											<!--		</div>-->
											<!--		<div class="flex-grow-1 ms-2">-->
											<!--			<h6 class="mb-0 chat-title">Katrina Bennett</h6>-->
											<!--			<p class="mb-0 chat-msg">I've sent you the files for...</p>-->
											<!--		</div>-->
											<!--		<div class="chat-time">16/3/2020</div>-->
											<!--	</div>-->
											<!--</a>-->
											<!--<a href="javascript:;" class="list-group-item">-->
											<!--	<div class="d-flex">-->
											<!--		<div class="chat-user-online">-->
											<!--			<img src="assets/images/avatars/avatar-10.png" width="42" height="42" class="rounded-circle" alt="" />-->
											<!--		</div>-->
											<!--		<div class="flex-grow-1 ms-2">-->
											<!--			<h6 class="mb-0 chat-title">Charles Forstman</h6>-->
											<!--			<p class="mb-0 chat-msg">Mike, this isn't over.</p>-->
											<!--		</div>-->
											<!--		<div class="chat-time">18/3/2020</div>-->
											<!--	</div>-->
											<!--</a>-->
											<!--<a href="javascript:;" class="list-group-item">-->
											<!--	<div class="d-flex">-->
											<!--		<div class="chat-user-online">-->
											<!--			<img src="assets/images/avatars/avatar-11.png" width="42" height="42" class="rounded-circle" alt="" />-->
											<!--		</div>-->
											<!--		<div class="flex-grow-1 ms-2">-->
											<!--			<h6 class="mb-0 chat-title">Jonathan Sidwell</h6>-->
											<!--			<p class="mb-0 chat-msg">That's bullshit. This deal..</p>-->
											<!--		</div>-->
											<!--		<div class="chat-time">24/3/2020</div>-->
											<!--	</div>-->
											<!--</a>-->
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="chat-header d-flex align-items-center">
						<div class="chat-toggle-btn"><i class='bx bx-menu-alt-left'></i>
						</div>
						<div>
							<h4 class="mb-1 font-weight-bold" id="chat_contacto_name">Harvey Inspector</h4>
							<div class="list-inline d-sm-flex mb-0 d-none"> <a href="javascript:;" class="list-inline-item d-flex align-items-center text-secondary"><small class='bx bxs-circle me-1 chart-online'></small>Active Now</a>
								<a href="javascript:;" class="list-inline-item d-flex align-items-center text-secondary">|</a>
								<a href="javascript:;" class="list-inline-item d-flex align-items-center text-secondary"><i class='bx bx-images me-1'></i>Gallery</a>
								<a href="javascript:;" class="list-inline-item d-flex align-items-center text-secondary">|</a>
								<a href="javascript:;" class="list-inline-item d-flex align-items-center text-secondary"><i class='bx bx-search me-1'></i>Find</a>
							</div>
						</div>
						
						
						<div class="chat-top-header-menu ms-auto">
						    <a href="javascript:;"><i class='bx bx-refresh'></i></a>
							<a href="javascript:;"><i class='bx bx-bar-chart-alt-2'></i></a>
						</div>
					</div>
					<div class="chat-content" id="chat_content">
						<!--<div class="chat-content-leftside">-->
						<!--	<div class="d-flex">-->
						<!--		<img src="assets/images/avatars/avatar-3.png" width="48" height="48" class="rounded-circle" alt="" />-->
						<!--		<div class="flex-grow-1 ms-2">-->
						<!--			<p class="mb-0 chat-time">Harvey, 2:35 PM</p>-->
						<!--			<p class="chat-left-msg">Hi, harvey where are you now a days?</p>-->
						<!--		</div>-->
						<!--	</div>-->
						<!--</div>-->
						
					</div>
					<div class="chat-footer d-flex align-items-center">
						
						<div class="flex-grow-1 pe-2">
							<input type="text" id="chat_send_mensaje" data-emojiable="true" data-emoji-input="unicode" class="form-control emoji-picker-container" placeholder="Type a message">
						</div>
						
						<div class="chat-footer-menu" id="chat_send_menu"> 
						</div>
					</div>
					<!--start chat overlay-->
					<div class="overlay chat-toggle-btn-mobile"></div>
					<!--end chat overlay-->
				</div>
								
				</div>
				
				</div>
				<div class="col-12 col-md-12 col-lg-3 col-xl-3">
					
					<div class="card radius-10 ">
								 <div class="card-header " style="background-color:#f0f2f5 ">
									<div class="d-flex align-items-center">
										<div>
											<h6 class="mb-0">Plantillas de mensajes</h6>
										</div>
										
										<div class="chat-top-header-menu ms-auto">
											<a href="javascript:;" id="btnTemplateModal" ><i class='bx bx-book'></i></a>
										</div>
									 </div>
								 </div>
								<div class="card-body fondo-chat">
								   
								    <div class="mb-3" style="margin-top:5px;" >
										<label for="listNamesTemplates" class="form-label">Seleccionar plantilla</label>
										<select class="form-select form-select-sm" id="listNamesTemplates"  >
												<option value="-1">-</option>  
										</select>
									</div>
								   
								   <div class="flex-grow-1 pe-2" >
								   	    <center>
										<div class="chat-content-leftside">
											<div class="d-flex ms-auto">
												<div class="flex-grow-1 me-2">
													<p class="chat-left-msg" id="chat_send_msm_template" ></p>
												</div>
											</div>
										</div>
										</center>
										<div>
											<ul id="chat_send_msm_template_variables" class="list-group list-group-flush">
											</ul>
										</div>
										
									</div>
								</div>
								<div class="row row-group border-top g-0">
									<div class="col">
										<div class="btn-group btn-block" style="width: 100%;" role="group" aria-label="Basic example">
											<button type="button" class="btn btn-whatsapp">-</button>
											<button type="button" class="btn btn-whatsapp">Enviar</button>
											<button type="button" class="btn btn-whatsapp">-</button>
										</div>
									</div>
								</div><!--end row-->
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
	
	<div class="modal fade" id="" tabindex="-1" style="display: none;" aria-hidden="true">
		<div class="modal-dialog modal-fullscreen">
			<div class="modal-content">
			<div class="modal-header">
			<h5 class="modal-title"></h5>
			<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
		    <div class="modal-body">
		    	<iframe 
		    	width=800
		    	height=800
		    	src="https://dev.restocombo.com/project-millennial-miconnect/modulos/whatsapp/public/tableListarMessagesTemplate?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxNSIsImp0aSI6IjA4ZjExZmI1YmJhMzA5YTljYWJjYTBkYjAyZWY2OGVkYTczYmQ5YWNlNGNmYjRmMzM2NjZiNzhhZjZlMGZmNTRkMzYzZjhiZjQ1YjAxYjZiIiwiaWF0IjoxNjU5MzMwODM0LCJuYmYiOjE2NTkzMzA4MzQsImV4cCI6MTY5MDg2NjgzNCwic3ViIjoiMSIsInNjb3BlcyI6W119.RhHBgeJoJUWXRG8Ev8wgyI5dWczjxQfw7iYOp1DhyataduuJ4ADSalrPnz_bpejefCNxTWNuaidrvPaN2LJCkQxphNdFd1GrHpDFClozoYQqcJ31MXwOOh_u5Ro701AYyRphcuILNy_kO3CwsDvCgmVSGkqquh1pB45QAI8uhb3DhoI8psHijgprrwdziVgY3o1NFVxajb97jY3hCzF_8Bwkcb145o6Spzh7Zy_DI8S9ulmKweEqigCFWXGw0r7AMDFsgtqog4kf8esxFSSDq_PGoNniR2PWZXxfjz9KTaQEUA0nZxyGsuF2qbpXZD8vPi3ERZB4wP70ECp21Jk4p5tN7hRg7GZ_r98mG9x2pSu4hcGlcqJ_aU9MDMGaFF6cTc-BkJQtfbamlvPg1AS4kkVV97RB0bzbvOk1WVEjWaqSct7QK9RoRycrwveSNXSKvIsgMDdq4-9kBFJolJpc2yrUQC7vgxgVp-mcOjncnlo34AHkXsVeCygYL5H01DmUUwkFr8ZDPGJaGETJkawSPoDxiKZOd8N7Exu5HVlf1Mu5WDEBq0YBq0pd4_HhcAX8uUno5AA8iKPWBd8sge08dU1EHdqc604t6h84njT82EYIoIJWTZUSxOaYQhcW3Zk3gtxSNqdKrevWL3xBSlYi9eYd-vFu8ZWQCHjl3rLKnQs#">
		    	</iframe>
		    </div>
			<div class="modal-footer">
			<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
			<button type="button" class="btn btn-primary">Save changes</button>
			</div>
			</div>
		</div>
	</div>
	
	<div class="modal fade" id="ModalTemplateFullScreenModal" tabindex="-1" style="display: none;" aria-hidden="true">
		<div class="modal-dialog modal-xl modal-dialog-scrollable">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Plantillas de mensajes</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<div class="table-responsive" style="font-size: 12px;">
							 <table class="table align-middle mb-0">
								<thead class="table-light">
									<tr>
									  <th>Nombre</th>
									  <th>Lenguaje</th>
									  <th>Estatus</th>
									  <th>Categoria</th>
									  <th>Vista previa</th>
									  <th>Eliminar</th>
									</tr>
								</thead>
								<tbody id="tb"></tbody>
							</table>
						</div>
					</div>
					<div class="modal-footer">	
						<p><small class="bx bxs-circle me-1 chart-online"></small>Aprovado</p>
			        </div>
				
					
				</div>
		</div>
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
    <script src={{ asset("/plugins/perfect-scrollbar/js/perfect-scrollbar.js") }} ></script>
    
	<script src={{ asset("/plugins/emoji-picker/js/config.min.js") }} ></script>
	<script src={{ asset("/plugins/emoji-picker/js/util.min.js") }} ></script>
	<script src={{ asset("/plugins/emoji-picker/js/jquery.emojiarea.min.js") }} ></script>
	<script src={{ asset("/plugins/emoji-picker/js/emoji-picker.min.js") }} ></script>
	
	<script>
      $(function() {
        // Initializes and creates emoji set from sprite sheet
        window.emojiPicker = new EmojiPicker({
          emojiable_selector: '[data-emojiable=true]',
          assetsPath: '{{ asset("/plugins/emoji-picker/img/") }}',
          popupButtonClasses: 'fa fa-smile-o' // far fa-smile if youre using FontAwesome 5
        });
        // Finds all elements with `emojiable_selector` and converts them to rich emoji input fields
        // You may want to delay this step if you have dynamically created input fields that appear later in the loading process
        // It can be called as many times as necessary; previously converted input fields will not be converted again
        window.emojiPicker.discover(); 
      });
    </script>
    
	<script>
		new PerfectScrollbar('.chat-list');
		new PerfectScrollbar('.chat-content');
		new PerfectScrollbar('.list-group-content');
	
	</script>   
	<script>
	
	    function getTemplateListName(){
			  
			  var formData = new FormData();
			  formData.append('configid', $('#configid').val());
			  formData.append('limit', 1000);
			  
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
			        $("#listNamesTemplates").find('option').remove();
		        },
		        success: function(data){
		            var options = $("#listNamesTemplates");
		            $("#listNamesTemplates").find('option').remove();
		            options.append(new Option("- Seleccionar plantilla -","-1"));
					$.each( data['data'], function( key, value ) {
					      var estatus="";
					      if(value['status']=='APPROVED'){
					        options.append(new Option('('+value['language']+') - '+value['name']+'', value['id']));
					      }
					});
                    console.log( data );
		            
		        },
		      }).fail(function(){
		         
		      });
		};  
		
		$( "#listNamesTemplates" ).change(function() {
		  getInformacionTemplate();
		});
		
		function getInformacionTemplate(){
			  
			  var img_emply= "{{ asset('img/img_emply.PNG') }} ";
			  var formData = new FormData();
			  formData.append('configid', $('#configid').val());
			  formData.append('idTemplate', $('#listNamesTemplates').val());
			  
		      $.ajax({
		   		type: "POST",
		        url: "{{ route('listarMessagesTemplateConfigIdBD') }}",
		        data: formData,
		        contentType: false,
		        processData: false,
		        dataType: "json",
		        headers: {'Authorization': "Bearer {{ $token }}"},
		        beforeSend:function (){
			        //$("#form_multimedia_guardar").find("button").prop('disabled', true);
			        //$(".load-foot").show();
			        $('#chat_send_msm_template').html("");
			        $('#chat_send_msm_template_variables').html("");
		        },
		        success: function(data){
		        
		        	console.log( data );
		        	
		        	if(data['templateHeader']=='true'){ 
		        		if(data['templateHeaderType']=='TEXT'){
		        			$('#chat_send_msm_template').append('<b>'+data['templateHeaderText']+'</b>');
		        		}
		        		if(data['templateHeaderType']=='IMAGE'){
		        		    $('#chat_send_msm_template').append('<img src="'+img_emply+'" class="card-img-top" style="height: 80px;">');
		        		}
		        		if(data['templateHeaderType']=='DOCUMENT'){
		        		    $('#chat_send_msm_template').append('<center><img src="'+img_emply+'" class="card-img-top" style="height: 150px;width: 200px;"></center>');
		        		}
		        	 
		        	
		        	}
		        	if(data['templateBody']=='true'){ $('#chat_send_msm_template').append('<br>'+data['templateBodyText']+''); }
		        	if(data['templateFooter']=='true'){ $('#chat_send_msm_template').append('<br>'+data['templateFooterText']+''); }
		            $('#chat_send_msm_template_variables').append('<br>'); 
		            
		            $('#chat_send_msm_template_variables').append('<li class="list-group-item fondo-remove">Lenguaje: '+data['language']+'</li>');
		            $('#chat_send_msm_template_variables').append('<li class="list-group-item fondo-remove">Categoria: '+data['category']+'</li>');
		            $('#chat_send_msm_template_variables').append('<li class="list-group-item fondo-remove">Tipo encabezado: '+data['templateHeaderType']+'</li>');
		            $('#chat_send_msm_template_variables').append('<li class="list-group-item fondo-remove">Variables encabezado: '+data['textHeaderVariable']+'</li>');
		            $('#chat_send_msm_template_variables').append('<li class="list-group-item fondo-remove">Variables body: '+data['countTextBodyVariables']+'</li>');
		            
		        },
		      }).fail(function(){
		         
		      });
		};  
		
		/*se puede optimizar solo get al id de plantilal*/
		function getformdivtemplate(){
			  
			  var img_emply= "{{ asset('img/img_emply.PNG') }} ";
			  var formData = new FormData();
			  formData.append('configid', $('#configid').val());
			  formData.append('limit', 1000);
			  
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
			        $('#chat_send_inputs').html("") 
		        },
		        success: function(data){
		        
		         
					$.each( data['data'], function( key, value ) {
					
					
					      if(value['id']==  $('#listNamesTemplates').val() ){
					        
					        console.log( value );
					        
					        var components = value['components'];
					        $.each( components , function( key, value ) {
					        
						        if(value['type']=='HEADER'){
							        if(value['format']=='TEXT'){
							        	$('#chat_send_inputs').append('<h5 class="mt-0">'+value['text']+'</h5>');
							        }else if(value['format']=='IMAGE') {
							        
							            var result2 = value['example']?.length || 0;
							            if(result2 > 0 ){ 
							            	$('#chat_send_inputs').append('<center><img src="'+value['example']['header_handle'][0]+'" class="card-img-top" style="height: 150px;width: 150px;"></center>');
							            }else{
							            	$('#chat_send_inputs').append('<center><img src="'+img_emply+'" class="card-img-top" style="height: 150px;width: 200px;"></center>');
							            }
							            
							        }else if(value['format']=='DOCUMENT') {
							            
							            var result2 = value['example']?.length || 0;
							            if(result2 > 0 ){ 
							            	$('#chat_send_inputs').append('<embed src="'+value['example']['header_handle'][0]+'#toolbar=0&navpanes=0&scrollbar=0" type="application/pdf" width="100%" height="150px" />');
							            }else{
							            	$('#chat_send_inputs').append('<center><img src="" class="card-img-top" style="height: 150px;width: 200px;"></center>');
							            }
							            
							        }
						        }
						        if(value['type']=='BODY'){
						            $('#chat_send_inputs').append(value['text']);
						        }
						        if(value['type']=='FOOTER'){
						            $('#chat_send_inputs').append('<br><b class="mt-0">'+value['text']+'</b>');
						        }
						        
						        
					        });
					      }
					});
                    
		            
		        },
		      }).fail(function(){
		         
		      });
		};  
		
		function getTemplateList(){
			  
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
					      
					      var estatus="";
					      if(value['status']=='APPROVED'){
					    	estatus='<small class="bx bxs-circle me-1 chart-online"></small>';
					      }
					      
					      
						  $("#tb").append('<tr><td>'+value['name']+'</td>'+
						  '<td>'+value['language']+'</td>'+
						  '<td>'+estatus+'</td>'+
						  '<td>'+value['category']+'</td>'+
						  '<td>'+components+'</td>'+
						  '<td>'+
						  '<button type="button" class="btn btn-outline-primary" onclick="postSincronizarTemplate(\''+value['id']+'\')" ><i class="bx bx-sync"></i></button>'+
						  '<button type="button" class="btn btn-outline-danger" disabled><i class="bx bx-trash"></i></button></td>'+
						  '</tr>');
						  
					});
                    console.log( data );
		            
		        },
		      }).fail(function(){
		         
		      });
		};    
		
		
		
		function postSincronizarTemplate(idTemplate){
			  
			 
			  var formData = new FormData();
			  formData.append('configid', $('#configid').val());
			  formData.append('idTemplate', idTemplate );
			  
		      $.ajax({
		   		type: "POST",
		        url: "{{ route('sincronizarTemplateDB') }}",
		        data: formData,
		        contentType: false,
		        processData: false,
		        dataType: "json",
		        headers: {'Authorization': "Bearer {{ $token }}"},
		        beforeSend:function (){
			        //$("#form_multimedia_guardar").find("button").prop('disabled', true);
			        
		        },
		        success: function(data){
		        
		         
					console.log( data );
					
                    
		            
		        },
		      }).fail(function(){
		         
		      });
		}; 
		
		      
	</script>	      
    <script>
    
        $("#btnTemplateModal").click(function(){
		  $('#ModalTemplateFullScreenModal').modal('toggle');
		  getTemplateList();
		});
    
    
    	$( "#configid" ).change(function() {
		  getInfo();
		  getListChat();
		});
		
		getInfo();
		getListChat();
		
    	function getInfo(){
			  var formData = new FormData();
			  formData.append('configid', $('#configid').val());
			  
		      $.ajax({
		   		type: "POST",
		        url: "{{ route('obtenerInfoNumeroConfigId') }}",
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
		          
		            if( data['quality_rating']  ){
		            	if(data['quality_rating']=='GREEN'){ $("#whassap_config_quality_rating").html("Calidad alta "); }
		            	if(data['quality_rating']=='YELLOW'){$("#whassap_config_quality_rating").html("Calidad media "); }
		            	if(data['quality_rating']=='RED'){ $("#whassap_config_quality_rating").html("Calidad baja "); }
		            }else{
		                $("#whassap_config_quality_rating").html("Calidad no encontrada "); 
		            }
		            
		            if( data['verified_name'] ){
		            	$("#whassap_config_name").html(data['verified_name']); 
		                $("#whassap_config_inicial").html(data['verified_name'].charAt(0));
		            }else{
		            	$("#whassap_config_name").html(data['name']);
		                $("#whassap_config_inicial").html(data['name'].charAt(0));
		            }
		            
		            $("#whassap_config_quality_rating").append(' <i class="fadeIn animated bx bx-info-circle"></i>'); 
		            
		            if( data['verified_name'] ){
		            	$("#whassap_config_estado").removeClass("chat-user-offline");
		            }else{
		            	$("#whassap_config_estado").addClass("chat-user-offline");
		            }
		            
		            console.log( data );
		        },
		      }).fail(function(){
		         
		      });
		};  
		
		
		function getListChat(){
			  var formData = new FormData();
			  formData.append('configid', $('#configid').val());
			  
		      $.ajax({
		   		type: "POST",
		        url: "{{ route('obtenerNumerosChatConfig') }}",
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
		          
		            var items = $("#chat_list");
		        	$("#chat_list").html("");
					$.each( data, function( key, value ) {
					    
					    
					    var time = new Date((parseInt(value['messages_timestamp'])*1000)).toLocaleTimeString("es", { hour: '2-digit', minute: '2-digit', hour12: true });
					    var date = new Date((parseInt(value['messages_timestamp'])*1000)).toLocaleDateString("es");
						
					    var inicial = '-';
					    if(value['contacts_profile_name']){
					    	inicial = value['contacts_profile_name'].charAt(0);
					    }
					    
						items.append(		'<a href="javascript:;" onclick="getChat('+value['to']+',\''+value['contacts_profile_name']+'\')" class="list-group-item">'+
												'<div class="d-flex">'+
													'<div class="chat-user-online">'+
														'<div class="notify bg-light-info text-info rounded-circle icono_letra_texto"  >'+inicial+'</div>'+
													'</div>'+
													'<div class="flex-grow-1 ms-2">'+
														'<h6 class="mb-0 chat-title">'+value['contacts_profile_name']+'</h6>'+
														'<p class="mb-0 chat-msg">'+value['to']+'</p>'+
													'</div>'+
													'<div class="chat-time">'+ date +"<br>"+ time +'</div>'+
												'</div>'+
											'</a>'
						);
					});
					
					//actualizar lista de templates
					getTemplateListName();
                    console.log( data );
		        },
		      }).fail(function(){
		         
		      });
		};  
		
		function getChat(number,name){
			
			
			  
			  var formData = new FormData();
			  formData.append('configid', $('#configid').val());
			  formData.append('numero', number );
			  
			  
			  
		      $.ajax({
		   		type: "POST",
		        url: "{{ route('obtenerChatNumeroConfig') }}",
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
		          
		        	$("#chat_contacto_name").html(name);
		           
		            
		            var items = $("#chat_content");
		        	$("#chat_content").html("");
		        	
		        	
		        	$("#chat_send_menu").html('<a href="javascript:;" onclick="post_type_text('+number+',\''+name+'\')"><i class="bx bx-send"></i></a>'+
											  '<a href="javascript:;" onclick="post_type_text('+number+',\''+name+'\')"><i class="bx bx-images"></i></a>'+
											  '<a href="javascript:;" onclick="post_type_text('+number+',\''+name+'\')"><i class="bx bx-video"></i></a>'+
											  '<a href="javascript:;" onclick="post_type_text('+number+',\''+name+'\')"><i class="bx bx-file-blank"></i></a>'
					);
						
		        	
					$.each( data, function( key, value ) {
					    
					    
					    var time = new Date((parseInt(value['messages_timestamp'])*1000)).toLocaleTimeString("es", { hour: '2-digit', minute: '2-digit', hour12: true });
					    //var date = new Date((parseInt(value['messages_timestamp'])*1000)).toLocaleDateString("es");
						
					    var inicial = '-';
					    if(name){
					    	inicial = name.charAt(0);
					    }
					    
					    var messages_text_body = "";
					    if(value['messages_type']=='text'){
							if(isValidUrl(value['messages_text_body'])){
								messages_text_body = '<a href="'+value['messages_text_body']+'" target="_bank">'+value['messages_text_body']+'</a>';
							}else{
								messages_text_body =  value['messages_text_body']
							}
						}
						
					    if(value['chat']=='recive'){
							
							if(value['messages_type']=='text'){
								
								
								  
								items.append(	'<div class="chat-content-leftside">'+
													'<div class="d-flex">'+
														'<div class="chat-user-online">'+
															'<div class="notify bg-light-info text-info rounded-circle icono_letra_texto"  >'+inicial+'</div>'+
														'</div>'+
														'<div class="flex-grow-1 ms-2">'+
															'<p class="chat-left-msg">'+messages_text_body+'</p>'+
															'<p class="mb-0 chat-time">'+time+'</p>'+
														'</div>'+
													'</div>'+
												'</div>'
								);
							
							} else {
							
								items.append(	'<div class="chat-content-leftside">'+
													'<div class="d-flex">'+
														'<div class="chat-user-online">'+
															'<div class="notify bg-light-info text-info rounded-circle icono_letra_texto"  >'+inicial+'</div>'+
														'</div>'+
														'<div class="flex-grow-1 ms-2">'+
															'<p class="chat-left-msg">'+messages_text_body+'</p>'+
															'<p class="mb-0 chat-time">'+time+'</p>'+
														'</div>'+
													'</div>'+
												'</div>'
								);
							
							}
							
							
					    }else{
					    
					    	if(value['messages_type']=='text'){
					    	
						    	items.append(	'<div class="chat-content-rightside">'+
													'<div class="d-flex ms-auto">'+
														'<div class="flex-grow-1 me-2">'+
															'<p class="mb-0 chat-time text-end">tu,'+time+'</p>'+
															'<p class="chat-right-msg">'+messages_text_body+'</p>'+
														'</div>'+
													'</div>'+
												'</div>'
								);
								
							} else {
							
								items.append(	'<div class="chat-content-rightside">'+
													'<div class="d-flex ms-auto">'+
														'<div class="flex-grow-1 me-2">'+
															'<p class="mb-0 chat-time text-end">tu,'+time+'</p>'+
															'<p class="chat-right-msg">'+messages_text_body+'</p>'+
														'</div>'+
													'</div>'+
												'</div>'
								);
							
							}
					    }
					    
					    
					 
					    
					});
					
                    console.log( data );
		        },
		      }).fail(function(){
		         
		      });
		};  
		
		
		
		function post_type_text(number,name){
			  
			  var formData = new FormData();
			  formData.append('configid', $('#configid').val());
			  formData.append('to',number);
			  formData.append('recipient_type','individual');
			  formData.append('body',$('#chat_send_mensaje').val());
			  
			  if(isValidUrl($('#chat_send_mensaje').val())){
			  	formData.append('preview_url','true');
			  }else{
			  	formData.append('preview_url','false');
			  }
			  
			  
		      $.ajax({
		   		type: "POST",
		        url: "{{ route('sendTextMessagesConfigId') }}",
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
		             $('#chat_send_mensaje').val('');
		             $("#chat_send_mensaje").next("div").html("");
		             getChat(number,name);
		             console.log( data );
		             
		             
		            
		        },
		      }).fail(function(){
		         
		      });
		}; 
		
		
		
		
		
    </script>
    <script>
    	
        const isValidUrl = (string) => {
		  try {
		    new URL(string);
		    return true;
		  } catch (_) {
		    return false;  
		  }
		}
		
    	
    </script>
	
	
</body>

</html>