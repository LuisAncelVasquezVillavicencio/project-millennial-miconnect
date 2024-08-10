<?php

namespace App;
use Auth;
use Illuminate\Support\Facades\Storage;

class WhatsAppBot
{
    /*created : Jesus Salgado*/
    /*
        Metodos de envio:
        $n_pais : Numero prefijo de pais
        $numero : Numero de teléfono
        $mensaje: 
    */ 
    
    function enviar_mensaje_regular($n_pais,$numero,$mensaje,$APIurl,$token){
        
        $data = [
                'phone' => $n_pais.$numero, 
                'body' => $mensaje
            ];
        $json = json_encode($data); // Encode data to JSON
        
        //$url = $APIurl.'message?token='.$token;

        $url = $APIurl.'sendMessage?token='.$token;
        //https://api.chat-api.com/instance139591/sendMessage?token=5qzsfqhpihfr8rze

        // Make a POST request
        $options = stream_context_create(['http' => [
                        'method'  => 'POST',
                        'header'  => 'Content-type: application/json',
                        'content' => $json
                    ]
        ]);
        // Send a request
        $result = json_decode(file_get_contents($url, false, $options));
        
        //return dd($result);
        
        
        if(isset($result->{'sent'})){
            if($result->{'sent'}){
                return  [
                'sent' =>  $result->{'sent'}, // Message
                'id' =>  $result->{'id'},
                'queueNumber' =>  $result->{'message'}, //Total general de mensajes enviados
                'n_pais' => $n_pais,
                'numero' => $numero, // Receivers phone
                'mensaje' =>  $mensaje, // Message
                ];
                
            }
             else{
                return  [
                'sent' =>  $result->{'sent'}, // Message
                'id' =>  "",
                'queueNumber' => "", //Total general de mensajes enviados
                'n_pais' => $n_pais,
                'numero' => $numero, // Receivers phone
                'mensaje' =>  $mensaje, // Message
                'error' => $result->{'message'}

                ];
            }
        }
        else{
            //inster a tabla de error 
            return  [
                'error' => $result->{'error'}
            ];
        }
    }
    
    function enviar_documento($n_pais,$numero,$documento,$APIurl,$token){
        
        $formato_aceptado = [".pdf",".doc",".docx",".xlsx",".xlsm",".xls"];  
        $nombre = explode('/', $documento);
        $nombre = end($nombre);
        
        $es = false;
        
        foreach($formato_aceptado as $cadena ){
            if (strpos($documento, $cadena ) !== false) {
            $es = 'true';
            }  
        }
        
        if(!$es){
                return [
                    'error' => "Formato incorrecto documento"
                ]; 
        }
        
        else{
            
            /*$data = [
                'phone' => $n_pais.$numero, 
                'body' => $documento,
                "filename" => $nombre
            ];*/

            $data = [
            	'body' => $documento,
            	"filename" => $nombre,
            	'caption' => "", 
                'phone' => $n_pais.$numero
            ];

            $json = json_encode($data); // Encode data to JSON
            $url = $APIurl.'sendFile?token='.$token;
            // Make a POST request
            $options = stream_context_create(['http' => [
                            'method'  => 'POST',
                            'header'  => 'Content-type: application/json',
                            'content' => $json
                        ]
            ]);
            // Send a request
            $result = json_decode(file_get_contents($url, false, $options));
            
            //return dd($result);
            
            if(isset($result->{'sent'})){
                if($result->{'sent'}){
                    return  [
                    'sent' =>  $result->{'sent'}, // Message
                    'id' =>  $result->{'id'},
                    'queueNumber' =>  $result->{'message'}, //Total general de mensajes enviados
                    'n_pais' => $n_pais,
                    'numero' => $numero, // Receivers phone
                    'mensaje' =>  "", // Message
                    'archivo' =>$documento
                    ];
                    
                }
                 else{
                    return  [
                    'sent' =>  $result->{'sent'}, // Message
                    'id' =>  "",
                    'queueNumber' => "", //Total general de mensajes enviados
                    'n_pais' => $n_pais,
                    'numero' => $numero, // Receivers phone
                    'mensaje' =>  "", // Message
                    'error' => $result->{'message'},
                    'archivo' =>$documento
                    ];
                }
            }
            else{
                //inster a tabla de error 
                return  [
                    'error' => $result->{'error'}
                ];
            }
        }

        
    }
    
