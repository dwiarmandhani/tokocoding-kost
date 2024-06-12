<?php

namespace App\Http\Controllers;

use App\Http\Requests\AvatarRequest;
use App\Http\Requests\ProfilUserRequest;
use App\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class ProfilUserController extends Controller
{
    public function index(){
        $data = User::where('id',Auth::user()->id)->get();
        return view('pages.user.profil.view',[
            'data' => $data
        ]);
    }

    public function avatar(AvatarRequest $request){
        $request->validate([
            'avatar' => 'required|image|mimes:png,jpg,jpeg|max:2048',
        ]);
        $data = User::where('id', Auth::user()->id)->first();
        if($request->hasFile('avatar')){
            $path = $request->file('avatar')->store('assets/avatar','public');
            $data->avatar = $path;
        }
        $data->save();
        Alert::success('SUCCESS','Foto profil berhasil diubah');
        return redirect()->back();
    }

    public function user(){
        $data = User::where('id',Auth::user()->id)->get();
        return view('pages.user.profil.edit',[
            'data' => $data
        ]);
    }

    public function update(ProfilUserRequest $request, $id){
        $data = User::where('id',$id)->first();
        $data->name = $request->name;
        $data->email = $request->email;
        $data->no_hp = $request->no_hp;
        $data->pekerjaan = $request->pekerjaan;
        $data->alamat = $request->alamat;
        $data->bank = $request->bank;
        $data->no_rekening = $request->no_rekening;

        if(request()->hasFile('foto_ktp')){
            $foto_ktp = request()->file('foto_ktp')->store('assets/user','public');
            $data->update(['foto_ktp' => $foto_ktp]);
        }
        $data->save();
        Alert::success('SUCCESS','Profil Berhasil diupdate');
        return redirect()->route('profil-user');
    }
}
