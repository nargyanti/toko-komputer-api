<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class ProductAssetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $product_assets =
        [
            [
                'id' => 1,
                'product_id' => 1,
                'image' => 'logitech-h111.png',   
                'user_id' => 1,             
            ],
            [
                'id' => 2,
                'product_id' => 1,
                'image' => 'logitech-h111-headset-stereo-single-jack-3-5mm.png',                
                'user_id' => 1,
            ],
            [
                'id' => 3,
                'product_id' => 2,
                'image' => 'philips-rice-cooker-inner-pot-2l-bakuhanseki-hd3110-33.png',                
                'user_id' => 1,
            ],
            [
                'id' => 4,
                'product_id' => 2,
                'image' => 'philips.png',                
                'user_id' => 1,
            ],
            [
                'id' => 5,
                'product_id' => 2,
                'image' => 'philips-rice-cooker.png',                
                'user_id' => 1,
            ],
            [
                'id' => 6,
                'product_id' => 3,
                'image' => 'iphone-12-64gb-128gb-256gb.png',
                'user_id' => 1,
            ],
            [
                'id' => 7,
                'product_id' => 4,
                'image' => 'papan-alat-bantu-push-up.png',                
                'user_id' => 1,
            ],
            [
                'id' => 8,
                'product_id' => 5,
                'image' => 'jim-joker-sandal-slide-kulit-pria-bold-2s-hitam-hitam.png',                
                'user_id' => 1,
            ],
        ];
        DB::table('product_assets')->insert($product_assets);
    }
}
