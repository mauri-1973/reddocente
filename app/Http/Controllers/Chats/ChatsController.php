<?php



namespace App\Http\Controllers\Chats;



use App\Http\Controllers\Controller;

use App\Http\Requests\StorePostRequest;

use App\Http\Requests\UpdatePostRequest;

use App\Categoryblog;

use App\Post;

use App\Tagblog;

use App\PostTag;

use App\Commentblog;

use App\Message_Users;

use App\Messages;

use App\StatusUserReg;

use App\CategoriesChats;

use App\MessageAuth;

use App\Resource;

use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use Intervention\Image\Facades\Image as Image;

use Symfony\Component\HttpFoundation\Response;

use Illuminate\Http\JsonResponse;

use File;

use Crypt;



class ChatsController extends Controller

{

    /**

    *

    * allow blog only

    *

    */

    public function __construct() {

        //$this->middleware(['role:admin|creator']);

        $this->middleware('auth');

    }

    /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function buschatusureg()

    {
        $cat = CategoriesChats::join("resources as res", "res.id_rec", "categorieschats.idres")
        ->where('res.user_id', Auth::user()->id)
        ->get(['categorieschats.*']);
        $array = array();
        foreach($cat as $row)
        {
            $statuspen = MessageAuth::where('statususerchat', 0)->where('iduserchat', '!=', Auth::user()->id)->where('idcatchat', $row->idcatchat)->count();
            $statusact = MessageAuth::where('statususerchat', 1)->where('iduserchat', '!=', Auth::user()->id)->where('idcatchat', $row->idcatchat)->count();
            $statuseli = MessageAuth::where('statususerchat', 2)->where('iduserchat', '!=', Auth::user()->id)->where('idcatchat', $row->idcatchat)->count(); 
            array_push($array, array("idcat" => $row->idcatchat, "fecha" => $row->created_at->format('d-m-Y H:i:s'), "namecat" => $row->namecat, "uspen" => $statuspen, "usact" => $statusact, "useli" => $statuseli));
        }
        $array2 = array();
        $rec = Resource::join('subcategories as sub','sub.id_sub','=','resources.subcategory_id')
        ->where('resources.user_id', Auth::user()->id)
        ->get(['resources.id_rec', 'sub.name']); 
        foreach($rec as $row)
        {
            array_push($array2, array(["id_sub" => Crypt::encrypt($row->id_rec), "name" => $row->name]));
        }
        return view('chats.indexchats',  ["categories" => $array, "rec" => $array2]);

    }

    public function buschatusuregest()

    {
        $cat = CategoriesChats::join("resources as res", "res.id_rec", "categorieschats.idres")
                ->join("subcategories  as sub", "res.subcategory_id", "sub.id_sub")
                ->join("categories  as cat", "sub.cat_id", "cat.id_cat")
                ->get(['categorieschats.*', 'sub.name as namesub', 'cat.name as namecatcat']);
        $array = array();
        foreach($cat as $row)
        {
            $status = 10;
            $statuspen = MessageAuth::where('iduserchat', Auth::user()->id)->count();
            if($statuspen > 0) 
            {
                $statuspen = MessageAuth::where('iduserchat', Auth::user()->id)->first();
                $status = $statuspen->statususerchat;
            }
            array_push($array, array("idcatchat" => $row->idcatchat, "fecha" => $row->created_at->format('d-m-Y H:i:s'), "namecatchat" => $row->namecat, "statusus" => $status, "namecat" => $row->namecatcat, "namesub" => $row->namesub));
        }
        
        return view('chats.indexchatsest',  ["categories" => $array]);

    }

    public function agecatchadoc(Request $request)

