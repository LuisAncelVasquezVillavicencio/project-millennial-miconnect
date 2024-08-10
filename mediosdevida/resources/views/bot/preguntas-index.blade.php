@extends('template.app')
@section('title', 'Configuracion encuestas')
@section('content')
<div class="page-breadcrumb d-flex align-items-center">
   <div class="bread-crumb-custom w-100 d-flex align-items-center">
   	<div class="breadcrumb-title pe-3">Encuestas</div>
   	<div class="ps-3 mb-0 mb-md-0">
   		<nav aria-label="breadcrumb">
   			<ol class="breadcrumb mb-0 p-0">
   				<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
   				</li>
   				<li class="breadcrumb-item active" aria-current="page">{{$bot->TITULO_ENCUESTA}}</li>
   			</ol>
   		</nav>
   	</div>
	</div>
	<div class="ms-auto">
		<div class="btn-group">
			<button type="button" class="btn btn-primary dropdown-toggle " data-bs-toggle="dropdown">Opciones</button>
			{{--<button type="button" class="btn btn-primary split-bg-primary dropdown-toggle dropdown-toggle-split" >	<span class="visually-hidden">Toggle Dropdown</span>
			</button>--}}
			<div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-end">	
			   <a class="dropdown-item" href="javascript:;" data-bs-toggle="modal" data-bs-target="#pregunta-create">Crear nueva pregunta</a>
			   <a class="dropdown-item" href="javascript:;" data-bs-toggle="modal" data-bs-target="#destroy-bot">Eliminar bot</a>
			   <a class="dropdown-item" href="{{route('bot.reporteria', $bot->ID_ENCUESTA)}}">Reporteria</a>
			   <div class="dropdown-divider"></div>	
			   <a class="dropdown-item" href="{{route('bot.admins')}}">Volver</a>
			</div>
		</div>
	</div>
</div>
<div class="row mt-3 preguntas-body">
   @include('bot.preguntas-list')
</div>

<div class="modal fade" id="pregunta-create" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog modal-lg ">
		<div class="modal-content ">
			<div class="modal-header border-top border-0 border-4 border-primary ps-4 pe-4 ">
				<h5 class="modal-title text-primary "><i class="bx bx-bot"></i> Agregar nueva pregunta</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form id="form-create" action="{{route('bot.pregunta_c',$bot->ID_ENCUESTA)}}" method="POST">
			   @csrf
   			<div class="modal-body ps-4 pe-4">
   			   <div class="row g-3">
   			      <div class="col-12">
   			         <label for="PREGUNTA" class="form-label">Escriba la pregunta</label>
   			         <textarea name="PREGUNTA" id="PREGUNTA" class="form-control" placeholder="Maximos caracteres: 1000" required></textarea>
   			      </div>
   			   </div>
   			</div>
   			<div class="modal-footer">
   				<button type="button" class="btn btn-link" data-bs-dismiss="modal">Cerrar</button>
   				<button type="submit" class="btn btn-primary">Crear</button>
   			</div>
			</form>
		</div>
	</div>
</div>

<div class="modal fade" id="pregunta-edit" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog modal-lg ">
		<div class="modal-content ">
			<div class="modal-header border-top border-0 border-4 border-primary ps-4 pe-4 ">
				<h5 class="modal-title text-primary "><i class="bx bx-bot"></i> Editar pregunta</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form id="form-edit" action="{{route('bot.pregunta_e',$bot->ID_ENCUESTA)}}" method="POST">
			   @csrf
			   <input type="hidden" name="ID_PREGUNTA_E" id="ID_PREGUNTA_E"></input>
   			<div class="modal-body ps-4 pe-4">
   			   <div class="row g-3">
   			      <div class="col-12">
   			         <label for="PREGUNTA_E" class="form-label">Escriba la pregunta</label>
   			         <textarea name="PREGUNTA_E" id="PREGUNTA_E" class="form-control" placeholder="Maximos caracteres: 1000" required></textarea>
   			      </div>
   			   </div>
   			</div>
   			<div class="modal-footer">
   				<button type="button" class="btn btn-link" data-bs-dismiss="modal">Cerrar</button>
   				<button type="submit" class="btn btn-primary">Guardar</button>
   			</div>
			</form>
		</div>
	</div>
</div>

