<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $table = 'bookings';

    protected $fillable = [
        'user_id','kamar_id','bukti_pembayaran','kode','tanggal_pesan','total_harga','durasi','tanggal_masuk','tanggal_keluar','status','expired_at'
    ];

    protected $hidden = [

    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function kamar(){
        return $this->belongsTo(Kamar::class);
    }

    public function review(){
        return $this->hasOne(Review::class);
    }
}
