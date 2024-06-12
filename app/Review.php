<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $table = 'reviews';

    protected $fillable = [
        'review','booking_id'
    ];

    protected $hidden = [

    ];

    public function booking(){
        return $this->belongsTo(Booking::class);
    }
}
