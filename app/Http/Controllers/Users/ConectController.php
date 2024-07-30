<?php



namespace App\Http\Controllers\Users;



use App\Http\Controllers\Controller;

use App\Http\Requests\StorePostRequest;

use App\Http\Requests\UpdatePostRequest;

use App\User;

use App\EmailContact;

use App\TagUsers;

use App\Categoryblog;

use App\Post;

use App\Tagblog;

use App\PostTag;

use App\Commentblog;

use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use Intervention\Image\Facades\Image as Image;

use Symfony\Component\HttpFoundation\Response;

use Illuminate\Http\JsonResponse;

use App\Mail\SendEmailContact;

use Illuminate\Support\Facades\Mail;


use File;

use Crypt;



class ConectController extends Controller

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
    public function conusureg()
    {
        $env = array();
        $array = User::where(['status_us' => 1, 'conectar' => 1])->get();
        foreach($array as $row)
        {
            $tagsus = array();
            $tag = TagUsers::where('tagidus', $row->id)->get();
            foreach($tag as $r)
            {
                array_push($tagsus, array('tagnom' => $r->tagnom, 'idtag' => $r->idtag));
            }
            array_push($env, array('idus' => $row->id, 'prof' => $row->profesion, 'nombre' => $row->name, 'apellidos' => $row->surname, 'email' => $row->email, 'movil' => $row->mobile, 'avatar' => $row->avatar, 'tags' =>  $tagsus));
        }

        return view('users.conectar', ["array" => $env]);
    }

    public function envemaconusureg(Request $request)
    {
        
        $user = User::where('id', Auth::user()->id)->first();
        $idhacia = Crypt::decrypt($request->idhacia);
        $email = new EmailContact;
        $email->iddesde =  Auth::user()->id;
        $email->idhacia =  $idhacia;
        $email->asunto =  $request->asunto;
        $email->mensaje =  $request->summernote;
        if($email->save())
        {
            $em = EmailContact::where('idemcon', $email->idemcon)->first();
            $data['nombredesde'] = $user->name.' '.$user->surname;
            $data['asunto'] = $request->asunto;
            $data['nombrehacia'] = $request->name;
            //Mail::to($request->email)->send(new SendEmailContact($request->name, $request->asunto, $request->summernote, $user->name.' '.$user->surname));
            Mail::to('mauri-1973@outlook.cl')->send(new SendEmailContact($request->name, $request->asunto, $em->mensaje, $user->name.' '.$user->surname));
            return redirect()->route('conectar-usuarios-registrado')->with('success', trans('multi-leng.formerror245'));
        }
        else
        {
            return redirect()->route('conectar-usuarios-registrado')->with('danger', trans('multi-leng.formerror246'));
        }
        
    }
    
    

}