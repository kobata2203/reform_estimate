@extends('layouts.app1')

@section('content')
    <div class="form-container">
        <p>編集</p>
        <form action="{{ route('managers.update', $manager->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">氏名</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ $manager->name }}" required>
            </div>
            <div class="form-group">
                <label for="email">メールアドレス</label>
                <input type="email" name="email" id="email" class="form-control" value="{{ $manager->email }}" required>
            </div>
            <div class="form-group">
                <label for="password">パスワード</label>
                <input type="password" name="password" id="password" class="form-control">
                <small>パスワードを変更しない場合は空欄のままで</small>
            </div>
            <div class="form-group">
                <label for="department_name">部署名</label>
                <input type="text" name="department_name" id="department_name" class="form-control" value="{{ $manager->department_name }}" required>
            </div>
            <button type="submit" class="btn btn-primary custom-margin custom-border">更新</button>
        </form>
    </div>
@endsection
