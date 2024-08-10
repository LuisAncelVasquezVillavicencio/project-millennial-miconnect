<table class="table mb-0 mt-0 border"> 
<thead class="primary text-white">
	<tr>
		<th style="background-color:#02529a; color:#FFFFFF; height:20px; width:40px" align="center"> Número </th>
		<th style="background-color:#02529a; color:#FFFFFF; height:20px;width:40px" align="center"> Título </th>
		<th style="background-color:#02529a; color:#FFFFFF; height:20px; width:40px" align="center"> Rango </th>
		<th style="background-color:#02529a; color:#FFFFFF; height:20px; width:40px" align="center"> Puntaje resultado </th>
	</tr>
</thead>
<tbody>
	@foreach($reporteria2 as $item)
	<tr>
		<td align="center">{{$item->NUMERO}}</td>
		<td align="center">{{$item->TITULO_ENCUESTA}}</td>
		<td align="center">{{$item->RESPUESTA}}</td>
		<td align="center">{{$item->PUNTAJE_RESULTADO}}</td>
	</tr>
	@endforeach
</tbody>
</table>