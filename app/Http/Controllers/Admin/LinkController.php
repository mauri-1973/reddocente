<?php



namespace App\Http\Controllers\Admin;



use App\User;

use App\Category;

use App\Subcategory;

use App\Link;

use Spatie\Permission\Models\Role;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Gate;

use App\Http\Controllers\Controller;

use Illuminate\Validation\Rule;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\DB;

use App\UserLoginLog;

use Illuminate\Support\Facades\Crypt;



class LinkController extends Controller

{

     /**

    *

    * allow admin only

    *

    */

    public function __construct() {

        //$this->middleware(['role:admin|creator']);

        $this->middleware(['role:admin']);

    }



    /**

     * Display a listing of User.

     *

     * @return \Illuminate\Http\Response

     */

    public function indexconlinadm()

    {
        $link = Link::count();
        
        if($link == 0)
        {
            session(['ver' => 'no']);
            session(['url' => '']);
            return view('admin.link.indexlinkedit', compact('link'));
        }
        if($link == 1)
        {
            $link = Link::first();
            session(['ver' => 'si']);
            session(['url' => $link->url]);
            return view('admin.link.indexlink', compact('link'));
        }
        else
        {
            abort(404);
        }
    }

    public function agrelinredadm(Request $request)

    {
        $url = "https://".$request->name;

        $post = new Link; 

        $post->url = $url;

        $post->iduser = Auth::user()->id;

        if($post->save())
        {

            return redirect()->route('configurar-link-admin')->with('success', trans('multi-leng.formerror229'));

        }

        else

        {

            return redirect()->route('configurar-link-admin')->with('danger', trans('multi-leng.formerror230'));

        }

    }

    public function edilinredadm(Request $request)

    {
        $idlink = Crypt::decrypt($request->idlink);

        $url = "https://".$request->name;

        $post = Link::where('idlink', $idlink)->update(["url" => $url]); 

        return redirect()->route('configurar-link-admin')->with('success', trans('multi-leng.formerror231'));

    }
    public function elilinredadm(Request $request)

    {
        $idlink = Crypt::decrypt($request->idlinkdelete);
       
        $url = "https://".$request->name;

        $post = Link::where('idlink', $idlink)->delete(); 

        return redirect()->route('configurar-link-admin')->with('danger', trans('multi-leng.formerror232'));

    }



    public function editsubcatadm(Request $request)

    {

        $namecatSanitize = filter_var($request->namecat, FILTER_SANITIZE_STRING);

        $namecatSanitize = eliminar_tildes($namecatSanitize);

        $post = Subcategory::firstOrNew(['id_sub' => $request->idcat]); 

        $post->name = $namecatSanitize;

        $post->save();

        return redirect()->route('agregar-categorias-administrador')->with('success', trans('multi-leng.texteditsubfolder'));

    }

    

    public function elisubcatadm(Request $request)

    {

        $namecatSanitize = filter_var($request->namecat, FILTER_SANITIZE_STRING);

        $model = Subcategory::where(['id_sub' => $request->idcat])->delete();

        return redirect()->route('agregar-categorias-administrador')->with('success', trans('multi-leng.textelisubfolder'));

    }

    

}

