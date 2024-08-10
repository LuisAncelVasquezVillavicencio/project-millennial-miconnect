<!--start header -->
<header>
	<div class="topbar d-flex align-items-center">
		<nav class="navbar navbar-expand">
			<div class="mobile-toggle-menu"><i class='bx bx-menu'></i>
			</div>
			<div class="search-bar flex-grow-1">
				<!--<div class="position-relative search-bar-box">-->
				<!--	<input type="text" class="form-control search-control" placeholder="Type to search..."> <span class="position-absolute top-50 search-show translate-middle-y"><i class='bx bx-search'></i></span>-->
				<!--	<span class="position-absolute top-50 search-close translate-middle-y"><i class='bx bx-x'></i></span>-->
				<!--</div>-->
			</div>
			<div class="top-menu ms-auto">
				<ul class="navbar-nav align-items-center" >
					<li class="qr_gen nav-item dropdown dropdown-large">
						<div class="con_status dropdown-toggle dropdown-toggle-nocaret position-relative" role="button" data-bs-toggle="dropdown" aria-expanded="false">
							<div class="con_status_in">
								
							</div>
						</div>
						<div class="dropdown-menu dropdown-menu-end">
							<div class="row qr-container">
								
							</div>
						</div>
					</li>
				
					<li class="nav-item dropdown dropdown-large" style="display:none">
						
						<div class="dropdown-menu dropdown-menu-end">
							
							<div class="header-notifications-list">
								
							</div>
							
						</div>
					</li>
					<li class="nav-item dropdown dropdown-large" style="display:none">

						<div class="dropdown-menu dropdown-menu-end">

							<div class="header-message-list">

							</div>
							
						</div>
					</li>
				</ul>
			</div>
			
			
			
			<div class="user-box dropdown">
				<a class="d-flex align-items-center nav-link dropdown-toggle dropdown-toggle-nocaret" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
					<img src="https://w7.pngwing.com/pngs/419/473/png-transparent-computer-icons-user-profile-login-user-heroes-sphere-black-thumbnail.png" class="user-img" alt="user avatar">
					<div class="user-info ps-3">
						<p class="user-name mb-0">{{Auth::user()->name}}</p>
						<p class="designattion mb-0"> 
							@if(Auth::user()->rol == 1)
						    Administrador
						    @else
						    Usuario
						    @endif
						</p>
					</div>
				</a>
				<ul class="dropdown-menu dropdown-menu-end">
					<li><a class="dropdown-item" href="#"><i class="bx bx-user"></i><span>Perfil</span></a>
					</li>
					{{--<li><a class="dropdown-item" href="javascript:;"><i class="bx bx-cog"></i><span>Settings</span></a>
					</li>
					<li><a class="dropdown-item" href="javascript:;"><i class='bx bx-home-circle'></i><span>Dashboard</span></a>
					</li>
					<li><a class="dropdown-item" href="javascript:;"><i class='bx bx-dollar-circle'></i><span>Earnings</span></a>
					</li>
					<li><a class="dropdown-item" href="javascript:;"><i class='bx bx-download'></i><span>Downloads</span></a>
					</li>
					--}}
					<li>
						<div class="dropdown-divider mb-0"></div>
					</li>
					<li>
						<a class="dropdown-item" onclick="document.getElementById('logout-form').submit()">
							<i class='bx bx-log-out-circle'></i>
							<span class="link">Salir</span>
						</a>
					</li>
					<form id="logout-form" action="{{ route('logout') }}" method="POST" >
					    @csrf
	            </form>
				</ul>
			</div>
		</nav>
	</div>
</header>
<!--end header -->