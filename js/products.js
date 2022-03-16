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
    $('#may').prop('disabled', false);
    $('#cont-may').empty();
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
                    $('#codeBars').attr('readonly', true);
                    $('#nameProduct').val(data.nombre);
                    $('#unidadV').val(data.unidad);
                    $('#price').val(data.precio);
                    if (data.cantMay != null) {
                        $('#may').click();
                        $('#may').prop('disabled', true)
                        $('#priceMay').val(data.preciomay)
                        $('#cantMay').val(data.cantMay);
                    } else {
                        $('#may').prop("checked", false);
                        $('#cont-may').empty();
                        $('#may').prop('disabled', true)
                    }
                    break;
            }
        }
    });
}

function closeAlert() {
    $('#descrip').remove();
}

$(function() {
    $('#tableProd').dataTable();
    $('#may').change(function() {
        if ($('#may').prop('checked')) {
            $('#cont-may').append("<div class='input-group mb-3'>" +
                "<span class='input-group-text'>Precio de mayoreo: $</span>" +
                "<input step='any' type='number' maxlength='10'" +
                "oninput='if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);'" +
                "class='form-control' name='priceMay' id='priceMay' placeholder='Precio Mayoreo' required>" +
                "</div>" +

                "<div class='input-group mb-3'>" +
                "<span class='input-group-text'>Cantidad valida:</span>" +
                "<input step='any' type='number' maxlength='10'" +
                "oninput='if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);'" +
                "class='form-control' name='cantMay' id='cantMay' placeholder='Cantidad valida' required>" +
                "</div>");
        } else
            $('#cont-may').empty();

    })
})