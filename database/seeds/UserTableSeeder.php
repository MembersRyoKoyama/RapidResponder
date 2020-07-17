<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $num = 5;
        // 開発用ユーザーを定義
        for ($i = 0; $i < $num; ++$i) {
            factory(App\User::class)->create([
                'name' => 'staff' . $i,
                'email' => 'staff' . $i . '@gmail.com',
                'password' => Hash::make('staff' . $i), // この場合、「my_secure_password」でログインできる
            ]);
        }
        // モデルファクトリーで定義したテストユーザーを 20 作成
        //factory(App\User::class, 20)->create();
    }
}
