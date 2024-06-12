<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Pengeluaran;
use Illuminate\Http\Request;
use App\Exports\PengeluaranExport;
use Barryvdh\DomPDF\Facade as PDF;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\Admin\PengeluaranRequest;
use App\Http\Requests\Admin\PengeluaranEditRequest;
use Maatwebsite\Excel\Facades\Excel;

class PengeluaranController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $pengeluarans = Pengeluaran::all();
        return view('pages.admin.pengeluaran.index',[
            'pengeluarans' => $pengeluarans
        ]);
    }

    public function create(){
        return view('pages.admin.pengeluaran.create');
    }

    public function store(PengeluaranRequest $request){
        $data = new Pengeluaran();
        $data->deskripsi = $request->input('deskripsi');
        $data->nominal = $request->input('nominal');
        $data->tanggal = $request->input('tanggal');
        $data->foto = $request->file('foto')->store('assets/pengeluaran','public');
        $data->save();

        Alert::success('SUCCESS','Data Pengeluaran Berhasil Ditambah');
        return redirect()->route('pengeluaran.index');
    }

    public function edit($id){
        $data = Pengeluaran::findOrFail($id);
        return view('pages.admin.pengeluaran.edit',[
            'data' => $data,
        ]);
    }
    public function update(PengeluaranEditRequest $request,$id){
        $data = Pengeluaran::where('id',$id)->first();
        $data->deskripsi = $request->deskripsi;
        $data->nominal = $request->nominal;
        $data->tanggal = $request->tanggal;
        if(request()->hasFile('foto')){
            $foto = request()->file('foto')->store('assets/pengeluaran','public');
            $data->update(['foto' => $foto]);
        }
        $data->save();
        Alert::success('SUCCESS','Data Pengeluaran Berhasil Diupdate');
        return redirect()->route('pengeluaran.index');
    }

    public function ex_pdf(){
        $now = Carbon::now();
        $pengeluaran = Pengeluaran::orderBy('tanggal','ASC')->get();
        $nominal = Pengeluaran::sum('nominal');

        $pdf = PDF::loadview('pages.admin.pengeluaran.pengeluaran_pdf',[
            'now' => $now,
            'pengeluaran' => $pengeluaran,
            'nominal' => $nominal
        ]);
        return $pdf->download('laporan-pengeluaran.pdf');
    }

    public function excel(){
        return Excel::download(new PengeluaranExport,'laporan-pengeluaran.xlsx');
    }

    public function destroy($id){
        $item = Pengeluaran::findOrFail($id);
        $item->delete();

        return redirect()->route('pengeluaran.index');
    }
}
