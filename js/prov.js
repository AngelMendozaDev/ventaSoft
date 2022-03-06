function setProv() {
    $.ajax({
        url: "controllers/addProv.php",
        type: "POST",
        data: $('#formProv').serialize(),
        success: function (response) {
            console.log(response);
            res = response.trim();
            if (response.trim() == 1) {
                swal({
                    title: "Proveedor Guardado, con exíto",
                    text: "LUMEGA-MX ESTUDIO [MARZO 2022]",
                    icon: "success"
                })
                    .then((value) => {
                        location.reload();
                    });
            } else if (response.trim() == "exist") {
                swal("El proveedor ya se encuentra registrado", "LUMEGA-MX [VentaSoft V 1.0]", "info");
            } else {
                swal("Oops!", "Algo salio mal, intenta de nuevo, si el problema continua, contacte a soporte tecnico");
            }
        }
    });

    return false;
}

function getInfo(proveedor) {
    $.ajax({
        url: "controllers/getInfo.php",
        type: "POST",
        data: { prov: proveedor, Tipo: "gprov" },
        success: function (response) {
            //console.log(response);
            data = JSON.parse(response);
            $('#action').val("update");
            $('#idProv').val(data.id_prov);
            $('#nameP').val(data.nombre_prov);
            $('#empresa').val(data.empresa);
            $('#phone').val(data.numero);
        }
    });
}

function deleteProv(param) {
    swal({
        title: "Estas Segur@?",
        text: "Una vez eliminado el registro no podras recuperarlo",
        icon: "warning",
        buttons: ["Cancelar", "Eliminar"],
        dangerMode: true,
    })
        .then((willDelete) => {
            if (willDelete) {
                data = param.split("*");

                prov = data[0];
                phone = data[1];
                user = data[2];
                action = "delProv";

                $.ajax({
                    url: "controllers/addProv.php",
                    type: "POST",
                    data: { action, prov, phone, user },
                    success: function (response) {
                        console.log(response);
                        res = response.trim();
                        if (response.trim() == 1) {
                            swal({
                                title: "Proveedor Eliminado, con exíto",
                                text: "LUMEGA-MX ESTUDIO [MARZO 2022]",
                                icon: "success"
                            })
                                .then((value) => {
                                    location.reload();
                                });
                        } else if (response.trim() == "exist") {
                            swal("El proveedor ya se encuentra registrado", "LUMEGA-MX [VentaSoft V 1.0]", "info");
                        } else {
                            swal("Oops!", "Algo salio mal, intenta de nuevo, si el problema continua, contacte a soporte tecnico");
                        }
                    }
                });
            }
        });
}

function closeAlert() {
    $('#descrip').remove();
}

$(function () {
    $('#tableProv').dataTable();
})