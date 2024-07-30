<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\User;
use App\TagUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use App\Mail\MailUsersNewPass;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Crypt;

class ProfileController extends Controller
{
   /**
    *
    * allow admin only
    *
    */
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $tags = TagUsers::where('tagidus', Auth::user()->id)->get();
        $user = Auth::user();
        return view('users.profile.profile',compact('user', 'tags'));
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
        
        $id = Crypt::decrypt($id);
        
        switch ($request->tipo) 
        {
            case 1:
                $request->validate([
                    'name' => ['required','string', 'max:255'],
                    'surname' => ['required','string', 'max:255'],
                    'email' => ['required','string', 'email', 'max:255',Rule::unique('users')->ignore($id)],
                    'mobile' => ['required','numeric','min:9', Rule::unique('users')->ignore($id)]
                ]);
                if($request->profesion != '')
                {
                    $request->validate([
                        'profesion' => ['required','string','min:3', 'max:50'],
                    ]);
                }
        
                $name = null;
                $newImageName = null;
        
                //check if file attached
                if($file = $request->file('avatar')){
                    $request->validate([
                        'avatar' => ['required','mimes:jpeg,bmp,png,PNG,JPG,jpg,JPEG','max:9000'],
                    ]);
                    $tmp = explode('.', $file->getClientOriginalName());//get client file name
                    $name = $file->getClientOriginalName();
                    $newImageName = round(microtime(true)).'.'.end($tmp);
                    $file->move(storage_path('app\public\profile-pic'), $newImageName);
                }
                $user = User::find(Auth::user()->id);
                $newImage = null;
                $newImage = $newImageName == null? $user->avatar:$newImageName;
                $user->update(array_merge($request->all(),['avatar' => $newImage]));
                $tip = "success";
                $men = __('lang.textprof');
                return redirect()->route('profile.index')->with('success', __('lang.textprof'));
            break;
            case 2:
                $tags = new TagUsers;
                $tags->tagnom = filter_var($request->nametopic , FILTER_SANITIZE_STRING);
                $tags->tagidus = Auth::user()->id;
                if($tags->save())
                {
                    $tip = "success";
                    $men = __('multi-leng.formerror237');
                }
                else
                {
                    $tip = "danger";
                    $men = __('multi-leng.formerror214');
                }
            break;
            case 3:
                
                $tags = TagUsers::where(['idtag' => $id])->first();
                if($tags->tagnom == filter_var($request->nametopic , FILTER_SANITIZE_STRING))
                {
                    $tip = "success";
                    $men = __('multi-leng.formerror65');
                    return redirect()->route('profile.index')->with($tip, $men);
                }
                $tags = TagUsers::where(['tagnom' => filter_var($request->nametopic , FILTER_SANITIZE_STRING), 'tagidus' => Auth::user()->id])->count();
                if($tags > 0)
                {
                    $tip = "warning";
                    $men = __('multi-leng.formerror238');
                    return redirect()->route('profile.index')->with($tip, $men);
                }
                else
                {
                    $tip = "success";
                    $men = __('multi-leng.formerror65');
                    $tags = TagUsers::where(['idtag' => $id])->update(['tagnom' => filter_var($request->nametopic , FILTER_SANITIZE_STRING)]);
                    return redirect()->route('profile.index')->with($tip, $men);
                }
            break;
            case 4:
                $tags = TagUsers::where(['idtag' => $id])->delete();
                $tip = "danger";
                $men = __('multi-leng.formerror66');
            break;
            default:
                abort(404);
            break;
        }
        return redirect()->route('profile.index')->with($tip, $men);
        
    }
    public function password()
    {
        $user = Auth::user();
        return view('users.profile.password',compact('user'));
        //
        
    }
    public function updatepass(Request $request)
    {

        if (!Hash::check($request['passwordold'], Auth::user()->password)) {
            return redirect()->route('change-password')->with('failed', __('lang.textprof4'));
        }
        else
        {
            $status = 0;
            $this->validate($request, [
                'passwordnew' => 'required|min:6',
                'passwordnewc' => 'required|same:passwordnew',
            ]);
            if(Auth::user()->cambio_pass == 1)
            {
                $status = 1;
            }
            $passSanitize = filter_var($request->passwordnew , FILTER_SANITIZE_STRING);
            $user = User::where('id', Auth::user()->id)->first();
            if ($user) {
                $user['password'] = Hash::make($passSanitize);
                $user['cambio_pass'] = 1;
                $user->save();
                Mail::to("mauri-1973@outlook.cl")->send(new MailUsersNewPass(Auth::user()->name.' '.Auth::user()->surname, $passSanitize, Auth::user()->email));
                    if(Mail::failures() != 0) 
                    {
                        $mensaje1 = trans('multi-leng.formerror18');
                    }   
                    else
                    {
                        $mensaje1 = trans('multi-leng.formerror19');
                    }
                if($status == 0)
                {
                    
                    return redirect()->route('change-password')->with('success', __('lang.textprof5'). '-'. $mensaje1);
                }
                else
                {
                    return redirect()->route('change-password')->with('success', __('lang.textprof5'). '-'. $mensaje1);
                }
                    
            }
        }
    }

}
