<table class="table card-table border table-vcenter text-nowrap ">
	<thead>
	   <tr>
   	   @if(isset($grupo_data))
   	   <th>CÓDIGO PAÍS</th>
   	   <th>NÚMERO CELULAR</th>
   	   <th>NOMBRE</th>
   	   <th>APELLIDO</th>
      	   @if($grupo_data->NOM_GRUPO_1 != "")
      	   <th>{{$grupo_data->NOM_GRUPO_1}}</th>
      	   @endif
      	   @if($grupo_data->NOM_GRUPO_2 != "")
      	   <th>{{$grupo_data->NOM_GRUPO_2}}</th>
      	   @endif
      	   @if($grupo_data->NOM_GRUPO_3 != "")
      	   <th>{{$grupo_data->NOM_GRUPO_3}}</th>btn_descarga
      	   @endif
      	   @if($grupo_data->NOM_GRUPO_4 != "")
      	   <th>{{$grupo_data->NOM_GRUPO_4}}</th>
      	   @endif
      	   @if($grupo_data->NOM_GRUPO_5 != "")
      	   <th>{{$grupo_data->NOM_GRUPO_5}}</th>
      	   @endif
   	   @endif
	   </tr>
	</thead>
   @if(isset($contactos))
	<tbody class="table_content">
	   @foreach($contactos as $linea)
	      <tr>
	         <td>{{$linea->COD_TEL_PAIS}}</td>
	         <td>{{$linea->NUMERO}}</td>
	         <td>{{$linea->NOMBRE}}</td>
	         <td>{{$linea->APELLIDO}}</td>
   	      @if($grupo_data->NOM_GRUPO_1 != "")
      	   <th>{{$linea->VAL_GRUPO1}}</th>
      	   @endif
      	   @if($grupo_data->NOM_GRUPO_2 != "")
      	   <th>{{$linea->VAL_GRUPO2}}</th>
      	   @endif
      	   @if($grupo_data->NOM_GRUPO_3 != "")
      	   <th>{{$linea->VAL_GRUPO3}}</th>
      	   @endif
      	   @if($grupo_data->NOM_GRUPO_4 != "")
      	   <th>{{$linea->VAL_GRUPO4}}</th>
      	   @endif
      	   @if($grupo_data->NOM_GRUPO_5 != "")
      	   <th>{{$linea->VAL_GRUPO5}}</th>
      	   @endif
	      </tr>
	   @endforeach
	</tbody>
	@endif
</table>