<div class="modal fade" id="add-answer" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog modal-lg ">
		<div class="modal-content ">
			<div class="modal-header border-top border-0 border-4 border-primary ps-4 pe-4 ">
				<h5 class="modal-title text-primary "><i class="bx bx-bot"></i> Agregar opción</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form id="form-answer-option" action="{{route('bot.respuesta_new',$bot->ID_ENCUESTA)}}" method="POST">
			   @csrf
			   <input type="hidden" name="ID_PREGUNTA_A" id="ID_PREGUNTA_A">
   			<div class="modal-body ps-4 pe-4">
   			   <div class="row g-3">
   			      <div class="col-12">
                     <label for="OPCION" class="form-label">Opción*</label>
   			         <input name="OPCION" id="OPCION" class="form-control" placeholder="Escriba la opción (máximo 100 caracteres)" required>
   			      </div>
   			      <div class="col-12">
                     <label for="CLAVE" class="form-label">Clave</label>
   			         <select name="CLAVE" id="CLAVE" class="form-control" required></select>
   			      </div>
   			      {{--<div class="col-md-6 col-sm-12">
                     <label for="IMG" class="form-label">¿Enviar imagen al recibir respuesta?</label>
   			         <div class="form-check">
								<input class="form-check-input" type="checkbox" value="1" id="IMG" name="IMG">
								<label class="form-check-label" for="IMG">Si</label>
							</div>
   			      </div>
   			      <div class="col-12">
                     <label for="URL_IMAGEN" class="form-label">Imagen</label>
   			         <input name="URL_IMAGEN" id="URL_IMAGEN" class="form-control" placeholder="Dirección web de la imagen" type="url" disabled required>
   			      </div>--}}
   			      <div class="col-md-6 col-sm-12">
                     <label for="AUTO_RESPUESTA" class="form-label">¿Enviar mensaje al recibir respuesta?</label>
   			         <div class="form-check">
								<input class="form-check-input" type="checkbox" value="1" id="AUTO_RESPUESTA" name="AUTO_RESPUESTA">
								<label class="form-check-label" for="AUTO_RESPUESTA">Si</label>
							</div>
   			      </div>
   			      <div class="col-12">
                     <label for="RESPUESTA" class="form-label">Respuesta</label>
   			         <textarea name="RESPUESTA" id="RESPUESTA" class="form-control" placeholder="Mensaje (máximo 1000 caracteres)" disabled required></textarea>
   			      </div>
   			      <div class="col-12">
                     <label for="RESPUESTA" class="form-label">Peso</label>
   			         <input type="number" name="PESO" id="PESO" class="form-control" >
   			      </div>
   			   </div>
   			</div>
   			<div class="modal-footer">
   				<button type="button" class="btn btn-link" data-bs-dismiss="modal">Cerrar</button>
   				<button type="submit" class="btn btn-primary">Crear</button>
   			</div>
			</form>
		</div>
	</div>
</div>

<div class="modal fade" id="edit-answer" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog modal-lg ">
		<div class="modal-content ">
			<div class="modal-header border-top border-0 border-4 border-primary ps-4 pe-4 ">
				<h5 class="modal-title text-primary "><i class="bx bx-bot"></i> Editar opción</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form id="form-answer-edit-option" action="{{route('bot.respuesta_edit',$bot->ID_ENCUESTA)}}" method="POST">
			   @csrf
			   <input type="hidden" name="ID_PREGUNTA_E_A" id="ID_PREGUNTA_E_A">
			   <input type="hidden" name="ID_OPCIONES_E" id="ID_OPCIONES_E">
   			<div class="modal-body ps-4 pe-4">
   			   <div class="row g-3">
   			      <div class="col-12">
                     <label for="OPCION" class="form-label">Opción*</label>
   			         <input name="OPCION_E" id="OPCION_E" class="form-control" placeholder="Escriba la opción (máximo 100 caracteres)" required>
   			      </div>
   			      <div class="col-12">
                     <label for="CLAVE" class="form-label">Clave</label>
   			         <select name="CLAVE_E" id="CLAVE_E" class="form-control" required></select>
   			      </div>
   			      {{--<div class="col-md-6 col-sm-12">
                     <label for="IMG" class="form-label">¿Enviar imagen al recibir respuesta?</label>
   			         <div class="form-check">
								<input class="form-check-input" type="checkbox" value="1" id="IMG_E" name="IMG_E">
								<label class="form-check-label" for="IMG">Si</label>
							</div>
   			      </div>
   			      <div class="col-12">
                     <label for="URL_IMAGEN" class="form-label">Imagen</label>
   			         <input name="URL_IMAGEN_E" id="URL_IMAGEN_E" class="form-control" placeholder="Dirección web de la imagen" type="url" disabled required>
   			      </div>--}}
   			      <div class="col-md-6 col-sm-12">
                     <label for="AUTO_RESPUESTA" class="form-label">¿Enviar mensaje al recibir respuesta?</label>
   			         <div class="form-check">
								<input class="form-check-input" type="checkbox" value="1" id="AUTO_RESPUESTA_E" name="AUTO_RESPUESTA_E">
								<label class="form-check-label" for="AUTO_RESPUESTA">Si</label>
							</div>
   			      </div>
   			      <div class="col-12">
                     <label for="RESPUESTA" class="form-label">Respuesta</label>
   			         <textarea name="RESPUESTA_E" id="RESPUESTA_E" class="form-control" placeholder="Mensaje (máximo 1000 caracteres)" disabled required></textarea>
   			      </div>
   			      <div class="col-12">
                     <label for="RESPUESTA" class="form-label">Peso</label>
   			         <input type="number" name="PESO_E" id="PESO_E" class="form-control" >
   			      </div>
   			   </div>
   			</div>
   			<div class="modal-footer">
   				<button type="button" class="btn btn-link" data-bs-dismiss="modal">Cerrar</button>
   				<button type="submit" class="btn btn-primary">Editar</button>
   			</div>
			</form>
		</div>
	</div>
