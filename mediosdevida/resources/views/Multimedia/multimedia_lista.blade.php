@if(count($items) == 0)
<div class=col-md-12>
   <span class="text-primary">No hay archivos para mostrar</span>
</div>
@endif
@foreach($items as $item)
<div class="file-item d-flex">
   <div class="file-icon">
      <a class="visual-button" href="javascript:;" data-type="{{$item->TIPO}}" data-id="{{$item->URL}}">
         @if($item->TIPO == "imagen")
         <i class='bx bxs-file-image'></i>
         @elseif($item->TIPO == "video")
         <i class='bx bx-movie-play'></i>
         @elseif($item->TIPO == "documento")
            @if($item->FORMATO_ARCHIVO == "pdf")
               <i class='bx bxs-file-pdf text-danger'></i>
            @elseif($item->FORMATO_ARCHIVO == "doc" || $item->FORMATO_ARCHIVO == "docx")
               <i class='bx bxs-file-doc text-primary'></i>
            @elseif($item->FORMATO_ARCHIVO == "xls" || $item->FORMATO_ARCHIVO == "xlsx")
               <i class='bx bxs-file-blank text-success'></i>
            @else
               <i class='bx bx-file-blank' ></i>
            @endif
         @endif
      </a>
   </div>
   <div class="file-name">
      <span class="copy-btn" data-id="{{$item->URL}}">{{$item->NOMBRE_ORIGINAL}} </span>
   </div>
   <div class="file-config ms-auto">
      <div class="btn-group">
			<button type="button" class="btn btn-primary btn-sm dropdown-toggle  " data-bs-toggle="dropdown"><i class="bx bx-cog"></i></button>
			</button>
			<div class="dropdown-menu dropdown-menu-right dropdown-menu-sm-end">
			   <a class="dropdown-item visual-button" href="javascript:;" data-type="{{$item->TIPO}}" data-id="{{$item->URL}}" >Ver</a>
			   <a class="dropdown-item copy-btn" href="javascript:;" data-id="{{$item->URL}}">Copiar link</a>
			   <a class="dropdown-item elim-btn" href="javascript:;" data-archivo="{{$item->ID_MULTIMEDIA}}">Eliminar</a>
			</div>
		</div>
   </div>
</div>
@endforeach