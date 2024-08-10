<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bot;
use App\Botpreguntas;
use App\Botpreguntasopcion;
use App\Botbienvenida;
use App\BotCalculo;

class botbetaController extends Controller
{
    //
    
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(){
       
       $encuestas = Bot::get();
       $bienvenida = Botbienvenida::first();
       return view("bot.index",compact("encuestas","bienvenida"));
       
    }
    
    public function store(Request $request){

        $campos=[
            "TITULO_ENCUESTA"=>["required","max:255"],
            "PALABRA_CLAVE"=>"required|unique:tb_bot_encuestas,PALABRA_CLAVE|max:100",
            "DESCRIPCION"=>"required|max:500",
            "MSM_BIENVENIDA"=>"sometimes|max:500",
            "MSM_DESPEDIDA"=>"sometimes|max:500",
        ];
        $reglas=[
            "TITULO_ENCUESTA.required"=>"Este campo es requerido",
            "PALABRA_CLAVE.required"=>"Este campo es requerido",
            "DESCRIPCION.required"=>"Este campo es requerido",
            "TITULO_ENCUESTA.max"=>"Caracteres máximos: 255",
            "PALABRA_CLAVE.max"=>"Caracteres máximos: 100",
            "DESCRIPCION.max"=>"Caracteres máximos: 500",
            "MSM_BIENVENIDA.max"=>"Caracteres máximos: 500",
            "MSM_DESPEDIDA.max"=>"Caracteres máximos: 500",
            "PALABRA_CLAVE.unique"=>"La palabra clave debe ser unica",
        ];
        
        $validator = \Validator::make($request->all(), $campos,$reglas);
        $error = $validator->errors()->toArray();
        
        if($error){
            return response()->json(["errors"=>$error]);
        }
        
        $contador_activos = Bot::where("ESTADO",1)->count();
        
        if($contador_activos >= env("MAX_ENCUESTA") && $request->get("ESTADO_ENCUESTA") != null){
           return response()->json(["errors"=>["ESTADO_ENCUESTA" => "Solo puede haber ".env("MAX_ENCUESTA")." Bot(s) activo(s)."]]);
        }
        
        $TITULO_ENCUESTA = $request->get("TITULO_ENCUESTA");
        $PALABRA_CLAVE = $request->get("PALABRA_CLAVE");
        $DESCRIPCION = $request->get("DESCRIPCION");
        $MSM_BIENVENIDA = $request->get("MSM_BIENVENIDA");
        $MSM_DESPEDIDA = $request->get("MSM_DESPEDIDA");
        
        $bot = new Bot;
        $bot->TITULO_ENCUESTA = $TITULO_ENCUESTA;
        $bot->PALABRA_CLAVE = $PALABRA_CLAVE;
        $bot->DESCRIPCION = $DESCRIPCION;
        $bot->MSM_BIENVENIDA = $MSM_BIENVENIDA;
        $bot->MSM_DESPEDIDA = $MSM_DESPEDIDA;
        $bot->ESTADO = ($request->get("ESTADO_ENCUESTA") != null) ? 1 : 0;
        
        if($bot->save()){
            
            return response()->json(['resultado'=>"ok"]);
            
        }
    }
    
    public function edit(Request $request){
        
        $id = $request->get("id");
        $bot = Bot::find($id);
        return response()->json($bot);
        
    }
    