</div>

<div class="modal fade" id="destroy-bot" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog modal-lg ">
		<div class="modal-content ">
			<div class="modal-header border-top border-0 border-4 border-primary ps-4 pe-4 ">
				<h5 class="modal-title text-primary "><i class="bx bx-bot"></i> Eliminar encuesta</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form id="form-destroy" action="{{route('bot.destroy',$bot->ID_ENCUESTA)}}" method="POST">
			   @csrf
			   <input type="hidden" name="ID_ENCUESTA_EL" id="ID_ENCUESTA_EL" value="{{$bot->ID_ENCUESTA}}">
   			<div class="modal-body ps-4 pe-4">
   			   <div class="row g-3">
   			      <div class="col-12">
   			         Al eliminar este bot, se eliminaran tambien los datos relacionados al mismo (respuestas, lista de usuarios que completaron,etc.).
   			         <br>No se eliminaran los mensajes enviados y recibidos por medio del bot, ni contactos.
   			      </div>
   			   </div>
   			</div>
            <div class="modal-footer">
   				<button type="button" class="btn btn-link" data-bs-dismiss="modal">Cerrar</button>
   				<button type="submit" class="btn btn-primary">Eliminar</button>
   			</div>
			</form>
		</div>
	</div>
</div>

<div class="modal fade" id="destroy-question" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog modal-lg ">
		<div class="modal-content ">
			<div class="modal-header border-top border-0 border-4 border-primary ps-4 pe-4 ">
				<h5 class="modal-title text-primary "><i class="bx bx-bot"></i> Eliminar pregunta</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form id="form-destroy-pregunta" action="{{route('bot.pregunta_destroy',$bot->ID_ENCUESTA)}}" method="POST">
			   @csrf
			   <input type="hidden" name="ID_ENCUESTA_P_EL" id="ID_ENCUESTA_P_EL" value="{{$bot->ID_ENCUESTA}}">
			   <input type="hidden" name="ID_PREGUNTA_EL" id="ID_PREGUNTA_EL" value="">
   			<div class="modal-body ps-4 pe-4">
   			   <div class="row g-3">
   			      <div class="col-12">
   			         Al eliminar la pregunta, tambien se eliminaran los datos relacionados a la misma (Opciones, registro de respuesta, etc).
   			         <br>No se modificaran resultados de encuestas ya cerradas.
   			         <br>No se eliminaran los mensajes enviados y recibidos por medio del bot, ni contactos.
   			      </div>
   			   </div>
   			</div>
            <div class="modal-footer">
   				<button type="button" class="btn btn-link" data-bs-dismiss="modal">Cerrar</button>
   				<button type="submit" class="btn btn-primary">Eliminar</button>
   			</div>
			</form>
		</div>
	</div>
</div>

<div class="modal fade" id="destroy-answer" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog modal-lg ">
		<div class="modal-content ">
			<div class="modal-header border-top border-0 border-4 border-primary ps-4 pe-4 ">
				<h5 class="modal-title text-primary "><i class="bx bx-bot"></i> Eliminar respuesta</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form id="form-destroy-opcion" action="{{route('bot.respuesta_destroy',$bot->ID_ENCUESTA)}}" method="POST">
			   @csrf
			   <input type="hidden" name="ID_ENCUESTA_P_EL" id="ID_ENCUESTA_P_EL" value="{{$bot->ID_ENCUESTA}}">
			   <input type="hidden" name="ID_PREGUNTA_A_EL" id="ID_PREGUNTA_A_EL" value="">
			   <input type="hidden" name="ID_OPCIONES_A_EL" id="ID_OPCIONES_A_EL" value="">
   			<div class="modal-body ps-4 pe-4">
   			   <div class="row g-3">
   			      <div class="col-12">
   			         Al eliminar la respuesta, tambien se eliminaran los datos relacionados a la misma (registro de respuesta).
   			         <br>No se modificaran resultados de encuestas ya cerradas.
   			         <br>No se eliminaran los mensajes enviados y recibidos por medio del bot, ni contactos.
   			      </div>
   			   </div>
   			</div>
            <div class="modal-footer">
   				<button type="button" class="btn btn-link" data-bs-dismiss="modal">Cerrar</button>
   				<button type="submit" class="btn btn-primary">Eliminar</button>
   			</div>
			</form>
		</div>
	</div>
</div>

