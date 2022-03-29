<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UbahPwController extends Controller
{
    public function ubahpw()
    {
        $title = 'Ubah Password';
        return view('backend.ubahpw', compact('title'));
    }
    public function prosesubahpw(Request $request)
    {
        $message = [
            'required' => 'harus diisi!',
            'min' => 'terlalu pendek!',
            'max' => 'terlalu panjang!',
            'same' => 'tidak sama!'
        ];

        $request->validate([
            'pwlama' => 'required',
            'password' => 'min:6|max:12|min:6|required_with:password1|same:password1',
            'password1' => 'min:6'
        ], $message);

        $user = User::find(Auth::user()->id);

        

        if(Hash::check($request->pwlama, $user->password)){
            
            $user->update([
                'password' => Hash::make($request->password)
            ]);

            return back()->with(['alert' => 'success',
                                 'pesan' => 'Password berhasil diubah'                     
                                ]);

        }
        return back()->with(['pesan' => 'Password lama tidak cocok!']);
    }
}
