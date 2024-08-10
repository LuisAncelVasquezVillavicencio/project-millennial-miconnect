<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Carbon\Carbon;
use App\WhatsappConfig;
use Illuminate\Support\Facades\Http;
use OpenApi\Annotations as OA;

use App\WhatsappTemplate;

use App\WhatsappStatus;
use App\WhatsappRecive;
use App\WhatsappSend;

class ViewController extends Controller
{


    public function formSendTextMessages(Request $request){
        $token = $request->query('token');
        $whatsappConfig = WhatsappConfig::get();
        return view('formSendTextMessages',compact("whatsappConfig","token"));
    }
    
    
    public function tableListarMessagesTemplate(Request $request){
        $token = $request->query('token');
        $whatsappConfig = WhatsappConfig::get();
        
        
        return view('tableListarMessagesTemplate',compact("whatsappConfig","token"));
    }
    
    
    public function formCreateTemplateMessages(Request $request){
        $token = $request->query('token');
        $whatsappConfig = WhatsappConfig::get();
        return view('formCreateTemplateMessages',compact("whatsappConfig","token"));
    }
    
    
    
    public function formSendTemplateMessages(Request $request){
        $token = $request->query('token');
        $whatsappConfig = WhatsappConfig::get();
        $whatsappTemplate = WhatsappTemplate::select('id','templateName','language')->get();
        return view('formSendTemplateMessages',compact("whatsappConfig","token","whatsappTemplate"));
    }
    
    
    public function index(Request $request){
        
       
        $token = $request->query('token');
        $whatsappConfig = WhatsappConfig::orderBy("created_at","desc")->orderBy("estado","desc")->get();
        $countWhatsappRecive = WhatsappRecive::count(); 
        $countWhatsappSend = WhatsappSend::count(); 
        $countWhatsappStatus = WhatsappStatus::count();
        
        return view('index',compact("countWhatsappRecive","countWhatsappSend","countWhatsappStatus","whatsappConfig","token"));
    }
    

//https://developers.facebook.com/docs/whatsapp/on-premises/reference
}