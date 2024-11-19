@extends('layouts.main')
@section('title', '管見積書一覧画面（営業者用）')
@section('headder')
    <!-- 個別のCSS・JSなどの読み込み -->
    <link rel="stylesheet" href="{{ asset('css/estimate_index.css') }}">
@endsection
@section('content')
        <div>
            <p>見積書一覧画面<br>（営業者用）</p>
        </div>

        @if(session('message'))
            <div>
                {{ session('message') }}
            </div>
        @endif

        <h1>見積書発行日, お客様名, 工事名, 営業担当, 営業部署</h1>
        <div>
            <form action="{{ route('estimate.index') }}" method="GET">

            @csrf

                <input type="text" name="keyword" value="{{ $keyword }}">
                <input type="submit" value="検索">
            </form>
        </div>

        <div class="table-container">
            <table id="table02">
                <thead>
                    <th>見積書発行日</th>
                    <th>お客様名</th>
                    <th>工事名</th>
                    <th>営業担当</th>
                    <th>営業部署</th>
                    <th></th>
                    <th></th>
                </thead>
                <tbody>
                    @foreach ($estimate_info as $estimate)
                        <div>

                            <tr>
                                <td><a href="{{ route('estimate.edit', $estimate->id) }}" class="btn btn-primary">{{ $estimate->creation_date }}</a></td>
                                <td>{{ $estimate->customer_name }}</td>
                                <td>{{ $estimate->construction_name }}</td>
                                <td>{{ $estimate->charger_name }}</td>
                                <td>{{ $estimate->department_name }}</td>
                                <td><form action="{{ route('estimate.breakdown_create',['id' => $estimate->id]) }}" method="GET">
                                    @csrf
                                    <button class="btn btn-primary">内訳明細書作成へ</button>
                                </form></td>
                                <td><a href="{{ route('estimatesales', $estimate->id) }}" class="btn btn-primary">閲覧</a></td>
                            </tr>

                        </div>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="btn-menu">
            <form action="{{ route('salesperson_menu') }}" method="GET">
                @csrf
                <button class="btn btn-primary">営業者メニュー</button>
            </form>
        </div>
@endsection