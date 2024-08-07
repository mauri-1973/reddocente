<?php

namespace App\Http\Controllers\Blog;

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

class PostController extends Controller
{
    /**
    *
    * allow blog only
    *
    */
    public function __construct() {
        //$this->middleware(['role:admin|creator']);
        $this->middleware(['role:blog']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_if(Gate::denies('post_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        //$posts = (new \App\Post)->getDashboardPosts()->with('categoriesblog','user')->get();
        $post = Post::join('categoriesblog as p', 'p.category_id', '=', 'categoriesblog.id_cat')
        ->where('p.is_published', 1)
        ->get(['categoriesblog.*']);
        return view('blog.posts.index', compact('posts'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexnew()
    {
        $posts = Post::join('categoriesblog as cp', 'posts.category_id', '=', 'cp.id')
        ->join('users as u', 'u.id', '=', 'posts.created_by')
        ->where('posts.is_published', 1)
        ->get(['posts.*', 'cp.title as titlecat', 'u.name as nameus', 'u.surname as surnameus']);
        return view('blog.posts.index', compact('posts'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function creteposts()
    {
        $categories = Categoryblog::all();
        $tags = Tagblog::pluck('title', 'title')->all();
        return view('blog.posts.create', compact('categories', 'tags'), ["numtags" => count($tags)]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storepost(Request $request)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:70'],
            'subcat' => ['required'],
            'summernote' => ['required', 'string']
        ]);
        $fileName = "ust3.png";
        if ($request->hasFile('thumbnail'))
        {
            $request->validate([
                'thumbnail' => 'image|mimes:jpg,png,jpeg|max:9000|dimensions:min_width=600,min_height=400,max_width=600,max_height=400'
            ]);
            $destinationPath = storage_path('app/public/blog/imagenes');

            if (file_exists(storage_path('app/public/blog/imagenes'))) 
            {
                @chmod(storage_path('app/public/blog/imagenes'), 0777);
            }

            $thumbnail = $request->file('thumbnail');

            $fileName = time().'.'. $thumbnail->getClientOriginalExtension();

            Image::make($thumbnail)->resize(600, 400, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath.'/'.$fileName);
        }

        $post = new Post();
        $post->title = $request->title;
        $post->category_id = (int)$request->subcat[0];
        $post->body = $request->summernote;
        $post->thumbnail = $fileName;
        $post->is_published = 1;

        if ($post->save())
        { 
            if ($request->has('tags')) 
            {
                foreach($request->tags as $row => $slice)
                {
                    $dataClient = new PostTag;
                    $dataClient->post_id    = $post->id;
                    $dataClient->tag_id   = (int)$request->tags[$row];
                    $dataClient->save();
                }
            }

            return redirect()->route('ver-publicaciones-blog')->with('success', trans('multi-leng.formerror44'));
        }

        return redirect()->route('ver-publicaciones-blog')->with('danger', trans('multi-leng.formerror45'));
    }
    public function verpubcom($id = null)
    {
        Post::where('id', $id)
        ->update([
          'read_count'=> DB::raw('read_count+1'), 
        ]);
        $post = Categoryblog::join('posts as p', 'p.category_id', '=', 'categoriesblog.id')
        ->join('users as u', 'u.id', '=', 'p.created_by')
        ->where('p.is_published', 1)
        ->where("p.id", $id)
        ->first(['p.*', 'categoriesblog.title as titlecat', 'u.name as nameus', 'u.surname as surnameus']);
        $tags = PostTag::join('tagsblog as tag', 'tag.id', '=', 'post_tag.tag_id')
        ->where("post_tag.post_id", $id)
        ->get(['tag.title']);
        $comments = Commentblog::join('users as u', 'u.id', '=', 'commentsblog.user_id')
        ->where('commentsblog.post_id', $id)
        ->get(['commentsblog.*', 'u.name as nameus', 'u.surname as surnameus']);
        return view('postusers.post', compact('post', 'tags', 'comments'));
    }

    public function eliminarpost(Request $request)
    {
        Post::where('id', $request->idpost)->forceDelete();
        Commentblog::where('post_id', $request->idpost)->forceDelete();
        PostTag::where('post_id', $request->idpost)->forceDelete();
        return redirect()->route('ver-publicaciones-blog')->with('danger', __('multi-leng.formerror55'));
    }
    public function ediatrpost($id = null)
    {
        $id = Crypt::decrypt($id);
        $post = Categoryblog::join('posts as p', 'p.category_id', '=', 'categoriesblog.id')
        ->join('users as u', 'u.id', '=', 'p.created_by')
        ->where("p.id", $id)
        ->first(['p.*', 'categoriesblog.title as titlecat', 'u.name as nameus', 'u.surname as surnameus']);
        $catall = Categoryblog::all();

        $arreglo = array();

        $tagsselect = PostTag::join('tagsblog as tag', 'tag.id', '=', 'post_tag.tag_id')
        ->where("post_tag.post_id", $id)
        ->get(['tag.title', 'tag.id']);

        foreach($tagsselect as $row)
        {
            array_push($arreglo, array('title' => $row->title, 'id' => $row->id, 'tipo' => 'selected'));
        }
        
        
        $tags = Tagblog::select('tagsblog.title', 'tagsblog.id')
        ->whereNotIn('id', PostTag::join('tagsblog as tag', 'tag.id', '=', 'post_tag.tag_id')
        ->where("post_tag.post_id", $id)
        ->get(['post_tag.tag_id'])->toArray())
        ->get();
        foreach($tags as $row)
        {
            array_push($arreglo, array('title' => $row->title, 'id' => $row->id, 'tipo' => ''));
        }
        
        return view('blog.posts.edit', compact('post', 'tagsselect', 'tags', 'catall', 'arreglo'), ["numtags" => count($tags)]);
    }
    public function finedipubblo(Request $request)
    {
        $id = Crypt::decrypt($request->idpost);
        $request->validate([
            'title' => ['required', 'string', 'max:70'],
            'subcat' => ['required'],
            'summernote' => ['required', 'string']
        ]);
        if ($request->hasFile('thumbnail'))
        {
            $request->validate([
                'thumbnail' => 'image|mimes:jpg,png,jpeg|max:9000|dimensions:min_width=600,min_height=400,max_width=600,max_height=400'
            ]);
            $destinationPath = storage_path('app/public/blog/imagenes');

            if (file_exists(storage_path('app/public/blog/imagenes'))) 
            {
                @chmod(storage_path('app/public/blog/imagenes'), 0777);
            }

            $thumbnail = $request->file('thumbnail');

            $fileName = time().'.'. $thumbnail->getClientOriginalExtension();

            Image::make($thumbnail)->resize(600, 400, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath.'/'.$fileName);
            $post = Post::firstOrNew(['id' => $id]); 
            $post->title = $request->title;
            $post->category_id = (int)$request->subcat[0];
            $post->body = $request->summernote;
            $post->thumbnail = $fileName;
        }
        else
        {
            $post = Post::firstOrNew(['id' => $id]); 
            $post->title = $request->title;
            $post->category_id = (int)$request->subcat[0];
            $post->body = $request->summernote;
        }

        if ($post->save())
        { 
            
            PostTag::where("post_id", $id)->forceDelete();
            if ($request->has('tags')) 
            {
                foreach($request->tags as $row => $slice)
                {
                    $dataClient = new PostTag;
                    $dataClient->post_id    = $id;
                    $dataClient->tag_id   = (int)$request->tags[$row];
                    $dataClient->save();
                }
            }
            return redirect()->route('ver-publicaciones-blog')->with('success', trans('multi-leng.formerror56'));
        }

        return redirect()->route('ver-publicaciones-blog')->with('danger', trans('multi-leng.formerror57'));
    }

    public function uplposblogresp(Request $request)
    {
        if($request->hasFile('upload')) {
            //get filename with extension
            $filenamewithextension = $request->file('upload')->getClientOriginalName();
     
            //get filename without extension
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
     
            //get file extension
            $extension = $request->file('upload')->getClientOriginalExtension();
     
            //filename to store
            $filenametostore = $filename.'_'.time().'.'.$extension;
     
            //Upload File
            $request->file('upload')->storeAs('public/ckeditor/ckeditornormal', $filenametostore);
            $request->file('upload')->storeAs('public/ckeditor/ckeditorchicas', $filenametostore);
    
            //Resize image here
            $thumbnailpath = public_path('storage/ckeditor/ckeditorchicas/'.$filenametostore);
            $img = Image::make($thumbnailpath)->resize(500, 150, function($constraint) {
                $constraint->aspectRatio();
            });
            $img->save($thumbnailpath);
    
            echo json_encode([
                'default' => asset('storage/ckeditor/ckeditornormal/'.$filenametostore),
                '500' => asset('storage/ckeditor/ckeditorchicas/'.$filenametostore)
            ]);
        }
    }
    public function uplposblog(Request $request)
    {
        if ($request->hasFile('upload')) {

            if ($request->file('upload')->isValid ()) {
         
             $fileName=$request->file('upload')->getClientOriginalName();
 
           $uploaded_url=$this->upload_any_file_and_convert_image_to_webp($request->file('upload'),'resize',1000,null);
 
       
  
         ////
   
             return response()->json(['fileName' => $fileName, 'uploaded'=> 1, 'url' => $uploaded_url]);
 
           }else{
             return response()->json(['fileName' => '', 'uploaded'=> 0, 'url' => '']);
 
           }
 
        }
    }
    function upload_any_file_and_convert_image_to_webp($file, $mode = '', $width = '', $height = ''){
       
        $fileName=$file->getClientOriginalName();
        $fileName =rand(11111111,99999999)."_".time()."_".$fileName;
        $fileName=str_replace(' ','-',$fileName);
       
        $folder='storage/ckeditor/ckeditorchicas';
        $path = public_path('storage/ckeditor/ckeditorchicas/');
       
 
        $file_url = $path.'/'.$fileName;
 
        /////to convert non gif images to webp///////////////////
        $image = $file;
        $filename_without_extension = pathinfo($fileName, PATHINFO_FILENAME);
        //dd($filename_without_extension);
        if(substr($image->getMimeType(), 0, 5) == 'image') 
        {  
         
            if($image->getMimeType() != 'image/gif')
            {
    
                $fileName = $filename_without_extension.'.webp';          
                $file_url = $path.'/'.$fileName;
                if($mode == 'resize')
                {
                    Image::make($image)->resize($width,$height, function ($constraint) {
                        $constraint->aspectRatio();
                        $constraint->upsize();
                    })->encode('webp', 90)->save($file_url);
    
                }
                else if($mode == 'fit')
                {
                    Image::make($image)->fit($width,$height)->encode('webp', 90)->save($file_url);
                }
                else
                {
                    Image::make($image)->encode('webp', 90)->save($file_url);
                }
    
                    //
            }
            else
            {
                $file->move($path, $fileName);
            }
         
        }
        else
        {
            $file->move($path, $fileName);
 
        }   
 
        $uploaded_url = url($folder).'/'.$fileName;
 
        return $uploaded_url;
    }
    














    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(Gate::denies('post_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $categories = Category::all();
        $tags = Tag::pluck('title', 'title')->all();

        return view('admin.posts.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {
        abort_if(Gate::denies('post_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->hasFile('thumbnail')){
            $thumbnail = $request->file('thumbnail');
            $fileName = time().'.'. $thumbnail->getClientOriginalExtension();
            Image::make($thumbnail)->save(public_path('uploads/posts/'. $fileName));
        }

        $post = new Post();
        $post->title = $request->title;
        $post->category_id = $request->category;
        $post->body = $request->body;
        $post->thumbnail = $fileName;
        $post->is_published = 1;

       if ($post->save()){
           $tagsId = collect($request->tags)->map(function ($tag) {
               return Tag::firstOrCreate(['title' => $tag])->id;
           });

           $post->tags()->attach($tagsId);

           return redirect()->route('admin.posts.index')->with('message','Post successfully saved');
       }

       return redirect()->back()->with('message','Whoops! something went wrong!');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        abort_if(Gate::denies('post_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $post->load('tags');
        $categories = Category::all();
        $tags = Tag::pluck('title', 'title')->all();

        return view('admin.posts.edit', compact('post','categories', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        abort_if(Gate::denies('post_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->hasFile('thumbnail')){
            $thumbnail = $request->file('thumbnail');
            $fileName = time().'.'. $thumbnail->getClientOriginalExtension();
            Image::make($thumbnail)->save(public_path('uploads/posts/'. $fileName));
        }

        $post->title = $request->title;
        $post->category_id = $request->category;
        $post->body = $request->description;
        $post->thumbnail = $fileName ?? $post->thumbnail;

        if ($post->save()){
            $tagsId = collect($request->tags)->map(function ($tag) {
                return Tag::firstOrCreate(['title' => $tag])->id;
            });

            $post->tags()->sync($tagsId);

            return redirect()->back()->with('message','Post updated successfully');
        }
        return redirect()->back()->with('error','Whoops!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        abort_if(Gate::denies('post_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $post = Post::findOrFail($id);

        if ($post->delete()){
            return redirect()->back()->with('message','Post deleted successfully');
        }
        return redirect()->back()->with('message','Whoops!!');
    }

    public function publish(Post $post)
    {
        $post->is_published = ! $post->is_published;
        $post->save();

        return redirect()->back()->with('message','Post changed successfully.');
    }
}