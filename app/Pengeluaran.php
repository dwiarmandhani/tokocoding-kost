<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pengeluaran extends Model
{
    protected $table = 'pengeluarans';

    protected $fillable = [
        'deskripsi','tanggal','nominal','foto'
    ];

    protected $hidden = [

    ];
}
