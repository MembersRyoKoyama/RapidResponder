<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Http\Controllers\QuestionsController;

class ConfirmTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
    public function testConfirm()
    {
        $QuestionsController = new QuestionsController;
        $questions = $QuestionsController->id('1'); 

        $this->post('/questions', $questions);
            ->assertSee('村山 康弘');

    }
}
