function getDiario() {
    fecha = new Date();

    day = fecha.getDate() < 10 ? "0" + fecha.getDate() : fecha.getDate;
    month = fecha.getMonth() + 1 < 10 ? "0" + (fecha.getMonth() + 1) : fecha.getMonth() + 1;
    year = fecha.getFullYear();

    hoy = year + "-" + month + "-" + day
    location.href = 'repov.php?fi=' + hoy + '&ff=' + hoy;
}


$(function() {
    // $('#myTable').DataTable({
    //     scrollY: "400px",
    //     scrollCollapse: true,
    //     paging: false,
    //     dom: 'Bfrtip',
    //     buttons: [{
    //         extend: 'print',
    //         text: 'Imprimir reporte'
    //     }]
    // });

    $('#myTable').DataTable({
        "footerCallback": function(row, data, start, end, display) {
            var api = this.api();

            // Remove the formatting to get integer data for summation
            var intVal = function(i) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '') * 1 :
                    typeof i === 'number' ?
                    i : 0;
            };

            // Total over all pages
            total = api
                .column(2)
                .data()
                .reduce(function(a, b) {
                    return intVal(a) + intVal(b);
                }, 0);

            // Total over this page
            pageTotal = api
                .column(2, { page: 'current' })
                .data()
                .reduce(function(a, b) {
                    return intVal(a) + intVal(b);
                }, 0);

            // Update footer
            $(api.column(2).footer()).html(
                '$' + total
            );
        },
        dom: 'Bfrtip',
        buttons: [{
            extend: 'print',
            text: 'Imprimir reporte',
            footer: true
        }]
    });

    $('#f-i').change(function() {
        if ($('#f-i').val() <= $('#f-f').val()) {
            location.href = 'repov.php?fi=' + $('#f-i').val() + '&ff=' + $('#f-f').val();
        } else {
            alert("Fechas invalidas")
        }

    });
});