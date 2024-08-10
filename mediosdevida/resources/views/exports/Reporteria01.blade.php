<table class="table mb-0 mt-0 border"> 
<thead class="primary text-white">
	<tr>
		<th style="background-color:#02529a; color:#FFFFFF; height:20px;width:40px" align="center"> Número </th>
		<th style="background-color:#02529a; color:#FFFFFF; height:20px; width:40px" align="center"> Pregunta </th>
		<th style="background-color:#02529a; color:#FFFFFF; height:20px; width:40px" align="center"> Opción contenido </th>
		<th style="background-color:#02529a; color:#FFFFFF; height:20px; width:40px" align="center"> Opción escogida </th>
		<th style="background-color:#02529a; color:#FFFFFF; height:20px; width:40px" align="center"> Peso </th>
		<th style="background-color:#02529a; color:#FFFFFF; height:20px; width:40px" align="center"> Fecha registro </th>
	</tr>
</thead>
<tbody>
	@foreach($reporteria1 as $item)
	<tr>
		<td align="center">{{$item->NUMERO}}</td>
		<td align="center">{{$item->PREGUNTA}}</td>
		<td align="center">{{$item->OPCION_CONTENIDO}}</td>
		<td align="center">{{$item->OPCION_ESCOJIDA}}</td>
		<td align="center">{{$item->PESO}}</td>
		<td align="center">{{$item->created_at}}</td>
	</tr>
	@endforeach
</tbody>
</table>