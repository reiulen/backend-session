<?php

namespace App\Http\Controllers;

use Image;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $title = 'Dashboard';
        return view('backend.dashboard', compact('title'));
    }

    public function profil()
    {
        $title = 'Profil';
        return view('backend.profil', compact('title'));
    }
    public function ubahprofil(Request $request)
    {
        $user = User::findorfail(Auth::user()->id);
        $message = [
            'required' => 'wajib diisi!',
            'max' => 'terlalu pendek!',
            'min' => 'terlalu panjang!',
            'unique' => 'sudah tersedia!',
            'numeric' => 'bukan angka'
        ];

        if($request->hasFile('foto')){
            $request->validate([
                'foto' => 'required|file|image|max:2024',
            ]);

            $destination = public_path('upload/avatar');
        
            if(!File::isDirectory($destination)) {
                File::makeDirectory($destination, 0755, true, true);
            }

            $file = $request->file('foto');
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
            
            $user->update([
                'avatar' => 'upload/avatar' . '/' . $rename . '_300_x_300.' . $file->getClientOriginalExtension(),
            ]);

            return back()->with([
                                'alert' => 'success',
                                'title' => 'Profil berhasil di ubah'
            ]);

        }

        if($request->a == 'a'){
            $request->validate([
                'nama' => 'required',
                'email' => 'required|email:rfc,dns|unique:users,nis,' .$user->id,
            ], $message);

           $user->update([
                'nama' => $request->nama,
                'email' => $request->email
           ]);

           return back()->with([
                                'alert' => 'success',
                                'title' => 'Profil berhasil di ubah'
           ]);
       
        }
        
    }
}
