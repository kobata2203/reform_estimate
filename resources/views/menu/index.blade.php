@extends('layouts.main')

@section('title', $title_name. 'メニュー画面')

@section('headder')
    <!-- 個別のCSS・JSなどの読み込み -->
    <link rel="stylesheet" href="{{ asset('css/menu/index.css') }}">
@endsection

@section('content')
    <!-- bobyタグ内の処理を記述 -->
    <div>
      <h1>{{ $title_name }}Menu</h1>
      <p>いずれかのボタンをクリックしてください。</p>
    </div>
    <div class="button-container">
        @if(Auth::check())
            @if(Auth::user()->role === \App\Models\User::ROLE_SALES)
                <button onclick="window.location.href='{{ route('estimate.create') }}'">見積書作成へ</button>
                <button onclick="window.location.href='{{ route('estimate.index') }}'">見積書一覧へ</button>
                <button onclick="window.location.href='{{ route('sales_logout') }}'">ログアウト</button>
            @elseif(Auth::user()->role === \App\Models\User::ROLE_ADMIN)
                <button onclick="window.location.href='{{ route('estimate.index') }}'">見積書一覧へ</button>
                <button onclick="window.location.href='{{ route('salesperson.create') }}'">営業者登録へ</button>
                <button onclick="window.location.href='{{ route('salesperson.index') }}'">営業者一覧へ</button>
                <button onclick="window.location.href='{{ route('manager.create') }}'">管理者登録へ</button>
                <button onclick="window.location.href='{{ route('manager.index') }}'">管理者一覧画面へ</button>
                <button onclick="window.location.href='{{ route('admin_logout') }}'">ログアウト</button>
            @endif
        @else
            <p>ログインしてください。</p>
        @endif    
    </div>
@endsection
