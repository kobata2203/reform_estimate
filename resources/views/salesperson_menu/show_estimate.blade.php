
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>内訳明細書</title>
    <link rel="stylesheet" href="{{ asset('css/ichirann.css') }}">
</head>
<body class="estimate-detail">
    <div>
        <h2>内訳明細書</br>(営業者用)</h2>
    </div>
    <div class="contact-info">
        <p>株式会社サーバントップ</p>
    </div>

    <div class="construction-name">
        <label for="construction-name">工事名</label>
        <input type="text" id="construction-name" name="construction_name"
            value="{{ $estimate_info->construction_name ?? '' }}"
            placeholder="工事名を入力してください">
    </div>

    <div>
        <form action="{{ route('updateDiscount', ['id' => $id]) }}" method="POST">
            @csrf
        <table class="table-large item-table estimate-item-table">
            <tr class="iro">
                <th>項目</th>
                <th>仕様・摘要</th>
                <th>数量</th>
                <th>単位</th>
                <th>単価</th>
                <th>金額</th>
                <th>備考</th>
            </tr>
            @php
                $totalAmount = 0;
            @endphp
            @foreach ($breakdown as $item)
                @php
                    $totalAmount += $item->amount;
                    @endphp
                <tr>
                    <td>{{ $item->construction_item }}</td>
                    <td>{{ $item->specification }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ $item->unit }}</td>
                    <td>{{ number_format($item->unit_price) }}</td>
                    <td><span> ¥　</span>{{ number_format($item->amount) }}</td>
                    <td>{{ $item->remarks }}</td>
                </tr>
            @endforeach
            <tr>
                <td colspan="5" class="custom-width" style="text-align: right;">特別お値引き</td>
                <td>
                    <div class="amount-container">
                        <span class="yen-symbol">¥</span>
                    <input type="number" id="special_discount" name="special_discount"
                        value="{{ $discount }}" placeholder="お値引き金額を入力してください"
                        style="text-align: center; width: 90%; padding: 5px; font-size: 15px;  width: 120px;">
                    </div>
                </td>
            @php
                // Calculate subtotal after discount
                $subtotal = $totalAmount - $discount;
                // Calculate tax (10%)
                $tax = $subtotal * 0.1;
                // Calculate grand total
                $grandTotal = $subtotal + $tax;
            @endphp
            <tr>
                <td colspan="5" class="custom-width" style="text-align: right;">小計（税抜）</td>
                <td class="currency"><span> ¥　</span>{{ number_format($subtotal) }}</td> <!-- Use calculated $subtotal -->

            </tr>
            <tr>
                <td colspan="5" class="custom-width" style="text-align: right;">消費税（10%）</td>
                <td class="currency"><span> ¥　</span>{{ number_format($tax) }}<!-- Use calculated $tax -->
            </tr>
            <tr>
                <td colspan="5" class="custom-width" style="text-align: right;">合計（税込）</td>
                <td class="currency"><span> ¥　</span>{{ number_format($grandTotal) }}</td> <!-- Use calculated $grandTotal -->
            </tr>
        </table>
        <div class="actions-2">
            <div class="action2">
                <button type="submit" class="btn btn-primary">計算する</button> <!-- Update button -->
            </div>
        </div>
    </form>
    </div>

    <div class="actions-2">
        <div class="action2">
            <a href="{{ route('showestimate', ['id' => $id]) }}" class="btn btn-primary no-print">御見積書</a>
            {{-- <button class="btn btn-primary no-print" style="margin: 10px;" onclick="printPage()">Print PDF</button> --}}
            <a href="{{ route('showPdftrail', ['id' => $id]) }}" class="btn btn-primary no-print">View PDF</a>
            <a href="{{ route('manager_estimate') }}" class="btn btn-primary no-print">戻る</a>
        </div>
    </div>

</body>
</html>
