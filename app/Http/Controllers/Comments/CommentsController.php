<?php



namespace App\Http\Controllers\Comments;



use App\Http\Controllers\Controller;

use App\Http\Requests\StorePostRequest;

use App\Http\Requests\UpdatePostRequest;

use App\Categoryblog;

use App\Post;

use App\Tagblog;

use App\PostTag;

use App\Commentblog;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use Intervention\Image\Facades\Image as Image;

use Symfony\Component\HttpFoundation\Response;

use Crypt;

class CommentsController extends Controller

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

    public function ingcomusureg(Request $request)

    {
        
        $request->validate([

            'idpost' => ['required'],

            'comment' => ['required', 'string', 'min:10']

        ]);

        $dataClient = new Commentblog;

        $dataClient->user_id    = Auth::user()->id;

        $dataClient->post_id = $request->idpost;

        $dataClient->body = $request->comment;

        $dataClient->save();

        if(Auth::user()->hasRole('admin'))

        {
            return redirect()->route('ver-publicacion-completa-usuario', [Crypt::encrypt($request->idpost)])->with('success', trans('multi-leng.formerror53'));

        }

        if(Auth::user()->hasRole('docente'))

        {
            return redirect()->route('ver-publicacion-completa-usuario', [Crypt::encrypt($request->idpost)])->with('success', trans('multi-leng.formerror53'));

        }

        if(Auth::user()->hasRole('blog'))

        {

            return redirect()->route('ver-publicacion-completa-usuario', [Crypt::encrypt($request->idpost)])->with('success', trans('multi-leng.formerror53'));

        }

        if(Auth::user()->hasRole('user'))

        {

            return redirect()->route('ver-publicacion-completa-usuario', [Crypt::encrypt($request->idpost)])->with('success', trans('multi-leng.formerror53'));    

        }

        else

        {

            return view('errors.403');

        }

        

    }

    public function elicomusureg(Request $request)

    {

        $request->validate([

            'idcom' => ['required'],

            'idpost' => ['required']

        ]);

        Commentblog::where("id", $request->idcom)->delete();

        return redirect()->route('ver-publicacion-completa-usuario', [Crypt::encrypt($request->idpost)])->with('success', trans('multi-leng.formerror53'));

    }

}