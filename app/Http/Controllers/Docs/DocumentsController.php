<?php



namespace App\Http\Controllers\Docs;



use App\User;

use App\Category;

use App\Subcategory;

use App\Resource;

use App\Book;

use App\CategoryDocAdm;

use App\BookAdm;

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



class DocumentsController extends Controller

{

   /**

    *

    * allow admin only

    *

    */

    public function __construct() {

        $this->middleware('auth');

    }



    /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function busdocdigpub()

    {

        $arreglo1 = array();

        $category = Category::all();

        foreach($category as $row)

        {

            $arreglo2 = array();

            $subcategory = Subcategory::select('*')->where('cat_id', $row->id_cat)->get();

            foreach($subcategory as $row1)

            {

                array_push($arreglo2, array('idsub' => $row1->id_sub, 'nombresub' => $row1->name, 'idcat' => $row1->cat_id, 'fechasub' => $row1->created_at->format('d-m-Y H:i:s')));

            }

            array_push($arreglo1, array('idcat' => $row->id_cat, 'nombrecat' => $row->name, 'fechacat' => $row->created_at->format('d-m-Y H:i:s'), 'arreglosub' => $arreglo2));

        }

        return view('docs.indexdoc', ['catego' => count($arreglo1), 'arreglo' => $arreglo1]);

    }

    public function actdocdigadm()
    {
        $disabled = "";
        $array = array();
        $cat = CategoryDocAdm::count();
        if($cat == 0)
        {
            $disabled = "disabled";
        }
        else
        {
            $cat = CategoryDocAdm::all();
            foreach($cat as $row)
            {
                array_push($array, array("idcatdoc" => Crypt::encrypt($row->idcatdoc), "namecatdoc" => $row->namecatdoc));
            }
        }
        $book = BookAdm::select('bookadm.*', 'cat.namecatdoc as namecat')
        ->join('categoriesdocadm  as cat', 'cat.idcatdoc', '=', 'bookadm.cat_id')
        ->get();
        return view('docs.adddocsadmin', ["disabled" => $disabled, "cat" => $array, "book" => $book]); 

    }

    public function busdocsubcatid(Request $request)

    {

        $doc = Subcategory::join('resources as re', 're.subcategory_id', '=', 'subcategories.id_sub')

            ->join('users as us', 're.user_id', '=', 'us.id')

            ->where('us.cargo_us', 'docente')

            ->get(['us.*']);

        $user = User::join('resources as re', 're.user_id', '=', 'users.id')

            ->join('subcategories as su', 're.subcategory_id', '=', 'su.id_sub')

            ->where('su.id_sub', $request->id)

            ->where('users.cargo_us', 'docente')

            ->get(['users.id', 'users.name', 'users.surname','re.folder','re.id_rec']);

        $array = array();

        $file = array();

        foreach($user as $row)

        {

            $file = array();

            $books = Book::where('resource_id', $row->id_rec)->get();

            foreach($books as $row1 )

            {

                

                array_push($file, array('idbook' => Crypt::encrypt($row1->id_book), 'nombre' => ucwords($row1->name), 'autor' => ucwords($row1->autor), 'desc' => $row1->descripcion, 'fecha' => $row1->created_at->format('d-m-Y H:i:s'), 'folder' => 'storage/'.$row->folder.'/'.$row1->name , 'string' => Crypt::encryptString('storage/'.$row->folder.'/'.$row1->name), "key" => $row1->keybook));

            }

            /*$search[] = glob(public_path('storage/'.$row->folder.'/*.pdf'));

            foreach($search as $row1 )

            {

                foreach($row1 as $r)

                {

                    $porciones = explode("storage/", $r);

                    $file[] = "storage/".$porciones[1];

                }

                

                

            }*/

            array_push($array, array('id' => $row->id, 'nombre' => ucwords($row->name.' '.$row->surname), 'arreglolib' => $file));

        }

        

        return response()->json(['num' => count($array), "arrayfinal" => $array, 'numbooks' => count($file)]);

    }

    public function visordocs($id = null)

    {

        $id = Crypt::decryptString($id);

        return view('visorpdf', ['url' => $id]);

    }





