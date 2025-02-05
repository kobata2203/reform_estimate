@extends('layouts.main')
@section('title', '営業者登録画面')
@section('headder')
    <!-- 個別のCSS・JSなどの読み込み -->
    <link rel="stylesheet" href="{{ asset('css/salesperson/register.css') }}">
@endsection
@section('content')
    <!-- bobyタグ内の処理を記述 -->

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <h2>営業者登録画面</h2>

    <div class="form-container">
        <form action="{{ $action }}" method="POST">

            @csrf
            <label for="name">氏名</label>
            <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required>
            @if ($errors->has('name'))
            <div class="invalid-feedback" role="alert">
                {{ $errors->first('name') }}
            </div>
            @endif
            <label for="department">部署名</label>
            <select id="department_name" name="department_id" class="department_id">
                    @foreach($departments as $department)
                        <option value={{ $department->id }}@if($department->id == old('department_id', $user->department_id)) selected @endif>{{ old('department_name', $department->name) }}</option>
                    @endforeach
            </select>
            @if ($errors->has('department_name'))
            <div class="invalid-feedback" role="alert">
                {{ $errors->first('department_name') }}
            </div>
            @endif
            <label for="email">メールアドレス</label>
            <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required>
            @if ($errors->has('email'))
                <div class="invalid-feedback" role="alert">
                    {{ $errors->first('email') }}
                </div>
            @endif
            <label for="password">パスワード</label>
            <input type="password" id="password" name="password" value="" required>
            @if ($errors->has('password'))
            <div class="invalid-feedback" role="alert">
                {{ $errors->first('password') }}
            </div>
            @endif

            <div class="button-container">
                <button type="submit">登録</button>
                <button type="button" onclick="window.location.href='{{ route('menu') }}'">戻る</button>
            </div>
        </form>

    </div>
@endsection
