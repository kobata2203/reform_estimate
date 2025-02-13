$(function(){
    $('.select_construction').change(function() {
        // 選択されているvalue属性値を取り出す
        let val = $(this).val();
        let no = $(this).data('no');

        // 選択されている表示文字列を取り出す
        $('#construction_name' + no).val(val);
    });

    // 追加ボタンを押した時
    $('#add_construction').on('click',function() {
        // ul.listの中の一番下のli.list__itemをクローン
        var clone = $(this).parent().prev('ul.list').find('li.list__item:last-of-type').clone(true);
        // クローンした要素のinputのvalue属性を空にする
        clone.find('input[type="text"]').val('');
        // クローンしてinputを操作した要素をul.listの一番下に追加
        clone.appendTo('.list');

        number();
    });

    // 削除ボタンを押した時
    $('.js-delete-btn').on('click',function() {
        if($('.add_item').length > 1 ) {//li.list__itemが1つより多い時
            // 削除の確認
            var deleteConfirm = confirm('削除してよろしいでしょうか？');
            if(deleteConfirm == true) {// OKを押したら
                // 削除ボタンをクリックしたli.list__itemを削除
                $(this).closest('.add_item').remove();
            }
        } else {
            alert('工事名は一件以上が必要です。');
        }
    });

    // 数字を入れ替える
    function number() {
        var $i = 0;
        $('.select_construction').each(function() {
            $i++;
            // inputのnameやidも変更
            $(this).attr('name', 'select_construction'+$i);
            $(this).attr('id', 'select_construction'+$i);
            $(this).data('no', $i);
        });
        $('#construction_count').val($i);

        var $i = 0;
        $('.construction_name').each(function() {
            $i++;
            // inputのnameやidも変更
            $(this).attr('id', 'construction_name'+$i);
            $(this).attr('name', 'construction_name['+$i+']');
        });
    }

});
