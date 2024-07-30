<?php



namespace App\Http\Controllers\Brainstorm;



use App\User;

use App\Category;

use App\Subcategory;

use App\Resource;

use App\Book;

use App\CategoryDocAdm;

use App\BookAdm;

use App\Brainstorm;

use App\BrainstormComment;

use App\BrainstormParticipants;

use Spatie\Permission\Models\Role;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Gate;

use App\Http\Controllers\Controller;

use Illuminate\Validation\Rule;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\DB;

use App\UserLoginLog;

use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\Crypt;



class BrainstormController extends Controller

{
    public function __construct() {

        //$this->middleware(['role:admin|creator']);

        $this->middleware('auth');

    }
   /**

    *

    * allow admin only

    *

    */


    public function indexbrainstorm()

    {
        $user = User::where('id', Auth::user()->id)->first();

        $brain = BrainstormComment::select('brainstorm_comment.*')
        ->join('brainstorm_participants as brapar', 'brainstorm_comment.idbrainpart', 'brapar.idbrainstorm')
        ->where('brapar.iduser', Auth::user()->id)
        ->get();

        $ideas = 0;
        $numbrain = 0;
        $array = array();
        foreach($brain as $row)
        {
            $array = array();
            
            $ideas = Brainstorm::where(['brainscomm' =>  $row->idbraincom])->count();
            
            $numbrain++;

            array_push($array, array("idbraincom" => $row->idbraincom, "titlebrain" => $row->titlebrain , "contenido" => $row->commbrain, "fecha" => $row->created_at->diffForHumans(), "ideas" => $ideas));
        }

        return view('brains.indexbrain', ["array" => $array, "user" => $user, "num" => $numbrain]);

    }

    public function addnueidereg(Request $request)
    {
        $valpart = BrainstormParticipants::where('iduser', Auth::user()->id)->count();
        if($valpart == 0)
        {
            $valpart = new BrainstormParticipants;
            $valpart->iduser       = Auth::user()->id;
            $valpart->statususer   = 1;
            $valpart->save();

            $valpart = BrainstormParticipants::where('iduser', Auth::user()->id)->first();
            if($valpart->statususer == 1)
            {
                $comment = new BrainstormComment;
                $comment->idbrainpart   = $valpart->idbrainstorm;
                $comment->titlebrain    = $request->nametopic;
                $comment->commbrain     = $request->summernote;
                $comment->brains        = 0;
                $comment->save();
                return redirect()->route('lluvia-de-ideas-usuarios-registrados')->with('success', trans('multi-leng.formerror205'));
            }
            else
            {
                return redirect()->route('lluvia-de-ideas-usuarios-registrados')->with('danger', trans('multi-leng.formerror206'));
            }
        }
        else
        {
            $valpart = BrainstormParticipants::where('iduser', Auth::user()->id)->first();
            if($valpart->statususe == 1)
            {
                $comment = new BrainstormComment;
                $comment->idbrainpart   = $valpart->idbrainstorm;
                $comment->titlebrain    = $request->nametopic;
                $comment->commbrain     = $request->summernote;
                $comment->brains        = 0;
                $comment->save();
                return redirect()->route('lluvia-de-ideas-usuarios-registrados')->with('success', trans('multi-leng.formerror205'));
            }
            else
            {
                return redirect()->route('lluvia-de-ideas-usuarios-registrados')->with('danger', trans('multi-leng.formerror206'));
            }
        }
    }

    public function anenueideusureg($idcom = null)
    {
        $idcom = Crypt::decrypt($idcom);
        $comment = BrainstormComment::where(["idbraincom" => $idcom])->count();
        if($comment == 1)
        {
            $comment = BrainstormComment::where(["idbraincom" => $idcom])->first();
            $array = array();
            $resp = Brainstorm::where(['brainscomm' =>  $idcom])->get();
            $count = Brainstorm::where(['brainscomm' =>  $idcom])->count();
            return view('brains.anexbrain', ["comment" => $comment, "resp" => $resp, "count" => $count]);
            
        }
        else
        {
            return redirect()->route('lluvia-de-ideas-usuarios-registrados')->with('danger', trans('multi-leng.formerror209'));
        }
    }
    
    public function envideaneusureg(Request $request)
    {
        $idcom = Crypt::decrypt($request->idforcom);
        $brains = new Brainstorm;
        $brains->brainscomm     = $idcom;
        $brains->brainstext    = $request->summernote;
        if($brains->save())
        {
            $comment = BrainstormComment::where(["idbraincom" => $idcom])->first();
            
            $comment = BrainstormComment::where(["idbraincom" => $idcom])->update(["brains" => $comment->brains + 1]);

            $text = trans('multi-leng.formerror213');

            $tipo = "success";
        }
        else
        {
            $text = trans('multi-leng.formerror214');

            $tipo = "danger";
        }
        
        return redirect()->action('Brainstorm\BrainstormController@anenueideusureg',['idcom' => $request->idforcom])->with($tipo, $text);
    }

    public function eliideaneusureg(Request $request)
    {
        $idcom = Crypt::decrypt($request->idcom);
        
        $idresp = Crypt::decrypt($request->idresp);

        $resp = Brainstorm::where(["brains" => $idresp])->delete();

        $comment = BrainstormComment::where(["idbraincom" => $idcom])->first();
            
        $comment = BrainstormComment::where(["idbraincom" => $idcom])->update(["brains" => $comment->brains - 1]);

        return redirect()->action('Brainstorm\BrainstormController@anenueideusureg',['idcom' => $request->idcom])->with("danger", trans('multi-leng.formerror219'));
    }

    public function eliidepriusureg(Request $request)
    {
        $idcom = Crypt::decrypt($request->idcom);

        $resp = Brainstorm::where(["brainscomm" => $idcom])->delete();

        $comment = BrainstormComment::where(["idbraincom" => $idcom])->delete();

        return redirect()->route('lluvia-de-ideas-usuarios-registrados')->with('danger', trans('multi-leng.formerror221'));
    }
    

    public function ediideaneusureg(Request $request)
    {
        

        $idcom = Crypt::decrypt($request->idcom);
            
        $comment = BrainstormComment::where(["idbraincom" => $idcom])->update(["titlebrain" => $request->nametopic, "commbrain" => $request->summernotedos ]);

        return redirect()->action('Brainstorm\BrainstormController@anenueideusureg',['idcom' => $request->idcom])->with("success", trans('multi-leng.formerror220'));
    }

    public function ediideaneusureganex(Request $request)
    {
        

        $idcom = Crypt::decrypt($request->idcom);

        $idresp = Crypt::decrypt($request->idresp);
            
        $comment = Brainstorm::where(["brains" => $idresp])->update(["brainstext" => $request->summernotedos ]);

        return redirect()->action('Brainstorm\BrainstormController@anenueideusureg',['idcom' => $request->idcom])->with("success", trans('multi-leng.formerror220'));
    }
    

}

