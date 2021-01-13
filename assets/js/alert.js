
jQuery(document).ready(function() {

    $('table').DataTable();

    $('#select_frais').on('change', function () {
        $select_frais = $(this).val();
        if ($select_frais === 'minerval')
            $('#div_minerval').slideDown();
        else
            $('#div_minerval').slideUp();

    });
    $('#select_cycle').on('change', function () {
        $select_cycle = $(this).val();
        if ($select_cycle === 'secondaire')
            $('#row_secondaire').slideDown();
        else
            $('#row_secondaire').slideUp();

        if ($select_cycle === 'EB')
            $('#row_eb').slideDown();
        else
            $('#row_eb').slideUp();

        if ($select_cycle === 'primaire')
            $('#row_primaire').slideDown();
        else
            $('#row_primaire').slideUp();

        if ($select_cycle === 'maternel')
            $('#row_maternel').slideDown();
        else
            $('#row_maternel').slideUp();

    });

    $('#bld').on('click', function (e) {
        e.preventDefault();
        $('#alt').hide(1500);
    });

    setTimeout(function () {
        $('#alt').show(1000);
    }, 500);

    setTimeout(function () {
        $('#alt').hide(1500);
    }, 9000);

    $('form').attr('autocomplete', 'off');

    $('.form-control').on('focus', function () {
        $(this).removeClass('is-invalid');
    });

});
