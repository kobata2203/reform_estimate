@extends('layouts.main')

@section('title', '見積書作成画面')

@section('headder')
    <link rel="stylesheet" href="{{ asset('css/cover/index.css') }}">
    <script src="{{ asset('/js/cover/util.js') }}"></script>
    <script src="{{ asset('/js/cover/index.js') }}"></script>
@endsection

@section('content')

    <div>
        <h4>見積書作成</h4>
        <p>各項目を入力・選択後、登録ボタン押下してください。</p>
    </div>
    <div class="container">
        <form id="estimate" method="post" action="{{ $action }}">
            @csrf
            <table>
                <tr>
                    <th>お客様名</th>
                    <td>
                        <input id="customer_name" type="text" name="customer_name" value="{{ old("customer_name", $estimate_info->customer_name) }}" required>
                        @if ($errors->has("customer_name"))
                            <div class="invalid-feedback" role="alert">
                                {{ $errors->first("customer_name") }}
                            </div>
                        @endif
                    </td>
                </tr>
                <tr>
                    <th>担当者名</th>
                    <td>
                        <input id="charger_name" type="text" name="charger_name" value="{{ old("charger_name", $estimate_info->charger_name) }}" required>
                        @if ($errors->has("charger_name"))
                            <div class="invalid-feedback" role="alert">
                                {{ $errors->first("charger_name") }}
                            </div>
                        @endif
                    </td>
                </tr>
                <tr>
                    <th>件名</th>
                    <td>
                        <input id="subject_name" type="text" name="subject_name" value="{{ old("subject_name", $estimate_info->subject_name) }}" required>
                        @if ($errors->has("subject_name"))
                            <div class="invalid-feedback" role="alert">
                                {{ $errors->first("subject_name") }}
                            </div>
                        @endif
                    </td>
                </tr>
                <tr>
                    <th>納入場所</th>
                    <td>
                        <input id="delivery_place" type="text" name="delivery_place" value="{{ old("delivery_place", $estimate_info->delivery_place) }}" required>
                        @if ($errors->has("delivery_place"))
                            <div class="invalid-feedback" role="alert">
                                {{ $errors->first("delivery_place") }}
                            </div>
                        @endif
                    </td>
                </tr>
                <tr>
                    <th>工期</th>
                    <td>
                        <input id="construction_period" type="text" name="construction_period" value="{{ old("construction_period", $estimate_info->construction_period) }}" required>
                        @if ($errors->has("construction_period"))
                            <div class="invalid-feedback" role="alert">
                                {{ $errors->first("construction_period") }}
                            </div>
                        @endif
                    </td>
                </tr>
                <tr>
                    <th>支払方法</th>
                    <td>
                        <select id="payment_id" type="text" name="payment_id" value="{{ old("payment_id", $estimate_info->payment_id) }}">
                            @foreach($payments as $payment)
                                <option value={{ $payment ->id }}@if($payment->id == old("payment_id", $estimate_info->payment_id)) selected @endif>{{ $payment->name }}</option>
                            @endforeach
                        </select>
                        @if ($errors->has("payment_id"))
                            <div class="invalid-feedback" role="alert">
                                {{ $errors->first("payment_id") }}
                            </div>
                        @endif
                    </td>
                </tr>
                <tr>
                    <th>有効期限</th>
                    <td>
                        <input id="expiration_date" type="text" name="expiration_date" value="{{ old("expiration_date", $estimate_info->expiration_date) }}" required>
                        @if ($errors->has("expiration_date"))
                            <div class="invalid-feedback" role="alert">
                                {{ $errors->first("expiration_date") }}
                            </div>
                        @endif
                    </td>
                </tr>
                <tr>
                    <th>備考</th>
                    <td>
                        <textarea id="remarks" name="remarks">{{ old("remarks", $estimate_info->remarks) }}</textarea>
                        @if ($errors->has("remarks"))
                            <div class="invalid-feedback" role="alert">
                                {{ $errors->first("remarks") }}
                            </div>
                        @endif
                    </td>
                </tr>
                <tr>
                    <th>部署名</th>
                    <td>
                        <select id="department" name="department_id"  class="department_id">
                            @foreach($departments as $department)
                                <option value={{ $department->id }} @if($department->id == old("payment_id", $estimate_info->department_id))selected @endif>{{ $department->name }}</option>
                            @endforeach
                        </select>
                        @if ($errors->has("department_id"))
                            <div class="invalid-feedback" role="alert">
                                {{ $errors->first("department_id") }}
                            </div>
                        @endif
                    </td>
                </tr>
                <tr>
                    <th>工事名</th>
                    <td>
                        <ul class="list">
                            @foreach($registered_construction_list as $registered_construction)
                                <li class="list__item">{{ $registered_construction->name }}</li>
                            @endforeach
                            <li class="list__item">
                                @for ($i = 1; $i <= old("construction_count", $construction_count); $i++)
                                    <select id="select_construction{{ $i }}" name="select_construction{{ $i }}"  class="select_construction" data-no="{{ $i }}">
                                        <option value=""></option>
                                        @foreach($construction_name as $construction)
                                            <option value={{ $construction->construction_name }}@if($construction->construction_name == $construction) selected @endif>{{ $construction->construction_name }}</option>
                                        @endforeach
                                    </select></br>
                                    <input type="text" name="construction_name[{{ $i }}]" class="construction_name" id="construction_name{{ $i }}" value="{{ old("construction_name.$i") }}"@if($regist_type == config('util.regist_type_create')) required @endif>
                                    @if ($errors->has("construction_name.$i"))
                                        <div class="invalid-feedback" role="alert">
                                            {{ $errors->first("construction_name.$i") }}
                                        </div>
                                    @endif
                                    <p class="delete">
                                        <button type="button" class="js-delete-btn">削除</button>
                                    </p>
                                @endfor
                            </li>
                        </ul>
                        <p class="add">
                            <button class="btn-add" id="add_construction" type="button">追加</button>
                        </p>
                        <input type="hidden" name="construction_count" class="construction_count" id="construction_count" value="{{ old("construction_count", $construction_count) }}">
                    </td>
                </tr>
            </table>
            <div class="btn-submit">
                <button class="btn" id="btn1" type="submit">登録</button>
            </div>
            <input type="hidden" name="regist_type" value="{{ $regist_type }}">
        </form>
    </div>
    <div id="btn2" class="btn-back">
        <button class="btn" id="btn_back" data-url="{{ $prev_url }}">戻る</button>
    </div>

@endsection
