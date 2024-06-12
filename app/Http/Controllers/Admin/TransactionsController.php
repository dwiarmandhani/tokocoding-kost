<?php

namespace App\Http\Controllers\Admin;

use App\Booking;
use Illuminate\Http\Request;
use App\Mail\PaymentSuccessMail;
use App\Http\Controllers\Controller;
use App\Kamar;
use Illuminate\Support\Facades\Mail;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;

class TransactionsController extends Controller
{
    public function index()
    {
        $transaksis = Booking::all();
        return view('pages.admin.booking.index', [
            'transaksis' => $transaksis
        ]);
    }

    public function selesai()
    {
        $transaksis = Booking::where('status', "Selesai")->get();
        return view('pages.admin.booking.selesai', [
            'transaksis' => $transaksis
        ]);
    }

    public function menunggu()
    {
        $transaksis = Booking::where('status', "Menunggu")->get();
        return view('pages.admin.booking.menunggu', [
            'transaksis' => $transaksis
        ]);
    }

    public function cancel()
    {
        $transaksis = Booking::Where('status', "Dibatalkan")->get();
        return view('pages.admin.booking.batal', [
            'transaksis' => $transaksis
        ]);
    }

    public function edit($id)
    {
        $transaksis = Booking::findOrFail($id);
        return view('pages.admin.booking.edit', [
            'transaksis' => $transaksis
        ]);
    }
    public function status(Request $request, $id)
    {
        $transaksis = Booking::findOrFail($id);
        $transaksis->status = "Selesai";
        $transaksis->save();
        Alert::success('SUCCESS', 'Pesanan telah berhasil dikonfirmasi');
        return redirect()->route('transaksi');
    }
    public function batal(Request $request, $id)
    {
        $transaksis = Booking::findOrFail($id);
        $kamar = Kamar::find($transaksis->kamar_id);
        $transaksis->status = "Dibatalkan";
        $kamar->status = 1;
        $kamar->save();
        $transaksis->save();
        Alert::success('SUCCESS', 'Pesanan telah berhasil  dibatalkan');
        return redirect()->route('transaksi');
    }


    public function update(Request $request, $id)
    {
        $transaksis = Booking::findOrFail($id);

        $rules = [
            'status' => 'in:PENDING,SUCCESS,CANCELLED',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->back()
                ->withInput($request->all())
                ->withErrors($validator);
        }
        if ($transaksis->status === 'CANCELLED') {
            $transaksis = Booking::findOrFail($id);
            $kamar = Kamar::find($transaksis->kamar_id);
            $kamar->tersedia = 1;
            $kamar->save();
            $transaksis->save();
        } else {
            $transaksis->status = $request->input('status', 'SUCCESS');
            $transaksis->save();
        }
        // Mail::to($transaction->user->email)->send(new PaymentSuccessMail());
        Alert::success('SUCCESS', 'Status booking telah diubah');
        return redirect()->route('transaksi');
    }

    public function detail($id)
    {
        $transaksis = Booking::where('id', $id)->get();
        return view('pages.admin.booking.detail', [
            'transaksis' => $transaksis
        ]);
    }
}
