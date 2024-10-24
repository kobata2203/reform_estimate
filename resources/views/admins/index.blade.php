<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>管理者一覧画面</title>
    <link rel="stylesheet" href="{{ asset('css/managerindex.css') }}">
</head>
<body>
    <div>
        <p>管理者一覧画面</p>
    </div>
    <form action="{{ route('admins.index') }}" method="GET" class="form-inline">
        <div class="form-group d-flex align-items-center">
            <input type="search" name="search" class="form-control search-box-margin me-2" placeholder="検索して下さい" value="{{ request()->input('search') }}">
            <button type="submit" class="btn btn-primary custom-margin">検索</button>
        </div>
    </form>

    <div>
        <table>
            <thead>
                <tr>
                    <th>氏名</th>
                    <th>メールアドレス</th>
                    <th>部署名</th>
                    <th>アクション</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($manager_info as $manager)
                <tr>
                    <td>{{ $manager->name }}</td>
                    <td>{{ $manager->email }}</td>
                    <td>{{ $manager->department_name }}</td>
                    <td>
                        <a href="{{ route('admins.edit', $manager->id) }}" class="btn btn-dark">編集</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="col-3 custom-margin-bottom" style="margin-top: 20px; margin-right: 20px; text-align: right;">
            <button type="button" onclick="window.location.href='{{ route('manager_menu') }}'" class="btn btn-primary custom-margin custom-border mb-3">管理者メニュー</button>
        </div>
    </div>
</body>
</html>
