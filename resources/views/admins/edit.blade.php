<!-- resources/views/admins/edit.blade.php -->
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
    <form action="{{ route('admins.update', $admin->id) }}" method="POST">
        @csrf
        @method('PUT') <!-- This is required to send a PUT request for updating -->

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
            <!-- Leave this blank if you do not want to change the password -->
        </div>

        <button type="submit" class="btn btn-primary ">更新</button>

    </form>
</body>
</html>
