<?php

use Illuminate\Database\Seeder;

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
            [
                'id' => 1,
                'name' => 'Peter'
            ],
            [
                'id' => 2,
                'name' => 'Ann'
            ],
            [
                'id' => 3,
                'name' => 'David'
            ],
        ]);
    }
}
