<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Question;
use App\Product;
use Laravel\Dusk\Chrome;

class IndexTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
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
                ->press('confirm-btn')
                ->assertPathIs('/question/confirm');
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
            'name' => 'あああああああああああああああああ',
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
