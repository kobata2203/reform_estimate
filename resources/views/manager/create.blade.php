@extends('layouts.main')
@section('title', '管理者登録画面')
@section('headder')
    <!-- 個別のCSS・JSなどの読み込み -->
    <link rel="stylesheet" href="{{ asset('css/manager_salesperson/register.css') }}">
@endsection
@section('content')
    <!-- bobyタグ内の処理を記述 -->

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <h2>管理者登録画面</h2>

    <div class="form-container">
        <form action="{{ route('manager.store') }}" method="POST">
            @csrf
            <label for="name">氏名</label>
            <input type="text" id="name" name="name" value="{{ old('name') }}" required>
            @if ($errors->has('name'))
            <div class="invalid-feedback" role="alert">
                {{ $errors->first('name') }}
            </div>
            @endif
            <label for="department">部署名</label>
            <select id="department" name="department_name" required>
                <option value="本部">本部</option>
                <option value=" 契約管理課"> 契約管理課</option>
                <option value="営業１課">営業１課</option>
                <option value="営業１課３係">営業１課３係</option>
                <option value="営業２課１係">営業２課１係</option>
                <option value="営業３課">営業３課</option>
            </select>
            @if ($errors->has('department_name'))
            <div class="invalid-feedback" role="alert">
                {{ $errors->first('department_name') }}
            </div>
            @endif
            <label for="email">メールアドレス</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required>
            @if ($errors->has('email'))
                <div class="invalid-feedback" role="alert">
                    {{ $errors->first('email') }}
                </div>
            @endif
            <label for="password">パスワード</label>
            <input type="password" id="password" name="password" maxlength="32" required>
            @if ($errors->has('password'))
            <div class="invalid-feedback" role="alert">
                {{ $errors->first('password') }}
            </div>
            @endif
            <div class="button-container">
                <button type="submit">登録</button>
                <button type="button" onclick="window.location.href='{{ route('manager_menu') }}'">管理者<br>メニュー</button>
            </div>
        </form>
    </div>
@endsection
