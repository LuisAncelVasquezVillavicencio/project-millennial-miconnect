<?php

namespace App\Http\Controllers\Config\View;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Config\View\View;
use Illuminate\Support\Facades\Storage;


class ViewController extends Controller
{
    //
    public function generate_config_view()
    {
        $View = View::get()->toJson(JSON_PRETTY_PRINT);
        Storage::disk('local')->put('public/config/view.json' , $View);
        $path = Storage::disk('local')->get('public/config/view.json');
        $jsonencode = utf8_encode($path);
        $arrayjson = json_decode($jsonencode, true);
        //generar array
        $array = array();
        foreach ($arrayjson as &$obj) {
            $key = $obj['CODIGO'];
            $array[$key]=$obj;
        }
        $myJsonString = json_encode($array,JSON_PRETTY_PRINT);
        Storage::disk('local')->put('public/config/view.json' , $myJsonString);
        //generar css
        $css = '';
        foreach ($arrayjson as &$obj) {
            if($obj['CLASE']!=''){
                 $css = $css.$obj['CLASE'].'{ '.$obj['PROPIEDAD'].':'.$obj['VALOR'].' '.$obj['IMPORTANTE'].'; }'.PHP_EOL;
            }
        };
        Storage::disk('local')->put('public/config/view.css' , $css);
        return dd($arrayjson);
    }
    
}
