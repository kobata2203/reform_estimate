<?php
return [
    'login_complete' => env('LOGIN_COMPLETE', 'ログインしました。'),
    'regist_complete' => env('REGIST_COMPLETE', '登録完了しました。'),
    'update_complete' => env('UPDATE_COMPLETE', '更新完了しました。'),
    'delete_complete' => env('DELETE_COMPLETE', '削除完了しました。'),
    'login_fail' => env('LOGIN_FAIL', 'ログイン処理に失敗しました。メールアドレス・パスワードを確認ください。'),
    'regist_fail' => env('REGIST_FAIL', '登録処理に失敗しました。管理者にご連絡ください。'),
    'update_fail' => env('UPDATE_FAIL', '更新処理に失敗しました。管理者にご連絡ください。'),
    'delete_fail' => env('DELETE_FAIL', '削除処理に失敗しました。管理者にご連絡ください。'),
    'register_discount' => env('REGISTER_DISCOUNT_COMPLETE', '特別お値引きを登録完了しました。'),
    'register_discount_fail' => env('REGISTER_COMPLETE', '特別お値引きを登録更新処理に失敗しました, 数字を入力してください。'),

    'validation' => [
        'special_discount_required' => 'Please provide a discount value.',
    ],


];
