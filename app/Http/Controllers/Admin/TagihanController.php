<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Booking;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class TagihanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {
        $tagihans = Booking::where('status',"Sukses")->get();
        return view('pages.admin.tagihan.index',[
            'tagihans' => $tagihans
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){}
    public function lanjut(Request $request,$id){
        $transaction = Booking::where('id',$id)->first();
        // dd($transaction);
        $tipe_kamar =  $transaction->kamar->tipe_kamar;
        return view('pages.admin.tagihan.create',[
            'transaction' => $transaction,
            'tipe_kamar' => $tipe_kamar
        ]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$id)
    {
        $old_room_booking = json_decode($request->transaction);
        $new_tanggal_masuk = $old_room_booking->tanggal_keluar;
        $durasi = $request->input('durasi');
        $total_harga = $request->input('total');
        $kode = 'KOS'.date("ymd").mt_rand(000,999);
        if ($durasi == 1) {
            $new_tanggal_keluar = date('Y-m-d', strtotime('+1 month', strtotime($new_tanggal_masuk)));
        } elseif ($durasi == 6){
            $new_tanggal_keluar = date('Y-m-d', strtotime('+6 month', strtotime($new_tanggal_masuk)));
        } else {
            $new_tanggal_keluar = date('Y-m-d', strtotime('+12 month', strtotime($new_tanggal_masuk)));
        }
        $user = Booking::with('user')->where('id',$id)->first();
        $transaction = new Booking();
        $transaction->durasi = $durasi;
        $transaction->tanggal_masuk = $new_tanggal_masuk;
        $transaction->tanggal_keluar = $new_tanggal_keluar;
        $transaction->tanggal_pesan = Carbon::now();
        $transaction->total_harga = $total_harga;
        $transaction->kamar_id = $old_room_booking->kamar_id;
        $transaction->user_id = $user->user_id;
        $transaction->kode = $kode;
        $transaction->expired_at = Carbon::now()->addHours(24);
        $transaction->save();
        Alert::success('SUCCESS','Berhasil membuat tagihan sewa kamar');
        return redirect()->route('transaksi');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
