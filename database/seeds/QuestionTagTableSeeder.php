<?php

use Illuminate\Database\Seeder;

class QuestionTagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $questionsNum = count(App\Question::pluck('id')->all());
        $tagsNum = count(App\Tag::pluck('id')->all());
        $n = [1, 2, 3, 4, 5, 6];
        for ($i = 1; $i <= $questionsNum; ++$i) {
            shuffle($n);
            $t = random_int(0, $tagsNum - 1);
            for ($j = 0; $j <= $t; ++$j) {
                DB::table('questions_tags')
                    ->insert([
                        'questions_id' => $i,
                        'tags_id' => $n[$j],
                    ]);
            }
        }
    }
}
