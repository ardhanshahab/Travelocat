<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Image;

class imageController extends Controller
{
    public function upload($file, $user, $folder)
    {
        $imageName = time().'.'.$file->getClientOriginalExtension();
        $file->move(public_path($folder), $imageName);
        $image = new Image;
        $image->user_id = $user;
        $image->url = $folder.'/'.$imageName;
        $image->save();

        return $image;
    }
}
