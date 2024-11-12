@extends('layouts.main')
@section('title', '営業者一覧画面')
@section('headder')
    <!-- 個別のCSS・JSなどの読み込み -->
    <link rel="stylesheet" href="{{ asset('css/managerindex1.css') }}">
@endsection
@section('content')
    <!-- bobyタグ内の処理を記述 -->
    <div>
        <h1 style="text-align: center; background-color:orange ; margin:10px">営業者一覧画面</h1>
    </div>
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
                            {{-- <button href="{{ route('salesperson.edit', $user->id) }}" class="btn btn-dark">編集</button> --}}
                            <button onclick="window.location.href='{{ route('salesperson.edit', $user->id) }}'" class="btn btn-dark">編集</button>

                            <form action="{{ route('salesperson.destroy', $user->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')

                            </form>
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