    public function update(Request $request){
        
        
        $bot = Bot::find($request->get("ID_ENCUESTA_E"));
        
        if($bot == null){
            return response()->json(['resultado'=>"no found"]);
        }
        
        $campos=[
            "TITULO_ENCUESTA_E"=>["required","max:255"],
            "PALABRA_CLAVE_E"=>"required|unique:tb_bot_encuestas,PALABRA_CLAVE,".$request->get("ID_ENCUESTA_E").",ID_ENCUESTA|max:100",
            "DESCRIPCION_E"=>"required|max:500",
            "MSM_BIENVENIDA_E"=>"sometimes|max:500",
            "MSM_DESPEDIDA_E"=>"sometimes|max:500",
        ];
        $reglas=[
            "TITULO_ENCUESTA_E.required"=>"Este campo es requerido",
            "PALABRA_CLAVE_E.required"=>"Este campo es requerido",
            "DESCRIPCION_E.required"=>"Este campo es requerido",
            "TITULO_ENCUESTA_E.max"=>"Caracteres máximos: 255",
            "PALABRA_CLAVE_E.max"=>"Caracteres máximos: 100",
            "DESCRIPCION_E.max"=>"Caracteres máximos: 500",
            "MSM_BIENVENIDA_E.max"=>"Caracteres máximos: 500",
            "MSM_DESPEDIDA_E.max"=>"Caracteres máximos: 500",
            "PALABRA_CLAVE_E.unique"=>"La palabra clave debe ser unica",
        ];
        
        $validator = \Validator::make($request->all(), $campos,$reglas);
        $error = $validator->errors()->toArray();
        
        if($error){
            return response()->json(["errors"=>$error]);
        }
        
        $contador_activos = Bot::where("ESTADO",1)->where("ID_ENCUESTA","<>",$request->get("ID_ENCUESTA_E"))->count();
        
        if($contador_activos >= env("MAX_ENCUESTA") && $request->get("ESTADO_ENCUESTA_E") != null ){
           return response()->json(["errors"=>["ESTADO_ENCUESTA_E" => "Solo puede haber ".env("MAX_ENCUESTA")." Bot(s) activo(s)."]]);
        }

        $TITULO_ENCUESTA = $request->get("TITULO_ENCUESTA_E");
        $PALABRA_CLAVE = $request->get("PALABRA_CLAVE_E");
        $DESCRIPCION = $request->get("DESCRIPCION_E");
        $MSM_BIENVENIDA = $request->get("MSM_BIENVENIDA_E");
        $MSM_DESPEDIDA = $request->get("MSM_DESPEDIDA_E");
        
        
        $bot->TITULO_ENCUESTA = $TITULO_ENCUESTA;
        $bot->PALABRA_CLAVE = $PALABRA_CLAVE;
        $bot->DESCRIPCION = $DESCRIPCION;
        $bot->MSM_BIENVENIDA = $MSM_BIENVENIDA;
        $bot->MSM_DESPEDIDA = $MSM_DESPEDIDA;
        $bot->ESTADO = ($request->get("ESTADO_ENCUESTA_E") != null) ? 1 : 0;
        
        if($bot->save()){
            
            return response()->json(['resultado'=>"ok"]);
            
        }
        
    }
    
    public function destroy(Request $request){
        
        $id_encuesta = $request->get("ID_ENCUESTA_EL");

        //desactivamos los encuestados activos
        $activos = \App\Botactivos::where("ID_ENCUESTA",$id_encuesta)->delete();
        $activos = \App\Botresultados::where("ID_ENCUESTA",$id_encuesta)->delete();
        $preguntas = Botpreguntas::where("ID_ENCUESTA",$id_encuesta)->delete();
        $finalizados = \App\Botfinal::where("ID_ENCUESTA",$id_encuesta)->delete();
        $opciones = \App\Botpreguntasopcion::where("ID_ENCUESTA",$id_encuesta)->delete();
        $bot = Bot::where("ID_ENCUESTA",$id_encuesta)->delete();
        
        return redirect()->route("bot.admins")->with(["eliminado"=>"Exito al eliminar encuesta"]);
        
    }
    
    public function preguntas(Request $request){
        
        $bot = Bot::find($request->id);
        $resultado = BotCalculo::where("ID_ENCUESTA",$request->id)->get();
        
        if($request->ajax()){
            return view("bot.preguntas-list",compact('bot','resultado'))->render();
        }
        
        return view("bot.preguntas-index",compact('bot','resultado'));
    }
    
    public function create_pregunta(Request $request,$id){
        
        $campos=[
            "PREGUNTA"=>"required|max:1000",
        ];
        $reglas=[
            "PREGUNTA.required"=>"Este campo es requerido",
            "PREGUNTA.max"=>"Caracteres máximos: 1000",
        ];
        
        $validator = \Validator::make($request->all(), $campos,$reglas);
        $error = $validator->errors()->toArray();
        
        if($error){
            return response()->json(["errors"=>$error]);
        }
        
        $ID_ENCUESTA = $id;
        $PREGUNTA = $request->get("PREGUNTA");
        
        $total = Botpreguntas::where("ID_ENCUESTA",$id)->orderBy("ID_PREGUNTA","desc")->first();
        
        if($total != null){
            $total = $total->ID_PREGUNTA + 1;
             
        }
        else{
            $total = 1;
        }
            
        $pregunta_new = new Botpreguntas();
        $pregunta_new->ID_PREGUNTA = $total;
        $pregunta_new->ID_ENCUESTA = $ID_ENCUESTA;
        $pregunta_new->PREGUNTA = $PREGUNTA;
        
        if($pregunta_new->save()){
            
            return response()->json(['resultado'=>"ok"]);
            
        }
    }
    
