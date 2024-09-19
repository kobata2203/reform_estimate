<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>見積書一覧画面(営業者用)</title>
    <link rel="stylesheet" href="estimate_index.css">
</head>

<body>
    <div>
        <p>見積書一覧画面<br>(営業者用)</p>
    </div>

    <div>見積書発行日, お客様名, 工事名, 営業担当, 部署名</div>
    <input type="text" size="60">
    <button id="btn" style="width: 100px; height: 30px; margin-bottom: 20px;">検索</button>

    <div class="table-container">
        <table>
            <thead>
                <th>見積書発行日</th>
                <th>お客様名</th>
                <th>工事名</th>
                <th>営業担当</th>
                <th>部署名</th>
                <th></th>
            </thead>
            <tbody>
                @foreach ($estimate_info as $estimate)
                    <div>

                        <tr>
                            <td>{{ $estimate->creation_date }}</td>
                            <td>{{ $estimate->customer_name }}</td>
                            <td>{{ $estimate->construction_name }}</td>
                            <td>{{ $estimate->charger_name }}</td>
                            <td>{{ $estimate->department_name }}</td>
                            <td><button type="button">閲覧</button></td>
                        </tr>

                    </div>
                @endforeach
            </tbody>
        </table>
    </div>

    <div>
        <button id="menu">営業者メニュー</button>
    </div>
</body>

</html>
