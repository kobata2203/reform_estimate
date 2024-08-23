@extends('...layouts.layout')

@section('salesperson_add')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>営業者登録画面</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
    <div class="hero">
        <p>営業者登録画面</p>
    </div>
    <form action="{{ route('salesperson_create') }}" method='post'>
    {{ csrf_field() }}

    <div class="form-content">
        <div class="container">
            <label for="name" class="label">氏名</label>
            <input type="text" id="name" name="name" class="text">
        </div>
        
        <div class="container">
            <label for="department" class="label">部署名</label>
            <select id="department_name" name="department_name" class="text">
                <option value="option1">営業部</option>
                <option value="option2">管理部</option>
            </select>
        </div>
        
        <div class="container">
            <label for="password" class="label">パスワード</label>
            <input type="password" id="password" name="password" class="text">
        </div>
    </div>

    <div class="button-container">
        <button type="submit">登録</button>
        <button>管理者メニュー</button>
    </div>
    </form>
</body>
</html>
@endsection