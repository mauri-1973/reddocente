<?php

namespace App\Http\Controllers\Auth;
use App\User;
use App\Category;
use App\Subcategory;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Auth;
use App\UserLoginLog;
use App\Events\UserEvent;
use App\Mail\NewEmailUp;
use Illuminate\Support\Facades\Mail;


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    function authenticated(Request $request, $user){        
        if(!Auth::check()){
            return view('errors.404');
        }
        event(new UserEvent($request,$user));      
    }
    protected function credentials(Request $request)
    {
        return [
            'email' => trim(request()->email),
            'password' => request()->password,
            'status_us' => 1
        ];
    }

    public function showLoginFormnew()
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
            array_push($arraycat, array('nombrecat' => $cat->name, 'idcat' => $cat->id_cat, 'arraysub' => $arraysub));
        };
        return view('auth.login', compact('arraycat'));
    }
    public function sendmail(Request $request)
    {
        $subcat4 = [];
        $subcat5 = [];
        $nombre = $request->nombre;
        $email = $request->email;
        $rut = $request->rut;
        $tel = $request->tel;
        $subcat = explode(",", $request->subcat);
        $otra = $request->otra;
        $otrascat = $request->otrascat;
        $cadena = '';
        $subcadena = '.';

        for($i = 0; $i < count($subcat); $i++)
        {
            $subcat2 = explode("*", $subcat[$i]);
            if(count($subcat2) > 1)
            {
                $cadena .= $subcat2[0].',  ';
                $subcat3 = explode("-", $subcat2[1]);
                $subcat4[] = $subcat3[0];
                $subcat5[] = $subcat3[1];
            }
            else
            {
                $cadena .= $subcat2[0].'-'.$otrascat.'.';
            }
        }
        $e = '';
        $r = '';
        $t = '';
        $status = '';
        $user = User::where('email', $email)->count();
        if($user > 0)
        {
            $e = 'El email ya se encuentra registrado. Recupere su contraseña';
            $status = 'error';
        }
        $user = User::where('rut', $rut)->count();
        if($user > 0)
        {
            $r = 'El rut ya se encuentra registrado. Recupere su contraseña';
            $status = 'error';
        }
        $user = User::where('mobile', $tel)->count();
        if($user > 0)
        {
            $t = 'Este # ya se encuentra registrado.';
            $status = 'error';
        }
        
        if($status == '')
        {
            
            $ins = DB::table('solicitudesdocentes')->insertGetId(["nombre" => $nombre, "email" => $email, "rut" => $rut, "tel" => $tel, "cadena" => $cadena, "created_at" => date('Y-m-d H:i:s'), "updated_at" => date('Y-m-d H:i:s')  ] );
            if(count($subcat4) > 0 )
            {
                for($i = 0; $i < count($subcat4); $i++)
                {
                    $insid = DB::table('solicitudesid')->insertGetId(["idcat" => $subcat4[$i], "idsubcat" => $subcat5[$i], "idsol" => $ins, "created_at" => date('Y-m-d H:i:s'), "updated_at" => date('Y-m-d H:i:s')  ] );
                
                }
            }
            if($otrascat != '')
            {
                $insid = DB::table('solicitudesid')->insertGetId(["idcat" => 18, "tipo" => $otrascat, "idsol" => $ins, "created_at" => date('Y-m-d H:i:s'), "updated_at" => date('Y-m-d H:i:s')  ] );
            }
            Mail::to($email)->cc(['cco92479@reddocenteinnovador.congresocied.cl', 'cied@santotomas.cl', 'mauri-1973@outlook.cl'])->send(new NewEmailUp(["nombre" => $nombre, "email" => $email, "rut" => $rut, "tel" => $tel, "cadena" => $cadena]));
        }
        
        return json_encode([ "status" => $status, "email" => $e, "cel" => $t, "rut" => $r ]);
        //dd(["nombre" => $nombre, "email" => $email, "rut" => $rut, "tel" => $tel, "cadena" => $cadena]);
    }
}
