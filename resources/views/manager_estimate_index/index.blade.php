@extends('layouts.app1')

@section('content')
<div class="estimate_info mt-5">
    <h2>見積書情報</h2>
    <div class="search-bar mb-3">
        <form action="{{ route('managers.index') }}" method="GET">
            <label for="search">見積書発行日、お客様名、工事名、営業担当、営業部署で検索</label>
            <input type="text" name="search" id="search" value="{{ request('search') }}">
            <button type="submit" class="btn btn-primary">検索</button>
        </form>
    </div>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>見積書発行日</th>
                <th>お客様名</th>
                <th>工事名</th>
                <th>営業担当者</th>
                <th>営業部署</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($manager_info as $manager)
                <tr>
                    <td>{{ $manager->creation_date }}</td>
                    <td>{{ $manager->customer_name }}</td>
                    <td>{{ $manager->construction_name }}</td>
                    <td>{{ $manager->charger_name }}</td>
                    <td>{{ $manager->department_name }}</td>
                    <td><a href="{{ route('managers.show', $manager->id) }}" class="btn btn-info">閲覧</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div>
        <button id="menu" class="btn btn-secondary">管理者メニュー</button>
    </div>
</div>
@endsection
