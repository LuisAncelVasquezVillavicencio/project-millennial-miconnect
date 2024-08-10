@extends('template.app')
@section('title', 'Instancias')
@section('linksstyle')
@endsection
@section('content')
<div class="page-breadcrumb d-flex align-items-center">
   <div class="bread-crumb-custom w-100 d-flex align-items-center">
   	<div class="breadcrumb-title pe-3">Configuración</div>
   	<div class="ps-3 mb-0 mb-md-0">
   		<nav aria-label="breadcrumb">
   			<ol class="breadcrumb mb-0 p-0">
   				<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
   				</li>
   				<li class="breadcrumb-item active" aria-current="page">Instancias</li>
   			</ol>
   		</nav>
   	</div>
	</div>
</div>
<div class="row mt-3" >
	<div class="card">
   	<div class="card-body table_cont">
   		@include("Config.inst_mods.instancias_table")
   	</div>
   </div>
</div>

<div class="modal fade" id="qr_modal_conf" tabindex="-1" aria-labelledby="qr_modal_conf" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body d-flex flex-column">
         <button type="button" class="btn-close mb-2" data-bs-dismiss="modal" aria-label="Close"></button>
         <div class="row ps-3 pe-3 mb-2 title_modal_i">Instancia: <b></b> </div>
         <div class="qr_conect_body" style="display: flex;align-content: center;justify-content: center;min-height:300px"></div>
      </div>
    </div>
  </div>
</div>

@endsection
@section('scripts')
<script>
ask_return = false;
unique = 0
last_unique = 0;

function load_partial_table(){
   
   $.ajax({
         url: "{{route('config.instancias')}}",
         method:"get",
         beforeSend:function(data){
            $(".table_cont").html("");
         }
      })
      .done(function(data){
        $(".table_cont").html(data);
      })
   
}

$(document).ready(function(){
   
   $("body").on("click",".get_state",function(e){
      $(".qr_conect_body").html("");
      $("#qr_modal_conf").modal("show");
      $(".title_modal_i b").html($(this).attr("data-name"));
      last_qr = ""
      ask_return = false;
      get = $(this).attr("data-id");
      
      unique = Math.floor(Math.random() * 100000);
      last_unique = unique
      loop($(this).attr("data-id"),unique)
   
   })
   
   $("body").on("click",".logout_state",function(e){
   
      logingout_special($(this).attr("data-id"))
   
   })
   
   $('#qr_modal_conf').on('hidden.bs.modal', function () {
     ask_return = true;
     unique = 0;
     load_partial_table()
   });
   
})

function logingout_special(id_w_qr){
   var valor = false;
   var r = confirm("¿Desea cerrar esta conexión? \nPuede tomar unos minutos en desconectarse por completo");
   if (r == true) {
   $.ajaxSetup({
      headers:{
         "X-CSRF-TOKEN":$('meta[name="_token"]').attr('content')
      }
      })
      $.ajax({
         url: "{{route('logout_whats')}}",
         method:"POST",
         dataType: "json",
         data:{
            id: id_w_qr
         },
         beforeSend:function(data){
         }
      })
      .done(function(data){
        if(data["Estado"]){

           notification_custom("success","Se cerro sesión con exito");

        }
        else{
           notification_custom("warning","No se pudo cerrar sesión");

        }
        
        load_partial_table()
      })
   }
   

}

async function loop(call,unique_id){
   

   while (!ask_return) {
      if(unique_id != last_unique){
         console.warn("dead id:",unique_id)
         break;
      }
      re_data = await call_modal(call)
      if(re_data.hasOwnProperty("qr")){
         
         if(re_data.Estado === false){
            if(last_qr != re_data.qr)
            $(".qr_conect_body").html("");
            $(".qr_conect_body").append("<img id='qr_const_re' src='"+re_data.qr+"' />")
         }
      }
      else{
         
         if(re_data.Estado == true){
            $(".qr_conect_body").html("");
            $(".qr_conect_body").append(re_data.Mensaje)
            notification_custom("success","Instancia conectada con exito");

         }
         else if(re_data.Estado === false){
            
            if(re_data.hasOwnProperty("Mensaje")){
               $(".qr_conect_body").html("");
               $(".qr_conect_body").append(re_data.Mensaje)
               notification_custom("warning","No se pudo obtener instancia, espere unos momentos mientras reconectamos");
            }
            
         }
         
      }
      
      await delay(10000)
  }

}

async function call_modal(call){
   
   
   c = false;
   
   $.ajaxSetup({
      headers:{
         "X-CSRF-TOKEN":$('meta[name="_token"]').attr('content')
      }
   })
   b = await $.ajax({
      url: "{{route('estado_uno')}}",
      method:"POST",
      dataType: "json",
      data:{
         id: call
      },beforeSend:function(){
          $(".qr_conect_body").html("");
           $(".qr_conect_body").append("<div class='h-auto mt-auto mb-auto' ><h5><i class='bx bx-circle bx-spin text-primary'></i><span>Cargando</span></h5></div>")
      }
   }).fail(function(data){
      
      retorno = {Estado : false, Mensaje: "Ocurrio un error"}
      
   })
   
   return b;
}

const delay = ms => new Promise(res => setTimeout(res, ms));
</script>
@endsection