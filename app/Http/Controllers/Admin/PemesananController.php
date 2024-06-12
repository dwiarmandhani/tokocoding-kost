<?php

namespace App\Http\Controllers\Admin;

use App\Booking as AppBooking;
use App\Mail\BookedMail;
use App\Kamar;
use App\Booking;

use App\Rules\Booking as Bookings;
use Illuminate\Http\Request;
use App\Mail\PaymentCancelMail;
use App\Mail\PaymentSuccessMail;
use App\Mail\PaymentCancelledMail;
use App\Http\Controllers\Controller;
use App\Http\Requests\BookingRequest;
use App\Rules\KamarTersedia;
use App\TipeKamar;
use App\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;

class PemesananController extends Controller
{
    public function index()
    {
        $pemesanans = Booking::all();
        return view('pages.admin.booking.index', [
            'pemesanans' => $pemesanans
        ]);
    }

    public function sukses()
    {
        $pemesanans = Booking::where('status', "Sukses")->get();
        return view('pages.admin.booking.sukses', [
            'pemesanans' => $pemesanans
        ]);
    }

    public function menunggu()
    {
        $pemesanans = Booking::where('status', "Menunggu")->get();
        return view('pages.admin.booking.menunggu', [
            'pemesanans' => $pemesanans
        ]);
    }

    public function cancel()
    {
        $pemesanans = Booking::Where('status', "Dibatalkan")->get();
        return view('pages.admin.booking.batal', [
            'pemesanans' => $pemesanans
        ]);
    }

    public function edit($id)
    {
        $pemesanans = Booking::findOrFail($id);
        return view('pages.admin.booking.edit', [
            'pemesanans' => $pemesanans
        ]);
    }
    public function status(Request $request, $id)
    {
        $pemesanans = Booking::findOrFail($id);
        $kamar = Kamar::find($pemesanans->kamar_id);
        $pemesanans->status = "Sukses";
        $kamar->status = "Disewa";
        $kamar->save();
        $pemesanans->save();
        // Mail::to($pemesanans->user->email)->send(new PaymentSuccessMail());
        Alert::success('SUCCESS', 'Pesanan telah berhasil dikonfirmasi');
        return redirect()->route('sukses');
    }

    public function batal(Request $request, $id)
    {
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
        Alert::success('SUCCESS', 'Pesanan telah berhasil dibatalkan');
        return redirect()->route('dibatalkan');
    }

    public function detail($id)
    {
        $pemesanans = Booking::where('id', $id)->get();
        return view('pages.admin.booking.detail', [
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



    public function create()
    {
        $users = User::all();
        $tipe_kamars = TipeKamar::all();
        return view('pages.admin.transaksi.create', [
            'users' => $users,
            'tipe_kamars' => $tipe_kamars
        ]);
    }
    public function formPesanKamar(TipeKamar $tipe_kamar)
    {
        // Ambil data pengguna untuk dropdown
        $users = User::all();
        return view('pages.admin.transaksi.createkamar', [
            'tipe_kamar' => $tipe_kamar,
            'users' => $users,
        ]);
    }

    public function confirmation(Request $request, $tipe_kamar_id)
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

        // Data pengguna
        $user_id = $request->input('user_id');
        $user = User::findOrFail($user_id);
        $email = $user->email;
        $no_hp = $user->no_hp;
        $name = $user->name;

        // var_dump($user_id);
        // die;

        return view('pages.admin.transaksi.confirmation', [
            'tipe_kamar_id' => $tipe_kamar_id,
            'new_tanggal_masuk' => $new_tanggal_masuk,
            'new_tanggal_keluar' => $new_tanggal_keluar,
            'tipe_kamar' => $tipe_kamar,
            'nomor_kamar' => $new_tanggal_masuk, // Ganti dengan tanggal masuk
            'durasi' => $durasi,
            'total_harga' => $total_harga,
            'kode' => $kode,
            'email' => $email, // Kirim data email ke halaman konfirmasi
            'no_hp' => $no_hp, // Kirim data nomor hp ke halaman konfirmasi
            'name' => $name, // Kirim data nomor hp ke halaman konfirmasi
            'user_id' => $user_id, // Kirim data nomor hp ke halaman konfirmasi
        ]);
    }

    public function booking(Request $request)
    {
        $tipe_kamar = TipeKamar::findOrFail($request->input('tipe_kamar_id'));

        $new_tanggal_masuk = $request->input('tanggal_masuk');
        $durasi = $request->input('durasi');
        $kode = $request->input('kode');
        $user_id = $request->input('user_id');
        $harga = $request->input('harga');
        // Tentukan tanggal keluar berdasarkan durasi
        if ($durasi == 1) {
            $new_tanggal_keluar = date('Y-m-d', strtotime('+1 month', strtotime($request->tanggal_masuk)));
        } elseif ($durasi == 6) {
            $new_tanggal_keluar = date('Y-m-d', strtotime('+6 month', strtotime($request->tanggal_masuk)));
        } else {
            $new_tanggal_keluar = date('Y-m-d', strtotime('+12 month', strtotime($request->tanggal_masuk)));
        }

        // var_dump($new_tanggal_keluar, $new_tanggal_masuk);
        // die;

        $rules['booking_validation'] = [new KamarTersedia($tipe_kamar, $new_tanggal_masuk, $new_tanggal_keluar)];

        $bookingg = new AppBooking();

        $bookingg->kode = $kode;
        $bookingg->tanggal_masuk = $request->input('tanggal_masuk');
        $bookingg->tanggal_keluar = $new_tanggal_keluar;
        $bookingg->expired_at = Carbon::now()->addHours(24);
        $bookingg->status = "Menunggu";
        $bookingg->durasi = $durasi;
        $bookingg->tanggal_pesan = Carbon::now();


        if ($durasi == 1) {
            $total_harga = $durasi * $harga;
        } elseif ($durasi == 6) {
            $total_harga = $durasi * $harga - (0.5 * $harga);
        } elseif ($durasi == 12) {
            $total_harga = $durasi * $harga - (1 * $harga);
        }

        $bookingg->total_harga = $total_harga;
        $booking = new Bookings($tipe_kamar, $new_tanggal_masuk, $new_tanggal_keluar);
        // var_dump($booking);
        // die;
        $kamar = Kamar::where('nomor_kamar', $booking->available_nomor_kamar())->first();

        $bookingg->kamar_id = $kamar->id;
        $bookingg->user_id = $user_id;
        $bookingg->save();
        // sampe sini

        $kamar->status = "Dipesan";
        $kamar->save();

        Alert::success('SUCCESS', 'Berhasil melakukan pemesanan kamar');
        return redirect()->route('pemesanansukses');
    }

    // Method untuk menghitung total harga
    private function hitungTotalHarga($harga, $durasi)
    {
        if ($durasi == 1) {
            return $durasi * $harga;
        } elseif ($durasi == 6) {
            return $durasi * $harga - (0.5 * $harga);
        } else {
            return $durasi * $harga - (1 * $harga);
        }
    }

    public function pemesanansukses()
    {
        return view('pages.admin.transaksi.success');
    }
}
