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

class QuestionListingTest extends DuskTestCase
{
    use DatabaseMigrations;
    private $questions, $tags, $num;

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
     * @group listingTest
     * 質問一覧画面のテスト
     * @test
     */
    public function listingHome()
    {
        $user = factory(User::class)->create();
        $this->browse(function ($first, $second) use ($user) {
            $first->loginAs($user)
                ->visit('/questionList')
                ->assertPathIs('/questionList')
                ->assertSee($this->questions[1][5]->name)
                ->assertSee($this->questions[1][7]->name)
                ->assertDontSee($this->questions[1][8]->name)
                ->assertDontSee($this->questions[1][9]->name)
                ->clickLink('2')
                ->assertPathIs('/questionList')
                ->assertQueryStringHas('p', 2)
                ->assertSee($this->questions[1][8]->name)
                ->assertSee($this->questions[1][9]->name)
                ->assertDontSee($this->questions[1][5]->name);
        });
    }

    /**
     * @group listingTest
     * 質問一覧画面(end=2)のテスト
     * @test
     */
    public function listingEnd2()
    {
        $end = 2;
        $user = factory(User::class)->create();
        $this->browse(function ($first, $second) use ($user, $end) {
            $first->loginAs($user)
                ->visit('/questionList')
                ->press('#dropdown1')
                ->clickLink('対応中')
                ->assertQueryStringHas('end', $end)
                ->assertSee($this->questions[$end][5]->name)
                ->assertSee($this->questions[$end][7]->name)
                ->assertDontSee($this->questions[$end][8]->name)
                ->assertDontSee($this->questions[1][9]->name)
                ->clickLink('2')
                ->assertPathIs('/questionList')
                ->assertQueryStringHas('p', 2)
                ->assertSee($this->questions[$end][8]->name)
                ->assertSee($this->questions[$end][9]->name)
                ->assertDontSee($this->questions[$end][5]->name);
        });
    }
    /**
     * @group listingTest
     * 質問一覧画面(end=3)のテスト
     * @test
     */
    public function listingEnd3()
    {
        $end = 3;
        $user = factory(User::class)->create();
        $this->browse(function ($first, $second) use ($user, $end) {
            $first->loginAs($user)
                ->visit('/questionList')
                ->press('#dropdown1')
                ->clickLink('対応済')
                ->assertQueryStringHas('end', $end)
                ->assertSee($this->questions[$end][5]->name)
                ->assertSee($this->questions[$end][7]->name)
                ->assertDontSee($this->questions[$end][8]->name)
                ->assertDontSee($this->questions[1][9]->name)
                ->clickLink('2')
                ->assertPathIs('/questionList')
                ->assertQueryStringHas('p', 2)
                ->assertSee($this->questions[$end][8]->name)
                ->assertSee($this->questions[$end][9]->name)
                ->assertDontSee($this->questions[$end][5]->name);
        });
    }
}
