<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>御見積書</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid black;
        }

        th, td {
            padding: 8px;
            text-align:center;
        }

        th {
            background-color: #f2f2f2;
        }

        .buttons {
            margin-top: 20px;
            text-align: right;
        }

        .buttons a, .buttons button {
            display: inline-block;
            padding: 10px 20px;
            margin-left: 10px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border: none;
            cursor: pointer;
        }

        .buttons button {
            background-color: #28a745;
        }

        .buttons a:hover, .buttons button:hover {
            background-color: #0056b3;
        }

        .buttons button:hover {
            background-color: #218838;
        }
    </style>
</head>

<body>
    <h1 style="text-align: center; border: 1px solid black; background-color: #f2f2f2; padding: 20px; margin: 20px; width: 100%; box-sizing: border-box;">
        御　見　積　書
    </h1>

    <table>
        <tr>
            <th>見積書発行日</th>
            <td>{{$estimate_info->creation_date }}</td>
        </tr>
        <tr>
            <th>お客様名</th>
            <td>{{ $estimate_info->customer_name }}</td>
        </tr>
        <tr>
            <th>工事名</th>
            <td>{{ $estimate_info->construction_name }}</td>
        </tr>
        <tr>
            <th>営業担当</th>
            <td>{{$estimate_info->charger_name }}</td>
        </tr>
        <tr>
            <th>営業部署</th>
            <td>{{ $estimate_info->department_name }}</td>
        </tr>
        <tr>
            <th>作成日</th>
            <td>{{ $admin->creation_date }}</td>
        </tr>
        <tr>
            <th>有効期限</th>
            <td>{{ $admin->expiration_date }}</td>
        </tr>
    </table>

    <!-- Buttons for downloading PDF and printing -->
    <div class="buttons">

        <button onclick="window.print()">印刷</button>
    </div>
</body>

</html>
