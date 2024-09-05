<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>営業者一覧画面</title>
    <!-- Link to CSS file using Laravel's asset helper -->
    <link rel="stylesheet" href="{{ asset('index.css') }}">
</head>
<body>
    <div>
        <p>営業者一覧画面</p>
    </div>

    <div>部署名検索</div>
    <input type="text">
    <button>検索</button>

    <div>
        <table>
            <tr>
                <th>氏名</th>
                <th>メールアドレス</th>
                <th>パスワード</th>
                <th>部署名</th>
                <th></th>
            </tr>

            @foreach($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->password }}</td>
                    <td>{{ $user->department }}</td>
                    <td>
                        <!-- Use Laravel's route helper for generating URLs -->
                        <a href="{{ route('user.edit', $user->id) }}" class="btn btn-primary" role="button">編集</a>
                    </td>
                </tr>
            @endforeach

            <!-- Example of a fixed link, use route helper if applicable -->
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>
                    <a href="https://www.google.com" class="btn btn-primary" role="button">編集</a>
                </td>
            </tr>
        </table>
    </div>

    <div>
        <button id="menu">管理者メニュー</button>
    </div>
</body>
</html>
