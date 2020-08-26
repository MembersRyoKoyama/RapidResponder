<?php

namespace Tests\Feature\Answer;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Artisan;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Tests\TestCase;
use App\Question;
use App\User;
use App\Product;
use App\Answer;

class AnswerStoreTest extends TestCase
{
    use DatabaseMigrations;
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
     * @group answerTest
     * answer投稿テスト（可能ユーザー）
     * @test
     */
    public function answerAvailableUser()
    {
        $user1 = factory(User::class)->create();
        //$user2 = factory(User::class)->create();

        $question = factory(Question::class)->create([
            'staffs_id' => $user1->id,
            'end' => 2,
        ]);
        eval(\Psy\sh());
        $answer = factory(Answer::class)->make([
            "comment" => "comment",
            "message" => "message",
        ])->toArray();
        unset($answer['date']);
        // $answerContents = [
        //     'message' => $answer->message,
        //     'comment' => $answer->comment,
        // ];
        $this->actingAs($user1)
            ->withSession(['questions_id' => $question->id])
            ->post("answerStoreComplete", $answer)
            ->assertOk();
        $this->assertDatabaseHas('answers', $answer);
    }
    /**
     * @group answerTest
     * answer投稿テスト（不可能ユーザー）
     * @test
     */
    public function answerUnavailableUser()
    {
        $user1 = factory(User::class)->create();
        $user2 = factory(User::class)->create();

        $question = factory(Question::class)->create([
            'staffs_id' => $user1->id,
            'end' => 2,
        ]);

        $answer = factory(Answer::class)->make()->toArray();
        $this->actingAs($user2)
            ->withSession(['questions_id' => $question->id])
            ->post("answerStoreComplete", $answer)
            ->assertRedirect();
        $this->assertDatabaseMissing('answers', $answer);
    }
}
