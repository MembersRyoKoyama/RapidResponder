<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Illuminate\Support\Facades\Artisan;
use App\Question as Question;
use App\User as User;
use App\Product as Product;
use App\Tag as Tag;
use DB;

class supportStatusTest extends DuskTestCase
{
    use DatabaseMigrations;
    private $questions;

    protected function setUp(): void
    {

        parent::setUp();
        //parent::tearDown();
        $this->seed([
            'ProductTableSeeder',
            'UserTableSeeder',
            'TagTableSeeder',
        ]);

        $this->num = 10;
        $products = Product::pluck('id')->all();
        $this->tag_name = Tag::pluck('name')->all();

        for ($j = 0; $j < $this->num; $j++) {
            factory(Question::class)->create([
                'name' => 'userNumber' . ($j),
                'products_id' => $products[random_int(0, count($products) - 1)],
                'end' => 1,
            ]);
        }
        $this->questions = Question::where('end', 1)->orderBy('date')->get();
    }
    public function tearDown(): void
    {
        Artisan::call('migrate:fresh');
        parent::tearDown();
    }
    /**
     * @group supportStatus
     * A Dusk test example.
     * 
     * @return void
     */
    public function supportStatusGraph()
    {
        $user = factory(User::class)->create();
        $this->browse(function (Browser $browser) use ($user) {
            $browser->loginAs($user)
                ->visit('/supportStatus')
                ->assertPathIs('/supportStatus')
                ->pause(1000)
                ->screenshot('test1');
        });
    }
}
