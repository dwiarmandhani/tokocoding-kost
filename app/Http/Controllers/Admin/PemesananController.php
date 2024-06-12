<?php

namespace App\Http\Controllers\Admin;

use App\Kamar;
use App\Booking;
use Illuminate\Http\Request;
use App\Mail\PaymentCancelMail;
use App\Mail\PaymentSuccessMail;
use App\Mail\PaymentCancelledMail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;

class PemesananController extends Controller
{
    public function index(){
        $pemesanans = Booking::all();
        return view('pages.admin.booking.index',[
            'pemesanans' => $pemesanans
        ]);
    }

    public function sukses(){
        $pemesanans = Booking::where('status',"Sukses")->get();
        return view('pages.admin.booking.sukses',[
            'pemesanans' => $pemesanans
        ]);
    }

    public function menunggu(){
        $pemesanans = Booking::where('status',"Menunggu")->get();
        return view('pages.admin.booking.menunggu',[
            'pemesanans' => $pemesanans
        ]);
    }

    public function cancel(){
        $pemesanans = Booking::Where('status',"Dibatalkan")->get();
        return view('pages.admin.booking.batal',[
            'pemesanans' => $pemesanans
        ]);
    }

    public function edit($id){
        $pemesanans = Booking::findOrFail($id);
        return view('pages.admin.booking.edit',[
            'pemesanans' => $pemesanans
        ]);
    }
    public function status(Request $request, $id){
        $pemesanans = Booking::findOrFail($id);
        $kamar = Kamar::find($pemesanans->kamar_id);
        $pemesanans->status = "Sukses";
        $kamar->status = "Disewa";
        $kamar->save();
        $pemesanans->save();
        // Mail::to($pemesanans->user->email)->send(new PaymentSuccessMail());
        Alert::success('SUCCESS','Pesanan telah berhasil dikonfirmasi');
        return redirect()->route('sukses');
    }

    public function batal(Request $request, $id){
        $pemesanans = Booking::findOrFail($id);
        $kamar = Kamar::find($pemesanans->kamar_id);
        $pemesanans->status = "Dibatalkan";
        $kamar->status = "Kosong";
        $kamar->save();
        $pemesanans->save();
        // if($pemesanans->bukti_pembayaran == null){
        //     Mail::to($pemesanans->user->email)->send(new PaymentCancelMail());
        // }else{
        //     Mail::to($pemesanans->user->email)->send(new PaymentCancelledMail());
        // }
        Alert::success('SUCCESS','Pesanan telah berhasil dibatalkan');
        return redirect()->route('dibatalkan');
    }

    public function detail($id){
        $pemesanans = Booking::where('id',$id)->get();
        return view('pages.admin.booking.detail',[
            'pemesanans' => $pemesanans
        ]);
    }

    // public function update(Request $request, $id){
    //     $pemesanans = Booking::findOrFail($id);

    //     $rules = [
    //         'status' => 'in:PENDING,SUCCESS,CANCELLED',
    //     ];

    //     $validator = Validator::make($request->all(), $rules);
    //     if($validator->fails()){
    //         return redirect()->back()
    //         ->withInput($request->all())
    //         ->withErrors($validator);
    //     }
    //     if($pemesanans->status === 'CANCELLED'){
    //         $pemesanans = Booking::findOrFail($id);
    //         $kamar = Kamar::find($pemesanans->kamar_id);
    //         $kamar->tersedia = 1;
    //         $kamar->save();
    //         $pemesanans->save();
    //     } else {
    //         $pemesanans->status = $request->input('status','SUCCESS');
    //         $pemesanans->save();
    //     }
    //     // Mail::to($transaction->user->email)->send(new PaymentSuccessMail());
    //     Alert::success('SUCCESS','Status booking telah diubah');
    //     return redirect()->route('transaksi');
    // }

}
