$(function(){
    // 追加ボタンを押した時
    $('#add_breakdown').click(function(event){
        var count = parseInt($('#breakdown_count').val()) + 1;
        $('#breakdown_table').append('<tr id="breakdown_no_' + count + '">\n' +
            '                            <td><input id="item_' + count + '" type="text" name="item[' + count + ']" value=""></td>\n' +
            '                            <td><input id="maker_' + count + '" type="text" name="maker[' + count + ']" value=""></td>\n' +
            '                            <td><input id="series_name_' + count + '" type="text" name="series_name[' + count + ']" value=""></td>\n' +
            '                            <td><input id="item_number_' + count + '" type="text" name="item_number[' + count + ']" value=""></td>\n' +
            '                            <td><input id="quantity_' + count + '" class="amount_output" data-count="' + count + '" type="number" name="quantity[' + count + ']" value=""></td>\n' +
            '                            <td><input id="unit_' + count + '" type="text" name="unit[' + count + ']" value=""></td>\n' +
            '                            <td><input id="unit_price_' + count + '" class="amount_output" data-count="' + count + '" type="number" name="unit_price[' + count + ']" value=""></td>\n' +
            '                            <td><input id="amount_' + count + '" type="text" name="amount[' + count + ']" value=""></td>\n' +
            '                            <td><input id="remarks_' + count + '" type="text" name="remarks[' + count + ']" value=""></td>\n' +
            '                            <td><button type="button" class="delete_breakdown" data-breakdown_no="' + count + '">削除</button></td>\n' +
            '                        </tr>\n'
        );

        $('#breakdown_count').val(count);
    });

    // 削除ボタンを押した時
    $(document).on('click', '.delete_breakdown',function(event){
        // 削除の確認
        var tr_count = $("#breakdown_table tbody").children().length;
        var breakdown_no = $(this).data('breakdown_no');

        if(tr_count > 1 ) {// テーブルが2行以上存在する
            // 削除の確認
            var delete_confirm = confirm('削除してよろしいでしょうか？');
            if(delete_confirm == true) {// OKを押したら
                // 削除ボタンをクリックしたli.list__itemを削除
                $('#breakdown_no_' + breakdown_no).remove();
            }
        } else {
            alert('内訳明細は一件以上が必要です。');
        }
    });

    // 金額計算
    $('.amount_output').change(function() {
        let loop_count = $(this).data('count');
        let quantity = parseInt($('#quantity_' + loop_count).val());
        let unit_price = parseInt($('#unit_price_' + loop_count).val());

        if(Number.isInteger(quantity) && Number.isInteger(unit_price)) {
            let amount = quantity * unit_price;
            $('#amount_' + loop_count).val(amount);
        } else {
            return false;
        }
    });
});
