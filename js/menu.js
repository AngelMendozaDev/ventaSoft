$('#menu-status').change(function() {
    if ($('#menu-status').is(':checked')) {
        $('#my-menu').addClass('activo');
    } else {
        $('#my-menu').removeClass('activo');
    }
});