<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('12345678'),
            'level' => 'admin'
        ]);

        DB::table('users')->insert([
            'name' => 'PT. Telkom',
            'email' => 'telkom@gmail.com',
            'password' => Hash::make('12345678'),
            'level' => 'client'
        ]);
        DB::table('users')->insert([
            'name' => 'PT. Indosat',
            'email' => 'indosat@gmail.com',
            'password' => Hash::make('12345678'),
            'level' => 'client'
        ]);

        DB::table('users')->insert([
            'name' => 'Agus P',
            'email' => 'agus@gmail.com',
            'password' => Hash::make('12345678'),
            'level' => 'kordinator'
        ]);
        DB::table('users')->insert([
            'name' => 'Hendra S',
            'email' => 'hendra@gmail.com',
            'password' => Hash::make('12345678'),
            'level' => 'kordinator'
        ]);

        DB::table('users')->insert([
            'name' => 'Ahmad Santoso',
            'email' => 'ahmad@gmail.com',
            'password' => Hash::make('12345678'),
            'level' => 'teknisi'
        ]);
        DB::table('users')->insert([
            'name' => 'Rizki Fauzi',
            'email' => 'rizki@gmail.com',
            'password' => Hash::make('12345678'),
            'level' => 'teknisi'
        ]);
        DB::table('users')->insert([
            'name' => 'Rahmat Hidayat',
            'email' => 'rahmat@gmail.com',
            'password' => Hash::make('12345678'),
            'level' => 'teknisi'
        ]);
    }
}