    {
        $idcat = Crypt::decrypt($request->selectcat);
        $cat = new CategoriesChats;
        $cat->namecat         = $request->namecat;
        $cat->idres          = $idcat;
        if($cat->save())
        {
            $mes = new MessageAuth;
            $mes->idcatchat        = $cat->idcatchat;
            $mes->iduserchat          = Auth::user()->id;
            $mes->statususerchat         = 1;
            $mes->save();
            return redirect()->route('buscar-chats-usuario-registrado')->with('success', trans('multi-leng.formerror118'));
        }
        else
        {
            return redirect()->route('buscar-chats-usuario-registrado')->with('warning', trans('multi-leng.formerror119'));
        }
          
    }

    public function valnomcatchats(Request $request)

    {
        
        $idcat = Crypt::decrypt($request->selectcat);
        $val = 2;
        $val1 = CategoriesChats::where(["idres" => $idcat, "namecat" => $request->name])->count();
        if($val1 == 0)
        {
            $val = 1;
        }
        return response()->json(['status' => $val]);
    }

    public function businfchatdoc(Request $request)

    {
        $idcat = Crypt::decrypt($request->idcat);
        
        if($request->tipo == 0)
        {
            $array = array();
            $statuspen = MessageAuth::where('statususerchat', 1)->where('idcatchat', $idcat)->count();
            if($statuspen > 0)
            {
                $for = MessageAuth::join('users as us','us.id','=','message_auth.iduserchat')
                ->where('message_auth.statususerchat', 1)
                ->where('message_auth.iduserchat', '!=', Auth::user()->id)
                ->where('message_auth.idcatchat', $idcat)
                ->get(['us.name as nameus', 'us.id as idus' ,'us.surname', 'message_auth.idauth']);
                foreach($for as $row) 
                {
                    array_push($array, array("nombre" => $row->nameus.' '.$row->surname, "idus" => $row->idus , "idforpar" => $row->idauth));
                }
            }
            return response()->json(['tipo' => $request->tipo, "count" => count($array), "array" => $array ]);
        }
        if($request->tipo == 1)
        {
            $array = array();
            $statuspen = MessageAuth::where('statususerchat', 0)->where('idcatchat', $idcat)->count();
            if($statuspen > 0)
            {
                $for = MessageAuth::join('users as us','us.id','=','message_auth.iduserchat')
                ->where('message_auth.statususerchat', 0)
                ->where('message_auth.iduserchat', '!=', Auth::user()->id)
                ->where('message_auth.idcatchat', $idcat)
                ->get(['us.name as nameus', 'us.id as idus' ,'us.surname', 'message_auth.idauth']);
                foreach($for as $row) 
                {
                    array_push($array, array("nombre" => $row->nameus.' '.$row->surname, "idus" => $row->idus , "idforpar" => $row->idauth));
                }
            }
            return response()->json(['tipo' => $request->tipo, "count" => count($array), "array" => $array ]);
        }
        if($request->tipo == 2)
        {
            $array = array();
            $statuspen = MessageAuth::where('statususerchat', 2)->where('idcatchat', $idcat)->count();
            if($statuspen > 0)
            {
                $for = MessageAuth::join('users as us','us.id','=','message_auth.iduserchat')
                ->where('message_auth.statususerchat', 2)
                ->where('message_auth.iduserchat', '!=', Auth::user()->id)
                ->where('message_auth.idcatchat', $idcat)
                ->get(['us.name as nameus', 'us.id as idus' ,'us.surname', 'message_auth.idauth']);
                foreach($for as $row) 
                {
                    array_push($array, array("nombre" => $row->nameus.' '.$row->surname, "idus" => $row->idus , "idforpar" => $row->idauth));
                }
            }
            return response()->json(['tipo' => $request->tipo, "count" => count($array), "array" => $array ]);
        }
        if($request->tipo == 3)
        {
            $array = array();
            $array1 = array();
            $array2 = array();
            $statuspen = ForumParticipants::where('statusidfor', 1)->where('idcatfor', $idcat)->count();
            if($statuspen > 0)
            {
                $for = ForumParticipants::join('users as us','us.id','=','forum_participants.iduser')
                ->where('forum_participants.statusidfor', 1)
                ->where('forum_participants.idcatfor', $idcat)
                ->get(['us.name as nameus', 'us.surname', 'us.id as idus', 'forum_participants.idforpar']);
                
                foreach($for as $row) 
                {
                    $comm = ForumComments::where('idforpar', $row->idforpar)->get();
                    foreach($comm as $row1)
                    {
                        $array1 = array();
                        $answ = ForumAnswers::where('idforcom', $row1->idforcom)->get();
                        foreach($answ as $row2)
                        {
                            $array2 = array();
                            array_push($array2, array("idforans" => $row2->idforans, "answers" => $row2->answers));
                        }
                        array_push($array1, array("idforcom" => $row1->idforcom, "comments" => $row1->comments, "resp" => $array2));
                    }

                    array_push($array, array("nombre" => $row->nameus.''.$row->surname, "idus" => $row->idus , "idforpar" => $row->idforpar, "comments" => $array1));
                }
            }
            return response()->json(['tipo' => $request->tipo, "count" => count($array), "array" => $array ]);
        }
        if($request->tipo == 10)
        {
            $idchat = Crypt::decrypt($request->idcat);
            $act = new MessageAuth;
            $act->idcatchat       = $idchat;
            $act->iduserchat      =  Auth::user()->id;
            $act->statususerchat  =  0;
            if($act->save())
            {
                return response()->json(['tipo' => $request->tipo, "count" => true]);
            }

            return response()->json(['tipo' => $request->tipo, "count" => false]);
        }
        
    }

