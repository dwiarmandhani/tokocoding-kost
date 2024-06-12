<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class FasilitasRequest extends FormRequest
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
            'nama' => 'required|string|unique:fasilitas',
            'icon' => 'required|image|mimes:png,jpg,svg|max:2048'
        ];
    }

    public function messages()
    {
        return [
            'nama.required' => 'Fasilitas harus diisi',
            'nama.string' => 'Fasilitas harus berbentuk huruf',
            'nama.unique' => 'Fasilitas sudah tersedia',
            'icon.required' => 'Icon harus diisi',
            'icon.image' => 'Icon harus berupa image',
            'icon.mimes' => 'Icon harus berformat png jpg svg',
            'icon.max' => 'Ukuran icon maksimal 2MB'
        ];
    }
}