    public function edit_pregunta(Request $request,$id){
        
        $bot = Botpreguntas::where("ID_ENCUESTA",$id)->where("ID_PREGUNTA",$request->get("id_p"))->first();
        return response()->json($bot);
    }
    
    public function update_pregunta(Request $request,$id){
        
        $campos=[
            "PREGUNTA_E"=>"required|max:1000",
        ];
        $reglas=[
            "PREGUNTA_E.required"=>"Este campo es requerido",
            "PREGUNTA_E.max"=>"Caracteres máximos: 1000",
        ];
        
        $validator = \Validator::make($request->all(), $campos,$reglas);
        $error = $validator->errors()->toArray();
        
        if($error){
            return response()->json(["errors"=>$error]);
        }
        
        $ID_ENCUESTA = $id;
        $PREGUNTA = $request->get("PREGUNTA_E");
        $ID_PREGUNTA = $request->get("ID_PREGUNTA_E");
            
        $pregunta_new = Botpreguntas::where("ID_ENCUESTA",$ID_ENCUESTA)->where("ID_PREGUNTA",$ID_PREGUNTA)->update([
            "PREGUNTA" => $PREGUNTA
        ]);
            
        return response()->json(['resultado'=>"ok"]);
    }
    
    public function preguntas_destroy(Request $request,$id){
        
        $id_encuesta = $id;
        $id_pregunta = $request->get("ID_PREGUNTA_EL");
        
        $resultados = \App\Botresultados::where("ID_ENCUESTA",$id_encuesta)->where("ID_PREGUNTA",$id_pregunta)->delete();
        $opciones = \App\Botpreguntasopcion::where("ID_ENCUESTA",$id_encuesta)->where("ID_PREGUNTA",$id_pregunta)->delete();
        $preguntas = Botpreguntas::where("ID_ENCUESTA",$id_encuesta)->where("ID_PREGUNTA",$id_pregunta)->delete();
        
        return response()->json(['resultado'=>"ok"]);
        
    }
    
    public function opcion(Request $request,$id){
        
        $claves = Botpreguntasopcion::select("CLAVE")->where("ID_ENCUESTA",$id)->where("ID_PREGUNTA",$request->get("id_p"))->pluck("CLAVE")->toArray();
        
        $array_opciones = ["a","b","c","d","e","f","g","h","i","j","Otro"];
        
        $a_op = array_diff( $array_opciones, $claves ); 
        
        return response()->json(["opciones"=>$a_op]);
        
    }
    
    public function create_respuesta(Request $request,$id){
    
        $campos=[
            "OPCION"=>"required|max:100",
            "CLAVE"=>"required",
            "PESO"=>"nullable|numeric",
        ];
        $reglas=[
            "OPCION.required"=>"Este campo es requerido",
            "OPCION.max"=>"Caracteres máximos: 100",
            "CLAVE.required"=>"Este campo es requerido",
            "PESO.numeric"=>"Debe de ser un numero",
        ];
        
        if($request->get("IMG") == 1){
            $campos["URL_IMAGEN"] = ["required","regex:/.(?:jpe?g|png|gif)/"];
            $reglas["URL_IMAGEN.required"] = "Este campo es requerido";
            $reglas["URL_IMAGEN.regex"] = "Debe ser una dirección de imagen (.jpeg, .png, .gif)";
        }
        
        if($request->get("AUTO_RESPUESTA") == 1){
            $campos["RESPUESTA"] = ["required","max:1000"];
            $reglas["RESPUESTA.required"] = "Este campo es requerido";
            $reglas["RESPUESTA.max"] = "Caracteres máximos: 1000";
        }
    
        
        $validator = \Validator::make($request->all(), $campos,$reglas);
        $error = $validator->errors()->toArray();
        
        if($error){
            return response()->json(["errors"=>$error]);
        } 
        
        $total = Botpreguntasopcion::where("ID_ENCUESTA",$id)->where("ID_PREGUNTA",$request->get("ID_PREGUNTA_A"))->orderBy("ID_OPCIONES","desc")->first();
        
        if($total != null){
            $total = $total->ID_OPCIONES + 1;
             
        }
        else{
            $total = 1;
        }
        
        $bot = new Botpreguntasopcion();
        
        $bot->ID_ENCUESTA = $id;
        $bot->ID_PREGUNTA = $request->get("ID_PREGUNTA_A");
        $bot->ID_OPCIONES = $total;
        $bot->OPCION = $request->get("OPCION");
        $bot->CLAVE = $request->get("CLAVE");
        $bot->IMG = ($request->get("IMG") != null) ? 1 : 0;
        $bot->AUTO_RESPUESTA = ($request->get("AUTO_RESPUESTA") != null) ? 1 : 0;
        $bot->URL_IMAGEN = ($request->get("IMG") != null) ? $request->get("URL_IMAGEN") : null;
        $bot->RESPUESTA = ($request->get("AUTO_RESPUESTA") != null) ? $request->get("RESPUESTA") : null;
        $bot->PESO = ($request->get("PESO") != null) ? $request->get("PESO") : 0;
        
        if($bot->save()){
            
            return response()->json(['resultado'=>"ok"]);
            
        }
    
    }
    
