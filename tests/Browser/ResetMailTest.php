<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Laravel\Dusk\Chrome;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ResetMailTest extends DuskTestCase
{
    use RefreshDatabase;
    protected function setUp(): void
    {
        parent::setUp();
        //parent::tearDown();
        $this->seed([
            'UserTableSeeder'
        ]);
    }

    public function tearDown(): void
    {
        Artisan::call('migrate:refresh');
        parent::tearDown();
    }
    /**
     * A Dusk test example.
     *
     * @return void
     * @group reset
     */
    public function testResetMail()
    {
        $user = factory(User::class)->create();
        $this->browse(function ($browser) use ($user) {
            $browser->visit('/password/reset')
                ->assertPathIs('/password/reset')
                ->type('@email', 'staff1@gmail.com')
                ->press('#email-btn');
            eval(\Psy\sh());
            //->assertPathIs('/password/email');
            //$browser->clickLink('password-forget');
        });
    }
}