    function enviar_imagen_y_texto($n_pais,$numero,$mensaje,$imagen,$APIurl,$token){
        
        $formato_aceptado = [".jpg",".jpeg",".png",".PNG",".gif"];
        $nombre = explode('/', $imagen);
        $nombre = end($nombre);
        
        $es = false;
        
        foreach($formato_aceptado as $cadena ){
            if (strpos($imagen, $cadena ) !== false) {
            $es = 'true';
            }  
        }
        
        if(!$es){
                return [
                    'error' => "Formato incorrecto imagen y texto"
                ]; 
        }
        
        else{

            /*$data = [
                'phone' => $n_pais.$numero, 
                'body' => $imagen,
                "filename" => $nombre,
                "caption" => $mensaje,
            ];*/

            $data = [
            	'body' => $imagen,
            	"filename" => $nombre,
            	'caption' => $mensaje,
                'phone' => $n_pais.$numero
            ];

            $json = json_encode($data); // Encode data to JSON
            $url = $APIurl.'sendFile?token='.$token;
            // Make a POST request
            $options = stream_context_create(['http' => [
                            'method'  => 'POST',
                            'header'  => 'Content-type: application/json',
                            'content' => $json
                        ]
            ]);
            // Send a request
            $result = json_decode(file_get_contents($url, false, $options));
            
            //return dd($result);
            
            if(isset($result->{'sent'})){
                if($result->{'sent'}){
                    return  [
                    'sent' =>  $result->{'sent'}, // Message
                    'id' =>  $result->{'id'},
                    'queueNumber' =>  $result->{'message'}, //Total general de mensajes enviados
                    'n_pais' => $n_pais,
                    'numero' => $numero, // Receivers phone
                    'mensaje' =>  $mensaje, // Message
                    'archivo' =>$imagen
                    ];
                    
                }else{
                    return  [
                    'sent' =>  $result->{'sent'}, // Message
                    'id' =>  "",
                    'queueNumber' => "", //Total general de mensajes enviados
                    'n_pais' => $n_pais,
                    'numero' => $numero, // Receivers phone
                    'mensaje' =>  $mensaje, // Message
                    'error' => $result->{'message'},
                    'archivo' =>$imagen

                    ];
                }
            }
            else{
                //inster a tabla de error 
                return  [
                    'error' => $result->{'error'}
                ];
            }
        }
    }
    
    
    function enviar_imagen($n_pais,$numero,$imagen,$APIurl,$token){
        
        $formato_aceptado = [".jpg",".jpeg",".png",".gif"];
        $nombre = explode('/', $imagen);
        $nombre = end($nombre);
        
        $es = false;
        
        foreach($formato_aceptado as $cadena ){
            if (strpos($imagen, $cadena ) !== false) {
            $es = 'true';
            }  
        }
        
        if(!$es){
            return [
                    'error' => "Formato incorrecto imagen"
                ]; 
        }
        
        else{
            
            /*$data = [
                'phone' => $n_pais.$numero, 
                'body' => $imagen,
                "filename" => $nombre
            ];*/

            $data = [
            	'body' => $imagen,
            	"filename" => $nombre,
                'phone' => $n_pais.$numero
            ];

            $json = json_encode($data); // Encode data to JSON
            $url = $APIurl.'sendFile?token='.$token;
            // Make a POST request
            $options = stream_context_create(['http' => [
                            'method'  => 'POST',
                            'header'  => 'Content-type: application/json',
                            'content' => $json
                        ]
            ]);
            // Send a request
            $result = json_decode(file_get_contents($url, false, $options));
            
            //return dd($result);
            
            if(isset($result->{'sent'})){
                if($result->{'sent'}){
                    return  [
                    'sent' =>  $result->{'sent'}, // Message
                    'id' =>  $result->{'id'},
                    'queueNumber' =>  $result->{'message'}, //Total general de mensajes enviados
                    'n_pais' => $n_pais,
                    'numero' => $numero, // Receivers phone
                    'mensaje' =>  "", // Message
                    'archivo' =>$imagen
                    ];
                    
                }
                 else{
                    return  [
                    'sent' =>  $result->{'sent'}, // Message
                    'id' =>  "",
                    'queueNumber' => "", //Total general de mensajes enviados
                    'n_pais' => $n_pais,
                    'numero' => $numero, // Receivers phone
                    'mensaje' =>  "", // Message
                    'error' => $result->{'message'},
                    'archivo' =>$imagen
                    ];
                }
            }
            else{
                //inster a tabla de error 
                return  [
                    'error' => $result->{'error'}
                ];
            }
        }
    }
    
