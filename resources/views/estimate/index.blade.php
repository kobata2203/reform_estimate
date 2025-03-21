@extends('layouts.main')
@section('title', '見積書一覧画面（営業者用）')
@section('headder')
    <!-- 個別のCSS・JSなどの読み込み -->
    <link rel="stylesheet" href="{{ asset('css/estimate/index.css') }}">
    <script src="{{ asset('/js/estimate/index.js') }}"></script>
@endsection
@section('content')
    <div>
        <h3>見積書一覧画面</h3>
    </div>
    <div class="search-salesperson">
        @if(session('message'))
        <div class="message">
            {{ session('message') }}
        </div>
        @endif
        <h6>見積書発行日, お客様名, 工事名, 営業担当, 営業部署で検索してください。</h6>
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
            <tbody>
                @foreach ($estimate_info as $estimate)
                    <div>
                        <tr>
                            <td><a href="{{ route('estimate.edit', $estimate->id) }}">{{ $estimate->creation_date }}</a></td>
                            <td>{{ $estimate->customer_name }}</td>
                            <td>
                                @foreach($construction_list[$estimate->id] as $item)
                                     <a href="{{ route($breakdown_create_routing,['id' => $estimate->id, 'cid' => $item['id']]) }}">{{ $item['name'] }}</a></br>
                                @endforeach
                            </td>
                            <td>{{ $estimate->charger_name }}</td>
                            <td>{{ $departments[$estimate->department_id] }}</td>
                            <td>
                                <button data-url="{{ route('salesperson.show', $estimate->id) }}" class="btn btn-primary custom-border btn_pdf" @if($pdf_show_flags[$estimate->id] != true) disabled @endif>閲覧</button><br/>
                            </td>
                            <td>
                                <button class="btn btn-danger btn_delete" data-url="{{ route('estimate.delete', $estimate->id) }}">削除</button>
                            </td>
                        </tr>
                    </div>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="btn-menu">
        <button class="btn btn-primary" id="btn_back"  data-url="{{ route('menu') }}">戻る</button>
    </div>
@endsection
