<?php

namespace App\Http\Controllers;

use App\TipeKamar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DetailController extends Controller
{

    public function detail(Request $request, $id)
    {
        $user = Auth::user();
        $tipe_kamars = TipeKamar::where('id',$id)->get();
        $fasilitas = TipeKamar::with('fasilitas')->get();
        return view('detail-kost', [
            'user' => $user,
            'tipe_kamars' => $tipe_kamars,
            'fasilitas' => $fasilitas,
        ]);
    }
}
