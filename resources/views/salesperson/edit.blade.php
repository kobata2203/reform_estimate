@extends('layouts.main')
@section('title', '管理者登録画面')
@section('headder')
    <!-- 個別のCSS・JSなどの読み込み -->
    <link rel="stylesheet" href="{{ asset('css/manager_salesperson/edit.css') }}">
@endsection
@section('content')
    <!-- bobyタグ内の処理を記述 -->
    <body>
        <div>
            <h2>営業者編集画面</h2>
            <form action="{{ route('salesperson.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name">氏名</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $user->name) }}" required>
                </div>
                <div class="form-group">
                    <label for="department_name">部署名</label>
                    <select id="department_name" name="department_id"  class="department_id">
                            @foreach($departments as $department)
                                <option value={{ $department->id }}>{{ $department->name }}</option>
                            @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="email">メールアドレス</label>
                    <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $user->email) }}" required>
                </div>
                <div class="form-group">
                    <label for="password">パスワード</label>
                    <input type="password" name="password" id="password" class="form-control">
                </div>
                <button type="submit" class="btn btn-primary margin-left-300">更新</button>
                <button type="button"
                onclick="window.location.href='{{ route('manager_menu') }}'"
                class="btn btn-primary custom-border">戻る

                </button>
            </form>
        </div>
    </body>
@endsection
