<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Laravel\Dusk\Chrome;

class ResetMailTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     * @group reset
     */
    public function testResetMail()
    {
        $user1 = factory(User::class)->create();
        $this->browse(function ($browser) {
            $browser->visit('/login')
                ->assertPathIs('/login');
            //->ensurejQueryIsAvailable();
            /*->assertSeeLink()
                ->clickLink()*/
            //->assertDontSeeLink('/')
            /*->press("password-forget")
                ->assertPathIs('/password/reset');*/
        });
    }
}
