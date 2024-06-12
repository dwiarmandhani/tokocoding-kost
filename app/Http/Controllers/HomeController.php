<?php

namespace App\Http\Controllers;

use App\Kamar;
use App\Review;
use App\TipeKamar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware(['auth','verified']);
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $reviews = Review::latest()->take(5)->get();
        $tipe_kamars = TipeKamar::with('galeri')->get();
        $kamars = TipeKamar::with('kamars')->get();
        $kamar = Kamar::where('status',"Kosong")->count();
        $kam = Kamar::count();
        return view('landing',[
            'reviews' => $reviews,
            'tipe_kamars' => $tipe_kamars,
            'kamars' => $kamars,
            'kamar' => $kamar,
            'kam' => $kam,
        ]);
    }
}