<div class="modal fade" id="destroy-calc" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog modal-lg ">
		<div class="modal-content ">
			<div class="modal-header border-top border-0 border-4 border-primary ps-4 pe-4 ">
				<h5 class="modal-title text-primary "><i class="bx bx-bot"></i> Eliminar respuesta</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form id="form-destroy-calc" action="{{route('bot.calc_destroy',$bot->ID_ENCUESTA)}}" method="POST">
			   @csrf
			   <input type="hidden" name="ID_ENCUESTA_DES" id="ID_ENCUESTA_DES" value="{{$bot->ID_ENCUESTA}}">
			   <input type="hidden" name="ID_RESULTADO_DES" id="ID_RESULTADO_DES" value="">
   			<div class="modal-body ps-4 pe-4">
   			   <div class="row g-3">
   			      <div class="col-12">
   			         ¿Desea eliminar este calculo?
   			         <br>No se modificaran resultados de encuestas ya cerradas.
   			         <br>No se eliminaran los mensajes enviados y recibidos por medio del bot, ni contactos.
   			      </div>
   			   </div>
   			</div>
            <div class="modal-footer">
   				<button type="button" class="btn btn-link" data-bs-dismiss="modal">Cerrar</button>
   				<button type="submit" class="btn btn-primary">Eliminar</button>
   			</div>
			</form>
		</div>
	</div>
</div>



<div class="modal fade" id="create_calc_modal" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog modal-lg ">
		<div class="modal-content ">
			<div class="modal-header border-top border-0 border-4 border-primary ps-4 pe-4 ">
				<h5 class="modal-title text-primary "><i class="bx bx-bot"></i> Agregar resultado de calculo</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form id="bot-calc" action="{{route('bot.calc',$bot->ID_ENCUESTA)}}" method="POST">
			   @csrf
   			<div class="modal-body ps-4 pe-4">
   			   <div class="row g-3">
   			      <div class="col-md-4 col-sm-12">
   			          <label for="OTROS" class="form-label">Fuera de rango</label>
   			         <div class="form-check">
								<input class="form-check-input" type="checkbox" value="1" id="OTROS" name="OTROS">
								<label class="form-check-label" for="OTROS">Si</label>
							</div>
   			      </div>
   			      <div class="col-md-4 col-sm-12">
   			         <label for="MINIMO" class="form-label">Minimo</label>
   			         <input name="MINIMO" id="MINIMO" class="form-control" placeholder="Puntaje minimo" type="number" required>
   			      </div>
   			      <div class="col-md-4 col-sm-12">
   			         <label for="MAXIMO" class="form-label">Maximo</label>
   			         <input name="MAXIMO" id="MAXIMO" class="form-control" placeholder="Puntaje maximo" type="number" required>
   			      </div>
   			      
   			      <div class="col-12">
   			         <label for="MENSAJE" class="form-label">Mensaje</label>
   			         <textarea name="MENSAJE" id="MENSAJE" class="form-control" placeholder="Mensaje de resultado (maximo: 1000 caracteres)" required></textarea>
   			      </div>
                  <div class="col-md-6 col-sm-12">
                     <label for="IMG" class="form-label">¿Enviar imagen?</label>
   			         <div class="form-check">
								<input class="form-check-input" type="checkbox" value="1" id="IMG" name="IMG">
								<label class="form-check-label" for="IMG">Si</label>
							</div>
   			      </div>
   			      <div class="col-12">
                     <label for="URL_IMAGEN" class="form-label">Imagen</label>
   			         <input name="URL_IMAGEN" id="URL_IMAGEN" class="form-control" placeholder="Dirección web de la imagen" type="url" disabled required>
   			      </div>
   			   </div>
   			</div>
   			<div class="modal-footer">
   				<button type="button" class="btn btn-link" data-bs-dismiss="modal">Cerrar</button>
   				<button type="submit" class="btn btn-primary">Guardar</button>
   			</div>
			</form>
		</div>
	</div>
</div>

