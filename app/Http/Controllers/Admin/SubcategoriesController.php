<?php



namespace App\Http\Controllers\Admin;



use App\User;

use App\Category;

use App\Subcategory;

use App\Resource;

use App\Book;

use App\CategoriesForums;

use App\CategoriesChats;

use Spatie\Permission\Models\Role;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Gate;

use App\Http\Controllers\Controller;

use Illuminate\Validation\Rule;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\DB;

use App\UserLoginLog;



class SubcategoriesController extends Controller

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

    public function index()

    {

        $users = User::where("cargo_us", "Administrador")->get();



        return view('admin.users.index', compact('users'));

    }





    public function ingsubcatadm(Request $request)

    {

        $id = $request->idcat;

        $cat = Category::select('carpeta')->where('id_cat', $id)->count();

        if($cat > 0)

        {

            $cat = Category::select('carpeta')->where('id_cat', $id)->first();

            $destino = $cat->carpeta;

            $namecatSanitize = filter_var($request->namecat, FILTER_SANITIZE_STRING);

            $namecatSanitize = eliminar_tildes($namecatSanitize);

            $carpeta = date("YmdHis");

            $anexo =  preg_replace("/\s+/", "", trim($namecatSanitize)).$carpeta;

            $dataClient = new Subcategory;

            $dataClient->name    = $namecatSanitize;

            $dataClient->cat_id  = $id;

            $dataClient->carpeta = $destino.'/'.$anexo;

            $dataClient->save();

            $path = storage_path('app/public/'.$destino.'/'.$anexo);

            if (!is_dir($path))

            {

                mkdir($path, 0777, true);

            }

            return redirect()->route('agregar-categorias-administrador')->with('success', trans('multi-leng.textingsubfolder'));

        }

        else

        {

            return redirect()->route('agregar-categorias-administrador')->with('danger', trans('multi-leng.textingsubfolderno'));

        }

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

        $idrec = [];

        $rec = Resource::select('id_rec')->where(['subcategory_id' => $request->idcat])->get();

        foreach($rec as $row)
        {
            $idrec[] = $row->id_rec;
        }
        

        $catfor = CategoriesForums::whereIn('idres', $idrec)->delete();

        $catchat = CategoriesChats::whereIn('idres', $idrec)->delete();

        $catbook = Book::whereIn('resource_id', $idrec)->delete();

        $model = Resource::where(['subcategory_id' => $request->idcat])->delete();


        return redirect()->route('agregar-categorias-administrador')->with('success', trans('multi-leng.textelisubfolder'));

    }

    

}

