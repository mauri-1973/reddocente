<?php



namespace App\Http\Controllers\Blog;



use App\Http\Controllers\Controller;

use App\Categoryblog;

use App\Tagblog;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Gate;

use Symfony\Component\HttpFoundation\Response;



class TagsBlogController extends Controller

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

    public function vertagsblog()

    {

        //abort_if(Gate::denies('category_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');



        $tags = Tagblog::get();

        return view('blog.tags.index', compact('tags'));

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

    public function valnomtag(Request $request)

    {

        $val = 1;

        $tags = Tagblog::select()->where('title', $request->name)->count();

        if($tags > 0)

        {

            $val = 2;

        }

        return response()->json(['val' => $val]);

    }



    public function ingtagadm(Request $request)

    {

        $namecatSanitize = filter_var($request->namecat, FILTER_SANITIZE_STRING);

        

        $dataClient = new Tagblog;

        $dataClient->title    = $namecatSanitize;

        $dataClient->save();

        

        return redirect()->route('ver-tags-blog')->with('success', trans('multi-leng.a6'));

    }



    public function edittagadm(Request $request)

    {

        $namecatSanitize = filter_var($request->namecat, FILTER_SANITIZE_STRING);

        $post = Tagblog::firstOrNew(['id' => $request->idcat]); 

        $post->title = $namecatSanitize;

        $post->save();

        return redirect()->route('ver-tags-blog')->with('success', trans('multi-leng.a7'));

    }



    public function elimtagadm(Request $request)

    {

        $namecatSanitize = filter_var($request->namecat, FILTER_SANITIZE_STRING);

        $model = DB::table('posts')->join('post_tag as po', 'posts.id', '=', 'po.post_id')->where(['po.tag_id' => $request->idcat])->count();

        if($model > 0)

        {

            return redirect()->route('ver-tags-blog')->with('danger', trans('multi-leng.formerror64'));

        }

        else

        {

            $model = DB::table('post_tag')->where(['tag_id' => $request->idcat])->count();

            if($model > 0)
            {
                $model = DB::table('post_tag')->where(['tag_id' => $request->idcat])->forceDelete();
            }

            $model = Tagblog::where(['id' => $request->idcat])->forceDelete();

            return redirect()->route('agregar-nuevos-tags-administrador')->with('success', trans('multi-leng.a8'));

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