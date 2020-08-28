<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class PasswordRestTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * A basic feature test example.
     *
     * @test
     * @return void
     * @group passreset
     */
    public function valid_user_can_reset_password()
    {
        Notification::fake();

        // ユーザーを1つ作成
        $user = factory(User::class)->create();

        // パスワードリセットをリクエスト
        $response = $this->post('password/email', [
            'email' => $user->email
        ]);
        eval(\Psy\sh());
        // トークンを取得

        $token = '';


        Notification::assertSentTo(
            User::latest()->first(),
            ResetPassword::class,
            function ($notification, $channels) use ($user, &$token) {
                $token = $notification->token;
                return true;
            }
        );

        // パスワードリセットの画面へ
        $response = $this->get('password/reset/' . $token);

        $response->assertStatus(200);

        // パスワードをリセット

        $new = 'reset1111';

        $response = $this->post('password/reset', [
            'email'                 => $user->email,
            'token'                 => $token,
            'password'              => $new,
            'password_confirmation' => $new
        ]);

        // ホームへ遷移
        $response->assertStatus(302);
        $response->assertRedirect('/home');
        // リセット成功のメッセージ
        $response->assertSessionHas('status', 'パスワードはリセットされました!');

        // 認証されていることを確認
        $this->assertTrue(Auth::check());

        // 変更されたパスワードが保存されていることを確認
        $this->assertTrue(Hash::check($new, $user->fresh()->password));
    }
}
