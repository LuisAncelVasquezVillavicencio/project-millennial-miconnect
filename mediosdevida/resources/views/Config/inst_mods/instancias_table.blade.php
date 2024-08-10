<table class="table mb-0">
	<thead>
		<tr>
			<th scope="col">Instancia</th>
			<th>Estado</th>
			<th>Opciones</th>
		</tr>
	</thead>
	<tbody>
	   @foreach($instancias as $item)
		<tr>
			<td class="w-50">{{$item->PROPIETARIO}}</td>
			<td>{{($item->ESTADO == "authenticated" ) ? "Conectado" : "Desconectado"}}</td>
			<td>
			   @if($item->ESTADO == "got qr code")
			   <button class="btn btn-primary get_state" id="get_state" data-num="{{$item->NUMERO}}" data-name="{{$item->PROPIETARIO}}" data-id="{{$item->ID_WASSAP}}">Conectar instancia</button>
			   @else
			   <button class="btn btn-danger logout_state" id="logout_state" data-name="{{$item->PROPIETARIO}}" data-id="{{$item->ID_WASSAP}}">Desconectar instancia</button>
			   @endif
			  
			</td>
		</tr>
		@endforeach
	</tbody>
</table>