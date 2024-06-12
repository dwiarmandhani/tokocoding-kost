<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\Admin\ChangePassRequest;

class ChangePasswordController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function edit(){
        return view('pages.admin.password.edit');
    }

    public function update(ChangePassRequest $request){
        $request->user()->update([
            'password' => Hash::make($request->get('password'))
        ]);
        Alert::success('SUCCESS','Kata Sandi Berhasil Diubah');
        return redirect()->route('admin-dashboard');
    }
}
