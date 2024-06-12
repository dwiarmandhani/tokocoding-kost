<?php

namespace App\Http\Controllers\Admin;

use App\Room;
use App\User;
use App\Kamar;
use App\Booking;
use App\Expense;
use App\TipeKamar;
use App\Pengeluaran;
use App\RoomBooking;
use App\Transaction;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        $user = User::role('user')->count();
        $tipe_kamar = TipeKamar::all();
        $kamar_kosong = Kamar::where('status',"Kosong")->count();
        $kamar = Kamar::count();
        $bookings = Booking::count();
        $total_harga = Booking::where('status',"Sukses")->sum('total_harga');
        $pengeluaran = Pengeluaran::sum('nominal');
        $keuntungan = $total_harga - $pengeluaran;
        $label = ["Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"];
        for($bulan = 1 ; $bulan < 12; $bulan++){
            $chart = collect(DB::select("SELECT count(id) as jumlah from bookings where month(created_at)='$bulan'"))->first();
            $jumlah_transactions[] = $chart->jumlah;
        }
        return view('pages.admin.dashboard',[
            'user' => $user,
            'tipe_kamar' => $tipe_kamar,
            'kamar_kosong' => $kamar_kosong,
            'bookings' => $bookings,
            'total_harga' => $total_harga,
            'keuntungan' => $keuntungan,
            'pengeluaran' => $pengeluaran,
            'kamar' => $kamar,
            'label' => $label,
            'jumlah_transactions' => $jumlah_transactions,
        ]);
    }
}
