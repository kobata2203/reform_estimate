<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>内訳明細書</title>
    <style>
        {!! file_get_contents(public_path('css/cover/cover_pdf.css')) !!}
    </style>
</head>

<body>
    <h2>内訳明細書</h2>
    <p class="right-text">株式会社サーバントップ</p>

    <p>
        <strong class="border-bottom">工事名:</strong><span id="construction-name-text" class="border-bottom-text">{{ $construction_list->name }}</span>
    </p>

    <table class="table">
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
                    <td class="item-column">{{ $item->item }}</td>
                    <td class="description-column adjust-font">{{ $item->maker }}&ensp;{{ $item->series_name }}&ensp;{{ $item->item_number }}</td>
                    <td class="quantity-column">{{ $item->quantity }}</td>
                    <td class="unit-column">{{ $item->unit }}</td>
                    <td class="unit-price-column">{{ number_format($item->unit_price) }}</td>
                    <td class="amount-column">{{ '¥ ' . number_format($item->amount) }}</td>
                    <td class="remarks-column">{{ $item->remarks }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            @php
                $subtotal = $totalAmount - $discount;
                $tax = $subtotal * 0.1;
                $grandTotal = $subtotal + $tax;
            @endphp
            <tr>
                <td colspan="5" class="custom-width">特別お値引き</td>
                <td class="amount-container">
                    <span>¥ </span>
                    <span>{{ number_format($discount) }}</span>
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
