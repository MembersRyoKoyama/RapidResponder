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
use DB;
use Illuminate\Contracts\Encryption\DecryptException;

class PasswordResetTest extends DuskTestCase
{
    use DatabaseMigrations;
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
     * @group resetEnd
     */
    public function testResetMail()
    {
        $user = factory(User::class)->create();
        $this->browse(function ($browser) use ($user) {
            $browser->visit('/questionList')
                ->assertPathIs('/login')
                ->clickLink('パスワードを忘れた方はこちら')
                ->assertPathIs('/password/reset')
                ->type('email', $user->email)
                ->press('#email-btn');
            $urlsha256 = DB::table('password_resets')->where('email', $user->email)->first()->token;

            eval(\Psy\sh());
            $browser->assertSee('unko');
        });
    }
}
