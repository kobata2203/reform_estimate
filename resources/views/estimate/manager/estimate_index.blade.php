@extends('layouts.main')
@section('title', '見積書一覧画面（管理者用）')
@section('headder')
    <!-- 個別のCSS・JSなどの読み込み -->
    <link rel="stylesheet" href="{{ asset('css/estimate/admin_index.css') }}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="{{ asset('js\estimate\manager\index.js') }}"></script>

@endsection
@section('content')
    <!-- bobyタグ内の処理を記述 -->
    <div>
        <h2>見積書一覧画面</h2>
    </div>
    <div class="search-manager">
        <h5>見積書発行日, お客様名, 工事名, 営業担当, 営業部署</br>で検索してください。</h5>
        <div>
            <form action="{{ route('manager_estimate') }}" method="GET">
                @csrf
                <input type="text" name="keyword" class="form-control search-box-margin me-2" placeholder="検索して下さい"
                    value="{{ $keyword }}">
                <button type="submit" class="btn btn-primary custom-border">検索</button>
            </form>
        </div>
    </div>
    <div>
        <table>
            <thead>
                <tr>
                    <th>見積書発行日</th>
                    <th>お客様名</th>
                    <th>工事名</th>
                    <th>営業担当</th>
                    <th>営業部署</th>
                    <th>PDF</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($estimate_info as $estimate)
                    <div>

                        <tr>
                            <td><a
                                    href="{{ route('manager_estimate.edit', $estimate->id) }}">{{ $estimate->creation_date }}</a>
                            </td>
                            <td>{{ $estimate->customer_name }}</td>
                            <td>
                                @foreach ($construction_list[$estimate->id] as $item)
                                    <a
                                        href="{{ route('manager_breakdown.create', ['id' => $item['id']]) }}">{{ $item['name'] }}</a></br>
                                @endforeach
                            </td>
                            <td>{{ $estimate->charger_name }}</td>
                            <td>{{ $departments[$estimate->department_id] }}</td>
                            <td><button data-url="{{ route('manager.item', $estimate->id) }}" class="btn btn-primary"
                                    @if ($pdf_show_flags[$estimate->id] != true) disabled @endif>閲覧</button></td>
                            <td><a href="{{ route('manager_estimate.delete', $estimate->id) }}"
                                    class="btn btn-danger btn_delete">削除</a></td>

                        </tr>
                    </div>
                @endforeach
            </tbody>
        </table>

    </div>
    <div class="col-3 margin-top-example" style="text-align: right;">
        <a href="{{ route('manager_menu') }}" class="btn btn-primary custom-border">戻る</a>
    </div>
@endsection
