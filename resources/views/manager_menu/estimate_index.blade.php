<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>見積書一覧画面(管理者用)</title>
    <link rel="stylesheet" href="{{ asset('css/admin_index.css') }}">
</head>

<body>
    <div>
        <p>見積書一覧画面<br>（管理者用）</p>
    </div>

    <div class="estimate">
        見積書発行日, お客様名, 工事名, 営業担当, 営業部署
    </div>
    <div>
        <form action="{{ route('manager_estimate') }}" method="GET">

        @csrf

          <input type="text" name="keyword" value="{{ $keyword }}">
          <input type="submit" value="検索">
        </form>
    </div>

    <div>
        <table>
            <tr>
                <th>見積書発行日</th>
                <th>お客様名</th>
                <th>工事名</th>
                <th>営業担当</th>
                <th>営業部署</th>
                <th></th>
            </tr>
            @foreach ($estimate_info as $estimate)
                <tr>
                    <td>{{ $estimate->creation_date }}</td>
                    <td>{{ $estimate->customer_name }}</td>
                    <td>{{ $estimate->construction_name }}</td>
                    <td>{{ $estimate->charger_name }}</td>
                    <td>{{ $estimate->department_name }}</td>
                    <td><a href="{{ route('managers.show', $estimate->id) }}" class="btn btn-primary">閲覧</a></td>

                </tr>
            @endforeach
        </table>
    </div>

    <div class="col-3 margin-top-example" style="text-align: right;">
        <a href="{{ route('manager_menu') }}" class="btn btn-primary custom-border">管理者メニュー画面へ</a>
    </div>
</body>

</html>
