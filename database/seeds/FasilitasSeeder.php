<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class FasilitasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('fasilitas')->insert([
            [
                'nama' => 'Meja',
                'created_at' => Carbon::now(),
            ],
            [
                'nama' => 'Kursi',
                'created_at' => Carbon::now(),
            ],
            [
                'nama' => 'Kamar Mandi Dalam',
                'created_at' => Carbon::now(),
            ],
            [
                'nama' => 'Kamar Mandi Luar',
                'created_at' => Carbon::now(),
            ],
            [
                'nama' => 'Kasur',
                'created_at' => Carbon::now(),
            ],
            [
                'nama' => 'Kipas Angin',
                'created_at' => Carbon::now(),
            ],
        ]);
    }
}
