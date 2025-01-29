@extends('layouts.main')

@section('title', '営業者メニュー画面')

@section('headder')
    <!-- 個別のCSS・JSなどの読み込み -->
    <link rel="stylesheet" href="{{ asset('css/menu/menuindex.css') }}">
@endsection

@section('content')
    <!-- bobyタグ内の処理を記述 -->
    <div>
      <h1>担当者Menu</h1>
      <p>いずれかのボタンをクリックしてください。</p>
    </div>
    <div class="button-container">
        <form method="GET" action="estimate/create">
            @csrf
                <button>見積書作成へ</button><br>
        </form>

        <form method="GET" action="estimate/index">
            @csrf
                <button>見積書一覧へ</button>
        </form>

        <form method="GET" action="auth/logout">
            @csrf
            <button>ログアウト</button>
        </form>
    </div>
@endsection
