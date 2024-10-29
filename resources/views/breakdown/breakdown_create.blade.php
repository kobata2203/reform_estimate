<!DOCTYPE html>
<html lang="jp">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>見積書作成画面(内訳明細書)</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <link rel="stylesheet" href="breakdown_create.css">
        <script src="{{ asset('/js/estimate/breakdown_create.js') }}"></script>
    </head>

<body>
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
                                            @if (old("construction_item.$i") == $construction_item['item_id'])
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
                            <td><input id="specification_{{$i}}" type="text" name="specification[{{$i}}]" value="{{ old("specification.$i") }}">
                                @if ($errors->has("specification.$i"))
                                    <div class="invalid-feedback" role="alert">
                                        {{ $errors->first("specification.$i") }}
                                    </div>
                                @endif
                            </td>
                            <td><input id="quantity_{{$i}}" class="amount_output" data-count="{{$i}}" type="number" name="quantity[{{$i}}]" value="{{ old("quantity.$i") }}">
                                @if ($errors->has("quantity.$i"))
                                    <div class="invalid-feedback" role="alert">
                                        {{ $errors->first("quantity.$i") }}
                                    </div>
                                @endif
                            </td>
                            <td><input id="unit_{{$i}}" type="text" name="unit[{{$i}}]" value="{{ old("unit.$i") }}">
                                @if ($errors->has("unit.$i"))
                                    <div class="invalid-feedback" role="alert">
                                        {{ $errors->first("unit.$i") }}
                                    </div>
                                @endif
                            </td>
                            <td><input id="unit_price_{{$i}}" class="amount_output" data-count="{{$i}}" type="number" name="unit_price[{{$i}}]" value="{{ old("unit_price.$i") }}">
                                @if ($errors->has("unit_price.$i"))
                                    <div class="invalid-feedback" role="alert">
                                        {{ $errors->first("unit_price.$i") }}
                                    </div>
                                @endif
                            </td>
                            <td><input id="amount_{{$i}}" type="text" name="amount[{{$i}}]" value="{{ old("amount.$i") }}">
                                @if ($errors->has("amount.$i"))
                                    <div class="invalid-feedback" role="alert">
                                        {{ $errors->first("amount.$i") }}
                                    </div>
                                @endif
                            </td>
                            <td><input id="remarks2_{{$i}}" type="text" name="remarks2[{{$i}}]" value="{{ old("remarks2.$i") }}">
                                @if ($errors->has("remarks2.$i"))
                                    <div class="invalid-feedback" role="alert">
                                        {{ $errors->first("remarks2.$i") }}
                                    </div>
                                @endif
                            </td>
                        </tr>
                    @endfor
                </tbody>
            </table>
            <button type="submit">登録</button>
            <input type="hidden" name="construction_loop_count" value="{{$construction_loop_count}}">
        </form>
        <div>
          <form method="GET" action="estimate/index">
            @csrf
                <button>見積書一覧へ</button>
        </form>
        </div>
    </div>
</body>

</html>
