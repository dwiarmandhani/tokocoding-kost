<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailBookings extends Model
{
    protected $table = 'detail_bookings';

    protected $fillable = [
        'booking_id','user_id'
    ];

    protected $hidden = [

    ];
}
