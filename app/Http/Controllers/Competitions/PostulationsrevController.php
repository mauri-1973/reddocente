<?php



namespace App\Http\Controllers\Competitions;



use App\Http\Controllers\Controller;

use App\Http\Requests\StorePostRequest;

use App\Http\Requests\UpdatePostRequest;

use App\Categoryblog;

use App\Post;

use App\Tagblog;

use App\TagsComp;

use App\PostTag;

use App\Commentblog;

use App\CategoriesCompetitions;

use App\Competitions;

use App\FilesCompetitions;

use App\CompetitionsTags;

use App\Postulations;

use App\DetailsResources;

use App\Answers;

use App\AnswersDirector;

use App\AnswersFiles;

use App\AnswersStatus;

use App\Corrections;

use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use Intervention\Image\Facades\Image as Image;

use Symfony\Component\HttpFoundation\Response;

use Illuminate\Http\JsonResponse;

use Barryvdh\DomPDF\Facade\Pdf;

use File;

use Crypt;

use Mail;



class PostulationsrevController extends Controller

{

    /**

    *

    * allow blog only

    *

    */

    public function __construct() {

        //$this->middleware(['role:admin|creator']);

        $this->middleware(['role:revisor|admin']);

    }

    /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function index()

    {

        abort_if(Gate::denies('post_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');



        //$posts = (new \App\Post)->getDashboardPosts()->with('categoriesblog','user')->get();

        $post = Post::join('categoriesblog as p', 'p.category_id', '=', 'categoriesblog.id_cat')

        ->where('p.is_published', 1)

        ->get(['categoriesblog.*']);

        return view('blog.posts.index', compact('posts'));

    }
    
    public function verposconreg($id = null)
    {
        $array1 = array();

        $id = Crypt::decrypt($id);
        
        $comp = Competitions::join('postulations as post', 'post.idconc', '=', 'competitions.idcomp')

        ->join('categoriesCompetitions  as cat', 'competitions.category_id', '=', 'cat.idcatcom')

        ->join('users as u', 'u.id', '=', 'post.idus')

        ->where('competitions.idcomp', $id)

        ->get(['post.status', 'post.idpost', 'competitions.title', 'cat.namecat as namecat', 'u.name as nameuser', 'u.surname as surnameuser']);

        foreach($comp as $c)
        {
            $array2 = array();

            $answ = Answers::select('idansw')->where('id_post', $c->idpost)->orderBy('idansw', 'desc')->get();

            $cont = 1;

            foreach($answ as $a)
            {
                array_push($array2, array('idansw' => $a->idansw, 'cont' => $cont));
                $cont++;
            }

            array_push($array1, array('idpost' => $c->idpost, 'status' => $c->status, 'titlecat' => $c->title, 'namecat' => $c->namecat, 'user' => $c->nameuser.' '.$c->surnameuser, 'answ' => $array2));

        }

        return view('revisor.userspost', ['array1' => $array1]);
    }

    public function verinfingdoc($tipo = null, $idpost = null, $idansw = null)
    {
        $idansw = Crypt::decrypt($idansw);
        
        $idpost = $idpost;

        $tipo = $tipo;

        $answ = Answers::select('idansw', 'id_post', 'preg1et1', 'preg2et1')->where('idansw', $idansw)->orderBy('idansw', 'asc')->get();

        $post = Postulations::where(['idpost' =>  $idpost])->first();
        
        switch (true) 
        {
            case ($post->status == "inicial" || $tipo == "historial" || $tipo == "conobservaciones" ):

                
                switch (true) 
                {
                    case ($post->status == "inicial"):
                    {
                        $text = trans('multi-leng.a206');
                        $display = "none";
                    }
                    break;
                    case ($tipo == "historial"):

                        $text = trans('multi-leng.a248');
                        $display = "block";

                    break;
                    case ($tipo == "conobservaciones"):

                        $display = "none";

                        $text = trans('multi-leng.a245');

                    break;
                    
                    default:
                        # code...
                    break;
                }

                $dir = AnswersDirector::where(['id_answ' => $answ[0]->idansw, 'typedir' => 'dir'])->first();

                $subdir = AnswersDirector::where(['id_answ' => $answ[0]->idansw, 'typedir' => 'sub'])->first();

                $est = AnswersDirector::where(['id_answ' => $answ[0]->idansw, 'typedir' => 'est'])->get();

                $acad = AnswersDirector::where(['id_answ' => $answ[0]->idansw, 'typedir' => 'acad'])->get();

                $finalstus = DB::table('answersstatus')->select('etapa1')->where('id_anwsstat', $idansw)->first();

                $view = 'etapa1soloverhistorial';

                $sumper = 0; $sumcom = 0; $sumfun = 0; $sumotr = 0;

                $id = $idansw;

                $answ = Answers::select('*')->where('idansw', $id)->orderBy('idansw', 'asc')->get();

                $dir = AnswersDirector::where(['id_answ' => $answ[0]->idansw, 'typedir' => 'dir'])->first();

                $subdir = AnswersDirector::where(['id_answ' => $answ[0]->idansw, 'typedir' => 'sub'])->first();

                $est = AnswersDirector::where(['id_answ' => $answ[0]->idansw, 'typedir' => 'est'])->get();

                $acad = AnswersDirector::where(['id_answ' => $answ[0]->idansw, 'typedir' => 'acad'])->get();

                $files = AnswersFiles::where(['id_answ' => $id, 'tipofile' => 'Normal'])->orderBy('idanswfile', 'asc')->get();

                $tablaper = DetailsResources::select('iddetres', 'descri', 'valor1', 'valor2')->where(['id_answ' =>  $id, 'type' => 1])->orderBy('iddetres', 'asc')->get();

                foreach($tablaper as $tabla)
                {
                    $sumper = ($tabla->valor1 * $tabla->valor2) + $sumper;
                }

                $tablacom = DetailsResources::select('iddetres', 'descri', 'valor1', 'valor2')->where(['id_answ' =>  $id, 'type' => 2])->orderBy('iddetres', 'asc')->get();
                
                foreach($tablacom as $tabla)
                {
                    $sumcom = ($tabla->valor1 * $tabla->valor2) + $sumcom;
                }

                $tablafun = DetailsResources::select('iddetres', 'descri', 'valor1', 'valor2')->where(['id_answ' =>  $id, 'type' => 3])->orderBy('iddetres', 'asc')->get();
                
                foreach($tablafun as $tabla)
                {
                    $sumfun = ($tabla->valor1 * $tabla->valor2) + $sumfun;
                }

                $tablaotr = DetailsResources::select('iddetres', 'descri', 'valor1', 'valor2')->where(['id_answ' =>  $id, 'type' => 4])->orderBy('iddetres', 'asc')->get();
                
                foreach($tablaotr as $tabla)
                {
                    $sumotr = ($tabla->valor1 * $tabla->valor2) + $sumotr;
                }

                $countfilesDA = AnswersFiles::where(['id_answ' => $id, 'tipofile' => 'Director (a) Académico'])->count();

                $countfilesDN = AnswersFiles::where(['id_answ' => $id, 'tipofile' => 'Director(a) Nacional'])->count();

                //$sumper = DetailsResources::where(['id_answ' =>  $id, 'type' => 1])->selectRaw('(SUM(valor1) * SUM(valor2)) as sumaTotal')->get();

                $filesa = AnswersFiles::where(['id_answ' => $id])->where('tipofile', '!=', 'Normal')->orderBy('idanswfile', 'asc')->get();
                
                return view('revisor.'.$view, ["answ" => $answ, 'dir' => $dir, 'subdir' => $subdir, 'est' => $est, 'acad' => $acad, 'files' => $files, "sumper" => (int)$sumper, "sumcom" => (int)$sumcom, "sumfun" => (int)$sumfun, "sumotr" => (int)$sumotr, 'tablaper' => $tablaper, 'tablacom' => $tablacom, 'tablafun' => $tablafun , 'tablaotr' => $tablaotr,  'filesa' => $filesa,  'contda' => $countfilesDA,  'contdn' => $countfilesDN, 'text' => $text, 'idconcurso' => Crypt::encrypt($post->idconc), 'idpostulacion' => $idpost, 'display' => $display]);

            break;
            case ( $post->status == "enrevision" || $post->status == "rechazado" || $post->status == "aprobado"):
                
                
                if($post->status == "enrevision")
                {
                    $text = trans('multi-leng.a207');
                }
                if($post->status == "rechazado")
                {
                    $text = trans('multi-leng.a244');
                }
                if($post->status == "aprobado")
                {
                    $text = trans('multi-leng.a246');
                }

                $dir = AnswersDirector::where(['id_answ' => $answ[0]->idansw, 'typedir' => 'dir'])->first();

                $subdir = AnswersDirector::where(['id_answ' => $answ[0]->idansw, 'typedir' => 'sub'])->first();

                $est = AnswersDirector::where(['id_answ' => $answ[0]->idansw, 'typedir' => 'est'])->get();

                $acad = AnswersDirector::where(['id_answ' => $answ[0]->idansw, 'typedir' => 'acad'])->get();

                $finalstus = DB::table('answersstatus')->select('etapa1')->where('id_anwsstat', $idansw)->first();

                switch (true) 
                {
                    case ($post->status == "inicial"):

                        $display = "none";

                        $view = 'etapa1solover';

                    break;
                    case ($post->status == "enrevision"):

                        $display = "block";

                        $view = 'vistarevision';

                    break;
                    case ($post->status == "rechazado"  || $post->status == "aprobado"):

                        $view = 'etapa1solover';

                        $display = "block";

                    break;
                    
                    default:
                        # code...
                    break;
                }

                $sumper = 0; $sumcom = 0; $sumfun = 0; $sumotr = 0;

                $id = $idansw;

                $answ = Answers::select('*')->where('idansw', $id)->orderBy('idansw', 'asc')->get();

                $dir = AnswersDirector::where(['id_answ' => $answ[0]->idansw, 'typedir' => 'dir'])->first();

                $subdir = AnswersDirector::where(['id_answ' => $answ[0]->idansw, 'typedir' => 'sub'])->first();

                $est = AnswersDirector::where(['id_answ' => $answ[0]->idansw, 'typedir' => 'est'])->get();

                $acad = AnswersDirector::where(['id_answ' => $answ[0]->idansw, 'typedir' => 'acad'])->get();

                $files = AnswersFiles::where(['id_answ' => $id, 'tipofile' => 'Normal'])->orderBy('idanswfile', 'asc')->get();

                $tablaper = DetailsResources::select('iddetres', 'descri', 'valor1', 'valor2')->where(['id_answ' =>  $id, 'type' => 1])->orderBy('iddetres', 'asc')->get();

                foreach($tablaper as $tabla)
                {
                    $sumper = ($tabla->valor1 * $tabla->valor2) + $sumper;
                }

                $tablacom = DetailsResources::select('iddetres', 'descri', 'valor1', 'valor2')->where(['id_answ' =>  $id, 'type' => 2])->orderBy('iddetres', 'asc')->get();
                
                foreach($tablacom as $tabla)
                {
                    $sumcom = ($tabla->valor1 * $tabla->valor2) + $sumcom;
                }

                $tablafun = DetailsResources::select('iddetres', 'descri', 'valor1', 'valor2')->where(['id_answ' =>  $id, 'type' => 3])->orderBy('iddetres', 'asc')->get();
                
                foreach($tablafun as $tabla)
                {
                    $sumfun = ($tabla->valor1 * $tabla->valor2) + $sumfun;
                }

                $tablaotr = DetailsResources::select('iddetres', 'descri', 'valor1', 'valor2')->where(['id_answ' =>  $id, 'type' => 4])->orderBy('iddetres', 'asc')->get();
                
                foreach($tablaotr as $tabla)
                {
                    $sumotr = ($tabla->valor1 * $tabla->valor2) + $sumotr;
                }

                $countfilesDA = AnswersFiles::where(['id_answ' => $id, 'tipofile' => 'Director (a) Académico'])->count();

                $countfilesDN = AnswersFiles::where(['id_answ' => $id, 'tipofile' => 'Director(a) Nacional'])->count();

                //$sumper = DetailsResources::where(['id_answ' =>  $id, 'type' => 1])->selectRaw('(SUM(valor1) * SUM(valor2)) as sumaTotal')->get();

                $filesa = AnswersFiles::where(['id_answ' => $id])->where('tipofile', '!=', 'Normal')->orderBy('idanswfile', 'asc')->get();
                
                return view('revisor.'.$view, ["answ" => $answ, 'dir' => $dir, 'subdir' => $subdir, 'est' => $est, 'acad' => $acad, 'files' => $files, "sumper" => (int)$sumper, "sumcom" => (int)$sumcom, "sumfun" => (int)$sumfun, "sumotr" => (int)$sumotr, 'tablaper' => $tablaper, 'tablacom' => $tablacom, 'tablafun' => $tablafun , 'tablaotr' => $tablaotr,  'filesa' => $filesa,  'contda' => $countfilesDA,  'contdn' => $countfilesDN, 'text' => $text, 'idconcurso' => Crypt::encrypt($post->idconc), 'idpostulacion' => $idpost, 'display' => $display]);

            break;
            
            default:

                return redirect()->route('ver-vista-concurso-usuarios-registrados', [Crypt::encrypt($answ[0]->idansw)])->with('warning', trans('multi-leng.a212'));

            break;
        }
    }

    public function impfordoc($id = null)
    {
        $sumper = 0; $sumcom = 0; $sumfun = 0; $sumotr = 0; 

        $id = Crypt::decrypt($id);

        $answ = Answers::select('*')->where('idansw', $id)->orderBy('idansw', 'asc')->get();

        $dir = AnswersDirector::where(['id_answ' => $answ[0]->idansw, 'typedir' => 'dir'])->first();

        $subdir = AnswersDirector::where(['id_answ' => $answ[0]->idansw, 'typedir' => 'sub'])->first();

        $est = AnswersDirector::where(['id_answ' => $answ[0]->idansw, 'typedir' => 'est'])->get();

        $acad = AnswersDirector::where(['id_answ' => $answ[0]->idansw, 'typedir' => 'acad'])->get();

        $files = AnswersFiles::where(['id_answ' => $id, 'tipofile' => 'Normal'])->orderBy('idanswfile', 'asc')->get();

        $tablaper = DetailsResources::select('iddetres', 'descri', 'valor1', 'valor2')->where(['id_answ' =>  $id, 'type' => 1])->orderBy('iddetres', 'asc')->get();

        foreach($tablaper as $tabla)
        {
            $sumper = ($tabla->valor1 * $tabla->valor2) + $sumper;
        }

        $tablacom = DetailsResources::select('iddetres', 'descri', 'valor1', 'valor2')->where(['id_answ' =>  $id, 'type' => 2])->orderBy('iddetres', 'asc')->get();
        
        foreach($tablacom as $tabla)
        {
            $sumcom = ($tabla->valor1 * $tabla->valor2) + $sumcom;
        }

        $tablafun = DetailsResources::select('iddetres', 'descri', 'valor1', 'valor2')->where(['id_answ' =>  $id, 'type' => 3])->orderBy('iddetres', 'asc')->get();
        
        foreach($tablafun as $tabla)
        {
            $sumfun = ($tabla->valor1 * $tabla->valor2) + $sumfun;
        }

        $tablaotr = DetailsResources::select('iddetres', 'descri', 'valor1', 'valor2')->where(['id_answ' =>  $id, 'type' => 4])->orderBy('iddetres', 'asc')->get();
        
        foreach($tablaotr as $tabla)
        {
            $sumotr = ($tabla->valor1 * $tabla->valor2) + $sumotr;
        }

        $countfilesDA = AnswersFiles::where(['id_answ' => $id, 'tipofile' => 'Director (a) Académico'])->count();

        $countfilesDN = AnswersFiles::where(['id_answ' => $id, 'tipofile' => 'Director(a) Nacional'])->count();

        //$sumper = DetailsResources::where(['id_answ' =>  $id, 'type' => 1])->selectRaw('(SUM(valor1) * SUM(valor2)) as sumaTotal')->get();

        $filesa = AnswersFiles::where(['id_answ' => $id])->where('tipofile', '!=', 'Normal')->orderBy('idanswfile', 'asc')->get();
        
        
        $pdf = \PDF::loadView('emails/prueba', ["answ" => $answ, 'dir' => $dir, 'subdir' => $subdir, 'est' => $est, 'acad' => $acad, 'files' => $files, "sumper" => (int)$sumper, "sumcom" => (int)$sumcom, "sumfun" => (int)$sumfun, "sumotr" => (int)$sumotr, 'tablaper' => $tablaper, 'tablacom' => $tablacom, 'tablafun' => $tablafun , 'tablaotr' => $tablaotr,  'filesa' => $filesa,  'contda' => $countfilesDA,  'contdn' => $countfilesDN]);
        
    
        return $pdf->download('Formulario.pdf');
    }
    public function impfordocobs($id = null)
    {
        $sumper = 0; $sumcom = 0; $sumfun = 0; $sumotr = 0; 

        $id = Crypt::decrypt($id);

        $correc = Corrections::where('id_answ', $id)->first();

        $answ = Answers::select('id_post')->where('idansw', $id)->orderBy('idansw', 'asc')->first();

        $idconc = Postulations::select('idconc')->where(['idpost' =>  $answ->id_post])->first();

        $post = Postulations::join('competitions as con', 'postulations.idconc', '=', 'con.idcomp')

        ->join('users as u', 'u.id', '=', 'postulations.idus')

        ->where('con.idcomp', $idconc->idconc )

        ->first(['postulations.created_at', 'con.title', 'u.name', 'u.surname']);

        $dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");

        $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");

        $pdf = \PDF::loadView('emails/observaciones', ["correc" => $correc, 'conc' => $post->title, 'nombre' => $post->name.''.$post->surname, 'fecha' => $dias[date("w", strtotime($post->created_at))]." ".date("d", strtotime($post->created_at))." de ".$meses[date("n", strtotime($post->created_at))-1]. " del ".date("Y", strtotime($post->created_at))]);

        return $pdf->download(trans('multi-leng.a250').'.pdf');
    }
    public function ventanapopup($id = null)
    {
        $id = Crypt::decrypt($id);

        $correc = Corrections::where('id_answ', $id)->first();

        $answ = Answers::select('id_post')->where('idansw', $id)->orderBy('idansw', 'asc')->first();

        $idconc = Postulations::select('idconc')->where(['idpost' =>  $answ->id_post])->first();

        $post = Postulations::join('competitions as con', 'postulations.idconc', '=', 'con.idcomp')

        ->join('users as u', 'u.id', '=', 'postulations.idus')

        ->where('con.idcomp', $idconc->idconc )

        ->first(['postulations.created_at', 'con.title', 'u.name', 'u.surname']);

        $dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");

        $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
        
        return view('revisor.dashboardempty', [ "id" => Crypt::encrypt($id), 'correc' => $correc, 'conc' => $post->title, 'nombre' => $post->name.''.$post->surname, 'fecha' => $dias[date("w", strtotime($post->created_at))]." ".date("d", strtotime($post->created_at))." de ".$meses[date("n", strtotime($post->created_at))-1]. " del ".date("Y", strtotime($post->created_at))]);
    }
    public function actforposcor(Request $request)
    {
        $sum = 0;

        $id = Crypt::decrypt($request->idansw);

        $idcorrec = Crypt::decrypt($request->idcorrec);

        $answ = Answers::select('*')->where('idansw', $id)->first();

        

        switch (true) 
        {
            case ($request->type == 'fin'):

                switch (true) 
                {
                    case($request->value == 'rechazado'):
                        
                        $post = Postulations::where('idpost', $answ->id_post )->update(['status' => 'rechazado']);

                        return response()->json(['status' => 1, 'sum' => 0, 'fin' => 'rechazado' ]);

                    break;
                    case($request->value == 'conobservaciones'):

                        $post = Postulations::where('idpost', $answ->id_post )->update(['status' => 'conobservaciones']);

                        $answnew = new Answers;

                        $answnew->id_post = $answ->id_post;

                        $answnew->save();

                        $answnew = $answnew->idansw;

                        $dataClient = Answers::firstOrNew(['idansw' => $answnew]);

                        $dataClient->preg1et1   = $answ->preg1et1;

                        $dataClient->preg2et1   = $answ->preg2et1;

                        $dataClient->preg1et2   = $answ->preg1et2;

                        $dataClient->preg2et2   = $answ->preg2et2;

                        $dataClient->preg3et2   = $answ->preg3et2;

                        $dataClient->preg4et2   = $answ->preg4et2;

                        $dataClient->preg5et2   = $answ->preg5et2;

                        $dataClient->preg1et3   = $answ->preg1et3;
                        
                        $dataClient->preg2et3   = $answ->preg2et3;

                        $dataClient->preg3et3   = $answ->preg3et3;

                        $dataClient->preg3et4   = $answ->preg3et4;

                        $dataClient->save(); 

                        $ansdir = AnswersDirector::where('id_answ', $id)->get();

                        foreach($ansdir as $ans)
                        {
                            $dataClient = new AnswersDirector;

                            $dataClient->id_answ   = $answnew;

                            $dataClient->namedir   = $ans->namedir;

                            $dataClient->rutdir    = $ans->rutdir;

                            $dataClient->faculdir  = $ans->faculdir;

                            $dataClient->jordir    = $ans->jordir;

                            $dataClient->tipodir   = $ans->tipodir;

                            $dataClient->antidir   = $ans->antidir;

                            $dataClient->teldir    = $ans->teldir;

                            $dataClient->emaildir  = $ans->emaildir;

                            $dataClient->horasdir  = $ans->horasdir;

                            $dataClient->niveldir  = $ans->niveldir;

                            $dataClient->typedir   = $ans->typedir;

                            $dataClient->save();
                        }

                        $ansfil = AnswersFiles::where('id_answ', $id)->get();

                        foreach($ansfil as $an)
                        {
                            $dataClient = new AnswersFiles;

                            $dataClient->id_answ      = $answnew;

                            $dataClient->descripcion  = $an->descripcion;

                            $dataClient->dirfile      = $an->dirfile;

                            $dataClient->tipofile     = $an->tipofile;

                            $dataClient->save();
                        }
                        
                        DB::table('answersstatus')->insert(['id_anwsstat' => $answnew, 'etapa1' => 0, 'etapa2' => 0, 'etapa3' => 0, 'etapa4' => 0]);
                         
                        $correc = new Corrections;

                        $correc->id_answ  = $answnew;

                        $correc->save();
                        
                        $deta = DetailsResources::where('id_answ', $id)->get();

                        foreach($deta as $an)
                        {
                            $dataClient = new DetailsResources;

                            $dataClient->id_answ   = $answnew;

                            $dataClient->type      = $an->type;

                            $dataClient->name      = $an->name;

                            $dataClient->descri    = $an->descri;

                            $dataClient->valor1    = $an->valor1;

                            $dataClient->valor2    = $an->valor2;

                            $dataClient->valor3    = $an->valor3;

                            $dataClient->valor4    = $an->valor4;

                            $dataClient->save();
                        }

                        return response()->json(['status' => 1, 'sum' => 0, 'fin' => 'conobservaciones' ]);

                    break;
                    case($request->value == 'aprobado'):

                        $post = Postulations::where('idpost', $answ->id_post )->update(['status' => 'aprobado']);

                        return response()->json(['status' => 1, 'sum' => 0, 'fin' => 'aprobado' ]);

                    break;
                }
                
            break;
            case ((int)$request->type === 1 ):

                $correc = Corrections::where('idcorrec', $idcorrec)->update([$request->col => $request->value]);

                if($request->type == 1)
                {
                    
                    
                    $sql = "SELECT SUM(ptje1 + ptje2 + ptje3 + ptje4 + ptje5 + ptje6 + ptje7 + ptje8 + ptje9 + ptje10 + ptje11 + ptje12) as sum FROM corrections WHERE idcorrec = :ID";
        
                    $result = DB::select($sql,['ID' => $idcorrec]);
        
                    $sum = (int)$result[0]->sum;
                }
                
                return response()->json(['status' => 1, 'sum' => $sum ]);

            break;
            case ((int)$request->type ===  0):
                
                $correc = Corrections::where('idcorrec', $idcorrec)->update([$request->col => $request->value]);
                
                return response()->json(['status' => 1, 'sum' => $sum ]);

            break;
            
            
            default:
           
                return response()->json(['status' => 0, 'sum' => 0, 'fin' => 0 ]);

            break;
        }
        
    }

    private function fechaEspanol($FechaStamp)
    {
        $ano = date('Y',$FechaStamp);

        $mes = date('n',$FechaStamp);

        $dia = date('d',$FechaStamp);

        $diasemana = date('w',$FechaStamp);

        $diassemanaN= array("Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado");

        $mesesN=array(1=>"Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
        
        return $diassemanaN[$diasemana].", $dia de ". $mesesN[$mes] ." de $ano";
    } 























































    public function verposactdoc()
    {

        $post = Postulations::join('competitions as con', 'postulations.idconc', '=', 'con.idcomp')

        ->join('categoriesCompetitions  as cat', 'con.category_id', '=', 'cat.idcatcom')

        ->join('answers as a', 'a.id_post', '=', 'postulations.idpost')

        ->where('postulations.idus', Auth::user()->id)

        ->get(['postulations.status', 'con.title', 'con.created_by', 'cat.namecat as namecat', 'a.idansw']);

        return view('cuestionario.index', compact('post'));
    }

    public function vervisconusuregdoc($id = null)
    {
        $id = Crypt::decrypt($id);

        Competitions::where('idcomp', $id)

        ->update([

          'applicants'=> DB::raw('applicants+1'), 

        ]);
        $postulacionnum = 0;

        $post = CategoriesCompetitions::join('competitions as c', 'c.category_id', '=', 'categoriesCompetitions.idcatcom')

        ->join('users as u', 'u.id', '=', 'c.created_by')

        ->where("c.idcomp", $id)

        ->first(['c.*', 'categoriesCompetitions.namecat as titlecat', 'u.name as nameus', 'u.surname as surnameus']);

        $postulacion = Postulations::where(['idconc' => $id, 'status' => 'inicial'])->get();

        if(count($postulacion) > 0)
        {
            $postulacionnum = 1;
        }
        

        $tags = TagsComp::join('competitions_tag as comtag', 'tagcomp.idtag', '=', 'comtag.tag_id')

        ->where("comtag.comp_id", $id)

        ->get(['tagcomp.tagnom']);

        $files = FilesCompetitions::where('idcomp', $id)->get();


        return view('docentes.verconcursosdoc', compact('post', 'tags', 'files'),['postulacion' => $postulacionnum]);
    }
    public function redforcomdoc($id = null)
    {
        $id1 = Crypt::decrypt($id);

        return redirect()->route('ver-vista-concurso-usuario-registrado-docente', [$id])->with('success', trans('multi-leng.a202'));
            
    }

    public function solposcondoc(Request $request)
    {
        $id = Crypt::decrypt($request->idpost); //id-concurso


        $post = Postulations::where(['idconc' =>  $id, 'idus' => Auth::user()->id])->count();

        if($post == 0)
        {
            $post = new Postulations;

            $post->idconc = $id;

            $post->idus = Auth::user()->id;

            $post->status = "inicial";

            $post->save();

            $idpost = $post->idpost; // id postulación

            $answ = new Answers;

            $answ->id_post = $idpost;

            $answ->save();

            $idansw = $answ->idansw; // idpreguntas

            $answdir = new AnswersDirector;

            $answdir->id_answ = $idansw;

            $answdir->typedir = "dir";

            $answdir->save();

            $answdir = new AnswersDirector;

            $answdir->id_answ = $idansw;

            $answdir->typedir = "sub";

            $answdir->save();

            DB::table('answersstatus')->insert(['id_anwsstat' => $idansw, 'etapa1' => 0, 'etapa2' => 0, 'etapa3' => 0, 'etapa4' => 0]);

            DB::table('detailresources')->insert(['id_answ' => $idansw, 'type' => 1, 'name' => 'formerror26', 'valor1' => 0, 'valor2' => 0,  'valor3' => 0, 'valor4' => 0]);
            
            DB::table('detailresources')->insert(['id_answ' => $idansw, 'type' => 2, 'name' => 'a123', 'valor1' => 0, 'valor2' => 0,  'valor3' => 0, 'valor4' => 0]);

            DB::table('detailresources')->insert(['id_answ' => $idansw, 'type' => 3, 'name' => 'a124', 'valor1' => 0, 'valor2' => 0,  'valor3' => 0, 'valor4' => 0]);

            DB::table('detailresources')->insert(['id_answ' => $idansw, 'type' => 4, 'name' => 'Total ($)', 'valor1' => 0, 'valor2' => 0,  'valor3' => 0, 'valor4' => 0]);

            DB::table('detailresources')->insert(['id_answ' => $idansw, 'type' => 5, 'valor1' => 0, 'valor2' => 0,  'valor3' => 0, 'valor4' => 0]);

            

            $answ = Answers::select('idansw', 'preg1et1', 'preg2et1')->where('idansw', $idansw)->orderBy('idansw', 'asc')->get();

            $dir = AnswersDirector::where(['id_answ' => $answ[0]->idansw, 'typedir' => 'dir'])->first();

            $subdir = AnswersDirector::where(['id_answ' => $answ[0]->idansw, 'typedir' => 'sub'])->first();

            $est = AnswersDirector::where(['id_answ' => $answ[0]->idansw, 'typedir' => 'est'])->get();

            $acad = AnswersDirector::where(['id_answ' => $answ[0]->idansw, 'typedir' => 'acad'])->get();
        
            return view('cuestionario.etapa1', compact('answ', 'dir', 'subdir', 'est', 'acad'), [ "idconcurso" => Crypt::encrypt($id), 'idpostulacion' => Crypt::encrypt(1) ]);

            
        }
        else
        {
            $post = Postulations::where(['idconc' =>  $id, 'idus' => Auth::user()->id])->first();

            return redirect()->route('ver-vista-concurso-usuario-registrado-docente', [Crypt::encrypt($id)])->with('danger', trans('multi-leng.a172'));
            
        }
    }

    public function solposcondocfin(Request $request)
    {
        $id = Crypt::decrypt($request->idpost); //id-concurso

        $post = Postulations::where(['idconc' =>  $id, 'idus' => Auth::user()->id])->first();

        return redirect()->route('ver-vista-concurso-usuario-registrado-docente', [Crypt::encrypt($id)])->with('danger', trans('multi-leng.a172'));
    }

    public function verfordocprieta($id = null)
    {
        $id = Crypt::decrypt($id);

        $answ = Answers::select('idansw', 'id_post', 'preg1et1', 'preg2et1')->where('idansw', $id)->orderBy('idansw', 'asc')->get();

        $post = Postulations::where(['idpost' =>  $answ[0]->id_post])->first();

        if($post->status == "inicial")
        {
            $text = trans('multi-leng.a206');
        }
        if($post->status == "enrevision")
        {
            $text = trans('multi-leng.a207');
        }

        switch (true) 
        {
            case ($post->status == "inicial" || $post->status == "enrevision"):

                $dir = AnswersDirector::where(['id_answ' => $answ[0]->idansw, 'typedir' => 'dir'])->first();

                $subdir = AnswersDirector::where(['id_answ' => $answ[0]->idansw, 'typedir' => 'sub'])->first();

                $est = AnswersDirector::where(['id_answ' => $answ[0]->idansw, 'typedir' => 'est'])->get();

                $acad = AnswersDirector::where(['id_answ' => $answ[0]->idansw, 'typedir' => 'acad'])->get();

                $finalstus = DB::table('answersstatus')->select('etapa1')->where('id_anwsstat', $id)->first();

                switch (true) 
                {
                    case ($post->status == "inicial"):

                        $view = 'etapa1';

                    break;
                    case ($post->status == "enrevision"):

                        $view = 'etaparev1';

                    break;
                    
                    default:
                        # code...
                    break;
                }
                
                return view('cuestionario.'.$view, compact('answ', 'dir', 'subdir', 'est', 'acad'), [ "idconcurso" => Crypt::encrypt($answ[0]->id_post), 'idpostulacion' => Crypt::encrypt($answ[0]->id_post), "status" => $finalstus, 'text' => $text ]);

            break;
            
            default:

                return redirect()->route('ver-vista-concurso-usuario-registrado-docente', [Crypt::encrypt($post->idconc)])->with('danger', trans('multi-leng.a172'));

            break;
        }

        

    }

    public function verfordocsegeta($id = null)
    {
        $id = Crypt::decrypt($id);

        $answ = Answers::select('idansw', 'id_post', 'preg1et2', 'preg2et2', 'preg3et2', 'preg4et2', 'preg5et2')->where(['idansw' => $id])->orderBy('idansw', 'asc')->get();

        $post = Postulations::where(['idpost' =>  $answ[0]->id_post])->first();

        if($post->status == "inicial")
        {
            $text = trans('multi-leng.a206');
        }
        if($post->status == "enrevision")
        {
            $text = trans('multi-leng.a207');
        }

        switch (true) 
        {
            case ($post->status == "inicial" || $post->status == "enrevision"):

                $finalstus = DB::table('answersstatus')->select('etapa2')->where('id_anwsstat', $id)->first();

                switch (true) 
                {
                    case ($post->status == "inicial"):
                        $view = 'etapa2';
                    break;
                    case ($post->status == "enrevision"):
                        $view = 'etaparev2';
                    break;
                    
                    default:
                        # code...
                    break;
                }
        
                return view('cuestionario.'.$view, compact('answ'), [ "idconcurso" => Crypt::encrypt($answ[0]->id_post), 'idpostulacion' => Crypt::encrypt($answ[0]->id_post), 'idansw' => Crypt::encrypt($id), "status" => $finalstus, 'text' => $text ]);

            break;
            
            default:

                return redirect()->route('ver-vista-concurso-usuario-registrado-docente', [Crypt::encrypt($post->idconc)])->with('danger', trans('multi-leng.a172'));

            break;
        }
    }
    public function verfordoctereta($id = null)
    {
        $id = Crypt::decrypt($id);

        $answ = Answers::select('idansw', 'id_post', 'preg1et3', 'preg2et3', 'preg3et3')->where(['idansw' => $id])->orderBy('idansw', 'asc')->get();

        $post = Postulations::where(['idpost' =>  $answ[0]->id_post])->first();

        if($post->status == "inicial")
        {
            $text = trans('multi-leng.a206');
        }
        if($post->status == "enrevision")
        {
            $text = trans('multi-leng.a207');
        }

        switch (true) 
        {
            case ($post->status == "inicial" || $post->status == "enrevision"):

                $countfiles = AnswersFiles::where(['id_answ' => $id, 'tipofile' => 'Normal'])->count();

                $files = AnswersFiles::where(['id_answ' => $id, 'tipofile' => 'Normal'])->orderBy('idanswfile', 'asc')->get();

                $finalstus = DB::table('answersstatus')->select('etapa3')->where('id_anwsstat', $id)->first();

                switch (true) 
                {
                    case ($post->status == "inicial"):
                        $view = 'etapa3';
                    break;
                    case ($post->status == "enrevision"):
                        $view = 'etaparev3';
                    break;
                    
                    default:
                        # code...
                    break;
                }

                return view('cuestionario.'.$view, compact('answ'), [ "idconcurso" => Crypt::encrypt($answ[0]->id_post), 'idpostulacion' => Crypt::encrypt($answ[0]->id_post), 'idansw' => Crypt::encrypt($id), 'countfiles' => $countfiles, 'files' => $files, "status" => $finalstus, 'text' => $text]);

            break;
            
            default:

                return redirect()->route('ver-vista-concurso-usuario-registrado-docente', [Crypt::encrypt($post->idconc)])->with('danger', trans('multi-leng.a172'));

            break;
        }

    }
    public function verfordoccuaeta($id = null)
    {
        $id = Crypt::decrypt($id);
        $data = [
            'titulo' => 'Styde.net'
        ];
    
        /*$pdf = \PDF::loadView('emails/prueba', $data);
    
        return $pdf->download('archivo.pdf');

        $data = [
            'titulo' => 'Styde.net'
        ];
    
        $data = PDF::loadView('emails/prueba', $data)
            ->save(storage_path('app/public/pdfs') . 'archivo.pdf');*/

        $sumper = 0; $sumcom = 0; $sumfun = 0; $sumotr = 0;

        $answ = Answers::select('idansw', 'id_post', 'preg3et4')->where('idansw', $id)->orderBy('idansw', 'asc')->get();

        $post = Postulations::where(['idpost' =>  $answ[0]->id_post])->first();

        if($post->status == "inicial")
        {
            $text = trans('multi-leng.a206');
        }
        if($post->status == "enrevision")
        {
            $text = trans('multi-leng.a207');
        }

        switch (true) 
        {
            case ($post->status == "inicial" || $post->status == "enrevision"):

                $tablaper = DetailsResources::select('iddetres', 'descri', 'valor1', 'valor2')->where(['id_answ' =>  $id, 'type' => 1])->orderBy('iddetres', 'asc')->get();

                foreach($tablaper as $tabla)
                {
                    $sumper = ($tabla->valor1 * $tabla->valor2) + $sumper;
                }

                $tablacom = DetailsResources::select('iddetres', 'descri', 'valor1', 'valor2')->where(['id_answ' =>  $id, 'type' => 2])->orderBy('iddetres', 'asc')->get();
                
                foreach($tablacom as $tabla)
                {
                    $sumcom = ($tabla->valor1 * $tabla->valor2) + $sumcom;
                }

                $tablafun = DetailsResources::select('iddetres', 'descri', 'valor1', 'valor2')->where(['id_answ' =>  $id, 'type' => 3])->orderBy('iddetres', 'asc')->get();
                
                foreach($tablafun as $tabla)
                {
                    $sumfun = ($tabla->valor1 * $tabla->valor2) + $sumfun;
                }

                $tablaotr = DetailsResources::select('iddetres', 'descri', 'valor1', 'valor2')->where(['id_answ' =>  $id, 'type' => 4])->orderBy('iddetres', 'asc')->get();
                
                foreach($tablaotr as $tabla)
                {
                    $sumotr = ($tabla->valor1 * $tabla->valor2) + $sumotr;
                }

                $countfilesDA = AnswersFiles::where(['id_answ' => $id, 'tipofile' => 'Director (a) Académico'])->count();

                $countfilesDN = AnswersFiles::where(['id_answ' => $id, 'tipofile' => 'Director(a) Nacional'])->count();

                //$sumper = DetailsResources::where(['id_answ' =>  $id, 'type' => 1])->selectRaw('(SUM(valor1) * SUM(valor2)) as sumaTotal')->get();

                $files = AnswersFiles::where(['id_answ' => $id])->where('tipofile', '!=', 'Normal')->orderBy('idanswfile', 'asc')->get();

                $finalstus = DB::table('answersstatus')->select('etapa4')->where('id_anwsstat', $id)->first();
                
                switch (true) 
                {
                    case ($post->status == "inicial"):
                        $view = 'etapa4';
                    break;
                    case ($post->status == "enrevision"):
                        $view = 'etaparev4';
                    break;
                    
                    default:
                        # code...
                    break;
                }
                
                return view('cuestionario.'.$view, compact('answ'), ["idconcurso" => Crypt::encrypt($answ[0]->id_post), 'idpostulacion' => Crypt::encrypt($answ[0]->id_post), 'idansw' => Crypt::encrypt($id), "sumper" => (int)$sumper, "sumcom" => (int)$sumcom, "sumfun" => (int)$sumfun, "sumotr" => (int)$sumotr, 'tablaper' => $tablaper, 'tablacom' => $tablacom, 'tablafun' => $tablafun , 'tablaotr' => $tablaotr,  'files' => $files,  'contda' => $countfilesDA,  'contdn' => $countfilesDN, "status" => $finalstus, 'text' => $text ]);

            break;
            
            default:

                return redirect()->route('ver-vista-concurso-usuario-registrado-docente', [Crypt::encrypt($post->idconc)])->with('danger', trans('multi-leng.a172'));

            break;
        }

    }

    function actforposdocetauno(Request $request)
    {
        $sum = 0;

        $idansw = Crypt::decrypt($request->idansw);

        switch (true) 
        {
            case ($request->type == "answ"):

                $idansw = Crypt::decrypt($request->idansw);

                Answers::where(['idansw' => $idansw])->update([$request->col => $request->value, 'updated_at' => date("Y-m-d H:i:s")]);

                if($request->value == "" || $request->value == null)
                {
                    DB::table('answersstatus')->where('id_anwsstat', $idansw)->update(['etapa1' => 0]);
                }

                return response()->json(['status' => 1 ]);

            break;

            case ($request->type == "dir"):

                AnswersDirector::where(['idansdir' => $request->tipo])->update([$request->col => $request->value, 'updated_at' => date("Y-m-d H:i:s")]);

                if($request->value == "" || $request->value == null)
                {
                    DB::table('answersstatus')->where('id_anwsstat', $idansw)->update(['etapa1' => 0]);
                }

                return response()->json(['status' => 1 ]); 

            break;
            case ($request->type == "subdir"):    

                AnswersDirector::where(['idansdir' => $request->tipo])->update([$request->col => $request->value, 'updated_at' => date("Y-m-d H:i:s")]);


                return response()->json(['status' => 1 ]);

            break;

            case ($request->type == "est"):

                $idansw = Crypt::decrypt($request->idansw);

                $est = new AnswersDirector;

                $est->id_answ = $idansw;

                $est->typedir = "est";

                $est->save();

                $send = AnswersDirector::where(['id_answ' => $idansw, 'typedir' => 'est'])->get();
                
                return response()->json(['status' => 1, 'est' => $send ]);

            break;
            case ($request->type == "estid"):

                $idansw = Crypt::decrypt($request->idansw);
                
                $porciones = explode(",", $request->value);

                
                if((int)$porciones[0] == 0)
                {
                    
                    $est = AnswersDirector::create(['id_answ' => $idansw, 'namedir' => $porciones[1], 'rutdir' => $porciones[2], 'teldir' => $porciones[3], 'emaildir' => $porciones[4], 'tipodir' => $porciones[5], 'jordir' => $porciones[6], 'faculdir' => $porciones[7], 'niveldir' => $porciones[8], 'typedir' => 'est' ]);
                }
                else
                {
                    $est = AnswersDirector::where(['idansdir' => (int)$porciones[0] ])->update(['namedir' => $porciones[1], 'rutdir' => $porciones[2], 'teldir' => $porciones[3], 'emaildir' => $porciones[4], 'tipodir' => $porciones[5], 'jordir' => $porciones[6], 'faculdir' => $porciones[7], 'niveldir' => $porciones[8], 'updated_at' => date("Y-m-d H:i:s")]);
                }

                

                $send = AnswersDirector::where(['id_answ' => $idansw, 'typedir' => 'est'])->get();
                
                return response()->json(['status' => 1, 'est' => $send ]);

            break;
            case ($request->type == "acadid"):

                $idansw = Crypt::decrypt($request->idansw);
                
                $porciones = explode(",", $request->value);
                
                if((int)$porciones[0] == 0)
                {
                    
                    $est = AnswersDirector::create(['id_answ' => $idansw, 'namedir' => $porciones[1], 'tipodir' => $porciones[2], 'jordir' => $porciones[3], 'faculdir' => $porciones[4], 'niveldir' => $porciones[5], 'typedir' => 'acad' ]);
                }
                else
                {
                    $est = AnswersDirector::where(['idansdir' => (int)$porciones[0] ])->update(['namedir' => $porciones[1], 'tipodir' => $porciones[2], 'jordir' => $porciones[3], 'faculdir' => $porciones[4], 'niveldir' => $porciones[5], 'updated_at' => date("Y-m-d H:i:s")]);
                }

                

                $send = AnswersDirector::where(['id_answ' => $idansw, 'typedir' => 'acad'])->get();
                
                return response()->json(['status' => 1, 'est' => $send ]);

            break;

            case ($request->type == "acadpend"):

                $idansw = Crypt::decrypt($request->idansw);
                
                $new = new AnswersDirector;

                $new->id_answ = $idansw;

                $new->typedir = "acad";

                $new->save();

                $send = AnswersDirector::where(['id_answ' => $idansw, 'typedir' => 'acad'])->get();
                
                return response()->json(['status' => 1, 'est' => $send ]);

            break;

            case ($request->type == "delete"):

                $idansw = Crypt::decrypt($request->idansw);
                
                $porciones = explode(",", $request->value);

                $est = AnswersDirector::where( ['idansdir' => $request->value] )->delete();
                
                if($request->col == "acadid")
                {

                    $send = AnswersDirector::where(['id_answ' => $idansw, 'typedir' => 'acad'])->get();
                
                }
                else
                {
                    $send = AnswersDirector::where(['id_answ' => $idansw, 'typedir' => 'est'])->get();
                }

                return response()->json(['status' => 1, 'est' => $send ]);

            break;

            case ($request->type == "val"):

                $idansw = Crypt::decrypt($request->idansw);
                
                DB::table('answersstatus')->where('id_anwsstat', $idansw)->update(['etapa1' => 1]);

                return response()->json(['status' => 1, 'est' => ""]);

            break;

            //actualizardatos(val1, val2, val3, "detresfila", idtab, $("#filatipo").val());

            
            default:
                
                return response()->json([ 'sum' => 0, 'status' => "0" ]);

            break;
        }
    }
    function actforposdocetados(Request $request)
    {
        $sum = 0;

        switch (true) 
        {
            case ($request->type == "answ"):

                $idansw = Crypt::decrypt($request->idansw);

                Answers::where(['idansw' => $idansw])->update([$request->col => $request->value, 'updated_at' => date("Y-m-d H:i:s")]);

                if($request->value == "" || $request->value == null)
                {
                    DB::table('answersstatus')->where('id_anwsstat', $idansw)->update(['etapa2' => 0]);
                }

                return response()->json(['status' => 1 ]);

            break;
            case ($request->type == "val"):

                $idansw = Crypt::decrypt($request->idansw);
                
                DB::table('answersstatus')->where('id_anwsstat', $idansw)->update(['etapa2' => 1]);

                return response()->json(['status' => 1]);

            break;

            
            default:
                
                return response()->json(['status' => 0 ]);

            break;
        }
    }
    function actforposdocetatres(Request $request)
    {
        $sum = 0;

        switch (true) 
        {
            case ($request->type == "answ"):

                $idansw = Crypt::decrypt($request->idansw);

                Answers::where(['idansw' => $idansw])->update([$request->col => $request->value, 'updated_at' => date("Y-m-d H:i:s")]);

                if($request->value == "" || $request->value == null)
                {
                    DB::table('answersstatus')->where('id_anwsstat', $idansw)->update(['etapa3' => 0]);
                }

                return response()->json(['status' => 1 ]);

            break;
            case ($request->type == "val"):

                $idansw = Crypt::decrypt($request->idansw);
                
                DB::table('answersstatus')->where('id_anwsstat', $idansw)->update(['etapa3' => 1]);

                return response()->json(['status' => 1]);

            break;
            case ($request->type == "file"):

                $id = Crypt::decrypt($request->idansw);

                if ($request->hasFile('value'))
    
                {
    
                    $request->validate([
    
                        'value' => 'mimes:jpg,png,jpeg,xlsx,pdf|max:9000'
    
                    ]);
    
                    $destinationPath = storage_path('app/public/adjuntos/docentes');
    
    
    
                    if (is_dir(storage_path('app/public/adjuntos/docentes'))) 
    
                    {
    
                        @chmod(storage_path('app/public/adjuntos/docentes'), 0777);
    
                    }
    
                    $thumbnail = $request->file('value');
    
                    $namecatSanitize = filter_var($request->col, FILTER_SANITIZE_STRING);
    
                    $fileName = time().'.'. $thumbnail->getClientOriginalExtension();
    
                    move_uploaded_file($thumbnail, $destinationPath.'/'.$fileName);

                    $dataClient1 = new AnswersFiles;
    
                    $dataClient1->id_answ   = $id;

                    $dataClient1->descripcion   = $namecatSanitize;
        
                    $dataClient1->dirfile    = $fileName;
        
                    $dataClient1->created_at    = date("Y-m-d H:i:s");
        
                    $dataClient1->updated_at    = date("Y-m-d H:i:s");
        
                    $dataClient1->save();
    
                }

                $countfiles = AnswersFiles::where(['id_answ' => $id, 'tipofile' => 'Normal'])->count();

                $files = AnswersFiles::where(['id_answ' => $id, 'tipofile' => 'Normal'])->orderBy('idanswfile', 'asc')->get();

                return response()->json(['status' => 1, 'files' => $files, 'countfiles' => $countfiles]);

            break;
            case ($request->type == "delete"):

                $id = Crypt::decrypt($request->idansw);

                $files = AnswersFiles::where(['idanswfile' => $request->value])->delete();
                
                if(is_file(storage_path('app/public/adjuntos/docentes')."/".$request->col)) {

                    unlink(storage_path('app/public/adjuntos/docentes')."/".$request->col);
                
                }

                $countfiles = AnswersFiles::where(['id_answ' => $id, 'tipofile' => 'Normal'])->count();

                if($countfiles == 0)
                {
                    DB::table('answersstatus')->where('id_anwsstat', $id)->update(['etapa3' => 0]);
                }

                $files = AnswersFiles::where(['id_answ' => $id, 'tipofile' => 'Normal'])->orderBy('idanswfile', 'asc')->get();

                return response()->json(['status' => 1, 'files' => $files, 'countfiles' => $countfiles]);

            break;

            default:
                
                return response()->json(['status' => 0 ]);

            break;
        }
    }

    function actforposdocetacua(Request $request)
    {
        $sum = 0;

        switch (true) 
        {
            //actualizardatos(val1, val2, val3, "detresfila", idtab, $("#filatipo").val());

            case ($request->tipo == "answ"):

                $idansw = Crypt::decrypt($request->idansw);

                $idpost = Crypt::decrypt($request->idpost);

                $dataClient = Answers::firstOrNew(['idansw' => $idansw]);

                $dataClient->preg3et4    = $request->value;

                $dataClient->save();

                
                if($request->value == "" || $request->value == null)
                {
                    DB::table('answersstatus')->where('id_anwsstat', $idansw)->update(['etapa4' => 0]);
                }

                return response()->json([ 'sum' => "", 'status' => "0" ]);

            break;

            case ($request->type == "file"):

                $id = Crypt::decrypt($request->idansw);

                if ($request->hasFile('value'))
    
                {
    
                    $request->validate([
    
                        'value' => 'mimes:docx,pdf|max:9000'
    
                    ]);
    
                    $destinationPath = storage_path('app/public/adjuntos/docentes');
    
    
    
                    if (is_dir(storage_path('app/public/adjuntos/docentes'))) 
    
                    {
    
                        @chmod(storage_path('app/public/adjuntos/docentes'), 0777);
    
                    }
    
                    $thumbnail = $request->file('value');
    
                    $namecatSanitize = filter_var($request->col, FILTER_SANITIZE_STRING);
    
                    $fileName = time().'.'. $thumbnail->getClientOriginalExtension();
    
                    move_uploaded_file($thumbnail, $destinationPath.'/'.$fileName);

                    $dataClient1 = new AnswersFiles;
    
                    $dataClient1->id_answ   = $id;

                    $dataClient1->descripcion   = $namecatSanitize;
        
                    $dataClient1->dirfile    = $fileName;

                    if($request->data1 == 1)
                    {
                        $dataClient1->tipofile    = "Director (a) Académico";
                    }
                    if($request->data1 == 2)
                    {
                        $dataClient1->tipofile    = "Director(a) Nacional";
                    }

                    if($request->data1 == 3)
                    {
                        $dataClient1->tipofile    = "Otros Documentos";
                    }
                    
        
                    $dataClient1->created_at    = date("Y-m-d H:i:s");
        
                    $dataClient1->updated_at    = date("Y-m-d H:i:s");
        
                    $dataClient1->save();
    
                }

                $countfilesDA = AnswersFiles::where(['id_answ' => $id, 'tipofile' => 'Director (a) Académico'])->count();

                if($countfilesDA == 0)
                {
                    DB::table('answersstatus')->where('id_anwsstat', $id)->update(['etapa4' => 0]);
                }

                $countfilesDN = AnswersFiles::where(['id_answ' => $id, 'tipofile' => 'Director(a) Nacional'])->count();

                if($countfilesDN == 0)
                {
                    DB::table('answersstatus')->where('id_anwsstat', $id)->update(['etapa4' => 0]);
                }

                $files = AnswersFiles::where(['id_answ' => $id])->where('tipofile', '!=', 'Normal')->orderBy('idanswfile', 'asc')->get();

                return response()->json(['status' => 1, 'files' => $files, 'contda' => $countfilesDA, 'contdn' => $countfilesDN]);


            break;

            case ($request->type == "delete"):

                $id = Crypt::decrypt($request->idansw);

                $files = AnswersFiles::where(['idanswfile' => $request->value])->delete();
                
                if(is_file(storage_path('app/public/adjuntos/docentes')."/".$request->col)) {

                    unlink(storage_path('app/public/adjuntos/docentes')."/".$request->col);
                
                }

                $countfilesDA = AnswersFiles::where(['id_answ' => $id, 'tipofile' => 'Director (a) Académico'])->count();

                $countfilesDN = AnswersFiles::where(['id_answ' => $id, 'tipofile' => 'Director(a) Nacional'])->count();

                $files = AnswersFiles::where(['id_answ' => $id])->where('tipofile', '!=', 'Normal')->orderBy('idanswfile', 'asc')->get();

                return response()->json(['status' => 1, 'files' => $files, 'contda' => $countfilesDA, 'contdn' => $countfilesDN]);

            break;

            case ($request->tipo == "additems"):

                $idansw = Crypt::decrypt($request->idansw);

                $idpost = Crypt::decrypt($request->idpost);

                switch (true) {

                    case ((int)$request->data == 0):

                        $dataClient = new DetailsResources;

                        $dataClient->id_answ     = $idansw;

                        $dataClient->type    = 1;

                        $dataClient->name    = '----------';

                        $dataClient->descri    = $request->value;

                        $dataClient->valor1    = $request->col;

                        $dataClient->valor2   = $request->type;

                        $dataClient->save();

                        $datos = DetailsResources::select('iddetres', 'descri','valor1', 'valor2')->where(['id_answ' => $idansw, 'type' => 1 ])->get();

                        return response()->json([ 'datos' => $datos, 'status' => 1 ]);

                    break;
                    case ((int)$request->data != 0 && $request->data1 == 2):

                        DetailsResources::where(['iddetres' => (int)$request->data])->update(['descri' => $request->value, 'valor1' =>$request->col, 'valor2' => $request->type]);

                        $datos = DetailsResources::select('iddetres', 'descri', 'valor1', 'valor2')->where(['id_answ' => $idansw, 'type' => 1 ])->get();

                        return response()->json([ 'datos' => $datos, 'status' => 1 ]);

                    break;

                    case ((int)$request->data != 0 && $request->data1 == 3):

                        DetailsResources::where(['iddetres' => (int)$request->data])->delete();

                        $datos = DetailsResources::select('iddetres', 'descri', 'valor1', 'valor2')->where(['id_answ' => $idansw, 'type' => 1 ])->get();
                        
                        return response()->json([ 'datos' => $datos, 'status' => 1 ]);

                    break;
                    
                    default:
                        # code...
                    break;
                }

            break;

            case ($request->tipo == "additemscom"):

                $idansw = Crypt::decrypt($request->idansw);

                $idpost = Crypt::decrypt($request->idpost);

                switch (true) {

                    case ((int)$request->data == 0):

                        $dataClient = new DetailsResources;

                        $dataClient->id_answ     = $idansw;

                        $dataClient->type    = 2;

                        $dataClient->name    = '----------';

                        $dataClient->descri    = $request->value;

                        $dataClient->valor1    = $request->col;

                        $dataClient->valor2   = $request->type;

                        $dataClient->save();

                        $datos = DetailsResources::select('iddetres', 'descri','valor1', 'valor2')->where(['id_answ' => $idansw, 'type' => 2 ])->get();

                        return response()->json([ 'datos' => $datos, 'status' => 1 ]);

                    break;
                    case ((int)$request->data != 0 && $request->data1 == 2):

                        DetailsResources::where(['iddetres' => (int)$request->data])->update(['descri' => $request->value, 'valor1' =>$request->col, 'valor2' => $request->type]);

                        $datos = DetailsResources::select('iddetres', 'descri', 'valor1', 'valor2')->where(['id_answ' => $idansw, 'type' => 2 ])->get();

                        return response()->json([ 'datos' => $datos, 'status' => 1 ]);

                    break;

                    case ((int)$request->data != 0 && $request->data1 == 3):

                        DetailsResources::where(['iddetres' => (int)$request->data])->delete();

                        $datos = DetailsResources::select('iddetres', 'descri', 'valor1', 'valor2')->where(['id_answ' => $idansw, 'type' => 2 ])->get();
                        
                        return response()->json([ 'datos' => $datos, 'status' => 1 ]);

                    break;
                    
                    default:
                        # code...
                    break;
                }

            break;

            case ($request->tipo == "additemsfun"):

                $idansw = Crypt::decrypt($request->idansw);

                $idpost = Crypt::decrypt($request->idpost);

                switch (true) {

                    case ((int)$request->data == 0):

                        $dataClient = new DetailsResources;

                        $dataClient->id_answ     = $idansw;

                        $dataClient->type    = 3;

                        $dataClient->name    = '----------';

                        $dataClient->descri    = $request->value;

                        $dataClient->valor1    = $request->col;

                        $dataClient->valor2   = $request->type;

                        $dataClient->save();

                        $datos = DetailsResources::select('iddetres', 'descri','valor1', 'valor2')->where(['id_answ' => $idansw, 'type' => 3 ])->get();

                        return response()->json([ 'datos' => $datos, 'status' => 1 ]);

                    break;
                    case ((int)$request->data != 0 && $request->data1 == 2):

                        DetailsResources::where(['iddetres' => (int)$request->data])->update(['descri' => $request->value, 'valor1' =>$request->col, 'valor2' => $request->type]);

                        $datos = DetailsResources::select('iddetres', 'descri', 'valor1', 'valor2')->where(['id_answ' => $idansw, 'type' => 3 ])->get();

                        return response()->json([ 'datos' => $datos, 'status' => 1 ]);

                    break;

                    case ((int)$request->data != 0 && $request->data1 == 3):

                        DetailsResources::where(['iddetres' => (int)$request->data])->delete();

                        $datos = DetailsResources::select('iddetres', 'descri', 'valor1', 'valor2')->where(['id_answ' => $idansw, 'type' => 3 ])->get();
                        
                        return response()->json([ 'datos' => $datos, 'status' => 1 ]);

                    break;
                    
                    default:
                        # code...
                    break;
                }

            break;

            case ($request->tipo == "additemsotr"):

                $idansw = Crypt::decrypt($request->idansw);

                $idpost = Crypt::decrypt($request->idpost);

                switch (true) {

                    case ((int)$request->data == 0):

                        $dataClient = new DetailsResources;

                        $dataClient->id_answ     = $idansw;

                        $dataClient->type    = 4;

                        $dataClient->name    = '----------';

                        $dataClient->descri    = $request->value;

                        $dataClient->valor1    = $request->col;

                        $dataClient->valor2   = $request->type;

                        $dataClient->save();

                        $datos = DetailsResources::select('iddetres', 'descri','valor1', 'valor2')->where(['id_answ' => $idansw, 'type' => 4 ])->get();

                        return response()->json([ 'datos' => $datos, 'status' => 1 ]);

                    break;
                    case ((int)$request->data != 0 && $request->data1 == 2):

                        DetailsResources::where(['iddetres' => (int)$request->data])->update(['descri' => $request->value, 'valor1' =>$request->col, 'valor2' => $request->type]);

                        $datos = DetailsResources::select('iddetres', 'descri', 'valor1', 'valor2')->where(['id_answ' => $idansw, 'type' => 4 ])->get();

                        return response()->json([ 'datos' => $datos, 'status' => 1 ]);

                    break;

                    case ((int)$request->data != 0 && $request->data1 == 3):

                        DetailsResources::where(['iddetres' => (int)$request->data])->delete();

                        $datos = DetailsResources::select('iddetres', 'descri', 'valor1', 'valor2')->where(['id_answ' => $idansw, 'type' => 4 ])->get();
                        
                        return response()->json([ 'datos' => $datos, 'status' => 1 ]);

                    break;
                    
                    default:
                        # code...
                    break;
                }

            break;

            case ($request->type == "val"):

                $idansw = Crypt::decrypt($request->idansw);

                $error = "";
                
                DB::table('answersstatus')->where('id_anwsstat', $idansw)->update(['etapa4' => 1]);

                return response()->json(['status' => 2, 'error' => $error]);
            break;

            case ($request->type == "final"):

                $idansw = Crypt::decrypt($request->idansw);

                $idpost = Crypt::decrypt($request->idpost);

                $error = "";

                $final = DB::table('answersstatus')->where('id_anwsstat', $idansw)->first();

                if($final->etapa1 == 0)
                {
                    $error .= trans('multi-leng.a165');
                }
                if($final->etapa2 == 0)
                {
                    $error .= trans('multi-leng.a166');
                }
                if($final->etapa3 == 0)
                {
                    $error .= trans('multi-leng.a167');
                }
                if($final->etapa4 == 0)
                {
                    $error .= trans('multi-leng.a168');
                }
                if($error == "")
                {
                    $post = Postulations::where('idpost', $idpost)->update(['status' => 'enrevision']);
                    
                    $post = Postulations::where('idpost', $idpost)->first();
                    
                    return response()->json(['status' => 1, 'error' => $error, "id" => Crypt::encrypt($post->idconc)]);
                }
                else
                {
                    return response()->json(['status' => 0, 'error' => $error, "id" => ""]);
                }

            break;
            
            default:
                
                return response()->json([ 'sum' => 0, 'status' => "0" ]);

            break;
        }
    }

    
    

}