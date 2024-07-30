<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use App\Mail\MailUsersNew;
use Illuminate\Support\Facades\Mail;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $messages = [
            'name.required' => 'El nombre de usuario es obligatorio',
            'name.string' =>'El nombre de usuario debe ser una cadena de texto.',
            'name.min' => 'El mínimo requerido es de 2 caracteres.',
            'name.max' => 'El máximo requerido es hasta 50 caracteres.',
            'surname.required' => 'El nombre de usuario es obligatorio',
            'surname.string' =>'El nombre de usuario debe ser una cadena de texto.',
            'surname.min' => 'El mínimo requerido es de 2 caracteres.',
            'surname.max' => 'El máximo requerido es hasta 50 caracteres.',
            'email.required' => 'El email es obligatorio',
            'email.string' => 'El email debe ser una cadena de texto',
            'email.email' => 'El email no tiene el formato correcto',
            'email.max' => 'El máximo requerido es hasta 255 caracteres.',
            'email.unique' => 'El email ingresado ya se encuentra registrado.',
            'mobile.required' => 'El número de celular es obligatorio',
            'mobile.numeric' => 'El formato del número de celular es incorrecto',
            'mobile.max' => 'El máximo requerido es hasta 9 dígitos.',
            'mobile.unique' => 'El número de celular ya se encuentra registrado.',
            'tipo.required' => 'El tipo de perfil es obligatorio',
            'password.required' => 'El password es obligatorio.',
            'password.string' => 'El password debe ser una cadena de texto',
            'password.min' => 'El password debe contener al menos 5 caracteres',
            'password.confirmed' => 'El password debe repetirse correctamente',
            'otros.required' => 'Debe ingresar su tipo de perfil ó institución',
            'otros.string' =>'El nombre del tipo de perfil ó institución debe ser una cadena de texto.',
            'otros.min' => 'El mínimo requerido es de 2 caracteres.',
            'otros.max' => 'El máximo requerido es hasta 50 caracteres.',
        ];
        if($data['tipo'] == 3 || $data['tipo'] == 4 || $data['tipo'] == 5)
        {
            return Validator::make($data, [
                'name' => ['required', 'string', 'max:50', 'min:2'],
                'surname' => ['required', 'string', 'max:50', 'min:2'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'mobile' => ['required', 'numeric', 'digits:9', 'unique:users'],
                'tipo' => ['required'],
                'otros' => ['required', 'string', 'max:50', 'min:2'],
                'password' => ['required', 'string', 'min:5', 'confirmed'],
                'password_confirmation' => ['required', 'min:5'],
            ], $messages);
        }
        else
        {
            return Validator::make($data, [
                'name' => ['required', 'string', 'max:50', 'min:2'],
                'surname' => ['required', 'string', 'max:50', 'min:2'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'mobile' => ['required', 'numeric', 'digits:9', 'unique:users'],
                'tipo' => ['required'],
                'password' => ['required', 'string', 'min:5', 'confirmed'],
                'password_confirmation' => ['required', 'min:5'],
            ], $messages);
        }
        
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $user = User::create(['name' => filter_var($data['name'], FILTER_SANITIZE_STRING), 'surname' => filter_var($data['surname'], FILTER_SANITIZE_STRING), 'email' => filter_var($data['email'], FILTER_SANITIZE_STRING), 'mobile' => filter_var($data['mobile'], FILTER_SANITIZE_STRING), 'password' => Hash::make(filter_var($data['password'], FILTER_SANITIZE_STRING)), 'avatar' => 'sinregistro.png', 'status_us' => 1, 'cargo_us' => 'Estudiante']);

        $roles = "user";
        $user->assignRole($roles);

        if($data['tipo'] == 3 || $data['tipo'] == 4 || $data['tipo'] == 5)
        {
            $tipoing = DB::table('users_inst')->insert(['iduser' => $user->id, 'idtipo' => $data['tipo'], 'texttipo' => $data['otros'], 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')]);
        }
        else
        {
            if($data['tipo'] == 1)
            {
                $tipoing = DB::table('users_inst')->insert(['iduser' => $user->id, 'idtipo' => $data['tipo'], 'texttipo' => "Usuario activo UST", 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')]);
            }
            if($data['tipo'] == 2)
            {
                $tipoing = DB::table('users_inst')->insert(['iduser' => $user->id, 'idtipo' => $data['tipo'], 'texttipo' => "Usuario egresado UST", 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')]);
            }
        }
        
        Mail::to("mauri-1973@outlook.cl")->send(new MailUsersNew(filter_var($data['name'], FILTER_SANITIZE_STRING).' '.filter_var($data['surname'], FILTER_SANITIZE_STRING), filter_var($data['password'], FILTER_SANITIZE_STRING), filter_var($data['email'], FILTER_SANITIZE_STRING)));
        if(Mail::failures() != 0) 
        {
            $mensaje1 = trans('multi-leng.formerror18');
        }   
        else
        {
            $mensaje1 = trans('multi-leng.formerror19');
        }    
        return $user;
    }
}
