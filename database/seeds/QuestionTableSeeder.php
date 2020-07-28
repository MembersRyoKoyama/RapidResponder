<?php

use Illuminate\Database\Seeder;

class QuestionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $num = 10;
        $staffs = App\User::pluck('id')->all();
        $products = App\Product::pluck('id')->all();
        //end=3;staff=5;
        for ($i = 1; $i <= 3; $i++) {
            for ($j = 0; $j < 10; $j++) {
                $staffs_id = $i != 1 ? $staffs[$j % count($staffs)] : null;
                factory(App\Question::class)->create([
                    'products_id' => $products[random_int(0, count($products) - 1)],
                    'end' => $i,
                    'staffs_id' => $staffs_id,
                ]);
            }
        }
    }
}