    function enviar_video_y_texto($n_pais,$numero,$mensaje,$video,$APIurl,$token){
        
        $formato_aceptado = [".mp4",".gif"];
        $nombre = explode('/', $video);
        $nombre = end($nombre);
        
        $es = false;
        
        foreach($formato_aceptado as $cadena ){
            if (strpos($video, $cadena ) !== false) {

            $es = 'true';
            }  
        }
        
        if(!$es){
            return  [
                    'error' => "Formato incorrecto video texto"
                ];
        }
        
        else{
            /*$data = [
                'phone' => $n_pais.$numero, 
                'body' => $video,
                "filename" => $nombre,
                "caption" => $mensaje,
            ];*/

            $data = [
            	'body' => $video,
            	"filename" => $nombre,
            	'caption' => $mensaje,
                'phone' => $n_pais.$numero
            ];



            $json = json_encode($data); // Encode data to JSON
            $url = $APIurl.'sendFile?token='.$token;
            // Make a POST request
            $options = stream_context_create(['http' => [
                            'method'  => 'POST',
                            'header'  => 'Content-type: application/json',
                            'content' => $json
                        ]
            ]);
            // Send a request
            $result = json_decode(file_get_contents($url, false, $options));
            
            //return dd($result);
            
            if(isset($result->{'sent'})){
                if($result->{'sent'}){
                    return  [
                    'sent' =>  $result->{'sent'}, // Message
                    'id' =>  $result->{'id'},
                    'queueNumber' =>  $result->{'message'}, //Total general de mensajes enviados
                    'n_pais' => $n_pais,
                    'numero' => $numero, // Receivers phone
                    'mensaje' =>  $mensaje, // Message
                    'archivo' => $video
                    ];
                    
                }
                 else{
                    return  [
                    'sent' =>  $result->{'sent'}, // Message
                    'id' =>  "",
                    'queueNumber' => "", //Total general de mensajes enviados
                    'n_pais' => $n_pais,
                    'numero' => $numero, // Receivers phone
                    'mensaje' =>  $mensaje, // Message
                    'error' => $result->{'message'},
                    'archivo' => $video
                    ];
                }
            }
            else{
                //inster a tabla de error 
                return  [
                    'error' => $result->{'error'}
                ];
            }
        }
    }
    
    function enviar_video($n_pais,$numero,$video,$APIurl,$token){
        
        $formato_aceptado = [".mp4",".gif"];
        $nombre = explode('/', $video);
        $nombre = end($nombre);
        
        $es = false;
        
        foreach($formato_aceptado as $cadena ){
            if (strpos($video, $cadena ) !== false) {
                
            $es = 'true';
            }  
        }
        
        if(!$es){
            return [
                    'error' => "Formato incorrecto video"
                ]; 
        }
        
        else{
            /*$data = [
                'phone' => $n_pais.$numero, 
                'body' => $video,
                "filename" => $nombre
            ];*/

            $data = [
            	'body' => $video,
            	"filename" => $nombre,
                'phone' => $n_pais.$numero
            ];

            $json = json_encode($data); // Encode data to JSON
            $url = $APIurl.'sendFile?token='.$token;
            // Make a POST request
            $options = stream_context_create(['http' => [
                            'method'  => 'POST',
                            'header'  => 'Content-type: application/json',
                            'content' => $json
                        ]
            ]);
            // Send a request
            $result = json_decode(file_get_contents($url, false, $options));
            
            //return dd($result);
            
            if(isset($result->{'sent'})){
                if($result->{'sent'}){
                    return  [
                    'sent' =>  $result->{'sent'}, // Message
                    'id' =>  $result->{'id'},
                    'queueNumber' =>  $result->{'message'}, //Total general de mensajes enviados
                    'n_pais' => $n_pais,
                    'numero' => $numero, // Receivers phone
                    'mensaje' =>  "", // Message
                    'archivo'=>$video
                    ];
                    
                }
                 else{
                    return  [
                    'sent' =>  $result->{'sent'}, // Message
                    'id' =>  "",
                    'queueNumber' => "", //Total general de mensajes enviados
                    'n_pais' => $n_pais,
                    'numero' => $numero, // Receivers phone
                    'mensaje' =>  "", // Message
                    'error' => $result->{'message'},
                    'archivo'=>$video
                    ];
                }
            }
            else{
                //inster a tabla de error 
                return  [
                    'error' => $result->{'error'}
                ];
            }
        }
    }
    
    
    
    
    
    
    
    
    
    
    
}

