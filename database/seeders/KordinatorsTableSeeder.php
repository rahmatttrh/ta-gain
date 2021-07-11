<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KordinatorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('kordinators')->insert([
            'nama' => 'Agus P',
            'no_hp' => '08213344544',
            'email' => 'agus@gmail.com',
            'foto_ktp' => 'images/ktp/NkyjFtI76liq4tOcjG9H5lS4cyEWNO0r7HNGiudJ.jpg',
            'foto_diri' => 'images/diri/l74XxqTXo8mWBgyD0SOnFuUyacqCTlIonSxgSpbp.jpg',
            'area' => 'Papua',
            'no_rek' => '0123212210'
        ]);
        DB::table('kordinators')->insert([
            'nama' => 'Hendra S',
            'no_hp' => '089993455',
            'email' => 'hendra@gmail.com',
            'foto_ktp' => 'images/ktp/NkyjFtI76liq4tOcjG9H5lS4cyEWNO0r7HNGiudJ.jpg',
            'foto_diri' => 'images/diri/l74XxqTXo8mWBgyD0SOnFuUyacqCTlIonSxgSpbp.jpg',
            'area' => 'Jawa Barat',
            'no_rek' => '0123212210'
        ]);
    }
}
