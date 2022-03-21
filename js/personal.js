function addPerson() {
    $.ajax({
        url: 'controllers/addPersona.php',
        type: 'POST',
        data: $('#form-personal').serialize(),
        success: function(response) {
            console.log(response);
            if (response.trim() == 1) {
                swal({
                        title: "Persona Guardada, con exíto",
                        text: "LUMEGA-MX ESTUDIO [MARZO 2022]",
                        icon: "success"
                    })
                    .then((value) => {
                        location.reload();
                    });
            } else if (response.trim() == "exist") {
                swal("La persona ya se encuentra registrada", "LUMEGA-MX [VentaSoft V 1.2]", "info");
            } else if (response.trim() == 3) {
                swal("Server sin Conexión", "Contacte a soporte técnico", "info");
            }
        }
    });

    return false;
}

function getUser(persona) {
    $('#action').val("edit");
    $.ajax({
        url: 'controllers/getInfo.php',
        type: 'POST',
        data: { Tipo: "getPersonal", persona: persona },
        success: function(response) {
            console.log(response);
            data = JSON.parse(response);
            $('#name').val(data.nombre);
            $('#app').val(data.app);
            $('#apm').val(data.apm);
            $('#phone').val(data.telefono);
            $('#nameUser').val(data.usuario);
            $('#tipo').val(data.tipo);
            $('#id_us').val(data.id_p);
        }
    });
}

function resetPass(persona, user) {
    swal({
            title: "Restaurar la contraseña?",
            text: "Una vez que la restaures no hay marcha atras",
            icon: "warning",
            buttons: ["Cancelar", "restaurar contraseña"],
            successMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    url: "controllers/addPersona.php",
                    type: "POST",
                    data: { action: "reset", user: user, person: persona },
                    success: function(response) {
                        console.log(response);
                        if (response.trim() == 1) {
                            swal({
                                    title: "Contraseña [1234] Guardada, con exíto",
                                    text: "LUMEGA-MX ESTUDIO [MARZO 2022]",
                                    icon: "success"
                                })
                                .then((value) => {
                                    location.reload();
                                });
                        } else if (response.trim() == "exist") {
                            swal("La persona ya se encuentra registrada", "LUMEGA-MX [VentaSoft V 1.2]", "info");
                        } else if (response.trim() == 3) {
                            swal("Server sin Conexión", "Contacte a soporte técnico", "info");
                        }
                    }
                });
            }
        })
}

function closeAlert() {
    $('#descrip').remove();
}


$(function() {
    $('#table').dataTable();
});