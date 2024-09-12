@extends('layouts.app1')

@section('content')
<div class="manager-details mt-5">
    <h2>管理者詳細情報</h2>
    <p><strong>名前:</strong> {{ $manager->name }}</p>
    <p><strong>メール:</strong> {{ $manager->email }}</p>
    <p><strong>部署:</strong> {{ $manager->department_name }}</p>
    <a href="{{ route('managers.index') }}" class="btn btn-secondary">戻る</a>
</div>
@endsection
