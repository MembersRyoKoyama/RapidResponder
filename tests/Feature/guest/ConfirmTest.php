<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Http\Controllers\QuestionsController;
use App\Question;

class ConfirmTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testConfirm()
    {
        $response = $this->get('/question/confirm');
        $response->assertStatus(302)
            ->assertRedirect('/question');
    }
}
