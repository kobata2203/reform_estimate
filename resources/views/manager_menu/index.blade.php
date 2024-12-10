@extends('layouts.main')
@section('title', '管理者メニュー画面')
@section('headder')
    <!-- 個別のCSS・JSなどの読み込み -->
    <link rel="stylesheet" href="{{ asset('css/menu/menuindex.css') }}">
@endsection
@section('content')
    <!-- bobyタグ内の処理を記述 -->
    <div class="hero">
        <h1>管理者Menu</h1>
        <p>いずれかのボタンをクリックしてください。</p>
    </div>

    <div class="button-container">
        <button onclick="window.location='{{ route('manager_estimate') }}'">見積書一覧へ</button>
        <button onclick="window.location='{{ route('salesperson.create') }}'">営業者登録へ</button>
        <button onclick="window.location='{{ route('salesperson.index') }}'">営業者一覧へ</button>
        <button onclick="window.location='{{ route('manager.create') }}'">管理者登録へ</button>
        <button onclick="window.location='{{ route('manager.index') }}'">管理者一覧画面へ</button>
    </div>
@endsection