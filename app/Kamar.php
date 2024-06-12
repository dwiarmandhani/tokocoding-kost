<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kamar extends Model
{
    protected $table = 'kamars';

    protected $fillable = [
        'tipe_kamar_id','nomor_kamar','tersedia'
    ];

    protected $hidden = [

    ];

    public function tipe_kamar(){
        return $this->belongsTo(TipeKamar::class);
    }

    public function bookings(){
        return $this->hasMany(Booking::class);
    }

}
