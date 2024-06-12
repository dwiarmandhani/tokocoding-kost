<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class PengeluaranEditRequest extends FormRequest
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
            'deskripsi' => 'required|string',
            'nominal' => 'required|numeric',
            'tanggal' => 'required|date',
            'foto' => 'image','mimes:png,jpg,jpeg','max:2048'
        ];
    }

    public function messages()
    {
        return [
            'deskripsi.required' => 'Deskripsi tidak boleh kosong',
            'deskripsi.string' => 'Deskripsi harus berupa huruf',
            'nominal.required' => 'Nominal tidak boleh kosong',
            'nominal.numeric' => 'Nominal harus berupa angka',
            'tanggal.required' => 'Tanggal tidak boleh kosong',
            'tanggal.date' => 'Tanggal harus berupa tanggal',
            'foto.image' => 'Foto harus berupa gambar',
            'foto.mimes' => 'Format foto harus berupa file png,jpg, atau jpeg',
            'foto.max' => 'Ukuran foto tidak boleh lebih dari 2 MB'
        ];
    }
}
