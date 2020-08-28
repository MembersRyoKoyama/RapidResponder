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

class QuestionTagTest extends DuskTestCase
{
    use DatabaseMigrations;
    private $questions, $tags, $num;
    private $tag_name, $exceptTag;

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
        $questionsNum = $this->num; //count(Question::pluck('id')->all());
        $this->exceptTag = [6, 3];
        $n = [1, 2, 4, 5];
        $tagsNum = count($this->tag_name) - count($this->exceptTag);
        for ($i = 0; $i < $questionsNum; ++$i) {
            shuffle($n);
            $t = random_int(1, $tagsNum);
            //$this->tags[] = [];
            for ($j = 0; $j < $t; ++$j) {
                DB::table('questions_tags')
                    ->insert([
                        'questions_id' => $this->questions[$i]->id,
                        'tags_id' => $n[$j],
                    ]);
                $this->tags[$i][] = $n[$j];
            }
            if ($i % (int)($this->num / 2) == 0) {
                $this->tags[$i][] = $this->exceptTag[0];
                DB::table('questions_tags')
                    ->insert([
                        'questions_id' => $this->questions[$i]->id,
                        'tags_id' => $this->exceptTag[0],
                    ]);
            }
            if ($i % 3 == 0) {
                DB::table('questions_tags')
                    ->insert([
                        'questions_id' => $this->questions[$i]->id,
                        'tags_id' => $this->exceptTag[1],
                    ]);
                $this->tags[$i][] = $this->exceptTag[1];
            }
            sort($this->tags[$i]);
            for ($j = 0; $j < count($this->tags[$i]); ++$j) {
                $this->tags[$i][$j] = $this->tag_name[$this->tags[$i][$j] - 1];
            }
        }
    }
    public function tearDown(): void
    {
        Artisan::call('migrate:fresh');
        parent::tearDown();
    }
    /**
     * @group tagTest
     * 質問一覧画面のテスト
     * @test
     */
    public function listing()
    {
        $user = factory(User::class)->create();
        $this->browse(function ($first, $second) use ($user) {
            $first->loginAs($user)
                ->visit('/questionList')
                ->assertPathIs('/questionList');
            for ($j = 0; $j < count($this->tags[0]); ++$j) {
                $first->assertSee($this->tags[0][$j]);
            }
            $first->clickLink('2');
            for ($j = 0; $j < count($this->tags[8]); ++$j) {
                $first->assertSee($this->tags[8][$j]);
            }
        });
    }
    /**
     * @group tagTest
     * 質問一覧画面(検索あり)のテスト
     * @test
     */
    public function listingFiltered()
    {
        $user = factory(User::class)->create();
        $this->browse(function ($first, $second) use ($user) {
            $q = Question::where('end', 1)->orderBy('date')->get();
            $first->loginAs($user)
                ->visit('/questionList')
                ->assertPathIs('/questionList')
                ->clickLink($this->tag_name[$this->exceptTag[0] - 1])
                ->clickLink($this->tag_name[$this->exceptTag[1] - 1])
                ->assertQueryStringHas('tagids', ($this->exceptTag[0]) . ',' . ($this->exceptTag[1]))
                ->assertSee($q[0]->name)
                ->assertDontSee($q[1]->name);
        });
    }
    /**
     * @group tagTest
     * 質問詳細画面のテスト
     * @test
     */
    public function view()
    {
        $user = factory(User::class)->create();
        $this->browse(function ($first, $second) use ($user) {
            $id = Question::where('end', 1)->orderBy('date')->first()->id;
            $first->loginAs($user)
                ->visit('/questionView?id=' . $id)
                ->assertPathIs('/questionView');
            //eval(\Psy\Sh());
            $first->assertSee($this->tag_name[$this->exceptTag[0] - 1]);
            $first->assertSee($this->tag_name[$this->exceptTag[1] - 1]);
            // for ($j = 0; $j < count($this->tags[0]); ++$j) {
            // $first->assertSee($this->tag_name[$j]);
            // }
        });
    }
}
