<?php

namespace App\Http\Controllers\Admin;

use App\Fasilitas;
use App\GaleriKamar;
use App\TipeKamar;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\TipeKamarEditRequest;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\Admin\TipeKamarRequest;

class TipeKamarController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {
        $tipe_kamars = TipeKamar::with(['galeri', 'fasilitas:nama'])->get();
        return view('pages.admin.tipe.index', [
            'tipe_kamars' => $tipe_kamars,
        ]);
    }

    public function uploadGaleri(Request $request)
    {
        $data = $request->all();
        $data['foto'] = $request->file('foto')->store('assets/GaleriKamar', 'public');

        GaleriKamar::create($data);

        return redirect()->route('tipe.edit', $request->tipe_kamar_id);
    }

    public function deleteGaleri(Request $request, $id)
    {
        $item = GaleriKamar::findOrFail($id);
        $item->delete();

        return redirect()->route('tipe.edit', $item->tipe_kamar_id);
    }

    public function create()
    {
        $fasilitas = Fasilitas::all();
        return view('pages.admin.tipe.create', [
            'fasilitas' => $fasilitas
        ]);
    }

    public function store(TipeKamarRequest $request)
    {
        $data = new TipeKamar();
        $data->nama = $request->input('nama');
        $data->lantai = $request->input('lantai');
        $data->harga = $request->input('harga');
        $data->ukuran = $request->input('ukuran');
        $data->save();
        $galeri = [
            'tipe_kamar_id' => $data->id,
            'foto' => $request->file('foto')->store('assets/GaleriKamar', 'public'),
        ];
        GaleriKamar::create($galeri);
        if ($request->has('fas')) {
            $data->fasilitas()->attach(array_keys($request->input('fas')));
        }
        Alert::success('SUCCESS', 'Data Tipe Kamar Berhasil Ditambah');
        return redirect()->route('tipe.index');
    }

    public function edit($id)
    {
        $fasilitas = Fasilitas::all();
        $data = TipeKamar::with('galeri')->findOrFail($id);
        return view('pages.admin.tipe.edit', [
            'data' => $data,
            'fasilitas' => $fasilitas
        ]);
    }

    public function update(TipeKamarEditRequest $request, $id)
    {
        $data = TipeKamar::where('id', $id)->first();
        $data->nama = $request->nama;
        $data->lantai = $request->lantai;
        $data->harga = $request->harga;
        $data->ukuran = $request->ukuran;
        $data->save();
        if (request()->hasFile('fas')) {
            $data->fasilitas()->sync(array_keys($request->input('fas')));
        }

        Alert::success('SUCCESS', 'Data Tipe Kamar Berhasil Diupdate');
        return redirect()->route('tipe.index');
    }

    public function destroy($id)
    {
        $tipe_kamar = TipeKamar::findOrFail($id);
        $tipe_kamar->delete();

        return redirect()->route('tipe.index');
    }
}
