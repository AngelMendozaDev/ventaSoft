function addPerson(){
    
    $.ajax({
        url:'controllers/addPersona.php',
        type: 'POST',
        data:$('#form-personal').serialize(),
        success:function(response){
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
            }
            else if(response.trim() == 3){
                swal("Server sin Conexión", "Contacte a soporte técnico", "info");
            }

        }
    });

    return false;
}

function closeAlert() {
    $('#descrip').remove();
}


$(function(){
    $('#table').dataTable();
});