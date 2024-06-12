<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailFasilitas extends Model
{
    protected $table = 'detail_fasilitas';

    protected $fillable = [
        'fasilitas_id','kamar_id'
    ];

    protected $hidden = [

    ];
}
