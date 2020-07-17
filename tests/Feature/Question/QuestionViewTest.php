<?php

namespace Tests\Feature\Question;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Question;

class QuestionViewTest extends TestCase
{
    /**
     * 質問詳細表示テスト
     * @test
     */
    public function availableId()
    {
        $questions_id = Question::pluck('id')->all();
        foreach ($questions_id as $id) {
            $response = $this->get('/questionView?id=' . $id);
            $response->assertStatus(200);
        }
    }

    public function unavailableId()
    {
        $questions_id = Question::pluck('id')->all();
        foreach ($questions_id as $id) {
            $response = $this->get('/questionView?id=' . $id);
            $response->assertStatus(302);
        }
    }
}
