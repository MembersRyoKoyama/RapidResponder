<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Illuminate\Support\Facades\Artisan;
use Laravel\Dusk\Chrome;
use App\Tag;
use Facebook\WebDriver\WebDriverBy;

class TagTest extends DuskTestCase
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
     * @group tagindex
     */
    public function testIndexTag()
    {
        $this->browse(function ($browser) {
            $browser->visit('/question')
                ->click('.js-modal-open')
                ->driver
                ->findElement(WebDriverBy::xpath('//*[@id="app"]/main/div/form/div[2]/div[2]/label[1]'))
                ->click();
            $browser->assertChecked('#step1_0')
                ->clickLink('閉じる')
                ->pause(1000)
                ->screenshot('filename_1')
                ->assertSelected('#select_box_list', 1);
        });
    }
}
