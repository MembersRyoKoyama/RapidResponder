<?php

use Illuminate\Database\Seeder;

class TagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $tag_name = ['初期不良', 'パーツ欠損', '故障', '老朽化', '疑問点・質問', 'その他'];
        for ($i = 0; $i < count($tag_name); $i++) {
            DB::table('tags')->insert(['name' => $tag_name[$i]]);
        }
    }
}
