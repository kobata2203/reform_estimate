@extends('layouts.main')

@section('title', $title_name. 'メニュー画面')

@section('headder')
    <!-- 個別のCSS・JSなどの読み込み -->
    <link rel="stylesheet" href="{{ asset('css/menu/index.css') }}">
    <script src="{{ asset('/js/menu.js') }}"></script>
@endsection

@section('content')
    <!-- bobyタグ内の処理を記述 -->
    <div>
      <h1>{{ $title_name }}Menu</h1>
      <p>いずれかのボタンをクリックしてください。</p>
    </div>
    <div class="button-container">
        @if(Auth::check())
            @can('sales-access')
                <button data-url="{{ route('estimate.create') }}">見積書作成へ</button>
                <button data-url="{{ route('estimate.index') }}">見積書一覧へ</button>
                <button data-url="{{ route('sales_logout')}} ">ログアウト</button>
            @endcan
            @can('admin-access')
                <button data-url="{{route('estimate.index')}}" >見積書一覧へ</button>
                <button data-url="{{ route('salesperson.create') }}">営業者登録へ</button>
                <button data-url="{{ route('salesperson.index') }}">営業者一覧へ</button>
                <button data-url="{{ route('manager.create') }}">管理者登録へ</button>
                <button data-url="{{ route('manager.index') }}">管理者一覧画面へ</button>
                <button data-url="{{ route('admin_logout') }}">ログアウト</button>
            @endcan
        @else
            <p>ログインしてください。</p>
        @endif
    </div>
@endsection
