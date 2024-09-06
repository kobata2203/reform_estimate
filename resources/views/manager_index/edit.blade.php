@extends('layouts.app1')

@section('content')
<div class="container">
    <h1>営業者情報編集画面</h1>

    <!-- Form to edit salesperson details -->
    <form action="{{ route('salespersons.update', $salesperson->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">氏名</label>
            <input type="text" id="name" name="name" value="{{ old('name', $salesperson->name) }}" class="form-control">
            @error('name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="email">メールアドレス</label>
            <input type="email" id="email" name="email" value="{{ old('email', $salesperson->email) }}" class="form-control">
            @error('email')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="password">パスワード</label>
            <input type="password" id="password" name="password" class="form-control">
            @error('password')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="department_name">部署名</label>
            <select id="department_name" name="department_name" class="form-control">
                <!-- Populate departments dynamically -->
                <option value="">Select a department</option>
                @foreach($departments as $department)
                    <option value="{{ $department->id }}" {{ old('department_name', $salesperson->department_id) == $department->id ? 'selected' : '' }}>
                        {{ $department->name }}
                    </option>
                @endforeach
            </select>
            @error('department_name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">更新</button>
        <a href="{{ route('manager_index.index') }}" class="btn btn-secondary"></a>
    </form>
</div>
@endsection
