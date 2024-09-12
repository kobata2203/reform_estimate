<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>新規作成</title>
    <link rel="stylesheet" href="{{ asset('css/managerindex.css') }}">
</head>
<body>
    <div>
        <p>新規作成</p>
        <form action="{{ route('managers.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">氏名</label>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="email">メールアドレス</label>
                <input type="email" name="email" id="email" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="password">パスワード</label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="department_name">部署名</label>
                <input type="text" name="department_name" id="department_name" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">保存</button>
        </form>
    </div>
</body>
</html>
