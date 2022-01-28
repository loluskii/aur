<?php

namespace Database\Seeders;

use DateTime;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = [
            [
                'name' => "MEN'S BETTER THAN NAKED & JACKET",
                'tag_number' => rand(10101,99999),
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                tempor incididunt ut labore et dolore magna aliqua consequat.',
                'units' => 21,
                'price' => 200.10,
                'image' => 'a1.jpg',
                'created_at' => new DateTime,
                'updated_at' => null,
            ],
            [
                'name' => "WOMEN'S BETTER THAN NAKED™ JACKET",
                'tag_number' => rand(10101,99999),
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                tempor incididunt ut labore et dolore magna aliqua consequat.',
                'units' => 400,
                'price' => 1600.21,
                'image' => 'b1.jpg',
                'created_at' => new DateTime,
                'updated_at' => null,
            ],
            [
                'name' => "WOMEN'S SINGLE-TRACK SHOE",
                'tag_number' => rand(10101,99999),
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                tempor incididunt ut labore et dolore magna aliqua consequat.',
                'units' => 37,
                'price' => 378.00,
                'image' => 'c3.jpg',
                'created_at' => new DateTime,
                'updated_at' => null,
            ],
            [
                'name' => "MEN'S BETTER THAN NAKED & JACKET",
                'tag_number' => rand(10101,99999),
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                tempor incididunt ut labore et dolore magna aliqua consequat.',
                'units' => 21,
                'price' => 200.10,
                'image' => 'a1.jpg',
                'created_at' => new DateTime,
                'updated_at' => null,
            ],
            [
                'name' => "WOMEN'S BETTER THAN NAKED™ JACKET",
                'tag_number' => rand(10101,99999),
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                tempor incididunt ut labore et dolore magna aliqua consequat.',
                'units' => 400,
                'price' => 1600.21,
                'image' => 'b1.jpg',
                'created_at' => new DateTime,
                'updated_at' => null,
            ],
            [
                'name' => "WOMEN'S SINGLE-TRACK SHOE",
                'tag_number' => rand(10101,99999),
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                tempor incididunt ut labore et dolore magna aliqua consequat.',
                'units' => 37,
                'price' => 378.00,
                'image' => 'c3.jpg',
                'created_at' => new DateTime,
                'updated_at' => null,
            ],

        ];
        DB::table('products')->insert($products);
    }
}
