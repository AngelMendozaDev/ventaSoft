function login(sex,name){
    $('#Login').show();
    $('#us').val(name)
    $('#img-login').prop('src','media/images/'+sex+'.svg')
    $('#pass').focus();
}

function logIn() {
    $.ajax({
        url: 'controllers/logIn.php',
        type: 'POST',
        data: $('#form-log').serialize(),
        success: function(response) {
            //console.log(response);
            response = response.trim();
            if (response == 1)
                location.href = "ventas.php";
            else if (response == 2)
                swal("Usuario/Contraseña Incorrectos", "LUMEGA-MX ESTUDIO 2022", "error");
            else if (response == 3)
                swal("Server sin Conexión", "Contacte a soporte técnico", "info");
        }
    });

    return false;
}

$(function(){
    $('#Login').hide()

    $('#closeL').click(function(){
        $('#Login').hide();
    });
});