    public function lisusuestingdoc($idcat = null, $tipo = null)
    {
        $idcat = Crypt::decrypt($idcat);
        if($tipo == 0)
        {
            $array = array();
            $statuspen = MessageAuth::where('statususerchat', 1)->where('idcatchat', $idcat)->where('iduserchat', '!=', Auth::user()->id)->count();
            if($statuspen > 0)
            {
                $for = MessageAuth::select('us.name as nameus', 'us.id as idus' ,'us.surname', 'message_auth.idauth', 'message_auth.created_at as created_at')
                ->join('users as us','us.id','=','message_auth.iduserchat')
                ->where('message_auth.statususerchat', 1)
                ->where('message_auth.iduserchat', '!=', Auth::user()->id)
                ->where('message_auth.idcatchat', $idcat)
                ->get();
                foreach($for as $row) 
                {
                    array_push($array, array("nombre" => $row->nameus.' '.$row->surname, "idus" => $row->idus , "idforpar" => $row->idauth, "fecha" => $row->created_at->format('d-m-Y H:i:s')));
                }
            }
            
        }
        if($tipo == 1)
        {
            $array = array();
            $statuspen = MessageAuth::where('statususerchat', 0)->where('idcatchat', $idcat)->where('iduserchat', '!=', Auth::user()->id)->count();
            if($statuspen > 0)
            {
                $for = MessageAuth::select('us.name as nameus', 'us.id as idus' ,'us.surname', 'message_auth.idauth', 'message_auth.created_at as created_at')
                ->join('users as us','us.id','=','message_auth.iduserchat')
                ->where('message_auth.statususerchat', 0)
                ->where('message_auth.iduserchat', '!=', Auth::user()->id)
                ->where('message_auth.idcatchat', $idcat)
                ->get();
                foreach($for as $row) 
                {
                    array_push($array, array("nombre" => $row->nameus.' '.$row->surname, "idus" => $row->idus , "idforpar" => $row->idauth , "fecha" => $row->created_at->format('d-m-Y H:i:s')));
                }
            }
            
        }
        if($tipo == 2)
        {
            $array = array();
            $statuspen = MessageAuth::where('statususerchat', 2)->where('idcatchat', $idcat)->where('iduserchat', '!=', Auth::user()->id)->count();
            if($statuspen > 0)
            {
                $for = MessageAuth::select('us.name as nameus', 'us.id as idus' ,'us.surname', 'message_auth.idauth', 'message_auth.created_at as created_at')
                ->join('users as us','us.id','=','message_auth.iduserchat')
                ->where('message_auth.statususerchat', 2)
                ->where('message_auth.iduserchat', '!=', Auth::user()->id)
                ->where('message_auth.idcatchat', $idcat)
                ->get();
                foreach($for as $row) 
                {
                    array_push($array, array("nombre" => $row->nameus.' '.$row->surname, "idus" => $row->idus , "idforpar" => $row->idauth, "fecha" => $row->created_at->format('d-m-Y H:i:s')));
                }
            }
        }
        return view('chats.listadousuarioschats', ['tipo' => $tipo, "count" => count($array), "array" => $array ]);
    }

