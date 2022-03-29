<?php

namespace App\Http\Controllers;

use App\Models\Gambar;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Gallery';
        $gallery = Gallery::with(['gambar'])->filter(request(['search']))->latest()->paginate(10)->withQueryString();
        return view('backend.gallery.gallery', compact('title', 'gallery'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Tambah Gallery';
        return view('backend.gallery.tambah', compact('title'));
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
            'filename' => 'required',
            'filename.*' => 'max:2500|image|file'
        ], $message);

        Gallery::create([
            'judul' => $request->judul,
            'slug' => Gallery::max('id')+1 .'-'.strtolower(str_replace(' ', '-', $request->judul)),
        ]);


        if($request->hasfile('filename'))
        {
            foreach($request->file('filename') as $image)
            {
                Gambar::create([
                                'filename' => $image->store('upload/gallery'),
                                'gallery_id' => Gallery::latest()->first()->id,
                                ]);
  
            }
        }
        return redirect('/gallery')->with(['alert' => 'success',
                                            'pesan' => 'Gallery berhasil ditambahkan'                     
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $gallery = Gallery::find($id);
        $gambar = Gambar::where(['gallery_id' => $gallery->id]);
        foreach($gallery->gambar as $row)
        {
            Storage::delete($row->filename);
            $gambar->delete($row->id);
        }
        $gallery->delete($id);
        return redirect('/gallery')->with(['alert' => 'success',
                                            'pesan' => 'Gallery berhasil dihapus'                     
                                            ]);
    }
}
