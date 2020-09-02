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
use Facebook\WebDriver\WebDriverBy;
use Illuminate\Support\Arr;

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
    public function detailButtonTransition()
    {
        $user = factory(User::class)->create([]);
        $num = 1;
        $this->browse(function ($browser) use ($user, $num) {
            $browser->loginAs($user)
                ->visit('/questionList')
                ->assertPathIs('/questionList')
                ->driver->findElement(WebDriverBy::xpath('//*[@id="app"]/main/div/table/tbody[1]/tr[' . ($num + 1) . ']/td[7]/span/a/span'))->click();
            $browser->assertQueryStringHas('id', $this->questions[1][$num - 1]->id);
            $browser->screenshot('filename_3');
            $q = $this->questions[1][$num - 1];
            $check = [
                'name' => $q->name,
                'date' => (string)$q->date->format('Y-m-d'),
                'tel' => (string)$q->tel,
                'products_id' => $q->products->name,
                'content' => $q->content,
            ];
            $browser->assertSee($check['name'])
                ->assertSee($check['date'])
                ->assertSee($check['tel'])
                ->assertSee($check['products_id'])
                ->assertSee($check['content']);
            //eval(\Psy\sh());
            //$browser->assertSee($check['date']);
            // foreach ($check as $k) {
            //     eval(\Psy\sh());
            //     $browser->assertSee($check['name']);
            // }
        });
    }
    /**
     * @group transitionTest
     * A Dusk test example.
     * @test
     */
    public function stateChangeButtonTransition()
    {
        $user = factory(User::class)->create([]);
        $num = 1;
        $this->browse(function ($browser) use ($user, $num) {
            $browser->loginAs($user)
                ->visit('/questionView?id=' . $this->questions[1][0]->id)
                ->assertPathIs('/questionView')
                ->screenshot('filename_3')
                ->assertQueryStringHas('id', $this->questions[1][0]->id)
                ->clickLink("対応開始")
                ->assertQueryStringHas('id', $this->questions[1][0]->id)
                ->assertSeeIn('.endIcon', '対応中')
                ->screenshot('filename_3')
                ->clickLink("対応完了")
                ->assertQueryStringHas('id', $this->questions[1][0]->id)
                ->assertSeeIn('.endIcon', '対応済')
                ->screenshot('filename_3')
                ->clickLink("未対応に戻す")
                ->assertQueryStringHas('id', $this->questions[1][0]->id)
                ->assertSeeIn('.endIcon', '未対応')
                ->screenshot('filename_3')
                ->clickLink("対応開始")
                ->assertQueryStringHas('id', $this->questions[1][0]->id)
                ->screenshot('filename_3')
                ->clickLink("未対応に戻す")
                ->assertQueryStringHas('id', $this->questions[1][0]->id)
                ->assertSeeIn('.endIcon', '未対応')
                ->screenshot('filename_3');
        });
    }
    /**
     * @group transitionTest
     * A Dusk test example.
     * @test
     */
    public function supportStatusTransition()
    {
        $user = factory(User::class)->create();
        $this->browse(function ($browser) use ($user) {
            $browser->loginAs($user)
                ->visit('/questionList')
                ->clickLink("対応状況")
                ->assertPathIs('/supportStatus');
        });
    }
}
