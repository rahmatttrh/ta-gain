<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TeknisisTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        DB::table('teknisis')->insert([
            'nama' => 'Ahmad Santoso',
            'no_hp' => '08213231833',
            'email' => 'ahmad@gmail.com',
            'foto_ktp' => 'images/ktp/NkyjFtI76liq4tOcjG9H5lS4cyEWNO0r7HNGiudJ.jpg',
            'foto_diri' => 'images/diri/l74XxqTXo8mWBgyD0SOnFuUyacqCTlIonSxgSpbp.jpg',
            'latitude' => '-6.914744',
            'longitude' => '107.609811',
            'area' => 'Sulawesi',
            'no_rek' => '342342211'
        ]);
        DB::table('teknisis')->insert([
            'nama' => 'Rizki Fauzi',
            'no_hp' => '08999393334',
            'email' => 'rizki@gmail.com',
            'foto_ktp' => 'images/ktp/NkyjFtI76liq4tOcjG9H5lS4cyEWNO0r7HNGiudJ.jpg',
            'foto_diri' => 'images/diri/l74XxqTXo8mWBgyD0SOnFuUyacqCTlIonSxgSpbp.jpg',
            'latitude' => '-6.966667',
            'longitude' => '110.416664',
            'area' => 'Jawa Barat',
            'no_rek' => '1122220099'
        ]);
        DB::table('teknisis')->insert([
            'nama' => 'Rahmat Hidayat',
            'no_hp' => '087736464334',
            'email' => 'rahmat@gmail.com',
            'foto_ktp' => 'images/ktp/NkyjFtI76liq4tOcjG9H5lS4cyEWNO0r7HNGiudJ.jpg',
            'foto_diri' => 'images/diri/l74XxqTXo8mWBgyD0SOnFuUyacqCTlIonSxgSpbp.jpg',
            'latitude' => '-6.595038',
            'longitude' => '106.816635',
            'area' => 'Papua',
            'no_rek' => '994854343'
        ]);
    }
}
