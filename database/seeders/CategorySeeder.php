<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories =
        [
            [
                'id' => 1,
                'user_id' => 1,
                'name' => 'Elektronik',                
            ],
            [
                'id' => 2,
                'user_id' => 1,
                'name' => 'Fashion Pria',                
            ],
            [
                'id' => 3,
                'user_id' => 1,
                'name' => 'Fashion Wanita',                
            ],
            [
                'id' => 4,
                'user_id' => 1,
                'name' => 'Handphone & Tablet',                
            ],
            [
                'id' => 5,
                'user_id' => 1,
                'name' => 'Olahraga',                
            ],
        ];
        DB::table('categories')->insert($categories);
    }
}
