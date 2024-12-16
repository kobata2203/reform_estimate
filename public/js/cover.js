$(function(){
    function adjustFontSize() {

        var $container = $('#construction-items');//Target the ID "件名"
        var text = $container.text().replace(/\s+/g, '\u0020').trim(); //　\u0020使て半角スペース
        var containerWidth = $container.width();
        var minFontSize = 7;
        var maxFontSize = 12;
        var fontSize = maxFontSize;

        var $tempSpan = $('<span>').text(text).css({
            'font-size': fontSize + 'px',
            'white-space': 'nowrap',
            'visibility': 'hidden',
            'position': 'absolute'
        }).appendTo('body');

        while ($tempSpan.width() > containerWidth && fontSize > minFontSize) {
            fontSize--;
            $tempSpan.css('font-size', fontSize + 'px');
        }

        $tempSpan.remove();
        $container.css('font-size', fontSize + 'px');
    }

    adjustFontSize();

    $(window).resize(function () {
        adjustFontSize();
    });
});
