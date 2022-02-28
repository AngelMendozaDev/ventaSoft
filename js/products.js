function addProd() {
    $.ajax({
        url: 'controllers/addProduct.php',
        type: 'POST',
        data: $('#formAddProd').serialize(),
        success: function(response) {
            console.log(response);
            $('#formAddProd')[0].reset();
            $('#btn-close').click();
            if (response.trim() == 1) {
                swal({
                        title: "Producto Guardado, con exíto",
                        text: "LUMEGA-MX ESTUDIO [MARZO 2022]",
                        icon: "success"
                    })
                    .then((value) => {
                        location.reload();
                    });
            } else if (response.trim() == "exist") {
                swal("El producto ya se encuentra registrado", "LUMEGA-MX [VentaSoft V 1.0]", "info");
            }

        }
    });

    return false;
}

function getInfo(codeBar) {
    $('#action').val("edit");
    $.ajax({
        url: "controllers/getInfo.php",
        type: "POST",
        data: { codeBar: codeBar, Tipo: "gp" },
        success: function(response) {
            //console.log(response);
            res = response.trim();

            switch (res) {
                case 'err':
                    swal("No se encontro información, intente de nuevo", "", "error");
                    break;
                case '3':
                    swal("Servidor sin Conexión", "LUMEGA-MX", "info");
                    break;
                default:
                    data = JSON.parse(res);
                    $('#codeBars').val(data.codigo);
                    $('#nameProduct').val(data.nombre);
                    $('#unidadV').val(data.unidad);
                    $('#price').val(data.precio);
                    break;
            }
        }
    });
}

$(function() {
    $('#tableProd').dataTable();
})