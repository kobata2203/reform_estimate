{{-- <!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Breakdown Statement</title>
    <style>
        @font-face {
            font-family: 'NotoSansJP';
            font-style: normal;
            font-weight: 400;
            src: url('path_to_fonts/NotoSansJP-Regular.ttf') format('truetype');
        }

        body {
            font-family: 'NotoSansJP', sans-serif;
            margin: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
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

        .contact-info {
            width: 30%;
            /* Set width for the contact info */
            padding-left: 75%;
            /* Optional padding for separation */
            font-size: 14px;
            /* Adjust font size */
        }

        th,
        td {
            border: 1px solid black;
            /* Ensures all cells have borders */
            padding: 8px;
            text-align: left;
        }

        .no-border {
            border: none;
        }

        .print-button {
            margin: 10px;
            padding: 10px 20px;
            font-size: 16px;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .print-button:hover {
            background-color: #0056b3;
        }

        .construction-name {
            margin: 20px 0;
            /* Add margin between this section and others */
            display: flex;
            /* Align label and input horizontally */
            align-items: center;
            /* Vertically align input with label */
        }

        .construction-name label {
            margin-right: 10px;
            /* Spacing between label and input */
        }

        .construction-name input {
            width: 300px;
            /* Set a fixed width for the input field */
            padding: 5px;
            /* Add some padding for better appearance */
        }
    </style>
</head>

<body>
    <h2>内訳明細書</h2>
    <div class="contact-info">
        <p>株式会社サーバントップ</p>
    </div>

    <div class="construction-name">
        <label for="construction-name">工事名:</label>
        <span>{{ $estimate_info->construction_name ?? '工事名がありません' }}</span>
    </div>




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
                    <td>{{ $item->construction_item }}</td>
                    <td>{{ $item->specification }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ $item->unit }}</td>
                    <td>{{ number_format($item->unit_price) }}</td>
                    <td>{{ number_format($item->amount) }}</td>
                    <td>{{ $item->remarks }}</td>
                </tr>
            @endforeach
            <tr>
                <td colspan="5" style="text-align: right;">特別お値引き</td>
                <td>{{ number_format($discount) }}</td>
                <td class="no-border"></td> <!-- Keeps the last cell empty but with a border -->
            </tr>
            <tr>
                <td colspan="5" style="text-align: right;">小計（税抜）</td>
                <td>{{ number_format($subtotal) }}</td>
                <td class="no-border"></td> <!-- Keeps the last cell empty but with a border -->
            </tr>
            <tr>
                <td colspan="5" style="text-align: right;">消費税（10%）</td>
                <td>{{ number_format($tax) }}</td>
                <td class="no-border"></td> <!-- Keeps the last cell empty but with a border -->
            </tr>
            <tr>
                <td colspan="5" style="text-align: right;">合計（税込）</td>
                <td>{{ number_format($grandTotal) }}</td>
                <td class="no-border"></td> <!-- Keeps the last cell empty but with a border -->
            </tr>
        </tbody>
    </table>

</body>

</html> --}}
