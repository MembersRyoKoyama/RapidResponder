<?php

use Illuminate\Database\Seeder;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=1;$i<=16;$i++){
            DB::table('products')->insert(['name' => 'A0'.str_pad($i, 2, 0, STR_PAD_LEFT),]);
        }
    }
}
