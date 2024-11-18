$(function(){
    // 戻るボタン
    $('#btn_back').on('click', function() {
        window.location.href = $(this).data('url');
    });

    // 削除ボタン
    $('.btn_delete').on('click', function() {
        if(!confirm('削除してもよろしいですか？')){
            /*　キャンセルの時の処理 */
            return false;
        }else{
            window.location.href = $(this).data('url');
        }

    });
});
