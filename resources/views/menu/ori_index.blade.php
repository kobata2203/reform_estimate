@extends('layouts.main')

@section('title', $title_name. 'メニュー画面')

@section('headder')
    <!-- 個別のCSS・JSなどの読み込み -->
    <link rel="stylesheet" href="{{ asset('css/menu/index.css') }}">
@endsection

@section('content')
    <!-- bobyタグ内の処理を記述 -->
    @dump(Auth::user())
    <div>
      <h1>{{ $title_name }}Menu</h1>
      <p>いずれかのボタンをクリックしてください。</p>
    </div>
    <div class="button-container">
        @if(Auth::check() && Auth::user()->role === \App\Models\User::ROLE_SALES)
            <a href="{{ route('estimate.create') }}" class="menu-button">見積書作成へ</a>
            <a href="{{ route('estimate.index') }}" class="menu-button">見積書一覧へ</a>
            <a href="{{ route('sales_logout') }}" class="menu-button"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                ログアウト
            </a>
            <form id="logout-form" action="{{ route('sales_logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        @elseif(Auth::check() && Auth::user()->role === \App\Models\User::ROLE_ADMIN)
            <a href="{{ route('estimate.index') }}" class="menu-button">見積書一覧へ</a>
            <a href="{{ route('salesperson.create') }}" class="menu-button">営業者登録へ</a>
            <a href="{{ route('salesperson.index') }}" class="menu-button">営業者一覧へ</a>
            <a href="{{ route('manager.create') }}" class="menu-button">管理者登録へ</a>
            <a href="{{ route('manager.index') }}" class="menu-button">管理者一覧画面へ</a>
            <a href="{{ route('admin_logout') }}" class="menu-button"
                onclick="event.preventDefault(); document.getElementById('admin-logout-form').submit();">
                ログアウト
            </a>
            <form id="admin-logout-form" action="{{ route('admin_logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        @endif
    </div>
@endsection
