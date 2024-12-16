$(document).ready(function() {
    $('button').click(function() {
        const url = $(this).data('url');
        if (url) {
            window.location.href = url;
        }
    });
});
