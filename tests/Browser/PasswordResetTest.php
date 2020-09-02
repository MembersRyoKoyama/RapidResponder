<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Laravel\Dusk\Chrome;
use Illuminate\Support\Facades\Notification;
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
    public function resetMail()
    {
        Notification::fake();
        $user = factory(User::class)->create();
        $this->browse(function ($browser) use ($user) {
            /* $browser->visit('/questionList')
                ->assertPathIs('/login')
                ->clickLink('パスワードを忘れた方はこちら')
                ->assertPathIs('/password/reset')
                ->type('email', $user->email)
                ->press('#email-btn');
            $urlsha256 = DB::table('password_resets')->where('email', $user->email)->first()->token;
            //$browser->visit('/password/reset/' . $urlsha256 . '?email=' . $user->email);
            //$browser->visit(':8025');*/

            $response = $this->post('password/email', [
                'email' => $user->email
            ]);
            $token = '';

            Notification::assertSentTo(
                $user,
                ResetPassword::class,
                function ($notification, $channels) use ($user, &$token) {
                    $token = $notification->token;
                    return true;
                }
            );
            $browser->visit('/password/reset/' . $token . '?email=' . $user->email);
            eval(\Psy\sh());
        });
    }
}
