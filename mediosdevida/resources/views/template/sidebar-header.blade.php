<!--sidebar wrapper -->
<div class="sidebar-wrapper" data-simplebar="true">
	<div class="sidebar-header">
		<div>
			<img class="logo-icon" src="{{asset("new_temp/assets/images/icono.png")}}" alt="logo icon">
		</div>
		<div>
			<h4 class="logo-text"> <img src="{{asset("new_temp/assets/images/colores.svg")}}" style="width: 90%;"> </h4>
		</div>
		<div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i>
		</div>
	</div>
	<!--navigation-->
	<ul class="metismenu" id="menu">
		
		<li>
			<a href="{{route('home')}}">
				<div class="parent-icon"><i class="bx bx-home-circle"></i>
				</div>
				<div class="menu-title">Inicio</div>
			</a>
		</li>
		<li>
			<a href="{{route('report')}}">
				<div class="parent-icon"><i class="bx bxs-report"></i>
				</div>
				<div class="menu-title">Reportes</div>
			</a>
		</li>
		<li>
			<a href="javascript:;" class="has-arrow">
				<div class="parent-icon"><i class='bx bxs-user-account'></i>
				</div>
				<div class="menu-title">Agenda</div>
			</a>
			<ul>
				<li> <a href="{{route('grupos')}}"><i class="bx bx-right-arrow-alt"></i>Grupos</a>
				</li>
				<li> 
					<a href="{{route('contactos')}}"><i class="bx bx-right-arrow-alt"></i>Contactos</a>
				</li>
			</ul>
		</li>
		<li>
			<a href="javascript:;" class="has-arrow">
				<div class="parent-icon"><i class='bx bxs-cog'></i>
				</div>
				<div class="menu-title">Configuración</div>
			</a>
			<ul>
				<li> <a href="{{route('config.categorias')}}"><i class="bx bx-right-arrow-alt"></i>Categorias</a>
				</li>
				<li> <a href="{{route('config.plantillas')}}"><i class="bx bx-right-arrow-alt"></i>Plantillas</a>
				</li>
				<li> <a href="{{route('config.instancias')}}"><i class="bx bx-right-arrow-alt"></i>Instancias</a>
				</li>
			</ul>
		</li>
		<li>
			<a href="{{route('bolsa')}}">
				<div class="parent-icon"><i class='bx bx-message-alt-detail'></i>
				</div>
				<div class="menu-title">Bolsa de mensajes</div>
			</a>
		</li>
		<li>
			<a href="{{route('plantillas')}}">
				<div class="parent-icon"><i class='bx bx-bookmarks'></i>
				</div>
				<div class="menu-title">Plantillas</div>
			</a>
		</li>
		<li>
			<a href="{{route('colas')}}">
				<div class="parent-icon"><i class='bx bx-add-to-queue'></i>
				</div>
				<div class="menu-title">Colas</div>
			</a>
		</li>
		<li>
			<a href="{{route('Sent_1')}}">
				<div class="parent-icon"><i class='bx bx-mobile-vibration'></i>
				</div>
				<div class="menu-title">Envios masivos</div>
			</a>
		</li>
		<li>
			<a href="{{route('multimedia_index')}}">
				<div class="parent-icon"><i class='bx bx-folder-open'></i>
				</div>
				<div class="menu-title">Multimedia</div>
			</a>
		</li>
		<li>
			<a href="{{route('recive')}}">
				<div class="parent-icon"><i class='bx bx-message-rounded-detail'></i>
				</div>
				<div class="menu-title">Mensajes recibidos</div>
			</a>
		</li>
		<li>
			<a href="{{route('bot.admins')}}">
				<div class="parent-icon"><i class='bx bx-joystick'></i>
				</div>
				<div class="menu-title">Configuración de bots</div>
			</a>
		</li>
	</ul>
	<!--end navigation-->
</div>
<!--end sidebar wrapper -->