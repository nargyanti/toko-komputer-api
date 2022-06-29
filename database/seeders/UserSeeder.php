<?php

namespace Database\Seeders;

use DB;
use Hash;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([            
            'name' => 'Admin Toko Komputer',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('12345678'),            
        ]);
    }
}
