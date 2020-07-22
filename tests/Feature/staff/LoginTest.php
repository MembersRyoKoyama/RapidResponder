<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use DatabaseMigrations; // テスト用データベースを使用
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Artisan;

class LoginTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    //データベースのリセットとシーダーの選択
    use RefreshDatabase;
    protected function setUp(): void
    {
        parent::setUp();
        //parent::tearDown();
        $this->seed([
            'UserTableSeeder'
        ]);
    }

    public function tearDown(): void
    {
        Artisan::call('migrate:refresh');
        parent::tearDown();
    }

    public function testLogin()
    {
        $response = $this->get('/login');
        $response->assertStatus(200);
        $this->assertGuest();
    }

    public function testLoginRedirect()
    {
        $response = $this->get('/questionList'); //ログインの必要なページに
        $response->assertStatus(302)
            ->assertRedirect('/login'); // リダイレクト先
        $this->assertGuest();
    }

    public function testDummyLogin()
    {
        // 認証されていないことを確認
        $this->assertGuest();
        // ダミーログイン
        $response = $this->dummyLogin();
        $response->assertStatus(200);
        // 認証を確認
        $this->assertAuthenticated();
    }
    private function dummyLogin()
    {
        $user = factory(User::class)->create();
        return $this->actingAs($user)
            ->withSession(['user_id' => $user->id])
            ->get('/questionList'); //ログインの必要なページに飛ばす
    }
}
