<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    public $redirectTo = '/email/verify';
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string','min:3','max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users','regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix'],
            'password' => ['required', 'string', 'min:8'],
            'no_hp' => ['required','numeric', 'digits_between:10,13','unique:users'],
        ],[
            'name.required' => 'Nama lengkap tidak boleh kosong',
            'name.min' => 'Nama lengkap tidak boleh kurang dari 3 karakter',
            'name.max' => 'Nama lengkap tidak boleh lebih dari 255 karakter',
            'name.string' => 'Nama lengkap harus berupa huruf',
            'email.required' => 'Email tidak boleh kosong',
            'email.string' => 'Email harus berupa huruf atau angka',
            'email.min' => 'Email tidak boleh kurang dari 11 karakter',
            'email.email' => 'Email tidak valid',
            'email.regex' => 'Masukkan email yang benar',
            'email.unique' => 'Email sudah terdaftar, silakan gunakan email lain',
            'no_hp.digits_between' => 'No telp tidak boleh kurang dari 11 angka dan lebih dari 13 angka',
            'no_hp.required' =>  'No telp tidak boleh kosong',
            'no_hp.numeric' => 'No telp harus berisi angka',
            'no_hp.unique' => 'No telp sudah ada, masukkan no telp yang lain',
            'password.string' => 'Kata sandi harus berupa huruf atau angka',
            'password.min' => 'Kata sandi tidak boleh kurang dari 8 karakter',
            'password.required' => 'Kata sandi tidak boleh kosong',
        ]);
    }

    protected function create(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'no_hp' => $data['no_hp'],
        ]);

        $user->assignRole('user');
        return $user;
    }
}

// 'alamat' => ['required','string'],
// 'pekerjaan' => ['required','alpha'],
// 'foto_ktp' => ['required','image','mimes:png,jpg,jpeg','max:2048'],
// 'alamat.required' => 'Alamat asal tidak boleh kosong',
// 'alamat.string' => 'Alamat asal harus berupa huruf',
// 'pekerjaan.required' => 'Pekerjaan tidak boleh kosong',
// 'pekerjaan.alpha' => 'Pekerjaan harus berupa huruf',
// 'foto_ktp.required' => 'Foto ktp tidak boleh kosong',
// 'foto_ktp.mimes' => 'Foto ktp harus berupa file png,jpg, atau jpeg',
// 'foto_ktp.max' => 'Ukuran foto ktp tidak boleh lebih dari 2MB',
// 'foto_ktp.image' => 'Foto Ktp harus berupa gambar'
// 'alamat' => $data['alamat'],
// 'pekerjaan' => $data['pekerjaan'],
// if(request()->hasFile('foto_ktp')){
//     $foto_ktp = request()->file('foto_ktp')->store('assets/user','public');
//     $user->update(['foto_ktp' => $foto_ktp]);
// }
