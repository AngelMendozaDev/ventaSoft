$('#menu-status').change(function() {
    if ($('#menu-status').is(':checked')) {
        $('#my-menu').addClass('activo');
    } else {
        $('#my-menu').removeClass('activo');
    }
});

$(function() {

    fecha = new Date();

    day = fecha.getDate() < 10 ? "0" + fecha.getDate() : fecha.getDate();
    month = fecha.getMonth() + 1 < 10 ? "0" + (fecha.getMonth() + 1) : fecha.getMonth() + 1;
    year = fecha.getFullYear();

    hoy = year + "-" + month + "-" + day
    hoy = ""+hoy
    $('#rep_v').attr('href', 'repov.php?fi=' + hoy + '&ff=' + hoy);
});