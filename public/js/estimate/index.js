$(function(){
    // 閲覧ボタン
    $('.btn_pdf').on('click', function() {
        window.location.href = $(this).data('url');
    });
});
