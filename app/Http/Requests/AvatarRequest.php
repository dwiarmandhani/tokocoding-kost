<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AvatarRequest extends FormRequest
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
            'avatar' => 'required|image|mimes:png,jpg,jpeg|max:2048',
        ];
    }

    public function messages()
    {
        return [
            'avatar.required' => 'Foto profil tidak boleh kosong',
            'avatar.image' => 'Foto profil harus berupa gambar',
            'avatar.mimes' => 'Format foto harus berupa png, jpg, jpeg',
            'avatar.max' => 'Ukuran foto tidak boleh lebih dari 2 MB'
        ];
    }
}