    public function accusudocfor($tipo = null, $idforpar = null)
    {
        if($tipo == 1)
        {
            $text = trans('multi-leng.formerror187');
            $text1 = "success";
        }
        if($tipo == 2)
        {
            $text = trans('multi-leng.formerror184');
            $text1 = "danger";
        }
        $idforpar = Crypt::decrypt($idforpar);
        $for = MessageAuth::where('idauth', $idforpar)->update(['statususerchat' => $tipo]);
        return redirect()->route('buscar-chats-usuario-registrado')->with($text1, $text);
    }

    public function ingchatusureg($id = null)

    {
        $array = array();

        $idchat = Crypt::decrypt($id);
        
        $flag = MessageAuth::where(['iduserchat' => Auth::user()->id, 'statususerchat' => 1, 'idcatchat' => $idchat])->count();
        
        if($flag == 1)
        {
            $for = MessageAuth::select('us.name as nameus', 'us.id as idus' ,'us.surname', 'us.cargo_us as cargo' , 'message_auth.idauth')
                ->join('users as us','us.id','=','message_auth.iduserchat')
                ->where('message_auth.statususerchat', 1)
                ->where('message_auth.iduserchat', '!=', Auth::user()->id)
                ->where('message_auth.idcatchat', $idchat)
                ->get();
            foreach($for as $us)
            {
                $total = 0;
                
                $status = StatusUserReg::where('status_id_user', $us->idus)->count();
                switch (true) {
                    case ($status == 1):
                        $fecha_f = date("d-m-Y H:i:s");
                        $status = StatusUserReg::where('status_id_user', $us->idus)->first();
                        $minutos = (strtotime($status->status_hour)-strtotime($fecha_f))/60;
                        $minutos = abs($minutos); $minutos = floor($minutos);
                        if($minutos >= 0 && $minutos <= 4)
                        {
                            $minutos = 1;
                        }
                        else 
                        {
                            $minutos = 0;
                        }
                    break;
                    case ($status == 0):
                        $minutos = 0;
                    break;
                    default:
                        $minutos = 0;
                    break;
                }
                array_push($array, array("id" => $us->idus, "name" => $us->nameus.' '.$us->surname, 'cargo' => $us->cargo,  "usuario_status" => $minutos ));
            }

            return view('chats.salachat', ["arreglo" => $array]);
        }
        else
        {
            $name = CategoriesChats::where(['idcatchat' => $id])->first();
            return redirect()->route('buscar-chats-usuario-registrado-est')->with('danger', trans('multi-leng.formerror280').$name->namecat);
        }
        return view('chats.salachat', []);

    }












    
    public function index()
    {
        $array = array();
        switch (true) 
        {
            case (Auth::user()->role_us == "administrador"):
                $users = User::whereNotIn('id', [536])->where('role_us', "empresa")->orWhere('role_us', "empresa-area")->orWhere('role_us', "empresa-inv")->get();
                
                $val = "chatemp.index";
                $tipo = "adm";
                
            break;
            
            case (Auth::user()->role_us == "empresa" || Auth::user()->role_us == "empresa-area" || Auth::user()->role_us == "empresa-inv"):

                $users = User::where('role_us', "administrador")->get();
                $val = "chatemp.index";
                $tipo = "emp";

            break;
        }
        
        foreach($users as $us)
        {
            $total = 0;
            if($tipo == "adm")
            {
                $idprinc1 = Message_Users::where('sender_id', $us->id)->count();
                switch (true) 
                {
                    case ($idprinc1 > 0):
                        $idprinc1 = Message_Users::where('sender_id', $us->id)->first();
                        $total = Messages::where(['message_users_id' => $idprinc1->id, 'status_send' => 'Pendiente'])->count();
                    break;
                }
                
            }
            $status = DB::table('statususerreg')->where('status_id_user', $us->id)->count();
            switch (true) {
                case ($status == 1):
                    $fecha_f = date("d-m-Y H:i:s");
                    $status = DB::table('statususerreg')->where('status_id_user', $us->id)->first();
                    $minutos = (strtotime($status->status_hour)-strtotime($fecha_f))/60;
                    $minutos = abs($minutos); $minutos = floor($minutos);
                    if($minutos >= 0 && $minutos <= 4)
                    {
                        $minutos = 1;
                    }
                    else
                    {
                        $minutos = 0;
                    }
                break;
                case ($status == 0):
                   $minutos = 0;
                break;
                default:
                    $minutos = 0;
                break;
            }
            $status = 0;
            if($us->empresa_id > 0)
            {
                $nombreemp = DB::table('empresa')->where('emp_id', $us->empresa_id)->first();
                $nombreemp = $nombreemp->emp_nombre;
            }
            else
            {
                $nombreemp = "Administrador-Plataforma";
            }
            
           array_push($array, array("id" => $us->id, "name" => $us->name, "usuario_status" => $minutos, "empresa" => $nombreemp, "tipo" => $tipo, "total" => $total ));
        }
        return view('chat.'.$val,  compact('users'), ["arreglo" => $array]);
    }
    public function check($recieverId = null)
    {
        
        $senderId = Auth::user()->id;
        $recieverId = Crypt::decrypt($recieverId);
        $data = [
            'sender_id' => $senderId,
            'reciever_id' => $recieverId
        ];
        $data2 = [
            'sender_id' => $recieverId,
            'reciever_id' => $senderId
        ];
       
        $checkExist = Message_Users::where('sender_id', $senderId)->where('reciever_id', $recieverId)->first();
        
        if(!$checkExist)
        {
            $createConvo = Message_Users::create($data);
            $createConvo2 = Message_Users::create($data2);
            return $createConvo->id;
        }
        else
        {
            return $checkExist->id;
        }
    }
    public function load($reciever, $sender){

        
        $reciever = Crypt::decrypt($reciever);
        $sender = Crypt::decrypt($sender);

        $boxType = "";

        $id1 = Message_Users::where('sender_id', $sender)->where('reciever_id',$reciever)->count();
        
        $id2 = Message_Users::where('reciever_id', $sender)->where('sender_id',$reciever)->count();
        switch (true) {
            case ($id1 > 0 && $id2 > 0):
                $id1 = Message_Users::where('sender_id', $sender)->where('reciever_id',$reciever)->pluck('id');
                
                $id2 = Message_Users::where('reciever_id', $sender)->where('sender_id',$reciever)->pluck('id');
                
                $allMessages = Messages::whereIn('message_users_id', $id1)->orWhereIn('message_users_id', $id2)->orderBy('id', 'asc')->get();
            break;
            
            default:
            $allMessages = array();
            break;
        }
        
        // foreach($allMessages as $row){
        //     if($id1[0]==$row['message_users_id']){$boxType = "p-2 recieverBox ml-auto";}else{$boxType = "float-left p-2 mb-2 senderBox";}
        //     echo "<div class='p-2 d-flex'>";
        //     echo "<div class='".$boxType."'>";
        //     echo "<p>".$row['message']."</p>";
        //     echo "</div>";
        //     echo "</div>";
        // }
        $tobePassed = [$allMessages, $id1];
        return $tobePassed;
    }
    public function retrieveNew($reciever, $sender, $lastId){
        $id1 = Message_Users::where('sender_id', $sender)->where('reciever_id',$reciever)->count('id');
        $id2 = Message_Users::where('reciever_id', $sender)->where('sender_id',$reciever)->count('id');
        switch (true) {
            case ($id1 > 0 && $id2 > 0):
                $id1 = Message_Users::where('sender_id', $sender)->where('reciever_id',$reciever)->pluck('id');
                $id2 = Message_Users::where('reciever_id', $sender)->where('sender_id',$reciever)->pluck('id');
                $allMessages = Messages::where('id','>=',$lastId)->whereIn('message_users_id', $id2)->orderBy('id', 'asc')->get();
                
            break;
            
            default:
            $allMessages = array();
            break;
        }
        
        return $allMessages;
    }
    public function store(Request $request){
        $data = [
            'message_users_id' => $request->convo_id,
            'message' => $request->message
        ];

        $sendMessage = Messages::create($data);

        if($sendMessage){
            switch (true) 
            {
                case (Auth::user()->role_us == "administrador"):
                    $idprinc1 = Message_Users::where('id', $request->convo_id)->first();
                    $idprinc2 = Message_Users::where(['sender_id' => $idprinc1->reciever_id, 'reciever_id'=> $idprinc1->sender_id])->first();
                    $actstatus = Messages::where(['message_users_id' => $idprinc2->id, 'status_send' => 'Pendiente'])->count();
                    switch (true) {
                        case ($actstatus > 0):
                            Messages::where(['message_users_id' => $idprinc2->id, 'status_send' => 'Pendiente'])->update(['status_send' => 'Enviado', 'time_send' => date('d-m-Y H:i:s')]);
                            Messages::where('id', $sendMessage->id)->update(['status_send' => 'EnviadoRespuesta', 'time_send' => date('d-m-Y H:i:s')]);
                            return "Mensaje enviado. Estado Eviado y respuesta";
                        break;
                        case ($actstatus == 0):
                            Messages::where('id', $sendMessage->id)->update(['status_send' => 'EnviadoPregunta', 'time_send' => date('d-m-Y H:i:s')]);
                            return "Mensaje enviado. Estado Enviado y pregunta";
                        break;
                    }
                    
                break;
                case (Auth::user()->role_us == "empresa" || Auth::user()->role_us == "empresa-area"):
                     Messages::where('id', $sendMessage->id)->update(['status_send' => 'Pendiente', 'time_send' => date('d-m-Y H:i:s')]);
                     return "Mensaje enviado. Estado Pendiente";
                break;
            }
            
        }
        else
        {
            return "Error sending message.";
        }
    }
    public function useronline()
    {
        $status = DB::table('statususerreg')->select('*')->where('status_id_user', '=', Auth::user()->id)->count();
        $var = "ingresado";
        switch (true) {
            case ($status == 1):
                DB::table('statususerreg')->where('status_id_user', '=', Auth::user()->id)->update(["status_hour" => date("d-m-Y H:i:s")]);
                $var = "actualizado";
            break;
            case ($status == 0):
                DB::table('statususerreg')->insert(["status_id_user" => Auth::user()->id, "status_hour" => date("d-m-Y H:i:s")]);
            break;
        }
        return json_encode(["status" => $var]);
    }


    public function regusulin()
    {
        $status = StatusUserReg::select('*')->where('status_id_user', '=', Auth::user()->id)->count();
        $var = "ingresado";
        switch (true) {
            case ($status == 1):
                StatusUserReg::where('status_id_user', '=', Auth::user()->id)->update(["status_hour" => date("d-m-Y H:i:s")]);
                $var = "actualizado";
            break;
            case ($status == 0):
                $ing = new StatusUserReg;
                $ing->status_id_user = Auth::user()->id;
                $ing->status_hour= date("d-m-Y H:i:s");
                $ing->save();
            break;
        }
        return json_encode(["status" => $var]);
    }

}