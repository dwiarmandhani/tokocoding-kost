<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\ChangePasswordRequest;

class ChangePassController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function change(){
        return view('pages.user.change-pass.index');
    }

    public function update(ChangePasswordRequest $request) {
        $request->user()->update([
            'password' => Hash::make($request->get('password'))
        ]);
        Alert::success('SUCCESS','Kata Sandi Berhasil Diubah');
        return redirect()->route('change-pass');
    }
}
