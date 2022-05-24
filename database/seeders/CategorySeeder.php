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
        $category = [
            [
                'name' => 'Sweatshirts',
                'slug' => 'sweatshirts',
            ],
            [
                'name' => 'Tops',
                'slug' => 'tops',
            ],
            [
                'name' => 'Accessories',
                'slug' => 'accessories',
            ],
            [
                'name' => 'outerwear',
                'slug' => 'outerwear',
            ],
            [
                'name' => 'Bottoms',
                'slug' => 'bottoms',
            ],
            [
                'name' => 'Women',
                'slug' => 'women',
            ],
            
        ];
        DB::table('categories')->insert($category);
    }
}
