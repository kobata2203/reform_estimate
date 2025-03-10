@extends('layouts.main')

@section('title', '見積書作成画面(内訳明細書)')

@section('headder')
    <link rel="stylesheet" href="{{ asset('css/breakdown/create.css') }}">
    <script src="{{ asset('/js/breakdown/create.js') }}"></script>
@endsection

@section('content')
    <div>
        <h4>見積書作成画面<br>（内訳明細書）</h4>
    </div>
    <div class="table-container">
        <form action="{{ $breakdown_store_routing }}" method="post">
            @csrf
            <table>
            <input type="hidden" name="estimate_id" value="{{ $estimate_info->id}}">
            <input type="hidden" name="construction_id" value="{{ $construction_id }}">
            <input type="hidden" name="construction_list_id" value="{{ $cid }}">

            <table id="breakdown_table" class="breakdown">
                <thead>
                    <th>項目</th>
                    <th>メーカー名</th>
                    <th>シリーズ名（商品名）</th>
                    <th>品番</th>
                    <th class="quantity">数量</th>
                    <th class="unit">単位</th>
                    <th class="unit_price">単価</th>
                    <th class="amount">金額</th>
                    <th>備考</th>
                    <th></th>
                </thead>
                <tbody>
                    @foreach($breakdown_items as $key => $item)
                        @php
                            $i = $key++
                        @endphp
                        <tr id="breakdown_no_{{$i}}">
                            <td><input id="item_{{$i}}" type="text" name="item[{{$i}}]" value="{{ old("item.$i", $item->item) }}" required>
                                @if ($errors->has("item.$i"))
                                    <div class="invalid-feedback" role="alert">
                                        {{ $errors->first("item.$i") }}
                                    </div>
                                @endif
                            </td>
                            <td><input id="maker_{{$i}}" type="text" name="maker[{{$i}}]" value="{{ old("maker.$i", $item->maker) }}">
                                @if ($errors->has("maker.$i"))
                                    <div class="invalid-feedback" role="alert">
                                        {{ $errors->first("maker.$i") }}
                                    </div>
                                @endif
                            </td>
                            <td><input id="series_name_{{$i}}" type="text" name="series_name[{{$i}}]" value="{{ old("series_name.$i", $item->series_name) }}">
                                @if ($errors->has("series_name.$i"))
                                    <div class="invalid-feedback" role="alert">
                                        {{ $errors->first("series_name.$i") }}
                                    </div>
                                @endif
                            </td>
                            <td><input id="item_number_{{$i}}" type="text" name="item_number[{{$i}}]" value="{{ old("item_number.$i", $item->item_number) }}">
                                @if ($errors->has("item_number.$i"))
                                    <div class="invalid-feedback" role="alert">
                                        {{ $errors->first("item_number.$i") }}
                                    </div>
                                @endif
                            </td>
                            <td><input id="quantity_{{$i}}" class="quantity amount_output" data-count="{{$i}}" type="number" name="quantity[{{$i}}]" value="{{ old("quantity.$i", $item->quantity) }}" required>
                                @if ($errors->has("quantity.$i"))
                                    <div class="invalid-feedback" role="alert">
                                        {{ $errors->first("quantity.$i") }}
                                    </div>
                                @endif
                            </td>
                            <td><input id="unit_{{$i}}" class="unit" type="text" name="unit[{{$i}}]" value="{{ old("unit.$i", $item->unit) }}" required>
                                @if ($errors->has("unit.$i"))
                                    <div class="invalid-feedback" role="alert">
                                        {{ $errors->first("unit.$i") }}
                                    </div>
                                @endif
                            </td>
                            <td><input id="unit_price_{{$i}}" class="unit_price amount_output" data-count="{{$i}}" type="number" name="unit_price[{{$i}}]" value="{{ old("unit_price.$i", $item->unit_price) }}" required>
                                @if ($errors->has("unit_price.$i"))
                                    <div class="invalid-feedback" role="alert">
                                        {{ $errors->first("unit_price.$i") }}
                                    </div>
                                @endif
                            </td>
                            <td><input id="amount_{{$i}}" class="amount" type="number" name="amount[{{$i}}]" value="{{ old("amount.$i", $item->amount) }}" required>
                                @if ($errors->has("amount.$i"))
                                    <div class="invalid-feedback" role="alert">
                                        {{ $errors->first("amount.$i") }}
                                    </div>
                                @endif
                            </td>
                            <td><input id="remarks_{{$i}}" type="text" name="remarks[{{$i}}]" value="{{ old("remarks.$i", $item->remarks) }}">
                                @if ($errors->has("remarks.$i"))
                                    <div class="invalid-feedback" role="alert">
                                        {{ $errors->first("remarks.$i") }}
                                    </div>
                                @endif
                            </td>
                            <td><button type="button" class="delete_breakdown" data-breakdown_no="{{ $i }}">削除</button></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
                <input type="hidden" id="breakdown_count" value="{{ $i }}">
                <button type="button" id="add_breakdown" class="btn-primary">追加</button>

                <button type="submit" class="btn-primary">登録</button>
{{--            <input type="hidden" name="regist_flag" value="{{$regist_flag}}">--}}
{{--            <input type="hidden" name="construction_loop_count" value="{{$construction_loop_count}}">--}}
            <button type="button" class="btn btn-link" id="btn_back" data-url="{{ route('estimate.index') }}">戻る</button>
        </form>
    </div>
@endsection
