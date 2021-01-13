
jQuery(document).ready(function() {

    $('td').addClass('text-uppercase');

    $('#jlk').on('click', function (e) {
        e.preventDefault();
        $('#alt').removeClass('bounceInUp').addClass('zoomOutDown');
    });

    setTimeout(function () {
        $('#alt').show(1000);
    }, 500);

    setTimeout(function () {
        $('#alt').removeClass('bounceInUp').addClass('zoomOutDown');
    }, 8000);

    $('form').attr('autocomplete', 'off');

    $('.form-control').on('focus', function () {
        $(this).removeClass('is-invalid');
    });

    $(function(){

        $(document).on( 'scroll', function(){
            if ($(window).scrollTop() > 100) {
                $('.scroll-top-wrapper').addClass('show');
            } else {
                $('.scroll-top-wrapper').removeClass('show');
            }
        });

        $('.scroll-top-wrapper').on('click', scrollToTop);
    });

    function scrollToTop() {
        verticalOffset = typeof(verticalOffset) != 'undefined' ? verticalOffset : 0;
        element = $('body');
        offset = element.offset();
        offsetTop = offset.top;
        $('html, body').animate({scrollTop: offsetTop}, 500, 'linear');
    }
});
