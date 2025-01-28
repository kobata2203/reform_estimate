<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>内訳明細書</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            font-size: 14px;
        }

        .container {
            width: 80%;
            margin: 20px auto;
            padding: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px auto;
        }

        th,
        td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
        }

        .custom-width {
            text-align: right;
        }

        .amount-container {
            display: flex;
            align-items: center;
        }

        .amount-container .yen-symbol {
            margin-right: 5px;
        }

        input[type="number"] {
            text-align: center;
            width: 120px;
            padding: 5px;
            font-size: 15px;
        }

        h2 {
            text-align: center;
            border: 2px solid #160202;
            padding: 20px;
            margin: 2px;
            width: 100%;
            box-sizing: border-box;
            background-color: rgb(186, 182, 182);
        }
    </style>
</head>

<body>
    <h2>内訳明細書</h2>
    <p style="text-align: right;">株式会社サーバントップ</p>

    <p>
        <strong style="border-bottom: 1px solid black; padding-bottom: 10px;">
            工事名:</strong><span id="construction-name-text"
            style="border-bottom: 1px solid black;">{{ $construction_list->name }}</span>
    </p>

    <table>
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
                    <td>{{ $item->item }}</td>
                    <td style="font-size: {{ $font_size }}px; text-align: center;">
                        {{ $item->maker }}&ensp;{{ $item->series_name }}&ensp;{{ $item->item_number }}
                    </td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ $item->unit }}</td>
                    <td>{{ number_format($item->unit_price) }}</td>
                    <td>{{ '¥ ' . number_format($item->amount) }}</td>
                    <td>{{ $item->remarks }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            @php
                // Calculations
                $subtotal = $totalAmount - $discount;
                $tax = $subtotal * 0.1;
                $grandTotal = $subtotal + $tax;
            @endphp
            <tr>
                <td colspan="5" class="custom-width">特別お値引き</td>
                <td style="text-align: center;">
                    <div class="amount-container">
                        <span>¥ </span>
                        <span>{{ number_format($discount) }}</span>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="5" class="custom-width">小計（税抜）</td>
                <td>¥ {{ number_format($subtotal) }}</td>
            </tr>
            <tr>
                <td colspan="5" class="custom-width">消費税（10%）</td>
                <td>¥ {{ number_format($tax) }}</td>
            </tr>
            <tr>
                <td colspan="5" class="custom-width">合計（税込）</td>
                <td>¥ {{ number_format($grandTotal) }}</td>
            </tr>
        </tfoot>
    </table>
</body>

</html>
