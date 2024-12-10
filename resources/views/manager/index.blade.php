@extends('layouts.main')
@section('title', '管理者一覧画面')
@section('headder')
    <!-- 個別のCSS・JSなどの読み込み -->
    <link rel="stylesheet" href="{{ asset('css/manager_salesperson/managerindex.css') }}">
@endsection
@section('content')
    <!-- bobyタグ内の処理を記述 -->
    <div>
        <h2>管理者一覧画面</h2>
    </div>
    @if(session('message'))
        <div class="message">
            {{ session('message') }}
        </div>
    @endif
    <form action="{{ route('manager.index') }}" method="GET" class="form-inline">
        <div class="form-group d-flex align-items-center">
            <input type="search" name="search" class="form-control search-box-margin me-2" placeholder="検索して下さい" value="{{ request()->input('search') }}">
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
                @foreach ($manager_info as $manager)
                <tr>
                    <td>{{ $manager->name }}</td>
                    <td>{{ $manager->email }}</td>
                    <td>{{ $manager->department_name }}</td>
                    <td>
                        <a href="{{ route('manager.edit', $manager->id) }}" class="btn btn-primary custom-border">編集</a>
                        <a href="{{ route('manager.delete', $manager->id) }}" class="btn btn-danger custom-border btn_delete">削除</a>
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