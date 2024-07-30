<?php

use App\User;

use App\Category;

use App\Subcategory;

use App\Resource;



use Spatie\Permission\Models\Role;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Gate;

use App\Http\Controllers\Controller;

use Illuminate\Validation\Rule;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Storage;

use Intervention\Image\Facades\Image as Image;

if (! function_exists('createavatar')) {

    function createavatar($file, $id) 

    {

        $tmp = explode('.', $file->getClientOriginalName());//get client file name

        $name = $file->getClientOriginalName();

        $newImageName = date('YdmHis').'.png';

        if (file_exists(storage_path('app/public/profile-pic'))) 

        {

            @chmod(storage_path('app/public/profile-pic'), 0777);

        }

        

        $destinationPath = storage_path('app/public/profile-pic');



        $img = Image::make($file->path());

        if (file_exists($destinationPath)) 

        {

            $img->resize(400, 400, function ($constraint) {

                $constraint->aspectRatio();

            })->save($destinationPath.'/'.$newImageName);

        }

        User::where('id', $id)->update(['avatar' => $newImageName]);

        return $newImageName;

    }

}
if (! function_exists('eliminar_tildes')) {

    function eliminar_tildes($cadena) 
    {
        $cadena = str_replace(" ", "-", $cadena);
        setlocale(LC_ALL, "en_US.utf8");
        $cadena = iconv("utf-8", "ascii//TRANSLIT", $cadena);

        $cadena = preg_replace("/[^a-zA-Z0-9\_\-]+/", "", $cadena);

        return utf8_encode($cadena);

    }

}


?>