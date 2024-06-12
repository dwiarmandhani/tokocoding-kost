<?php

namespace App\Http\Controllers;

use App\Booking as AppBooking;
use App\Http\Requests\BookingRequest;
use App\Mail\BookedMail;
use App\Kamar;
use App\Rules\Booking;
use App\TipeKamar;
use App\Rules\KamarTersedia;
use Carbon\Carbon;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;

use Exception;

use Midtrans\Snap;
use Midtrans\Config;
use Midtrans\Notification;

class BookingController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    public function confirmation(BookingRequest $request, $tipe_kamar_id)
    {
        $tipe_kamar = TipeKamar::findOrFail($tipe_kamar_id);
        $harga = $tipe_kamar->harga;
        $new_tanggal_masuk = $request->input('tanggal_masuk');
        $durasi = $request->input('durasi');
        $kode = 'KOS' . date("ymd") . mt_rand(000, 999);
        if ($durasi == 1) {
            $new_tanggal_keluar = date('Y-m-d', strtotime('+1 month', strtotime($request->tanggal_masuk)));
            $total_harga = $durasi * $harga;
        } elseif ($durasi == 6) {
            $new_tanggal_keluar = date('Y-m-d', strtotime('+6 month', strtotime($request->tanggal_masuk)));
            $total_harga = $durasi * $harga - (0.5 * $harga);
        } else {
            $new_tanggal_keluar = date('Y-m-d', strtotime('+12 month', strtotime($request->tanggal_masuk)));
            $total_harga = $durasi * $harga - (1 * $harga);
        }

        // var_dump($new_tanggal_keluar, $new_tanggal_masuk);
        // die;
        $rules['booking_validation'] = [new KamarTersedia($tipe_kamar, $new_tanggal_masuk, $new_tanggal_keluar)];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        }
        $booking = new Booking($tipe_kamar, $new_tanggal_masuk, $new_tanggal_keluar);

        return view('confirmation', [
            'tipe_kamar_id' => $tipe_kamar_id,
            'new_tanggal_masuk' => $new_tanggal_masuk,
            'new_tanggal_keluar' => $new_tanggal_keluar,
            'tipe_kamar' => $tipe_kamar,
            'nomor_kamar' => $booking->available_nomor_kamar(),
            'durasi' => $durasi,
            'total_harga' => $total_harga,
            'kode' => $kode,
        ]);
    }

    public function booking(BookingRequest $request, $tipe_kamar_id)
    {
        $tipe_kamar = TipeKamar::findOrFail($tipe_kamar_id);
        // var_dump($tipe_kamar);
        // die;
        $new_tanggal_masuk = $request->input('tanggal_masuk');
        $durasi = $request->input('durasi');
        $kode = $request->input('kode');
        if ($durasi == 1) {
            $new_tanggal_keluar = date('Y-m-d', strtotime('+1 month', strtotime($request->tanggal_masuk)));
        } elseif ($durasi == 6) {
            $new_tanggal_keluar = date('Y-m-d', strtotime('+6 month', strtotime($request->tanggal_masuk)));
        } else {
            $new_tanggal_keluar = date('Y-m-d', strtotime('+12 month', strtotime($request->tanggal_masuk)));
        }
        // var_dump($tipe_kamar, $new_tanggal_masuk, $new_tanggal_keluar);
        // die;
        $rules['booking_validation'] = [new KamarTersedia($tipe_kamar, $new_tanggal_masuk, $new_tanggal_keluar)];
        $bookingg = new AppBooking();
        $user = Auth::user();
        $bookingg->kode = $kode;
        $bookingg->tanggal_masuk = $request->input('tanggal_masuk');
        $bookingg->tanggal_keluar = $new_tanggal_keluar;
        $bookingg->tanggal_pesan = Carbon::now();
        $bookingg->expired_at = Carbon::now()->addHours(24);
        $bookingg->status = "Menunggu";
        $bookingg->durasi = $durasi;
        $harga = $tipe_kamar->harga;
        if ($durasi == 1) {
            $total_harga = $durasi * $harga;
        } elseif ($durasi == 6) {
            $total_harga = $durasi * $harga - (0.5 * $harga);
        } elseif ($durasi == 12) {
            $total_harga = $durasi * $harga - (1 * $harga);
        }
        $bookingg->total_harga = $total_harga;
        // var_dump($tipe_kamar);
        // die;
        $booking = new Booking($tipe_kamar, $new_tanggal_masuk, $new_tanggal_keluar);
        // var_dump($booking);
        // die;
        $kamar = Kamar::where('nomor_kamar', $booking->available_nomor_kamar())->first();
        $bookingg->kamar_id = $kamar->id;
        $bookingg->user_id = $user->id;
        $bookingg->save();
        $kamar->status = "Dipesan";
        $kamar->save();
        Alert::success('SUCCESS', 'Berhasil melakukan pemesanan kamar');
        return redirect()->route('upload');
    }

    public function show()
    {
        $transaction = AppBooking::with('user', 'kamar')->where('user_id', Auth::user()->id)->latest()->first();
        return view('pages.unggah', [
            'transaction' => $transaction
        ]);
    }

    public function upload(Request $request, $id)
    {
        $this->validate(
            $request,
            [
                'bukti_pembayaran' => 'required|image|max:2048|mimes:png,jpg,jpeg',
            ],
            [
                'bukti_pembayaran.required' => 'Bukti pembayaran tidak boleh kosong',
                'bukti_pembayaran.max' => 'Bukti pembayaran melebihi 2MB',
                'bukti_pembayaran.mimes' => 'Format file harus berupa png, jpg, jpeg'
            ]
        );

        $transaction = AppBooking::with('user', 'kamar')->where('user_id', Auth::user()->id)->latest()->first();
        if ($request->hasFile('bukti_pembayaran')) {
            $path = $request->file('bukti_pembayaran')->store('assets/transaction', 'public');
            $transaction->bukti_pembayaran = $path;
        }
        $transaction->save();
        Alert::success('SUCCESS', 'Foto pembayaran berhasil disimpan');
        return redirect()->route('user-transaksi');
    }
}

