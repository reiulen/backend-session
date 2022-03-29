<?php

namespace App\Http\Controllers\api;

use App\Models\Post;
use App\Models\User;
use App\Models\Gallery;
use App\Models\Project;
use App\Models\Kategori;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DataPostController extends Controller
{
    public function post()
    {
        $post = Post::with(['kategori', 'user'])->where(['status' => 'Publish'])->latest()->get();

        if(request('q') == 'first'){
            $post = Post::with(['kategori', 'user'])->where(['status' => 'Publish'])->latest()->get();
        }

        if(request('q') == 'all'){
            $post = Post::with(['kategori', 'user'])->where(['status' => 'Publish'])->where('id', '!=', [Post::max('id')])->latest()->get();
        }

        if(request('slug')){
            $post = Post::where(['slug' => request('slug')])->with(['user', 'kategori'])->get();
            $s = Post::where(['slug' => request('slug')])->first();
            if($s){
                Post::find($s->id)->update([
                    'views' => $s->views + 1,
                ]);
            }
        }

        if(request('kategori')){
            $kategori = Kategori::where('slug', request('kategori'))->first();
            if(!$kategori){
                $k = [];
                return $post = $k;
            }
            $post = Post::where(['status' => 'Publish', 'kategori_id' => $kategori->id])->with(['user', 'kategori'])->latest()->get();
        }

        if(request('author')){
            $user = User::where('nama', request('author'))->first();
            if(!$user){
                $k = [];
                return $post = $k;
            }
            $post = Post::where(['status' => 'Publish', 'user_id' => $user->id])->with(['user', 'kategori'])->latest()->get();
        }

        if(request('q') == 'rekomendasi'){
            $post = Post::with(['kategori', 'user'])->where(['status'=> 'publish'])->limit('4')->latest()->get();
        }

         if(request('q') == 'populer'){
            $post = Post::with(['kategori', 'user'])->orderByDesc('views')->limit(request('limit'))->get();
        }

        if(request('search')){
            $post = Post::with(['user', 'kategori'])->filter(request(['search']))->get();
        }
        

        return response()->json($post);;
    }
    public function kategori()
    {
        $kategori = Kategori::latest()->get();
        return $kategori;
    }

    public function project()
    {
        $project = Project::latest()->get();
        return response()->json($project);
    }

    public function gallery()
    {
        $gallery = Gallery::with(['gambar'])->latest()->get();
        if(request('slug')){
            $gallery = Gallery::where(['slug' => request('slug')])->with(['gambar'])->get();
        }
        if(request('limit')){
            $gallery = Gallery::with(['gambar'])->limit(request('limit'))->latest()->get();
        }
        return response()->json($gallery);
    }
}
