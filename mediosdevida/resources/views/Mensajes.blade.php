<head>
    <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
    <div class="container">
        <div class="col-md-12">
            <div class="row">
                <div class="row">
                    <h3 class="text-info">Mensajes enviados y recibidos por medio de API:</h3>
                </div>
                <div class="row form-group">
                    <div class="col-md-3">
                        <select class="form-control" id="x_Ttexto">
                            <option value="1" >Número</option>
                            <option value="2" >Nombre chat</option>
                        </select>
                    </div>
                    <div class=col-md-8>
                        <input class="form-control " id="xTexto"/>
                    </div>
                    <div class=col-md-1>
                        <button class="btn btn-info" id="xBoton">Buscar</button>
                    </div>
                </div>
                <div class="row form-group">
                    <label class="col-md-2">Enviado/Respuesta</label>
                    <div class="col-md-3">
                        <select class="form-control" id="x_env">
                            <option value="0" selected>Todos</option>
                            <option value="1" >Enviado</option>
                            <option value="2" >Respuesta</option>
                        </select>
                    </div>
                </div>
                <div class="row" id="cargar">
                 @if (count($mensajes_recibidos) > 0)
                    @include('tabla_view')
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
            </div>
        </div>
    </div>
</body>

<script type="text/javascript">

$(function() {
    var x = $( "#x_env" ).val()
    var v = "--"
    var f = $( "#x_Ttexto" ).val()
    $('body').on('click', '.paginacion a', function(e) {
        e.preventDefault();
        var url = $(this).attr('href');

        getArticles(url,"click");
        window.history.pushState("", "", url);
    });
    
    $( "#x_env" ).change(function() {
        //var url = window.location.href;
        window.history.pushState("", "", "http://restocombo.com/BOT_WHATSAPP/DemoWhat/public/mensajes_api?page=1");
        var url =  window.location.href;
        x = $( "#x_env" ).val()
        getArticles(url,"change");
        
    });
    $("#xBoton").click( function(){

        v = "%"+$.trim($( "#xTexto" ).val())+"%"
        f = $( "#x_Ttexto" ).val()
        window.history.pushState("", "", "http://restocombo.com/BOT_WHATSAPP/DemoWhat/public/mensajes_api?page=1");
        var url =  window.location.href;
        getArticles(url,"change");}
      );
      
    function getArticles(url,evento) {
        v = $.trim(v)
        $.ajax({
            url : url,
            data: { tipo : x ,
                    texto : v,
                    tipo_t : f
            } 
        }).done(function (data) {
            $('#cargar').html(data)
            
        }).fail(function () {
            alert('No se encontraron mensajes');
            v = "--"
            $("#cargar").html("")
            $( "#xTexto" ).val("")
            var url = $().attr('href');

            getArticles(url,"change");
        });
    }
    
    window.setInterval(function(){
        var url = window.location.href;
        console.log("update")
        getArticles(url,"up");
    }, 30000);


});

</script>