    public function opcion_edit(Request $request,$id){
        
        $claves = Botpreguntasopcion::select("CLAVE")->where("ID_ENCUESTA",$id)->where("ID_PREGUNTA",$request->get("id_p"))->where("ID_OPCIONES","<>",$request->get("id_q"))->pluck("CLAVE")->toArray();
        
        $array_opciones = ["a","b","c","d","e","f","g","h","i","j","Otro"];
        
        $a_op = array_diff( $array_opciones, $claves ); 
        
        $opcion = Botpreguntasopcion::where("ID_ENCUESTA",$id)->where("ID_PREGUNTA",$request->get("id_p"))->where("ID_OPCIONES",$request->get("id_q"))->first();
        
        $opcion->lista_claves = $a_op;
        
        return response()->json($opcion);
        
    }
    
    public function update_respuesta(Request $request,$id){
    
        $campos=[
            "OPCION_E"=>"required|max:100",
            "CLAVE_E"=>"required",
            "PESO_E"=>"nullable|numeric",
        ];
        $reglas=[
            "OPCION_E.required"=>"Este campo es requerido",
            "OPCION_E.max"=>"Caracteres máximos: 100",
            "CLAVE_E.required"=>"Este campo es requerido",
            "PESO_E.numeric"=>"Debe de ser un numero",
        ];
        
        if($request->get("IMG_E") == 1){
            $campos["URL_IMAGEN_E"] = ["required","regex:/.(?:jpe?g|png|gif)/"];
            $reglas["URL_IMAGEN_E.required"] = "Este campo es requerido";
            $reglas["URL_IMAGEN_E.regex"] = "Debe ser una dirección de imagen (.jpeg, .png, .gif)";
        }
        
        if($request->get("AUTO_RESPUESTA_E") == 1){
            $campos["RESPUESTA_E"] = ["required","max:1000"];
            $reglas["RESPUESTA_E.required"] = "Este campo es requerido";
            $reglas["RESPUESTA_E.max"] = "Caracteres máximos: 1000";
        }
    
        
        $validator = \Validator::make($request->all(), $campos,$reglas);
        $error = $validator->errors()->toArray();
        
        if($error){
            return response()->json(["errors"=>$error]);
        } 
        
        
        
        Botpreguntasopcion::where("ID_ENCUESTA",$id)->where("ID_PREGUNTA",$request->get("ID_PREGUNTA_E_A"))->where("ID_OPCIONES",$request->get("ID_OPCIONES_E"))->update([
        
        "ID_ENCUESTA" => $id,
        "ID_PREGUNTA" => $request->get("ID_PREGUNTA_E_A"),
        "ID_OPCIONES" => $request->get("ID_OPCIONES_E"),
        "OPCION" => $request->get("OPCION_E"),
        "CLAVE" => $request->get("CLAVE_E"),
        "IMG" => ($request->get("IMG_E") != null) ? 1 : 0,
        "AUTO_RESPUESTA" => ($request->get("AUTO_RESPUESTA_E") != null) ? 1 : 0,
        "URL_IMAGEN" => ($request->get("IMG_E") != null) ? $request->get("URL_IMAGEN_E") : null,
        "RESPUESTA" => ($request->get("AUTO_RESPUESTA_E") != null) ? $request->get("RESPUESTA_E") : null,
        "PESO" => ($request->get("PESO_E") != null) ? $request->get("PESO_E") : 0,
        
        ]);
            
        return response()->json(['resultado'=>"ok"]);
            
    
    }
    
