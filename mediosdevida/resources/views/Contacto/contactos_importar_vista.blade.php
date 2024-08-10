@if(isset($error))
<div class="alert alert-danger" role="alert">
  {{$error}}
</div>
@endif
@if(isset($lista_error))
   <div class="alert alert-danger" role="alert">
     @foreach($lista_error as $error)
        <small>{{$error}}</small><br>
     @endforeach
   </div>
@endif
@if(isset($Incorrecto))
   @if(count($mensajesError)>0)
      <div class="alert alert-danger" role="alert">
        Ocurrieron los siguientes errores<br>
        @foreach($mensajesError as $error)
        <small>{{$error}}</small><br>
        @endforeach
      </div>
   @elseif (count($Incorrecto)>0)
      <div class="alert alert-danger" role="alert">
        Los siguientes numeros no se pudieron insertar:<br>
        @foreach($Incorrecto as $error)
        <small>{{$error}}</small><br>
        @endforeach
      </div>
   @else
   <script>
      $.growl.notice({ title: "OK", message: "{{$Correcto}}"});
      window.location.href = "{{route('contactos')}}";
      $(".Guardar").hide();
   </script>
   @endif
@endif
@if(isset($csv_data))
   @if(isset($validado))
      @if($validado)
         <script type="text/javascript">
            $(".Guardar").show();
         </script>
         
         <div class="row form-group">
            <div class="col-md-12">
               <div class="table-responsive">
                  <table class="table table-bordered">
                     <tr>
                        <th>Pais</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th >Numero</th>
                        @if($grupo_busqueda->NOM_GRUPO_1 != "")
                        <th>{{$grupo_busqueda->NOM_GRUPO_1}}</th>
                        @endif
                        @if($grupo_busqueda->NOM_GRUPO_2 != "")
                        <th>{{$grupo_busqueda->NOM_GRUPO_2}}</th>
                        @endif
                        @if($grupo_busqueda->NOM_GRUPO_3 != "")
                        <th>{{$grupo_busqueda->NOM_GRUPO_3}}</th>
                        @endif
                        @if($grupo_busqueda->NOM_GRUPO_4 != "")
                        <th>{{$grupo_busqueda->NOM_GRUPO_4}}</th>
                        @endif
                        @if($grupo_busqueda->NOM_GRUPO_5 != "")
                        <th>{{$grupo_busqueda->NOM_GRUPO_5}}</th>
                        @endif
                     </tr>
                     @php ($num = 0)
                     @foreach($csv_data as $linea)
                     <tr>
                        <td>{!!$linea["PAIS"]!!}</td>
                        <td>{!!$linea["NOMBRE_CONTACTO"]!!}</td>
                        <td>{!!$linea["APELLIDO_CONTACTO"]!!}</td>
                        <td>{!!$linea["NUMERO"]!!}</td>
                         @if($grupo_busqueda->NOM_GRUPO_1 != "")
                        <td>{!!$linea["VAL_GRUPO1"]!!}</td>
                         @endif
                         @if($grupo_busqueda->NOM_GRUPO_2 != "")
                        <td>{!!$linea["VAL_GRUPO2"]!!}</td>
                         @endif
                        @if($grupo_busqueda->NOM_GRUPO_3 != "")
                        <td>{!!$linea["VAL_GRUPO3"]!!}</td>
                         @endif
                        @if($grupo_busqueda->NOM_GRUPO_4 != "")
                        <td>{!!$linea["VAL_GRUPO4"]!!}</td>
                         @endif
                        @if($grupo_busqueda->NOM_GRUPO_5 != "")
                        <td>{!!$linea["VAL_GRUPO5"]!!}</td>
                         @endif
                     </tr>
                     @php ($num++)
                     @endforeach
                  </table>
                  <div class="paginacion">
                  	{{$csv_data->links()}}	      
                  </div>
         
               </div>
            </div>
         </div>
      @else
         <script type="text/javascript">
            $(".Guardar").hide();
         </script>
      @endif
   @endif
@else
@endif