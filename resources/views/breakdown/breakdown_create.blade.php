<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>見積書作成画面(内訳明細書)</title>
    <link rel="stylesheet" href="css/estimate_index.css">
</head>

<body>
    <div>
        <p>見積書作成画面<br>(内訳明細書)</p>
    </div>
    <div class="table-container">
        <table>
        <form action="{{ route('estimate.breakdown_store') }}" method="post">
            @csrf
            <div>
                <table>
                    <thead>
                        <th>見積書id</th>
                        <th>工事id</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td><input type="hidden"name="estimate_id" value="{{ $estimate_info->id}}">{{ $estimate_info->id}}</td>
                            <td><input type="hidden"name="construction_id" value="{{ $estimate_info->construction_id }}">{{ $estimate_info->construction_id }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
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
                    @php
                        $j = DB::{'construction_name'->loop_count}
                    @endphp
                    @for($i = 1;$i < $j;$i++)
                        <tr>
                            <td><input id="construction_item1" type="text" name="construction_item[$i]" placeholder="既存洗い場タイル解体" value="既存洗い場タイル解体"></td>
                            <td><input id="specification1" type="text" name="specification[$i]"></input></td>
                            <td><input id="quantity1" type="text" name="quantity[$i]"></input></td>
                            <td><input id="unit1" type="text" name="unit[$i]"></input></td>
                            <td><input id="unit_price1" type="text" name="unit_price[$i]"></input></td>
                            <td><input id="amount1" type="text" name="amount[$i]"></input></td>
                            <td><input id="remarks2_1" type="text" name="remarks2[$i]"></input></td>
                        </tr>
                    @endfor
                </tbody>
            </table>
                <td><button type="submit">登録</button></td>
        </form>
    </div>
</body>

</html>
