@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">見積書一覧</h1>

    <a href="{{ route('estimate_info.index') }}" class="btn btn-primary mb-3">見積書一覧</a>

   

    <div class="estimate_info mt-5">
        <h2>見積書情報</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>見積書発行日</th>
                    <th>お客様名</th>
                    <th>工事名</th>
                    <th>営業担当者</th>
                    <th>営業部署</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            @foreach ($estimate_info as $estimate)
                <tr>
                    <td>{{ $estimate->creation_date }}</td>
                    <td>{{ $estimate->customer_name }}</td>
                    <td>{{ $estimate->construction_name }}</td>
                    <td>{{ $estimate->charger_name }}</td>
                    <td>{{ $estimate->department_name }}</td>
                    <td>
                        <a href="{{ route('products.show', $product) }}" class="btn btn-info btn-sm mx-1">詳細表示</a>
                        <a href="{{ route('products.edit', $product) }}" class="btn btn-primary btn-sm mx-1">編集</a>
                        <form method="POST" action="{{ route('estimate.destroy', $product) }}" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm mx-1">削除</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    
</div>
@endsection

