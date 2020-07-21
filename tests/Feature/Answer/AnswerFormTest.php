<?php

namespace Tests\Feature\Answer;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;
use App\Question;
use App\User;
use App\Product;
use App\Answer;

class AnswerFormTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        //parent::tearDown();
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
     * 
     */
    public function answerAvailableUser()
    {
        $user1 = factory(User::class)->create();
        $answer = factory(Answer::class)->make();
        //$user2 = factory(User::class)->create();

        $question = factory(Question::class)->create([
            'staffs_id' => $user1->id,
            'end' => 2,
        ]);

        $this->actingAs($user1)
            ->post("answerConfirmation", [
                'message' => $answer->message,
                'comment' => $answer->comment,
            ])
            ->assertOk();
    }
}
