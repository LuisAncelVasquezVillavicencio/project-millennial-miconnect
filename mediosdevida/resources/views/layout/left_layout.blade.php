<!-- Sidebar menu-->

<div class="app-sidebar__overlay" data-toggle="sidebar" ></div>
<aside class="app-sidebar toggle-sidebar bg-gradient-secondary menu_over" >
	<!--<div class="app-sidebar__user">-->
	<!--	<div class="user-body">-->
	<!--		<img src="../assets/images/users/2.jpg" alt="profile-img" class="rounded-circle w-25">-->
	<!--	</div>-->
	<!--	<div class="user-info">-->
	<!--		<a href="#" class=""><span class="app-sidebar__user-name font-weight-semibold"> Jonathan</span><br>-->
	<!--			<span class="text-muted app-sidebar__user-designation text-sm">App Developer</span>-->
	<!--		</a>-->
	<!--	</div>-->
	<!--</div>-->
	<ul class="side-menu toggle-menu " >
		<li class="slide">
			<a class=" {{ (Route::currentRouteName() == 'home') ? 'side-menu__item link active' : 'side-menu__item link' }} "  href="{{route('home')}}">
			    <span class="icon-menu-img">
			        <img src="{{ asset('images_theme/svgs/homepage.svg')}}" class="side_menu_img svg-1" alt="image">
			    </span>
			    <span class="side-menu__label">Home</span>
			 </a>
		</li>
		<li class="slide">
       	<a class=" {{ (Route::currentRouteName() == 'report') ? 'side-menu__item link active' : 'side-menu__item link' }}" href="{{route('report')}}"><span class="icon-menu-img"><img src="{{ asset('images_theme/svgs/bars-graphic.svg')}}" class="side_menu_img svg-1" alt="image"></span><span class="side-menu__label">Reportes</span></a>
		</li>
		<li class="slide">
			<a class=" {{ (Route::currentRouteName() == 'grupos')||(Route::currentRouteName() == 'contactos')||(Route::currentRouteName() == 'creargrupo')||(Route::currentRouteName() == 'editargrupo') ? 'side-menu__item active' : 'side-menu__item' }} " 
				data-toggle="slide" href="#"><span class="icon-menu-img"><img src="{{ asset('images_theme/svgs/calendar.svg')}}" class="side_menu_img svg-1" alt="image"></span><span class="side-menu__label">Agenda</span><i class="angle fa fa-angle-right"></i></a>
			<ul class="slide-menu">
				<li><a href="{{route('grupos')}}" class="slide-item">Grupos</a></li>
				<li><a href="{{route('contactos')}}" class="slide-item">Contactos</a></li>

			</ul>
		</li>
		<li class="slide">
			<a class=" {{ (Route::currentRouteName() == 'config.*') ? 'side-menu__item active' : 'side-menu__item' }} " 
				data-toggle="slide" href="#"><span class="icon-menu-img"><img src="{{ asset('images_theme/svgs/app.svg')}}" class="side_menu_img svg-1" alt="image"></span><span class="side-menu__label">Configuración</span><i class="angle fa fa-angle-right"></i></a>
			<ul class="slide-menu">
				<li><a href="{{route('config.categorias')}}" class="slide-item">Categorias</a></li>
				<li><a href="{{route('config.plantillas')}}" class="slide-item">Plantillas</a></li>
				<li><a href="{{route('config.instancias')}}" class="slide-item">Instancias</a></li>
			</ul>
		</li>
		<li class="slide">
			<a class=" {{ (Route::currentRouteName() == 'bolsa') ? 'side-menu__item link active' : 'side-menu__item link' }}" href="{{route('bolsa')}}"><span class="icon-menu-img"><img src="{{ asset('images_theme/svgs/email.svg')}}" class="side_menu_img svg-1" alt="image"></span><span class="side-menu__label">Bolsa de mensajes</span></a>
		</li>
		<!--<li class="slide">-->
		<!--	<a class="{{ (Route::currentRouteName() == 'plantillas') ? 'side-menu__item link active' : 'side-menu__item link' }}"  href="{{route('plantillas')}}"><span class="icon-menu-img"><img src="{{ asset('images_theme/svgs/layers.svg')}}" class="side_menu_img svg-1" alt="image"></span><span class="side-menu__label">Plantillas</span></a>-->
		<!--</li>-->
		
		<li class="slide">
			<a class="{{ (Route::currentRouteName() == 'colas') ? 'side-menu__item link active' : 'side-menu__item link' }}"  href="{{route('colas')}}"><span class="icon-menu-img"><img src="{{ asset('images_theme/svgs/layers.svg')}}" class="side_menu_img svg-1" alt="image"></span><span class="side-menu__label">Colas</span></a>
		</li>
		
		<li class="slide">
			<a class="{{ (Route::currentRouteName() == 'Sent_1') ? 'side-menu__item link active' : 'side-menu__item link' }}"  href="{{route('Sent_1')}}"><span class="icon-menu-img"><img src="{{ asset('images_theme/svgs/email.svg')}}" class="side_menu_img svg-1" alt="image"></span><span class="side-menu__label">Envio masivo</span></a>
		</li>
		<li class="slide">
			<a class="{{ (Route::currentRouteName() == 'multimedia_index') ? 'side-menu__item link active' : 'side-menu__item link' }}"  href="{{route('multimedia_index')}}"><span class="icon-menu-img"><img src="{{ asset('images_theme/svgs/icons.svg')}}" class="side_menu_img svg-1" alt="image"></span><span class="side-menu__label">Multimedia</span></a>
		</li>
		<!--<li class="slide">-->
		<!--	<a class="side-menu__item" data-toggle="slide" href="#"><span class="icon-menu-img"><img src="{{ asset('images_theme/svgs/writing.svg')}}" class="side_menu_img svg-1" alt="image"></span><span class="side-menu__label">Bot whatsapp</span></a>-->
		<!--</li>-->
	
		<li class="slide">
			<a class="{{ (Route::currentRouteName() == 'recive') ? 'side-menu__item link active' : 'side-menu__item link' }}"  href="{{route('recive')}}"><span class="icon-menu-img"><img src="{{ asset('images_theme/svgs/writing.svg')}}" class="side_menu_img svg-1" alt="image"></span><span class="side-menu__label">Mensajes Recibidos</span></a>
		</li>
		
		
		<li class="slide">
			<a class="{{ (Route::currentRouteName() == 'bot.admins') ? 'side-menu__item link active' : 'side-menu__item link' }}"  href="{{route('bot.admins')}}">
				<span class="icon-menu-img"><img src="{{ asset('images_theme/svgs/inteligencia-artificial.svg')}}" class="side_menu_img svg-1" alt="image" style=""></span>
				<span class="side-menu__label" style="width: 100%; display: flex;justify-content: space-between;align-items: center;">Configuracion de bots 
					<span class="badge badge-primary" style="height: fit-content;">beta</span> 
				</span>
			</a>
		</li>

	</ul>
</aside>