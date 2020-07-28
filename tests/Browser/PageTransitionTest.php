<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Tests\TestCase;
use App\User;
use App\Product;
use App\Question;
use Illuminate\Support\Facades\Artisan;

class PageTransitionTest extends DuskTestCase
{
    use DatabaseMigrations;
    private $questions, $num;

    protected function setUp(): void
    {
        parent::setUp();
        //parent::tearDown();
        $this->seed([
            'ProductTableSeeder',
            'UserTableSeeder',
        ]);

        $this->num = 10;
        $staffs = User::pluck('id')->all();
        $products = Product::pluck('id')->all();

        for ($i = 1; $i <= 3; $i++) {
            for ($j = 0; $j < $this->num; $j++) {
                $staffs_id = $i != 1 ? $staffs[$j % count($staffs)] : null;
                factory(Question::class)->create([
                    'name' => 'userNumber' . ($this->num * $i + $j),
                    'products_id' => $products[random_int(0, count($products) - 1)],
                    'end' => $i,
                    'staffs_id' => $staffs_id,
                ]);
            }
            $this->questions[$i] = Question::where('end', $i)->orderBy('date')->get();
        }
    }
    public function tearDown(): void
    {
        Artisan::call('migrate:fresh');
        parent::tearDown();
    }
    /**
     * @group transitionTest
     * A Dusk test example.
     * @test
     */
    public function testPageTransition()
    {
        $user = factory(User::class)->create([]);

        $this->browse(function ($browser) use ($user) {
            $browser->loginAs($user)
                ->visit('/questionList')
                ->assertPathIs('/questionList')
                ->clickLink('詳細')
                //->assertPathIs('/questionView?id=' . "{{$this->questions[1][3]->id}}");
                //<a href="/questionView?id={{$question->id}}">
                ->clickLink('対応開始')
                ->clickLink('未対応に戻す');
        });
    }
}
