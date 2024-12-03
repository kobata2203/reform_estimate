@extends('layouts.main')
@section('title', '見積書一覧画面（営業者用）')
@section('headder')
    <!-- 個別のCSS・JSなどの読み込み -->
    <link rel="stylesheet" href="{{ asset('css/estimate_index.css') }}">
@endsection
@section('content')
    <div>
        <h3>見積書一覧画面<br>（営業者用）</h3>
    </div>
    @if(session('message'))
        <div>
            {{ session('message') }}
        </div>
    @endif
    <div class="search-salesperson">
        <h6>見積書発行日, お客様名, 工事名, 営業担当, 営業部署</br>で検索してください。</h6>
        <div>
            <form action="{{ route('estimate.index') }}" method="GET">
                @csrf
                <input type="text" name="keyword" class="form-control search-box-margin me-2" placeholder="検索して下さい" value="{{ $keyword }}">
                <button type="submit" class="btn-primary custom-border">検索</button>
            </form>
        </div>
    </div>
    <div class="table-container">
        <table id="table02">
            <thead>
                <th>見積書発行日</th>
                <th>お客様名</th>
                <th>工事名</th>
                <th>営業担当</th>
                <th>営業部署</th>
                <th>PDF</th>
                <th></th>
            </thead>
            {{-- <tbody>
                @foreach ($estimate_info as $estimate)
                    <div>
                        <tr>
                            <td><a href="{{ route('estimate.edit', $estimate->id) }}">{{ $estimate->creation_date }}</a></td>
                            <td>{{ $estimate->customer_name }}</td>
                            <td>
                                @foreach($construction_list[$estimate->id] as $item)
                                    <a href="{{ route('estimate.breakdown_create',['id' => $estimate->id]) }}" method="GET">{{ $item }}</a></br>
                                @endforeach
                            </td>
                            <td>{{ $estimate->charger_name }}</td>
                            <td>{{ $departments[$estimate->department_id] }}</td>
                            <td>
                                <a href="{{ route('managers.show', $estimate->id) }}" class="btn btn-primary custom-border">閲覧</a><br/>
                            </td>
                            <td>
                                <button class="btn btn-danger"  data-url="{{ route('estimate.delete', $estimate->id) }}">削除</button>
                            </td>
                        </tr>
                    </div>
                @endforeach
            </tbody> --}}
            <tbody>
                @foreach ($estimate_info ?? [] as $estimate)
                    <div>
                        <tr>
                            <td><a href="{{ route('estimate.edit', $estimate->id) }}">{{ $estimate->creation_date }}</a></td>
                            <td>{{ $estimate->customer_name }}</td>
                            <td>
                                @foreach($construction_list[$estimate->id] ?? [] as $item)
                                    <a href="{{ route('estimate.breakdown_create', ['id' => $estimate->id]) }}" method="GET">{{ $item }}</a></br>
                                @endforeach
                            </td>
                            <td>{{ $estimate->charger_name }}</td>
                            <td>{{ $departments[$estimate->department_id] ?? 'N/A' }}</td>
                            <td>
                                <a href="{{ route('managers.show', $estimate->id) }}" class="btn btn-primary custom-border">閲覧</a><br/>
                            </td>
                            <td>
                                <button class="btn btn-danger" data-url="{{ route('estimate.delete', $estimate->id) }}">削除</button>
                            </td>
                        </tr>
                    </div>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="btn-menu">
        <form action="{{ route('salesperson_menu') }}" method="GET">
            @csrf
            <button class="btn btn-primary custom-border">戻る</button>
        </form>
    </div>
@endsection
