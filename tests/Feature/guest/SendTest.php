<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Http\Controllers\QuestionsController;

class SendTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @test
     * 
     */

    public function testSend()
    {
        $response = $this->get('/question/send');
        $response->assertStatus(302)
            ->assertRedirect('/question');
    }
}
