<?php

use Illuminate\Database\Seeder;

class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('orders')->insert([
            [
                'id' => 1,
                'quantity' => 2,
                'date' => '2017-01-24',
                'user_id' => 1,
                'product_id' => 2
            ],
            [
                'id' => 2,
                'quantity' => 3,
                'date' => '2017-01-25',
                'user_id' => 1,
                'product_id' => 3
            ],
            [
                'id' => 3,
                'quantity' => 1,
                'date' => '2017-01-26',
                'user_id' => 1,
                'product_id' => 1
            ],
            [
                'id' => 4,
                'quantity' => 1,
                'date' => date('Y-m-d'),
                'user_id' => 2,
                'product_id' => 2
            ],
        ]);
    }
}
