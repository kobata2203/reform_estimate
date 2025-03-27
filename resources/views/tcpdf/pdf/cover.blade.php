<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>御見積書</title>

    <style>
       {!! file_get_contents(public_path('css/pdf/cover.css')) !!}
    </style>
</head>

<body>
    <h2>御　見　積　書</h2>

    <div class="flex-container">
        <div class="right-align">
            <p>{{ $estimate_info->creation_date }}</p>
        </div>
    </div>

    <div>
            <p class="customer-name"><strong>お客様名 :</strong> {{ $estimate_info->customer_name }} 様</p>
            <p class="estimate-description">下記の通りお見積り申し上げます。</p>
            <p class="estimate-amount"><strong>お見積り金額 :</strong>  ¥ {{ number_format($totalGrandTotal) }}（税込）</p>
    </div>

    <table>

        <tr>
            <th>件名</th>
                <td class="adjust-font table-data" style="font-size: {{ $font_size_construction }}px;">
                <span>{{ $estimate_info->subject_name }}</span>
                <span style="white-space: nowrap;">
                    @foreach ($construction_list as $index => $item)
                        {{ $item->name }}
                        @if ($index < count($construction_list) - 1)
                            /
                        @endif
                    @endforeach
                </span>
            </td>
        </tr>

        <tr>
            <th>納入場所</th>
            <td class="adjust-font" style="font-size: {{ $font_size_delivery }}px;">
                <span>{{ $estimate_info->delivery_place }}</span>
            </td>
        </tr>
        <tr>
            <th>工期</th>
            <td class="adjust-font">{{ $estimate_info->construction_period }}</td>
        </tr>
        <tr>
            <th>支払方法</th>
            <td class="adjust-font">{{ $estimate_info->payment->name }}</td>
        </tr>
        <tr>
            <th>有効期限</th>
            <td class="adjust-font">{{ $estimate_info->expiration_date }}</td>
        </tr>

        <tr>
            <th>備考</th>
            <td class="table-data adjust-font" style="font-size: {{ $font_size_remarks }}px;">
                <span>{{ $estimate_info->remarks }}</span>
            </td>
        </tr>

    </table>

    <div class="contact-info">
        <p>株式会社サーバントップ<br>
            〒591-8023<br>
            大阪府堺市北区中百舌鳥町2-34<br>
            お客様専用窓口：0120-01-3810<br>
            担当：{{ $estimate_info->charger_name }}</p>
    </div>
</body>

</html>
