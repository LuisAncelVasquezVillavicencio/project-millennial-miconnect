{"filter":false,"title":"ViewController.php","tooltip":"/modulos/whatsapp/app/Http/Controllers/ViewController.php","undoManager":{"mark":100,"position":100,"stack":[[{"start":{"row":11,"column":0},"end":{"row":11,"column":13},"action":"insert","lines":["use App\\User;"],"id":64}],[{"start":{"row":12,"column":0},"end":{"row":12,"column":16},"action":"remove","lines":["WhatsappTemplate"],"id":65}],[{"start":{"row":11,"column":8},"end":{"row":11,"column":12},"action":"remove","lines":["User"],"id":66},{"start":{"row":11,"column":8},"end":{"row":11,"column":24},"action":"insert","lines":["WhatsappTemplate"]}],[{"start":{"row":47,"column":26},"end":{"row":47,"column":40},"action":"remove","lines":["WhatsappConfig"],"id":67},{"start":{"row":47,"column":26},"end":{"row":47,"column":42},"action":"insert","lines":["WhatsappTemplate"]}],[{"start":{"row":47,"column":9},"end":{"row":47,"column":23},"action":"remove","lines":["whatsappConfig"],"id":68},{"start":{"row":47,"column":9},"end":{"row":47,"column":25},"action":"insert","lines":["WhatsappTemplate"]}],[{"start":{"row":47,"column":9},"end":{"row":47,"column":10},"action":"remove","lines":["W"],"id":69}],[{"start":{"row":47,"column":9},"end":{"row":47,"column":10},"action":"insert","lines":["w"],"id":70}],[{"start":{"row":48,"column":81},"end":{"row":48,"column":82},"action":"insert","lines":[","],"id":71}],[{"start":{"row":48,"column":82},"end":{"row":48,"column":84},"action":"insert","lines":["\"\""],"id":72}],[{"start":{"row":48,"column":83},"end":{"row":48,"column":99},"action":"insert","lines":["whatsappTemplate"],"id":73}],[{"start":{"row":47,"column":46},"end":{"row":47,"column":47},"action":"insert","lines":["s"],"id":74},{"start":{"row":47,"column":47},"end":{"row":47,"column":48},"action":"insert","lines":["e"]},{"start":{"row":47,"column":48},"end":{"row":47,"column":49},"action":"insert","lines":["l"]},{"start":{"row":47,"column":49},"end":{"row":47,"column":50},"action":"insert","lines":["e"]},{"start":{"row":47,"column":50},"end":{"row":47,"column":51},"action":"insert","lines":["c"]},{"start":{"row":47,"column":51},"end":{"row":47,"column":52},"action":"insert","lines":["t"]}],[{"start":{"row":47,"column":52},"end":{"row":47,"column":53},"action":"insert","lines":["("],"id":75},{"start":{"row":47,"column":53},"end":{"row":47,"column":54},"action":"insert","lines":[")"]},{"start":{"row":47,"column":54},"end":{"row":47,"column":55},"action":"insert","lines":["-"]},{"start":{"row":47,"column":55},"end":{"row":47,"column":56},"action":"insert","lines":[">"]}],[{"start":{"row":47,"column":53},"end":{"row":47,"column":55},"action":"insert","lines":["''"],"id":76}],[{"start":{"row":48,"column":21},"end":{"row":48,"column":47},"action":"remove","lines":["formCreateTemplateMessages"],"id":77},{"start":{"row":48,"column":21},"end":{"row":48,"column":41},"action":"insert","lines":["formSendTextMessages"]}],[{"start":{"row":48,"column":30},"end":{"row":48,"column":33},"action":"remove","lines":["ext"],"id":78},{"start":{"row":48,"column":30},"end":{"row":48,"column":31},"action":"insert","lines":["e"]},{"start":{"row":48,"column":31},"end":{"row":48,"column":32},"action":"insert","lines":["m"]},{"start":{"row":48,"column":32},"end":{"row":48,"column":33},"action":"insert","lines":["p"]},{"start":{"row":48,"column":33},"end":{"row":48,"column":34},"action":"insert","lines":["l"]},{"start":{"row":48,"column":34},"end":{"row":48,"column":35},"action":"insert","lines":["a"]},{"start":{"row":48,"column":35},"end":{"row":48,"column":36},"action":"insert","lines":["t"]},{"start":{"row":48,"column":36},"end":{"row":48,"column":37},"action":"insert","lines":["e"]}],[{"start":{"row":47,"column":54},"end":{"row":47,"column":66},"action":"insert","lines":["templateName"],"id":79}],[{"start":{"row":47,"column":67},"end":{"row":47,"column":68},"action":"insert","lines":[","],"id":80}],[{"start":{"row":47,"column":68},"end":{"row":47,"column":70},"action":"insert","lines":["''"],"id":81}],[{"start":{"row":47,"column":69},"end":{"row":47,"column":77},"action":"insert","lines":["language"],"id":82}],[{"start":{"row":47,"column":53},"end":{"row":47,"column":55},"action":"insert","lines":["''"],"id":83}],[{"start":{"row":47,"column":54},"end":{"row":47,"column":55},"action":"insert","lines":["i"],"id":84},{"start":{"row":47,"column":55},"end":{"row":47,"column":56},"action":"insert","lines":["d"]}],[{"start":{"row":47,"column":57},"end":{"row":47,"column":58},"action":"insert","lines":[","],"id":85}],[{"start":{"row":51,"column":0},"end":{"row":51,"column":5},"action":"insert","lines":["index"],"id":86}],[{"start":{"row":49,"column":5},"end":{"row":50,"column":0},"action":"insert","lines":["",""],"id":87},{"start":{"row":50,"column":0},"end":{"row":50,"column":4},"action":"insert","lines":["    "]},{"start":{"row":50,"column":4},"end":{"row":51,"column":0},"action":"insert","lines":["",""]},{"start":{"row":51,"column":0},"end":{"row":51,"column":4},"action":"insert","lines":["    "]},{"start":{"row":51,"column":4},"end":{"row":52,"column":0},"action":"insert","lines":["",""]},{"start":{"row":52,"column":0},"end":{"row":52,"column":4},"action":"insert","lines":["    "]}],[{"start":{"row":52,"column":4},"end":{"row":57,"column":5},"action":"insert","lines":["public function formSendTemplateMessages(Request $request){","        $token = $request->query('token');","        $whatsappConfig = WhatsappConfig::get();","        $whatsappTemplate = WhatsappTemplate::select('id','templateName','language')->get();","        return view('formSendTemplateMessages',compact(\"whatsappConfig\",\"token\",\"whatsappTemplate\"));","    }"],"id":88}],[{"start":{"row":59,"column":0},"end":{"row":59,"column":5},"action":"remove","lines":["index"],"id":89}],[{"start":{"row":52,"column":20},"end":{"row":52,"column":44},"action":"remove","lines":["formSendTemplateMessages"],"id":90},{"start":{"row":52,"column":20},"end":{"row":52,"column":25},"action":"insert","lines":["index"]}],[{"start":{"row":56,"column":21},"end":{"row":56,"column":45},"action":"remove","lines":["formSendTemplateMessages"],"id":92},{"start":{"row":56,"column":21},"end":{"row":56,"column":22},"action":"insert","lines":["i"]},{"start":{"row":56,"column":22},"end":{"row":56,"column":23},"action":"insert","lines":["n"]},{"start":{"row":56,"column":23},"end":{"row":56,"column":24},"action":"insert","lines":["d"]},{"start":{"row":56,"column":24},"end":{"row":56,"column":25},"action":"insert","lines":["e"]},{"start":{"row":56,"column":25},"end":{"row":56,"column":26},"action":"insert","lines":["x"]}],[{"start":{"row":53,"column":42},"end":{"row":55,"column":92},"action":"remove","lines":["","        $whatsappConfig = WhatsappConfig::get();","        $whatsappTemplate = WhatsappTemplate::select('id','templateName','language')->get();"],"id":93}],[{"start":{"row":54,"column":36},"end":{"row":54,"column":51},"action":"remove","lines":["\"whatsappConfig"],"id":95},{"start":{"row":54,"column":35},"end":{"row":54,"column":36},"action":"remove","lines":["("]}],[{"start":{"row":54,"column":28},"end":{"row":54,"column":63},"action":"remove","lines":["compact\",\"token\",\"whatsappTemplate\""],"id":96}],[{"start":{"row":54,"column":28},"end":{"row":54,"column":29},"action":"remove","lines":[")"],"id":97}],[{"start":{"row":54,"column":27},"end":{"row":54,"column":28},"action":"remove","lines":[","],"id":98}],[{"start":{"row":53,"column":5},"end":{"row":53,"column":42},"action":"remove","lines":["   $token = $request->query('token');"],"id":99}],[{"start":{"row":53,"column":5},"end":{"row":53,"column":6},"action":"insert","lines":[" "],"id":100},{"start":{"row":53,"column":6},"end":{"row":53,"column":7},"action":"insert","lines":[" "]},{"start":{"row":53,"column":7},"end":{"row":53,"column":8},"action":"insert","lines":[" "]}],[{"start":{"row":54,"column":8},"end":{"row":54,"column":29},"action":"remove","lines":["return view('index');"],"id":103},{"start":{"row":54,"column":8},"end":{"row":54,"column":101},"action":"insert","lines":["return view('formSendTemplateMessages',compact(\"whatsappConfig\",\"token\",\"whatsappTemplate\"));"]}],[{"start":{"row":54,"column":21},"end":{"row":54,"column":45},"action":"remove","lines":["formSendTemplateMessages"],"id":104},{"start":{"row":54,"column":21},"end":{"row":54,"column":22},"action":"insert","lines":["i"]},{"start":{"row":54,"column":22},"end":{"row":54,"column":23},"action":"insert","lines":["n"]},{"start":{"row":54,"column":23},"end":{"row":54,"column":24},"action":"insert","lines":["d"]},{"start":{"row":54,"column":24},"end":{"row":54,"column":25},"action":"insert","lines":["e"]},{"start":{"row":54,"column":25},"end":{"row":54,"column":26},"action":"insert","lines":["x"]}],[{"start":{"row":54,"column":54},"end":{"row":54,"column":59},"action":"remove","lines":["token"],"id":105},{"start":{"row":54,"column":53},"end":{"row":54,"column":55},"action":"remove","lines":["\"\""]}],[{"start":{"row":54,"column":55},"end":{"row":54,"column":71},"action":"remove","lines":["whatsappTemplate"],"id":106},{"start":{"row":54,"column":54},"end":{"row":54,"column":56},"action":"remove","lines":["\"\""]},{"start":{"row":54,"column":53},"end":{"row":54,"column":54},"action":"remove","lines":[","]},{"start":{"row":54,"column":52},"end":{"row":54,"column":53},"action":"remove","lines":[","]}],[{"start":{"row":53,"column":8},"end":{"row":54,"column":0},"action":"insert","lines":["",""],"id":107},{"start":{"row":54,"column":0},"end":{"row":54,"column":8},"action":"insert","lines":["        "]},{"start":{"row":54,"column":8},"end":{"row":55,"column":0},"action":"insert","lines":["",""]},{"start":{"row":55,"column":0},"end":{"row":55,"column":8},"action":"insert","lines":["        "]}],[{"start":{"row":13,"column":0},"end":{"row":14,"column":23},"action":"insert","lines":["use App\\WhatsappStatus;","use App\\WhatsappRecive;"],"id":108}],[{"start":{"row":55,"column":8},"end":{"row":55,"column":22},"action":"insert","lines":["WhatsappRecive"],"id":109}],[{"start":{"row":55,"column":8},"end":{"row":55,"column":48},"action":"insert","lines":["$whatsappConfig = WhatsappConfig::get();"],"id":110}],[{"start":{"row":55,"column":48},"end":{"row":55,"column":49},"action":"insert","lines":[" "],"id":111}],[{"start":{"row":55,"column":49},"end":{"row":55,"column":63},"action":"remove","lines":["WhatsappRecive"],"id":112}],[{"start":{"row":55,"column":26},"end":{"row":55,"column":40},"action":"remove","lines":["WhatsappConfig"],"id":113},{"start":{"row":55,"column":26},"end":{"row":55,"column":40},"action":"insert","lines":["WhatsappRecive"]}],[{"start":{"row":55,"column":42},"end":{"row":55,"column":45},"action":"remove","lines":["get"],"id":114},{"start":{"row":55,"column":42},"end":{"row":55,"column":43},"action":"insert","lines":["c"]},{"start":{"row":55,"column":43},"end":{"row":55,"column":44},"action":"insert","lines":["o"]},{"start":{"row":55,"column":44},"end":{"row":55,"column":45},"action":"insert","lines":["u"]},{"start":{"row":55,"column":45},"end":{"row":55,"column":46},"action":"insert","lines":["n"]},{"start":{"row":55,"column":46},"end":{"row":55,"column":47},"action":"insert","lines":["t"]}],[{"start":{"row":55,"column":9},"end":{"row":55,"column":23},"action":"remove","lines":["whatsappConfig"],"id":115},{"start":{"row":55,"column":9},"end":{"row":55,"column":10},"action":"insert","lines":["c"]},{"start":{"row":55,"column":10},"end":{"row":55,"column":11},"action":"insert","lines":["o"]},{"start":{"row":55,"column":11},"end":{"row":55,"column":12},"action":"insert","lines":["u"]},{"start":{"row":55,"column":12},"end":{"row":55,"column":13},"action":"insert","lines":["n"]},{"start":{"row":55,"column":13},"end":{"row":55,"column":14},"action":"insert","lines":["t"]}],[{"start":{"row":55,"column":14},"end":{"row":55,"column":28},"action":"insert","lines":["WhatsappRecive"],"id":116}],[{"start":{"row":57,"column":37},"end":{"row":57,"column":51},"action":"remove","lines":["whatsappConfig"],"id":117},{"start":{"row":57,"column":37},"end":{"row":57,"column":57},"action":"insert","lines":["$countWhatsappRecive"]}],[{"start":{"row":57,"column":37},"end":{"row":57,"column":38},"action":"remove","lines":["$"],"id":118}],[{"start":{"row":15,"column":0},"end":{"row":15,"column":21},"action":"insert","lines":["use App\\WhatsappSend;"],"id":120}],[{"start":{"row":15,"column":21},"end":{"row":16,"column":0},"action":"insert","lines":["",""],"id":121}],[{"start":{"row":16,"column":0},"end":{"row":16,"column":25},"action":"insert","lines":["use App\\WhatsappTemplate;"],"id":122}],[{"start":{"row":57,"column":8},"end":{"row":58,"column":0},"action":"insert","lines":["",""],"id":123},{"start":{"row":58,"column":0},"end":{"row":58,"column":8},"action":"insert","lines":["        "]}],[{"start":{"row":58,"column":8},"end":{"row":58,"column":20},"action":"insert","lines":["WhatsappSend"],"id":124}],[{"start":{"row":58,"column":20},"end":{"row":59,"column":0},"action":"insert","lines":["",""],"id":125},{"start":{"row":59,"column":0},"end":{"row":59,"column":8},"action":"insert","lines":["        "]}],[{"start":{"row":57,"column":8},"end":{"row":57,"column":57},"action":"insert","lines":[" $countWhatsappRecive = WhatsappRecive::count(); "],"id":126}],[{"start":{"row":58,"column":8},"end":{"row":58,"column":20},"action":"remove","lines":["WhatsappSend"],"id":127}],[{"start":{"row":57,"column":32},"end":{"row":57,"column":46},"action":"remove","lines":["WhatsappRecive"],"id":128},{"start":{"row":57,"column":32},"end":{"row":57,"column":44},"action":"insert","lines":["WhatsappSend"]}],[{"start":{"row":57,"column":15},"end":{"row":57,"column":29},"action":"remove","lines":["WhatsappRecive"],"id":129},{"start":{"row":57,"column":15},"end":{"row":57,"column":27},"action":"insert","lines":["WhatsappSend"]}],[{"start":{"row":60,"column":57},"end":{"row":60,"column":58},"action":"insert","lines":[","],"id":130}],[{"start":{"row":60,"column":58},"end":{"row":60,"column":60},"action":"insert","lines":["\"\""],"id":131}],[{"start":{"row":60,"column":59},"end":{"row":60,"column":77},"action":"insert","lines":["$countWhatsappSend"],"id":132}],[{"start":{"row":60,"column":59},"end":{"row":60,"column":60},"action":"remove","lines":["$"],"id":133}],[{"start":{"row":57,"column":8},"end":{"row":57,"column":9},"action":"remove","lines":[" "],"id":134}],[{"start":{"row":15,"column":21},"end":{"row":16,"column":25},"action":"remove","lines":["","use App\\WhatsappTemplate;"],"id":135}],[{"start":{"row":58,"column":8},"end":{"row":58,"column":22},"action":"insert","lines":["WhatsappStatus"],"id":136}],[{"start":{"row":57,"column":8},"end":{"row":57,"column":51},"action":"insert","lines":["$countWhatsappSend = WhatsappSend::count();"],"id":137}],[{"start":{"row":58,"column":8},"end":{"row":58,"column":22},"action":"remove","lines":["WhatsappStatus"],"id":138}],[{"start":{"row":57,"column":29},"end":{"row":57,"column":41},"action":"remove","lines":["WhatsappSend"],"id":139},{"start":{"row":57,"column":29},"end":{"row":57,"column":43},"action":"insert","lines":["WhatsappStatus"]}],[{"start":{"row":57,"column":14},"end":{"row":57,"column":26},"action":"remove","lines":["WhatsappSend"],"id":140},{"start":{"row":57,"column":14},"end":{"row":57,"column":28},"action":"insert","lines":["WhatsappStatus"]}],[{"start":{"row":59,"column":77},"end":{"row":59,"column":78},"action":"insert","lines":[","],"id":141}],[{"start":{"row":59,"column":78},"end":{"row":59,"column":80},"action":"insert","lines":["\"\""],"id":142}],[{"start":{"row":59,"column":79},"end":{"row":59,"column":99},"action":"insert","lines":["$countWhatsappStatus"],"id":143}],[{"start":{"row":59,"column":79},"end":{"row":59,"column":80},"action":"remove","lines":["$"],"id":144}],[{"start":{"row":53,"column":44},"end":{"row":54,"column":0},"action":"insert","lines":["",""],"id":145},{"start":{"row":54,"column":0},"end":{"row":54,"column":8},"action":"insert","lines":["        "]},{"start":{"row":54,"column":8},"end":{"row":55,"column":0},"action":"insert","lines":["",""]},{"start":{"row":55,"column":0},"end":{"row":55,"column":8},"action":"insert","lines":["        "]}],[{"start":{"row":56,"column":8},"end":{"row":56,"column":48},"action":"insert","lines":["$whatsappConfig = WhatsappConfig::get();"],"id":146}],[{"start":{"row":61,"column":99},"end":{"row":61,"column":100},"action":"insert","lines":[","],"id":147}],[{"start":{"row":61,"column":100},"end":{"row":61,"column":116},"action":"insert","lines":["\"whatsappConfig\""],"id":148}],[{"start":{"row":65,"column":0},"end":{"row":65,"column":1},"action":"insert","lines":["/"],"id":149},{"start":{"row":65,"column":1},"end":{"row":65,"column":2},"action":"insert","lines":["/"]}],[{"start":{"row":65,"column":2},"end":{"row":65,"column":69},"action":"insert","lines":["https://developers.facebook.com/docs/whatsapp/on-premises/reference"],"id":150}],[{"start":{"row":55,"column":8},"end":{"row":55,"column":42},"action":"insert","lines":["$token = $request->query('token');"],"id":151}],[{"start":{"row":61,"column":116},"end":{"row":61,"column":117},"action":"insert","lines":[","],"id":152}],[{"start":{"row":61,"column":117},"end":{"row":61,"column":119},"action":"insert","lines":["\"\""],"id":153}],[{"start":{"row":61,"column":118},"end":{"row":61,"column":124},"action":"insert","lines":["$token"],"id":154}],[{"start":{"row":61,"column":118},"end":{"row":61,"column":119},"action":"remove","lines":["$"],"id":155}],[{"start":{"row":56,"column":42},"end":{"row":56,"column":80},"action":"insert","lines":["->orderBy(\"created_at\",\"desc\")->get();"],"id":156}],[{"start":{"row":56,"column":79},"end":{"row":56,"column":85},"action":"remove","lines":[";get()"],"id":157}],[{"start":{"row":56,"column":42},"end":{"row":56,"column":72},"action":"insert","lines":["->orderBy(\"created_at\",\"desc\")"],"id":158}],[{"start":{"row":56,"column":43},"end":{"row":56,"column":44},"action":"remove","lines":[">"],"id":159},{"start":{"row":56,"column":42},"end":{"row":56,"column":43},"action":"remove","lines":["-"]}],[{"start":{"row":56,"column":81},"end":{"row":56,"column":91},"action":"remove","lines":["created_at"],"id":161},{"start":{"row":56,"column":81},"end":{"row":56,"column":87},"action":"insert","lines":["estado"]}],[{"start":{"row":54,"column":8},"end":{"row":55,"column":0},"action":"insert","lines":["",""],"id":162},{"start":{"row":55,"column":0},"end":{"row":55,"column":8},"action":"insert","lines":["        "]},{"start":{"row":55,"column":8},"end":{"row":55,"column":9},"action":"insert","lines":["r"]},{"start":{"row":55,"column":9},"end":{"row":55,"column":10},"action":"insert","lines":["e"]},{"start":{"row":55,"column":10},"end":{"row":55,"column":11},"action":"insert","lines":["t"]}],[{"start":{"row":55,"column":8},"end":{"row":55,"column":11},"action":"remove","lines":["ret"],"id":163},{"start":{"row":55,"column":8},"end":{"row":55,"column":14},"action":"insert","lines":["return"]}],[{"start":{"row":55,"column":14},"end":{"row":55,"column":15},"action":"insert","lines":["\""],"id":164},{"start":{"row":55,"column":15},"end":{"row":55,"column":16},"action":"insert","lines":["\""]}],[{"start":{"row":55,"column":15},"end":{"row":55,"column":16},"action":"insert","lines":["o"],"id":165},{"start":{"row":55,"column":16},"end":{"row":55,"column":17},"action":"insert","lines":["k"]}],[{"start":{"row":55,"column":14},"end":{"row":55,"column":15},"action":"insert","lines":[" "],"id":166}],[{"start":{"row":55,"column":19},"end":{"row":55,"column":20},"action":"insert","lines":[";"],"id":167}],[{"start":{"row":55,"column":7},"end":{"row":55,"column":20},"action":"remove","lines":[" return \"ok\";"],"id":168}],[{"start":{"row":62,"column":21},"end":{"row":62,"column":26},"action":"remove","lines":["index"],"id":169},{"start":{"row":62,"column":21},"end":{"row":62,"column":27},"action":"insert","lines":["indexx"]}],[{"start":{"row":62,"column":26},"end":{"row":62,"column":27},"action":"remove","lines":["x"],"id":170}]]},"ace":{"folds":[],"scrolltop":358,"scrollleft":0,"selection":{"start":{"row":62,"column":26},"end":{"row":62,"column":26},"isBackwards":false},"options":{"guessTabSize":true,"useWrapMode":false,"wrapToView":true},"firstLineState":{"row":24,"state":"php-start","mode":"ace/mode/php"}},"timestamp":1661542824433,"hash":"1e7cb06b87f4746a5d1f741aa474f8e3a6a2eeb6"}