// public function booking(BookingRequest $request, $tipe_kamar_id){
//     $tipe_kamar = TipeKamar::findOrFail($tipe_kamar_id);
//     $new_tanggal_masuk = $request->input('tanggal_masuk');
//     $durasi = $request->input('durasi');
//     $kode = 'KOS'.date("ymd").mt_rand(000,999);

//     if($durasi == 1){
//         $new_tanggal_keluar = date('Y-m-d', strtotime('+1 month', strtotime($request->tanggal_masuk)));
//     }elseif($durasi == 6){
//         $new_tanggal_keluar = date('Y-m-d', strtotime('+6 month', strtotime($request->tanggal_masuk)));
//     }else {
//         $new_tanggal_keluar = date('Y-m-d', strtotime('+12 month', strtotime($request->tanggal_masuk)));
//     }
//     $rules['booking_validation'] = [new KamarTersedia($tipe_kamar,$new_tanggal_masuk,$new_tanggal_keluar)];

//     $bookingg = new AppBooking();
//     $user = Auth::user();
//     $bookingg->kode = $kode;
//     $bookingg->tanggal_masuk = $request->input('tanggal_masuk');
//     $bookingg->tanggal_keluar = $new_tanggal_keluar;
//     $bookingg->tanggal_pesan = Carbon::now();
//     $bookingg->transaction_status = "PENDING";
//     $bookingg->expired_at = Carbon::now()->addHours(24);

//     $harga = $tipe_kamar->harga;
//     if($durasi == 1){
//         $total_harga = $durasi * $harga;
//     } elseif($durasi == 6){
//         $total_harga = $durasi * $harga - (0.5 * $harga);
//     } elseif($durasi == 12){
//         $total_harga = $durasi * $harga - (1 * $harga);
//     }

//     $bookingg->total_harga = $total_harga;
//     // $bookingg->user_id = $user->id;

//     $booking = new Booking($tipe_kamar, $new_tanggal_masuk, $new_tanggal_keluar);

//     $kamar = Kamar::where('nomor_kamar', $booking->available_nomor_kamar())->first();

//     $bookingg->kamar_id = $kamar->id;
//     $bookingg->user_id = $user->id;
//     $bookingg->save();
//     $kamar->status = 0;
//     $kamar->save();

//     Config::$serverKey = config('services.midtrans.serverKey');
//     Config::$isProduction = config('services.midtrans.isProduction');
//     Config::$isSanitized = config('services.midtrans.isSanitized');
//     Config::$is3ds = config('services.midtrans.is3ds');

