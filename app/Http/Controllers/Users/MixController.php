<?php



namespace App\Http\Controllers\Users;



use App\Http\Controllers\Controller;

use App\Http\Requests\StorePostRequest;

use App\Http\Requests\UpdatePostRequest;

use App\Categoryblog;

use App\Post;

use App\Tagblog;

use App\PostTag;

use App\Commentblog;

use App\LinkExt;

use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use Intervention\Image\Facades\Image as Image;

use Symfony\Component\HttpFoundation\Response;

use Illuminate\Http\JsonResponse;

use File;

use Crypt;



class MixController extends Controller

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

    public function verpubcom($id = null)

    {

        $id = Crypt::decrypt($id);

        Post::where('id', $id)

        ->update([

          'read_count'=> DB::raw('read_count+1'), 

        ]);

        $post = Categoryblog::join('posts as p', 'p.category_id', '=', 'categoriesblog.id')

        ->join('users as u', 'u.id', '=', 'p.created_by')

        ->where('p.is_published', 1)

        ->where("p.id", $id)

        ->first(['p.*', 'categoriesblog.title as titlecat', 'u.name as nameus', 'u.surname as surnameus']);

        $tags = PostTag::join('tagsblog as tag', 'tag.id', '=', 'post_tag.tag_id')

        ->where("post_tag.post_id", $id)

        ->get(['tag.title']);

        $comments = Commentblog::join('users as u', 'u.id', '=', 'commentsblog.user_id')

        ->where('commentsblog.post_id', $id)

        ->get(['commentsblog.*', 'u.name as nameus', 'u.surname as surnameus']);

        return view('postusers.post', compact('post', 'tags', 'comments'), ["idpost" => Crypt::encrypt($id)]);

    }

    public function verpublin()
    {
        $post = Post::join('categoriesblog as cat', 'posts.category_id', '=', 'cat.id')
        ->join('users as u', 'u.id', '=', 'posts.created_by')
        //->where('posts.is_published', 1)
        ->get(['posts.*', 'cat.title as titlecat', 'u.name as nameus', 'u.surname as surnameus']);
        $arraytagas = array();
        foreach($post as $row)
        {
            $temp = array();
            $tags = PostTag::join('tagsblog as tag', 'tag.id', '=', 'post_tag.tag_id')
            ->where("post_tag.post_id", $row->id)
            ->get(['tag.title']);
            foreach($tags as $r)
            {
                array_push($temp, array("titulo" => $r->title));
            }
            $comments = Commentblog::where('post_id', $row->id)
            ->count();
            array_push($arraytagas, array("tags" => $temp, "nomcom" => $comments, "idpost" => $row->id));
        }

        return view('postusers.verpost', ["post" => $post, "info" => $arraytagas, "cont" => 0 ]);
    }

    public function irlinadmextuno()
    {
        $link = LinkExt::where('nombreini', 'Formación')->get();
        return view('linksext.linkuno', ["tipo" => "Formación", 'link' => $link ]);
    }

    public function irlinadmextdos()
    {
        $link = LinkExt::where('nombreini', 'Extensión')->get();
        return view('linksext.linkdos', ["tipo" => "Extensión", 'link' => $link ]);
    }
    public function irlinadmexttres()
    {
        
        $link = LinkExt::where('nombreini', 'Innovación')->get();
        return view('linksext.linktres', ["tipo" => "Innovación", 'link' => $link ]);
    }
    public function irlinadmextcuatro()
    {
        $link = LinkExt::where('nombreini', 'Recursos')->get();
        return view('linksext.linkcuatro', ["tipo" => "Recursos", 'link' => $link ]);
    }
    
    public function verlinenbadm($tipo = null, $desde = null)
    {
        if($tipo == 1)
        {
            $url = "https://congresocied.cl/";
        }
        if($tipo == 2)
        {
            $url = "https://www.concursocied.cl/";
        }
        if($tipo == 3)
        {
            $url = "https://www.ust.cl/investigacion/centro-cied/centros-de-recursos/charlas-talleres-y-capsulas/";
        }
        if($tipo == 4)
        {
            $url = "https://get.foundation/";
        }
        return view('linksext.verlink', ["url" => $url, "desde" => $desde  ] );
    }
    public function verlinenbadmweb($id = null)
    {
        $id = Crypt::decrypt($id);
        $ver = LinkExt::where('idlinkext', $id)->first();
        $url = $ver->urlext;
        $name = $ver->nombreini;
        return view('linksext.verlink', ["url" => $url, "desde" => $name  ] );
    }


    public function edisubcatlinext(Request $request)
    {
        $id = Crypt::decrypt($request->idlink);
        if($request->cat == "Formación")
        {
            $text = 'ir-link-administrador-externo-formacion';
        }
        if($request->cat == "Extensión")
        {
            $text = 'ir-link-administrador-externo-extension';
        }
        if($request->cat == "Innovación")
        {
            $text = 'ir-link-administrador-externo-proyectos';
        }
        if($request->cat == "Recursos")
        {
            $text = 'ir-link-administrador-externo-recursos';
        }
        if($request->tipoact == 0)
        {
            LinkExt::where('idlinkext', $id)->update(["nombresub" => $request->catsub, "urlext" => $request->urlcatsub, 'tipo' => (int)$request->inlineRadioOptions  ] );
            
            return redirect()->route($text)->with('primary', trans('multi-leng.formerror294'));
        }
        if($request->tipoact == 2)
        {
            $new = new LinkExt;
            $new->nombreini = $request->cat;
            $new->nombresub = $request->catsub;
            $new->urlext = $request->urlcatsub;
            $new->tipo = (int)$request->inlineRadioOptions;
            $new->save();
            
            return redirect()->route($text)->with('success', trans('multi-leng.formerror296'));
        }
        else
        {
            LinkExt::where('idlinkext', $id)->delete();
            
            return redirect()->route($text)->with('danger', trans('multi-leng.formerror295'));
        }
    }
}