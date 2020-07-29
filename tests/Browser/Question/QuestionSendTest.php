<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Question;
use App\Product;
use Laravel\Dusk\Chrome;
use Illuminate\Support\Facades\Artisan;

class QuestionSendTest extends DuskTestCase
{
    use DatabaseMigrations;
    protected function setUp(): void
    {
        parent::setUp();
        $this->seed([
            'ProductTableSeeder',
            'UserTableSeeder',
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
     * @group  send
     */
    public function testSendQuestion()
    {
        $question = factory(Question::class)->make([
            'mail' => 'taylor@laravel.com',
        ]);
        //想定された値のページ遷移 送信完了画面まで
        $this->browse(function ($browser) use ($question) {
            $browser->visit('/question')
                ->type('name', $question->name)
                ->type('mail', $question->mail)
                ->type('tel', $question->tel)
                ->select('products_id', $question->products_id)
                ->type('content', $question->content)
                //eval(\Psy\sh());
                ->press('confirm-btn')
                ->assertPathIs('/question/confirm')
                //->press('submit')
                ->click('.submit')
                ->assertPathIs('/question/send')
                //->click('.submit')
                ->screenshot('filename_1')
                ->clickLink('トップページに戻る')
                //->waitForText('氏名')
                //eval(\Psy\sh());
                ->assertPathIs('/question');
            //$browser->screenshot('filename_1');
        });
    }
}
