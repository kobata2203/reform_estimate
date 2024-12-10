@extends('layouts.main')
@section('title', '営業者一覧画面')
@section('headder')
    <!-- 個別のCSS・JSなどの読み込み -->
    <link rel="stylesheet" href="{{ asset('css/managerindex.css') }}">
@endsection
@section('content')
    <!-- bobyタグ内の処理を記述 -->
    <div>
        <h2>営業者一覧画面</h2>
    </div>
    @if(session('message'))
        <div class="message">
            {{ session('message') }}
        </div>
    @endif
    <form action="{{ route('salesperson.index') }}" method="GET" class="form-inline">
        <div class="form-group d-flex align-items-center">
            <input type="search" name="search" class="form-control search-box-margin me-2" placeholder="検索して下さい"
                value="{{ request()->input('search') }}">
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
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->department_name }}</td>
                        <td>
                            <a href="{{ route('salesperson.edit', $user->id) }}" class="btn btn-dark custom-border">編集</a>
                            <a href="{{ route('salesperson.delete', $user->id) }}" class="btn btn-dark custom-border">削除</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="col-3 custom-margin-bottom" style="margin-top: 20px; margin-right: 20px; text-align: right;">
            <button type="button" onclick="window.location.href='{{ route('manager_menu') }}'" class="btn btn-primary custom-margin custom-border mb-3">管理者メニュー</button>
        </div>
    </div>
@endsection
