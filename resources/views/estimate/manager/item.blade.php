<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>内訳明細書</title>
    <link rel="stylesheet" href="{{ asset('css/ichirann.css') }}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="{{ asset('js/brekdown.js') }}"></script>
</head>

<body class="estimate-detail">
    <div>
        <h2>内訳明細書</h2>
    </div>
    <div class="contact-info">
        <p>株式会社サーバントップ</p>
    </div>

    <div class="construction-name">
        <label for="construction-name">工事名</label>
        <input type="text" id="construction-name" name="construction_name"
            value="{{ $construction_list->name ?? '' }}">

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
                        // 割引後の小計を計算
                        $subtotal = $totalAmount - $discount;
                        //小計の税金（10%）を計算
                        $tax = $subtotal * 0.1;
                        //合計金額を計算
                        $grandTotal = $subtotal + $tax;
                    @endphp
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
            <div class="actions-2">
                <div class="action2">
                    <button type="submit" class="btn btn-primary">計算する</button>
                </div>
            </div>
        </form>
    </div>

    <div class="actions-2">
        <div class="action2">
            <a href="{{ route('managers.show', ['id' => $id]) }}" class="btn btn-primary no-print">御見積書</a>
            <a href="{{ route('generatebreakdown', ['id' => $id]) }}" class="btn btn-primary no-print">View PDF</a>
            <a href="{{ route('manager_estimate') }}" class="btn btn-primary no-print">戻る</a>
        </div>
    </div>

</body>

</html>
