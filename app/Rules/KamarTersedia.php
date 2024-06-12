<?php

namespace App\Rules;

use App\Rules\Booking;
use Illuminate\Contracts\Validation\Rule;
use Carbon\Carbon;

class KamarTersedia implements Rule
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
        $booking = new Booking($this->tipe_kamar, $this->new_tanggal_masuk, $this->new_tanggal_keluar);
        return $booking->kamar_tersedia();
    }
}
