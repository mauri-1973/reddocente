<?php



namespace App\Http\Controllers\Docs;


use App\Tracker;

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

use Session;


class DocumentsExtController extends Controller

{

   /**

    *

    * allow admin only

    *

    */


    public function visordocs($id = null)

    {
        $url = BookAdm::where("key", $id)->count(); 
        if($url > 0)
        {

            $url = BookAdm::where("key", $id)->first();
            
            return view('visorpdfext', ['url' => url('/').'/public/storage/DocAdm/'.$url->carpeta]);
        }
        else
        {
            abort(404);
        }
        

    }

    public function visordocsdoc($id = null)

    {
        $url = Book::where("keybook", $id)->count(); 
        if($url > 0)
        {

            $url = Book::where("keybook", $id)->first();

            $folder = Resource::where("id_rec", $url->resource_id)->first();
            
            return view('visorpdfext', ['url' => url('/').'/public/storage/'.$folder->folder.'/'.$url->name]);
        }
        else
        {
            abort(404);
        }
        

    }
    public function exit()
    {
        //number of user connected or viewed
        Tracker::firstOrCreate([
            'ip'   => $_SERVER['REMOTE_ADDR']],
            ['ip'   => $_SERVER['REMOTE_ADDR'],
            'current_date' => date('Y-m-d')])->save();

        return view('welcome');
    }

    public function lang($lang = null)
    {
        Session::put('language',$lang);
        return redirect()->back();
    }

}

