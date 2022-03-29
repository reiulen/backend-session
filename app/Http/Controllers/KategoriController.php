<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Kategori';
        $kategori = Kategori::latest()->filter(request(['q']))->paginate(10)->withQueryString();
        $post = Post::get();
        return view('backend.post.kategori', compact('title', 'kategori',  'post'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'required' => 'Kategori tidak boleh kosong!',
            'unique' => 'Kategori sudah ada!'
        ];

        $request->validate([
            'kategori' => 'required|unique:kategoris'
        ], $message);

        Kategori::create([
            'kategori' => $request->kategori,
            'slug' => strtolower(str_replace(' ', '-', $request->kategori)),
        ]);

        return redirect('/kategori')->with(['alert' => 'success',
                                            'pesan' => 'Kategori berhasil diedit'                     
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
        //
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
            'required' => 'Kategori tidak boleh kosong!',
            'unique' => 'Kategori sudah ada!'
        ];

        $request->validate([
            'kategori' => 'required|unique:kategoris,kategori,'.$id,
        ], $message);

        Kategori::findorFail($id)->update([
            'kategori' => $request->kategori,
            'slug' => strtolower(str_replace(' ', '-', $request->kategori))
        ]);

        return redirect('/kategori')->with(['alert' => 'success',
                                            'pesan' => 'Kategori berhasil diedit'                     
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
        Kategori::findorFail($id)->delete($id);
        return redirect('/kategori')->with(['alert' => 'success',
                                            'pesan' => 'Kategori berhasil dihapus'                     
                                            ]);
    }
}
