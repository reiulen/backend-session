<?php

namespace App\Http\Controllers;

use Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class UploadController extends Controller
{

    public function index()
    {
        $title = 'Coba';
        File::delete('upload/content/content_20220107105601.jpg');
        return view('backend.cobakirim', compact('title'));
    }

    public function upload(Request $request)
    {
        if($request->hasFile('file')){

            $destination = 'upload/content';

            if(!File::isDirectory($destination)) {
                File::makeDirectory($destination, 0755, true, true);
            }

            $file = $request->file('file');
            $rename = 'content_' . date('YmdHis');
            $image = Image::make($file);

            $image->save($destination . '/' . $rename . '.' . $file->getClientOriginalExtension());

            return response()->json([
                'imageUrl' => asset($destination . '/' . $rename . '.' . $file->getClientOriginalExtension())
            ]);
        }
    }

    public function delete(Request $request)
    {  
        $filename = str_replace(url('') . '/', "", $request->src);
        File::delete($filename);
    }
}
