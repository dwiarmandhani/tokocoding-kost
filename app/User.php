<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'no_hp','alamat','pekerjaan','bank','no_rekening','foto_ktp','avatar','status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function tipe_kamar(){
        return $this->belongsTo(TipeKamar::class);
    }

    public function bookings(){
        return $this->hasMany(Booking::class);
    }

    public function initials()
    {
        $words = explode(" ", trim($this->name) );
        return $words[0];
    }

    public function usernamee(){
        $word = explode(" ", $this->name );
        $initials = null;
        foreach ($word as $w) {
            $initials .= $w[0];
        }
        return strtoupper($initials);
    }

    public function getProfilePhotoAttribute()
    {
        $avatar = null;
        if($this->avatar == 'avatar'){
            $avatar = public_path('assets/storage/assets/avatar/'.$this->avatar);
        }
        return $avatar;
    }
}
