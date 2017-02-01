<?php

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            [
                'id' => 1,
                'price' => 10,
                'name' => 'apple'
            ],
            [
                'id' => 2,
                'price' => 12.5,
                'name' => 'orange'
            ],
            [
                'id' => 3,
                'price' => 6,
                'name' => 'potato'
            ],
        ]);
    }
}