<div class="modal fade" id="edit_calc_modal" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog modal-lg ">
		<div class="modal-content ">
			<div class="modal-header border-top border-0 border-4 border-primary ps-4 pe-4 ">
				<h5 class="modal-title text-primary "><i class="bx bx-bot"></i> Editar resultado de calculo</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form id="bot-calc-edit" action="{{route('bot.calc_edit',$bot->ID_ENCUESTA)}}" method="POST">
			   @csrf
			   <input value="" type="hidden" name="ID_RESULTADO_EC" id="ID_RESULTADO_EC">
   			<div class="modal-body ps-4 pe-4">
   			   <div class="row g-3">
   			      <div class="col-md-4 col-sm-12">
   			          <label for="OTROS_EC" class="form-label">Fuera de rango</label>
   			         <div class="form-check">
								<input class="form-check-input" type="checkbox" value="1" id="OTROS_EC" name="OTROS_EC">
								<label class="form-check-label" for="OTROS_EC">Si</label>
							</div>
   			      </div>
   			      <div class="col-md-4 col-sm-12">
   			         <label for="MINIMO" class="form-label">Minimo</label>
   			         <input name="MINIMO_EC" id="MINIMO_EC" class="form-control" placeholder="Puntaje minimo" type="number" required>
   			      </div>
   			      <div class="col-md-4 col-sm-12">
   			         <label for="MAXIMO" class="form-label">Maximo</label>
   			         <input name="MAXIMO_EC" id="MAXIMO_EC" class="form-control" placeholder="Puntaje maximo" type="number" required>
   			      </div>
   			      
   			      <div class="col-12">
   			         <label for="MENSAJE" class="form-label">Mensaje</label>
   			         <textarea name="MENSAJE_EC" id="MENSAJE_EC" class="form-control" placeholder="Mensaje de resultado (maximo: 1000 caracteres)"></textarea>
   			      </div>
                  <div class="col-md-6 col-sm-12">
                     <label for="IMG" class="form-label">¿Enviar imagen?</label>
   			         <div class="form-check">
								<input class="form-check-input" type="checkbox" value="1" id="IMG_EC" name="IMG_EC">
								<label class="form-check-label" for="IMG">Si</label>
							</div>
   			      </div>
   			      <div class="col-12">
                     <label for="URL_IMAGEN" class="form-label">Imagen</label>
   			         <input name="URL_IMG_EC" id="URL_IMG_EC" class="form-control" placeholder="Dirección web de la imagen" type="url" disabled required>
   			      </div>
   			   </div>
   			</div>
   			<div class="modal-footer">
   				<button type="button" class="btn btn-link" data-bs-dismiss="modal">Cerrar</button>
   				<button type="submit" class="btn btn-primary">Guardar</button>
   			</div>
			</form>
		</div>
	</div>
</div>
   		