    public function actdocdigdoc()

    {

        $rec = Resource::join('subcategories as sub', 'sub.id_sub', '=', 'resources.subcategory_id')

            ->where('resources.user_id', Auth::user()->id)

            ->get(['sub.*', 'resources.*']);

        $array = array();

        foreach($rec as $row)

        {

            $file = array();

            $books = Book::where('resource_id', $row->id_rec)->get();

            foreach($books as $row1 )

            {

                

                array_push($file, array('idbook' => Crypt::encrypt($row1->id_book), 'nombre' => ucwords($row1->name), 'autor' => ucwords($row1->autor), 'desc' => $row1->descripcion, 'fecha' => $row1->created_at->format('d-m-Y H:i:s'), 'folder' => 'storage/'.$row->folder.'/'.$row1->name , 'string' => Crypt::encryptString('storage/'.$row->folder.'/'.$row1->name) ));

            }

            /*$search[] = glob(public_path('storage/'.$row->folder.'/*.pdf'));

            foreach($search as $row1 )

            {

                foreach($row1 as $r)

                {

                    $porciones = explode("storage/", $r);

                    $file[] = "storage/".$porciones[1];

                }

                

                

            }*/

            array_push($array, array('idrec' => Crypt::encrypt($row->id_rec), 'namesub' => $row->name, 'idsub' => Crypt::encrypt($row->id_sub), 'arreglolib' => $file));

        }

        return view('docentes.indexactbooks', compact('array'));

    }

    public function ingdocbibdoc(Request $request)
    {
        $idsub = Crypt::decrypt($request->idsub);
        $idrec = Crypt::decrypt($request->idrec);
        $name = eliminar_tildes($request->namebook);
        $name = str_replace(".pdf", "", $name);
        $name = $name.".pdf";
        $autor = $request->autorbook;
        $desc = $request->descbook;
        $carpeta = Resource::where('id_rec', $idrec)->count();
        if($autor == "")
        {
            $autor = "---------------";
        }
        if($desc == "")
        {
            $desc = "---------------";
        }
        if($carpeta > 0)
        {
            $carpeta = Resource::where('id_rec', $idrec)->first();
            if($file = $request->file('filebook'))
            {
                if (file_exists(storage_path('app/public/'.$carpeta->folder))) 
                {

                    @chmod(storage_path('app/public/'.$carpeta->folder), 0777);

                }
                copy($file, storage_path('app/public/'.$carpeta->folder.'/'.$name));
                $token2 = Crypt::encryptString(substr(md5("ADBCKSJDF".time()."EFGHPOWJDKAW"),0, 64).mt_rand(5, 32));
                $book = new Book;
                $book->name            = $name;
                $book->autor           = $autor;
                $book->descripcion     = $desc;
                $book->keybook         = $token2;
                $book->resource_id     = $idrec;
                $book->save();
                return redirect()->route('actualizar-documentos-digitales-docentes')->with('success', trans('multi-leng.formerror95'));
            }
            
        }
        else
        {
            return redirect()->route('actualizar-documentos-digitales-docentes')->with('danger', trans('multi-leng.formerror96'));
        }
    }
    public function editdocbibdoc(Request $request)
    {
       
        $idbook = Crypt::decrypt($request->idbook);
        $folder = Crypt::decryptString($request->folder);
        $folder = str_replace("storage/", "app/public/", $folder);
        $name = eliminar_tildes($request->namebook);
        $name = str_replace(".pdf", "", $name);
        $name = $name.".pdf";
        $autor = $request->autorbook;
        $desc = $request->descbook;
        if($autor == "")
        {
            $autor = "---------------";
        }
        if($desc == "")
        {
            $desc = "---------------";
        }
        $book = Book::where('id_book', $idbook )->count();
        
        if($book > 0)
        {

            $book = Book::where('id_book', $idbook )->first();

            $namedel = $book->name;

            $namedel = str_replace($namedel, $name, $folder);

            rename(storage_path($folder), storage_path($namedel));

            $book = Book::where('id_book', $idbook )->update(['name' => $name, 'autor' => $autor, 'descripcion' => $desc]);

            return redirect()->route('actualizar-documentos-digitales-docentes')->with('success', trans('multi-leng.formerror110'));
        }
        else
        {
            return redirect()->route('actualizar-documentos-digitales-docentes')->with('danger', trans('multi-leng.formerror96'));
        }
    } 