    public function delete_respuesta(Request $request,$id){
        
        $id_encuesta = $id;
        $id_pregunta = $request->get("ID_PREGUNTA_A_EL");
        $id_opcion = $request->get("ID_OPCIONES_A_EL");
        
        $clave = \App\Botpreguntasopcion::where("ID_ENCUESTA",$id_encuesta)->where("ID_PREGUNTA",$id_pregunta)->where("ID_OPCIONES",$id_opcion)->first();
        
        $resultados = \App\Botresultados::where("ID_ENCUESTA",$id_encuesta)->where("ID_PREGUNTA",$id_pregunta)->where("OPCION_ESCOJIDA",$clave->CLAVE)->delete();
        $opciones = \App\Botpreguntasopcion::where("ID_ENCUESTA",$id_encuesta)->where("ID_PREGUNTA",$id_pregunta)->where("ID_OPCIONES",$id_opcion)->delete();
        
        return response()->json(['resultado'=>"ok"]);
        
    }
    
    public function create_welcome(Request $request){
        
        $campos=[
            "MENSAJE"=>"required|max:1000",
        ];
        $reglas=[
            "MENSAJE.required"=>"Este campo es requerido",
            "MENSAJE.max"=>"Caracteres máximos: 1000",
        ];
        
        if($request->get("IMG") == 1){
            $campos["URL_IMG"] = ["required","regex:/.(?:jpe?g|png|gif)/"];
            $reglas["URL_IMG.required"] = "Este campo es requerido";
            $reglas["URL_IMG.regex"] = "Debe ser una dirección de imagen (.jpeg, .png, .gif)";
        }
        
        $validator = \Validator::make($request->all(), $campos,$reglas);
        $error = $validator->errors()->toArray();
        
        if($error){
            return response()->json(["errors"=>$error]);
        } 
        
        $check = Botbienvenida::first();
        
        if($check != null){
            return response()->json(["errors"=>["MENSAJE"=>"No se puede crear mas de un mensaje de bienvenida"]]); 
        }
        
        $bot = new Botbienvenida();
        
        $bot->MENSAJE = $request->get("MENSAJE");
        $bot->IMG = ($request->get("IMG") != null) ? 1 : 0;
        $bot->URL_IMG = ($request->get("URL_IMG") != null) ? $request->get("URL_IMG") : null;
        $bot->ESTADO = ($request->get("ESTADO") != null) ? 1 : 0;
        
        if($bot->save()){
            
            return response()->json(['resultado'=>"ok"]);
            
        }
    }
    public function edit_welcome($id){
        
        $bot = Botbienvenida::first();
        return response()->json($bot); 
        
    }
    
    public function update_welcome(Request $request,$id){
        
        
        
        $bot = Botbienvenida::where("ID_BIENVENIDA",$id)->first();
        $campos=[
            "MENSAJE"=>"required|max:1000",
        ];
        $reglas=[
            "MENSAJE.required"=>"Este campo es requerido",
            "MENSAJE.max"=>"Caracteres máximos: 1000",
        ];
        
        if($request->get("IMG") == 1){
            $campos["URL_IMG"] = ["required","regex:/.(?:jpe?g|png|gif)/"];
            $reglas["URL_IMG.required"] = "Este campo es requerido";
            $reglas["URL_IMG.regex"] = "Debe ser una dirección de imagen (.jpeg, .png, .gif)";
        }
        
        $validator = \Validator::make($request->all(), $campos,$reglas);
        $error = $validator->errors()->toArray();
        
        if($error){
            return response()->json(["errors"=>$error]);
        } 
        $bot->MENSAJE = $request->get("MENSAJE");
        $bot->IMG = ($request->get("IMG") != null) ? 1 : 0;
        $bot->URL_IMG = ($request->get("URL_IMG") != null) ? $request->get("URL_IMG") : null;
        $bot->ESTADO = ($request->get("ESTADO") != null) ? 1 : 0;
        
        if($bot->save()){
            
            return response()->json(['resultado'=>"ok"]);
            
        }
        
    }
    
