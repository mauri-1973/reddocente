<?php



namespace App\Http\Controllers\Users;



use App\Http\Controllers\Controller;

use App\Http\Requests\StorePostRequest;

use App\Http\Requests\UpdatePostRequest;

use App\Categoryblog;

use App\Post;

use App\Tagblog;

use App\PostTag;

use App\Commentblog;

use App\TagUsers;

use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use Intervention\Image\Facades\Image as Image;

use Symfony\Component\HttpFoundation\Response;

use Illuminate\Http\JsonResponse;

use File;

use Crypt;



class TagsUsersController extends Controller

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
    public function valnomtagusu(Request $request)

    {

        $val = 1;

        $namecatSanitize = filter_var($request->name, FILTER_SANITIZE_STRING);

        $namecatSanitize = eliminar_tildes($namecatSanitize);

        $category = TagUsers::select('*')->where(['tagnom' => $namecatSanitize, 'tagidus' => Auth::user()->id])->count();

        if($category > 0)

        {

            $val = 2;

        }

        return response()->json(['val' => $val]);

    }
    
    

}