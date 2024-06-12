<?php

use App\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'email_verified_at' => Carbon::now(),
            'password' => bcrypt('12345678'),
            'foto_ktp' => "",
            'no_hp' => '085721813979',
            'alamat' => 'Bandung',
            'pekerjaan' => 'Admin TokoCodingKost',
            'bank' => 'BCA',
            'no_rekening' => '12345678',
            'avatar' => "",
            'status' => 1,
        ]);

        $admin->assignRole('admin');

        $user = User::create([
            'name' => 'User',
            'email' => 'user@gmail.com',
            'email_verified_at' => Carbon::now(),
            'password' => bcrypt('12345678'),
            'no_hp' => '085158803979',
            'foto_ktp' => "",
            'alamat' => 'Bandung',
            'pekerjaan' => 'Pencati Kost',
            'bank' => 'BCA',
            'no_rekening' => '12345678',
            'avatar' => "",
            'status' => 1,
        ]);

        $user->assignRole('user');
    }
}