    public function elidocbibdoc(Request $request)
    {
       
        $idbook = Crypt::decrypt($request->idbook);

        $folder = Crypt::decryptString($request->folder);

        $folder = str_replace("storage/", "app/public/", $folder);

        $book = Book::where('id_book', $idbook )->count();
        
        if($book > 0)
        {

            $book = Book::where('id_book', $idbook )->delete();

            unlink(storage_path($folder));

            return redirect()->route('actualizar-documentos-digitales-docentes')->with('danger', trans('multi-leng.formerror111'));
        }
        else
        {
            return redirect()->route('actualizar-documentos-digitales-docentes')->with('danger', trans('multi-leng.formerror96'));
        }
    }


    public function ingcatadmdoc(Request $request)

    {

        $namecatSanitize = filter_var($request->namecat, FILTER_SANITIZE_STRING);

        $namecatSanitize = eliminar_tildes($namecatSanitize);

        $carpeta = date("YmdHis");

        $anexo =  preg_replace("/\s+/", "", trim($namecatSanitize)).$carpeta;

        $dataClient = new CategoryDocAdm;

        $dataClient->namecatdoc   = $namecatSanitize;

        $dataClient->carpeta = $anexo;

        $dataClient->iduser = Auth::user()->id;

        $dataClient->save();

        $path = storage_path('app/public/DocAdm/'.$anexo);

        if (!is_dir($path))

        {

            mkdir($path, 0777, true);

        }

        return redirect()->route('actualizar-documentos-digitales-administrador')->with('success', trans('multi-leng.textingfolder'));

    }

    public function valnomcatdoc(Request $request)

    {

        $val = 1;

        $namecatSanitize = filter_var($request->name, FILTER_SANITIZE_STRING);

        $namecatSanitize = eliminar_tildes($namecatSanitize);

        $category = CategoryDocAdm::select()->where('namecatdoc', $namecatSanitize)->count();

        if($category > 0)

        {

            $val = 2;

        }

        return response()->json(['val' => $val]);

    }

    public function ingdocbibdocadm(Request $request)
    {
        
        $idcat = Crypt::decrypt($request->selectcat);
        $subcat = strtoupper($request->subcat);
        $name = eliminar_tildes($request->namebook);
        $name = str_replace(".pdf", "", $name);
        $name = $name.'-'.date("His").".pdf";
        $autor = $request->autorbook;
        $desc = $request->descbook;
        $carpeta = CategoryDocAdm::where('idcatdoc', $idcat)->count();
        if($autor == "")
        {
            $autor = "---------------";
        }
        if($desc == "")
        {
            $desc = "---------------";
        }
        if($carpeta > 0)
        {
            $carpeta = CategoryDocAdm::where('idcatdoc', $idcat)->first();
            if($file = $request->file('filebook'))
            {
                if (file_exists(storage_path('app/public/DocAdm/'.$carpeta->carpeta))) 
                {

                    @chmod(storage_path('app/public/DocAdm/'.$carpeta->carpeta), 0777);

                }
                copy($file, storage_path('app/public/DocAdm/'.$carpeta->carpeta.'/'.$name));
                $token2 = Crypt::encryptString(substr(md5("ADBCKSJDF".time()."EFGHPOWJDKAW"),0, 64).mt_rand(5, 32));
                $book = new BookAdm;
                $book->nombre            = $name;
                $book->subcat            = $subcat;
                $book->autor           = $autor;
                $book->descripcion     = $desc;
                $book->cat_id     = $idcat;
                $book->key     = $token2;
                $book->us_id     = Auth::user()->id;
                $book->carpeta     = $carpeta->carpeta.'/'.$name;
                $book->save();
                return redirect()->route('actualizar-documentos-digitales-administrador')->with('success', trans('multi-leng.formerror95'));
            }
            
        }
        else
        {
            return redirect()->route('actualizar-documentos-digitales-administrador')->with('danger', trans('multi-leng.formerror96'));
        }
    }

