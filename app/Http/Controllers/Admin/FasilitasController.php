<?php

namespace App\Http\Controllers\Admin;

use App\Fasilitas;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\Admin\FasilitasRequest;
use App\Http\Requests\Admin\FasilitasEditRequest;

class FasilitasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $fasilitas = Fasilitas::all();
        return view('pages.admin.fasilitas.index',[
            'fasilitas' => $fasilitas
        ]);
    }

    public function create(){
        return view('pages.admin.fasilitas.create');
    }

    public function store(FasilitasRequest $request){
        $data = new Fasilitas();
        $data->nama = $request->input('nama');
        $data->icon = $request->file('icon')->store('assets/Fasilitas','public');
        $data->save();
        Alert::success('SUCCESS','Data Fasilitas Berhasil Ditambah');
        return redirect()->route('fasilitas.index');
    }

    public function edit($id){
        $data = Fasilitas::where('id',$id)->first();
        return view('pages.admin.fasilitas.edit',[
            'data' => $data
        ]);
    }

    public function update(FasilitasEditRequest $request, $id){
        $data = Fasilitas::where('id',$id)->first();
        $data->nama = $request->input('nama');
        if(request()->hasFile('icon')){
            $icon = request()->file('icon')->store('assets/Fasilitas','public');
            $data->update(['icon' => $icon]);
        }
        $data->save();
        Alert::success('SUCCESS','Data Fasilitas Berhasil Diupdate');
        return redirect()->route('fasilitas.index');
    }

    public function destroy($id){
        $fas = Fasilitas::findOrFail($id);
        $fas->delete();

        // return redirect()->route('fasilitas.index');
    }
}
