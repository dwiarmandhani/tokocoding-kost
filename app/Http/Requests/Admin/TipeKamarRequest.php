<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class TipeKamarRequest extends FormRequest
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
            'nama' => 'required|string',
            'foto' => 'required|image|max:2048|mimes:png,jpg,jpeg',
            'lantai' => 'required|integer',
            'harga' => 'required|integer',
            'ukuran' => 'required|string',
            'fasilitas' => 'array',
        ];
    }

    public function messages()
    {
        return [
            'nama.required' => 'Nama kamar harus diisi',
            'nama.string' => 'Nama kamar harus berupa huruf',
            'foto.required' => 'Foto kamar harus diisi',
            'foto.image' => 'Foto harus berupa image',
            'foto.mimes' => 'Foto harus berformat png, jpg, atau jpeg',
            'foto.max' => 'Foto berukuran maksimal 2 MB',
            'lantai.required' => 'Lantai kamar harus diisi',
            'lantai.integer' => 'Lantai kamar harus berupa angka',
            'harga.required' => 'Harga kamar harus diisi',
            'harga.integer' => 'Harga kamar harus berupa angka',
            'ukuran.required' => 'Ukuran kamar harus diisi',
            'ukuran.integer' => 'Ukuran kamar harus berupa angka atau huruf',
            'fasilitas.array' => 'Fasilitas harus berupa array',
        ];
    }
}
