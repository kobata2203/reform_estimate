<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>見積書一覧画面(営業者用)</title>
    <link rel="stylesheet" href="css/estimate_index.css">
</head>

<body>
    <div>
        <p>見積書一覧画面<br>(営業者用)</p>
    </div>

    <div>見積書発行日, お客様名, 工事名, 営業担当, 営業部署</div>
    <div>
        <form action="{{ route('estimate') }}" method="GET">

        @csrf

          <input type="text" name="keyword" value="{{ $keyword }}">
          <input type="submit" value="検索">
        </form>
    </div>

    <div class="table-container">
        <table>
            <thead>
                <th>見積書発行日</th>
                <th>お客様名</th>
                <th>工事名</th>
                <th>営業担当</th>
                <th>営業部署</th>
                <th></th>
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
                            <td><a action="{{ route('estimate.breakdown_create') }}" method="GET">
                                @csrf
                                <button type="button">内訳明細書作成へ</button></a></td>
                            <td><button type="button">閲覧</button></td>
                        </tr>

                    </div>
                @endforeach
            </tbody>
        </table>
    </div>

    <div>
        <form action="{{ route('salesperson_menu') }}" method="GET">
            @csrf
            <button>営業者メニュー</button>
        </form>
    </div>
</body>

</html>
