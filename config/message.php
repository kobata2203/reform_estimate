<?php

return [
    'only_admin_access' => env('ONLY_ADMIN_ACCESS', 'アクセスが拒否されました。このページは管理者のみがアクセスできます。'),
    'only_sales_access' => env('ONLY_SALES_ACCESS', 'アクセスが拒否されました。このページは営業者のみがアクセスできます。'),
    'login_complete' => env('LOGIN_COMPLETE', 'ログインしました。'),
    'regist_complete' => env('REGIST_COMPLETE', '登録完了しました。'),
    'update_complete' => env('UPDATE_COMPLETE', '更新完了しました。'),
    'delete_complete' => env('DELETE_COMPLETE', '削除完了しました。'),
    'login_fail' => env('LOGIN_FAIL', 'ログイン処理に失敗しました。メールアドレス・パスワードを確認ください。'),
    'regist_fail' => env('REGIST_FAIL', '登録処理に失敗しました。管理者にご連絡ください。'),
    'update_fail' => env('UPDATE_FAIL', '更新処理に失敗しました。管理者にご連絡ください。'),
    'delete_fail' => env('DELETE_FAIL', '削除処理に失敗しました。管理者にご連絡ください。'),
    'auto_logout' => env('AUTO_LOGOUT_MESSAGE', '120分間操作がなかったため、自動ログアウトしました。'),
    'credentials_invalid' => '入力されたクレデンシャルが無効です。',
];
