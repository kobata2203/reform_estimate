<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>営業者一覧編集画面</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>
    <div class="bg-dark py-3">
        <h3 class="text-white text-center">営業者一覧編集画面</h3>
    </div>
    <div class="container">
        <div class="row justify-content-center mt-4">
            <div class="col-md-10 d-flex justify-content-end">
                <a href="{{ route('products.index') }}" class="btn btn-dark">戻る</a>
            </div>
        </div>
        <div class="row d-flex justify-content-center">
            <div class="col-md-10">
                <div class="card borde-0 shadow-lg my-4">
                    <div class="card-header bg-dark">
                        <h3 class="text-white">氏名</h3>
                    </div>
                    <form enctype="multipart/form-data" action="{{ route('manager_index.index',$product->id) }}" method="post">
                        @method('put')
                        @csrf
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="" class="form-label h5">メールアドレス</label>
                                <input value="{{ old('name',$product-email) }}" type="text" class="@error('email') is-invalid @enderror form-control-lg form-control" placeholder="Email" name="email">
                                @error('email')
                                    <p class="invalid-feedback">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label h5">パスワード</label>
                                <input value="{{ old('sku',$product->password) }}" type="text" class="@error('password') is-invalid @enderror form-control form-control-lg" placeholder="password" name="password">
                                @error('password')
                                    <p class="invalid-feedback">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="department_name" class="form-label h5">部署名</label>
                                <select name="department_name" id="department_name" class="form-select form-select-lg @error('department_name') is-invalid @enderror">
                                    <option value="" disabled selected>Select a department</option>
                                    @foreach($departments as $department)
                                        <option value="{{ $department->value }}" {{ old('department_name', $product->department_name) == $department->value ? 'selected' : '' }}>
                                            {{ $department->label }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('department_name')
                                    <p class="invalid-feedback">{{ $message }}</p>
                                @enderror
                            </div>


                            <div class="d-grid">
                                <button class="btn btn-lg btn-primary">保存</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
