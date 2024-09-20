<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>見積書作成画面(内訳明細書)</title>
    <link rel="stylesheet" href="css/estimate_index.css">
</head>

<body>
    <div>
        <p>見積書作成画面<br>(内訳明細書)</p>
    </div>
    <form action="{{ route('estimate.breakdown_store') }}" method="post">
        @csrf
        <div class="table-container">
            <table>
                <thead>
                    <th>項目</th>
                    <th>仕様・摘要</th>
                    <th>数量</th>
                    <th>単位</th>
                    <th>単価</th>
                    <th>金額</th>
                    <th>備考</th>
                </thead>
                <tbody>
                    <tr>
                        <td><input id="construction_item" type="text" name="construction_item" placeholder="既存浴槽解体" value="既存浴槽解体"></td>
                        <td><input id="specification" type="text" name="specification"></input></td>
                        <td><input id="quantity" type="text" name="quantity"></input></td>
                        <td><input id="unit" type="text" name="unit"></input></td>
                        <td><input id="unit_price" type="text" name="unit_price"></input></td>
                        <td><input id="amount" type="text" name="amount"></input></td>
                        <td><input id="remarks2" type="text" name="remarks2"></input></td>
                    </tr>
                    <tr>
                        <td><input id="construction_item" type="text" name="construction_item" placeholder="土間モルタル打ち" value="土間モルタル打ち"></td>
                        <td><input id="specification" type="text" name="specification"></input></td>
                        <td><input id="quantity" type="text" name="quantity"></input></td>
                        <td><input id="unit" type="text" name="unit"></input></td>
                        <td><input id="unit_price" type="text" name="unit_price"></input></td>
                        <td><input id="amount" type="text" name="amount"></input></td>
                        <td><input id="remarks2" type="text" name="remarks2"></input></td>
                    </tr>
                    <tr>
                        <td><input id="construction_item" type="text" name="construction_item" placeholder="バスナフローレ貼り付け" value="バスナフローレ貼り付け"></td>
                        <td><input id="specification" type="text" name="specification"></input></td>
                        <td><input id="quantity" type="text" name="quantity"></input></td>
                        <td><input id="unit" type="text" name="unit"></input></td>
                        <td><input id="unit_price" type="text" name="unit_price"></input></td>
                        <td><input id="amount" type="text" name="amount"></input></td>
                        <td><input id="remarks2" type="text" name="remarks2"></input></td>
                    </tr>
                    <tr>
                        <td><input id="construction_item" type="text" name="construction_item" placeholder="浴槽取付" value="浴槽取付"></td>
                        <td><input id="specification" type="text" name="specification"></input></td>
                        <td><input id="quantity" type="text" name="quantity"></input></td>
                        <td><input id="unit" type="text" name="unit"></input></td>
                        <td><input id="unit_price" type="text" name="unit_price"></input></td>
                        <td><input id="amount" type="text" name="amount"></input></td>
                        <td><input id="remarks2" type="text" name="remarks2"></input></td>
                    </tr>
                    <tr>
                        <td><input id="construction_item" type="text" name="construction_item" placeholder="雑工事" value="雑工事"></td>
                        <td><input id="specification" type="text" name="specification"></input></td>
                        <td><input id="quantity" type="text" name="quantity"></input></td>
                        <td><input id="unit" type="text" name="unit"></input></td>
                        <td><input id="unit_price" type="text" name="unit_price"></input></td>
                        <td><input id="amount" type="text" name="amount"></input></td>
                        <td><input id="remarks2" type="text" name="remarks2"></input></td>
                    </tr>
                    <tr>
                        <td><input id="construction_item" type="text" name="construction_item" placeholder="廃材処分費" value="廃材処分費"></td>
                        <td><input id="specification" type="text" name="specification"></input></td>
                        <td><input id="quantity" type="text" name="quantity"></input></td>
                        <td><input id="unit" type="text" name="unit"></input></td>
                        <td><input id="unit_price" type="text" name="unit_price"></input></td>
                        <td><input id="amount" type="text" name="amount"></input></td>
                        <td><input id="remarks2" type="text" name="remarks2"></input></td>
                    </tr>
                    <tr>
                        <td><input id="construction_item" type="text" name="construction_item" placeholder="諸経費" value="諸経費"></td>
                        <td><input id="specification" type="text" name="specification"></input></td>
                        <td><input id="quantity" type="text" name="quantity"></input></td>
                        <td><input id="unit" type="text" name="unit"></input></td>
                        <td><input id="unit_price" type="text" name="unit_price"></input></td>
                        <td><input id="amount" type="text" name="amount"></input></td>
                        <td><input id="remarks2" type="text" name="remarks2"></input></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <button type="submit">登録</button>
    </form>
    <div>
        <form action="{{ route('salesperson_menu') }}" method="GET">
            @csrf
            <button>営業者メニュー</button>
        </form>
    </div>
</body>

</html>
