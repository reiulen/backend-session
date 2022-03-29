<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Post';

        if(Auth::user()->role != 'admin'){
            $post = Post::with(['kategori', 'user'])->where(['user_id' => Auth::user()->id])->filter(request(['search']))->latest()->paginate(10)->withQueryString();
            if(request('status')){
                $post = Post::with(['kategori', 'user'])->where(['status' => request('status'), 'user_id' => Auth::user()->id])->filter(request(['search']))->latest()->paginate(10)->withQueryString();
            }
        }

        if(Auth::user()->role == 'admin'){
            $post = Post::with(['kategori', 'user'])->latest()->filter(request(['search']))->paginate(10)->withQueryString();
            if(request('status')){
                $post = Post::with(['kategori', 'user'])->where(['status' => request('status')])->filter(request(['search']))->latest()->paginate(10)->withQueryString();
            }
        }

        $jumlah = Post::get();

        return view('backend.post.post', compact('title', 'post', 'jumlah'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Tambah Post';
        $kategori = Kategori::all();
        return view('backend.post.tambahpost', compact('title', 'kategori'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $message = [
            'required' => 'tidak boleh kosong!',
            'unique' => 'sudah tersedia!',
            'image' => 'bukan sebuah gambar!',
            'file' => 'bukan sebuah gambar!',
            'max' => 'terlalu besar!'
        ];
        $request->validate([
            'thumbnail' => 'required|image|file|max:2024',
            'judul' => 'required',
            'content' => 'required',
            'kategori_id' => 'required',
            'status' => 'required'
        ], $message);

        Post::create([
            'user_id' => Auth::user()->id,
            'judul' => $request->judul,
            'slug' => Post::max('id')+1 .'-'. strtolower(str_replace(' ', '-', $request->judul)),
            'kategori_id' => $request->kategori_id,
            'thumbnail' => $request->file('thumbnail')->store('upload/thumbnail'),
            'tag' => $request->tag,
            'isi' => $request->content,
            'status' => $request->status
        ]);
        return redirect('post')->with(['alert' => 'success',
                                       'pesan' => 'Post berhasil ditambahkan'
                                      ]);
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
    public function edit($id)
    {
        $title = 'Edit Post';
        $post = Post::with(['kategori'])->findorFail($id);
        $kategori = Kategori::latest()->get();
        return view('backend.post.edit', compact('title', 'post', 'kategori'));
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
         $message = [
            'required' => 'tidak boleh kosong!',
            'unique' => 'sudah tersedia!',
            'image' => 'bukan sebuah gambar!',
            'file' => 'bukan sebuah gambar!',
            'max' => 'terlalu besar!'
        ];
        $request->validate([
            'thumbnail' => 'image|file|max:2024',
            'judul' => 'required',
            'content' => 'required',
            'kategori_id' => 'required',
            'status' => 'required'
        ], $message);

        $post = Post::findorFail($id);

        $thumbnail = $post->thumbnail;

        if($request->thumbnail){
            $thumbnail = $request->file('thumbnail')->store('upload/thumbnail');
            Storage::delete($post->thumbnail);
        }

        $post->update([
            'user_id' => Auth::user()->id,
            'judul' => $request->judul,
            'slug' => strtolower(str_replace(' ', '-', $request->judul)),
            'kategori_id' => $request->kategori_id,
            'thumbnail' => $thumbnail,
            'tag' => $request->tag,
            'isi' => $request->content,
        ]);
        return redirect('post')->with(['alert' => 'success',
                                       'pesan' => 'Post berhasil diedit'
                                      ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::findorFail($id);
        Storage::delete($post->thumbnail);
        $post->destroy($id);
        return back();
    }
}
