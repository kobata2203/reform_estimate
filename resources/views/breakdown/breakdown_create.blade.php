@extends('layouts.main')

@section('title', '見積書作成画面(内訳明細書)')

@section('headder')
    <link rel="stylesheet" href="{{ asset('css/breakdown_create.css') }}">
    <script src="{{ asset('/js/estimate/breakdown_create.js') }}"></script>
@endsection

@section('content')
    <div>
        <p>見積書作成画面<br>(内訳明細書)</p>
    </div>
    <div class="table-container">
        <form action="{{ route('estimate.breakdown_store') }}" method="post">
            @csrf
            <table>
            <input type="hidden" name="estimate_id" value="{{ $estimate_info->id}}">
            <input type="hidden" name="construction_id" value="{{ $estimate_info->construction_id }}">
            <table>
                <thead>
                    <th>項目</th>
                    <th>仕様・摘要</th>
                    <th>数量</th>
                    <th>単位</th>
                    <th>単価</th>
                    <th>金額</th>
                    <th>備考</th>
                </thead>
                <tbody>
                    @for($i = 1; $i <= $construction_loop_count; $i++)
                        <tr>
                            <td>
                                <select name="construction_item[{{$i}}]">
                                    @foreach ($construction_items as $construction_item)
                                        <option value="{{$construction_item['item_id']}}"
                                            @if (old("construction_item.$i") == $construction_item['item_id'] || $breakdown_items[$i - 1]->construction_item == $construction_item['item_id'])
                                                selected
                                            @endif
                                        >{{$construction_item['item']}}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has("construction_item.$i"))
                                    <div class="invalid-feedback" role="alert">
                                        {{ $errors->first("construction_item.$i") }}
                                    </div>
                                @endif
                            </td>
                            <td><input id="specification_{{$i}}" type="text" name="specification[{{$i}}]" value="{{ old("specification.$i", $breakdown_items[$i - 1]->specification) }}">
                                @if ($errors->has("specification.$i"))
                                    <div class="invalid-feedback" role="alert">
                                        {{ $errors->first("specification.$i") }}
                                    </div>
                                @endif
                            </td>
                            <td><input id="quantity_{{$i}}" class="amount_output" data-count="{{$i}}" type="number" name="quantity[{{$i}}]" value="{{ old("quantity.$i", $breakdown_items[$i - 1]->quantity) }}">
                                @if ($errors->has("quantity.$i"))
                                    <div class="invalid-feedback" role="alert">
                                        {{ $errors->first("quantity.$i") }}
                                    </div>
                                @endif
                            </td>
                            <td><input id="unit_{{$i}}" type="text" name="unit[{{$i}}]" value="{{ old("unit.$i", $breakdown_items[$i - 1]->unit) }}">
                                @if ($errors->has("unit.$i"))
                                    <div class="invalid-feedback" role="alert">
                                        {{ $errors->first("unit.$i") }}
                                    </div>
                                @endif
                            </td>
                            <td><input id="unit_price_{{$i}}" class="amount_output" data-count="{{$i}}" type="number" name="unit_price[{{$i}}]" value="{{ old("unit_price.$i", $breakdown_items[$i - 1]->unit_price) }}">
                                @if ($errors->has("unit_price.$i"))
                                    <div class="invalid-feedback" role="alert">
                                        {{ $errors->first("unit_price.$i") }}
                                    </div>
                                @endif
                            </td>
                            <td><input id="amount_{{$i}}" type="text" name="amount[{{$i}}]" value="{{ old("amount.$i", $breakdown_items[$i - 1]->amount) }}">
                                @if ($errors->has("amount.$i"))
                                    <div class="invalid-feedback" role="alert">
                                        {{ $errors->first("amount.$i") }}
                                    </div>
                                @endif
                            </td>
                            <td><input id="remarks_{{$i}}" type="text" name="remarks[{{$i}}]" value="{{ old("remarks.$i", $breakdown_items[$i - 1]->remarks) }}">
                                @if ($errors->has("remarks.$i"))
                                    <div class="invalid-feedback" role="alert">
                                        {{ $errors->first("remarks.$i") }}
                                    </div>
                                @endif
                            </td>
                        </tr>
                    @endfor
                </tbody>
            </table>
            <button type="submit">登録</button>
            <input type="hidden" name="regist_flag" value="{{$regist_flag}}">
            <input type="hidden" name="construction_loop_count" value="{{$construction_loop_count}}">
            <button type="button" class="btn btn-link" id="btn_back"  data-url="{{$prevurl}}">戻る</button>
        </form>
    </div>
@endsection
