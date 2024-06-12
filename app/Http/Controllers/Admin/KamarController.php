<?php

namespace App\Http\Controllers\Admin;

use App\Booking;
use App\Kamar;
use App\TipeKamar;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\Admin\KamarRequest;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\Admin\KamarEditRequest;

class KamarController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index($id){
        $tipe_kamars = TipeKamar::find($id);
        $pemesanans = Booking::all();
        return view('pages.admin.kamar.index',[
            'tipe_kamar' => $tipe_kamars,
            'pemesanans' => $pemesanans
        ]);
    }

    public function create($id){
        $tipe_kamar = TipeKamar::find($id);
        return view('pages.admin.kamar.create',[
            'tipe_kamar' => $tipe_kamar
        ]);
    }

    public function store($id, KamarRequest $request){
        $tipe_kamar = TipeKamar::find($id);
        $kamar = new Kamar();
        $kamar->nomor_kamar = $request->input('nomor_kamar');

        $kamar->tipe_kamar()->associate($tipe_kamar);
        $kamar->save();

        Alert::success('SUCCESS','Data Kamar Berhasil Ditambah');
        return redirect('/admin/tipe/'.$id.'/kamar');
    }

    public function edit($id,$kamar_id){
        $tipe_kamar = TipeKamar::find($id);
        $kamar =  Kamar::findOrFail($kamar_id);
        return view('pages.admin.kamar.edit',[
            'tipe_kamar' => $tipe_kamar,
            'kamar' => $kamar
        ]);
    }

    public function update($id, $kamar_id,KamarEditRequest $request){
        $kamar = Kamar::find($kamar_id);
        $kamar->nomor_kamar = $request->input('nomor_kamar');
        $kamar->status = $request->input('status');
        $kamar->save();

        Alert::success('SUCCESS','Data Kamar Berhasil Diupdate');
        return redirect('admin/tipe/'.$id.'/kamar/');
    }

    public function destroy($id, $kamar_id){
        $kamar = Kamar::findOrFail($kamar_id);

        foreach ($kamar->bookings as $booking) {
            $booking->delete();
        }
        if($kamar->delete()){

            return redirect('/admin/tipe/'.$id.'/kamar');
        }
        return redirect()->back()->withErrors(array('message' => 'Maaf, data kamar tidak terhapus'));
    }
}
