<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>内訳明細書</title>
    {{-- <link rel="stylesheet" href="{{ asset('css/ichirann.css') }}"> --}}
    <style>
        body {
            font-family: 'kozgopromedium', sans-serif;
            font-size: 12pt;
        }

        h2 {
            text-align: center;
            border: 2px solid #160202;
            /* Border color and width */
            padding: 20px;
            /* Space inside the border */
            margin: 2px;
            /* Remove default margin */
            width: 100%;
            /* Full width of the page */
            box-sizing: border-box;
            background-color: rgb(186, 182, 182);
        }

        .table,
        .table th,
        .table td {
            border: 1px solid black;
            border-collapse: collapse;
            padding: 5px;
        }

        .table th {
            background-color: rgb(186, 182, 182);
            text-align: center;
        }

        .table td {
            text-align: center;
        }

        .total {
            margin-top: 20px;
            text-align: right;
        }
    </style>
</head>

<body>
    <h2>内訳明細書</h2>
    <p style="text-align: right;">株式会社サーバントップ</p>

    <p><strong>工事名:</strong> {{ $estimate_info->construction_name }}</p>

    <table class="table" width="100%">
        <thead>
            <tr>
                <th>項目</th>
                <th>仕様・摘要</th>
                <th>数量</th>
                <th>単位</th>
                <th>単価</th>
                <th>金額</th>
                <th>備考</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($breakdown as $item)
                <tr>
                    <td>{{ $item->construction_item }}</td>
                    <td>{{ $item->specification }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ $item->unit }}</td>
                    <td>{{ number_format($item->unit_price) }}</td>
                    <td>{{ '¥ ' . number_format($item->amount) }}</td>
                    <td>{{ $item->remarks }}</td>
                </tr>
            @endforeach
        </tbody>
        <tr>
            <td colspan="5" class="custom-width" style="text-align: right;">特別お値引き</td>
            <td >
                <div style="display: flex; justify-content: center; ">
                    <span style="margin-right: 5px;">¥</span>
                    <input type="number" id="special_discount" name="special_discount" value="{{ $discount }}">
                </div>
            </td>

            @php
                $subtotal = $totalAmount - $discount;
                $tax = $subtotal * 0.1;
                $grandTotal = $subtotal + $tax;
            @endphp
        <tr>

        <tr>
            <td colspan="5" class="custom-width" style="text-align: right;">小計（税抜）</td>
            <td class="currency"><span> ¥　</span>{{ number_format($subtotal) }}</td>
        </tr>
        <tr>
            <td colspan="5" class="custom-width" style="text-align: right;">消費税（10%）</td>
            <td class="currency"><span> ¥　</span>{{ number_format($tax) }}
        </tr>
        <tr>
            <td colspan="5" class="custom-width" style="text-align: right;">合計（税込）</td>
            <td class="currency"><span> ¥　</span>{{ number_format($grandTotal) }}</td>
        </tr>
    </table>
</body>

</html>
