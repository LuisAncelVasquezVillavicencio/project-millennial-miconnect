<div class="col-md-12 col-sm-12 col-xs-12">
	<div class="card border-success border-bottom border-3 border-0">
		<div class="card-body">
		   <div class="d-flex" style="justify-content:space-between;align-items:center">
		      <h5 class="card-title text-success p-0" >Resultados calculados</h5>
		      <i data-bs-toggle="collapse" aria-expanded="true" aria-controls="collapsethis" class="bx bx-chevron-up collapse_control" style="font-size:20pt" data-bs-target="#collapsethis"></i>
		   </div>
			<div class="collapse show" id="collapsethis">
            <p class="card-text">
               @if(count($resultado) > 0)
                  @foreach($resultado as $calculo)
                  <div class="d-flex pb-2" style="justify-content:space-between;  align-item:center">
                     @if($calculo->OTROS != 1)
                     <span class="">{{$calculo->MINIMO}} puntos - {{$calculo->MAXIMO}} puntos</span>
                     @else
                     <span class="">Fuera de rango</span>
                     @endif
                     <div>
                        <button data-id="{{$calculo->ID_RESULTADO}}" class="btn btn-success btn-sm bx bxs-cog edit_calculos"></button>
                        <button data-id="{{$calculo->ID_RESULTADO}}" class="btn btn-inverse-success btn-sm bx bxs-trash delete_calc"></button>
                     </div>
                  </div>
                  @endforeach
               @else
                  No existen calculos configurados.
               @endif
            </p>
         </div>
			<hr>
			<div class="d-flex align-items-center gap-2">
				<button data-id="{{$bot->ID_ENCUESTA}}" class="answer_calcs btn btn-inverse-success">
			      <i class='bx bx-star'></i>Agregar calculo
			   </button>
			</div>
		</div>
	</div>
</div>
@if(count($bot->pregunta) > 0)
   @foreach($bot->pregunta as $linea)
      <div class="col-md-12 col-sm-12 col-xs-12">
   		<div class="card border-primary border-bottom border-3 border-0">
   			<div class="card-body">
   			   <div class="d-flex" style="justify-content:space-between;align-items:center">
   				   <h5 class="card-title text-primary p-0">{{$linea->PREGUNTA}}</h5>
   				   <i data-bs-toggle="collapse" aria-expanded="true" aria-controls="collapse-{{$linea->ID_PREGUNTA}}" class="bx bx-chevron-down collapse_control" style="font-size:20pt;color:#008CFF !important" data-bs-target=".collapse-{{$linea->ID_PREGUNTA}}"></i>
               </div>
               <div class="collapse show collapse-{{$linea->ID_PREGUNTA}}">
                  <p class="card-text">
                     @if(isset($linea->respuestas))
                        @foreach($linea->respuestas as $opcion)
                        <div class="d-flex pb-2" style="justify-content:space-between;  align-item:center">
                           <span class="">{{$opcion->OPCION}}</span>
                           <div>
                              <button data-id="{{$linea->ID_PREGUNTA}}" data-q="{{$opcion->ID_OPCIONES}}" class="btn btn-primary btn-sm bx bxs-cog edit_answer"></button>
                              <button data-id="{{$linea->ID_PREGUNTA}}" data-q="{{$opcion->ID_OPCIONES}}" class="btn btn-inverse-primary btn-sm bx bxs-trash delete_answer"></button>
                           </div>
                        </div>
                        @endforeach
                     @else
                        No existen respuestas configuradas.
                     @endif
                  </p>
               </div>
   				<hr>
   				<div class="d-flex align-items-center gap-2">
   				   <button data-id="{{$linea->ID_PREGUNTA}}" class="delete btn btn-inverse-primary">
   					   <i class='bx bx-trash'></i>Eliminar
   					</button>
   				   <button data-id="{{$linea->ID_PREGUNTA}}" class="edit btn btn-inverse-primary">
   					   <i class='bx bx-pencil'></i>Editar
   					</button>
   					<button data-id="{{$linea->ID_PREGUNTA}}" class="answer btn btn-inverse-primary">
					      <i class='bx bx-star'></i>Agregar opción
					   </button>
   				</div>
   			</div>
   		</div>
   	</div>
   @endforeach
@else
   <h3>No existen preguntas configuradas</h3>
@endif