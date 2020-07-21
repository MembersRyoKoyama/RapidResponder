<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use DatabaseMigrations; // テスト用データベースを使用
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;

class LogoutTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testLogout()
    {
        // ダミーログイン
        $response = $this->dummyLogin();
        // 認証を確認
        $this->assertAuthenticated();
        $response = $this->post('/logout');
        // ホーム画面にリダイレクト
        $response->assertStatus(302)
            ->assertRedirect('/login'); // リダイレクト先を確認
        // 認証されていないことを確認
        $this->assertGuest();
    }

    /**
     * ダミーユーザーログイン
     */
    private function dummyLogin()
    {
        $user = new User;
        //$user = factory(User::class)->create();
        return $this->actingAs($user)
            ->withSession(['user_id' => $user->id])
            ->get('/questionList'); //ログインの必要なページに飛ばす
    }
}