    public function create_calc(Request $request,$id){
        
        $campos=[
            "MENSAJE"=>"required|max:1000",
        ];
        $reglas=[
            "MENSAJE.required"=>"Este campo es requerido",
            "MENSAJE.max"=>"Caracteres máximos: 1000",
        ];
        
        if($request->get("IMG") == 1){
            $campos["URL_IMAGEN"] = ["required","regex:/.(?:jpe?g|png|gif)/"];
            $reglas["URL_IMAGEN.required"] = "Este campo es requerido";
            $reglas["URL_IMAGEN.regex"] = "Debe ser una dirección de imagen (.jpeg, .png, .gif)";
        }
        
        if($request->get("OTROS") != 1){
            $campos["MAXIMO"] = ["required","numeric"];
            $campos["MINIMO"] = ["required","numeric"];
            $reglas["MAXIMO.required"] = "Este campo es requerido";
            $reglas["MAXIMO.numeric"] = "Debe ingresar un numero";
            $reglas["MINIMO.required"] = "Este campo es requerido";
            $reglas["MINIMO.numeric"] = "Debe ingresar un numero";
        }
        
        $validator = \Validator::make($request->all(), $campos,$reglas);
        $error = $validator->errors()->toArray();
        
        if($error){
            return response()->json(["errors"=>$error]);
        } 
        
        if($request->get("MAXIMO") < $request->get("MINIMO")){
            return response()->json(["errors"=>["MINIMO"=>"El minimo no puede ser mayor al maximo."]]);
        }
        
        $bot = new BotCalculo();
        
        $bot->ID_ENCUESTA = $id;
        $bot->MENSAJE = $request->get("MENSAJE");
        $bot->IMG = ($request->get("IMG") != null) ? 1 : 0;
        $bot->URL_IMG = ($request->get("URL_IMAGEN") != null) ? $request->get("URL_IMAGEN") : null;
        $bot->MAXIMO = ($request->get("OTROS") != null) ? 0 : $request->get("MAXIMO");
        $bot->MINIMO = ($request->get("OTROS") != null) ? 0 : $request->get("MINIMO");
        $bot->OTROS = ($request->get("OTROS") != null) ? 1 : 0;
        
        if($bot->save()){
            
            return response()->json(['resultado'=>"ok"]);
        }  
    }
    
    public function edit_calc(Request $request,$id){
        
        $bot = BotCalculo::where("ID_ENCUESTA",$id)->where("ID_RESULTADO",$request->get("id_p"))->first();
        return response()->json($bot); 
        
    }
    
    public function update_calc(Request $request,$id){
        
        $campos=[
            "MENSAJE_EC"=>"required|max:1000",
        ];
        $reglas=[
            "MENSAJE_EC.required"=>"Este campo es requerido",
            "MENSAJE_EC.max"=>"Caracteres máximos: 1000",
        ];
        
        if($request->get("IMG_EC") == 1){
            $campos["URL_IMG_EC"] = ["required","regex:/.(?:jpe?g|png|gif)/"];
            $reglas["URL_IMG_EC.required"] = "Este campo es requerido";
            $reglas["URL_IMG_EC.regex"] = "Debe ser una dirección de imagen (.jpeg, .png, .gif)";
        }
        
        if($request->get("OTROS_EC") != 1){
            $campos["MAXIMO_EC"] = ["required","numeric"];
            $campos["MINIMO_EC"] = ["required","numeric"];
            $reglas["MAXIMO_EC.required"] = "Este campo es requerido";
            $reglas["MAXIMO_EC.numeric"] = "Debe ingresar un numero";
            $reglas["MINIMO_EC.required"] = "Este campo es requerido";
            $reglas["MINIMO_EC.numeric"] = "Debe ingresar un numero";
        }
        
        $validator = \Validator::make($request->all(), $campos,$reglas);
        $error = $validator->errors()->toArray();
        
        if($error){
            return response()->json(["errors"=>$error]);
        } 
        
        if($request->get("MAXIMO_EC") < $request->get("MINIMO_EC")){
            return response()->json(["errors"=>["MINIMO"=>"El minimo no puede ser mayor al maximo."]]);
        }
        
        $bot = BotCalculo::find($request->get("ID_RESULTADO_EC"));
        
        $bot->ID_ENCUESTA = $id;
        $bot->MENSAJE = $request->get("MENSAJE_EC");
        $bot->IMG = ($request->get("IMG_EC") != null) ? 1 : 0;
        $bot->URL_IMG = ($request->get("URL_IMG_EC") != null) ? $request->get("URL_IMG_EC") : null;
        $bot->MAXIMO = ($request->get("OTROS_EC") != null) ? 0 : $request->get("MAXIMO_EC");
        $bot->MINIMO = ($request->get("OTROS_EC") != null) ? 0 : $request->get("MINIMO_EC");
        $bot->OTROS = ($request->get("OTROS_EC") != null) ? 1 : 0;
        
        if($bot->save()){
            
            return response()->json(['resultado'=>"ok"]);
        }  
        
        
    }
    
    public function destroy_calc(Request $request){
        
        $opciones = BotCalculo::find($request->get("ID_RESULTADO_DES"))->delete();
        
        return response()->json(['resultado'=>"ok"]);
    }
}
