<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fasilitas extends Model
{
    protected $table = 'fasilitas';

    protected $fillable = [
        'nama','icon'
    ];

    protected $hidden = [

    ];

    public function tipe_kamars(){
        return $this->belongsToMany('App\TipeKamar','detail_fasilitas')->withTimestamps();
    }
}
