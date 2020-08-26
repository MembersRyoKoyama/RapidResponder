<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Question;
use App\Product;
use Illuminate\Support\Facades\Artisan;

class QuestionDatabaseTest extends TestCase
{
    use RefreshDatabase;
    protected function setUp(): void
    {
        parent::setUp();
        $this->seed([
            'ProductTableSeeder',
            'UserTableSeeder',
            'TagTableSeeder',
        ]);
    }
    public function tearDown(): void
    {
        Artisan::call('migrate:refresh');
        parent::tearDown();
    }
    /**
     * A basic feature test example.
     *
     * @return void
     * @group questiondatabase
     */
    public function testQuestionDatabase()
    {
        $question = factory(Question::class)->make([
            'id' => '1',
            'end'  =>  '1',
        ]);
        $questionContents = [
            'name' => $question->name,
            'mail' => $question->mail,
            'tel'  => $question->tel,
            'products_id' => $question->products_id,
            'content'     => $question->content,
            'end'         => $question->end,
            'tags'  => [1],
        ];
        $tagContents = [
            'questions_id' => $question->id,
            'tags_id'      => 1,
        ];
        // $tagcontent = ['tags'  => [1]];
        $this->post("/question/send", $questionContents)
            ->assertOk();
        //eval(\Psy\sh());
        //array_poで配列の末尾（tag）を削除
        array_pop($questionContents);
        $this->assertDatabaseHas('questions', $questionContents);
        $this->assertDatabaseHas('questions_tags', $tagContents);
    }
}
