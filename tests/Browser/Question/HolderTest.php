<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Illuminate\Support\Facades\Artisan;
use Laravel\Dusk\Chrome;

class HolderTest extends DuskTestCase
{
    use DatabaseMigrations;
    protected function setUp(): void
    {
        parent::setUp();
        $this->seed([
            'ProductTableSeeder',
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
     * @group press
     */
    public function testPressHolder()
    {
        $this->browse(function ($browser) {
            $browser->visit('/question')
                //->assertSee( 'まで')
                //->assertSeeIn('.name', 'まで')
                //->assertInputValue('', 'まで')
                ->assertAttribute('#name', 'placeholder', '16文字まで')
                ->assertAttribute('#mail', 'placeholder', '英数字記号のみ')
                ->assertAttribute('#tel', 'placeholder', '数字のみ　12桁まで')
                ->assertAttribute('#content', 'placeholder', '2000文字まで')
                ->type('name', 'test')
                ->assertInputValue('.name', 'test');
        });
    }
}
