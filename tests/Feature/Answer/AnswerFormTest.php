<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Artisan;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Tests\TestCase;
use App\Question;
use App\User;
use App\Product;
use App\Answer;
use Faker\Generator as Faker;

class AnswerFormTest extends TestCase
{
    use RefreshDatabase;
    protected function setUp(): void
    {
        parent::setUp();
        $this->seed([
            'ProductTableSeeder',
        ]);
    }
    public function tearDown(): void
    {
        Artisan::call('migrate:refresh');
        parent::tearDown();
    }
    /**
     * @group formTest
     * フォーム入力後の表示テスト
     * @test
     */
    public function answerFormAvailableContents()
    {
        $user1 = factory(User::class)->create();
        //$user2 = factory(User::class)->create();

        $question = factory(Question::class)->create([
            'staffs_id' => $user1->id,
            'end' => 2,
        ]);

        $answer = factory(Answer::class)->make();
        $answerContents = [
            'message' => $answer->message,
            'comment' => $answer->comment,
        ];
        $this->actingAs($user1)
            ->withSession(['questions_id' => $question->id])
            ->post("answerConfirmation", $answerContents)
            ->assertOk()
            ->assertSeeInOrder($answerContents);
    }
    /**
     * @group formTest
     * フォームに想定外の値を投げるテスト
     * @test
     */
    public function answerFormUnavailableContents()
    {

        $user1 = factory(User::class)->create();
        //$user2 = factory(User::class)->create();

        $question = factory(Question::class)->create([
            'staffs_id' => $user1->id,
            'end' => 2,
        ]);

        $answer = factory(Answer::class)->make();
        $answerContents = [
            'message' => $answer->message . $answer->message,
            'comment' => $answer->comment,
        ];
        $this->actingAs($user1)
            ->withSession(['questions_id' => $question->id])
            ->post("answerConfirmation", $answerContents)
            ->assertRedirect();
    }
    /**
     * @group formTest
     * ダメなユーザーがフォームに想定の値を投げるテスト
     * @test
     */
    public function answerFormUnavailableUser()
    {

        $user1 = factory(User::class)->create();
        $user2 = factory(User::class)->create();
        eval(\Psy\sh());
        $question = factory(Question::class)->create([
            'staffs_id' => $user1->id,
            'end' => 2,
        ]);

        $answer = factory(Answer::class)->make();
        $answerContents = [
            'message' => $answer->message,
            'comment' => $answer->comment,
        ];
        $this->actingAs($user2)
            ->withSession(['questions_id' => $question->id])
            ->post("answerConfirmation", $answerContents)
            ->assertRedirect();
    }
}
