@extends('template.app')
@section('title', 'Reporteria')
@section('content')
<div class="page-breadcrumb d-flex align-items-center">
   <div class="bread-crumb-custom w-100 d-flex align-items-center">
   	<div class="breadcrumb-title pe-3">Reporteria</div>
   	<div class="ps-3 mb-0 mb-md-0">
   		<nav aria-label="breadcrumb">
   			<ol class="breadcrumb mb-0 p-0">
   				<li class="breadcrumb-item"><a href="{{route('bot.pregunta',$id)}}"><i class="bx bx-home-alt"></i></a>
   				</li>
   				<li class="breadcrumb-item active" aria-current="page">Descargas</li>
   			</ol>
   		</nav>
   	</div>
	</div>
	<div class="ms-auto">
		<div class="btn-group">
			<a href="{{route('bot.pregunta',$id)}}" class="btn btn-primary">Volver</a>
		</div>
	</div>
</div>
<hr class="border-top" />
<div class="row row-cols-1 row-cols-md-1 row-cols-lg-2 row-cols-xl-2">
   <div class="col">
      <div class="card radius-10 border-start border-0 border-3 border-info">
         <div class="card-body">
               <div class="d-flex align-items-center">
                  <div>
                     <p class="mb-0 text-secondary">Total Cerrado</p>
                     <h4 class="my-1 text-info">{{$count_total_cerrado}}</h4>
                  </div>
                  <div class="widgets-icons-2 rounded-circle bg-gradient-scooter text-white ms-auto"><i class="bx bx-bot"></i>
                  </div>
               </div>
               <a href="{{route('bot.reporteria_02',$id)}}" class="btn btn-primary">Descargar</a>
         </div>
      </div>
   </div>
   <div class="col">
      <div class="card radius-10 border-start border-0 border-3 border-info">
         <div class="card-body">
               <div class="d-flex align-items-center">
                  <div>
                     <p class="mb-0 text-secondary">Total Abierto</p>
                     <h4 class="my-1 text-info">{{$count_total_abierto}}</h4>
                  </div>
                  <div class="widgets-icons-2 rounded-circle bg-gradient-scooter text-white ms-auto"><i class='bx bx-bot' ></i>
                  </div>
               </div>
               <a href="{{route('bot.reporteria_03',$id)}}" class="btn btn-primary">Descargar</a>
         </div>
      </div>
   </div>         
</div>

<div class="card radius-10">
   <div class="card-body">
         <div class="d-flex align-items-center">
            <div>
               <h6 class="mb-0"></h6>
            </div>
            <div class="dropdown ms-auto">
               <a  href="{{route('bot.reporteria_01',$id)}}" class="btn btn-primary">Descargar</a>
            </div>
         </div><br>
         <div class="table-responsive">
            <table class="table align-middle mb-0">
               <thead class="table-light">
                  <tr>
                     <th>Número</th>
                     <th>Pregunta</th>
                     <th>Opción contenido</th>
                     <th>Opción escogida</th>
                     <th>Peso</th>
                     <th>Fecha registro</th>
                  </tr>
               </thead>
               <tbody>
                  @if(count($listado_resultados)>0)
                  @foreach($listado_resultados as $item)
                  <tr>
                     <td>{{$item->NUMERO}}</td>
                     <td>{{$item->PREGUNTA}}</td>
                     <td>{{$item->OPCION_CONTENIDO}}</td>
                     <td>{{$item->OPCION_ESCOJIDA}}</td>
                     <td>{{$item->PESO}}</td>
                     <td>{{$item->created_at}}</td>
                  </tr>
                  @endforeach
                  @else
                  <td colspan="6" class="text-center"> No se encontraron datos.</td>
                  @endif
               </tbody>
            </table>
         </div>
         <br>
         <div class="col-md-12 col-lg-12 col-xl-12"> {{ $listado_resultados->links() }}</div>
   </div>
</div>  		
@endsection
@section('scripts')

@endsection