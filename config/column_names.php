<?php
return [
    'breakdown_item' => env('BREAKDOWN_ITEM','項目名'),
    'breakdown_maker' => env('BREAKDOWN_MAKER','	メーカー名'),
    'breakdown_series_name' => env('BREAKDOWN_SERIES_NAME','	シリーズ名（商品名）'),
    'breakdown_item_number' => env('BREAKDOWN_ITEM_NUMBER','	品番'),
    'breakdown_quantity' => env('BREAKDOWN_QUANTITY','数量'),
    'breakdown_unit' => env('BREAKDOWN_UNIT','単位'),
    'breakdown_unit_price' => env('BREAKDOWN_UNIT_PRICE','単価'),
    'breakdown_amount' => env('BREAKDOWN_AMOUNT','金額'),
    'special_discount' => env('SPECIAL_DISCOUNT', '特別お値引き'),
    'grand_total' => env('GRAND_TOTAL', '合計金額'),

    'customer_name' => env('CUSTOMER_NAME','お客様名'),
    'charger_name' => env('CHARGER_NAME','担当者名'),
    'subject_name' => env('SUBJECT_NAME','件名'),
    'delivery_place' => env('DELIVERY_PLACE','納入場所'),
    'construction_period' => env('CONSTRUCTION_PERIOD','工期'),
    'payment_id' => env('PAYMENT_ID','支払方法'),
    'expiration_date' => env('EXPIRATION_DATE','有効期限'),
    'department_id' => env('DEPARTMENT_ID','部署名'),
    'remarks' => env('REMARKS','備考'),
    'construction_name' => env('CONSTRUCTION_NAME','工事名'),

];
