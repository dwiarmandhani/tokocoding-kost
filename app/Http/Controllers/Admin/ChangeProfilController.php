<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProfilAdminRequest;
use RealRashid\SweetAlert\Facades\Alert;
use App\User;
use Illuminate\Support\Facades\Auth;

class ChangeProfilController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function profil(){
        $user = User::where('id',Auth::user()->id)->first();
        return view('pages.admin.profil.edit',[
            'user' => $user
        ]);
    }

    public function update(ProfilAdminRequest $request, $id){
        $user = User::where('id',$id)->first();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->no_hp = $request->no_hp;
        $user->save();

        Alert::success('SUCCESS','Profil Berhasil diupdate');
        return redirect()->back();
    }
}
