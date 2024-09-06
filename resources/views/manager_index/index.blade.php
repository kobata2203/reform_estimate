<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>営業者一覧画面</title>
    <link rel="stylesheet" href="index.css">
</head>

<body>
    <div>
        <p>営業者一覧画面</p>
    </div>
<<<<<<< HEAD
    <form action="" class='col-9'>
=======
    <form action=""　class='col-9'>
>>>>>>> 48147603d70d61985c04a545335cf4d8038f9305
        <div class="form-group">

            <input type="search" name="search" id="" class="form-control" placeholder="検索して下さい">
        </div>
    </form>
    <div class="col-3">
        <a href="{{ route('admin/register') }}">
            <button class="btn btn-primary d-line-block ml-2 float-right ">検索</button>
        </a>
    </div>


    <div>

        <table>

            <tr>
                <th>氏名</th>
                <th>メールアドレス</th>
                <th>パスワード</th>
                <th>部署名</th>
                <th></th>
            </tr>
<<<<<<< HEAD
            <tbody>
                @foreach ($manager_info as $manager)
                    <div>
                        <tr>
                            <td>{{ $manager->manager_name }}</td>
                            <td>{{ $manager->manager_email }}</td>
                            <td>{{ $manager->manager_password }}</td>
                            <td>{{ $manager->department_name }}</td>
                            <td><button type="button">検索</button></td>
                        </tr>

                    </div>
                @endforeach
=======

            @foreach ($estimate_info as $estimate)
                <div>
                    <tr>
                        <td>{{ $estimate->salesperson_name }}</td>
                        <td>{{ $estimate->salesperson_email }}</td>
                        <td>{{ $estimate->salesperson_password }}</td>
                        <td>{{ $estimate->department_name }}</td>
                        <td><button>編集</button></td>
                    </tr>

                </div>
            @endfor
>>>>>>> 48147603d70d61985c04a545335cf4d8038f9305
        </table>

    </div>
    <div>
<<<<<<< HEAD
        <a id="menu" class="btn btn-primary" href="{{ url('manager_menu.index') }}">管理者メニュー</a>
=======
        <a id="menu" class="btn btn-primary" href="{{ url('salesperson_menu.index') }}">管理者メニュー</a>
>>>>>>> 48147603d70d61985c04a545335cf4d8038f9305
    </div>
</body>

</html>
