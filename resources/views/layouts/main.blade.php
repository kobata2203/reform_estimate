<!DOCTYPE html>
<html lang="jp">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!-- TODO:CSSから共通処理を専用ファイルにまとめる -->
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <script src="{{ asset('/js/utill.js') }}"></script>
    @yield('headder')

</head>

<body>
@yield('content')
</body>

</html>
