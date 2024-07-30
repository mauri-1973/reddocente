<?php

namespace App\Http\Controllers\Statistics;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
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
use File;
use Crypt;

class StatisticsController extends Controller
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
    public function estgensegusu(Request $request)
    {
        if($request->tipo == "panelbloginicio")
        {
            $arraycant = [];
            $arrayname = [];
            $arraycolor = [];
            $post = Post::where("read_count", '>', 0)->get();
            foreach($post as $row)
            {
                $arraycant[] = $row->read_count;
                $arrayname[] = "Post #".$row->id;
                $arraycolor[] = sprintf('#%06X', mt_rand(0, 0xFFFFFF));
            }
            return response()->json(['status' => 1, 'cant'=> $arraycant, 'name' => $arrayname, 'cant'=> $arraycant, 'color' => $arraycolor]);
        }
        
    }
}