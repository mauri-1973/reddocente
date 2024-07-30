<?php



namespace App\Http\Controllers\Forums;



use App\Http\Controllers\Controller;

use App\Http\Requests\StorePostRequest;

use App\Http\Requests\UpdatePostRequest;

use App\User;

use App\Categoryblog;

use App\Post;

use App\Tagblog;

use App\PostTag;

use App\Commentblog;

use App\CategoriesForums;

use App\Resource;

use App\ForumParticipants;

use App\ForumAnswers;

use App\ForumComments;

use App\TagsComments;

use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use Intervention\Image\Facades\Image as Image;

use Symfony\Component\HttpFoundation\Response;

use Illuminate\Http\JsonResponse;

use Illuminate\Support\Str;

use Illuminate\Support\Facades\Crypt;

use File;



class ForumsController extends Controller

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

    public function indexforunms()

    {
        $cat = CategoriesForums::select('categoriesforums.idcatfor as idcatfor', 'categoriesforums.created_at as created_at', 'categoriesforums.namecat as namecatfor', 'sub.name as namesub','cat.name as namecat', 'us.name as name', 'us.surname as surname')
                ->join('resources as res', 'res.id_rec', 'categoriesforums.idres')
                ->join('users as us', 'res.user_id', 'us.id')
                ->join('subcategories as sub', 'res.subcategory_id', 'sub.id_sub')
                ->join('categories as cat', 'sub.cat_id', 'cat.id_cat')
                ->get();
        
        $array = array();
        foreach($cat as $row)
        {
            $numfor = "no";
            $idforpar = "";
            $part = ForumParticipants::where(['idcatfor' =>  $row->idcatfor, 'iduser' => Auth::user()->id])->get();
            foreach($part as $p)
            {
                $numfor = (int)$p->statusidfor;
                $idforpar = $p->idforpar;
            }
            array_push($array, array("idcatfor" => $row->idcatfor, "namecatforo" => $row->namecatfor, "fecha" => $row->created_at->format('d-m-Y H:i:s'), "namesub" => $row->namesub, "namecat" => $row->namecat, "numfor" => $numfor, "idforpar" => $idforpar, "namedocente" => $row->name.' '.$row->surname));
             
        }
        
        return view('forums.indexforums', ["array" => $array]);

    }

    public function solaccfordoc($idcat = null)
    {
        $idcat = Crypt::decrypt($idcat);
        $part = ForumParticipants::select('*')->where(["iduser" => Auth::user()->id, "idcatfor" => $idcat ])->count();
        if($part == 0)
        {
            $part = new ForumParticipants;
            $part->iduser          = Auth::user()->id;
            $part->idcatfor        = $idcat;
            $part->statusidfor     = 0;
            $part->save();
            if($part->save())
            {
                return redirect()->action('Forums\ForumsController@indexforunms')->with('success', trans('multi-leng.formerror180'));
            }
            else
            {
                return redirect()->route('Forums\ForumsController@indexforunms')->with('warning', trans('multi-leng.formerror81'));
            }
        }
        if($part->count() == 1)
        {
            $part = ForumParticipants::select('*')->where(["iduser" => Auth::user()->id, "idcatfor" => $idcat ])->first();

            if($part->statusidfor == 0)
            {
                return redirect()->action('Forums\ForumsController@indexforunms')->with('success', trans('multi-leng.formerror182'));
            }
            if($part->statusidfor == 1)
            {
                return redirect()->action('Forums\ForumsController@indexforunms')->with('success', trans('multi-leng.formerror183'));
            }
            if($part->statusidfor == 2)
            {
                return redirect()->action('Forums\ForumsController@indexforunms')->with('success', trans('multi-leng.formerror184'));
            }
        }
        if($part->count() > 1)
        {
            return redirect()->route('Forums\ForumsController@indexforunms')->with('warning', trans('multi-leng.formerror81'));
        }
    }

    public function accfordoc(Request $request)
    {
        $cat = CategoriesForums::select('categoriesforums.idcatfor as idcatfor', 'categoriesforums.created_at as created_at', 'categoriesforums.namecat as namecatfor', 'sub.name as namesub','cat.name as namecat', 'us.name as name', 'us.surname as surname')
                ->join('resources as res', 'res.id_rec', 'categoriesforums.idres')
                ->join('users as us', 'res.user_id', 'us.id')
                ->join('subcategories as sub', 'res.subcategory_id', 'sub.id_sub')
                ->join('categories as cat', 'sub.cat_id', 'cat.id_cat')
                ->get();
        foreach($cat as $row)
        {
            $array = array();
            $numfor = "";
            $idforpar = "";
            $part = ForumParticipants::where(['idcatfor' =>  $row->idcatfor, 'iduser' => Auth::user()->id])->get();
            foreach($part as $p)
            {
                $numfor = $p->statusidfor;
                $idforpar = $p->idforpar;
            }
            array_push($array, array("idcatfor" => $row->idcatfor, "namecatforo" => $row->namecatfor, "fecha" => $row->created_at->format('d-m-Y H:i:s'), "namesub" => $row->namesub, "namecat" => $row->namecat, "numfor" => $numfor, "idforpar" => $idforpar, "namedocente" => $row->name.' '.$row->surname));
        }
        return view('forums.indexforums', ["array" => $array]);

    }
    

    public function addforunmsdoc()

    {
        $cat = CategoriesForums::join("resources as res", "res.id_rec", "categoriesforums.idres")
        ->where('res.user_id', Auth::user()->id)
        ->get(['categoriesforums.*']);
        $array = array();
        foreach($cat as $row)
        {
            $statuspen = ForumParticipants::where('statusidfor', 0)->where('iduser', '!=', Auth::user()->id)->count();
            $statusact = ForumParticipants::where('statusidfor', 1)->where('iduser', '!=', Auth::user()->id)->count();
            $statusact = ForumParticipants::where('statusidfor', 2)->where('iduser', '!=', Auth::user()->id)->count(); 
            array_push($array, array("idcat" => $row->idcatfor, "fecha" => $row->created_at->format('d-m-Y H:i:s'), "namecat" => $row->namecat, "uspen" => $statuspen, "usact" => $statusact, "useli" => $statusact));
        }
        $array2 = array();
        $rec = Resource::join('subcategories as sub','sub.id_sub','=','resources.subcategory_id')
        ->where('resources.user_id', Auth::user()->id)
        ->get(['resources.id_rec', 'sub.name']); 
        foreach($rec as $row)
        {
            array_push($array2, array(["id_sub" => Crypt::encrypt($row->id_rec), "name" => $row->name]));
        }
        return view('forums.indexforumsdoc', ["categories" => $array, "rec" => $array2]);

    }

    public function valnomcatfor(Request $request)

    {
        
        $idcat = Crypt::decrypt($request->selectcat);
        $val = 2;
        $val1 = CategoriesForums::where(["idres" => $idcat, "namecat" => $request->name])->count();
        if($val1 == 0)
        {
            $val = 1;
        }
        return response()->json(['status' => $val]);
    }

    public function ingcatdocfor(Request $request)

    {
        $idcat = Crypt::decrypt($request->selectcat);
        $cat = new CategoriesForums;
        $cat->namecat         = $request->namecat;
        $cat->idres          = $idcat;
        if($cat->save())
        {
            return redirect()->route('categorias-forums-docentes-registrados')->with('success', trans('multi-leng.formerror118'));
        }
        else
        {
            return redirect()->route('categorias-forums-docentes-registrados')->with('warning', trans('multi-leng.formerror119'));
        }
               

    }

    public function businffordoc(Request $request)

    {
        $idcat = Crypt::decrypt($request->idcat);
        
        if($request->tipo == 0)
        {
            $array = array();
            $statuspen = ForumParticipants::where('statusidfor', 1)->where('idcatfor', $idcat)->count();
            if($statuspen > 0)
            {
                $for = ForumParticipants::join('users as us','us.id','=','forum_participants.iduser')
                ->where('forum_participants.statusidfor', 1)
                ->where('forum_participants.iduser', '!=', Auth::user()->id)
                ->where('forum_participants.idcatfor', $idcat)
                ->get(['us.name as nameus', 'us.id as idus' ,'us.surname', 'forum_participants.idforpar']);
                foreach($for as $row) 
                {
                    array_push($array, array("nombre" => $row->nameus.' '.$row->surname, "idus" => $row->idus , "idforpar" => $row->idforpar));
                }
            }
            return response()->json(['tipo' => $request->tipo, "count" => count($array), "array" => $array ]);
        }
        if($request->tipo == 1)
        {
            $array = array();
            $statuspen = ForumParticipants::where('statusidfor', 0)->where('forum_participants.idcatfor', $idcat)->count();
            if($statuspen > 0)
            {
                $for = ForumParticipants::join('users as us','us.id','=','forum_participants.iduser')
                ->where('forum_participants.statusidfor', 0)
                ->where('forum_participants.iduser', '!=', Auth::user()->id)
                ->where('forum_participants.idcatfor', $idcat)
                ->get(['us.name as nameus', 'us.surname', 'us.id as idus' , 'forum_participants.idforpar']);
                foreach($for as $row) 
                {
                    array_push($array, array("nombre" => $row->nameus.' '.$row->surname, "idus" => $row->idus , "idforpar" => $row->idforpar));
                }
            }
            return response()->json(['tipo' => $request->tipo, "count" => count($array), "array" => $array ]);
        }
        if($request->tipo == 2)
        {
            $array = array();
            $statuspen = ForumParticipants::where('statusidfor', 2)->where('idcatfor', $idcat)->count();
            if($statuspen > 0)
            {
                $for = ForumParticipants::join('users as us','us.id','=','forum_participants.iduser')
                ->where('forum_participants.statusidfor', 2)
                ->where('forum_participants.iduser', '!=', Auth::user()->id)
                ->where('forum_participants.idcatfor', $idcat)
                ->get(['us.name as nameus', 'us.surname', 'us.id as idus' , 'forum_participants.idforpar']);
                foreach($for as $row) 
                {
                    array_push($array, array("nombre" => $row->nameus.' '.$row->surname, "idus" => $row->idus , "idforpar" => $row->idforpar));
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
        if($request->tipo == 5)
        {
            $text1 = "";
            $text2 = "";
            $text3 = "";
            $text4 = "";
            $text5 = "";
            $array = array();
            $array1 = array();
            $comm = ForumComments::where('idforcom', $idcat)->first();
            $tags = TagsComments::where('idcomment', $idcat)->orderBy("idtag","asc")->get();
            
            foreach($tags as $ta => $t)
            {
                if($ta == 0)
                {
                    $text1 = $t->nametag;
                }
                if($ta == 1)
                {
                    $text2 = $t->nametag;
                }
                if($ta == 2)
                {
                    $text3 = $t->nametag;
                }
                if($ta == 3)
                {
                    $text4 = $t->nametag;
                }
                if($ta == 4)
                {
                    $text5 = $t->nametag;
                }
            }
            array_push($array, array("titulo" => $comm->title, "contenido" => $comm->comments ));
            array_push($array1, array("tag1" => $text1, "tag2" => $text2, "tag3" => $text3, "tag4" => $text4, "tag5" => $text5 ));
            return response()->json(['idcat' => $idcat, 'forum' => $array, 'tags' => $array1 ]);
        }
        
    }

    public function editcatdocfor(Request $request)
    {
        $idcat = Crypt::decrypt($request->selectcat);

        $cat = CategoriesForums::firstOrNew(['idcatfor' =>  $idcat]);

        $cat->namecat = $request->namecat;

        if($cat->save())
        {
            return redirect()->route('categorias-forums-docentes-registrados')->with('success', trans('multi-leng.formerror127'));
        }
        else
        {
            return redirect()->route('categorias-forums-docentes-registrados')->with('warning', trans('multi-leng.formerror128'));
        }
    }

    public function elicatdocfor(Request $request)
    {

        $idcat = Crypt::decrypt($request->selectcat);

        $statuspen = ForumParticipants::where('statusidfor', 1)->where('idcatfor', $idcat)->count();

        if($statuspen > 0)
        {
            $for = ForumParticipants::join('users as us','us.id','=','forum_participants.iduser')
            ->where('forum_participants.statusidfor', 1)
            ->where('forum_participants.idcatfor', $idcat)
            ->get(['us.name as nameus', 'us.surname', 'forum_participants.idforpar']);
            
            foreach($for as $row) 
            {
                $comm = ForumComments::where('idforpar', $row->idforpar)->get();
                foreach($comm as $row1)
                {
                    $answ = ForumAnswers::where('idforcom', $row1->idforcom)->get();
                    foreach($answ as $row2)
                    {
                        $answ = ForumAnswers::where('idforans', $row2->idforans)->delete();
                    }
                    $comm = ForumComments::where('idforpar', $row->idforpar)->delete();
                }
                
            }
            $par = ForumParticipants::where('idcatfor', $row->idforpar)->delete();
        }

        $val1 = CategoriesForums::where(["idcatfor" => $idcat])->delete();

        return redirect()->route('categorias-forums-docentes-registrados')->with('warning', trans('multi-leng.formerror130'));
    }

    public function accforusuact($idcat = null)
    
    {
        setlocale(LC_ALL,"es_ES");
        \Carbon\Carbon::setLocale('es');
        $idcat = Crypt::decrypt($idcat);

        $cat = CategoriesForums::join('resources as res','res.id_rec','=','categoriesforums.idres')
        ->join('subcategories  as sub','sub.id_sub','=','res.subcategory_id')
        ->join('users as us','us.id','=','res.user_id')
        ->where(['categoriesforums.idcatfor' =>  $idcat])
        ->first(['categoriesforums.idcatfor as idcatfor', 'categoriesforums.namecat as namecat', 'categoriesforums.created_at as fecha', 'sub.name as namesubcat', 'us.name as nameus', 'us.surname as surname', 'us.email as email', 'us.id as idus']);
        $array = [];
        $array1 = array();

        $contresp = 0;
        $contvis = 0;
        $contvotos = 0;
        $conttopic = 0;
        $part = ForumParticipants::join('users as us','us.id','=','forum_participants.iduser')
        ->where(['forum_participants.idcatfor' => $idcat, "statusidfor" => 1])
        ->get(['forum_participants.idforpar', 'us.id as idus', 'us.name as nameus', 'us.surname as surname']);
        $participantes = ForumParticipants::join('users as us','us.id','=','forum_participants.iduser')
        ->where(['forum_participants.idcatfor' => $idcat, "statusidfor" => 1])
        ->distinct('us.id')
        ->count();
        
        foreach($part as $row)
        {
            $array[] = $row->idforpar;
            
        }
        $commentmore = ForumComments::whereIn('idforpar', $array)->where('visitas', '>=', 1)->orderBy('visitas', 'desc')->skip(0)->take(5)->get();
        $arraysup = array();
        foreach($commentmore as $row)
        {
            foreach($part as $row1)
            {
                if($row1->idforpar == $row->idforpar)
                {
                    $nombreus = $row1->nameus;
                    $surnameus = $row1->surname;
                    $idus = $row1->idus;
                }
                
            }
            array_push($arraysup, array('idcomment' => $row->idforcom, 'usuario' => $nombreus.' '.$surnameus , "idus" => Crypt::encrypt($idus), 'title' => $row->title,'fecha' => $row->created_at->diffForHumans(), 'idcommentcryp' => Crypt::encrypt($row->idforcom)));
        }
        $comment = ForumComments::whereIn('idforpar', $array)->orderBy('idforcom', 'desc')->get();
        foreach($comment as $row)
        {
            $conttopic++;
            foreach($part as $row1)
            {
                if($row1->idforpar == $row->idforpar)
                {
                    $nombreus = $row1->nameus;
                    $surnameus = $row1->surname;
                    $idus = $row1->idus;
                }
                
            }
            $tags = array();
            
            $valtags = TagsComments::where(['idcomment' => $row->idforcom, 'tipotag' => 'comments'])->get();
            foreach($valtags as $valt)
            {
                array_push($tags, array("nametag" => $valt->nametag)); 
            }
            $contresp = $contresp + $row->respuestas;
            $contvis = $contvis + $row->visitas;
            $contvotos = $contvotos + $row->votos;
            array_push($array1, array('idcomment' => $row->idforcom, 'usuario' => $nombreus.' '.$surnameus , "idus" => Crypt::encrypt($idus), 'contenido' => Str::limit(strip_tags($row->comments), 100), 'title' => $row->title,'fecha' => $row->created_at->diffForHumans(), 'votos' => $row->votos, 'respuestas' => $row->respuestas, 'visitas' => $row->visitas, 'tags' => $tags, 'idcommentcryp' => Crypt::encrypt($row->idforcom), 'idforpar' => Crypt::encrypt($row->idforpar), "idcat" => Crypt::encrypt($idcat), "idusreal" => $idus ));
           
        }
        
        return view('forums.vistageneralforum', ["cat" => $cat, "topic" => $array1, 'totalcoment' => $conttopic, 'votos' => $contvotos, 'part' => $participantes, 'visitas' => $contvis, "idcat" => $idcat, 'more' => $arraysup ]);
    }

    public function addnuetemfor(Request $request)

    {
        
        $idcat = Crypt::decrypt($request->idcat);
        /*$par = ForumParticipants::where(['idcatfor' => $idcat, "iduser" => Auth::user()->id])->count();
        if($par == 0)
        {
            $part = new ForumParticipants;
            $part->iduser          = Auth::user()->id;
            $part->idcatfor        = $idcat;
            $part->statusidfor     = 1;
            $part->save();
            $idforpar  = $part->idforpar;
        }
        if($par == 1)
        {
            $part = ForumParticipants::where(['idcatfor' => $idcat, "iduser" => Auth::user()->id, "statusidfor" => 1])->first();
            $idforpar  = $part->idforpar;
        }
        if($par > 1)
        {
            return redirect()->route('categorias-forums-docentes-registrados')->with('danger', trans('multi-leng.formerror138'));
        }*/
        $part = new ForumParticipants;
        $part->iduser          = Auth::user()->id;
        $part->idcatfor        = $idcat;
        $part->statusidfor     = 1;
        $part->save();
        $idforpar  = $part->idforpar;

        $part = new ForumComments;
        $part->idforpar        = $idforpar;
        $part->title           = $request->nametopic;
        $part->comments        = $request->summernote;
        $part->votos           = 0;
        $part->respuestas      = 0;
        $part->visitas         = 0;
        $part->save();
        $val = $part->idforcom;
        if($val)
        {
            if($request->tag1 != "")
            {
                $tag = new TagsComments;
                $tag->idcomment      = $val;
                $tag->nametag        = str_replace("#", "", $request->tag1);
                $tag->tipotag      = 'comments';
                $tag->save();
            }
            if($request->tag2 != "")
            {
                $tag = new TagsComments;
                $tag->idcomment      = $val;
                $tag->nametag        = str_replace("#", "", $request->tag2);
                $tag->tipotag      = 'comments';
                $tag->save();
            }
            if($request->tag3 != "")
            {
                $tag = new TagsComments;
                $tag->idcomment      = $val;
                $tag->nametag        = str_replace("#", "", $request->tag3);
                $tag->tipotag      = 'comments';
                $tag->save();
            }
            if($request->tag4 != "")
            {
                $tag = new TagsComments;
                $tag->idcomment      = $val;
                $tag->nametag        = str_replace("#", "", $request->tag4);
                $tag->tipotag      = 'comments';
                $tag->save();
            }
            if($request->tag5 != "")
            {
                $tag = new TagsComments;
                $tag->idcomment      = $val;
                $tag->nametag        = str_replace("#", "", $request->tag5);
                $tag->tipotag      = 'comments';
                $tag->save();
            }
            return redirect()->route('acceder-forum-usuarios-activos', ["idcat" => $request->idcat])->with('success', trans('multi-leng.formerror139'));
        }
        else
        {
            return redirect()->route('acceder-forum-usuarios-activos', ["idcat" => $request->idcat])->with('warnig', trans('multi-leng.formerror140'));
        }
    }
    public function deletenuetemfor(Request $request)
    {
        $idforpart = Crypt::decrypt($request->idforumpart);
        $idcat = $request->idcat;
        ForumParticipants::where('idforpar', $idforpart)->update(['statusidfor' => 0]);
        return redirect()->route('acceder-forum-usuarios-activos', ['idcat' => Crypt::encrypt((int)$idcat)])->with('success', trans('multi-leng.a257'));
    }
    public function editnuetemfor(Request $request)
    {
       
        $idcript = Crypt::decrypt($request->idcript);
        TagsComments::where('idcomment', $idcript)->delete();
        $eit = ForumComments::where('idforcom', $idcript)->update(["title" => $request->nametopic, "comments" => $request->summernote]);
        if($request->tag1 != "")
        {
            $tag = new TagsComments;
            $tag->idcomment      = $idcript;
            $tag->nametag        = str_replace("#", "", $request->tag1);
            $tag->tipotag      = 'comments';
            $tag->save();
        }
        if($request->tag2 != "")
        {
            $tag = new TagsComments;
            $tag->idcomment      = $idcript;
            $tag->nametag        = str_replace("#", "", $request->tag2);
            $tag->tipotag      = 'comments';
            $tag->save();
        }
        if($request->tag3 != "")
        {
            $tag = new TagsComments;
            $tag->idcomment      = $idcript;
            $tag->nametag        = str_replace("#", "", $request->tag3);
            $tag->tipotag      = 'comments';
            $tag->save();
        }
        if($request->tag4 != "")
        {
            $tag = new TagsComments;
            $tag->idcomment      = $idcript;
            $tag->nametag        = str_replace("#", "", $request->tag4);
            $tag->tipotag      = 'comments';
            $tag->save();
        }
        if($request->tag5 != "")
        {
            $tag = new TagsComments;
            $tag->idcomment      = $idcript;
            $tag->nametag        = str_replace("#", "", $request->tag5);
            $tag->tipotag      = 'comments';
            $tag->save();
        }
        $idcat = $request->idcat;
        return redirect()->route('acceder-forum-usuarios-activos', ['idcat' => Crypt::encrypt((int)$idcat)])->with('success', trans('multi-leng.a258'));
    }

    public function businfusucon(Request $request)
    {
        $idus = Crypt::decrypt($request->idus);

        $user = User::where('id', $idus)->first();

        return response()->json(['name' => $user->name.' '.$user->surname, "email" => $user->email, "mobile" => $user->mobile, "avatar" => $user->avatar, "profesion" => $user->profesion]);
    }

    public function vercontemfor($idcom = null, $idcat = null)
    {
        $display = "none";

        $from = date('Y-m-d').' 00:00:00';

        $to = date('Y-m-d').' 23:59:59';

        $idcom = Crypt::decrypt($idcom);

        $votos = DB::table('forum_votos')->where(['id_commen' => $idcom, 'id_user' => Auth::user()->id])->whereBetween('created_at', [$from, $to])->count();

        if($votos == 0)
        {
            $display = "block";
        }

        $comment = ForumComments::where('idforcom', $idcom)->update(["visitas" => DB::raw('visitas+1')]);

        $comment = ForumComments::where('idforcom', $idcom)->first();

        if($comment->count() > 0)
        {
            $part = ForumParticipants::join('users as us','us.id','=','forum_participants.iduser')
            ->where(['forum_participants.idforpar' => $comment->idforpar, "statusidfor" => 1])
            ->first(['forum_participants.idforpar', 'us.id as idus', 'us.name as nameus', 'us.surname as surname']);
        }
        
        $tags = TagsComments::where('idcomment', $idcom)->get(); 

        $array = array();

        $idresp = [];

        $resp = ForumAnswers::where('idforcom', $idcom)->orderBy('created_at', 'desc')->get(); 

        foreach($resp as $row)
        {
            $display1 = "none";
            $votosresp = DB::table('forum_votos')->where(['id_answ' => $row->idforans, 'id_user' => Auth::user()->id])->whereBetween('created_at', [$from, $to])->count();
            if($votosresp == 0)
            {
                $display1 = "block";
            }
            $partuno = User::where('id', $row->iduser)->first();
            array_push($array, array('name' => $partuno->name.' '.$partuno->surname, "idus" => $partuno->id, "idresp" => $row->idforans, "respuesta" => $row->answers , "votos" => $row->votos, "fecha" => $row->created_at->diffForHumans(), 'display' => $display1));
            $idresp[] = $row->idforans;
        }
        return view('forums.vistunicoforum', compact('comment', 'tags', 'part'), ["resp" => $array, "idresp" => $idresp, "idcom" => Crypt::encrypt($idcom), "idcat" => (int)$idcat, "display" => $display]);
    }

    public function envresasutem(Request $request)
    {
       
        $idcom = Crypt::decrypt($request->idforcom);
        $commentresp = ForumComments::where('idforcom', $idcom)->first();
        $part = ForumParticipants::where(['idforpar' => $commentresp->idforpar, "statusidfor" => 1])->first();
        $comment = new ForumAnswers;
        $comment->idforcom       = $idcom;
        $comment->answers        = $request->summernote;
        $comment->iduser        = Auth::user()->id;
        $comment->save();
        if((int)$request->ratingdos > 0)
        {
            $votos = DB::table('forum_votos')->insert(["id_commen" => $idcom, "id_user" =>  Auth::user()->id ]);
        }
        
        $comment = ForumComments::where('idforcom', $idcom)->update(["votos" => ((int)$commentresp->votos + (int)$request->ratingdos), "respuestas" => ((int)$commentresp->respuestas + 1)]);
        
        return redirect()->action('Forums\ForumsController@vercontemfor',['idcom' => $request->idforcom, 'idcat' => $part->idcatfor ])->with('success', trans('multi-leng.formerror146'));
    }
    
    public function guavotresusu(Request $request)
    {
        $idcom = Crypt::decrypt($request->idresp);
        $votos = ForumAnswers::where('idforans', $idcom)->first();
        if((int)$request->ratingdos > 0)
        {
            $votosresp = DB::table('forum_votos')->insert(["id_answ" => $idcom, "id_user" =>  Auth::user()->id ]);
        }
        $comment = ForumAnswers::where('idforans', $idcom)->update(["votos" => $votos->votos + $request->ratingdos]);
        return redirect()->action('Forums\ForumsController@vercontemfor',['idcom' => $request->idforcom, 'idcat' => $request->idcat])->with('success', trans('multi-leng.formerror145'));
    }
    public function eliresusu(Request $request)
    {
        $idcom = Crypt::decrypt($request->idresp);
        $comment = ForumAnswers::where('idforans', $idcom)->delete();
        return redirect()->action('Forums\ForumsController@vercontemfor',['idcom' => $request->idforcom, 'idcat' => $request->idcat])->with('danger', trans('multi-leng.formerror163'));
    }

    public function lisusuestingdoc($idcat = null, $tipo = null)
    {
        $idcat = Crypt::decrypt($idcat);
        
        if($tipo == 0)
        {
            $array = array();
            $statuspen = ForumParticipants::where('statusidfor', 1)->where('idcatfor', $idcat)->count();
            if($statuspen > 0)
            {
                $for = ForumParticipants::join('users as us','us.id','=','forum_participants.iduser')
                ->where('forum_participants.statusidfor', 1)
                ->where('forum_participants.iduser', '!=', Auth::user()->id)
                ->where('forum_participants.idcatfor', $idcat)
                ->get(['us.name as nameus', 'us.id as idus' ,'us.surname', 'forum_participants.idforpar', 'forum_participants.created_at as created_at']);
                foreach($for as $row) 
                {
                    array_push($array, array("nombre" => $row->nameus.' '.$row->surname, "idus" => $row->idus , "idforpar" => $row->idforpar, "fecha" => $row->created_at->format('d-m-Y H:i:s')));
                }
            }
            
        }
        if($tipo == 1)
        {
            $array = array();
            $statuspen = ForumParticipants::where('statusidfor', 0)->where('forum_participants.idcatfor', $idcat)->count();
            if($statuspen > 0)
            {
                $for = ForumParticipants::join('users as us','us.id','=','forum_participants.iduser')
                ->where('forum_participants.statusidfor', 0)
                ->where('forum_participants.iduser', '!=', Auth::user()->id)
                ->where('forum_participants.idcatfor', $idcat)
                ->get(['us.name as nameus', 'us.surname', 'us.id as idus' , 'forum_participants.idforpar', 'forum_participants.created_at as created_at']);
                foreach($for as $row) 
                {
                    array_push($array, array("nombre" => $row->nameus.' '.$row->surname, "idus" => $row->idus , "idforpar" => $row->idforpar, "fecha" => $row->created_at->format('d-m-Y H:i:s')));
                }
            }
            
        }
        if($tipo == 2)
        {
            $array = array();
            $statuspen = ForumParticipants::where('statusidfor', 2)->where('idcatfor', $idcat)->count();
            if($statuspen > 0)
            {
                $for = ForumParticipants::join('users as us','us.id','=','forum_participants.iduser')
                ->where('forum_participants.statusidfor', 2)
                ->where('forum_participants.iduser', '!=', Auth::user()->id)
                ->where('forum_participants.idcatfor', $idcat)
                ->get(['us.name as nameus', 'us.surname', 'us.id as idus' , 'forum_participants.idforpar' , 'forum_participants.created_at as created_at']);
                foreach($for as $row) 
                {
                    array_push($array, array("nombre" => $row->nameus.' '.$row->surname, "idus" => $row->idus , "idforpar" => $row->idforpar, "fecha" => $row->created_at->format('d-m-Y H:i:s')));
                }
            }
        }
        return view('forums.listadousuariosforum', ['tipo' => $tipo, "count" => count($array), "array" => $array ]);
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
        $for = ForumParticipants::where('idforpar', $idforpar)->update(['statusidfor' => $tipo]);
        return redirect()->route('categorias-forums-docentes-registrados')->with($text1, $text);
    }
    
}