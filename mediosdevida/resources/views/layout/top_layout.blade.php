@if (auth()->guest())
	<script>window.location.href = "{{route('login')}}"</script>     
@else

<div class="header-main header sticky">
	<div class="app-header header top-header navbar-collapse ">
		<div class="container-fluid">
			<div class="d-flex">
			    <a href="#" data-toggle="sidebar" class="nav-link icon toggle"><i class="fe fe-align-justify fs-20"></i></a>
			    <a class="header-brand" href="{{route('home')}}">
			        <img src="{{asset('images_theme/Logo-millev-completo.png')}}" class="header-brand-img" alt="logo">
				</a> 
				<div class="d-flex header-left left-header">
					<div class="d-none d-lg-block horizontal">
					</div>
				</div>
				<div class="d-flex header-right ml-auto">

					<div class="con_status">
						<div class="con_status_in">
							
						</div>
					</div>
				
					<div class="dropdown drop-profile">
						<a class="nav-link pr-0 leading-none" href="#" data-toggle="dropdown" aria-expanded="false">
							<div class="profile-details mt-1">
								<span class="mr-3 mb-0  fs-15 font-weight-semibold">{{ Auth::user()->name }}</span>
								<!--<small class="text-muted mr-3">appdeveloper</small>-->
							</div>
							<img class="avatar avatar-md brround" src="{{asset('images_theme/users/2.jpg')}}" alt="image">
						 </a>
						<div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow animated bounceInDown w-250">
							<div class="user-profile bg-header-image-orange border-bottom p-3">
								<div class="user-image text-center">
									<img class="user-images" src="{{asset('images_theme/users/2.jpg')}}" alt="image">
								</div>
								<div class="user-details text-center">
									<h4 class="mb-0"> {{ Auth::user()->name }}</h4>
									<p class="mb-1 fs-13 text-white"> {{ Auth::user()->email }}</p>
								</div>
							</div>
							<!--<a class="dropdown-item" href="#">-->
							<!--	<i class="dropdown-icon mdi mdi-account-outline "></i> Profile-->
							<!--</a>-->
							<!--<a class="dropdown-item" href="#">-->
							<!--	<i class="dropdown-icon  mdi mdi-settings"></i> Settings-->
							<!--</a>-->
							<!--<a class="dropdown-item" href="#">-->
							<!--	<span class="float-right"><span class="badge badge-success">6</span></span>-->
							<!--	<i class="dropdown-icon mdi  mdi-message-outline"></i> Inbox-->
							<!--</a>-->
							<!--<a class="dropdown-item" href="#">-->
							<!--	<i class="dropdown-icon mdi mdi-comment-check-outline"></i> Message-->
							<!--</a>-->
							<!--<div class="dropdown-divider"></div>-->
							<!--<a class="dropdown-item" href="#">-->
							<!--	<i class="dropdown-icon mdi mdi-compass"></i> Need help?-->
							<!--</a>-->
							<a class="dropdown-item mb-1" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                      document.getElementById('logout-form').submit();">
								<i class="dropdown-icon mdi  mdi-logout-variant"></i> Salir
                     </a>
                     <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                         @csrf
                     </form>
						</div>
						
				</div><!-- Profile -->	
			</div>
		</div>
	</div>
</div>
</div>

@endif 