$(function(){
    $('#btn_back').on('click', function() {
        window.location.href = $(this).data('url');
    });
});
