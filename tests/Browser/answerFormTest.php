<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Question;
use App\User;
use App\Product;
use App\Answer;

class answerFormTest extends DuskTestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        //parent::tearDown();
    }
    public function tearDown(): void
    {
        Artisan::call('migrate:refresh');
        parent::tearDown();
    }
    /**
     * @group formTest
     * A Dusk test example.
     * @test
     */
    public function answerAvailableUser()
    {
        $user1 = factory(User::class)->create();
        $this->browse(function (Browser $browser) {
            $browser->click('@dummyFormButton')
                ->type('message', 'uaa')
                ->type('comment', 'aaa')
                ->click('@submitButton');
        });
    }
}
