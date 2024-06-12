<?php

namespace App\Rules;

use Carbon\Carbon;
use Illuminate\Contracts\Validation\Rule;

class Booking implements Rule
{
    protected $tipe_kamar;
    protected $new_tanggal_masuk;
    protected $new_tanggal_keluar;
    protected $message;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($tipe_kamar, $new_tanggal_masuk, $new_tanggal_keluar)
    {
        $this->tipe_kamar = $tipe_kamar;
        $this->new_tanggal_masuk = $new_tanggal_masuk;
        $this->new_tanggal_keluar = $new_tanggal_keluar;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return $this->kamar_tersedia();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Maaf, tidak ada kamar yang tersedia saat ini. Silakan pilih tipe kamar yang lain.';
    }

    public function kamar_tersedia(){
        $this->kamar_exist();

        foreach ($this->tipe_kamar->kamars as $kamar) {
            if($kamar->status == "Kosong"){
                if($this->kamar_bookings_exist($kamar)){
                    if($this->kamar_bookings_check($kamar->bookings) == "Dipesan"){
                    continue;
                    }
                }
                return true;
            }
        }
    }

    public function available_nomor_kamar(){
        $this->kamar_exist();
        foreach ($this->tipe_kamar->kamars as $kamar) {
            if($kamar->status == "Kosong"){
                if($this->kamar_bookings_exist($kamar)){
                    if($this->kamar_bookings_check($kamar->bookings) == "Dipesan")
                    continue;
                }
                return $kamar->nomor_kamar;
            }
        }
    }

    protected function kamar_exist(){
        if(count($this->tipe_kamar->kamars) > 0){
            return true;
        }
        $this->message = "Maaf tidak ada kamar yang tersedia";
        return false;
    }

    protected function kamar_bookings_exist($kamar){
        if(count($kamar->bookings) > 0){
            return true;
        }
    }

    protected function kamar_bookings_check($bookings)
    {
        foreach ($bookings as $bookingg) {
            $old_tanggal_masuk = Carbon::parse($bookingg->tanggal_masuk);
            $old_tanggal_keluar = Carbon::parse($bookingg->tanggal_keluar);
            if($this->new_tanggal_masuk < $old_tanggal_masuk){
                if($this->new_tanggal_keluar > $old_tanggal_keluar){
                return false;
                }
            } elseif ($this->new_tanggal_masuk > $old_tanggal_masuk){
                if($this->new_tanggal_keluar < $old_tanggal_keluar){
                return false;
                }
            } elseif ($this->new_tanggal_masuk == $old_tanggal_masuk){
                return false;
            }
        }
        return true;
    }
}

