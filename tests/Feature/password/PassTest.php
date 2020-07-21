<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PassTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testChange()
    {
        $response = $this->get('/change');
        $response->assertStatus(200);
    }
    /*public function testEnd()
    {
        $response = $this->get('/end');
        $response->assertStatus(200);
    }*/
}
