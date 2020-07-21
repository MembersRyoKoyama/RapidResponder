<?php

namespace Tests\Feature\Question;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;
use App\Question;
use App\User;
use App\Product;

class QuestionIdViewTest extends TestCase
{
    use RefreshDatabase;
    protected function setUp(): void
    {
        parent::setUp();
        //parent::tearDown();
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
     * @group idTest
     * 質問詳細表示（IDがOK）テスト
     * @test
     */
    public function idAvailable()
    {
        $user = factory(User::class)->create();
        factory(Question::class, 20)->create();
        $questions_id = Question::pluck('id')->all();
        $id = $questions_id[1];
        $this->actingAs($user)
            ->get('questionView?id=' . $id)
            ->assertOk();
    }

    /**
     * @group idTest
     * 質問詳細表示（IDがNG）テスト
     * @test
     */
    public function idUnavailable()
    {

        $user = factory(User::class)->create();
        factory(Question::class, 20)->create();
        $questions_id = Question::pluck('id')->all();
        $id = 40;
        $this->actingAs($user)
            ->get('/questionView?id=' . $id)
            ->assertRedirect('questionList');
    }
    /**
     * @group idTest
     * 質問詳細表示（IDが境界）テスト
     * @test
     */
    public function idBorder()
    {
        $id1 = 19;
        $id2 = 21;
        $user = factory(User::class)->create();
        factory(Question::class, 20)->create();

        $this->actingAs($user)
            ->get('/questionView?id=' . $id1)
            ->assertOk();
        $this->actingAs($user)
            ->get('/questionView?id=' . $id2)
            ->assertRedirect('questionList');
    }
}
