<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use App\Categoryblog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class CategoryBlogController extends Controller
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
        abort_if(Gate::denies('category_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $categories = Categoryblog::paginate();

        return view('blog.categories.index', compact('categories'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function vercatblog()
    {
        //abort_if(Gate::denies('category_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $categories = Categoryblog::get();
        return view('blog.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function agrcatblog()
    {
        //abort_if(Gate::denies('category_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('blog.categories.create');
    }
    public function valnomcat(Request $request)
    {
        $val = 1;
        $category = Categoryblog::select()->where('title', $request->name)->count();
        if($category > 0)
        {
            $val = 2;
        }
        return response()->json(['val' => $val]);
    }

    public function ingcatadm(Request $request)
    {
        $namecatSanitize = filter_var($request->namecat, FILTER_SANITIZE_STRING);
        
        $dataClient = new Categoryblog;
        $dataClient->title    = $namecatSanitize;
        $dataClient->save();
        
        return redirect()->route('ver-categorias-blog')->with('success', trans('multi-leng.textingfolder'));
    }

    public function editcatadm(Request $request)
    {
        $namecatSanitize = filter_var($request->namecat, FILTER_SANITIZE_STRING);
        $post = Categoryblog::firstOrNew(['id' => $request->idcat]); 
        $post->title = $namecatSanitize;
        $post->save();
        return redirect()->route('ver-categorias-blog')->with('success', trans('multi-leng.texteditcarpeta'));
    }

    public function elitcatadm(Request $request)
    {
        $namecatSanitize = filter_var($request->namecat, FILTER_SANITIZE_STRING);
        $model = DB::table('posts')->where(['category_id' => $request->idcat, 'is_published' => 1])->count();
        if($model > 0)
        {
            return redirect()->route('ver-categorias-blog')->with('danger', trans('multi-leng.formerror67'));
        }
        else
        {
            $model = DB::table('posts')->where(['category_id' => $request->idcat])->forceDelete();
            $model = DB::table('post_tag')->where(['post_id' => $request->idcat])->forceDelete();
            $model = DB::table('commentsblog')->where(['post_id' => $request->idcat])->forceDelete();
            return redirect()->route('ver-categorias-blog')->with('success', trans('multi-leng.formerror64'));
        }
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(Gate::denies('category_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        abort_if(Gate::denies('category_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $this->validate($request,[
            'title' => 'required'
        ]);

        $category = new Category();
        $category->title = $request->title;

        $category->save();

        return redirect()->back()->with('message','Category Successfully saved');
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
     * @param Category $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        abort_if(Gate::denies('category_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        abort_if(Gate::denies('category_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $this->validate($request,[
            'title' =>'required'
        ]);

        $category = Category::find($id);
        $category->title = $request->title;

        $category->save();

        return redirect()->back()->with('message','Category Successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Category $category
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Category $category)
    {
        abort_if(Gate::denies('category_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if (!DB::table('posts')->where('category_id', $category->id)->exists()){
            $category->delete();
            return redirect()->back()->with('message', 'Category deleted successfully.');
        }

        return redirect()->back()->with('error', "Category is used on post, you can't delete it!");
    }
}