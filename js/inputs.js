let cont = 0;
let auxCont = 0;

function closeAlert() {
    $('#descrip').remove();
}

function deleteProd(id) {
    console.log("Eliminando el Prod " + id)
    $('#prod' + id).remove();
    auxCont--;
}

function getDetalle(id) {
    $.ajax({
        url: "controllers/getInfo.php",
        type: "POST",
        data: { note: id, Tipo: "getDetailNote" },
        success: function(response) {
            //console.log(response);
            data = JSON.parse(response);
            $('#lienzo-detail').empty();
            $.each(data, function(item, key) {
                $('#n_note').html(key.note);
                $('#name_prov').html(key.prov);
                $('#lienzo-detail').append("<tr>" +
                    "<td>" + key.code + "</td>" +
                    "<td>" + key.name + "</td>" +
                    "<td>" + key.cant + "</td>" +
                    "</tr>")
            });
        }
    });
}

$(function() {
    $('#tableInput').dataTable();
    Tipo = "gallprov";
    $.ajax({
        url: "controllers/getInfo.php",
        type: "POST",
        data: { Tipo },
        success: function(response) {
            //console.log(response);
            data = JSON.parse(response);
            //console.log(data);
            $.each(data, function(key, item) {
                $('#prov').append("<option value='" + item.id + "'>" + item.name + "</option>");
            });
        }
    });


    $('#codeBar').keypress(function(event) {
        if (event.which == 13) {
            code = $('#codeBar').val();
            $('#form-nota').submit(false);
            if (code != "") {
                $.ajax({
                    url: "controllers/getInfo.php",
                    type: 'POST',
                    data: { Tipo: "getProdN", codeBar: code },
                    success: function(response) {
                        res = response.trim();
                        if (res == "err") {
                            swal("Codigo inexistente", "LUMEGA-MX[VentaSoft v.0.1]", "error");
                            $('#Cant').attr('disabled', true);
                        } else if (res == '3')
                            swal("Se perdio La conexión", "LUMEGA-MX[VentaSoft v.0.1]", "error");
                        else {
                            data = JSON.parse(response);
                            $('#Name').val(data.nombre);
                            $('#Cant').attr('disabled', false);
                            $('#Cost').attr('disabled', false);
                            $('#Cost').focus();
                        }
                    }
                });
            }
        }
    });

    $('#addProd').click(function() {
        cant = $('#Cant').val();
        if (cant != "") {
            $('#msgbox').removeClass('visible');
            cont++;
            auxCont++;
            code = $('#codeBar').val();
            namep = $('#Name').val();
            cos = $('#Cost').val();

            $('#codeBar').val("");
            $('#Name').val("");
            $('#Cant').val("");
            $('#Cant').attr('disabled', true);
            $('#codeBar').focus();

            $("#lienzo").append("<tr id='prod" + cont + "'>" +
                "<td>" +
                "<input type='text' maxlength='15' value='" + code + "' name='codeNote[]' readonly>" +
                "</td>" +
                "<td>" +
                "<input type='text' value='" + namep + "' readonly>" +
                "</td>" +
                "<td>" +
                "<input style='width: 50px; text-align:center' name='cantProd[]' step='any' value='" + cant + "' type='number' maxlength='10' oninput='if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);' readonly>" +
                "</td>" +
                "<td>" +
                "<input style='width: 50px; text-align:center' name='costProd[]' step='any' value='" + cos + "' type='number' maxlength='10' oninput='if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);' readonly>" +
                "</td>" +
                "<td>" +
                "<button type='button' class='btn btn-small btn-danger' onclick='deleteProd(`" + cont + "`)'>" +
                "<i class='fa fa-times' aria-hidden='true'></i>" +
                "</button>" +
                "</td>" +
                "</tr>");
        } else {
            $('#msgbox').addClass('visible');
            console.log("rede");
        }
    });

    $('#Cant').keypress(function(evt) {
        if (evt.which == 13) {
            cant = $('#Cant').val();
            if (cant != "") {
                $('#addProd').click();
            } else {
                $('#msgbox').addClass('visible');
                console.log("rede");
            }
        }
    });

    $("#cancelNote").click(function() {
        $('#form-nota')[0].reset();
        $('#lienzo').empty();
        cont = 0;
        auxCont = 0;
    });

    $("#saveNote").click(function() {
        nota = $('#n_nota').val();
        prov = $('#prov').val();

        if (auxCont > 0 && nota != "" && prov != null) {
            $.ajax({
                url: "controllers/addNotes.php",
                type: 'POST',
                data: $('#form-nota').serialize(),
                success: function(response) {
                    result = response.trim();
                    console.log(result);
                    if (result == 1) {
                        swal("Nota Guardada Con éxito", "LUMEGA-MX [2022]", "success")
                            .then((value) => {
                                location.reload();
                            });
                    } else if (result == 3)
                        swal("Se perdio la conexion con el Servidor", "Intenta mas tarde o llama a soporte tecnico", "info");
                    else if (result == "exist")
                        swal("La nota ya existe o ya fue cargada, revisala por favor, si es complemento colocale -B al final");
                }
            });
        } else {
            swal({
                title: "La nota NO sera guardada",
                text: "Completa la informacion para poder guaradar",
                icon: "info"
            })
        }
    });
});