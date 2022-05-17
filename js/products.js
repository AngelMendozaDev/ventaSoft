function addProd() {
    $.ajax({
        url: 'controllers/addProduct.php',
        type: 'POST',
        data: $('#formAddProd').serialize(),
        success: function (response) {
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
        success: function (response) {
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

function getInfoM(codeBar) {
    $('#formMay').hide();
    $('#prodID').val(codeBar);
    $('#formMay').hide();
    $('#btn-more-may').addClass('btn-primary');
    $('#btn-more-may').removeClass('btn-danger');
    $('#btn-more-may').html('<i class="fa fa-plus" aria-hidden="true"></i>');
    $.ajax({
        url: "controllers/getInfo.php",
        type: 'POST',
        data: { Tipo: "getMay", code: codeBar },
        success: function (response) {
            //console.log(response);
            data = JSON.parse(response);
            console.log(data);
            $('#lienzo-may').empty();
            $.each(data, function (key, item) {
                aux = item.cant.split(".");
                if (aux[1] != '00')
                    cant = item.cant;
                else
                    cant = aux[0];
                $('#lienzo-may').append("<tr class='text-center'>" +
                    "<td>" + cant + "</td>" +
                    "<td>$" + item.price + "</td>" +
                    "<td>" +
                    "<button class='btn btn-warning btn-small' onclick='editMay(`" + codeBar + "`,`"+item.folio+" `,`" + item.cant + "`,`" + item.price + "`)'>" +
                    "<i class='fa fa-edit' aria-hidden='true'></i>" +
                    "</button>" +
                    "<button class='btn btn-danger btn-small'>" +
                    "<i class='fa fa-trash' aria-hidden='true'></i>" +
                    "</button>" +
                    "</td>" +
                    "</tr>")
            });
        }
    });
}

function editMay(code,folio, cant, price) {
    $('#prodID').val(code+"-"+folio);
    $('#types').val("M");
    $('#cantMayA').val(cant);
    $('#priceMayA').val(price);
    $('#btn-May').html('<i class="fa fa-sync" aria-hidden="true"></i> Actualizar');
    $('#formMay').show();
    $('#btn-more-may').removeClass('btn-primary');
    $('#btn-more-may').addClass('btn-danger');
    $('#btn-more-may').html('<i class="fa fa-times" aria-hidden="true"></i>');
}

function setMayoreo() {
    $.ajax({
        url: 'controllers/addMayoreo.php',
        type: 'POST',
        data: $("#formMay").serialize(),
        success: function (response) {
            console.log(response);
            if (response.trim() == '1') {
                swal({
                    title: "Mayoreo guardado, con exíto",
                    text: "LUMEGA-MX ESTUDIO [MARZO 2022]",
                    icon: "success"
                })
                    .then((value) => {
                        getInfoM($('#prodID').val());
                    });
            }
        }
    });
    return false;
}

function closeAlert() {
    $('#descrip').remove();
}

$(function () {
    $('#tableProd').dataTable();

    $('#may').change(function () {
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

    });

    $('#btn-more-may').click(function () {
        if ($('#types').val() == "") {
            $('#types').val("N");
            $('#formMay').show();
            $('#btn-more-may').removeClass('btn-primary');
            $('#btn-more-may').addClass('btn-danger');
            $('#btn-more-may').html('<i class="fa fa-times" aria-hidden="true"></i>');
            $('#btn-May').html('<i class="fa fa-save" aria-hidden="true"></i> Guardar');
        }
        else {
            $('#types').val("");
            $('#formMay').hide();
            $('#btn-more-may').addClass('btn-primary');
            $('#btn-more-may').removeClass('btn-danger');
            $('#btn-more-may').html('<i class="fa fa-plus" aria-hidden="true"></i>');
        }
    });

})