<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>見積書詳細</title>
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
            width: 68%;
            border-collapse: collapse;
            margin-bottom: 20px;
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

        th,
        td {
            padding: 10px;
            text-align: left;
        }

        .contact-info {
            width: 30%;
            font-size: 14px;
            position: absolute; /* Use absolute positioning for placement */
            bottom: 50px; /* Adjust as needed */
            right: 20px; /* Adjust as needed */
            margin-bottom:640px;

        }
    </style>
</head>

<body>
    <h2>見積書詳細画面</h2>

    <div>
        <p><strong>お客様名 :</strong> {{ $estimate_info->customer_name }} 様</p>
        <p style="font-size: 8px;">下記の通りお見積り申し上げます。</p>
        <p style="text-align: center;"><strong>お見積り金額 : ¥ </strong> {{ number_format($estimate_info->estimate_amount) }} （税込）</p>
    </div>



    <table>
        <tr>
            <th>件名</th>
            <td>{{ $estimate_info->subject_name }}</td>
        </tr>
        <tr>
            <th>納入場所</th>
            <td>{{ $estimate_info->delivery_place }}</td>
        </tr>
        <tr>
            <th>工期</th>
            <td>{{ $estimate_info->construction_period }}</td>
        </tr>
        <tr>
            <th>支払方法</th>
            <td>{{ $estimate_info->payment_type }}</td>
        </tr>
        <tr>
            <th>有効期限</th>
            <td>{{ $estimate_info->expiration_date }}</td>
        </tr>
        <tr>
            <th>備考</th>
            <td>{{ $estimate_info->remarks }}</td>
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
