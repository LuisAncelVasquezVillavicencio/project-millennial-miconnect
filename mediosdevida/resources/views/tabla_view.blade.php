<style type="text/css">
    .pagination {
    display: -ms-flexbox;
    flex-wrap: wrap;
    display: flex;
    padding-left: 0;
    list-style: none;
    border-radius: 0.25rem;
}
    th {
    background-color: #28a4c9;
    color: white;
} 
</style>
<div class="row" id="generado">
    @if(count($mensajes_recibidos)>0)
    <div class="col-md-12"> 
        <div class="row form-group">
            <div class="col-md-12">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th style="width:5%;"> Id</th>
                            <th style="width:15%; max-width:15%">Num. Origen</th>
                            <th style="width:15%; max-width:15%">Num. Destino</th>
                            <th style="width:15%; max-width:15%">De:</th>
                            <th style="width:15%; max-width:15%">Nombre chat (contacto):</th>
                            <th style="width:10%;">Enviado/respuesta</th>
                            <th> Mensaje</th>
                        </tr>
                    </thead>
                    <tbody>
                         @foreach($mensajes_recibidos as $linea)
                          <tr>
                              <td> {{$linea->id}} </td>
                              <td> {{$linea->numero}} </td>
                              <td> {{$linea->numdestino}} </td>
                              <td> {{$linea->NombreAutor}} </td>
                              <td> {{$linea->nombrechat}} 
                              </td>

                               
                                  @if ($linea->fromMe == "1")
                                  <td class="info">
                                     Enviado
                                  </td>
                                  @elseif ($linea->fromMe == "0")
                                   <td class="success">
                                     Respuesta
                                  </td>
                                  @else
                                  <td class="danger">
                                    Pruebas
                                  </td>
                                  @endif
                              

                                   @if ($linea->tipo == "chat")
                                   <td> 
                                       {{$linea->Mensaje}}
                                   </td>
                                   @else
                                      <td>
                                        {{$linea->caption}} &nbsp
                                        @if(strpos($linea->Mensaje, 'https://firebasestorage.googleapis.com') !== false)
                                           
                                           <a href='{{$linea->Mensaje}}' target="_blank">{{$linea->tipo}}</a>
                                        @else
                                            {{$linea->Mensaje}}
                                        @endif
                                      </td>
                                    @endif
                          </tr>
                         @endforeach
                   </tbody>
                </table>
                <div class="paginacion" style="max-width:100%"> {{ $mensajes_recibidos->links() }} </div>
            </div>
        </div>
    </div>
     @else
         <div class="row" id="nop">
            <div class="col-md-12"> 
                <div class="row form-group">
                     <label class="text-info col-md-12">No existe infomación para mostrar</label>
                </div>
                <div class="row form-group">
                     <a class="btn btn-info" href="http://restocombo.com/BOT_WHATSAPP/DemoWhat/public/mensajes_api">&nbsp INICIO</a>
                </div>
            </div>
         </div>
    @endif
</div>