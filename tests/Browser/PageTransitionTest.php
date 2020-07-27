<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class PageTransitionTest extends DuskTestCase
{
    /**
     * @group transitionTest
     * A Dusk test example.
     * @test
     */
    public function Example()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->assertSee('Lalaa');
        });
    }
}
