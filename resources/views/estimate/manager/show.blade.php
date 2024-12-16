<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>見積書詳細</title>
    <link rel="stylesheet" href="{{ asset('css/ichirann.css') }}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="{{ asset('js/cover.js') }}"></script>
</head>

<body>
    <div>
        <div>
            <h2>御 見 積 書</h2>
        </div>

        <div style="display: flex; justify-content: flex-end; width: 100%; align-items: flex-start;">
            <div style="text-align: right;">
                <p>{{ $estimate_info->creation_date }}</p>
            </div>
        </div>

        <div class="input-container" id="customer">
            <label for="customer-name">お客様名 :</label>
            <div class="input-underline">
                <input type="text" id="customer-name" placeholder="Customer name here"
                    value="{{ old('customer_name', $estimate_info->customer_name) }}">
                <span class="suffix">様</span>
            </div>
            <span id="customer-name-byte-count"></span>
        </div>

        <div>
            <p style="display: inline; font-size: 9px; margin: 0; padding-left: 60px;">下記の通りお見積り申し上げます。</p>
        </div>

        <div class="input-suffix-wrapper" id="grandtotal">
            <div class="input-suffix">
                <label for="estimate-amount">お見積り金額 :</label>
                <span> ¥</span>
                <input type="text" id="estimate-amount" placeholder="金額を入力してください"
                    value="{{ number_format($grandTotal) }}">
                <span class="suffix">（税込）</span>
            </div>
            <span id="estimate-amount-byte-count"></span>
        </div>

        <div class="details" id="div1">
            <div class="show-page">
                <table>
                    <tr>
                        <td>件名</td>
                        <td id="construction-items">
                            @foreach ($construction_list as $index => $item)
                                {{ $item->name }}
                                @if ($index < count($construction_list) - 1)
                                    /
                                @endif
                            @endforeach
                        </td>
                    </tr>

                    <tr>
                        <td>納入場所</td>
                        <td>{{ $estimate_info->delivery_place }}</td>
                    </tr>

                    <tr>
                        <td>工期</td>
                        <td>{{ $estimate_info->construction_period }}</td>
                    </tr>

                    <tr>
                        <td>支払方法</td>
                        <td>{{ $estimate_info->payment->name }}</td>
                    </tr>

                    <tr>
                        <td>有効期限</td>
                        <td>{{ $estimate_info->expiration_date }}</td>
                    </tr>
                    <tr>
                        <td>備考</td>
                        <td>{{ $estimate_info->remarks }}</td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="contact-info" id="div2">
            <p>株式会社サーバントップ<br>
                〒591-8023<br>
                大阪府堺市北区中百舌鳥町2-34<br>
                お客様専用窓口：0120-01-3810<br>
                担当：{{ $estimate_info->charger_name }}</p>
        </div>
        <div class="action2">
            <a href="{{ route('generatecover', $estimate_info->id) }}" class="btn btn-warning">View PDF</a>
            <a href="{{ route('manager_estimate') }}" class="btn btn-primary">戻る</a>
        </div>
    </div>

</body>

</html>
