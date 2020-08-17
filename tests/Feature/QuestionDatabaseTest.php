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
            'UserTableSeeder'
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
            'name' => 'abcde',
            'mail' => 'taylor@laravel.com',
            'end'  =>  '1',
        ]);

        $questionContents = [
            'name' => $question->name,
            'mail' => $question->mail,
            'tel'  => $question->tel,
            'products_id' => $question->products_id,
            'content'     => '1',
            'end'         => $question->end,
        ];
        $this->post("/question/send", $questionContents)
            ->assertOk();
        $this->assertDatabaseHas('questions', $questionContents);
    }
}
