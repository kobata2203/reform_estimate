<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>管理者編集画面</title>
    <link rel="stylesheet" href="{{ asset('css/edit.css') }}">
</head>
<body>
    <div>
        <h1>管理者編集画面</h1>
    </div>
    <form action="{{ route('admin.update', $admin->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">氏名:</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $admin->name) }}" required>
        </div>

        <div class="form-group">
            <label for="department_name">部署名:</label>
            <input type="text" name="department_name" id="department_name" class="form-control" value="{{ old('department_name', $admin->department_name) }}" required>
        </div>

        <div class="form-group">
            <label for="email">メールアドレス:</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $admin->email) }}" required>
        </div>

        <div class="form-group">
            <label for="password">パスワード:</label>
            <input type="password" name="password" id="password" class="form-control" placeholder="新しいパスワードを入力してください">

        </div>

        <button type="submit" class="btn btn-primary">更新</button>
        <div class="bottom mb-3 text-right mr-3">
            <button type="button"
                    onclick="window.location.href='{{ route('manager_menu') }}'"
                    class="btn btn-primary custom-margin custom-border"
                    style="width: 50%; height: 40px;">管理者メニュー
            </button>
        </div>
    </form>
   
</body>
</html>
