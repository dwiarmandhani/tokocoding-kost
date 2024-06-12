<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GaleriKamar extends Model
{
    protected $table = 'galeri_kamars';

    protected $fillable = [
        'foto','tipe_kamar_id'
    ];

    protected $hidden = [

    ];

    public function tipe(){
        return $this->belongsTo(TipeKamar::class,'tipe_kamar_id','id');
    }
}
