<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>御見積書</title>

    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            margin: 0;
            padding: 20px;
            font-size: 12px;
        }

        h2 {
            text-align: center;
            border: 2px solid #160202;
            padding: 20px;
            margin: 2px;
            background-color: rgb(186, 182, 182);
        }

        table {
            width: 65%;
            border-collapse: collapse;
            margin-bottom: 20px;
            table-layout: fixed;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th {
            background-color: grey;
            color: white;
        }
        td {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        th,
        td {
            padding: 10px;
            text-align:center;
        }

        .contact-info {
            width: 30%;
            font-size: 14px;
            position: absolute;
            bottom: 375px;
            right: 15px;
            margin-bottom: 300px;
        }

    </style>
</head>

<body>
    <h2>御　見　積　書</h2>

    <div style="display: flex; justify-content: space-between; width: 100%; align-items: flex-start;">
        <div style="text-align: right;">
            <p>{{ $estimate_info->creation_date }}</p>
        </div>
    </div>
    <div>
        <p style="display: inline; text-decoration: underline; margin: 0; padding: 0;"><strong>お客様名 :</strong>
            {{ $estimate_info->customer_name }} 様</p>
        <p style="display: inline; font-size: 8px; margin: 0; padding: 0;">下記の通りお見積り申し上げます。</p>
        <p style="text-align: center; margin-left: 150px; display: inline; text-decoration: underline;">
            <strong>お見積り金額 : ¥ </strong> {{ number_format($totalGrandTotal) }}（税込）
        </p>
    </div>

    <table>

        <tr>
            <th style="width: 20%; text-align:center;">件名</th>
            <td class="adjust-font" style="font-size: {{ $font_size_construction }}px;  width: 80%; max-width: 600px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
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
            <th style="width: 20%; text-align:center;">納入場所</th>
            <td class="adjust-font" style="font-size: {{ $font_size_delivery }}px; width: 80%; max-width: 600px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                <span>{{ $estimate_info->delivery_place }}</span>
            </td>
        </tr>
        <tr>
            <th style="width: 20%; text-align:center; ">工期</th>
            <td class="adjust-font">{{ $estimate_info->construction_period }}</td>
        </tr>
        <tr>
            <th style="width: 20%; text-align:center; ">支払方法</th>
            <td class="adjust-font">{{ $estimate_info->payment->name }}</td>
        </tr>
        <tr>
            <th style="width: 20%; text-align:center; ">有効期限</th>
            <td class="adjust-font">{{ $estimate_info->expiration_date }}</td>
        </tr>

        <tr>
            <th style="width: 20%; text-align:center;">備考</th>
            <td class="adjust-font" style="font-size: {{ $font_size_remarks }}px;width: 80%; max-width: 600px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
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
