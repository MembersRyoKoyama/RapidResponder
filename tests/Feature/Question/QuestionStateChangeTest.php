<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;
use App\Question;
use App\User;
use App\Product;

class QuestionStateChangeTest extends TestCase
{
    use RefreshDatabase;
    protected function setUp(): void
    {
        parent::setUp();
        //parent::tearDown();
        $this->seed([
            'ProductTableSeeder',
        ]);
    }
    public function tearDown(): void
    {
        Artisan::call('migrate:refresh');
        parent::tearDown();
    }

    /**
     * @group stateTest
     * state変更テスト（可能ユーザー）
     * @test
     */
    public function stateChangeAvailableUser()
    {
        $user1 = factory(User::class)->create();
        //$user2 = factory(User::class)->create();
        $end = [1, 2, 2, 3];
        $to = [2, 1, 3, 1];
        for ($i = 0; $i < count($end); ++$i) {
            $questions[] = factory(Question::class)->create([
                'staffs_id' => $user1->id,
                'end' => $end[$i],
            ]);
        }
        $i = 0;
        foreach ($questions as $q) {
            $id = $q->id;
            $this->actingAs($user1)
                ->get("/questionStateChange?id=$id&to=$to[$i]")
                ->assertOk();
            $this->assertEquals($to[$i], Question::where('id', $id)->first()->end);
            $i++;
        }
    }
    /**
     * @group stateTest
     * state変更テスト（不可能ユーザー）
     * @test
     */
    public function stateChangeUnavailableUser()
    {
        $user1 = factory(User::class)->create();
        $user2 = factory(User::class)->create();
        $questions = [];
        $end = [2, 2, 3];
        $to = [1, 3, 1];
        for ($i = 0; $i < count($end); ++$i) {
            $questions[] = factory(Question::class)->create([
                'staffs_id' => $user1->id,
                'end' => $end[$i],
            ]);
        }
        $i = 0;
        foreach ($questions as $q) {
            $id = $q->id;
            $this->actingAs($user2)
                ->get("/questionStateChange?id=$id&to=$to[$i]")
                ->assertRedirect();
            $this->assertEquals($end[$i], Question::where('id', $id)->first()->end);
            $i++;
        }
    }
    /**
     * @group stateTest
     * state変更テスト（不可能id）
     * @test
     */
    public function stateChangeUnavailableId()
    {
        $user1 = factory(User::class)->create();
        //$user2 = factory(User::class)->create();
        $questions = [];
        $end = [1, 2];
        $to = [2, 3];
        $id = [0, 100];
        for ($i = 0; $i < count($end); ++$i) {
            $questions[] = factory(Question::class)->create([
                'staffs_id' => $user1->id,
                'end' => $end[$i],
            ]);
        }
        $i = 0;

        foreach ($questions as $q) {
            $this->actingAs($user1)
                ->get("/questionStateChange?id=$id[$i]&to=$to[$i]")
                ->assertRedirect();
            $i++;
        }
    }
    /**
     * @group stateTest
     * state変更テスト（不可能state）
     * @test
     */
    public function stateChangeUnavailableState()
    {
        $user1 = factory(User::class)->create();
        //$user2 = factory(User::class)->create();
        $questions = [];
        $end = [1, 3, 1, 2, 3, 1, 2];
        $to = [3, 2, 1, 2, 3, 0, 10];
        for ($i = 0; $i < count($end); ++$i) {
            $questions[] = factory(Question::class)->create([
                'staffs_id' => $user1->id,
                'end' => $end[$i],
            ]);
        }

        $i = 0;
        foreach ($questions as $q) {
            $id = $q->id;
            $this->actingAs($user1)
                ->get("/questionStateChange?id=$id&to=$to[$i]")
                ->assertRedirect();
            $this->assertEquals($end[$i], Question::where('id', $id)->first()->end);
            $i++;
        }
    }
}
