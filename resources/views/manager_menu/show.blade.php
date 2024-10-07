<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>見積書詳細</title>
    <link rel="stylesheet" href="{{ asset('css/ichirann.css') }}">
</head>

<body>
    <div class="stimate-detail">
        <div>
            <h2>見積書詳細画面</h2>
        </div>

        <div class="input-container" id="customer">
            <label for="customer-name">お客様名 :</label>
            <div class="input-underline">
                <input type="text" id="customer-name" placeholder="Customer name here"
                    value="{{ old('customer_name', $estimate_info->customer_name) }}">
                <span class="suffix">様</span>
            </div>
        </div>

        <div>
            <p style="padding-left: 60px; font-size: 9px;">下記の通りお見積り申し上げます。</p>
        </div>

        <div class="input-suffix-wrapper">
            <div class="input-suffix">
                <label for="estimate-amount">お見積り金額 :</label>
                <input type="text" id="estimate-amount" placeholder="金額を入力してください"
                    value="{{ old('estimate_amount', $estimate_info->estimate_amount) }}">
                <span class="suffix">（税込）</span>
            </div>
        </div>

        <div class="details" id="div1">
            <div class="show-page">
                <table>
                    <tr>

                        <td>件名</td>
                        <td>{{ $estimate_info->subject_name }}</td>
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
                        <td>{{ $estimate_info->payment_type }}</td>
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
            <a href="{{ route('manager.item', $estimate_info->id) }}" class="btn btn-warning">内訳明細書</a>
            <a href="{{ route('managers.pdfshow', $estimate_info->id) }}" class="btn btn-warning">View PDF</a>
            <a href="{{ route('manager_estimate') }}" class="btn btn-primary">戻る</a>
        </div>
    </div>
</body>

</html>
