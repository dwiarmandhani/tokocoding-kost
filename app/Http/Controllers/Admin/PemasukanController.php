<?php

namespace App\Http\Controllers\Admin;

use App\Booking;
use App\Exports\PemasukanExport;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class PemasukanController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    protected function setPdfOption()
    {
        return [
            'dpi' => 150,
            'defaultFont' => 'sans-serif',
            'isHtml5ParserEnabled' => true,
            'isRemoteEnabled' => true
        ];
    }

    public function index(){
        $pemesanans = Booking::where('status',"Sukses")->get();
        return view('pages.admin.pemasukan.index',[
            'pemesanans' => $pemesanans
        ]);
    }

    public function show(){}
    public function search(Request $request){
        $fromDate = $request->input('fromDate');
        $toDate = $request->input('toDate');

        $transactions = Booking::where('order_date','>=',$fromDate)
                    ->where('order_date','<=',$toDate)
                    ->where('status',"Sukses")
                    ->get();
        return view('pages.admin.pemasukan.index',compact('transactions'));
    }

    public function pdf(){
        $now = Carbon::now();
        $pemesanans = Booking::where('status',"Sukses")->orderBy('tanggal_pesan','ASC')->get();
        $total_harga = Booking::where('status',"Sukses")->sum('total_harga');

        $pdf = PDF::loadview('pages.admin.pemasukan.pemasukan_pdf',[
            'now' => $now,
            'total_harga' => $total_harga,
            'pemesanans' => $pemesanans
        ]);
        return $pdf->download('laporan-pemasukan.pdf');
    }

    public function pemesanans(){
        $pemesanans = Booking::where('status',"Sukses")->orderBy('tanggal_pesan','ASC')->get();
        return $pemesanans;
    }

    public function exportExcel(){
        return Excel::download(new PemasukanExport,'pemasukan.xlsx');
    }
}

// public function index(Request $request){
    //     $method = $request->method();

    //     if($request->isMethod('POST')){
    //         $from  = $request->input('from');
    //         $to = $request->input('to');
    //         if(!empty($from) && !empty($to)){
    //             if($request->has('search')){
    //                 $pemesanans = Booking::where('tanggal_pesan','>=',$from)
    //                     ->where('tanggal_pesan','<=',$to)
    //                     ->where('status',"Sukses")
    //                     ->get();
    //                 return view('pages.admin.pemasukan.index',[
    //                 'pemesanans' => $pemesanans]);
    //             }elseif($request->has('exportPDF')){
    //                 $now = Carbon::now();
    //                 $pemesanans = DB::table('bookings')->join('users','users.id','=','bookings.user_id')
    //                         ->whereBetween('tanggal_pesan',[$from,$to])
    //                         ->where('status',"Sukses")
    //                         ->get();
    //                 // $pemesanans = Booking::where('tanggal_pesan','>=',$from)
    //                 // ->where('tanggal_pesan','<=',$to)
    //                 // ->where('status',"Sukses")
    //                 // ->get();
    //                 dd($pemesanans);
    //                 $total_harga = Booking::where('status',"Sukses")->sum('total_harga');
    //                 $pdf = PDF::loadview('pages.admin.pemasukan.pemasukan_pdf',[
    //                     'now' => $now,
    //                     'total_harga' => $total_harga,
    //                     'pemesanans' => $pemesanans
    //                 ]);
    //                 return $pdf->download('laporan-pemasukan.pdf');
    //             }
    //         else{
    //             $now = Carbon::now();
    //             // $pemesanans = DB::table('bookings')->join('users','users.id','=','bookings.user_id')
    //             //         ->whereBetween('tanggal_pesan',[$from,$to])
    //             //         ->where('status',"Sukses")
    //             //         ->get();
    //             $pemesanans = Booking::where('tanggal_pesan','>=',$from)
    //             ->where('tanggal_pesan','<=',$to)
    //             ->where('status',"Sukses")
    //             ->get();
    //             dd($pemesanans);
    //             $total_harga = Booking::where('status',"Sukses")->sum('total_harga');
    //             $pdf = PDF::loadview('pages.admin.pemasukan.pemasukan_pdf',[
    //                 'now' => $now,
    //                 'total_harga' => $total_harga,
    //                 'pemesanans' => $pemesanans
    //             ]);
    //             return $pdf->download('laporan-pemasukan.pdf');
    //         }
    //     }
    //     }
    //     else{
    //         $pemesanans = Booking::where('status',"Sukses")->orderBy('tanggal_pesan','ASC')->get();
    //         return view('pages.admin.pemasukan.index',[
    //             'pemesanans' => $pemesanans
    //         ]);
    //     }
    // }
