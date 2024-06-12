<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class KamarRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nomor_kamar' => 'required|numeric|unique:kamars,nomor_kamar',
        ];
    }

    public function messages(){
        return[
            'nomor_kamar.required' => 'Nomor kamar harus diisi',
            'nomor_kamar.numeric' => 'Nomor kamar harus berformat angka',
            'nomor_kamar.unique' => 'Nomor kamar sudah ada, silakan masukkan nomor lain',
        ];
    }
}
