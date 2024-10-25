<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>内訳明細書</title>
    <link rel="stylesheet" href="{{ asset('css/ichirann.css') }}">
</head>

<body class="estimate-detail">
    <div>
        <h2>内訳明細書</h2>
    </div>
    <div class="contact-info">
        <p>株式会社サーバントップ</p>
    </div>

    <div class="construction-name">
        <label for="construction-name">工事名</label>
        <input type="text" id="construction-name" name="construction_name"
               value="{{ $estimate_info->construction_name ?? '' }}"
               placeholder="工事名を入力してください">
    </div>
    <div>
        <table class="table-large item-table estimate-item-table">
            <tr class="iro">
                <th>項目</th>
                <th>仕様・摘要</th>
                <th>数量</th>
                <th>単位</th>
                <th>単価</th>
                <th>金額</th>
                <th>備考</th>
            </tr>
            @php
                // Initialize total amount and discount
                $totalAmount = 0;
                $discount = 0; // Set your discount value here
            @endphp
            @foreach ($breakdown as $item)
                @php
                    $totalAmount += $item->amount; // Add each item's amount to total
                @endphp
                <tr>
                    <td>{{ $item->construction_item }}</td>
                    <td>{{ $item->specification }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ $item->unit }}</td>
                    <td>{{ number_format($item->unit_price) }}</td>
                    <td>{{ number_format($item->amount) }}</td>
                    <td>{{ $item->remarks }}</td>
                </tr>
            @endforeach

            {{-- Calculate subtotal, tax, and grand total --}}
            @php
                $subtotal = $totalAmount - $discount; // Calculate subtotal after discount
                $tax = $subtotal * 0.1; // Calculate 10% tax
                $grandTotal = $subtotal + $tax; // Calculate grand total
            @endphp
            <tr>
                <td colspan="5" class="custom-width" style="text-align: right;">特別お値引き</td>
                <td>{{ number_format($discount) }}</td>
            </tr>
            <tr>
                <td colspan="5" class="custom-width" style="text-align: right;">小計（税抜）</td>
                <td>{{ number_format($subtotal) }}</td>
            </tr>
            <tr>
                <td colspan="5" class="custom-width" style="text-align: right;">消費税（10%）</td>
                <td>{{ number_format($tax) }}</td>
            </tr>
            <tr>
                <td colspan="5" class="custom-width" style="text-align: right;">合計（税込）</td>
                <td>{{ number_format($grandTotal) }}</td>
            </tr>
        </table>
    </div>

    <div class="actions-2">
        <div class="action2">
            {{-- <a href="{{ route('generate_pdf') }}" class="btn btn-warning no-print">View PDF</a> --}}

            <button class="btn btn-primary no-print" style="margin: 10px;" onclick="printPage()">Print PDF</button>

            <a href="{{ route('showPdftrail', ['id' => $id]) }}" class="btn btn-primary no-print">View PDF<br>(TCPDF)</a>
            {{-- <a href="{{ route('generatefpdi', ['id' => $id]) }}"class="btn btn-primary no-print">View PDF<br>(fpdi)</a> --}}
            <a href="{{ route('manager_estimate') }}" class="btn btn-primary no-print">戻る</a>

            {{-- <a href="{{ route('showPdftrail', ['id' => $estimateId]) }}" class="btn btn-primary">Download DDF</a> --}}
        </div>
    </div>
    <script>
        function printPage() {
            console.log("btn btn-warning clicked!"); // Debugging message
            window.print();
        }
    </script>
</body>

</html>
