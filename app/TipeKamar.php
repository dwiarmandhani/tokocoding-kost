<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipeKamar extends Model
{
    protected $table = 'tipe_kamars';

    protected $fillable = [
        'nama','lantai','harga','ukuran'
    ];

    public function galeri(){
        return $this->hasMany(GaleriKamar::class,'tipe_kamar_id','id');
    }

    public function kamars()
    {
        return $this->hasMany(Kamar::class);
    }

    public function fasilitas()
    {
        return $this->belongsToMany('App\Fasilitas', 'detail_fasilitas')->withTimestamps();
    }
}
