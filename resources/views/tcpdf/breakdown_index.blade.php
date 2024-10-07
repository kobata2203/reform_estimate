<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>見積書作成画面(内訳明細書)</title>
    <STYLE>
        p {
            background-color: rgb(135, 197, 48);
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;


        }

        th {
            background-color: rgb(121, 168, 51);
        }



        #menue {
            margin: 27px;
            margin-left: 83%;
            cursor: pointer;
            border: 2px solid black;

        }

        .row-button {
            display: flex;
            justify-content: flex-end;
            margin-bottom: 10px;
            /* Space between rows of buttons */
        }


        #btn {
            margin-left: 50px;
        }
    </STYLE>

</head>

<body>
    <div>
        <p>見積書作成画面<br>(内訳明細書)</p>
    </div>
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
                    <th></th>
                </thead>
                @if($estimate_info->construction_name==="外壁塗装工事a")
                    <tbody>
                        <tr>
                            <form action="{{ route('estimate.breakdown_store') }}" method="post">
                                @csrf
                                <input name="estimate_id" type="hidden" value="{{$id}}">
                                <td><input id="construction_item1" type="text" name="construction_item" placeholder="仮設足場" value="仮設足場"></td>
                                <td><input id="specification1" type="text" name="specification"></input></td>
                                <td><input id="quantity1" type="text" name="quantity"></input></td>
                                <td><input id="unit1" type="text" name="unit"></input></td>
                                <td><input id="unit_price1" type="text" name="unit_price"></input></td>
                                <td><input id="amount1" type="text" name="amount"></input></td>
                                <td><input id="remarks2_1" type="text" name="remarks2"></input></td>
                                <td><button type="submit">登録</button></td>
                            </form>
                        </tr>
                        <tr>
                            <form action="{{ route('estimate.breakdown_store') }}" method="post">
                                @csrf
                                <input name="estimate_id" type="hidden" value="{{$id}}">
                                <td><input id="construction_item2" type="text" name="construction_item" placeholder="養生" value="養生"></td>
                                <td><input id="specification2" type="text" name="specification"></input></td>
                                <td><input id="quantity2" type="text" name="quantity"></input></td>
                                <td><input id="unit2" type="text" name="unit"></input></td>
                                <td><input id="unit_price2" type="text" name="unit_price"></input></td>
                                <td><input id="amount2" type="text" name="amount"></input></td>
                                <td><input id="remarks2_2" type="text" name="remarks2"></input></td>
                                <td><button type="submit">登録</button></td>
                            </form>
                        </tr>
                        <tr>
                            <form action="{{ route('estimate.breakdown_store') }}" method="post">
                                @csrf
                                <input name="estimate_id" type="hidden">
                                <td><input id="construction_item3" type="text" name="construction_item" placeholder="高圧洗浄" value="高圧洗浄"></td>
                                <td><input id="specification3" type="text" name="specification"></input></td>
                                <td><input id="quantity3" type="text" name="quantity"></input></td>
                                <td><input id="unit3" type="text" name="unit"></input></td>
                                <td><input id="unit_price3" type="text" name="unit_price"></input></td>
                                <td><input id="amount3" type="text" name="amount"></input></td>
                                <td><input id="remarks2_3" type="text" name="remarks2"></input></td>
                                <td><button type="submit">登録</button></td>
                            </form>
                        </tr>
                        <tr>
                            <form action="{{ route('estimate.breakdown_store') }}" method="post">
                                @csrf
                                <input name="estimate_id" type="hidden">
                                <td><input id="construction_item4" type="text" name="construction_item" placeholder="下塗り" value="下塗り"></td>
                                <td><input id="specification4" type="text" name="specification"></input></td>
                                <td><input id="quantity4" type="text" name="quantity"></input></td>
                                <td><input id="unit4" type="text" name="unit"></input></td>
                                <td><input id="unit_price4" type="text" name="unit_price"></input></td>
                                <td><input id="amount4" type="text" name="amount"></input></td>
                                <td><input id="remarks2_4" type="text" name="remarks2"></input></td>
                                <td><button type="submit">登録</button></td>
                            </form>
                        </tr>
                        <tr>
                            <form action="{{ route('estimate.breakdown_store') }}" method="post">
                                @csrf
                                <input name="estimate_id" type="hidden">
                                <td><input id="construction_item5" type="text" name="construction_item" placeholder="中塗り" value="中塗り"></td>
                                <td><input id="specification5" type="text" name="specification"></input></td>
                                <td><input id="quantity5" type="text" name="quantity"></input></td>
                                <td><input id="unit5" type="text" name="unit"></input></td>
                                <td><input id="unit_price5" type="text" name="unit_price"></input></td>
                                <td><input id="amount5" type="text" name="amount"></input></td>
                                <td><input id="remarks2_5" type="text" name="remarks2"></input></td>
                                <td><button type="submit">登録</button></td>
                            </form>
                        </tr>
                        <tr>
                            <form action="{{ route('estimate.breakdown_store') }}" method="post">
                                @csrf
                                <input name="estimate_id" type="hidden">
                                <td><input id="construction_item6" type="text" name="construction_item" placeholder="上塗り" value="上塗り"></td>
                                <td><input id="specification6" type="text" name="specification"></input></td>
                                <td><input id="quantity6" type="text" name="quantity"></input></td>
                                <td><input id="unit6" type="text" name="unit"></input></td>
                                <td><input id="unit_price6" type="text" name="unit_price"></input></td>
                                <td><input id="amount6" type="text" name="amount"></input></td>
                                <td><input id="remarks2_6" type="text" name="remarks2"></input></td>
                                <td><button type="submit">登録</button></td>
                            </form>
                        </tr>
                        <tr>
                            <form action="{{ route('estimate.breakdown_store') }}" method="post">
                                @csrf
                                <input name="estimate_id" type="hidden">
                                <td><input id="construction_item7" type="text" name="construction_item" placeholder="付帯塗装" value="付帯塗装"></td>
                                <td><input id="specification7" type="text" name="specification"></input></td>
                                <td><input id="quantity7" type="text" name="quantity"></input></td>
                                <td><input id="unit7" type="text" name="unit"></input></td>
                                <td><input id="unit_price7" type="text" name="unit_price"></input></td>
                                <td><input id="amount7" type="text" name="amount"></input></td>
                                <td><input id="remarks2_7" type="text" name="remarks2"></input></td>
                                <td><button type="submit">登録</button></td>
                            </form>
                        </tr>
                        <tr>
                            <form action="{{ route('estimate.breakdown_store') }}" method="post">
                                @csrf
                                <input name="estimate_id" type="hidden">
                                <td><input id="construction_item8" type="text" name="construction_item" placeholder="目地" value="目地"></td>
                                <td><input id="specification8" type="text" name="specification"></input></td>
                                <td><input id="quantity8" type="text" name="quantity"></input></td>
                                <td><input id="unit8" type="text" name="unit"></input></td>
                                <td><input id="unit_price8" type="text" name="unit_price"></input></td>
                                <td><input id="amount8" type="text" name="amount"></input></td>
                                <td><input id="remarks2_8" type="text" name="remarks2"></input></td>
                                <td><button type="submit">登録</button></td>
                            </form>
                        </tr>
                        <tr>
                            <form action="{{ route('estimate.breakdown_store') }}" method="post">
                                @csrf
                                <input name="estimate_id" type="hidden">
                                <td><input id="construction_item9" type="text" name="construction_item" placeholder="廃材処分費" value="廃材処分費"></td>
                                <td><input id="specification9" type="text" name="specification"></input></td>
                                <td><input id="quantity9" type="text" name="quantity"></input></td>
                                <td><input id="unit9" type="text" name="unit"></input></td>
                                <td><input id="unit_price9" type="text" name="unit_price"></input></td>
                                <td><input id="amount9" type="text" name="amount"></input></td>
                                <td><input id="remarks2_9" type="text" name="remarks2"></input></td>
                                <td><button type="submit">登録</button></td>
                            </form>
                        </tr>
                        <tr>
                            <form action="{{ route('estimate.breakdown_store') }}" method="post">
                                @csrf
                                <input name="estimate_id" type="hidden">
                                <td><input id="construction_item10" type="text" name="construction_item" placeholder="諸経費" value="諸経費"></td>
                                <td><input id="specification10" type="text" name="specification"></input></td>
                                <td><input id="quantity10" type="text" name="quantity"></input></td>
                                <td><input id="unit10" type="text" name="unit6"></input></td>
                                <td><input id="unit_price10" type="text" name="unit_price"></input></td>
                                <td><input id="amount10" type="text" name="amount"></input></td>
                                <td><input id="remarks2_10" type="text" name="remarks2"></input></td>
                                <td><button type="submit">登録</button></td>
                            </form>
                        </tr>
                    </tbody>
                @elseif($estimate_info->construction_name==="外壁塗装工事b")
                    <tbody>
                        <tr>
                            <form action="{{ route('estimate.breakdown_store') }}" method="post">
                                @csrf
                                <td><input id="construction_item1" type="text" name="construction_item" placeholder="仮設足場" value="仮設足場"></td>
                                <td><input id="specification1" type="text" name="specification"></input></td>
                                <td><input id="quantity1" type="text" name="quantity"></input></td>
                                <td><input id="unit1" type="text" name="unit"></input></td>
                                <td><input id="unit_price1" type="text" name="unit_price"></input></td>
                                <td><input id="amount1" type="text" name="amount"></input></td>
                                <td><input id="remarks2_1" type="text" name="remarks2"></input></td>
                                <td><button type="submit">登録</button></td>
                            </form>
                        </tr>
                        <tr>
                            <form action="{{ route('estimate.breakdown_store') }}" method="post">
                                @csrf

                                <td><input id="construction_item2" type="text" name="construction_item" placeholder="養生" value="養生"></td>
                                <td><input id="specification2" type="text" name="specification"></input></td>
                                <td><input id="quantity2" type="text" name="quantity"></input></td>
                                <td><input id="unit2" type="text" name="unit"></input></td>
                                <td><input id="unit_price2" type="text" name="unit_price"></input></td>
                                <td><input id="amount2" type="text" name="amount"></input></td>
                                <td><input id="remarks2_2" type="text" name="remarks2"></input></td>
                                <td><button type="submit">登録</button></td>
                            </form>
                        </tr>
                        <tr>
                            <form action="{{ route('estimate.breakdown_store') }}" method="post">
                                @csrf
                                <td><input id="construction_item3" type="text" name="construction_item" placeholder="高圧洗浄" value="高圧洗浄"></td>
                                <td><input id="specification3" type="text" name="specification"></input></td>
                                <td><input id="quantity3" type="text" name="quantity"></input></td>
                                <td><input id="unit3" type="text" name="unit"></input></td>
                                <td><input id="unit_price3" type="text" name="unit_price"></input></td>
                                <td><input id="amount3" type="text" name="amount"></input></td>
                                <td><input id="remarks2_3" type="text" name="remarks2"></input></td>
                                <td><button type="submit">登録</button></td>
                            </form>
                        </tr>
                        <tr>
                            <form action="{{ route('estimate.breakdown_store') }}" method="post">
                                @csrf
                                <td><input id="construction_item4" type="text" name="construction_item" placeholder="下塗り" value="下塗り"></td>
                                <td><input id="specification4" type="text" name="specification"></input></td>
                                <td><input id="quantity4" type="text" name="quantity"></input></td>
                                <td><input id="unit4" type="text" name="unit"></input></td>
                                <td><input id="unit_price4" type="text" name="unit_price"></input></td>
                                <td><input id="amount4" type="text" name="amount"></input></td>
                                <td><input id="remarks2_4" type="text" name="remarks2"></input></td>
                                <td><button type="submit">登録</button></td>
                            </form>
                        </tr>
                        <tr>
                            <form action="{{ route('estimate.breakdown_store') }}" method="post">
                                @csrf
                                <td><input id="construction_item5" type="text" name="construction_item" placeholder="中塗り" value="中塗り"></td>
                                <td><input id="specification5" type="text" name="specification"></input></td>
                                <td><input id="quantity5" type="text" name="quantity"></input></td>
                                <td><input id="unit5" type="text" name="unit"></input></td>
                                <td><input id="unit_price5" type="text" name="unit_price"></input></td>
                                <td><input id="amount5" type="text" name="amount"></input></td>
                                <td><input id="remarks2_5" type="text" name="remarks2"></input></td>
                                <td><button type="submit">登録</button></td>
                            </form>
                        </tr>
                        <tr>
                            <form action="{{ route('estimate.breakdown_store') }}" method="post">
                                @csrf
                                <td><input id="construction_item6" type="text" name="construction_item" placeholder="上塗り" value="上塗り"></td>
                                <td><input id="specification6" type="text" name="specification"></input></td>
                                <td><input id="quantity6" type="text" name="quantity"></input></td>
                                <td><input id="unit6" type="text" name="unit"></input></td>
                                <td><input id="unit_price6" type="text" name="unit_price"></input></td>
                                <td><input id="amount6" type="text" name="amount"></input></td>
                                <td><input id="remarks2_6" type="text" name="remarks2"></input></td>
                                <td><button type="submit">登録</button></td>
                            </form>
                        </tr>
                        <tr>
                            <form action="{{ route('estimate.breakdown_store') }}" method="post">
                                @csrf
                                <td><input id="construction_item7" type="text" name="construction_item" placeholder="ベランダ防水塗装" value="ベランダ防水塗装"></td>
                                <td><input id="specification7" type="text" name="specification"></input></td>
                                <td><input id="quantity7" type="text" name="quantity"></input></td>
                                <td><input id="unit7" type="text" name="unit"></input></td>
                                <td><input id="unit_price7" type="text" name="unit_price"></input></td>
                                <td><input id="amount7" type="text" name="amount"></input></td>
                                <td><input id="remarks2_7" type="text" name="remarks2"></input></td>
                                <td><button type="submit">登録</button></td>
                            </form>
                        </tr>
                        <tr>
                            <form action="{{ route('estimate.breakdown_store') }}" method="post">
                                @csrf
                                <td><input id="construction_item8" type="text" name="construction_item" placeholder="付帯塗装" value="付帯塗装"></td>
                                <td><input id="specification8" type="text" name="specification"></input></td>
                                <td><input id="quantity8" type="text" name="quantity"></input></td>
                                <td><input id="unit8" type="text" name="unit"></input></td>
                                <td><input id="unit_price8" type="text" name="unit_price"></input></td>
                                <td><input id="amount8" type="text" name="amount"></input></td>
                                <td><input id="remarks2_8" type="text" name="remarks2"></input></td>
                                <td><button type="submit">登録</button></td>
                            </form>
                        </tr>
                        <tr>
                            <form action="{{ route('estimate.breakdown_store') }}" method="post">
                                @csrf
                                <td><input id="construction_item9" type="text" name="construction_item" placeholder="目地" value="目地"></td>
                                <td><input id="specification9" type="text" name="specification"></input></td>
                                <td><input id="quantity9" type="text" name="quantity"></input></td>
                                <td><input id="unit9" type="text" name="unit"></input></td>
                                <td><input id="unit_price9" type="text" name="unit_price"></input></td>
                                <td><input id="amount9" type="text" name="amount"></input></td>
                                <td><input id="remarks2_9" type="text" name="remarks2"></input></td>
                                <td><button type="submit">登録</button></td>
                            </form>
                        </tr>
                        <tr>
                            <form action="{{ route('estimate.breakdown_store') }}" method="post">
                                @csrf
                                <td><input id="construction_item10" type="text" name="construction_item" placeholder="廃材処分費" value="廃材処分費"></td>
                                <td><input id="specification10" type="text" name="specification"></input></td>
                                <td><input id="quantity10" type="text" name="quantity"></input></td>
                                <td><input id="unit10" type="text" name="unit"></input></td>
                                <td><input id="unit_price10" type="text" name="unit_price"></input></td>
                                <td><input id="amount10" type="text" name="amount"></input></td>
                                <td><input id="remarks2_10" type="text" name="remarks2"></input></td>
                                <td><button type="submit">登録</button></td>
                            </form>
                        </tr>
                        <tr>
                            <form action="{{ route('estimate.breakdown_store') }}" method="post">
                                @csrf
                                <td><input id="construction_item11" type="text" name="construction_item" placeholder="諸経費" value="諸経費"></td>
                                <td><input id="specification11" type="text" name="specification"></input></td>
                                <td><input id="quantity11" type="text" name="quantity"></input></td>
                                <td><input id="unit11" type="text" name="unit6"></input></td>
                                <td><input id="unit_price11" type="text" name="unit_price"></input></td>
                                <td><input id="amount11" type="text" name="amount"></input></td>
                                <td><input id="remarks2_11" type="text" name="remarks2"></input></td>
                                <td><button type="submit">登録</button></td>
                            </form>
                        </tr>
                    </tbody>
                @elseif($estimate_info->construction_name==="外壁重ね張り工事")
                    <tbody>
                        <tr>
                            <form action="{{ route('estimate.breakdown_store') }}" method="post">
                                @csrf
                                <td><input id="construction_item1" type="text" name="construction_item" placeholder="仮設足場" value="仮設足場"></td>
                                <td><input id="specification1" type="text" name="specification"></input></td>
                                <td><input id="quantity1" type="text" name="quantity"></input></td>
                                <td><input id="unit1" type="text" name="unit"></input></td>
                                <td><input id="unit_price1" type="text" name="unit_price"></input></td>
                                <td><input id="amount1" type="text" name="amount"></input></td>
                                <td><input id="remarks2_1" type="text" name="remarks2"></input></td>
                                <td><button type="submit">登録</button></td>
                            </form>
                        </tr>
                        <tr>
                            <form action="{{ route('estimate.breakdown_store') }}" method="post">
                                @csrf
                                <td><input id="construction_item2" type="text" name="construction_item" placeholder="下地新設" value="下地新設"></td>
                                <td><input id="specification2" type="text" name="specification"></input></td>
                                <td><input id="quantity2" type="text" name="quantity"></input></td>
                                <td><input id="unit2" type="text" name="unit"></input></td>
                                <td><input id="unit_price2" type="text" name="unit_price"></input></td>
                                <td><input id="amount2" type="text" name="amount"></input></td>
                                <td><input id="remarks2_2" type="text" name="remarks2"></input></td>
                                <td><button type="submit">登録</button></td>
                            </form>
                        </tr>
                        <tr>
                            <form action="{{ route('estimate.breakdown_store') }}" method="post">
                                @csrf
                                <td><input id="construction_item3" type="text" name="construction_item" placeholder="板金貼り" value="板金貼り"></td>
                                <td><input id="specification3" type="text" name="specification"></input></td>
                                <td><input id="quantity3" type="text" name="quantity"></input></td>
                                <td><input id="unit3" type="text" name="unit"></input></td>
                                <td><input id="unit_price3" type="text" name="unit_price"></input></td>
                                <td><input id="amount3" type="text" name="amount"></input></td>
                                <td><input id="remarks2_3" type="text" name="remarks2"></input></td>
                                <td><button type="submit">登録</button></td>
                            </form>
                        </tr>
                        <tr>
                            <form action="{{ route('estimate.breakdown_store') }}" method="post">
                                @csrf
                                <td><input id="construction_item4" type="text" name="construction_item" placeholder="各所役物" value="各所役物"></td>
                                <td><input id="specification4" type="text" name="specification"></input></td>
                                <td><input id="quantity4" type="text" name="quantity"></input></td>
                                <td><input id="unit4" type="text" name="unit"></input></td>
                                <td><input id="unit_price4" type="text" name="unit_price"></input></td>
                                <td><input id="amount4" type="text" name="amount"></input></td>
                                <td><input id="remarks2_4" type="text" name="remarks2"></input></td>
                                <td><button type="submit">登録</button></td>
                            </form>
                        </tr>
                        <tr>
                            <form action="{{ route('estimate.breakdown_store') }}" method="post">
                                @csrf
                                <td><input id="construction_item5" type="text" name="construction_item" placeholder="水切り" value="水切り"></td>
                                <td><input id="specification5" type="text" name="specification"></input></td>
                                <td><input id="quantity5" type="text" name="quantity"></input></td>
                                <td><input id="unit5" type="text" name="unit"></input></td>
                                <td><input id="unit_price5" type="text" name="unit_price"></input></td>
                                <td><input id="amount5" type="text" name="amount"></input></td>
                                <td><input id="remarks2_5" type="text" name="remarks2"></input></td>
                                <td><button type="submit">登録</button></td>
                            </form>
                        </tr>
                        <tr>
                            <form action="{{ route('estimate.breakdown_store') }}" method="post">
                                @csrf
                                <td><input id="construction_item6" type="text" name="construction_item" placeholder="土台水切り" value="土台水切り"></td>
                                <td><input id="specification6" type="text" name="specification"></input></td>
                                <td><input id="quantity6" type="text" name="quantity"></input></td>
                                <td><input id="unit6" type="text" name="unit"></input></td>
                                <td><input id="unit_price6" type="text" name="unit_price"></input></td>
                                <td><input id="amount6" type="text" name="amount"></input></td>
                                <td><input id="remarks2_6" type="text" name="remarks2"></input></td>
                                <td><button type="submit">登録</button></td>
                            </form>
                        </tr>
                        <tr>
                            <form action="{{ route('estimate.breakdown_store') }}" method="post">
                                @csrf
                                <td><input id="construction_item7" type="text" name="construction_item" placeholder="各所シーリング" value="各所シーリング"></td>
                                <td><input id="specification7" type="text" name="specification"></input></td>
                                <td><input id="quantity7" type="text" name="quantity"></input></td>
                                <td><input id="unit7" type="text" name="unit"></input></td>
                                <td><input id="unit_price7" type="text" name="unit_price"></input></td>
                                <td><input id="amount7" type="text" name="amount"></input></td>
                                <td><input id="remarks2_7" type="text" name="remarks2"></input></td>
                                <td><button type="submit">登録</button></td>
                            </form>
                        </tr>
                        <tr>
                            <form action="{{ route('estimate.breakdown_store') }}" method="post">
                                @csrf
                                <td><input id="construction_item8" type="text" name="construction_item" placeholder="廻り縁" value="廻り縁"></td>
                                <td><input id="specification8" type="text" name="specification"></input></td>
                                <td><input id="quantity8" type="text" name="quantity"></input></td>
                                <td><input id="unit8" type="text" name="unit"></input></td>
                                <td><input id="unit_price8" type="text" name="unit_price"></input></td>
                                <td><input id="amount8" type="text" name="amount"></input></td>
                                <td><input id="remarks2_8" type="text" name="remarks2"></input></td>
                                <td><button type="submit">登録</button></td>
                            </form>
                        </tr>
                        <tr>
                            <form action="{{ route('estimate.breakdown_store') }}" method="post">
                                @csrf
                                <td><input id="construction_item5" type="text" name="construction_item" placeholder="廃材処分費" value="廃材処分費"></td>
                                <td><input id="specification5" type="text" name="specification"></input></td>
                                <td><input id="quantity5" type="text" name="quantity"></input></td>
                                <td><input id="unit5" type="text" name="unit"></input></td>
                                <td><input id="unit_price5" type="text" name="unit_price"></input></td>
                                <td><input id="amount5" type="text" name="amount"></input></td>
                                <td><input id="remarks2_5" type="text" name="remarks2"></input></td>
                                <td><button type="submit">登録</button></td>
                            </form>
                        </tr>
                        <tr>
                            <form action="{{ route('estimate.breakdown_store') }}" method="post">
                                @csrf
                                <td><input id="construction_item6" type="text" name="construction_item" placeholder="諸経費" value="諸経費"></td>
                                <td><input id="specification6" type="text" name="specification"></input></td>
                                <td><input id="quantity6" type="text" name="quantity"></input></td>
                                <td><input id="unit6" type="text" name="unit6"></input></td>
                                <td><input id="unit_price6" type="text" name="unit_price"></input></td>
                                <td><input id="amount6" type="text" name="amount"></input></td>
                                <td><input id="remarks2_6" type="text" name="remarks2"></input></td>
                                <td><button type="submit">登録</button></td>
                            </form>
                        </tr>
                    </tbody>
                @elseif($estimate_info->construction_name==="浴室改修工事　※タイルのみ")
                  <form action="{{ route('estimate.breakdown_store') }}" method="post">
                    @csrf
                    <tbody>
                        <tr>
                                <td><input id="construction_item1" type="text" name="construction_item" placeholder="既存洗い場タイル解体" value="既存洗い場タイル解体"></td>
                                <td><input id="specification1" type="text" name="specification"></input></td>
                                <td><input id="quantity1" type="text" name="quantity"></input></td>
                                <td><input id="unit1" type="text" name="unit"></input></td>
                                <td><input id="unit_price1" type="text" name="unit_price"></input></td>
                                <td><input id="amount1" type="text" name="amount"></input></td>
                                <td><input id="remarks2_1" type="text" name="remarks2"></input></td>
                        </tr>
                        <tr>

                                <td><input id="construction_item2" type="text" name="construction_item" placeholder="土間モルタル打ち" value="土間モルタル打ち"></td>
                                <td><input id="specification2" type="text" name="specification"></input></td>
                                <td><input id="quantity2" type="text" name="quantity"></input></td>
                                <td><input id="unit2" type="text" name="unit"></input></td>
                                <td><input id="unit_price2" type="text" name="unit_price"></input></td>
                                <td><input id="amount2" type="text" name="amount"></input></td>
                                <td><input id="remarks2_2" type="text" name="remarks2"></input></td>


                        </tr>
                        <tr>

                                <td><input id="construction_item3" type="text" name="construction_item" placeholder="タイル貼り付け" value="タイル貼り付け"></td>
                                <td><input id="specification3" type="text" name="specification"></input></td>
                                <td><input id="quantity3" type="text" name="quantity"></input></td>
                                <td><input id="unit3" type="text" name="unit"></input></td>
                                <td><input id="unit_price3" type="text" name="unit_price"></input></td>
                                <td><input id="amount3" type="text" name="amount"></input></td>
                                <td><input id="remarks2_3" type="text" name="remarks2"></input></td>


                        </tr>
                        <tr>

                                <td><input id="construction_item4" type="text" name="construction_item" placeholder="雑工事" value="雑工事"></td>
                                <td><input id="specification4" type="text" name="specification"></input></td>
                                <td><input id="quantity4" type="text" name="quantity"></input></td>
                                <td><input id="unit4" type="text" name="unit"></input></td>
                                <td><input id="unit_price4" type="text" name="unit_price"></input></td>
                                <td><input id="amount4" type="text" name="amount"></input></td>
                                <td><input id="remarks2_4" type="text" name="remarks2"></input></td>


                        </tr>
                        <tr>

                                <td><input id="construction_item5" type="text" name="construction_item" placeholder="廃材処分費" value="廃材処分費"></td>
                                <td><input id="specification5" type="text" name="specification"></input></td>
                                <td><input id="quantity5" type="text" name="quantity"></input></td>
                                <td><input id="unit5" type="text" name="unit"></input></td>
                                <td><input id="unit_price5" type="text" name="unit_price"></input></td>
                                <td><input id="amount5" type="text" name="amount"></input></td>
                                <td><input id="remarks2_5" type="text" name="remarks2"></input></td>


                        </tr>
                        <tr>

                                <td><input id="construction_item6" type="text" name="construction_item" placeholder="諸経費" value="諸経費"></td>
                                <td><input id="specification6" type="text" name="specification"></input></td>
                                <td><input id="quantity6" type="text" name="quantity"></input></td>
                                <td><input id="unit6" type="text" name="unit6"></input></td>
                                <td><input id="unit_price6" type="text" name="unit_price"></input></td>
                                <td><input id="amount6" type="text" name="amount"></input></td>
                                <td><input id="remarks2_6" type="text" name="remarks2"></input></td>


                        </tr>
                    </tbody>
                      <button type="submit">登録</button></td>
                  </form>
                @elseif($estimate_info->construction_name==="浴室改修工事　※バスナフローレのみ")
                    <tbody>
                        <tr>
                            <form action="{{ route('estimate.breakdown_store') }}" method="post">
                                @csrf
                                <td><input id="construction_item1" type="text" name="construction_item" placeholder="土間モルタル打ち" value="土間モルタル打ち"></td>
                                <td><input id="specification1" type="text" name="specification"></input></td>
                                <td><input id="quantity1" type="text" name="quantity"></input></td>
                                <td><input id="unit1" type="text" name="unit"></input></td>
                                <td><input id="unit_price1" type="text" name="unit_price"></input></td>
                                <td><input id="amount1" type="text" name="amount"></input></td>
                                <td><input id="remarks2_1" type="text" name="remarks2"></input></td>
                                <td><button type="submit">登録</button></td>
                            </form>
                        </tr>
                        <tr>
                            <form action="{{ route('estimate.breakdown_store') }}" method="post">
                                @csrf
                                <td><input id="construction_item2" type="text" name="construction_item" placeholder="バスナフローレ貼り付け" value="バスナフローレ貼り付け"></td>
                                <td><input id="specification2" type="text" name="specification"></input></td>
                                <td><input id="quantity2" type="text" name="quantity"></input></td>
                                <td><input id="unit2" type="text" name="unit"></input></td>
                                <td><input id="unit_price2" type="text" name="unit_price"></input></td>
                                <td><input id="amount2" type="text" name="amount"></input></td>
                                <td><input id="remarks2_2" type="text" name="remarks2"></input></td>
                                <td><button type="submit">登録</button></td>
                            </form>
                        </tr>
                        <tr>
                            <form action="{{ route('estimate.breakdown_store') }}" method="post">
                                @csrf
                                <td><input id="construction_item3" type="text" name="construction_item" placeholder="雑工事" value="雑工事"></td>
                                <td><input id="specification3" type="text" name="specification"></input></td>
                                <td><input id="quantity3" type="text" name="quantity"></input></td>
                                <td><input id="unit3" type="text" name="unit"></input></td>
                                <td><input id="unit_price3" type="text" name="unit_price"></input></td>
                                <td><input id="amount3" type="text" name="amount"></input></td>
                                <td><input id="remarks2_3" type="text" name="remarks2"></input></td>
                                <td><button type="submit">登録</button></td>
                            </form>
                        </tr>
                        <tr>
                            <form action="{{ route('estimate.breakdown_store') }}" method="post">
                                @csrf
                                <td><input id="construction_item4" type="text" name="construction_item" placeholder="廃材処分費" value="廃材処分費"></td>
                                <td><input id="specification4" type="text" name="specification"></input></td>
                                <td><input id="quantity4" type="text" name="quantity"></input></td>
                                <td><input id="unit4" type="text" name="unit"></input></td>
                                <td><input id="unit_price4" type="text" name="unit_price"></input></td>
                                <td><input id="amount4" type="text" name="amount"></input></td>
                                <td><input id="remarks2_4" type="text" name="remarks2"></input></td>
                                <td><button type="submit">登録</button></td>
                            </form>
                        </tr>
                        <tr>
                            <form action="{{ route('estimate.breakdown_store') }}" method="post">
                                @csrf
                                <td><input id="construction_item5" type="text" name="construction_item" placeholder="諸経費" value="諸経費"></td>
                                <td><input id="specification5" type="text" name="specification"></input></td>
                                <td><input id="quantity5" type="text" name="quantity"></input></td>
                                <td><input id="unit5" type="text" name="unit"></input></td>
                                <td><input id="unit_price5" type="text" name="unit_price"></input></td>
                                <td><input id="amount5" type="text" name="amount"></input></td>
                                <td><input id="remarks2_5" type="text" name="remarks2"></input></td>
                                <td><button type="submit">登録</button></td>
                            </form>
                        </tr>
                    </tbody>
                @elseif($estimate_info->construction_name==="浴室改修工事　※タイル・浴槽")
                    <tbody>
                        <tr>
                            <form action="{{ route('estimate.breakdown_store') }}" method="post">
                                @csrf
                                <td><input id="construction_item1" type="text" name="construction_item" placeholder="既存洗い場タイル・浴槽解体" value="既存洗い場タイル・浴槽解体"></td>
                                <td><input id="specification1" type="text" name="specification"></input></td>
                                <td><input id="quantity1" type="text" name="quantity"></input></td>
                                <td><input id="unit1" type="text" name="unit"></input></td>
                                <td><input id="unit_price1" type="text" name="unit_price"></input></td>
                                <td><input id="amount1" type="text" name="amount"></input></td>
                                <td><input id="remarks2_1" type="text" name="remarks2"></input></td>
                                <td><button type="submit">登録</button></td>
                            </form>
                        </tr>
                        <tr>
                            <form action="{{ route('estimate.breakdown_store') }}" method="post">
                                @csrf
                                <td><input id="construction_item2" type="text" name="construction_item" placeholder="土間モルタル打ち" value="土間モルタル打ち"></td>
                                <td><input id="specification2" type="text" name="specification"></input></td>
                                <td><input id="quantity2" type="text" name="quantity"></input></td>
                                <td><input id="unit2" type="text" name="unit"></input></td>
                                <td><input id="unit_price2" type="text" name="unit_price"></input></td>
                                <td><input id="amount2" type="text" name="amount"></input></td>
                                <td><input id="remarks2_2" type="text" name="remarks2"></input></td>
                                <td><button type="submit">登録</button></td>
                            </form>
                        </tr>
                        <tr>
                            <form action="{{ route('estimate.breakdown_store') }}" method="post">
                                @csrf
                                <td><input id="construction_item3" type="text" name="construction_item" placeholder="タイル貼り付け" value="タイル貼り付け"></td>
                                <td><input id="specification3" type="text" name="specification"></input></td>
                                <td><input id="quantity3" type="text" name="quantity"></input></td>
                                <td><input id="unit3" type="text" name="unit"></input></td>
                                <td><input id="unit_price3" type="text" name="unit_price"></input></td>
                                <td><input id="amount3" type="text" name="amount"></input></td>
                                <td><input id="remarks2_3" type="text" name="remarks2"></input></td>
                                <td><button type="submit">登録</button></td>
                            </form>
                        </tr>
                        <tr>
                            <form action="{{ route('estimate.breakdown_store') }}" method="post">
                                @csrf
                                <td><input id="construction_item4" type="text" name="construction_item" placeholder="浴槽取り付け" value="浴槽取り付け"></td>
                                <td><input id="specification4" type="text" name="specification"></input></td>
                                <td><input id="quantity4" type="text" name="quantity"></input></td>
                                <td><input id="unit4" type="text" name="unit"></input></td>
                                <td><input id="unit_price4" type="text" name="unit_price"></input></td>
                                <td><input id="amount4" type="text" name="amount"></input></td>
                                <td><input id="remarks2_4" type="text" name="remarks2"></input></td>
                                <td><button type="submit">登録</button></td>
                            </form>
                        </tr>
                        <tr>
                            <form action="{{ route('estimate.breakdown_store') }}" method="post">
                                @csrf
                                <td><input id="construction_item5" type="text" name="construction_item" placeholder="雑工事" value="雑工事"></td>
                                <td><input id="specification5" type="text" name="specification"></input></td>
                                <td><input id="quantity5" type="text" name="quantity"></input></td>
                                <td><input id="unit5" type="text" name="unit"></input></td>
                                <td><input id="unit_price5" type="text" name="unit_price"></input></td>
                                <td><input id="amount5" type="text" name="amount"></input></td>
                                <td><input id="remarks2_5" type="text" name="remarks2"></input></td>
                                <td><button type="submit">登録</button></td>
                            </form>
                        </tr>
                        <tr>
                            <form action="{{ route('estimate.breakdown_store') }}" method="post">
                                @csrf
                                <td><input id="construction_item6" type="text" name="construction_item" placeholder="廃材処分費" value="廃材処分費"></td>
                                <td><input id="specification6" type="text" name="specification"></input></td>
                                <td><input id="quantity6" type="text" name="quantity"></input></td>
                                <td><input id="unit6" type="text" name="unit"></input></td>
                                <td><input id="unit_price6" type="text" name="unit_price"></input></td>
                                <td><input id="amount6" type="text" name="amount"></input></td>
                                <td><input id="remarks2_6" type="text" name="remarks2"></input></td>
                                <td><button type="submit">登録</button></td>
                            </form>
                        </tr>
                        <tr>
                            <form action="{{ route('estimate.breakdown_store') }}" method="post">
                                @csrf
                                <td><input id="construction_item7" type="text" name="construction_item" placeholder="諸経費" value="諸経費"></td>
                                <td><input id="specification7" type="text" name="specification"></input></td>
                                <td><input id="quantity7" type="text" name="quantity"></input></td>
                                <td><input id="unit7" type="text" name="unit"></input></td>
                                <td><input id="unit_price7" type="text" name="unit_price"></input></td>
                                <td><input id="amount7" type="text" name="amount"></input></td>
                                <td><input id="remarks2_7" type="text" name="remarks2"></input></td>
                                <td><button type="submit">登録</button></td>
                            </form>
                        </tr>
                    </tbody>
                @elseif($estimate_info->construction_name==="浴室改修工事　※バスナ・浴槽")
                    <tbody>
                        <tr>
                            <form action="{{ route('estimate.breakdown_store') }}" method="post">
                                @csrf
                                <td><input id="construction_item1" type="text" name="construction_item" placeholder="既存浴槽解体" value="既存浴槽解体"></td>
                                <td><input id="specification1" type="text" name="specification"></input></td>
                                <td><input id="quantity1" type="text" name="quantity"></input></td>
                                <td><input id="unit1" type="text" name="unit"></input></td>
                                <td><input id="unit_price1" type="text" name="unit_price"></input></td>
                                <td><input id="amount1" type="text" name="amount"></input></td>
                                <td><input id="remarks2_1" type="text" name="remarks2"></input></td>
                                <td><button type="submit">登録</button></td>
                            </form>
                        </tr>
                        <tr>
                            <form action="{{ route('estimate.breakdown_store') }}" method="post">
                                @csrf
                                <td><input id="construction_item2" type="text" name="construction_item" placeholder="土間モルタル打ち" value="土間モルタル打ち"></td>
                                <td><input id="specification2" type="text" name="specification"></input></td>
                                <td><input id="quantity2" type="text" name="quantity"></input></td>
                                <td><input id="unit2" type="text" name="unit"></input></td>
                                <td><input id="unit_price2" type="text" name="unit_price"></input></td>
                                <td><input id="amount2" type="text" name="amount"></input></td>
                                <td><input id="remarks2_2" type="text" name="remarks2"></input></td>
                                <td><button type="submit">登録</button></td>
                            </form>
                        </tr>
                        <tr>
                            <form action="{{ route('estimate.breakdown_store') }}" method="post">
                                @csrf
                                <td><input id="construction_item3" type="text" name="construction_item" placeholder="バスナフローレ貼り付け" value="バスナフローレ貼り付け"></td>
                                <td><input id="specification3" type="text" name="specification"></input></td>
                                <td><input id="quantity3" type="text" name="quantity"></input></td>
                                <td><input id="unit3" type="text" name="unit"></input></td>
                                <td><input id="unit_price3" type="text" name="unit_price"></input></td>
                                <td><input id="amount3" type="text" name="amount"></input></td>
                                <td><input id="remarks2_3" type="text" name="remarks2"></input></td>
                                <td><button type="submit">登録</button></td>
                            </form>
                        </tr>
                        <tr>
                            <form action="{{ route('estimate.breakdown_store') }}" method="post">
                                @csrf
                                <td><input id="construction_item4" type="text" name="construction_item" placeholder="浴槽取り付け" value="浴槽取り付け"></td>
                                <td><input id="specification4" type="text" name="specification"></input></td>
                                <td><input id="quantity4" type="text" name="quantity"></input></td>
                                <td><input id="unit4" type="text" name="unit"></input></td>
                                <td><input id="unit_price4" type="text" name="unit_price"></input></td>
                                <td><input id="amount4" type="text" name="amount"></input></td>
                                <td><input id="remarks2_4" type="text" name="remarks2"></input></td>
                                <td><button type="submit">登録</button></td>
                            </form>
                        </tr>
                        <tr>
                            <form action="{{ route('estimate.breakdown_store') }}" method="post">
                                @csrf
                                <td><input id="construction_item5" type="text" name="construction_item" placeholder="雑工事" value="雑工事"></td>
                                <td><input id="specification5" type="text" name="specification"></input></td>
                                <td><input id="quantity5" type="text" name="quantity"></input></td>
                                <td><input id="unit5" type="text" name="unit"></input></td>
                                <td><input id="unit_price5" type="text" name="unit_price"></input></td>
                                <td><input id="amount5" type="text" name="amount"></input></td>
                                <td><input id="remarks2_5" type="text" name="remarks2"></input></td>
                                <td><button type="submit">登録</button></td>
                            </form>
                        </tr>
                        <tr>
                            <form action="{{ route('estimate.breakdown_store') }}" method="post">
                                @csrf
                                <td><input id="construction_item6" type="text" name="construction_item" placeholder="廃材処分費" value="廃材処分費"></td>
                                <td><input id="specification6" type="text" name="specification"></input></td>
                                <td><input id="quantity6" type="text" name="quantity"></input></td>
                                <td><input id="unit6" type="text" name="unit"></input></td>
                                <td><input id="unit_price6" type="text" name="unit_price"></input></td>
                                <td><input id="amount6" type="text" name="amount"></input></td>
                                <td><input id="remarks2_6" type="text" name="remarks2"></input></td>
                                <td><button type="submit">登録</button></td>
                            </form>
                        </tr>
                        <tr>
                            <form action="{{ route('estimate.breakdown_store') }}" method="post">
                                @csrf
                                <td><input id="construction_item7" type="text" name="construction_item" placeholder="諸経費" value="諸経費"></td>
                                <td><input id="specification7" type="text" name="specification"></input></td>
                                <td><input id="quantity7" type="text" name="quantity"></input></td>
                                <td><input id="unit7" type="text" name="unit"></input></td>
                                <td><input id="unit_price7" type="text" name="unit_price"></input></td>
                                <td><input id="amount7" type="text" name="amount"></input></td>
                                <td><input id="remarks2_7" type="text" name="remarks2"></input></td>
                                <td><button type="submit">登録</button></td>
                            </form>
                        </tr>
                    </tbody>
                @elseif($estimate_info->construction_name==="浴室改修工事　※タイル・浴槽・壁")
                    <tbody>
                        <tr>
                            <form action="{{ route('estimate.breakdown_store') }}" method="post">
                                @csrf
                                <td><input id="construction_item1" type="text" name="construction_item" placeholder="既存洗い場タイル・浴槽解体" value="既存洗い場タイル・浴槽解体"></td>
                                <td><input id="specification1" type="text" name="specification"></input></td>
                                <td><input id="quantity1" type="text" name="quantity"></input></td>
                                <td><input id="unit1" type="text" name="unit"></input></td>
                                <td><input id="unit_price1" type="text" name="unit_price"></input></td>
                                <td><input id="amount1" type="text" name="amount"></input></td>
                                <td><input id="remarks2_1" type="text" name="remarks2"></input></td>
                                <td><button type="submit">登録</button></td>
                            </form>
                        </tr>
                        <tr>
                            <form action="{{ route('estimate.breakdown_store') }}" method="post">
                                @csrf
                                <td><input id="construction_item2" type="text" name="construction_item" placeholder="土間モルタル打ち" value="土間モルタル打ち"></td>
                                <td><input id="specification2" type="text" name="specification"></input></td>
                                <td><input id="quantity2" type="text" name="quantity"></input></td>
                                <td><input id="unit2" type="text" name="unit"></input></td>
                                <td><input id="unit_price2" type="text" name="unit_price"></input></td>
                                <td><input id="amount2" type="text" name="amount"></input></td>
                                <td><input id="remarks2_2" type="text" name="remarks2"></input></td>
                                <td><button type="submit">登録</button></td>
                            </form>
                        </tr>
                        <tr>
                            <form action="{{ route('estimate.breakdown_store') }}" method="post">
                                @csrf
                                <td><input id="construction_item3" type="text" name="construction_item" placeholder="タイル貼り付け" value="タイル貼り付け"></td>
                                <td><input id="specification3" type="text" name="specification"></input></td>
                                <td><input id="quantity3" type="text" name="quantity"></input></td>
                                <td><input id="unit3" type="text" name="unit"></input></td>
                                <td><input id="unit_price3" type="text" name="unit_price"></input></td>
                                <td><input id="amount3" type="text" name="amount"></input></td>
                                <td><input id="remarks2_3" type="text" name="remarks2"></input></td>
                                <td><button type="submit">登録</button></td>
                            </form>
                        </tr>
                        <tr>
                            <form action="{{ route('estimate.breakdown_store') }}" method="post">
                                @csrf
                                <td><input id="construction_item4" type="text" name="construction_item" placeholder="浴槽取り付け" value="浴槽取り付け"></td>
                                <td><input id="specification4" type="text" name="specification"></input></td>
                                <td><input id="quantity4" type="text" name="quantity"></input></td>
                                <td><input id="unit4" type="text" name="unit"></input></td>
                                <td><input id="unit_price4" type="text" name="unit_price"></input></td>
                                <td><input id="amount4" type="text" name="amount"></input></td>
                                <td><input id="remarks2_4" type="text" name="remarks2"></input></td>
                                <td><button type="submit">登録</button></td>
                            </form>
                        </tr>
                        <tr>
                            <form action="{{ route('estimate.breakdown_store') }}" method="post">
                                @csrf
                                <td><input id="construction_item5" type="text" name="construction_item" placeholder="壁パネル貼り付け" value="壁パネル貼り付け"></td>
                                <td><input id="specification5" type="text" name="specification"></input></td>
                                <td><input id="quantity5" type="text" name="quantity"></input></td>
                                <td><input id="unit5" type="text" name="unit"></input></td>
                                <td><input id="unit_price5" type="text" name="unit_price"></input></td>
                                <td><input id="amount5" type="text" name="amount"></input></td>
                                <td><input id="remarks2_5" type="text" name="remarks2"></input></td>
                                <td><button type="submit">登録</button></td>
                            </form>
                        </tr>
                        <tr>
                            <form action="{{ route('estimate.breakdown_store') }}" method="post">
                                @csrf
                                <td><input id="construction_item6" type="text" name="construction_item" placeholder="雑工事" value="雑工事"></td>
                                <td><input id="specification6" type="text" name="specification"></input></td>
                                <td><input id="quantity6" type="text" name="quantity"></input></td>
                                <td><input id="unit6" type="text" name="unit"></input></td>
                                <td><input id="unit_price6" type="text" name="unit_price"></input></td>
                                <td><input id="amount6" type="text" name="amount"></input></td>
                                <td><input id="remarks2_6" type="text" name="remarks2"></input></td>
                                <td><button type="submit">登録</button></td>
                            </form>
                        </tr>
                        <tr>
                            <form action="{{ route('estimate.breakdown_store') }}" method="post">
                                @csrf
                                <td><input id="construction_item7" type="text" name="construction_item" placeholder="廃材処分費" value="廃材処分費"></td>
                                <td><input id="specification7" type="text" name="specification"></input></td>
                                <td><input id="quantity7" type="text" name="quantity"></input></td>
                                <td><input id="unit7" type="text" name="unit"></input></td>
                                <td><input id="unit_price7" type="text" name="unit_price"></input></td>
                                <td><input id="amount7" type="text" name="amount"></input></td>
                                <td><input id="remarks2_7" type="text" name="remarks2"></input></td>
                                <td><button type="submit">登録</button></td>
                            </form>
                        </tr>
                        <tr>
                            <form action="{{ route('estimate.breakdown_store') }}" method="post">
                                @csrf
                                <td><input id="construction_item8" type="text" name="construction_item" placeholder="諸経費" value="諸経費"></td>
                                <td><input id="specification8" type="text" name="specification"></input></td>
                                <td><input id="quantity8" type="text" name="quantity"></input></td>
                                <td><input id="unit8" type="text" name="unit"></input></td>
                                <td><input id="unit_price8" type="text" name="unit_price"></input></td>
                                <td><input id="amount8" type="text" name="amount"></input></td>
                                <td><input id="remarks2_8" type="text" name="remarks2"></input></td>
                                <td><button type="submit">登録</button></td>
                            </form>
                        </tr>
                    </tbody>
                @elseif($estimate_info->construction_name==="浴室改修工事　※バスナ・浴槽・壁")
                    <tbody>
                        <tr>
                            <form action="{{ route('estimate.breakdown_store') }}" method="post">
                                @csrf
                                <td><input id="construction_item1" type="text" name="construction_item" placeholder="既存浴槽解体" value="既存浴槽解体"></td>
                                <td><input id="specification1" type="text" name="specification"></input></td>
                                <td><input id="quantity1" type="text" name="quantity"></input></td>
                                <td><input id="unit1" type="text" name="unit"></input></td>
                                <td><input id="unit_price1" type="text" name="unit_price"></input></td>
                                <td><input id="amount1" type="text" name="amount"></input></td>
                                <td><input id="remarks2_1" type="text" name="remarks2"></input></td>
                                <td><button type="submit">登録</button></td>
                            </form>
                        </tr>
                        <tr>
                            <form action="{{ route('estimate.breakdown_store') }}" method="post">
                                @csrf
                                <td><input id="construction_item2" type="text" name="construction_item" placeholder="土間モルタル打ち" value="土間モルタル打ち"></td>
                                <td><input id="specification2" type="text" name="specification"></input></td>
                                <td><input id="quantity2" type="text" name="quantity"></input></td>
                                <td><input id="unit2" type="text" name="unit"></input></td>
                                <td><input id="unit_price2" type="text" name="unit_price"></input></td>
                                <td><input id="amount2" type="text" name="amount"></input></td>
                                <td><input id="remarks2_2" type="text" name="remarks2"></input></td>
                                <td><button type="submit">登録</button></td>
                            </form>
                        </tr>
                        <tr>
                            <form action="{{ route('estimate.breakdown_store') }}" method="post">
                                @csrf
                                <td><input id="construction_item3" type="text" name="construction_item" placeholder="バスナフローレ貼り付け" value="バスナフローレ貼り付け"></td>
                                <td><input id="specification3" type="text" name="specification"></input></td>
                                <td><input id="quantity3" type="text" name="quantity"></input></td>
                                <td><input id="unit3" type="text" name="unit"></input></td>
                                <td><input id="unit_price3" type="text" name="unit_price"></input></td>
                                <td><input id="amount3" type="text" name="amount"></input></td>
                                <td><input id="remarks2_3" type="text" name="remarks2"></input></td>
                                <td><button type="submit">登録</button></td>
                            </form>
                        </tr>
                        <tr>
                            <form action="{{ route('estimate.breakdown_store') }}" method="post">
                                @csrf
                                <td><input id="construction_item4" type="text" name="construction_item" placeholder="浴槽取り付け" value="浴槽取り付け"></td>
                                <td><input id="specification4" type="text" name="specification"></input></td>
                                <td><input id="quantity4" type="text" name="quantity"></input></td>
                                <td><input id="unit4" type="text" name="unit"></input></td>
                                <td><input id="unit_price4" type="text" name="unit_price"></input></td>
                                <td><input id="amount4" type="text" name="amount"></input></td>
                                <td><input id="remarks2_4" type="text" name="remarks2"></input></td>
                                <td><button type="submit">登録</button></td>
                            </form>
                        </tr>
                        <tr>
                            <form action="{{ route('estimate.breakdown_store') }}" method="post">
                                @csrf
                                <td><input id="construction_item5" type="text" name="construction_item" placeholder="壁パネル貼り付け" value="壁パネル貼り付け"></td>
                                <td><input id="specification5" type="text" name="specification"></input></td>
                                <td><input id="quantity5" type="text" name="quantity"></input></td>
                                <td><input id="unit5" type="text" name="unit"></input></td>
                                <td><input id="unit_price5" type="text" name="unit_price"></input></td>
                                <td><input id="amount5" type="text" name="amount"></input></td>
                                <td><input id="remarks2_5" type="text" name="remarks2"></input></td>
                                <td><button type="submit">登録</button></td>
                            </form>
                        </tr>
                        <tr>
                            <form action="{{ route('estimate.breakdown_store') }}" method="post">
                                @csrf
                                <td><input id="construction_item6" type="text" name="construction_item" placeholder="雑工事" value="雑工事"></td>
                                <td><input id="specification6" type="text" name="specification"></input></td>
                                <td><input id="quantity6" type="text" name="quantity"></input></td>
                                <td><input id="unit6" type="text" name="unit"></input></td>
                                <td><input id="unit_price6" type="text" name="unit_price"></input></td>
                                <td><input id="amount6" type="text" name="amount"></input></td>
                                <td><input id="remarks2_6" type="text" name="remarks2"></input></td>
                                <td><button type="submit">登録</button></td>
                            </form>
                        </tr>
                        <tr>
                            <form action="{{ route('estimate.breakdown_store') }}" method="post">
                                @csrf
                                <td><input id="construction_item7" type="text" name="construction_item" placeholder="廃材処分費" value="廃材処分費"></td>
                                <td><input id="specification7" type="text" name="specification"></input></td>
                                <td><input id="quantity7" type="text" name="quantity"></input></td>
                                <td><input id="unit7" type="text" name="unit"></input></td>
                                <td><input id="unit_price7" type="text" name="unit_price"></input></td>
                                <td><input id="amount7" type="text" name="amount"></input></td>
                                <td><input id="remarks2_7" type="text" name="remarks2"></input></td>
                                <td><button type="submit">登録</button></td>
                            </form>
                        </tr>
                        <tr>
                            <form action="{{ route('estimate.breakdown_store') }}" method="post">
                                @csrf
                                <td><input id="construction_item8" type="text" name="construction_item" placeholder="諸経費" value="諸経費"></td>
                                <td><input id="specification8" type="text" name="specification"></input></td>
                                <td><input id="quantity8" type="text" name="quantity"></input></td>
                                <td><input id="unit8" type="text" name="unit"></input></td>
                                <td><input id="unit_price8" type="text" name="unit_price"></input></td>
                                <td><input id="amount8" type="text" name="amount"></input></td>
                                <td><input id="remarks2_8" type="text" name="remarks2"></input></td>
                                <td><button type="submit">登録</button></td>
                            </form>
                        </tr>
                    </tbody>
                @elseif($estimate_info->construction_name==="システムバス工事")
                    <tbody>
                        <tr>
                            <form action="{{ route('estimate.breakdown_store') }}" method="post">
                                @csrf
                                <td><input id="construction_item1" type="text" name="construction_item" placeholder="既存浴槽解体" value="既存浴槽解体"></td>
                                <td><input id="specification1" type="text" name="specification"></input></td>
                                <td><input id="quantity1" type="text" name="quantity"></input></td>
                                <td><input id="unit1" type="text" name="unit"></input></td>
                                <td><input id="unit_price1" type="text" name="unit_price"></input></td>
                                <td><input id="amount1" type="text" name="amount"></input></td>
                                <td><input id="remarks2_1" type="text" name="remarks2"></input></td>
                                <td><button type="submit">登録</button></td>
                            </form>
                        </tr>
                        <tr>
                            <form action="{{ route('estimate.breakdown_store') }}" method="post">
                                @csrf
                                <td><input id="construction_item2" type="text" name="construction_item" placeholder="電気工事" value="電気工事"></td>
                                <td><input id="specification2" type="text" name="specification"></input></td>
                                <td><input id="quantity2" type="text" name="quantity"></input></td>
                                <td><input id="unit2" type="text" name="unit"></input></td>
                                <td><input id="unit_price2" type="text" name="unit_price"></input></td>
                                <td><input id="amount2" type="text" name="amount"></input></td>
                                <td><input id="remarks2_2" type="text" name="remarks2"></input></td>
                                <td><button type="submit">登録</button></td>
                            </form>
                        </tr>
                        <tr>
                            <form action="{{ route('estimate.breakdown_store') }}" method="post">
                                @csrf
                                <td><input id="construction_item3" type="text" name="construction_item" placeholder="水道工事" value="水道工事"></td>
                                <td><input id="specification3" type="text" name="specification"></input></td>
                                <td><input id="quantity3" type="text" name="quantity"></input></td>
                                <td><input id="unit3" type="text" name="unit"></input></td>
                                <td><input id="unit_price3" type="text" name="unit_price"></input></td>
                                <td><input id="amount3" type="text" name="amount"></input></td>
                                <td><input id="remarks2_3" type="text" name="remarks2"></input></td>
                                <td><button type="submit">登録</button></td>
                            </form>
                        </tr>
                        <tr>
                            <form action="{{ route('estimate.breakdown_store') }}" method="post">
                                @csrf
                                <td><input id="construction_item4" type="text" name="construction_item" placeholder="土間モルタル打ち" value="土間モルタル打ち"></td>
                                <td><input id="specification4" type="text" name="specification"></input></td>
                                <td><input id="quantity4" type="text" name="quantity"></input></td>
                                <td><input id="unit4" type="text" name="unit"></input></td>
                                <td><input id="unit_price4" type="text" name="unit_price"></input></td>
                                <td><input id="amount4" type="text" name="amount"></input></td>
                                <td><input id="remarks2_4" type="text" name="remarks2"></input></td>
                                <td><button type="submit">登録</button></td>
                            </form>
                        </tr>
                        <tr>
                            <form action="{{ route('estimate.breakdown_store') }}" method="post">
                                @csrf
                                <td><input id="construction_item5" type="text" name="construction_item" placeholder="防水処理" value="防水処理"></td>
                                <td><input id="specification5" type="text" name="specification"></input></td>
                                <td><input id="quantity5" type="text" name="quantity"></input></td>
                                <td><input id="unit5" type="text" name="unit"></input></td>
                                <td><input id="unit_price5" type="text" name="unit_price"></input></td>
                                <td><input id="amount5" type="text" name="amount"></input></td>
                                <td><input id="remarks2_5" type="text" name="remarks2"></input></td>
                                <td><button type="submit">登録</button></td>
                            </form>
                        </tr>
                        <tr>
                            <form action="{{ route('estimate.breakdown_store') }}" method="post">
                                @csrf
                                <td><input id="construction_item6" type="text" name="construction_item" placeholder="システムバス" value="システムバス"></td>
                                <td><input id="specification6" type="text" name="specification"></input></td>
                                <td><input id="quantity6" type="text" name="quantity"></input></td>
                                <td><input id="unit6" type="text" name="unit"></input></td>
                                <td><input id="unit_price6" type="text" name="unit_price"></input></td>
                                <td><input id="amount6" type="text" name="amount"></input></td>
                                <td><input id="remarks2_6" type="text" name="remarks2"></input></td>
                                <td><button type="submit">登録</button></td>
                            </form>
                        </tr>
                        <tr>
                            <form action="{{ route('estimate.breakdown_store') }}" method="post">
                                @csrf
                                <td><input id="construction_item7" type="text" name="construction_item" placeholder="システムバス組み立て" value="システムバス組み立て"></td>
                                <td><input id="specification7" type="text" name="specification"></input></td>
                                <td><input id="quantity7" type="text" name="quantity"></input></td>
                                <td><input id="unit7" type="text" name="unit"></input></td>
                                <td><input id="unit_price7" type="text" name="unit_price"></input></td>
                                <td><input id="amount7" type="text" name="amount"></input></td>
                                <td><input id="remarks2_7" type="text" name="remarks2"></input></td>
                                <td><button type="submit">登録</button></td>
                            </form>
                        </tr>
                        <tr>
                            <form action="{{ route('estimate.breakdown_store') }}" method="post">
                                @csrf
                                <td><input id="construction_item8" type="text" name="construction_item" placeholder="大工工事" value="大工工事"></td>
                                <td><input id="specification8" type="text" name="specification"></input></td>
                                <td><input id="quantity8" type="text" name="quantity"></input></td>
                                <td><input id="unit8" type="text" name="unit"></input></td>
                                <td><input id="unit_price8" type="text" name="unit_price"></input></td>
                                <td><input id="amount8" type="text" name="amount"></input></td>
                                <td><input id="remarks2_8" type="text" name="remarks2"></input></td>
                                <td><button type="submit">登録</button></td>
                            </form>
                        </tr>
                        <tr>
                            <form action="{{ route('estimate.breakdown_store') }}" method="post">
                                @csrf
                                <td><input id="construction_item9" type="text" name="construction_item" placeholder="雑工事" value="雑工事"></td>
                                <td><input id="specification9" type="text" name="specification"></input></td>
                                <td><input id="quantity9" type="text" name="quantity"></input></td>
                                <td><input id="unit9" type="text" name="unit"></input></td>
                                <td><input id="unit_price9" type="text" name="unit_price"></input></td>
                                <td><input id="amount9" type="text" name="amount"></input></td>
                                <td><input id="remarks2_9" type="text" name="remarks2"></input></td>
                                <td><button type="submit">登録</button></td>
                            </form>
                        </tr>
                        <tr>
                            <form action="{{ route('estimate.breakdown_store') }}" method="post">
                                @csrf
                                <td><input id="construction_item10" type="text" name="construction_item" placeholder="資材運搬費" value="資材運搬費"></td>
                                <td><input id="specification10" type="text" name="specification"></input></td>
                                <td><input id="quantity10" type="text" name="quantity"></input></td>
                                <td><input id="unit10" type="text" name="unit"></input></td>
                                <td><input id="unit_price10" type="text" name="unit_price"></input></td>
                                <td><input id="amount10" type="text" name="amount"></input></td>
                                <td><input id="remarks2_10" type="text" name="remarks2"></input></td>
                                <td><button type="submit">登録</button></td>
                            </form>
                        </tr>
                        <tr>
                            <form action="{{ route('estimate.breakdown_store') }}" method="post">
                                @csrf
                                <td><input id="construction_item11" type="text" name="construction_item" placeholder="廃材処分費" value="廃材処分費"></td>
                                <td><input id="specification11" type="text" name="specification"></input></td>
                                <td><input id="quantity11" type="text" name="quantity"></input></td>
                                <td><input id="unit11" type="text" name="unit"></input></td>
                                <td><input id="unit_price11" type="text" name="unit_price"></input></td>
                                <td><input id="amount11" type="text" name="amount"></input></td>
                                <td><input id="remarks2_11" type="text" name="remarks2"></input></td>
                                <td><button type="submit">登録</button></td>
                            </form>
                        </tr>
                        <tr>
                            <form action="{{ route('estimate.breakdown_store') }}" method="post">
                                @csrf
                                <td><input id="construction_item12" type="text" name="construction_item" placeholder="諸経費" value="諸経費"></td>
                                <td><input id="specification12" type="text" name="specification"></input></td>
                                <td><input id="quantity12" type="text" name="quantity"></input></td>
                                <td><input id="unit12" type="text" name="unit"></input></td>
                                <td><input id="unit_price12" type="text" name="unit_price"></input></td>
                                <td><input id="amount12" type="text" name="amount"></input></td>
                                <td><input id="remarks2_12" type="text" name="remarks2"></input></td>
                                <td><button type="submit">登録</button></td>
                            </form>
                        </tr>
                    </tbody>
                @endif
            </table>
        </div>

    <div>
        <form action="{{ route('salesperson_menu.get') }}" method="GET">
            @csrf
            <button>営業者メニューへ</button>
        </form>
    </div>
</body>

</html>
