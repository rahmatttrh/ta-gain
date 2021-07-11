<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PelanggansTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pelanggans')->insert([
            'nama' => 'PT. Telkom',
            'email' => 'telkom@gmail.com',
            'alamat' => 'Jakarta Pusat',
            'nama_pm' => 'Agus',
            'no_pm' => '082121231333',
            'nama_gm' => 'Budi',
            'no_gm' => '082121367677'
        ]);
        DB::table('pelanggans')->insert([
            'nama' => 'PT. Indosat',
            'email' => 'indosat@gmail.com',
            'alamat' => 'Bogor',
            'nama_pm' => 'Widya',
            'no_pm' => '0899939383',
            'nama_gm' => 'Hendra',
            'no_gm' => '0857577744'
        ]);
    }
}
