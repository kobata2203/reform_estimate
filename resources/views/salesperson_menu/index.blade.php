<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>営業者メニュー画面</title>
    <link rel="stylesheet" href="css/index.css">
</head>
<body>
    <div>
      <h1>営業者Menu</h1>
      <p>見積書作成、見積書一覧のいずれかのボタンをクリックしてください。</p>
    </div>
    <div class="btn">
        <form method="GET" action="estimate/create">
            @csrf
                <button>見積書作成へ</button><br>
        </form>
        <form method="GET" action="estimate/index">
            @csrf
                <button>見積書一覧へ</button>
        </form>
    </div>
</body>
</html>
