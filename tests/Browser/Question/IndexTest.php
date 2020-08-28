<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Question;
use App\Product;
use Laravel\Dusk\Chrome;
use Illuminate\Support\Facades\Artisan;

class IndexTest extends DuskTestCase
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
     * @group index
     */
    public function testBrowseIndex()
    {
        $question = factory(Question::class)->create([
            'mail' => 'taylor@laravel.com',
        ]);
        //想定された値のページ遷移
        $this->browse(function ($browser) use ($question) {
            $browser->visit('/question')
                ->type('name', $question->name)
                ->type('mail', $question->mail)
                ->type('tel', $question->tel)
                ->select('products_id', $question->products_id)
                ->type('content', $question->content)
                //タグ
                ->click('.js-modal-open')
                ->check('#step1_0')
                ->assertChecked('#step1_0')
                ->clickLink('閉じる')
                ->press('confirm-btn')
                ->assertPathIs('/question/confirm');

            $browser->screenshot('filename_1');
        });
    }
    public function testNonBrowseIndex()
    {
        $question = factory(Question::class)->create([
            'mail' => 'taylor@laravel.com',
        ]);
        //値がない状態での動作
        $this->browse(function ($browser) use ($question) {
            $browser->visit('/question')
                ->press('confirm-btn')
                ->assertPathIsNot('/question/confirm')
                ->assertPathIs('/question');
        });
    }
    public function testErrBrowseIndex()
    {
        $question = factory(Question::class)->create([
            'name' => 'あいうえおかきくけこさしすせそたちつ',
            'mail' => 'taylor@laravel.com',
        ]);
        //想定外な値のページ遷移
        $this->browse(function ($browser) use ($question) {
            $browser->visit('/question')
                ->type('name', $question->name)
                ->type('mail', $question->mail)
                ->type('tel', $question->tel)
                ->select('products_id', $question->products_id)
                ->type('content', $question->content)
                ->press('confirm-btn')
                ->assertPathIsNot('/question/confirm')
                ->assertPathIs('/question');
        });
    }
}