//     $token_id = $_POST['token_id'];
//     //array midtrans
//     $midtrans = array(
//         'transaction_details' => array(
//             'order_id' => $kode,
//             'gross_amount' => $total_harga,
//         ),
//         'credit_card'  => array(
//             'token_id'      => $token_id,
//             'authentication'=> true,
//     //        'bank'          => 'bni', // optional to set acquiring bank
//     //        'save_token_id' => true   // optional for one/two clicks feature
//         ),
//         'customer_details' => array(
//             'first_name' => Auth::user()->name,
//             'email' => Auth::user()->email,
//             'phone' => Auth::user()->no_hp,
//         ),
//         'enabled_payments' => array(
//             'gopay', 'bni_va','bank_transfer'
//         ),
//         'vtweb' => array()
//     );
//     try {
//         // Get Snap Payment Page URL
//         $paymentUrl = Snap::createTransaction($midtrans)->redirect_url;

//         // Redirect to Snap Payment Page
//         return redirect($paymentUrl);
//     }
//     catch (Exception $e) {
//         echo $e->getMessage();
//     }
// }

// public function callback(Request $request){
//     Config::$serverKey = config('services.midtrans.serverKey');
//     Config::$isProduction = config('services.midtrans.isProduction');
//     Config::$isSanitized = config('services.midtrans.isSanitized');
//     Config::$is3ds = config('services.midtrans.is3ds');

//     // Buat instance midtrans notification
//     $notification = new Notification();

//     // Assign ke variable untuk memudahkan coding
//     $status = $notification->transaction_status;
//     $type = $notification->payment_type;
//     $fraud = $notification->fraud_status;
//     $order_id = $notification->order_id;

//     // Cari transaksi berdasarkan ID
//     $transaction = AppBooking::where('kode',$order_id)->first();

//     // Handle notification status midtrans
//     if ($status == 'capture') {
//         if ($type == 'credit_card'){
//             if($fraud == 'challenge'){
//                 $transaction->transaction_status = 'PENDING';
//                 echo "Transaction order_id: " . $order_id ." is challenged by FDS";
//             }
//             else {
//                 $transaction->transaction_status = 'SUCCESS';
//                 echo "Transaction order_id: " . $order_id ." successfully captured using " . $type;
//             }
//         }
//     }
//     else if ($status == 'SETTLEMENT'){
//         $transaction->transaction_status = 'SUCCESS';
//         echo "Transaction order_id: " . $order_id ." successfully transfered using " . $type;
//     }
//     else if($status == 'PENDING'){
//         $transaction->transaction_status = 'PENDING';
//         echo "Waiting customer to finish transaction order_id: " . $order_id . " using " . $type;
//     }
//     else if ($status == 'DENY') {
//         $transaction->transaction_status = 'CANCELLED';
//         echo "Payment using " . $type . " for transaction order_id: " . $order_id . " is denied.";
//     }
//     else if ($status == 'EXPIRE') {
//         $transaction->transaction_status = 'CANCELLED';
//         echo "Payment using " . $type . " for transaction order_id: " . $order_id . " is expired.";
//     }
//     else if ($status == 'CANCEL') {
//         $transaction->transaction_status = 'CANCELLED';
//         echo "Payment using " . $type . " for transaction order_id: " . $order_id . " is canceled.";
//     }

//     // Simpan transaksi
//     $transaction->save();

//     // Kirimkan email
//     if ($transaction)
//     {
//         if($status == 'capture' && $fraud == 'accept' )
//         {

//         }
//         else if ($status == 'SETTLEMENT')
//         {
//             //
//         }
//         else if ($status == 'SUCCESS')
//         {
//             //
//         }
//         else if($status == 'capture' && $fraud == 'challenge' )
//         {
//             return response()->json([
//                 'meta' => [
//                     'code' => 200,
//                     'message' => 'Midtrans Payment Challenge'
//                 ]
//             ]);
//         }
//         else
//         {
//             return response()->json([
//                 'meta' => [
//                     'code' => 200,
//                     'message' => 'Midtrans Payment not Settlement'
//                 ]
//             ]);
//         }

//         return response()->json([
//             'meta' => [
//                 'code' => 200,
//                 'message' => 'Midtrans Notification Success'
//             ]
//         ]);
//     }
// }

// public function success(){
//     return view('pages.user.success');
// }

// public function gagal(){
//     return view('pages.user.gagal');
// }
