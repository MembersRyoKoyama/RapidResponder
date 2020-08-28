<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Illuminate\Support\Facades\Artisan;
use Laravel\Dusk\Chrome;

class LoginTest extends DuskTestCase
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
     * @group login
     */
    public function testLoginCheck()
    {
        $this->browse(function ($browser) {
            $browser->visit('/login')
                ->assertNotChecked('.boxform-check-input')
                ->click('.auto')
                ->assertChecked('.boxform-check-input');
            //->screenshot('filename_1');
        });
    }
}