@endsection
@section('scripts')
<script>
   var ref = "";
   $(document).ready(function(){

      $("#form-create").on("submit",function(e){
         e.preventDefault();
         store_pregunta($(this));
      })
      
      $("#form-edit").on("submit",function(e){
         e.preventDefault();
         update_pregunta($(this));
      })
      $("#form-answer-option").on("submit",function(e){
         e.preventDefault();
         store_opcion($(this));
      })
       $("#form-answer-edit-option").on("submit",function(e){
         e.preventDefault();
         update_opcion($(this));
      })
      $("#form-destroy-pregunta").on("submit",function(e){
         e.preventDefault();
         destroy_pregunta($(this));
      })
      $("#form-destroy-opcion").on("submit",function(e){
         e.preventDefault();
         destroy_respuesta($(this));
      })
      $("#form-destroy-calc").on("submit",function(e){
         e.preventDefault();
         destroy_calc($(this));
      })
      
      
      $("#bot-calc").on("submit",function(e){
         e.preventDefault();
         store_calc($(this));
      })
      $("#bot-calc-edit").on("submit",function(e){
         e.preventDefault();
         update_calc($(this));
      })
      
      $('body').on('click', '.edit', function(e) {
         open_edit($(this).attr("data-id"));   
      })
      
      $('body').on('click', '.delete', function(e) {
         open_delete($(this).attr("data-id"));   
      })
      
      $('body').on('click', '.answer', function(e) {
         $("#RESPUESTA").prop("disabled",true);
         $("#URL_IMAGEN").prop("disabled",true);
         open_create_answer($(this).attr("data-id"));   
      })
      
      $('body').on('click', '.edit_answer', function(e) {
         open_edit_answer($(this).attr("data-id"),$(this).attr("data-q"));   
      })
      
      $('body').on('click', '.delete_answer', function(e) {
         delete_answer($(this).attr("data-id"),$(this).attr("data-q"));   
      })
      
      $('body').on('click', '.answer_calcs', function(e) {
         open_create_calc($(this).attr("data-id"));   
      })
      
      $('body').on('click', '.edit_calculos', function(e) {
         open_edit_calc($(this).attr("data-id"));   
      })
      $('body').on('click', '.delete_calc', function(e) {
         delete_calc($(this).attr("data-id"));   
      })
      
      $('body').on('click','i.collapse_control', function () {
        $(this).toggleClass("rotate-180");
      })
      
      $("#pregunta-create").on("show.bs.modal",function(e){
      
         $(this).find("form").trigger("reset");
      
      })
      
      
      $("#AUTO_RESPUESTA").on("change",function(){
         
         if($(this).is(":checked")){
            $("#RESPUESTA").prop("disabled",false);
         }
         else{
            $("#RESPUESTA").prop("disabled",true);
         }
         
      })
      
      $("#OTROS").on("change",function(){
         
         if(!$(this).is(":checked")){
            $("#MAXIMO").prop("disabled",false);
            $("#MINIMO").prop("disabled",false);
            $("#MAXIMO").val("");
            $("#MINIMO").val("");
         }
         else{
            $("#MAXIMO").prop("disabled",true);
            $("#MINIMO").prop("disabled",true);
            $("#MAXIMO").val("");
            $("#MINIMO").val("");
         }
         
      })
      
      $("#IMG").on("change",function(){
         
         if($(this).is(":checked")){
            $("#URL_IMAGEN").prop("disabled",false);
         }
         else{
            $("#URL_IMAGEN").prop("disabled",true);
         }
         
      })
      
      $("#AUTO_RESPUESTA_E").on("change",function(){
         
         if($(this).is(":checked")){
            $("#RESPUESTA_E").prop("disabled",false);
         }
         else{
            $("#RESPUESTA_E").prop("disabled",true);
         }
         
      })
      
      $("#IMG_E").on("change",function(){
         
         if($(this).is(":checked")){
            $("#URL_IMAGEN_E").prop("disabled",false);
         }
         else{
            $("#URL_IMAGEN_E").prop("disabled",true);
         }
         
      })
      
      $("#IMG_EC").on("change",function(){
         
         if($(this).is(":checked")){
            $("#URL_IMG_EC").prop("disabled",false);
         }
         else{
            $("#URL_IMG_EC").prop("disabled",true);
         }
         
      })
      $("#OTROS_EC").on("change",function(){
         
         if(!$(this).is(":checked")){
            $("#MAXIMO_EC").prop("disabled",false);
            $("#MINIMO_EC").prop("disabled",false);
         }
         else{
            $("#MAXIMO_EC").prop("disabled",true);
            $("#MINIMO_EC").prop("disabled",true);
            $("#MAXIMO_EC").val("");
            $("#MINIMO_EC").val("");
         }
         
      })
   })
   
   function store_pregunta(formdata){
      
      url = $(formdata).attr("action");
      fd = new FormData();
      fd = formdata;
      $.ajax({
        url: url,
        data: fd.serialize(),
        type: 'POST',
        dataType: "json",
        beforeSend:function(data){
            $(formdata).find("button").prop('disabled', true)
        },      
        success: function(data){
            if(data.resultado == "ok"){
               cargar();
               $("#pregunta-create").modal("hide");
               notification_custom("success","Pregunta creada con exito!");
            }
            else if(data.errors){
               error_marker(data);
            }
            $(formdata).find("button").prop('disabled', false)
        },
        error: function(xhr, status, error) {

        }
     }).fail(function(data){
         notification_custom("warning","Ocurrio un error vuelva a intentarlo ");
         $(formdata).find("button").prop('disabled', false)
      })
   }
   
   function store_calc(formdata){
      
      url = $(formdata).attr("action");
      fd = new FormData();
      fd = formdata;
      $.ajax({
        url: url,
        data: fd.serialize(),
        type: 'POST',
        dataType: "json",
        beforeSend:function(data){
            $(formdata).find("button").prop('disabled', true)
        },      
        success: function(data){
            if(data.resultado == "ok"){
               cargar();
               $("#create_calc_modal").modal("hide");
               
            }
            else if(data.errors){
               error_marker(data);
            }
            $(formdata).find("button").prop('disabled', false)
        },
        error: function(xhr, status, error) {

        }
     }).fail(function(data){
         notification_custom("warning","Ocurrio un error vuelva a intentarlo ");
         $(formdata).find("button").prop('disabled', false)
      })
   }
   
   function update_pregunta(formdata){
      
      url = $(formdata).attr("action");
      fd = new FormData();
      fd = formdata;
      $.ajax({
        url: url,
        data: fd.serialize(),
        type: 'POST',
        dataType: "json",
        beforeSend:function(data){
            $(formdata).find("button").prop('disabled', true)
        },      
        success: function(data){
            if(data.resultado == "ok"){
               cargar();
               $("#pregunta-edit").modal("hide");
               notification_custom("success","Pregunta editada con exito!");
            }
            else if(data.errors){
               error_marker(data);
            }
            $(formdata).find("button").prop('disabled', false)
        },
        error: function(xhr, status, error) {
           
        }
     }).fail(function(data){
         notification_custom("warning","Ocurrio un error vuelva a intentarlo ");
         $(formdata).find("button").prop('disabled', false)
      })
   }
   
   function update_opcion(formdata){
      
      url = $(formdata).attr("action");
      fd = new FormData();
      fd = formdata;
      $.ajax({
        url: url,
        data: fd.serialize(),
        type: 'POST',
        dataType: "json",
        beforeSend:function(data){
            $(formdata).find("button").prop('disabled', true)
        },      
        success: function(data){
            if(data.resultado == "ok"){
               cargar();
               $("#edit-answer").modal("hide");
               notification_custom("success","Opcion editada con exito!");
            }
            else if(data.errors){
               error_marker(data);
            }
            $(formdata).find("button").prop('disabled', false)
        },
        error: function(xhr, status, error) {

        }
     }).fail(function(data){
         notification_custom("warning","Ocurrio un error vuelva a intentarlo ");
         $(formdata).find("button").prop('disabled', false)
      })
   }
   function update_calc(formdata){
      
      url = $(formdata).attr("action");
      fd = new FormData();
      fd = formdata;
      $.ajax({
        url: url,
        data: fd.serialize(),
        type: 'POST',
        dataType: "json",
        beforeSend:function(data){
            $(formdata).find("button").prop('disabled', true)
        },      
        success: function(data){
            if(data.resultado == "ok"){
               cargar();
               $("#edit_calc_modal").modal("hide");
               notification_custom("success","Pregunta editada con exito!");
            }
            else if(data.errors){
               error_marker(data);
            }
            $(formdata).find("button").prop('disabled', false)
        },
        error: function(xhr, status, error) {
           
        }
     }).fail(function(data){
         notification_custom("warning","Ocurrio un error vuelva a intentarlo ");
         $(formdata).find("button").prop('disabled', false)
      })
   }
   
   function open_create_calc(){
      $("#create_calc_modal").modal("show");
      $("#create_calc_modal").find("form").trigger("reset");
      $("#IMG").attr('checked', false).triggerHandler('change')
   }
   
   function open_edit_calc(id){
      
      url = "{{route('bot.calc_edit',$bot->ID_ENCUESTA)}}"

      $.ajax({
        url: url,
        data: {id_p:id},
        type: 'get',
        dataType: "json",
        beforeSend:function(data){
            
        },      
        success: function(data){
            $("#edit_calc_modal").find("form").trigger("reset");
            if(data.ID_ENCUESTA){
               $.each(data,function(key,value){
                  if(!$("#"+key+"_EC").is(":checkbox")){
                      $("#"+key+"_EC").val(value);
                  }
                  else{
                     if(value == 1){
                        $("#"+key+"_EC").attr('checked', true).triggerHandler('change')
                     }
                     else if (value == 0 && $("#"+key+"_EC").is(":checkbox")){
                     console.log(key)
                        $("#"+key+"_EC").attr('checked', false).triggerHandler('change')
                     }
                     else if(value != 0){
                        $("#"+key+"_EC").val(value)
                     }
                  }

               })
               $("#edit_calc_modal").modal("show");
               
            }
            else{
               notification_custom("warning","No se encontrarón datos");
            }
        }
      })
      
   }
   
   
   function open_edit(id){
      
      url = "{{route('bot.pregunta_edit',$bot->ID_ENCUESTA)}}"

      $.ajax({
        url: url,
        data: {id_p:id},
        type: 'get',
        dataType: "json",
        beforeSend:function(data){
            
        },      
        success: function(data){
            $("#pregunta-edit").find("form").trigger("reset");
            if(data.ID_ENCUESTA){
               $.each(data,function(key,value){
                  $("#"+key+"_E").val(value);
               })
               $("#pregunta-edit").modal("show");
            }
            else{
               notification_custom("warning","No se encontrarón datos");
            }
        }
      })
      
   }
   
   function open_create_answer(id){
      
      $.ajax({
        url: "{{route('bot.opcion',$bot->ID_ENCUESTA)}}",
        data: {id_p:id},
        type: 'get',
        dataType: "json",
        beforeSend:function(data){
             $('#CLAVE').html("");
        },      
        success: function(data){
            $("#add-answer").find("form").trigger("reset");
            $("#AUTO_RESPUESTA").attr('checked', false).triggerHandler('change')
            if(data.opciones){
               $("#ID_PREGUNTA_A").val(id);
               $.each(data.opciones,function(key,value){
               
                  $('#CLAVE').append($('<option>', {
                      value: value,
                      text: value.charAt(0).toUpperCase() + value.slice(1)
                  }));
               
               })
            
            }
            
            $("#add-answer").modal("show");
        }
      })
      
   }
   
   function open_edit_answer(id_p,id_q){
      
      $.ajax({
        url: "{{route('bot.opcion_edit',$bot->ID_ENCUESTA)}}",
        data: {id_p:id_p,id_q:id_q},
        type: 'get',
        dataType: "json",
        beforeSend:function(data){
             $('#CLAVE_E').html("");
        },      
        success: function(data){
            $("#edit-answer").find("form").trigger("reset");
            
            if(data.ID_OPCIONES){
              
               $.each(data.lista_claves,function(key,value){
               
                  $('#CLAVE_E').append($('<option>', {
                      value: value,
                      text: value.charAt(0).toUpperCase() + value.slice(1)
                  }));
               
               })
               $.each(data,function(key,value){
                  
                   if(!$("#"+key+"_E").is(":checkbox") && !$("#"+key+"_E").is("select")){
                      $("#"+key+"_E").val(value);
                   }
                   else{
                     if(value == 1){
                        $("#"+key+"_E").attr('checked', true).triggerHandler('change')
                     }
                     else if (value == 0 && $("#"+key+"_E").is(":checkbox")){
                        $("#"+key+"_E").attr('checked', false).triggerHandler('change')
                     }
                     else if(value != 0){
                        $("#"+key+"_E").val(value)
                     }
                   }
               })
               $("#ID_PREGUNTA_E_A").val(id_p);
               $("#ID_OPCIONES_E").val(id_q);
            }
            if(data.ID_ENCUESTA){
               $("#edit-answer").modal("show");
            }
            else{
               notification_custom("warning","No se encontrarón datos");
            }

        }
      })
      
   }
   
   function store_opcion(formdata){
      
      url = $(formdata).attr("action");
      fd = new FormData();
      fd = formdata;
      $.ajax({
        url: url,
        data: fd.serialize(),
        type: 'POST',
        dataType: "json",
        beforeSend:function(data){
            $(formdata).find("button").prop('disabled', true)
        },      
        success: function(data){
            if(data.resultado == "ok"){
               cargar();
               $("#add-answer").modal("hide");
               notification_custom("success","Opcion guardada con exito");
            }
            else if(data.errors){
               error_marker(data);
            }
            $(formdata).find("button").prop('disabled', false)
        },
        error: function(xhr, status, error) {
          
        }
     })
     .fail(function(data){
         notification_custom("warning","Ocurrio un error vuelva a intentarlo ");
         $(formdata).find("button").prop('disabled', false)
      })
     ;
   }
   
   
   function cargar(){
      
      $.ajax({
        url: window.location.href,
        type: 'GET',
        beforeSend:function(data){
            
        },      
        success: function(data){
            $(".preguntas-body").html(data);
        }
     });
      
   }
   
   function open_delete(id){
      
      $("#ID_PREGUNTA_EL").val(id);
      $("#destroy-question").modal("show");
      
   }
   
   
   function destroy_pregunta(formdata){
      
      url = $(formdata).attr("action");
      fd = new FormData();
      fd = formdata;
      $.ajax({
        url: url,
        data: fd.serialize(),
        type: 'POST',
        dataType: "json",
        beforeSend:function(data){
            $(formdata).find("button").prop('disabled', true)
        },      
        success: function(data){
            if(data.resultado == "ok"){
               cargar();
               $("#destroy-question").modal("hide");
               notification_custom("success","Pregunta eliminada con exito");
            }
            else if(data.errors){
               error_marker(data);
            }
            $(formdata).find("button").prop('disabled', false)
        },
        error: function(xhr, status, error) {
           
        }
     }).fail(function(data){
         notification_custom("warning","Ocurrio un error vuelva a intentarlo ");
         $(formdata).find("button").prop('disabled', false)
      })
      
   }
   
   function delete_answer(id_p,id_q){
      
      $("#ID_PREGUNTA_A_EL").val(id_p);
      $("#ID_OPCIONES_A_EL").val(id_q);
      $("#destroy-answer").modal("show");
      
   }
   
   function delete_calc(id){
      
      $("#ID_RESULTADO_DES").val(id);
      $("#destroy-calc").modal("show");
      
   }
   
   function destroy_respuesta(formdata){
      
      url = $(formdata).attr("action");
      fd = new FormData();
      fd = formdata;
      $.ajax({
        url: url,
        data: fd.serialize(),
        type: 'POST',
        dataType: "json",
        beforeSend:function(data){
            $(formdata).find("button").prop('disabled', true)
        },      
        success: function(data){
            if(data.resultado == "ok"){
               cargar();
               $("#destroy-answer").modal("hide");
               notification_custom("success","Opcion eliminada con exito");
            }
            else if(data.errors){
               error_marker(data);
            }
            $(formdata).find("button").prop('disabled', false)
        },
        error: function(xhr, status, error) {
          
        }
     }).fail(function(data){
         notification_custom("warning","Ocurrio un error vuelva a intentarlo ");
         $(formdata).find("button").prop('disabled', false)
      })
      
   }
   
   function destroy_calc(formdata){
      
      url = $(formdata).attr("action");
      fd = new FormData();
      fd = formdata;
      $.ajax({
        url: url,
        data: fd.serialize(),
        type: 'POST',
        dataType: "json",
        beforeSend:function(data){
            $(formdata).find("button").prop('disabled', true)
        },      
        success: function(data){
            if(data.resultado == "ok"){
               cargar();
               $("#destroy-calc").modal("hide");
               notification_custom("success","Opcion eliminada con exito");
            }
            else if(data.errors){
               error_marker(data);
            }
            $(formdata).find("button").prop('disabled', false)
        },
        error: function(xhr, status, error) {
          
        }
     }).fail(function(data){
         notification_custom("warning","Ocurrio un error vuelva a intentarlo ");
         $(formdata).find("button").prop('disabled', false)
      })
      
   }
   
</script>
@endsection