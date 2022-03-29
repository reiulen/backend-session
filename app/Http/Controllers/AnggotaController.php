<?php

namespace App\Http\Controllers;

use Image;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class AnggotaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Data Anggota';
        $anggota = User::with(['post'])->filter(request(['search']))->latest()->paginate(10)->withQueryString();
        if(request('role')){
             $anggota = User::with(['post'])->where(['role' => request('role')])->filter(request(['search']))->latest()->paginate(10)->withQueryString();
        }
        $jumlah = User::get();
        return view('backend.anggota.anggota', compact('title', 'anggota', 'jumlah'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Data Anggota';
        return view('backend.anggota.tambah', compact('title'));
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
            'max' => 'terlalu besar!',
            'same' => 'tidak sama!',
            'email' => 'tidak valid!',
        ];
        $request->validate([
            'avatar' => 'required|file|image|max:2024',
            'nis' => 'required|unique:users',
            'email' => 'required|unique:users|email:rfc,dns',
            'role' => 'required',
            'password1' => 'min:6|max:12|min:6|required_with:password2|same:password2',
            'password2' => 'min:6'
        ], $message);

        $destination = public_path('upload/avatar');

        if(!File::isDirectory($destination)) {
            File::makeDirectory($destination, 0755, true, true);
        }

        $file = $request->file('avatar');
        $rename = 'avatar_' . date('YmdHis');
        $image = Image::make($file);

        // Proses crop
        $image->fit(300, 300, function($constraint) {
            $constraint->aspectRatio();
        });

        $image->save($destination . '/' . $rename . '_300_x_300.' . $file->getClientOriginalExtension());
        
        User::create([
            'avatar' => 'upload/avatar' . '/' . $rename . '_300_x_300.' . $file->getClientOriginalExtension(),
            'nis' => $request->nis,
            'nama' => $request->nama,
            'email' => $request->email,
            'role' => $request->role,
            'password' => Hash::make($request->password1),
        ]);

        return redirect('/anggota')->with(['alert' => 'success',
                                            'pesan' => 'Anggota berhasil ditambahkan'                     
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
        $title = 'Edit Anggota';
        $user = User::findorfail($id);
        return view('backend.anggota.edit', compact('title', 'user'));
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
            'max' => 'terlalu besar!',
            'same' => 'tidak sama!',
            'email' => 'tidak valid!',
        ];
        $request->validate([
            'avatar' => 'file|image|max:2024',
            'nis' => 'required|unique:users,nis,' .$id,
            'email' => 'required|email:rfc,dns|unique:users,email,'.$id,
            'role' => 'required',
        ], $message);

        $user = User::find($id);
        $avatar = $user->avatar;

        $password = $user->password;

        if($request->password1){
            $message = [
                'required' => 'tidak boleh kosong!',
                'max' => 'terlalu besar!',
                'min' => 'terlalu pendek!',
                'same' => 'tidak sama!',
            ];
            $request->validate([
                'password1' => 'min:6|max:12|min:6|same:password2',
                'password2' => 'min:6'
            ], $message);
            $password  = $request->password1;
        }

        $destination = public_path('upload/avatar');
        

        if($request->hasFile('avatar')){
            if(!File::isDirectory($destination)) {
                File::makeDirectory($destination, 0755, true, true);
            }

            $file = $request->file('avatar');
            $rename = 'avatar_' . date('YmdHis');
            $image = Image::make($file);

            // Proses crop
            $image->fit(300, 300, function($constraint) {
                $constraint->aspectRatio();
            });

            $image->save($destination . '/' . $rename . '_300_x_300.' . $file->getClientOriginalExtension());
            if($user->avatar != 'upload/avatar/user.png')
            {
                File::delete($user->avatar);
            }
            $avatar = 'upload/avatar' . '/' . $rename . '_300_x_300.' . $file->getClientOriginalExtension();
        }

        
        $user->update([
            'avatar' => $avatar,
            'nis' => $request->nis,
            'nama' => $request->nama,
            'email' => $request->email,
            'role' => $request->role,
            'password' => Hash::make($password),
        ]);

        return redirect('/anggota')->with(['alert' => 'success',
                                            'pesan' => 'Anggota berhasil diedit'                     
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
        $user = User::find($id);
        File::delete($user->avatar);
        $user->delete($id);
        return redirect('/anggota')->with(['alert' => 'success',
                                            'pesan' => 'Anggota berhasil dihapus'                     
                                         ]);
    }
}
