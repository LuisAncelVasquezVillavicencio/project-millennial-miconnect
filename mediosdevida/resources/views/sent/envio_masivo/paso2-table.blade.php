<div class="totales d-flex w-100">
   <label class=" ms-auto mb-3">
      Total de contactos: {{$list_contactos_count}}
   </label>
</div>
<div class="table-responsive">
   <table class="table card-table border table-vcenter text-nowrap ">
      <thead>
         <th>Nombre</th>
         <th>Nro teléfono</th>
         @if(isset(array_keys($data_filtros)[0]))
         @if (!($data_filtros["GRUPO1"]["cabecera"] == ""))
         <th>{{ $data_filtros["GRUPO1"]["cabecera"] }}</th>
         @endif
         @endif
         @if (!($data_filtros["GRUPO2"]["cabecera"] == ""))
         @if (!(array_keys($data_filtros)[1] === ''))
         <th>{{ $data_filtros["GRUPO2"]["cabecera"]}}</th>
         @endif
         @endif
         
         @if (!($data_filtros["GRUPO3"]["cabecera"] == ""))
         @if (!(array_keys($data_filtros)[2] === ''))
         <th>{{ $data_filtros["GRUPO3"]["cabecera"] }}</th>
         @endif
         @endif
         
         @if (!($data_filtros["GRUPO4"]["cabecera"] == ""))
         @if (!(array_keys($data_filtros)[3] === ''))
         <th>{{ $data_filtros["GRUPO4"]["cabecera"] }}</th>
         @endif
         @endif
         
         @if (!($data_filtros["GRUPO5"]["cabecera"] == ""))
         @if (!(array_keys($data_filtros)[4] === ''))
         <th>{{ $data_filtros["GRUPO5"]["cabecera"] }}</th>
         @endif
         @endif
      </thead>
      <tbody class="table_content">
         @isset($list_contactos_paginada)
         @forelse($list_contactos_paginada as $item )
         <tr>
            <td scope="row">
            	<div style="">
            		{{ $item->NOMBRE .' '.$item->APELLIDO }}
            	</div>
            	
            	
            </td>
            <td>{{ $item->NUMERO }}</td>
         
         @if (!($disable_filtros))
         @if(isset(array_keys($data_filtros)[0]))
         	@if (!($data_filtros["GRUPO1"]["cabecera"] == ""))
         	<td>{{ $item->VAL_GRUPO1 }}</td>
         	@endif
         @endif
         
         @if(isset(array_keys($data_filtros)[1]))
         	@if (!($data_filtros["GRUPO2"]["cabecera"] == ""))
         	<td>{{ $item->VAL_GRUPO2 }}</td>
         	@endif
         @endif
         
         @if(isset(array_keys($data_filtros)[2]))
         	@if (!($data_filtros["GRUPO3"]["cabecera"] == ""))
         	<td>{{ $item->VAL_GRUPO3 }}</td>
         	@endif
         @endif
         
         @if(isset(array_keys($data_filtros)[3]))
         	@if (!($data_filtros["GRUPO4"]["cabecera"] == ""))
         	<td>{{ $item->VAL_GRUPO4 }}</td>
         	@endif
         @endif
         
         @if(isset(array_keys($data_filtros)[4]))
         	@if (!($data_filtros["GRUPO5"]["cabecera"] == ""))
         	<td>{{ $item->VAL_GRUPO5 }}</td>
         	@endif
         @endif
         @endif
         
         </tr>
         @empty
         <tr>
          <td style="text-align:center;" colspan="100" class="text-warning">No se encontraron resultados</td>
         </tr>
         @endforelse
         @endisset
      </tbody>
   </table>
</div>
<div class="row d-flex mt-3">
 <div class="paginado me-auto">
    {{ $list_contactos_paginada->links() }}
 </div>
</div>