    public function edidocbibdocadm(Request $request)
    {
        
        $idbook = Crypt::decrypt($request->idbook);
        $name = eliminar_tildes($request->namebook);
        $name = str_replace(".pdf", "", $name);
        $name = $name.'-'.date("His").".pdf";
        $subcat = strtoupper($request->subcat);
        $autor = $request->autorbook;
        $desc = $request->descbook;
        if($autor == "")
        {
            $autor = "---------------";
        }
        if($desc == "")
        {
            $desc = "---------------";
        }

        $book = BookAdm::where("idbook", $idbook)->update(['nombre' => $name, 'autor' => $autor, 'descripcion' => $desc, 'subcat' => $subcat]);

        return redirect()->route('actualizar-documentos-digitales-administrador')->with('success', trans('multi-leng.formerror194'));
    }

    public function elidocbibdocadm(Request $request)
    {
       
        $idbook = Crypt::decrypt($request->idbook);

        $folder = Crypt::decryptString($request->folder);

        $folder = str_replace("/storage/", "app/public/", $folder);

        $book = BookAdm::where('idbook', $idbook )->count();
        
        if($book > 0)
        {

            $book = BookAdm::where('idbook', $idbook )->delete();

            //unlink(storage_path($folder));

            return redirect()->route('actualizar-documentos-digitales-administrador')->with('danger', trans('multi-leng.formerror111'));
        }
        else
        {
            return redirect()->route('actualizar-documentos-digitales-administrador')->with('danger', trans('multi-leng.formerror96'));
        }
    }

    public function busdocdigadm()
    {
       
        $disabled = "";
        $array = array();
        $cat = CategoryDocAdm::count();
        if($cat == 0)
        {
            $disabled = "disabled";
        }
        else
        {
            $cat = CategoryDocAdm::all();
            foreach($cat as $row)
            {
                array_push($array, array("idcatdoc" => Crypt::encrypt($row->idcatdoc), "namecatdoc" => $row->namecatdoc));
            }
        }
        $book = BookAdm::select('bookadm.*', 'cat.namecatdoc as namecat')
        ->join('categoriesdocadm  as cat', 'cat.idcatdoc', '=', 'bookadm.cat_id')
        ->get();
        return view('docs.verdocsadm', ["disabled" => $disabled, "cat" => $array, "book" => $book]); 
    }

    public function catdocbibdocadm()
    {
       
        $array = array();
        $cat = CategoryDocAdm::select('us.name', 'us.surname', 'categoriesdocadm.*')
        ->join('users as us', 'us.id', '=', 'categoriesdocadm.iduser')
        ->get();
        foreach($cat as $row)
        {
            array_push($array, array("idcatdoc" => Crypt::encrypt($row->idcatdoc), "namecatdoc" => $row->namecatdoc, "fechaini" => $row->created_at->format('d-m-Y H:i:s'), "fechafin" => $row->updated_at->format('d-m-Y H:i:s'), 'nombreus' => $row->name.'',$row->surname));
        }

        return view('docs.catadmdoc', ["cat" => $array]); 
    }

    public function edicatadmdoc(Request $request)

    {
        $idcat = Crypt::decrypt($request->idcat);

        $namecatSanitize = filter_var($request->namecat, FILTER_SANITIZE_STRING);

        $namecatSanitize = eliminar_tildes($namecatSanitize);

        $cat = CategoryDocAdm::where('idcatdoc', $idcat)->update(['namecatdoc' => $namecatSanitize]);

        return redirect()->route('categorias-documentos-digitales-administrador')->with('success', trans('multi-leng.formerror197'));

    }

    public function elicatadmdoc(Request $request)

    {
        $idcat = Crypt::decrypt($request->idbook);

        $cat = CategoryDocAdm::where('idcatdoc', $idcat)->delete();

        $delbook = BookAdm::where('cat_id', $idcat)->delete();

        return redirect()->route('categorias-documentos-digitales-administrador')->with('danger', trans('multi-leng.textelicarpeta'));

    }
    

}

