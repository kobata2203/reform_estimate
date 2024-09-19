<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>営業者一覧画面</title>
    <link rel="stylesheet" href="{{ asset('css/managerindex1.css') }}">
</head>

<body>
    <div>
        <p>営業者一覧画面</p>
    </div>
    <form action="{{ route('managers.index') }}" method="GET" class="form-inline">
        <div class="form-group d-flex align-items-center"> <!-- Use d-flex to make the elements align in a row -->
            <input type="search" name="search" class="form-control search-box-margin me-2" placeholder="検索して下さい"
                value="{{ request()->input('search') }}">
            <!-- Added me-2 for margin to the right side of the search box -->
            <button type="submit" class="btn btn-primary custom-margin">検索</button>
        </div>

    </form>


    <div>
        <table>
            <thead>
                <tr>
                    <th>氏名</th>
                    <th>メールアドレス</th>
                    <th>パスワード</th>
                    <th>部署名</th>
                    <th>アクション</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($manager_info as $manager)
                    <tr>
                        <td>{{ $manager->name }}</td>
                        <td>{{ $manager->email }}</td>
                        <td>{{ $manager->password }}</td>
                        <td>{{ $manager->department_name }}</td>
                        <td>
                            <a href="{{ route('managers.edit', $manager->id) }}" class="btn btn-dark">編集</a>
                            <form action="{{ route('managers.destroy', $manager->id) }}" method="POST"
                                style="display:inline;">
                                @csrf

                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="col-3 custom-margin-bottom" style="margin-top: 20px; margin-right: 20px; text-align: right;">

            <a href="{{ route('manager_menu.index') }}"
                class="btn btn-primary custom-margin custom-border mb-3">管理者メニュー画面へ</a>


        </div>




    </div>
</body>

</html>
