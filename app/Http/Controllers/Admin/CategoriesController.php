<?php



namespace App\Http\Controllers\Admin;



use App\User;

use App\Category;

use App\Subcategory;

use Spatie\Permission\Models\Role;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Gate;

use App\Http\Controllers\Controller;

use Illuminate\Validation\Rule;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\DB;

use App\UserLoginLog;



class CategoriesController extends Controller

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

    public function indexini()

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

        return view('admin.categories.indexcat', ['catego' => count($arreglo1), 'arreglo' => $arreglo1]);

    }



    public function ingcatadm(Request $request)

    {

        $namecatSanitize = filter_var($request->namecat, FILTER_SANITIZE_STRING);

        $namecatSanitize = eliminar_tildes($namecatSanitize);

        $carpeta = date("YmdHis");

        $anexo =  preg_replace("/\s+/", "", trim($namecatSanitize)).$carpeta;

        $dataClient = new Category;

        $dataClient->name    = $namecatSanitize;

        $dataClient->carpeta = $anexo;

        $dataClient->save();

        $path = storage_path('app/public/'.$anexo);

        if (!is_dir($path))

        {

            mkdir($path, 0777, true);

        }

        return redirect()->route('agregar-categorias-administrador')->with('success', trans('multi-leng.textingfolder'));

    }



    public function editcatadm(Request $request)

    {

        $namecatSanitize = filter_var($request->namecat, FILTER_SANITIZE_STRING);

        $namecatSanitize = eliminar_tildes($namecatSanitize);

        $post = Category::firstOrNew(['id_cat' => $request->idcat]); 

        $post->name = $namecatSanitize;

        $post->save();

        return redirect()->route('agregar-categorias-administrador')->with('success', trans('multi-leng.texteditcarpeta'));

    }



    public function elitcatadm(Request $request)

    {

        $namecatSanitize = filter_var($request->namecat, FILTER_SANITIZE_STRING);

        $model = Category::where(['id_cat' => $request->idcat])->delete();

        $model = Subcategory::where(['cat_id' => $request->idcat])->delete();

        return redirect()->route('agregar-categorias-administrador')->with('success', trans('multi-leng.textelicarpeta'));

    }

    

    public function valnomcat(Request $request)

    {

        $val = 1;

        $namecatSanitize = filter_var($request->name, FILTER_SANITIZE_STRING);

        $namecatSanitize = eliminar_tildes($namecatSanitize);

        $category = Category::select('*')->where('name', $namecatSanitize)->count();

        if($category > 0)

        {

            $val = 2;

        }

        return response()->json(['val' => $val]);

    }



























    public function indexest()

    {

        $cat = Category::join('subcategories as sub', 'sub.cat_id', '=', 'categories.id_cat')

                ->join('resources as res', 'res.subcategory_id', '=', 'sub.id_sub')

                ->join('users as us', 'us.id', '=', 'res.user_id')

                ->where('us.cargo_us', 'Academico')

                ->get(['categories.*', 'sub.*', 'us.*']);

        $users = User::where("cargo_us", "Usuario")->get();



        return view('admin.users.indexest', compact('users', 'cat'), ['catego' => count($cat)]);

    }

    public function indexnot()

    {

        $users = User::where("cargo_us", "Periodista")->paginate(10);



        return view('admin.users.indexnot', compact('users'));

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

                case ($tipo == "adm"):

                    return view('admin.users.create', compact('roles'));

                break;

                case ($tipo == "aca"):

                    return view('admin.users.createaca', compact('roles'));

                break;

                case ($tipo == "not"):

                    return view('admin.users.createnot', compact('roles'));

                break;

                case ($tipo == "est"):

                    return view('admin.users.createest', compact('roles'));

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

        $request->validate([

            'name' => ['required', 'string', 'max:255'],

            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],

            'mobile' => ['required', 'numeric', 'digits:10', 'unique:users'],

            'password' => ['required','min:5'],

            'roles.*' => ['required']

        ]);



        $user = User::create(array_merge($request->all(),['password' => bcrypt($request->password)]));

        $roles = $request->input('roles') ? $request->input('roles') : [];

        $user->assignRole($roles);



        return redirect()->route('users.index')->with('success', "The $user->name was saved successfully");

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



        return view('admin.users.edit', compact('user', 'roles','selectedRoles'));

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

        $request->validate([

            'name' => ['required', 'string', 'max:255'],

            'email' => ['required','string', 'email', 'max:255', Rule::unique('users')->ignore($id)],

            'mobile' => ['required', 'numeric', 'digits:10', Rule::unique('users')->ignore($id)],

            'password' => ['sometimes','nullable','min:5'],

            'roles.*' => ['required']

        ]);



        $user = User::findOrFail($id);

        $user->update(array_merge($request->all(),['password' => bcrypt($request->password)]));

        $roles = $request->input('roles') ? $request->input('roles') : [];

        $user->syncRoles($roles);



        return redirect()->route('users.index')->with('warning', "The $user->name was updated successfully");

    }



    /**

     * Remove User from storage.

     *

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function destroy($id)

    {

        $user = User::findOrFail($id);

        $user->delete();



        return redirect()->route('users.index')->with('danger', "The $user->name was deleted successfully");

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



}

