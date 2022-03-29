<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Project';
        $project = Project::latest()->filter(request(['search']))->paginate(10);

        return view('backend.project.project', compact('title', 'project'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Tambah Project';
        return view('backend.project.tambah', compact('title'));
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
            'thumbnail' => 'required|file|image|max:2024',
            'judul' => 'required',
            'deskripsi' => 'required'
        ], $message);

        Project::create([
            'judul' => $request->judul,
            'thumbnail' => $request->file('thumbnail')->store('upload/project'),
            'deskripsi' => $request->deskripsi,
            'link' => $request->link,
        ]);

        return redirect('/project')->with(['alert' => 'success',
                                       'pesan' => 'Project berhasil ditambahkan'                     
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
        $title = 'Edit Project';
        $project = Project::findorfail($id);
        return view('backend.project.edit', compact('title', 'project'));
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
            'thumbnail' => 'file|image|max:2024',
            'judul' => 'required',
            'deskripsi' => 'required'
        ], $message);

        $project = Project::findorFail($id);

        $thumbnail = $project->thumbnail;

        if($request->thumbnail){
            $thumbnail = $request->file('thumbnail')->store('upload/project');
            Storage::delete($project->thumbnail);
        }

        $project->update([
            'judul' => $request->judul,
            'thumbnail' => $thumbnail,
            'deskripsi' => $request->deskripsi,
            'link' => $request->link,
        ]);

        return redirect('/project')->with(['alert' => 'success',
                                       'pesan' => 'Project berhasil diedit'                     
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
        $project = Project::findorFail($id);
        Storage::delete($project->thumbnail);
        $project->delete($id);
        return redirect('/project')->with(['alert' => 'success',
                                           'pesan' => 'Project berhasil dihapus'                     
                                         ]);
    }
}
