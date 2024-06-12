<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'name' => 'required|string',
            'email' => 'required|email',
            'password' => 'required|string','min:8','confirmed',
            'password-confirmation' => 'required|same:password',
        ];
    }

    // public function messages()
    // {
    //     return [
    //         'photo_ktp' => 'required|image',
    //         'password.required' =>'Kata sandi tidak boleh kosong',
    //         'password.min' => 'kata sandi tidak boleh kurang dari 8 karakter',
    //         'password-confirmation.required' => 'konfirmasi kata sandi tidak boleh kosong',
    //         'password-confirmation.same' => 'konfirmasi sandi tidak sama',
    //         'photo_ktp.required' => 'foto ktp tidak boleh kosong'
    //     ];
    // }
}
