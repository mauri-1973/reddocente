<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Category;
use App\Subcategory;
use App\Resource;
use App\UserResourse;
use App\CategoriesForums;
use App\CategoriesChats;
use App\Book;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Mail\MailUsersNew;
use App\Mail\MailUsersNewDoc;
use Illuminate\Support\Facades\Mail;
use App\UserLoginLog;
use App\Exports\UsersExport;
use App\Imports\UsersImport;
use Excel;
use Image;
use Crypt;

class UsersController extends Controller
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
        $users = User::where("cargo_us", "Administrador")->paginate(10);

        return view('admin.users.index', compact('users'));
    }
    /**
     * Display a listing of User.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexaca()
    {
        $arraycat = array();
        $category = Category::all();
        foreach($category as $cat)
        {
            $arraysub = array();
            $sub = Subcategory::where('cat_id', $cat->id_cat)->get();
            foreach($sub as $s)
            {
                array_push($arraysub, array('idsub' => $s->id_sub, 'nombresub' => $s->name));
            }
            array_push($arraycat, array('nombrecat' => $cat->name, 'arraysub' => $arraysub));
        };
        $cat = Category::join('subcategories as sub', 'sub.cat_id', '=', 'categories.id_cat')
                ->get(['categories.*', 'sub.*']);
        $users = User::where("cargo_us", "Docente")->get();

        return view('admin.users.indexaca', compact('users', 'cat'), ['catego' => count($cat) , 'arraycat' => $arraycat]);
    }
    public function indexest()
    {
        $cat = Category::join('subcategories as sub', 'sub.cat_id', '=', 'categories.id_cat')
        ->join('resources as res', 'res.subcategory_id', '=', 'sub.id_sub')
        ->join('users as us', 'us.id', '=', 'res.user_id')
        ->where('us.cargo_us', 'Docente')
        ->get(['categories.id_cat as idcat', 'categories.name as namecat', 'sub.id_sub as idsub', 'sub.name as namesub', 'us.id as idusu', 'us.name as nombre', 'us.surname as apellido', 'res.id_rec as idrec']);
        $users = User::where("cargo_us", "Estudiante")->get();
        return view('admin.users.indexest', compact('users', 'cat'), ['catego' => count($cat)]);
    }
    public function indexnot()
    {
        $users = User::where("cargo_us", "Periodista")->get();

        return view('admin.users.indexnot', compact('users'));
    }

    public function indexrev()
    {
        $users = User::where("cargo_us", "Revisor")->get();

        return view('admin.users.indexrev', compact('users'));
    }
    /**
     * Display a listing of User.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexLoginLogs()
    {
        $userLoginActivities = UserLoginLog::paginate(10);

        return view('admin.activity.logs', compact('userLoginActivities'));
    }

    /**
     * Show the form for creating new User.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::get()->pluck('name', 'name');
        foreach($roles as $rol)
        {
            switch (true) 
            {
                case (Auth::user()->cargo_us == "Administrador"):
                    return view('admin.users.create', compact('roles'));
                break;
                case (Auth::user()->cargo_us == "Academico"):
                    return view('admin.users.createaca', compact('roles'));
                break;
                case (Auth::user()->cargo_us == "Periodista"):
                    return view('admin.users.createnot', compact('roles'));
                break;
                case (Auth::user()->cargo_us == "Usuario"):
                    return view('admin.users.createest', compact('roles'));
                break;
                default:
                    return redirect()->route('home')->with('danger', trans('multi-leng.error1')."UsersController:create");
                break;
            }
        }
        
    }

    /**
     * Show the form for creating new User.
     *
     * @return \Illuminate\Http\Response
     */
    public function adduser($tipo)
    {
        $roles = Role::get()->pluck('name', 'name');
        foreach($roles as $rol)
        {
            switch (true) 
            {
                case ($tipo == "administradores"):
                    
                    return view('admin.users.create', compact('roles'));
                break;
                case ($tipo == "academicos"):
                    $arraycat = array();
                    $category = Category::all();
                    foreach($category as $cat)
                    {
                        $arraysub = array();
                        $sub = Subcategory::where('cat_id', $cat->id_cat)->get();
                        foreach($sub as $s)
                        {
                            array_push($arraysub, array('idsub' => $s->id_sub, 'nombresub' => $s->name));
                        }
                        array_push($arraycat, array('nombrecat' => $cat->name, 'arraysub' => $arraysub));
                    };
                    return view('admin.users.createaca', compact('roles', 'arraycat'));
                break;
                case ($tipo == "periodistas"):
                    return view('admin.users.createnot', compact('roles'));
                break;
                case ($tipo == "estudiantes"):
                    $arraycat = Category::join('subcategories as sub', 'sub.cat_id', '=', 'categories.id_cat')
                    ->join('resources as res', 'res.subcategory_id', '=', 'sub.id_sub')
                    ->join('users as us', 'us.id', '=', 'res.user_id')
                    ->where('us.cargo_us', 'Docente')
                    ->get(['categories.id_cat as idcat', 'categories.name as namecat', 'sub.id_sub as idsub', 'sub.name as namesub', 'us.id as idusu', 'us.name as nombre', 'us.surname as apellido', 'res.id_rec as idrec']);
                    $arreglo = array();
                    foreach($arraycat as $row)
                    {
                        array_push($arreglo, array("idcat" => $row->idcat,  "namecat" => $row->namecat, "idsub" => $row->idcat, "namesub" => $row->namesub, "iduseresp" => $row->idusu, "idrec" => $row->idrec, "iduser" => $row->nombre." ".$row->apellido));
                    }
                    $val = $this->getPeopleByAge($arreglo);
                    return view('admin.users.createest', compact('roles', 'val'));
                break;
                case ($tipo == "revisor"):
                    return view('admin.users.createrev', compact('roles'));
                break;
                default:
                    return redirect()->route('home')->with('danger', trans('multi-leng.error1')."Users-Cont: adduser");
                break;
            }
        }
        
    }
    

    /**
     * Store a newly created User in storage.
     *
     * @param  \App\Http\Requests\StoreUsersRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tipo = $request->tipo;
        if($tipo == 1 || $tipo == 4 || $tipo == 5 )
        {
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'surname' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'mobile' => ['required', 'numeric', 'digits:9', 'unique:users'],
                'password' => ['required','min:5'],
                'roles.*' => ['required']
            ]);
        }
        if($tipo == 2 || $tipo == 3)
        {
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'surname' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'mobile' => ['required', 'numeric', 'digits:9', 'unique:users'],
                'password' => ['required','min:5'],
                'roles.*' => ['required'],
                'subcat.*' => ['required']
            ]);
        }
        
        if($request->avatar != "")
        {
            $request->validate([
                'avatar' => 'image|mimes:jpg,png,jpeg|max:9000|dimensions:min_width=400,min_height=400,max_width=400,max_height=400'
            ]);
        }
        $nameSanitize = filter_var(ucwords($request->name), FILTER_SANITIZE_STRING);
        $surnameSanitize = filter_var(ucwords($request->surname), FILTER_SANITIZE_STRING);
        $emailSanitize = filter_var(strtolower($request->email), FILTER_SANITIZE_STRING);
        $mobileSanitize = filter_var($request->mobile, FILTER_SANITIZE_STRING);
        $surnameSanitize = filter_var($request->surname, FILTER_SANITIZE_STRING);
        $emailSanitize = filter_var($request->email, FILTER_SANITIZE_STRING);
        $passSanitize = filter_var($request->password, FILTER_SANITIZE_STRING);
        
        $user = new User;
        $user->name    = $nameSanitize;
        $user->surname    = $surnameSanitize;
        $user->email    = $emailSanitize;
        $user->mobile    = $mobileSanitize;
        $user->password    = bcrypt(filter_var($passSanitize, FILTER_SANITIZE_STRING));
        $user->status_us    = 1;
        if($tipo == 1)
        {
            $user->cargo_us    = "Administrador";
        }
        if($tipo == 2)
        {
            $user->cargo_us    = "Docente";
        }
        if($tipo == 3)
        {
            $user->cargo_us    = "Estudiante";
        }
        if($tipo == 4)
        {
            $user->cargo_us    = "Periodista";
        }
        if($tipo == 5)
        {
            $user->cargo_us    = "Revisor";
        }
        $user->save();
        $roles = $request->input('roles') ? $request->input('roles') : [];
        $user->assignRole($roles);

        $newImageName = 'sinregistro.png';

        if($file = $request->file('avatar'))
        {
            $newImageName = createavatar($file, $user->id);
        }
        else
        {
            User::where('id', $user->id)->update(['avatar' => $newImageName]);
        }
        $mensaje1 = trans('multi-leng.formerror17');
        if($request->sendmail == 1)
        {
            //Mail::to("mauri-1973@outlook.cl")->send(new MailUsersNew($nameSanitize.' '.$surnameSanitize, $passSanitize, $emailSanitize));
            Mail::to($emailSanitize)->send(new MailUsersNew($nameSanitize.' '.$surnameSanitize, $passSanitize, $emailSanitize));

            if(Mail::failures() != 0) 
            {
                $mensaje1 = trans('multi-leng.formerror18');
            }   
            else
            {
                $mensaje1 = trans('multi-leng.formerror19');
            }
        }
        
             
        if($tipo == 1)
        {
            return redirect()->route('agregar-usuarios-administradores')->with('success', trans('multi-leng.formerror15').$nameSanitize." ".$surnameSanitize.trans('multi-leng.formerror16').$mensaje1);
        }
        if($tipo == 2)
        {
            foreach($request->subcat as $row => $slice)
            {
                $res = Subcategory::select('carpeta')->where('id_sub', (int)$request->subcat[$row])->first();
                $destino = $res->carpeta;
                $carpeta = date("YmdHis");
                $anexo =  preg_replace("/\s+/", "", trim($nameSanitize)).$carpeta;
                
                $dataClient = new Resource;
                $dataClient->title    = "actualizar";
                $dataClient->author    = "actualizar";
                $dataClient->user_id    = $user->id;
                $dataClient->subcategory_id     = (int)$request->subcat[$row];
                $dataClient->folder = $destino.'/'.$anexo;
                $dataClient->save();

                $path = storage_path('app/public/'.$destino.'/'.$anexo);
                if (!is_dir($path))
                {
                    mkdir($path, 0777, true);
                }
            } 
            return redirect()->route('agregar-usuarios-academicos')->with('success', trans('multi-leng.formerror15').$nameSanitize." ".$surnameSanitize.trans('multi-leng.formerror16').$mensaje1);
        }
        if($tipo == 3)
        {
            foreach($request->subcat as $row => $slice)
            {
                $dataClient = new UserResourse;
                $dataClient->id_us    = $user->id;
                $dataClient->id_res   = (int)$request->subcat[$row];
                $dataClient->status   = "habilitado";
                $dataClient->save();
            }
            return redirect()->route('agregar-usuarios-estudiantes')->with('success', trans('multi-leng.formerror15').$nameSanitize." ".$surnameSanitize.trans('multi-leng.formerror16').$mensaje1);
        }
        if($tipo == 4)
        {
            return redirect()->route('agregar-usuarios-noticias')->with('success', trans('multi-leng.formerror15').$nameSanitize." ".$surnameSanitize.trans('multi-leng.formerror16').$mensaje1);
        }
        if($tipo == 5)
        {
            return redirect()->route('agregar-usuarios-revisores')->with('success', trans('multi-leng.formerror15').$nameSanitize." ".$surnameSanitize.trans('multi-leng.formerror16').$mensaje1);
        }
        else
        {
            return view('errors.403');
        }

        
    }


    /**
     * Show the form for editing User.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $roles = Role::get()->pluck('name', 'name');

        $user = User::findOrFail($id);

        $data = $user->roles()->pluck('name');
        $selectedRoles = $data[0];
        $select = [];
        $arraycat = array();
        if($selectedRoles == "docente")
        {
            
            $category = Category::all();
            foreach($category as $cat)
            {
                $arraysub = array();
                $sub = Subcategory::where('cat_id', $cat->id_cat)->get();
                foreach($sub as $s)
                {
                    
                    $validador = Resource::where(['subcategory_id' => $s->id_sub, "user_id" => $id])->count();
                    if($validador > 0)
                    {
                        $select[] = $s->id_sub;
                    }
                    array_push($arraysub, array('idsub' => $s->id_sub, 'nombresub' => $s->name ));
                }
                array_push($arraycat, array('nombrecat' => $cat->name, 'arraysub' => $arraysub));
            };

        }

        return view('admin.users.edit', compact('user', 'roles','selectedRoles'), ["arraycat" => $arraycat, "select" => $select]);
    }

    /**
     * Update User in storage.
     *
     * @param  \App\Http\Requests\UpdateUsersRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        $id = Crypt::decrypt($id);
        
        
        
        if($request->avatar != "")
        {
            $request->validate([
                'avatar' => 'image|mimes:jpg,png,jpeg|max:9000|dimensions:min_width=400,min_height=400,max_width=400,max_height=400'
            ]);
        }
        if($request->tipo == 0)
        {
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'surname' => ['required', 'string', 'max:255'],
                'email' => ['required','string', 'email', 'max:255', Rule::unique('users')->ignore($id)],
                'mobile' => ['required', 'numeric', 'digits:9', Rule::unique('users')->ignore($id)],
                'profesion' => ['required', 'string', 'max:50'],
                'subcat' => ['required'],
            ]);
        }
        else
        {
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'surname' => ['required', 'string', 'max:255'],
                'email' => ['required','string', 'email', 'max:255', Rule::unique('users')->ignore($id)],
                'mobile' => ['required', 'numeric', 'digits:9', Rule::unique('users')->ignore($id)],
                'profesion' => ['required', 'string', 'max:50'],
            ]);
        }

        $user = User::findOrFail($id);

        if($request->password != "")
        {
            $request->validate([
                'password' => ['nullable','min:5']
            ]);
            $user->update(['password' => bcrypt($request->password)]);
        }

        if($file = $request->file('avatar'))
        {
            $newImageName = createavatar($file, $id);
        }

        
        $user->update(['name' => $request->name, 'surname' => $request->surname, 'email' => $request->email, 'mobile' => $request->mobile, 'profesion' => $request->profesion]);


        if($request->tipo == 0)
        {
            $arraysubcat = [];
            $arrayresour = [];
            $new = [];
            $dif = [];
            foreach($request->subcat as $row)
            {
                $arraysubcat[] = (int)$row;
            }
            $res = Resource::select('subcategory_id')->where(['user_id' => $id])->get();
            foreach($res as $row)
            {
                $arrayresour[] = $row->subcategory_id;
            }
            
            $new = array_intersect($arraysubcat, $arrayresour);
            
            foreach($new as $row)
            {
                unset($arrayresour[$row]); //array para eliminar
            }

            $array1 = $arrayresour;
            $array2 = $new;
            foreach ($array2 as $valor) {
                foreach ($array1 as $valor2) {
                    if($valor == $valor2){
                        $borrar=array_search($valor,$array1);
                        unset($array1[$borrar]);            
                    }   
                }
            }

            $dif = array_diff($arraysubcat, $arrayresour);

            //dd(['ingresar' => $dif, 'eliminay' =>  $array1 ]);
            foreach($dif as $row)
            {
                $res = Resource::select('subcategory_id')->where(['user_id' => $id, 'subcategory_id' => (int)$row])->withTrashed()->count();
                if($res == 1)
                {
                    $idrec = [];

                    $rec = Resource::select('id_rec')->where(['subcategory_id' => (int)$row ])->withTrashed()->get();

                    foreach($rec as $row1)
                    {
                        $idrec[] = $row1->id_rec;
                    }
                    
                    $catfor = CategoriesForums::where('idres', $idrec)->withTrashed()->count();
                    if($catfor > 0)
                    {
                        $catfor = CategoriesForums::where('idres', $idrec)->restore();
                    }
                    
                    $catchat = CategoriesChats::where('idres', $idrec)->withTrashed()->count();
                    if($catchat > 0)
                    {
                        $catchat = CategoriesChats::where('idres', $idrec)->restore();
                    }

                    $catbook = Book::where('resource_id', $idrec)->withTrashed()->count();
                    if($catbook > 0)
                    {
                        $catbook = Book::where('resource_id', $idrec)->restore();
                    }

                    Resource::where(['user_id' => $id, 'subcategory_id' => (int)$row])->restore();
                }
                else
                {
                    $res = Subcategory::select('carpeta')->where('id_sub', (int)$row)->first();
                    $destino = $res->carpeta;
                    $carpeta = date("YmdHis");
                    $anexo =  preg_replace("/\s+/", "", trim($request->name)).$carpeta;
                    
                    $dataClient = new Resource;
                    $dataClient->title    = "actualizar";
                    $dataClient->author    = "actualizar";
                    $dataClient->user_id    = $id;
                    $dataClient->subcategory_id     = (int)$row;
                    $dataClient->folder = $destino.'/'.$anexo;
                    $dataClient->save();

                    $path = storage_path('app/public/'.$destino.'/'.$anexo);
                    if (!is_dir($path))
                    {
                        mkdir($path, 0777, true);
                    }
                }
                

            }
            foreach($array1 as $row)
            {
                $res = Resource::select('subcategory_id')->where(['user_id' => $id, 'subcategory_id' => (int)$row ])->count();
                
                if($res == 1)
                {
                    $res = Resource::select('*')->where(['user_id' => $id, 'subcategory_id' => (int)$row ])->first();
                    if($res->deleted_at == '')
                    {
                        $catfor = CategoriesForums::where('idres', $res->id_rec)->delete();

                        $catchat = CategoriesChats::where('idres', $res->id_rec)->delete();

                        $catbook = Book::where('resource_id', $res->id_rec)->delete();

                        Resource::select('subcategory_id')->where(['user_id' => $id, 'subcategory_id' => (int)$row ])->delete();
                    }
                    else
                    {
                        
                        $catfor = CategoriesForums::where('idres', $res->id_rec)->withTrashed()->count();
                        if($catfor > 0)
                        {
                            $catfor = CategoriesForums::where('idres', $res->id_rec)->restore();
                        }
                        
                        $catchat = CategoriesChats::where('idres', $res->id_rec)->withTrashed()->count();
                        if($catchat > 0)
                        {
                            $catchat = CategoriesChats::where('idres', $res->id_rec)->restore();
                        }

                        $catbook = Book::where('resource_id', $res->id_rec)->withTrashed()->count();
                        if($catbook > 0)
                        {
                            $catbook = Book::where('resource_id', $res->id_rec)->restore();
                        }
                        Resource::select('subcategory_id')->where(['user_id' => $id, 'subcategory_id' => (int)$row ])->restore();
                    }
                }
            }
        }
        $user = User::select('cargo_us')->where("id", $id)->first();
        if($user->cargo_us == "Administrador")
        {
            $ruta = "agregar-usuarios-administradores";
        }
        if($user->cargo_us == "Estudiante")
        {
            $ruta = "agregar-usuarios-estudiantes";
        }
        if($user->cargo_us == "Docente")
        {
            $ruta = "agregar-usuarios-academicos";
        }
        if($user->cargo_us == "Periodista")
        {
            $ruta = "agregar-usuarios-noticias";
        }
        return redirect()->route($ruta)->with('success', "The $request->name was updated successfully");
    }

    /**
     * Remove User from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        switch (true) {
            case ($request->tipo = "aca"):
                return redirect()->route('agregar-usuarios-academicos')->with('danger', "$user->name". trans("multi-leng.a269") );
            break;
            case ($request->tipo = "est"):
                return redirect()->route('agregar-usuarios-estudiantes')->with('danger', "$user->name". trans("multi-leng.a269") );
            break;
            case ($request->tipo = "not"):
                return redirect()->route('agregar-usuarios-noticias')->with('danger', "$user->name". trans("multi-leng.a269") );
            break;
            case ($request->tipo = "rev"):
                return redirect()->route('agregar-usuarios-revisores')->with('danger', "$user->name". trans("multi-leng.a269") );
            break;
            default:
                return redirect()->route('users.index')->with('danger', "$user->name". trans("multi-leng.a269") );
            break;
        }
    }

    /**
     * Delete all selected User at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if ($request->input('ids')) {
            $entries = User::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

    public function array_value_recursive($key, array $arr)
    {
        $val = array();
        array_walk_recursive($arr, function($v, $k) use($key, &$val){
            if($k == $key) array_push($val, $v);
        });

        return count($val) > 1 ? $val : array_pop($val);
    }

    public function getPeopleByAge($arrPeople)
    {
        $arrAges = array_unique($this->array_value_recursive('iduser', $arrPeople));

        $arrPeopleGroupingByAge = [];
        foreach ($arrAges as $age) {
            $arrPeopleGroupingByAge[$age] = $this->getPeopleForAgeOf($age, $arrPeople);
        }

        return $arrPeopleGroupingByAge;
    }

    public function getPeopleForAgeOf($age, $arrPeople)
    {
        $result = [];
        foreach ($arrPeople as $personData) {
            foreach ($personData as $key => $value) {
                if ($key === 'iduser' && $value === $age) {
                    $result[] = $personData;
                }
            }
        }

        return $result;
    }

    public function exportarexcelusuarios()
    {
        return Excel::download(new UsersExport, 'users.xlsx');
    }

    public function agregarexcelusuarios(Request $request)
    {
        $temp = [];
        $us = DB::table('resources')->get();
        foreach($us as $u)
        {
            $path = storage_path('app/public/'.$u->folder);
            if (!is_dir($path))
            {
                $temp[] = $u->id_rec;
                //mkdir($path, 0777, true);
            }
        }
        dd($temp);

                    
        /*$cont = 0;
        foreach($us as $u)
        {
            
            $mobileSanitize = 0;
            do {

                $mobileSanitize = "9".$this->generacelu();

            } while (User::where('mobile', $mobileSanitize)->count() > 0);

            $nameSanitize = filter_var($u->nombre, FILTER_SANITIZE_STRING);

            $surnameSanitize = filter_var($u->apellido, FILTER_SANITIZE_STRING);

            $emailSanitize = filter_var(strtolower(trim($u->email)), FILTER_SANITIZE_STRING);

            $passSanitize = trim($u->rut);//$this->generapass();

            $ing = User::where(['email' => $emailSanitize ])->count();
            if( (int)$ing == 0)
            {
                $user = new User;

                $user->name         = $nameSanitize;

                $user->surname      = $surnameSanitize;

                $user->email        = $emailSanitize;

                $user->mobile       = $mobileSanitize;

                $user->rut          = $u->rut;

                $user->password     = bcrypt($passSanitize);

                $user->status_us    = 1;

                $user->cargo_us     = "Docente";

                $user->avatar       = 'sinregistro.png';

                $user->save();
                

                $user->assignRole("docente");

                $mensaje1 = trans('multi-leng.formerror19');

                //Mail::to($emailSanitize)->send(new MailUsersNew($nameSanitize, $passSanitize, $emailSanitize));
                //Mail::to($emailSanitize)->send(new MailUsersNew($nameSanitize.' '.$surnameSanitize, $passSanitize, $emailSanitize));

                /*if(Mail::failures() != 0) 
                {
                    $mensaje1 = trans('multi-leng.formerror18');
                }   
                else
                {
                    $mensaje1 = trans('multi-leng.formerror19');
                }

                    
                    $res = Subcategory::select('carpeta', 'cat_id')->where('id_sub', $temp)->first();

                    $destino = $res->carpeta;

                    $carpeta = $user->id.date("YmdHis");

                    $anexo =  preg_replace("/\s+/", "", trim($nameSanitize)).$carpeta;
                    
                    $dataClient = new Resource;

                    $dataClient->title    = "actualizar";

                    $dataClient->author    = "actualizar";

                    $dataClient->user_id    = $user->id;

                    $dataClient->subcategory_id     = $temp;

                    $dataClient->folder = $destino.'/'.$anexo;

                    $dataClient->save();

                    $path = storage_path('app/public/'.$destino.'/'.$anexo);

                    if (!is_dir($path))
                    {
                        mkdir($path, 0777, true);
                    }
                    DB::table('upload_excel')->where("id", $u->id )->update(["estado" => 1]);
                    
                $cont++ ;
            }
            
        }*/
        dd("código nada más");
        //$val = Excel::import(new UsersImport, request()->file('docexcel'));
        /*$cont = 0;

        $val = Excel::toCollection(new UsersImport, request()->file('docexcel'));

        $mensaje1 = trans('multi-leng.formerror17');

        foreach($val[0] as $v)
        {
            $rut = explode('-', $v[0]);
            $nombre = explode(' ', $v[1]);
            
            if(count($nombre) == 2)
            {
                $nombres = $nombre[0];
                $apellido = $nombre[1];
            }
            elseif(count($nombre) == 3)
            {
                $nombres = $nombre[0];
                $apellido = $nombre[1].' '.$nombre[2];
            }
            elseif(count($nombre) == 4)
            {
                $nombres = $nombre[0].' '.$nombre[1];
                $apellido = $nombre[2].' '.$nombre[3];
            }
            else
            {
                $nombres = $nombre[0].' '.$nombre[1];
                $apellido = $nombre[2].' '.$nombre[3];
            }

            DB::table('upload_excel')->insert(["rut" => (int)$rut[0].'-'.$rut[1], "nombre" => $nombres, "apellido" => $apellido, "email" => strtolower(trim($v[2])), "area" => trim($v[3]) ] );
            /*if( trim($v[1] ) != "" && $this->is_valid_email( trim($v[2]) ) && $this->validaRut( str_replace('.', '', trim( $v[0] )  ) ) )
            {
                //$mobileSanitize = 0;
                do {

                    $mobileSanitize = "9".$this->generacelu();

                } while (User::where('mobile', $mobileSanitize)->count() > 0);

                $nameSanitize = filter_var(ucwords(trim($v[1])), FILTER_SANITIZE_STRING);

                $surnameSanitize = "Sin Registro";

                $emailSanitize = filter_var(strtolower(trim($v[2])), FILTER_SANITIZE_STRING);

                $passSanitize = str_replace('.', '', trim($v[2]) );//$this->generapass();

                $ing = User::where(['email' => $emailSanitize ])->count();
                
                if( (int)$ing == 0)
                {
                    $user = new User;

                    $user->name         = $nameSanitize;

                    $user->surname      = $surnameSanitize;

                    $user->email        = $emailSanitize;

                    $user->mobile       = $mobileSanitize;

                    $user->password     = bcrypt($passSanitize);

                    $user->status_us    = 1;

                    $user->cargo_us     = "Docente";

                    $user->avatar       = 'sinregistro.png';

                    //$user->save();
                    dd($user); 

                    $user->assignRole("docente");

                    $mensaje1 = trans('multi-leng.formerror19');

                    //Mail::to($emailSanitize)->send(new MailUsersNew($nameSanitize, $passSanitize, $emailSanitize));
                    //Mail::to($emailSanitize)->send(new MailUsersNew($nameSanitize.' '.$surnameSanitize, $passSanitize, $emailSanitize));

                    /*if(Mail::failures() != 0) 
                    {
                        $mensaje1 = trans('multi-leng.formerror18');
                    }   
                    else
                    {
                        $mensaje1 = trans('multi-leng.formerror19');
                    }*/

                    /*foreach($request->subcat as $row => $slice)
                    {
                        $res = Subcategory::select('carpeta')->where('id_sub', (int)$request->subcat[$row])->first();

                        $destino = $res->carpeta;

                        $carpeta = date("YmdHis");

                        $anexo =  preg_replace("/\s+/", "", trim($nameSanitize)).$carpeta;
                        
                        $dataClient = new Resource;

                        $dataClient->title    = "actualizar";

                        $dataClient->author    = "actualizar";

                        $dataClient->user_id    = $user->id;

                        $dataClient->subcategory_id     = (int)$request->subcat[$row];

                        $dataClient->folder = $destino.'/'.$anexo;

                        $dataClient->save();

                        $path = storage_path('app/public/'.$destino.'/'.$anexo);

                        if (!is_dir($path))
                        {
                            mkdir($path, 0777, true);
                        }

                    }

                    $cont++ ;
                }
                
            }*/
            
        /*}*/
        dd("ok");
        return redirect()->route('agregar-usuarios-academicos')->with('success', trans('multi-leng.a276').$cont.trans('multi-leng.a277'). $mensaje1 );
    }
    public function solingdocfor()
    {
        $array = array();
        
        $user = DB::table('solicitudesdocentes')->get();
        foreach($user as $u)
        {
            $cat = DB::table('solicitudesid')->where('idsol', $u->id)->get();
            $arr = array();
            foreach($cat as $c)
            {
                
                $catarr = Category::where('id_cat', $c->idcat)->first();
                $subcatarr = Subcategory::where('id_sub', $c->idsubcat)->count();
                
                if($subcatarr == 0)
                {
                    array_push($arr, array("idus" => $u->id, "idcat" => $c->idcat, "namecat" => $catarr->name, "idsub" => 0, "namesub" => $c->tipo, "tipo" => $c->tipo, "estadocat" => $c->estado, "solicitudid" =>  $c->id) );
                }
                else
                {
                    $subcatarr = Subcategory::where('id_sub', $c->idsubcat)->get();
                    
                    foreach($subcatarr as $su)
                    {
                        array_push($arr, array("idus" => $u->id, "idcat" => $c->idcat, "namecat" => $catarr->name, "idsub" => $c->idsubcat, "namesub" => $su->name, "tipo" => $c->tipo, "estadocat" => $c->estado, "solicitudid" =>  $c->id ) );
                    }
                    
                }
            }
            array_push($array, array("idsol" => $u->id, "nombre" => $u->nombre, "email" => $u->email, "rut" => $u->rut, "tel" => $u->tel, "cadena" => $u->tel, "estado" => $u->estado, "fecha" => $u->created_at, "cat" => $arr) );
        }
        
        return view('admin.users.solicitud', ["datos" => $array]);
    }

    public function ingcatsoldoc(Request $request)
    {
        $iddec = Crypt::decrypt($request->solicitudid);
        
        switch (true) 
        {
            case ($request->acc == 'add'):
                $u = "";
                $e = '';
                $r = '';
                $t = '';
                $status = '';
                $us = DB::table('solicitudesdocentes')->select('*')->where('id', $request->idus)->count();
                switch (true) 
                {
                    case ($us == 0):
                        $status = 'error';
                        $u = 'la solicitud de ingreso no se encuentra disponible.';
                        return json_encode([ "status" => $status, "email" => $e, "cel" => $t, "rut" => $r, "u" => $u  ]);
                    break;
                    
                    default:
                    
                        $us = DB::table('solicitudesdocentes')->select('*')->where('id', $request->idus)->first();

                        $nameSanitize = filter_var(ucwords(substr($us->nombre, 0, 30)), FILTER_SANITIZE_STRING);

                        $surnameSanitize = "Sin Registro";

                        $emailSanitize = filter_var(strtolower(trim($us->email)), FILTER_SANITIZE_STRING);

                        $mobileSanitize = filter_var(trim($us->tel), FILTER_SANITIZE_STRING);

                        $rutSanitize = filter_var(strtolower(trim($us->rut)), FILTER_SANITIZE_STRING);

                        $user = User::where('email', $us->email)->count();
                        
                        $user1 = User::where('rut', $us->rut)->count();
                        
                        $user2 = User::where('mobile', $us->tel)->count();

                        

                        if($user > 0)
                        {
                            $e = 'El email ya se encuentra registrado. Recupere su contraseña';
                            $status = 'error';
                        }
                        if($user1 > 0)
                        {
                            $r = 'El rut ya se encuentra registrado. Recupere su contraseña';
                            $status = 'error';
                        }
                        if($user2 > 0)
                        {
                            $t = 'Este # ya se encuentra registrado.';
                            $status = 'error';
                        }
                        
                        switch (true) 
                        {
                            /////////////////////////////////////////////////////////////////////////////
                            /////////////////////////////////////////////////////////////////////////////
                            ///////////////////////// Usuario No Registrado /////////////////////////////
                            /////////////////////////////////////////////////////////////////////////////
                            /////////////////////////////////////////////////////////////////////////////
                            case ( $status == '' && $e == '' && $r == '' && $t == '' && $u == '' ):

                                $user = new User;

                                $user->name         = $nameSanitize;

                                $user->surname      = $surnameSanitize;

                                $user->email        = $emailSanitize;

                                $user->mobile       = $mobileSanitize;

                                $user->rut          = $rutSanitize;

                                $user->password     = bcrypt($rutSanitize);

                                $user->status_us    = 1;

                                $user->cargo_us     = "Docente";

                                $user->avatar       = 'sinregistro.png';

                                $user->save();

                                $user->assignRole("docente");

                                $res = Category::select('carpeta')->where('id_cat', (int)$request->idcat)->count();
                                
                                switch (true) 
                                {
                                    case ($res == 0):

                                        return json_encode([ "status" => "errorcat", "email" => $e, "cel" => $t, "rut" => $r, "u" => $u  ]);

                                    break;
                                    
                                    default:

                                        $res = Category::select('carpeta')->where('id_cat', (int)$request->idcat)->first();

                                        $carpeta = $res->carpeta;
                                        
                                        switch (true) 
                                        {
                                            /////////////////////////////////////////////////////////////////////////////
                                            /////////////////////////////////////////////////////////////////////////////
                                            ///////////////////////// Otras sub-categorías //////////////////////////////
                                            /////////////////////////////////////////////////////////////////////////////
                                            /////////////////////////////////////////////////////////////////////////////
                                            case ((int)$request->idsub == 0):
                                                
                                                $subcat = new Subcategory;

                                                $subcat->name = mb_strtoupper($request->nametipo, 'UTF-8');

                                                $subcat->cat_id = (int)$request->idcat;

                                                $subcat->carpeta = $carpeta.'/OTRSSUBCAT'.date('YmdHis');

                                                $subcat->created_at = date('Y-m-d H:i:s');

                                                $subcat->updated_at = date('Y-m-d H:i:s');

                                                $subcat->save();


                                                $destino = $carpeta.'/OTRSSUBCAT'.date('YmdHis');

                                                $carpetasub = date("YmdHis");

                                                $anexo =  preg_replace("/\s+/", "", trim($nameSanitize)).$carpetasub;
                                                
                                                $dataClient = new Resource;

                                                $dataClient->title    = "actualizar";

                                                $dataClient->author    = "actualizar";

                                                $dataClient->user_id    =  $user->id;

                                                $dataClient->subcategory_id     =  $subcat->id_sub;

                                                $dataClient->folder = $destino.'/'.$anexo;
                                                try 
                                                {
                                                    $dataClient->save();
                                                } 
                                                catch (Exception $ee) 
                                                {
                                             
                                                    return json_encode([ "status" => "errorresorce", "email" => $ee, "cel" => $t, "rut" => $r, "u" => $u  ]);
                                                }

                                                $path = storage_path('app/public/'.$destino.'/'.$anexo);

                                                if (!is_dir($path))
                                                {
                                                    mkdir($path, 0777, true);
                                                }

                                                $solicitudid = DB::table('solicitudesid')->where('id', $iddec)->count();

                                                switch (true) 
                                                {
                                                    case ($solicitudid == 0):

                                                        return json_encode([ "status" => "errorsolicitudid", "email" => $e, "cel" => $t, "rut" => $r, "u" => $u  ]);

                                                    break;
                                                    
                                                    default:
                                                    
                                                        $solicitudid = DB::table('solicitudesid')->where('id', $iddec)->update(["estado" => 1, "id_rec" => $dataClient->id_rec]);

                                                        return json_encode([ "status" => "okingresada", "email" => $e, "cel" => $t, "rut" => $r, "u" => $u  ]);

                                                    break;
                                                }

                                            break;
                                            
                                            default:
                                                /////////////////////////////////////////////////////////////////////////////
                                                /////////////////////////////////////////////////////////////////////////////
                                                ///////////////////////// Con Subcategoría //////////////////////////////
                                                /////////////////////////////////////////////////////////////////////////////
                                                /////////////////////////////////////////////////////////////////////////////
                                                $ressub = Subcategory::select('carpeta')->where('id_sub', (int)$request->idsub)->count();

                                                switch (true) 
                                                {
                                                    case ($ressub == 0):
                                                        return json_encode([ "status" => "errorsubcat", "email" => $e, "cel" => $t, "rut" => $r, "u" => $u  ]);
                                                    break;
                                                    
                                                    default:

                                                        $ressub = Subcategory::select('*')->where('id_sub', (int)$request->idsub)->first();

                                                        $carpetasub = $ressub->carpeta;

                                                        $destino = $carpetasub;

                                                        $carpetasubnew = date("YmdHis");

                                                        $anexo =  preg_replace("/\s+/", "", trim($nameSanitize)).$carpetasubnew;
                                                        
                                                        $dataClient = new Resource;

                                                        $dataClient->title    = "actualizar";

                                                        $dataClient->author    = "actualizar";

                                                        $dataClient->user_id    =  $user->id;

                                                        $dataClient->subcategory_id     =  $ressub->id_sub;

                                                        $dataClient->folder = $destino.'/'.$anexo;

                                                        try 
                                                        {
                                                            $dataClient->save();
                                                        } 
                                                        catch (Exception $ee) 
                                                        {
                                                    
                                                            return json_encode([ "status" => "errorresorce", "email" => $ee, "cel" => $t, "rut" => $r, "u" => $u  ]);
                                                        }

                                                        
                                                        $path = storage_path('app/public/'.$destino.'/'.$anexo);

                                                        if (!is_dir($path))
                                                        {
                                                            mkdir($path, 0777, true);
                                                        }

                                                        $solicitudid = DB::table('solicitudesid')->where('id', $iddec)->count();

                                                        switch (true) 
                                                        {
                                                            case ($solicitudid == 0):

                                                                return json_encode([ "status" => "errorsolicitudid", "email" => $e, "cel" => $t, "rut" => $r, "u" => $u  ]);

                                                            break;
                                                            
                                                            default:

                                                            $solicitudid = DB::table('solicitudesid')->where('id', $iddec)->update(["estado" => 1, "id_rec" => $dataClient->id_rec ]);

                                                                return json_encode([ "status" => 'okingresada', "email" => $e, "cel" => $t, "rut" => $r, "u" => $u  ]);

                                                            break;
                                                        }
                                                    break;
                                                }

                                                
                                            break;
                                        }

                                    break;
                                }
                            break;
                            /////////////////////////////////////////////////////////////////////////////
                            /////////////////////////////////////////////////////////////////////////////
                            ///////////////////////// Usuario Registrado /////////////////////////////
                            /////////////////////////////////////////////////////////////////////////////
                            /////////////////////////////////////////////////////////////////////////////
                            default:
                                
                                $usval = User::where('rut', $us->rut)->count();
                                
                                switch (true) 
                                {
                                    case ($usval == 0):

                                        return json_encode([ "status" => "errorrut", "email" => $e, "cel" => $t, "rut" => $r, "u" => $u  ]);

                                    break;
                                    
                                    default:
                                    
                                        $usval = User::where('rut', $us->rut)->first();
                                        
                                        $res = Category::select('carpeta')->where('id_cat', (int)$request->idcat)->count();

                                        switch (true) 
                                        {
                                            case ($res == 0):

                                                return json_encode([ "status" => "errorcat", "email" => $e, "cel" => $t, "rut" => $r, "u" => $u  ]);

                                            break;
                                            
                                            default:
                                            
                                                $res = Category::select('carpeta')->where('id_cat', (int)$request->idcat)->first();

                                                $carpeta = $res->carpeta;
                                                
                                                switch (true) 
                                                {
                                                    case ((int)$request->idsub == 0):
                                                        
                                                        
                                                        $subcat = new Subcategory;

                                                        $subcat->name = mb_strtoupper($request->nametipo, 'UTF-8');

                                                        $subcat->cat_id = (int)$request->idcat;

                                                        $subcat->carpeta = $carpeta.'/OTRSSUBCAT'.date('YmdHis');

                                                        $subcat->created_at = date('Y-m-d H:i:s');

                                                        $subcat->updated_at = date('Y-m-d H:i:s');

                                                        try 
                                                        {
                                                            $subcat->save();
                                                        } 
                                                        catch (Exception $ee) 
                                                        {
                                                    
                                                            return json_encode([ "status" => "errorsubcat", "email" => $ee, "cel" => $t, "rut" => $r, "u" => $u  ]);
                                                        }

                                                        $destino = $carpeta.'/OTRSSUBCAT'.date('YmdHis');

                                                        $carpetasub = date("YmdHis");

                                                        $anexo =  preg_replace("/\s+/", "", trim($nameSanitize)).$carpetasub;
                                                        
                                                        $dataClient = new Resource;

                                                        $dataClient->title    = "actualizar";

                                                        $dataClient->author    = "actualizar";

                                                        $dataClient->user_id    =  $usval->id;

                                                        $dataClient->subcategory_id     =  $subcat->id_sub;

                                                        $dataClient->folder = $destino.'/'.$anexo;

                                                        try 
                                                        {
                                                            $dataClient->save();
                                                        } 
                                                        catch (Exception $ee) 
                                                        {
                                                    
                                                            return json_encode([ "status" => "errorresorce", "email" => $ee, "cel" => $t, "rut" => $r, "u" => $u  ]);
                                                        }
                                                        

                                                        

                                                        $path = storage_path('app/public/'.$destino.'/'.$anexo);

                                                        if (!is_dir($path))
                                                        {
                                                            mkdir($path, 0777, true);
                                                        }

                                                        $solicitudid = DB::table('solicitudesid')->where('id', $iddec)->count();
                                                        switch (true) 
                                                        {
                                                            case ($solicitudid == 0):
                                                                return json_encode([ "status" => "errorsolicitudid", "email" => $e, "cel" => $t, "rut" => $r, "u" => $u  ]);
                                                            break;
                                                            
                                                            default:

                                                                $solicitudid = DB::table('solicitudesid')->where('id', $iddec)->update(["estado" => 1, "id_rec" => $dataClient->id_rec ]);

                                                                return json_encode([ "status" => 'okingresada', "email" => '', "cel" => '', "rut" => '', "u" => ''  ]);

                                                            break;
                                                        }

                                                        

                                                    break;
                                                    
                                                    default:
                                                    
                                                        $ressub = Subcategory::select('carpeta')->where([ 'id_sub' => (int)$request->idsub ])->count();

                                                        switch (true) 
                                                        {
                                                            case ($ressub == 0):
                                                                return json_encode([ "status" => "errorsubcat", "email" => $e, "cel" => $t, "rut" => $r, "u" => $u  ]);
                                                            break;
                                                            
                                                            default:

                                                                $ressub = Subcategory::select('*')->where('id_sub', (int)$request->idsub)->first();

                                                                $carpetasub = $ressub->carpeta;

                                                                $destino = $carpetasub;

                                                                $carpetasubnew = date("YmdHis");

                                                                $anexo =  preg_replace("/\s+/", "", trim($nameSanitize)).$carpetasubnew;


                                                                $validador = Resource::select('*')->where(['subcategory_id' => $ressub->id_sub, 'user_id' => $usval->id  ])->count();

                                                                if($validador > 0)
                                                                {
                                                                    $validador = Resource::select('*')->where(['subcategory_id' => $ressub->id_sub, 'user_id' => $usval->id  ])->first();

                                                                    $validador = $validador->id_rec;
                                                                }
                                                                else
                                                                {
                                                                    $dataClient = new Resource;

                                                                    $dataClient->title    = "actualizar";

                                                                    $dataClient->author    = "actualizar";

                                                                    $dataClient->user_id    =  $usval->id;

                                                                    $dataClient->subcategory_id     =  $ressub->id_sub;

                                                                    $dataClient->folder = $destino.'/'.$anexo;

                                                                    
                                                                    try 
                                                                    {
                                                                        $dataClient->save();
                                                                        $validador = $dataClient->id_rec;
                                                                    } 
                                                                    catch (Exception $ee) 
                                                                    {
                                                                
                                                                        return json_encode([ "status" => "errorresourse", "email" => $ee, "cel" => $t, "rut" => $r, "u" => $u  ]);
                                                                    }
                                                                    $path = storage_path('app/public/'.$destino.'/'.$anexo);

                                                                    if (!is_dir($path))
                                                                    {
                                                                        mkdir($path, 0777, true);
                                                                    }

                                                                }
                                                                
                                                                $solicitudid = DB::table('solicitudesid')->where('id', $iddec)->count();

                                                                switch (true) 
                                                                {
                                                                    case ($solicitudid == 0):
                                                                        return json_encode([ "status" => "errorsolicitudid", "email" => $e, "cel" => $t, "rut" => $r, "u" => $u  ]);
                                                                    break;
                                                                    
                                                                    default:
                                                                    $solicitudid = DB::table('solicitudesid')->where('id', $iddec)->update(["estado" => 1, "id_rec" => $validador ]);

                                                                        return json_encode([ "status" => 'okingresada', "email" => '', "cel" => '', "rut" => '', "u" => ''  ]);

                                                                    break;
                                                                }
                                                            break;
                                                        }

                                                        
                                                    break;
                                                }

                                            break;
                                        }


                                    break;
                                }

                            break;
                        }

                        dd("error1390");

                    break;
                }
                
            break;

            case ($request->acc == 'del'):

                $solicitudid = DB::table('solicitudesid')->where('id', $iddec)->count();

                switch (true) 
                {
                    case ($solicitudid == 0):
                        
                        return json_encode([ "status" => "errorsolid", "email" => '', "cel" => '', "rut" => '', "u" => ''  ]);

                    break;
                    case ($solicitudid == 1):

                        $solicitudid = DB::table('solicitudesid')->where('id', $iddec)->first();

                        $rec = Resource::select('*')->where(['id_rec' => $solicitudid->id_rec])->count();
                        
                        switch (true) 
                        {
                            case ($rec == 0):
                               
                                try 
                                {
                                    $solicitudid = DB::table('solicitudesid')->where('id', $iddec)->update(["estado" => 2]);

                                    return json_encode([ "status" => 'soleliminada', "email" => '', "cel" => '', "rut" => '', "u" => ''  ]);
                                } 
                                catch (Exception $e) 
                                {
                                    return json_encode([ "status" => 'errorsoleli', "email" => '', "cel" => '', "rut" => '', "u" => ''  ]);
                                }
                                
                            break;
                            case ($rec == 1):
                                dd('1');
                                $rec = Resource::select('*')->where(['id_rec' => $solicitudid->id_rec])->first();

                                $path = storage_path('app/public/'.$rec->folder);

                                $this->deleteDirectory($path);

                                $resdel = Resource::where('id_rec', $sol->id_rec)->delete();

                                try 
                                {
                                    $solicitudid = DB::table('solicitudesid')->where('id', $iddec)->update(["estado" => 2]);

                                    return json_encode([ "status" => 'soleliminada', "email" => '', "cel" => '', "rut" => '', "u" => ''  ]);
                                } 
                                catch (Exception $e) 
                                {
                                    return json_encode([ "status" => 'errorsoleli', "email" => '', "cel" => '', "rut" => '', "u" => ''  ]);
                                }
                                
                            break;
                            default:
                                return json_encode([ "status" => "erroridrec", "email" => '', "cel" => '', "rut" => '', "u" => ''  ]);
                            break;
                        }

                    break;

                    default:
                        return json_encode([ "status" => "error1557", "email" => '', "cel" => '', "rut" => '', "u" => ''  ]);
                    break;
                }

            break;

            case ($request->acc == 'addus'):
                
                $user = User::where('rut', $request->nametipo)->count();
                
                switch (true) 
                {
                    case ($user == 0):
                        
                        return json_encode([ "status" => 'erroriduser', "email" => '', "cel" => '', "rut" => '', "u" => ''  ]);

                    break;

                    case ($user == 1):

                        $user = User::where('rut', $request->nametipo)->first();

                        $res = Resource::where('user_id', $user->id)->count();
                        
                        switch (true) 
                        {

                            case ($res == 0):

                                return json_encode([ "status" => 'errornumrec', "email" => '', "cel" => '', "rut" => '', "u" => ''  ]);

                            break;

                            case ($res >= 1):

                                try 
                                {
                                   
                                    $solicitudid = DB::table('solicitudesdocentes')->where('id', $iddec)->update(["estado" => 1]);

                                    Mail::to($user->email)->cc(['cco92479@reddocenteinnovador.congresocied.cl', 'cied@santotomas.cl', 'mauri-1973@outlook.cl'])->send(new MailUsersNew($user->name.' '.$user->surname, $user->rut, $user->email ));

                                    if(Mail::failures() != 0) 
                                    {
                                        return json_encode([ "status" => 'okfinalizada', "email" => 'El email de notificación fue enviado al docente correctamente.', "cel" => '', "rut" => '', "u" => ''  ]);
                                    }   
                                    else
                                    {
                                        return json_encode([ "status" => 'okfinalizada', "email" => 'El email de notificación no pudo ser enviado.', "cel" => '', "rut" => '', "u" => ''  ]);
                                    }
                                    
                                } 
                                catch (Exception $e) 
                                {
                                    
                                    return json_encode([ "status" => 'errorsolicitudesdocentes', "email" => '', "cel" => '', "rut" => '', "u" => ''  ]);
                                }

                            break;
                            
                            default:
                                
                                return json_encode([ "status" => 'error1440', "email" => 'linea 1547', "cel" => '', "rut" => '', "u" => ''  ]);

                            break;
                        }

                    break;

                    default:
                        
                        return json_encode([ "status" => 'error1464', "email" => 'linea 1556', "cel" => '', "rut" => '', "u" => ''  ]);

                    break;
                }

            break;
            case ($request->acc == 'delus'):

                $solicitudid = DB::table('solicitudesid')->select('*')->where('idsol', $iddec)->count();

                switch (true) 
                {
                    case ($solicitudid == 0):

                        $soli = DB::table('solicitudesdocentes')->where('id', $iddec)->update(["estado" => 2]);
                        
                        return json_encode([ "status" => 'sinsol', "email" => '', "cel" => '', "rut" => '', "u" => ''  ]);

                    break;

                    case ($solicitudid >= 1):

                        $solicitudid = DB::table('solicitudesid')->select('*')->where('idsol', $iddec)->get();

                        foreach($solicitudid as $sol)
                        {
                            if($sol->id_rec > 0)
                            {
                                $res = Resource::select('*')->where('id_rec', $sol->id_rec)->first();

                                $path = storage_path('app/public/'.$res->folder);

                                $this->deleteDirectory($path);

                                $resdel = Resource::where('id_rec', $sol->id_rec)->delete();
                            }
                            
                            $solic = DB::table('solicitudesid')->where('id', $sol->id)->update(["estado" => 2]);

                        }

                        $soli = DB::table('solicitudesdocentes')->where('id', $iddec)->update(["estado" => 2]);

                        return json_encode([ "status" => 'okeliminada', "email" => '', "cel" => '', "rut" => '', "u" => ''  ]);

                    break;

                    default:
                        
                        return json_encode([ "status" => 'error1464', "email" => '', "cel" => '', "rut" => '', "u" => ''  ]);

                    break;
                }

            break;
            
            default:
                dd("error1397");
            break;
        }
        
        
        
        //return json_encode([ "status" => $status, "email" => $e, "cel" => $t, "rut" => $r ]);
    }
    private function deleteDirectory($dir) {
        if(!$dh = @opendir($dir)) return false;
        while (false !== ($current = readdir($dh))) 
        {
            if($current != '.' && $current != '..') 
            {
                if (!@unlink($dir.'/'.$current)) 
                {
                    $this->deleteDirectory($dir.'/'.$current);
                }
                    
            }       
        }
        closedir($dh);
        @rmdir($dir);
        return true;
    }
    
    private function generacelu()
    {
        $caracteres = '0123456789';
        $caractereslong = strlen($caracteres);
        $clave = '';
        for($i = 0; $i < 8; $i++) 
        {
            $clave .= $caracteres[rand(0, $caractereslong - 1)];
        }
        return $clave;
    }

    private function generapass()
    {
        $caracteres = '0123456789abcdefghijklmnpqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ$#@!?=%-+*.[]{}_,;:<>|';
        $caractereslong = strlen($caracteres);
        $clave = '';
        for($i = 0; $i < 10; $i++) 
        {
            $clave .= $caracteres[rand(0, $caractereslong - 1)];
        }
        return $clave;
    }
    private function is_valid_email($str)
    {
        $matches = null;
        return (1 === preg_match('/^[A-z0-9\\._-]+@[A-z0-9][A-z0-9-]*(\\.[A-z0-9_-]+)*\\.([A-z]{2,6})$/', $str, $matches));
    }
    private function not_repeat_email($str)
    {
        $matches = null;
        return (1 === preg_match('/^[A-z0-9\\._-]+@[A-z0-9][A-z0-9-]*(\\.[A-z0-9_-]+)*\\.([A-z]{2,6})$/', $str, $matches));
    }
    private function validaRut ( $rutCompleto ) 
    {
        if ( !preg_match("/^[0-9]+-[0-9kK]{1}/", $rutCompleto) )
        {
            return false;
        } 

        $rut = explode('-', $rutCompleto);
       
        return strtolower($rut[1]) == $this->dv($rut[0]);
    }
    private function dv( $T ) 
    {
            $M = 0; $S = 1;
            for(;$T; $T=floor($T/10))

                $S = ($S + $T % 10 * (9 - $M++ %6 ) )% 11;

            return $S ? $S -1 : 'k';
    }

}
