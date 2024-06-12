<?php

namespace App\Http\Controllers;

use App\Booking;
use Carbon\Carbon;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class PerpanjangController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function lanjut(Request $request,$id){
        $transaction = Booking::where('id',$id)->first();
        // dd($transaction);
        $tipe_kamar =  $transaction->kamar->tipe_kamar;
        return view('pages.user.perpanjang.create',[
            'transaction' => $transaction,
            'tipe_kamar' => $tipe_kamar
        ]);
    }

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
        return redirect()->route('user-transaksi');
    }
}
