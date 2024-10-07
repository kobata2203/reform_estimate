@extends('layouts.app1')

@section('content')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>編集</title>
    <link rel="stylesheet" href="{{ asset('css/edit1.css') }}">
</head>
<body>
    <div>
        <h2>編集</h2>
        <form action="{{ route('salesperson.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">氏名</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ $user->name }}" required>
            </div>
            <div class="form-group">
                <label for="email">メールアドレス</label>
                <input type="email" name="email" id="email" class="form-control" value="{{ $user->email }}" required>
            </div>
            <div class="form-group">
                <label for="password">パスワード</label>
                <input type="password" name="password" id="password" class="form-control">
            </div>
            <div class="form-group">
                <label for="department_name">部署名</label>
                <input type="text" name="department_name" id="department_name" class="form-control" value="{{ $user->department_name }}" required>
            </div>
            <button type="submit" class="btn btn-primary margin-left-300">編集</button>
        </form>
    </div>
</body>
</html>

@endsection
