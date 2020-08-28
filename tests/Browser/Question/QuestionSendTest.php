<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Question;
use App\Tag;
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
            'TagTableSeeder',
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
     * @group send
     */
    public function testSendQuestion()
    {
        $question = factory(Question::class)->make([
            'mail' => 'taylor@laravel.com',
        ]);
        //$taginputs = factory(Tag::class)->make([]);
        //想定された値のページ遷移 送信完了画面まで
        $this->browse(function ($browser) use ($question) {
            $browser->visit('/question')
                ->type('name', $question->name)
                ->type('mail', $question->mail)
                ->type('tel', $question->tel)
                ->select('products_id', $question->products_id)
                ->click('.js-modal-open')
                ->click('#step1_0')
                ->clickLink('閉じる')
                //->select('#select_box_list', 1)
                ->type('content', $question->content)
                ->press('confirm-btn')
                ->assertPathIs('/question/confirm');
            //->press('submit')
            $browser->click('#submit')
                //->clickLink('送信する')
                //->doubleClick('送信する')
                //->waitForText('完了しました')
                ->assertPathIs('/question/send')
                ->screenshot('filename_1')
                ->clickLink('トップページに戻る')
                //->press('return-btn')
                ->assertPathIs('/question');
            //$browser->screenshot('filename_1');
        });
    }
}
