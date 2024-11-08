<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>営業者登録画面</title>
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
</head>

<body>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <h1>営業者登録画面</h1>


    <!-- Form to register salesperson -->

    <div class="form-container">
        <form action="{{ route('salesperson.create') }}" method="POST">

            @csrf
            <label for="name">氏名</label>
            <input type="text" id="name" name="name"required>
            @if ($errors->has('name'))
            <div class="invalid-feedback" role="alert">
                {{ $errors->first('name') }}
            </div>
            @endif
            <label for="department">部署名</label>
            <select id="department" name="department_name"required>
                <option value="本部">本部</option>
                <option value="営業１課１係">営業１課１係</option>
                <option value="営業１課２係">営業１課２係</option>
                <option value="営業１課３係">営業１課３係</option>
                <option value="営業２課１係">営業２課１係</option>
                <option value="営業２課２係">営業２課２係</option>
                <option value="営業３課">営業３課</option>
                <option value=" 契約管理課"> 契約管理課</option>
            </select>
            @if ($errors->has('department_name'))
            <div class="invalid-feedback" role="alert">
                {{ $errors->first('department_name') }}
            </div>
             @endif
            <label for="email">メールアドレス</label>
            <input type="email" id="email" name="email"required>
            @if ($errors->has('email'))
                <div class="invalid-feedback" role="alert">
                    {{ $errors->first('email') }}
                </div>
            @endif
            <label for="password">パスワード</label>
            <input type="password" id="password" name="password" required>
            @if ($errors->has('password'))
            <div class="invalid-feedback" role="alert">
                {{ $errors->first('password') }}
            </div>
            @endif
            <!-- Place button container inside the form-container -->
            <div class="button-container">
                <button type="submit">登録</button>
                <button type="button" onclick="window.location.href='{{ route('manager_menu') }}'">管理者<br>メニュー</button>
            </div>
        </form>

    </div>

</body>

</html>
